<?php
include '../assets/db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $company  = $_POST['company'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO login (name, company, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $company, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Signup successful! You can now login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const slides = document.querySelectorAll(".form-slide");
            const nextBtns = document.querySelectorAll(".next-button");
            const prevBtns = document.querySelectorAll(".prev-button");

            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle("active", i === index);
                });
            }

            nextBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    if (currentSlide < slides.length - 1) {
                        currentSlide++;
                        showSlide(currentSlide);
                    }
                });
            });

            prevBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    if (currentSlide > 0) {
                        currentSlide--;
                        showSlide(currentSlide);
                    }
                });
            });

            showSlide(currentSlide);
        });
    </script>
    <style>
        .form-slide { display: none; }
        .form-slide.active { display: block; }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1 class="signup-header">Signup</h1>
        <form method="POST" action="">
            <div class="form-slide active">
                <input type="text" name="name" placeholder="Enter your name" required>
                <button type="button" class="next-button">Next →</button>
            </div>
            <div class="form-slide">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="button" class="prev-button">←</button>
                <button type="button" class="next-button">Next →</button>
            </div>
            <div class="form-slide">
                <input type="text" name="company" placeholder="Enter your company" required>
                <button type="button" class="prev-button">←</button>
                <button type="button" class="next-button">Next →</button>
            </div>
            <div class="form-slide">
                <input type="password" name="password" placeholder="Enter your password" required>
                <input type="password" name="confirm_password" placeholder="Confirm your password" required>
                <button type="button" class="prev-button">←</button>
                <input type="submit" value="Signup" class="signup-button">
            </div>
        </form>
        <p class="p">
            already have an account? <a href="login.php" class="login-link">Login</a>
        </p>
    </div>
</body>
</html>