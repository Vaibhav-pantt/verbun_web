const btn = document.getElementById('theme-toggle');
const intro = document.querySelector('.intro-section');

btn.addEventListener('click', () => {
  document.body.classList.toggle('dark');
  intro.classList.toggle('flag-bg');
});

function filterItems() {
  const input = document.querySelector('.search-input').value.toLowerCase();
  const items = document.querySelectorAll('#item-list li');

  items.forEach(item => {
    const text = item.textContent.toLowerCase();
    item.style.display = text.includes(input) ? 'list-item' : 'none';
  });
}
function handleSearch() {
  const query = document.getElementById('search-box').value.trim();
  if (query) {
    window.location.href = `/search.html?q=${encodeURIComponent(query)}`;
  }
  return false; // Prevent form from submitting normally
}


const cardContainer = document.getElementById('card-container');
const form = document.getElementById('card-form');
let isEnglish = true;

form.addEventListener('submit', function (e) {
  e.preventDefault();
  const spanish = document.getElementById('spanish-word').value.trim();
  const english = document.getElementById('english-word').value.trim();

  if (spanish && english) {
    createCard(spanish, english);
    form.reset();
  }
});

function createCard(spanish, english) {
  const card = document.createElement('div');
  card.className = 'flashcard';

  const content = document.createElement('div');
  content.innerHTML = `<strong>${spanish}</strong><br/>${english}`;
  card.appendChild(content);

  const actions = document.createElement('div');
  actions.className = 'actions';

  const editBtn = document.createElement('button');
  editBtn.className = 'edit';
  editBtn.innerText = 'Edit';
  editBtn.onclick = () => {
    const newSpanish = prompt('Edit Spanish word:', spanish);
    const newEnglish = prompt('Edit English word:', english);
    if (newSpanish && newEnglish) {
      content.innerHTML = `<strong>${newSpanish}</strong><br/>${newEnglish}`;
    }
  };

  const deleteBtn = document.createElement('button');
  deleteBtn.className = 'delete';
  deleteBtn.innerText = 'Delete';
  deleteBtn.onclick = () => card.remove();

  actions.appendChild(editBtn);
  actions.appendChild(deleteBtn);
  card.appendChild(actions);
  cardContainer.appendChild(card);
}

// Optional: Add a few sample flashcards on load
createCard('Hola', 'Hello');
createCard('Gracias', 'Thank you');
createCard('Casa', 'House');

function toggleLanguage() {
  isEnglish = !isEnglish;
  document.querySelector(".toggle-btn").innerText = isEnglish ? "Español" : "English";
  document.getElementById("hero-text").innerText = isEnglish ? "Learn Spanish with Verbun" : "Aprende español con Verbun";
  document.getElementById("flashcard-title").innerText = isEnglish ? "Vocabulary Flashcards" : "Tarjetas de Vocabulario";
}

const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close');

// Show menu
if (navToggle) {
  navToggle.addEventListener('click', () => {
    navMenu.classList.add('show-menu');
  });
}

// Hide menu
if (navClose) {
  navClose.addEventListener('click', () => {
    navMenu.classList.remove('show-menu');
  });
}

// Search toggle
const search = document.getElementById('search'),
      searchBtn = document.getElementById('search-btn'),
      searchClose = document.getElementById('search-close');

// Show search
if (searchBtn) {
  searchBtn.addEventListener('click', () => {
    search.classList.add('show-search');
  });
}

// Hide search
if (searchClose) {
  searchClose.addEventListener('click', () => {
    search.classList.remove('show-search');
  });
}
