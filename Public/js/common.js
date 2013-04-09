function isTextEmpty(text){
    text = text.trim();
    if (text == "" || text == null) {
        return true;
    }
    else {
        return false;
    }
}

/* 分页按钮ajax请求 */
function pageAjaxRequest(pageId, data, insertHtmlId, url){
    var type = "post";
    var pArr = pageId.split("_");
    var p = pArr[pArr.length - 1];
    $.extend(data, {
        p: p
    });
    
    pageId = $("#" + pageId);
    var content = $(insertHtmlId);
    $.ajax({
        type: type,
        url: url,
        data: data, // 传送的参数，json格式
        beforeSend: function(){
            // showloading();
        
        },
        success: function(data, textStatus){
            content.html(data);
            
        },
        complete: function(XMLHttpRequest, textStatus){
            // hideLoading
        
        },
        error: function(){
            // 请求出错处理
            var msg = "加载失败，请稍后重试...";
            content.html(msg);
        }
    });
}

/* 点击page按钮 */
function pageClick(pgClass, insertHtmlId, url){
    $(pgClass).click(function(){
        var pageId = this.id;
        var nowPage = $("#" + pageId);
        pageAjaxRequest(pageId, {}, $("#" + insertHtmlId), url);
    });
}

/* 点击page按钮 */
function pageClickByData(pgClass, data, insertHtmlId, url){
    $(pgClass).click(function(){
        var pageId = this.id;
        var nowPage = $("#" + pageId);
        pageAjaxRequest(pageId, data, $("#" + insertHtmlId), url);
    });
}

/** **** 按钮ajax请求 ****** */
function ajaxRequest(type, url, data, btnId, insertHtmlId){
    var btn = $(btnId);
    var content = $(insertHtmlId);
    $.ajax({
        type: type,
        url: url,
        data: data, // 传送的参数，json格式
        beforeSend: function(){
            // showloding();
            btn.button('loading');
        },
        success: function(data, textStatus){
            content.html(data);
        },
        complete: function(XMLHttpRequest, textStatus){
            btn.button("reset");
            // hideLoading
        },
        error: function(){
            // 请求出错处理
            content.html('加载失败，请稍后再试..');
            
        }
        
    });
}

// 点击单独按钮
function singleBtn(btnId, inputId, url, data, insertHtmlId){
    var btn = $("#" + btnId);
    btn.click(function(){
        checkThePost(btn, inputId, url, data, insertHtmlId);
    });
}

function checkThePost(btn, inputId, url, data, insertHtmlId){
    var input = $("#" + inputId);
    var value = input.attr("value");
    if (isTextEmpty(value)) {
        input.css("border-color", "red");
        input.focus();
        input.focusout(function(){
            input.css("border-color", "lightgray");
        });
    }
    else {
        var type = "post";
        $.extend(data, {
            key: value
        });
        ajaxRequest(type, url, data, btn, "#" + insertHtmlId);
    }
}

function singleBtnToAddGoods(btnId, inputId, treaId, imgId, url, data, insertHtmlId){
    var btn = $("#" + btnId);
    btn.click(function(){
        var treaVal = $("#" + treaId).val();
        var imgVal = $("#" + imgId).attr("rel");
        $.extend(data, {
            gdesc: treaVal,
            img: imgVal
        });
        checkThePost(btn, inputId, url, data, insertHtmlId);
    });
}



// 点击单独按钮,以类样式传入
function mutilBtn(btnClass, url, data, insertHtmlId){
    var btn = $(btnClass);
    btn.click(function(){
        var btnEditId = this.id;
        var cidArr = btnEditId.split("_");
        var id = cidArr[cidArr.length - 1];
        var btnInputId = cidArr[0] + "_input_" + id;
        var input = $("#" + btnInputId);
        var value = input.attr("value");
        if (isTextEmpty(value)) {
            input.css("border-color", "red");
            input.focus();
            input.focusout(function(){
                input.css("border-color", "lightgray");
            });
        }
        else {
            var type = "post";
            $.extend(data, {
                key: value,
                id: id
            });
            ajaxRequest(type, url, data, $(this), "#" + insertHtmlId);
        }
    });
}


// 点击单独按钮,以类样式传入
function mutilBtnSelect(btnClass, selectIdPref, url, data, insertHtmlId){
    var btn = $(btnClass);
    btn.click(function(){
        var btnEditId = this.id;
        var cidArr = btnEditId.split("_");
        var id = cidArr[cidArr.length - 1];
        var btnInputId = cidArr[0] + "_input_" + id;
        var input = $("#" + btnInputId);
        var value = input.attr("value");
        if (isTextEmpty(value)) {
            input.css("border-color", "red");
            input.focus();
            input.focusout(function(){
                input.css("border-color", "lightgray");
            });
        }
        else {
            var Str = $("#" + selectIdPref + id).attr("value");
            var arr = Str.split("_");
            var ctgname = arr[0]
            var ctgid = arr[1];
            
            var type = "post";
            $.extend(data, {
                key: value,
                id: id,
                ctgid: ctgid,
                ctgname: ctgname
            });
            ajaxRequest(type, url, data, $(this), "#" + insertHtmlId);
        }
    });
}


