<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $randomSeed = $request->session()->get('random_seed', null);
        if (!$randomSeed) {
            $randomSeed = rand();
            $request->session()->put('random_seed', $randomSeed);
        }

        $books = Book::inRandomOrder("RAND($randomSeed)")->paginate(3);
        return view('/home', compact('books'));
    }

    public function update($id)
    {
        $book = Book::findOrFail($id);
        $status = $book->status;
        $busy = 'busy';
        $available = 'available';

        if ($status == $available) {
            $book->status = $busy;
            $book->save();
            return redirect()->back()->with('warning', 'Book Taken From The Library!');
        } else {
            $book->status = $available;
            $book->save();
            return redirect()->back()->with('status', 'Book Returned In The Library');
        }
    }

    public function searchData(Request $request){
        $data = $request->input('search');
        $books = Book::where('title', 'like', '%'.$data.'%')
            ->orWhereHas('authors', function ($query) use ($data) {
                $query->where('name', 'like', '%'.$data.'%')
                    ->orWhere('last_name', 'like', '%'.$data.'%');
            })
            ->paginate(3);
        return view('home', compact('books'));
    }

}
