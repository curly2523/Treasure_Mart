<?php
include_once 'Config.php';
session_start();

$result = mysqli_query($con, "SELECT * FROM payment WHERE user='" . $_SESSION["id"] . "'");
$row = mysqli_fetch_array($result);
if (is_array($row)) {

    $cardno = $row["cardno"];
    $name = $row["name"];
    $date = $row["date"];
    $cvv = $row["cvv"];
} else {
    echo "<script>alert('No user found')</script>";
    echo "<script>setTimeout(\"location.href = '../html/login.html';\",700);</script>";
}

if (isset($_POST['edit'])) {

    $sql = "UPDATE payment SET cardno='" . $_POST['cardnumber'] . "', name='" . $_POST['cardname'] . "', date='" . $_POST['date'] . "' , cvv='" . $_POST['securitykey'] . "' WHERE user='" . $_SESSION['id'] . "'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Card Successfully Updated..')</script>";
        echo "<script>setTimeout(\"location.href = '../php/MyProfile.php';\",700);</script>";
        exit();
    } else {
        echo "SQL Error";
    }
}

if (isset($_POST['deleteCard'])) {

    $result = mysqli_query($con, "DELETE FROM payment WHERE user='" . $_SESSION["id"] . "'");
    if ($result) {
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
        <link rel="stylesheet" href="../css/updatecard.css">
        <link rel="stylesheet" href="../css/Header&Footer.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/Chamindu.js"></script>
        <script>
            $(function () {
                $("#header").load("../php/Header.php");
                $("#footer").load("Footer.html");
            });
        </script>
    </head>

    <div id="header"></div>

    <br>

    <body>
        <form method="POST">
            <div class="container">
                <center>
                    <h2>Card Details</h2>
                </center><br>
                <h1 style="color: rgb(240, 203, 157);">Edit card details</h1>

                <div class="payment">
                    <div class="row">
                        <img class="img" src="../image/visa.png" alt="">
                        <img class="img" src="../image/mastercard.png" alt="">
                        <img class="img" src="../image/amexnew.png" alt="">
                        <img class="img" src="../image/Discover.png">
                    </div>

                    <label for="cnum"><a class="a1"><b>Card number</b></a></label>
                    <input type="text" placeholder="Enter card number" name="cardnumber" maxlength="16" value="<?php echo $cardno ?>" required>

                    <label for="cname" for="psw"><a class="a1"><b>Name on card</b></a></label>
                    <input type="text" placeholder="Enter card name" name="cardname" value="<?php echo $name ?>" required>

                    <label for="date"><a class="a1"><b>Expiration date</b></a></label><br>
                    <input type="date" placeholder="Enter date of expiration" name="date" value="<?php echo $date ?>" required><br><br>

                    <label for="skey"><a class="a1"><b>CVV</b></a></label>
                    <input type="text" placeholder="Enter cvv number" name="securitykey" maxlength="3" value="<?php echo $cvv ?>" required>

                    <label>
                        <center> <input type="checkbox" checked="checked" name="save"><a class="a2">Save this card</a>
                        </center><br>
                        <div class="pcard">
                            <button type="submit" class="card card-1" name="edit"><b>Edit card</b></button><br><br>
                            <button class="card2 card-2" onclick="event.preventDefault();openConfirmationDialog()"><b>Detete card</b></button><br><br>
                        </div>



                    </label>
                </div>
            </div>

        </form>

        <div id="confirmationDialog" class="modal">
            <div class="modal-content">
                <h3>Confirm Deletion</h3>
                <p>Are you sure you want to delete?</p>
                <div class="button-container">
                    <button id="confirmDeleteButton" onclick="deleteCard()">Delete</button>
                    <button onclick="closeConfirmationDialog()">Cancel</button>
                </div>
            </div>
        </div>
        <br>


    </body>
    <br>
    <div id="footer"></div>

</html>