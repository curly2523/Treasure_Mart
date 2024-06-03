<?php
include_once 'Config.php';
session_start();

if (isset($_POST['deleteCart'])) {
    $id = $_POST['id'];
    $sql = mysqli_query($con, "DELETE FROM cart WHERE id='$id'");
    if ($sql) {
        echo "success";
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
        <link rel="stylesheet" href="../css/My Cart.css">
        <link rel="stylesheet" href="../css/Header&Footer.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/Dileesha.js"></script>
        <script>
            $(function () {
                $("#header").load("../php/Header.php");
                $("#footer").load("../html/Footer.html");
            });

        </script>
    </head>

    <div id="header"></div>
    <br>
    <div class="container">
        <center>My Cart</center><br>
        <div class="">
            <table class="tablecart">
                <thead>
                    <tr class="bar">
                        <th class="center" width="30%" height="40px">Name</th>
                        <th class="center" width="10%">Qty</th>
                        <th class="center" width="10%">Unit Price</th>2
                        <th class="center" width="10%">Price</th>
                        <th class="center" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM cart WHERE user='" . $_SESSION["id"] . "' ORDER BY id ASC";
                    $result = mysqli_query($con, $sql);
                    $total = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td class="" height="70px"><img src="../uploads/<?php echo $row['image']; ?>" class="cart-image" /><?php echo $row['name']; ?></td>
                                <td class="center">
                                    <?php echo $row['qty']; ?>
                                </td>
                                <td class="center">
                                    <?php echo number_format($row['price'], 2); ?>
                                </td>
                                <td class="center">
                                    <?php echo number_format($row['qty'] * $row['price'], 2); ?>
                                </td>
                                <td class="center">
                                <div class="actionrow">
                                    <div class="pen">
                                        <a href ="../php/UpdateCart.php?id=<?php echo $row['id']; ?>"><img src="../image/pen.png" width="25" height="35"></a>
                                    </div>
                                    <div style="width:60px;">
                                        <button style="width:60px;" onclick="deletecart(<?php echo $row['id']; ?>)"><img type="button" class="img1" src="../image/delete.png"></button>
                                    </div>
                                </div>
                                </td>
                            </tr>
                        <?php $total += $row['qty'] * $row['price']; }
                    } ?></tbody>
            </table>
            
            <?php
            if ($result->num_rows == 0) {
                echo "<div class='center'>Cart is empty</div>";
            }
            else {
                echo "<div class='total'>Total " . number_format($total, 2) . " </div>";
            }
            ?>
            
        </div>

    </div>
    <br>
    
    <div id="footer"></div>

</html>