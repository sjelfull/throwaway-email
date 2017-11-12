<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        return response()->json(Address::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address $address
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy (Address $address)
    {
        //
    }
}
