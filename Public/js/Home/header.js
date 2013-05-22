/*pub-1|2012-07-12 12:12:30*/KISSY
		.add({
			"etao/component/loginpopup" : {
				fullpath : "http://a.tbcdn.cn/apps/e/component/120510/loginpopup.js",
				cssfullpath : "http://a.tbcdn.cn/apps/e/component/120510/loginpopup.css"
			}
		});
KISSY.add("IE6Hover", function(B, G) {
	var B = KISSY, F = B.DOM, C = B.Event;
	var A = function(I, E) {
		var D = !!(B.UA.ie < 7);
		if (!D || !I) {
			return
		}
		var H = E || "hover";
		C.on(I, "mouseenter", function() {
			F.addClass(this, H)
		});
		C.on(I, "mouseleave", function() {
			F.removeClass(this, H)
		})
	};
	B.IE6Hover = A
});
KISSY.add("placeHolder", function(A, G) {
	var F = A.DOM, C = A.Event, B = function(E, D) {
		if (!E) {
			return
		}
		if ("placeholder" in document.createElement("input")) {
			return
		}
		var H = F.attr(E, "placeholder"), D = D ? D : "blur";
		if (E.value === H) {
			F.addClass(E, D)
		}
		if (E.value === "") {
			F.addClass(E, D);
			E.value = H
		}
		C.on(E, "blur", function() {
			if (this.value === "") {
				F.addClass(E, D);
				this.value = H
			}
		});
		C.on(E, "focus", function() {
			if (this.value === H) {
				F.removeClass(E, D);
				this.value = ""
			}
		})
	};
	A.placeHolder = B
});
KISSY
		.add(
				"Stat",
				function(B, E, E) {
					var C = B.DOM;
					var A = function(G, F, J, I) {
						var D = (new Date()).getTime(), L = "log_" + D, K = window[L] = new Image();
						K.onload = (K.onerror = function() {
							window[L] = null
						});
						if (J) {
							K.src = J
						} else {
							var H = (F) ? "" : "sfrom=etao&";
							I = I ? I : "http://www.atpanel.com/search?";
							K.src = I + H + "t=" + D + "&" + G
						}
						K = null
					};
					A.pv = function(D, F, J, I) {
						var H = document.referrer ? "&pre="
								+ escape(document.referrer) : "", D = D ? D
								: "#J_PvStat";
						if (D) {
							var G = C.attr(D, "data-stat") + H;
							B.Stat(G, F, J, I)
						}
					};
					A.orderForm = function(F, H, G) {
						var D = B.Cookie.get("pid");
						B.Event
								.on(
										document,
										"click",
										function(U) {
											var S = U.target;
											if (S.tagName.toUpperCase() != "A") {
												S = C.parent(S, "a");
												if (!S) {
													return
												}
											}
											var T = B.trim(C.attr(S,
													"data-stat")), K = T, V = S.href, I = [
													"s.etao.com",
													"s.taobao.com",
													"search.taobao.com",
													"taobao.etao.com" ], J = I.length, M = false;
											while (J--) {
												if (V.indexOf(I[J]) > -1) {
													M = true;
													break
												}
											}
											if (T && M) {
												if (D) {
													var P = T.split("."), Q = P.length, R = 7;
													for ( var O = 0; O < R; O++) {
														if (!P[O]
																&& P[O] !== "0") {
															P.push("0")
														}
													}
													P[R - 1] = D;
													T = P.join(".")
												}
												T = "stp=" + T;
												if (V.indexOf("stp=") !== -1) {
													var L = new RegExp(
															"[&?]stp=[^&]*(&|$)",
															"i");
													S.href = V.replace(L, "$1")
												}
												S.href = (S.href.indexOf("?") === -1) ? S.href
														+ "?"
														: S.href + "&";
												S.href += T
											}
											if (K && B.Stat) {
												var N = document.referrer ? "&pre="
														+ escape(document.referrer)
														: "", K = "click=" + K
														+ N;
												B.Stat(K, F, H, G)
											}
										})
					};
					A.init = function(D, F, H, G) {
						KISSY.Stat.pv(D, F, H, G);
						KISSY.Stat.orderForm(F, H, G)
					};
					B.Stat = A
				});
