document.addEventListener('DOMContentLoaded', () => {
    // Retrieve the domain from the meta tag
    const appDomain = document.querySelector('meta[name="app-domain"]').getAttribute('content');

    // Function to get cookie value
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return decodeURIComponent(parts.pop().split(';').shift());
    }

    // Check if eventData exists in cookies
    const storedEventData = getCookie("eventData");

    if (storedEventData) {
        // Parse the stored event data
        const eventData = JSON.parse(storedEventData);

        // Submit the event data using AJAX
        $.ajax({
            type: "POST",
            url: "/event/create-shareable-event",
            data: eventData,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // Use the domain from the environment to delete the cookie
                document.cookie = `eventData=; path=/; domain=${appDomain}; expires=Thu, 01 Jan 1970 00:00:00 UTC;`;
            },
            error: function (error) {
                console.error("Error creating event:", error);
            }
        });
    }
});
