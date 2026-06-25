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
