var menu = false; //Відкрите(true) або закрите(false) меню на телефоні

//Функція яка ховає або відкриває меню
function ShowHideMenu() {
    if (menu == false) {
        $(".edit_site_menu").slideDown(200);
        menu = true;
    } else {
        $(".edit_site_menu").slideUp(200);
        menu = false;
    }
};

$(document).ready(function () {
    //При кліку на меню випливає меню
    $(".edit_site").bind("click", ShowHideMenu);
});