document.querySelectorAll(".add-to-cart-btn").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default anchor behavior

        const productName = this.getAttribute("data-name"); // Item name
        const productPrice = parseFloat(this.getAttribute("data-price")); // Item price
        const productImage = this.getAttribute("data-image"); // Item image URL

        if (!productName || isNaN(productPrice) || !productImage) {
            alert("Invalid product data. Please check the button attributes.");
            return;
        }

        // Retrieve existing cart from Local Storage or initialize as an empty string
        let cart = localStorage.getItem("cart") || "";
        let updatedCart = "";

        // Split the cart string into individual items
        let cartItems = cart.split("|").filter(item => item.trim() !== "");
        let itemExists = false;

        // Check if the product already exists in the cart
        cartItems = cartItems.map(item => {
            const [name, price, quantity, image] = item.split(",");
            if (name === productName) {
                itemExists = true;
                const newQuantity = parseInt(quantity) + 1; // Increment quantity
                return `${name},${price},${newQuantity},${image}`;
            }
            return item;
        });

        // Add new product if it doesn't already exist
        if (!itemExists) {
            cartItems.push(`${productName},${productPrice},1,${productImage}`);
        }

        // Rebuild the cart string
        updatedCart = cartItems.join("|");

        // Save updated cart back to Local Storage
        localStorage.setItem("cart", updatedCart);

        alert(`${productName} added to cart successfully!`);
    });
});
