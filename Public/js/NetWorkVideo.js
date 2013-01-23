//NetWorkVideo
$(document).ready(function () {
    $("tr.NetWorkVideo").mousemove(function () {
        $(this).css("background-color", "#DDDDDD");
    });
    $("tr.NetWorkVideo").mouseleave(function () {
        $(this).css("background-color", "white");
    });

    $("tr.NetWorkVideo").click(function () {
        var NetWorkVideoId = $(this).attr("id");
        //alert(NetWorkVideoId);
        window.open("Search_Report/?id=5&appName=" + NetWorkVideoId);
    });
});
