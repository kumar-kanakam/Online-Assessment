<html>
<head>
<title>Testify:online assesments</title>
<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .success-message {
        margin-bottom: 30px;
        font-size: 32px;
        color: #2ecc71;
    }
    .continue-button {
        display: inline-block;
        padding: 15px 30px;
        background-color: #2ecc71;
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .continue-button:hover {
        transform: scale(1.1);
        box-shadow: 0 0 20px rgba(46, 204, 113, 0.5);
    }
</style>
</head>
<body>
    <div class="container">
        <div class="success-message">Uploaded Successfully!</div>
        <a href="upload.php" class="continue-button">Continue</a>
    </div>
</body>
</html>
