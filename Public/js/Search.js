var appUrl="http://localhost:8001/ComputerAssets/";

function siftZhCH() {
    $("input#textBoxSearch_app").focus(function () {
        var content = $(this).attr("value");
        if (content == "请输入关键字·筛选") {
            $(this).attr("value", "");
            $(this).css("color", "Black");
        }
    });
    $("input#textBoxSearch_app").blur(function () {
        var content = $(this).attr("value");
        if (content == "") {
            $(this).attr("value", "请输入关键字·筛选");
            $(this).css("color", "#C0C0C0");
        }
    });

    $("input#siftZhCN").click(function () {
        var content = $("input#textBoxSearch_app").attr("value");
        $("span#errorSelectAppName").css("display", "none");
        if (content == "请输入关键字·筛选") {
            // var url = "http://localhost:8080/Home/SearchKey/?content=";
            $("input#textBoxSearch_app").focus();
            $("input#textBoxSearch_app").css("border-color", "red");
        } else {
            document.cookie = content;
            var url = appUrl+"Content/searchKey/?content=" + content;
            alert(url);
            $.get(url, function (result) {
                $("div#mainTable").html(result);
            });

        }
    });
}

function siftEnUS() {
    $("input#textBoxSearch_app").focus(function () {
        var content = $(this).attr("value");
        if (content == "Please input key · screening") {
            $(this).attr("value", "");
            $(this).css("color", "Black");
        }
    });
    $("input#textBoxSearch_app").blur(function () {
        var content = $(this).attr("value");
        if (content == "") {
            $(this).attr("value", "Please input key · screening");
            $(this).css("color", "#C0C0C0");
        }
    });

    $("input#siftEnUS").click(function () {
        var content = $("input#textBoxSearch_app").attr("value");
        $("span#errorSelectAppName").css("display", "none");
        if (content == "Please input key · screening") {
            // var url = "http://localhost:8080/Home/SearchKey/?content=";
            $("input#textBoxSearch_app").focus();
            $("input#textBoxSearch_app").css("border-color", "red");
        } else {
            document.cookie = content;
            var url = appUrl+"Content/SearchKey/?content=" + content;
            $.get(url, function (result) {
                $("div#mainTable").html(result);
            });

        }
    });
}

function siftZhHK() {
    $("input#textBoxSearch_app").focus(function () {
        var content = $(this).attr("value");
        if (content == "請輸入關鍵字·篩選") {
            $(this).attr("value", "");
            $(this).css("color", "Black");
        }
    });
    $("input#textBoxSearch_app").blur(function () {
        var content = $(this).attr("value");
        if (content == "") {
            $(this).attr("value", "請輸入關鍵字·篩選");
            $(this).css("color", "#C0C0C0");
        }
    });

    $("input#siftZhHK").click(function () {
        var content = $("input#textBoxSearch_app").attr("value");
        $("span#errorSelectAppName").css("display", "none");
        if (content == "請輸入關鍵字·篩選") {
            // var url = "http://localhost:8080/Home/SearchKey/?content=";
            $("input#textBoxSearch_app").focus();
            $("input#textBoxSearch_app").css("border-color", "red");
        } else {
            document.cookie = content;
            var url = appUrl+"Content/SearchKey/?content=" + content;
            $.get(url, function (result) {
                $("div#mainTable").html(result);
            });

        }
    });
}

