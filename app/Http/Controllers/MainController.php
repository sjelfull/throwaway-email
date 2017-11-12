<?php

namespace App\Http\Controllers;

use App\Address;
use App\Message;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index (Request $request)
    {
        $addresses = Address::with('messages')->get();

        return view('addresses', compact('addresses'));
    }

    public function messages ($inbox, $selectedMessage = null)
    {
        $address = Address::firstOrCreate([
            'name' => $inbox,
        ]);

        if ( $selectedMessage ) {
            $selectedMessage = Message::find($selectedMessage);
        }

        $address->load([
            'messages' => function ($query) {
                $query->orderBy('receive_date', 'asc');
            } ]);

        return view('messages', compact('address', 'selectedMessage'));
    }
}
