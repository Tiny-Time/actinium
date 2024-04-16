function calculateTimeRemaining(targetDate) {
    const now = new Date().getTime();
    const timeRemaining = targetDate - now;

    if (timeRemaining <= 0) {
        var audio = new Audio("/audio/alarm.mp3");
        audio.play();
        clearInterval(timerInterval);
        return { days: 0, hours: 0, minutes: 0, seconds: 0 };
    }

    const seconds = Math.floor((timeRemaining / 1000) % 60);
    const minutes = Math.floor((timeRemaining / 1000 / 60) % 60);
    const hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24);
    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));

    return { days, hours, minutes, seconds };
}

function userTimezone() {
    const offset = new Date().getTimezoneOffset() / 60;
    const sign = offset < 0 ? "+" : "-";
    const absOffset = Math.abs(offset);

    const userTimeZone = `UTC${sign}${absOffset}`;

    return userTimeZone;
}

function updateCountdown(datetime, timezone) {

    const localOffset = new Date().getTimezoneOffset(); // Get the local timezone offset in minutes

    let targetDate = new Date(datetime);
    const tzNow = userTimezone();
    // Extract the offset value from the timezone parameter
    const offsetMatch = timezone.match(/UTC([+-]\d+)/i);
    let offsetHours = 0;
    if (offsetMatch) {
        offsetHours = parseInt(offsetMatch[1]);
    }
    
    // Extract the offset value from the timezone parameter
    const offsetMatchLocal = tzNow.match(/UTC([+-]\d+)/i);
    let offsetHoursLocal = 0;
    if (offsetMatchLocal) {
        offsetHoursLocal = parseInt(offsetMatchLocal[1]);
    }

    if(tzNow != timezone) {
        // Use the timezone that was used to create the timer for countdown
        targetDate = new Date(targetDate.getTime() + (-1 * offsetHours + offsetHoursLocal) * 60 * 60 * 1000)
    }

    const countdown = calculateTimeRemaining(targetDate);

    // Calculate the dynamic stroke length based on the screen width
    const screenWidth = window.innerWidth;
    const dynamicStrokeLength = screenWidth <= 767 ? 377 : 468;

    // Event component stroke control
    // Control For seconds
    const tozES = document.getElementById("toz-es");
    if (tozES) {
        tozES.style.strokeDashoffset =
            dynamicStrokeLength -
            (dynamicStrokeLength * countdown.seconds) / 60;
    }
    // Control For minutes
    const toMins = document.getElementById("toz-mn");
    if (toMins) {
        toMins.style.strokeDashoffset =
            dynamicStrokeLength -
            (dynamicStrokeLength * countdown.minutes) / 60;
    }
    // Control For hours
    const toHours = document.getElementById("toz-hr");
    if (toHours) {
        toHours.style.strokeDashoffset =
            dynamicStrokeLength - (dynamicStrokeLength * countdown.hours) / 24;
    }
    // Control For days
    const toDays = document.getElementById("toz-day");
    if (toDays) {
        toDays.style.strokeDashoffset =
            dynamicStrokeLength - (dynamicStrokeLength * countdown.days) / 365;
    }
    /* Main Countdown */
    // Days
    const tozDays = document.getElementById("toz-days");
    if (tozDays) {
        tozDays.innerText = countdown.days;
    }
    // Hours
    const tozHours = document.getElementById("toz-hours");
    if (tozHours) {
        tozHours.innerText = countdown.hours;
    }
    // Minutes
    const tozMins = document.getElementById("toz-mins");
    if (tozMins) {
        tozMins.innerText = countdown.minutes;
    }
    // Seconds
    const tozSecs = document.getElementById("toz-secs");
    if (tozSecs) {
        tozSecs.innerText = countdown.seconds;
    }
}

window.uC = updateCountdown;