var ETao = ETao || {};
ETao.Header = function() {
	var C = KISSY, D = C.DOM, A = C.Event, F = window, E = document, G = {
		getCookie : function(J) {
			var I = document.cookie.match("(?:^|;)\\s*" + J + "=([^;]*)");
			return (I && I[1]) ? decodeURIComponent(I[1]) : ""
		},
		escapeHTML : function(J) {
			var K = document.createElement("div"), I = document
					.createTextNode(J);
			K.appendChild(I);
			return K.innerHTML
		}
	};
	function B() {
		var I = C.get("#J_Logout");
		if (!I) {
			return
		}
		A.on(I, "click", function(K) {
			K.halt();
			var J = I.href;
			new Image().src = "//taobao.alipay.com/user/logout.htm";
			setTimeout(function() {
				location.href = J
			}, 20)
		})
	}
	function H(L) {
		var I = C.one(L);
		if (!I) {
			return
		}
		var J = C.one(I.children()[0]), K = J.next();
		J.on("keydown", function(M) {
			if (M.keyCode == 27) {
				M.halt(true);
				I.removeClass("hover")
			}
			if (M.keyCode == 40) {
				M.halt(true);
				I.addClass("hover")
			}
		});
		K.on("mouseleave", function(M) {
			if (I.hasClass("hover")) {
				I.removeClass("hover")
			}
		})
	}
	return {
		init : function(I) {
			B();
			C.IE6Hover("#J_moreProduct");
			C.IE6Hover("#J_Myetao");
			H("#J_moreProduct");
			H("#J_Myetao")
		},
		writeLoginInfo : function(K) {
			K = K || {};
			var L = document.domain.indexOf("daily.etao.net") > -1, P = document.domain
					.indexOf("etao.com") > -1, S = L || P, N = new Date()
					.getTime(), R = "", I = "", T = "", J = "", O = false;
			function Q() {
				var U = L ? "http://etao.daily.taobao.net"
						: "http://etao.taobao.com";
				KISSY.getScript(U + "/cookieinfo.html?t=" + N, {
					success : function() {
						if (!tbcookie) {
							M();
							return
						}
						R = tbcookie.tracknick;
						I = tbcookie._nk_ || R;
						J = tbcookie.ck1;
						T = tbcookie._l_g_;
						O = (T && I) || (J && R);
						M()
					},
					error : function() {
						M()
					}
				})
			}
			if (S) {
				R = G.getCookie("tracknick");
				login = G.getCookie("login") == "true";
				aNick = G.getCookie("a_nk");
				logintype = G.getCookie("l_t");
				if (login && aNick && logintype == "alipay") {
					I = aNick
				} else {
					I = G.getCookie("_nk_") || R;
					J = G.getCookie("ck1")
				}
				O = (login && I) || (J && R);
				if (!O && !(G.getCookie("cookie2") && G.getCookie("t"))) {
					Q()
				} else {
					M()
				}
			} else {
				R = G.getCookie("tracknick");
				I = G.getCookie("_nk_") || R;
				T = G.getCookie("_l_g_");
				J = G.getCookie("ck1");
				O = T && I || J && R;
				M()
			}
			function M() {
				var X = L ? "http://login.daily.etao.net"
						: "http://login.etao.com/", V = L ? "http://login.daily.etao.net/logout.html"
						: "http://login.etao.com/logout.html";
				var Y = location.href, W = K.redirectUrl || Y;
				if (W) {
					X += "?redirect_url=" + encodeURIComponent(W)
				}
				V += "?redirect_url=" + encodeURIComponent(W);
				var U = "";
				if (O) {
					U = '<span class="is-login sep">\u60a8\u597d\uff01<span>'
							+ G.escapeHTML(unescape(I.replace(/\\u/g, "%u")))
							+ '</span> <a rel="nofollow" id="J_Logout" data-stat="etao.etao_sy.dd.exit" href="'
							+ V + '" target="_top">\u9000\u51fa</a></span>'
				} else {
					U = '<a rel="nofollow" class="sep nav-link-item" href="http://www.etao.com/register.html" data-stat="etao.etao_sy.dd.registration" target="_top">\u6ce8\u518c</a><a rel="nofollow" class="sep nav-link-item" data-stat="etao.etao_sy.dd.alipay_login" href="'
							+ X
							+ '&logintype=alipay" target="_top">\u652f\u4ed8\u5b9d\u767b\u5f55</a><a rel="nofollow" class="sep nav-link-item" data-stat="etao.etao_sy.dd.taobao_login" href="'
							+ X
							+ '&logintype=taobao" target="_top">\u6dd8\u5b9d\u767b\u5f55</a>'
				}
				KISSY.DOM.get("#etao-nav .login-info").innerHTML = U
			}
		}
	}
}();
KISSY.ready(function(A) {
	if (A.Cookie.get("cookie2") && A.Cookie.get("t")) {
		A.later(function() {
			A.Stat(undefined, undefined, "//ally.etao.com/pass.htm")
		}, 50)
	}
});
KISSY
		.add(
				"searchTabBox",
				function(C, H) {
					var G = C.DOM, F = C.Event, B = {
						searchForm : "#J_etaoForm",
						searchInput : "#J_searchIpt",
						autosuggest : "data-suggest-api",
						stat : "data-stat-submit",
						emptyAction : "data-empty-action",
						redirect : "data-redirect",
						labelshowCls : "labelshow",
						backgroundOuter : "#J_sBgOuter",
						menu : "#J_sMenu",
						menuSelectedItem : "#J_sMenuSelected",
						menuContainer : "#J_sMenuContainer",
						menuList : "#J_sMenuList",
						currentCls : "selected",
						btnClear : "#J_sBtnClear",
						btnSubmit : "#J_sBtnSubmit",
						isSuggest : true
					}, A = function(K) {
						var Q = this;
						G = KISSY.DOM;
						F = KISSY.Event;
						KISSY.mix(Q, KISSY.EventTarget);
						Q.config = K = C.merge(B, K);
						Q.event = {
							loaded : "loaded",
							submited : "submited",
							tabChange : "tabChange",
							tabChanged : "tabChanged",
							focused : "focused"
						};
						var L = function() {
							return Q.searchInput.value === ""
									|| Q.searchInput.value === C.trim(G.attr(
											Q.searchInput, "placeholder"))
						};
						Q.searchForm = G.get(Q.config.searchForm);
						Q.menu = G.get(K.menu);
						Q.menuContainer = G.get(K.menuContainer);
						Q.menuList = G.get(K.menuList);
						Q.menuItems = G.query(K.menuList + " li");
						Q.curItem = G.filter(Q.menuItems, "." + K.currentCls)[0];
						Q.bgOuter = G.get(K.backgroundOuter);
						Q.searchInput = G.get(K.searchInput);
						Q.btnClear = G.get(K.btnClear);
						Q.btnSubmit = G.get(K.btnSubmit);
						Q.selItem = G.get(Q.config.menuSelectedItem);
						if (!(Q.searchForm && Q.bgOuter && Q.searchInput)) {
							return
						}
						var I = Q.menuItems.length;
						F.on(Q.menu, "mouseenter", function(S) {
							S.preventDefault();
							var R = S.currentTarget;
							G.addClass(R, "expand");
							G.height(Q.menuContainer, 26 * I + 12);
							G.height(Q.menuList, 26 * I + 9);
							G.addClass(G.parent(R), "expandmenu");
							if (!G.hasClass(Q.bgOuter, "focus")) {
								G.addClass(Q.bgOuter, "focus")
							}
						});
						F.on(Q.menu, "mouseleave", function(R) {
							R.preventDefault();
							N();
							Q.searchInput.focus()
						});
						var N = function() {
							G.removeClass(Q.menu, "expand");
							G.height(Q.menuContainer, 0);
							G.height(Q.menuList, 0);
							G.removeClass(G.parent(Q.menu), "expandmenu")
						};
						var O = function(R) {
							G.removeClass(R, "btn-show");
							G.addClass(R, "btn-hide")
						};
						var M = function(R) {
							G.removeClass(R, "btn-hide");
							G.addClass(R, "btn-show")
						};
						F.on(Q.btnClear, "click", function(S) {
							var R = Q.searchInput;
							G.val(R, "");
							O(Q.btnClear);
							R.focus()
						});
						F.on(Q.searchInput, "keyup", function(R) {
							if (Q.searchInput.value !== "") {
								M(Q.btnClear)
							} else {
								O(Q.btnClear)
							}
						});
						F.on(Q.searchInput, "keydown", function(R) {
							if (R.keyCode == 13) {
								R.halt(true);
								Q.fireEvent(Q.searchForm, "submit")
							}
						});
						Q.fireEvent(Q.searchInput, "keyup");
						F.on(Q, Q.event.loaded, Q.config.loaded);
						Q.loaded();
						F.on(Q.menuItems, "click", function(R) {
							Q.tabChange({
								tar : R.currentTarget,
								clickE : R
							})
						});
						var E = navigator.userAgent.toLowerCase();
						if (E.match(/iPad/i) == "ipad") {
							F.on(G.prev(Q.searchInput, "label"), "click",
									function(R) {
										Q.searchInput.focus()
									})
						}
						F.on(Q, Q.event.tabChange, function(V) {
							var W = L(), R = V.eventData.tar;
							if (G.hasClass(R, K.currentCls)) {
								V.eventData.clickE.halt(true);
								return
							}
							C.each(Q.menuItems, function(X) {
								G.removeClass(X, K.currentCls)
							});
							G.addClass(R, K.currentCls);
							N();
							G
									.html(Q.selItem, G.html(G.get("a", R))
											+ "<i></i>");
							Q.searchInput.focus();
							if (Q.suggest) {
								Q.suggest.on("beforeStart", function() {
									return false
								});
								Q.suggest = H
							}
							Q.curItem = R;
							Q.fire(Q.event.tabChanged, {
								eventData : R
							});
							var U = C.trim(G.attr(G.get(K.menuList),
									Q.config.redirect)) !== "false";
							if (!U) {
								V.eventData.clickE.halt(true);
								return
							}
							var T = G.get("a", Q.curItem), S = C.trim(G.attr(T,
									Q.config.emptyAction));
							if (!W) {
								V.eventData.clickE.halt(true);
								Q.fireEvent(Q.searchForm, "submit")
							} else {
								if (S) {
									G.get("a", Q.curItem).href = S
								} else {
									V.eventData.clickE.halt(true)
								}
							}
						});
						F.on(Q.searchForm, "submit", function(U) {
							var V = L(), T = G.get("a", Q.curItem), R = C
									.trim(G.attr(T, Q.config.emptyAction));
							if (V) {
								if (R) {
									Q.searchInput.value = "";
									this.action = R;
									G.addClass(Q.btnSubmit, "loading");
									Q.searchForm.submit()
								} else {
									U.halt(true);
									Q.searchInput.focus()
								}
							} else {
								G.addClass(Q.btnSubmit, "loading");
								this.action = G.attr(T, "href");
								Q.parseAction(this.action);
								var S = G.attr(T, Q.config.stat);
								if (C.trim(S)) {
								}
								Q.searchForm.submit()
							}
						});
						F.on(Q.searchInput, "blur", function(R) {
							if (this.value === "") {
								G.addClass(G.prev(Q.searchInput),
										Q.config.labelshowCls)
							}
							if (G.hasClass(Q.bgOuter, "focus")
									&& !G.hasClass(Q.selItem, "expand")) {
								G.removeClass(Q.bgOuter, "focus")
							}
						});
						F.on(Q.searchInput, "focus",
								function(S) {
									if (!G.hasClass(Q.bgOuter, "focus")) {
										G.addClass(Q.bgOuter, "focus")
									}
									G.removeClass(G.prev(Q.searchInput),
											Q.config.labelshowCls);
									if (Q.config.isSuggest) {
										if (Q.suggest) {
											Q.detach(S.type, arguments.callee);
											return
										}
										var R = G.attr(Q.curItem,
												Q.config.autosuggest);
										if (R && R.indexOf("area=etao") > 0) {
											C.use("suggest", function() {
												Q._initSuggest(R)
											})
										}
									}
									Q.focused()
								});
						var D = "autofocus" in document.createElement("input"), J = G
								.attr(Q.searchInput, "data-autofocus"), P = (J == "autofocus")
								|| (J == true);
						if (!D || !P) {
							if (L()) {
								G.addClass(G.prev(Q.searchInput),
										Q.config.labelshowCls)
							}
						}
						if (P) {
							Q.searchInput.focus()
						}
					};
					C
							.augment(
									A,
									{
										loaded : function() {
											this.fire(this.event.loaded)
										},
										submited : function() {
											return this
													.fire(this.event.submited)
										},
										tabChange : function(D) {
											this.fire(this.event.tabChange, {
												eventData : D
											})
										},
										focused : function() {
											this.fire(this.event.focused)
										},
										_initSuggest : function(E) {
											var D = this;
											D.suggest = new C.Suggest(
													this.searchInput,
													E,
													{
														resultFormat : "%result%",
														offset : 0
													});
											D.suggest
													.on(
															"dataReturn",
															function(I) {
																D.suggest.etaobook = I.data.etaobook;
																D.suggest.results = I.data.result
															});
											D.suggest
													.on(
															"beforeShow",
															function() {
																var J = D.suggest.etaobook, I = "";
																if (J
																		&& J.length > 0) {
																	C
																			.each(
																					J,
																					function(
																							K,
																							L) {
																						I += '<li class="ks-suggest-extra" key="'
																								+ J[L][0]
																								+ '" data-epid="'
																								+ J[L][1]
																								+ '"><span class="ks-suggest-key">'
																								+ J[L][0]
																								+ '</span><span class="suggest-star">\u2605</span><span class="suggest-author">'
																								+ J[L][2]
																								+ '</span><span class="suggest-pub">'
																								+ J[L][3]
																								+ '</span><span class="suggest-time">'
																								+ J[L][4]
																								+ "</span></li>"
																					});
																	if (D.suggest.results.length === 0) {
																		G
																				.html(
																						D.suggest.content,
																						"<ol></ol>")
																	}
																	if (I) {
																		G
																				.append(
																						G
																								.create(I),
																						D.suggest.content.firstChild)
																	}
																}
																D._keyword()
															});
											D.suggest
													.on(
															"itemSelect",
															function() {
																var K = this.selectedItem, I = G
																		.query(
																				"li",
																				this.containers), M = {};
																M.q = this.query;
																M.wq = G.attr(
																		K,
																		"key");
																M.n = C
																		.indexOf(
																				K,
																				I);
																var L = G
																		.get(
																				"a",
																				D.curItem);
																G
																		.attr(
																				L,
																				D.config.stat,
																				G
																						.attr(
																								L,
																								D.config.stat)
																						+ "&"
																						+ C
																								.param(M));
																var J = G
																		.attr(
																				K,
																				"data-epid");
																if (J) {
																	D
																			.writeHiddenInput(
																					D.searchForm,
																					"epid",
																					J);
																	D
																			.writeHiddenInput(
																					D.searchForm,
																					"v",
																					"product");
																	D
																			.writeHiddenInput(
																					D.searchForm,
																					"p",
																					"detail")
																}
															})
										},
										_keyword : function() {
											var I = this, E = this.suggest, J = E.query, D = J.length;
											C
													.each(
															G.query("li",
																	E.content),
															function(M) {
																var K = G
																		.get(
																				".ks-suggest-key",
																				M), L = G
																		.html(K);
																if (L
																		.indexOf(J) === 0) {
																	G
																			.html(
																					K,
																					L
																							.substring(
																									0,
																									D)
																							+ "<b>"
																							+ L
																									.substring(
																											D,
																											L.length)
																							+ "</b>")
																}
															})
										},
										writeHiddenInput : function(I, D, J) {
											var E = I[D];
											if (E) {
												E.value = J
											} else {
												E = G
														.create('<input type="hidden" name="'
																+ D
																+ '" value="'
																+ J + '" />');
												I.appendChild(E)
											}
											return E
										},
										parseAction : function(K) {
											if (K.indexOf("?") !== -1) {
												var I = K.substring(
														K.indexOf("?") + 1,
														K.length).split("&");
												for ( var E = 0, D = I.length; E < D; E++) {
													if (C.trim(I[E]) === "") {
														continue
													}
													var J = I[E].split("=");
													this.writeHiddenInput(
															this.searchForm,
															J[0], J[1])
												}
											}
										},
										fireEvent : function(E, I) {
											if (document.createEvent) {
												var J = document
														.createEvent("HTMLEvents");
												J.initEvent(I, false, true);
												E.dispatchEvent(J)
											} else {
												if (document.createEventObject) {
													var D = document
															.createEventObject(I);
													E.fireEvent("on" + I, D)
												}
											}
										}
									});
					C.mix(A.prototype, C.EventTarget);
					C.searchTabBox = A
				});
