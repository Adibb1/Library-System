<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $casts = [
        'loan_date' => 'datetime',
    ];

    function book()
    {
        return $this->belongsTo(Book::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function testimony()
    {
        return $this->hasOne(Testimony::class);
    }
}
