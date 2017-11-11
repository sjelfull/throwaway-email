<?php

namespace App\Http\Controllers;

use App\Address;
use App\Message;
use Illuminate\Http\Request;
use Postmark\Inbound;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        return response()->json([ 'status' => 'ok' ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $inbound = new Inbound(file_get_contents('php://input'));

        $recipients = collect($inbound->Recipients());

        // Get address first
        $address = Address::firstOrCreate([
            'name' => $recipients->first()->Email,
        ]);


        $message = Message::create([
            'from_email'   => $inbound->FromEmail(),
            'from_name'    => $inbound->FromName(),
            'reply_to'     => $inbound->ReplyTo(),
            'receive_date' => $inbound->Date(),
            'html_body'    => $inbound->HtmlBody(),
            'text_body'    => $inbound->TextBody(),
            'message_id'   => $inbound->MessageID(),
            'mailbox_hash' => $inbound->MailboxHash(),
            'source'       => $inbound->Json,
            'address_id'   => $address->id,
        ]);

        //app('log')->debug($request->all());

        return response()->json([ 'status' => 'ok' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message $message
     *
     * @return \Illuminate\Http\Response
     */
    public function show (Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message $message
     *
     * @return \Illuminate\Http\Response
     */
    public function edit (Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Message             $message
     *
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message $message
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy (Message $message)
    {
        //
    }
}
