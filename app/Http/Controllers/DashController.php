<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Message;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Type\TrueType;

class DashController extends Controller
{
    function index()
    {
        $trendingBooks = Book::where('trending', true)->take(6)->get();
        $recommendedBooks = Book::where('recommended', true)->take(6)->get();
        $testimonials = Testimony::latest()->take(5)->get();

        // Pass data to the view
        return view('dashboard', compact('trendingBooks', 'recommendedBooks', 'testimonials',));
    }
}
