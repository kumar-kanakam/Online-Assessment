<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clicked'])) {
    $num = $_POST['clicked'];
    $r = $_SESSION['rollno'];
    $_SESSION['test'] = "test$num";
    $con = mysqli_connect("localhost", "root", "", "log");

    if (!$con) {
        die("Connection failed!" . mysqli_connect_error());
    }

    $sql = "SELECT * FROM result where rollno='$r'";
    $retval = mysqli_query($con, $sql);

    if ($retval) {
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            if ($row["test$num"] !== 'null') {
              echo "<script>alert('You have already done this test');</script>";
            } elseif ($num > 1 && $row["test" . ($num - 1)] === 'null') {
                echo "<script>alert('You should complete the previous test first');</script>";
            } else {
                if($num > 1 &&$row["test" . ($num - 1)]<10){
                echo "<script>alert('You are not eligible for this test');</script>";
                }else{

                            header("Location:test1.php");
                            
                }
            }
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
    mysqli_close($con);
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stbd.css">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .head {
            display:flex;
            justify-content:space-between;
            align-items: center;
            padding: 5px;
            background-color: #40E0D0;
        }
        .logout{
            margin-left:20px;
        }
        .title{
            text-align:center;
            flex-grow:1;
        }
        .logout:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            color: #007bff;
            
        }
        .Tests {
            display: flex;
            justify-content: center;
            align-items: center; 
        }
        .Test button {
            margin: 10px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .Test:hover {
            transform: translateY(-5px);
        }   
        .Test button:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="head">
    <h1 class=title>Student Dashboard</h1>
    <button onclick="window.location.href='index.php'" class="logout">logout</button>
</div>
<form method="post">
<div class="Tests">
    <div class="Test">
        <button type="submit" name="clicked" value="1">Test 1</button>
    </div>
    <div class="Test">
    <button type="submit" name="clicked" value="2">Test 2</button>
    </div>
    <div class="Test">
    <button type="submit" name="clicked" value="3">Test 3</button>
    </div>
    <div class="Test">
    <button type="submit" name="clicked" value="4">Test 4</button>
    </div>
    <div class="Test">
    <button type="submit" name="clicked" value="5">Test 5</button>
    </div>
</div>
</form>
<div class="Tests">
    <div class="Test">
        <button onclick="window.location.href='rdis.php'" class="result">Result</button>
    </div>
</div>
</body>
</html>