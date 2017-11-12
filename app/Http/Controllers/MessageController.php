<?php

namespace App\Http\Controllers;

use App\Address;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $inbound   = new Inbound(file_get_contents('php://input'));
        $domain    = config('throwaway.domain');
        $recipient = collect($inbound->Recipients())->filter(function ($recipient) use ($domain) {
            $parts = explode('@', $recipient->Email);

            return trim($parts[1]) === $domain;
        })->transform(function ($recipient) {
            return $recipient->Email;
        })->first();

        // Ignore if no matches
        if ( !$recipient ) {
            return response()->json([ 'status' => 'ok' ]);
        }

        //throw_if(!$recipient, \Exception::class);

        $recipientInbox = explode('@', $recipient);

        Log::debug($recipientInbox[0]);

        // Get address first
        $address = Address::firstOrCreate([
            'name' => $recipientInbox[0],
        ]);

        // TODO: Verify request

        $message = Message::create([
            'subject'      => $inbound->Subject(),
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
        return $message->html_body;
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
        return $message->delete();
    }
}
