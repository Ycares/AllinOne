document.addEventListener("DOMContentLoaded", function () {
    const categoryButtons = document.querySelectorAll(".nav-link");
    const categoryCards = document.querySelectorAll(".category-card");

    categoryButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const targetCategory = button.getAttribute("data-category");
            categoryCards.forEach((card) => {
                if (card.getAttribute("data-category") === targetCategory) {
                    card.classList.remove("d-none");
                } else {
                    card.classList.add("d-none");
                }
            });
        });
    });
});