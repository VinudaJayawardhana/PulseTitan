document.addEventListener('DOMContentLoaded', function() {
    const filterSelect = document.getElementById('filter');
    const sortSelect = document.getElementById('sort');
    const productGrid = document.querySelector('.product-grid');

    // Function to filter products
    function filterProducts() {
        const filterValue = filterSelect.value;
        const products = document.querySelectorAll('.product-card');

        products.forEach(product => {
            if (filterValue === 'all' || product.querySelector('h3').textContent.toLowerCase().includes(filterValue)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    // Function to sort products
    function sortProducts() {
        const sortValue = sortSelect.value;
        const productsArray = Array.from(document.querySelectorAll('.product-card'));

        if (sortValue === 'price') {
            productsArray.sort((a, b) => {
                const priceA = parseFloat(a.querySelector('.row-right h6').textContent.replace('LKR', ''));
                const priceB = parseFloat(b.querySelector('.row-right h6').textContent.replace('LKR', ''));
                return priceA - priceB;
            });
        } else if (sortValue === 'rating') {
            productsArray.sort((a, b) => {
                const ratingA = parseFloat(a.querySelector('.rating a').textContent.split('/')[0]);
                const ratingB = parseFloat(b.querySelector('.rating a').textContent.split('/')[0]);
                return ratingB - ratingA;
            });
        }

        // Reorder products in the DOM
        productsArray.forEach(product => productGrid.appendChild(product));
    }

    // Event listeners for filter and sort
    filterSelect.addEventListener('change', () => {
        filterProducts();
        sortProducts();
    });

    sortSelect.addEventListener('change', sortProducts);
});
