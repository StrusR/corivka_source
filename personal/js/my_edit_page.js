var url = document.location.href;
var ip = url.substring(url.lastIndexOf('ip=') + 3);

function UserData(json_data) {
    if (json_data.ip == undefined) {
        location = "https://corivka.com.ua/personal/my_edit_page.php";
    } else {
        information_output(json_data);
    }
};

function information_output(data) {
    if (data.my_surname == undefined || data.my_surname == "") {
        location.reload();
    }
    var my_access_rights = "";

    if (data.my_access_rights == 1) {
        my_access_rights = "(Директор)";
    } else if (data.my_access_rights == 2) {
        my_access_rights = "(Адміністратор)";
    } else {
        my_access_rights = "";
    }

    $("title").html(data.my_surname + " " + data.my_name + " " + my_access_rights);


    old_email = data.my_login;
    $("#email").attr("value", data.my_login);
    $("#surname").attr("value", data.my_surname);
    $("#name").attr("value", data.my_name);
    $("#patronymic").attr("value", data.my_patronymic);
    $("#phone").attr("value", data.my_phone);
};

function AuditEditPageForm() {
    var regular_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var regular_name_surname_patronymic = /^[_a-zA-Zа-яА-ЯіІїЇьЬ]+$/;
    var regular_phone = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){12}(\s*)?$/;
    var regular_password = /(?=.*[0-9])(?=.*[_a-zA-Zа-яА-ЯіІїЇьЬ])/;

    var email = $("#email").val();
    var surname = $("#surname").val();
    var name = $("#name").val();
    var patronymic = $("#patronymic").val();
    var phone = $("#phone").val();
    var oldpassword = $("#oldpassword").val();
    var newpassword = $("#newpassword").val();
    var newrepassword = $("#newrepassword").val();



    var audit_email = false;
    var audit_surname = false;
    var audit_name = false;
    var audit_patronymic = false;
    var audit_phone = false;
    var audit_newpassword = false;
    var audit_newrepassword = false;

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    surname = capitalizeFirstLetter(surname);
    name = capitalizeFirstLetter(name);
    patronymic = capitalizeFirstLetter(patronymic);
    if (email.length < 1) {
        audit_email = false;
        $("#lemail").html("Введіть email");
        $("#email").removeClass("check_passed").addClass("check_not_passed");
    } else if (regular_email.test(email) == false) {
        audit_email = false;
        $("#lemail").html("Email введено не коректно");
        $("#email").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_email = true;
        $("#lemail").html("Змінити логін");
        $("#email").removeClass("check_not_passed").addClass("check_passed");
    };
    if (surname.length < 1) {
        audit_surname = false;
        $("#lsurname").html("Введіть прізвище");
        $("#surname").removeClass("check_passed").addClass("check_not_passed");
    } else if (regular_name_surname_patronymic.test(surname) == false) {
        audit_surname = false;
        $("#lsurname").html("Прізвище введено не коректно");
        $("#surname").removeClass("check_passed").addClass("check_not_passed");
    } else if (surname.length < 3) {
        audit_surname = false;
        $("#lsurname").html("Прізвище закоротке");
        $("#surname").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_surname = true;
        $("#lsurname").html("Змінити прізвище");
        $("#surname").removeClass("check_not_passed").addClass("check_passed");
    };
    if (name.length < 1) {
        audit_name = false;
        $("#lname").html("Введіть ім'я");
        $("#name").removeClass("check_passed").addClass("check_not_passed");
    } else if (regular_name_surname_patronymic.test(name) == false) {
        audit_name = false;
        $("#lname").html("Ім'я введено не коректно");
        $("#name").removeClass("check_passed").addClass("check_not_passed");
    } else if (name.length < 3) {
        audit_name = false;
        $("#lname").html("Ім'я закоротке");
        $("#name").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_name = true;
        $("#lname").html("Змінити ім'я");
        $("#name").removeClass("check_not_passed").addClass("check_passed");
    };
    if (patronymic.length < 1) {
        audit_patronymic = false;
        $("#lpatronymic").html("Введіть по батькові");
        $("#patronymic").removeClass("check_passed").addClass("check_not_passed");
    } else if (regular_name_surname_patronymic.test(patronymic) == false) {
        audit_patronymic = false;
        $("#lpatronymic").html("По батькові введено не коректно");
        $("#patronymic").removeClass("check_passed").addClass("check_not_passed");
    } else if (name.length < 3) {
        audit_patronymic = false;
        $("#lpatronymic").html("По батькові закоротке");
        $("#patronymic").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_patronymic = true;
        $("#lpatronymic").html("Змінити по батькові");
        $("#patronymic").removeClass("check_not_passed").addClass("check_passed");
    };
    if (phone.length < 1) {
        audit_phone = false;
        $("#lphone").html("Введіть номер телефону");
        $("#phone").removeClass("check_passed").addClass("check_not_passed");
    } else if (regular_phone.test(phone) == false) {
        audit_phone = false;
        $("#lphone").html("Номер телефону введено не коректно");
        $("#phone").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_phone = true;
        $("#lphone").html("Змінити номер телефону");
        $("#phone").removeClass("check_not_passed").addClass("check_passed");
    };
    if (newpassword.length < 1) {
        audit_oldpassword = true;
        audit_newpassword = true;
        audit_newrepassword = true;
        $("#loldpassword").html("Пароль");
        $("#oldpassword").removeClass("check_not_passed").addClass("check_passed");
        $("#lnewpassword").html("Новий пароль");
        $("#newpassword").removeClass("check_not_passed").addClass("check_passed");
        $("#lnewrepassword").html("Повторіть новий пароль");
        $("#newrepassword").removeClass("check_not_passed").addClass("check_passed");
    } else {
        if (newpassword.length < 6) {
            $("#lnewpassword").html("Пароль не менше 6 символів");
            $("#newpassword").removeClass("check_passed").addClass("check_not_passed");
        } else if (regular_password.test(newpassword) == false) {
            audit_newpassword = false;
            $("#lnewpassword").html("Пароль має містити і букви і цифри");
            $("#newpassword").removeClass("check_passed").addClass("check_not_passed");
        } else {
            audit_newpassword = true;
            $("#lnewpassword").html("Пароль");
            $("#newpassword").removeClass("check_not_passed").addClass("check_passed");
        };
        if (newrepassword.length < 1) {
            $("#lnewrepassword").html("Введіть повторно пароль");
            $("#newrepassword").removeClass("check_passed").addClass("check_not_passed");
        } else if (newpassword != newrepassword) {
            audit_newrepassword = false;
            $("#lnewrepassword").html("Паролі не співпадають");
            $("#newrepassword").removeClass("check_passed").addClass("check_not_passed");
        } else {
            audit_newrepassword = true;
            $("#lnewrepassword").html("Повторіть пароль");
            $("#newrepassword").removeClass("check_not_passed").addClass("check_passed");
        };
    };
    if (audit_email == true && audit_surname == true && audit_name == true && audit_patronymic == true && audit_phone == true && audit_newpassword == true && audit_newrepassword == true) {
        $.ajax({
            url: "../personal/base/my_edit_page_base.php",
            type: "POST",
            dataType: "json",
            data: ({
                ip: ip,
                email: email,
                surname: surname,
                name: name,
                patronymic: patronymic,
                phone: phone,
                oldpassword: oldpassword,
                newpassword: newpassword,
            }),
            success: AuditBaseSuccess
        });
    };

    function AuditBaseSuccess(json_data) {
        if (json_data.login == false) {
            $("#lemail").html("Цей логін уже зареєстрований");
            $("#email").removeClass("check_passed").addClass("check_not_passed");
        } else {
            $("#lemail").html("Змінити логін");
            $("#email").removeClass("check_not_passed").addClass("check_passed");
        };
        if (json_data.phone == false) {
            $("#lphone").html("Цей номер телефону уже зареєстрований");
            $("#phone").removeClass("check_passed").addClass("check_not_passed");
        } else {
            $("#lphone").html("Номер телефону");
            $("#phone").removeClass("check_not_passed").addClass("check_passed");
        };
        if (json_data.password == false) {
            $("#loldpassword").html("Не правильний пароль");
            $("#oldpassword").removeClass("check_passed").addClass("check_not_passed");
        } else {
            $("#loldpassword").html("Пароль");
            $("#oldpassword").removeClass("check_not_passed").addClass("check_passed");
        };
        if (json_data.phone == true && json_data.login == true && json_data.password == true) {
            alert("Дані збережено");
            location = "https://corivka.com.ua/personal/user.php?ip=" + json_data.ip;
        };

    };
};

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

function AuditBasePasswordSuccess(json_data) {
    if (json_data.password == false) {
        $("#loldpassword").html("Не правильний пароль");
        $("#oldpassword").removeClass("check_passed").addClass("check_not_passed");
    } else {
        location = "https://corivka.com.ua/personal/login.php";
    };
}

function delete_user_base() {
    var oldpassword = $("#oldpassword").val();
    var assured = confirm("Ви впевнені, що хочете видалити свій аккаунт?");
    if (assured) {
        $.ajax({
            url: "../personal/base/delete_my_user_base.php",
            type: "POST",
            dataType: "json",
            data: ({
                ip: ip,
                oldpassword: oldpassword
            }),
            success: AuditBasePasswordSuccess
        });
    }
}
$(document).ready(function () {
    Information();
    $("#edit_page_submit").bind("click", AuditEditPageForm);
    $("#delete_user_button").bind("click", delete_user_base);
    $(".file_upload").change(function () {
        if ($('#file').val() == "") {
            $(".status").html("зображення не вибрано");
        } else {
            var f = $('#file').val().substring($('#file').val().lastIndexOf('\\') + 1);
            $(".status").html(f);
        }
    });

});