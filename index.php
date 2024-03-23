<?php
include('./readData.php');
$report = new Report;
$result = $report->read_Product();

echo "<pre>";
print_r($result);