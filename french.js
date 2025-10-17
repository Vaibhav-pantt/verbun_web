
const btn = document.getElementById('theme-toggle');

btn.addEventListener('click', () => {
  document.body.classList.toggle('dark');
});


  // Set this to the current language of the page (all lowercase)
  const currentLanguage = 'freanch'; // e.g. 'chinese', 'japanese', etc.

  // Assign weights to each video, in order of appearance on the page
  // For example, if 3 videos: first 20%, second 15%, third 10%...
  // Sum weights <= 100 for full progress.
  const videoWeights = [20, 15, 10, 10, 5]; // adjust length to number of videos

  // Initialize or read current progress from localStorage
  function getProgress(lang) {
    return parseFloat(localStorage.getItem(`progress_${lang}`)) || 0;
  }

  function setProgress(lang, value) {
    if (value > 100) value = 100;
    localStorage.setItem(`progress_${lang}`, value);
  }

  // On DOM ready
  document.addEventListener('DOMContentLoaded', () => {
    const videoItems = document.querySelectorAll('.video-item');
    videoItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        let currentProgress = getProgress(currentLanguage);
        let increment = videoWeights[index] || 10; // default 10 if weight missing
        let newProgress = currentProgress + increment;
        if (newProgress > 100) newProgress = 100;
        setProgress(currentLanguage, newProgress);
        alert(`Progress updated: ${currentLanguage} ${newProgress}%`);
      });
    });
  });
