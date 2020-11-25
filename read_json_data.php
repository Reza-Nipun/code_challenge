<?php
echo '<h1><a href="./index.php"> <<< GO Back</a></h1>';

require_once('./db_connect.php');

$string = file_get_contents("./Code Challenge (DEV_Sales_full).json");
if ($string === false) {
    // deal with error...

    echo 'No File Found!';
}

$json_a = json_decode($string, true);

echo '<pre>';
print_r($json_a);
echo '</pre>';

if ($json_a === null) {
    // deal with error...

    echo 'No Data Found!';
}

// Customer & Product Master Data Parsing Start

foreach ($json_a as $k => $v) {
    $sale_id = $v['sale_id'];
    $customer_name = $mysqli -> real_escape_string($v['customer_name']);
    $customer_mail = $mysqli -> real_escape_string($v['customer_mail']);
    $product_id = $v['product_id'];
    $product_name = $mysqli -> real_escape_string($v['product_name']);
    $product_price = $v['product_price'];
    $sale_date = $v['sale_date'];
    $version = $v['version'];

    // Customer Insertion Start
    $customer_result = $mysqli -> query("SELECT * FROM tb_customer WHERE customer_mail='$customer_mail'");
    $customer_count = mysqli_num_rows($customer_result);

    if($customer_count == 0){
        $mysqli -> query("INSERT INTO tb_customer (customer_name, customer_mail) 
                          VALUES ('$customer_name', '$customer_mail')");
    }    
    // Customer Insertion End


    // Product Insertion Start
    $product_result = $mysqli -> query("SELECT * FROM tb_product_list WHERE id='$product_id'");
    $product_count = mysqli_num_rows($product_result);
        
    if($product_count == 0){
        $mysqli -> query("INSERT INTO tb_product_list (product_name) 
                          VALUES ('$product_name')");
    }   
    // Product Insertion End

}
// Customer & Product Master Data Parsing End

// Sale Data Parsing Start
foreach ($json_a as $k_s => $v_s) {
    $sale_ids = $v_s['sale_id'];
    $customer_names = $mysqli -> real_escape_string($v_s['customer_name']);
    $customer_mails = $mysqli -> real_escape_string($v_s['customer_mail']);
    $product_ids = $v_s['product_id'];
    $product_names = $mysqli -> real_escape_string($v_s['product_name']);
    $product_prices = $v_s['product_price'];
    $sale_dates = $v_s['sale_date'];
    $versions = $v_s['version'];

    // Get Customer Info Start
    $customer_info_result = $mysqli -> query("SELECT * FROM tb_customer WHERE customer_mail='$customer_mails'");
    $customer_info = mysqli_fetch_row($customer_info_result);
    $customer_ids = $customer_info[0]['id'];
    // Get Customer Info End


    // Sale Info Insertion Start
    $sale_result = $mysqli -> query("SELECT * FROM tb_sale WHERE id='$sale_ids'");
    $sale_count = mysqli_num_rows($sale_result);
            

    if($sale_count == 0){
        $mysqli -> query("INSERT INTO tb_sale (customer_id, product_id, product_price, sale_date, version) 
                          VALUES ('$customer_ids', '$product_ids', '$product_prices', '$sale_dates', '$versions')");
    }   
    // Sale Info Insertion End
}
// Sale Data Parsing End

echo "<h1 style='color: WHITE; background-color: GREEN;'>JSON DATA READING AND SAVING TO DATABASE IS SUCCESSFUL! </h1><br />";
echo '<h1><a href="./index.php"> <<< GO Back</a></h1>';
?>