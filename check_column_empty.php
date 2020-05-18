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
        echo $data[$columnIndex] . "<br />\n";
        $result[] = $data[$columnIndex];
        if (empty($data[$columnIndex])) {
            $emptyColumn = true;
            echo "empty column at row $row";
        }
    }
    fclose($handle);
}
echo "scaned $row rows".PHP_EOL;
if (array_unique($result)) {
    echo "Data is unique".PHP_EOL;
} else {
    echo "Data is not unique".PHP_EOL;
}
if ($emptyColumn) {
    echo "has empty value";
} else {
    echo "no empty value";
}