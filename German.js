
const btn = document.getElementById('theme-toggle');

btn.addEventListener('click', () => {
  document.body.classList.toggle('dark');
});


const imageInput = document.getElementById('imageInput');
const profilePreview = document.getElementById('profilePreview');

imageInput.addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      profilePreview.src = e.target.result;
    }
    reader.readAsDataURL(file);
  }
});

const stars = document.querySelectorAll('.star');
const ratingValue = document.getElementById('rating-value');
let selectedRating = 0;

stars.forEach(star => {
  star.addEventListener('mouseover', () => {
    const val = Number(star.getAttribute('data-value'));
    highlightStars(val);
  });

  star.addEventListener('mouseout', () => {
    highlightStars(selectedRating);
  });

  star.addEventListener('click', () => {
    selectedRating = Number(star.getAttribute('data-value'));
    ratingValue.textContent = selectedRating;
    highlightStars(selectedRating);
  });
});

function highlightStars(rating) {
  stars.forEach(star => {
    star.classList.remove('hover', 'selected');
    const val = Number(star.getAttribute('data-value'));
    if (val <= rating) {
      star.classList.add('selected');
    }
  });
}


window.addEventListener('DOMContentLoaded', () => {
  const progressCircles = document.querySelectorAll('.progress-circle');

  progressCircles.forEach(circle => {
    const svgCircle = circle.querySelector('.circle');
    const percentageText = circle.querySelector('.percentage');
    const progress = circle.getAttribute('data-progress');

    const circumference = 100;
    const offset = (circumference * progress) / 100;

    setTimeout(() => {
      svgCircle.style.strokeDasharray = `${offset}, 100`;
      percentageText.textContent = `${progress}%`;
    }, 300);
  });
});


window.addEventListener('DOMContentLoaded', () => {
  const progressCircles = document.querySelectorAll('.progress-circle');
  const progressData = JSON.parse(localStorage.getItem('videoProgress') || '{}');

  const maxProgressPerVideo = 8;
  const germanVideoKeys = Object.keys(progressData); // adjust if you want to filter

  let totalProgress = 0;
  germanVideoKeys.forEach(key => {
    totalProgress += Math.min(progressData[key], maxProgressPerVideo);
  });

  const maxTotalProgress = maxProgressPerVideo * germanVideoKeys.length || 1;
  const normalizedProgress = Math.round((totalProgress / maxTotalProgress) * 100);

  progressCircles.forEach(circle => {
    const svgCircle = circle.querySelector('.circle');
    const percentageText = circle.querySelector('.percentage');

    const circumference = 100;
    const offset = (circumference * normalizedProgress) / 100;

    setTimeout(() => {
      svgCircle.style.strokeDasharray = `${offset}, 100`;
      percentageText.textContent = `${normalizedProgress}%`;
    }, 300);
  });
});