(function(A) {
	var C = A.unparam(window.location.search.replace("?", "")), B = "etao.com";
	if (C.refpid && /^mm_[0-9]{1,12}_[0-9]{1,12}_[0-9]{1,12}$/.test(C.refpid)) {
		A.Cookie.set("pid", C.refpid, undefined, B)
	}
	if (C.pid && /^mm_[0-9]{1,12}_[0-9]{1,12}_[0-9]{1,12}$/.test(C.pid)) {
		A.Cookie.set("pid", C.pid, undefined, B)
	}
	if (C.unid !== undefined && /^[a-zA-Z0-9]{0,32}$/.test(C.unid)) {
		A.Cookie.set("unid", C.unid, undefined, B)
	}
})(KISSY);
KISSY
		.add(
				"SidePannel",
				function(A) {
					var G = A.DOM, F = A.Event, C = A.UA;
					var B = {
						init : function(E) {
							var D = this;
									show = E.show == undefined ? "all" : E.show,
									topHtml = '<a href="#" target="_self" hidefocus="true" class="back-to-top"></a>',
									surHtml = '<span class="call-survey"></span>',
									scrollDn = {
										all : 85,
										top : 40,
										sur : 74
									}, scrollUp = {
										all : 68,
										top : 28,
										sur : 0
									};
							if (show == "top") {
								D._initHtml(topHtml);
								D._backToTop()
							} else {
								if (show == "sur") {
									D._initHtml(surHtml);
									D._survey(E)
								} else {
									D._initHtml(topHtml + surHtml);
									D._backToTop();
									D._survey(E)
								}
							}
							F.on(window, "scroll", function() {
								var H = 0, I = A.one(".back-to-top"), J = G
										.scrollTop();
								if (J >= 100) {
									if (I) {
										I.addClass("transition")
									}
									H = scrollDn[show]
								} else {
									if (J <= 10) {
										if (I) {
											I.removeClass("transition")
										}
										H = scrollUp[show]
									}
								}
								if (C.ie == 6) {
									G.css(".side-pannel", "top", G
											.viewportHeight()
											+ J - H + "px")
								}
							})
						},
						_initHtml : function(E) {
							var D = G.create('<div class="side-pannel"></div>');
							D.innerHTML = E;
							document.body.appendChild(D)
						},
						_backToTop : function() {
							if ((C.ie == 6 || C.shell == "firefox")
									&& G.scrollTop() > 100) {
								G.addClass(".back-to-top", "transition")
							}
						},
						_survey : function(E) {
							A
									.add({
										"component/survey" : {
											fullpath : "http://a.tbcdn.cn/apps/e/component/120320/survey.js",
											cssfullpath : "http://a.tbcdn.cn/apps/e/component/120224/survey.css"
										}
									});
							var D = null, H = function(J) {
								A.use("component/survey", function() {
									if (!D) {
										D = new A.Survey(E);
										D.ini()
									}
									if (J) {
										D.show()
									}
								})
							}, I = A.later(H, 1500);
							F.on(".call-survey", "click", function() {
								H(true)
							})
						}
					};
					A.SidePannel = B;
					return B
				});
(function(A) {
	A
			.ready(function() {
				if (A.DOM.get(".J_WangWang")) {
					KISSY
							.add(
									"webww",
									{
										fullpath : "http://a.tbcdn.cn/p/header/webww-min.js?t=20101201.js"
									});
					KISSY.use("webww", function() {
						if (window.Light) {
							Light.light()
						}
					})
				}
			})
})(KISSY);
KISSY.add("scollFixed", function(B, H) {
	var F = B.DOM, C = B.Event, A = {
		fixedBar : "#J_survey",
		right : 0,
		top : 0.4
	}, G = function(D) {
		if (B.UA.ie !== 6) {
			return
		}
		var E = this;
		E.config = D = B.merge(A, D);
		var I = E.config.fixedBar ? E.config.fixedBar : F
				.get(E.config.fixedBar);
		if (!I) {
			return
		}
		C.on(window, "scroll", function() {
			var J = F.viewportHeight(), L = F.scrollTop(), K = Math
					.floor(E.config.top * J)
					+ L;
			F.css(I, "top", K + "px");
			F.css(I, "right", E.config.right + "px")
		})
	};
	B.scollFixed = G
});