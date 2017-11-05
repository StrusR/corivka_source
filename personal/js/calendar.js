var url = document.location.href;
var ip = url.substring(url.lastIndexOf('ip=') + 3);
var year = url.substring(url.lastIndexOf('year=') + 5);
var month = url.substring(url.lastIndexOf('month=') + 6, url.lastIndexOf('month=') + 8);

if (year < 2017 || year > 2030 || !isFinite(year) || month < 1 || month > 12) {
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
    location = "http://corivka.com.ua/personal/calendar.php?month=" + month + "&year=" + year;
}

function editMonth() {
    month = $(".month").val();
    location = "http://corivka.com.ua/personal/calendar.php?month=" + month + "&year=" + year;
}

function selectedMonthYear() {
    $(".year [value='" + year + "']").attr("selected", "selected");
    $(".month [value='" + month + "']").attr("selected", "selected");
}

function clear_month() {
    var assured = confirm("Ви впевнені, що хочете очистити місяць?\nДані резервації будуть збережені!");
    if (assured) {
        var days_in_month = 33 - new Date(year, month - 1, 33).getDate();
        var days = [];
        $.ajax({
            url: "../personal/base/calendar_base.php",
            type: "POST",
            dataType: "json",
            data: ({
                days_in_month: days_in_month,
                month: month,
                year: year,
                days: days
            }),
            success: reloadWindow
        });
    }
}

function send_new_graph() {
    var days_in_month = 33 - new Date(year, month - 1, 33).getDate();
    var days = [];
    for (var i = 1; i < days_in_month + 1; i++) {
        var employers = $("#emp" + i).val();
        days[i - 1] = employers;

    }
    $.ajax({
        url: "../personal/base/calendar_base.php",
        type: "POST",
        dataType: "json",
        data: ({
            days_in_month: days_in_month,
            month: month,
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
    $(".clear_month").show();
    $(".cancel_graph").show();
    $(".selected_users").hide();
    $(".select_users").show();
}

function save_graph() {
    $(".edit_graph").show();
    $(".save_graph").hide();
    $(".clear_month").hide();
    $(".cancel_graph").hide();
    $(".selected_users").show();
    $(".select_users").hide();
    send_new_graph();
}



$(document).ready(function () {
    selectedMonthYear();
    $(".year").change(editYear);
    $(".month").change(editMonth);
    $(".edit_graph").on("click", edit_graph);
    $(".save_graph").on("click", save_graph);
    $(".clear_month").on("click", clear_month);
    $(".cancel_graph").on("click", cancel_graph);
});