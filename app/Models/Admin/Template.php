<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'template_category_id',
        'view',
        'preview_image',
        'premium',
        'status',
    ];

    /**
     * Get the templateCategory that owns the Template
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function templateCategory(): BelongsTo
    {
        return $this->belongsTo(TemplateCategory::class);
    }
}
