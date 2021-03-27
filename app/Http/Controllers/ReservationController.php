<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reservation::with(['user', 'book'])->orderBydesc('created_at')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(['book_id' => 'required']);
        $book = Book::find($validateData['book_id']); //rendre le book non-disponible
        if ($book->availability) {
            $book->availability = 0;
            $book->save();

            $validateData['user_id'] = Auth::id();
            $validateData['return_date'] = Carbon::now()->addDays(7);;
            $reservation = Reservation::create($validateData);
            return response()->json(['success' => true, 'reservation' => $reservation]);
        }
        return response()->json(['success' => false, 'message' => 'le livre est réserver']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return $reservation->load(['user', 'book']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        if ($reservation->update($request->all())) {
            return response()->json(
                ['success' => true, 'message' => 'Reservation was modified'],
                200
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {

        if ($reservation->delete()) {
            $book = Book::find($reservation->book_id); //rendre le book non-disponible
            $book->availability = 1;
            $book->save();
            return response()->json(
                ['success' => true, 'message' => 'Reservation was deleted'],
                200
            );
        }
    }
}
