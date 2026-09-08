const themeToggle = document.getElementById("themeToggle");

const savedTheme = localStorage.getItem("portfolio-theme");

if (savedTheme === "dark") {
    document.body.classList.add("dark");
}

themeToggle?.addEventListener("click", () => {
    document.body.classList.toggle("dark");

    localStorage.setItem(
        "portfolio-theme",
        document.body.classList.contains("dark")
            ? "dark"
            : "light"
    );
});

// const cursor = document.querySelector(".cursor");
// const dot = document.querySelector(".cursor-dot");

// let mouseX = 0;
// let mouseY = 0;
// let cursorX = 0;
// let cursorY = 0;

// window.addEventListener("mousemove", (event) => {
//     mouseX = event.clientX;
//     mouseY = event.clientY;

//     if (dot) {
//         dot.style.left = `${mouseX}px`;
//         dot.style.top = `${mouseY}px`;
//     }
// });

// function animateCursor() {
//     cursorX += (mouseX - cursorX) * 0.15;
//     cursorY += (mouseY - cursorY) * 0.15;

//     if (cursor) {
//         cursor.style.left = `${cursorX}px`;
//         cursor.style.top = `${cursorY}px`;
//     }

//     requestAnimationFrame(animateCursor);
// }

// animateCursor();

const cursor = document.querySelector(".cursor");
const dot = document.querySelector(".cursor-dot");

let mouseX = 0;
let mouseY = 0;
let cursorX = 0;
let cursorY = 0;
let cursorAnimation = null;

window.addEventListener(
    "mousemove",
    (event) => {
        mouseX = event.clientX;
        mouseY = event.clientY;

        if (dot) {
            dot.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0)`;
        }

        if (!cursorAnimation) {
            animateCursor();
        }
    },
    { passive: true }
);

function animateCursor() {
    cursorX += (mouseX - cursorX) * 0.15;
    cursorY += (mouseY - cursorY) * 0.15;

    if (cursor) {
        cursor.style.transform =
            `translate3d(${cursorX}px, ${cursorY}px, 0)`;
    }

    const distance =
        Math.abs(mouseX - cursorX) +
        Math.abs(mouseY - cursorY);

    if (distance > 0.5) {
        cursorAnimation = requestAnimationFrame(animateCursor);
    } else {
        cursorAnimation = null;
    }
}

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    },
    {
        threshold: 0.12
    }
);

document.querySelectorAll(".reveal").forEach((element) => {
    observer.observe(element);
});