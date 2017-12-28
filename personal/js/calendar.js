var url = document.location.href;
var ip = url.substring(url.lastIndexOf('ip=') + 3);
var year = url.substring(url.lastIndexOf('year=') + 5);
var month = url.substring(url.lastIndexOf('month=') + 6, url.lastIndexOf('month=') + 8);

if (year < 2017 || year > 2030 || !isFinite(year) || month < 1 || month > 12) {
    location = "https://corivka.com.ua/personal/calendar.php";
}

function UserData(data) {
    if (data.my_surname == undefined || data.my_surname == "") {
        location.reload();
    }
    if (data.my_access_rights == 1) {
        $(".edit_graph").show();
        $(".weekend").hide();
        $(".lweekend").hide();
    } else if (data.my_access_rights == 2) {
        $(".edit_graph").show();
        $(".weekend").hide();
        $(".lweekend").hide();
    } else {
        $(".edit_graph").hide();
        $(".weekend").show();
        $(".lweekend").show();
    }

};


$.ajax({
    url: "../personal/base/users_base.php",
    type: "POST",
    dataType: "json",
    success: UserData
});

function editYear() {
    year = $(".selectYear").val();
    location = "https://corivka.com.ua/personal/calendar.php?month=" + month + "&year=" + year;
}

function editMonth() {
    month = $(".selectMonth").val();
    location = "https://corivka.com.ua/personal/calendar.php?month=" + month + "&year=" + year;
}

function selectedMonthYear() {
    $(".selectYear [value='" + year + "']").attr("selected", "selected");
    $(".selectMonth [value='" + month + "']").attr("selected", "selected");
}


function clear_month() {
    var assured = confirm("Ви впевнені, що хочете очистити місяць?");
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
    var assured = confirm("Ви впевнені, що хочете скасувати редагування?\nЗміни не буде збережено!");
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
    $(".print").hide();
}

function save_graph() {
    $(".edit_graph").show();
    $(".save_graph").hide();
    $(".clear_month").hide();
    $(".cancel_graph").hide();
    $(".selected_users").show();
    $(".select_users").hide();
    $(".print").show();
    send_new_graph();
}



function editWeekend() {
    var days_in_month = 33 - new Date(year, month - 1, 33).getDate();
    var weekends = [];
    for (var i = 1; i < days_in_month + 1; i++) {
        if ($("#weekend" + i).is(':checked')) {
            $("#lweekend" + i).css('color', 'red');
            weekends[i - 1] = 1;
        } else {
            weekends[i - 1] = 0;
            $("#lweekend" + i).css('color', 'white');
        }
    }
    $.ajax({
        url: "../personal/base/weekends_base.php",
        type: "POST",
        dataType: "json",
        data: ({
            days_in_month: days_in_month,
            month: month,
            year: year,
            weekends: weekends
        }),
    });
}

function print_graph() {
    window.print();
}



$(document).ready(function () {
    selectedMonthYear();
    $(".selectYear").change(editYear);
    $(".selectMonth").change(editMonth);
    $(".weekend").change(editWeekend);
    $(".edit_graph").on("click", edit_graph);
    $(".save_graph").on("click", save_graph);
    $(".clear_month").on("click", clear_month);
    $(".cancel_graph").on("click", cancel_graph);
    $(".print").on("click", print_graph);

});