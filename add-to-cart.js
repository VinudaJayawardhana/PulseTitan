document.addEventListener("DOMContentLoaded", () => {
    const cartContainer = document.getElementById("cart-container");
    const totalPriceElement = document.getElementById("total-price");
    const finalTotalElement = document.getElementById("final-total");
    let cart = localStorage.getItem("cart") || "";
    const checkoutButton = document.getElementById("checkout-btn");


    const taxRate = 0.1; 

    // Here it is function to calculate and display totals
    const calculateTotal = () => {
        let subTotal = 0;

        // Parse the cart string and calculate the subtotal
        const cartItems = cart.split("|").filter(item => item.trim() !== "");
        cartItems.forEach(item => {
            const [name, price, quantity] = item.split(",");
            subTotal += parseFloat(price) * parseInt(quantity);
        });

        const taxAmount = subTotal * taxRate; // Here it calculate tax
       const finalTotal = subTotal + taxAmount; // Final total including tax

        totalPriceElement.textContent = subTotal.toFixed(2); // Display subtotal
        finalTotalElement.textContent = finalTotal.toFixed(2); // Display final total
    };

    // Function to render the cart
    const renderCart = () => {
        cartContainer.innerHTML = ""; // Clear container content

        const cartItems = cart.split("|").filter(item => item.trim() !== "");
        cartItems.forEach((item, index) => {
            const [name, price, quantity, image] = item.split(",");

            const cartItem = document.createElement("div");
            cartItem.className = "cart-item";

            cartItem.innerHTML = `
                <img src="${image}" alt="${name}" class="product-image">
                <div class="item-details">
                    <h3 class="product-name">${name}</h3>
                    <p class="product-price">Price: LKR${price}</p>
                    <div class="quantity-controls">
                        <button class="decrease-quantity" data-index="${index}">-</button>
                        <input type="text" class="quantity-input" value="${quantity}" readonly>
                        <button class="increase-quantity" data-index="${index}">+</button>
                    </div>
                </div>
                <button class="remove-item" data-index="${index}">Remove</button>
            `;

            // Increase quantity
            cartItem.querySelector(".increase-quantity").addEventListener("click", () => {
                const updatedCartItems = cart.split("|").map((item, i) => {
                    if (i === index) {
                        const [name, price, quantity, image] = item.split(",");
                        return `${name},${price},${parseInt(quantity) + 1},${image}`;
                    }
                    return item;
                });
                cart = updatedCartItems.join("|");
                localStorage.setItem("cart", cart);
                renderCart();
                calculateTotal();
            });

            // Decrease quantity
            cartItem.querySelector(".decrease-quantity").addEventListener("click", () => {
                const updatedCartItems = cart.split("|").map((item, i) => {
                    if (i === index) {
                        const [name, price, quantity, image] = item.split(",");
                        const newQuantity = parseInt(quantity) - 1;
                        return newQuantity > 0 ? `${name},${price},${newQuantity},${image}` : null;
                    }
                    return item;
                }).filter(item => item !== null);
                cart = updatedCartItems.join("|");
                localStorage.setItem("cart", cart);
                renderCart();
                calculateTotal();
            });

            // Remove item
            cartItem.querySelector(".remove-item").addEventListener("click", () => {
                const updatedCartItems = cart.split("|").filter((_, i) => i !== index);
                cart = updatedCartItems.join("|");
                localStorage.setItem("cart", cart);
                renderCart();
                calculateTotal();
            });

            cartContainer.appendChild(cartItem);
        });
        
        calculateTotal(); // Update totals after rendering
    };

     // Checkout button logic
     if (checkoutButton) {
        checkoutButton.addEventListener("click", () => {
            alert("Checkout successfully proceeded!");
        });
    } else {
        console.error("Checkout button not found!");
    }



    renderCart(); // Initial render


    
    
   
        
});
