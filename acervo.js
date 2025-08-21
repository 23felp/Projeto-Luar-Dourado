document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const bookCards = document.querySelectorAll(".book-card");

  searchInput.addEventListener("input", function () {
    const query = searchInput.value.toLowerCase();

    bookCards.forEach(card => {
      const title = card.querySelector("h3").textContent.toLowerCase();
      const author = card.querySelector(".author")?.textContent.toLowerCase() || "";
      const year = card.querySelector(".year")?.textContent.toLowerCase() || "";

      const match = title.includes(query) || author.includes(query) || year.includes(query);
      card.style.display = match ? "block" : "none";
    });
  });
});
