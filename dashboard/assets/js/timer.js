window.addEventListener('load', (event) => {
    let clock;
    let countdownTime = 50 * 60; // 50 minutes in seconds
    let additionalCountdownTime = 10 * 60; // 10 minutes in seconds
  
    // Get the audio element for the ticking sound
    let tickSound = document.getElementById('tickSound');
  
    // Function to start the countdown
    function startCountdown(time, callback) {
      clock = $(".clock").FlipClock(time, {
        clockFace: "MinuteCounter", // واجهة العد
        countdown: true,
        callbacks: {
          interval: function() {
            tickSound.play(); // Play the ticking sound every second
          },
          stop: function() {
            if (callback) {
              callback();
            }
          }
        }
      });
  
      // Check when timer reaches 0, then stop at 0
      function checktime() {
        let t = clock.getTime();
        if (t <= 0) {
          clock.setTime(0);
          if (callback) {
            callback();
          }
        } else {
          setTimeout(checktime, 1000);
        }
      }
  
      setTimeout(checktime, 1000);
    }
  
    // Start the first 50-minute countdown
    startCountdown(countdownTime, function() {
      console.log("50 minutes have passed!");
  
      // Start the additional 10-minute countdown after the 50-minute countdown ends
      startCountdown(additionalCountdownTime, function() {
        console.log("10 additional minutes have passed!");
      });
    });
  });
  