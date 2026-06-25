const resultsContainer = document.getElementById("resultsContainer");

const buses = JSON.parse(localStorage.getItem("searchResults")) || [];

if (buses.length === 0) {
  resultsContainer.innerHTML = `
    <h2>No buses found for this route.</h2>
  `;
} else {
  buses.forEach((bus) => {
    resultsContainer.innerHTML += `

      <div class="bus-card hover-card">

        <img src="${bus.image}">

        <div class="bus-info">
          <h2>${bus.company}</h2>
          <p>${bus.from} → ${bus.to}</p>
          <p>${bus.departure} - ${bus.arrival}</p>
          <p>${bus.duration}</p>
        </div>

        <div class="price-box">
          <h2>${bus.price}</h2>

          <button onclick='viewBus(${JSON.stringify(bus)})'>
            View Details
          </button>
        </div>

      </div>
    `;
  });
}

function viewBus(bus) {
  localStorage.setItem("selectedBus", JSON.stringify(bus));

  window.location.href = "bus-details.php";
}
