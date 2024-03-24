<?php
include('./readData.php');
$report = new Report;
$data = $report->read_Product();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product Gift</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
</head>
<body>
    <table class="table table-striped report">
        <thead>
            <tr>
                <th scope="col">orderNumber</th>
                <th scope="col">Status</th>
                <th scope="col">firstName</th>
                <th scope="col">lastName</th>
                <th scope="col">phoneNumber</th>
                <th scope="col">sku</th>
                <th scope="col">product_name</th>
                <th scope="col">createdAt</th>
                <th scope="col">updatedAt</th>
            </tr>
        </thead>
        <tbody>
           <?php
                foreach($data as $val){

                    ?>
                <tr>
                    <td><?=$val['orderNumber']?></td>
                    <td><?=$val['Status']?></td>
                    <td><?=$val['firstName']?></td>
                    <td><?=$val['lastName']?></td>
                    <td><?=$val['phoneNumber']?></td>
                    <td><?=$val['sku']?></td>
                    <td><?=$val['product_name']?></td>
                    <td><?=$val['createdAt']?></td>
                    <td><?=$val['updatedAt']?></td>
                </tr>
                    <?php

                }
           ?>
           
        </tbody>
    </table>
</body>
</html>
<script>
    new DataTable('.report',{
        order: [[8, 'desc']]
    });
</script>