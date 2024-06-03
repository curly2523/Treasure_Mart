<?php
include_once 'Config.php';
$currentScriptPath = $_SERVER['SCRIPT_NAME'];
$subdirectory = rtrim(dirname(dirname($currentScriptPath)), '/\\');
$fileName = isset($_FILES["file"]["name"]) ? basename($_FILES["file"]["name"]) : "";
$targetDir = $_SERVER['DOCUMENT_ROOT'] . $subdirectory . "/uploads/";
$targetFilePath = $targetDir . $fileName;

if (isset($_POST['add'])) {
  if(!empty($fileName) && move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $sql = mysqli_query($con, "INSERT INTO shop (name , price , rating , image) VALUES ('$name','" . $_POST['price'] . "','" . $_POST['rating'] . "','".$fileName."')");
    if ($sql) {
      echo "<script>alert('Item Successfully Added..')</script>";
      echo "<script>setTimeout(\"location.href = '../php/Shop.php';\",700);</script>";
        exit();
    } else {
        echo "error";
        exit();
    }
  }
}

?>

<!DOCTYPE html>
<html>
<header>
    <head>
    <title>Treasure Mart</title>
    <link rel="stylesheet" href="../css/Add item.css">
    <link rel="stylesheet" href="../css/Header&Footer.css">
    <script src="../js/jquery.min.js"></script>
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
    <center class="h1">Add New Item</center><br><br><br>
    <div class="add">
      <form method="POST" enctype="multipart/form-data">
            <label for="iname" ><a class="a1"><b>Item Name</b></a></label>
            <input type="text" placeholder="Enter Item Name" name="name" required><br>

            <label for="iprice"><a class="a1"><b>Item Price</b></a></label>
            <input type="text" placeholder="Enter Item Price" name="price" required><br>

            <label for="irate" ><a class="a1"><b>Item Ratings</b></a></label>
            <input type="number" placeholder="Enter Item Ratings" name="rating" min="1" max="5" required><br><br>

            <label for="iimage"><a class="a1"><b>Item Picture</b></a></label>
            <input type="file" id="file" name="file" accept="image/jpg, image/png, image/jpeg"><br><br><br><br>
            
            <button type="submit" name="add" class="btn btn-1"><b>Add Item</b></button>
      </form>
    </div>
</div>
<br>

<div id="footer"></div>
</html>
<!--End Footer-->