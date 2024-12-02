<?php
$handle = fopen(__DIR__ . "/input.txt", 'r');

$part1 = [];
$part2 = [];
function isSafe($parts) {
    $type = null;

    for ($index = 1; $index < count($parts); $index++) {
        $diff = $parts[$index] - $parts[$index - 1];

        // Determine if it's increasing or decreasing
        if ($type === null && $diff > 0) {
            $type = 'increase';
        }

        if($type === null && $diff < 0) {
            $type = 'decrease';
        }

        if ($diff === 0) {
            return false;
        }

        // Check if the sequence is valid
        if (($type === 'increase' && ($diff <= 0 || $diff > 3)) ||
            ($type === 'decrease' && ($diff >= 0 || $diff < -3))) {
            return false;
        }
    }

    return true;
}

while (($line = fgets($handle)) !== false) {
    $line = trim($line);
    $unsafeParts = [];
    $lastPart = null;
    $type = null;
    $hasBigDiff = false;
    $parts = array_map('intval', explode(' ', $line));

    if(isSafe($parts)) {
        $part1[] = $line;
        $part2[] = $line;
    } else {
        for ($i = 0; $i < count($parts); $i++) {
            $modifiedParts = $parts;
            array_splice($modifiedParts, $i, 1); // Remove the i-th element

            if (isSafe($modifiedParts)) {
                $part2[] = $line;
                break;
            }
        }
    }
}

echo sprintf("Part 1: %d\n", count($part1));
echo sprintf("Part 2: %d\n", count($part2));