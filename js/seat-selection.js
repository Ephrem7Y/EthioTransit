const travelDate = localStorage.getItem("travelDate");

const selectedBus = JSON.parse(localStorage.getItem("selectedBus"));

const seatContainer = document.getElementById("seatContainer");

const occupiedSeats = [3, 6, 11, 14];

const selectedSeats = [];

document.getElementById("companyName").innerText = selectedBus.company;

document.getElementById("routeName").innerText =
  `${selectedBus.from} → ${selectedBus.to}`;

document.getElementById("departureTime").innerText = selectedBus.departure;
document.getElementById("departureDate").innerText = travelDate;

for (let i = 1; i <= 20; i++) {
  const seat = document.createElement("div");

  seat.classList.add("seat");

  seat.innerText = i;

  if (occupiedSeats.includes(i)) {
    seat.classList.add("occupied-seat");
  }

  seat.addEventListener("click", () => {
    if (seat.classList.contains("occupied-seat")) return;

    seat.classList.toggle("selected-seat");

    updateSeats();
  });

  seatContainer.appendChild(seat);
}

function updateSeats() {
  selectedSeats.length = 0;

  document.querySelectorAll(".selected-seat").forEach((seat) => {
    selectedSeats.push(seat.innerText);
  });

  const selectedSeatsDiv = document.getElementById("selectedSeats");

  selectedSeatsDiv.innerHTML = "";

  selectedSeats.forEach((seat) => {
    selectedSeatsDiv.innerHTML += `
      <span class="selected-seat-tag">
        ${seat}
      </span>
    `;
  });

  document.getElementById("seatCount").innerText =
    `${selectedSeats.length} Seat`;

  localStorage.setItem("selectedSeats", JSON.stringify(selectedSeats));

  const price = parseInt(selectedBus.price);

  const subtotal = selectedSeats.length * price;

  document.getElementById("baseFare").innerText = `${subtotal} ETB`;

  document.getElementById("totalPrice").innerText = `${subtotal + 50} ETB`;
}

const continueBtn = document.getElementById("continuePaymentBtn");

if (continueBtn) {
  continueBtn.addEventListener("click", () => {
    if (selectedSeats.length === 0) {
      alert("Please select at least one seat.");

      return;
    }

    window.location.href = "payment.php";
  });
}

function goBack() {
  window.history.back();
}
