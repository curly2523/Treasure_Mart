<?php
session_start();
?>
<div class="header">
<?php

    if (isset($_SESSION['email'])) {
        echo '<a href="../php/logout.php" class="btn-header btn-header-1">Logout</a>';
    } else {
        echo '<a href="../html/Login.html" class="btn-header btn-header-1">Login</a><br><br><br>';
        echo '<a href="../html/Registration.html" class="btn-header btn-header-2">Register</a>';
    }
    ?>
    <h3 class="h3-header">Treasure Mart</h3>
    <div class ="logoheader">
        <img src ="../logo/logo.png" width="120" height="120"/>
    </div>
    <h2 class="h2-header">Stay Home , Order Now.</h2>
    <div>
    <ul class="menu-header">
            <li class="menu-header"><a class="one-header" href ="../html/Home.html">Home</a></li>
            <?php
            if (isset($_SESSION['email'])) {
                echo '<li class="menu-header"><a class="one-header" href ="../php/Myprofile.php">My Account</a></li>';
            } else {
                echo '<li class="menu-header"><a class="one-header" href ="../html/Login.html">My Account</a></li>';
            }
            ?>          
            <li class="menu-header"><a class="one-header" href ="../php/Shop.php">Shop</a></li>
            <li class="menu-header"><a class="one-header" href ="../php/Add%20Item.php">Add Items</a></li>
            <li class="menu-header"><a class="one-header" href ="../php/My%20Cart.php">Cart</a></li>
            
    </ul>
    </div>
</div>