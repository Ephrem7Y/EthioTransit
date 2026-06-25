document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("admin-menu-toggle");
  const sidebar = document.querySelector(".sidebar, .admin-sidebar");

  if (!toggle || !sidebar) {
    return;
  }

  toggle.addEventListener("click", () => {
    const isOpen = sidebar.classList.toggle("open");

    toggle.classList.toggle("open", isOpen);
    toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    toggle.textContent = isOpen ? "X" : "☰";
  });
});
