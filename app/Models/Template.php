<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Template extends Model
{
    use \Sushi\Sushi;

    public function getRows()
    {
        return [
            [
                'id' => 1,
                'name' => 'Enchanted Midnight Forest',
                'category' => 'Anniversary',
                'image' => '/images/templates/Anniversary_ Enchanted_Midnight_Forest.png',
                'type' => 'free',
                'path' => 'themes.anniversary.enchanted-midnight-forest.index',
            ],
            [
                'id' => 2,
                'name' => 'Anniversary Scarlet Serenity',
                'category' => 'Anniversary',
                'image' => '/images/templates/Anniversary_ Scarlet_Serenity.png',
                'type' => 'free',
                'path' => 'themes.anniversary.scarlet-serenity.index',
            ],
            [
                'id' => 3,
                'name' => 'Dark Blue Sequins',
                'category' => 'Birthday',
                'image' => '/images/templates/Birthday_ Dark_Blue_Sequins.png',
                'type' => 'free',
                'path' => 'themes.birthday.dark-blue-sequins.index',
            ],
        ];
    }

    protected function sushiShouldCache()
    {
        return true;
    }

    protected function afterMigrate(Blueprint $table)
    {
        $table->index('id');
    }

    public function event(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
