const e = {
    timerInterval: null,
    counterInterval: null,

    // Start Event Timer or Counter.
    startEvent() {
        // Get all the form values.
        const ct_title = $("#ct_title").val();
        const ct_date = $("#ct_date").val();
        const ct_hour = $("#ct_hour").val();
        const ct_min = $("#ct_min").val();
        const ct_sec = $("#ct_sec").val();
        const ct_type = $("#ct_type").val();
        const autostart = $("#autostart").is(":checked");

        // Get the current date
        const currentDate = new Date();

        // Get the event date
        const eventDate = new Date(ct_date);

        // Calculate the time difference in milliseconds
        const timeDifference = eventDate - currentDate;

        // Convert the time difference to days
        const ct_day = Math.floor(timeDifference / (1000 * 60 * 60 * 24)) + 1;

        // Set the event value.
        $(".eventTitle").text(ct_title);
        $(".days").text(ct_day);
        $(".hours").text(ct_hour);
        $(".mins").text(ct_min);
        $(".secs").text(ct_sec);

        // Close modal
        const alpineInstance = Alpine;
        if (alpineInstance) {
            Alpine.store("openCreateTimerModal").toggle();
        }

        // Start the event timer or counter.
        let d = parseInt(ct_day, 10);
        let h = parseInt(ct_hour, 10);
        let m = parseInt(ct_min, 10);
        let s = parseInt(ct_sec, 10);

        clearInterval(e.timerInterval);
        clearInterval(e.counterInterval);

        if (ct_type == "timer") {
            autostart ? e.startTimer(d, h, m, s) : e.setVal(d, h, m, s);
            Alpine.store("counter").on = false;
        } else {
            autostart ? e.startCounter(d, h, m, s) : e.setVal(d, h, m, s);
            Alpine.store("counter").on = true;
        }

        if (autostart) {
            Alpine.store("playBtn").on = false;
        } else {
            Alpine.store("playBtn").on = true;
        }
    },
    startTimer(d, h, m, s) {
        let totalSeconds = d * 86400 + h * 3600 + m * 60 + s;

        function updateTimer() {
            if (totalSeconds < 0) {
                clearInterval(e.timerInterval);
                playAudio();
                Alpine.store("playBtn").on = true;
            } else {
                const days = Math.floor(totalSeconds / 86400);
                const hours = Math.floor((totalSeconds % 86400) / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;
                totalSeconds--;

                e.setVal(days, hours, minutes, seconds);

                e.setTitle(days, hours, minutes, seconds);
            }
        }

        updateTimer();

        e.timerInterval = setInterval(updateTimer, 1000);
    },
    startCounter(d, h, m, s) {
        let totalSeconds = 0;
        const targetSeconds = d * 86400 + h * 3600 + m * 60 + s;

        function updateCounter() {
            if (totalSeconds > targetSeconds) {
                clearInterval(e.counterInterval);
                playAudio();
                Alpine.store("playBtn").on = true;
            } else {
                const days = Math.floor(totalSeconds / 86400);
                const hours = Math.floor((totalSeconds % 86400) / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                e.setVal(days, hours, minutes, seconds);

                e.setTitle(days, hours, minutes, seconds);

                totalSeconds++;
            }
        }

        updateCounter();

        e.counterInterval = setInterval(updateCounter, 1000);
    },
    setVal(d, h, m, s) {
        $(".days").text(d);
        $(".hours").text(h);
        $(".mins").text(m);
        $(".secs").text(s);
    },
    play(mobile = false) {
        if (mobile) {
            var d = parseInt($("#mDays").text(), 10);
            var h = parseInt($("#mHours").text(), 10);
            var m = parseInt($("#mMins").text(), 10);
            var s = parseInt($("#mSecs").text(), 10);
        } else {
            var d = parseInt($("#days").text(), 10);
            var h = parseInt($("#hours").text(), 10);
            var m = parseInt($("#mins").text(), 10);
            var s = parseInt($("#secs").text(), 10);
        }

        const alpineInstance = Alpine;
        if (alpineInstance) {
            const counter = Alpine.store("counter").on;

            if (counter) {
                e.startCounter(d, h, m, s);
            } else {
                e.startTimer(d, h, m, s);
            }
        }
    },
    pause() {
        clearInterval(e.counterInterval);
        clearInterval(e.timerInterval);
    },
    reset() {
        e.pause();
        e.setVal(0, 0, 5, 0);
    },
    setTitle(days, hours, minutes, seconds) {
        if (days > 0) {
            document.title = `${days} : ${hours} : ${minutes} : ${seconds} - TinyTime`;
        } else if (hours > 0) {
            document.title = `${hours} : ${minutes} : ${seconds} - TinyTime`;
        } else {
            document.title = `${minutes} : ${seconds} - TinyTime`;
        }
    },
};

export default e;
