document.addEventListener("DOMContentLoaded", function() {
    const filterSelect = document.getElementById("filter");
    const sortSelect = document.getElementById("sort");
    const productGrid = document.querySelector(".product-grid");

    filterSelect.addEventListener("change", filterProducts);
    sortSelect.addEventListener("change", sortProducts);

    function filterProducts() {
        const filterValue = filterSelect.value;
        const products = productGrid.querySelectorAll(".product-card");

        products.forEach(product => {
            const productCategory = product.getAttribute("data-category");
            if (filterValue === "all" || filterValue === productCategory) {
                product.style.display = "block";
            } else {
                product.style.display = "none";
            }
        });
    }

    function sortProducts() {
        const sortValue = sortSelect.value;
        const products = Array.from(productGrid.querySelectorAll(".product-card"));

        products.sort((a, b) => {
           
                const aPrice = parseFloat(a.getAttribute("data-price"));
                const bPrice = parseFloat(b.getAttribute("data-price"));
                const aRating = parseFloat(a.getAttribute("data-rating"));
                const bRating = parseFloat(b.getAttribute("data-rating"));

            if (sortValue === "price-asc") return aPrice - bPrice;
            if (sortValue === "price-desc") return bPrice - aPrice;
            if (sortValue === "rating-asc") return aRating - bRating;
            if (sortValue === "rating-desc") return bRating - aRating;
        });

        productGrid.innerHTML = "";
        products.forEach(product => productGrid.appendChild(product));
    }
});
