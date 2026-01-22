<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        
        $lostItems = Item::where('user_id', $user->id)
            ->where('type', 'lost')
            ->with(['category', 'location'])
            ->latest()
            ->get();
        
        $foundItems = Item::where('user_id', $user->id)
            ->where('type', 'found')
            ->with(['category', 'location'])
            ->latest()
            ->get();
        
        return view('dashboard.index', compact('user', 'lostItems', 'foundItems'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'telegram_username' => 'required|string|max:50|regex:/^[a-zA-Z0-9_]+$/', // ✅ WAJIB!
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        /** @var User $user */
        $user = Auth::user();
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }
        
        $user->fill($validated);
        $user->save();

        return redirect()->route('dashboard.profile')
            ->with('success', 'Profil berhasil diperbarui');
    }

    public function points()
    {
        $user = Auth::user();
        
        $badges = [];
        
        $foundCount = Item::where('user_id', $user->id)
            ->where('type', 'found')
            ->count();
            
        if ($foundCount >= 5) {
            $badges[] = [
                'name' => 'Penemu Jujur',
                'description' => 'Lapor 5 barang temuan',
                'achieved' => true
            ];
        }
        
        $verifiedCount = Item::where('user_id', $user->id)
            ->where('status', 'verified')
            ->count();
            
        if ($verifiedCount >= 10) {
            $badges[] = [
                'name' => 'Sahabat Amanah',
                'description' => '10 verifikasi berhasil',
                'achieved' => true
            ];
        }
        
        if ($user->points >= 100) {
            $badges[] = [
                'name' => 'Pahlawan Kampus',
                'description' => 'Bantu 20 orang',
                'achieved' => true
            ];
        }
        
        return view('dashboard.points', compact('user', 'badges'));
    }
}