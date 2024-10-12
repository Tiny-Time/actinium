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
                "resources/views/templates/beauty/perfect-pout/css/style.css",
                "resources/views/templates/study/focused-learning/css/style.css",
                "resources/views/templates/study/focus-session/css/style.css",
                "resources/views/templates/fitness/boxing-fit/css/style.css",
                "resources/views/templates/meeting/collaboration-gathering/css/style.css",
                "resources/views/templates/sport/smash-it-on-the-court/css/style.css",
                "resources/views/templates/study/academic-excellence/css/style.css",
                "resources/views/templates/sport/time-your-tennis-thrills/css/style.css",
                "resources/views/templates/pets/nutritious-feeding-for-happy-bunnies/css/style.css",
                "resources/views/templates/birthday/get-ready-to-party/css/style.css",
                "resources/views/templates/vacation/coastal-beachfront-paradise/css/style.css",
                "resources/views/templates/meeting/team-huddle/css/style.css",
                "resources/views/templates/study/discover-learn-succeed/css/style.css",
                "resources/views/templates/fitness/sculpt-your-body/css/style.css",
                "resources/views/templates/pets/dogs-having-a-blast/css/style.css",
                "resources/views/templates/birthday/let-s-celebrate/css/style.css",
                "resources/views/templates/beauty/transform-your-hair/css/style.css",
                "resources/views/templates/vacation/nature-s-tranquil-haven/css/style.css",
                "resources/views/templates/study/focused-reading-session/css/style.css",
                "resources/views/templates/sport/ace-your-game/css/style.css",
                "resources/views/templates/pets-birthday/scoot-s-party/css/style.css",
                "resources/views/templates/holiday/go-fly-a-kite/css/style.css",
                "resources/views/templates/fashion/a-fashion-fusion-photoshoot/css/style.css",
                "resources/views/templates/sport/serve-rally-win/css/style.css",
                "resources/views/templates/vacation/blissful-nature-retreat/css/style.css",
                "resources/views/templates/study/boost-your-focus/css/style.css",
                "resources/views/templates/vacation/hit-the-open-road/css/style.css",
                "resources/views/templates/birthday/toast-to-another-year/css/style.css",
                "resources/views/templates/study/learning-together/css/style.css",
                "resources/views/templates/meeting/business-strategy-session/css/style.css",
                "resources/views/templates/fashion/vogue-vista/css/style.css",
                "resources/views/templates/holiday/international-joke-day/css/style.css",
                "resources/views/templates/study/ace-your-exam/css/style.css",
                "resources/views/templates/sport/kick-off-passion/css/style.css",
                "resources/views/templates/holiday/world-humanitarian-day/css/style.css",
                "resources/views/templates/meeting/corporate-alignment-summit/css/style.css",
                "resources/views/templates/pets/purr-fect-relaxation/css/style.css",
                "resources/views/templates/beauty/lip-care/css/style.css",
                "resources/views/templates/birthday/marking-another-year-with-joy/css/style.css",
                "resources/views/templates/fitness/yoga-for-mind-body-and-soul/css/style.css",
                "resources/views/templates/study/illuminate-your-mind/css/style.css",
                "resources/views/templates/sport/pause-the-action-and-recharge/css/style.css",
                "resources/views/templates/holiday/world-peace-day/css/style.css",
                "resources/views/templates/meeting/quarterly-board-meeting/css/style.css",
                "resources/views/templates/fashion/graceful-elegance/css/style.css",
                "resources/views/templates/birthday/a-celebration-of-life/css/style.css",
                "resources/views/templates/fitness/elevate-your-wellness/css/style.css",
                "resources/views/templates/meeting/project-progress-review/css/style.css",
                "resources/views/templates/fashion/shoulder-chic/css/style.css",
                "resources/views/templates/holiday/celebrating-nature-s-treasure/css/style.css",
                "resources/views/templates/pets/play-fetch-by-the-beach/css/style.css",
                "resources/views/templates/fitness/healthier-stronger-and-happier-you/css/style.css",
                "resources/views/templates/study/study-smart-succeed-strong/css/style.css",
                "resources/views/templates/vacation/shoreline-shindig/css/style.css",
                "resources/views/templates/meeting/collaborative-strategy-session/css/style.css",
                "resources/views/templates/birthday/a-whimsical-birthday-soirée/css/style.css",
                "resources/views/templates/ramadan/eid-al-fitr/css/style.css",
                "resources/views/templates/sport/master-the-art/css/style.css",
                "resources/views/templates/beauty/dedicate-time-to-radiant-skin/css/style.css",
                "resources/views/templates/cooking/delightful-culinary-creations/css/style.css",
                "resources/views/templates/fitness/workout-warriors/css/style.css",
                "resources/views/templates/vacation/wanderlust-adventure/css/style.css",
                "resources/views/templates/birthday/emilys-first-birthday-bash/css/style.css",
                "resources/views/templates/vacation/a-picnic-retreat-for-one/css/style.css",
                "resources/views/templates/sport/ride-the-waves/css/style.css",
                "resources/views/templates/pets/stroll-with-your-friend/css/style.css",
                "resources/views/templates/birthday/harmonious-melody-of-joy-and-jubilation/css/style.css",
                "resources/views/templates/fitness/seasoned-gym-goer/css/style.css",
                "resources/views/templates/sport/glide-through-winter/css/style.css",
                "resources/views/templates/beauty/soothing-massage-experience/css/style.css",
                "resources/views/templates/meeting/strategy-alignment-meeting/css/style.css",
                "resources/views/templates/meeting/team-sync-up-meeting/css/style.css",
                "resources/views/templates/sport/the-art-of-archery/css/style.css",
                "resources/views/templates/vacation/coastal-bliss/css/style.css",
                "resources/views/templates/beauty/relaxing-facial-spa/css/style.css",
                "resources/views/templates/birthday/year-ahead/css/style.css",
                "resources/views/templates/fitness/indoor-running/css/style.css",
                "resources/views/templates/meeting/team-collaboration-session/css/style.css",
                "resources/views/templates/holiday/world-laughter-day/css/style.css",
                "resources/views/templates/study/unlocking-deeper-understanding/css/style.css",
                "resources/views/templates/fitness/zen-harmony/css/style.css",
                "resources/views/templates/meeting/virtual-business-conference/css/style.css",
                "resources/views/templates/study/stay-disciplined/css/style.css",
                "resources/views/templates/holiday/world-smile-day/css/style.css",
                "resources/views/templates/vacation/serene-forest-groves/css/style.css",
                "resources/views/templates/study/applauding-their-accomplishments/css/style.css",
                "resources/views/templates/skill/sharpening-craft-your-mastery/css/style.css",
                "resources/views/templates/pets/nap-time/css/style.css",
                "resources/views/templates/holiday/ramadan/css/style.css",
                "resources/views/templates/beauty/radiant-glow/css/style.css",
                "resources/views/templates/pets/walk-your-fury-friends/css/style.css",
                "resources/views/templates/fitness/synced-precision/css/style.css",
                "resources/views/templates/fitness/tempo-tuned/css/style.css",
                "resources/views/templates/fashion/the-big-shoe/css/style.css",
                "resources/views/templates/study/deep-focus/css/style.css",
                "resources/views/templates/fashion/elegance-in-motion/css/style.css",
                "resources/views/templates/live-stream/travel-destination-tour/css/style.css",
                "resources/views/templates/birthday/mark-your-calendar/css/style.css",
                "resources/views/templates/meeting/presentation-meeting/css/style.css",
                "resources/views/templates/vacation/discover-new-horizons/css/style.css",
                "resources/views/templates/pets/fun-day-for-furry-friends/css/style.css",
                "resources/views/templates/fitness/personal-training-session-with-coach/css/style.css",
                "resources/views/templates/pets/family-pet-day-in-nature/css/style.css",
                "resources/views/templates/study/reach-your-goals-with-confidence/css/style.css",
                "resources/views/templates/sport/soccer-showdown/css/style.css",
                "resources/views/templates/live-stream/tech-news/css/style.css",
                "resources/views/templates/birthday/counting-down-to-the-big-day/css/style.css",
                "resources/views/templates/study/focus-session-2/css/style.css",
                "resources/views/templates/sport/swimming-championship/css/style.css",
                "resources/views/templates/fashion/fashion-frenzy/css/style.css",
                "resources/views/templates/vacation/family-adventure/css/style.css",
                "resources/views/templates/fitness/kickstart-your-fitness-journey/css/style.css",
                "resources/views/templates/live-stream/crypto-live-trading/css/style.css",
                "resources/views/templates/live-stream/travel-destination-tours-2/css/style.css",
                "resources/views/templates/live-stream/art-printmaking-3/css/style.css",
                "resources/views/templates/live-stream/gaming-arcade-mario/css/style.css",
                "resources/views/templates/live-stream/healthy-eating/css/style.css",
                "resources/views/templates/live-stream/diy-upcycling/css/style.css",
                "resources/views/templates/live-stream/music-reviews-2/css/style.css",
                "resources/views/templates/live-stream/technology-tech-news/css/style.css",
                "resources/views/templates/live-stream/crypto-analysis/css/style.css",
                "resources/views/templates/live-stream/travel-destination-tour-3/css/style.css",
                "resources/views/templates/live-stream/art-printmaking-2/css/style.css",
                "resources/views/templates/live-stream/music-lessons/css/style.css",
                "resources/views/templates/live-stream/food-challenges/css/style.css",
                "resources/views/templates/live-stream/diy-home-improvements-2/css/style.css",
                "resources/views/templates/live-stream/gaming-arcade/css/style.css",
                "resources/views/templates/live-stream/travel-vlog/css/style.css",
                "resources/views/templates/live-stream/art-painting-art/css/style.css",
                "resources/views/templates/live-stream/food-cookings-live/css/style.css",
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
