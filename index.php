<?php
session_start();

if (isset($_POST["submit"])) {
    $rollno = $_POST["rollno"];
    $pass = $_POST["password"];

    $con = mysqli_connect("localhost", "root", "", "log");

    if (!$con) {
        die("Connection failed!" . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user WHERE rollno = '$rollno'";

    if ($sql) {
        $retval = mysqli_query($con, $sql);
    }

    $found = false;
    if ($rollno == "ADMIN") {
        if ($pass == "admin123") {
            header("Location: upload.php");
            exit(); // Always use exit() after header redirection
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        while ($row = mysqli_fetch_assoc($retval)) {
            if ($row['rollno'] == $rollno) {
                $found = true;
                $s = "SELECT * FROM user WHERE rollno='$rollno'";
                $re = mysqli_query($con, $s);
                $r = mysqli_fetch_assoc($re);

                if ($pass == $r['password']) {
                    mysqli_close($con);
                    $_SESSION['rollno'] = $rollno;
                    header("Location: studentdb.php");
                    exit();
                } else {
                    echo "<script>alert('Invalid password');</script>";
                    echo "<script>window.location.href = window.location.href;</script>";
                    break;
                }
            }
        }

        if (!$found) {
            echo "<script>alert('Incorrect username or you do not have an account');</script>";
            echo "<script>window.location.href = window.location.href;</script>";
        }
    }
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Login Page</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            background: url('bg3.jpeg') no-repeat center center fixed;
            background-size: cover;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        header {
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px 0;
            text-align: center;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        header a {
            margin: 0 15px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }

        header a:hover {
            text-decoration: underline;
        }

        form {
            background-color: transparent;
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 200px; /* Adjusted to avoid overlap with header */
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: transparent;
        }

        input:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        a {
            text-decoration: none;
            color: #007bff;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .info-sections-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-top: 150px;
        }

        .info-section {
            background-color: transparent;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            margin: 100px 0;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .info-section.visible {
            opacity: 1;
        }
    </style>
</head>
<body>
    <script>
        function next(event, index) {
            if(event.key === "Enter") {
                event.preventDefault();
                document.querySelector(`[name="${index}"]`).focus();
            }
        }

        function smoothScroll(targetId) {
            document.getElementById(targetId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const sections = document.querySelectorAll('.info-section');

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>

    <header>
        <a href="#aboutus" onclick="smoothScroll('aboutus')">About Us</a>
        <a href="#contactus" onclick="smoothScroll('contactus')">Contact Us</a>
    </header>

    <form method="post" action="">
        <div class="box">
            <div class="username">
                Username(Rollno) : &nbsp; <input type="text" name="rollno" class="un" onkeydown="next(event,'password')">
            </div>
            <div class="password">
                Password : &nbsp; <input type="password" name="password" class="pd">
            </div>
            <input type="submit" name="submit" id="submit" value="Login">
        </div>
        <a href="Register.php">Register</a>
    </form>

    <div class="info-sections-container">
        <div id="aboutus" class="info-section">
            <h2>About Us</h2>
            <p>Welcome to our website. We are dedicated to providing the best service to our users. Our team works hard to ensure that you have a seamless experience.</p>
            <p>Our mission is to deliver high-quality content and resources to our community. We value feedback and continuously strive to improve our offerings.</p>
        </div>

        <div id="contactus" class="info-section">
            <h2>Contact Us</h2>
            <p>For any inquiries, please email us at contact@example.com or call us at (123) 456-7890.</p>
            <p>Our support team is available from Monday to Friday, 9 AM to 5 PM. We are here to assist you with any questions or concerns you may have.</p>
        </div>
    </div>
</body>
</html>
