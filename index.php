<?php

require_once('./db_connect.php');

// Return name of current default database
$customer_result = $mysqli -> query("SELECT * FROM tb_customer");
$product_result = $mysqli -> query("SELECT * FROM tb_product_list");

$where = '';

if(isset($_POST['submit_btn'])){
    
    $customer = $_POST['select_customer'];
    $product = $_POST['select_product'];
    $price_min = $_POST['price_min'];
    $price_max = $_POST['price_max'];

    if($customer != ''){
        $where .= " AND t1.customer_id='$customer'";
    }

    if($product != ''){
        $where .= " AND t1.product_id='$product'";
    }

    if($price_min != '' && $price_max != '' && $price_max >= $price_min){
        $where .= " AND t1.product_price BETWEEN '$price_min' AND '$price_max'";
    }

}

$sale_result = $mysqli -> query("SELECT t1.*, t2.customer_name, t2.customer_mail, t3.product_name
                                    
                                    FROM `tb_sale` AS t1

                                    LEFT JOIN
                                    `tb_customer` AS t2
                                    ON t1.customer_id=t2.id
                                    LEFT JOIN
                                    `tb_product_list` AS t3
                                    ON t1.product_id=t3.id
                                    
                                    WHERE 1 $where");

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <title>Book Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<br />
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <div class="form-row">
        <div class="col-md-3">
            <label for="select_customer"><b>Customer</b></label>
            <select class="form-control" id="select_customer" name="select_customer">
                <option value="">Select Customer</option>

                <?php
                    while($customer_row = mysqli_fetch_assoc($customer_result)){
                ?>

                    <option value="<?php echo $customer_row['id'];?>"><?php echo $customer_row['customer_name'].' ~ '.$customer_row['customer_mail'];?></option>
                
                <?php 
                    } 
                ?>

            </select>
        </div>
        <div class="col-md-3">
            <label for="select_product"><b>Product</b></label>
            <select class="form-control" id="select_product" name="select_product">
                <option value="">Select Product</option>
                <?php
                    while($product_row = mysqli_fetch_assoc($product_result)){
                ?>

                    <option value="<?php echo $product_row['id'];?>"><?php echo $product_row['product_name'];?></option>
                
                <?php 
                    } 
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for=""><b>Price Range</b></label>

                <div data-role="rangeslider">
                    <input type="number" name="price_min" id="price_min" value="0" min="0" max="1000" style="width: 120px;">
                    <input type="number" name="price_max" id="price_max" value="10000" min="0" max="10000" style="width: 120px;">
                </div>
        </div>
        <div class="col-md-1">
            <br />
            <button type="submit" class="btn btn-success" name="submit_btn" id="submit_btn">Search</button>
        </div>
        <div class="col-md-2">
            <br />
            <a class="btn btn-warning" href="./read_json_data.php">READ JSON DATA</a>
        </div>
    </div>
    </form>
    
    <table class="table table-bordered mt-5" style="margin-top: 80px;">
        <thead>
            <tr>
                <th scope="col" class="text-center">Sale ID</th>
                <th scope="col" class="text-center">Customer Name</th>
                <th scope="col" class="text-center">Customer Mail</th>
                <th scope="col" class="text-center">Product Name</th>
                <th scope="col" class="text-center">Product Price</th>
                <th scope="col" class="text-center">Sale Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total_product_price=0;
                $sale_count = mysqli_num_rows($sale_result);

                if($sale_count > 0){

                while($sale_row = mysqli_fetch_assoc($sale_result)){
            ?>
                <tr>
                    <td class="text-center"><?php echo $sale_row['id'];?></td>
                    <td class="text-center"><?php echo $sale_row['customer_name'];?></td>
                    <td class="text-center"><?php echo $sale_row['customer_mail'];?></td>
                    <td class="text-center"><?php echo $sale_row['product_name'];?></td>
                    <td class="text-center"><?php echo $sale_row['product_price'];?></td>
                    <td class="text-center"><?php echo $sale_row['sale_date'];?></td>
                </tr>
            <?php

                $total_product_price += $sale_row['product_price'];
                }
            }else{ ?>
                <tr>
                    <td class="text-center" colspan="6">No Data Found!</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <th colspan="4" class="text-right"><h4>Total Price</h4></th>
            <th class="text-center"><h4><?php echo $total_product_price;?></h4></th>
            <th></th>
        </tfoot>
    </table>
        
</div>

</body>
</html>