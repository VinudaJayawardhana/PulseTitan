document.addEventListener('DOMContentLoaded', function() {
    const filterSelect = document.getElementById('filter');
    const sortSelect = document.getElementById('sort');
    const products = document.querySelectorAll('.product');
  
    // Filter products
    filterSelect.addEventListener('change', function() {
      const category = filterSelect.value;
      products.forEach(product => {
        if (category === 'all' || product.getAttribute('data-category') === category) {
          product.style.display = 'block';
        } else {
          product.style.display = 'none';
        }
      });
    });
  
    // Sort products
    sortSelect.addEventListener('change', function() {
      const sortBy = sortSelect.value;
      const productArray = Array.from(products);
      productArray.sort((a, b) => {
        if (sortBy === 'price') {
          return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
        } else if (sortBy === 'rating') {
          return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
        }
      });
  
      // Reorder products in the DOM
      const productGrid = document.querySelector('.product-grid');
      productGrid.innerHTML = '';
      productArray.forEach(product => {
        productGrid.appendChild(product);
      });
    });
  });
  