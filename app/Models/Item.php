<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'location_id',
        'type',
        'name',
        'description',
        'date',
        'images',
        'has_reward',
        'reward_description',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
        'date' => 'date',
        'has_reward' => 'boolean',
    ];

    // 🔥 TAMBAHKAN INI - Accessor untuk fix casting
    public function getImagesAttribute($value)
    {
        // Kalau null atau empty string, return empty array
        if (empty($value) || $value === '[]' || $value === '"[]"') {
            return [];
        }
        
        // Decode JSON
        $decoded = json_decode($value, true);
        
        // Kalau berhasil decode dan hasilnya array, return
        if (is_array($decoded)) {
            return $decoded;
        }
        
        // Fallback: return empty array
        return [];
    }

    // 🔥 TAMBAHKAN INI - Mutator untuk ensure data disimpan sebagai JSON
    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = json_encode($value);
        } elseif (is_string($value)) {
            // Kalau udah string, cek apakah valid JSON
            $decoded = json_decode($value, true);
            $this->attributes['images'] = json_encode(is_array($decoded) ? $decoded : []);
        } else {
            $this->attributes['images'] = json_encode([]);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function getFirstImageAttribute()
    {
        $images = $this->images;
        return !empty($images) && isset($images[0]) ? $images[0] : null;
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->format('d F Y');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'waiting' => '<span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Menunggu</span>',
            'verified' => '<span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Terverifikasi</span>',
            'claimed' => '<span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Diklaim</span>',
            'returned' => '<span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Dikembalikan</span>',
            default => '',
        };
    }
}