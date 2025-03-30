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
            collatz_range($start, $end);
            print_results();
        } else {
            echo "<p style='color: red;'>Invalid range. Ensure start > 0 and end >= start.</p>";
        }
    }
    ?>
</body>
</html>
