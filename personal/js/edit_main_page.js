var AddParagraph = false;
var AddImage = false;

function UserData(data) {
    if (data.my_surname == undefined || data.my_surname == "") {
        location.reload();
    }
};


function showAddParagraph() {
    if (AddParagraph) {
        $('.addParagraph').slideUp();
        AddParagraph = false;
    } else {
        $('.addParagraph').slideDown();
        AddParagraph = true;
    }
}

function showAddImage() {
    if (AddImage) {
        $('.addImage').slideUp();
        AddImage = false;
    } else {
        $('.addImage').slideDown();
        AddImage = true;
    }
}


$(document).ready(function () {
    $.ajax({
        url: "../personal/base/users_base.php",
        type: "POST",
        dataType: "json",
        success: UserData
    });

    $('.showAddParagraph').on('click', showAddParagraph);
    $('.showAddImage').on('click', showAddImage);
});