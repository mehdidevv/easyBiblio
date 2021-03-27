<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        $validateData['password'] = bcrypt($request->password);
        $user = User::create($validateData);
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $token = Auth::attempt($loginData); //JWT
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'invalid login or password'], 200);
        }
        $user = auth()->user();
        return response()->json(['success' => true, 'user' => $user, 'JWT_Token' => $token]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'log out success'
        ], 200);
    }
    public function mybooks()
    {
        //les livres reservés par l'utilisateur
        $book_ids = Collect(Auth::user()->reservations->pluck('book_id'));
        $books = [];
        foreach ($book_ids as $id) {
            array_push($books, Book::find($id)->load(['reservation', 'author']));
        }
        return $books;
    }
    public function mybooksCount()
    {
        //le nombre de livres reservés par l'utilisateur
        return Auth::user()->reservations->count();
    }
}
