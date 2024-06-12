<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Type\TrueType;

class MessageController extends Controller
{
    function index()
    {
        $messages = Message::where('user_id', Auth::id())->get()->reverse();
        return view('/message', compact('messages'));
    }
    function read_message(Request $request, $id)
    {
        $message = Message::find($id);
        $message->read = true;
        $message->save();

        return (redirect('/message'));
    }
}
