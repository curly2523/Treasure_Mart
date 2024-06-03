function deletecart(id) {
    $.ajax({
        url: window.location.href,
        type: "POST",
        data: { deleteCart: true, id: id },
        success: function (response) {
            response = response.trim();
            if (response === "success") {
                alert("Successfully Deleted the Item");
                setTimeout("location.href = '../php/My%20Cart.php';", 400);
            } else {
                alert("SQL Error");
            }
        },
        error: function () {
            alert("Javascript Error");
        }
    });
}

function addtocart() {
    var qty = document.getElementById("qty").value; 
    $.ajax({
        url: window.location.href,
        type: "POST",
        data: { addtoCart: true, qty: qty },
        success: function(response) {
            response = response.trim();
            if (response === "success") {
                alert("Successfully added to the cart");
                setTimeout("location.href = '../php/Shop.php';",400);
            } else {
                alert("SQL Error");
            }
        },
        error: function() {
            alert("Javascript Error");
        }
    });
}