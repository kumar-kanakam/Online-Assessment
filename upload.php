<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $test = $_POST["test"];
    $answer = $_POST["answer"];
    $con = mysqli_connect("localhost", "root", "", "log");

    if (!$con) {
        echo "not connected ";
    }

    $file_tmp = $_FILES['file']['tmp_name'];
    $file_content = mysqli_real_escape_string($con, file_get_contents($file_tmp));

    // Insert data into the database
    $sql = "UPDATE admin SET answer='$answer', file_content='$file_content' WHERE test='$test'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location:submited.php");
    } else {
        echo "Error in insertion: " . mysqli_error($con);
    }

    mysqli_close($con);
    exit;
}
?> 
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="file"], input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<script>
        function fun(){
            var input = document.getElementById("answer").value;
            var test = document.getElementById("test").value;
            if (test=="nogo"){
                alert ("select required test.");
            }
            if (!input.trim()) {
                alert("answer cannot be empty.");
            }

        var chars = input.split(',');

        var validChars = ['a', 'b', 'c', 'd'];
        for (var i = 0; i < chars.length; i++) {
            if (!validChars.includes(chars[i])) {
                alert("answer contains invalid value "+chars[i]+". Only a, b, c, or d are allowed.");
                return false; 
            }
        }

        return true; 
    }
</script>
   <form action="" method="post" enctype="multipart/form-data" onsubmit="return fun()">
    <label for="file">Choose a file:</label><br>
    <input type="file" name="file"><br><br>

<label for="test">Select the test number:</label><br>
<select name="test" id="test">
    <option value="nogo">Select</option>
    <option value="test1">Test 1</option>
    <option value="test2">Test 2</option>
    <option value="test3">Test 3</option>
    <option value="test4">Test 4</option>
    <option value="test5">Test 5</option>
</select><br><br>

<label for="answer">Enter all answers:</label><br>
<input type="text" name="answer" id="answer" placeholder="answer like this a,b,c,d... or this abcd... "><br><br>
<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>