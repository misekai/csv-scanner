<?php

$filename = $argv[1];
$column = $argv[2];
$row = 0;
$emptyColumn = false;
$columnIndex = null;
$result = [];
if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
        $row++;
        if ($row === 1) {
            $columnIndex = array_keys($data, $column)[0];
            continue;
        }
        if (!empty($data[$columnIndex])) {
            echo basename($data[$columnIndex]) . "($data[$columnIndex])" .  PHP_EOL;
            $result[] = basename($data[$columnIndex]);
        }
    }
    fclose($handle);
}
echo "scaned $row rows".PHP_EOL;
if (count(array_unique($result)) === count($result)) {
    echo "Data is unique".PHP_EOL;
} else {
    echo "Data is not unique".PHP_EOL;
}
echo sprintf("There are %d rows have data", count($result));
echo PHP_EOL;
echo sprintf("There are %d rows have unique data", count(array_unique($result)));