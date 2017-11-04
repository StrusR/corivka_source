var menu = false; //Відкрите(true) або закрите(false) меню на телефоні

//Функція яка ховає або відкриває меню на телефоні
function ShowHideMenu() {
    if (menu == false) {
        $(".MenuOnClick").slideDown(200);
        menu = true;
    } else {
        $(".MenuOnClick").slideUp(200);
        menu = false;
    }
};
//якщо пролистати більше ніж висота headerBefore, то футер закріпиться в горі екрану
function StaticFixedHeader() {
    if ($(document).scrollTop() >= $(".headerBefore").outerHeight()) {
        $(".headerBefore").attr("style", "margin-bottom: " + ($("header").outerHeight() + 10) + "px;");
        $("header").attr("style", "position: fixed; top: 0;");
        $(".MenuOnClick").attr("style", "top: " + ($("header").outerHeight() + 5) + "px;");
    } else {
        $("header").attr("style", "position: static");
        $(".headerBefore").attr("style", "margin-bottom: 0px;");
        $(".MenuOnClick").attr("style", "top: " + ($(".headerBefore").outerHeight() + $("header").outerHeight() + 5) + "px");
    };
};

$(document).ready(function () {
    //При кліку на меню випливає меню
    $(".menu").bind("click", ShowHideMenu);
    $(".MenuOnClick").attr("style", "top: " + ($(".headerBefore").outerHeight() + $("header").outerHeight() + 5) + "px");
});
//при зміні орієнтації екрану меню буде сховане
window.onresize = function (event) {
    $(".MenuOnClick").hide();
    menu = false;
    StaticFixedHeader();
};
//при пролистуванні екрану меню буде сховане
$(document).scroll(function () {
    $(".MenuOnClick").hide();
    menu = false;
    StaticFixedHeader();
});