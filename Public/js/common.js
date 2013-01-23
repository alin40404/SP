var host = "http://localhost:8001";

$(document).ready(function () {
    $("input.text").focusin(function () {
        $(this).css("border-color", "#E99CDD");
    });
    $("input.text").focusout(function () {
        $(this).css("border-color", "#B6D9F5");
    });
});

$(document).ready(function (e) {
    //首先将#back_to_top隐藏
    $("#back_to_top").hide();
    //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
    $(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 10) {
                $("#back_to_top").fadeIn(500);
            } else {
                $("#back_to_top").fadeOut(500);
            }
        });

        //当点击跳转链接后，回到页面顶部位置
        $("#back_to_top").click(function () {
            $('body,html').animate({ scrollTop: 0 }, 500);
            return false;
        });
    });
});
