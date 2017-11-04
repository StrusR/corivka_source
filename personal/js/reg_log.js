window.onbeforeunload = function () {
    alert(hjk);
};

function AuditRegForm() {
    var regular_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var regular_name_surname_patronymic = /^[_a-zA-Zа-яА-ЯіІїЇьЬ]+$/;
    var regular_phone = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){12}(\s*)?$/;
    var regular_password = /(?=.*[0-9])(?=.*[_a-zA-Zа-яА-ЯіІїЇьЬ])/;

    var email = $("#email").val();
    var surname = $("#surname").val();
    var name = $("#name").val();
    var patronymic = $("#patronymic").val();
    var phone = $("#phone").val();
    var password = $("#password").val();
    var repassword = $("#repassword").val();

    var audit_email = false;
    var audit_surname = false;
    var audit_name = false;
    var audit_patronymic = false;
    var audit_phone = false;
    var audit_password = false;
    var audit_repassword = false;

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
        $("#lemail").html("Логін");
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
        $("#lsurname").html("Прізвище");
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
        $("#lname").html("Ім'я");
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
        $("#lpatronymic").html("По батькові");
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
        $("#lphone").html("Номер телефону");
        $("#phone").removeClass("check_not_passed").addClass("check_passed");
    };
    if (password.length < 1) {
        audit_password = false;
        $("#lpassword").html("Введіть пароль");
        $("#password").removeClass("check_passed").addClass("check_not_passed");
    } else if (password.length < 6) {
        $("#lpassword").html("Пароль не менше 6 символів");
        $("#password").removeClass("check_passed").addClass("check_not_passed");
    } else if (regular_password.test(password) == false) {
        audit_password = false;
        $("#lpassword").html("Пароль має містити і букви і цифри");
        $("#password").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_password = true;
        $("#lpassword").html("Пароль");
        $("#password").removeClass("check_not_passed").addClass("check_passed");
    };
    if (repassword.length < 1) {
        $("#lrepassword").html("Введіть повторно пароль");
        $("#repassword").removeClass("check_passed").addClass("check_not_passed");
    } else if (password != repassword) {
        audit_repassword = false;
        $("#lrepassword").html("Паролі не співпадають");
        $("#repassword").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_repassword = true;
        $("#lrepassword").html("Повторіть пароль");
        $("#repassword").removeClass("check_not_passed").addClass("check_passed");
    };

    if (audit_email == true && audit_surname == true && audit_name == true && audit_patronymic == true && audit_phone == true && audit_password == true && audit_repassword == true) {
        $.ajax({
            url: "../personal/base/register_base.php",
            type: "POST",
            dataType: "json",
            data: ({
                email: email,
                surname: surname,
                name: name,
                patronymic: patronymic,
                phone: phone,
                password: password
            }),
            // beforeSend: f_before,
            success: AuditBaseSuccess
        });
    };

    function AuditBaseSuccess(json_data) {
        if (json_data.login == false) {
            $("#lemail").html("Цей логін уже зареєстрований");
            $("#email").removeClass("check_passed").addClass("check_not_passed");
        } else {
            $("#lemail").html("Логін");
            $("#email").removeClass("check_not_passed").addClass("check_passed");
        };
        if (json_data.phone == false) {
            $("#lphone").html("Цей номер телефону уже зареєстрований");
            $("#phone").removeClass("check_passed").addClass("check_not_passed");
        } else {
            $("#lphone").html("Номер телефону");
            $("#phone").removeClass("check_not_passed").addClass("check_passed");
        };
        if (json_data.phone == true && json_data.login == true) {
            location = "http://corivka.com.ua/personal/user.php?ip=" + json_data.ip;
        };
    };
};

function AuditLogForm() {

    var login = $("#email_phone").val();
    var password = $("#password").val();

    var audit_login = false;
    var audit_password = false;

    if (login.length < 1) {
        audit_login = false;
        $("#lemail_phone").html("Введіть email або номер телефону");
        $("#email_phone").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_login = true;
        $("#lemail_phone").html("Логін");
        $("#email_phone").removeClass("check_not_passed").addClass("check_passed");
    };
    if (password.length < 1) {
        audit_password = false;
        $("#lpassword").html("Введіть пароль");
        $("#password").removeClass("check_passed").addClass("check_not_passed");
    } else {
        audit_password = true;
        $("#lpassword").html("Пароль");
        $("#password").removeClass("check_not_passed").addClass("check_passed");
    };

    if (audit_login == true && audit_password == true) {
        $.ajax({
            url: "../personal/base/login_base.php",
            type: "POST",
            dataType: "json",
            data: ({
                email_phone: login,
                password: password
            }),
            // beforeSend: f_before,
            success: AuditBaseSuccess
        });
    }

    function AuditBaseSuccess(json_data) {
        if (json_data.login == false) {
            $(".display").html("Ви ввели не правильно логін або пароль");
            $("#email_phone").removeClass("check_passed").addClass("check_not_passed");
            $("#password").removeClass("check_passed").addClass("check_not_passed");
        } else {
            $(".display").html("Вхід");
            $("#email_phone").removeClass("check_not_passed").addClass("check_passed");
            $("#password").removeClass("check_not_passed").addClass("check_passed");
            location = "http://corivka.com.ua/personal/user.php?ip=" + json_data.ip;
        };
    };
};

function ExitBase() {
    $.ajax({
        url: "../personal/base/exit_base.php",
        type: "POST",
        dataType: "json"
    });

}

$(document).ready(function () {
    $("#reg_submit").bind("click", AuditRegForm);
    $("#log_submit").bind("click", AuditLogForm);
    $(".exit").bind("click", ExitBase);
});