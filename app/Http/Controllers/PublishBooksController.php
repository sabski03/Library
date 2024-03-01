<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class PublishBooksController extends Controller
{
    public function index(){
        $book = Book::paginate(5);
        return view('publishedBooks.index', compact('book'));
    }

    public function create(){
        $author = Author::all();
        return view('publishedBooks.create', compact('author'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'releaseDate' => 'required|date',
            'status' => 'required|in:available,busy',
            'author_ids' => 'nullable|array',
            'new_authors.*.name' => 'nullable|string',
            'new_authors.*.last_name' => 'nullable|string',
        ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->release_date = $request->input('releaseDate');
        $book->status = $request->input('status');
        $book->save();

        if ($request->filled('author_ids')) {
            $authorIds = array_diff($request->input('author_ids'), ['none']);
            if (!empty($authorIds)) {
                $book->authors()->attach($authorIds);
            }
        }

        if ($request->filled('author_name') && $request->filled('author_lastName')) {
            $author = Author::firstOrCreate([
                'name' => $request->input('author_name'),
                'last_name' => $request->input('author_lastName')
            ]);
            $book->authors()->attach($author->id);
        }

        if ($request->filled('new_authors')) {
            foreach ($request->input('new_authors') as $newAuthorData) {
                if (!empty($newAuthorData['name']) || !empty($newAuthorData['last_name'])) {
                    $author = Author::firstOrCreate([
                        'name' => $newAuthorData['name'] ?? null,
                        'last_name' => $newAuthorData['last_name'] ?? null
                    ]);
                    $book->authors()->attach($author->id);
                }
            }
        }

        return redirect('published_book')->with('status', 'Published Book Created Successfully');
    }


    public function edit($id){
        $book = Book::find($id);
        $authors = Author::all();

        return view('publishedBooks.edit', compact('book', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'releaseDate' => 'required|date',
            'status' => 'required|in:available,busy',
            'author_ids' => 'nullable|array',
        ]);


        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->release_date = $request->input('releaseDate');
        $book->status = $request->input('status');
        $book->save();

        if (!$request->filled('author_ids') || in_array('none', $request->input('author_ids'))) {
            $book->authors()->detach();
        } else {
            $authorIds = $request->input('author_ids');
            $book->authors()->sync($authorIds);
        }

        if ($request->filled('new_authors')) {
            foreach ($request->input('new_authors') as $newAuthorData) {
                if (!empty($newAuthorData['name']) || !empty($newAuthorData['last_name'])) {
                    $author = Author::firstOrCreate([
                        'name' => $newAuthorData['name'] ?? null,
                        'last_name' => $newAuthorData['last_name'] ?? null,
                    ]);

                    $book->authors()->attach($author->id);
                }
            }
        }

        return redirect('published_book')->with('status', 'Published Book Updated Successfully');
    }




    public function delete($id){
        $book = Book::findOrFail($id);
        $book->authors()->detach();
        $book->delete();

        return redirect()->back()->with('delete', 'Published Book Deleted Successfully');
    }

}
