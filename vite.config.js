import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/custom.css",
                "resources/js/app.js",
                "resources/js/embed.js",
                "resources/js/main.js",
                "resources/js/clipboard.js",
                "resources/views/templates/general/js/subscribe.js",
                "resources/views/templates/general/js/main.js",
                "resources/views/templates/anniversary/enchanted-midnight-forest/css/style.css",
                "resources/views/templates/anniversary/scarlet-serenity/css/style.css",
                "resources/views/templates/birthday/dark-blue-sequins/css/style.css",
                "resources/views/templates/meeting/punctual-meeting/css/style.css",
                "resources/views/templates/meeting/time-master/css/style.css",
                "resources/views/templates/study/shape-the-future/css/style.css",
                "resources/views/templates/live-stream/mind-body-wellness/css/style.css",
                "resources/views/templates/live-stream/science-experiment/css/style.css",
                "resources/views/templates/thanksgiving/feasting-around-the-corner/css/style.css",
                "resources/views/templates/vacation/great-escape/css/style.css",
                "resources/views/templates/fitness/peak-performance/css/style.css",
                "resources/views/templates/fitness/peak-performance-v2/css/style.css",
                "resources/views/templates/vacation/journey-to-relaxation/css/style.css",
                "resources/views/templates/vacation/dream-to-reality/css/style.css",
                "resources/views/templates/meeting/mastery-tracker/css/style.css",
                "resources/views/templates/meeting/time-keeper/css/style.css",
                "resources/views/templates/fitness/training-regimen/css/style.css",
                "resources/views/templates/new-year/ticking-away/css/style.css",
                "resources/views/templates/study/dare-to-start/css/style.css",
                "resources/views/templates/study/embracing-mastery/css/style.css",
                "resources/views/templates/study/mind-forge/css/style.css",
                "resources/views/templates/fitness/tailored-fitness-journey/css/style.css",
                "resources/views/templates/meeting/momentum-timer/css/style.css",
                "resources/views/templates/study/journey-to-mastery/css/style.css",
                "resources/views/templates/meeting/punctual-progress-timer/css/style.css",
                "resources/views/templates/vacation/sun-kissed-paradise/css/style.css",
                "resources/views/templates/vacation/adventure-escape/css/style.css",
                "resources/views/templates/study/quest-for-knowledge/css/style.css",
                "resources/views/templates/vacation/tranquil/css/style.css",
                "resources/views/templates/walk/step-by-step/css/style.css",
                "resources/views/templates/plant/watering-effortless/css/style.css",
                "resources/views/templates/birthday/ticking-time/css/style.css",
                "resources/views/templates/christmas/santa-s-spectacle/css/style.css",
                "resources/views/templates/birthday/building-excitement/css/style.css",
                "resources/views/templates/study/limitless-learning/css/style.css",
                "resources/views/templates/fitness/elevate-your-sweat-sessions/css/style.css",
                "resources/views/templates/birthday/explosive-joy/css/style.css",
                "resources/views/templates/birthday/hyped-celebration/css/style.css",
                "resources/views/templates/vacation/dream-gateway/css/style.css",
                "resources/views/templates/meeting/stay-on-track/css/style.css",
                "resources/views/templates/meeting/time-sync/css/style.css",
                "resources/views/templates/birthday/laughter-surprises-pure-joy/css/style.css",
                "resources/views/templates/study/focus-booster/css/style.css",
                "resources/views/templates/vacation/dream-gateway-v2/css/style.css",
                "resources/views/templates/fitness/optimal-workout/css/style.css",
                "resources/views/templates/fitness/redefined-fitness-journey/css/style.css",
                "resources/views/templates/meeting/meeting-time-keeper/css/style.css",
                "resources/views/templates/meeting/meeting-time-matters/css/style.css",
                "resources/views/templates/study/stay-focus/css/style.css",
                "resources/views/templates/study/mind-sync/css/style.css",
                "resources/views/templates/vacation/blissful-escape/css/style.css",
                "resources/views/templates/fitness/sync-clockwork/css/style.css",
                "resources/views/templates/fitness/personal-tempo/css/style.css",
                "resources/views/templates/birthday/tick-bash/css/style.css",
                "resources/views/templates/birthday/blissful-thrill/css/style.css",
                "resources/views/templates/vacation/closer-to-paradise/css/style.css",
                "resources/views/templates/vacation/paradise-gateway/css/style.css",
                "resources/views/templates/fitness/achieving-peak-performance/css/style.css",
                "resources/views/templates/christmas/enchanted-season/css/style.css",
                "resources/views/templates/new-year/new-beginning/css/style.css",
                "resources/views/templates/meditation/enhancing-mindfulness/css/style.css",
                "resources/views/templates/self-care/harmony-and-well-being/css/style.css",
                "resources/views/templates/brainstorm/project-ideation/css/style.css",
                "resources/views/templates/cleaning/managing-time/css/style.css",
                "resources/views/templates/gaming/conquer-every-level/css/style.css",
                "resources/views/templates/meeting/simplify-your-meeting/css/style.css",
                "resources/views/templates/meeting/keep-everyone-on-track/css/style.css",
                "resources/views/templates/sport/improve-your-swimming-skills/css/style.css",
                "resources/views/templates/holiday/celebrate-love/css/style.css",
                "resources/views/templates/meeting/table-of-innovation/css/style.css",
                "resources/views/templates/study/intensive-study-dive/css/style.css",
                "resources/views/templates/fitness/embracing-healthier-lifestyles/css/style.css",
                "resources/views/templates/beauty/organize-your-haircare-routine/css/style.css",
                "resources/views/templates/sport/refine-your-swing/css/style.css",
                "resources/views/templates/birthday/embrace-the-day/css/style.css",
                "resources/views/templates/vacation/an-unforgettable-journey/css/style.css",
                "resources/views/templates/vacation/generations-united/css/style.css",
                "resources/views/templates/fitness/dance-practice/css/style.css",
                "resources/views/templates/meeting/charting-the-course-for-success/css/style.css",
                "resources/views/templates/pets/playing-fetch/css/style.css",
                "resources/views/templates/holiday/international-women-s-day/css/style.css",
                "resources/views/templates/study/intensive-study-session/css/style.css",
                "resources/views/templates/fitness/transformative-journey/css/style.css",
                "resources/views/templates/meeting/fresh-perspectives/css/style.css",
                "resources/views/templates/pets/never-keep-paws-waiting/css/style.css",
                "resources/views/templates/fashion/your-time-your-style/css/style.css",
                "resources/views/templates/birthday/another-trip-around-the-sun/css/style.css",
                "resources/views/templates/fitness/embrace-the-challenge/css/style.css",
                "resources/views/templates/meeting/techtalk-summer/css/style.css",
                "resources/views/templates/sport/basketball/css/style.css",
                "resources/views/templates/study/master-your-studies/css/style.css",
                "resources/views/templates/study/manage-your-study-time/css/style.css",
                "resources/views/templates/birthday/let-the-celebration-begin/css/style.css",
                "resources/views/templates/fashion/timeless-grace-personified/css/style.css",
                "resources/views/templates/vacation/picnic-paradise-retreat/css/style.css",
                "resources/views/templates/animals/holiday-international-tiger-day/css/style.css",
                "resources/views/templates/fitness/power-packed-workout/css/style.css",
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
