<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCustomUrl extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'custom_url'];

    /**
     * Get the event that owns the custom URL.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the guestbooks through the event.
     */
    public function guestbooks()
    {
        return $this->hasManyThrough(
            Guestbook::class,
            Event::class,
            'id',
            'event_id',
            'event_id',
            'id'
        );
    }
}
