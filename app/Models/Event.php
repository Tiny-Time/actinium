<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'date_time',
        'timezone',
        'event_id',
        'template_id',
        'user_id',
        'status',
        'public',
        'address',
        'country',
        'state',
        'contact_name',
        'contact_email_address',
        'contact_phone_number',
        'check_in_time',
        'event_end_time',
        'guestbook',
        'rsvp',
        'post_event_massage',
        'watermark',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_time' => 'datetime',
        'check_in_time' => 'datetime',
        'event_end_time' => 'datetime',
    ];

    /**
     * user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(Template::class);
    }

    /**
     * Get the guestbooks for the event.
     */
    public function guestbooks(): HasMany
    {
        return $this->hasMany(Guestbook::class, 'event_id', 'event_id');
    }

    /**
     * Get the RSVPs for the event.
     */
    public function rsvps(): HasMany
    {
        return $this->hasMany(RSVP::class, 'event_id', 'event_id');
    }

    /**
     * Get the expired events based on timezone.
     */
    public function scopeExpired($query)
    {
        return $query->where('date_time', '<', now($this->timezone));
    }

    /**
     * Get the upcoming events based on timezone.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date_time', '>', now($this->timezone));
    }

    /**
     * Get the event that owns the custom URL.
     */
    public function customUrl(): HasOne
    {
        return $this->hasOne(EventCustomUrl::class);
    }
}
