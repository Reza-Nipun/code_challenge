<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"  media="screen">
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>

        .ui-select{
            display: none;
        }

    </style>

    <title>Hello, world!</title>

</head>
<body>
<br />
<div class="container">
    <div class="form-row">
        <div class="col-md-3">
            <label for="select_customer"><b>Customer</b></label>
            <select class="form-control" id="select_customer" name="select_customer">
                <option value="">Select Customer</option>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="select_product"><b>Product</b></label>
            <select class="form-control" id="select_product" name="select_product">
                <option value="">Select Product</option>
                <option value="Product-1">Product-1</option>
                <option value="Product-2">Product-2</option>
            </select>
        </div>
        <div class="col-md-5">
            <label for=""><b>Price Range</b></label>

                <div data-role="rangeslider">
                    <input type="range" name="price-min" id="price-min" value="0" min="0" max="1000">
                    <input type="range" name="price-max" id="price-max" value="1000" min="0" max="1000">
                </div>
        </div>
        <div class="col-md-1">
            <br />
            <button class="btn btn-success" onclick="getFilterData();">Search</button>
        </div>
    </div>
    <br />
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>
</div>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>
</html>
<script type="text/javascript">
    $('select').select2();

    function getFilterData(){
        var customer = $("#select_customer").val();
        var product = $("#select_product").val();
        var min_price = $("#price-min").val();
        var max_price = $("#price-max").val();

        console.log(customer+' '+product+' '+min_price+' '+max_price);
    }
</script>