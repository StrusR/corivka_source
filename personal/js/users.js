var url = document.location.href;
var ip = url.substring(url.lastIndexOf('ip=') + 3);

function UserData(data) {
    if (data.my_surname == undefined || data.my_surname == "") {
        location.reload();
    }
    var my_access_rights;
    if (data.my_access_rights == 1) {
        my_access_rights = "(Директор)";
    } else if (data.my_access_rights == 2) {
        my_access_rights = "(Адміністратор)";
    } else {
        my_access_rights = "(Працівник)";
    }

    $(".my_snp").html(data.my_surname + " " + data.my_name + " " + data.my_patronymic + " " + my_access_rights);
    $(".my_snp").attr("href", "http://corivka.com.ua/personal/user.php?ip=" + data.my_ip);
};


$.ajax({
    url: "../personal/base/users_base.php",
    type: "POST",
    dataType: "json",
    success: UserData
});