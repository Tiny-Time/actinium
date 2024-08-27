<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
                'image' => 'resources/views/templates/anniversary/enchanted-midnight-forest/images/preview.webp',
                'type' => 'free',
                'path' => 'templates.anniversary.enchanted-midnight-forest.index',
                'tokens' => 7,
            ],
            [
                'id' => 2,
                'name' => 'Anniversary Scarlet Serenity',
                'category' => 'Anniversary',
                'sub_category' => '',
                'image' => 'resources/views/templates/anniversary/scarlet-serenity/images/preview.webp',
                'type' => 'free',
                'path' => 'templates.anniversary.scarlet-serenity.index',
                'tokens' => 3,
            ],
            [
                'id' => 3,
                'name' => 'Dark Blue Sequins',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => 'resources/views/templates/birthday/dark-blue-sequins/images/preview.webp',
                'type' => 'free',
                'path' => 'templates.birthday.dark-blue-sequins.index',
                'tokens' => 5,
            ],
            [
                'id' => 4,
                'name' => 'Punctual Meeting',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/punctual-meeting/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.punctual-meeting.index',
                'tokens' => 2,
            ],
            [
                'id' => 5,
                'name' => 'Time Master',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/time-master/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.time-master.index',
                'tokens' => 3,
            ],
            [
                'id' => 6,
                'name' => 'Shape The Future',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/shape-the-future/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.shape-the-future.index',
                'tokens' => 4,
            ],
            [
                'id' => 7,
                'name' => 'Mind Body Wellness',
                'category' => 'Live Stream',
                'sub_category' => '',
                'image' => 'resources/views/templates/live-stream/mind-body-wellness/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.live-stream.mind-body-wellness.index',
                'tokens' => 5,
            ],
            [
                'id' => 8,
                'name' => 'Science Experiment',
                'category' => 'Live Stream',
                'sub_category' => '',
                'image' => 'resources/views/templates/live-stream/science-experiment/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.live-stream.science-experiment.index',
                'tokens' => 5,
            ],
            [
                'id' => 9,
                'name' => 'Feasting Around The Corner',
                'category' => 'Thanksgiving',
                'sub_category' => '',
                'image' => 'resources/views/templates/thanksgiving/feasting-around-the-corner/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.thanksgiving.feasting-around-the-corner.index',
                'tokens' => 5,
            ],
            [
                'id' => 10,
                'name' => 'Great Escape',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/great-escape/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.great-escape.index',
                'tokens' => 3,
            ],
            [
                'id' => 11,
                'name' => 'Peak Performance',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/peak-performance/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.peak-performance.index',
                'tokens' => 3,
            ],
            [
                'id' => 12,
                'name' => 'Peak Performance V2',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/peak-performance-v2/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.peak-performance-v2.index',
                'tokens' => 3,
            ],
            [
                'id' => 13,
                'name' => 'Journey To Relaxation',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/journey-to-relaxation/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.journey-to-relaxation.index',
                'tokens' => 10,
            ],
            [
                'id' => 14,
                'name' => 'Dream To Reality',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/dream-to-reality/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.dream-to-reality.index',
                'tokens' => 10,
            ],
            [
                'id' => 15,
                'name' => 'Mastery Tracker',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/mastery-tracker/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.mastery-tracker.index',
                'tokens' => 3,
            ],
            [
                'id' => 16,
                'name' => 'Time Keeper',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/time-keeper/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.time-keeper.index',
                'tokens' => 12,
            ],
            [
                'id' => 17,
                'name' => 'Training Regimen',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/training-regimen/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.training-regimen.index',
                'tokens' => 23,
            ],
            [
                'id' => 18,
                'name' => 'Ticking Away',
                'category' => 'New Year',
                'sub_category' => '',
                'image' => 'resources/views/templates/new-year/ticking-away/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.new-year.ticking-away.index',
                'tokens' => 7,
            ],
            [
                'id' => 19,
                'name' => 'Dare To Start',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/dare-to-start/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.dare-to-start.index',
                'tokens' => 7,
            ],
            [
                'id' => 20,
                'name' => 'Embracing Mastery',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/embracing-mastery/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.embracing-mastery.index',
                'tokens' => 7,
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
