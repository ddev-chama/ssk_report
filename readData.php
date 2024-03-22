<?php

use function PHPSTORM_META\type;

include("./connect_db.php");   

Class Report {
    protected $conn;
    protected $result;

    function __construct()
    {
        function exception_error_handler($errno, $errstr, $errfile, $errline ) {
            throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
        }
        set_error_handler("exception_error_handler");
        
        try {
            $this->conn=@pg_connect("host=postgres.staging.diamondgrains-internal.com port=6432 user=ro_report_campaign dbname=diamondgrains password=Fqb4ttsw5ysKX9Ry2WxuyRvJ4AdXv3eup6QXBNnkMAm3pY8qtvEWRaFyFgVq");
        } Catch (Exception $e) {
            Echo $e->getMessage();
        }
    }    
    
    function read_Product(){

        $store = array();

        // query
        $sql = 'SELECT * FROM public."order" x inner join public."user" u on x."userId" = u.id ';
        $sql .= " WHERE status NOT IN ('CANCEL') LIMIT 50";
        // where status NOT IN ("CANCEL") LIMIT 50
        $result = pg_query( $this->conn, $sql);
        if (!$result) {  
            echo "An error occurred.\n"."<br>".$sql;  
            exit;  
        }

        //Find Product_gift and pass to storeArray
        while ($row = pg_fetch_assoc($result)) {  
            
            echo "<pre>\n";  
            
            // discout object 
            $disc = json_decode($row["discount"],false);
            $order_num = json_decode($row["orderNumber"]);
            $name = json_decode($row["firstName"]);
            $tel = json_decode($row["phoneNumber"]);

            $count = count((array)$disc)-1;

            // split_value
            if($count > 0 && isset($disc->promotions[0]->reward)){
                
                foreach($disc->promotions[0]->reward as $val){
                    $data = (array)$val;
                    if(isset($data["PRODUCT"])){
                        if(count($data["PRODUCT"])>0){
                            $item["orderNumber"] = $order_num;
                            $item["firstName"] = $name;
                            $item["orderNumber"] = $tel;
                            $item["sku"] = $data["PRODUCT"][0]->sku->sku;
                            $item["product_name"]  = $data["PRODUCT"][0]->sku->product->displayName;
                            $item["createdAt"]  = $data["PRODUCT"][0]->sku->createdAt;
                            $item["updatedAt"]  = $data["PRODUCT"][0]->sku->updatedAt;
                            
                            array_push($store,$item);
                        }
                    }
                }
            }
            
        }
        print_r($store);            
    }
}