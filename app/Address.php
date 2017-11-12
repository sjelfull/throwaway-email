<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    /**
     * Get all related messages for this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages ()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the messages count
     *
     * @return int
     */
    public function getMessageCountAttribute ()
    {
        $this->loadMissing('messages');

        return $this->messages->count();
    }

    public function getEmailAttribute ()
    {
        return $this->name . '@' . config('throwaway.domain');
    }
}
