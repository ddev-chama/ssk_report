<?php
include('./connect_db.php');

$result = pg_query($conn, "SELECT * FROM public.order LIMIT 3");  
if (!$result) {  
 echo "An error occurred.\n";  
 exit;  
}  
while ($row = pg_fetch_row($result)) {  
 echo "value1: $row[3]  value2: $row[4]";  
 echo "<br />\n";  
}  

