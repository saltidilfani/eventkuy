<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event; // Tambahkan ini

class Category extends Model
{
    use HasFactory;

    protected $table = 'salti_categories';

    protected $fillable = [
        'name',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
    }
    
    // Accessor untuk menghitung sisa kuota
    public function getAvailableSlotsAttribute()
    {
        $registeredCount = $this->registrations()->count();
        $maxParticipants = $this->max_participants ?? 100; // Default 100 jika tidak ada
        return max(0, $maxParticipants - $registeredCount); // Perbaiki di sini
    }
}
