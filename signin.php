<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulse-Titan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('./Apparel/signin_cover.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .icon {
            width: 120px; /* Adjust size */
            height: auto;
            border-radius: 100px;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .button-container {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
        }

        button {
            padding: 12px 24px;
            font-size: 1.2rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            display: block;
            width: 150px;
            text-align: center;
        }

        .signin {
            background-color: #ff5733;
            color: white;
            box-shadow: 3px 3px 10px rgba(255, 87, 51, 0.5);
        }

        .login {
            background-color: #3498db;
            color: white;
            box-shadow: 3px 3px 10px rgba(52, 152, 219, 0.5);
        }

        .signin:hover {
            background-color: #e74c3c;
            box-shadow: 0 0 15px rgba(255, 87, 51, 0.8);
        }

        .login:hover {
            background-color: #2980b9;
            box-shadow: 0 0 15px rgba(52, 152, 219, 0.8);
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img class="icon" src="./image5.png" alt="Pulse-Titan Logo">
    </div>

    <h1>Pulse-Titan</h1>

    <div class="button-container">
        <a href="./login.html"><button class="signin">Sign-In</button></a>
        <a href="./login.html"><button class="login">Log-In</button></a>
    </div>
</body>
</html>