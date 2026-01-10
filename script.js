const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navLinks.classList.toggle("show");
});

function scrollToContact() {
    document.getElementById("contact").scrollIntoView({ behavior: "smooth" });
}

const form = document.getElementById("contactForm");
const message = document.getElementById("formMessage");

form.addEventListener("submit", function (e) {
    e.preventDefault();
    message.style.color = "green";
    message.textContent = "Thank you for contacting Intego Limited. We will respond shortly.";
    form.reset();
});
