<?php

include_once 'Config.php';

$result = mysqli_query($con,"SELECT * FROM cart WHERE id='" . $_GET["id"] . "'");
$row  = mysqli_fetch_array($result);
if(is_array($row)) {

    $id = $row["id"];
    $name = $row["name"];
    $price = $row["price"];
    $qty = $row["qty"];
    $image = $row["image"];
}

if (isset($_POST['updatecart'])) {
    $sql = mysqli_query($con, "UPDATE cart SET qty='" . $_POST['qty'] . "' WHERE id='" . $_POST['id'] . "'");
    
    if ($sql) {
        echo "<script>alert('Cart Successfully Updated..')</script>";
        echo "<script>setTimeout(\"location.href = '../php/My%20Cart.php';\",400);</script>";
        exit();
    } else {
        echo "error";
        exit();
    }
}

?>
<!DOCTYPE html>
<html>
<header>
    <head>
    <title>Treasure Mart</title>
    <link rel="stylesheet" href="../css/Product.css">
    <link rel="stylesheet" href="../css/Header&Footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery.min.js"></script>
    <script>
    $(function(){
        $("#header").load("../php/Header.php");
        $("#footer").load("../html/Footer.html");
    });
    </script>
</head>

<div id="header"></div>

<br>
<body>
    <div class="container">
        <form method="POST">
            <input type="number" style="display: none" value="<?php echo $id ?>" name="id">
            <img src="../uploads/<?php echo $image ?>">
            <div class="column">
                <lable  class="name">Product Name : <?php echo $name ?></lable>
                <lable class="name">Product Price : Rs. <?php echo $price ?></lable>
                <div class="row">
                    <label  for="qnt"><a class="name"><b>Quantity : &nbsp;</b></a></label>
                    <input type="number" id="qty" name="qty" class="quntity" value="<?php echo $qty ?>" required>
                </div>
                
            </div>
            <div class="row1">
                <button type="submit" name="updatecart" class="btn1 btn2 btn3">Update Cart</button>
            </div>
        </form>
        <br><br><br>
        <div class="des">
            <h3>Description</h3>
            <p>A product description is a form of marketing copy used to describe and explain the benefits of your product. In other words, it provides all the information and details of your product on your ecommerce site. These product details can be one sentence, a short paragraph or bulleted.</p>
        </div><br><br>
    </div>
</body>
<br>

<div id="footer"></div>
</html>