<?php
$collatz_results = [];

function collatz_sequence($n) {
    $sequence = [$n];
    while ($n !== 1) {
        $n = ($n % 2 == 0) ? $n / 2 : 3 * $n + 1;
        $sequence[] = $n;
    }
    return implode(" ", $sequence);
}

function collatz_analysis($n) {
    global $collatz_results;
    $original = $n;
    $maxValue = $n;
    $iterations = 0;

    while ($n !== 1) {
        $n = ($n % 2 == 0) ? $n / 2 : 3 * $n + 1;
        $maxValue = max($maxValue, $n);
        $iterations++;
    }

    $collatz_results[$original] = [
        'maxValue' => $maxValue,
        'iterations' => $iterations,
        'sequence' => collatz_sequence($original)
    ];
}

function collatz_range($start, $end) {
    for ($i = $start; $i <= $end; $i++) {
        collatz_analysis($i);
    }
}

function find_extremes() {
    global $collatz_results;
    $maxIterNum = $minIterNum = $highestValueNum = null;
    $maxIterations = 0;
    $minIterations = PHP_INT_MAX;
    $highestValue = 0;

    foreach ($collatz_results as $num => $data) {
        if ($data['iterations'] > $maxIterations) {
            $maxIterations = $data['iterations'];
            $maxIterNum = $num;
        }
        if ($data['iterations'] < $minIterations) {
            $minIterations = $data['iterations'];
            $minIterNum = $num;
        }
        if ($data['maxValue'] > $highestValue) {
            $highestValue = $data['maxValue'];
            $highestValueNum = $num;
        }
    }

    return [
        'maxIterNum' => $maxIterNum,
        'minIterNum' => $minIterNum,
        'highestValueNum' => $highestValueNum
    ];
}

function print_results() {
    global $collatz_results;
    $extremes = find_extremes();

    echo "<h3>Collatz Results</h3>";
    echo "<p>Number with max iterations: <strong>{$extremes['maxIterNum']}</strong></p>";
    echo "<p>Number with min iterations: <strong>{$extremes['minIterNum']}</strong></p>";
    echo "<p>Number with highest value reached: <strong>{$extremes['highestValueNum']}</strong></p>";

    echo "<table>";
    echo "<tr><th>Number</th><th>Max Value</th><th>Iterations</th><th>Sequence</th></tr>";

    foreach ($collatz_results as $num => $info) {
        echo "<tr>
                <td>{$num}</td>
                <td>{$info['maxValue']}</td>
                <td>{$info['iterations']}</td>
                <td>{$info['sequence']}</td>
              </tr>";
    }
    echo "</table>";
}
?>
