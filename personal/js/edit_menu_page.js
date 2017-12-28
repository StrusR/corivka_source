function UserData(data) {
    if (data.my_surname == undefined || data.my_surname == "") {
        location.reload();
    }
};




$(document).ready(function () {
    $.ajax({
        url: "../personal/base/users_base.php",
        type: "POST",
        dataType: "json",
        success: UserData
    });

    $('.ShowHide').on('click', function (e) {
        e.preventDefault();
        $('.ShowHideBlock').show().not($(this).data('rel')).hide();
    });
});