<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventReport extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'report_reason',
        'deleted_at',
    ];

    /**
     * Get the event that is being reported.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user who reported the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the responses for the event report.
     */
    public function responses()
    {
        return $this->hasMany(EventReportResponse::class);
    }
}
