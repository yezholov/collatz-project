<?php

function collatz($l)
{
    echo "$l";
    while ($l !== 1) {
        if ($l % 2 == 0) {
            $l /= 2;
        } else {
            $l = $l * 3 + 1;
        }
        echo " $l";
    }
    echo "<br>";
}

for ($x = 1; $x <= 10; $x++) {
    echo "The number is: $x <br>";
    collatz($x);
}

echo "<br>";
echo "The number is: 123 <br>";
collatz(123);
?>