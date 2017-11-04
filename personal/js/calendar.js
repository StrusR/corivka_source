var url = document.location.href;
var ip = url.substring(url.lastIndexOf('ip=') + 3);
var year = url.substring(url.lastIndexOf('year=') + 5);
var moon = url.substring(url.lastIndexOf('moon=') + 5, url.lastIndexOf('moon=') + 7);

if (year < 2017 || year > 2030 || !isFinite(year) || moon < 1 || moon > 12) {
    location = "http://corivka.com.ua/personal/calendar.php";
}

function UserData(data) {
    if (data.my_surname == undefined || data.my_surname == "") {
        location.reload();
    }
    var my_access_rights;
    if (data.my_access_rights == 1) {
        my_access_rights = "(Директор)";
        $(".edit_graph").show();
    } else if (data.my_access_rights == 2) {
        my_access_rights = "(Адміністратор)";
        $(".edit_graph").show();
    } else {
        my_access_rights = "(Працівник)";
        $(".edit_graph").hide();
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

function editYear() {
    year = $(".year").val();
    location = "http://corivka.com.ua/personal/calendar.php?moon=" + moon + "&year=" + year;
}

function editMoon() {
    moon = $(".moon").val();
    location = "http://corivka.com.ua/personal/calendar.php?moon=" + moon + "&year=" + year;
}

function selectedMoonYear() {
    $(".year [value='" + year + "']").attr("selected", "selected");
    $(".moon [value='" + moon + "']").attr("selected", "selected");
}

function clear_moon() {
    var assured = confirm("Ви впевнені, що хочете очистити місяць?\nДані резервації будуть збережені!");
    if (assured) {
        var days_in_moon = 33 - new Date(year, moon - 1, 33).getDate();
        var days = [];
        $.ajax({
            url: "../personal/base/calendar_base.php",
            type: "POST",
            dataType: "json",
            data: ({
                days_in_moon: days_in_moon,
                moon: moon,
                year: year,
                days: days
            }),
            success: reloadWindow
        });
    }
}

function send_new_graph() {
    var days_in_moon = 33 - new Date(year, moon - 1, 33).getDate();
    var days = [];
    for (var i = 1; i < days_in_moon + 1; i++) {
        var employers = $("#emp" + i).val();
        days[i - 1] = employers;

    }
    $.ajax({
        url: "../personal/base/calendar_base.php",
        type: "POST",
        dataType: "json",
        data: ({
            days_in_moon: days_in_moon,
            moon: moon,
            year: year,
            days: days
        }),
        success: reloadWindow
    });
}

function cancel_graph() {
    var assured = confirm("Ви впевнені, що хочете скасувати редагування?\nГрафік не буде збережено!");
    if (assured) {
        reloadWindow();
    }
}

function reloadWindow() {
    location.reload();
}

function edit_graph() {
    $(".edit_graph").hide();
    $(".save_graph").show();
    $(".clear_moon").show();
    $(".cancel_graph").show();
    $(".selected_users").hide();
    $(".select_users").show();
}

function save_graph() {
    $(".edit_graph").show();
    $(".save_graph").hide();
    $(".clear_moon").hide();
    $(".cancel_graph").hide();
    $(".selected_users").show();
    $(".select_users").hide();
    send_new_graph();
}



$(document).ready(function () {
    selectedMoonYear();
    $(".year").change(editYear);
    $(".moon").change(editMoon);
    $(".edit_graph").on("click", edit_graph);
    $(".save_graph").on("click", save_graph);
    $(".clear_moon").on("click", clear_moon);
    $(".cancel_graph").on("click", cancel_graph);
});