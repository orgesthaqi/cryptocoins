function updateCountdown() {
    var now = new Date();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    var nextTenMinute = Math.ceil(minutes / 10) * 10; // Calculate the next 10-minute mark

    var remainingMinutes;
    if (minutes === 0 && remainingSeconds === 60) {
        remainingMinutes = 9; // When minutes is 0, set remaining minutes to 10
    } else {
        remainingMinutes = nextTenMinute - minutes;
    }

    var remainingSeconds = 60 - seconds;

    if (remainingSeconds === 60) {
        remainingSeconds = 59; // Reset seconds when it reaches 60
    }

    // Format the time
    var countdownText = "Next update: " + remainingMinutes + "m " + remainingSeconds + "s";

    // Update countdown display
    document.getElementById("countdown").innerText = countdownText;
}

// Call updateCountdown initially
updateCountdown();

// Update the countdown every second
setInterval(updateCountdown, 1000);
