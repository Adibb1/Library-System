<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestiController extends Controller
{
    function add_testi(Request $request, $loan_id)
    {
        $testimony = new Testimony();
        $loan = Loan::findOrFail($loan_id);

        $testimony->user_id = Auth::id();
        $testimony->loan_id = $loan_id;
        $testimony->text = $request->text;
        $testimony->created_at = now();

        $testimony->save();

        $loan->testimoni_id = $testimony->id;
        $loan->save();

        return redirect()->back()->with('success', 'Testimony added successfully!');
    }
    function edit_testi(Request $request, $testi_id)
    {
        $testimony = Testimony::findOrFail($testi_id);

        $testimony->text = $request->text;
        $testimony->save();

        return redirect()->back()->with('success', 'Testimony editted successfully!');
    }
    function delete_testi(Request $request, $testi_id)
    {
        $testimony = Testimony::findOrFail($testi_id);

        $testimony->delete();

        return redirect()->back()->with('success', 'Testimony deleted successfully!');
    }
}
