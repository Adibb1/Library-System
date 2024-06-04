<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index()
    {
        $fines = Fine::where('user_id', Auth::id())->where('paid', false)->get();
        return view('fines', compact('fines'));
    }

    public function pay(Fine $fine)
    {
        if ($fine->user_id !== Auth::id()) {
            return redirect()->route('fines')->withErrors('Unauthorized');
        }

        $fine->paid = True;
        $fine->save();
        return redirect()->route('fines')->with('success', 'Fine paid successfully.');
    }
}
