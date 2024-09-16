<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Template extends Model
{
    use \Sushi\Sushi;

    public function getRows(): array
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
                'tags' => 'forest, night, anniversary, enchanted, midnight, free, template',
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
                'tags' => 'scarlet, serenity, anniversary, free, template',
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
                'tags' => 'dark, blue, sequins, birthday, free, template',
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
                'tags' => 'punctual, meeting, paid, template',
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
                'tags' => 'time, master, meeting, paid, template',
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
                'tags' => 'shape, future, study, paid, template',
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
                'tags' => 'mind, body, wellness, live, stream, paid, template',
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
                'tags' => 'science, experiment, live, stream, paid, template',
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
                'tags' => 'feasting, around, corner, thanksgiving, paid, template',
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
                'tags' => 'great, escape, vacation, paid, template',
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
                'tags' => 'peak, performance, fitness, paid, template',
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
                'tags' => 'peak, performance, fitness, paid, template',
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
                'tags' => 'journey, relaxation, vacation, paid, template',
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
                'tags' => 'dream, reality, vacation, paid, template',
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
                'tags' => 'mastery, tracker, meeting, paid, template',
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
                'tags' => 'time, keeper, meeting, paid, template',
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
                'tags' => 'training, regimen, fitness, paid, template',
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
                'tags' => 'ticking, away, new, year, paid, template',
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
                'tags' => 'dare, start, study, paid, template',
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
                'tags' => 'embracing, mastery, study, paid, template',
            ],
            [
                'id' => 21,
                'name' => 'Mind Forge',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/mind-forge/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.mind-forge.index',
                'tokens' => 7,
                'tags' => 'mind, forge, study, paid, template',
            ],
            [
                'id' => 22,
                'name' => 'Tailored Fitness Journey',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/tailored-fitness-journey/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.tailored-fitness-journey.index',
                'tokens' => 7,
                'tags' => 'tailored, fitness, journey, paid, template',
            ],
            [
                'id' => 23,
                'name' => 'Momentum Timer',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/momentum-timer/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.momentum-timer.index',
                'tokens' => 23,
                'tags' => 'momentum, timer, meeting, paid, template',
            ],
            [
                'id' => 24,
                'name' => 'Journey To Mastery',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/journey-to-mastery/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.journey-to-mastery.index',
                'tokens' => 14,
                'tags' => 'journey, mastery, study, paid, template',
            ],
            [
                'id' => 25,
                'name' => 'Punctual Progress Timer',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/punctual-progress-timer/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.punctual-progress-timer.index',
                'tokens' => 20,
                'tags' => 'punctual, progress, timer, meeting, paid, template',
            ],
            [
                'id' => 26,
                'name' => 'Sun Kissed Paradise',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/sun-kissed-paradise/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.sun-kissed-paradise.index',
                'tokens' => 17,
                'tags' => 'sun, kissed, paradise, vacation, paid, template',
            ],
            [
                'id' => 27,
                'name' => 'Adventure Escape',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/adventure-escape/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.adventure-escape.index',
                'tokens' => 19,
                'tags' => 'adventure, escape, vacation, paid, template',
            ],
            [
                'id' => 28,
                'name' => 'Quest For Knowledge',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/quest-for-knowledge/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.quest-for-knowledge.index',
                'tokens' => 8,
                'tags' => 'quest, knowledge, study, paid, template',
            ],
            [
                'id' => 29,
                'name' => 'Tranquil',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/tranquil/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.tranquil.index',
                'tokens' => 7,
                'tags' => 'tranquil, vacation, paid, template',
            ],
            [
                'id' => 30,
                'name' => 'Step by Step',
                'category' => 'Walk',
                'sub_category' => '',
                'image' => 'resources/views/templates/walk/step-by-step/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.walk.step-by-step.index',
                'tokens' => 7,
                'tags' => 'step, walk, paid, template',
            ],
            [
                'id' => 31,
                'name' => 'Watering Effortless',
                'category' => 'Plant',
                'sub_category' => '',
                'image' => 'resources/views/templates/plant/watering-effortless/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.plant.watering-effortless.index',
                'tokens' => 7,
                'tags' => 'watering, effortless, plant, paid, template',
            ],
            [
                'id' => 32,
                'name' => 'Ticking Time',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => 'resources/views/templates/birthday/ticking-time/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.birthday.ticking-time.index',
                'tokens' => 7,
                'tags' => 'ticking, time, birthday, paid, template',
            ],
            [
                'id' => 33,
                'name' => 'Santa\'s Spectacle',
                'category' => 'Christmas',
                'sub_category' => '',
                'image' => 'resources/views/templates/christmas/santa-s-spectacle/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.christmas.santa-s-spectacle.index',
                'tokens' => 7,
                'tags' => 'santa, spectacle, christmas, paid, template',
            ],
            [
                'id' => 34,
                'name' => 'Building Excitement',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => 'resources/views/templates/birthday/building-excitement/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.birthday.building-excitement.index',
                'tokens' => 7,
                'tags' => 'building, excitement, birthday, paid, template',
            ],
            [
                'id' => 35,
                'name' => 'Limitless Learning',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/limitless-learning/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.limitless-learning.index',
                'tokens' => 7,
                'tags' => 'limitless, learning, study, paid, template',
            ],
            [
                'id' => 36,
                'name' => 'Elevate Your Sweat Sessions',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/elevate-your-sweat-sessions/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.elevate-your-sweat-sessions.index',
                'tokens' => 7,
                'tags' => 'elevate, sweat, sessions, fitness, paid, template',
            ],
            [
                'id' => 37,
                'name' => 'Explosive Joy',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => 'resources/views/templates/birthday/explosive-joy/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.birthday.explosive-joy.index',
                'tokens' => 7,
                'tags' => 'explosive, joy, birthday, paid, template',
            ],
            [
                'id' => 38,
                'name' => 'Hyped Celebration',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => 'resources/views/templates/birthday/hyped-celebration/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.birthday.hyped-celebration.index',
                'tokens' => 8,
                'tags' => 'hyped, celebration, birthday, paid, template',
            ],
            [
                'id' => 39,
                'name' => 'Dream Gateway',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/dream-gateway/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.dream-gateway.index',
                'tokens' => 7,
                'tags' => 'dream, gateway, vacation, paid, template',
            ],
            [
                'id' => 40,
                'name' => 'Stay on Track',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/stay-on-track/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.stay-on-track.index',
                'tokens' => 3,
                'tags' => 'stay, track, meeting, paid, template',
            ],
            [
                'id' => 41,
                'name' => 'TimeSync',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/time-sync/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.time-sync.index',
                'tokens' => 9,
                'tags' => 'time, sync, meeting, paid, template',
            ],
            [
                'id' => 42,
                'name' => 'Laughter Surprises Pure Joy',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => 'resources/views/templates/birthday/laughter-surprises-pure-joy/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.birthday.laughter-surprises-pure-joy.index',
                'tokens' => 21,
                'tags' => 'laughter, surprises, pure, joy, birthday, paid, template',
            ],
            [
                'id' => 43,
                'name' => 'Focus Booster',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/focus-booster/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.focus-booster.index',
                'tokens' => 6,
                'tags' => 'focus, booster, study, paid, template',
            ],
            [
                'id' => 44,
                'name' => 'Dream Gateway v2',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/dream-gateway-v2/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.dream-gateway-v2.index',
                'tokens' => 7,
                'tags' => 'dream, gateway, vacation, paid, template',
            ],
            [
                'id' => 45,
                'name' => 'Optimal Workout',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/optimal-workout/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.optimal-workout.index',
                'tokens' => 7,
                'tags' => 'optimal, workout, fitness, paid, template',
            ],
            [
                'id' => 46,
                'name' => 'Redefined Fitness Journey',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/redefined-fitness-journey/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.redefined-fitness-journey.index',
                'tokens' => 10,
                'tags' => 'redefined, fitness, journey, paid, template',
            ],
            [
                'id' => 47,
                'name' => 'Meeting Time keeper',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/meeting-time-keeper/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.meeting-time-keeper.index',
                'tokens' => 19,
                'tags' => 'meeting, time, keeper, paid, template',
            ],
            [
                'id' => 48,
                'name' => 'Meeting Time Matters',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/meeting-time-matters/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.meeting-time-matters.index',
                'tokens' => 6,
                'tags' => 'meeting, time, matters, paid, template',
            ],
            [
                'id' => 49,
                'name' => 'Stay Focus',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/stay-focus/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.stay-focus.index',
                'tokens' => 7,
                'tags' => 'stay, focus, study, paid, template',
            ],
            [
                'id' => 50,
                'name' => 'Mind Sync',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/mind-sync/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.mind-sync.index',
                'tokens' => 14,
                'tags' => 'mind, sync, study, paid, template',
            ],
            [
                'id' => 51,
                'name' => 'Blissful Escape',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/blissful-escape/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.blissful-escape.index',
                'tokens' => 7,
                'tags' => 'blissful, escape, vacation, paid, template',
            ],
            [
                'id' => 52,
                'name' => 'Sync Clockwork',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/sync-clockwork/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.sync-clockwork.index',
                'tokens' => 14,
                'tags' => 'sync, clockwork, fitness, paid, template',
            ],
            [
                'id' => 53,
                'name' => 'Personal Tempo',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/personal-tempo/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.personal-tempo.index',
                'tokens' => 20,
                'tags' => 'personal, tempo, fitness, paid, template',
            ],
            [
                'id' => 54,
                'name' => 'Tick Bash',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => 'resources/views/templates/birthday/tick-bash/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.birthday.tick-bash.index',
                'tokens' => 13,
                'tags' => 'tick, bash, birthday, paid, template',
            ],
            [
                'id' => 55,
                'name' => 'Blissful Thrill',
                'category' => 'Birthday',
                'sub_category' => '',
                'image' => 'resources/views/templates/birthday/blissful-thrill/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.birthday.blissful-thrill.index',
                'tokens' => 7,
                'tags' => 'blissful, thrill, birthday, paid, template',
            ],
            [
                'id' => 56,
                'name' => 'Closer to Paradise',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/closer-to-paradise/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.closer-to-paradise.index',
                'tokens' => 9,
                'tags' => 'closer, paradise, vacation, paid, template',
            ],
            [
                'id' => 57,
                'name' => 'Paradise Gateway',
                'category' => 'Vacation',
                'sub_category' => '',
                'image' => 'resources/views/templates/vacation/paradise-gateway/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.vacation.paradise-gateway.index',
                'tokens' => 10,
                'tags' => 'paradise, gateway, vacation, paid, template',
            ],
            [
                'id' => 58,
                'name' => 'Achieving Peak Performance',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/achieving-peak-performance/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.achieving-peak-performance.index',
                'tokens' => 19,
                'tags' => 'achieving, peak, performance, fitness, paid, template',
            ],
            [
                'id' => 59,
                'name' => 'Enchanted Season',
                'category' => 'Christmas',
                'sub_category' => '',
                'image' => 'resources/views/templates/christmas/enchanted-season/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.christmas.enchanted-season.index',
                'tokens' => 10,
                'tags' => 'enchanted, season, christmas, paid, template',
            ],
            [
                'id' => 60,
                'name' => 'New Beginning',
                'category' => 'New Year',
                'sub_category' => '',
                'image' => 'resources/views/templates/new-year/new-beginning/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.new-year.new-beginning.index',
                'tokens' => 10,
                'tags' => 'new, beginning, new, year, paid, template',
            ],
            [
                'id' => 61,
                'name' => 'Enhancing Mindfulness',
                'category' => 'Meditation',
                'sub_category' => '',
                'image' => 'resources/views/templates/meditation/enhancing-mindfulness/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meditation.enhancing-mindfulness.index',
                'tokens' => 10,
                'tags' => 'enhancing, enhancement, mindfulness, meditation, paid, template',
            ],
            [
                'id' => 62,
                'name' => 'Harmony And Well Being',
                'category' => 'Self Care',
                'sub_category' => '',
                'image' => 'resources/views/templates/self-care/harmony-and-well-being/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.self-care.harmony-and-well-being.index',
                'tokens' => 10,
                'tags' => 'harmony, well, being, self, care, paid, template',
            ],
            [
                'id' => 63,
                'name' => 'Project Ideation',
                'category' => 'Brainstorm',
                'sub_category' => '',
                'image' => 'resources/views/templates/brainstorm/project-ideation/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.brainstorm.project-ideation.index',
                'tokens' => 10,
                'tags' => 'project, ideation, brainstorm, paid, template',
            ],
            [
                'id' => 64,
                'name' => 'Managing Time',
                'category' => 'Cleaning',
                'sub_category' => '',
                'image' => 'resources/views/templates/cleaning/managing-time/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.cleaning.managing-time.index',
                'tokens' => 7,
                'tags' => 'managing, manage, time, cleaning, paid, template',
            ],
            [
                'id' => 65,
                'name' => 'Conquer Every Level',
                'category' => 'Gaming',
                'sub_category' => '',
                'image' => 'resources/views/templates/gaming/conquer-every-level/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.gaming.conquer-every-level.index',
                'tokens' => 10,
                'tags' => 'conquer, every, level, gaming, paid, template',
            ],
            [
                'id' => 66,
                'name' => 'Simplify Your Meeting',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/simplify-your-meeting/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.simplify-your-meeting.index',
                'tokens' => 20,
                'tags' => 'simplify, meeting, paid, template',
            ],
            [
                'id' => 67,
                'name' => 'Keep Everyone On Track',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/keep-everyone-on-track/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.keep-everyone-on-track.index',
                'tokens' => 20,
                'tags' => 'keep, everyone, track, meeting, paid, template',
            ],
            [
                'id' => 68,
                'name' => 'Improve Your Swimming Skills',
                'category' => 'Sport',
                'sub_category' => '',
                'image' => 'resources/views/templates/sport/improve-your-swimming-skills/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.sport.improve-your-swimming-skills.index',
                'tokens' => 20,
                'tags' => 'improve, swimming, skills, sport, paid, template',
            ],
            [
                'id' => 69,
                'name' => 'Celebrate Love',
                'category' => 'Holiday',
                'sub_category' => '',
                'image' => 'resources/views/templates/holiday/celebrate-love/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.holiday.celebrate-love.index',
                'tokens' => 10,
                'tags' => 'celebrate, love, holiday, paid, template',
            ],
            [
                'id' => 70,
                'name' => 'Revitalize Your Skin',
                'category' => 'Beauty',
                'sub_category' => '',
                'image' => 'resources/views/templates/beauty/revitalize-your-skin/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.beauty.revitalize-your-skin.index',
                'tokens' => 10,
                'tags' => 'revitalize, skin, beauty, paid, template',
            ],
            [
                'id' => 71,
                'name' => 'Table Of Innovation',
                'category' => 'Meeting',
                'sub_category' => '',
                'image' => 'resources/views/templates/meeting/table-of-innovation/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.meeting.table-of-innovation.index',
                'tokens' => 7,
                'tags' => 'table, innovation, meeting, paid, template',
            ],
            [
                'id' => 72,
                'name' => 'Intensive Study Dive',
                'category' => 'Study',
                'sub_category' => '',
                'image' => 'resources/views/templates/study/intensive-study-dive/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.study.intensive-study-dive.index',
                'tokens' => 7,
                'tags' => 'intensive, study, dive, paid, template',
            ],
            [
                'id' => 73,
                'name' => 'Embracing Healthier Lifestyles',
                'category' => 'Fitness',
                'sub_category' => '',
                'image' => 'resources/views/templates/fitness/embracing-healthier-lifestyles/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.fitness.embracing-healthier-lifestyles.index',
                'tokens' => 14,
                'tags' => 'embracing, healthier, lifestyles, fitness, paid, template',
            ],
            [
                'id' => 74,
                'name' => 'Organize Your Haircare Routine',
                'category' => 'Beauty',
                'sub_category' => '',
                'image' => 'resources/views/templates/beauty/organize-your-haircare-routine/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.beauty.organize-your-haircare-routine.index',
                'tokens' => 18,
                'tags' => 'organize, haircare, routine, beauty, paid, template',
            ],
            [
                'id' => 75,
                'name' => 'Refine Your Swing',
                'category' => 'Sport',
                'sub_category' => '',
                'image' => 'resources/views/templates/sport/refine-your-swing/images/preview.webp',
                'type' => 'paid',
                'path' => 'templates.sport.refine-your-swing.index',
                'tokens' => 10,
                'tags' => 'refine, swing, sport, paid, template',
            ],
        ];
    }

    protected function sushiShouldCache(): bool
    {
        return true;
    }

    protected function afterMigrate(Blueprint $table): void
    {
        $table->index(columns: 'id');
    }

    public function event(): HasMany
    {
        return $this->hasMany(related: Event::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(related: Event::class);
    }
}
