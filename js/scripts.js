// LIGHT & DARK MODE VARIABLES
const primaryButton = document.getElementById("primaryButton");
const toggleButton = document.getElementById("themeToggle");
const card = document.getElementById("card");
const pageBody = document.getElementById("pageBody");

toggleButton.addEventListener('click', toggleTheme); // toggle theme on click

function toggleTheme() { // Toggles the site theme between Light & Dark modes.
    console.log("Function toggleButtonColours() is working.")
    console.log(pageBody.classList);
    if (card.classList.contains("card--dark")) { // if already in 'Dark mode', remove dark classes
        console.log("Changed theme to light mode.");
        pageBody.classList.remove("background--dark"); // remove dark classes
        card.classList.remove("card--dark");

        pageBody.classList.add("background--light"); // add light classes
        card.classList.add("card--light");
        primaryButton.style.color = "white";
    }
    else { // if already in 'Light mode', remove light classes
        console.log("Changed theme to dark mode.");
        pageBody.classList.remove("background--light"); // remove light
        card.classList.remove("card--light");

        pageBody.classList.add("background--dark"); // add dark classes
        card.classList.add("card--dark");
        primaryButton.style.color = "black";
    }
};