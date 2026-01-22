<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recentItems = Item::with(['category', 'location', 'user'])
            ->where('type', 'found')
            ->where('status', 'verified')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('recentItems'));
    }
}