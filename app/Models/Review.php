<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'organizer_id',
        'transaction_id',
        'rating',
        'review',
    ];

    public function event()
    {
        return $this->hasOneThrough(
            Event::class,
            Transaction::class,
            'id',
            'id',
            'transaction_id',
            'event_id'
        );
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }


    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
