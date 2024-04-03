<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function guests() {
        $guests = Guest::all();
        
        return response()->json([
            'guests' => $guests
        ], 200);
    }

    public function reservation(Request $req) {
        $validator = Validator::make($req->all(), [
            'first_seat_name' => ['required', 'string', 'unique:guests,first_seat_name', 'max:255'],
            'first_seat_phone' => ['required', 'numeric', 'unique:guests,first_seat_phone', 'digits:11'],
            'second_seat_name' => ['sometimes', 'required', 'string', 'unique:guests,second_seat_name', 'max:255'],
            'second_seat_phone' => ['nullable', 'numeric', 'unique:guests,second_seat_phone', 'digits:11'],
            'confirmation' => ['required', 'string', 'max:3']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $guest = new Guest;
        $guest->first_seat_name = $req->first_seat_name;
        $guest->first_seat_phone = $req->first_seat_phone;
        $guest->second_seat_name = $req->second_seat_name;
        $guest->second_seat_phone = $req->second_seat_phone;
        $guest->confirmation = $req->confirmation;
        $guest->save();

        return response()->json([
            'msg' => "success",
            'guest' => $guest
        ], 201);
    }
}
