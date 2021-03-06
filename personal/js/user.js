var url = document.location.href;
var ip = url.substring(url.lastIndexOf('ip=') + 3);

function UserData(json_data) {
    if (json_data.ip == undefined) {
        location = "https://corivka.com.ua:443/personal/user.php";
    } else {
        information_output(json_data);
    }
};


function information_output(data) {
    if (data.my_surname == undefined || data.my_surname == "") {
        location.reload();
    }
    var access_rights;
    if (data.access_rights == 1) {
        $(".edit_access_rights_button").hide();
        $(".delete_user_button").hide();
    } else if (data.access_rights == 2) {
        $(".edit_access_rights_button").html("Забрати права адміністратора");
        $(".edit_access_rights_button").removeClass("edit_access_rights_button_to_provide").addClass("edit_access_rights_button_take");
        $(".delete_user_button").show();
    } else {
        $(".edit_access_rights_button").show();
        $(".edit_access_rights_button").html("Надати права адміністратора");
        $(".edit_access_rights_button").removeClass("edit_access_rights_button_take").addClass("edit_access_rights_button_to_provide");
        $(".delete_user_button").show();
    }
};


function edit_admin_base() {
    $.ajax({
        url: "../personal/base/edit_admin_base.php",
        type: "POST",
        data: ({
            ip: ip
        }),
        success: Information
    });
}

function delete_user_base() {
    var assured = confirm("Ви впевнені, що хочете видалити цього працівника?");
    if (assured) {
        var pas = prompt('Введіть пароль');
        if (pas) {
            $.ajax({
                url: "../personal/base/delete_user_base.php",
                type: "POST",
                dataType: "json",
                data: ({
                    ip: ip,
                    password: pas
                }),
                success: InformationAboutDeleteUser
            });
        }
    }
}

function InformationAboutDeleteUser(json_data) {
    if (json_data.password) {
        alert("Аккаунт працівника видалено успішно");
        Information()
    } else {
        alert("Ви ввели не правильний пароль");
    }
}

function Information() {
    $.ajax({
        url: "../personal/base/user_base.php",
        type: "POST",
        dataType: "json",
        data: ({
            ip: ip
        }),
        success: UserData
    });
}




$(document).ready(function () {
    Information();
    $(".edit_access_rights_button").bind("click", edit_admin_base);
    $(".delete_user_button").bind("click", delete_user_base);
});