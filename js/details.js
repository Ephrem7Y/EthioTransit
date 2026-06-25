const bus = JSON.parse(localStorage.getItem("selectedBus"));

if (bus) {
  document.querySelector(".details-image img").src = bus.image;

  document.querySelector(".details-content h1").innerText = bus.company;

  const detailTexts = document.querySelectorAll(".details-grid p");

  detailTexts[0].innerText = bus.from;
  detailTexts[1].innerText = bus.to;
  detailTexts[2].innerText = bus.departure;
  detailTexts[3].innerText = bus.arrival;
  detailTexts[4].innerText = bus.duration;
  detailTexts[5].innerText = bus.price;

  const mapFrame = document.querySelector("iframe");

  mapFrame.src = `https://www.google.com/maps?q=${bus.from}&output=embed`;
}

const bookSeatBtn = document.getElementById("bookSeatBtn");

if (bookSeatBtn) {
  bookSeatBtn.addEventListener("click", () => {
    window.location.href = "seat-selection.php";
  });
}