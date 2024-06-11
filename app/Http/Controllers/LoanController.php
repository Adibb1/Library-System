<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Message;
use App\Models\Book;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    function create(Request $request)
    {
        $loans = new Loan();
        $messages = new Message();
        $book = Book::findOrFail($_GET['bookid']);

        $messages->user_id = Auth::id();
        $messages->text = 'Thanks for renting our books !';
        $messages->date = now();

        $loans->name = $request->name;
        $loans->user_id = Auth::id();
        $loans->book_id = $_GET['bookid'];
        $loans->loan_date = now();

        $book->increment('loaned');

        $messages->save();
        $loans->save();

        return redirect('/loans');
    }
    function index()
    {
        $loans = Loan::with('book')->where('user_id', Auth::id())->get()->reverse();
        $testimonies = Testimony::where('user_id', Auth::id())->get();
        return view('loans', compact('loans', 'testimonies'));
    }
}
