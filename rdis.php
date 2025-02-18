<?php
session_start();

$con = new mysqli("localhost", "root", "", "log");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$rollno = $_SESSION['rollno'];

// Prepared statements to avoid SQL injection
$stmt = $con->prepare("SELECT * FROM user WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$userResult = $stmt->get_result();

$stmt = $con->prepare("SELECT * FROM result WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$resultResult = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f0f0;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<?php
if ($userResult->num_rows > 0) {
    echo "<h2>User Details</h2>";
    echo "<table>";
    while ($row = $userResult->fetch_assoc()) {
        foreach ($row as $key => $value) {
            echo "<tr><th>$key</th><td>$value</td></tr>";
        }
    }
    echo "</table>";
} else {
    echo "<p>No user found with the given roll number.</p>";
}

if ($resultResult->num_rows > 0) {
    echo "<h2>Result Details</h2>";
    echo "<table>";
    while ($row = $resultResult->fetch_assoc()) {
        foreach ($row as $key => $value) {
            if ($key != "rollno"){
            echo "<tr><td>$key</td><td>$value</td></tr>";
            }
            else{
                echo "<tr><th>TESTNO</th><th>MARKS</th></tr>"; 
            }
        }
    }
    echo "</table>";
} else {
    echo "<p>No result found for the given roll number.</p>";
}

$stmt->close();
$con->close();
?>

</body>
</html>
