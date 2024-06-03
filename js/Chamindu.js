function openConfirmationDialog() {
    document.getElementById("confirmationDialog").style.display = "block";
}

function closeConfirmationDialog() {
    document.getElementById("confirmationDialog").style.display = "none";
}

function deleteCard() {
    $.ajax({
        url: window.location.href,
        type: "POST",
        data: { deleteCard: true },
        success: function (response) {
            if (response === "success") {
                closeConfirmationDialog();
                window.location.href = "MyProfile.php";
            } else {
                alert("Error deleting card");
            }
        },
        error: function () {
            alert("Error deleting card");
        }
    });
}