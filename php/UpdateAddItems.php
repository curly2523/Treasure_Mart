<?php
include_once 'Config.php';
$currentScriptPath = $_SERVER['SCRIPT_NAME'];
$subdirectory = rtrim(dirname(dirname($currentScriptPath)), '/\\');
$fileName = isset($_FILES["file"]["name"]) ? basename($_FILES["file"]["name"]) : "";
$targetDir = $_SERVER['DOCUMENT_ROOT'] . $subdirectory . "/uploads/";
$targetFilePath = $targetDir . $fileName;

$result = mysqli_query($con,"SELECT * FROM shop WHERE id='" . $_GET["id"] . "'");
$row  = mysqli_fetch_array($result);
if(is_array($row)) {

   $itemname = $row["name"];
   $price = $row["price"];
   $rating = $row["rating"];
} 
else {
    echo "<script>alert('No user found')</script>";
    echo "<script>setTimeout(\"location.href = '../html/login.html';\",700);</script>";
}

if (isset($_POST['update'])) {

  if(!empty($fileName) && move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $sql = "UPDATE shop SET name='$name', price='" . $_POST['price'] . "', rating='" . $_POST['rating'] . "' , image='$fileName' WHERE id='" . $_GET['id'] . "'";
    
    if ($con->query($sql) === TRUE) 
    {
      echo "<script>alert('Item Successfully Updated..')</script>";
      echo "<script>setTimeout(\"location.href = '../php/Shop.php';\",700);</script>";
      exit();
    }
    else
    {
      echo "SQL Error";
    }
  }else{
      
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $sql = "UPDATE shop SET name='$name', price='" . $_POST['price'] . "', rating='" . $_POST['rating'] . "' WHERE id='" . $_GET['id'] . "'";
    
    if ($con->query($sql) === TRUE) 
    {
      echo "<script>alert('Item Successfully Updated..')</script>";
      echo "<script>setTimeout(\"location.href = '../php/Shop.php';\",700);</script>";
      exit();
    }
    else
    {
      echo "SQL Error";
    }
  }

}

if (isset($_POST['deleteItem'])) {

  $result = mysqli_query($con, "DELETE FROM shop WHERE id='" . $_GET["id"] . "'");
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
    <link rel="stylesheet" href="../css/UpdateAddItems.css">
    <link rel="stylesheet" href="../css/Header&Footer.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/Nethmi.js"></script>
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
    <center class="h1">Edit Item</center><br><br><br><br><br><br>
    <div class="add">
      <form method="POST" enctype="multipart/form-data">
            <label for="iname" ><a class="a1"><b>Item Name</b></a></label>
            <input type="text" placeholder="Enter Item Name" name="name" value="<?php echo $itemname ?>" required><br>

            <label for="iprice"><a class="a1"><b>Item Price</b></a></label>
            <input type="text" placeholder="Enter Item Price" name="price" value="<?php echo $price ?>" required><br>

            <label for="irate" ><a class="a1"><b>Item Ratings</b></a></label>
            <input type="number" placeholder="Enter Item Ratings" name="rating" value="<?php echo $rating ?>" min="1" max="5" required><br><br>

            <label for="iimage"><a class="a1"><b>Item Picture</b></a></label>
            <input type="file" id="file" name="file" accept="image/jpg, image/png, image/jpeg"><br><br><br><br>
            
            <div class="pcard">
                <button type="submit" class="card card-1" name="update"><b>Update</b></button><br><br>
                <button class="card2 card-2" name="delete" onclick="event.preventDefault();openConfirmationDialog()"><b>Detete Item</b></button><br><br>
            </div>
      </form>
      
      <div id="confirmationDialog" class="modal">
        <div class="modal-content">
            <h3>Confirm Deletion</h3>
            <p>Are you sure you want to delete?</p>
            <div class="button-container">
            <button id="confirmDeleteButton" onclick="deleteItem()">Delete</button>
            <button onclick="closeConfirmationDialog()">Cancel</button>
            </div>
        </div>
      </div>
    </div>
</div>
<br>

<div id="footer"></div>
</html>
<!--End Footer-->