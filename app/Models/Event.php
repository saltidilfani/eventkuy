<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'salti_events';
    protected $fillable = ['title', 'description', 'event_date', 'event_time', 'category_id', 'location_id', 'poster', 'organizer', 'max_participants'];
    protected $casts = ['event_date' => 'date'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'event_id');
    }

    // Accessor untuk menghitung sisa kuota
    public function getAvailableSlotsAttribute()
    {
        $registeredCount = $this->registrations()->count();
        $maxParticipants = $this->max_participants ?? 100; // Default 100 jika tidak ada
        return max(0, $maxParticipants - $registeredCount);
    }
}
