<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $casts = [
        'published_date' => 'date',
    ];

    function loan()
    {
        return $this->hasMany(Loan::class);
    }
    function language()
    {
        return $this->belongsTo(Language::class);
    }
    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
