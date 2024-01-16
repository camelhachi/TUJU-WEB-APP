let time = 30;

  // Function to update the countdown
  function updateCountdown() {
    const countdownElement = document.getElementById('countdown');
    
    // Format the time as mm:ss
    const minutes = Math.floor(time / 60);
    const seconds = time % 60;
    const formattedTime = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    
    // Update the countdown element
    countdownElement.textContent = formattedTime;

    // Decrease the time by 1 second
    time--;

    // Check if the countdown is complete 
    if (time < 0) {
      clearInterval(countdownInterval);
      // You can add additional actions when the countdown is complete
      countdownElement.textContent = "Time's up!";
    }
  }
  const countdownInterval = setInterval(updateCountdown, 1000);