// Function for authentication
function authenticate(event) {
    event.preventDefault(); // Prevent form submission

    // Sample hard-coded credentials for demonstration
    const validUsername = "pulse";
    const validPassword = "password123";

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if (username === validUsername && password === validPassword) {
        alert("Login successful!");
        // Redirect or perform actions upon successful login
        window.location.href = "index.html";
    } else {
        alert("Invalid username or password.");
    }
}

// Attach event listener to the form
document.getElementById("loginForm").addEventListener("submit", authenticate);
