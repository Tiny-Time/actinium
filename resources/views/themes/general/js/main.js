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

function updateCountdown(datetime) {
    const targetDate = new Date(datetime).getTime();
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
