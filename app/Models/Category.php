<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $casts = [
        'published_date' => 'date',
    ];
    function book()
    {
        return $this->hasMany(Book::class);
    }
}
