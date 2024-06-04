<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    function create(Request $request, Book $book)
    {
        $loans = new Loan();
        $loans->name = $request->name;
        $loans->loan_date = $request->date_loan;
        $loans->due_date = $request->date_return;

        $loans->user_id = Auth::id();
        $loans->book_id = $_GET['bookid'];

        $loans->save();

        $book = Book::find($_GET['bookid']);
        if ($book) {
            $book->increment('loan');
            $book->decrement('ammount');
            $book->save();
        }

        return redirect('/loans');
    }
    function index()
    {
        $loans = Loan::with('book')->where('user_id', Auth::id())->get();
        return view('loans', compact('loans'));
    }
    function confirm_end(Loan $loan)
    {
        $loan->confirm_end = True;
        $loan->save();
        return redirect('/loans');
    }
}
