<?php
include('./readData.php');
$report = new Report;
$report->read_Product();

// $result = pg_query($conn, "SELECT * FROM public.order WHERE status IN ('DELIVERED','ON_DELIVERING','PAYMENT_SUCCESS','PAYMENT_SUCCESS	','PREPARE_SHIPPING') LIMIT 1");  
// if (!$result) {  
//  echo "An error occurred.\n";  
//  exit;  
// }  
// $arr = array();

// }  

//value2: $row[4]