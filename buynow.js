
// Prices for each product code in LKR
const productPrices = {
    "DB001": 2100,  // Dumbell Bar
    "DB002": 3000,  // Soft Dumbell
    "DB003": 8500,  // Steel Dumbell-8kg
    "EB001": 15000, // Exercise Bikes-WESLO
    "TM001": 200000, // Treadmill-WESLO(90KG)
    "DS001": 28000, // Dumbell Set
    "MT001": 4000,  // Men's Trackbottom
    "WT001": 2000,  // Women's Sport T-shirt
    "YM001": 3000,  // Yoga-Mats
    "HH001": 2000,  // Hoola-hoops
    "CT001": 129000, // Cross-Trainer
    "SG001": 250000, // All-In-One Strength Gym
    "FK001": 11000,  // Fitness-Pulldown-Kit
    "NS001": 15000,  // Nature-Craft Enhancing-Supplement
    "NM001": 20000,  // Naturello Multi-Vitamin
    "NK001": 12000,  // Naturemade K-13 Vitamin
    "NK002": 14000,  // Naturemade K-2 Vitamin
    "MP001": 25000,  // Muscle Protein-Powder
    "CS001": 9000,   // Creatine Bodybuilding-Supplement
    "SC001": 300000, // Stair-Climber
    "SB001": 160000  // Stationary Bike
};

//  add a product row dynamically
function addProductRow() {
    const container = document.getElementById('product-container');
    const newRow = document.createElement('div');
    newRow.className = 'product-row';

    newRow.innerHTML = `
        <div class="row-content">
            <label>Product</label>
            <select name="product_code[]" onchange="updateTotal()" required>
                <option value="" disabled selected>Select a Product</option>
                ${generateProductOptions()}
            </select>

            <label>Quantity</label>
            <input type="number" name="quantity[]" min="1" onchange="updateTotal()" required placeholder="Enter Quantity">

            <button type="button" class="remove-btn" onclick="removeProductRow(this)">Remove</button>
        </div>
    `;

    container.appendChild(newRow);
}

// Generate product options for the dropdown
function generateProductOptions() {
    let options = "";
    for (const code in productPrices) {
        options += `<option value="${code}">${getProductName(code)} (${code})</option>`;
    }
    return options;
}

// Get product name based on product code (optional utility)
function getProductName(code) {
    const productNames = {
        "DB001": "Dumbell Bar",
        "DB002": "Soft Dumbell",
        "DB003": "Steel Dumbell-8kg",
        "EB001": "Exercise Bikes-WESLO",
        "TM001": "Treadmill-WESLO(90KG)",
        "DS001": "Dumbell Set",
        "MT001": "Men's Trackbottom",
        "WT001": "Women's Sport T-shirt",
        "YM001": "Yoga-Mats",
        "HH001": "Hoola-hoops",
        "CT001": "Cross-Trainer",
        "SG001": "All-In-One Strength Gym",
        "FK001": "Fitness-Pulldown-Kit",
        "NS001": "Nature-Craft Enhancing-Supplement",
        "NM001": "Naturello Multi-Vitamin",
        "NK001": "Naturemade K-13 Vitamin",
        "NK002": "Naturemade K-2 Vitamin",
        "MP001": "Muscle Protein-Powder",
        "CS001": "Creatine Bodybuilding-Supplement",
        "SC001": "Stair-Climber",
        "SB001": "Stationary Bike"
    };
    return productNames[code] || "Unknown Product";
}

// Remove a product row
function removeProductRow(button) {
    const row = button.closest('.product-row');
    row.remove();
    updateTotal(); // Update total after removing a row
}

// Update the total cost dynamically
function updateTotal() {
    let total = 0;

    // Loop over all product rows
    const rows = document.querySelectorAll('.product-row');
    rows.forEach(row => {
        const productCode = row.querySelector('select').value;
        const quantity = row.querySelector('input[type="number"]').value;

        if (productCode && quantity) {
            total += productPrices[productCode] * parseInt(quantity);
        }
    });

    // Update the total display
    const totalDisplay = document.getElementById('total-cost');
    totalDisplay.textContent = `Total: LKR ${total.toLocaleString()}`;
}

// Debugging function (optional for testing)
function debugLog(message) {
    console.log(message);
}