
const lang = window.Telegram.WebApp.initDataUnsafe.user.language_code;

const translations = {
    ru: {
        title: "Привет, мир!",
        description: "Это пример многоязычного сайта."
    },
    en: {
        title: "Hello, world!",
        description: "This is an example of a multilingual website."
    }
};

// Выбираем словарь в зависимости от языка
const currentLang = translations[lang] || translations.ru;

// Заменяем тексты на странице
// document.getElementById('title').textContent = currentLang.title;
// document.getElementById('description').textContent = currentLang.description;
