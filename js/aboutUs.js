let navbar = document.getElementById("navbar");

window.addEventListener("scroll", () => {
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

const cards = document.querySelectorAll(
  ".mission-card, .stats-card, .story-image",
);

cards.forEach((card) => {
  card.addEventListener("mouseenter", () => {
    card.style.transform = "translateY(-10px)";
  });

  card.addEventListener("mouseleave", () => {
    card.style.transform = "translateY(0)";
  });
});

document.addEventListener("DOMContentLoaded", () => {
  let navbar = document.getElementById("navbar");

  if (navbar) {
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });
  }

  let menuToggle = document.getElementById("menu-toggle");

  let mobileNav = document.getElementById("mobile-nav");

  let closeMenu = document.getElementById("close-menu");

  if (menuToggle && mobileNav) {
    menuToggle.addEventListener("click", () => {
      mobileNav.classList.add("active");

      menuToggle.style.display = "none";
    });
  }

  if (closeMenu && mobileNav) {
    closeMenu.addEventListener("click", () => {
      mobileNav.classList.remove("active");

      menuToggle.style.display = "block";
    });
  }
});


const reveals = document.querySelectorAll(".reveal");

function revealOnScroll() {
  reveals.forEach((element) => {
    const windowHeight = window.innerHeight;

    const revealTop = element.getBoundingClientRect().top;

    if (revealTop < windowHeight - 100) {
      element.classList.add("active");
    }
  });
}

window.addEventListener("scroll", revealOnScroll);

revealOnScroll();

const counters = document.querySelectorAll(".stats-card h2");

let started = false;

function startCounterAnimation() {
  if (started) return;

  const triggerPoint = window.innerHeight * 0.85;

  counters.forEach((counter) => {
    const top = counter.getBoundingClientRect().top;

    if (top < triggerPoint) {
      started = true;

      const targetText = counter.innerText;

      const targetNumber = parseInt(targetText);

      const suffix = targetText.replace(targetNumber, "");

      let current = 0;

      const increment = targetNumber / 80;

      const updateCounter = () => {
        current += increment;

        if (current < targetNumber) {
          counter.innerText = `${Math.floor(current)}${suffix}`;

          requestAnimationFrame(updateCounter);
        } else {
          counter.innerText = `${targetNumber}${suffix}`;
        }
      };

      updateCounter();
    }
  });
}

window.addEventListener("scroll", startCounterAnimation);

window.addEventListener("load", startCounterAnimation);
