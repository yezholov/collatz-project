<?php

class Collatz {
    private $startNumber;
    private $results = [];

    public function __construct($startNumber) {
        $this->startNumber = $startNumber;
    }

    public function calculateCollatz($number) {
        $maxValue = $number;
        $iterations = 0;

        $sequence = [$number];

        while ($number !== 1) {
            if ($number % 2 == 0) {
                $number /= 2;
            } else {
                $number = $number * 3 + 1;
            }
            $sequence[] = $number;
            $maxValue = max($maxValue, $number);
            $iterations++;
        }
        return [
            'number' => $sequence[0],
            'maxValue' => $maxValue,
            'iterations' => $iterations,
            'sequence' => implode(" → ", $sequence)
        ];
    }

    public function calculateRange($end) {
        $this->results = [];
        for ($i = $this -> startNumber; $i <= $end; $i++) {
            $this->results[$i] = $this->calculateCollatz($i);
        }
    }

    public function getStatistics() {
        if (empty($this->results)) return null;

        $maxIterations = max(array_column($this->results, 'iterations'));
        $minIterations = min(array_column($this->results, 'iterations'));
        $maxValue = max(array_column($this->results, 'maxValue'));


        $maxIterationNum = null;
        $minIterationNum = null;
        $maxValueNum = null;
        foreach ($this->results as $key => $value) {
            if ($value['iterations'] == $maxIterations && $maxIterationNum == null) {
                $maxIterationNum = $key;
            }
            if ($value['iterations'] == $minIterations && $minIterationNum == null) {
                $minIterationNum = $key;
            }
            if ($value['maxValue'] == $maxValue && $maxValueNum == null) {
                $maxValueNum = $key;
            }
        }

        return [
            'maxIterations' => $maxIterationNum,
            'minIterations' => $minIterationNum,
            'maxValue' => $maxValueNum
        ];
    }

    public function getResults() {
        return $this->results;
    }
}
?>
