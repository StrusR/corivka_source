var ShowEdit_s_t = false;
var ShowEdit_m_t = false;

function ShowEdit_site_type() {
    if (ShowEdit_s_t == false) {
        $(".edit_site_type").attr("style", "top: " + $(".user_header").outerHeight() + "px;");
        $(".edit_site_type").slideDown(200);
        $(".edit_menu_type").slideUp(200);
        ShowEdit_s_t = true;
    }
};

function ShowEdit_menu_type() {
    if (ShowEdit_m_t == false) {
        $(".edit_menu_type").attr("style", "top: " + ($(".user_header").outerHeight() - 3) + "px;");
        $(".edit_menu_type").slideDown(200);
        ShowEdit_m_t = true
    }
};

function HideEdit_site_type() {
    $(".edit_site_type").slideUp(200);
    ShowEdit_s_t = false;
    ShowEdit_m_t = false;
};

$(document).ready(function () {
    $(".edit_site").mouseenter(ShowEdit_site_type);
    $(".edit_menu").mouseenter(ShowEdit_menu_type);
    $(".user_header").mouseleave(HideEdit_site_type);
});