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
                'sub_category' => '',
                'image' => '/images/templates/Anniversary_ Enchanted_Midnight_Forest.png',
                'type' => 'free',
                'path' => 'themes.anniversary.enchanted-midnight-forest.index',
                'points' => 0,
            ],
            [
                'id' => 2,
                'name' => 'Anniversary Scarlet Serenity',
                'category' => 'Anniversary',
                'sub_category' => '',
                'image' => '/images/templates/Anniversary_ Scarlet_Serenity.png',
                'type' => 'free',
                'path' => 'themes.anniversary.scarlet-serenity.index',
                'points' => 0,
            ],
            [
                'id' => 3,
                'name' => 'Dark Blue Sequins',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => '/images/templates/Birthday_ Dark_Blue_Sequins.png',
                'type' => 'free',
                'path' => 'themes.birthday.dark-blue-sequins.index',
                'points' => 0,
            ],
            [
                'id' => 4,
                'name' => 'Punctual Meeting',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => '/images/templates/meeting/Punctual Meeting/preview.webp',
                'type' => 'paid',
                'path' => 'themes.meeting.punctual-meeting.index',
                'points' => 5,
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
