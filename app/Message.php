<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string      from_email
 * @property string|null from_name
 * @property string|null html_body
 */
class Message extends Model
{
    protected $guarded = [];

    public function address ()
    {
        $this->belongsTo(Address::class);
    }

    public function getFromAttribute ()
    {
        $name = $this->from_name;

        return !empty($name) ? $name . ' <' . $this->from_email . '>' : $this->from_email;
    }

    public function getRelativeDateAttribute ()
    {
        return $this->created_at->diffForHumans();
    }
}
