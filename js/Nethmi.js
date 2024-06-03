function openConfirmationDialog() {
    document.getElementById("confirmationDialog").style.display = "block";
}

function closeConfirmationDialog() {
    document.getElementById("confirmationDialog").style.display = "none";
}

function deleteItem() {
    $.ajax({
        url: window.location.href,
        type: "POST",
        data: { deleteItem: true },
        success: function(response) {
            if (response === "success") {
                closeConfirmationDialog();
                window.location.href = "Shop.php";
            } else {
                alert("Error deleting item");
            }
        },
        error: function() {
            alert("Error deleting item");
        }
    });
}