<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'parent_id',
    ];

    /**
     * Get the subcategories of this category.
     */
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get all of the templates for the TemplateCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function templates(): HasMany
    {
        return $this->hasMany(Template::class);
    }
}
