<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Button Click Example</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clicked'])) {
   // or any other numeric value
   echo "<script>alert('You are not eligible for this test');</script>";
}
?>

<form method="post">
    <button type="submit" name="clicked" value="1">Click Me</button>
    <button type="submit" name="clicked" value="5">Click Me</button>
</form>

</body>
</html>
