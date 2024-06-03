
function openConfirmationDialog() {
    document.getElementById("confirmationDialog").style.display = "block";
}

function closeConfirmationDialog() {
    document.getElementById("confirmationDialog").style.display = "none";
}

function deleteAcc() {
    $.ajax({
        url: window.location.href,
        type: "POST",
        data: { deleteAccount: true },
        success: function (response) {
            if (response === "success") {
                closeConfirmationDialog();
                window.location.href = "logout.php";
            } else {
                alert("Error deleting account");
            }
        },
        error: function () {
            alert("Error deleting account");
        }
    });
}