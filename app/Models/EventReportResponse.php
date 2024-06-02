<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReportResponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_report_id',
        'user_id',
        'response',
    ];

    /**
     * Get the event report that this response is for.
     */
    public function eventReport()
    {
        return $this->belongsTo(EventReport::class);
    }

    /**
     * Get the user who made the response.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
