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
        $URmessages = Message::where('user_id', Auth::id())->where('read', 0)->get();
        $Rmessages = Message::where('user_id', Auth::id())->where('read', 1)->get();
        return view('/message', compact('URmessages', 'Rmessages'));
    }
    function read_message(Request $request, $id)
    {
        $message = Message::find($id);
        $message->read = true;
        $message->save();

        return (redirect('/message'));
    }
}
