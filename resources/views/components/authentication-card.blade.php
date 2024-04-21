<div class="flex flex-col items-center justify-center min-h-screen">
    <div class="">
        {{ $logo }}
    </div>

    <div class="w-full px-6 mt-5 flex flex-col-reverse md:flex-row items-center gap-4">
        <div class="w-full">
            <div class="max-w-sm mx-auto">
                <h1 class="text-2xl font-bold text-center">{{ $title }}</h1>
                {{ $slot }}
            </div>
        </div>

        <div class="font-medium w-full flex flex-col gap-3 text-sm">
            <p>🌟 Unlock Over 800+ Templates - Dive into a vast collection of design options for every occasion!</p>

            <p>📅 Auto-Save Events - Your events are automatically saved to your profile for quick and easy access.</p>

            <p>👀 RSVP Monitoring - See who's coming to your events with real-time RSVP updates.</p>

            <p>💬 Manage Guest Interactions - View and delete guest comments and feedback seamlessly.</p>

            <p>🔗 Custom Short URLs - Create personalized short URLs for your events to make sharing simpler.</p>

            <p>📊 Advanced Tracking - Monitor the performance of your custom URLs with comprehensive tracking
                capabilities.</p>

            <p>📈 Detailed Event Reports - Get full insights on your events with reports on views, clicks, and sources
                analytics.</p>

            <p>🎟️ RSVP to Events Effortlessly - Automatically save events you have RSVPed to for future reference.</p>

            <p>🎉 All for FREE - Enjoy all these amazing features at no cost! Join us today and elevate your event
                planning!</p>
        </div>
    </div>
</div>
