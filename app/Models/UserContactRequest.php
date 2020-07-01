<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserContactRequest extends Model
{

    protected $fillable = [
        'sender_id', 'reciever_id', 'status',
    ];


    public function sender()
    {

        return $this->belongsTo(User::class, 'sender_id');

    }


    public function reciever()
    {

        return $this->belongsTo(User::class, 'reciever_id');

    }


    public function accept()
    {
        return $this->update([
            'status' => 'accepted'
        ]);
    }


    public function decline()
    {
        return $this->update([
            'status' => 'declined'
        ]);
    }


}
