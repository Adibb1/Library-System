<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('author')) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        if ($request->filled('ISBN')) {
            $query->where('ISBN', $request->ISBN);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        if ($request->filled('language')) {
            $query->whereHas('language', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->language . '%');
            });
        }

        $books = $query->get();

        return view('home', compact('books'));
    }
    function showLoanPage($id)
    {
        $book = Book::findOrFail($id);
        $loan = Loan::where('book_id', $book->id)->where('user_id', Auth::id())->first();
        $testimonies = Testimony::where('book_id', $book->id)->get();
        return view('confirmloan', compact('book', 'loan', 'testimonies'));
    }
}
