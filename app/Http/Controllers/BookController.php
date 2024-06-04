<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    function index()
    {
        $books = Book::all();
        // dd($books);
        return view('home', compact('books'));
    }

    function showLoanPage($id)
    {
        $book = Book::findOrFail($id);
        return view('confirmloan', compact('book'));
    }
}
