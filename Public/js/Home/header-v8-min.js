var TB = TB || {};
TB.Header = function() {
	var g = KISSY, o = g.DOM, q = g.Event, f = window, r = document, n = (r.location.protocol === "https:"), j = (f.g_config || 0).appId === 6, h = {
		getCookie : function(t) {
			var s = document.cookie.match("(?:^|;)\\s*" + t + "=([^;]*)");
			return (s && s[1]) ? decodeURIComponent(s[1]) : ""
		},
		setCookie : function(u, x, s, v) {
			var w = encodeURIComponent(x), t = s;
			if (typeof t === "number") {
				t = new Date();
				t.setTime(t.getTime() + s * 86400000)
			}
			if (t instanceof Date) {
				w += "; expires=" + t.toUTCString()
			}
			if (typeof v === "string" && v !== "") {
				w += "; domain=" + v
			}
			document.cookie = u + "=" + w
		},
		pickDomain : function(u, v) {
			v = v || location.hostname;
			var w = ".", t = v.split(w), s = t.length;
			if (s <= 2) {
				return v
			}
			u = u || 1;
			if (u > s - 2) {
				u = s - 2
			}
			return t.slice(u).join(w)
		},
		escapeHTML : function(t) {
			var u = document.createElement("div"), s = document
					.createTextNode(t);
			u.appendChild(s);
			return u.innerHTML
		}
	};
	function a(u) {
		if (!u) {
			return
		}
		var t = g.get("div.menu-bd", u);
		if (!t) {
			return
		}
		if (!n) {
			var s = document.createElement("iframe");
			s.src = "about: blank";
			s.className = "menu-bd";
			u.insertBefore(s, t);
			u.iframe = s
		}
		u.menulist = t;
		u.onmouseenter = function() {
			o.addClass(this.parentNode, "hover");
			if (n) {
				return
			}
			this.iframe.style.height = parseInt(this.menulist.offsetHeight)
					+ 25 + "px";
			this.iframe.style.width = parseInt(this.menulist.offsetWidth) + 1
					+ "px"
		};
		u.onmouseleave = function() {
			o.removeClass(this.parentNode, "hover")
		}
	}
	function d() {
		var s = document.forms.topSearch;
		if (!s) {
			return
		}
		q.on(s, "submit", function() {
			if (s.q.value == "") {
				s.action = "http://list.taobao.com/browse/cat-0.htm"
			}
		})
	}
	function e(V, U) {
		var w = g.get("#" + V), J = w && w.q, u = w && w.search_type, D = w
				&& w.getElementsByTagName("label")[0], C = w && w.cat, R = g
				.get("#J_TSearchTabs").getElementsByTagName("li"), s = R.length, O = {}, H = false, E = false, v = "tsearch-tabs-active", z = "tsearch-tabs-hover", M = function(
				X) {
			for ( var W = 0; W < s; W++) {
				o[W === X ? "addClass" : "removeClass"](R[W], v)
			}
		}, Q = g.get("#J_TSearchCat"), T = null, t = g.get("#J_TSearchCatHd"), y = Q
				&& Q.getElementsByTagName("div")[0], B = y
				&& y.getElementsByTagName("a") || [], G = B.length, P, F = function(
				W) {
			for (P = 0; P < G; P++) {
				if (B[P].getAttribute("data-value") === W) {
					return B[P]
				}
			}
			return null
		}, L = function() {
			o.removeClass(Q, "tsearch-cat-active")
		}, S = function() {
			o.addClass(Q, "tsearch-cat-active")
		}, K = function(W) {
			for (P = 0; P < G; P++) {
				o[B[P] === W ? "addClass" : "removeClass"](B[P],
						"tsearch-cat-selected")
			}
			L();
			t.innerHTML = W.innerHTML;
			C.value = W.getAttribute("data-value")
		}, I = function() {
			J.focus();
			if (g.UA.ie) {
				J.value = J.value
			}
		};
		if (!w) {
			return
		}
		if (g.get("#J_TSearchTabs")) {
			var N = 0, A = {
				"\u5b9d\u8d1d" : [ "item",
						"\u8f93\u5165\u60a8\u60f3\u8981\u7684\u5b9d\u8d1d" ],
				"\u6dd8\u5b9d\u5546\u57ce" : [ "mall",
						"\u8f93\u5165\u60a8\u60f3\u8981\u7684\u5546\u54c1" ],
				"\u5e97\u94fa" : [
						"shop",
						"\u8f93\u5165\u60a8\u60f3\u8981\u7684\u5e97\u94fa\u540d\u6216\u638c\u67dc\u540d" ],
				"\u62cd\u5356" : [ "auction",
						"\u8f93\u5165\u60a8\u60f3\u8981\u7684\u5b9d\u8d1d" ],
				"\u6dd8\u5427" : [ "taoba",
						"\u8f93\u5165\u60a8\u60f3\u8981\u641c\u7d22\u7684\u5185\u5bb9" ],
				"\u5b9d\u8d1d\u5206\u4eab" : [ "share",
						"\u8f93\u5165\u60a8\u60f3\u8981\u7684\u5b9d\u8d1d" ]
			}, x = {
				"\u5bf6\u8c9d" : [ "item",
						"\u8f38\u5165\u60a8\u60f3\u8981\u7684\u5bf6\u8c9d" ],
				"\u6dd8\u5bf6\u5546\u57ce" : [ "mall",
						"\u8f38\u5165\u60a8\u60f3\u8981\u7684\u5546\u54c1" ],
				"\u5e97\u92ea" : [
						"shop",
						"\u8f38\u5165\u60a8\u60f3\u8981\u7684\u5e97\u8216\u540d\u6216\u638c\u6ac3\u540d" ],
				"\u62cd\u8ce3" : [ "auction",
						"\u8f38\u5165\u60a8\u60f3\u8981\u7684\u5bf6\u8c9d" ],
				"\u6dd8\u5427" : [ "taoba",
						"\u8f38\u5165\u60a8\u60f3\u8981\u641c\u7d22\u7684\u5167\u5bb9" ],
				"\u5bf6\u8c9d\u5206\u4eab" : [ "share",
						"\u8f38\u5165\u60a8\u60f3\u8981\u7684\u5bf6\u8c9d" ]
			};
			for (; N < s; N++) {
				(function() {
					var Y = N, W = g
							.trim(R[Y].getElementsByTagName("a")[0].innerHTML), X = A[W]
							|| x[W];
					if (!X) {
						return
					}
					O[X[0]] = {
						index : Y,
						hint : X[1]
					};
					q.on(R[Y], "click", function(Z) {
						Z.halt();
						M(Y);
						o.removeClass(R[Y], z);
						u.value = X[0];
						D.innerHTML = X[1];
						I()
					});
					q.on(R[Y], "mouseenter", function(Z) {
						Z.halt();
						if (!o.hasClass(R[Y], v)) {
							o.addClass(R[Y], z)
						}
					});
					q.on(R[Y], "mouseleave", function(Z) {
						Z.halt();
						if (!o.hasClass(R[Y], v)) {
							o.removeClass(R[Y], z)
						}
					})
				})()
			}
		}
		q.on(J, "focus", function() {
			D.innerHTML = "";
			o.addClass(D, "hidden")
		});
		q.on(J, "blur", function() {
			if (g.trim(J.value) === "" && !H) {
				D.innerHTML = O[u.value]["hint"];
				o.removeClass(D, "hidden")
			}
		});
		q.on("#J_TSearchTabs", "mousedown", function() {
			H = true;
			E = true;
			setTimeout(function() {
				H = false
			})
		});
		q.on("#J_TSearchCat", "click", function(W) {
			W.halt();
			var X = W.target;
			switch (true) {
			case o.hasClass(X.parentNode, "tsearch-cat-hd"):
			case o.hasClass(X, "tsearch-cat-hd"):
				S();
				break;
			case X.parentNode.nodeName.toLowerCase() === "div":
				K(X);
				I();
				break
			}
		});
		q.on(document, "click", L);
		q
				.on(
						w,
						"submit",
						function() {
							switch (w.search_type.value) {
							case "item":
								if (J.value === "") {
									w.action = "http://list.taobao.com/browse/cat-0.htm"
								}
								break;
							case "mall":
								w.action = "http://list.tmall.com/search_product.htm";
								break;
							case "shop":
								w.action = "http://shopsearch.taobao.com/browse/shop_search.htm";
								break;
							case "auction":
								w.atype.value = "a";
								break;
							case "taoba":
								w.action = "http://ba.taobao.com/index.htm";
								break;
							case "share":
								w.tracelog.value = "msearch2fx";
								if (J.value === "") {
									w.action = "http://jianghu.taobao.com/square.htm"
								} else {
									w.keyword.value = J.value;
									w.action = "http://fx.taobao.com/view/share_search.htm"
								}
								break
							}
						});
		D.innerHTML = "";
		setTimeout(function() {
			if (!E) {
				u.value = (U && U.searchType) ? U.searchType : "item";
				if (document.domain.indexOf("shopsearch.taobao.com") > -1) {
					u.value = "shop"
				}
				var W = O[u.value];
				D.innerHTML = W.hint;
				M(W.index)
			}
			if (Q && (T = F(C.value))) {
				K(T)
			}
			if (g.trim(J.value) !== "") {
				D.innerHTML = ""
			}
			if (U && U.autoFocus) {
				I()
			}
			w.atype.value = "";
			if (w.keyword) {
				w.keyword.value = ""
			}
			if (w.tracelog) {
				w.tracelog.value = ""
			}
		})
	}
	function b(B) {
		var u = g.get("#" + B);
		if (!u) {
			return
		}
		var s = u.q;
		if (!s) {
			return
		}
		if (!(window.TB && TB.Suggest || g.Suggest)) {
			return
		}
		var v = g.Suggest ? g : TB, A = new v.Suggest(s,
				"http://suggest.taobao.com/sug", {
					resultFormat : "\u7ea6%result%\u4e2a\u5b9d\u8d1d"
				});
		var t = u.ssid;
		if (t) {
			setTimeout(function() {
				t.value = "s5-e"
			}, 0);
			t.setAttribute("autocomplete", "off");
			var w = function() {
				if (t.value.indexOf("-p1") == -1) {
					t.value += "-p1"
				}
			};
			try {
				if (A.subscribe) {
					A.subscribe("onItemSelect", w)
				}
				if (A.on) {
					A.on("onItemSelect", w)
				}
			} catch (y) {
			}
		}
		var z = u.elements.search_type;
		var C = function() {
			return z.value
		};
		var x = A._needUpdate;
		A._needUpdate = function() {
			var D = C();
			return (D === "item" || D === "mall") && x.call(A)
		}
	}
	function m() {
		var s = g.get("#J_Logout");
		if (!s) {
			return
		}
		q.on(s, "click", function(u) {
			u.halt();
			var t = s.href;
			new Image().src = "//taobao.alipay.com/user/logout.htm";
			setTimeout(function() {
				location.href = t
			}, 20)
		})
	}
	function i() {
		if (document.domain.indexOf(".taobao.net") === -1) {
			return
		}
		var v = document.getElementById("header"), u = v ? v
				.getElementsByTagName("a") : [], t = 0, s = u.length, w = location.hostname
				.split(".");
		while (w.length > 3) {
			w.shift()
		}
		w = w.join(".");
		for (; t < s; t++) {
			u[t].href = u[t].href.replace("taobao.com", w)
		}
	}
	function p() {
		if (document.location.href.indexOf("https://") === 0) {
			return
		}
		var t = document, v = t.getElementsByTagName("head")[0], u = t
				.createElement("script");
		u.src = "http://a.tbcdn.cn/app/search/monitor.js?t=20100331.js";
		v.appendChild(u)
	}
	function l() {
		if (j) {
			return
		}
		var s = g.unparam(location.search.substring(1));
		if ((("g_config" in f) && ("appId" in f.g_config) && f.g_config["appId"] != -1)
				|| "tstart" in s || "tdog" in s) {
			g
					.ready(function() {
						var x = r.getElementsByTagName("head")[0]
								|| r.documentElement, y = r
								.createElement("link"), v = r
								.createElement("script"), w = h.pickDomain(2), z = (w === "taobao.com")
								|| (location.hostname.indexOf("tmall.com") != -1), t = z ? "a.tbcdn.cn"
								: "assets.daily.taobao.net", u = "http://" + t
								+ "/p/header/webww-min.js?t=20110629.js";
						v.src = u;
						x.insertBefore(v, x.firstChild)
					})
		}
	}
	function k() {
		function y() {
			x.async = true;
			x.src = u + "?cb=" + v;
			(t.getElementsByTagName("head")[0] || t.documentElement)
					.appendChild(x)
		}
		var t = document, x = t.createElement("script"), s = t
				.getElementById("J_Service"), w = t
				.getElementById("J_ServicesContainer"), u = "http://www.taobao.com/index_inc/2010c/includes/get-services.php", v = "g_header_services_results";
		if (s && w) {
			if (window[v]) {
				return
			}
			if (t.addEventListener) {
				s.addEventListener("mouseover", y, false)
			} else {
				t.attachEvent && s.attachEvent("onmouseenter", y)
			}
			window[v] = function(z) {
				w.innerHTML = z;
				w.style.height = "auto";
				if (t.removeEventListener) {
					s.removeEventListener("mouseover", y, false)
				} else {
					t.detachEvent && s.detachEvent("onmouseenter", y)
				}
				x = s = w = null
			}
		}
	}
	function c() {
		if (!h.getCookie("l")) {
			return
		}
		g
				.ready(function() {
					var v = g.unparam(location.search.substring(1)), u = document.domain, t = (u
							.indexOf("taobao.com") > -1 || u
							.indexOf("tmall.com") > -1) ? "a.tbcdn.cn"
							: "assets.daily.taobao.net", s = "http://"
							+ t
							+ "/p/tlabs/??tlabs.js,base64.js,cookie.js,validator.js,loader.js,util.js,top.js?t=20101012.js";
					if ("ks-local" in v) {
						s = "http://test.taobao.com/code/fed/2010/tlabs/combo.php?b=src&f=tlabs.js,base64.js,cookie.js,validator.js,loader.js,util.js,top.js"
					}
					g.getScript(s, function() {
						if (typeof TLabs !== "undefined") {
							TLabs.init()
						}
					})
				})
	}
	return {
		init : function(s) {
			if (g.UA.ie === 6) {
				g.each(g.query("#site-nav div.menu"), function(u) {
					a(u)
				})
			}
			d();
			l();
			m();
			k();
			p();
			i();
			if (g.get("#J_TSearch")) {
				e("J_TSearchForm", s);
				if (!j) {
					setTimeout(function t() {
						if (typeof t.count == "undefined") {
							t.count = 0
						}
						t.count++;
						if (!(window.TB && TB.Suggest || g.Suggest)) {
							setTimeout(arguments.callee, 200)
						} else {
							b("J_TSearchForm")
						}
					}, 200)
				}
			}
		},
		writeLoginInfo : function(L) {
			L = L || {};
			var v = h.getCookie("tracknick"), K = h.getCookie("_nk_") || v, y = h
					.getCookie("uc1"), u = g.unparam(y), F = u.cookie15 && K
					|| h.getCookie("ck1") && v, E = parseInt(u._msg_, 10) || 0, z = +new Date(), s = L.memberServer
					|| "http://member1.taobao.com", H = L.outmemServer
					|| "http://outmem.taobao.com", t = L.loginServer
					|| "https://login.taobao.com", C = L.loginUrl || t
					+ "/member/login.jhtml?f=top";
			var x = location.href;
			if (/^http.*(\/member\/login\.jhtml)$/i.test(x)) {
				x = ""
			}
			var D = L.redirectUrl || x;
			if (D) {
				C += "&redirectURL=" + encodeURIComponent(D)
			}
			var B = "http://login.taobao.com";
			var I = L.logoutUrl || B + "/member/logout.jhtml?f=top";
			var w = s + "/member/newbie.htm";
			var J = H + "/message/list_private_msg.htm?t=" + z;
			var G = "http://jianghu.taobao.com/?t=" + z;
			var A = "";
			if (F) {
				A = 'hi\uff0c<a class="user-nick" href="' + G
						+ '" target="_top">'
						+ h.escapeHTML(unescape(K.replace(/\\u/g, "%u")))
						+ '</a>\uff01<a id="J_Logout" href="' + I
						+ '" target="_top">\u9000\u51fa</a><a href="' + J
						+ '" target="_top">\u7ad9\u5185\u4fe1';
				if (E) {
					A += "(" + E + ")"
				}
				A += "</a>"
			} else {
				A = '\u4eb2\uff0c\u6b22\u8fce\u6765\u6dd8\u5b9d\uff01<a href="'
						+ C + '" target="_top">\u8bf7\u767b\u5f55</a>';
				A += '<a href="' + w
						+ '" target="_top">\u514d\u8d39\u6ce8\u518c</a>'
			}
			r.write(A)
		}
	}
}();