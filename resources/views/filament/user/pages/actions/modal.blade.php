@script
    <script>
        $wire.on('update-url', (event) => {
            // Get all the href attributes of the social icons
            var socialIcons = document.querySelectorAll('#cseShareFacebook, #cseShareTelegram, #cseShareXTwitter, #cseShareWhatsApp, #cseShareEmail, #csePreview');
            // Get the event
            var event = event[0].event;
            // Loop through the social icons
            socialIcons.forEach(function (icon) {
                // Get the href attribute of the social icon
                var href = icon.getAttribute('href');
                // Replace the URL with the new URL
                icon.setAttribute('href', href.replace(/\/event\/([^\/]+)/, '/event/' + event.event_id));
            });
            // Get the URL input
            var urlInput = document.getElementById('shareUrl');
            // Replace the URL with the new URL
            urlInput.value = urlInput.value.replace(/\/event\/([^\/]+)/, '/event/' + event.event_id);
        });
    </script>
@endscript
