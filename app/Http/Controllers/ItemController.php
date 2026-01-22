<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['category', 'location', 'user'])
            ->where('type', 'found')
            ->whereIn('status', ['waiting', 'verified']); // ✅ HANYA TAMPILKAN YANG BELUM DIKLAIM

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location_id', $request->location);
        }

        $sort = $request->get('sort', 'newest');
        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $items = $query->paginate(12);
        $categories = Category::all();
        $locations = Location::all();

        return view('items.index', compact('items', 'categories', 'locations'));
    }

    public function show(Item $item)
    {
        $item->load(['category', 'location', 'user']);
        return view('items.show', compact('item'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('items.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:lost,found',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'date' => 'required|date',
            'description' => 'required|string',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'has_reward' => 'boolean',
            'reward_description' => 'nullable|string',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('items', 'public');
                $images[] = $path;
            }
        }

        Item::create([
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'location_id' => $validated['location_id'],
            'date' => $validated['date'],
            'description' => $validated['description'],
            'images' => $images,
            'has_reward' => $request->has('has_reward'),
            'reward_description' => $validated['reward_description'] ?? null,
            'status' => 'waiting',
        ]);
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->points = $user->points + 10;
        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Laporan berhasil dibuat. Terima kasih atas kejujuran Anda!');
    }

    public function claim(Request $request, Item $item)
    {
        $validated = $request->validate([
            'claim_description' => 'required|string',
            'proof_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $proofImages = [];
        if ($request->hasFile('proof_images')) {
            foreach ($request->file('proof_images') as $image) {
                $path = $image->store('claims', 'public');
                $proofImages[] = $path;
            }
        }

        // Simpan claim ke database
        $claim = $item->claims()->create([
            'user_id' => Auth::id(),
            'claim_description' => $validated['claim_description'],
            'proof_images' => $proofImages,
            'status' => 'pending',
        ]);

        // ✅ UPDATE STATUS BARANG JADI "CLAIMED" (Sedang diklaim, tunggu verifikasi)
        $item->status = 'claimed';
        $item->save();

        // Ambil informasi penemu (user yang melaporkan barang)
        $finder = $item->user;
        
        // Cek apakah penemu punya username Telegram
        if ($finder->telegram_username) {
            // Redirect ke Telegram dengan pesan otomatis
            $claimant = Auth::user();
            $telegramMessage = urlencode(
                "Halo, saya {$claimant->name} (NIM: {$claimant->nim}).\n\n" .
                "Saya ingin mengklaim barang: *{$item->name}*\n" .
                "Lokasi: {$item->location->name}\n" .
                "Tanggal: {$item->date->format('d/m/Y')}\n\n" .
                "Saya sudah mengirim klaim melalui sistem. Mohon diverifikasi. Terima kasih! 🙏"
            );
            
            // Redirect dengan pesan sukses dan link Telegram
            return redirect()->route('items.show', $item)
                ->with('success', 'Klaim berhasil dikirim!')
                ->with('telegram_url', "https://t.me/{$finder->telegram_username}?text={$telegramMessage}")
                ->with('finder_name', $finder->name)
                ->with('finder_telegram', $finder->telegram_username);
        }

        // Jika tidak ada Telegram, tampilkan error
        return redirect()->route('items.show', $item)
            ->with('error', 'Penemu belum mengisi username Telegram. Hubungi admin untuk bantuan.')
            ->with('finder_name', $finder->name);
    }
}