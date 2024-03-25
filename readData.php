<?php


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
        $sql2 = 'SELECT "orderNumber",status,discount,"firstName","lastName",u."phoneNumber" ,x."createdAt",x."updatedAt" FROM public."order" x inner join public."user" u on x."userId" = u.id ';
        $sql2 .= " WHERE status NOT IN ('CANCEL','PREPARE_SHIPPING_FAIL')";
        $sql2 .= ' order by x."orderNumber" desc ';
        // where status NOT IN ("CANCEL") LIMIT 50
        $result = pg_query( $this->conn, $sql2);
        if (!$result) {  
            echo "An error occurred.\n"."<br>".$sql2;  
            exit;  
        }
        //Find Product_gift and pass to storeArray
        while ($row = pg_fetch_assoc($result)) {  
            
            // discout object 
            $disc = json_decode($row["discount"],false);
            $order_num = json_decode($row["orderNumber"]);
            $fname = $row["firstName"];
            $lname = $row["lastName"];
            $tel = $row["phoneNumber"];
            $status = $row["status"];
            $createdAt = $row["createdAt"];
            $updatedAt = $row["updatedAt"];


            // counter check data 
            $count = count((array)$disc)-1;

            // split_value
            if($count > 0 && isset($disc->promotions[0]->reward)){
                
                foreach($disc->promotions[0]->reward as $val){
                    $data = (array)$val;
                    if(isset($data["PRODUCT"])){
                        if(count($data["PRODUCT"])>0){
                            $item["orderNumber"] = $order_num;
                            $item["Status"] = $status;
                            $item["firstName"] = $fname;
                            $item["lastName"] = $lname;
                            $item["phoneNumber"] = $tel;
                            $item["sku"] = $data["PRODUCT"][0]->sku->sku;
                            $item["product_name"]  = $data["PRODUCT"][0]->sku->product->displayName;
                            $item["createdAt"]  = $createdAt ;
                            $item["updatedAt"]  = $updatedAt ;
                            
                            array_push($store,$item);
                        }
                    }
                }
            }
            
        }
        return $store;            
    }

}