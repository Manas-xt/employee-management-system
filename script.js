document.addEventListener('DOMContentLoaded', function() {
    const loadingScreen = document.getElementById('loading-screen');
    const minLoadTime = 2000; // Minimum loading time in milliseconds (3 seconds)
    const startTime = Date.now();

    function hideLoadingScreen() {
      const elapsedTime = Date.now() - startTime;
      if (elapsedTime < minLoadTime) {
        // If less than minimum time has passed, wait for the remainder
        setTimeout(hideLoadingScreen, minLoadTime - elapsedTime);
      } else {
        // Fade out and remove the loading screen
        loadingScreen.style.opacity = '0';
        setTimeout(() => {
          loadingScreen.style.display = 'none';
        }, 500);
      }
    }

    // Start hiding process when the window is fully loaded
    window.addEventListener('load', hideLoadingScreen);
  });