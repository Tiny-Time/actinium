<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_ip',
        'emoji',
        'guestbook_id',
    ];

     /**
     * Get the guestbook that owns the reaction.
     */
    public function guestbook(): BelongsTo
    {
        return $this->belongsTo(Guestbook::class);
    }
}
