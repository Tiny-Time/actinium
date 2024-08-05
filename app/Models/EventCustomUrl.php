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
}
