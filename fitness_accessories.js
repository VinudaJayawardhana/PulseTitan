document.addEventListener('DOMContentLoaded', () => {
    const filterSelect = document.getElementById('filter');
    const sortSelect = document.getElementById('sort');
    const products = document.querySelectorAll('.product');

    filterSelect.addEventListener('change', filterProducts);
    sortSelect.addEventListener('change', sortProducts);

    function filterProducts() {
        const category = filterSelect.value;
        products.forEach(product => {
            if (category === 'all' || product.getAttribute('data-category') === category) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    function sortProducts() {
        const sortBy = sortSelect.value;
        const productGrid = document.querySelector('.product-grid');
        const productArray = Array.from(products);

        productArray.sort((a, b) => {
            if (sortBy === 'price') {
                return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
            } else if (sortBy === 'rating') {
                return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
            }
        });

        productArray.forEach(product => {
            productGrid.appendChild(product);
        });
    }
});
