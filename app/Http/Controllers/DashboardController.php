<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $availableBooks = Book::where('status', 'available')->count();
        $busyBooks = Book::where('status', 'busy')->count();
        $author = Author::count();
        $user = User::count();
        return view('dashboard.index', compact('availableBooks', 'busyBooks','author','user'));
    }
}
