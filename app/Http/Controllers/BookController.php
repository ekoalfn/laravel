<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){
        if($request->keyword){
            $books = Book::search($request->keyword)->get();
        }else{
            $books = Book::all();
        }

        return view('book', ['books' => $books]);
    }
}
