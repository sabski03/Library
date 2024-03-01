<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $author = Author::paginate(5);

        return view('authors.index', compact('author'));
    }

    public function create(){
        return view('authors.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
        ]);

        $author = new Author();
        $author->name = $request->input('name');
        $author->last_name = $request->input('lastName');
        $author->save();

        return redirect('author')->with('status', 'Author Added Successfully!');
    }

    public function edit($id){
        $author = Author::find($id);

        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
        ]);

        $author = Author::find($id);
        $author->name = $request->input('name');
        $author->last_name = $request->input('lastName');
        $author->update();

        return redirect('author')->with('status', 'Author Updated Successfully');
    }

    public function delete($id){
        $author = Author::find($id);
        $author->delete();

        return redirect('author')->with('delete', 'Author Deleted Successfully');
    }


}
