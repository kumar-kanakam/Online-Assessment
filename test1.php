<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            margin-left: auto;
            margin-right: auto;
        }

        .rad1 {
            background-color: lightblue;
        }

        .rad {
            background-color: #FF5733;
        }
    </style>
</head>
<body>

<div class="assessment" id="ACE">
    <div class="aces">
        <h1><center>QUESTION PAPER</center></h1>
        <h2 id="ques">
            <iframe src="testpdf.pdf" width="1500" height="600"></iframe>
        </h2>
        <h1><center>ANSWERS SHEET</center></h1>
        <?php
        $options = ['a', 'b', 'c', 'd'];
        $con = mysqli_connect("localhost", "root", "", "log");
        if (!$con) {
            die("Connection failed!" . mysqli_connect_error());
        }
        $tes = $_SESSION['test'];
        $sql = "SELECT * FROM admin WHERE test='$tes'";
        if ($sql) {
            $retval = mysqli_query($con, $sql);
        }
        if ($retval) {
            while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
                $answer = $row['answer'];
                break;
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
        $answers = explode(',', $answer);
        $corr = $answers;
        mysqli_close($con);
        echo '<table>';
        echo '<tr>';
        for ($j = 0; $j < count($corr); $j++) {
            if ($j % 5 == 0) {
                echo '<tr>';
                echo '</tr>';
            }

            echo "<td class='rad1'>" . ($j + 1) . ".</td>";

            for ($i = 0; $i < count($options); $i++) {
                echo "<td class='rad'>
                        <input type='radio' name='answer_" . ($j + 1) . "' id='" . $options[$i] . "_" . ($j + 1) . "' class='answer'>
                        <label for='" . $options[$i] . "_" . ($j + 1) . "' name='" . ($j + 1) . "' id='" . $options[$i] . "_" . ($j + 1) . "'></label>
                      </td>";
            }
            echo '<td>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo '</td>';

        }
        echo '</tr>';
        echo '</table>';
        ?>
        <script>
            function sub() {
                const selectedOptions = document.querySelectorAll(`input[class="answer"]:checked`);
                const s = Array.from(selectedOptions).map(option => option.id);
                var score = 0;

                for (var j = 0; j < <?php echo count($corr); ?>; j++) {
                    const selectedOptionId = s.find(optionId => optionId.endsWith(`_${j + 1}`));

                    if (selectedOptionId === `${<?php echo json_encode($corr); ?>[j]}_${j + 1}`) {
                        score = score + 1;
                    }
                }
                document.getElementById('score').value = score;
                return true;
            }
        </script>
        <form method="post" action="result1.php" onsubmit="return sub()">
            <input type="hidden" id="score" name="score" value="">
    </div>
    <br>
    <center><button type="submit" id="submit">Submit</button></center>
    </form>
</div>
</body>
</html>
