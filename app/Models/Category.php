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
}