// 删除按钮
function mutilDelBtn(btnClass, alertBtn, url, data, insertHtmlId){
    var btn = $(btnClass);
    var id;
    var cidArr;
    var btnEditId;
    btn.click(function(){
        btnEditId = this.id;
        cidArr = btnEditId.split("_");
        id = cidArr[cidArr.length - 1];
    });
    var deleteBtn = $("#" + alertBtn);
    deleteBtn.click(function(){
        var type = "post";
        $.extend(data, {
            id: id
        });
        ajaxRequest(type, url, data, $("#" + btnEditId), "#" + insertHtmlId);
        
    });
}

// 批量保存
function mutilSave(btnSaveId, checkboxName, tipInfoId, url, data, insertHtmlId){
    var btn = $("#" + btnSaveId);
    btn.click(function(){
        var dataStr = "{";
        var isEmpty = true;
        $("input[name='" + checkboxName + "']").each(function(){
            if ($(this).attr("checked") == "checked") {
                var arrId = (this.id).split("_");
                var tempId = arrId[arrId.length - 1];
                var tempValue = $("#" + arrId[0] + "_input_" +
                arrId[arrId.length - 1]).attr("value");
                dataStr += "'" + tempId + "':'" + tempValue +
                "'" +
                ",";
                isEmpty = false;
            }
        });
        dataStr += "}";
        var d = window.eval("(" + dataStr + ")");
        if (isEmpty) {
            $('#' + tipInfoId).modal({
                show: true,
                keyboard: false
            })
        }
        else {
            $.extend(d, data);
            ajaxRequest("post", url, d, btn, "#" + insertHtmlId);
        }
    });
}

// 批量保存
function mutilSaveBySelect(btnSaveId, selectIdPref, checkboxName, tipInfoId, url, data, insertHtmlId){
    var btn = $("#" + btnSaveId);
    btn.click(function(){
        var dataStr = "{";
        var isEmpty = true;
        $("input[name='" + checkboxName + "']").each(function(){
            if ($(this).attr("checked") == "checked") {
                var arrId = (this.id).split("_");
                var tempId = arrId[arrId.length - 1];
                var tempValue = $("#" + arrId[0] + "_input_" +
                arrId[arrId.length - 1]).attr("value");
                var Str = $("#" + selectIdPref + tempId).attr("value");
                var arr = Str.split("_");
                var ctgname = arr[0]
                var ctgid = arr[1];
                
                dataStr += "'" + tempId + "':{name:'" + tempValue + "',ctgid:'" + ctgid + "'}" + ",";
                isEmpty = false;
            }
        });
        dataStr += "}";
        var d = window.eval("(" + dataStr + ")");
        if (isEmpty) {
            $('#' + tipInfoId).modal({
                show: true,
                keyboard: false
            })
        }
        else {
            $.extend(d, data);
            ajaxRequest("post", url, d, btn, "#" + insertHtmlId);
        }
    });
}

// 批量删除
function mutilDel(btnDelId, checkboxName, tipInfoId, alertInfoId, alertBtn, url, data, insertHtmlId){
    var btn = $("#" + btnDelId);
    
    btn.click(function(){
        var dataStr = "{";
        var isEmpty = true;
        $("input[name='" + checkboxName + "']").each(function(){
            if ($(this).attr("checked") == "checked") {
                var arrId = (this.id).split("_");
                var tempId = arrId[arrId.length - 1];
                var tempValue = $("#" + arrId[0] + "_input_" +
                arrId[arrId.length - 1]).attr("value");
                dataStr += "'" + tempId + "':'" + tempValue +
                "'" +
                ",";
                isEmpty = false;
            }
        });
        dataStr += "}";
        
        $.extend(data, window.eval("(" + dataStr + ")"));
        if (isEmpty) {
            $('#' + tipInfoId).modal({
                show: true
            });
        }
        else {
            $('#' + alertInfoId).modal({
                show: true
            });
        }
    });
    
    var deleteBtn = $("#" + alertBtn);
    deleteBtn.click(function(){
        ajaxRequest("post", url, data, btn, "#" + insertHtmlId);
    });
}

// 加载局部文件
function loadFile(insertHtmlId, url){
    var insertHtmlId = $("#" + insertHtmlId);
    insertHtmlId.load(url, function(data, status){
        if (status != "success") {
            insertHtmlId.html("加载失败，请稍后再试.");
        }
    });
}

// 全选
function allChoose(btnId, checkboxName){
    $("#" + btnId).click(function(){
        $("input[name='" + checkboxName + "']").attr("checked", !$(this).attr("checked"));
    });
}

/**
 *  反选
 * @param {Object} btnId
 * @param {Object} checkboxName
 */
function invertChoose(btnId, checkboxName){
    $("#" + btnId).click(function(){
        $("input[name='" + checkboxName + "']").each(function(){
            $(this).attr("checked", !this.checked);
        });
    });
}

/**
 * 下拉框改变时，异步请求
 * @param {Object} selectName
 * @param {Object} url
 * @param {Object} data
 * @param {Object} replaceId
 */
function selectChange(selectName, url, data, replaceId){
    $(selectName).change(function(){
        var Str = this.value;
        var arr = Str.split("_");
        var name = arr[0]
        var id = arr[1];
        
        $.extend(data, {
            id: id,
            key: name
        });
        ajaxRequest("post", url, data, "", "#" + replaceId);
    })
}

/**
 * 隐藏，显示
 * @param {Object} btn
 * @param {Object} fadeclass
 */
function _fadeToggle(btn, fadeclass){
    $(btn).click(function(){
        $(fadeclass).fadeToggle();
    });
}
