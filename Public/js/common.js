function isTextEmpty(text) {
	text = text.trim();
	if (text == "" || text == null) {
		return true;
	} else {
		return false;
	}
}

/* 分页按钮ajax请求 */
function pageAjaxRequest(pageId, insertHtmlId, url) {
	var type = "post";
	var pArr = pageId.split("_");
	var p = pArr[pArr.length - 1];
	var data = {
		p : p
	};
	pageId = $("#" + pageId);
	var content = $(insertHtmlId);
	$.ajax({
		type : type,
		url : url,
		data : data, // 传送的参数，json格式
		beforeSend : function() {
			// showloding();

		},
		success : function(data, textStatus) {
			content.html(data);

		},
		complete : function(XMLHttpRequest, textStatus) {
			// hideLoading

		},
		error : function() {
			// 请求出错处理
			var msg = "加载失败，请稍后重试...";
			content.html(msg);
		}
	});
}

/* 点击page按钮 */
function pageClick(pgClass, insertHtmlId, url) {
	$(pgClass).click(function() {
		var pageId = this.id;
		var nowPage = $("#" + pageId);
		pageAjaxRequest(pageId, $(insertHtmlId), url);
	});
}

/** **** 按钮ajax请求 ****** */
function ajaxRequest(type, url, data, btnId, insertHtmlId) {
	var btn = $(btnId);
	var content = $(insertHtmlId);
	$.ajax({
		type : type,
		url : url,
		data : data, // 传送的参数，json格式
		beforeSend : function() {
			// showloding();
			btn.button('loading');
		},
		success : function(data, textStatus) {
			content.html(data);
		},
		complete : function(XMLHttpRequest, textStatus) {
			btn.button("reset");
			// hideLoading
		},
		error : function() {
			// 请求出错处理
			content.html('加载失败，请稍后再试..');

		}

	});
}

// 点击单独按钮
function singleBtn(btnId, inputId, url, data, insertHtmlId) {
	var btn = $("#" + btnId);
	btn.click(function() {
		var input = $("#" + inputId);
		var value = input.attr("value");
		if (isTextEmpty(value)) {
			input.css("border-color", "red");
			input.focus();
			input.focusout(function() {
				input.css("border-color", "lightgray");
			});
		} else {
			var type = "post";
			$.extend(data, {
				key : value
			});
			ajaxRequest(type, url, data, btn, "#" + insertHtmlId);
		}
	});
}

// 点击单独按钮,以类样式传入
function mutilBtn(btnClass, url, data, insertHtmlId) {
	var btn = $(btnClass);
	btn.click(function() {
		var btnEditId = this.id;
		var cidArr = btnEditId.split("_");
		var id = cidArr[cidArr.length - 1];
		var btnInputId = cidArr[0] + "_input_" + id;
		var input = $("#" + btnInputId);
		var value = input.attr("value");
		if (isTextEmpty(value)) {
			input.css("border-color", "red");
			input.focus();
			input.focusout(function() {
				input.css("border-color", "lightgray");
			});
		} else {
			var type = "post";
			$.extend(data, {
				key : value,
				id : id
			});
			ajaxRequest(type, url, data, $(this), "#" + insertHtmlId);
		}
	});
}

// 删除按钮
function mutilDelBtn(btnClass, alertBtn, url, data, insertHtmlId) {
	var btn = $(btnClass);
	var id;
	var cidArr;
	var btnEditId;
	btn.click(function() {
		btnEditId = this.id;
		cidArr = btnEditId.split("_");
		id = cidArr[cidArr.length - 1];
	});
	var deleteBtn = $("#" + alertBtn);
	deleteBtn.click(function() {
		var type = "post";
		$.extend(data, {
			id : id
		});
		ajaxRequest(type, url, data, $("#" + btnEditId), "#" + insertHtmlId);

	});
}

// 加载局部文件
function loadFile(insertHtmlId, url) {
	var insertHtmlId = $("#" + insertHtmlId);
	insertHtmlId.load(url, function(data, status) {
		if (status != "success") {
			insertHtmlId.html("加载失败，请稍后再试.");
		}
	});
}
