/*pub-1|2012-07-16 16:24:49*/
KISSY.add(
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
						var O = this;
						G = KISSY.DOM;
						F = KISSY.Event;
						KISSY.mix(O, KISSY.EventTarget);
						O.config = K = C.merge(B, K);
						O.event = {
							loaded : "loaded",
							submited : "submited",
							tabChange : "tabChange",
							tabChanged : "tabChanged",
							focused : "focused"
						};
						var L = function() {
							return O.searchInput.value === ""
									|| O.searchInput.value === C.trim(G.attr(
											O.searchInput, "placeholder"))
						};
						O.searchForm = G.get(O.config.searchForm);
						O.menu = G.get(K.menu);
						O.menuContainer = G.get(K.menuContainer);
						O.menuList = G.get(K.menuList);
						O.menuItems = G.query(K.menuList + " li");
						O.curItem = G.filter(O.menuItems, "." + K.currentCls)[0];
						O.bgOuter = G.get(K.backgroundOuter);
						O.searchInput = G.get(K.searchInput);
						O.btnClear = G.get(K.btnClear);
						O.btnSubmit = G.get(K.btnSubmit);
						O.selItem = G.get(O.config.menuSelectedItem);
						if (!(O.searchForm && O.bgOuter && O.searchInput)) {
							return
						}
						var I = O.menuItems.length;
						F.on(O.menu, "mouseenter", function(Q) {
							Q.preventDefault();
							var P = Q.currentTarget;
							G.addClass(P, "expand");
							G.height(O.menuContainer, 26 * I + 12);
							G.height(O.menuList, 26 * I + 9);
							G.addClass(G.parent(P), "expandmenu");
							if (!G.hasClass(O.bgOuter, "focus")) {
								G.addClass(O.bgOuter, "focus")
							}
						});
						F.on(O.menu, "mouseleave", function(P) {
							P.preventDefault();
							M();
							O.searchInput.focus()
						});
						var M = function() {
							G.removeClass(O.menu, "expand");
							G.height(O.menuContainer, 0);
							G.height(O.menuList, 0);
							G.removeClass(G.parent(O.menu), "expandmenu")
						};
						F.on(O.btnClear, "click", function(Q) {
							var P = O.searchInput;
							G.val(P, "");
							G.hide(O.btnClear);
							P.focus()
						});
						F.on(O.searchInput, "keyup", function(P) {
							if (O.searchInput.value !== "") {
								G.show(O.btnClear)
							} else {
								G.hide(O.btnClear)
							}
						});
						O.fireEvent(O.searchInput, "keyup");
						F.on(O, O.event.loaded, O.config.loaded);
						O.loaded();
						F.on(O.menuItems, "click", function(P) {
							O.tabChange({
								tar : P.currentTarget,
								clickE : P
							})
						});
						var E = navigator.userAgent.toLowerCase();
						if (E.match(/iPad/i) == "ipad") {
							F.on(G.prev(O.searchInput, "label"), "click",
									function(P) {
										O.searchInput.focus()
									})
						}
						F.on(O, O.event.tabChange, function(T) {
							var U = L(), P = T.eventData.tar;
							if (G.hasClass(P, K.currentCls)) {
								T.eventData.clickE.halt(true);
								return
							}
							C.each(O.menuItems, function(V) {
								G.removeClass(V, K.currentCls)
							});
							G.addClass(P, K.currentCls);
							M();
							G
									.html(O.selItem, G.html(G.get("a", P))
											+ "<i></i>");
							O.searchInput.focus();
							if (O.suggest) {
								O.suggest.on("beforeStart", function() {
									return false
								});
								O.suggest = H
							}
							O.curItem = P;
							O.fire(O.event.tabChanged, {
								eventData : P
							});
							var S = C.trim(G.attr(G.get(K.menuList),
									O.config.redirect)) !== "false";
							if (!S) {
								T.eventData.clickE.halt(true);
								return
							}
							var R = G.get("a", O.curItem), Q = C.trim(G.attr(R,
									O.config.emptyAction));
							if (!U) {
								T.eventData.clickE.halt(true);
								O.fireEvent(O.searchForm, "submit")
							} else {
								if (Q) {
									G.get("a", O.curItem).href = Q
								} else {
									T.eventData.clickE.halt(true)
								}
							}
						});
						F.on(O.searchForm, "submit", function(S) {
							var T = L(), R = G.get("a", O.curItem), P = C
									.trim(G.attr(R, O.config.emptyAction));
							if (T) {
								if (P) {
									O.searchInput.value = "";
									this.action = P;
									G.addClass(O.btnSubmit, "loading");
									return O.submited()
								} else {
									S.halt(true);
									O.searchInput.focus()
								}
							} else {
								this.action = G.attr(R, "href");
								O.parseAction(this.action);
								var Q = G.attr(R, O.config.stat);
								if (C.trim(Q)) {
								}
								return O.submited()
							}
						});
						F.on(O.searchInput, "blur", function(P) {
							if (this.value === "") {
								G.addClass(G.prev(O.searchInput),
										O.config.labelshowCls)
							}
							if (G.hasClass(O.bgOuter, "focus")
									&& !G.hasClass(O.selItem, "expand")) {
								G.removeClass(O.bgOuter, "focus")
							}
						});
						F.on(O.searchInput, "focus",
								function(Q) {
									if (!G.hasClass(O.bgOuter, "focus")) {
										G.addClass(O.bgOuter, "focus")
									}
									G.removeClass(G.prev(O.searchInput),
											O.config.labelshowCls);
									if (O.config.isSuggest) {
										if (O.suggest) {
											O.detach(Q.type, arguments.callee);
											return
										}
										var P = G.attr(O.curItem,
												O.config.autosuggest);
										if (P && P.indexOf("area=etao") > 0) {
											C.use("suggest", function() {
												O._initSuggest(P)
											})
										}
									}
									O.focused()
								});
						var D = "autofocus" in document.createElement("input"), J = G
								.attr(O.searchInput, "data-autofocus"), N = (J == "autofocus")
								|| (J == true);
						if (!D || !N) {
							if (L()) {
								G.addClass(G.prev(O.searchInput),
										O.config.labelshowCls)
							}
						}
						if (N) {
							O.searchInput.focus()
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
										clearHiddenInput : function(D) {
											var E = C.get(".inputContainer", D);
											if (!E) {
												return
											}
											G.empty(E)
										},
										writeHiddenInput : function(I, D, J) {
											var K = C.get(".inputContainer", I);
											if (!K) {
												K = G
														.create('<div class="inputContainer"></div>');
												I.appendChild(K)
											}
											var E = G
													.create('<input type="hidden" name="'
															+ D
															+ '" value="'
															+ J + '" />');
											G.append(E, K)
										},
										parseAction : function(K) {
											if (K.indexOf("?") !== -1) {
												this
														.clearHiddenInput(this.searchForm);
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
											if (document.createEventObject) {
												var D = document
														.createEventObject(I);
												E.fireEvent("on" + I, D)
											} else {
												if (document.createEvent) {
													var J = document
															.createEvent("HTMLEvents");
													J.initEvent(I, false, true);
													E.dispatchEvent(J)
												}
											}
											if (E[I]) {
												E[I]()
											}
										}
									});
					C.mix(A.prototype, C.EventTarget);
					C.searchTabBox = A
				});