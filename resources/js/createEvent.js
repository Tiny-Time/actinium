document.addEventListener('DOMContentLoaded', (event) => {
    // Check if eventData exists in localStorage
    const storedEventData = localStorage.getItem("eventData");

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
                // Remove the eventData from localStorage after successful submission
                localStorage.removeItem("eventData");
            },
            error: function (error) {
                console.error("Error creating event:", error);
            }
        });
    }
});
