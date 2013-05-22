/*pub-1|2013-04-26 10:51:21*/
KISSY.config({
	packages : [ {
		name : "gallery",
		tag : "20120520",
		path : "http://a.tbcdn.cn/s/kissy/",
		charset : "gbk"
	} ]
});
KISSY.ready(function(b) {
			b.one("#J_addFavor").on("click",
							function(g) {
								g.preventDefault();
								if (!h) {
									var h = document.title
								}
								if (!f) {
									var f = window.location.href
								}
								try {
									window.external.addFavorite(f, h)
								} catch (g) {
									try {
										window.sidebar.addPanel(h, f, "false")
									} catch (g) {
										alert("\u52a0\u5165\u6536\u85cf\u5931\u8d25\uff0c\u8bf7\u4f7f\u7528Ctrl+D\u8fdb\u884c\u6dfb\u52a0")
									}
								}
							});
			
				var e = (function() {
				var q = b.DOM, o = b.Event, n = q.create('<span class="floatMsg"></span>'), f = null, j = "";
				function g() {
					q.css(n, {
						top : "0"
					});
					b.one(n).css("opacity", 1)
				}
				function i(r, s) {
					q.html(n, s);
					q.append(n, r);
					g();
					b.one(n).fadeIn(0.4).animate({
						top : "-17px"
					}, {
						queue : false,
						complete : function() {
							b.one(n).fadeOut(0.3, g)
						}
					})
				}
				
				function k(s) {/*
					if (SNS.isTBDomain()) {
						SNS.login(s)
					} else {
						var r = b.Cookie.get("login")
								&& (b.Cookie.get("_nk_") || b.Cookie
										.get("a_nk"));
						if (r) {
							s()
						} else {
							SNS.login(function() {
								b.getScript("http://etao.taobao.com/cookieinfo.html?t="+ new Date().getTime(),
														{
															success : function() {
																if (tbcookie) {
																	var t = tbcookie._nk_
																			|| tbcookie.tracknick;
																	b.Cookie
																			.set(
																					"login",
																					true,
																					undefined,
																					"etao.com");
																	b.Cookie
																			.set(
																					"_nk_",
																					t,
																					undefined,
																					"etao.com")
																}
															}
														});
										s()
									})
						}
					}*/
				}
				
				function h(v, u, s) {
					var t, r;
					b.each(u, function(x, w) {
						t = b.get(".J_Counter", x);
						if (!t) {
							return
						}
						r = v["ZAN_27_2_" + s[w]];
						q.text(t, r)
					});
					u = null;
					s = null
				}
				
				function m(u, v) {/*
					if (typeof u === "string") {
						if (!v) {
							v = "body"
						}
						var w = b.query(u, v)
					} else {
						if (b.isArray(u)) {
							var w = u
						}
					}
					var r = [];
					b.each(w, function(x) {
						r.push(q.attr(x, "data-item"))
					});
					var s = r.join(",ZAN_27_2_"), t = "http://count.tbcdn.cn/counter3?keys=ZAN_27_2_"
							+ s;
					b.io({
						type : "get",
						dataType : "jsonp",
						url : t,
						success : function(x) {
							h(x, w, r)
						}
					}) */
				}
				function l(r, s) {/*
					o.delegate(r,"click",s,function(x) {
										x.preventDefault();
										var w = b.one(x.currentTarget), t = w
												.attr("data-link")
												|| "", v = w.attr("data-item"), u = SNS
												.isDaily() ? "http://t.daily.taobao.net/cooperate/publish_favor.do?_input_charset=utf-8&favor_type=2&comment=%E4%BA%B2%EF%BC%8C%E8%BF%99%E4%B8%AA%E4%B8%8D%E9%94%99%E5%96%94%EF%BD%9E&type=item"
												: "http://t.taobao.com/cooperate/publish_favor.do?_input_charset=utf-8&favor_type=2&comment=%E4%BA%B2%EF%BC%8C%E8%BF%99%E4%B8%AA%E4%B8%8D%E9%94%99%E5%96%94%EF%BD%9E&type=item";
										UA_Opt.Token = new Date().getTime()
												+ ":" + Math.random();
										try {
											UA_Opt.reload()
										} catch (x) {
										}
										if (!j) {
											b
													.io({
														type : "get",
														url : "http://comment.jianghu.taobao.com/json/token.htm?_fetchToken=true",
														dataType : "jsonp",
														success : function(z) {
															j = z.token;
															k(y)
														}
													})
										} else {
											k(y)
										}
										function y() {
											b
													.ajax({
														type : "get",
														url : u,
														data : {
															t : new Date()
																	.getTime(),
															linkurl : t,
															favor_target_key : v,
															key : v,
															_tb_token_ : j,
															ua : window.ua
														},
														dataType : "jsonp",
														success : function(A) {
															if (A.status == 1) {
																i(w, "+1");
																w
																		.parent(
																				".item")
																		.all(
																				".J_Trigger")
																		.addClass(
																				"done");
																if (w
																		.parent(".mask")) {
																	c("tblm.3.38");
																	var z = w
																			.parent(
																					".item")
																			.all(
																					".J_Counter")[1];
																	var z = b
																			.one(z);
																	z
																			.text(parseInt(z
																					.text()) + 1)
																} else {
																	c("tblm.3.58");
																	var z = w
																			.one(".J_Counter");
																	z
																			.text(parseInt(z
																					.text()) + 1)
																}
															} else {
																if (A.result.content
																		.indexOf("\u767b\u9646\u5931\u6548") !== -1) {
																	SNS
																			.login(
																					function() {
																					},
																					true)
																} else {
																	if (A.result.content
																			.indexOf("\u64cd\u4f5c\u672a\u6210\u529f") !== -1) {
																		SNS
																				.alert("\u64cd\u4f5c\u672a\u6210\u529f,\u5237\u65b0\u4e0b\u8bd5\u8bd5\u5427!")
																	} else {
																		if (w
																				.parent(".mask")) {
																			i(
																					w,
																					"\u5df2\u559c\u6b22");
																			c("tblm.3.38")
																		} else {
																			i(
																					w
																							.parent(),
																					"\u4F60\u5DF2\u7ECF\u559C\u6B22\u8FC7\u4E86");
																			c("tblm.3.58")
																		}
																		w
																				.parent(
																						".item")
																				.all(
																						".J_Trigger")
																				.addClass(
																						"done")
																	}
																}
															}
														}
													})
										}
									})*/
				}
				
				(function p() {
					if (!window.UA_Opt || !window.ua) {
						window.ua = "";
						window.UA_Opt = {
							LogVal : "ua",
							MaxMCLog : 2,
							MaxMPLog : 2,
							MaxKSLog : 2,
							Token : new Date().getTime() + ":" + Math.random(),
							SendMethod : 8,
							Flag : 14222
						};
						b.getScript("",
								function() {
									try {
										UA_Opt.reload()
									} catch (r) {
									}
								}, "GBK")
					}
					l("#J_waterfall", ".J_Trigger");
					m(".J_Trigger", "#J_waterfall")
				})();
				return {
					getLikeCount : m
				}
			}());
				/*
			KISSY.add("hotsale/waterfall",
							function(g, h) {
								function f(j, i) {
									this.config = g
											.mix(
													{
														load : l,
														align : "left",
														diff : 1000,
														effect : {},
														container : "#J_waterfall",
														minColCount : 4,
														colWidth : 228,
														maxScroll : 5,
														isFirefox : (g.UA.shell === "firefox") ? true
																: false
													}, i);
									this.page = 1;
									this.count = 1;
									this.back = "";
									this.posid = 0;
									this.filter = {
										ismall : 0,
										loc : "",
										gprice : "0,1000"
									};
									this.originURL = g.one(
											this.config.container).attr(
											"data-url");
									this.remote = this.getURL();
									var k = this;
									function l(m, o) {
										var p = k.config;
										k.count++;
										if (k.count > p.maxScroll) {
											return
										}
										g.one("#J_loading").show();
										g.ajax({
											data : {
												yp4p_page : k.page,
												scroll : k.count,
												back : k.back,
												posid : k.posid,
												gprice : k.filter.gprice
											},
											url : k.remote,
											dataType : "text",
											success : n,
											complete : q
										});
										function n(y) {
											var A = g.Node(y), t = [], u, C, z, w = [], v = k.config;
											if (A.length === 0) {
												o();
												return
											}
											var s = g.one(v.container);
											for ( var x = 0, B = A.length; x < B; x++) {
												u = g.Node(A[x]);
												if (u.hasClass("pagination")) {
													u.insertAfter(s)
												} else {
													if (u.hasClass("item")) {
														tempImg = g.one("img",
																u);
														z = g
																.query(
																		".J_Trigger",
																		u);
														if (v.isFirefox
																&& !tempImg
																		.attr("width")) {
															tempImg.attr({
																width : 210,
																height : 210
															})
														}
														t.push(u);
														w.push(z[1])
													} else {
														if (u.hasClass("debug")) {
															var r = g
																	.unparam(u
																			.attr("data-back"));
															k.back = r.back;
															k.posid = r.posid;
															u.prependTo(s)
														}
													}
												}
											}
											if (k.count <= v.maxScroll) {
												m(t);
												setTimeout(function() {
													e.getLikeCount(w)
												}, 600)
											}
											if (k.count >= v.maxScroll) {
												o()
											}
										}
										function q() {
											g.one("#J_loading").hide()
										}
									}
								}
								g.mix(
												f.prototype,
												{
													render : function() {
														var i = g
																.one(this.config.container);
														var k = i.all(".debug");
														if (k.length == 1) {
															var j = g
																	.unparam(k
																			.attr("data-back"));
															this.back = j.back;
															this.posid = j.posid
														}
														this.waterfall = new h.Loader(
																this.config);
														this.waterfall.on(
																"addComplete",
																function(l) {
																})
													},
													bind : function() {
														this.waterfall
																.on(
																		"adjustComplete",
																		function(
																				j) {
																			g
																					.one(
																							"#J_waterfall")
																					.css(
																							"visibility",
																							"visible")
																		});
														var i = g
																.one(this.config.container);
														if (!KISSY.UA.mobile) {
															i
																	.delegate(
																			"mouseenter",
																			".photo",
																			function(
																					l) {
																				var k = g
																						.one(l.currentTarget);
																				var j = k
																						.one(
																								"img")
																						.height();
																				k
																						.one(
																								".alpha-bg")
																						.css(
																								{
																									visibility : "visible",
																									height : j
																								});
																				k
																						.one(
																								".mask")
																						.css(
																								"visibility",
																								"visible")
																			});
															i
																	.delegate(
																			"mouseleave",
																			".photo",
																			function(
																					k) {
																				var j = g
																						.one(k.currentTarget);
																				j
																						.one(
																								".alpha-bg")
																						.css(
																								"visibility",
																								"hidden");
																				j
																						.one(
																								".mask")
																						.css(
																								"visibility",
																								"hidden")
																			})
														}
														i
																.delegate(
																		"click",
																		".photo",
																		function(
																				j) {
																			if (!g.DOM
																					.hasClass(
																							j.target,
																							"J_Trigger")) {
																				c("tblm.3.59")
																			}
																		});
														i
																.delegate(
																		"click",
																		".comment",
																		function(
																				j) {
																			c("tblm.3.57")
																		})
													},
													reload : function(j, i) {
														this.count = 0;
														this.page = j.page;
														this.back = j.back;
														this.posid = j.posid;
														this.filter = g.mix(
																this.filter,
																j.filter);
														this.remote = this
																.getURL();
														this.waterfall
																.destroy();
														this.config = g.mix(
																this.config, i);
														g
																.one(
																		this.config.container)
																.html("");
														this.waterfall = new h.Loader(
																this.config);
														this.waterfall.on(
																"addComplete",
																function(k) {
																})
													},
													getURL : function() {
														var i = this.originURL;
														i = i
																+ "&loc="
																+ this.filter.loc;
														return i
													}
												});
								return f
							}, {
								requires : [ "waterfall" ]
							});
							*/
			var d = {
				waterfall : null,
				init : function() {/*
					b.use("hotsale/waterfall", function(g, f) {
						waterfall = new f();
						g.one("#J_waterfall").css("display", "block");
						g.one("#J_waterfall").css("visibility", "hidden");
						waterfall.render();
						waterfall.bind()
					}) */
				},
				reload : function(g) {
					!g.filter ? g.filter = {} : -1;
					g.page = g.page ? g.page : waterfall.page;
					g.back = g.back ? g.back : "";
					g.posid = g.posid ? g.posid : 0;
					var f = b.one(".items-con").one(".pagination");
					if (f) {
						b.DOM.remove(f)
					}
					waterfall.reload(g)
				},
				pagination : function() {
					var f = b.DOM;
					b
							.one(".items-con")
							.delegate(
									"click",
									".pagination",
									function(k) {
										if (k.target.nodeName.toLowerCase() !== "a") {
											return
										}
										c("tblm.3.37");
										var j = k.target, g = f.parent(j), i = parseInt(b
												.one(".currentPage", g).text()), m;
										switch (b.trim(f.text(j))) {
										case "\u4E0A\u4E00\u9875":
											m = i - 1;
											break;
										case "\u4E0B\u4E00\u9875":
											m = i + 1;
											break;
										default:
											m = parseInt(f.text(j));
											break
										}
										var h = b.unparam(b.one(k.target).attr(
												"data-back"));
										var l = {
											page : m,
											back : h.back,
											posid : h.posid
										};
										d.reload(l);
										f.scrollTop(0);
										k.halt()
									})
				}
			};
			function c(g) {/*
				var f = "http://log.mmstat.com/" + g;
				(new Image()).src = f + "?logtype=2&cache="
//						+ (("" + Math.random()).substring(2)) */
			}
			
			function a() {/*
				var i = b.one("#J_hotword");
				if (i) {
					i.delegate("click", "a", function(j) {
						c("tblm.3.55")
					})
				}
				var h = b.one("#J_popword");
				h.delegate("click", "a", function(j) {
					c("tblm.3.71")
				});
				var g = b.one("#J_popDefault");
				var f = h.attr("data-param");
				b
						.ajax({
							url : "http://textlink.simba.taobao.com/lk?pid=421071_1007&refpid="
									+ f,
							data : {},
							dataType : "jsonp",
							success : function(l) {
								var j = l.data, k = [];
								b.each(j, function(o, m) {
									if (m > 9) {
										return
									}
									var n = b.DOM.create("<a>", {
										href : o[1],
										text : o[0],
										target : "_self"
									});
									k.push(n)
								});
								g.append(k)
							}
						})*/
			}
			
			(function() {
				var l = b.one(window);
				var j = 40, h = 230, k = 230;
				var f = l.outerWidth() - j - h;
				var g = parseInt(f / k);
				g < 4 ? g = 4 : -1;
				var i = g * k + h;
				b.one("#header").css("width", i);
				b.one("#content .grid-c2f").css("width", i);
				d.init();
				d.pagination();
				a();
				b.one("#J_goTop").on("click", function(m) {
					b.one(window).animate({
						scrollTop : 0
					}, 0.3, "easeNone")
				})
			}());
			
			(function() {
				var i = b.DOM, g = b.Event, f = b.get("#p4pHotshopSection"), h = b
						.get("#clk1ToJs"), j = "";
				if (!f) {
					return
				}
				if (h) {
					j = h.value
				}
				g.delegate(f, "click", "a", function(l) {
					var k = l.currentTarget;
					if (!i.attr(k, "data-init")) {
						l.preventDefault();
						k.href = k.href + "&clk1=" + j;
						i.attr(k, "data-init", "1");
						window.open(k.href, "_blank")
					}
				})
			})()
	});