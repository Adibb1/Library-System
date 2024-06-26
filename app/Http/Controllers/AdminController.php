<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Message;
use App\Models\User;
use App\Models\Category;
use Carbon\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    function create(Request $request)
    {

        $books = new Book();
        $books->title = $request->Title;
        $books->author = $request->Author;
        $books->ISBN = $request->ISBN;
        $books->description = $request->Description;
        $books->category_id = $request->Category;
        $books->price = $request->Price;
        $books->language_id = $request->Language;
        // dd($books);

        $request->validate([
            'picture' => 'required|image|max:10240'
        ]);
        $file = $request->file('picture');
        $file_name = time() . '_' . $file->getClientOriginalName();

        $file_path = $file->storeAs('public', $file_name);

        $asset_url = asset(Storage::url($file_path));

        $books->picture = $asset_url;

        $books->save();
        return redirect('/admin');
    }
    function index()
    {
        $books = Book::all();
        $loans = Loan::all();
        $users = User::all();
        $languages = Language::all();
        $categories = Category::all();
        return view('admin', compact('books', 'loans', 'users', 'categories', 'languages'));
    }
    function destroy(Book $book)
    {
        $book->delete();
        return redirect('/admin');
    }
    function update(Request $request, Book $book)
    {
        $book->title = $request->Title;
        $book->author = $request->Author;
        $book->ISBN = $request->ISBN;
        $book->description = $request->Description;
        $book->price = $request->Price;

        // Handle pictuer
        if ($request->hasFile('picture')) {
            $request->validate([
                'picture' => 'image|max:10240'
            ]);

            if ($book->picture) { // Delete old picture if it existss
                $oldFilePath = str_replace(asset('storage'), 'public', $book->picture);
                Storage::delete($oldFilePath);
            }

            // cnp from top uwu
            $file = $request->file('picture');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file_path = $file->storeAs('public', $file_name);
            $asset_url = asset(Storage::url($file_path));

            $book->picture = $asset_url;
        }

        // Save the updated book
        $book->save();

        // Redirect with success message
        return redirect('/admin')->with('success', 'Book updated successfully');
    }
    function send_message(Request $request)
    {
        $message = new Message();
        $message->user_id = $request->user;
        $message->text = $request->message;

        $message->save();
        return redirect('/admin');
    }
    function trends($bookid)
    {
        $book = Book::findOrFail($bookid);
        $book->trending = True;
        $book->save();
        return redirect('/admin');
    }
    function canceltrends($bookid)
    {
        $book = Book::findOrFail($bookid);
        $book->trending = False;
        $book->save();
        return redirect('/admin');
    }
    function recommends($bookid)
    {
        $book = Book::findOrFail($bookid);
        $book->recommended = True;
        $book->save();
        return redirect('/admin');
    }
    function cancelrecommends($bookid)
    {
        $book = Book::findOrFail($bookid);
        $book->recommended = False;
        $book->save();
        return redirect('/admin');
    }
    public function edit_picture(Request $request, $id): RedirectResponse
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'picture' => 'required|image|max:10240'
        ]);

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file_path = $file->storeAs('public/profile_pictures', $file_name);
            $asset_url = Storage::url($file_path);

            //delete old picture
            if ($book->profile_picture) {
                $old_file_path = str_replace('/storage', 'public', $book->picture);
                Storage::delete($old_file_path);
            }

            $book->picture = $asset_url;
            $book->save();
        }

        return redirect('/admin');
    }
}
