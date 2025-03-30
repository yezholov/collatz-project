<?php
include 'collatz_functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Conjecture</title>
</head>
<body>
    <h2>Collatz Conjecture Calculator</h2>
    <form method="GET">
        <label>Start Number:</label>
        <input type="number" name="start" required>
        <label>End Number:</label>
        <input type="number" name="end" required>
        <button type="submit">Calculate</button>
    </form>

    <?php
    if (isset($_GET["start"]) && isset($_GET["end"])) {
        $start = intval($_GET["start"]);
        $end = intval($_GET["end"]);

        if ($start > 0 && $end >= $start) {
            $collatz = new Collatz($start);
            $collatz->calculateRange($end);
            $stats = $collatz->getStatistics();
            $results = $collatz->getResults();
            

            echo "<h3>Collatz Results</h3>";
            echo "<p>Number with max iterations: <strong>{$stats['maxIterations']}</strong></p>";
            echo "<p>Number with min iterations: <strong>{$stats['minIterations']}</strong></p>";
            echo "<p>Number with highest value reached: <strong>{$stats['maxValue']}</strong></p>";

            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Value</th><th>Iterations</th><th>Sequence</th></tr>";
            foreach ($results as $num => $info) {
                echo "<tr>
                        <td>{$info['number']}</td>
                        <td>{$info['maxValue']}</td>
                        <td>{$info['iterations']}</td>
                        <td>{$info['sequence']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color: red;'>Invalid range. Ensure start > 0 and end >= start.</p>";
        }
    }
    ?>
</body>
</html>
