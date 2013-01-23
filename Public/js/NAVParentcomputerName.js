//NAVParentcomputerName
$(document).ready(function () {
    $("tr.NAVParentcomputerName").mousemove(function () {
        $(this).css("background-color", "#DDDDDD");
    });
    $("tr.NAVParentcomputerName").mouseleave(function () {
        $(this).css("background-color", "white");
        // $(this).attr("title", "Click me to view the details!");
    });
    $("tr.NAVParentcomputerName").click(function () {
        //获取id属性值
        var NAVParentId = $(this).attr("id");
        NAVParentId = "tr#" + NAVParentId + " td.NAVP_class";
        var NAVParent_ComName = $(NAVParentId).text();
         window.open("http://localhost:8080/Home/ViewTheDetails/?mode=computerName&key=" + NAVParent_ComName);
        //window.open("ViewTheDetails/?mode=computerName&key=" + NAVParent_ComName.toString());
        //alert(NAVParentId);
        //alert("http://localhost:8080/Home/ViewTheDetails/?mode=computerName&key=" + NAVParent_ComName);
    });
});