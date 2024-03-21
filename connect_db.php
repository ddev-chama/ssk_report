<?php
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");

try {
    $conn=@pg_connect("host=postgres.staging.diamondgrains-internal.com port=6432 user=ro_report_campaign dbname=diamondgrains password=Fqb4ttsw5ysKX9Ry2WxuyRvJ4AdXv3eup6QXBNnkMAm3pY8qtvEWRaFyFgVq");
} Catch (Exception $e) {
    Echo $e->getMessage();
}

?>
