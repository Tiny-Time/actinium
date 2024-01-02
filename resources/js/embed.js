import { DateTime, Settings } from "luxon";


function updateCountdown(target) {
    // Set the target UTC date and time
    const targetDateTime = DateTime.fromISO(target, { zone: "UTC" });
    console.log(target)
    // Get the current UTC date and time
    const currentDateTime = DateTime.utc();

    // Calculate the difference between target and current time
    const timeDiff = targetDateTime.diff(currentDateTime, ['days', 'hours', 'minutes', 'seconds']);

    // Get the components of the time difference
    const event = timeDiff.values ? timeDiff.values : { days: 0, hours: 0, minutes: 0, seconds: 0 }

    const { days, hours, minutes, seconds } = event;

    // Return an object with days, hours, minutes, and seconds
    return { days, hours, minutes, seconds: parseInt(seconds) };
}

window.updateCountdown = updateCountdown;

// function eventTimer(targetTime) {
//     // Parse the target time and set the timezone to UTC
//     const targetDateTime = DateTime.fromISO(targetTime, { zone: "utc" });

//     // Get the current UTC time
//     const currentDateTime = DateTime.utc();

//     // Calculate the difference between the current time and the target time
//     const diff = targetDateTime.diff(currentDateTime);

//     // Extract the remaining hours, minutes, and seconds
//     const { hours, minutes, seconds } = diff.shiftTo(
//         "hours",
//         "minutes",
//         "seconds"
//     );

//     // Return the countdown object
//     return {
//         hours: hours,
//         minutes: minutes,
//         seconds: seconds,
//     };
// }

// window.eventTimer = eventTimer;

// function calculateTimeRemaining(targetDate) {
//     const now = new Date().getTime();
//     const timeRemaining = targetDate - now;

//     if (timeRemaining <= 0) {
//         return { days: 0, hours: 0, minutes: 0, seconds: 0 };
//     }

//     const seconds = Math.floor((timeRemaining / 1000) % 60);
//     const minutes = Math.floor((timeRemaining / 1000 / 60) % 60);
//     const hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24);
//     const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));

//     return { days, hours, minutes, seconds };
// }

// function updateCountdown(target) {
//     const targetDate = new DateTime(target).getTime();
//     const countdown = calculateTimeRemaining(targetDate);

//     /* Event component stroke control */

//     // Control For seconds
//     const tozES = document.getElementById("toz-es");
//     if (tozES) {
//         tozES.style.strokeDashoffset = 471 - (471 * countdown.seconds) / 60;
//     }
//     // Control For minutes
//     const toMins = document.getElementById("toz-mn");
//     if (toMins) {
//         toMins.style.strokeDashoffset = 471 - (471 * countdown.minutes) / 60;
//     }
//     // Control For hours
//     const toHours = document.getElementById("toz-hr");
//     if (toHours) {
//         toHours.style.strokeDashoffset = 471 - (471 * countdown.hours) / 24;
//     }
//     // Control For days
//     const toDays = document.getElementById("toz-day");
//     if (toDays) {
//         toDays.style.strokeDashoffset = 471 - (471 * countdown.days) / 365;
//     }
//     /* Main Countdown */
//     // Days
//     const tozDays = document.getElementById("toz-days");
//     if (tozDays) {
//         tozDays.innerText = countdown.days;
//     }
//     // Hours
//     const tozHours = document.getElementById("toz-hours");
//     if (tozHours) {
//         tozHours.innerText = countdown.hours;
//     }
//     // Minutes
//     const tozMins = document.getElementById("toz-mins");
//     if (tozMins) {
//         tozMins.innerText = countdown.minutes;
//     }
//     // Seconds
//     const tozSecs = document.getElementById("toz-secs");
//     if (tozSecs) {
//         tozSecs.innerText = countdown.seconds;
//     }

//     console.log(countdown);
// }

// window.updateCountdown = updateCountdown;
