<?php
$handle = fopen(__DIR__ . "/input.txt", 'r');

$list1 = [];
$list2 = [];
while (($line = fgets($handle)) !== false) {
    $parts = explode('   ', $line, 2);
    $list1[] = (int) $parts[0];
    $list2[] = (int) $parts[1];
}

sort($list1);
sort($list2);

$part1 = [];
$part2 = [];
foreach($list1 as $key => $value) {
    $part1[] = abs($value - $list2[$key]);
    
    $part2[] = abs($value * count(array_filter($list2, fn ($val) => $val === $value)));
}

echo sprintf("Part 1: %d\n", array_sum($part1));
echo sprintf("Part 2: %d\n", array_sum($part2));