function genSearchZhCH() {
    $("input#textBoxSearch_app").focus(function () {
        var content = $(this).attr("value");
        if (content == "请输入关键字") {
            $(this).attr("value", "");
            $(this).css("color", "Black");
        }
    });
    $("input#textBoxSearch_app").blur(function () {
        var content = $(this).attr("value");
        if (content == "") {
            $(this).attr("value", "请输入关键字");
            $(this).css("color", "#C0C0C0");
        }
    });

    $("div#table").ajaxStart(function () {
        $("span#loading").css("display", "inline");
    });
    $("div#table").ajaxComplete(function () {
        $("span#loading").css("display", "none");
    });

    $("input#search").click(function () {
        $("span#errorExportExcel").css("display", "none");
        var searchText = $("input#textBoxSearch_app").attr("value");
        //存入cookie
        document.cookie = searchText;

        if (searchText == "请输入关键字") {
            //$("span#errorExportExcel").css("display", "none");
            $("input#textBoxSearch_app").focus();
            $("input#textBoxSearch_app").css("border-color", "red");

        } else {
            var url = "http://localhost:8080/Home/Enquiry_On_App_Result/?searchText=" + searchText;
            $.get(url, function (result) {
                $("div#table").html(result);
            });

        }

    });

    //*************  导出excel  *************//
    $("a#exportExcel").click(function () {
        // 取出cookie
        var searchText = document.cookie;

        //searchText = (searchText == null ? "请输入关键字" : searchText);
        if (searchText != "请输入关键字" && searchText != "") {
            var url = "http://localhost:8080/Home/ExportExcelEnquiryOnApp/?appNameKey=" + searchText;
            //alert(url);
            window.open(url);
        } else {
            $("span#errorExportExcel").css("display", "inline");
        }
    });
}

function genSearchEnUS() {
    $("input#textBoxSearch_app").focus(function () {
        var content = $(this).attr("value");
        if (content == "Please input the keyword") {
            $(this).attr("value", "");
            $(this).css("color", "Black");
        }
    });
    $("input#textBoxSearch_app").blur(function () {
        var content = $(this).attr("value");
        if (content == "") {
            $(this).attr("value", "Please input the keyword");
            $(this).css("color", "#C0C0C0");
        }
    });

    $("div#table").ajaxStart(function () {
        $("span#loading").css("display", "inline");
    });
    $("div#table").ajaxComplete(function () {
        $("span#loading").css("display", "none");
    });

    $("input#search").click(function () {
        $("span#errorExportExcel").css("display", "none");
        var searchText = $("input#textBoxSearch_app").attr("value");
        //存入cookie
        document.cookie = searchText;

        if (searchText == "Please input the keyword") {
            //$("span#errorExportExcel").css("display", "none");
            $("input#textBoxSearch_app").focus();
            $("input#textBoxSearch_app").css("border-color", "red");

        } else {
            var url = "http://localhost:8080/Home/Enquiry_On_App_Result/?searchText=" + searchText;
            $.get(url, function (result) {
                $("div#table").html(result);
            });

        }

    });

    //*************  导出excel  *************//
    $("a#exportExcel").click(function () {
        // 取出cookie
        var searchText = document.cookie;

        //searchText = (searchText == null ? "请输入关键字" : searchText);
        if (searchText != "Please input the keyword" && searchText != "") {
            var url = "http://localhost:8080/Home/ExportExcelEnquiryOnApp/?appNameKey=" + searchText;
            //alert(url);
            window.open(url);
        } else {
            $("span#errorExportExcel").css("display", "inline");
        }
    });
}

function genSearchZhHK() {

    $("input#textBoxSearch_app").focus(function () {
        var content = $(this).attr("value");
        if (content == "請輸入關鍵字") {
            $(this).attr("value", "");
            $(this).css("color", "Black");
        }
    });
    $("input#textBoxSearch_app").blur(function () {
        var content = $(this).attr("value");
        if (content == "") {
            $(this).attr("value", "請輸入關鍵字");
            $(this).css("color", "#C0C0C0");
        }
    });

    $("div#table").ajaxStart(function () {
        $("span#loading").css("display", "inline");
    });
    $("div#table").ajaxComplete(function () {
        $("span#loading").css("display", "none");
    });

    $("input#search").click(function () {
        $("span#errorExportExcel").css("display", "none");
        var searchText = $("input#textBoxSearch_app").attr("value");
        //存入cookie
        document.cookie = searchText;

        if (searchText == "請輸入關鍵字") {
            //$("span#errorExportExcel").css("display", "none");
            $("input#textBoxSearch_app").focus();
            $("input#textBoxSearch_app").css("border-color", "red");

        } else {
            var url = "http://localhost:8080/Home/Enquiry_On_App_Result/?searchText=" + searchText;
            $.get(url, function (result) {
                $("div#table").html(result);
            });

        }

    });

    //*************  导出excel  *************//
    $("a#exportExcel").click(function () {
        // 取出cookie
        var searchText = document.cookie;

        //searchText = (searchText == null ? "请输入关键字" : searchText);
        if (searchText != "請輸入關鍵字" && searchText != "") {
            var url = "http://localhost:8080/Home/ExportExcelEnquiryOnApp/?appNameKey=" + searchText;
            //alert(url);
            window.open(url);
        } else {
            $("span#errorExportExcel").css("display", "inline");
        }
    });

}

