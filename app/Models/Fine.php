<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'amount',
        'due_date',
        'paid',
    ];
    function loan()
    {
        return $this->belongsTo(Loan::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
