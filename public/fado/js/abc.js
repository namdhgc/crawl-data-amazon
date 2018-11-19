if (! function(t, e) {
        "object" == typeof module && "object" == typeof module.exports ? module.exports = t.document ? e(t, !0) : function(t) {
            if (!t.document) throw new Error("jQuery requires a window with a document");
            return e(t)
        } : e(t)
    }("undefined" != typeof window ? window : this, function(t, e) {
        function n(t) {
            var e = !!t && "length" in t && t.length,
                n = at.type(t);
            return "function" !== n && !at.isWindow(t) && ("array" === n || 0 === e || "number" == typeof e && e > 0 && e - 1 in t)
        }

        function i(t, e, n) {
            if (at.isFunction(e)) return at.grep(t, function(t, i) {
                return !!e.call(t, i, t) !== n
            });
            if (e.nodeType) return at.grep(t, function(t) {
                return t === e !== n
            });
            if ("string" == typeof e) {
                if (mt.test(e)) return at.filter(e, t, n);
                e = at.filter(e, t)
            }
            return at.grep(t, function(t) {
                return J.call(e, t) > -1 !== n
            })
        }

        function o(t, e) {
            for (;
                (t = t[e]) && 1 !== t.nodeType;);
            return t
        }

        function a(t) {
            var e = {};
            return at.each(t.match(xt) || [], function(t, n) {
                e[n] = !0
            }), e
        }

        function r() {
            G.removeEventListener("DOMContentLoaded", r), t.removeEventListener("load", r), at.ready()
        }

        function s() {
            this.expando = at.expando + s.uid++
        }

        function l(t, e, n) {
            var i;
            if (void 0 === n && 1 === t.nodeType)
                if (i = "data-" + e.replace(Dt, "-$&").toLowerCase(), n = t.getAttribute(i), "string" == typeof n) {
                    try {
                        n = "true" === n || "false" !== n && ("null" === n ? null : +n + "" === n ? +n : Et.test(n) ? at.parseJSON(n) : n)
                    } catch (o) {}
                    kt.set(t, e, n)
                } else n = void 0;
            return n
        }

        function c(t, e, n, i) {
            var o, a = 1,
                r = 20,
                s = i ? function() {
                    return i.cur()
                } : function() {
                    return at.css(t, e, "")
                },
                l = s(),
                c = n && n[3] || (at.cssNumber[e] ? "" : "px"),
                d = (at.cssNumber[e] || "px" !== c && +l) && Ot.exec(at.css(t, e));
            if (d && d[3] !== c) {
                c = c || d[3], n = n || [], d = +l || 1;
                do a = a || ".5", d /= a, at.style(t, e, d + c); while (a !== (a = s() / l) && 1 !== a && --r)
            }
            return n && (d = +d || +l || 0, o = n[1] ? d + (n[1] + 1) * n[2] : +n[2], i && (i.unit = c, i.start = d, i.end = o)), o
        }

        function d(t, e) {
            var n = "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(e || "*") : "undefined" != typeof t.querySelectorAll ? t.querySelectorAll(e || "*") : [];
            return void 0 === e || e && at.nodeName(t, e) ? at.merge([t], n) : n
        }

        function u(t, e) {
            for (var n = 0, i = t.length; i > n; n++) _t.set(t[n], "globalEval", !e || _t.get(e[n], "globalEval"))
        }

        function p(t, e, n, i, o) {
            for (var a, r, s, l, c, p, h = e.createDocumentFragment(), f = [], m = 0, g = t.length; g > m; m++)
                if (a = t[m], a || 0 === a)
                    if ("object" === at.type(a)) at.merge(f, a.nodeType ? [a] : a);
                    else if ($t.test(a)) {
                for (r = r || h.appendChild(e.createElement("div")), s = (Pt.exec(a) || ["", ""])[1].toLowerCase(), l = Lt[s] || Lt._default, r.innerHTML = l[1] + at.htmlPrefilter(a) + l[2], p = l[0]; p--;) r = r.lastChild;
                at.merge(f, r.childNodes), r = h.firstChild, r.textContent = ""
            } else f.push(e.createTextNode(a));
            for (h.textContent = "", m = 0; a = f[m++];)
                if (i && at.inArray(a, i) > -1) o && o.push(a);
                else if (c = at.contains(a.ownerDocument, a), r = d(h.appendChild(a), "script"), c && u(r), n)
                for (p = 0; a = r[p++];) zt.test(a.type || "") && n.push(a);
            return h
        }

        function h() {
            return !0
        }

        function f() {
            return !1
        }

        function m() {
            try {
                return G.activeElement
            } catch (t) {}
        }

        function g(t, e, n, i, o, a) {
            var r, s;
            if ("object" == typeof e) {
                "string" != typeof n && (i = i || n, n = void 0);
                for (s in e) g(t, s, n, i, e[s], a);
                return t
            }
            if (null == i && null == o ? (o = n, i = n = void 0) : null == o && ("string" == typeof n ? (o = i, i = void 0) : (o = i, i = n, n = void 0)), o === !1) o = f;
            else if (!o) return t;
            return 1 === a && (r = o, o = function(t) {
                return at().off(t), r.apply(this, arguments)
            }, o.guid = r.guid || (r.guid = at.guid++)), t.each(function() {
                at.event.add(this, e, o, i, n)
            })
        }

        function v(t, e) {
            return at.nodeName(t, "table") && at.nodeName(11 !== e.nodeType ? e : e.firstChild, "tr") ? t.getElementsByTagName("tbody")[0] || t.appendChild(t.ownerDocument.createElement("tbody")) : t
        }

        function y(t) {
            return t.type = (null !== t.getAttribute("type")) + "/" + t.type, t
        }

        function w(t) {
            var e = Ut.exec(t.type);
            return e ? t.type = e[1] : t.removeAttribute("type"), t
        }

        function b(t, e) {
            var n, i, o, a, r, s, l, c;
            if (1 === e.nodeType) {
                if (_t.hasData(t) && (a = _t.access(t), r = _t.set(e, a), c = a.events)) {
                    delete r.handle, r.events = {};
                    for (o in c)
                        for (n = 0, i = c[o].length; i > n; n++) at.event.add(e, o, c[o][n])
                }
                kt.hasData(t) && (s = kt.access(t), l = at.extend({}, s), kt.set(e, l))
            }
        }

        function x(t, e) {
            var n = e.nodeName.toLowerCase();
            "input" === n && Nt.test(t.type) ? e.checked = t.checked : "input" !== n && "textarea" !== n || (e.defaultValue = t.defaultValue)
        }

        function C(t, e, n, i) {
            e = Q.apply([], e);
            var o, a, r, s, l, c, u = 0,
                h = t.length,
                f = h - 1,
                m = e[0],
                g = at.isFunction(m);
            if (g || h > 1 && "string" == typeof m && !it.checkClone && Wt.test(m)) return t.each(function(o) {
                var a = t.eq(o);
                g && (e[0] = m.call(this, o, a.html())), C(a, e, n, i)
            });
            if (h && (o = p(e, t[0].ownerDocument, !1, t, i), a = o.firstChild, 1 === o.childNodes.length && (o = a), a || i)) {
                for (r = at.map(d(o, "script"), y), s = r.length; h > u; u++) l = o, u !== f && (l = at.clone(l, !0, !0), s && at.merge(r, d(l, "script"))), n.call(t[u], l, u);
                if (s)
                    for (c = r[r.length - 1].ownerDocument, at.map(r, w), u = 0; s > u; u++) l = r[u], zt.test(l.type || "") && !_t.access(l, "globalEval") && at.contains(c, l) && (l.src ? at._evalUrl && at._evalUrl(l.src) : at.globalEval(l.textContent.replace(qt, "")))
            }
            return t
        }

        function T(t, e, n) {
            for (var i, o = e ? at.filter(e, t) : t, a = 0; null != (i = o[a]); a++) n || 1 !== i.nodeType || at.cleanData(d(i)), i.parentNode && (n && at.contains(i.ownerDocument, i) && u(d(i, "script")), i.parentNode.removeChild(i));
            return t
        }

        function S(t, e) {
            var n = at(e.createElement(t)).appendTo(e.body),
                i = at.css(n[0], "display");
            return n.detach(), i
        }

        function _(t) {
            var e = G,
                n = Vt[t];
            return n || (n = S(t, e), "none" !== n && n || (Yt = (Yt || at("<iframe frameborder='0' width='0' height='0'/>")).appendTo(e.documentElement), e = Yt[0].contentDocument, e.write(), e.close(), n = S(t, e), Yt.detach()), Vt[t] = n), n
        }

        function k(t, e, n) {
            var i, o, a, r, s = t.style;
            return n = n || Kt(t), r = n ? n.getPropertyValue(e) || n[e] : void 0, "" !== r && void 0 !== r || at.contains(t.ownerDocument, t) || (r = at.style(t, e)), n && !it.pixelMarginRight() && Gt.test(r) && Xt.test(e) && (i = s.width, o = s.minWidth, a = s.maxWidth, s.minWidth = s.maxWidth = s.width = r, r = n.width, s.width = i, s.minWidth = o, s.maxWidth = a), void 0 !== r ? r + "" : r
        }

        function E(t, e) {
            return {
                get: function() {
                    return t() ? void delete this.get : (this.get = e).apply(this, arguments)
                }
            }
        }

        function D(t) {
            if (t in ie) return t;
            for (var e = t[0].toUpperCase() + t.slice(1), n = ne.length; n--;)
                if (t = ne[n] + e, t in ie) return t
        }

        function M(t, e, n) {
            var i = Ot.exec(e);
            return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : e
        }

        function O(t, e, n, i, o) {
            for (var a = n === (i ? "border" : "content") ? 4 : "width" === e ? 1 : 0, r = 0; 4 > a; a += 2) "margin" === n && (r += at.css(t, n + It[a], !0, o)), i ? ("content" === n && (r -= at.css(t, "padding" + It[a], !0, o)), "margin" !== n && (r -= at.css(t, "border" + It[a] + "Width", !0, o))) : (r += at.css(t, "padding" + It[a], !0, o), "padding" !== n && (r += at.css(t, "border" + It[a] + "Width", !0, o)));
            return r
        }

        function I(t, e, n) {
            var i = !0,
                o = "width" === e ? t.offsetWidth : t.offsetHeight,
                a = Kt(t),
                r = "border-box" === at.css(t, "boxSizing", !1, a);
            if (0 >= o || null == o) {
                if (o = k(t, e, a), (0 > o || null == o) && (o = t.style[e]), Gt.test(o)) return o;
                i = r && (it.boxSizingReliable() || o === t.style[e]), o = parseFloat(o) || 0
            }
            return o + O(t, e, n || (r ? "border" : "content"), i, a) + "px"
        }

        function A(t, e) {
            for (var n, i, o, a = [], r = 0, s = t.length; s > r; r++) i = t[r], i.style && (a[r] = _t.get(i, "olddisplay"), n = i.style.display, e ? (a[r] || "none" !== n || (i.style.display = ""), "" === i.style.display && At(i) && (a[r] = _t.access(i, "olddisplay", _(i.nodeName)))) : (o = At(i), "none" === n && o || _t.set(i, "olddisplay", o ? n : at.css(i, "display"))));
            for (r = 0; s > r; r++) i = t[r], i.style && (e && "none" !== i.style.display && "" !== i.style.display || (i.style.display = e ? a[r] || "" : "none"));
            return t
        }

        function N(t, e, n, i, o) {
            return new N.prototype.init(t, e, n, i, o)
        }

        function P() {
            return t.setTimeout(function() {
                oe = void 0
            }), oe = at.now()
        }

        function z(t, e) {
            var n, i = 0,
                o = {
                    height: t
                };
            for (e = e ? 1 : 0; 4 > i; i += 2 - e) n = It[i], o["margin" + n] = o["padding" + n] = t;
            return e && (o.opacity = o.width = t), o
        }

        function L(t, e, n) {
            for (var i, o = (F.tweeners[e] || []).concat(F.tweeners["*"]), a = 0, r = o.length; r > a; a++)
                if (i = o[a].call(n, e, t)) return i
        }

        function $(t, e, n) {
            var i, o, a, r, s, l, c, d, u = this,
                p = {},
                h = t.style,
                f = t.nodeType && At(t),
                m = _t.get(t, "fxshow");
            n.queue || (s = at._queueHooks(t, "fx"), null == s.unqueued && (s.unqueued = 0, l = s.empty.fire, s.empty.fire = function() {
                s.unqueued || l()
            }), s.unqueued++, u.always(function() {
                u.always(function() {
                    s.unqueued--, at.queue(t, "fx").length || s.empty.fire()
                })
            })), 1 === t.nodeType && ("height" in e || "width" in e) && (n.overflow = [h.overflow, h.overflowX, h.overflowY], c = at.css(t, "display"), d = "none" === c ? _t.get(t, "olddisplay") || _(t.nodeName) : c, "inline" === d && "none" === at.css(t, "float") && (h.display = "inline-block")), n.overflow && (h.overflow = "hidden", u.always(function() {
                h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
            }));
            for (i in e)
                if (o = e[i], re.exec(o)) {
                    if (delete e[i], a = a || "toggle" === o, o === (f ? "hide" : "show")) {
                        if ("show" !== o || !m || void 0 === m[i]) continue;
                        f = !0
                    }
                    p[i] = m && m[i] || at.style(t, i)
                } else c = void 0;
            if (at.isEmptyObject(p)) "inline" === ("none" === c ? _(t.nodeName) : c) && (h.display = c);
            else {
                m ? "hidden" in m && (f = m.hidden) : m = _t.access(t, "fxshow", {}), a && (m.hidden = !f), f ? at(t).show() : u.done(function() {
                    at(t).hide()
                }), u.done(function() {
                    var e;
                    _t.remove(t, "fxshow");
                    for (e in p) at.style(t, e, p[e])
                });
                for (i in p) r = L(f ? m[i] : 0, i, u), i in m || (m[i] = r.start, f && (r.end = r.start, r.start = "width" === i || "height" === i ? 1 : 0))
            }
        }

        function B(t, e) {
            var n, i, o, a, r;
            for (n in t)
                if (i = at.camelCase(n), o = e[i], a = t[n], at.isArray(a) && (o = a[1], a = t[n] = a[0]), n !== i && (t[i] = a, delete t[n]), r = at.cssHooks[i], r && "expand" in r) {
                    a = r.expand(a), delete t[i];
                    for (n in a) n in t || (t[n] = a[n], e[n] = o)
                } else e[i] = o
        }

        function F(t, e, n) {
            var i, o, a = 0,
                r = F.prefilters.length,
                s = at.Deferred().always(function() {
                    delete l.elem
                }),
                l = function() {
                    if (o) return !1;
                    for (var e = oe || P(), n = Math.max(0, c.startTime + c.duration - e), i = n / c.duration || 0, a = 1 - i, r = 0, l = c.tweens.length; l > r; r++) c.tweens[r].run(a);
                    return s.notifyWith(t, [c, a, n]), 1 > a && l ? n : (s.resolveWith(t, [c]), !1)
                },
                c = s.promise({
                    elem: t,
                    props: at.extend({}, e),
                    opts: at.extend(!0, {
                        specialEasing: {},
                        easing: at.easing._default
                    }, n),
                    originalProperties: e,
                    originalOptions: n,
                    startTime: oe || P(),
                    duration: n.duration,
                    tweens: [],
                    createTween: function(e, n) {
                        var i = at.Tween(t, c.opts, e, n, c.opts.specialEasing[e] || c.opts.easing);
                        return c.tweens.push(i), i
                    },
                    stop: function(e) {
                        var n = 0,
                            i = e ? c.tweens.length : 0;
                        if (o) return this;
                        for (o = !0; i > n; n++) c.tweens[n].run(1);
                        return e ? (s.notifyWith(t, [c, 1, 0]), s.resolveWith(t, [c, e])) : s.rejectWith(t, [c, e]), this
                    }
                }),
                d = c.props;
            for (B(d, c.opts.specialEasing); r > a; a++)
                if (i = F.prefilters[a].call(c, t, d, c.opts)) return at.isFunction(i.stop) && (at._queueHooks(c.elem, c.opts.queue).stop = at.proxy(i.stop, i)), i;
            return at.map(d, L, c), at.isFunction(c.opts.start) && c.opts.start.call(t, c), at.fx.timer(at.extend(l, {
                elem: t,
                anim: c,
                queue: c.opts.queue
            })), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always)
        }

        function H(t) {
            return t.getAttribute && t.getAttribute("class") || ""
        }

        function j(t) {
            return function(e, n) {
                "string" != typeof e && (n = e, e = "*");
                var i, o = 0,
                    a = e.toLowerCase().match(xt) || [];
                if (at.isFunction(n))
                    for (; i = a[o++];) "+" === i[0] ? (i = i.slice(1) || "*", (t[i] = t[i] || []).unshift(n)) : (t[i] = t[i] || []).push(n)
            }
        }

        function R(t, e, n, i) {
            function o(s) {
                var l;
                return a[s] = !0, at.each(t[s] || [], function(t, s) {
                    var c = s(e, n, i);
                    return "string" != typeof c || r || a[c] ? r ? !(l = c) : void 0 : (e.dataTypes.unshift(c), o(c), !1)
                }), l
            }
            var a = {},
                r = t === ke;
            return o(e.dataTypes[0]) || !a["*"] && o("*")
        }

        function W(t, e) {
            var n, i, o = at.ajaxSettings.flatOptions || {};
            for (n in e) void 0 !== e[n] && ((o[n] ? t : i || (i = {}))[n] = e[n]);
            return i && at.extend(!0, t, i), t
        }

        function U(t, e, n) {
            for (var i, o, a, r, s = t.contents, l = t.dataTypes;
                "*" === l[0];) l.shift(), void 0 === i && (i = t.mimeType || e.getResponseHeader("Content-Type"));
            if (i)
                for (o in s)
                    if (s[o] && s[o].test(i)) {
                        l.unshift(o);
                        break
                    }
            if (l[0] in n) a = l[0];
            else {
                for (o in n) {
                    if (!l[0] || t.converters[o + " " + l[0]]) {
                        a = o;
                        break
                    }
                    r || (r = o)
                }
                a = a || r
            }
            return a ? (a !== l[0] && l.unshift(a), n[a]) : void 0
        }

        function q(t, e, n, i) {
            var o, a, r, s, l, c = {},
                d = t.dataTypes.slice();
            if (d[1])
                for (r in t.converters) c[r.toLowerCase()] = t.converters[r];
            for (a = d.shift(); a;)
                if (t.responseFields[a] && (n[t.responseFields[a]] = e), !l && i && t.dataFilter && (e = t.dataFilter(e, t.dataType)), l = a, a = d.shift())
                    if ("*" === a) a = l;
                    else if ("*" !== l && l !== a) {
                if (r = c[l + " " + a] || c["* " + a], !r)
                    for (o in c)
                        if (s = o.split(" "), s[1] === a && (r = c[l + " " + s[0]] || c["* " + s[0]])) {
                            r === !0 ? r = c[o] : c[o] !== !0 && (a = s[0], d.unshift(s[1]));
                            break
                        }
                if (r !== !0)
                    if (r && t["throws"]) e = r(e);
                    else try {
                        e = r(e)
                    } catch (u) {
                        return {
                            state: "parsererror",
                            error: r ? u : "No conversion from " + l + " to " + a
                        }
                    }
            }
            return {
                state: "success",
                data: e
            }
        }

        function Y(t, e, n, i) {
            var o;
            if (at.isArray(e)) at.each(e, function(e, o) {
                n || Oe.test(t) ? i(t, o) : Y(t + "[" + ("object" == typeof o && null != o ? e : "") + "]", o, n, i)
            });
            else if (n || "object" !== at.type(e)) i(t, e);
            else
                for (o in e) Y(t + "[" + o + "]", e[o], n, i)
        }

        function V(t) {
            return at.isWindow(t) ? t : 9 === t.nodeType && t.defaultView
        }
        var X = [],
            G = t.document,
            K = X.slice,
            Q = X.concat,
            Z = X.push,
            J = X.indexOf,
            tt = {},
            et = tt.toString,
            nt = tt.hasOwnProperty,
            it = {},
            ot = "2.2.4",
            at = function(t, e) {
                return new at.fn.init(t, e)
            },
            rt = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
            st = /^-ms-/,
            lt = /-([\da-z])/gi,
            ct = function(t, e) {
                return e.toUpperCase()
            };
        at.fn = at.prototype = {
            jquery: ot,
            constructor: at,
            selector: "",
            length: 0,
            toArray: function() {
                return K.call(this)
            },
            get: function(t) {
                return null != t ? 0 > t ? this[t + this.length] : this[t] : K.call(this)
            },
            pushStack: function(t) {
                var e = at.merge(this.constructor(), t);
                return e.prevObject = this, e.context = this.context, e
            },
            each: function(t) {
                return at.each(this, t)
            },
            map: function(t) {
                return this.pushStack(at.map(this, function(e, n) {
                    return t.call(e, n, e)
                }))
            },
            slice: function() {
                return this.pushStack(K.apply(this, arguments))
            },
            first: function() {
                return this.eq(0)
            },
            last: function() {
                return this.eq(-1)
            },
            eq: function(t) {
                var e = this.length,
                    n = +t + (0 > t ? e : 0);
                return this.pushStack(n >= 0 && e > n ? [this[n]] : [])
            },
            end: function() {
                return this.prevObject || this.constructor()
            },
            push: Z,
            sort: X.sort,
            splice: X.splice
        }, at.extend = at.fn.extend = function() {
            var t, e, n, i, o, a, r = arguments[0] || {},
                s = 1,
                l = arguments.length,
                c = !1;
            for ("boolean" == typeof r && (c = r, r = arguments[s] || {}, s++), "object" == typeof r || at.isFunction(r) || (r = {}), s === l && (r = this, s--); l > s; s++)
                if (null != (t = arguments[s]))
                    for (e in t) n = r[e], i = t[e], r !== i && (c && i && (at.isPlainObject(i) || (o = at.isArray(i))) ? (o ? (o = !1, a = n && at.isArray(n) ? n : []) : a = n && at.isPlainObject(n) ? n : {}, r[e] = at.extend(c, a, i)) : void 0 !== i && (r[e] = i));
            return r
        }, at.extend({
            expando: "jQuery" + (ot + Math.random()).replace(/\D/g, ""),
            isReady: !0,
            error: function(t) {
                throw new Error(t)
            },
            noop: function() {},
            isFunction: function(t) {
                return "function" === at.type(t)
            },
            isArray: Array.isArray,
            isWindow: function(t) {
                return null != t && t === t.window
            },
            isNumeric: function(t) {
                var e = t && t.toString();
                return !at.isArray(t) && e - parseFloat(e) + 1 >= 0
            },
            isPlainObject: function(t) {
                var e;
                if ("object" !== at.type(t) || t.nodeType || at.isWindow(t)) return !1;
                if (t.constructor && !nt.call(t, "constructor") && !nt.call(t.constructor.prototype || {}, "isPrototypeOf")) return !1;
                for (e in t);
                return void 0 === e || nt.call(t, e)
            },
            isEmptyObject: function(t) {
                var e;
                for (e in t) return !1;
                return !0
            },
            type: function(t) {
                return null == t ? t + "" : "object" == typeof t || "function" == typeof t ? tt[et.call(t)] || "object" : typeof t
            },
            globalEval: function(t) {
                var e, n = eval;
                t = at.trim(t), t && (1 === t.indexOf("use strict") ? (e = G.createElement("script"), e.text = t, G.head.appendChild(e).parentNode.removeChild(e)) : n(t))
            },
            camelCase: function(t) {
                return t.replace(st, "ms-").replace(lt, ct)
            },
            nodeName: function(t, e) {
                return t.nodeName && t.nodeName.toLowerCase() === e.toLowerCase()
            },
            each: function(t, e) {
                var i, o = 0;
                if (n(t))
                    for (i = t.length; i > o && e.call(t[o], o, t[o]) !== !1; o++);
                else
                    for (o in t)
                        if (e.call(t[o], o, t[o]) === !1) break;
                return t
            },
            trim: function(t) {
                return null == t ? "" : (t + "").replace(rt, "")
            },
            makeArray: function(t, e) {
                var i = e || [];
                return null != t && (n(Object(t)) ? at.merge(i, "string" == typeof t ? [t] : t) : Z.call(i, t)), i
            },
            inArray: function(t, e, n) {
                return null == e ? -1 : J.call(e, t, n)
            },
            merge: function(t, e) {
                for (var n = +e.length, i = 0, o = t.length; n > i; i++) t[o++] = e[i];
                return t.length = o, t
            },
            grep: function(t, e, n) {
                for (var i, o = [], a = 0, r = t.length, s = !n; r > a; a++) i = !e(t[a], a), i !== s && o.push(t[a]);
                return o
            },
            map: function(t, e, i) {
                var o, a, r = 0,
                    s = [];
                if (n(t))
                    for (o = t.length; o > r; r++) a = e(t[r], r, i), null != a && s.push(a);
                else
                    for (r in t) a = e(t[r], r, i), null != a && s.push(a);
                return Q.apply([], s)
            },
            guid: 1,
            proxy: function(t, e) {
                var n, i, o;
                return "string" == typeof e && (n = t[e], e = t, t = n), at.isFunction(t) ? (i = K.call(arguments, 2), o = function() {
                    return t.apply(e || this, i.concat(K.call(arguments)))
                }, o.guid = t.guid = t.guid || at.guid++, o) : void 0
            },
            now: Date.now,
            support: it
        }), "function" == typeof Symbol && (at.fn[Symbol.iterator] = X[Symbol.iterator]), at.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(t, e) {
            tt["[object " + e + "]"] = e.toLowerCase()
        });
        var dt = function(t) {
            function e(t, e, n, i) {
                var o, a, r, s, l, c, u, h, f = e && e.ownerDocument,
                    m = e ? e.nodeType : 9;
                if (n = n || [], "string" != typeof t || !t || 1 !== m && 9 !== m && 11 !== m) return n;
                if (!i && ((e ? e.ownerDocument || e : H) !== A && I(e), e = e || A, P)) {
                    if (11 !== m && (c = vt.exec(t)))
                        if (o = c[1]) {
                            if (9 === m) {
                                if (!(r = e.getElementById(o))) return n;
                                if (r.id === o) return n.push(r), n
                            } else if (f && (r = f.getElementById(o)) && B(e, r) && r.id === o) return n.push(r), n
                        } else {
                            if (c[2]) return Z.apply(n, e.getElementsByTagName(t)), n;
                            if ((o = c[3]) && x.getElementsByClassName && e.getElementsByClassName) return Z.apply(n, e.getElementsByClassName(o)), n
                        }
                    if (x.qsa && !q[t + " "] && (!z || !z.test(t))) {
                        if (1 !== m) f = e, h = t;
                        else if ("object" !== e.nodeName.toLowerCase()) {
                            for ((s = e.getAttribute("id")) ? s = s.replace(wt, "\\$&") : e.setAttribute("id", s = F), u = _(t), a = u.length, l = pt.test(s) ? "#" + s : "[id='" + s + "']"; a--;) u[a] = l + " " + p(u[a]);
                            h = u.join(","), f = yt.test(t) && d(e.parentNode) || e
                        }
                        if (h) try {
                            return Z.apply(n, f.querySelectorAll(h)), n
                        } catch (g) {} finally {
                            s === F && e.removeAttribute("id")
                        }
                    }
                }
                return E(t.replace(st, "$1"), e, n, i)
            }

            function n() {
                function t(n, i) {
                    return e.push(n + " ") > C.cacheLength && delete t[e.shift()], t[n + " "] = i
                }
                var e = [];
                return t
            }

            function i(t) {
                return t[F] = !0, t
            }

            function o(t) {
                var e = A.createElement("div");
                try {
                    return !!t(e)
                } catch (n) {
                    return !1
                } finally {
                    e.parentNode && e.parentNode.removeChild(e), e = null
                }
            }

            function a(t, e) {
                for (var n = t.split("|"), i = n.length; i--;) C.attrHandle[n[i]] = e
            }

            function r(t, e) {
                var n = e && t,
                    i = n && 1 === t.nodeType && 1 === e.nodeType && (~e.sourceIndex || V) - (~t.sourceIndex || V);
                if (i) return i;
                if (n)
                    for (; n = n.nextSibling;)
                        if (n === e) return -1;
                return t ? 1 : -1
            }

            function s(t) {
                return function(e) {
                    var n = e.nodeName.toLowerCase();
                    return "input" === n && e.type === t
                }
            }

            function l(t) {
                return function(e) {
                    var n = e.nodeName.toLowerCase();
                    return ("input" === n || "button" === n) && e.type === t
                }
            }

            function c(t) {
                return i(function(e) {
                    return e = +e, i(function(n, i) {
                        for (var o, a = t([], n.length, e), r = a.length; r--;) n[o = a[r]] && (n[o] = !(i[o] = n[o]))
                    })
                })
            }

            function d(t) {
                return t && "undefined" != typeof t.getElementsByTagName && t
            }

            function u() {}

            function p(t) {
                for (var e = 0, n = t.length, i = ""; n > e; e++) i += t[e].value;
                return i
            }

            function h(t, e, n) {
                var i = e.dir,
                    o = n && "parentNode" === i,
                    a = R++;
                return e.first ? function(e, n, a) {
                    for (; e = e[i];)
                        if (1 === e.nodeType || o) return t(e, n, a)
                } : function(e, n, r) {
                    var s, l, c, d = [j, a];
                    if (r) {
                        for (; e = e[i];)
                            if ((1 === e.nodeType || o) && t(e, n, r)) return !0
                    } else
                        for (; e = e[i];)
                            if (1 === e.nodeType || o) {
                                if (c = e[F] || (e[F] = {}), l = c[e.uniqueID] || (c[e.uniqueID] = {}), (s = l[i]) && s[0] === j && s[1] === a) return d[2] = s[2];
                                if (l[i] = d, d[2] = t(e, n, r)) return !0
                            }
                }
            }

            function f(t) {
                return t.length > 1 ? function(e, n, i) {
                    for (var o = t.length; o--;)
                        if (!t[o](e, n, i)) return !1;
                    return !0
                } : t[0]
            }

            function m(t, n, i) {
                for (var o = 0, a = n.length; a > o; o++) e(t, n[o], i);
                return i
            }

            function g(t, e, n, i, o) {
                for (var a, r = [], s = 0, l = t.length, c = null != e; l > s; s++)(a = t[s]) && (n && !n(a, i, o) || (r.push(a), c && e.push(s)));
                return r
            }

            function v(t, e, n, o, a, r) {
                return o && !o[F] && (o = v(o)), a && !a[F] && (a = v(a, r)), i(function(i, r, s, l) {
                    var c, d, u, p = [],
                        h = [],
                        f = r.length,
                        v = i || m(e || "*", s.nodeType ? [s] : s, []),
                        y = !t || !i && e ? v : g(v, p, t, s, l),
                        w = n ? a || (i ? t : f || o) ? [] : r : y;
                    if (n && n(y, w, s, l), o)
                        for (c = g(w, h), o(c, [], s, l), d = c.length; d--;)(u = c[d]) && (w[h[d]] = !(y[h[d]] = u));
                    if (i) {
                        if (a || t) {
                            if (a) {
                                for (c = [], d = w.length; d--;)(u = w[d]) && c.push(y[d] = u);
                                a(null, w = [], c, l)
                            }
                            for (d = w.length; d--;)(u = w[d]) && (c = a ? tt(i, u) : p[d]) > -1 && (i[c] = !(r[c] = u))
                        }
                    } else w = g(w === r ? w.splice(f, w.length) : w), a ? a(null, r, w, l) : Z.apply(r, w)
                })
            }

            function y(t) {
                for (var e, n, i, o = t.length, a = C.relative[t[0].type], r = a || C.relative[" "], s = a ? 1 : 0, l = h(function(t) {
                        return t === e
                    }, r, !0), c = h(function(t) {
                        return tt(e, t) > -1
                    }, r, !0), d = [function(t, n, i) {
                        var o = !a && (i || n !== D) || ((e = n).nodeType ? l(t, n, i) : c(t, n, i));
                        return e = null, o
                    }]; o > s; s++)
                    if (n = C.relative[t[s].type]) d = [h(f(d), n)];
                    else {
                        if (n = C.filter[t[s].type].apply(null, t[s].matches), n[F]) {
                            for (i = ++s; o > i && !C.relative[t[i].type]; i++);
                            return v(s > 1 && f(d), s > 1 && p(t.slice(0, s - 1).concat({
                                value: " " === t[s - 2].type ? "*" : ""
                            })).replace(st, "$1"), n, i > s && y(t.slice(s, i)), o > i && y(t = t.slice(i)), o > i && p(t))
                        }
                        d.push(n)
                    }
                return f(d)
            }

            function w(t, n) {
                var o = n.length > 0,
                    a = t.length > 0,
                    r = function(i, r, s, l, c) {
                        var d, u, p, h = 0,
                            f = "0",
                            m = i && [],
                            v = [],
                            y = D,
                            w = i || a && C.find.TAG("*", c),
                            b = j += null == y ? 1 : Math.random() || .1,
                            x = w.length;
                        for (c && (D = r === A || r || c); f !== x && null != (d = w[f]); f++) {
                            if (a && d) {
                                for (u = 0, r || d.ownerDocument === A || (I(d), s = !P); p = t[u++];)
                                    if (p(d, r || A, s)) {
                                        l.push(d);
                                        break
                                    }
                                c && (j = b)
                            }
                            o && ((d = !p && d) && h--, i && m.push(d))
                        }
                        if (h += f, o && f !== h) {
                            for (u = 0; p = n[u++];) p(m, v, r, s);
                            if (i) {
                                if (h > 0)
                                    for (; f--;) m[f] || v[f] || (v[f] = K.call(l));
                                v = g(v)
                            }
                            Z.apply(l, v), c && !i && v.length > 0 && h + n.length > 1 && e.uniqueSort(l)
                        }
                        return c && (j = b, D = y), m
                    };
                return o ? i(r) : r
            }
            var b, x, C, T, S, _, k, E, D, M, O, I, A, N, P, z, L, $, B, F = "sizzle" + 1 * new Date,
                H = t.document,
                j = 0,
                R = 0,
                W = n(),
                U = n(),
                q = n(),
                Y = function(t, e) {
                    return t === e && (O = !0), 0
                },
                V = 1 << 31,
                X = {}.hasOwnProperty,
                G = [],
                K = G.pop,
                Q = G.push,
                Z = G.push,
                J = G.slice,
                tt = function(t, e) {
                    for (var n = 0, i = t.length; i > n; n++)
                        if (t[n] === e) return n;
                    return -1
                },
                et = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
                nt = "[\\x20\\t\\r\\n\\f]",
                it = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
                ot = "\\[" + nt + "*(" + it + ")(?:" + nt + "*([*^$|!~]?=)" + nt + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + it + "))|)" + nt + "*\\]",
                at = ":(" + it + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + ot + ")*)|.*)\\)|)",
                rt = new RegExp(nt + "+", "g"),
                st = new RegExp("^" + nt + "+|((?:^|[^\\\\])(?:\\\\.)*)" + nt + "+$", "g"),
                lt = new RegExp("^" + nt + "*," + nt + "*"),
                ct = new RegExp("^" + nt + "*([>+~]|" + nt + ")" + nt + "*"),
                dt = new RegExp("=" + nt + "*([^\\]'\"]*?)" + nt + "*\\]", "g"),
                ut = new RegExp(at),
                pt = new RegExp("^" + it + "$"),
                ht = {
                    ID: new RegExp("^#(" + it + ")"),
                    CLASS: new RegExp("^\\.(" + it + ")"),
                    TAG: new RegExp("^(" + it + "|[*])"),
                    ATTR: new RegExp("^" + ot),
                    PSEUDO: new RegExp("^" + at),
                    CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + nt + "*(even|odd|(([+-]|)(\\d*)n|)" + nt + "*(?:([+-]|)" + nt + "*(\\d+)|))" + nt + "*\\)|)", "i"),
                    bool: new RegExp("^(?:" + et + ")$", "i"),
                    needsContext: new RegExp("^" + nt + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + nt + "*((?:-\\d)?\\d*)" + nt + "*\\)|)(?=[^-]|$)", "i")
                },
                ft = /^(?:input|select|textarea|button)$/i,
                mt = /^h\d$/i,
                gt = /^[^{]+\{\s*\[native \w/,
                vt = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
                yt = /[+~]/,
                wt = /'|\\/g,
                bt = new RegExp("\\\\([\\da-f]{1,6}" + nt + "?|(" + nt + ")|.)", "ig"),
                xt = function(t, e, n) {
                    var i = "0x" + e - 65536;
                    return i !== i || n ? e : 0 > i ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
                },
                Ct = function() {
                    I()
                };
            try {
                Z.apply(G = J.call(H.childNodes), H.childNodes), G[H.childNodes.length].nodeType
            } catch (Tt) {
                Z = {
                    apply: G.length ? function(t, e) {
                        Q.apply(t, J.call(e))
                    } : function(t, e) {
                        for (var n = t.length, i = 0; t[n++] = e[i++];);
                        t.length = n - 1
                    }
                }
            }
            x = e.support = {}, S = e.isXML = function(t) {
                var e = t && (t.ownerDocument || t).documentElement;
                return !!e && "HTML" !== e.nodeName
            }, I = e.setDocument = function(t) {
                var e, n, i = t ? t.ownerDocument || t : H;
                return i !== A && 9 === i.nodeType && i.documentElement ? (A = i, N = A.documentElement, P = !S(A), (n = A.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", Ct, !1) : n.attachEvent && n.attachEvent("onunload", Ct)), x.attributes = o(function(t) {
                    return t.className = "i", !t.getAttribute("className")
                }), x.getElementsByTagName = o(function(t) {
                    return t.appendChild(A.createComment("")), !t.getElementsByTagName("*").length
                }), x.getElementsByClassName = gt.test(A.getElementsByClassName), x.getById = o(function(t) {
                    return N.appendChild(t).id = F, !A.getElementsByName || !A.getElementsByName(F).length
                }), x.getById ? (C.find.ID = function(t, e) {
                    if ("undefined" != typeof e.getElementById && P) {
                        var n = e.getElementById(t);
                        return n ? [n] : []
                    }
                }, C.filter.ID = function(t) {
                    var e = t.replace(bt, xt);
                    return function(t) {
                        return t.getAttribute("id") === e
                    }
                }) : (delete C.find.ID, C.filter.ID = function(t) {
                    var e = t.replace(bt, xt);
                    return function(t) {
                        var n = "undefined" != typeof t.getAttributeNode && t.getAttributeNode("id");
                        return n && n.value === e
                    }
                }), C.find.TAG = x.getElementsByTagName ? function(t, e) {
                    return "undefined" != typeof e.getElementsByTagName ? e.getElementsByTagName(t) : x.qsa ? e.querySelectorAll(t) : void 0
                } : function(t, e) {
                    var n, i = [],
                        o = 0,
                        a = e.getElementsByTagName(t);
                    if ("*" === t) {
                        for (; n = a[o++];) 1 === n.nodeType && i.push(n);
                        return i
                    }
                    return a
                }, C.find.CLASS = x.getElementsByClassName && function(t, e) {
                    return "undefined" != typeof e.getElementsByClassName && P ? e.getElementsByClassName(t) : void 0
                }, L = [], z = [], (x.qsa = gt.test(A.querySelectorAll)) && (o(function(t) {
                    N.appendChild(t).innerHTML = "<a id='" + F + "'></a><select id='" + F + "-\r\\' msallowcapture=''><option selected=''></option></select>", t.querySelectorAll("[msallowcapture^='']").length && z.push("[*^$]=" + nt + "*(?:''|\"\")"), t.querySelectorAll("[selected]").length || z.push("\\[" + nt + "*(?:value|" + et + ")"), t.querySelectorAll("[id~=" + F + "-]").length || z.push("~="), t.querySelectorAll(":checked").length || z.push(":checked"), t.querySelectorAll("a#" + F + "+*").length || z.push(".#.+[+~]")
                }), o(function(t) {
                    var e = A.createElement("input");
                    e.setAttribute("type", "hidden"), t.appendChild(e).setAttribute("name", "D"), t.querySelectorAll("[name=d]").length && z.push("name" + nt + "*[*^$|!~]?="), t.querySelectorAll(":enabled").length || z.push(":enabled", ":disabled"), t.querySelectorAll("*,:x"), z.push(",.*:")
                })), (x.matchesSelector = gt.test($ = N.matches || N.webkitMatchesSelector || N.mozMatchesSelector || N.oMatchesSelector || N.msMatchesSelector)) && o(function(t) {
                    x.disconnectedMatch = $.call(t, "div"), $.call(t, "[s!='']:x"), L.push("!=", at)
                }), z = z.length && new RegExp(z.join("|")), L = L.length && new RegExp(L.join("|")), e = gt.test(N.compareDocumentPosition), B = e || gt.test(N.contains) ? function(t, e) {
                    var n = 9 === t.nodeType ? t.documentElement : t,
                        i = e && e.parentNode;
                    return t === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : t.compareDocumentPosition && 16 & t.compareDocumentPosition(i)))
                } : function(t, e) {
                    if (e)
                        for (; e = e.parentNode;)
                            if (e === t) return !0;
                    return !1
                }, Y = e ? function(t, e) {
                    if (t === e) return O = !0, 0;
                    var n = !t.compareDocumentPosition - !e.compareDocumentPosition;
                    return n ? n : (n = (t.ownerDocument || t) === (e.ownerDocument || e) ? t.compareDocumentPosition(e) : 1, 1 & n || !x.sortDetached && e.compareDocumentPosition(t) === n ? t === A || t.ownerDocument === H && B(H, t) ? -1 : e === A || e.ownerDocument === H && B(H, e) ? 1 : M ? tt(M, t) - tt(M, e) : 0 : 4 & n ? -1 : 1)
                } : function(t, e) {
                    if (t === e) return O = !0, 0;
                    var n, i = 0,
                        o = t.parentNode,
                        a = e.parentNode,
                        s = [t],
                        l = [e];
                    if (!o || !a) return t === A ? -1 : e === A ? 1 : o ? -1 : a ? 1 : M ? tt(M, t) - tt(M, e) : 0;
                    if (o === a) return r(t, e);
                    for (n = t; n = n.parentNode;) s.unshift(n);
                    for (n = e; n = n.parentNode;) l.unshift(n);
                    for (; s[i] === l[i];) i++;
                    return i ? r(s[i], l[i]) : s[i] === H ? -1 : l[i] === H ? 1 : 0
                }, A) : A
            }, e.matches = function(t, n) {
                return e(t, null, null, n)
            }, e.matchesSelector = function(t, n) {
                if ((t.ownerDocument || t) !== A && I(t), n = n.replace(dt, "='$1']"), x.matchesSelector && P && !q[n + " "] && (!L || !L.test(n)) && (!z || !z.test(n))) try {
                    var i = $.call(t, n);
                    if (i || x.disconnectedMatch || t.document && 11 !== t.document.nodeType) return i
                } catch (o) {}
                return e(n, A, null, [t]).length > 0
            }, e.contains = function(t, e) {
                return (t.ownerDocument || t) !== A && I(t), B(t, e)
            }, e.attr = function(t, e) {
                (t.ownerDocument || t) !== A && I(t);
                var n = C.attrHandle[e.toLowerCase()],
                    i = n && X.call(C.attrHandle, e.toLowerCase()) ? n(t, e, !P) : void 0;
                return void 0 !== i ? i : x.attributes || !P ? t.getAttribute(e) : (i = t.getAttributeNode(e)) && i.specified ? i.value : null
            }, e.error = function(t) {
                throw new Error("Syntax error, unrecognized expression: " + t)
            }, e.uniqueSort = function(t) {
                var e, n = [],
                    i = 0,
                    o = 0;
                if (O = !x.detectDuplicates, M = !x.sortStable && t.slice(0), t.sort(Y), O) {
                    for (; e = t[o++];) e === t[o] && (i = n.push(o));
                    for (; i--;) t.splice(n[i], 1)
                }
                return M = null, t
            }, T = e.getText = function(t) {
                var e, n = "",
                    i = 0,
                    o = t.nodeType;
                if (o) {
                    if (1 === o || 9 === o || 11 === o) {
                        if ("string" == typeof t.textContent) return t.textContent;
                        for (t = t.firstChild; t; t = t.nextSibling) n += T(t)
                    } else if (3 === o || 4 === o) return t.nodeValue
                } else
                    for (; e = t[i++];) n += T(e);
                return n
            }, C = e.selectors = {
                cacheLength: 50,
                createPseudo: i,
                match: ht,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(t) {
                        return t[1] = t[1].replace(bt, xt), t[3] = (t[3] || t[4] || t[5] || "").replace(bt, xt), "~=" === t[2] && (t[3] = " " + t[3] + " "), t.slice(0, 4)
                    },
                    CHILD: function(t) {
                        return t[1] = t[1].toLowerCase(), "nth" === t[1].slice(0, 3) ? (t[3] || e.error(t[0]), t[4] = +(t[4] ? t[5] + (t[6] || 1) : 2 * ("even" === t[3] || "odd" === t[3])), t[5] = +(t[7] + t[8] || "odd" === t[3])) : t[3] && e.error(t[0]), t
                    },
                    PSEUDO: function(t) {
                        var e, n = !t[6] && t[2];
                        return ht.CHILD.test(t[0]) ? null : (t[3] ? t[2] = t[4] || t[5] || "" : n && ut.test(n) && (e = _(n, !0)) && (e = n.indexOf(")", n.length - e) - n.length) && (t[0] = t[0].slice(0, e), t[2] = n.slice(0, e)), t.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function(t) {
                        var e = t.replace(bt, xt).toLowerCase();
                        return "*" === t ? function() {
                            return !0
                        } : function(t) {
                            return t.nodeName && t.nodeName.toLowerCase() === e
                        }
                    },
                    CLASS: function(t) {
                        var e = W[t + " "];
                        return e || (e = new RegExp("(^|" + nt + ")" + t + "(" + nt + "|$)")) && W(t, function(t) {
                            return e.test("string" == typeof t.className && t.className || "undefined" != typeof t.getAttribute && t.getAttribute("class") || "")
                        })
                    },
                    ATTR: function(t, n, i) {
                        return function(o) {
                            var a = e.attr(o, t);
                            return null == a ? "!=" === n : !n || (a += "", "=" === n ? a === i : "!=" === n ? a !== i : "^=" === n ? i && 0 === a.indexOf(i) : "*=" === n ? i && a.indexOf(i) > -1 : "$=" === n ? i && a.slice(-i.length) === i : "~=" === n ? (" " + a.replace(rt, " ") + " ").indexOf(i) > -1 : "|=" === n && (a === i || a.slice(0, i.length + 1) === i + "-"))
                        }
                    },
                    CHILD: function(t, e, n, i, o) {
                        var a = "nth" !== t.slice(0, 3),
                            r = "last" !== t.slice(-4),
                            s = "of-type" === e;
                        return 1 === i && 0 === o ? function(t) {
                            return !!t.parentNode
                        } : function(e, n, l) {
                            var c, d, u, p, h, f, m = a !== r ? "nextSibling" : "previousSibling",
                                g = e.parentNode,
                                v = s && e.nodeName.toLowerCase(),
                                y = !l && !s,
                                w = !1;
                            if (g) {
                                if (a) {
                                    for (; m;) {
                                        for (p = e; p = p[m];)
                                            if (s ? p.nodeName.toLowerCase() === v : 1 === p.nodeType) return !1;
                                        f = m = "only" === t && !f && "nextSibling"
                                    }
                                    return !0
                                }
                                if (f = [r ? g.firstChild : g.lastChild], r && y) {
                                    for (p = g, u = p[F] || (p[F] = {}), d = u[p.uniqueID] || (u[p.uniqueID] = {}), c = d[t] || [], h = c[0] === j && c[1], w = h && c[2], p = h && g.childNodes[h]; p = ++h && p && p[m] || (w = h = 0) || f.pop();)
                                        if (1 === p.nodeType && ++w && p === e) {
                                            d[t] = [j, h, w];
                                            break
                                        }
                                } else if (y && (p = e, u = p[F] || (p[F] = {}), d = u[p.uniqueID] || (u[p.uniqueID] = {}), c = d[t] || [], h = c[0] === j && c[1], w = h), w === !1)
                                    for (;
                                        (p = ++h && p && p[m] || (w = h = 0) || f.pop()) && ((s ? p.nodeName.toLowerCase() !== v : 1 !== p.nodeType) || !++w || (y && (u = p[F] || (p[F] = {}), d = u[p.uniqueID] || (u[p.uniqueID] = {}), d[t] = [j, w]), p !== e)););
                                return w -= o, w === i || w % i === 0 && w / i >= 0
                            }
                        }
                    },
                    PSEUDO: function(t, n) {
                        var o, a = C.pseudos[t] || C.setFilters[t.toLowerCase()] || e.error("unsupported pseudo: " + t);
                        return a[F] ? a(n) : a.length > 1 ? (o = [t, t, "", n], C.setFilters.hasOwnProperty(t.toLowerCase()) ? i(function(t, e) {
                            for (var i, o = a(t, n), r = o.length; r--;) i = tt(t, o[r]), t[i] = !(e[i] = o[r])
                        }) : function(t) {
                            return a(t, 0, o)
                        }) : a
                    }
                },
                pseudos: {
                    not: i(function(t) {
                        var e = [],
                            n = [],
                            o = k(t.replace(st, "$1"));
                        return o[F] ? i(function(t, e, n, i) {
                            for (var a, r = o(t, null, i, []), s = t.length; s--;)(a = r[s]) && (t[s] = !(e[s] = a))
                        }) : function(t, i, a) {
                            return e[0] = t, o(e, null, a, n), e[0] = null, !n.pop()
                        }
                    }),
                    has: i(function(t) {
                        return function(n) {
                            return e(t, n).length > 0
                        }
                    }),
                    contains: i(function(t) {
                        return t = t.replace(bt, xt),
                            function(e) {
                                return (e.textContent || e.innerText || T(e)).indexOf(t) > -1
                            }
                    }),
                    lang: i(function(t) {
                        return pt.test(t || "") || e.error("unsupported lang: " + t), t = t.replace(bt, xt).toLowerCase(),
                            function(e) {
                                var n;
                                do
                                    if (n = P ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return n = n.toLowerCase(), n === t || 0 === n.indexOf(t + "-"); while ((e = e.parentNode) && 1 === e.nodeType);
                                return !1
                            }
                    }),
                    target: function(e) {
                        var n = t.location && t.location.hash;
                        return n && n.slice(1) === e.id
                    },
                    root: function(t) {
                        return t === N
                    },
                    focus: function(t) {
                        return t === A.activeElement && (!A.hasFocus || A.hasFocus()) && !!(t.type || t.href || ~t.tabIndex)
                    },
                    enabled: function(t) {
                        return t.disabled === !1
                    },
                    disabled: function(t) {
                        return t.disabled === !0
                    },
                    checked: function(t) {
                        var e = t.nodeName.toLowerCase();
                        return "input" === e && !!t.checked || "option" === e && !!t.selected
                    },
                    selected: function(t) {
                        return t.parentNode && t.parentNode.selectedIndex, t.selected === !0
                    },
                    empty: function(t) {
                        for (t = t.firstChild; t; t = t.nextSibling)
                            if (t.nodeType < 6) return !1;
                        return !0
                    },
                    parent: function(t) {
                        return !C.pseudos.empty(t)
                    },
                    header: function(t) {
                        return mt.test(t.nodeName)
                    },
                    input: function(t) {
                        return ft.test(t.nodeName)
                    },
                    button: function(t) {
                        var e = t.nodeName.toLowerCase();
                        return "input" === e && "button" === t.type || "button" === e
                    },
                    text: function(t) {
                        var e;
                        return "input" === t.nodeName.toLowerCase() && "text" === t.type && (null == (e = t.getAttribute("type")) || "text" === e.toLowerCase())
                    },
                    first: c(function() {
                        return [0]
                    }),
                    last: c(function(t, e) {
                        return [e - 1]
                    }),
                    eq: c(function(t, e, n) {
                        return [0 > n ? n + e : n]
                    }),
                    even: c(function(t, e) {
                        for (var n = 0; e > n; n += 2) t.push(n);
                        return t
                    }),
                    odd: c(function(t, e) {
                        for (var n = 1; e > n; n += 2) t.push(n);
                        return t
                    }),
                    lt: c(function(t, e, n) {
                        for (var i = 0 > n ? n + e : n; --i >= 0;) t.push(i);
                        return t
                    }),
                    gt: c(function(t, e, n) {
                        for (var i = 0 > n ? n + e : n; ++i < e;) t.push(i);
                        return t
                    })
                }
            }, C.pseudos.nth = C.pseudos.eq;
            for (b in {
                    radio: !0,
                    checkbox: !0,
                    file: !0,
                    password: !0,
                    image: !0
                }) C.pseudos[b] = s(b);
            for (b in {
                    submit: !0,
                    reset: !0
                }) C.pseudos[b] = l(b);
            return u.prototype = C.filters = C.pseudos, C.setFilters = new u, _ = e.tokenize = function(t, n) {
                var i, o, a, r, s, l, c, d = U[t + " "];
                if (d) return n ? 0 : d.slice(0);
                for (s = t, l = [], c = C.preFilter; s;) {
                    i && !(o = lt.exec(s)) || (o && (s = s.slice(o[0].length) || s), l.push(a = [])), i = !1, (o = ct.exec(s)) && (i = o.shift(), a.push({
                        value: i,
                        type: o[0].replace(st, " ")
                    }), s = s.slice(i.length));
                    for (r in C.filter) !(o = ht[r].exec(s)) || c[r] && !(o = c[r](o)) || (i = o.shift(), a.push({
                        value: i,
                        type: r,
                        matches: o
                    }), s = s.slice(i.length));
                    if (!i) break
                }
                return n ? s.length : s ? e.error(t) : U(t, l).slice(0)
            }, k = e.compile = function(t, e) {
                var n, i = [],
                    o = [],
                    a = q[t + " "];
                if (!a) {
                    for (e || (e = _(t)), n = e.length; n--;) a = y(e[n]), a[F] ? i.push(a) : o.push(a);
                    a = q(t, w(o, i)), a.selector = t
                }
                return a
            }, E = e.select = function(t, e, n, i) {
                var o, a, r, s, l, c = "function" == typeof t && t,
                    u = !i && _(t = c.selector || t);
                if (n = n || [], 1 === u.length) {
                    if (a = u[0] = u[0].slice(0), a.length > 2 && "ID" === (r = a[0]).type && x.getById && 9 === e.nodeType && P && C.relative[a[1].type]) {
                        if (e = (C.find.ID(r.matches[0].replace(bt, xt), e) || [])[0], !e) return n;
                        c && (e = e.parentNode), t = t.slice(a.shift().value.length)
                    }
                    for (o = ht.needsContext.test(t) ? 0 : a.length; o-- && (r = a[o], !C.relative[s = r.type]);)
                        if ((l = C.find[s]) && (i = l(r.matches[0].replace(bt, xt), yt.test(a[0].type) && d(e.parentNode) || e))) {
                            if (a.splice(o, 1), t = i.length && p(a), !t) return Z.apply(n, i), n;
                            break
                        }
                }
                return (c || k(t, u))(i, e, !P, n, !e || yt.test(t) && d(e.parentNode) || e), n
            }, x.sortStable = F.split("").sort(Y).join("") === F, x.detectDuplicates = !!O, I(), x.sortDetached = o(function(t) {
                return 1 & t.compareDocumentPosition(A.createElement("div"))
            }), o(function(t) {
                return t.innerHTML = "<a href='#'></a>", "#" === t.firstChild.getAttribute("href")
            }) || a("type|href|height|width", function(t, e, n) {
                return n ? void 0 : t.getAttribute(e, "type" === e.toLowerCase() ? 1 : 2)
            }), x.attributes && o(function(t) {
                return t.innerHTML = "<input/>", t.firstChild.setAttribute("value", ""), "" === t.firstChild.getAttribute("value")
            }) || a("value", function(t, e, n) {
                return n || "input" !== t.nodeName.toLowerCase() ? void 0 : t.defaultValue
            }), o(function(t) {
                return null == t.getAttribute("disabled")
            }) || a(et, function(t, e, n) {
                var i;
                return n ? void 0 : t[e] === !0 ? e.toLowerCase() : (i = t.getAttributeNode(e)) && i.specified ? i.value : null
            }), e
        }(t);
        at.find = dt, at.expr = dt.selectors, at.expr[":"] = at.expr.pseudos, at.uniqueSort = at.unique = dt.uniqueSort, at.text = dt.getText, at.isXMLDoc = dt.isXML, at.contains = dt.contains;
        var ut = function(t, e, n) {
                for (var i = [], o = void 0 !== n;
                    (t = t[e]) && 9 !== t.nodeType;)
                    if (1 === t.nodeType) {
                        if (o && at(t).is(n)) break;
                        i.push(t)
                    }
                return i
            },
            pt = function(t, e) {
                for (var n = []; t; t = t.nextSibling) 1 === t.nodeType && t !== e && n.push(t);
                return n
            },
            ht = at.expr.match.needsContext,
            ft = /^<([\w-]+)\s*\/?>(?:<\/\1>|)$/,
            mt = /^.[^:#\[\.,]*$/;
        at.filter = function(t, e, n) {
            var i = e[0];
            return n && (t = ":not(" + t + ")"), 1 === e.length && 1 === i.nodeType ? at.find.matchesSelector(i, t) ? [i] : [] : at.find.matches(t, at.grep(e, function(t) {
                return 1 === t.nodeType
            }))
        }, at.fn.extend({
            find: function(t) {
                var e, n = this.length,
                    i = [],
                    o = this;
                if ("string" != typeof t) return this.pushStack(at(t).filter(function() {
                    for (e = 0; n > e; e++)
                        if (at.contains(o[e], this)) return !0
                }));
                for (e = 0; n > e; e++) at.find(t, o[e], i);
                return i = this.pushStack(n > 1 ? at.unique(i) : i), i.selector = this.selector ? this.selector + " " + t : t, i
            },
            filter: function(t) {
                return this.pushStack(i(this, t || [], !1))
            },
            not: function(t) {
                return this.pushStack(i(this, t || [], !0))
            },
            is: function(t) {
                return !!i(this, "string" == typeof t && ht.test(t) ? at(t) : t || [], !1).length
            }
        });
        var gt, vt = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
            yt = at.fn.init = function(t, e, n) {
                var i, o;
                if (!t) return this;
                if (n = n || gt, "string" == typeof t) {
                    if (i = "<" === t[0] && ">" === t[t.length - 1] && t.length >= 3 ? [null, t, null] : vt.exec(t), !i || !i[1] && e) return !e || e.jquery ? (e || n).find(t) : this.constructor(e).find(t);
                    if (i[1]) {
                        if (e = e instanceof at ? e[0] : e, at.merge(this, at.parseHTML(i[1], e && e.nodeType ? e.ownerDocument || e : G, !0)), ft.test(i[1]) && at.isPlainObject(e))
                            for (i in e) at.isFunction(this[i]) ? this[i](e[i]) : this.attr(i, e[i]);
                        return this
                    }
                    return o = G.getElementById(i[2]), o && o.parentNode && (this.length = 1, this[0] = o), this.context = G, this.selector = t, this
                }
                return t.nodeType ? (this.context = this[0] = t, this.length = 1, this) : at.isFunction(t) ? void 0 !== n.ready ? n.ready(t) : t(at) : (void 0 !== t.selector && (this.selector = t.selector, this.context = t.context), at.makeArray(t, this))
            };
        yt.prototype = at.fn, gt = at(G);
        var wt = /^(?:parents|prev(?:Until|All))/,
            bt = {
                children: !0,
                contents: !0,
                next: !0,
                prev: !0
            };
        at.fn.extend({
            has: function(t) {
                var e = at(t, this),
                    n = e.length;
                return this.filter(function() {
                    for (var t = 0; n > t; t++)
                        if (at.contains(this, e[t])) return !0
                })
            },
            closest: function(t, e) {
                for (var n, i = 0, o = this.length, a = [], r = ht.test(t) || "string" != typeof t ? at(t, e || this.context) : 0; o > i; i++)
                    for (n = this[i]; n && n !== e; n = n.parentNode)
                        if (n.nodeType < 11 && (r ? r.index(n) > -1 : 1 === n.nodeType && at.find.matchesSelector(n, t))) {
                            a.push(n);
                            break
                        }
                return this.pushStack(a.length > 1 ? at.uniqueSort(a) : a)
            },
            index: function(t) {
                return t ? "string" == typeof t ? J.call(at(t), this[0]) : J.call(this, t.jquery ? t[0] : t) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
            },
            add: function(t, e) {
                return this.pushStack(at.uniqueSort(at.merge(this.get(), at(t, e))))
            },
            addBack: function(t) {
                return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
            }
        }), at.each({
            parent: function(t) {
                var e = t.parentNode;
                return e && 11 !== e.nodeType ? e : null
            },
            parents: function(t) {
                return ut(t, "parentNode")
            },
            parentsUntil: function(t, e, n) {
                return ut(t, "parentNode", n)
            },
            next: function(t) {
                return o(t, "nextSibling")
            },
            prev: function(t) {
                return o(t, "previousSibling")
            },
            nextAll: function(t) {
                return ut(t, "nextSibling")
            },
            prevAll: function(t) {
                return ut(t, "previousSibling")
            },
            nextUntil: function(t, e, n) {
                return ut(t, "nextSibling", n)
            },
            prevUntil: function(t, e, n) {
                return ut(t, "previousSibling", n)
            },
            siblings: function(t) {
                return pt((t.parentNode || {}).firstChild, t)
            },
            children: function(t) {
                return pt(t.firstChild)
            },
            contents: function(t) {
                return t.contentDocument || at.merge([], t.childNodes)
            }
        }, function(t, e) {
            at.fn[t] = function(n, i) {
                var o = at.map(this, e, n);
                return "Until" !== t.slice(-5) && (i = n), i && "string" == typeof i && (o = at.filter(i, o)), this.length > 1 && (bt[t] || at.uniqueSort(o), wt.test(t) && o.reverse()), this.pushStack(o)
            }
        });
        var xt = /\S+/g;
        at.Callbacks = function(t) {
            t = "string" == typeof t ? a(t) : at.extend({}, t);
            var e, n, i, o, r = [],
                s = [],
                l = -1,
                c = function() {
                    for (o = t.once, i = e = !0; s.length; l = -1)
                        for (n = s.shift(); ++l < r.length;) r[l].apply(n[0], n[1]) === !1 && t.stopOnFalse && (l = r.length, n = !1);
                    t.memory || (n = !1), e = !1, o && (r = n ? [] : "")
                },
                d = {
                    add: function() {
                        return r && (n && !e && (l = r.length - 1, s.push(n)), function i(e) {
                            at.each(e, function(e, n) {
                                at.isFunction(n) ? t.unique && d.has(n) || r.push(n) : n && n.length && "string" !== at.type(n) && i(n)
                            })
                        }(arguments), n && !e && c()), this
                    },
                    remove: function() {
                        return at.each(arguments, function(t, e) {
                            for (var n;
                                (n = at.inArray(e, r, n)) > -1;) r.splice(n, 1), l >= n && l--
                        }), this
                    },
                    has: function(t) {
                        return t ? at.inArray(t, r) > -1 : r.length > 0
                    },
                    empty: function() {
                        return r && (r = []), this
                    },
                    disable: function() {
                        return o = s = [], r = n = "", this
                    },
                    disabled: function() {
                        return !r
                    },
                    lock: function() {
                        return o = s = [], n || (r = n = ""), this
                    },
                    locked: function() {
                        return !!o
                    },
                    fireWith: function(t, n) {
                        return o || (n = n || [], n = [t, n.slice ? n.slice() : n], s.push(n), e || c()), this
                    },
                    fire: function() {
                        return d.fireWith(this, arguments), this
                    },
                    fired: function() {
                        return !!i
                    }
                };
            return d
        }, at.extend({
            Deferred: function(t) {
                var e = [
                        ["resolve", "done", at.Callbacks("once memory"), "resolved"],
                        ["reject", "fail", at.Callbacks("once memory"), "rejected"],
                        ["notify", "progress", at.Callbacks("memory")]
                    ],
                    n = "pending",
                    i = {
                        state: function() {
                            return n
                        },
                        always: function() {
                            return o.done(arguments).fail(arguments), this
                        },
                        then: function() {
                            var t = arguments;
                            return at.Deferred(function(n) {
                                at.each(e, function(e, a) {
                                    var r = at.isFunction(t[e]) && t[e];
                                    o[a[1]](function() {
                                        var t = r && r.apply(this, arguments);
                                        t && at.isFunction(t.promise) ? t.promise().progress(n.notify).done(n.resolve).fail(n.reject) : n[a[0] + "With"](this === i ? n.promise() : this, r ? [t] : arguments)
                                    })
                                }), t = null
                            }).promise()
                        },
                        promise: function(t) {
                            return null != t ? at.extend(t, i) : i
                        }
                    },
                    o = {};
                return i.pipe = i.then, at.each(e, function(t, a) {
                    var r = a[2],
                        s = a[3];
                    i[a[1]] = r.add, s && r.add(function() {
                        n = s
                    }, e[1 ^ t][2].disable, e[2][2].lock), o[a[0]] = function() {
                        return o[a[0] + "With"](this === o ? i : this, arguments), this
                    }, o[a[0] + "With"] = r.fireWith
                }), i.promise(o), t && t.call(o, o), o
            },
            when: function(t) {
                var e, n, i, o = 0,
                    a = K.call(arguments),
                    r = a.length,
                    s = 1 !== r || t && at.isFunction(t.promise) ? r : 0,
                    l = 1 === s ? t : at.Deferred(),
                    c = function(t, n, i) {
                        return function(o) {
                            n[t] = this, i[t] = arguments.length > 1 ? K.call(arguments) : o, i === e ? l.notifyWith(n, i) : --s || l.resolveWith(n, i)
                        }
                    };
                if (r > 1)
                    for (e = new Array(r), n = new Array(r), i = new Array(r); r > o; o++) a[o] && at.isFunction(a[o].promise) ? a[o].promise().progress(c(o, n, e)).done(c(o, i, a)).fail(l.reject) : --s;
                return s || l.resolveWith(i, a), l.promise()
            }
        });
        var Ct;
        at.fn.ready = function(t) {
            return at.ready.promise().done(t), this
        }, at.extend({
            isReady: !1,
            readyWait: 1,
            holdReady: function(t) {
                t ? at.readyWait++ : at.ready(!0)
            },
            ready: function(t) {
                (t === !0 ? --at.readyWait : at.isReady) || (at.isReady = !0, t !== !0 && --at.readyWait > 0 || (Ct.resolveWith(G, [at]), at.fn.triggerHandler && (at(G).triggerHandler("ready"), at(G).off("ready"))))
            }
        }), at.ready.promise = function(e) {
            return Ct || (Ct = at.Deferred(), "complete" === G.readyState || "loading" !== G.readyState && !G.documentElement.doScroll ? t.setTimeout(at.ready) : (G.addEventListener("DOMContentLoaded", r), t.addEventListener("load", r))), Ct.promise(e)
        }, at.ready.promise();
        var Tt = function(t, e, n, i, o, a, r) {
                var s = 0,
                    l = t.length,
                    c = null == n;
                if ("object" === at.type(n)) {
                    o = !0;
                    for (s in n) Tt(t, e, s, n[s], !0, a, r)
                } else if (void 0 !== i && (o = !0, at.isFunction(i) || (r = !0), c && (r ? (e.call(t, i), e = null) : (c = e, e = function(t, e, n) {
                        return c.call(at(t), n)
                    })), e))
                    for (; l > s; s++) e(t[s], n, r ? i : i.call(t[s], s, e(t[s], n)));
                return o ? t : c ? e.call(t) : l ? e(t[0], n) : a
            },
            St = function(t) {
                return 1 === t.nodeType || 9 === t.nodeType || !+t.nodeType
            };
        s.uid = 1, s.prototype = {
            register: function(t, e) {
                var n = e || {};
                return t.nodeType ? t[this.expando] = n : Object.defineProperty(t, this.expando, {
                    value: n,
                    writable: !0,
                    configurable: !0
                }), t[this.expando]
            },
            cache: function(t) {
                if (!St(t)) return {};
                var e = t[this.expando];
                return e || (e = {}, St(t) && (t.nodeType ? t[this.expando] = e : Object.defineProperty(t, this.expando, {
                    value: e,
                    configurable: !0
                }))), e
            },
            set: function(t, e, n) {
                var i, o = this.cache(t);
                if ("string" == typeof e) o[e] = n;
                else
                    for (i in e) o[i] = e[i];
                return o
            },
            get: function(t, e) {
                return void 0 === e ? this.cache(t) : t[this.expando] && t[this.expando][e]
            },
            access: function(t, e, n) {
                var i;
                return void 0 === e || e && "string" == typeof e && void 0 === n ? (i = this.get(t, e), void 0 !== i ? i : this.get(t, at.camelCase(e))) : (this.set(t, e, n), void 0 !== n ? n : e)
            },
            remove: function(t, e) {
                var n, i, o, a = t[this.expando];
                if (void 0 !== a) {
                    if (void 0 === e) this.register(t);
                    else {
                        at.isArray(e) ? i = e.concat(e.map(at.camelCase)) : (o = at.camelCase(e), e in a ? i = [e, o] : (i = o, i = i in a ? [i] : i.match(xt) || [])), n = i.length;
                        for (; n--;) delete a[i[n]]
                    }(void 0 === e || at.isEmptyObject(a)) && (t.nodeType ? t[this.expando] = void 0 : delete t[this.expando])
                }
            },
            hasData: function(t) {
                var e = t[this.expando];
                return void 0 !== e && !at.isEmptyObject(e)
            }
        };
        var _t = new s,
            kt = new s,
            Et = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
            Dt = /[A-Z]/g;
        at.extend({
            hasData: function(t) {
                return kt.hasData(t) || _t.hasData(t)
            },
            data: function(t, e, n) {
                return kt.access(t, e, n)
            },
            removeData: function(t, e) {
                kt.remove(t, e)
            },
            _data: function(t, e, n) {
                return _t.access(t, e, n)
            },
            _removeData: function(t, e) {
                _t.remove(t, e)
            }
        }), at.fn.extend({
            data: function(t, e) {
                var n, i, o, a = this[0],
                    r = a && a.attributes;
                if (void 0 === t) {
                    if (this.length && (o = kt.get(a), 1 === a.nodeType && !_t.get(a, "hasDataAttrs"))) {
                        for (n = r.length; n--;) r[n] && (i = r[n].name, 0 === i.indexOf("data-") && (i = at.camelCase(i.slice(5)), l(a, i, o[i])));
                        _t.set(a, "hasDataAttrs", !0)
                    }
                    return o
                }
                return "object" == typeof t ? this.each(function() {
                    kt.set(this, t)
                }) : Tt(this, function(e) {
                    var n, i;
                    if (a && void 0 === e) {
                        if (n = kt.get(a, t) || kt.get(a, t.replace(Dt, "-$&").toLowerCase()), void 0 !== n) return n;
                        if (i = at.camelCase(t), n = kt.get(a, i), void 0 !== n) return n;
                        if (n = l(a, i, void 0), void 0 !== n) return n
                    } else i = at.camelCase(t), this.each(function() {
                        var n = kt.get(this, i);
                        kt.set(this, i, e), t.indexOf("-") > -1 && void 0 !== n && kt.set(this, t, e)
                    })
                }, null, e, arguments.length > 1, null, !0)
            },
            removeData: function(t) {
                return this.each(function() {
                    kt.remove(this, t)
                })
            }
        }), at.extend({
            queue: function(t, e, n) {
                var i;
                return t ? (e = (e || "fx") + "queue", i = _t.get(t, e), n && (!i || at.isArray(n) ? i = _t.access(t, e, at.makeArray(n)) : i.push(n)), i || []) : void 0
            },
            dequeue: function(t, e) {
                e = e || "fx";
                var n = at.queue(t, e),
                    i = n.length,
                    o = n.shift(),
                    a = at._queueHooks(t, e),
                    r = function() {
                        at.dequeue(t, e)
                    };
                "inprogress" === o && (o = n.shift(), i--), o && ("fx" === e && n.unshift("inprogress"), delete a.stop, o.call(t, r, a)), !i && a && a.empty.fire()
            },
            _queueHooks: function(t, e) {
                var n = e + "queueHooks";
                return _t.get(t, n) || _t.access(t, n, {
                    empty: at.Callbacks("once memory").add(function() {
                        _t.remove(t, [e + "queue", n])
                    })
                })
            }
        }), at.fn.extend({
            queue: function(t, e) {
                var n = 2;
                return "string" != typeof t && (e = t, t = "fx", n--), arguments.length < n ? at.queue(this[0], t) : void 0 === e ? this : this.each(function() {
                    var n = at.queue(this, t, e);
                    at._queueHooks(this, t), "fx" === t && "inprogress" !== n[0] && at.dequeue(this, t)
                })
            },
            dequeue: function(t) {
                return this.each(function() {
                    at.dequeue(this, t)
                })
            },
            clearQueue: function(t) {
                return this.queue(t || "fx", [])
            },
            promise: function(t, e) {
                var n, i = 1,
                    o = at.Deferred(),
                    a = this,
                    r = this.length,
                    s = function() {
                        --i || o.resolveWith(a, [a])
                    };
                for ("string" != typeof t && (e = t, t = void 0), t = t || "fx"; r--;) n = _t.get(a[r], t + "queueHooks"), n && n.empty && (i++, n.empty.add(s));
                return s(), o.promise(e)
            }
        });
        var Mt = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
            Ot = new RegExp("^(?:([+-])=|)(" + Mt + ")([a-z%]*)$", "i"),
            It = ["Top", "Right", "Bottom", "Left"],
            At = function(t, e) {
                return t = e || t, "none" === at.css(t, "display") || !at.contains(t.ownerDocument, t)
            },
            Nt = /^(?:checkbox|radio)$/i,
            Pt = /<([\w:-]+)/,
            zt = /^$|\/(?:java|ecma)script/i,
            Lt = {
                option: [1, "<select multiple='multiple'>", "</select>"],
                thead: [1, "<table>", "</table>"],
                col: [2, "<table><colgroup>", "</colgroup></table>"],
                tr: [2, "<table><tbody>", "</tbody></table>"],
                td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
                _default: [0, "", ""]
            };
        Lt.optgroup = Lt.option, Lt.tbody = Lt.tfoot = Lt.colgroup = Lt.caption = Lt.thead, Lt.th = Lt.td;
        var $t = /<|&#?\w+;/;
        ! function() {
            var t = G.createDocumentFragment(),
                e = t.appendChild(G.createElement("div")),
                n = G.createElement("input");
            n.setAttribute("type", "radio"), n.setAttribute("checked", "checked"), n.setAttribute("name", "t"), e.appendChild(n), it.checkClone = e.cloneNode(!0).cloneNode(!0).lastChild.checked, e.innerHTML = "<textarea>x</textarea>", it.noCloneChecked = !!e.cloneNode(!0).lastChild.defaultValue
        }();
        var Bt = /^key/,
            Ft = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
            Ht = /^([^.]*)(?:\.(.+)|)/;
        at.event = {
            global: {},
            add: function(t, e, n, i, o) {
                var a, r, s, l, c, d, u, p, h, f, m, g = _t.get(t);
                if (g)
                    for (n.handler && (a = n, n = a.handler, o = a.selector), n.guid || (n.guid = at.guid++), (l = g.events) || (l = g.events = {}), (r = g.handle) || (r = g.handle = function(e) {
                            return "undefined" != typeof at && at.event.triggered !== e.type ? at.event.dispatch.apply(t, arguments) : void 0
                        }), e = (e || "").match(xt) || [""], c = e.length; c--;) s = Ht.exec(e[c]) || [], h = m = s[1], f = (s[2] || "").split(".").sort(), h && (u = at.event.special[h] || {}, h = (o ? u.delegateType : u.bindType) || h, u = at.event.special[h] || {}, d = at.extend({
                        type: h,
                        origType: m,
                        data: i,
                        handler: n,
                        guid: n.guid,
                        selector: o,
                        needsContext: o && at.expr.match.needsContext.test(o),
                        namespace: f.join(".")
                    }, a), (p = l[h]) || (p = l[h] = [], p.delegateCount = 0, u.setup && u.setup.call(t, i, f, r) !== !1 || t.addEventListener && t.addEventListener(h, r)), u.add && (u.add.call(t, d), d.handler.guid || (d.handler.guid = n.guid)), o ? p.splice(p.delegateCount++, 0, d) : p.push(d), at.event.global[h] = !0)
            },
            remove: function(t, e, n, i, o) {
                var a, r, s, l, c, d, u, p, h, f, m, g = _t.hasData(t) && _t.get(t);
                if (g && (l = g.events)) {
                    for (e = (e || "").match(xt) || [""], c = e.length; c--;)
                        if (s = Ht.exec(e[c]) || [], h = m = s[1], f = (s[2] || "").split(".").sort(), h) {
                            for (u = at.event.special[h] || {}, h = (i ? u.delegateType : u.bindType) || h, p = l[h] || [], s = s[2] && new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)"), r = a = p.length; a--;) d = p[a], !o && m !== d.origType || n && n.guid !== d.guid || s && !s.test(d.namespace) || i && i !== d.selector && ("**" !== i || !d.selector) || (p.splice(a, 1), d.selector && p.delegateCount--, u.remove && u.remove.call(t, d));
                            r && !p.length && (u.teardown && u.teardown.call(t, f, g.handle) !== !1 || at.removeEvent(t, h, g.handle), delete l[h])
                        } else
                            for (h in l) at.event.remove(t, h + e[c], n, i, !0);
                    at.isEmptyObject(l) && _t.remove(t, "handle events")
                }
            },
            dispatch: function(t) {
                t = at.event.fix(t);
                var e, n, i, o, a, r = [],
                    s = K.call(arguments),
                    l = (_t.get(this, "events") || {})[t.type] || [],
                    c = at.event.special[t.type] || {};
                if (s[0] = t, t.delegateTarget = this, !c.preDispatch || c.preDispatch.call(this, t) !== !1) {
                    for (r = at.event.handlers.call(this, t, l), e = 0;
                        (o = r[e++]) && !t.isPropagationStopped();)
                        for (t.currentTarget = o.elem, n = 0;
                            (a = o.handlers[n++]) && !t.isImmediatePropagationStopped();) t.rnamespace && !t.rnamespace.test(a.namespace) || (t.handleObj = a, t.data = a.data, i = ((at.event.special[a.origType] || {}).handle || a.handler).apply(o.elem, s), void 0 !== i && (t.result = i) === !1 && (t.preventDefault(), t.stopPropagation()));
                    return c.postDispatch && c.postDispatch.call(this, t), t.result
                }
            },
            handlers: function(t, e) {
                var n, i, o, a, r = [],
                    s = e.delegateCount,
                    l = t.target;
                if (s && l.nodeType && ("click" !== t.type || isNaN(t.button) || t.button < 1))
                    for (; l !== this; l = l.parentNode || this)
                        if (1 === l.nodeType && (l.disabled !== !0 || "click" !== t.type)) {
                            for (i = [], n = 0; s > n; n++) a = e[n], o = a.selector + " ", void 0 === i[o] && (i[o] = a.needsContext ? at(o, this).index(l) > -1 : at.find(o, this, null, [l]).length), i[o] && i.push(a);
                            i.length && r.push({
                                elem: l,
                                handlers: i
                            })
                        }
                return s < e.length && r.push({
                    elem: this,
                    handlers: e.slice(s)
                }), r
            },
            props: "altKey bubbles cancelable ctrlKey currentTarget detail eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
            fixHooks: {},
            keyHooks: {
                props: "char charCode key keyCode".split(" "),
                filter: function(t, e) {
                    return null == t.which && (t.which = null != e.charCode ? e.charCode : e.keyCode), t
                }
            },
            mouseHooks: {
                props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
                filter: function(t, e) {
                    var n, i, o, a = e.button;
                    return null == t.pageX && null != e.clientX && (n = t.target.ownerDocument || G, i = n.documentElement, o = n.body, t.pageX = e.clientX + (i && i.scrollLeft || o && o.scrollLeft || 0) - (i && i.clientLeft || o && o.clientLeft || 0), t.pageY = e.clientY + (i && i.scrollTop || o && o.scrollTop || 0) - (i && i.clientTop || o && o.clientTop || 0)), t.which || void 0 === a || (t.which = 1 & a ? 1 : 2 & a ? 3 : 4 & a ? 2 : 0), t
                }
            },
            fix: function(t) {
                if (t[at.expando]) return t;
                var e, n, i, o = t.type,
                    a = t,
                    r = this.fixHooks[o];
                for (r || (this.fixHooks[o] = r = Ft.test(o) ? this.mouseHooks : Bt.test(o) ? this.keyHooks : {}), i = r.props ? this.props.concat(r.props) : this.props, t = new at.Event(a), e = i.length; e--;) n = i[e], t[n] = a[n];
                return t.target || (t.target = G), 3 === t.target.nodeType && (t.target = t.target.parentNode), r.filter ? r.filter(t, a) : t
            },
            special: {
                load: {
                    noBubble: !0
                },
                focus: {
                    trigger: function() {
                        return this !== m() && this.focus ? (this.focus(), !1) : void 0
                    },
                    delegateType: "focusin"
                },
                blur: {
                    trigger: function() {
                        return this === m() && this.blur ? (this.blur(), !1) : void 0
                    },
                    delegateType: "focusout"
                },
                click: {
                    trigger: function() {
                        return "checkbox" === this.type && this.click && at.nodeName(this, "input") ? (this.click(), !1) : void 0
                    },
                    _default: function(t) {
                        return at.nodeName(t.target, "a")
                    }
                },
                beforeunload: {
                    postDispatch: function(t) {
                        void 0 !== t.result && t.originalEvent && (t.originalEvent.returnValue = t.result)
                    }
                }
            }
        }, at.removeEvent = function(t, e, n) {
            t.removeEventListener && t.removeEventListener(e, n)
        }, at.Event = function(t, e) {
            return this instanceof at.Event ? (t && t.type ? (this.originalEvent = t, this.type = t.type, this.isDefaultPrevented = t.defaultPrevented || void 0 === t.defaultPrevented && t.returnValue === !1 ? h : f) : this.type = t, e && at.extend(this, e), this.timeStamp = t && t.timeStamp || at.now(), void(this[at.expando] = !0)) : new at.Event(t, e)
        }, at.Event.prototype = {
            constructor: at.Event,
            isDefaultPrevented: f,
            isPropagationStopped: f,
            isImmediatePropagationStopped: f,
            isSimulated: !1,
            preventDefault: function() {
                var t = this.originalEvent;
                this.isDefaultPrevented = h, t && !this.isSimulated && t.preventDefault()
            },
            stopPropagation: function() {
                var t = this.originalEvent;
                this.isPropagationStopped = h, t && !this.isSimulated && t.stopPropagation()
            },
            stopImmediatePropagation: function() {
                var t = this.originalEvent;
                this.isImmediatePropagationStopped = h, t && !this.isSimulated && t.stopImmediatePropagation(), this.stopPropagation()
            }
        }, at.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout",
            pointerenter: "pointerover",
            pointerleave: "pointerout"
        }, function(t, e) {
            at.event.special[t] = {
                delegateType: e,
                bindType: e,
                handle: function(t) {
                    var n, i = this,
                        o = t.relatedTarget,
                        a = t.handleObj;
                    return o && (o === i || at.contains(i, o)) || (t.type = a.origType, n = a.handler.apply(this, arguments), t.type = e), n
                }
            }
        }), at.fn.extend({
            on: function(t, e, n, i) {
                return g(this, t, e, n, i)
            },
            one: function(t, e, n, i) {
                return g(this, t, e, n, i, 1)
            },
            off: function(t, e, n) {
                var i, o;
                if (t && t.preventDefault && t.handleObj) return i = t.handleObj, at(t.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
                if ("object" == typeof t) {
                    for (o in t) this.off(o, e, t[o]);
                    return this
                }
                return e !== !1 && "function" != typeof e || (n = e, e = void 0), n === !1 && (n = f), this.each(function() {
                    at.event.remove(this, t, n, e)
                })
            }
        });
        var jt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi,
            Rt = /<script|<style|<link/i,
            Wt = /checked\s*(?:[^=]|=\s*.checked.)/i,
            Ut = /^true\/(.*)/,
            qt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
        at.extend({
            htmlPrefilter: function(t) {
                return t.replace(jt, "<$1></$2>")
            },
            clone: function(t, e, n) {
                var i, o, a, r, s = t.cloneNode(!0),
                    l = at.contains(t.ownerDocument, t);
                if (!(it.noCloneChecked || 1 !== t.nodeType && 11 !== t.nodeType || at.isXMLDoc(t)))
                    for (r = d(s), a = d(t), i = 0, o = a.length; o > i; i++) x(a[i], r[i]);
                if (e)
                    if (n)
                        for (a = a || d(t), r = r || d(s), i = 0, o = a.length; o > i; i++) b(a[i], r[i]);
                    else b(t, s);
                return r = d(s, "script"), r.length > 0 && u(r, !l && d(t, "script")), s
            },
            cleanData: function(t) {
                for (var e, n, i, o = at.event.special, a = 0; void 0 !== (n = t[a]); a++)
                    if (St(n)) {
                        if (e = n[_t.expando]) {
                            if (e.events)
                                for (i in e.events) o[i] ? at.event.remove(n, i) : at.removeEvent(n, i, e.handle);
                            n[_t.expando] = void 0
                        }
                        n[kt.expando] && (n[kt.expando] = void 0)
                    }
            }
        }), at.fn.extend({
            domManip: C,
            detach: function(t) {
                return T(this, t, !0)
            },
            remove: function(t) {
                return T(this, t)
            },
            text: function(t) {
                return Tt(this, function(t) {
                    return void 0 === t ? at.text(this) : this.empty().each(function() {
                        1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = t)
                    })
                }, null, t, arguments.length)
            },
            append: function() {
                return C(this, arguments, function(t) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var e = v(this, t);
                        e.appendChild(t)
                    }
                })
            },
            prepend: function() {
                return C(this, arguments, function(t) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var e = v(this, t);
                        e.insertBefore(t, e.firstChild)
                    }
                })
            },
            before: function() {
                return C(this, arguments, function(t) {
                    this.parentNode && this.parentNode.insertBefore(t, this)
                })
            },
            after: function() {
                return C(this, arguments, function(t) {
                    this.parentNode && this.parentNode.insertBefore(t, this.nextSibling)
                })
            },
            empty: function() {
                for (var t, e = 0; null != (t = this[e]); e++) 1 === t.nodeType && (at.cleanData(d(t, !1)), t.textContent = "");
                return this
            },
            clone: function(t, e) {
                return t = null != t && t, e = null == e ? t : e, this.map(function() {
                    return at.clone(this, t, e)
                })
            },
            html: function(t) {
                return Tt(this, function(t) {
                    var e = this[0] || {},
                        n = 0,
                        i = this.length;
                    if (void 0 === t && 1 === e.nodeType) return e.innerHTML;
                    if ("string" == typeof t && !Rt.test(t) && !Lt[(Pt.exec(t) || ["", ""])[1].toLowerCase()]) {
                        t = at.htmlPrefilter(t);
                        try {
                            for (; i > n; n++) e = this[n] || {}, 1 === e.nodeType && (at.cleanData(d(e, !1)), e.innerHTML = t);
                            e = 0
                        } catch (o) {}
                    }
                    e && this.empty().append(t)
                }, null, t, arguments.length)
            },
            replaceWith: function() {
                var t = [];
                return C(this, arguments, function(e) {
                    var n = this.parentNode;
                    at.inArray(this, t) < 0 && (at.cleanData(d(this)), n && n.replaceChild(e, this))
                }, t)
            }
        }), at.each({
            appendTo: "append",
            prependTo: "prepend",
            insertBefore: "before",
            insertAfter: "after",
            replaceAll: "replaceWith"
        }, function(t, e) {
            at.fn[t] = function(t) {
                for (var n, i = [], o = at(t), a = o.length - 1, r = 0; a >= r; r++) n = r === a ? this : this.clone(!0), at(o[r])[e](n), Z.apply(i, n.get());
                return this.pushStack(i)
            }
        });
        var Yt, Vt = {
                HTML: "block",
                BODY: "block"
            },
            Xt = /^margin/,
            Gt = new RegExp("^(" + Mt + ")(?!px)[a-z%]+$", "i"),
            Kt = function(e) {
                var n = e.ownerDocument.defaultView;
                return n && n.opener || (n = t), n.getComputedStyle(e)
            },
            Qt = function(t, e, n, i) {
                var o, a, r = {};
                for (a in e) r[a] = t.style[a], t.style[a] = e[a];
                o = n.apply(t, i || []);
                for (a in e) t.style[a] = r[a];
                return o
            },
            Zt = G.documentElement;
        ! function() {
            function e() {
                s.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%", s.innerHTML = "", Zt.appendChild(r);
                var e = t.getComputedStyle(s);
                n = "1%" !== e.top, a = "2px" === e.marginLeft, i = "4px" === e.width, s.style.marginRight = "50%", o = "4px" === e.marginRight, Zt.removeChild(r)
            }
            var n, i, o, a, r = G.createElement("div"),
                s = G.createElement("div");
            s.style && (s.style.backgroundClip = "content-box", s.cloneNode(!0).style.backgroundClip = "", it.clearCloneStyle = "content-box" === s.style.backgroundClip, r.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute", r.appendChild(s), at.extend(it, {
                pixelPosition: function() {
                    return e(), n
                },
                boxSizingReliable: function() {
                    return null == i && e(), i
                },
                pixelMarginRight: function() {
                    return null == i && e(), o
                },
                reliableMarginLeft: function() {
                    return null == i && e(), a
                },
                reliableMarginRight: function() {
                    var e, n = s.appendChild(G.createElement("div"));
                    return n.style.cssText = s.style.cssText = "-webkit-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", n.style.marginRight = n.style.width = "0", s.style.width = "1px", Zt.appendChild(r), e = !parseFloat(t.getComputedStyle(n).marginRight), Zt.removeChild(r), s.removeChild(n), e
                }
            }))
        }();
        var Jt = /^(none|table(?!-c[ea]).+)/,
            te = {
                position: "absolute",
                visibility: "hidden",
                display: "block"
            },
            ee = {
                letterSpacing: "0",
                fontWeight: "400"
            },
            ne = ["Webkit", "O", "Moz", "ms"],
            ie = G.createElement("div").style;
        at.extend({
            cssHooks: {
                opacity: {
                    get: function(t, e) {
                        if (e) {
                            var n = k(t, "opacity");
                            return "" === n ? "1" : n
                        }
                    }
                }
            },
            cssNumber: {
                animationIterationCount: !0,
                columnCount: !0,
                fillOpacity: !0,
                flexGrow: !0,
                flexShrink: !0,
                fontWeight: !0,
                lineHeight: !0,
                opacity: !0,
                order: !0,
                orphans: !0,
                widows: !0,
                zIndex: !0,
                zoom: !0
            },
            cssProps: {
                "float": "cssFloat"
            },
            style: function(t, e, n, i) {
                if (t && 3 !== t.nodeType && 8 !== t.nodeType && t.style) {
                    var o, a, r, s = at.camelCase(e),
                        l = t.style;
                    return e = at.cssProps[s] || (at.cssProps[s] = D(s) || s), r = at.cssHooks[e] || at.cssHooks[s], void 0 === n ? r && "get" in r && void 0 !== (o = r.get(t, !1, i)) ? o : l[e] : (a = typeof n, "string" === a && (o = Ot.exec(n)) && o[1] && (n = c(t, e, o), a = "number"), void(null != n && n === n && ("number" === a && (n += o && o[3] || (at.cssNumber[s] ? "" : "px")), it.clearCloneStyle || "" !== n || 0 !== e.indexOf("background") || (l[e] = "inherit"), r && "set" in r && void 0 === (n = r.set(t, n, i)) || (l[e] = n))))
                }
            },
            css: function(t, e, n, i) {
                var o, a, r, s = at.camelCase(e);
                return e = at.cssProps[s] || (at.cssProps[s] = D(s) || s), r = at.cssHooks[e] || at.cssHooks[s], r && "get" in r && (o = r.get(t, !0, n)), void 0 === o && (o = k(t, e, i)), "normal" === o && e in ee && (o = ee[e]), "" === n || n ? (a = parseFloat(o), n === !0 || isFinite(a) ? a || 0 : o) : o
            }
        }), at.each(["height", "width"], function(t, e) {
            at.cssHooks[e] = {
                get: function(t, n, i) {
                    return n ? Jt.test(at.css(t, "display")) && 0 === t.offsetWidth ? Qt(t, te, function() {
                        return I(t, e, i)
                    }) : I(t, e, i) : void 0
                },
                set: function(t, n, i) {
                    var o, a = i && Kt(t),
                        r = i && O(t, e, i, "border-box" === at.css(t, "boxSizing", !1, a), a);
                    return r && (o = Ot.exec(n)) && "px" !== (o[3] || "px") && (t.style[e] = n, n = at.css(t, e)), M(t, n, r)
                }
            }
        }), at.cssHooks.marginLeft = E(it.reliableMarginLeft, function(t, e) {
            return e ? (parseFloat(k(t, "marginLeft")) || t.getBoundingClientRect().left - Qt(t, {
                marginLeft: 0
            }, function() {
                return t.getBoundingClientRect().left
            })) + "px" : void 0
        }), at.cssHooks.marginRight = E(it.reliableMarginRight, function(t, e) {
            return e ? Qt(t, {
                display: "inline-block"
            }, k, [t, "marginRight"]) : void 0
        }), at.each({
            margin: "",
            padding: "",
            border: "Width"
        }, function(t, e) {
            at.cssHooks[t + e] = {
                expand: function(n) {
                    for (var i = 0, o = {}, a = "string" == typeof n ? n.split(" ") : [n]; 4 > i; i++) o[t + It[i] + e] = a[i] || a[i - 2] || a[0];
                    return o
                }
            }, Xt.test(t) || (at.cssHooks[t + e].set = M)
        }), at.fn.extend({
            css: function(t, e) {
                return Tt(this, function(t, e, n) {
                    var i, o, a = {},
                        r = 0;
                    if (at.isArray(e)) {
                        for (i = Kt(t), o = e.length; o > r; r++) a[e[r]] = at.css(t, e[r], !1, i);
                        return a
                    }
                    return void 0 !== n ? at.style(t, e, n) : at.css(t, e)
                }, t, e, arguments.length > 1)
            },
            show: function() {
                return A(this, !0)
            },
            hide: function() {
                return A(this)
            },
            toggle: function(t) {
                return "boolean" == typeof t ? t ? this.show() : this.hide() : this.each(function() {
                    At(this) ? at(this).show() : at(this).hide()
                })
            }
        }), at.Tween = N, N.prototype = {
            constructor: N,
            init: function(t, e, n, i, o, a) {
                this.elem = t, this.prop = n, this.easing = o || at.easing._default, this.options = e, this.start = this.now = this.cur(), this.end = i, this.unit = a || (at.cssNumber[n] ? "" : "px")
            },
            cur: function() {
                var t = N.propHooks[this.prop];
                return t && t.get ? t.get(this) : N.propHooks._default.get(this)
            },
            run: function(t) {
                var e, n = N.propHooks[this.prop];
                return this.options.duration ? this.pos = e = at.easing[this.easing](t, this.options.duration * t, 0, 1, this.options.duration) : this.pos = e = t, this.now = (this.end - this.start) * e + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : N.propHooks._default.set(this), this
            }
        }, N.prototype.init.prototype = N.prototype, N.propHooks = {
            _default: {
                get: function(t) {
                    var e;
                    return 1 !== t.elem.nodeType || null != t.elem[t.prop] && null == t.elem.style[t.prop] ? t.elem[t.prop] : (e = at.css(t.elem, t.prop, ""), e && "auto" !== e ? e : 0)
                },
                set: function(t) {
                    at.fx.step[t.prop] ? at.fx.step[t.prop](t) : 1 !== t.elem.nodeType || null == t.elem.style[at.cssProps[t.prop]] && !at.cssHooks[t.prop] ? t.elem[t.prop] = t.now : at.style(t.elem, t.prop, t.now + t.unit)
                }
            }
        }, N.propHooks.scrollTop = N.propHooks.scrollLeft = {
            set: function(t) {
                t.elem.nodeType && t.elem.parentNode && (t.elem[t.prop] = t.now)
            }
        }, at.easing = {
            linear: function(t) {
                return t
            },
            swing: function(t) {
                return .5 - Math.cos(t * Math.PI) / 2
            },
            _default: "swing"
        }, at.fx = N.prototype.init, at.fx.step = {};
        var oe, ae, re = /^(?:toggle|show|hide)$/,
            se = /queueHooks$/;
        at.Animation = at.extend(F, {
                tweeners: {
                    "*": [function(t, e) {
                        var n = this.createTween(t, e);
                        return c(n.elem, t, Ot.exec(e), n), n
                    }]
                },
                tweener: function(t, e) {
                    at.isFunction(t) ? (e = t, t = ["*"]) : t = t.match(xt);
                    for (var n, i = 0, o = t.length; o > i; i++) n = t[i], F.tweeners[n] = F.tweeners[n] || [], F.tweeners[n].unshift(e)
                },
                prefilters: [$],
                prefilter: function(t, e) {
                    e ? F.prefilters.unshift(t) : F.prefilters.push(t)
                }
            }), at.speed = function(t, e, n) {
                var i = t && "object" == typeof t ? at.extend({}, t) : {
                    complete: n || !n && e || at.isFunction(t) && t,
                    duration: t,
                    easing: n && e || e && !at.isFunction(e) && e
                };
                return i.duration = at.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in at.fx.speeds ? at.fx.speeds[i.duration] : at.fx.speeds._default, null != i.queue && i.queue !== !0 || (i.queue = "fx"), i.old = i.complete, i.complete = function() {
                    at.isFunction(i.old) && i.old.call(this), i.queue && at.dequeue(this, i.queue)
                }, i
            }, at.fn.extend({
                fadeTo: function(t, e, n, i) {
                    return this.filter(At).css("opacity", 0).show().end().animate({
                        opacity: e
                    }, t, n, i)
                },
                animate: function(t, e, n, i) {
                    var o = at.isEmptyObject(t),
                        a = at.speed(e, n, i),
                        r = function() {
                            var e = F(this, at.extend({}, t), a);
                            (o || _t.get(this, "finish")) && e.stop(!0)
                        };
                    return r.finish = r, o || a.queue === !1 ? this.each(r) : this.queue(a.queue, r)
                },
                stop: function(t, e, n) {
                    var i = function(t) {
                        var e = t.stop;
                        delete t.stop, e(n)
                    };
                    return "string" != typeof t && (n = e, e = t, t = void 0), e && t !== !1 && this.queue(t || "fx", []), this.each(function() {
                        var e = !0,
                            o = null != t && t + "queueHooks",
                            a = at.timers,
                            r = _t.get(this);
                        if (o) r[o] && r[o].stop && i(r[o]);
                        else
                            for (o in r) r[o] && r[o].stop && se.test(o) && i(r[o]);
                        for (o = a.length; o--;) a[o].elem !== this || null != t && a[o].queue !== t || (a[o].anim.stop(n), e = !1, a.splice(o, 1));
                        !e && n || at.dequeue(this, t)
                    })
                },
                finish: function(t) {
                    return t !== !1 && (t = t || "fx"), this.each(function() {
                        var e, n = _t.get(this),
                            i = n[t + "queue"],
                            o = n[t + "queueHooks"],
                            a = at.timers,
                            r = i ? i.length : 0;
                        for (n.finish = !0, at.queue(this, t, []), o && o.stop && o.stop.call(this, !0), e = a.length; e--;) a[e].elem === this && a[e].queue === t && (a[e].anim.stop(!0), a.splice(e, 1));
                        for (e = 0; r > e; e++) i[e] && i[e].finish && i[e].finish.call(this);
                        delete n.finish
                    })
                }
            }), at.each(["toggle", "show", "hide"], function(t, e) {
                var n = at.fn[e];
                at.fn[e] = function(t, i, o) {
                    return null == t || "boolean" == typeof t ? n.apply(this, arguments) : this.animate(z(e, !0), t, i, o)
                }
            }), at.each({
                slideDown: z("show"),
                slideUp: z("hide"),
                slideToggle: z("toggle"),
                fadeIn: {
                    opacity: "show"
                },
                fadeOut: {
                    opacity: "hide"
                },
                fadeToggle: {
                    opacity: "toggle"
                }
            }, function(t, e) {
                at.fn[t] = function(t, n, i) {
                    return this.animate(e, t, n, i)
                }
            }), at.timers = [], at.fx.tick = function() {
                var t, e = 0,
                    n = at.timers;
                for (oe = at.now(); e < n.length; e++) t = n[e], t() || n[e] !== t || n.splice(e--, 1);
                n.length || at.fx.stop(), oe = void 0
            }, at.fx.timer = function(t) {
                at.timers.push(t), t() ? at.fx.start() : at.timers.pop()
            }, at.fx.interval = 13, at.fx.start = function() {
                ae || (ae = t.setInterval(at.fx.tick, at.fx.interval))
            }, at.fx.stop = function() {
                t.clearInterval(ae), ae = null
            }, at.fx.speeds = {
                slow: 600,
                fast: 200,
                _default: 400
            }, at.fn.delay = function(e, n) {
                return e = at.fx ? at.fx.speeds[e] || e : e, n = n || "fx", this.queue(n, function(n, i) {
                    var o = t.setTimeout(n, e);
                    i.stop = function() {
                        t.clearTimeout(o)
                    }
                })
            },
            function() {
                var t = G.createElement("input"),
                    e = G.createElement("select"),
                    n = e.appendChild(G.createElement("option"));
                t.type = "checkbox", it.checkOn = "" !== t.value, it.optSelected = n.selected, e.disabled = !0, it.optDisabled = !n.disabled, t = G.createElement("input"), t.value = "t", t.type = "radio", it.radioValue = "t" === t.value
            }();
        var le, ce = at.expr.attrHandle;
        at.fn.extend({
            attr: function(t, e) {
                return Tt(this, at.attr, t, e, arguments.length > 1)
            },
            removeAttr: function(t) {
                return this.each(function() {
                    at.removeAttr(this, t)
                })
            }
        }), at.extend({
            attr: function(t, e, n) {
                var i, o, a = t.nodeType;
                if (3 !== a && 8 !== a && 2 !== a) return "undefined" == typeof t.getAttribute ? at.prop(t, e, n) : (1 === a && at.isXMLDoc(t) || (e = e.toLowerCase(), o = at.attrHooks[e] || (at.expr.match.bool.test(e) ? le : void 0)), void 0 !== n ? null === n ? void at.removeAttr(t, e) : o && "set" in o && void 0 !== (i = o.set(t, n, e)) ? i : (t.setAttribute(e, n + ""), n) : o && "get" in o && null !== (i = o.get(t, e)) ? i : (i = at.find.attr(t, e), null == i ? void 0 : i))
            },
            attrHooks: {
                type: {
                    set: function(t, e) {
                        if (!it.radioValue && "radio" === e && at.nodeName(t, "input")) {
                            var n = t.value;
                            return t.setAttribute("type", e), n && (t.value = n), e
                        }
                    }
                }
            },
            removeAttr: function(t, e) {
                var n, i, o = 0,
                    a = e && e.match(xt);
                if (a && 1 === t.nodeType)
                    for (; n = a[o++];) i = at.propFix[n] || n, at.expr.match.bool.test(n) && (t[i] = !1), t.removeAttribute(n)
            }
        }), le = {
            set: function(t, e, n) {
                return e === !1 ? at.removeAttr(t, n) : t.setAttribute(n, n), n
            }
        }, at.each(at.expr.match.bool.source.match(/\w+/g), function(t, e) {
            var n = ce[e] || at.find.attr;
            ce[e] = function(t, e, i) {
                var o, a;
                return i || (a = ce[e], ce[e] = o, o = null != n(t, e, i) ? e.toLowerCase() : null, ce[e] = a), o
            }
        });
        var de = /^(?:input|select|textarea|button)$/i,
            ue = /^(?:a|area)$/i;
        at.fn.extend({
            prop: function(t, e) {
                return Tt(this, at.prop, t, e, arguments.length > 1)
            },
            removeProp: function(t) {
                return this.each(function() {
                    delete this[at.propFix[t] || t]
                })
            }
        }), at.extend({
            prop: function(t, e, n) {
                var i, o, a = t.nodeType;
                if (3 !== a && 8 !== a && 2 !== a) return 1 === a && at.isXMLDoc(t) || (e = at.propFix[e] || e, o = at.propHooks[e]), void 0 !== n ? o && "set" in o && void 0 !== (i = o.set(t, n, e)) ? i : t[e] = n : o && "get" in o && null !== (i = o.get(t, e)) ? i : t[e]
            },
            propHooks: {
                tabIndex: {
                    get: function(t) {
                        var e = at.find.attr(t, "tabindex");
                        return e ? parseInt(e, 10) : de.test(t.nodeName) || ue.test(t.nodeName) && t.href ? 0 : -1
                    }
                }
            },
            propFix: {
                "for": "htmlFor",
                "class": "className"
            }
        }), it.optSelected || (at.propHooks.selected = {
            get: function(t) {
                var e = t.parentNode;
                return e && e.parentNode && e.parentNode.selectedIndex, null
            },
            set: function(t) {
                var e = t.parentNode;
                e && (e.selectedIndex, e.parentNode && e.parentNode.selectedIndex)
            }
        }), at.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
            at.propFix[this.toLowerCase()] = this
        });
        var pe = /[\t\r\n\f]/g;
        at.fn.extend({
            addClass: function(t) {
                var e, n, i, o, a, r, s, l = 0;
                if (at.isFunction(t)) return this.each(function(e) {
                    at(this).addClass(t.call(this, e, H(this)))
                });
                if ("string" == typeof t && t)
                    for (e = t.match(xt) || []; n = this[l++];)
                        if (o = H(n), i = 1 === n.nodeType && (" " + o + " ").replace(pe, " ")) {
                            for (r = 0; a = e[r++];) i.indexOf(" " + a + " ") < 0 && (i += a + " ");
                            s = at.trim(i), o !== s && n.setAttribute("class", s)
                        }
                return this
            },
            removeClass: function(t) {
                var e, n, i, o, a, r, s, l = 0;
                if (at.isFunction(t)) return this.each(function(e) {
                    at(this).removeClass(t.call(this, e, H(this)))
                });
                if (!arguments.length) return this.attr("class", "");
                if ("string" == typeof t && t)
                    for (e = t.match(xt) || []; n = this[l++];)
                        if (o = H(n), i = 1 === n.nodeType && (" " + o + " ").replace(pe, " ")) {
                            for (r = 0; a = e[r++];)
                                for (; i.indexOf(" " + a + " ") > -1;) i = i.replace(" " + a + " ", " ");
                            s = at.trim(i), o !== s && n.setAttribute("class", s)
                        }
                return this
            },
            toggleClass: function(t, e) {
                var n = typeof t;
                return "boolean" == typeof e && "string" === n ? e ? this.addClass(t) : this.removeClass(t) : at.isFunction(t) ? this.each(function(n) {
                    at(this).toggleClass(t.call(this, n, H(this), e), e)
                }) : this.each(function() {
                    var e, i, o, a;
                    if ("string" === n)
                        for (i = 0, o = at(this), a = t.match(xt) || []; e = a[i++];) o.hasClass(e) ? o.removeClass(e) : o.addClass(e);
                    else void 0 !== t && "boolean" !== n || (e = H(this), e && _t.set(this, "__className__", e), this.setAttribute && this.setAttribute("class", e || t === !1 ? "" : _t.get(this, "__className__") || ""))
                })
            },
            hasClass: function(t) {
                var e, n, i = 0;
                for (e = " " + t + " "; n = this[i++];)
                    if (1 === n.nodeType && (" " + H(n) + " ").replace(pe, " ").indexOf(e) > -1) return !0;
                return !1
            }
        });
        var he = /\r/g,
            fe = /[\x20\t\r\n\f]+/g;
        at.fn.extend({
            val: function(t) {
                var e, n, i, o = this[0];
                return arguments.length ? (i = at.isFunction(t), this.each(function(n) {
                    var o;
                    1 === this.nodeType && (o = i ? t.call(this, n, at(this).val()) : t, null == o ? o = "" : "number" == typeof o ? o += "" : at.isArray(o) && (o = at.map(o, function(t) {
                        return null == t ? "" : t + ""
                    })), e = at.valHooks[this.type] || at.valHooks[this.nodeName.toLowerCase()], e && "set" in e && void 0 !== e.set(this, o, "value") || (this.value = o))
                })) : o ? (e = at.valHooks[o.type] || at.valHooks[o.nodeName.toLowerCase()], e && "get" in e && void 0 !== (n = e.get(o, "value")) ? n : (n = o.value, "string" == typeof n ? n.replace(he, "") : null == n ? "" : n)) : void 0
            }
        }), at.extend({
            valHooks: {
                option: {
                    get: function(t) {
                        var e = at.find.attr(t, "value");
                        return null != e ? e : at.trim(at.text(t)).replace(fe, " ")
                    }
                },
                select: {
                    get: function(t) {
                        for (var e, n, i = t.options, o = t.selectedIndex, a = "select-one" === t.type || 0 > o, r = a ? null : [], s = a ? o + 1 : i.length, l = 0 > o ? s : a ? o : 0; s > l; l++)
                            if (n = i[l], (n.selected || l === o) && (it.optDisabled ? !n.disabled : null === n.getAttribute("disabled")) && (!n.parentNode.disabled || !at.nodeName(n.parentNode, "optgroup"))) {
                                if (e = at(n).val(), a) return e;
                                r.push(e)
                            }
                        return r
                    },
                    set: function(t, e) {
                        for (var n, i, o = t.options, a = at.makeArray(e), r = o.length; r--;) i = o[r], (i.selected = at.inArray(at.valHooks.option.get(i), a) > -1) && (n = !0);
                        return n || (t.selectedIndex = -1), a
                    }
                }
            }
        }), at.each(["radio", "checkbox"], function() {
            at.valHooks[this] = {
                set: function(t, e) {
                    return at.isArray(e) ? t.checked = at.inArray(at(t).val(), e) > -1 : void 0
                }
            }, it.checkOn || (at.valHooks[this].get = function(t) {
                return null === t.getAttribute("value") ? "on" : t.value
            })
        });
        var me = /^(?:focusinfocus|focusoutblur)$/;
        at.extend(at.event, {
            trigger: function(e, n, i, o) {
                var a, r, s, l, c, d, u, p = [i || G],
                    h = nt.call(e, "type") ? e.type : e,
                    f = nt.call(e, "namespace") ? e.namespace.split(".") : [];
                if (r = s = i = i || G, 3 !== i.nodeType && 8 !== i.nodeType && !me.test(h + at.event.triggered) && (h.indexOf(".") > -1 && (f = h.split("."), h = f.shift(), f.sort()), c = h.indexOf(":") < 0 && "on" + h, e = e[at.expando] ? e : new at.Event(h, "object" == typeof e && e), e.isTrigger = o ? 2 : 3, e.namespace = f.join("."), e.rnamespace = e.namespace ? new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = i), n = null == n ? [e] : at.makeArray(n, [e]), u = at.event.special[h] || {}, o || !u.trigger || u.trigger.apply(i, n) !== !1)) {
                    if (!o && !u.noBubble && !at.isWindow(i)) {
                        for (l = u.delegateType || h, me.test(l + h) || (r = r.parentNode); r; r = r.parentNode) p.push(r), s = r;
                        s === (i.ownerDocument || G) && p.push(s.defaultView || s.parentWindow || t)
                    }
                    for (a = 0;
                        (r = p[a++]) && !e.isPropagationStopped();) e.type = a > 1 ? l : u.bindType || h, d = (_t.get(r, "events") || {})[e.type] && _t.get(r, "handle"), d && d.apply(r, n), d = c && r[c], d && d.apply && St(r) && (e.result = d.apply(r, n), e.result === !1 && e.preventDefault());
                    return e.type = h, o || e.isDefaultPrevented() || u._default && u._default.apply(p.pop(), n) !== !1 || !St(i) || c && at.isFunction(i[h]) && !at.isWindow(i) && (s = i[c], s && (i[c] = null), at.event.triggered = h, i[h](), at.event.triggered = void 0, s && (i[c] = s)), e.result
                }
            },
            simulate: function(t, e, n) {
                var i = at.extend(new at.Event, n, {
                    type: t,
                    isSimulated: !0
                });
                at.event.trigger(i, null, e)
            }
        }), at.fn.extend({
            trigger: function(t, e) {
                return this.each(function() {
                    at.event.trigger(t, e, this)
                })
            },
            triggerHandler: function(t, e) {
                var n = this[0];
                return n ? at.event.trigger(t, e, n, !0) : void 0
            }
        }), at.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(t, e) {
            at.fn[e] = function(t, n) {
                return arguments.length > 0 ? this.on(e, null, t, n) : this.trigger(e)
            }
        }), at.fn.extend({
            hover: function(t, e) {
                return this.mouseenter(t).mouseleave(e || t)
            }
        }), it.focusin = "onfocusin" in t, it.focusin || at.each({
            focus: "focusin",
            blur: "focusout"
        }, function(t, e) {
            var n = function(t) {
                at.event.simulate(e, t.target, at.event.fix(t))
            };
            at.event.special[e] = {
                setup: function() {
                    var i = this.ownerDocument || this,
                        o = _t.access(i, e);
                    o || i.addEventListener(t, n, !0), _t.access(i, e, (o || 0) + 1)
                },
                teardown: function() {
                    var i = this.ownerDocument || this,
                        o = _t.access(i, e) - 1;
                    o ? _t.access(i, e, o) : (i.removeEventListener(t, n, !0), _t.remove(i, e))
                }
            }
        });
        var ge = t.location,
            ve = at.now(),
            ye = /\?/;
        at.parseJSON = function(t) {
            return JSON.parse(t + "")
        }, at.parseXML = function(e) {
            var n;
            if (!e || "string" != typeof e) return null;
            try {
                n = (new t.DOMParser).parseFromString(e, "text/xml")
            } catch (i) {
                n = void 0
            }
            return n && !n.getElementsByTagName("parsererror").length || at.error("Invalid XML: " + e), n
        };
        var we = /#.*$/,
            be = /([?&])_=[^&]*/,
            xe = /^(.*?):[ \t]*([^\r\n]*)$/gm,
            Ce = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
            Te = /^(?:GET|HEAD)$/,
            Se = /^\/\//,
            _e = {},
            ke = {},
            Ee = "*/".concat("*"),
            De = G.createElement("a");
        De.href = ge.href, at.extend({
            active: 0,
            lastModified: {},
            etag: {},
            ajaxSettings: {
                url: ge.href,
                type: "GET",
                isLocal: Ce.test(ge.protocol),
                global: !0,
                processData: !0,
                async: !0,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                accepts: {
                    "*": Ee,
                    text: "text/plain",
                    html: "text/html",
                    xml: "application/xml, text/xml",
                    json: "application/json, text/javascript"
                },
                contents: {
                    xml: /\bxml\b/,
                    html: /\bhtml/,
                    json: /\bjson\b/
                },
                responseFields: {
                    xml: "responseXML",
                    text: "responseText",
                    json: "responseJSON"
                },
                converters: {
                    "* text": String,
                    "text html": !0,
                    "text json": at.parseJSON,
                    "text xml": at.parseXML
                },
                flatOptions: {
                    url: !0,
                    context: !0
                }
            },
            ajaxSetup: function(t, e) {
                return e ? W(W(t, at.ajaxSettings), e) : W(at.ajaxSettings, t)
            },
            ajaxPrefilter: j(_e),
            ajaxTransport: j(ke),
            ajax: function(e, n) {
                function i(e, n, i, s) {
                    var c, u, y, w, x, T = n;
                    2 !== b && (b = 2, l && t.clearTimeout(l), o = void 0, r = s || "", C.readyState = e > 0 ? 4 : 0, c = e >= 200 && 300 > e || 304 === e, i && (w = U(p, C, i)), w = q(p, w, C, c), c ? (p.ifModified && (x = C.getResponseHeader("Last-Modified"), x && (at.lastModified[a] = x), x = C.getResponseHeader("etag"), x && (at.etag[a] = x)), 204 === e || "HEAD" === p.type ? T = "nocontent" : 304 === e ? T = "notmodified" : (T = w.state, u = w.data, y = w.error, c = !y)) : (y = T, !e && T || (T = "error", 0 > e && (e = 0))), C.status = e, C.statusText = (n || T) + "", c ? m.resolveWith(h, [u, T, C]) : m.rejectWith(h, [C, T, y]), C.statusCode(v), v = void 0, d && f.trigger(c ? "ajaxSuccess" : "ajaxError", [C, p, c ? u : y]), g.fireWith(h, [C, T]), d && (f.trigger("ajaxComplete", [C, p]), --at.active || at.event.trigger("ajaxStop")))
                }
                "object" == typeof e && (n = e, e = void 0), n = n || {};
                var o, a, r, s, l, c, d, u, p = at.ajaxSetup({}, n),
                    h = p.context || p,
                    f = p.context && (h.nodeType || h.jquery) ? at(h) : at.event,
                    m = at.Deferred(),
                    g = at.Callbacks("once memory"),
                    v = p.statusCode || {},
                    y = {},
                    w = {},
                    b = 0,
                    x = "canceled",
                    C = {
                        readyState: 0,
                        getResponseHeader: function(t) {
                            var e;
                            if (2 === b) {
                                if (!s)
                                    for (s = {}; e = xe.exec(r);) s[e[1].toLowerCase()] = e[2];
                                e = s[t.toLowerCase()]
                            }
                            return null == e ? null : e
                        },
                        getAllResponseHeaders: function() {
                            return 2 === b ? r : null
                        },
                        setRequestHeader: function(t, e) {
                            var n = t.toLowerCase();
                            return b || (t = w[n] = w[n] || t, y[t] = e), this
                        },
                        overrideMimeType: function(t) {
                            return b || (p.mimeType = t), this
                        },
                        statusCode: function(t) {
                            var e;
                            if (t)
                                if (2 > b)
                                    for (e in t) v[e] = [v[e], t[e]];
                                else C.always(t[C.status]);
                            return this
                        },
                        abort: function(t) {
                            var e = t || x;
                            return o && o.abort(e), i(0, e), this
                        }
                    };
                if (m.promise(C).complete = g.add, C.success = C.done, C.error = C.fail, p.url = ((e || p.url || ge.href) + "").replace(we, "").replace(Se, ge.protocol + "//"), p.type = n.method || n.type || p.method || p.type, p.dataTypes = at.trim(p.dataType || "*").toLowerCase().match(xt) || [""], null == p.crossDomain) {
                    c = G.createElement("a");
                    try {
                        c.href = p.url, c.href = c.href, p.crossDomain = De.protocol + "//" + De.host != c.protocol + "//" + c.host
                    } catch (T) {
                        p.crossDomain = !0
                    }
                }
                if (p.data && p.processData && "string" != typeof p.data && (p.data = at.param(p.data, p.traditional)), R(_e, p, n, C), 2 === b) return C;
                d = at.event && p.global, d && 0 === at.active++ && at.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !Te.test(p.type), a = p.url, p.hasContent || (p.data && (a = p.url += (ye.test(a) ? "&" : "?") + p.data, delete p.data), p.cache === !1 && (p.url = be.test(a) ? a.replace(be, "$1_=" + ve++) : a + (ye.test(a) ? "&" : "?") + "_=" + ve++)), p.ifModified && (at.lastModified[a] && C.setRequestHeader("If-Modified-Since", at.lastModified[a]), at.etag[a] && C.setRequestHeader("If-None-Match", at.etag[a])), (p.data && p.hasContent && p.contentType !== !1 || n.contentType) && C.setRequestHeader("Content-Type", p.contentType), C.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + Ee + "; q=0.01" : "") : p.accepts["*"]);
                for (u in p.headers) C.setRequestHeader(u, p.headers[u]);
                if (p.beforeSend && (p.beforeSend.call(h, C, p) === !1 || 2 === b)) return C.abort();
                x = "abort";
                for (u in {
                        success: 1,
                        error: 1,
                        complete: 1
                    }) C[u](p[u]);
                if (o = R(ke, p, n, C)) {
                    if (C.readyState = 1, d && f.trigger("ajaxSend", [C, p]), 2 === b) return C;
                    p.async && p.timeout > 0 && (l = t.setTimeout(function() {
                        C.abort("timeout")
                    }, p.timeout));
                    try {
                        b = 1, o.send(y, i)
                    } catch (T) {
                        if (!(2 > b)) throw T;
                        i(-1, T)
                    }
                } else i(-1, "No Transport");
                return C
            },
            getJSON: function(t, e, n) {
                return at.get(t, e, n, "json")
            },
            getScript: function(t, e) {
                return at.get(t, void 0, e, "script")
            }
        }), at.each(["get", "post"], function(t, e) {
            at[e] = function(t, n, i, o) {
                return at.isFunction(n) && (o = o || i, i = n, n = void 0), at.ajax(at.extend({
                    url: t,
                    type: e,
                    dataType: o,
                    data: n,
                    success: i
                }, at.isPlainObject(t) && t))
            }
        }), at._evalUrl = function(t) {
            return at.ajax({
                url: t,
                type: "GET",
                dataType: "script",
                async: !1,
                global: !1,
                "throws": !0
            })
        }, at.fn.extend({
            wrapAll: function(t) {
                var e;
                return at.isFunction(t) ? this.each(function(e) {
                    at(this).wrapAll(t.call(this, e))
                }) : (this[0] && (e = at(t, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && e.insertBefore(this[0]), e.map(function() {
                    for (var t = this; t.firstElementChild;) t = t.firstElementChild;
                    return t
                }).append(this)), this)
            },
            wrapInner: function(t) {
                return at.isFunction(t) ? this.each(function(e) {
                    at(this).wrapInner(t.call(this, e))
                }) : this.each(function() {
                    var e = at(this),
                        n = e.contents();
                    n.length ? n.wrapAll(t) : e.append(t)
                })
            },
            wrap: function(t) {
                var e = at.isFunction(t);
                return this.each(function(n) {
                    at(this).wrapAll(e ? t.call(this, n) : t)
                })
            },
            unwrap: function() {
                return this.parent().each(function() {
                    at.nodeName(this, "body") || at(this).replaceWith(this.childNodes)
                }).end()
            }
        }), at.expr.filters.hidden = function(t) {
            return !at.expr.filters.visible(t)
        }, at.expr.filters.visible = function(t) {
            return t.offsetWidth > 0 || t.offsetHeight > 0 || t.getClientRects().length > 0
        };
        var Me = /%20/g,
            Oe = /\[\]$/,
            Ie = /\r?\n/g,
            Ae = /^(?:submit|button|image|reset|file)$/i,
            Ne = /^(?:input|select|textarea|keygen)/i;
        at.param = function(t, e) {
            var n, i = [],
                o = function(t, e) {
                    e = at.isFunction(e) ? e() : null == e ? "" : e, i[i.length] = encodeURIComponent(t) + "=" + encodeURIComponent(e)
                };
            if (void 0 === e && (e = at.ajaxSettings && at.ajaxSettings.traditional), at.isArray(t) || t.jquery && !at.isPlainObject(t)) at.each(t, function() {
                o(this.name, this.value)
            });
            else
                for (n in t) Y(n, t[n], e, o);
            return i.join("&").replace(Me, "+")
        }, at.fn.extend({
            serialize: function() {
                return at.param(this.serializeArray())
            },
            serializeArray: function() {
                return this.map(function() {
                    var t = at.prop(this, "elements");
                    return t ? at.makeArray(t) : this
                }).filter(function() {
                    var t = this.type;
                    return this.name && !at(this).is(":disabled") && Ne.test(this.nodeName) && !Ae.test(t) && (this.checked || !Nt.test(t))
                }).map(function(t, e) {
                    var n = at(this).val();
                    return null == n ? null : at.isArray(n) ? at.map(n, function(t) {
                        return {
                            name: e.name,
                            value: t.replace(Ie, "\r\n")
                        }
                    }) : {
                        name: e.name,
                        value: n.replace(Ie, "\r\n")
                    }
                }).get()
            }
        }), at.ajaxSettings.xhr = function() {
            try {
                return new t.XMLHttpRequest
            } catch (e) {}
        };
        var Pe = {
                0: 200,
                1223: 204
            },
            ze = at.ajaxSettings.xhr();
        it.cors = !!ze && "withCredentials" in ze, it.ajax = ze = !!ze, at.ajaxTransport(function(e) {
            var n, i;
            return it.cors || ze && !e.crossDomain ? {
                send: function(o, a) {
                    var r, s = e.xhr();
                    if (s.open(e.type, e.url, e.async, e.username, e.password), e.xhrFields)
                        for (r in e.xhrFields) s[r] = e.xhrFields[r];
                    e.mimeType && s.overrideMimeType && s.overrideMimeType(e.mimeType), e.crossDomain || o["X-Requested-With"] || (o["X-Requested-With"] = "XMLHttpRequest");
                    for (r in o) s.setRequestHeader(r, o[r]);
                    n = function(t) {
                        return function() {
                            n && (n = i = s.onload = s.onerror = s.onabort = s.onreadystatechange = null, "abort" === t ? s.abort() : "error" === t ? "number" != typeof s.status ? a(0, "error") : a(s.status, s.statusText) : a(Pe[s.status] || s.status, s.statusText, "text" !== (s.responseType || "text") || "string" != typeof s.responseText ? {
                                binary: s.response
                            } : {
                                text: s.responseText
                            }, s.getAllResponseHeaders()))
                        }
                    }, s.onload = n(), i = s.onerror = n("error"), void 0 !== s.onabort ? s.onabort = i : s.onreadystatechange = function() {
                        4 === s.readyState && t.setTimeout(function() {
                            n && i()
                        })
                    }, n = n("abort");
                    try {
                        s.send(e.hasContent && e.data || null)
                    } catch (l) {
                        if (n) throw l
                    }
                },
                abort: function() {
                    n && n()
                }
            } : void 0
        }), at.ajaxSetup({
            accepts: {
                script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
            },
            contents: {
                script: /\b(?:java|ecma)script\b/
            },
            converters: {
                "text script": function(t) {
                    return at.globalEval(t), t
                }
            }
        }), at.ajaxPrefilter("script", function(t) {
            void 0 === t.cache && (t.cache = !1), t.crossDomain && (t.type = "GET")
        }), at.ajaxTransport("script", function(t) {
            if (t.crossDomain) {
                var e, n;
                return {
                    send: function(i, o) {
                        e = at("<script>").prop({
                            charset: t.scriptCharset,
                            src: t.url
                        }).on("load error", n = function(t) {
                            e.remove(), n = null, t && o("error" === t.type ? 404 : 200, t.type)
                        }), G.head.appendChild(e[0])
                    },
                    abort: function() {
                        n && n()
                    }
                }
            }
        });
        var Le = [],
            $e = /(=)\?(?=&|$)|\?\?/;
        at.ajaxSetup({
            jsonp: "callback",
            jsonpCallback: function() {
                var t = Le.pop() || at.expando + "_" + ve++;
                return this[t] = !0, t
            }
        }), at.ajaxPrefilter("json jsonp", function(e, n, i) {
            var o, a, r, s = e.jsonp !== !1 && ($e.test(e.url) ? "url" : "string" == typeof e.data && 0 === (e.contentType || "").indexOf("application/x-www-form-urlencoded") && $e.test(e.data) && "data");
            return s || "jsonp" === e.dataTypes[0] ? (o = e.jsonpCallback = at.isFunction(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, s ? e[s] = e[s].replace($e, "$1" + o) : e.jsonp !== !1 && (e.url += (ye.test(e.url) ? "&" : "?") + e.jsonp + "=" + o), e.converters["script json"] = function() {
                return r || at.error(o + " was not called"), r[0]
            }, e.dataTypes[0] = "json", a = t[o], t[o] = function() {
                r = arguments
            }, i.always(function() {
                void 0 === a ? at(t).removeProp(o) : t[o] = a, e[o] && (e.jsonpCallback = n.jsonpCallback, Le.push(o)), r && at.isFunction(a) && a(r[0]), r = a = void 0
            }), "script") : void 0
        }), at.parseHTML = function(t, e, n) {
            if (!t || "string" != typeof t) return null;
            "boolean" == typeof e && (n = e, e = !1), e = e || G;
            var i = ft.exec(t),
                o = !n && [];
            return i ? [e.createElement(i[1])] : (i = p([t], e, o), o && o.length && at(o).remove(), at.merge([], i.childNodes))
        };
        var Be = at.fn.load;
        at.fn.load = function(t, e, n) {
            if ("string" != typeof t && Be) return Be.apply(this, arguments);
            var i, o, a, r = this,
                s = t.indexOf(" ");
            return s > -1 && (i = at.trim(t.slice(s)), t = t.slice(0, s)), at.isFunction(e) ? (n = e, e = void 0) : e && "object" == typeof e && (o = "POST"), r.length > 0 && at.ajax({
                url: t,
                type: o || "GET",
                dataType: "html",
                data: e
            }).done(function(t) {
                a = arguments, r.html(i ? at("<div>").append(at.parseHTML(t)).find(i) : t)
            }).always(n && function(t, e) {
                r.each(function() {
                    n.apply(this, a || [t.responseText, e, t])
                })
            }), this
        }, at.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(t, e) {
            at.fn[e] = function(t) {
                return this.on(e, t)
            }
        }), at.expr.filters.animated = function(t) {
            return at.grep(at.timers, function(e) {
                return t === e.elem
            }).length
        }, at.offset = {
            setOffset: function(t, e, n) {
                var i, o, a, r, s, l, c, d = at.css(t, "position"),
                    u = at(t),
                    p = {};
                "static" === d && (t.style.position = "relative"), s = u.offset(), a = at.css(t, "top"), l = at.css(t, "left"), c = ("absolute" === d || "fixed" === d) && (a + l).indexOf("auto") > -1, c ? (i = u.position(), r = i.top, o = i.left) : (r = parseFloat(a) || 0, o = parseFloat(l) || 0), at.isFunction(e) && (e = e.call(t, n, at.extend({}, s))), null != e.top && (p.top = e.top - s.top + r), null != e.left && (p.left = e.left - s.left + o), "using" in e ? e.using.call(t, p) : u.css(p)
            }
        }, at.fn.extend({
            offset: function(t) {
                if (arguments.length) return void 0 === t ? this : this.each(function(e) {
                    at.offset.setOffset(this, t, e)
                });
                var e, n, i = this[0],
                    o = {
                        top: 0,
                        left: 0
                    },
                    a = i && i.ownerDocument;
                return a ? (e = a.documentElement, at.contains(e, i) ? (o = i.getBoundingClientRect(), n = V(a), {
                    top: o.top + n.pageYOffset - e.clientTop,
                    left: o.left + n.pageXOffset - e.clientLeft
                }) : o) : void 0
            },
            position: function() {
                if (this[0]) {
                    var t, e, n = this[0],
                        i = {
                            top: 0,
                            left: 0
                        };
                    return "fixed" === at.css(n, "position") ? e = n.getBoundingClientRect() : (t = this.offsetParent(), e = this.offset(), at.nodeName(t[0], "html") || (i = t.offset()), i.top += at.css(t[0], "borderTopWidth", !0), i.left += at.css(t[0], "borderLeftWidth", !0)), {
                        top: e.top - i.top - at.css(n, "marginTop", !0),
                        left: e.left - i.left - at.css(n, "marginLeft", !0)
                    }
                }
            },
            offsetParent: function() {
                return this.map(function() {
                    for (var t = this.offsetParent; t && "static" === at.css(t, "position");) t = t.offsetParent;
                    return t || Zt
                })
            }
        }), at.each({
            scrollLeft: "pageXOffset",
            scrollTop: "pageYOffset"
        }, function(t, e) {
            var n = "pageYOffset" === e;
            at.fn[t] = function(i) {
                return Tt(this, function(t, i, o) {
                    var a = V(t);
                    return void 0 === o ? a ? a[e] : t[i] : void(a ? a.scrollTo(n ? a.pageXOffset : o, n ? o : a.pageYOffset) : t[i] = o)
                }, t, i, arguments.length)
            }
        }), at.each(["top", "left"], function(t, e) {
            at.cssHooks[e] = E(it.pixelPosition, function(t, n) {
                return n ? (n = k(t, e), Gt.test(n) ? at(t).position()[e] + "px" : n) : void 0
            })
        }), at.each({
            Height: "height",
            Width: "width"
        }, function(t, e) {
            at.each({
                padding: "inner" + t,
                content: e,
                "": "outer" + t
            }, function(n, i) {
                at.fn[i] = function(i, o) {
                    var a = arguments.length && (n || "boolean" != typeof i),
                        r = n || (i === !0 || o === !0 ? "margin" : "border");
                    return Tt(this, function(e, n, i) {
                        var o;
                        return at.isWindow(e) ? e.document.documentElement["client" + t] : 9 === e.nodeType ? (o = e.documentElement, Math.max(e.body["scroll" + t], o["scroll" + t], e.body["offset" + t], o["offset" + t], o["client" + t])) : void 0 === i ? at.css(e, n, r) : at.style(e, n, i, r)
                    }, e, a ? i : void 0, a, null)
                }
            })
        }), at.fn.extend({
            bind: function(t, e, n) {
                return this.on(t, null, e, n)
            },
            unbind: function(t, e) {
                return this.off(t, null, e)
            },
            delegate: function(t, e, n, i) {
                return this.on(e, t, n, i)
            },
            undelegate: function(t, e, n) {
                return 1 === arguments.length ? this.off(t, "**") : this.off(e, t || "**", n)
            },
            size: function() {
                return this.length
            }
        }), at.fn.andSelf = at.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
            return at
        });
        var Fe = t.jQuery,
            He = t.$;
        return at.noConflict = function(e) {
            return t.$ === at && (t.$ = He), e && t.jQuery === at && (t.jQuery = Fe), at
        }, e || (t.jQuery = t.$ = at), at
    }), "undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery"); + function(t) {
    "use strict";
    var e = t.fn.jquery.split(" ")[0].split(".");
    if (e[0] < 2 && e[1] < 9 || 1 == e[0] && 9 == e[1] && e[2] < 1 || e[0] > 3) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")
}(jQuery), + function(t) {
    "use strict";

    function e() {
        var t = document.createElement("bootstrap"),
            e = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                transition: "transitionend"
            };
        for (var n in e)
            if (void 0 !== t.style[n]) return {
                end: e[n]
            };
        return !1
    }
    t.fn.emulateTransitionEnd = function(e) {
        var n = !1,
            i = this;
        t(this).one("bsTransitionEnd", function() {
            n = !0
        });
        var o = function() {
            n || t(i).trigger(t.support.transition.end)
        };
        return setTimeout(o, e), this
    }, t(function() {
        t.support.transition = e(), t.support.transition && (t.event.special.bsTransitionEnd = {
            bindType: t.support.transition.end,
            delegateType: t.support.transition.end,
            handle: function(e) {
                if (t(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
            }
        })
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var n = t(this),
                o = n.data("bs.alert");
            o || n.data("bs.alert", o = new i(this)), "string" == typeof e && o[e].call(n)
        })
    }
    var n = '[data-dismiss="alert"]',
        i = function(e) {
            t(e).on("click", n, this.close)
        };
    i.VERSION = "3.3.7", i.TRANSITION_DURATION = 150, i.prototype.close = function(e) {
        function n() {
            r.detach().trigger("closed.bs.alert").remove()
        }
        var o = t(this),
            a = o.attr("data-target");
        a || (a = o.attr("href"), a = a && a.replace(/.*(?=#[^\s]*$)/, ""));
        var r = t("#" === a ? [] : a);
        e && e.preventDefault(), r.length || (r = o.closest(".alert")), r.trigger(e = t.Event("close.bs.alert")), e.isDefaultPrevented() || (r.removeClass("in"), t.support.transition && r.hasClass("fade") ? r.one("bsTransitionEnd", n).emulateTransitionEnd(i.TRANSITION_DURATION) : n())
    };
    var o = t.fn.alert;
    t.fn.alert = e, t.fn.alert.Constructor = i, t.fn.alert.noConflict = function() {
        return t.fn.alert = o, this
    }, t(document).on("click.bs.alert.data-api", n, i.prototype.close)
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.button"),
                a = "object" == typeof e && e;
            o || i.data("bs.button", o = new n(this, a)), "toggle" == e ? o.toggle() : e && o.setState(e)
        })
    }
    var n = function(e, i) {
        this.$element = t(e), this.options = t.extend({}, n.DEFAULTS, i), this.isLoading = !1
    };
    n.VERSION = "3.3.7", n.DEFAULTS = {
        loadingText: "loading..."
    }, n.prototype.setState = function(e) {
        var n = "disabled",
            i = this.$element,
            o = i.is("input") ? "val" : "html",
            a = i.data();
        e += "Text", null == a.resetText && i.data("resetText", i[o]()), setTimeout(t.proxy(function() {
            i[o](null == a[e] ? this.options[e] : a[e]), "loadingText" == e ? (this.isLoading = !0, i.addClass(n).attr(n, n).prop(n, !0)) : this.isLoading && (this.isLoading = !1, i.removeClass(n).removeAttr(n).prop(n, !1))
        }, this), 0)
    }, n.prototype.toggle = function() {
        var t = !0,
            e = this.$element.closest('[data-toggle="buttons"]');
        if (e.length) {
            var n = this.$element.find("input");
            "radio" == n.prop("type") ? (n.prop("checked") && (t = !1), e.find(".active").removeClass("active"), this.$element.addClass("active")) : "checkbox" == n.prop("type") && (n.prop("checked") !== this.$element.hasClass("active") && (t = !1), this.$element.toggleClass("active")), n.prop("checked", this.$element.hasClass("active")), t && n.trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active")), this.$element.toggleClass("active")
    };
    var i = t.fn.button;
    t.fn.button = e, t.fn.button.Constructor = n, t.fn.button.noConflict = function() {
        return t.fn.button = i, this
    }, t(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function(n) {
        var i = t(n.target).closest(".btn");
        e.call(i, "toggle"), t(n.target).is('input[type="radio"], input[type="checkbox"]') || (n.preventDefault(), i.is("input,button") ? i.trigger("focus") : i.find("input:visible,button:visible").first().trigger("focus"))
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function(e) {
        t(e.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(e.type))
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.carousel"),
                a = t.extend({}, n.DEFAULTS, i.data(), "object" == typeof e && e),
                r = "string" == typeof e ? e : a.slide;
            o || i.data("bs.carousel", o = new n(this, a)), "number" == typeof e ? o.to(e) : r ? o[r]() : a.interval && o.pause().cycle()
        })
    }
    var n = function(e, n) {
        this.$element = t(e), this.$indicators = this.$element.find(".carousel-indicators"), this.options = n, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", t.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", t.proxy(this.pause, this)).on("mouseleave.bs.carousel", t.proxy(this.cycle, this))
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 600, n.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0,
        keyboard: !0
    }, n.prototype.keydown = function(t) {
        if (!/input|textarea/i.test(t.target.tagName)) {
            switch (t.which) {
                case 37:
                    this.prev();
                    break;
                case 39:
                    this.next();
                    break;
                default:
                    return
            }
            t.preventDefault()
        }
    }, n.prototype.cycle = function(e) {
        return e || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(t.proxy(this.next, this), this.options.interval)), this
    }, n.prototype.getItemIndex = function(t) {
        return this.$items = t.parent().children(".item"), this.$items.index(t || this.$active)
    }, n.prototype.getItemForDirection = function(t, e) {
        var n = this.getItemIndex(e),
            i = "prev" == t && 0 === n || "next" == t && n == this.$items.length - 1;
        if (i && !this.options.wrap) return e;
        var o = "prev" == t ? -1 : 1,
            a = (n + o) % this.$items.length;
        return this.$items.eq(a)
    }, n.prototype.to = function(t) {
        var e = this,
            n = this.getItemIndex(this.$active = this.$element.find(".item.active"));
        if (!(t > this.$items.length - 1 || t < 0)) return this.sliding ? this.$element.one("slid.bs.carousel", function() {
            e.to(t)
        }) : n == t ? this.pause().cycle() : this.slide(t > n ? "next" : "prev", this.$items.eq(t))
    }, n.prototype.pause = function(e) {
        return e || (this.paused = !0), this.$element.find(".next, .prev").length && t.support.transition && (this.$element.trigger(t.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, n.prototype.next = function() {
        if (!this.sliding) return this.slide("next")
    }, n.prototype.prev = function() {
        if (!this.sliding) return this.slide("prev")
    }, n.prototype.slide = function(e, i) {
        var o = this.$element.find(".item.active"),
            a = i || this.getItemForDirection(e, o),
            r = this.interval,
            s = "next" == e ? "left" : "right",
            l = this;
        if (a.hasClass("active")) return this.sliding = !1;
        var c = a[0],
            d = t.Event("slide.bs.carousel", {
                relatedTarget: c,
                direction: s
            });
        if (this.$element.trigger(d), !d.isDefaultPrevented()) {
            if (this.sliding = !0, r && this.pause(), this.$indicators.length) {
                this.$indicators.find(".active").removeClass("active");
                var u = t(this.$indicators.children()[this.getItemIndex(a)]);
                u && u.addClass("active")
            }
            var p = t.Event("slid.bs.carousel", {
                relatedTarget: c,
                direction: s
            });
            return t.support.transition && this.$element.hasClass("slide") ? (a.addClass(e), a[0].offsetWidth, o.addClass(s), a.addClass(s), o.one("bsTransitionEnd", function() {
                a.removeClass([e, s].join(" ")).addClass("active"), o.removeClass(["active", s].join(" ")), l.sliding = !1, setTimeout(function() {
                    l.$element.trigger(p)
                }, 0)
            }).emulateTransitionEnd(n.TRANSITION_DURATION)) : (o.removeClass("active"), a.addClass("active"), this.sliding = !1, this.$element.trigger(p)), r && this.cycle(), this
        }
    };
    var i = t.fn.carousel;
    t.fn.carousel = e, t.fn.carousel.Constructor = n, t.fn.carousel.noConflict = function() {
        return t.fn.carousel = i, this
    };
    var o = function(n) {
        var i, o = t(this),
            a = t(o.attr("data-target") || (i = o.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, ""));
        if (a.hasClass("carousel")) {
            var r = t.extend({}, a.data(), o.data()),
                s = o.attr("data-slide-to");
            s && (r.interval = !1), e.call(a, r), s && a.data("bs.carousel").to(s), n.preventDefault()
        }
    };
    t(document).on("click.bs.carousel.data-api", "[data-slide]", o).on("click.bs.carousel.data-api", "[data-slide-to]", o), t(window).on("load", function() {
        t('[data-ride="carousel"]').each(function() {
            var n = t(this);
            e.call(n, n.data())
        })
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        var n, i = e.attr("data-target") || (n = e.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, "");
        return t(i)
    }

    function n(e) {
        return this.each(function() {
            var n = t(this),
                o = n.data("bs.collapse"),
                a = t.extend({}, i.DEFAULTS, n.data(), "object" == typeof e && e);
            !o && a.toggle && /show|hide/.test(e) && (a.toggle = !1), o || n.data("bs.collapse", o = new i(this, a)), "string" == typeof e && o[e]()
        })
    }
    var i = function(e, n) {
        this.$element = t(e), this.options = t.extend({}, i.DEFAULTS, n), this.$trigger = t('[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    i.VERSION = "3.3.7", i.TRANSITION_DURATION = 350, i.DEFAULTS = {
        toggle: !0
    }, i.prototype.dimension = function() {
        var t = this.$element.hasClass("width");
        return t ? "width" : "height"
    }, i.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var e, o = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(o && o.length && (e = o.data("bs.collapse"), e && e.transitioning))) {
                var a = t.Event("show.bs.collapse");
                if (this.$element.trigger(a), !a.isDefaultPrevented()) {
                    o && o.length && (n.call(o, "hide"), e || o.data("bs.collapse", null));
                    var r = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[r](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var s = function() {
                        this.$element.removeClass("collapsing").addClass("collapse in")[r](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!t.support.transition) return s.call(this);
                    var l = t.camelCase(["scroll", r].join("-"));
                    this.$element.one("bsTransitionEnd", t.proxy(s, this)).emulateTransitionEnd(i.TRANSITION_DURATION)[r](this.$element[0][l])
                }
            }
        }
    }, i.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var e = t.Event("hide.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var n = this.dimension();
                this.$element[n](this.$element[n]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var o = function() {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return t.support.transition ? void this.$element[n](0).one("bsTransitionEnd", t.proxy(o, this)).emulateTransitionEnd(i.TRANSITION_DURATION) : o.call(this)
            }
        }
    }, i.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, i.prototype.getParent = function() {
        return t(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(t.proxy(function(n, i) {
            var o = t(i);
            this.addAriaAndCollapsedClass(e(o), o)
        }, this)).end()
    }, i.prototype.addAriaAndCollapsedClass = function(t, e) {
        var n = t.hasClass("in");
        t.attr("aria-expanded", n), e.toggleClass("collapsed", !n).attr("aria-expanded", n)
    };
    var o = t.fn.collapse;
    t.fn.collapse = n, t.fn.collapse.Constructor = i, t.fn.collapse.noConflict = function() {
        return t.fn.collapse = o, this
    }, t(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(i) {
        var o = t(this);
        o.attr("data-target") || i.preventDefault();
        var a = e(o),
            r = a.data("bs.collapse"),
            s = r ? "toggle" : o.data();
        n.call(a, s)
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        var n = e.attr("data-target");
        n || (n = e.attr("href"), n = n && /#[A-Za-z]/.test(n) && n.replace(/.*(?=#[^\s]*$)/, ""));
        var i = n && t(n);
        return i && i.length ? i : e.parent()
    }

    function n(n) {
        n && 3 === n.which || (t(o).remove(), t(a).each(function() {
            var i = t(this),
                o = e(i),
                a = {
                    relatedTarget: this
                };
            o.hasClass("open") && (n && "click" == n.type && /input|textarea/i.test(n.target.tagName) && t.contains(o[0], n.target) || (o.trigger(n = t.Event("hide.bs.dropdown", a)), n.isDefaultPrevented() || (i.attr("aria-expanded", "false"), o.removeClass("open").trigger(t.Event("hidden.bs.dropdown", a)))))
        }))
    }

    function i(e) {
        return this.each(function() {
            var n = t(this),
                i = n.data("bs.dropdown");
            i || n.data("bs.dropdown", i = new r(this)), "string" == typeof e && i[e].call(n)
        })
    }
    var o = ".dropdown-backdrop",
        a = '[data-toggle="dropdown"]',
        r = function(e) {
            t(e).on("click.bs.dropdown", this.toggle)
        };
    r.VERSION = "3.3.7", r.prototype.toggle = function(i) {
        var o = t(this);
        if (!o.is(".disabled, :disabled")) {
            var a = e(o),
                r = a.hasClass("open");
            if (n(), !r) {
                "ontouchstart" in document.documentElement && !a.closest(".navbar-nav").length && t(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(t(this)).on("click", n);
                var s = {
                    relatedTarget: this
                };
                if (a.trigger(i = t.Event("show.bs.dropdown", s)), i.isDefaultPrevented()) return;
                o.trigger("focus").attr("aria-expanded", "true"), a.toggleClass("open").trigger(t.Event("shown.bs.dropdown", s))
            }
            return !1
        }
    }, r.prototype.keydown = function(n) {
        if (/(38|40|27|32)/.test(n.which) && !/input|textarea/i.test(n.target.tagName)) {
            var i = t(this);
            if (n.preventDefault(), n.stopPropagation(), !i.is(".disabled, :disabled")) {
                var o = e(i),
                    r = o.hasClass("open");
                if (!r && 27 != n.which || r && 27 == n.which) return 27 == n.which && o.find(a).trigger("focus"), i.trigger("click");
                var s = " li:not(.disabled):visible a",
                    l = o.find(".dropdown-menu" + s);
                if (l.length) {
                    var c = l.index(n.target);
                    38 == n.which && c > 0 && c--, 40 == n.which && c < l.length - 1 && c++, ~c || (c = 0), l.eq(c).trigger("focus")
                }
            }
        }
    };
    var s = t.fn.dropdown;
    t.fn.dropdown = i, t.fn.dropdown.Constructor = r, t.fn.dropdown.noConflict = function() {
        return t.fn.dropdown = s, this
    }, t(document).on("click.bs.dropdown.data-api", n).on("click.bs.dropdown.data-api", ".dropdown form", function(t) {
        t.stopPropagation()
    }).on("click.bs.dropdown.data-api", a, r.prototype.toggle).on("keydown.bs.dropdown.data-api", a, r.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", r.prototype.keydown)
}(jQuery), + function(t) {
    "use strict";

    function e(e, i) {
        return this.each(function() {
            var o = t(this),
                a = o.data("bs.modal"),
                r = t.extend({}, n.DEFAULTS, o.data(), "object" == typeof e && e);
            a || o.data("bs.modal", a = new n(this, r)), "string" == typeof e ? a[e](i) : r.show && a.show(i)
        })
    }
    var n = function(e, n) {
        this.options = n, this.$body = t(document.body), this.$element = t(e), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, t.proxy(function() {
            this.$element.trigger("loaded.bs.modal")
        }, this))
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 300, n.BACKDROP_TRANSITION_DURATION = 150, n.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, n.prototype.toggle = function(t) {
        return this.isShown ? this.hide() : this.show(t)
    }, n.prototype.show = function(e) {
        var i = this,
            o = t.Event("show.bs.modal", {
                relatedTarget: e
            });
        this.$element.trigger(o), this.isShown || o.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', t.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function() {
            i.$element.one("mouseup.dismiss.bs.modal", function(e) {
                t(e.target).is(i.$element) && (i.ignoreBackdropClick = !0)
            })
        }), this.backdrop(function() {
            var o = t.support.transition && i.$element.hasClass("fade");
            i.$element.parent().length || i.$element.appendTo(i.$body), i.$element.show().scrollTop(0), i.adjustDialog(), o && i.$element[0].offsetWidth, i.$element.addClass("in"), i.enforceFocus();
            var a = t.Event("shown.bs.modal", {
                relatedTarget: e
            });
            o ? i.$dialog.one("bsTransitionEnd", function() {
                i.$element.trigger("focus").trigger(a)
            }).emulateTransitionEnd(n.TRANSITION_DURATION) : i.$element.trigger("focus").trigger(a)
        }))
    }, n.prototype.hide = function(e) {
        e && e.preventDefault(), e = t.Event("hide.bs.modal"), this.$element.trigger(e), this.isShown && !e.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), t(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), t.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", t.proxy(this.hideModal, this)).emulateTransitionEnd(n.TRANSITION_DURATION) : this.hideModal())
    }, n.prototype.enforceFocus = function() {
        t(document).off("focusin.bs.modal").on("focusin.bs.modal", t.proxy(function(t) {
            document === t.target || this.$element[0] === t.target || this.$element.has(t.target).length || this.$element.trigger("focus")
        }, this))
    }, n.prototype.escape = function() {
        this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", t.proxy(function(t) {
            27 == t.which && this.hide()
        }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
    }, n.prototype.resize = function() {
        this.isShown ? t(window).on("resize.bs.modal", t.proxy(this.handleUpdate, this)) : t(window).off("resize.bs.modal")
    }, n.prototype.hideModal = function() {
        var t = this;
        this.$element.hide(), this.backdrop(function() {
            t.$body.removeClass("modal-open"), t.resetAdjustments(), t.resetScrollbar(), t.$element.trigger("hidden.bs.modal")
        })
    }, n.prototype.removeBackdrop = function() {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, n.prototype.backdrop = function(e) {
        var i = this,
            o = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var a = t.support.transition && o;
            if (this.$backdrop = t(document.createElement("div")).addClass("modal-backdrop " + o).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", t.proxy(function(t) {
                    return this.ignoreBackdropClick ? void(this.ignoreBackdropClick = !1) : void(t.target === t.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide()))
                }, this)), a && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !e) return;
            a ? this.$backdrop.one("bsTransitionEnd", e).emulateTransitionEnd(n.BACKDROP_TRANSITION_DURATION) : e()
        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass("in");
            var r = function() {
                i.removeBackdrop(), e && e()
            };
            t.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", r).emulateTransitionEnd(n.BACKDROP_TRANSITION_DURATION) : r()
        } else e && e()
    }, n.prototype.handleUpdate = function() {
        this.adjustDialog()
    }, n.prototype.adjustDialog = function() {
        var t = this.$element[0].scrollHeight > document.documentElement.clientHeight;
        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && t ? this.scrollbarWidth : "",
            paddingRight: this.bodyIsOverflowing && !t ? this.scrollbarWidth : ""
        })
    }, n.prototype.resetAdjustments = function() {
        this.$element.css({
            paddingLeft: "",
            paddingRight: ""
        })
    }, n.prototype.checkScrollbar = function() {
        var t = window.innerWidth;
        if (!t) {
            var e = document.documentElement.getBoundingClientRect();
            t = e.right - Math.abs(e.left)
        }
        this.bodyIsOverflowing = document.body.clientWidth < t, this.scrollbarWidth = this.measureScrollbar()
    }, n.prototype.setScrollbar = function() {
        var t = parseInt(this.$body.css("padding-right") || 0, 10);
        this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", t + this.scrollbarWidth)
    }, n.prototype.resetScrollbar = function() {
        this.$body.css("padding-right", this.originalBodyPad)
    }, n.prototype.measureScrollbar = function() {
        var t = document.createElement("div");
        t.className = "modal-scrollbar-measure", this.$body.append(t);
        var e = t.offsetWidth - t.clientWidth;
        return this.$body[0].removeChild(t), e
    };
    var i = t.fn.modal;
    t.fn.modal = e, t.fn.modal.Constructor = n, t.fn.modal.noConflict = function() {
        return t.fn.modal = i, this
    }, t(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(n) {
        var i = t(this),
            o = i.attr("href"),
            a = t(i.attr("data-target") || o && o.replace(/.*(?=#[^\s]+$)/, "")),
            r = a.data("bs.modal") ? "toggle" : t.extend({
                remote: !/#/.test(o) && o
            }, a.data(), i.data());
        i.is("a") && n.preventDefault(), a.one("show.bs.modal", function(t) {
            t.isDefaultPrevented() || a.one("hidden.bs.modal", function() {
                i.is(":visible") && i.trigger("focus")
            })
        }), e.call(a, r, this)
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.tooltip"),
                a = "object" == typeof e && e;
            !o && /destroy|hide/.test(e) || (o || i.data("bs.tooltip", o = new n(this, a)), "string" == typeof e && o[e]())
        })
    }
    var n = function(t, e) {
        this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", t, e)
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 150, n.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {
            selector: "body",
            padding: 0
        }
    }, n.prototype.init = function(e, n, i) {
        if (this.enabled = !0, this.type = e, this.$element = t(n), this.options = this.getOptions(i), this.$viewport = this.options.viewport && t(t.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
                click: !1,
                hover: !1,
                focus: !1
            }, this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
        for (var o = this.options.trigger.split(" "), a = o.length; a--;) {
            var r = o[a];
            if ("click" == r) this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this));
            else if ("manual" != r) {
                var s = "hover" == r ? "mouseenter" : "focusin",
                    l = "hover" == r ? "mouseleave" : "focusout";
                this.$element.on(s + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = t.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, n.prototype.getDefaults = function() {
        return n.DEFAULTS
    }, n.prototype.getOptions = function(e) {
        return e = t.extend({}, this.getDefaults(), this.$element.data(), e), e.delay && "number" == typeof e.delay && (e.delay = {
            show: e.delay,
            hide: e.delay
        }), e
    }, n.prototype.getDelegateOptions = function() {
        var e = {},
            n = this.getDefaults();
        return this._options && t.each(this._options, function(t, i) {
            n[t] != i && (e[t] = i)
        }), e
    }, n.prototype.enter = function(e) {
        var n = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
        return n || (n = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, n)), e instanceof t.Event && (n.inState["focusin" == e.type ? "focus" : "hover"] = !0), n.tip().hasClass("in") || "in" == n.hoverState ? void(n.hoverState = "in") : (clearTimeout(n.timeout), n.hoverState = "in", n.options.delay && n.options.delay.show ? void(n.timeout = setTimeout(function() {
            "in" == n.hoverState && n.show()
        }, n.options.delay.show)) : n.show())
    }, n.prototype.isInStateTrue = function() {
        for (var t in this.inState)
            if (this.inState[t]) return !0;
        return !1
    }, n.prototype.leave = function(e) {
        var n = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
        if (n || (n = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, n)), e instanceof t.Event && (n.inState["focusout" == e.type ? "focus" : "hover"] = !1), !n.isInStateTrue()) return clearTimeout(n.timeout), n.hoverState = "out", n.options.delay && n.options.delay.hide ? void(n.timeout = setTimeout(function() {
            "out" == n.hoverState && n.hide()
        }, n.options.delay.hide)) : n.hide()
    }, n.prototype.show = function() {
        var e = t.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(e);
            var i = t.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (e.isDefaultPrevented() || !i) return;
            var o = this,
                a = this.tip(),
                r = this.getUID(this.type);
            this.setContent(), a.attr("id", r), this.$element.attr("aria-describedby", r), this.options.animation && a.addClass("fade");
            var s = "function" == typeof this.options.placement ? this.options.placement.call(this, a[0], this.$element[0]) : this.options.placement,
                l = /\s?auto?\s?/i,
                c = l.test(s);
            c && (s = s.replace(l, "") || "top"), a.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(s).data("bs." + this.type, this), this.options.container ? a.appendTo(this.options.container) : a.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
            var d = this.getPosition(),
                u = a[0].offsetWidth,
                p = a[0].offsetHeight;
            if (c) {
                var h = s,
                    f = this.getPosition(this.$viewport);
                s = "bottom" == s && d.bottom + p > f.bottom ? "top" : "top" == s && d.top - p < f.top ? "bottom" : "right" == s && d.right + u > f.width ? "left" : "left" == s && d.left - u < f.left ? "right" : s, a.removeClass(h).addClass(s)
            }
            var m = this.getCalculatedOffset(s, d, u, p);
            this.applyPlacement(m, s);
            var g = function() {
                var t = o.hoverState;
                o.$element.trigger("shown.bs." + o.type), o.hoverState = null, "out" == t && o.leave(o)
            };
            t.support.transition && this.$tip.hasClass("fade") ? a.one("bsTransitionEnd", g).emulateTransitionEnd(n.TRANSITION_DURATION) : g()
        }
    }, n.prototype.applyPlacement = function(e, n) {
        var i = this.tip(),
            o = i[0].offsetWidth,
            a = i[0].offsetHeight,
            r = parseInt(i.css("margin-top"), 10),
            s = parseInt(i.css("margin-left"), 10);
        isNaN(r) && (r = 0), isNaN(s) && (s = 0), e.top += r, e.left += s, t.offset.setOffset(i[0], t.extend({
            using: function(t) {
                i.css({
                    top: Math.round(t.top),
                    left: Math.round(t.left)
                })
            }
        }, e), 0), i.addClass("in");
        var l = i[0].offsetWidth,
            c = i[0].offsetHeight;
        "top" == n && c != a && (e.top = e.top + a - c);
        var d = this.getViewportAdjustedDelta(n, e, l, c);
        d.left ? e.left += d.left : e.top += d.top;
        var u = /top|bottom/.test(n),
            p = u ? 2 * d.left - o + l : 2 * d.top - a + c,
            h = u ? "offsetWidth" : "offsetHeight";
        i.offset(e), this.replaceArrow(p, i[0][h], u)
    }, n.prototype.replaceArrow = function(t, e, n) {
        this.arrow().css(n ? "left" : "top", 50 * (1 - t / e) + "%").css(n ? "top" : "left", "")
    }, n.prototype.setContent = function() {
        var t = this.tip(),
            e = this.getTitle();
        t.find(".tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("fade in top bottom left right")
    }, n.prototype.hide = function(e) {
        function i() {
            "in" != o.hoverState && a.detach(), o.$element && o.$element.removeAttr("aria-describedby").trigger("hidden.bs." + o.type), e && e()
        }
        var o = this,
            a = t(this.$tip),
            r = t.Event("hide.bs." + this.type);
        if (this.$element.trigger(r), !r.isDefaultPrevented()) return a.removeClass("in"), t.support.transition && a.hasClass("fade") ? a.one("bsTransitionEnd", i).emulateTransitionEnd(n.TRANSITION_DURATION) : i(), this.hoverState = null, this
    }, n.prototype.fixTitle = function() {
        var t = this.$element;
        (t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "")
    }, n.prototype.hasContent = function() {
        return this.getTitle()
    }, n.prototype.getPosition = function(e) {
        e = e || this.$element;
        var n = e[0],
            i = "BODY" == n.tagName,
            o = n.getBoundingClientRect();
        null == o.width && (o = t.extend({}, o, {
            width: o.right - o.left,
            height: o.bottom - o.top
        }));
        var a = window.SVGElement && n instanceof window.SVGElement,
            r = i ? {
                top: 0,
                left: 0
            } : a ? null : e.offset(),
            s = {
                scroll: i ? document.documentElement.scrollTop || document.body.scrollTop : e.scrollTop()
            },
            l = i ? {
                width: t(window).width(),
                height: t(window).height()
            } : null;
        return t.extend({}, o, s, l, r)
    }, n.prototype.getCalculatedOffset = function(t, e, n, i) {
        return "bottom" == t ? {
            top: e.top + e.height,
            left: e.left + e.width / 2 - n / 2
        } : "top" == t ? {
            top: e.top - i,
            left: e.left + e.width / 2 - n / 2
        } : "left" == t ? {
            top: e.top + e.height / 2 - i / 2,
            left: e.left - n
        } : {
            top: e.top + e.height / 2 - i / 2,
            left: e.left + e.width
        }
    }, n.prototype.getViewportAdjustedDelta = function(t, e, n, i) {
        var o = {
            top: 0,
            left: 0
        };
        if (!this.$viewport) return o;
        var a = this.options.viewport && this.options.viewport.padding || 0,
            r = this.getPosition(this.$viewport);
        if (/right|left/.test(t)) {
            var s = e.top - a - r.scroll,
                l = e.top + a - r.scroll + i;
            s < r.top ? o.top = r.top - s : l > r.top + r.height && (o.top = r.top + r.height - l)
        } else {
            var c = e.left - a,
                d = e.left + a + n;
            c < r.left ? o.left = r.left - c : d > r.right && (o.left = r.left + r.width - d)
        }
        return o
    }, n.prototype.getTitle = function() {
        var t, e = this.$element,
            n = this.options;
        return t = e.attr("data-original-title") || ("function" == typeof n.title ? n.title.call(e[0]) : n.title)
    }, n.prototype.getUID = function(t) {
        do t += ~~(1e6 * Math.random()); while (document.getElementById(t));
        return t
    }, n.prototype.tip = function() {
        if (!this.$tip && (this.$tip = t(this.options.template), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
        return this.$tip
    }, n.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, n.prototype.enable = function() {
        this.enabled = !0
    }, n.prototype.disable = function() {
        this.enabled = !1
    }, n.prototype.toggleEnabled = function() {
        this.enabled = !this.enabled
    }, n.prototype.toggle = function(e) {
        var n = this;
        e && (n = t(e.currentTarget).data("bs." + this.type), n || (n = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, n))), e ? (n.inState.click = !n.inState.click, n.isInStateTrue() ? n.enter(n) : n.leave(n)) : n.tip().hasClass("in") ? n.leave(n) : n.enter(n)
    }, n.prototype.destroy = function() {
        var t = this;
        clearTimeout(this.timeout), this.hide(function() {
            t.$element.off("." + t.type).removeData("bs." + t.type), t.$tip && t.$tip.detach(), t.$tip = null, t.$arrow = null, t.$viewport = null, t.$element = null
        })
    };
    var i = t.fn.tooltip;
    t.fn.tooltip = e, t.fn.tooltip.Constructor = n, t.fn.tooltip.noConflict = function() {
        return t.fn.tooltip = i, this
    }
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.popover"),
                a = "object" == typeof e && e;
            !o && /destroy|hide/.test(e) || (o || i.data("bs.popover", o = new n(this, a)), "string" == typeof e && o[e]())
        })
    }
    var n = function(t, e) {
        this.init("popover", t, e)
    };
    if (!t.fn.tooltip) throw new Error("Popover requires tooltip.js");
    n.VERSION = "3.3.7", n.DEFAULTS = t.extend({}, t.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), n.prototype = t.extend({}, t.fn.tooltip.Constructor.prototype), n.prototype.constructor = n, n.prototype.getDefaults = function() {
        return n.DEFAULTS
    }, n.prototype.setContent = function() {
        var t = this.tip(),
            e = this.getTitle(),
            n = this.getContent();
        t.find(".popover-title")[this.options.html ? "html" : "text"](e), t.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof n ? "html" : "append" : "text"](n), t.removeClass("fade top bottom left right in"), t.find(".popover-title").html() || t.find(".popover-title").hide()
    }, n.prototype.hasContent = function() {
        return this.getTitle() || this.getContent()
    }, n.prototype.getContent = function() {
        var t = this.$element,
            e = this.options;
        return t.attr("data-content") || ("function" == typeof e.content ? e.content.call(t[0]) : e.content)
    }, n.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    };
    var i = t.fn.popover;
    t.fn.popover = e, t.fn.popover.Constructor = n, t.fn.popover.noConflict = function() {
        return t.fn.popover = i, this
    }
}(jQuery), + function(t) {
    "use strict";

    function e(n, i) {
        this.$body = t(document.body), this.$scrollElement = t(t(n).is(document.body) ? window : n), this.options = t.extend({}, e.DEFAULTS, i), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", t.proxy(this.process, this)), this.refresh(), this.process()
    }

    function n(n) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.scrollspy"),
                a = "object" == typeof n && n;
            o || i.data("bs.scrollspy", o = new e(this, a)), "string" == typeof n && o[n]()
        })
    }
    e.VERSION = "3.3.7", e.DEFAULTS = {
        offset: 10
    }, e.prototype.getScrollHeight = function() {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }, e.prototype.refresh = function() {
        var e = this,
            n = "offset",
            i = 0;
        this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), t.isWindow(this.$scrollElement[0]) || (n = "position", i = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function() {
            var e = t(this),
                o = e.data("target") || e.attr("href"),
                a = /^#./.test(o) && t(o);
            return a && a.length && a.is(":visible") && [
                [a[n]().top + i, o]
            ] || null
        }).sort(function(t, e) {
            return t[0] - e[0]
        }).each(function() {
            e.offsets.push(this[0]), e.targets.push(this[1])
        })
    }, e.prototype.process = function() {
        var t, e = this.$scrollElement.scrollTop() + this.options.offset,
            n = this.getScrollHeight(),
            i = this.options.offset + n - this.$scrollElement.height(),
            o = this.offsets,
            a = this.targets,
            r = this.activeTarget;
        if (this.scrollHeight != n && this.refresh(), e >= i) return r != (t = a[a.length - 1]) && this.activate(t);
        if (r && e < o[0]) return this.activeTarget = null, this.clear();
        for (t = o.length; t--;) r != a[t] && e >= o[t] && (void 0 === o[t + 1] || e < o[t + 1]) && this.activate(a[t])
    }, e.prototype.activate = function(e) {
        this.activeTarget = e, this.clear();
        var n = this.selector + '[data-target="' + e + '"],' + this.selector + '[href="' + e + '"]',
            i = t(n).parents("li").addClass("active");
        i.parent(".dropdown-menu").length && (i = i.closest("li.dropdown").addClass("active")), i.trigger("activate.bs.scrollspy")
    }, e.prototype.clear = function() {
        t(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
    };
    var i = t.fn.scrollspy;
    t.fn.scrollspy = n, t.fn.scrollspy.Constructor = e, t.fn.scrollspy.noConflict = function() {
        return t.fn.scrollspy = i, this
    }, t(window).on("load.bs.scrollspy.data-api", function() {
        t('[data-spy="scroll"]').each(function() {
            var e = t(this);
            n.call(e, e.data())
        })
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.tab");
            o || i.data("bs.tab", o = new n(this)), "string" == typeof e && o[e]()
        })
    }
    var n = function(e) {
        this.element = t(e)
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 150, n.prototype.show = function() {
        var e = this.element,
            n = e.closest("ul:not(.dropdown-menu)"),
            i = e.data("target");
        if (i || (i = e.attr("href"), i = i && i.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("active")) {
            var o = n.find(".active:last a"),
                a = t.Event("hide.bs.tab", {
                    relatedTarget: e[0]
                }),
                r = t.Event("show.bs.tab", {
                    relatedTarget: o[0]
                });
            if (o.trigger(a), e.trigger(r), !r.isDefaultPrevented() && !a.isDefaultPrevented()) {
                var s = t(i);
                this.activate(e.closest("li"), n), this.activate(s, s.parent(), function() {
                    o.trigger({
                        type: "hidden.bs.tab",
                        relatedTarget: e[0]
                    }), e.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: o[0]
                    })
                })
            }
        }
    }, n.prototype.activate = function(e, i, o) {
        function a() {
            r.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), e.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), s ? (e[0].offsetWidth, e.addClass("in")) : e.removeClass("fade"), e.parent(".dropdown-menu").length && e.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), o && o()
        }
        var r = i.find("> .active"),
            s = o && t.support.transition && (r.length && r.hasClass("fade") || !!i.find("> .fade").length);
        r.length && s ? r.one("bsTransitionEnd", a).emulateTransitionEnd(n.TRANSITION_DURATION) : a(), r.removeClass("in")
    };
    var i = t.fn.tab;
    t.fn.tab = e, t.fn.tab.Constructor = n, t.fn.tab.noConflict = function() {
        return t.fn.tab = i, this
    };
    var o = function(n) {
        n.preventDefault(), e.call(t(this), "show")
    };
    t(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', o).on("click.bs.tab.data-api", '[data-toggle="pill"]', o)
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var i = t(this),
                o = i.data("bs.affix"),
                a = "object" == typeof e && e;
            o || i.data("bs.affix", o = new n(this, a)), "string" == typeof e && o[e]()
        })
    }
    var n = function(e, i) {
        this.options = t.extend({}, n.DEFAULTS, i), this.$target = t(this.options.target).on("scroll.bs.affix.data-api", t.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", t.proxy(this.checkPositionWithEventLoop, this)), this.$element = t(e), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition()
    };
    n.VERSION = "3.3.7", n.RESET = "affix affix-top affix-bottom", n.DEFAULTS = {
        offset: 0,
        target: window
    }, n.prototype.getState = function(t, e, n, i) {
        var o = this.$target.scrollTop(),
            a = this.$element.offset(),
            r = this.$target.height();
        if (null != n && "top" == this.affixed) return o < n && "top";
        if ("bottom" == this.affixed) return null != n ? !(o + this.unpin <= a.top) && "bottom" : !(o + r <= t - i) && "bottom";
        var s = null == this.affixed,
            l = s ? o : a.top,
            c = s ? r : e;
        return null != n && o <= n ? "top" : null != i && l + c >= t - i && "bottom"
    }, n.prototype.getPinnedOffset = function() {
        if (this.pinnedOffset) return this.pinnedOffset;
        this.$element.removeClass(n.RESET).addClass("affix");
        var t = this.$target.scrollTop(),
            e = this.$element.offset();
        return this.pinnedOffset = e.top - t
    }, n.prototype.checkPositionWithEventLoop = function() {
        setTimeout(t.proxy(this.checkPosition, this), 1)
    }, n.prototype.checkPosition = function() {
        if (this.$element.is(":visible")) {
            var e = this.$element.height(),
                i = this.options.offset,
                o = i.top,
                a = i.bottom,
                r = Math.max(t(document).height(), t(document.body).height());
            "object" != typeof i && (a = o = i), "function" == typeof o && (o = i.top(this.$element)), "function" == typeof a && (a = i.bottom(this.$element));
            var s = this.getState(r, e, o, a);
            if (this.affixed != s) {
                null != this.unpin && this.$element.css("top", "");
                var l = "affix" + (s ? "-" + s : ""),
                    c = t.Event(l + ".bs.affix");
                if (this.$element.trigger(c), c.isDefaultPrevented()) return;
                this.affixed = s, this.unpin = "bottom" == s ? this.getPinnedOffset() : null, this.$element.removeClass(n.RESET).addClass(l).trigger(l.replace("affix", "affixed") + ".bs.affix")
            }
            "bottom" == s && this.$element.offset({
                top: r - e - a
            })
        }
    };
    var i = t.fn.affix;
    t.fn.affix = e, t.fn.affix.Constructor = n, t.fn.affix.noConflict = function() {
        return t.fn.affix = i, this
    }, t(window).on("load", function() {
        t('[data-spy="affix"]').each(function() {
            var n = t(this),
                i = n.data();
            i.offset = i.offset || {}, null != i.offsetBottom && (i.offset.bottom = i.offsetBottom), null != i.offsetTop && (i.offset.top = i.offsetTop), e.call(n, i)
        })
    })
}(jQuery);
var ResponsiveBootstrapToolkit = function(t) {
    var e = {
            detectionDivs: {
                bootstrap: {
                    xs: t('<div class="device-xs visible-xs visible-xs-block"></div>'),
                    sm: t('<div class="device-sm visible-sm visible-sm-block"></div>'),
                    md: t('<div class="device-md visible-md visible-md-block"></div>'),
                    lg: t('<div class="device-lg visible-lg visible-lg-block"></div>')
                },
                foundation: {
                    small: t('<div class="device-xs show-for-small-only"></div>'),
                    medium: t('<div class="device-sm show-for-medium-only"></div>'),
                    large: t('<div class="device-md show-for-large-only"></div>'),
                    xlarge: t('<div class="device-lg show-for-xlarge-only"></div>')
                }
            },
            applyDetectionDivs: function() {
                t(document).ready(function() {
                    t.each(n.breakpoints, function(t) {
                        n.breakpoints[t].appendTo(".responsive-bootstrap-toolkit")
                    })
                })
            },
            isAnExpression: function(t) {
                return "<" == t.charAt(0) || ">" == t.charAt(0)
            },
            splitExpression: function(t) {
                var e = t.charAt(0),
                    n = "=" == t.charAt(1),
                    i = 1 + (n ? 1 : 0),
                    o = t.slice(i);
                return {
                    operator: e,
                    orEqual: n,
                    breakpointName: o
                }
            },
            isAnyActive: function(e) {
                var i = !1;
                return t.each(e, function(t, e) {
                    return n.breakpoints[e].is(":visible") ? (i = !0, !1) : void 0
                }), i
            },
            isMatchingExpression: function(t) {
                var i = e.splitExpression(t),
                    o = Object.keys(n.breakpoints),
                    a = o.indexOf(i.breakpointName);
                if (-1 !== a) {
                    var r = 0,
                        s = 0;
                    "<" == i.operator && (r = 0, s = i.orEqual ? ++a : a), ">" == i.operator && (r = i.orEqual ? a : ++a, s = void 0);
                    var l = o.slice(r, s);
                    return e.isAnyActive(l)
                }
            }
        },
        n = {
            interval: 300,
            framework: null,
            breakpoints: null,
            is: function(t) {
                return e.isAnExpression(t) ? e.isMatchingExpression(t) : n.breakpoints[t] && n.breakpoints[t].is(":visible")
            },
            use: function(t, i) {
                n.framework = t.toLowerCase(), n.breakpoints = "bootstrap" === n.framework || "foundation" === n.framework ? e.detectionDivs[n.framework] : i, e.applyDetectionDivs()
            },
            current: function() {
                var e = "unrecognized";
                return t.each(n.breakpoints, function(t) {
                    n.is(t) && (e = t)
                }), e
            },
            changed: function(t, e) {
                var i;
                return function() {
                    clearTimeout(i), i = setTimeout(function() {
                        t()
                    }, e || n.interval)
                }
            }
        };
    return t(document).ready(function() {
        t('<div class="responsive-bootstrap-toolkit"></div>').appendTo("body")
    }), null === n.framework && n.use("bootstrap"), n
}(jQuery);
! function(t, e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e(require("jquery")) : t.bootbox = e(t.jQuery)
}(this, function t(e, n) {
    "use strict";

    function i(t) {
        var e = g[f.locale];
        return e ? e[t] : g.en[t]
    }

    function o(t, n, i) {
        t.stopPropagation(), t.preventDefault();
        var o = e.isFunction(i) && i.call(n, t) === !1;
        o || n.modal("hide")
    }

    function a(t) {
        var e, n = 0;
        for (e in t) n++;
        return n
    }

    function r(t, n) {
        var i = 0;
        e.each(t, function(t, e) {
            n(t, e, i++)
        })
    }

    function s(t) {
        var n, i;
        if ("object" != typeof t) throw new Error("Please supply an object of options");
        if (!t.message) throw new Error("Please specify a message");
        return t = e.extend({}, f, t), t.buttons || (t.buttons = {}), n = t.buttons, i = a(n), r(n, function(t, o, a) {
            if (e.isFunction(o) && (o = n[t] = {
                    callback: o
                }), "object" !== e.type(o)) throw new Error("button with key " + t + " must be an object");
            o.label || (o.label = t), o.className || (i <= 2 && a === i - 1 ? o.className = "btn-danger" : o.className = "btn-default")
        }), t
    }

    function l(t, e) {
        var n = t.length,
            i = {};
        if (n < 1 || n > 2) throw new Error("Invalid argument length");
        return 2 === n || "string" == typeof t[0] ? (i[e[0]] = t[0], i[e[1]] = t[1]) : i = t[0], i
    }

    function c(t, n, i) {
        return e.extend(!0, {}, t, l(n, i))
    }

    function d(t, e, n, i) {
        var o = {
            className: "bootbox-" + t,
            buttons: u.apply(null, e)
        };
        return p(c(o, i, n), e)
    }

    function u() {
        for (var t = {}, e = 0, n = arguments.length; e < n; e++) {
            var o = arguments[e],
                a = o.toLowerCase(),
                r = o.toUpperCase();
            t[a] = {
                label: i(r)
            }
        }
        return t
    }

    function p(t, e) {
        var i = {};
        return r(e, function(t, e) {
            i[e] = !0
        }), r(t.buttons, function(t) {
            if (i[t] === n) throw new Error("button key " + t + " is not allowed (options are " + e.join("\n") + ")")
        }), t
    }
    var h = {
            dialog: "<div class='bootbox modal modal-2' tabindex='-1' role='dialog'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><div class='bootbox-body'></div></div></div></div></div>",
            header: "<div class='modal-header'><h4 class='modal-title'></h4></div>",
            footer: "<div class='modal-footer'></div>",
            closeButton: "<button type='button' class='bootbox-close-button' data-dismiss='modal' aria-hidden='true'><i class='fa fa-close'></i></button>",
            form: "<form class='bootbox-form'></form>",
            inputs: {
                text: "<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",
                textarea: "<textarea class='bootbox-input bootbox-input-textarea form-control'></textarea>",
                email: "<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",
                select: "<select class='bootbox-input bootbox-input-select form-control'></select>",
                checkbox: "<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>",
                date: "<input class='bootbox-input bootbox-input-date form-control' autocomplete=off type='date' />",
                time: "<input class='bootbox-input bootbox-input-time form-control' autocomplete=off type='time' />",
                number: "<input class='bootbox-input bootbox-input-number form-control' autocomplete=off type='number' />",
                password: "<input class='bootbox-input bootbox-input-password form-control' autocomplete='off' type='password' />"
            }
        },
        f = {
            locale: "vina",
            backdrop: !1,
            animate: !0,
            className: null,
            closeButton: !0,
            show: !0,
            container: "body"
        },
        m = {};
    m.alert = function() {
        var t;
        if (t = d("alert", ["ok"], ["message", "callback"], arguments), t.callback && !e.isFunction(t.callback)) throw new Error("alert requires callback property to be a function when provided");
        return t.buttons.ok.callback = t.onEscape = function() {
            return !e.isFunction(t.callback) || t.callback.call(this)
        }, t.title || (t.title = "Thông báo"), m.dialog(t)
    }, m.confirm = function() {
        var t;
        if (t = d("confirm", ["cancel", "confirm"], ["message", "callback"], arguments), t.buttons.cancel.callback = t.onEscape = function() {
                return t.callback.call(this, !1)
            }, t.buttons.confirm.callback = function() {
                return t.callback.call(this, !0)
            }, !e.isFunction(t.callback)) throw new Error("confirm requires a callback");
        return t.title || (t.title = "Thông báo"), m.dialog(t)
    }, m.prompt = function() {
        var t, i, o, a, s, l, d;
        if (a = e(h.form), i = {
                className: "bootbox-prompt",
                buttons: u("cancel", "confirm"),
                value: "",
                inputType: "text"
            }, t = p(c(i, arguments, ["title", "callback"]), ["cancel", "confirm"]), l = t.show === n || t.show, t.message = a, t.buttons.cancel.callback = t.onEscape = function() {
                return t.callback.call(this, null)
            }, t.buttons.confirm.callback = function() {
                var n;
                switch (t.inputType) {
                    case "text":
                    case "textarea":
                    case "email":
                    case "select":
                    case "date":
                    case "time":
                    case "number":
                    case "password":
                        n = s.val();
                        break;
                    case "checkbox":
                        var i = s.find("input:checked");
                        n = [], r(i, function(t, i) {
                            n.push(e(i).val())
                        })
                }
                return t.callback.call(this, n)
            }, t.show = !1, !t.title) throw new Error("prompt requires a title");
        if (!e.isFunction(t.callback)) throw new Error("prompt requires a callback");
        if (!h.inputs[t.inputType]) throw new Error("invalid prompt type");
        switch (s = e(h.inputs[t.inputType]), t.inputType) {
            case "text":
            case "textarea":
            case "email":
            case "date":
            case "time":
            case "number":
            case "password":
                s.val(t.value);
                break;
            case "select":
                var f = {};
                if (d = t.inputOptions || [], !e.isArray(d)) throw new Error("Please pass an array of input options");
                if (!d.length) throw new Error("prompt with select requires options");
                r(d, function(t, i) {
                    var o = s;
                    if (i.value === n || i.text === n) throw new Error("given options in wrong format");
                    i.group && (f[i.group] || (f[i.group] = e("<optgroup/>").attr("label", i.group)), o = f[i.group]), o.append("<option value='" + i.value + "'>" + i.text + "</option>")
                }), r(f, function(t, e) {
                    s.append(e)
                }), s.val(t.value);
                break;
            case "checkbox":
                var g = e.isArray(t.value) ? t.value : [t.value];
                if (d = t.inputOptions || [], !d.length) throw new Error("prompt with checkbox requires options");
                if (!d[0].value || !d[0].text) throw new Error("given options in wrong format");
                s = e("<div/>"), r(d, function(n, i) {
                    var o = e(h.inputs[t.inputType]);
                    o.find("input").attr("value", i.value), o.find("label").append(i.text), r(g, function(t, e) {
                        e === i.value && o.find("input").prop("checked", !0)
                    }), s.append(o)
                })
        }
        return t.placeholder && s.attr("placeholder", t.placeholder), t.pattern && s.attr("pattern", t.pattern), t.maxlength && s.attr("maxlength", t.maxlength), a.append(s), a.on("submit", function(t) {
            t.preventDefault(), t.stopPropagation(), o.find(".btn-danger").click()
        }), o = m.dialog(t), o.off("shown.bs.modal"), o.on("shown.bs.modal", function() {
            s.focus()
        }), l === !0 && o.modal("show"), o
    }, m.dialog = function(t) {
        t = s(t);
        var i = e(h.dialog),
            a = i.find(".modal-dialog"),
            l = i.find(".modal-body"),
            c = t.buttons,
            d = "",
            u = {
                onEscape: t.onEscape
            };
        if (e.fn.modal === n) throw new Error("$.fn.modal is not defined; please double check you have included the Bootstrap JavaScript library. See http://getbootstrap.com/javascript/ for more details.");
        if (r(c, function(t, e) {
                d += "<button data-bb-handler='" + t + "' type='button' class='btn " + e.className + "'>" + e.label + "</button>", u[t] = e.callback
            }), l.find(".bootbox-body").html(t.message), t.animate === !0 && i.addClass("fade"), t.className && i.addClass(t.className), "large" === t.size ? a.addClass("modal-lg") : "small" === t.size && a.addClass("modal-sm"), t.title && l.before(h.header), t.closeButton) {
            var p = e(h.closeButton);
            t.title ? i.find(".modal-header").prepend(p) : p.prependTo(l)
        }
        return t.title && i.find(".modal-title").html(t.title), d.length && (l.after(h.footer), i.find(".modal-footer").html(d)), i.on("hidden.bs.modal", function(t) {
            t.target === this && i.remove()
        }), i.on("shown.bs.modal", function() {
            i.find(".btn-danger:first").focus()
        }), "static" !== t.backdrop && i.on("click.dismiss.bs.modal", function(t) {
            i.children(".modal-backdrop").length && (t.currentTarget = i.children(".modal-backdrop").get(0)), t.target === t.currentTarget && i.trigger("escape.close.bb")
        }), i.on("escape.close.bb", function(t) {
            u.onEscape && o(t, i, u.onEscape)
        }), i.on("click", ".modal-footer button", function(t) {
            var n = e(this).data("bb-handler");
            o(t, i, u[n])
        }), i.on("click", ".bootbox-close-button", function(t) {
            o(t, i, u.onEscape)
        }), i.on("keyup", function(t) {
            27 === t.which && i.trigger("escape.close.bb")
        }), e(t.container).append(i), i.modal({
            backdrop: !!t.backdrop || "static",
            keyboard: !1,
            show: !1
        }), t.show && i.modal("show"), i
    }, m.setDefaults = function() {
        var t = {};
        2 === arguments.length ? t[arguments[0]] = arguments[1] : t = arguments[0], e.extend(f, t)
    }, m.hideAll = function() {
        return e(".bootbox").modal("hide"), m
    };
    var g = {
        bg_BG: {
            OK: "Ок",
            CANCEL: "Отказ",
            CONFIRM: "Потвърждавам"
        },
        br: {
            OK: "OK",
            CANCEL: "Cancelar",
            CONFIRM: "Sim"
        },
        cs: {
            OK: "OK",
            CANCEL: "Zrušit",
            CONFIRM: "Potvrdit"
        },
        da: {
            OK: "OK",
            CANCEL: "Annuller",
            CONFIRM: "Accepter"
        },
        de: {
            OK: "OK",
            CANCEL: "Abbrechen",
            CONFIRM: "Akzeptieren"
        },
        el: {
            OK: "Εντάξει",
            CANCEL: "Ακύρωση",
            CONFIRM: "Επιβεβαίωση"
        },
        en: {
            OK: "OK",
            CANCEL: "Cancel",
            CONFIRM: "OK"
        },
        es: {
            OK: "OK",
            CANCEL: "Cancelar",
            CONFIRM: "Aceptar"
        },
        et: {
            OK: "OK",
            CANCEL: "Katkesta",
            CONFIRM: "OK"
        },
        fa: {
            OK: "قبول",
            CANCEL: "لغو",
            CONFIRM: "تایید"
        },
        fi: {
            OK: "OK",
            CANCEL: "Peruuta",
            CONFIRM: "OK"
        },
        fr: {
            OK: "OK",
            CANCEL: "Annuler",
            CONFIRM: "D'accord"
        },
        he: {
            OK: "אישור",
            CANCEL: "ביטול",
            CONFIRM: "אישור"
        },
        hu: {
            OK: "OK",
            CANCEL: "Mégsem",
            CONFIRM: "Megerősít"
        },
        hr: {
            OK: "OK",
            CANCEL: "Odustani",
            CONFIRM: "Potvrdi"
        },
        id: {
            OK: "OK",
            CANCEL: "Batal",
            CONFIRM: "OK"
        },
        it: {
            OK: "OK",
            CANCEL: "Annulla",
            CONFIRM: "Conferma"
        },
        ja: {
            OK: "OK",
            CANCEL: "キャンセル",
            CONFIRM: "確認"
        },
        lt: {
            OK: "Gerai",
            CANCEL: "Atšaukti",
            CONFIRM: "Patvirtinti"
        },
        lv: {
            OK: "Labi",
            CANCEL: "Atcelt",
            CONFIRM: "Apstiprināt"
        },
        nl: {
            OK: "OK",
            CANCEL: "Annuleren",
            CONFIRM: "Accepteren"
        },
        no: {
            OK: "OK",
            CANCEL: "Avbryt",
            CONFIRM: "OK"
        },
        pl: {
            OK: "OK",
            CANCEL: "Anuluj",
            CONFIRM: "Potwierdź"
        },
        pt: {
            OK: "OK",
            CANCEL: "Cancelar",
            CONFIRM: "Confirmar"
        },
        ru: {
            OK: "OK",
            CANCEL: "Отмена",
            CONFIRM: "Применить"
        },
        sq: {
            OK: "OK",
            CANCEL: "Anulo",
            CONFIRM: "Prano"
        },
        sv: {
            OK: "OK",
            CANCEL: "Avbryt",
            CONFIRM: "OK"
        },
        th: {
            OK: "ตกลง",
            CANCEL: "ยกเลิก",
            CONFIRM: "ยืนยัน"
        },
        tr: {
            OK: "Tamam",
            CANCEL: "İptal",
            CONFIRM: "Onayla"
        },
        zh_CN: {
            OK: "OK",
            CANCEL: "取消",
            CONFIRM: "确认"
        },
        zh_TW: {
            OK: "OK",
            CANCEL: "取消",
            CONFIRM: "確認"
        },
        vina: {
            OK: "Đồng ý",
            CANCEL: "Từ chối",
            CONFIRM: "Xác nhận"
        }
    };
    return m.addLocale = function(t, n) {
        return e.each(["OK", "CANCEL", "CONFIRM"], function(t, e) {
            if (!n[e]) throw new Error("Please supply a translation for '" + e + "'")
        }), g[t] = {
            OK: n.OK,
            CANCEL: n.CANCEL,
            CONFIRM: n.CONFIRM
        }, m
    }, m.removeLocale = function(t) {
        return delete g[t], m
    }, m.setLocale = function(t) {
        return m.setDefaults("locale", t)
    }, m.init = function(n) {
        return t(n || e)
    }, m
}), ! function(t) {
    "function" == typeof define && define.amd ? define(["jquery"], t) : t("object" == typeof exports ? require("jquery") : jQuery)
}(function(t, e) {
    function n() {
        return new Date(Date.UTC.apply(Date, arguments))
    }

    function i() {
        var t = new Date;
        return n(t.getFullYear(), t.getMonth(), t.getDate())
    }

    function o(t, e) {
        return t.getUTCFullYear() === e.getUTCFullYear() && t.getUTCMonth() === e.getUTCMonth() && t.getUTCDate() === e.getUTCDate()
    }

    function a(t) {
        return function() {
            return this[t].apply(this, arguments)
        }
    }

    function r(t) {
        return t && !isNaN(t.getTime())
    }

    function s(e, n) {
        function i(t, e) {
            return e.toLowerCase()
        }
        var o, a = t(e).data(),
            r = {},
            s = new RegExp("^" + n.toLowerCase() + "([A-Z])");
        n = new RegExp("^" + n.toLowerCase());
        for (var l in a) n.test(l) && (o = l.replace(s, i), r[o] = a[l]);
        return r
    }

    function l(e) {
        var n = {};
        if (g[e] || (e = e.split("-")[0], g[e])) {
            var i = g[e];
            return t.each(m, function(t, e) {
                e in i && (n[e] = i[e])
            }), n
        }
    }
    var c = function() {
            var e = {
                get: function(t) {
                    return this.slice(t)[0]
                },
                contains: function(t) {
                    for (var e = t && t.valueOf(), n = 0, i = this.length; i > n; n++)
                        if (this[n].valueOf() === e) return n;
                    return -1
                },
                remove: function(t) {
                    this.splice(t, 1)
                },
                replace: function(e) {
                    e && (t.isArray(e) || (e = [e]), this.clear(), this.push.apply(this, e))
                },
                clear: function() {
                    this.length = 0
                },
                copy: function() {
                    var t = new c;
                    return t.replace(this), t
                }
            };
            return function() {
                var n = [];
                return n.push.apply(n, arguments), t.extend(n, e), n
            }
        }(),
        d = function(e, n) {
            t(e).data("datepicker", this), this._process_options(n), this.dates = new c, this.viewDate = this.o.defaultViewDate, this.focusDate = null, this.element = t(e), this.isInline = !1, this.isInput = this.element.is("input"), this.component = !!this.element.hasClass("date") && this.element.find(".add-on, .input-group-addon, .btn"), this.hasInput = this.component && this.element.find("input").length, this.component && 0 === this.component.length && (this.component = !1), this.picker = t(v.template), this._buildEvents(), this._attachEvents(), this.isInline ? this.picker.addClass("datepicker-inline").appendTo(this.element) : this.picker.addClass("datepicker-dropdown dropdown-menu"), this.o.rtl && this.picker.addClass("datepicker-rtl"), this.viewMode = this.o.startView, this.o.calendarWeeks && this.picker.find("thead .datepicker-title, tfoot .today, tfoot .clear").attr("colspan", function(t, e) {
                return parseInt(e) + 1
            }), this._allow_update = !1, this.setStartDate(this._o.startDate), this.setEndDate(this._o.endDate), this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled), this.setDaysOfWeekHighlighted(this.o.daysOfWeekHighlighted), this.setDatesDisabled(this.o.datesDisabled), this.fillDow(), this.fillMonths(), this._allow_update = !0, this.update(), this.showMode(), this.isInline && this.show()
        };
    d.prototype = {
        constructor: d,
        _process_options: function(e) {
            this._o = t.extend({}, this._o, e);
            var o = this.o = t.extend({}, this._o),
                a = o.language;
            switch (g[a] || (a = a.split("-")[0], g[a] || (a = f.language)), o.language = a, o.startView) {
                case 2:
                case "decade":
                    o.startView = 2;
                    break;
                case 1:
                case "year":
                    o.startView = 1;
                    break;
                default:
                    o.startView = 0
            }
            switch (o.minViewMode) {
                case 1:
                case "months":
                    o.minViewMode = 1;
                    break;
                case 2:
                case "years":
                    o.minViewMode = 2;
                    break;
                default:
                    o.minViewMode = 0
            }
            switch (o.maxViewMode) {
                case 0:
                case "days":
                    o.maxViewMode = 0;
                    break;
                case 1:
                case "months":
                    o.maxViewMode = 1;
                    break;
                default:
                    o.maxViewMode = 2
            }
            o.startView = Math.min(o.startView, o.maxViewMode), o.startView = Math.max(o.startView, o.minViewMode), o.multidate !== !0 && (o.multidate = Number(o.multidate) || !1, o.multidate !== !1 && (o.multidate = Math.max(0, o.multidate))), o.multidateSeparator = String(o.multidateSeparator), o.weekStart %= 7, o.weekEnd = (o.weekStart + 6) % 7;
            var r = v.parseFormat(o.format);
            if (o.startDate !== -(1 / 0) && (o.startDate ? o.startDate instanceof Date ? o.startDate = this._local_to_utc(this._zero_time(o.startDate)) : o.startDate = v.parseDate(o.startDate, r, o.language) : o.startDate = -(1 / 0)), o.endDate !== 1 / 0 && (o.endDate ? o.endDate instanceof Date ? o.endDate = this._local_to_utc(this._zero_time(o.endDate)) : o.endDate = v.parseDate(o.endDate, r, o.language) : o.endDate = 1 / 0), o.daysOfWeekDisabled = o.daysOfWeekDisabled || [], t.isArray(o.daysOfWeekDisabled) || (o.daysOfWeekDisabled = o.daysOfWeekDisabled.split(/[,\s]*/)), o.daysOfWeekDisabled = t.map(o.daysOfWeekDisabled, function(t) {
                    return parseInt(t, 10)
                }), o.daysOfWeekHighlighted = o.daysOfWeekHighlighted || [], t.isArray(o.daysOfWeekHighlighted) || (o.daysOfWeekHighlighted = o.daysOfWeekHighlighted.split(/[,\s]*/)), o.daysOfWeekHighlighted = t.map(o.daysOfWeekHighlighted, function(t) {
                    return parseInt(t, 10)
                }), o.datesDisabled = o.datesDisabled || [], !t.isArray(o.datesDisabled)) {
                var s = [];
                s.push(v.parseDate(o.datesDisabled, r, o.language)), o.datesDisabled = s
            }
            o.datesDisabled = t.map(o.datesDisabled, function(t) {
                return v.parseDate(t, r, o.language)
            });
            var l = String(o.orientation).toLowerCase().split(/\s+/g),
                c = o.orientation.toLowerCase();
            if (l = t.grep(l, function(t) {
                    return /^auto|left|right|top|bottom$/.test(t)
                }), o.orientation = {
                    x: "auto",
                    y: "auto"
                }, c && "auto" !== c)
                if (1 === l.length) switch (l[0]) {
                    case "top":
                    case "bottom":
                        o.orientation.y = l[0];
                        break;
                    case "left":
                    case "right":
                        o.orientation.x = l[0]
                } else c = t.grep(l, function(t) {
                    return /^left|right$/.test(t)
                }), o.orientation.x = c[0] || "auto", c = t.grep(l, function(t) {
                    return /^top|bottom$/.test(t)
                }), o.orientation.y = c[0] || "auto";
            if (o.defaultViewDate) {
                var d = o.defaultViewDate.year || (new Date).getFullYear(),
                    u = o.defaultViewDate.month || 0,
                    p = o.defaultViewDate.day || 1;
                o.defaultViewDate = n(d, u, p)
            } else o.defaultViewDate = i()
        },
        _events: [],
        _secondaryEvents: [],
        _applyEvents: function(t) {
            for (var n, i, o, a = 0; a < t.length; a++) n = t[a][0], 2 === t[a].length ? (i = e, o = t[a][1]) : 3 === t[a].length && (i = t[a][1], o = t[a][2]), n.on(o, i)
        },
        _unapplyEvents: function(t) {
            for (var n, i, o, a = 0; a < t.length; a++) n = t[a][0], 2 === t[a].length ? (o = e, i = t[a][1]) : 3 === t[a].length && (o = t[a][1], i = t[a][2]), n.off(i, o)
        },
        _buildEvents: function() {
            var e = {
                keyup: t.proxy(function(e) {
                    -1 === t.inArray(e.keyCode, [27, 37, 39, 38, 40, 32, 13, 9]) && this.update()
                }, this),
                keydown: t.proxy(this.keydown, this),
                paste: t.proxy(this.paste, this)
            };
            this.o.showOnFocus === !0 && (e.focus = t.proxy(this.show, this)), this.isInput ? this._events = [
                [this.element, e]
            ] : this.component && this.hasInput ? this._events = [
                [this.element.find("input"), e],
                [this.component, {
                    click: t.proxy(this.show, this)
                }]
            ] : this.element.is("div") ? this.isInline = !0 : this._events = [
                [this.element, {
                    click: t.proxy(this.show, this)
                }]
            ], this._events.push([this.element, "*", {
                blur: t.proxy(function(t) {
                    this._focused_from = t.target
                }, this)
            }], [this.element, {
                blur: t.proxy(function(t) {
                    this._focused_from = t.target
                }, this)
            }]), this.o.immediateUpdates && this._events.push([this.element, {
                "changeYear changeMonth": t.proxy(function(t) {
                    this.update(t.date)
                }, this)
            }]), this._secondaryEvents = [
                [this.picker, {
                    click: t.proxy(this.click, this)
                }],
                [t(window), {
                    resize: t.proxy(this.place, this)
                }],
                [t(document), {
                    mousedown: t.proxy(function(t) {
                        this.element.is(t.target) || this.element.find(t.target).length || this.picker.is(t.target) || this.picker.find(t.target).length || this.picker.hasClass("datepicker-inline") || this.hide()
                    }, this)
                }]
            ]
        },
        _attachEvents: function() {
            this._detachEvents(), this._applyEvents(this._events)
        },
        _detachEvents: function() {
            this._unapplyEvents(this._events)
        },
        _attachSecondaryEvents: function() {
            this._detachSecondaryEvents(), this._applyEvents(this._secondaryEvents)
        },
        _detachSecondaryEvents: function() {
            this._unapplyEvents(this._secondaryEvents)
        },
        _trigger: function(e, n) {
            var i = n || this.dates.get(-1),
                o = this._utc_to_local(i);
            this.element.trigger({
                type: e,
                date: o,
                dates: t.map(this.dates, this._utc_to_local),
                format: t.proxy(function(t, e) {
                    0 === arguments.length ? (t = this.dates.length - 1, e = this.o.format) : "string" == typeof t && (e = t, t = this.dates.length - 1), e = e || this.o.format;
                    var n = this.dates.get(t);
                    return v.formatDate(n, e, this.o.language)
                }, this)
            })
        },
        show: function() {
            var e = this.component ? this.element.find("input") : this.element;
            if (!e.attr("readonly") || this.o.enableOnReadonly !== !1) return this.isInline || this.picker.appendTo(this.o.container), this.place(), this.picker.show(), this._attachSecondaryEvents(), this._trigger("show"), (window.navigator.msMaxTouchPoints || "ontouchstart" in document) && this.o.disableTouchKeyboard && t(this.element).blur(), this
        },
        hide: function() {
            return this.isInline ? this : this.picker.is(":visible") ? (this.focusDate = null, this.picker.hide().detach(), this._detachSecondaryEvents(), this.viewMode = this.o.startView, this.showMode(), this.o.forceParse && (this.isInput && this.element.val() || this.hasInput && this.element.find("input").val()) && this.setValue(), this._trigger("hide"), this) : this
        },
        remove: function() {
            return this.hide(), this._detachEvents(), this._detachSecondaryEvents(), this.picker.remove(), delete this.element.data().datepicker, this.isInput || delete this.element.data().date, this
        },
        paste: function(e) {
            var n;
            if (e.originalEvent.clipboardData && e.originalEvent.clipboardData.types && -1 !== t.inArray("text/plain", e.originalEvent.clipboardData.types)) n = e.originalEvent.clipboardData.getData("text/plain");
            else {
                if (!window.clipboardData) return;
                n = window.clipboardData.getData("Text")
            }
            this.setDate(n), this.update(), e.preventDefault()
        },
        _utc_to_local: function(t) {
            return t && new Date(t.getTime() + 6e4 * t.getTimezoneOffset())
        },
        _local_to_utc: function(t) {
            return t && new Date(t.getTime() - 6e4 * t.getTimezoneOffset())
        },
        _zero_time: function(t) {
            return t && new Date(t.getFullYear(), t.getMonth(), t.getDate())
        },
        _zero_utc_time: function(t) {
            return t && new Date(Date.UTC(t.getUTCFullYear(), t.getUTCMonth(), t.getUTCDate()))
        },
        getDates: function() {
            return t.map(this.dates, this._utc_to_local)
        },
        getUTCDates: function() {
            return t.map(this.dates, function(t) {
                return new Date(t)
            })
        },
        getDate: function() {
            return this._utc_to_local(this.getUTCDate())
        },
        getUTCDate: function() {
            var t = this.dates.get(-1);
            return "undefined" != typeof t ? new Date(t) : null
        },
        clearDates: function() {
            var t;
            this.isInput ? t = this.element : this.component && (t = this.element.find("input")), t && t.val(""), this.update(), this._trigger("changeDate"), this.o.autoclose && this.hide()
        },
        setDates: function() {
            var e = t.isArray(arguments[0]) ? arguments[0] : arguments;
            return this.update.apply(this, e), this._trigger("changeDate"), this.setValue(), this
        },
        setUTCDates: function() {
            var e = t.isArray(arguments[0]) ? arguments[0] : arguments;
            return this.update.apply(this, t.map(e, this._utc_to_local)), this._trigger("changeDate"), this.setValue(), this
        },
        setDate: a("setDates"),
        setUTCDate: a("setUTCDates"),
        setValue: function() {
            var t = this.getFormattedDate();
            return this.isInput ? this.element.val(t) : this.component && this.element.find("input").val(t), this
        },
        getFormattedDate: function(n) {
            n === e && (n = this.o.format);
            var i = this.o.language;
            return t.map(this.dates, function(t) {
                return v.formatDate(t, n, i)
            }).join(this.o.multidateSeparator)
        },
        setStartDate: function(t) {
            return this._process_options({
                startDate: t
            }), this.update(), this.updateNavArrows(), this
        },
        setEndDate: function(t) {
            return this._process_options({
                endDate: t
            }), this.update(), this.updateNavArrows(), this
        },
        setDaysOfWeekDisabled: function(t) {
            return this._process_options({
                daysOfWeekDisabled: t
            }), this.update(), this.updateNavArrows(), this
        },
        setDaysOfWeekHighlighted: function(t) {
            return this._process_options({
                daysOfWeekHighlighted: t
            }), this.update(), this
        },
        setDatesDisabled: function(t) {
            this._process_options({
                datesDisabled: t
            }), this.update(), this.updateNavArrows()
        },
        place: function() {
            if (this.isInline) return this;
            var e = this.picker.outerWidth(),
                n = this.picker.outerHeight(),
                i = 10,
                o = t(this.o.container),
                a = o.width(),
                r = "body" === this.o.container ? t(document).scrollTop() : o.scrollTop(),
                s = o.offset(),
                l = [];
            this.element.parents().each(function() {
                var e = t(this).css("z-index");
                "auto" !== e && 0 !== e && l.push(parseInt(e))
            });
            var c = Math.max.apply(Math, l) + this.o.zIndexOffset,
                d = this.component ? this.component.parent().offset() : this.element.offset(),
                u = this.component ? this.component.outerHeight(!0) : this.element.outerHeight(!1),
                p = this.component ? this.component.outerWidth(!0) : this.element.outerWidth(!1),
                h = d.left - s.left,
                f = d.top - s.top;
            "body" !== this.o.container && (f += r), this.picker.removeClass("datepicker-orient-top datepicker-orient-bottom datepicker-orient-right datepicker-orient-left"), "auto" !== this.o.orientation.x ? (this.picker.addClass("datepicker-orient-" + this.o.orientation.x), "right" === this.o.orientation.x && (h -= e - p)) : d.left < 0 ? (this.picker.addClass("datepicker-orient-left"), h -= d.left - i) : h + e > a ? (this.picker.addClass("datepicker-orient-right"), h += p - e) : this.picker.addClass("datepicker-orient-left");
            var m, g = this.o.orientation.y;
            if ("auto" === g && (m = -r + f - n, g = 0 > m ? "bottom" : "top"), this.picker.addClass("datepicker-orient-" + g), "top" === g ? f -= n + parseInt(this.picker.css("padding-top")) : f += u, this.o.rtl) {
                var v = a - (h + p);
                this.picker.css({
                    top: f,
                    right: v,
                    zIndex: c
                })
            } else this.picker.css({
                top: f,
                left: h,
                zIndex: c
            });
            return this
        },
        _allow_update: !0,
        update: function() {
            if (!this._allow_update) return this;
            var e = this.dates.copy(),
                n = [],
                i = !1;
            return arguments.length ? (t.each(arguments, t.proxy(function(t, e) {
                e instanceof Date && (e = this._local_to_utc(e)), n.push(e)
            }, this)), i = !0) : (n = this.isInput ? this.element.val() : this.element.data("date") || this.element.find("input").val(), n = n && this.o.multidate ? n.split(this.o.multidateSeparator) : [n], delete this.element.data().date), n = t.map(n, t.proxy(function(t) {
                return v.parseDate(t, this.o.format, this.o.language)
            }, this)), n = t.grep(n, t.proxy(function(t) {
                return !this.dateWithinRange(t) || !t
            }, this), !0), this.dates.replace(n), this.dates.length ? this.viewDate = new Date(this.dates.get(-1)) : this.viewDate < this.o.startDate ? this.viewDate = new Date(this.o.startDate) : this.viewDate > this.o.endDate ? this.viewDate = new Date(this.o.endDate) : this.viewDate = this.o.defaultViewDate, i ? this.setValue() : n.length && String(e) !== String(this.dates) && this._trigger("changeDate"), !this.dates.length && e.length && this._trigger("clearDate"), this.fill(), this.element.change(), this
        },
        fillDow: function() {
            var t = this.o.weekStart,
                e = "<tr>";
            for (this.o.calendarWeeks && (this.picker.find(".datepicker-days .datepicker-switch").attr("colspan", function(t, e) {
                    return parseInt(e) + 1
                }), e += '<th class="cw">&#160;</th>'); t < this.o.weekStart + 7;) e += '<th class="dow">' + g[this.o.language].daysMin[t++ % 7] + "</th>";
            e += "</tr>", this.picker.find(".datepicker-days thead").append(e)
        },
        fillMonths: function() {
            for (var t = "", e = 0; 12 > e;) t += '<span class="month">' + g[this.o.language].monthsShort[e++] + "</span>";
            this.picker.find(".datepicker-months td").html(t)
        },
        setRange: function(e) {
            e && e.length ? this.range = t.map(e, function(t) {
                return t.valueOf()
            }) : delete this.range, this.fill()
        },
        getClassNames: function(e) {
            var n = [],
                i = this.viewDate.getUTCFullYear(),
                o = this.viewDate.getUTCMonth(),
                a = new Date;
            return e.getUTCFullYear() < i || e.getUTCFullYear() === i && e.getUTCMonth() < o ? n.push("old") : (e.getUTCFullYear() > i || e.getUTCFullYear() === i && e.getUTCMonth() > o) && n.push("new"), this.focusDate && e.valueOf() === this.focusDate.valueOf() && n.push("focused"), this.o.todayHighlight && e.getUTCFullYear() === a.getFullYear() && e.getUTCMonth() === a.getMonth() && e.getUTCDate() === a.getDate() && n.push("today"), -1 !== this.dates.contains(e) && n.push("active"), (!this.dateWithinRange(e) || this.dateIsDisabled(e)) && n.push("disabled"), -1 !== t.inArray(e.getUTCDay(), this.o.daysOfWeekHighlighted) && n.push("highlighted"), this.range && (e > this.range[0] && e < this.range[this.range.length - 1] && n.push("range"), -1 !== t.inArray(e.valueOf(), this.range) && n.push("selected"), e.valueOf() === this.range[0] && n.push("range-start"), e.valueOf() === this.range[this.range.length - 1] && n.push("range-end")), n
        },
        fill: function() {
            var i, o = new Date(this.viewDate),
                a = o.getUTCFullYear(),
                r = o.getUTCMonth(),
                s = this.o.startDate !== -(1 / 0) ? this.o.startDate.getUTCFullYear() : -(1 / 0),
                l = this.o.startDate !== -(1 / 0) ? this.o.startDate.getUTCMonth() : -(1 / 0),
                c = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCFullYear() : 1 / 0,
                d = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCMonth() : 1 / 0,
                u = g[this.o.language].today || g.en.today || "",
                p = g[this.o.language].clear || g.en.clear || "",
                h = g[this.o.language].titleFormat || g.en.titleFormat;
            if (!isNaN(a) && !isNaN(r)) {
                this.picker.find(".datepicker-days thead .datepicker-switch").text(v.formatDate(new n(a, r), h, this.o.language)), this.picker.find("tfoot .today").text(u).toggle(this.o.todayBtn !== !1), this.picker.find("tfoot .clear").text(p).toggle(this.o.clearBtn !== !1), this.picker.find("thead .datepicker-title").text(this.o.title).toggle("" !== this.o.title), this.updateNavArrows(), this.fillMonths();
                var f = n(a, r - 1, 28),
                    m = v.getDaysInMonth(f.getUTCFullYear(), f.getUTCMonth());
                f.setUTCDate(m), f.setUTCDate(m - (f.getUTCDay() - this.o.weekStart + 7) % 7);
                var y = new Date(f);
                f.getUTCFullYear() < 100 && y.setUTCFullYear(f.getUTCFullYear()), y.setUTCDate(y.getUTCDate() + 42), y = y.valueOf();
                for (var w, b = []; f.valueOf() < y;) {
                    if (f.getUTCDay() === this.o.weekStart && (b.push("<tr>"), this.o.calendarWeeks)) {
                        var x = new Date(+f + (this.o.weekStart - f.getUTCDay() - 7) % 7 * 864e5),
                            C = new Date(Number(x) + (11 - x.getUTCDay()) % 7 * 864e5),
                            T = new Date(Number(T = n(C.getUTCFullYear(), 0, 1)) + (11 - T.getUTCDay()) % 7 * 864e5),
                            S = (C - T) / 864e5 / 7 + 1;
                        b.push('<td class="cw">' + S + "</td>")
                    }
                    if (w = this.getClassNames(f), w.push("day"), this.o.beforeShowDay !== t.noop) {
                        var _ = this.o.beforeShowDay(this._utc_to_local(f));
                        _ === e ? _ = {} : "boolean" == typeof _ ? _ = {
                            enabled: _
                        } : "string" == typeof _ && (_ = {
                            classes: _
                        }), _.enabled === !1 && w.push("disabled"), _.classes && (w = w.concat(_.classes.split(/\s+/))), _.tooltip && (i = _.tooltip)
                    }
                    w = t.unique(w), b.push('<td class="' + w.join(" ") + '"' + (i ? ' title="' + i + '"' : "") + ">" + f.getUTCDate() + "</td>"), i = null, f.getUTCDay() === this.o.weekEnd && b.push("</tr>"), f.setUTCDate(f.getUTCDate() + 1)
                }
                this.picker.find(".datepicker-days tbody").empty().append(b.join(""));
                var k = g[this.o.language].monthsTitle || g.en.monthsTitle || "Months",
                    E = this.picker.find(".datepicker-months").find(".datepicker-switch").text(this.o.maxViewMode < 2 ? k : a).end().find("span").removeClass("active");
                if (t.each(this.dates, function(t, e) {
                        e.getUTCFullYear() === a && E.eq(e.getUTCMonth()).addClass("active")
                    }), (s > a || a > c) && E.addClass("disabled"), a === s && E.slice(0, l).addClass("disabled"), a === c && E.slice(d + 1).addClass("disabled"), this.o.beforeShowMonth !== t.noop) {
                    var D = this;
                    t.each(E, function(e, n) {
                        if (!t(n).hasClass("disabled")) {
                            var i = new Date(a, e, 1),
                                o = D.o.beforeShowMonth(i);
                            o === !1 && t(n).addClass("disabled")
                        }
                    })
                }
                b = "", a = 10 * parseInt(a / 10, 10);
                var M = this.picker.find(".datepicker-years").find(".datepicker-switch").text(a + "-" + (a + 9)).end().find("td");
                a -= 1;
                for (var O, I = t.map(this.dates, function(t) {
                        return t.getUTCFullYear()
                    }), A = -1; 11 > A; A++) {
                    if (O = ["year"], i = null, -1 === A ? O.push("old") : 10 === A && O.push("new"), -1 !== t.inArray(a, I) && O.push("active"), (s > a || a > c) && O.push("disabled"), this.o.beforeShowYear !== t.noop) {
                        var N = this.o.beforeShowYear(new Date(a, 0, 1));
                        N === e ? N = {} : "boolean" == typeof N ? N = {
                            enabled: N
                        } : "string" == typeof N && (N = {
                            classes: N
                        }), N.enabled === !1 && O.push("disabled"), N.classes && (O = O.concat(N.classes.split(/\s+/))), N.tooltip && (i = N.tooltip)
                    }
                    b += '<span class="' + O.join(" ") + '"' + (i ? ' title="' + i + '"' : "") + ">" + a + "</span>", a += 1
                }
                M.html(b)
            }
        },
        updateNavArrows: function() {
            if (this._allow_update) {
                var t = new Date(this.viewDate),
                    e = t.getUTCFullYear(),
                    n = t.getUTCMonth();
                switch (this.viewMode) {
                    case 0:
                        this.o.startDate !== -(1 / 0) && e <= this.o.startDate.getUTCFullYear() && n <= this.o.startDate.getUTCMonth() ? this.picker.find(".prev").css({
                            visibility: "hidden"
                        }) : this.picker.find(".prev").css({
                            visibility: "visible"
                        }), this.o.endDate !== 1 / 0 && e >= this.o.endDate.getUTCFullYear() && n >= this.o.endDate.getUTCMonth() ? this.picker.find(".next").css({
                            visibility: "hidden"
                        }) : this.picker.find(".next").css({
                            visibility: "visible"
                        });
                        break;
                    case 1:
                    case 2:
                        this.o.startDate !== -(1 / 0) && e <= this.o.startDate.getUTCFullYear() || this.o.maxViewMode < 2 ? this.picker.find(".prev").css({
                            visibility: "hidden"
                        }) : this.picker.find(".prev").css({
                            visibility: "visible"
                        }), this.o.endDate !== 1 / 0 && e >= this.o.endDate.getUTCFullYear() || this.o.maxViewMode < 2 ? this.picker.find(".next").css({
                            visibility: "hidden"
                        }) : this.picker.find(".next").css({
                            visibility: "visible"
                        })
                }
            }
        },
        click: function(e) {
            e.preventDefault(), e.stopPropagation();
            var o, a, r, s = t(e.target).closest("span, td, th");
            if (1 === s.length) switch (s[0].nodeName.toLowerCase()) {
                case "th":
                    switch (s[0].className) {
                        case "datepicker-switch":
                            this.showMode(1);
                            break;
                        case "prev":
                        case "next":
                            var l = v.modes[this.viewMode].navStep * ("prev" === s[0].className ? -1 : 1);
                            switch (this.viewMode) {
                                case 0:
                                    this.viewDate = this.moveMonth(this.viewDate, l), this._trigger("changeMonth", this.viewDate);
                                    break;
                                case 1:
                                case 2:
                                    this.viewDate = this.moveYear(this.viewDate, l), 1 === this.viewMode && this._trigger("changeYear", this.viewDate)
                            }
                            this.fill();
                            break;
                        case "today":
                            this.showMode(-2);
                            var c = "linked" === this.o.todayBtn ? null : "view";
                            this._setDate(i(), c);
                            break;
                        case "clear":
                            this.clearDates()
                    }
                    break;
                case "span":
                    s.hasClass("disabled") || (this.viewDate.setUTCDate(1), s.hasClass("month") ? (r = 1, a = s.parent().find("span").index(s), o = this.viewDate.getUTCFullYear(), this.viewDate.setUTCMonth(a), this._trigger("changeMonth", this.viewDate), 1 === this.o.minViewMode ? (this._setDate(n(o, a, r)), this.showMode()) : this.showMode(-1)) : (r = 1, a = 0, o = parseInt(s.text(), 10) || 0, this.viewDate.setUTCFullYear(o), this._trigger("changeYear", this.viewDate), 2 === this.o.minViewMode && this._setDate(n(o, a, r)), this.showMode(-1)), this.fill());
                    break;
                case "td":
                    s.hasClass("day") && !s.hasClass("disabled") && (r = parseInt(s.text(), 10) || 1, o = this.viewDate.getUTCFullYear(), a = this.viewDate.getUTCMonth(), s.hasClass("old") ? 0 === a ? (a = 11, o -= 1) : a -= 1 : s.hasClass("new") && (11 === a ? (a = 0, o += 1) : a += 1), this._setDate(n(o, a, r)))
            }
            this.picker.is(":visible") && this._focused_from && t(this._focused_from).focus(), delete this._focused_from
        },
        _toggle_multidate: function(t) {
            var e = this.dates.contains(t);
            if (t || this.dates.clear(), -1 !== e ? (this.o.multidate === !0 || this.o.multidate > 1 || this.o.toggleActive) && this.dates.remove(e) : this.o.multidate === !1 ? (this.dates.clear(), this.dates.push(t)) : this.dates.push(t), "number" == typeof this.o.multidate)
                for (; this.dates.length > this.o.multidate;) this.dates.remove(0)
        },
        _setDate: function(t, e) {
            e && "date" !== e || this._toggle_multidate(t && new Date(t)), e && "view" !== e || (this.viewDate = t && new Date(t)), this.fill(), this.setValue(), e && "view" === e || this._trigger("changeDate");
            var n;
            this.isInput ? n = this.element : this.component && (n = this.element.find("input")), n && n.change(), !this.o.autoclose || e && "date" !== e || this.hide()
        },
        moveDay: function(t, e) {
            var n = new Date(t);
            return n.setUTCDate(t.getUTCDate() + e), n
        },
        moveWeek: function(t, e) {
            return this.moveDay(t, 7 * e)
        },
        moveMonth: function(t, e) {
            if (!r(t)) return this.o.defaultViewDate;
            if (!e) return t;
            var n, i, o = new Date(t.valueOf()),
                a = o.getUTCDate(),
                s = o.getUTCMonth(),
                l = Math.abs(e);
            if (e = e > 0 ? 1 : -1, 1 === l) i = -1 === e ? function() {
                return o.getUTCMonth() === s
            } : function() {
                return o.getUTCMonth() !== n
            }, n = s + e, o.setUTCMonth(n), (0 > n || n > 11) && (n = (n + 12) % 12);
            else {
                for (var c = 0; l > c; c++) o = this.moveMonth(o, e);
                n = o.getUTCMonth(), o.setUTCDate(a), i = function() {
                    return n !== o.getUTCMonth()
                }
            }
            for (; i();) o.setUTCDate(--a), o.setUTCMonth(n);
            return o
        },
        moveYear: function(t, e) {
            return this.moveMonth(t, 12 * e)
        },
        moveAvailableDate: function(t, e, n) {
            do {
                if (t = this[n](t, e), !this.dateWithinRange(t)) return !1;
                n = "moveDay"
            } while (this.dateIsDisabled(t));
            return t
        },
        weekOfDateIsDisabled: function(e) {
            return -1 !== t.inArray(e.getUTCDay(), this.o.daysOfWeekDisabled)
        },
        dateIsDisabled: function(e) {
            return this.weekOfDateIsDisabled(e) || t.grep(this.o.datesDisabled, function(t) {
                return o(e, t)
            }).length > 0
        },
        dateWithinRange: function(t) {
            return t >= this.o.startDate && t <= this.o.endDate
        },
        keydown: function(t) {
            if (!this.picker.is(":visible")) return void((40 === t.keyCode || 27 === t.keyCode) && (this.show(), t.stopPropagation()));
            var e, n, i = !1,
                o = this.focusDate || this.viewDate;
            switch (t.keyCode) {
                case 27:
                    this.focusDate ? (this.focusDate = null, this.viewDate = this.dates.get(-1) || this.viewDate, this.fill()) : this.hide(), t.preventDefault(), t.stopPropagation();
                    break;
                case 37:
                case 38:
                case 39:
                case 40:
                    if (!this.o.keyboardNavigation || 7 === this.o.daysOfWeekDisabled.length) break;
                    e = 37 === t.keyCode || 38 === t.keyCode ? -1 : 1, t.ctrlKey ? (n = this.moveAvailableDate(o, e, "moveYear"), n && this._trigger("changeYear", this.viewDate)) : t.shiftKey ? (n = this.moveAvailableDate(o, e, "moveMonth"), n && this._trigger("changeMonth", this.viewDate)) : 37 === t.keyCode || 39 === t.keyCode ? n = this.moveAvailableDate(o, e, "moveDay") : this.weekOfDateIsDisabled(o) || (n = this.moveAvailableDate(o, e, "moveWeek")), n && (this.focusDate = this.viewDate = n, this.setValue(), this.fill(), t.preventDefault());
                    break;
                case 13:
                    if (!this.o.forceParse) break;
                    o = this.focusDate || this.dates.get(-1) || this.viewDate, this.o.keyboardNavigation && (this._toggle_multidate(o), i = !0), this.focusDate = null, this.viewDate = this.dates.get(-1) || this.viewDate, this.setValue(), this.fill(), this.picker.is(":visible") && (t.preventDefault(), t.stopPropagation(), this.o.autoclose && this.hide());
                    break;
                case 9:
                    this.focusDate = null, this.viewDate = this.dates.get(-1) || this.viewDate, this.fill(), this.hide()
            }
            if (i) {
                this.dates.length ? this._trigger("changeDate") : this._trigger("clearDate");
                var a;
                this.isInput ? a = this.element : this.component && (a = this.element.find("input")), a && a.change()
            }
        },
        showMode: function(t) {
            t && (this.viewMode = Math.max(this.o.minViewMode, Math.min(this.o.maxViewMode, this.viewMode + t))), this.picker.children("div").hide().filter(".datepicker-" + v.modes[this.viewMode].clsName).show(), this.updateNavArrows()
        }
    };
    var u = function(e, n) {
        t(e).data("datepicker", this), this.element = t(e), this.inputs = t.map(n.inputs, function(t) {
            return t.jquery ? t[0] : t
        }), delete n.inputs, h.call(t(this.inputs), n).on("changeDate", t.proxy(this.dateUpdated, this)), this.pickers = t.map(this.inputs, function(e) {
            return t(e).data("datepicker")
        }), this.updateDates()
    };
    u.prototype = {
        updateDates: function() {
            this.dates = t.map(this.pickers, function(t) {
                return t.getUTCDate()
            }), this.updateRanges()
        },
        updateRanges: function() {
            var e = t.map(this.dates, function(t) {
                return t.valueOf()
            });
            t.each(this.pickers, function(t, n) {
                n.setRange(e)
            })
        },
        dateUpdated: function(e) {
            if (!this.updating) {
                this.updating = !0;
                var n = t(e.target).data("datepicker");
                if ("undefined" != typeof n) {
                    var i = n.getUTCDate(),
                        o = t.inArray(e.target, this.inputs),
                        a = o - 1,
                        r = o + 1,
                        s = this.inputs.length;
                    if (-1 !== o) {
                        if (t.each(this.pickers, function(t, e) {
                                e.getUTCDate() || e.setUTCDate(i)
                            }), i < this.dates[a])
                            for (; a >= 0 && i < this.dates[a];) this.pickers[a--].setUTCDate(i);
                        else if (i > this.dates[r])
                            for (; s > r && i > this.dates[r];) this.pickers[r++].setUTCDate(i);
                        this.updateDates(), delete this.updating
                    }
                }
            }
        },
        remove: function() {
            t.map(this.pickers, function(t) {
                t.remove()
            }), delete this.element.data().datepicker
        }
    };
    var p = t.fn.datepicker,
        h = function(n) {
            var i = Array.apply(null, arguments);
            i.shift();
            var o;
            if (this.each(function() {
                    var e = t(this),
                        a = e.data("datepicker"),
                        r = "object" == typeof n && n;
                    if (!a) {
                        var c = s(this, "date"),
                            p = t.extend({}, f, c, r),
                            h = l(p.language),
                            m = t.extend({}, f, h, c, r);
                        e.hasClass("input-daterange") || m.inputs ? (t.extend(m, {
                            inputs: m.inputs || e.find("input").toArray()
                        }), a = new u(this, m)) : a = new d(this, m), e.data("datepicker", a)
                    }
                    "string" == typeof n && "function" == typeof a[n] && (o = a[n].apply(a, i))
                }), o === e || o instanceof d || o instanceof u) return this;
            if (this.length > 1) throw new Error("Using only allowed for the collection of a single element (" + n + " function)");
            return o
        };
    t.fn.datepicker = h;
    var f = t.fn.datepicker.defaults = {
            autoclose: !1,
            beforeShowDay: t.noop,
            beforeShowMonth: t.noop,
            beforeShowYear: t.noop,
            calendarWeeks: !1,
            clearBtn: !1,
            toggleActive: !1,
            daysOfWeekDisabled: [],
            daysOfWeekHighlighted: [],
            datesDisabled: [],
            endDate: 1 / 0,
            forceParse: !0,
            format: "mm/dd/yyyy",
            keyboardNavigation: !0,
            language: "en",
            minViewMode: 0,
            maxViewMode: 2,
            multidate: !1,
            multidateSeparator: ",",
            orientation: "auto",
            rtl: !1,
            startDate: -(1 / 0),
            startView: 0,
            todayBtn: !1,
            todayHighlight: !1,
            weekStart: 0,
            disableTouchKeyboard: !1,
            enableOnReadonly: !0,
            showOnFocus: !0,
            zIndexOffset: 20,
            container: "body",
            immediateUpdates: !1,
            title: ""
        },
        m = t.fn.datepicker.locale_opts = ["format", "rtl", "weekStart"];
    t.fn.datepicker.Constructor = d;
    var g = t.fn.datepicker.dates = {
            en: {
                days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                today: "Today",
                clear: "Clear",
                titleFormat: "MM yyyy"
            }
        },
        v = {
            modes: [{
                clsName: "days",
                navFnc: "Month",
                navStep: 1
            }, {
                clsName: "months",
                navFnc: "FullYear",
                navStep: 1
            }, {
                clsName: "years",
                navFnc: "FullYear",
                navStep: 10
            }],
            isLeapYear: function(t) {
                return t % 4 === 0 && t % 100 !== 0 || t % 400 === 0
            },
            getDaysInMonth: function(t, e) {
                return [31, v.isLeapYear(t) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][e]
            },
            validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
            nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
            parseFormat: function(t) {
                if ("function" == typeof t.toValue && "function" == typeof t.toDisplay) return t;
                var e = t.replace(this.validParts, "\0").split("\0"),
                    n = t.match(this.validParts);
                if (!e || !e.length || !n || 0 === n.length) throw new Error("Invalid date format.");
                return {
                    separators: e,
                    parts: n
                }
            },
            parseDate: function(o, a, r) {
                function s() {
                    var t = this.slice(0, f[u].length),
                        e = f[u].slice(0, t.length);
                    return t.toLowerCase() === e.toLowerCase()
                }
                if (!o) return e;
                if (o instanceof Date) return o;
                if ("string" == typeof a && (a = v.parseFormat(a)), a.toValue) return a.toValue(o, a, r);
                var l, c, u, p, h = /([\-+]\d+)([dmwy])/,
                    f = o.match(/([\-+]\d+)([dmwy])/g),
                    m = {
                        d: "moveDay",
                        m: "moveMonth",
                        w: "moveWeek",
                        y: "moveYear"
                    };
                if (/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(o)) {
                    for (o = new Date, u = 0; u < f.length; u++) l = h.exec(f[u]), c = parseInt(l[1]), p = m[l[2]], o = d.prototype[p](o, c);
                    return n(o.getUTCFullYear(), o.getUTCMonth(), o.getUTCDate())
                }
                f = o && o.match(this.nonpunctuation) || [], o = new Date;
                var y, w, b = {},
                    x = ["yyyy", "yy", "M", "MM", "m", "mm", "d", "dd"],
                    C = {
                        yyyy: function(t, e) {
                            return t.setUTCFullYear(e)
                        },
                        yy: function(t, e) {
                            return t.setUTCFullYear(2e3 + e)
                        },
                        m: function(t, e) {
                            if (isNaN(t)) return t;
                            for (e -= 1; 0 > e;) e += 12;
                            for (e %= 12, t.setUTCMonth(e); t.getUTCMonth() !== e;) t.setUTCDate(t.getUTCDate() - 1);
                            return t
                        },
                        d: function(t, e) {
                            return t.setUTCDate(e)
                        }
                    };
                C.M = C.MM = C.mm = C.m, C.dd = C.d, o = i();
                var T = a.parts.slice();
                if (f.length !== T.length && (T = t(T).filter(function(e, n) {
                        return -1 !== t.inArray(n, x)
                    }).toArray()), f.length === T.length) {
                    var S;
                    for (u = 0, S = T.length; S > u; u++) {
                        if (y = parseInt(f[u], 10), l = T[u], isNaN(y)) switch (l) {
                            case "MM":
                                w = t(g[r].months).filter(s), y = t.inArray(w[0], g[r].months) + 1;
                                break;
                            case "M":
                                w = t(g[r].monthsShort).filter(s), y = t.inArray(w[0], g[r].monthsShort) + 1
                        }
                        b[l] = y
                    }
                    var _, k;
                    for (u = 0; u < x.length; u++) k = x[u], k in b && !isNaN(b[k]) && (_ = new Date(o), C[k](_, b[k]), isNaN(_) || (o = _))
                }
                return o
            },
            formatDate: function(e, n, i) {
                if (!e) return "";
                if ("string" == typeof n && (n = v.parseFormat(n)), n.toDisplay) return n.toDisplay(e, n, i);
                var o = {
                    d: e.getUTCDate(),
                    D: g[i].daysShort[e.getUTCDay()],
                    DD: g[i].days[e.getUTCDay()],
                    m: e.getUTCMonth() + 1,
                    M: g[i].monthsShort[e.getUTCMonth()],
                    MM: g[i].months[e.getUTCMonth()],
                    yy: e.getUTCFullYear().toString().substring(2),
                    yyyy: e.getUTCFullYear()
                };
                o.dd = (o.d < 10 ? "0" : "") + o.d, o.mm = (o.m < 10 ? "0" : "") + o.m, e = [];
                for (var a = t.extend([], n.separators), r = 0, s = n.parts.length; s >= r; r++) a.length && e.push(a.shift()), e.push(o[n.parts[r]]);
                return e.join("")
            },
            headTemplate: '<thead><tr><th colspan="7" class="datepicker-title"></th></tr><tr><th class="prev">&#171;</th><th colspan="5" class="datepicker-switch"></th><th class="next">&#187;</th></tr></thead>',
            contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
            footTemplate: '<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'
        };
    v.template = '<div class="datepicker"><div class="datepicker-days"><table class=" table-condensed">' + v.headTemplate + "<tbody></tbody>" + v.footTemplate + '</table></div><div class="datepicker-months"><table class="table-condensed">' + v.headTemplate + v.contTemplate + v.footTemplate + '</table></div><div class="datepicker-years"><table class="table-condensed">' + v.headTemplate + v.contTemplate + v.footTemplate + "</table></div></div>", t.fn.datepicker.DPGlobal = v, t.fn.datepicker.noConflict = function() {
        return t.fn.datepicker = p, this
    }, t.fn.datepicker.version = "1.5.1", t(document).on("focus.datepicker.data-api click.datepicker.data-api", '[data-provide="datepicker"]', function(e) {
        var n = t(this);
        n.data("datepicker") || (e.preventDefault(), h.call(n, "show"))
    }), t(function() {
        h.call(t('[data-provide="datepicker-inline"]'))
    })
}), ! function(t) {
    t.fn.datepicker.dates.vi = {
        days: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
        daysShort: ["CN", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
        daysMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        months: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
        monthsShort: ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"],
        today: "Hôm nay",
        clear: "Xóa",
        format: "dd/mm/yyyy"
    }
}(jQuery), fotoramaVersion = "4.6.4",
    function(t, e, n, i, o) {
        "use strict";

        function a(t) {
            var e = "bez_" + i.makeArray(arguments).join("_").replace(".", "p");
            if ("function" != typeof i.easing[e]) {
                var n = function(t, e) {
                    var n = [null, null],
                        i = [null, null],
                        o = [null, null],
                        a = function(a, r) {
                            return o[r] = 3 * t[r], i[r] = 3 * (e[r] - t[r]) - o[r], n[r] = 1 - o[r] - i[r], a * (o[r] + a * (i[r] + a * n[r]))
                        },
                        r = function(t) {
                            return o[0] + t * (2 * i[0] + 3 * n[0] * t)
                        },
                        s = function(t) {
                            for (var e, n = t, i = 0; ++i < 14 && (e = a(n, 0) - t, !(Math.abs(e) < .001));) n -= e / r(n);
                            return n
                        };
                    return function(t) {
                        return a(s(t), 1)
                    }
                };
                i.easing[e] = function(e, i, o, a, r) {
                    return a * n([t[0], t[1]], [t[2], t[3]])(i / r) + o
                }
            }
            return e
        }

        function r() {}

        function s(t, e, n) {
            return Math.max(isNaN(e) ? -(1 / 0) : e, Math.min(isNaN(n) ? 1 / 0 : n, t))
        }

        function l(t) {
            return t.match(/ma/) && t.match(/-?\d+(?!d)/g)[t.match(/3d/) ? 12 : 4]
        }

        function c(t) {
            return Pe ? +l(t.css("transform")) : +t.css("left").replace("px", "")
        }

        function d(t) {
            var e = {};
            return Pe ? e.transform = "translate3d(" + t + "px,0,0)" : e.left = t, e
        }

        function u(t) {
            return {
                "transition-duration": t + "ms"
            }
        }

        function p(t, e) {
            return isNaN(t) ? e : t
        }

        function h(t, e) {
            return p(+String(t).replace(e || "px", ""))
        }

        function f(t) {
            return /%$/.test(t) ? h(t, "%") : o
        }

        function m(t, e) {
            return p(f(t) / 100 * e, h(t))
        }

        function g(t) {
            return (!isNaN(h(t)) || !isNaN(h(t, "%"))) && t
        }

        function v(t, e, n, i) {
            return (t - (i || 0)) * (e + (n || 0))
        }

        function y(t, e, n, i) {
            return -Math.round(t / (e + (n || 0)) - (i || 0))
        }

        function w(t) {
            var e = t.data();
            if (!e.tEnd) {
                var n = t[0],
                    i = {
                        WebkitTransition: "webkitTransitionEnd",
                        MozTransition: "transitionend",
                        OTransition: "oTransitionEnd otransitionend",
                        msTransition: "MSTransitionEnd",
                        transition: "transitionend"
                    };
                q(n, i[be.prefixed("transition")], function(t) {
                    e.tProp && t.propertyName.match(e.tProp) && e.onEndFn()
                }), e.tEnd = !0
            }
        }

        function b(t, e, n, i) {
            var o, a = t.data();
            a && (a.onEndFn = function() {
                o || (o = !0, clearTimeout(a.tT), n())
            }, a.tProp = e, clearTimeout(a.tT), a.tT = setTimeout(function() {
                a.onEndFn()
            }, 1.5 * i), w(t))
        }

        function x(t, e) {
            if (t.length) {
                var n = t.data();
                Pe ? (t.css(u(0)), n.onEndFn = r, clearTimeout(n.tT)) : t.stop();
                var i = C(e, function() {
                    return c(t)
                });
                return t.css(d(i)), i
            }
        }

        function C() {
            for (var t, e = 0, n = arguments.length; e < n && (t = e ? arguments[e]() : arguments[e], "number" != typeof t); e++);
            return t
        }

        function T(t, e) {
            return Math.round(t + (e - t) / 1.5)
        }

        function S() {
            return S.p = S.p || ("https:" === n.protocol ? "https://" : "http://"), S.p
        }

        function _(t) {
            var n = e.createElement("a");
            return n.href = t, n
        }

        function k(t, e) {
            if ("string" != typeof t) return t;
            t = _(t);
            var n, i;
            if (t.host.match(/youtube\.com/) && t.search) {
                if (n = t.search.split("v=")[1]) {
                    var o = n.indexOf("&");
                    o !== -1 && (n = n.substring(0, o)), i = "youtube"
                }
            } else t.host.match(/youtube\.com|youtu\.be/) ? (n = t.pathname.replace(/^\/(embed\/|v\/)?/, "").replace(/\/.*/, ""), i = "youtube") : t.host.match(/vimeo\.com/) && (i = "vimeo", n = t.pathname.replace(/^\/(video\/)?/, "").replace(/\/.*/, ""));
            return n && i || !e || (n = t.href, i = "custom"), !!n && {
                id: n,
                type: i,
                s: t.search.replace(/^\?/, ""),
                p: S()
            }
        }

        function E(t, e, n) {
            var o, a, r = t.video;
            return "youtube" === r.type ? (a = S() + "img.youtube.com/vi/" + r.id + "/default.jpg", o = a.replace(/\/default.jpg$/, "/hqdefault.jpg"), t.thumbsReady = !0) : "vimeo" === r.type ? i.ajax({
                url: S() + "vimeo.com/api/v2/video/" + r.id + ".json",
                dataType: "jsonp",
                success: function(i) {
                    t.thumbsReady = !0, D(e, {
                        img: i[0].thumbnail_large,
                        thumb: i[0].thumbnail_small
                    }, t.i, n)
                }
            }) : t.thumbsReady = !0, {
                img: o,
                thumb: a
            }
        }

        function D(t, e, n, o) {
            for (var a = 0, r = t.length; a < r; a++) {
                var s = t[a];
                if (s.i === n && s.thumbsReady) {
                    var l = {
                        videoReady: !0
                    };
                    l[Ge] = l[Qe] = l[Ke] = !1, o.splice(a, 1, i.extend({}, s, l, e));
                    break
                }
            }
        }

        function M(t) {
            function e(t, e, o) {
                var a = t.children("img").eq(0),
                    r = t.attr("href"),
                    s = t.attr("src"),
                    l = a.attr("src"),
                    c = e.video,
                    d = !!o && k(r, c === !0);
                d ? r = !1 : d = c, n(t, a, i.extend(e, {
                    video: d,
                    img: e.img || r || s || l,
                    thumb: e.thumb || l || s || r
                }))
            }

            function n(t, e, n) {
                var o = n.thumb && n.img !== n.thumb,
                    a = h(n.width || t.attr("width")),
                    r = h(n.height || t.attr("height"));
                i.extend(n, {
                    width: a,
                    height: r,
                    thumbratio: U(n.thumbratio || h(n.thumbwidth || e && e.attr("width") || o || a) / h(n.thumbheight || e && e.attr("height") || o || r))
                })
            }
            var o = [];
            return t.children().each(function() {
                var t = i(this),
                    a = W(i.extend(t.data(), {
                        id: t.attr("id")
                    }));
                if (t.is("a, img")) e(t, a, !0);
                else {
                    if (t.is(":empty")) return;
                    n(t, null, i.extend(a, {
                        html: this,
                        _html: t.html()
                    }))
                }
                o.push(a)
            }), o
        }

        function O(t) {
            return 0 === t.offsetWidth && 0 === t.offsetHeight
        }

        function I(t) {
            return !i.contains(e.documentElement, t)
        }

        function A(t, e, n, i) {
            return A.i || (A.i = 1, A.ii = [!0]), i = i || A.i, "undefined" == typeof A.ii[i] && (A.ii[i] = !0), t() ? e() : A.ii[i] && setTimeout(function() {
                A.ii[i] && A(t, e, n, i)
            }, n || 100), A.i++
        }

        function N(t) {
            n.replace(n.protocol + "//" + n.host + n.pathname.replace(/^\/?/, "/") + n.search + "#" + t)
        }

        function P(t, e, n, i) {
            var o = t.data(),
                a = o.measures;
            if (a && (!o.l || o.l.W !== a.width || o.l.H !== a.height || o.l.r !== a.ratio || o.l.w !== e.w || o.l.h !== e.h || o.l.m !== n || o.l.p !== i)) {
                var r = a.width,
                    l = a.height,
                    c = e.w / e.h,
                    d = a.ratio >= c,
                    u = "scaledown" === n,
                    p = "contain" === n,
                    h = "cover" === n,
                    f = Z(i);
                d && (u || p) || !d && h ? (r = s(e.w, 0, u ? r : 1 / 0), l = r / a.ratio) : (d && h || !d && (u || p)) && (l = s(e.h, 0, u ? l : 1 / 0), r = l * a.ratio), t.css({
                    width: r,
                    height: l,
                    left: m(f.x, e.w - r),
                    top: m(f.y, e.h - l)
                }), o.l = {
                    W: a.width,
                    H: a.height,
                    r: a.ratio,
                    w: e.w,
                    h: e.h,
                    m: n,
                    p: i
                }
            }
            return !0
        }

        function z(t, e) {
            var n = t[0];
            n.styleSheet ? n.styleSheet.cssText = e : t.html(e)
        }

        function L(t, e, n) {
            return e !== n && (t <= e ? "left" : t >= n ? "right" : "left right")
        }

        function $(t, e, n, i) {
            if (!n) return !1;
            if (!isNaN(t)) return t - (i ? 0 : 1);
            for (var o, a = 0, r = e.length; a < r; a++) {
                var s = e[a];
                if (s.id === t) {
                    o = a;
                    break
                }
            }
            return o
        }

        function B(t, e, n) {
            n = n || {}, t.each(function() {
                var t, o = i(this),
                    a = o.data();
                a.clickOn || (a.clickOn = !0, i.extend(nt(o, {
                    onStart: function(e) {
                        t = e, (n.onStart || r).call(this, e)
                    },
                    onMove: n.onMove || r,
                    onTouchEnd: n.onTouchEnd || r,
                    onEnd: function(n) {
                        n.moved || e.call(this, t)
                    }
                }), {
                    noMove: !0
                }))
            })
        }

        function F(t, e) {
            return '<div class="' + t + '">' + (e || "") + "</div>"
        }

        function H(t) {
            for (var e = t.length; e;) {
                var n = Math.floor(Math.random() * e--),
                    i = t[e];
                t[e] = t[n], t[n] = i
            }
            return t
        }

        function j(t) {
            return "[object Array]" == Object.prototype.toString.call(t) && i.map(t, function(t) {
                return i.extend({}, t)
            })
        }

        function R(t, e, n) {
            t.scrollLeft(e || 0).scrollTop(n || 0)
        }

        function W(t) {
            if (t) {
                var e = {};
                return i.each(t, function(t, n) {
                    e[t.toLowerCase()] = n
                }), e
            }
        }

        function U(t) {
            if (t) {
                var e = +t;
                return isNaN(e) ? (e = t.split("/"), +e[0] / +e[1] || o) : e
            }
        }

        function q(t, e, n, i) {
            e && (t.addEventListener ? t.addEventListener(e, n, !!i) : t.attachEvent("on" + e, n))
        }

        function Y(t) {
            return !!t.getAttribute("disabled")
        }

        function V(t) {
            return {
                tabindex: t * -1 + "",
                disabled: t
            }
        }

        function X(t, e) {
            q(t, "keyup", function(n) {
                Y(t) || 13 == n.keyCode && e.call(t, n)
            })
        }

        function G(t, e) {
            q(t, "focus", t.onfocusin = function(n) {
                e.call(t, n)
            }, !0)
        }

        function K(t, e) {
            t.preventDefault ? t.preventDefault() : t.returnValue = !1, e && t.stopPropagation && t.stopPropagation()
        }

        function Q(t) {
            return t ? ">" : "<"
        }

        function Z(t) {
            return t = (t + "").split(/\s+/), {
                x: g(t[0]) || en,
                y: g(t[1]) || en
            }
        }

        function J(t, e) {
            var n = t.data(),
                o = Math.round(e.pos),
                a = function() {
                    n.sliding = !1, (e.onEnd || r)()
                };
            "undefined" != typeof e.overPos && e.overPos !== e.pos && (o = e.overPos, a = function() {
                J(t, i.extend({}, e, {
                    overPos: e.pos,
                    time: Math.max(Re, e.time / 2)
                }))
            });
            var s = i.extend(d(o), e.width && {
                width: e.width
            });
            n.sliding = !0, Pe ? (t.css(i.extend(u(e.time), s)), e.time > 10 ? b(t, "transform", a, e.time) : a()) : t.stop().animate(s, e.time, Je, a)
        }

        function tt(t, e, n, o, a, s) {
            var l = "undefined" != typeof s;
            if (l || (a.push(arguments), Array.prototype.push.call(arguments, a.length), !(a.length > 1))) {
                t = t || i(t), e = e || i(e);
                var c = t[0],
                    d = e[0],
                    u = "crossfade" === o.method,
                    p = function() {
                        if (!p.done) {
                            p.done = !0;
                            var t = (l || a.shift()) && a.shift();
                            t && tt.apply(this, t), (o.onEnd || r)(!!t)
                        }
                    },
                    h = o.time / (s || 1);
                n.removeClass(Wt + " " + Rt), t.stop().addClass(Wt), e.stop().addClass(Rt), u && d && t.fadeTo(0, 0), t.fadeTo(u ? h : 0, 1, u && p), e.fadeTo(h, 0, p), c && u || d || p()
            }
        }

        function et(t) {
            var e = (t.touches || [])[0] || t;
            t._x = e.pageX, t._y = e.clientY, t._now = i.now()
        }

        function nt(t, n) {
            function o(t) {
                return p = i(t.target), b.checked = m = g = y = !1, d || b.flow || t.touches && t.touches.length > 1 || t.which > 1 || an && an.type !== t.type && sn || (m = n.select && p.is(n.select, w)) ? m : (f = "touchstart" === t.type, g = p.is("a, a *", w), h = b.control, v = b.noMove || b.noSwipe || h ? 16 : b.snap ? 0 : 4, et(t), u = an = t, rn = t.type.replace(/down|start/, "move").replace(/Down/, "Move"), (n.onStart || r).call(w, t, {
                    control: h,
                    $target: p
                }), d = b.flow = !0, void(f && !b.go || K(t)))
            }

            function a(t) {
                if (t.touches && t.touches.length > 1 || Fe && !t.isPrimary || rn !== t.type || !d) return d && s(), void(n.onTouchEnd || r)();
                et(t);
                var e = Math.abs(t._x - u._x),
                    i = Math.abs(t._y - u._y),
                    o = e - i,
                    a = (b.go || b.x || o >= 0) && !b.noSwipe,
                    l = o < 0;
                f && !b.checked ? (d = a) && K(t) : (K(t), (n.onMove || r).call(w, t, {
                    touch: f
                })), !y && Math.sqrt(Math.pow(e, 2) + Math.pow(i, 2)) > v && (y = !0), b.checked = b.checked || a || l
            }

            function s(t) {
                (n.onTouchEnd || r)();
                var e = d;
                b.control = d = !1, e && (b.flow = !1), !e || g && !b.checked || (t && K(t), sn = !0, clearTimeout(ln), ln = setTimeout(function() {
                    sn = !1
                }, 1e3), (n.onEnd || r).call(w, {
                    moved: y,
                    $target: p,
                    control: h,
                    touch: f,
                    startEvent: u,
                    aborted: !t || "MSPointerCancel" === t.type
                }))
            }

            function l() {
                b.flow || setTimeout(function() {
                    b.flow = !0
                }, 10)
            }

            function c() {
                b.flow && setTimeout(function() {
                    b.flow = !1
                }, je)
            }
            var d, u, p, h, f, m, g, v, y, w = t[0],
                b = {};
            return Fe ? (q(w, "MSPointerDown", o), q(e, "MSPointerMove", a), q(e, "MSPointerCancel", s), q(e, "MSPointerUp", s)) : (q(w, "touchstart", o), q(w, "touchmove", a), q(w, "touchend", s), q(e, "touchstart", l), q(e, "touchend", c), q(e, "touchcancel", c), Oe.on("scroll", c), t.on("mousedown", o), Ie.on("mousemove", a).on("mouseup", s)), t.on("click", "a", function(t) {
                b.checked && K(t)
            }), b
        }

        function it(t, e) {
            function n(n, i) {
                k = !0, c = u = n._x, g = n._now, m = [
                    [g, c]
                ], p = h = M.noMove || i ? 0 : x(t, (e.getPos || r)()), (e.onStart || r).call(E, n)
            }

            function o(t, e) {
                y = M.min, w = M.max, b = M.snap, C = t.altKey, k = _ = !1, S = e.control, S || D.sliding || n(t)
            }

            function a(i, o) {
                M.noSwipe || (k || n(i), u = i._x, m.push([i._now, u]), h = p - (c - u), f = L(h, y, w), h <= y ? h = T(h, y) : h >= w && (h = T(h, w)), M.noMove || (t.css(d(h)), _ || (_ = !0, o.touch || Fe || t.addClass(oe)), (e.onMove || r).call(E, i, {
                    pos: h,
                    edge: f
                })))
            }

            function l(o) {
                if (!M.noSwipe || !o.moved) {
                    k || n(o.startEvent, !0), o.touch || Fe || t.removeClass(oe), v = i.now();
                    for (var a, l, c, d, f, g, x, T, S, _ = v - je, D = null, O = Re, I = e.friction, A = m.length - 1; A >= 0; A--) {
                        if (a = m[A][0], l = Math.abs(a - _), null === D || l < c) D = a, d = m[A][1];
                        else if (D === _ || l > c) break;
                        c = l
                    }
                    x = s(h, y, w);
                    var N = d - u,
                        P = N >= 0,
                        z = v - D,
                        L = z > je,
                        $ = !L && h !== p && x === h;
                    b && (x = s(Math[$ ? P ? "floor" : "ceil" : "round"](h / b) * b, y, w), y = w = x), $ && (b || x === h) && (S = -(N / z), O *= s(Math.abs(S), e.timeLow, e.timeHigh), f = Math.round(h + S * O / I), b || (x = f), (!P && f > w || P && f < y) && (g = P ? y : w, T = f - g, b || (x = g), T = s(x + .03 * T, g - 50, g + 50), O = Math.abs((h - T) / (S / I)))), O *= C ? 10 : 1, (e.onEnd || r).call(E, i.extend(o, {
                        moved: o.moved || L && b,
                        pos: h,
                        newPos: x,
                        overPos: T,
                        time: O
                    }))
                }
            }
            var c, u, p, h, f, m, g, v, y, w, b, C, S, _, k, E = t[0],
                D = t.data(),
                M = {};
            return M = i.extend(nt(e.$wrap, i.extend({}, e, {
                onStart: o,
                onMove: a,
                onEnd: l
            })), M)
        }

        function ot(t, e) {
            var n, o, a, s = t[0],
                l = {
                    prevent: {}
                };
            return q(s, He, function(t) {
                var s = t.wheelDeltaY || -1 * t.deltaY || 0,
                    c = t.wheelDeltaX || -1 * t.deltaX || 0,
                    d = Math.abs(c) && !Math.abs(s),
                    u = Q(c < 0),
                    p = o === u,
                    h = i.now(),
                    f = h - a < je;
                o = u, a = h, d && l.ok && (!l.prevent[u] || n) && (K(t, !0), n && p && f || (e.shift && (n = !0, clearTimeout(l.t), l.t = setTimeout(function() {
                    n = !1
                }, We)), (e.onEnd || r)(t, e.shift ? u : c)))
            }), l
        }

        function at() {
            i.each(i.Fotorama.instances, function(t, e) {
                e.index = t
            })
        }

        function rt(t) {
            i.Fotorama.instances.push(t), at()
        }

        function st(t) {
            i.Fotorama.instances.splice(t.index, 1), at()
        }
        var lt = "fotorama",
            ct = "fullscreen",
            dt = lt + "__wrap",
            ut = dt + "--css2",
            pt = dt + "--css3",
            ht = dt + "--video",
            ft = dt + "--fade",
            mt = dt + "--slide",
            gt = dt + "--no-controls",
            vt = dt + "--no-shadows",
            yt = dt + "--pan-y",
            wt = dt + "--rtl",
            bt = dt + "--only-active",
            xt = dt + "--no-captions",
            Ct = dt + "--toggle-arrows",
            Tt = lt + "__stage",
            St = Tt + "__frame",
            _t = St + "--video",
            kt = Tt + "__shaft",
            Et = lt + "__grab",
            Dt = lt + "__pointer",
            Mt = lt + "__arr",
            Ot = Mt + "--disabled",
            It = Mt + "--prev",
            At = Mt + "--next",
            Nt = lt + "__nav",
            Pt = Nt + "-wrap",
            zt = Nt + "__shaft",
            Lt = Nt + "--dots",
            $t = Nt + "--thumbs",
            Bt = Nt + "__frame",
            Ft = Bt + "--dot",
            Ht = Bt + "--thumb",
            jt = lt + "__fade",
            Rt = jt + "-front",
            Wt = jt + "-rear",
            Ut = lt + "__shadow",
            qt = Ut + "s",
            Yt = qt + "--left",
            Vt = qt + "--right",
            Xt = lt + "__active",
            Gt = lt + "__select",
            Kt = lt + "--hidden",
            Qt = lt + "--fullscreen",
            Zt = lt + "__fullscreen-icon",
            Jt = lt + "__error",
            te = lt + "__loading",
            ee = lt + "__loaded",
            ne = ee + "--full",
            ie = ee + "--img",
            oe = lt + "__grabbing",
            ae = lt + "__img",
            re = ae + "--full",
            se = lt + "__dot",
            le = lt + "__thumb",
            ce = le + "-border",
            de = lt + "__html",
            ue = lt + "__video",
            pe = ue + "-play",
            he = ue + "-close",
            fe = lt + "__caption",
            me = lt + "__caption__wrap",
            ge = lt + "__spinner",
            ve = '" tabindex="0" role="button',
            ye = i && i.fn.jquery.split(".");
        if (!ye || ye[0] < 1 || 1 == ye[0] && ye[1] < 8) throw "Fotorama requires jQuery 1.8 or later and will not run without it.";
        var we = {},
            be = function(t, e, n) {
                function i(t) {
                    v.cssText = t
                }

                function o(t, e) {
                    return typeof t === e
                }

                function a(t, e) {
                    return !!~("" + t).indexOf(e)
                }

                function r(t, e) {
                    for (var i in t) {
                        var o = t[i];
                        if (!a(o, "-") && v[o] !== n) return "pfx" != e || o
                    }
                    return !1
                }

                function s(t, e, i) {
                    for (var a in t) {
                        var r = e[t[a]];
                        if (r !== n) return i === !1 ? t[a] : o(r, "function") ? r.bind(i || e) : r
                    }
                    return !1
                }

                function l(t, e, n) {
                    var i = t.charAt(0).toUpperCase() + t.slice(1),
                        a = (t + " " + b.join(i + " ") + i).split(" ");
                    return o(e, "string") || o(e, "undefined") ? r(a, e) : (a = (t + " " + x.join(i + " ") + i).split(" "), s(a, e, n))
                }
                var c, d, u, p = "2.6.2",
                    h = {},
                    f = e.documentElement,
                    m = "modernizr",
                    g = e.createElement(m),
                    v = g.style,
                    y = ({}.toString, " -webkit- -moz- -o- -ms- ".split(" ")),
                    w = "Webkit Moz O ms",
                    b = w.split(" "),
                    x = w.toLowerCase().split(" "),
                    C = {},
                    T = [],
                    S = T.slice,
                    _ = function(t, n, i, o) {
                        var a, r, s, l, c = e.createElement("div"),
                            d = e.body,
                            u = d || e.createElement("body");
                        if (parseInt(i, 10))
                            for (; i--;) s = e.createElement("div"), s.id = o ? o[i] : m + (i + 1), c.appendChild(s);
                        return a = ["&#173;", '<style id="s', m, '">', t, "</style>"].join(""), c.id = m, (d ? c : u).innerHTML += a, u.appendChild(c), d || (u.style.background = "", u.style.overflow = "hidden", l = f.style.overflow, f.style.overflow = "hidden", f.appendChild(u)), r = n(c, t), d ? c.parentNode.removeChild(c) : (u.parentNode.removeChild(u), f.style.overflow = l), !!r
                    },
                    k = {}.hasOwnProperty;
                u = o(k, "undefined") || o(k.call, "undefined") ? function(t, e) {
                    return e in t && o(t.constructor.prototype[e], "undefined")
                } : function(t, e) {
                    return k.call(t, e)
                }, Function.prototype.bind || (Function.prototype.bind = function(t) {
                    var e = this;
                    if ("function" != typeof e) throw new TypeError;
                    var n = S.call(arguments, 1),
                        i = function() {
                            if (this instanceof i) {
                                var o = function() {};
                                o.prototype = e.prototype;
                                var a = new o,
                                    r = e.apply(a, n.concat(S.call(arguments)));
                                return Object(r) === r ? r : a
                            }
                            return e.apply(t, n.concat(S.call(arguments)))
                        };
                    return i
                }), C.csstransforms3d = function() {
                    var t = !!l("perspective");
                    return t
                };
                for (var E in C) u(C, E) && (d = E.toLowerCase(), h[d] = C[E](), T.push((h[d] ? "" : "no-") + d));
                return h.addTest = function(t, e) {
                    if ("object" == typeof t)
                        for (var i in t) u(t, i) && h.addTest(i, t[i]);
                    else {
                        if (t = t.toLowerCase(), h[t] !== n) return h;
                        e = "function" == typeof e ? e() : e, "undefined" != typeof enableClasses && enableClasses && (f.className += " " + (e ? "" : "no-") + t), h[t] = e
                    }
                    return h
                }, i(""), g = c = null, h._version = p, h._prefixes = y, h._domPrefixes = x, h._cssomPrefixes = b, h.testProp = function(t) {
                    return r([t])
                }, h.testAllProps = l, h.testStyles = _, h.prefixed = function(t, e, n) {
                    return e ? l(t, e, n) : l(t, "pfx")
                }, h
            }(t, e),
            xe = {
                ok: !1,
                is: function() {
                    return !1
                },
                request: function() {},
                cancel: function() {},
                event: "",
                prefix: ""
            },
            Ce = "webkit moz o ms khtml".split(" ");
        if ("undefined" != typeof e.cancelFullScreen) xe.ok = !0;
        else
            for (var Te = 0, Se = Ce.length; Te < Se; Te++)
                if (xe.prefix = Ce[Te], "undefined" != typeof e[xe.prefix + "CancelFullScreen"]) {
                    xe.ok = !0;
                    break
                }
        xe.ok && (xe.event = xe.prefix + "fullscreenchange", xe.is = function() {
            switch (this.prefix) {
                case "":
                    return e.fullScreen;
                case "webkit":
                    return e.webkitIsFullScreen;
                default:
                    return e[this.prefix + "FullScreen"]
            }
        }, xe.request = function(t) {
            return "" === this.prefix ? t.requestFullScreen() : t[this.prefix + "RequestFullScreen"]()
        }, xe.cancel = function(t) {
            return "" === this.prefix ? e.cancelFullScreen() : e[this.prefix + "CancelFullScreen"]()
        });
        var _e, ke = {
                lines: 12,
                length: 5,
                width: 2,
                radius: 7,
                corners: 1,
                rotate: 15,
                color: "rgba(128, 128, 128, .75)",
                hwaccel: !0
            },
            Ee = {
                top: "auto",
                left: "auto",
                className: ""
            };
        ! function(t, e) {
            _e = e()
        }(this, function() {
            function t(t, n) {
                var i, o = e.createElement(t || "div");
                for (i in n) o[i] = n[i];
                return o
            }

            function n(t) {
                for (var e = 1, n = arguments.length; e < n; e++) t.appendChild(arguments[e]);
                return t
            }

            function i(t, e, n, i) {
                var o = ["opacity", e, ~~(100 * t), n, i].join("-"),
                    a = .01 + n / i * 100,
                    r = Math.max(1 - (1 - t) / e * (100 - a), t),
                    s = p.substring(0, p.indexOf("Animation")).toLowerCase(),
                    l = s && "-" + s + "-" || "";
                return f[o] || (m.insertRule("@" + l + "keyframes " + o + "{0%{opacity:" + r + "}" + a + "%{opacity:" + t + "}" + (a + .01) + "%{opacity:1}" + (a + e) % 100 + "%{opacity:" + t + "}100%{opacity:" + r + "}}", m.cssRules.length), f[o] = 1), o
            }

            function a(t, e) {
                var n, i, a = t.style;
                for (e = e.charAt(0).toUpperCase() + e.slice(1), i = 0; i < h.length; i++)
                    if (n = h[i] + e, a[n] !== o) return n;
                if (a[e] !== o) return e
            }

            function r(t, e) {
                for (var n in e) t.style[a(t, n) || n] = e[n];
                return t
            }

            function s(t) {
                for (var e = 1; e < arguments.length; e++) {
                    var n = arguments[e];
                    for (var i in n) t[i] === o && (t[i] = n[i])
                }
                return t
            }

            function l(t) {
                for (var e = {
                        x: t.offsetLeft,
                        y: t.offsetTop
                    }; t = t.offsetParent;) e.x += t.offsetLeft, e.y += t.offsetTop;
                return e
            }

            function c(t, e) {
                return "string" == typeof t ? t : t[e % t.length]
            }

            function d(t) {
                return "undefined" == typeof this ? new d(t) : void(this.opts = s(t || {}, d.defaults, g))
            }

            function u() {
                function e(e, n) {
                    return t("<" + e + ' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">', n)
                }
                m.addRule(".spin-vml", "behavior:url(#default#VML)"), d.prototype.lines = function(t, i) {
                    function o() {
                        return r(e("group", {
                            coordsize: d + " " + d,
                            coordorigin: -l + " " + -l
                        }), {
                            width: d,
                            height: d
                        })
                    }

                    function a(t, a, s) {
                        n(p, n(r(o(), {
                            rotation: 360 / i.lines * t + "deg",
                            left: ~~a
                        }), n(r(e("roundrect", {
                            arcsize: i.corners
                        }), {
                            width: l,
                            height: i.width,
                            left: i.radius,
                            top: -i.width >> 1,
                            filter: s
                        }), e("fill", {
                            color: c(i.color, t),
                            opacity: i.opacity
                        }), e("stroke", {
                            opacity: 0
                        }))))
                    }
                    var s, l = i.length + i.width,
                        d = 2 * l,
                        u = 2 * -(i.width + i.length) + "px",
                        p = r(o(), {
                            position: "absolute",
                            top: u,
                            left: u
                        });
                    if (i.shadow)
                        for (s = 1; s <= i.lines; s++) a(s, -2, "progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");
                    for (s = 1; s <= i.lines; s++) a(s);
                    return n(t, p)
                }, d.prototype.opacity = function(t, e, n, i) {
                    var o = t.firstChild;
                    i = i.shadow && i.lines || 0, o && e + i < o.childNodes.length && (o = o.childNodes[e + i], o = o && o.firstChild, o = o && o.firstChild, o && (o.opacity = n))
                }
            }
            var p, h = ["webkit", "Moz", "ms", "O"],
                f = {},
                m = function() {
                    var i = t("style", {
                        type: "text/css"
                    });
                    return n(e.getElementsByTagName("head")[0], i), i.sheet || i.styleSheet
                }(),
                g = {
                    lines: 12,
                    length: 7,
                    width: 5,
                    radius: 10,
                    rotate: 0,
                    corners: 1,
                    color: "#000",
                    direction: 1,
                    speed: 1,
                    trail: 100,
                    opacity: .25,
                    fps: 20,
                    zIndex: 2e9,
                    className: "spinner",
                    top: "auto",
                    left: "auto",
                    position: "relative"
                };
            d.defaults = {}, s(d.prototype, {
                spin: function(e) {
                    this.stop();
                    var n, i, o = this,
                        a = o.opts,
                        s = o.el = r(t(0, {
                            className: a.className
                        }), {
                            position: a.position,
                            width: 0,
                            zIndex: a.zIndex
                        }),
                        c = a.radius + a.length + a.width;
                    if (e && (e.insertBefore(s, e.firstChild || null), i = l(e), n = l(s), r(s, {
                            left: ("auto" == a.left ? i.x - n.x + (e.offsetWidth >> 1) : parseInt(a.left, 10) + c) + "px",
                            top: ("auto" == a.top ? i.y - n.y + (e.offsetHeight >> 1) : parseInt(a.top, 10) + c) + "px"
                        })), s.setAttribute("role", "progressbar"), o.lines(s, o.opts), !p) {
                        var d, u = 0,
                            h = (a.lines - 1) * (1 - a.direction) / 2,
                            f = a.fps,
                            m = f / a.speed,
                            g = (1 - a.opacity) / (m * a.trail / 100),
                            v = m / a.lines;
                        ! function y() {
                            u++;
                            for (var t = 0; t < a.lines; t++) d = Math.max(1 - (u + (a.lines - t) * v) % m * g, a.opacity), o.opacity(s, t * a.direction + h, d, a);
                            o.timeout = o.el && setTimeout(y, ~~(1e3 / f))
                        }()
                    }
                    return o
                },
                stop: function() {
                    var t = this.el;
                    return t && (clearTimeout(this.timeout), t.parentNode && t.parentNode.removeChild(t), this.el = o), this
                },
                lines: function(e, o) {
                    function a(e, n) {
                        return r(t(), {
                            position: "absolute",
                            width: o.length + o.width + "px",
                            height: o.width + "px",
                            background: e,
                            boxShadow: n,
                            transformOrigin: "left",
                            transform: "rotate(" + ~~(360 / o.lines * l + o.rotate) + "deg) translate(" + o.radius + "px,0)",
                            borderRadius: (o.corners * o.width >> 1) + "px"
                        })
                    }
                    for (var s, l = 0, d = (o.lines - 1) * (1 - o.direction) / 2; l < o.lines; l++) s = r(t(), {
                        position: "absolute",
                        top: 1 + ~(o.width / 2) + "px",
                        transform: o.hwaccel ? "translate3d(0,0,0)" : "",
                        opacity: o.opacity,
                        animation: p && i(o.opacity, o.trail, d + l * o.direction, o.lines) + " " + 1 / o.speed + "s linear infinite"
                    }), o.shadow && n(s, r(a("#000", "0 0 4px #000"), {
                        top: "2px"
                    })), n(e, n(s, a(c(o.color, l), "0 0 1px rgba(0,0,0,.1)")));
                    return e
                },
                opacity: function(t, e, n) {
                    e < t.childNodes.length && (t.childNodes[e].style.opacity = n)
                }
            });
            var v = r(t("group"), {
                behavior: "url(#default#VML)"
            });
            return !a(v, "transform") && v.adj ? u() : p = a(v, "animation"), d
        });
        var De, Me, Oe = i(t),
            Ie = i(e),
            Ae = "quirks" === n.hash.replace("#", ""),
            Ne = be.csstransforms3d,
            Pe = Ne && !Ae,
            ze = Ne || "CSS1Compat" === e.compatMode,
            Le = xe.ok,
            $e = navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i),
            Be = !Pe || $e,
            Fe = navigator.msPointerEnabled,
            He = "onwheel" in e.createElement("div") ? "wheel" : e.onmousewheel !== o ? "mousewheel" : "DOMMouseScroll",
            je = 250,
            Re = 300,
            We = 1400,
            Ue = 5e3,
            qe = 2,
            Ye = 64,
            Ve = 500,
            Xe = 333,
            Ge = "$stageFrame",
            Ke = "$navDotFrame",
            Qe = "$navThumbFrame",
            Ze = "auto",
            Je = a([.1, 0, .25, 1]),
            tn = 99999,
            en = "50%",
            nn = {
                width: null,
                minwidth: null,
                maxwidth: "100%",
                height: null,
                minheight: null,
                maxheight: null,
                ratio: null,
                margin: qe,
                glimpse: 0,
                fit: "contain",
                position: en,
                thumbposition: en,
                nav: "dots",
                navposition: "bottom",
                navwidth: null,
                thumbwidth: Ye,
                thumbheight: Ye,
                thumbmargin: qe,
                thumbborderwidth: qe,
                thumbfit: "cover",
                allowfullscreen: !1,
                transition: "slide",
                clicktransition: null,
                transitionduration: Re,
                captions: !0,
                hash: !1,
                startindex: 0,
                loop: !1,
                autoplay: !1,
                stopautoplayontouch: !0,
                keyboard: !1,
                arrows: !0,
                click: !0,
                swipe: !0,
                trackpad: !1,
                enableifsingleframe: !1,
                controlsonstart: !0,
                shuffle: !1,
                direction: "ltr",
                shadows: !0,
                spinner: null
            },
            on = {
                left: !0,
                right: !0,
                down: !1,
                up: !1,
                space: !1,
                home: !1,
                end: !1
            };
        A.stop = function(t) {
            A.ii[t] = !1
        };
        var an, rn, sn, ln;
        jQuery.Fotorama = function(t, o) {
            function a() {
                i.each(_n, function(t, e) {
                    if (!e.i) {
                        e.i = hi++;
                        var n = k(e.video, !0);
                        if (n) {
                            var i = {};
                            e.video = n, e.img || e.thumb ? e.thumbsReady = !0 : i = E(e, _n, ci), D(_n, {
                                img: i.img,
                                thumb: i.thumb
                            }, e.i, ci)
                        }
                    }
                })
            }

            function r(t) {
                return Zn[t] || ci.fullScreen
            }

            function l(t) {
                var e = "keydown." + lt,
                    n = lt + di,
                    i = "keydown." + n,
                    a = "resize." + n + " orientationchange." + n;
                t ? (Ie.on(i, function(t) {
                    var e, n;
                    Mn && 27 === t.keyCode ? (e = !0, hn(Mn, !0, !0)) : (ci.fullScreen || o.keyboard && !ci.index) && (27 === t.keyCode ? (e = !0, ci.cancelFullScreen()) : t.shiftKey && 32 === t.keyCode && r("space") || 37 === t.keyCode && r("left") || 38 === t.keyCode && r("up") ? n = "<" : 32 === t.keyCode && r("space") || 39 === t.keyCode && r("right") || 40 === t.keyCode && r("down") ? n = ">" : 36 === t.keyCode && r("home") ? n = "<<" : 35 === t.keyCode && r("end") && (n = ">>")), (e || n) && K(t), n && ci.show({
                        index: n,
                        slow: t.altKey,
                        user: !0
                    })
                }), ci.index || Ie.off(e).on(e, "textarea, input, select", function(t) {
                    !Me.hasClass(ct) && t.stopPropagation()
                }), Oe.on(a, ci.resize)) : (Ie.off(i), Oe.off(a))
            }

            function c(e) {
                e !== c.f && (e ? (t.html("").addClass(lt + " " + ui).append(vi).before(mi).before(gi), rt(ci)) : (vi.detach(), mi.detach(), gi.detach(), t.html(fi.urtext).removeClass(ui), st(ci)), l(e), c.f = e)
            }

            function p() {
                _n = ci.data = _n || j(o.data) || M(t), kn = ci.size = _n.length, !Sn.ok && o.shuffle && H(_n), a(), Li = S(Li), kn && c(!0)
            }

            function f() {
                var t = kn < 2 && !o.enableifsingleframe || Mn;
                Fi.noMove = t || qn, Fi.noSwipe = t || !o.swipe, !Gn && wi.toggleClass(Et, !o.click && !Fi.noMove && !Fi.noSwipe), Fe && vi.toggleClass(yt, !Fi.noSwipe)
            }

            function w(t) {
                t === !0 && (t = ""), o.autoplay = Math.max(+t || Ue, 1.5 * Xn)
            }

            function b() {
                function t(t, n) {
                    e[t ? "add" : "remove"].push(n)
                }
                ci.options = o = W(o), qn = "crossfade" === o.transition || "dissolve" === o.transition, Fn = o.loop && (kn > 2 || qn && (!Gn || "slide" !== Gn)), Xn = +o.transitionduration || Re, Qn = "rtl" === o.direction, Zn = i.extend({}, o.keyboard && on, o.keyboard);
                var e = {
                    add: [],
                    remove: []
                };
                kn > 1 || o.enableifsingleframe ? (Hn = o.nav, Rn = "top" === o.navposition, e.remove.push(Gt), Ti.toggle(!!o.arrows)) : (Hn = !1, Ti.hide()), Wt(), Dn = new _e(i.extend(ke, o.spinner, Ee, {
                    direction: Qn ? -1 : 1
                })), Ae(), Ne(), o.autoplay && w(o.autoplay), Yn = h(o.thumbwidth) || Ye, Vn = h(o.thumbheight) || Ye, Hi.ok = Ri.ok = o.trackpad && !Be, f(), an(o, [Bi]), jn = "thumbs" === Hn, jn ? (ue(kn, "navThumb"), En = Di, li = Qe, z(mi, i.Fotorama.jst.style({
                    w: Yn,
                    h: Vn,
                    b: o.thumbborderwidth,
                    m: o.thumbmargin,
                    s: di,
                    q: !ze
                })), _i.addClass($t).removeClass(Lt)) : "dots" === Hn ? (ue(kn, "navDot"), En = Ei, li = Ke, _i.addClass(Lt).removeClass($t)) : (Hn = !1, _i.removeClass($t + " " + Lt)), Hn && (Rn ? Si.insertBefore(yi) : Si.insertAfter(yi), Ce.nav = !1, Ce(En, ki, "nav")), Wn = o.allowfullscreen, Wn ? (Oi.prependTo(yi), Un = Le && "native" === Wn) : (Oi.detach(), Un = !1), t(qn, ft), t(!qn, mt), t(!o.captions, xt), t(Qn, wt), t("always" !== o.arrows, Ct), Kn = o.shadows && !Be, t(!Kn, vt), vi.addClass(e.add.join(" ")).removeClass(e.remove.join(" ")), $i = i.extend({}, o)
            }

            function T(t) {
                return t < 0 ? (kn + t % kn) % kn : t >= kn ? t % kn : t
            }

            function S(t) {
                return s(t, 0, kn - 1)
            }

            function _(t) {
                return Fn ? T(t) : S(t)
            }

            function O(t) {
                return !!(t > 0 || Fn) && t - 1
            }

            function Y(t) {
                return !!(t < kn - 1 || Fn) && t + 1
            }

            function Z() {
                Fi.min = Fn ? -(1 / 0) : -v(kn - 1, Bi.w, o.margin, An), Fi.max = Fn ? 1 / 0 : -v(0, Bi.w, o.margin, An), Fi.snap = Bi.w + o.margin
            }

            function et() {
                ji.min = Math.min(0, Bi.nw - ki.width()), ji.max = 0, ki.toggleClass(Et, !(ji.noMove = ji.min === ji.max))
            }

            function nt(t, e, n) {
                if ("number" == typeof t) {
                    t = new Array(t);
                    var o = !0
                }
                return i.each(t, function(t, i) {
                    if (o && (i = t), "number" == typeof i) {
                        var a = _n[T(i)];
                        if (a) {
                            var r = "$" + e + "Frame",
                                s = a[r];
                            n.call(this, t, i, a, s, r, s && s.data())
                        }
                    }
                })
            }

            function at(t, e, n, i) {
                (!Jn || "*" === Jn && i === Bn) && (t = g(o.width) || g(t) || Ve, e = g(o.height) || g(e) || Xe, ci.resize({
                    width: t,
                    ratio: o.ratio || n || t / e
                }, 0, i !== Bn && "*"))
            }

            function jt(t, e, n, a, r, s) {
                nt(t, e, function(t, l, c, d, u, p) {
                    function h(t) {
                        var e = T(l);
                        rn(t, {
                            index: e,
                            src: C,
                            frame: _n[e]
                        })
                    }

                    function f() {
                        w.remove(), i.Fotorama.cache[C] = "error", c.html && "stage" === e || !S || S === C ? (!C || c.html || v ? "stage" === e && (d.trigger("f:load").removeClass(te + " " + Jt).addClass(ee), h("load"), at()) : (d.trigger("f:error").removeClass(te).addClass(Jt), h("error")), p.state = "error", !(kn > 1 && _n[l] === c) || c.html || c.deleted || c.video || v || (c.deleted = !0, ci.splice(l, 1))) : (c[x] = C = S, jt([l], e, n, a, r, !0))
                    }

                    function m() {
                        i.Fotorama.measures[C] = b.measures = i.Fotorama.measures[C] || {
                            width: y.width,
                            height: y.height,
                            ratio: y.width / y.height
                        }, at(b.measures.width, b.measures.height, b.measures.ratio, l), w.off("load error").addClass(ae + (v ? " " + re : "")).prependTo(d), P(w, (i.isFunction(n) ? n() : n) || Bi, a || c.fit || o.fit, r || c.position || o.position), i.Fotorama.cache[C] = p.state = "loaded", setTimeout(function() {
                            d.trigger("f:load").removeClass(te + " " + Jt).addClass(ee + " " + (v ? ne : ie)),
                                "stage" === e ? h("load") : (c.thumbratio === Ze || !c.thumbratio && o.thumbratio === Ze) && (c.thumbratio = b.measures.ratio, Cn())
                        }, 0)
                    }

                    function g() {
                        var t = 10;
                        A(function() {
                            return !ri || !t-- && !Be
                        }, function() {
                            m()
                        })
                    }
                    if (d) {
                        var v = ci.fullScreen && c.full && c.full !== c.img && !p.$full && "stage" === e;
                        if (!p.$img || s || v) {
                            var y = new Image,
                                w = i(y),
                                b = w.data();
                            p[v ? "$full" : "$img"] = w;
                            var x = "stage" === e ? v ? "full" : "img" : "thumb",
                                C = c[x],
                                S = v ? null : c["stage" === e ? "thumb" : "img"];
                            if ("navThumb" === e && (d = p.$wrap), !C) return void f();
                            i.Fotorama.cache[C] ? ! function _() {
                                "error" === i.Fotorama.cache[C] ? f() : "loaded" === i.Fotorama.cache[C] ? setTimeout(g, 0) : setTimeout(_, 100)
                            }() : (i.Fotorama.cache[C] = "*", w.on("load", g).on("error", f)), p.state = "", y.src = C
                        }
                    }
                })
            }

            function Rt(t) {
                zi.append(Dn.spin().el).appendTo(t)
            }

            function Wt() {
                zi.detach(), Dn && Dn.stop()
            }

            function Ut() {
                var t = On[Ge];
                t && !t.data().state && (Rt(t), t.on("f:load f:error", function() {
                    t.off("f:load f:error"), Wt()
                }))
            }

            function oe(t) {
                X(t, wn), G(t, function() {
                    setTimeout(function() {
                        R(_i)
                    }, 0), We({
                        time: Xn,
                        guessIndex: i(this).data().eq,
                        minMax: ji
                    })
                })
            }

            function ue(t, e) {
                nt(t, e, function(t, n, o, a, r, s) {
                    if (!a) {
                        a = o[r] = vi[r].clone(), s = a.data(), s.data = o;
                        var l = a[0];
                        "stage" === e ? (o.html && i('<div class="' + de + '"></div>').append(o._html ? i(o.html).removeAttr("id").html(o._html) : o.html).appendTo(a), o.caption && i(F(fe, F(me, o.caption))).appendTo(a), o.video && a.addClass(_t).append(Ai.clone()), G(l, function() {
                            setTimeout(function() {
                                R(yi)
                            }, 0), gn({
                                index: s.eq,
                                user: !0
                            })
                        }), bi = bi.add(a)) : "navDot" === e ? (oe(l), Ei = Ei.add(a)) : "navThumb" === e && (oe(l), s.$wrap = a.children(":first"), Di = Di.add(a), o.video && s.$wrap.append(Ai.clone()))
                    }
                })
            }

            function ye(t, e, n, i) {
                return t && t.length && P(t, e, n, i)
            }

            function we(t) {
                nt(t, "stage", function(t, e, n, a, r, s) {
                    if (a) {
                        var l = T(e),
                            c = n.fit || o.fit,
                            d = n.position || o.position;
                        s.eq = l, Ui[Ge][l] = a.css(i.extend({
                            left: qn ? 0 : v(e, Bi.w, o.margin, An)
                        }, qn && u(0))), I(a[0]) && (a.appendTo(wi), hn(n.$video)), ye(s.$img, Bi, c, d), ye(s.$full, Bi, c, d)
                    }
                })
            }

            function be(t, e) {
                if ("thumbs" === Hn && !isNaN(t)) {
                    var n = -t,
                        a = -t + Bi.nw;
                    Di.each(function() {
                        var t = i(this),
                            r = t.data(),
                            s = r.eq,
                            l = function() {
                                return {
                                    h: Vn,
                                    w: r.w
                                }
                            },
                            c = l(),
                            d = _n[s] || {},
                            u = d.thumbfit || o.thumbfit,
                            p = d.thumbposition || o.thumbposition;
                        c.w = r.w, r.l + r.w < n || r.l > a || ye(r.$img, c, u, p) || e && jt([s], "navThumb", l, u, p)
                    })
                }
            }

            function Ce(t, e, n) {
                if (!Ce[n]) {
                    var a = "nav" === n && jn,
                        r = 0;
                    e.append(t.filter(function() {
                        for (var t, e = i(this), n = e.data(), o = 0, a = _n.length; o < a; o++)
                            if (n.data === _n[o]) {
                                t = !0, n.eq = o;
                                break
                            }
                        return t || e.remove() && !1
                    }).sort(function(t, e) {
                        return i(t).data().eq - i(e).data().eq
                    }).each(function() {
                        if (a) {
                            var t = i(this),
                                e = t.data(),
                                n = Math.round(Vn * e.data.thumbratio) || Yn;
                            e.l = r, e.w = n, t.css({
                                width: n
                            }), r += n + o.thumbmargin
                        }
                    })), Ce[n] = !0
                }
            }

            function Te(t) {
                return t - qi > Bi.w / 3
            }

            function Se(t) {
                return !(Fn || Li + t && Li - kn + t || Mn)
            }

            function Ae() {
                var t = Se(0),
                    e = Se(1);
                xi.toggleClass(Ot, t).attr(V(t)), Ci.toggleClass(Ot, e).attr(V(e))
            }

            function Ne() {
                Hi.ok && (Hi.prevent = {
                    "<": Se(0),
                    ">": Se(1)
                })
            }

            function $e(t) {
                var e, n, i = t.data();
                return jn ? (e = i.l, n = i.w) : (e = t.position().left, n = t.width()), {
                    c: e + n / 2,
                    min: -e + 10 * o.thumbmargin,
                    max: -e + Bi.w - n - 10 * o.thumbmargin
                }
            }

            function He(t) {
                var e = On[li].data();
                J(Mi, {
                    time: 1.2 * t,
                    pos: e.l,
                    width: e.w - 2 * o.thumbborderwidth
                })
            }

            function We(t) {
                var e = _n[t.guessIndex][li];
                if (e) {
                    var n = ji.min !== ji.max,
                        i = t.minMax || n && $e(On[li]),
                        o = n && (t.keep && We.l ? We.l : s((t.coo || Bi.nw / 2) - $e(e).c, i.min, i.max)),
                        a = n && s(o, ji.min, ji.max),
                        r = 1.1 * t.time;
                    J(ki, {
                        time: r,
                        pos: a || 0,
                        onEnd: function() {
                            be(a, !0)
                        }
                    }), pn(_i, L(a, ji.min, ji.max)), We.l = o
                }
            }

            function qe() {
                Je(li), Wi[li].push(On[li].addClass(Xt))
            }

            function Je(t) {
                for (var e = Wi[t]; e.length;) e.shift().removeClass(Xt)
            }

            function en(t) {
                var e = Ui[t];
                i.each(In, function(t, n) {
                    delete e[T(n)]
                }), i.each(e, function(t, n) {
                    delete e[t], n.detach()
                })
            }

            function nn(t) {
                An = Nn = Li;
                var e = On[Ge];
                e && (Je(Ge), Wi[Ge].push(e.addClass(Xt)), t || ci.show.onEnd(!0), x(wi, 0, !0), en(Ge), we(In), Z(), et())
            }

            function an(t, e) {
                t && i.each(e, function(e, n) {
                    n && i.extend(n, {
                        width: t.width || n.width,
                        height: t.height,
                        minwidth: t.minwidth,
                        maxwidth: t.maxwidth,
                        minheight: t.minheight,
                        maxheight: t.maxheight,
                        ratio: U(t.ratio)
                    })
                })
            }

            function rn(e, n) {
                t.trigger(lt + ":" + e, [ci, n])
            }

            function sn() {
                clearTimeout(ln.t), ri = 1, o.stopautoplayontouch ? ci.stopAutoplay() : ii = !0
            }

            function ln() {
                ri && (o.stopautoplayontouch || (cn(), dn()), ln.t = setTimeout(function() {
                    ri = 0
                }, Re + je))
            }

            function cn() {
                ii = !(!Mn && !oi)
            }

            function dn() {
                if (clearTimeout(dn.t), A.stop(dn.w), !o.autoplay || ii) return void(ci.autoplay && (ci.autoplay = !1, rn("stopautoplay")));
                ci.autoplay || (ci.autoplay = !0, rn("startautoplay"));
                var t = Li,
                    e = On[Ge].data();
                dn.w = A(function() {
                    return e.state || t !== Li
                }, function() {
                    dn.t = setTimeout(function() {
                        if (!ii && t === Li) {
                            var e = $n,
                                n = _n[e][Ge].data();
                            dn.w = A(function() {
                                return n.state || e !== $n
                            }, function() {
                                ii || e !== $n || ci.show(Fn ? Q(!Qn) : $n)
                            })
                        }
                    }, o.autoplay)
                })
            }

            function un() {
                ci.fullScreen && (ci.fullScreen = !1, Le && xe.cancel(pi), Me.removeClass(ct), De.removeClass(ct), t.removeClass(Qt).insertAfter(gi), Bi = i.extend({}, ai), hn(Mn, !0, !0), yn("x", !1), ci.resize(), jt(In, "stage"), R(Oe, ei, ti), rn("fullscreenexit"))
            }

            function pn(t, e) {
                Kn && (t.removeClass(Yt + " " + Vt), e && !Mn && t.addClass(e.replace(/^|\s/g, " " + qt + "--")))
            }

            function hn(t, e, n) {
                e && (vi.removeClass(ht), Mn = !1, f()), t && t !== Mn && (t.remove(), rn("unloadvideo")), n && (cn(), dn())
            }

            function fn(t) {
                vi.toggleClass(gt, t)
            }

            function mn(t) {
                if (!Fi.flow) {
                    var e = t ? t.pageX : mn.x,
                        n = e && !Se(Te(e)) && o.click;
                    mn.p !== n && yi.toggleClass(Dt, n) && (mn.p = n, mn.x = e)
                }
            }

            function gn(t) {
                clearTimeout(gn.t), o.clicktransition && o.clicktransition !== o.transition ? setTimeout(function() {
                    var e = o.transition;
                    ci.setOptions({
                        transition: o.clicktransition
                    }), Gn = e, gn.t = setTimeout(function() {
                        ci.show(t)
                    }, 10)
                }, 0) : ci.show(t)
            }

            function vn(t, e) {
                var n = t.target,
                    a = i(n);
                a.hasClass(pe) ? ci.playVideo() : n === Ii ? ci.toggleFullScreen() : Mn ? n === Pi && hn(Mn, !0, !0) : e ? fn() : o.click && gn({
                    index: t.shiftKey || Q(Te(t._x)),
                    slow: t.altKey,
                    user: !0
                })
            }

            function yn(t, e) {
                Fi[t] = ji[t] = e
            }

            function wn(t) {
                var e = i(this).data().eq;
                gn({
                    index: e,
                    slow: t.altKey,
                    user: !0,
                    coo: t._x - _i.offset().left
                })
            }

            function bn(t) {
                gn({
                    index: Ti.index(this) ? ">" : "<",
                    slow: t.altKey,
                    user: !0
                })
            }

            function xn(t) {
                G(t, function() {
                    setTimeout(function() {
                        R(yi)
                    }, 0), fn(!1)
                })
            }

            function Cn() {
                if (p(), b(), !Cn.i) {
                    Cn.i = !0;
                    var t = o.startindex;
                    (t || o.hash && n.hash) && (Bn = $(t || n.hash.replace(/^#/, ""), _n, 0 === ci.index || t, t)), Li = An = Nn = Pn = Bn = _(Bn) || 0
                }
                if (kn) {
                    if (Tn()) return;
                    Mn && hn(Mn, !0), In = [], en(Ge), Cn.ok = !0, ci.show({
                        index: Li,
                        time: 0
                    }), ci.resize()
                } else ci.destroy()
            }

            function Tn() {
                if (!Tn.f === Qn) return Tn.f = Qn, Li = kn - 1 - Li, ci.reverse(), !0
            }

            function Sn() {
                Sn.ok || (Sn.ok = !0, rn("ready"))
            }
            De = i("html"), Me = i("body");
            var _n, kn, En, Dn, Mn, On, In, An, Nn, Pn, zn, Ln, $n, Bn, Fn, Hn, jn, Rn, Wn, Un, qn, Yn, Vn, Xn, Gn, Kn, Qn, Zn, Jn, ti, ei, ni, ii, oi, ai, ri, si, li, ci = this,
                di = i.now(),
                ui = lt + di,
                pi = t[0],
                hi = 1,
                fi = t.data(),
                mi = i("<style></style>"),
                gi = i(F(Kt)),
                vi = i(F(dt)),
                yi = i(F(Tt)).appendTo(vi),
                wi = (yi[0], i(F(kt)).appendTo(yi)),
                bi = i(),
                xi = i(F(Mt + " " + It + ve)),
                Ci = i(F(Mt + " " + At + ve)),
                Ti = xi.add(Ci).appendTo(yi),
                Si = i(F(Pt)),
                _i = i(F(Nt)).appendTo(Si),
                ki = i(F(zt)).appendTo(_i),
                Ei = i(),
                Di = i(),
                Mi = (wi.data(), ki.data(), i(F(ce)).appendTo(ki)),
                Oi = i(F(Zt + ve)),
                Ii = Oi[0],
                Ai = i(F(pe)),
                Ni = i(F(he)).appendTo(yi),
                Pi = Ni[0],
                zi = i(F(ge)),
                Li = !1,
                $i = {},
                Bi = {},
                Fi = {},
                Hi = {},
                ji = {},
                Ri = {},
                Wi = {},
                Ui = {},
                qi = 0,
                Yi = [];
            vi[Ge] = i(F(St)), vi[Qe] = i(F(Bt + " " + Ht + ve, F(le))), vi[Ke] = i(F(Bt + " " + Ft + ve, F(se))), Wi[Ge] = [], Wi[Qe] = [], Wi[Ke] = [], Ui[Ge] = {}, vi.addClass(Pe ? pt : ut).toggleClass(gt, !o.controlsonstart), fi.fotorama = this, ci.startAutoplay = function(t) {
                return ci.autoplay ? this : (ii = oi = !1, w(t || o.autoplay), dn(), this)
            }, ci.stopAutoplay = function() {
                return ci.autoplay && (ii = oi = !0, dn()), this
            }, ci.show = function(t) {
                var e;
                "object" != typeof t ? (e = t, t = {}) : e = t.index, e = ">" === e ? Nn + 1 : "<" === e ? Nn - 1 : "<<" === e ? 0 : ">>" === e ? kn - 1 : e, e = isNaN(e) ? $(e, _n, !0) : e, e = "undefined" == typeof e ? Li || 0 : e, ci.activeIndex = Li = _(e), zn = O(Li), Ln = Y(Li), $n = T(Li + (Qn ? -1 : 1)), In = [Li, zn, Ln], Nn = Fn ? e : Li;
                var n = Math.abs(Pn - Nn),
                    i = C(t.time, function() {
                        return Math.min(Xn * (1 + (n - 1) / 12), 2 * Xn)
                    }),
                    a = t.overPos;
                t.slow && (i *= 10);
                var r = On;
                ci.activeFrame = On = _n[Li];
                var l = r === On && !t.user;
                hn(Mn, On.i !== _n[T(An)].i), ue(In, "stage"), we(Be ? [Nn] : [Nn, O(Nn), Y(Nn)]), yn("go", !0), l || rn("show", {
                    user: t.user,
                    time: i
                }), ii = !0;
                var c = ci.show.onEnd = function(e) {
                    if (!c.ok) {
                        if (c.ok = !0, e || nn(!0), l || rn("showend", {
                                user: t.user
                            }), !e && Gn && Gn !== o.transition) return ci.setOptions({
                            transition: Gn
                        }), void(Gn = !1);
                        Ut(), jt(In, "stage"), yn("go", !1), Ne(), mn(), cn(), dn()
                    }
                };
                if (qn) {
                    var d = On[Ge],
                        u = Li !== Pn ? _n[Pn][Ge] : null;
                    tt(d, u, bi, {
                        time: i,
                        method: o.transition,
                        onEnd: c
                    }, Yi)
                } else J(wi, {
                    pos: -v(Nn, Bi.w, o.margin, An),
                    overPos: a,
                    time: i,
                    onEnd: c
                });
                if (Ae(), Hn) {
                    qe();
                    var p = S(Li + s(Nn - Pn, -1, 1));
                    We({
                        time: i,
                        coo: p !== Li && t.coo,
                        guessIndex: "undefined" != typeof t.coo ? p : Li,
                        keep: l
                    }), jn && He(i)
                }
                return ni = "undefined" != typeof Pn && Pn !== Li, Pn = Li, o.hash && ni && !ci.eq && N(On.id || Li + 1), this
            }, ci.requestFullScreen = function() {
                return Wn && !ci.fullScreen && (ti = Oe.scrollTop(), ei = Oe.scrollLeft(), R(Oe), yn("x", !0), ai = i.extend({}, Bi), t.addClass(Qt).appendTo(Me.addClass(ct)), De.addClass(ct), hn(Mn, !0, !0), ci.fullScreen = !0, Un && xe.request(pi), ci.resize(), jt(In, "stage"), Ut(), rn("fullscreenenter")), this
            }, ci.cancelFullScreen = function() {
                return Un && xe.is() ? xe.cancel(e) : un(), this
            }, ci.toggleFullScreen = function() {
                return ci[(ci.fullScreen ? "cancel" : "request") + "FullScreen"]()
            }, q(e, xe.event, function() {
                !_n || xe.is() || Mn || un()
            }), ci.resize = function(t) {
                if (!_n) return this;
                var e = arguments[1] || 0,
                    n = arguments[2];
                an(ci.fullScreen ? {
                    width: "100%",
                    maxwidth: null,
                    minwidth: null,
                    height: "100%",
                    maxheight: null,
                    minheight: null
                } : W(t), [Bi, n || ci.fullScreen || o]);
                var i = Bi.width,
                    a = Bi.height,
                    r = Bi.ratio,
                    l = Oe.height() - (Hn ? _i.height() : 0);
                return g(i) && (vi.addClass(bt).css({
                    width: i,
                    minWidth: Bi.minwidth || 0,
                    maxWidth: Bi.maxwidth || tn
                }), i = Bi.W = Bi.w = vi.width(), Bi.nw = Hn && m(o.navwidth, i) || i, o.glimpse && (Bi.w -= Math.round(2 * (m(o.glimpse, i) || 0))), wi.css({
                    width: Bi.w,
                    marginLeft: (Bi.W - Bi.w) / 2
                }), a = m(a, l), a = a || r && i / r, a && (i = Math.round(i), a = Bi.h = Math.round(s(a, m(Bi.minheight, l), m(Bi.maxheight, l))), yi.stop().animate({
                    width: i,
                    height: a
                }, e, function() {
                    vi.removeClass(bt)
                }), nn(), Hn && (_i.stop().animate({
                    width: Bi.nw
                }, e), We({
                    guessIndex: Li,
                    time: e,
                    keep: !0
                }), jn && Ce.nav && He(e)), Jn = n || !0, Sn())), qi = yi.offset().left, this
            }, ci.setOptions = function(t) {
                return i.extend(o, t), Cn(), this
            }, ci.shuffle = function() {
                return _n && H(_n) && Cn(), this
            }, ci.destroy = function() {
                return ci.cancelFullScreen(), ci.stopAutoplay(), _n = ci.data = null, c(), In = [], en(Ge), Cn.ok = !1, this
            }, ci.playVideo = function() {
                var t = On,
                    e = t.video,
                    n = Li;
                return "object" == typeof e && t.videoReady && (Un && ci.fullScreen && ci.cancelFullScreen(), A(function() {
                    return !xe.is() || n !== Li
                }, function() {
                    n === Li && (t.$video = t.$video || i(i.Fotorama.jst.video(e)), t.$video.appendTo(t[Ge]), vi.addClass(ht), Mn = t.$video, f(), Ti.blur(), Oi.blur(), rn("loadvideo"))
                })), this
            }, ci.stopVideo = function() {
                return hn(Mn, !0, !0), this
            }, yi.on("mousemove", mn), Fi = it(wi, {
                onStart: sn,
                onMove: function(t, e) {
                    pn(yi, e.edge)
                },
                onTouchEnd: ln,
                onEnd: function(t) {
                    pn(yi);
                    var e = (Fe && !si || t.touch) && o.arrows && "always" !== o.arrows;
                    if (t.moved || e && t.pos !== t.newPos && !t.control) {
                        var n = y(t.newPos, Bi.w, o.margin, An);
                        ci.show({
                            index: n,
                            time: qn ? Xn : t.time,
                            overPos: t.overPos,
                            user: !0
                        })
                    } else t.aborted || t.control || vn(t.startEvent, e)
                },
                timeLow: 1,
                timeHigh: 1,
                friction: 2,
                select: "." + Gt + ", ." + Gt + " *",
                $wrap: yi
            }), ji = it(ki, {
                onStart: sn,
                onMove: function(t, e) {
                    pn(_i, e.edge)
                },
                onTouchEnd: ln,
                onEnd: function(t) {
                    function e() {
                        We.l = t.newPos, cn(), dn(), be(t.newPos, !0)
                    }
                    if (t.moved) t.pos !== t.newPos ? (ii = !0, J(ki, {
                        time: t.time,
                        pos: t.newPos,
                        overPos: t.overPos,
                        onEnd: e
                    }), be(t.newPos), Kn && pn(_i, L(t.newPos, ji.min, ji.max))) : e();
                    else {
                        var n = t.$target.closest("." + Bt, ki)[0];
                        n && wn.call(n, t.startEvent)
                    }
                },
                timeLow: .5,
                timeHigh: 2,
                friction: 5,
                $wrap: _i
            }), Hi = ot(yi, {
                shift: !0,
                onEnd: function(t, e) {
                    sn(), ln(), ci.show({
                        index: e,
                        slow: t.altKey
                    })
                }
            }), Ri = ot(_i, {
                onEnd: function(t, e) {
                    sn(), ln();
                    var n = x(ki) + .25 * e;
                    ki.css(d(s(n, ji.min, ji.max))), Kn && pn(_i, L(n, ji.min, ji.max)), Ri.prevent = {
                        "<": n >= ji.max,
                        ">": n <= ji.min
                    }, clearTimeout(Ri.t), Ri.t = setTimeout(function() {
                        We.l = n, be(n, !0)
                    }, je), be(n)
                }
            }), vi.hover(function() {
                setTimeout(function() {
                    ri || fn(!(si = !0))
                }, 0)
            }, function() {
                si && fn(!(si = !1))
            }), B(Ti, function(t) {
                K(t), bn.call(this, t)
            }, {
                onStart: function() {
                    sn(), Fi.control = !0
                },
                onTouchEnd: ln
            }), Ti.each(function() {
                X(this, function(t) {
                    bn.call(this, t)
                }), xn(this)
            }), X(Ii, ci.toggleFullScreen), xn(Ii), i.each("load push pop shift unshift reverse sort splice".split(" "), function(t, e) {
                ci[e] = function() {
                    return _n = _n || [], "load" !== e ? Array.prototype[e].apply(_n, arguments) : arguments[0] && "object" == typeof arguments[0] && arguments[0].length && (_n = j(arguments[0])), Cn(), ci
                }
            }), Cn()
        }, i.fn.fotorama = function(e) {
            return this.each(function() {
                var n = this,
                    o = i(this),
                    a = o.data(),
                    r = a.fotorama;
                r ? r.setOptions(e, !0) : A(function() {
                    return !O(n)
                }, function() {
                    a.urtext = o.html(), new i.Fotorama(o, i.extend({}, nn, t.fotoramaDefaults, e, a))
                })
            })
        }, i.Fotorama.instances = [], i.Fotorama.cache = {}, i.Fotorama.measures = {}, i = i || {}, i.Fotorama = i.Fotorama || {}, i.Fotorama.jst = i.Fotorama.jst || {}, i.Fotorama.jst.style = function(t) {
            var e, n = "";
            we.escape;
            return n += ".fotorama" + (null == (e = t.s) ? "" : e) + " .fotorama__nav--thumbs .fotorama__nav__frame{\npadding:" + (null == (e = t.m) ? "" : e) + "px;\nheight:" + (null == (e = t.h) ? "" : e) + "px}\n.fotorama" + (null == (e = t.s) ? "" : e) + " .fotorama__thumb-border{\nheight:" + (null == (e = t.h - t.b * (t.q ? 0 : 2)) ? "" : e) + "px;\nborder-width:" + (null == (e = t.b) ? "" : e) + "px;\nmargin-top:" + (null == (e = t.m) ? "" : e) + "px}"
        }, i.Fotorama.jst.video = function(t) {
            function e() {
                n += i.call(arguments, "")
            }
            var n = "",
                i = (we.escape, Array.prototype.join);
            return n += '<div class="fotorama__video"><iframe src="', e(("youtube" == t.type ? t.p + "youtube.com/embed/" + t.id + "?autoplay=1" : "vimeo" == t.type ? t.p + "player.vimeo.com/video/" + t.id + "?autoplay=1&badge=0" : t.id) + (t.s && "custom" != t.type ? "&" + t.s : "")), n += '" frameborder="0" allowfullscreen></iframe></div>\n'
        }, i(function() {
            i("." + lt + ':not([data-auto="false"])').fotorama()
        })
    }(window, document, location, "undefined" != typeof jQuery && jQuery),
    function(t) {
        t.fn.autoComplete = function(e) {
            var n = t.extend({}, t.fn.autoComplete.defaults, e);
            return "string" == typeof e ? (this.each(function() {
                var n = t(this);
                "destroy" == e && (t(window).off("resize.autocomplete", n.updateSC), n.off("blur.autocomplete focus.autocomplete keydown.autocomplete keyup.autocomplete"), n.data("autocomplete") ? n.attr("autocomplete", n.data("autocomplete")) : n.removeAttr("autocomplete"), t(n.data("sc")).remove(), n.removeData("sc").removeData("autocomplete"))
            }), this) : this.each(function() {
                function e(t) {
                    var e = i.val();
                    if (i.cache[e] = t, t.length && e.length >= n.minChars) {
                        for (var o = "", a = 0; a < t.length; a++) o += n.renderItem(t[a], e);
                        i.sc.html(o), i.updateSC(0)
                    } else i.sc.hide()
                }
                var i = t(this);
                i.sc = t('<div class="autocomplete-suggestions ' + n.menuClass + '"></div>'), i.data("sc", i.sc).data("autocomplete", i.attr("autocomplete")), i.attr("autocomplete", "off"), i.cache = {}, i.last_val = "", i.updateSC = function(e, n) {
                    if (i.sc.css({
                            top: i.offset().top + i.outerHeight(),
                            left: i.offset().left,
                            width: i.outerWidth()
                        }), !e && (i.sc.show(), i.sc.maxHeight || (i.sc.maxHeight = parseInt(i.sc.css("max-height"))), i.sc.suggestionHeight || (i.sc.suggestionHeight = t(".autocomplete-suggestion", i.sc).first().outerHeight()), i.sc.suggestionHeight))
                        if (n) {
                            var o = i.sc.scrollTop(),
                                a = n.offset().top - i.sc.offset().top;
                            a + i.sc.suggestionHeight - i.sc.maxHeight > 0 ? i.sc.scrollTop(a + i.sc.suggestionHeight + o - i.sc.maxHeight) : a < 0 && i.sc.scrollTop(a + o)
                        } else i.sc.scrollTop(0)
                }, t(window).on("resize.autocomplete", i.updateSC), i.sc.appendTo("body"), i.sc.on("mouseleave", ".autocomplete-suggestion", function() {
                    t(".autocomplete-suggestion.selected").removeClass("selected")
                }), i.sc.on("mouseenter", ".autocomplete-suggestion", function() {
                    t(".autocomplete-suggestion.selected").removeClass("selected"), t(this).addClass("selected")
                }), i.sc.on("mousedown click", ".autocomplete-suggestion", function(e) {
                    var o = t(this),
                        a = o.data("val");
                    return (a || o.hasClass("autocomplete-suggestion")) && (i.val(a), n.onSelect(e, a, o), i.sc.hide()), !1
                }), i.on("blur.autocomplete", function() {
                    try {
                        over_sb = t(".autocomplete-suggestions:hover").length
                    } catch (e) {
                        over_sb = 0
                    }
                    over_sb ? i.is(":focus") || setTimeout(function() {
                        i.focus()
                    }, 20) : (i.last_val = i.val(), i.sc.hide(), setTimeout(function() {
                        i.sc.hide()
                    }, 350))
                }), n.minChars || i.on("focus.autocomplete", function() {
                    i.last_val = "\n", i.trigger("keyup.autocomplete")
                }), i.on("keydown.autocomplete", function(e) {
                    if ((40 == e.which || 38 == e.which) && i.sc.html()) {
                        var o, a = t(".autocomplete-suggestion.selected", i.sc);
                        return a.length ? (o = 40 == e.which ? a.next(".autocomplete-suggestion") : a.prev(".autocomplete-suggestion"), o.length ? (a.removeClass("selected"), i.val(o.addClass("selected").data("val"))) : (a.removeClass("selected"), i.val(i.last_val), o = 0)) : (o = 40 == e.which ? t(".autocomplete-suggestion", i.sc).first() : t(".autocomplete-suggestion", i.sc).last(), i.val(o.addClass("selected").data("val"))), i.updateSC(0, o), !1
                    }
                    if (27 == e.which) i.val(i.last_val).sc.hide();
                    else if (13 == e.which || 9 == e.which) {
                        var a = t(".autocomplete-suggestion.selected", i.sc);
                        a.length && i.sc.is(":visible") && (n.onSelect(e, a.data("val"), a), setTimeout(function() {
                            i.sc.hide()
                        }, 20))
                    }
                }), i.on("keyup.autocomplete", function(o) {
                    if (!~t.inArray(o.which, [13, 27, 35, 36, 37, 38, 39, 40])) {
                        var a = i.val();
                        if (a.length >= n.minChars) {
                            if (a != i.last_val) {
                                if (i.last_val = a, clearTimeout(i.timer), n.cache) {
                                    if (a in i.cache) return void e(i.cache[a]);
                                    for (var r = 1; r < a.length - n.minChars; r++) {
                                        var s = a.slice(0, a.length - r);
                                        if (s in i.cache && !i.cache[s].length) return void e([])
                                    }
                                }
                                i.timer = setTimeout(function() {
                                    n.source(a, e)
                                }, n.delay)
                            }
                        } else i.last_val = a, i.sc.hide()
                    }
                })
            })
        }, t.fn.autoComplete.defaults = {
            source: 0,
            minChars: 3,
            delay: 150,
            cache: 1,
            menuClass: "",
            renderItem: function(t, e) {
                e = e.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
                var n = new RegExp("(" + e.split(" ").join("|") + ")", "gi");
                return '<div class="autocomplete-suggestion" data-val="' + t + '">' + t.replace(n, "<b>$1</b>") + "</div>"
            },
            onSelect: function(t, e, n) {}
        }
    }(jQuery), ! function(t) {
        "use strict";
        "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
    }(function(t) {
        "use strict";

        function e(t) {
            if (t instanceof Date) return t;
            if (String(t).match(r)) return String(t).match(/^[0-9]*$/) && (t = Number(t)), String(t).match(/\-/) && (t = String(t).replace(/\-/g, "/")), new Date(t);
            throw new Error("Couldn't cast `" + t + "` to a date object.")
        }

        function n(t) {
            var e = t.toString().replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
            return new RegExp(e)
        }

        function i(t) {
            return function(e) {
                var i = e.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
                if (i)
                    for (var a = 0, r = i.length; r > a; ++a) {
                        var s = i[a].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),
                            c = n(s[0]),
                            d = s[1] || "",
                            u = s[3] || "",
                            p = null;
                        s = s[2], l.hasOwnProperty(s) && (p = l[s], p = Number(t[p])), null !== p && ("!" === d && (p = o(u, p)), "" === d && 10 > p && (p = "0" + p.toString()), e = e.replace(c, p.toString()))
                    }
                return e = e.replace(/%%/, "%")
            }
        }

        function o(t, e) {
            var n = "s",
                i = "";
            return t && (t = t.replace(/(:|;|\s)/gi, "").split(/\,/), 1 === t.length ? n = t[0] : (i = t[0], n = t[1])), 1 === Math.abs(e) ? i : n
        }
        var a = [],
            r = [],
            s = {
                precision: 100,
                elapse: !1
            };
        r.push(/^[0-9]*$/.source), r.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), r.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), r = new RegExp(r.join("|"));
        var l = {
                Y: "years",
                m: "months",
                n: "daysToMonth",
                w: "weeks",
                d: "daysToWeek",
                D: "totalDays",
                H: "hours",
                M: "minutes",
                S: "seconds"
            },
            c = function(e, n, i) {
                this.el = e, this.$el = t(e), this.interval = null, this.offset = {}, this.options = t.extend({}, s), this.instanceNumber = a.length, a.push(this), this.$el.data("countdown-instance", this.instanceNumber), i && ("function" == typeof i ? (this.$el.on("update.countdown", i), this.$el.on("stoped.countdown", i), this.$el.on("finish.countdown", i)) : this.options = t.extend({}, s, i)), this.setFinalDate(n), this.start()
            };
        t.extend(c.prototype, {
            start: function() {
                null !== this.interval && clearInterval(this.interval);
                var t = this;
                this.update(), this.interval = setInterval(function() {
                    t.update.call(t)
                }, this.options.precision)
            },
            stop: function() {
                clearInterval(this.interval), this.interval = null, this.dispatchEvent("stoped")
            },
            toggle: function() {
                this.interval ? this.stop() : this.start()
            },
            pause: function() {
                this.stop()
            },
            resume: function() {
                this.start()
            },
            remove: function() {
                this.stop.call(this), a[this.instanceNumber] = null, delete this.$el.data().countdownInstance
            },
            setFinalDate: function(t) {
                this.finalDate = e(t)
            },
            update: function() {
                if (0 === this.$el.closest("html").length) return void this.remove();
                var e, n = void 0 !== t._data(this.el, "events"),
                    i = new Date;
                e = this.finalDate.getTime() - i.getTime(), e = Math.ceil(e / 1e3), e = !this.options.elapse && 0 > e ? 0 : Math.abs(e), this.totalSecsLeft !== e && n && (this.totalSecsLeft = e, this.elapsed = i >= this.finalDate, this.offset = {
                    seconds: this.totalSecsLeft % 60,
                    minutes: Math.floor(this.totalSecsLeft / 60) % 60,
                    hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
                    days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                    daysToWeek: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                    daysToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 % 30.4368),
                    totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
                    weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
                    months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30.4368),
                    years: Math.abs(this.finalDate.getFullYear() - i.getFullYear())
                }, this.options.elapse || 0 !== this.totalSecsLeft ? this.dispatchEvent("update") : (this.stop(), this.dispatchEvent("finish")))
            },
            dispatchEvent: function(e) {
                var n = t.Event(e + ".countdown");
                n.finalDate = this.finalDate, n.elapsed = this.elapsed, n.offset = t.extend({}, this.offset), n.strftime = i(this.offset), this.$el.trigger(n)
            }
        }), t.fn.countdown = function() {
            var e = Array.prototype.slice.call(arguments, 0);
            return this.each(function() {
                var n = t(this).data("countdown-instance");
                if (void 0 !== n) {
                    var i = a[n],
                        o = e[0];
                    c.prototype.hasOwnProperty(o) ? i[o].apply(i, e.slice(1)) : null === String(o).match(/^[$A-Z_][0-9A-Z_$]*$/i) ? (i.setFinalDate.call(i, o), i.start()) : t.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, o))
                } else new c(this, e[0], e[1])
            })
        }
    }),
    function(t) {
        function e(t, e) {
            this.bearer = t, this.options = e, this.hideEvent, this.mouseOverMode = "hover" == this.options.trigger || "mouseover" == this.options.trigger || "onmouseover" == this.options.trigger
        }
        e.prototype = {
            show: function() {
                var t = this;
                this.options.modal && this.modalLayer.css("display", "block"), this.tooltip.css("display", "block"), t.mouseOverMode && (this.tooltip.mouseover(function() {
                    clearTimeout(t.hideEvent)
                }), this.tooltip.mouseout(function() {
                    clearTimeout(t.hideEvent), t.hide()
                }))
            },
            hide: function() {
                var t = this;
                this.hideEvent = setTimeout(function() {
                    t.tooltip.hide()
                }, 100), t.options.modal && t.modalLayer.hide(), this.options.onClose()
            },
            toggle: function() {
                this.tooltip.is(":visible") ? this.hide() : this.show()
            },
            addAnimation: function() {
                switch (this.options.animation) {
                    case "none":
                        break;
                    case "fadeIn":
                        this.tooltip.addClass("animated"), this.tooltip.addClass("fadeIn");
                        break;
                    case "flipIn":
                        this.tooltip.addClass("animated"), this.tooltip.addClass("flipIn")
                }
            },
            setContent: function() {
                if (t(this.bearer).css("cursor", "pointer"), this.options.content) this.content = this.options.content;
                else {
                    if (!this.bearer.attr("data-tooltip")) return;
                    this.content = this.bearer.attr("data-tooltip")
                }
                if ("#" == this.content.charAt(0)) {
                    if (this.options.delete_content) {
                        var e = t(this.content).html();
                        t(this.content).html(""), this.content = e, delete e
                    } else t(this.content).hide(), this.content = t(this.content).html();
                    this.contentType = "html"
                } else this.contentType = "text";
                tooltipId = "", "" != this.bearer.attr("id") && (tooltipId = "id='darktooltip-" + this.bearer.attr("id") + "'"), this.modalLayer = t("<ins class='darktooltip-modal-layer'></ins>"), this.tooltip = t("<ins " + tooltipId + " class = 'dark-tooltip " + this.options.theme + " " + this.options.size + " " + this.options.gravity + "'><div>" + this.content + "</div><div class = 'tip'></div></ins>"), this.tip = this.tooltip.find(".tip"), t("body").append(this.modalLayer), t("body").append(this.tooltip), "html" == this.contentType && this.tooltip.css("max-width", "none"), this.tooltip.css("opacity", this.options.opacity), this.addAnimation(), this.options.confirm && this.addConfirm()
            },
            setPositions: function() {
                var t = this.bearer.offset().left,
                    e = this.bearer.offset().top;
                switch (this.options.gravity) {
                    case "south":
                        t += this.bearer.outerWidth() / 2 - this.tooltip.outerWidth() / 2, e += -this.tooltip.outerHeight() - this.tip.outerHeight() / 2;
                        break;
                    case "west":
                        t += this.bearer.outerWidth() + this.tip.outerWidth() / 2, e += this.bearer.outerHeight() / 2 - this.tooltip.outerHeight() / 2;
                        break;
                    case "north":
                        t += this.bearer.outerWidth() / 2 - this.tooltip.outerWidth() / 2, e += this.bearer.outerHeight() + this.tip.outerHeight() / 2;
                        break;
                    case "east":
                        t += -this.tooltip.outerWidth() - this.tip.outerWidth() / 2, e += this.bearer.outerHeight() / 2 - this.tooltip.outerHeight() / 2
                }
                this.options.autoLeft && this.tooltip.css("left", t), this.options.autoTop && this.tooltip.css("top", e)
            },
            setEvents: function() {
                var e, n = this,
                    i = n.options.hoverDelay;
                n.mouseOverMode ? this.bearer.mouseenter(function() {
                    e = setTimeout(function() {
                        n.setPositions(), n.show()
                    }, i)
                }).mouseleave(function() {
                    clearTimeout(e), n.hide()
                }) : "click" != this.options.trigger && "onclik" != this.options.trigger || (this.tooltip.click(function(t) {
                    t.stopPropagation()
                }), this.bearer.click(function(t) {
                    t.preventDefault(), n.setPositions(), n.toggle(), t.stopPropagation()
                }), t("html").click(function() {
                    n.hide()
                }))
            },
            activate: function() {
                this.setContent(), this.content && this.setEvents()
            },
            addConfirm: function() {
                this.tooltip.append("<ul class = 'confirm'><li class = 'darktooltip-yes'>" + this.options.yes + "</li><li class = 'darktooltip-no'>" + this.options.no + "</li></ul>"), this.setConfirmEvents()
            },
            setConfirmEvents: function() {
                var t = this;
                this.tooltip.find("li.darktooltip-yes").click(function(e) {
                    t.onYes(), e.stopPropagation()
                }), this.tooltip.find("li.darktooltip-no").click(function(e) {
                    t.onNo(), e.stopPropagation()
                })
            },
            finalMessage: function() {
                if (this.options.finalMessage) {
                    var t = this;
                    t.tooltip.find("div:first").html(this.options.finalMessage), t.tooltip.find("ul").remove(), t.setPositions(), setTimeout(function() {
                        t.hide(), t.setContent()
                    }, t.options.finalMessageDuration)
                } else this.hide()
            },
            onYes: function() {
                this.options.onYes(this.bearer), this.finalMessage()
            },
            onNo: function() {
                this.options.onNo(this.bearer), this.hide()
            }
        }, t.fn.darkTooltip = function(n) {
            return this.each(function() {
                n = t.extend({}, t.fn.darkTooltip.defaults, n);
                var i = new e(t(this), n);
                i.activate()
            })
        }, t.fn.darkTooltip.defaults = {
            animation: "none",
            confirm: !1,
            content: "",
            finalMessage: "",
            finalMessageDuration: 1e3,
            gravity: "south",
            hoverDelay: 0,
            modal: !1,
            no: "No",
            onNo: function() {},
            onYes: function() {},
            opacity: .9,
            size: "medium",
            theme: "dark",
            trigger: "hover",
            yes: "Yes",
            autoTop: !0,
            autoLeft: !0,
            onClose: function() {}
        }
    }(jQuery),
    function(t) {
        t.fn.liveFilter = function(e, n, i) {
            var o = {
                    filterChildSelector: null,
                    filter: function(e, n) {
                        return t(e).text().toUpperCase().indexOf(n.toUpperCase()) >= 0
                    },
                    before: function() {},
                    after: function() {}
                },
                i = t.extend(o, i),
                a = t(this).find(n);
            i.filterChildSelector && (a = a.find(i.filterChildSelector));
            var r = i.filter;
            t(e).keyup(function() {
                var e = t(this).val(),
                    o = a.filter(function() {
                        return r(this, e)
                    }),
                    s = a.not(o);
                i.filterChildSelector && (o = o.parents(n), s = s.parents(n).hide()), i.before.call(this, o, s), o.show(), s.hide(), "" === e && (o.show(), s.show()), i.after.call(this, o, s)
            })
        }
    }(jQuery), ! function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : t("object" == typeof exports ? require("jquery") : window.jQuery || window.Zepto)
    }(function(t) {
        var e, n, i, o, a, r, s = "Close",
            l = "BeforeClose",
            c = "AfterClose",
            d = "BeforeAppend",
            u = "MarkupParse",
            p = "Open",
            h = "Change",
            f = "mfp",
            m = "." + f,
            g = "mfp-ready",
            v = "mfp-removing",
            y = "mfp-prevent-close",
            w = function() {},
            b = !!window.jQuery,
            x = t(window),
            C = function(t, n) {
                e.ev.on(f + t + m, n)
            },
            T = function(e, n, i, o) {
                var a = document.createElement("div");
                return a.className = "mfp-" + e, i && (a.innerHTML = i), o ? n && n.appendChild(a) : (a = t(a), n && a.appendTo(n)), a
            },
            S = function(n, i) {
                e.ev.triggerHandler(f + n, i), e.st.callbacks && (n = n.charAt(0).toLowerCase() + n.slice(1), e.st.callbacks[n] && e.st.callbacks[n].apply(e, t.isArray(i) ? i : [i]))
            },
            _ = function(n) {
                return n === r && e.currTemplate.closeBtn || (e.currTemplate.closeBtn = t(e.st.closeMarkup.replace("%title%", e.st.tClose)), r = n), e.currTemplate.closeBtn
            },
            k = function() {
                t.magnificPopup.instance || (e = new w, e.init(), t.magnificPopup.instance = e)
            },
            E = function() {
                var t = document.createElement("p").style,
                    e = ["ms", "O", "Moz", "Webkit"];
                if (void 0 !== t.transition) return !0;
                for (; e.length;)
                    if (e.pop() + "Transition" in t) return !0;
                return !1
            };
        w.prototype = {
            constructor: w,
            init: function() {
                var n = navigator.appVersion;
                e.isLowIE = e.isIE8 = document.all && !document.addEventListener, e.isAndroid = /android/gi.test(n), e.isIOS = /iphone|ipad|ipod/gi.test(n), e.supportsTransition = E(), e.probablyMobile = e.isAndroid || e.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent), i = t(document), e.popupsCache = {}
            },
            open: function(n) {
                var o;
                if (n.isObj === !1) {
                    e.items = n.items.toArray(), e.index = 0;
                    var r, s = n.items;
                    for (o = 0; o < s.length; o++)
                        if (r = s[o], r.parsed && (r = r.el[0]), r === n.el[0]) {
                            e.index = o;
                            break
                        }
                } else e.items = t.isArray(n.items) ? n.items : [n.items], e.index = n.index || 0;
                if (e.isOpen) return void e.updateItemHTML();
                e.types = [], a = "", n.mainEl && n.mainEl.length ? e.ev = n.mainEl.eq(0) : e.ev = i, n.key ? (e.popupsCache[n.key] || (e.popupsCache[n.key] = {}), e.currTemplate = e.popupsCache[n.key]) : e.currTemplate = {}, e.st = t.extend(!0, {}, t.magnificPopup.defaults, n), e.fixedContentPos = "auto" === e.st.fixedContentPos ? !e.probablyMobile : e.st.fixedContentPos, e.st.modal && (e.st.closeOnContentClick = !1, e.st.closeOnBgClick = !1, e.st.showCloseBtn = !1, e.st.enableEscapeKey = !1), e.bgOverlay || (e.bgOverlay = T("bg").on("click" + m, function() {
                    e.close()
                }), e.wrap = T("wrap").attr("tabindex", -1).on("click" + m, function(t) {
                    e._checkIfClose(t.target) && e.close()
                }), e.container = T("container", e.wrap)), e.contentContainer = T("content"), e.st.preloader && (e.preloader = T("preloader", e.container, e.st.tLoading));
                var l = t.magnificPopup.modules;
                for (o = 0; o < l.length; o++) {
                    var c = l[o];
                    c = c.charAt(0).toUpperCase() + c.slice(1), e["init" + c].call(e)
                }
                S("BeforeOpen"), e.st.showCloseBtn && (e.st.closeBtnInside ? (C(u, function(t, e, n, i) {
                    n.close_replaceWith = _(i.type)
                }), a += " mfp-close-btn-in") : e.wrap.append(_())), e.st.alignTop && (a += " mfp-align-top"), e.fixedContentPos ? e.wrap.css({
                    overflow: e.st.overflowY,
                    overflowX: "hidden",
                    overflowY: e.st.overflowY
                }) : e.wrap.css({
                    top: x.scrollTop(),
                    position: "absolute"
                }), (e.st.fixedBgPos === !1 || "auto" === e.st.fixedBgPos && !e.fixedContentPos) && e.bgOverlay.css({
                    height: i.height(),
                    position: "absolute"
                }), e.st.enableEscapeKey && i.on("keyup" + m, function(t) {
                    27 === t.keyCode && e.close()
                }), x.on("resize" + m, function() {
                    e.updateSize()
                }), e.st.closeOnContentClick || (a += " mfp-auto-cursor"), a && e.wrap.addClass(a);
                var d = e.wH = x.height(),
                    h = {};
                if (e.fixedContentPos && e._hasScrollBar(d)) {
                    var f = e._getScrollbarSize();
                    f && (h.marginRight = f)
                }
                e.fixedContentPos && (e.isIE7 ? t("body, html").css("overflow", "hidden") : h.overflow = "hidden");
                var v = e.st.mainClass;
                return e.isIE7 && (v += " mfp-ie7"), v && e._addClassToMFP(v), e.updateItemHTML(), S("BuildControls"), t("html").css(h), e.bgOverlay.add(e.wrap).prependTo(e.st.prependTo || t(document.body)), e._lastFocusedEl = document.activeElement, setTimeout(function() {
                    e.content ? (e._addClassToMFP(g), e._setFocus()) : e.bgOverlay.addClass(g), i.on("focusin" + m, e._onFocusIn)
                }, 16), e.isOpen = !0, e.updateSize(d), S(p), n
            },
            close: function() {
                e.isOpen && (S(l), e.isOpen = !1, e.st.removalDelay && !e.isLowIE && e.supportsTransition ? (e._addClassToMFP(v), setTimeout(function() {
                    e._close()
                }, e.st.removalDelay)) : e._close())
            },
            _close: function() {
                S(s);
                var n = v + " " + g + " ";
                if (e.bgOverlay.detach(), e.wrap.detach(), e.container.empty(), e.st.mainClass && (n += e.st.mainClass + " "), e._removeClassFromMFP(n), e.fixedContentPos) {
                    var o = {
                        marginRight: ""
                    };
                    e.isIE7 ? t("body, html").css("overflow", "") : o.overflow = "", t("html").css(o)
                }
                i.off("keyup" + m + " focusin" + m), e.ev.off(m), e.wrap.attr("class", "mfp-wrap").removeAttr("style"), e.bgOverlay.attr("class", "mfp-bg"), e.container.attr("class", "mfp-container"), !e.st.showCloseBtn || e.st.closeBtnInside && e.currTemplate[e.currItem.type] !== !0 || e.currTemplate.closeBtn && e.currTemplate.closeBtn.detach(), e.st.autoFocusLast && e._lastFocusedEl && t(e._lastFocusedEl).focus(), e.currItem = null, e.content = null, e.currTemplate = null, e.prevHeight = 0, S(c)
            },
            updateSize: function(t) {
                if (e.isIOS) {
                    var n = document.documentElement.clientWidth / window.innerWidth,
                        i = window.innerHeight * n;
                    e.wrap.css("height", i), e.wH = i
                } else e.wH = t || x.height();
                e.fixedContentPos || e.wrap.css("height", e.wH), S("Resize")
            },
            updateItemHTML: function() {
                var n = e.items[e.index];
                e.contentContainer.detach(), e.content && e.content.detach(), n.parsed || (n = e.parseEl(e.index));
                var i = n.type;
                if (S("BeforeChange", [e.currItem ? e.currItem.type : "", i]), e.currItem = n, !e.currTemplate[i]) {
                    var a = !!e.st[i] && e.st[i].markup;
                    S("FirstMarkupParse", a), a ? e.currTemplate[i] = t(a) : e.currTemplate[i] = !0
                }
                o && o !== n.type && e.container.removeClass("mfp-" + o + "-holder");
                var r = e["get" + i.charAt(0).toUpperCase() + i.slice(1)](n, e.currTemplate[i]);
                e.appendContent(r, i), n.preloaded = !0, S(h, n), o = n.type, e.container.prepend(e.contentContainer),
                    S("AfterChange")
            },
            appendContent: function(t, n) {
                e.content = t, t ? e.st.showCloseBtn && e.st.closeBtnInside && e.currTemplate[n] === !0 ? e.content.find(".mfp-close").length || e.content.append(_()) : e.content = t : e.content = "", S(d), e.container.addClass("mfp-" + n + "-holder"), e.contentContainer.append(e.content)
            },
            parseEl: function(n) {
                var i, o = e.items[n];
                if (o.tagName ? o = {
                        el: t(o)
                    } : (i = o.type, o = {
                        data: o,
                        src: o.src
                    }), o.el) {
                    for (var a = e.types, r = 0; r < a.length; r++)
                        if (o.el.hasClass("mfp-" + a[r])) {
                            i = a[r];
                            break
                        }
                    o.src = o.el.attr("data-mfp-src"), o.src || (o.src = o.el.attr("href"))
                }
                return o.type = i || e.st.type || "inline", o.index = n, o.parsed = !0, e.items[n] = o, S("ElementParse", o), e.items[n]
            },
            addGroup: function(t, n) {
                var i = function(i) {
                    i.mfpEl = this, e._openClick(i, t, n)
                };
                n || (n = {});
                var o = "click.magnificPopup";
                n.mainEl = t, n.items ? (n.isObj = !0, t.off(o).on(o, i)) : (n.isObj = !1, n.delegate ? t.off(o).on(o, n.delegate, i) : (n.items = t, t.off(o).on(o, i)))
            },
            _openClick: function(n, i, o) {
                var a = void 0 !== o.midClick ? o.midClick : t.magnificPopup.defaults.midClick;
                if (a || !(2 === n.which || n.ctrlKey || n.metaKey || n.altKey || n.shiftKey)) {
                    var r = void 0 !== o.disableOn ? o.disableOn : t.magnificPopup.defaults.disableOn;
                    if (r)
                        if (t.isFunction(r)) {
                            if (!r.call(e)) return !0
                        } else if (x.width() < r) return !0;
                    n.type && (n.preventDefault(), e.isOpen && n.stopPropagation()), o.el = t(n.mfpEl), o.delegate && (o.items = i.find(o.delegate)), e.open(o)
                }
            },
            updateStatus: function(t, i) {
                if (e.preloader) {
                    n !== t && e.container.removeClass("mfp-s-" + n), i || "loading" !== t || (i = e.st.tLoading);
                    var o = {
                        status: t,
                        text: i
                    };
                    S("UpdateStatus", o), t = o.status, i = o.text, e.preloader.html(i), e.preloader.find("a").on("click", function(t) {
                        t.stopImmediatePropagation()
                    }), e.container.addClass("mfp-s-" + t), n = t
                }
            },
            _checkIfClose: function(n) {
                if (!t(n).hasClass(y)) {
                    var i = e.st.closeOnContentClick,
                        o = e.st.closeOnBgClick;
                    if (i && o) return !0;
                    if (!e.content || t(n).hasClass("mfp-close") || e.preloader && n === e.preloader[0]) return !0;
                    if (n === e.content[0] || t.contains(e.content[0], n)) {
                        if (i) return !0
                    } else if (o && t.contains(document, n)) return !0;
                    return !1
                }
            },
            _addClassToMFP: function(t) {
                e.bgOverlay.addClass(t), e.wrap.addClass(t)
            },
            _removeClassFromMFP: function(t) {
                this.bgOverlay.removeClass(t), e.wrap.removeClass(t)
            },
            _hasScrollBar: function(t) {
                return (e.isIE7 ? i.height() : document.body.scrollHeight) > (t || x.height())
            },
            _setFocus: function() {
                (e.st.focus ? e.content.find(e.st.focus).eq(0) : e.wrap).focus()
            },
            _onFocusIn: function(n) {
                return n.target === e.wrap[0] || t.contains(e.wrap[0], n.target) ? void 0 : (e._setFocus(), !1)
            },
            _parseMarkup: function(e, n, i) {
                var o;
                i.data && (n = t.extend(i.data, n)), S(u, [e, n, i]), t.each(n, function(n, i) {
                    if (void 0 === i || i === !1) return !0;
                    if (o = n.split("_"), o.length > 1) {
                        var a = e.find(m + "-" + o[0]);
                        if (a.length > 0) {
                            var r = o[1];
                            "replaceWith" === r ? a[0] !== i[0] && a.replaceWith(i) : "img" === r ? a.is("img") ? a.attr("src", i) : a.replaceWith(t("<img>").attr("src", i).attr("class", a.attr("class"))) : a.attr(o[1], i)
                        }
                    } else e.find(m + "-" + n).html(i)
                })
            },
            _getScrollbarSize: function() {
                if (void 0 === e.scrollbarSize) {
                    var t = document.createElement("div");
                    t.style.cssText = "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;", document.body.appendChild(t), e.scrollbarSize = t.offsetWidth - t.clientWidth, document.body.removeChild(t)
                }
                return e.scrollbarSize
            }
        }, t.magnificPopup = {
            instance: null,
            proto: w.prototype,
            modules: [],
            open: function(e, n) {
                return k(), e = e ? t.extend(!0, {}, e) : {}, e.isObj = !0, e.index = n || 0, this.instance.open(e)
            },
            close: function() {
                return t.magnificPopup.instance && t.magnificPopup.instance.close()
            },
            registerModule: function(e, n) {
                n.options && (t.magnificPopup.defaults[e] = n.options), t.extend(this.proto, n.proto), this.modules.push(e)
            },
            defaults: {
                disableOn: 0,
                key: null,
                midClick: !1,
                mainClass: "",
                preloader: !0,
                focus: "",
                closeOnContentClick: !1,
                closeOnBgClick: !0,
                closeBtnInside: !0,
                showCloseBtn: !0,
                enableEscapeKey: !0,
                modal: !1,
                alignTop: !1,
                removalDelay: 0,
                prependTo: null,
                fixedContentPos: "auto",
                fixedBgPos: "auto",
                overflowY: "auto",
                closeMarkup: '<button title="%title%" type="button" class="mfp-close">&#215;</button>',
                tClose: "Close (Esc)",
                tLoading: "Loading...",
                autoFocusLast: !0
            }
        }, t.fn.magnificPopup = function(n) {
            k();
            var i = t(this);
            if ("string" == typeof n)
                if ("open" === n) {
                    var o, a = b ? i.data("magnificPopup") : i[0].magnificPopup,
                        r = parseInt(arguments[1], 10) || 0;
                    a.items ? o = a.items[r] : (o = i, a.delegate && (o = o.find(a.delegate)), o = o.eq(r)), e._openClick({
                        mfpEl: o
                    }, i, a)
                } else e.isOpen && e[n].apply(e, Array.prototype.slice.call(arguments, 1));
            else n = t.extend(!0, {}, n), b ? i.data("magnificPopup", n) : i[0].magnificPopup = n, e.addGroup(i, n);
            return i
        };
        var D, M, O, I = "inline",
            A = function() {
                O && (M.after(O.addClass(D)).detach(), O = null)
            };
        t.magnificPopup.registerModule(I, {
            options: {
                hiddenClass: "hide",
                markup: "",
                tNotFound: "Content not found"
            },
            proto: {
                initInline: function() {
                    e.types.push(I), C(s + "." + I, function() {
                        A()
                    })
                },
                getInline: function(n, i) {
                    if (A(), n.src) {
                        var o = e.st.inline,
                            a = t(n.src);
                        if (a.length) {
                            var r = a[0].parentNode;
                            r && r.tagName && (M || (D = o.hiddenClass, M = T(D), D = "mfp-" + D), O = a.after(M).detach().removeClass(D)), e.updateStatus("ready")
                        } else e.updateStatus("error", o.tNotFound), a = t("<div>");
                        return n.inlineElement = a, a
                    }
                    return e.updateStatus("ready"), e._parseMarkup(i, {}, n), i
                }
            }
        });
        var N, P = "ajax",
            z = function() {
                N && t(document.body).removeClass(N)
            },
            L = function() {
                z(), e.req && e.req.abort()
            };
        t.magnificPopup.registerModule(P, {
            options: {
                settings: null,
                cursor: "mfp-ajax-cur",
                tError: '<a href="%url%">The content</a> could not be loaded.'
            },
            proto: {
                initAjax: function() {
                    e.types.push(P), N = e.st.ajax.cursor, C(s + "." + P, L), C("BeforeChange." + P, L)
                },
                getAjax: function(n) {
                    N && t(document.body).addClass(N), e.updateStatus("loading");
                    var i = t.extend({
                        url: n.src,
                        success: function(i, o, a) {
                            var r = {
                                data: i,
                                xhr: a
                            };
                            S("ParseAjax", r), e.appendContent(t(r.data), P), n.finished = !0, z(), e._setFocus(), setTimeout(function() {
                                e.wrap.addClass(g)
                            }, 16), e.updateStatus("ready"), S("AjaxContentAdded")
                        },
                        error: function() {
                            z(), n.finished = n.loadError = !0, e.updateStatus("error", e.st.ajax.tError.replace("%url%", n.src))
                        }
                    }, e.st.ajax.settings);
                    return e.req = t.ajax(i), ""
                }
            }
        });
        var $, B = function(n) {
            if (n.data && void 0 !== n.data.title) return n.data.title;
            var i = e.st.image.titleSrc;
            if (i) {
                if (t.isFunction(i)) return i.call(e, n);
                if (n.el) return n.el.attr(i) || ""
            }
            return ""
        };
        t.magnificPopup.registerModule("image", {
            options: {
                markup: '<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',
                cursor: "mfp-zoom-out-cur",
                titleSrc: "title",
                verticalFit: !0,
                tError: '<a href="%url%">The image</a> could not be loaded.'
            },
            proto: {
                initImage: function() {
                    var n = e.st.image,
                        i = ".image";
                    e.types.push("image"), C(p + i, function() {
                        "image" === e.currItem.type && n.cursor && t(document.body).addClass(n.cursor)
                    }), C(s + i, function() {
                        n.cursor && t(document.body).removeClass(n.cursor), x.off("resize" + m)
                    }), C("Resize" + i, e.resizeImage), e.isLowIE && C("AfterChange", e.resizeImage)
                },
                resizeImage: function() {
                    var t = e.currItem;
                    if (t && t.img && e.st.image.verticalFit) {
                        var n = 0;
                        e.isLowIE && (n = parseInt(t.img.css("padding-top"), 10) + parseInt(t.img.css("padding-bottom"), 10)), t.img.css("max-height", e.wH - n)
                    }
                },
                _onImageHasSize: function(t) {
                    t.img && (t.hasSize = !0, $ && clearInterval($), t.isCheckingImgSize = !1, S("ImageHasSize", t), t.imgHidden && (e.content && e.content.removeClass("mfp-loading"), t.imgHidden = !1))
                },
                findImageSize: function(t) {
                    var n = 0,
                        i = t.img[0],
                        o = function(a) {
                            $ && clearInterval($), $ = setInterval(function() {
                                return i.naturalWidth > 0 ? void e._onImageHasSize(t) : (n > 200 && clearInterval($), n++, void(3 === n ? o(10) : 40 === n ? o(50) : 100 === n && o(500)))
                            }, a)
                        };
                    o(1)
                },
                getImage: function(n, i) {
                    var o = 0,
                        a = function() {
                            n && (n.img[0].complete ? (n.img.off(".mfploader"), n === e.currItem && (e._onImageHasSize(n), e.updateStatus("ready")), n.hasSize = !0, n.loaded = !0, S("ImageLoadComplete")) : (o++, 200 > o ? setTimeout(a, 100) : r()))
                        },
                        r = function() {
                            n && (n.img.off(".mfploader"), n === e.currItem && (e._onImageHasSize(n), e.updateStatus("error", s.tError.replace("%url%", n.src))), n.hasSize = !0, n.loaded = !0, n.loadError = !0)
                        },
                        s = e.st.image,
                        l = i.find(".mfp-img");
                    if (l.length) {
                        var c = document.createElement("img");
                        c.className = "mfp-img", n.el && n.el.find("img").length && (c.alt = n.el.find("img").attr("alt")), n.img = t(c).on("load.mfploader", a).on("error.mfploader", r), c.src = n.src, l.is("img") && (n.img = n.img.clone()), c = n.img[0], c.naturalWidth > 0 ? n.hasSize = !0 : c.width || (n.hasSize = !1)
                    }
                    return e._parseMarkup(i, {
                        title: B(n),
                        img_replaceWith: n.img
                    }, n), e.resizeImage(), n.hasSize ? ($ && clearInterval($), n.loadError ? (i.addClass("mfp-loading"), e.updateStatus("error", s.tError.replace("%url%", n.src))) : (i.removeClass("mfp-loading"), e.updateStatus("ready")), i) : (e.updateStatus("loading"), n.loading = !0, n.hasSize || (n.imgHidden = !0, i.addClass("mfp-loading"), e.findImageSize(n)), i)
                }
            }
        });
        var F, H = function() {
            return void 0 === F && (F = void 0 !== document.createElement("p").style.MozTransform), F
        };
        t.magnificPopup.registerModule("zoom", {
            options: {
                enabled: !1,
                easing: "ease-in-out",
                duration: 300,
                opener: function(t) {
                    return t.is("img") ? t : t.find("img")
                }
            },
            proto: {
                initZoom: function() {
                    var t, n = e.st.zoom,
                        i = ".zoom";
                    if (n.enabled && e.supportsTransition) {
                        var o, a, r = n.duration,
                            c = function(t) {
                                var e = t.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),
                                    i = "all " + n.duration / 1e3 + "s " + n.easing,
                                    o = {
                                        position: "fixed",
                                        zIndex: 9999,
                                        left: 0,
                                        top: 0,
                                        "-webkit-backface-visibility": "hidden"
                                    },
                                    a = "transition";
                                return o["-webkit-" + a] = o["-moz-" + a] = o["-o-" + a] = o[a] = i, e.css(o), e
                            },
                            d = function() {
                                e.content.css("visibility", "visible")
                            };
                        C("BuildControls" + i, function() {
                            if (e._allowZoom()) {
                                if (clearTimeout(o), e.content.css("visibility", "hidden"), t = e._getItemToZoom(), !t) return void d();
                                a = c(t), a.css(e._getOffset()), e.wrap.append(a), o = setTimeout(function() {
                                    a.css(e._getOffset(!0)), o = setTimeout(function() {
                                        d(), setTimeout(function() {
                                            a.remove(), t = a = null, S("ZoomAnimationEnded")
                                        }, 16)
                                    }, r)
                                }, 16)
                            }
                        }), C(l + i, function() {
                            if (e._allowZoom()) {
                                if (clearTimeout(o), e.st.removalDelay = r, !t) {
                                    if (t = e._getItemToZoom(), !t) return;
                                    a = c(t)
                                }
                                a.css(e._getOffset(!0)), e.wrap.append(a), e.content.css("visibility", "hidden"), setTimeout(function() {
                                    a.css(e._getOffset())
                                }, 16)
                            }
                        }), C(s + i, function() {
                            e._allowZoom() && (d(), a && a.remove(), t = null)
                        })
                    }
                },
                _allowZoom: function() {
                    return "image" === e.currItem.type
                },
                _getItemToZoom: function() {
                    return !!e.currItem.hasSize && e.currItem.img
                },
                _getOffset: function(n) {
                    var i;
                    i = n ? e.currItem.img : e.st.zoom.opener(e.currItem.el || e.currItem);
                    var o = i.offset(),
                        a = parseInt(i.css("padding-top"), 10),
                        r = parseInt(i.css("padding-bottom"), 10);
                    o.top -= t(window).scrollTop() - a;
                    var s = {
                        width: i.width(),
                        height: (b ? i.innerHeight() : i[0].offsetHeight) - r - a
                    };
                    return H() ? s["-moz-transform"] = s.transform = "translate(" + o.left + "px," + o.top + "px)" : (s.left = o.left, s.top = o.top), s
                }
            }
        });
        var j = "iframe",
            R = "//about:blank",
            W = function(t) {
                if (e.currTemplate[j]) {
                    var n = e.currTemplate[j].find("iframe");
                    n.length && (t || (n[0].src = R), e.isIE8 && n.css("display", t ? "block" : "none"))
                }
            };
        t.magnificPopup.registerModule(j, {
            options: {
                markup: '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',
                srcAction: "iframe_src",
                patterns: {
                    youtube: {
                        index: "youtube.com",
                        id: "v=",
                        src: "//www.youtube.com/embed/%id%?autoplay=1"
                    },
                    vimeo: {
                        index: "vimeo.com/",
                        id: "/",
                        src: "//player.vimeo.com/video/%id%?autoplay=1"
                    },
                    gmaps: {
                        index: "//maps.google.",
                        src: "%id%&output=embed"
                    }
                }
            },
            proto: {
                initIframe: function() {
                    e.types.push(j), C("BeforeChange", function(t, e, n) {
                        e !== n && (e === j ? W() : n === j && W(!0))
                    }), C(s + "." + j, function() {
                        W()
                    })
                },
                getIframe: function(n, i) {
                    var o = n.src,
                        a = e.st.iframe;
                    t.each(a.patterns, function() {
                        return o.indexOf(this.index) > -1 ? (this.id && (o = "string" == typeof this.id ? o.substr(o.lastIndexOf(this.id) + this.id.length, o.length) : this.id.call(this, o)), o = this.src.replace("%id%", o), !1) : void 0
                    });
                    var r = {};
                    return a.srcAction && (r[a.srcAction] = o), e._parseMarkup(i, r, n), e.updateStatus("ready"), i
                }
            }
        });
        var U = function(t) {
                var n = e.items.length;
                return t > n - 1 ? t - n : 0 > t ? n + t : t
            },
            q = function(t, e, n) {
                return t.replace(/%curr%/gi, e + 1).replace(/%total%/gi, n)
            };
        t.magnificPopup.registerModule("gallery", {
            options: {
                enabled: !1,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
                preload: [0, 2],
                navigateByImgClick: !0,
                arrows: !0,
                tPrev: "Previous (Left arrow key)",
                tNext: "Next (Right arrow key)",
                tCounter: "%curr% of %total%"
            },
            proto: {
                initGallery: function() {
                    var n = e.st.gallery,
                        o = ".mfp-gallery";
                    return e.direction = !0, !(!n || !n.enabled) && (a += " mfp-gallery", C(p + o, function() {
                        n.navigateByImgClick && e.wrap.on("click" + o, ".mfp-img", function() {
                            return e.items.length > 1 ? (e.next(), !1) : void 0
                        }), i.on("keydown" + o, function(t) {
                            37 === t.keyCode ? e.prev() : 39 === t.keyCode && e.next()
                        })
                    }), C("UpdateStatus" + o, function(t, n) {
                        n.text && (n.text = q(n.text, e.currItem.index, e.items.length))
                    }), C(u + o, function(t, i, o, a) {
                        var r = e.items.length;
                        o.counter = r > 1 ? q(n.tCounter, a.index, r) : ""
                    }), C("BuildControls" + o, function() {
                        if (e.items.length > 1 && n.arrows && !e.arrowLeft) {
                            var i = n.arrowMarkup,
                                o = e.arrowLeft = t(i.replace(/%title%/gi, n.tPrev).replace(/%dir%/gi, "left")).addClass(y),
                                a = e.arrowRight = t(i.replace(/%title%/gi, n.tNext).replace(/%dir%/gi, "right")).addClass(y);
                            o.click(function() {
                                e.prev()
                            }), a.click(function() {
                                e.next()
                            }), e.container.append(o.add(a))
                        }
                    }), C(h + o, function() {
                        e._preloadTimeout && clearTimeout(e._preloadTimeout), e._preloadTimeout = setTimeout(function() {
                            e.preloadNearbyImages(), e._preloadTimeout = null
                        }, 16)
                    }), void C(s + o, function() {
                        i.off(o), e.wrap.off("click" + o), e.arrowRight = e.arrowLeft = null
                    }))
                },
                next: function() {
                    e.direction = !0, e.index = U(e.index + 1), e.updateItemHTML()
                },
                prev: function() {
                    e.direction = !1, e.index = U(e.index - 1), e.updateItemHTML()
                },
                goTo: function(t) {
                    e.direction = t >= e.index, e.index = t, e.updateItemHTML()
                },
                preloadNearbyImages: function() {
                    var t, n = e.st.gallery.preload,
                        i = Math.min(n[0], e.items.length),
                        o = Math.min(n[1], e.items.length);
                    for (t = 1; t <= (e.direction ? o : i); t++) e._preloadItem(e.index + t);
                    for (t = 1; t <= (e.direction ? i : o); t++) e._preloadItem(e.index - t)
                },
                _preloadItem: function(n) {
                    if (n = U(n), !e.items[n].preloaded) {
                        var i = e.items[n];
                        i.parsed || (i = e.parseEl(n)), S("LazyLoad", i), "image" === i.type && (i.img = t('<img class="mfp-img" />').on("load.mfploader", function() {
                            i.hasSize = !0
                        }).on("error.mfploader", function() {
                            i.hasSize = !0, i.loadError = !0, S("LazyLoadError", i)
                        }).attr("src", i.src)), i.preloaded = !0
                    }
                }
            }
        });
        var Y = "retina";
        t.magnificPopup.registerModule(Y, {
            options: {
                replaceSrc: function(t) {
                    return t.src.replace(/\.\w+$/, function(t) {
                        return "@2x" + t
                    })
                },
                ratio: 1
            },
            proto: {
                initRetina: function() {
                    if (window.devicePixelRatio > 1) {
                        var t = e.st.retina,
                            n = t.ratio;
                        n = isNaN(n) ? n() : n, n > 1 && (C("ImageHasSize." + Y, function(t, e) {
                            e.img.css({
                                "max-width": e.img[0].naturalWidth / n,
                                width: "100%"
                            })
                        }), C("ElementParse." + Y, function(e, i) {
                            i.src = t.replaceSrc(i, n)
                        }))
                    }
                }
            }
        }), k()
    }), ! function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : "object" == typeof exports ? module.exports = t : t(jQuery)
    }(function(t) {
        function e(e) {
            var r = e || window.event,
                s = l.call(arguments, 1),
                c = 0,
                u = 0,
                p = 0,
                h = 0,
                f = 0,
                m = 0;
            if (e = t.event.fix(r), e.type = "mousewheel", "detail" in r && (p = -1 * r.detail), "wheelDelta" in r && (p = r.wheelDelta), "wheelDeltaY" in r && (p = r.wheelDeltaY), "wheelDeltaX" in r && (u = -1 * r.wheelDeltaX), "axis" in r && r.axis === r.HORIZONTAL_AXIS && (u = -1 * p, p = 0), c = 0 === p ? u : p, "deltaY" in r && (p = -1 * r.deltaY, c = p), "deltaX" in r && (u = r.deltaX, 0 === p && (c = -1 * u)), 0 !== p || 0 !== u) {
                if (1 === r.deltaMode) {
                    var g = t.data(this, "mousewheel-line-height");
                    c *= g, p *= g, u *= g
                } else if (2 === r.deltaMode) {
                    var v = t.data(this, "mousewheel-page-height");
                    c *= v, p *= v, u *= v
                }
                if (h = Math.max(Math.abs(p), Math.abs(u)), (!a || a > h) && (a = h, i(r, h) && (a /= 40)), i(r, h) && (c /= 40, u /= 40, p /= 40), c = Math[c >= 1 ? "floor" : "ceil"](c / a), u = Math[u >= 1 ? "floor" : "ceil"](u / a), p = Math[p >= 1 ? "floor" : "ceil"](p / a), d.settings.normalizeOffset && this.getBoundingClientRect) {
                    var y = this.getBoundingClientRect();
                    f = e.clientX - y.left, m = e.clientY - y.top
                }
                return e.deltaX = u, e.deltaY = p, e.deltaFactor = a, e.offsetX = f, e.offsetY = m, e.deltaMode = 0, s.unshift(e, c, u, p), o && clearTimeout(o), o = setTimeout(n, 200), (t.event.dispatch || t.event.handle).apply(this, s)
            }
        }

        function n() {
            a = null
        }

        function i(t, e) {
            return d.settings.adjustOldDeltas && "mousewheel" === t.type && e % 120 === 0
        }
        var o, a, r = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
            s = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
            l = Array.prototype.slice;
        if (t.event.fixHooks)
            for (var c = r.length; c;) t.event.fixHooks[r[--c]] = t.event.mouseHooks;
        var d = t.event.special.mousewheel = {
            version: "3.1.12",
            setup: function() {
                if (this.addEventListener)
                    for (var n = s.length; n;) this.addEventListener(s[--n], e, !1);
                else this.onmousewheel = e;
                t.data(this, "mousewheel-line-height", d.getLineHeight(this)), t.data(this, "mousewheel-page-height", d.getPageHeight(this))
            },
            teardown: function() {
                if (this.removeEventListener)
                    for (var n = s.length; n;) this.removeEventListener(s[--n], e, !1);
                else this.onmousewheel = null;
                t.removeData(this, "mousewheel-line-height"), t.removeData(this, "mousewheel-page-height")
            },
            getLineHeight: function(e) {
                var n = t(e),
                    i = n["offsetParent" in t.fn ? "offsetParent" : "parent"]();
                return i.length || (i = t("body")), parseInt(i.css("fontSize"), 10) || parseInt(n.css("fontSize"), 10) || 16
            },
            getPageHeight: function(e) {
                return t(e).height()
            },
            settings: {
                adjustOldDeltas: !0,
                normalizeOffset: !0
            }
        };
        t.fn.extend({
            mousewheel: function(t) {
                return t ? this.bind("mousewheel", t) : this.trigger("mousewheel")
            },
            unmousewheel: function(t) {
                return this.unbind("mousewheel", t)
            }
        })
    }), ! function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : "object" == typeof exports ? module.exports = t : t(jQuery)
    }(function(t) {
        function e(e) {
            var r = e || window.event,
                s = l.call(arguments, 1),
                c = 0,
                u = 0,
                p = 0,
                h = 0,
                f = 0,
                m = 0;
            if (e = t.event.fix(r), e.type = "mousewheel", "detail" in r && (p = -1 * r.detail), "wheelDelta" in r && (p = r.wheelDelta), "wheelDeltaY" in r && (p = r.wheelDeltaY), "wheelDeltaX" in r && (u = -1 * r.wheelDeltaX), "axis" in r && r.axis === r.HORIZONTAL_AXIS && (u = -1 * p, p = 0), c = 0 === p ? u : p, "deltaY" in r && (p = -1 * r.deltaY, c = p), "deltaX" in r && (u = r.deltaX, 0 === p && (c = -1 * u)), 0 !== p || 0 !== u) {
                if (1 === r.deltaMode) {
                    var g = t.data(this, "mousewheel-line-height");
                    c *= g, p *= g, u *= g
                } else if (2 === r.deltaMode) {
                    var v = t.data(this, "mousewheel-page-height");
                    c *= v, p *= v, u *= v
                }
                if (h = Math.max(Math.abs(p), Math.abs(u)), (!a || a > h) && (a = h, i(r, h) && (a /= 40)), i(r, h) && (c /= 40, u /= 40, p /= 40), c = Math[c >= 1 ? "floor" : "ceil"](c / a), u = Math[u >= 1 ? "floor" : "ceil"](u / a), p = Math[p >= 1 ? "floor" : "ceil"](p / a), d.settings.normalizeOffset && this.getBoundingClientRect) {
                    var y = this.getBoundingClientRect();
                    f = e.clientX - y.left, m = e.clientY - y.top
                }
                return e.deltaX = u, e.deltaY = p, e.deltaFactor = a, e.offsetX = f, e.offsetY = m, e.deltaMode = 0, s.unshift(e, c, u, p), o && clearTimeout(o), o = setTimeout(n, 200), (t.event.dispatch || t.event.handle).apply(this, s)
            }
        }

        function n() {
            a = null
        }

        function i(t, e) {
            return d.settings.adjustOldDeltas && "mousewheel" === t.type && e % 120 === 0
        }
        var o, a, r = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
            s = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
            l = Array.prototype.slice;
        if (t.event.fixHooks)
            for (var c = r.length; c;) t.event.fixHooks[r[--c]] = t.event.mouseHooks;
        var d = t.event.special.mousewheel = {
            version: "3.1.12",
            setup: function() {
                if (this.addEventListener)
                    for (var n = s.length; n;) this.addEventListener(s[--n], e, !1);
                else this.onmousewheel = e;
                t.data(this, "mousewheel-line-height", d.getLineHeight(this)), t.data(this, "mousewheel-page-height", d.getPageHeight(this))
            },
            teardown: function() {
                if (this.removeEventListener)
                    for (var n = s.length; n;) this.removeEventListener(s[--n], e, !1);
                else this.onmousewheel = null;
                t.removeData(this, "mousewheel-line-height"), t.removeData(this, "mousewheel-page-height")
            },
            getLineHeight: function(e) {
                var n = t(e),
                    i = n["offsetParent" in t.fn ? "offsetParent" : "parent"]();
                return i.length || (i = t("body")), parseInt(i.css("fontSize"), 10) || parseInt(n.css("fontSize"), 10) || 16
            },
            getPageHeight: function(e) {
                return t(e).height()
            },
            settings: {
                adjustOldDeltas: !0,
                normalizeOffset: !0
            }
        };
        t.fn.extend({
            mousewheel: function(t) {
                return t ? this.bind("mousewheel", t) : this.trigger("mousewheel")
            },
            unmousewheel: function(t) {
                return this.unbind("mousewheel", t)
            }
        })
    }), ! function(t) {
        "undefined" != typeof module && module.exports ? module.exports = t : t(jQuery, window, document)
    }(function(t) {
        ! function(e) {
            var n = "function" == typeof define && define.amd,
                i = "undefined" != typeof module && module.exports,
                o = "https:" == document.location.protocol ? "https:" : "http:",
                a = "cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js";
            n || (i ? require("jquery-mousewheel")(t) : t.event.special.mousewheel || t("head").append(decodeURI("%3Cscript src=" + o + "//" + a + "%3E%3C/script%3E"))), e()
        }(function() {
            var e, n = "mCustomScrollbar",
                i = "mCS",
                o = ".mCustomScrollbar",
                a = {
                    setTop: 0,
                    setLeft: 0,
                    axis: "y",
                    scrollbarPosition: "inside",
                    scrollInertia: 950,
                    autoDraggerLength: !0,
                    alwaysShowScrollbar: 0,
                    snapOffset: 0,
                    mouseWheel: {
                        enable: !0,
                        scrollAmount: "auto",
                        axis: "y",
                        deltaFactor: "auto",
                        disableOver: ["select", "option", "keygen", "datalist", "textarea"]
                    },
                    scrollButtons: {
                        scrollType: "stepless",
                        scrollAmount: "auto"
                    },
                    keyboard: {
                        enable: !0,
                        scrollType: "stepless",
                        scrollAmount: "auto"
                    },
                    contentTouchScroll: 25,
                    documentTouchScroll: !0,
                    advanced: {
                        autoScrollOnFocus: "input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
                        updateOnContentResize: !0,
                        updateOnImageLoad: "auto",
                        autoUpdateTimeout: 60
                    },
                    theme: "light",
                    callbacks: {
                        onTotalScrollOffset: 0,
                        onTotalScrollBackOffset: 0,
                        alwaysTriggerOffsets: !0
                    }
                },
                r = 0,
                s = {},
                l = window.attachEvent && !window.addEventListener ? 1 : 0,
                c = !1,
                d = ["mCSB_dragger_onDrag", "mCSB_scrollTools_onDrag", "mCS_img_loaded", "mCS_disabled", "mCS_destroyed", "mCS_no_scrollbar", "mCS-autoHide", "mCS-dir-rtl", "mCS_no_scrollbar_y", "mCS_no_scrollbar_x", "mCS_y_hidden", "mCS_x_hidden", "mCSB_draggerContainer", "mCSB_buttonUp", "mCSB_buttonDown", "mCSB_buttonLeft", "mCSB_buttonRight"],
                u = {
                    init: function(e) {
                        var e = t.extend(!0, {}, a, e),
                            n = p.call(this);
                        if (e.live) {
                            var l = e.liveSelector || this.selector || o,
                                c = t(l);
                            if ("off" === e.live) return void f(l);
                            s[l] = setTimeout(function() {
                                c.mCustomScrollbar(e), "once" === e.live && c.length && f(l)
                            }, 500)
                        } else f(l);
                        return e.setWidth = e.set_width ? e.set_width : e.setWidth, e.setHeight = e.set_height ? e.set_height : e.setHeight, e.axis = e.horizontalScroll ? "x" : m(e.axis), e.scrollInertia = e.scrollInertia > 0 && e.scrollInertia < 17 ? 17 : e.scrollInertia, "object" != typeof e.mouseWheel && 1 == e.mouseWheel && (e.mouseWheel = {
                            enable: !0,
                            scrollAmount: "auto",
                            axis: "y",
                            preventDefault: !1,
                            deltaFactor: "auto",
                            normalizeDelta: !1,
                            invert: !1
                        }), e.mouseWheel.scrollAmount = e.mouseWheelPixels ? e.mouseWheelPixels : e.mouseWheel.scrollAmount, e.mouseWheel.normalizeDelta = e.advanced.normalizeMouseWheelDelta ? e.advanced.normalizeMouseWheelDelta : e.mouseWheel.normalizeDelta, e.scrollButtons.scrollType = g(e.scrollButtons.scrollType), h(e), t(n).each(function() {
                            var n = t(this);
                            if (!n.data(i)) {
                                n.data(i, {
                                    idx: ++r,
                                    opt: e,
                                    scrollRatio: {
                                        y: null,
                                        x: null
                                    },
                                    overflowed: null,
                                    contentReset: {
                                        y: null,
                                        x: null
                                    },
                                    bindEvents: !1,
                                    tweenRunning: !1,
                                    sequential: {},
                                    langDir: n.css("direction"),
                                    cbOffsets: null,
                                    trigger: null,
                                    poll: {
                                        size: {
                                            o: 0,
                                            n: 0
                                        },
                                        img: {
                                            o: 0,
                                            n: 0
                                        },
                                        change: {
                                            o: 0,
                                            n: 0
                                        }
                                    }
                                });
                                var o = n.data(i),
                                    a = o.opt,
                                    s = n.data("mcs-axis"),
                                    l = n.data("mcs-scrollbar-position"),
                                    c = n.data("mcs-theme");
                                s && (a.axis = s), l && (a.scrollbarPosition = l), c && (a.theme = c, h(a)), v.call(this), o && a.callbacks.onCreate && "function" == typeof a.callbacks.onCreate && a.callbacks.onCreate.call(this), t("#mCSB_" + o.idx + "_container img:not(." + d[2] + ")").addClass(d[2]), u.update.call(null, n)
                            }
                        })
                    },
                    update: function(e, n) {
                        var o = e || p.call(this);
                        return t(o).each(function() {
                            var e = t(this);
                            if (e.data(i)) {
                                var o = e.data(i),
                                    a = o.opt,
                                    r = t("#mCSB_" + o.idx + "_container"),
                                    s = t("#mCSB_" + o.idx),
                                    l = [t("#mCSB_" + o.idx + "_dragger_vertical"), t("#mCSB_" + o.idx + "_dragger_horizontal")];
                                if (!r.length) return;
                                o.tweenRunning && Y(e), n && o && a.callbacks.onBeforeUpdate && "function" == typeof a.callbacks.onBeforeUpdate && a.callbacks.onBeforeUpdate.call(this), e.hasClass(d[3]) && e.removeClass(d[3]), e.hasClass(d[4]) && e.removeClass(d[4]), s.css("max-height", "none"), s.height() !== e.height() && s.css("max-height", e.height()), w.call(this), "y" === a.axis || a.advanced.autoExpandHorizontalScroll || r.css("width", y(r)), o.overflowed = S.call(this), D.call(this), a.autoDraggerLength && x.call(this), C.call(this), k.call(this);
                                var c = [Math.abs(r[0].offsetTop), Math.abs(r[0].offsetLeft)];
                                "x" !== a.axis && (o.overflowed[0] ? l[0].height() > l[0].parent().height() ? _.call(this) : (V(e, c[0].toString(), {
                                    dir: "y",
                                    dur: 0,
                                    overwrite: "none"
                                }), o.contentReset.y = null) : (_.call(this), "y" === a.axis ? E.call(this) : "yx" === a.axis && o.overflowed[1] && V(e, c[1].toString(), {
                                    dir: "x",
                                    dur: 0,
                                    overwrite: "none"
                                }))), "y" !== a.axis && (o.overflowed[1] ? l[1].width() > l[1].parent().width() ? _.call(this) : (V(e, c[1].toString(), {
                                    dir: "x",
                                    dur: 0,
                                    overwrite: "none"
                                }), o.contentReset.x = null) : (_.call(this), "x" === a.axis ? E.call(this) : "yx" === a.axis && o.overflowed[0] && V(e, c[0].toString(), {
                                    dir: "y",
                                    dur: 0,
                                    overwrite: "none"
                                }))), n && o && (2 === n && a.callbacks.onImageLoad && "function" == typeof a.callbacks.onImageLoad ? a.callbacks.onImageLoad.call(this) : 3 === n && a.callbacks.onSelectorChange && "function" == typeof a.callbacks.onSelectorChange ? a.callbacks.onSelectorChange.call(this) : a.callbacks.onUpdate && "function" == typeof a.callbacks.onUpdate && a.callbacks.onUpdate.call(this)), U.call(this)
                            }
                        })
                    },
                    scrollTo: function(e, n) {
                        if ("undefined" != typeof e && null != e) {
                            var o = p.call(this);
                            return t(o).each(function() {
                                var o = t(this);
                                if (o.data(i)) {
                                    var a = o.data(i),
                                        r = a.opt,
                                        s = {
                                            trigger: "external",
                                            scrollInertia: r.scrollInertia,
                                            scrollEasing: "mcsEaseInOut",
                                            moveDragger: !1,
                                            timeout: 60,
                                            callbacks: !0,
                                            onStart: !0,
                                            onUpdate: !0,
                                            onComplete: !0
                                        },
                                        l = t.extend(!0, {}, s, n),
                                        c = R.call(this, e),
                                        d = l.scrollInertia > 0 && l.scrollInertia < 17 ? 17 : l.scrollInertia;
                                    c[0] = W.call(this, c[0], "y"), c[1] = W.call(this, c[1], "x"), l.moveDragger && (c[0] *= a.scrollRatio.y, c[1] *= a.scrollRatio.x), l.dur = nt() ? 0 : d, setTimeout(function() {
                                        null !== c[0] && "undefined" != typeof c[0] && "x" !== r.axis && a.overflowed[0] && (l.dir = "y", l.overwrite = "all", V(o, c[0].toString(), l)), null !== c[1] && "undefined" != typeof c[1] && "y" !== r.axis && a.overflowed[1] && (l.dir = "x", l.overwrite = "none", V(o, c[1].toString(), l))
                                    }, l.timeout)
                                }
                            })
                        }
                    },
                    stop: function() {
                        var e = p.call(this);
                        return t(e).each(function() {
                            var e = t(this);
                            e.data(i) && Y(e)
                        })
                    },
                    disable: function(e) {
                        var n = p.call(this);
                        return t(n).each(function() {
                            var n = t(this);
                            n.data(i) && (n.data(i), U.call(this, "remove"), E.call(this), e && _.call(this), D.call(this, !0), n.addClass(d[3]))
                        })
                    },
                    destroy: function() {
                        var e = p.call(this);
                        return t(e).each(function() {
                            var o = t(this);
                            if (o.data(i)) {
                                var a = o.data(i),
                                    r = a.opt,
                                    s = t("#mCSB_" + a.idx),
                                    l = t("#mCSB_" + a.idx + "_container"),
                                    c = t(".mCSB_" + a.idx + "_scrollbar");
                                r.live && f(r.liveSelector || t(e).selector), U.call(this, "remove"), E.call(this), _.call(this), o.removeData(i), Q(this, "mcs"), c.remove(), l.find("img." + d[2]).removeClass(d[2]), s.replaceWith(l.contents()), o.removeClass(n + " _" + i + "_" + a.idx + " " + d[6] + " " + d[7] + " " + d[5] + " " + d[3]).addClass(d[4])
                            }
                        })
                    }
                },
                p = function() {
                    return "object" != typeof t(this) || t(this).length < 1 ? o : this
                },
                h = function(e) {
                    var n = ["rounded", "rounded-dark", "rounded-dots", "rounded-dots-dark"],
                        i = ["rounded-dots", "rounded-dots-dark", "3d", "3d-dark", "3d-thick", "3d-thick-dark", "inset", "inset-dark", "inset-2", "inset-2-dark", "inset-3", "inset-3-dark"],
                        o = ["minimal", "minimal-dark"],
                        a = ["minimal", "minimal-dark"],
                        r = ["minimal", "minimal-dark"];
                    e.autoDraggerLength = !(t.inArray(e.theme, n) > -1) && e.autoDraggerLength, e.autoExpandScrollbar = !(t.inArray(e.theme, i) > -1) && e.autoExpandScrollbar, e.scrollButtons.enable = !(t.inArray(e.theme, o) > -1) && e.scrollButtons.enable, e.autoHideScrollbar = t.inArray(e.theme, a) > -1 || e.autoHideScrollbar, e.scrollbarPosition = t.inArray(e.theme, r) > -1 ? "outside" : e.scrollbarPosition
                },
                f = function(t) {
                    s[t] && (clearTimeout(s[t]), Q(s, t))
                },
                m = function(t) {
                    return "yx" === t || "xy" === t || "auto" === t ? "yx" : "x" === t || "horizontal" === t ? "x" : "y"
                },
                g = function(t) {
                    return "stepped" === t || "pixels" === t || "step" === t || "click" === t ? "stepped" : "stepless"
                },
                v = function() {
                    var e = t(this),
                        o = e.data(i),
                        a = o.opt,
                        r = a.autoExpandScrollbar ? " " + d[1] + "_expand" : "",
                        s = ["<div id='mCSB_" + o.idx + "_scrollbar_vertical' class='mCSB_scrollTools mCSB_" + o.idx + "_scrollbar mCS-" + a.theme + " mCSB_scrollTools_vertical" + r + "'><div class='" + d[12] + "'><div id='mCSB_" + o.idx + "_dragger_vertical' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>", "<div id='mCSB_" + o.idx + "_scrollbar_horizontal' class='mCSB_scrollTools mCSB_" + o.idx + "_scrollbar mCS-" + a.theme + " mCSB_scrollTools_horizontal" + r + "'><div class='" + d[12] + "'><div id='mCSB_" + o.idx + "_dragger_horizontal' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>"],
                        l = "yx" === a.axis ? "mCSB_vertical_horizontal" : "x" === a.axis ? "mCSB_horizontal" : "mCSB_vertical",
                        c = "yx" === a.axis ? s[0] + s[1] : "x" === a.axis ? s[1] : s[0],
                        u = "yx" === a.axis ? "<div id='mCSB_" + o.idx + "_container_wrapper' class='mCSB_container_wrapper' />" : "",
                        p = a.autoHideScrollbar ? " " + d[6] : "",
                        h = "x" !== a.axis && "rtl" === o.langDir ? " " + d[7] : "";
                    a.setWidth && e.css("width", a.setWidth), a.setHeight && e.css("height", a.setHeight), a.setLeft = "y" !== a.axis && "rtl" === o.langDir ? "989999px" : a.setLeft, e.addClass(n + " _" + i + "_" + o.idx + p + h).wrapInner("<div id='mCSB_" + o.idx + "' class='mCustomScrollBox mCS-" + a.theme + " " + l + "'><div id='mCSB_" + o.idx + "_container' class='mCSB_container' style='position:relative; top:" + a.setTop + "; left:" + a.setLeft + ";' dir=" + o.langDir + " /></div>");
                    var f = t("#mCSB_" + o.idx),
                        m = t("#mCSB_" + o.idx + "_container");
                    "y" === a.axis || a.advanced.autoExpandHorizontalScroll || m.css("width", y(m)), "outside" === a.scrollbarPosition ? ("static" === e.css("position") && e.css("position", "relative"), e.css("overflow", "visible"), f.addClass("mCSB_outside").after(c)) : (f.addClass("mCSB_inside").append(c), m.wrap(u)), b.call(this);
                    var g = [t("#mCSB_" + o.idx + "_dragger_vertical"), t("#mCSB_" + o.idx + "_dragger_horizontal")];
                    g[0].css("min-height", g[0].height()), g[1].css("min-width", g[1].width())
                },
                y = function(e) {
                    var n = [e[0].scrollWidth, Math.max.apply(Math, e.children().map(function() {
                            return t(this).outerWidth(!0)
                        }).get())],
                        i = e.parent().width();
                    return n[0] > i ? n[0] : n[1] > i ? n[1] : "100%"
                },
                w = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = n.opt,
                        a = t("#mCSB_" + n.idx + "_container");
                    if (o.advanced.autoExpandHorizontalScroll && "y" !== o.axis) {
                        a.css({
                            width: "auto",
                            "min-width": 0,
                            "overflow-x": "scroll"
                        });
                        var r = Math.ceil(a[0].scrollWidth);
                        3 === o.advanced.autoExpandHorizontalScroll || 2 !== o.advanced.autoExpandHorizontalScroll && r > a.parent().width() ? a.css({
                            width: r,
                            "min-width": "100%",
                            "overflow-x": "inherit"
                        }) : a.css({
                            "overflow-x": "inherit",
                            position: "absolute"
                        }).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({
                            width: Math.ceil(a[0].getBoundingClientRect().right + .4) - Math.floor(a[0].getBoundingClientRect().left),
                            "min-width": "100%",
                            position: "relative"
                        }).unwrap()
                    }
                },
                b = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = n.opt,
                        a = t(".mCSB_" + n.idx + "_scrollbar:first"),
                        r = tt(o.scrollButtons.tabindex) ? "tabindex='" + o.scrollButtons.tabindex + "'" : "",
                        s = ["<a href='#' class='" + d[13] + "' oncontextmenu='return false;' " + r + " />", "<a href='#' class='" + d[14] + "' oncontextmenu='return false;' " + r + " />", "<a href='#' class='" + d[15] + "' oncontextmenu='return false;' " + r + " />", "<a href='#' class='" + d[16] + "' oncontextmenu='return false;' " + r + " />"],
                        l = ["x" === o.axis ? s[2] : s[0], "x" === o.axis ? s[3] : s[1], s[2], s[3]];
                    o.scrollButtons.enable && a.prepend(l[0]).append(l[1]).next(".mCSB_scrollTools").prepend(l[2]).append(l[3])
                },
                x = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = t("#mCSB_" + n.idx),
                        a = t("#mCSB_" + n.idx + "_container"),
                        r = [t("#mCSB_" + n.idx + "_dragger_vertical"), t("#mCSB_" + n.idx + "_dragger_horizontal")],
                        s = [o.height() / a.outerHeight(!1), o.width() / a.outerWidth(!1)],
                        c = [parseInt(r[0].css("min-height")), Math.round(s[0] * r[0].parent().height()), parseInt(r[1].css("min-width")), Math.round(s[1] * r[1].parent().width())],
                        d = l && c[1] < c[0] ? c[0] : c[1],
                        u = l && c[3] < c[2] ? c[2] : c[3];
                    r[0].css({
                        height: d,
                        "max-height": r[0].parent().height() - 10
                    }).find(".mCSB_dragger_bar").css({
                        "line-height": c[0] + "px"
                    }), r[1].css({
                        width: u,
                        "max-width": r[1].parent().width() - 10
                    })
                },
                C = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = t("#mCSB_" + n.idx),
                        a = t("#mCSB_" + n.idx + "_container"),
                        r = [t("#mCSB_" + n.idx + "_dragger_vertical"), t("#mCSB_" + n.idx + "_dragger_horizontal")],
                        s = [a.outerHeight(!1) - o.height(), a.outerWidth(!1) - o.width()],
                        l = [s[0] / (r[0].parent().height() - r[0].height()), s[1] / (r[1].parent().width() - r[1].width())];
                    n.scrollRatio = {
                        y: l[0],
                        x: l[1]
                    }
                },
                T = function(t, e, n) {
                    var i = n ? d[0] + "_expanded" : "",
                        o = t.closest(".mCSB_scrollTools");
                    "active" === e ? (t.toggleClass(d[0] + " " + i), o.toggleClass(d[1]), t[0]._draggable = t[0]._draggable ? 0 : 1) : t[0]._draggable || ("hide" === e ? (t.removeClass(d[0]), o.removeClass(d[1])) : (t.addClass(d[0]),
                        o.addClass(d[1])))
                },
                S = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = t("#mCSB_" + n.idx),
                        a = t("#mCSB_" + n.idx + "_container"),
                        r = null == n.overflowed ? a.height() : a.outerHeight(!1),
                        s = null == n.overflowed ? a.width() : a.outerWidth(!1),
                        l = a[0].scrollHeight,
                        c = a[0].scrollWidth;
                    return l > r && (r = l), c > s && (s = c), [r > o.height(), s > o.width()]
                },
                _ = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = n.opt,
                        a = t("#mCSB_" + n.idx),
                        r = t("#mCSB_" + n.idx + "_container"),
                        s = [t("#mCSB_" + n.idx + "_dragger_vertical"), t("#mCSB_" + n.idx + "_dragger_horizontal")];
                    if (Y(e), ("x" !== o.axis && !n.overflowed[0] || "y" === o.axis && n.overflowed[0]) && (s[0].add(r).css("top", 0), V(e, "_resetY")), "y" !== o.axis && !n.overflowed[1] || "x" === o.axis && n.overflowed[1]) {
                        var l = dx = 0;
                        "rtl" === n.langDir && (l = a.width() - r.outerWidth(!1), dx = Math.abs(l / n.scrollRatio.x)), r.css("left", l), s[1].css("left", dx), V(e, "_resetX")
                    }
                },
                k = function() {
                    function e() {
                        r = setTimeout(function() {
                            t.event.special.mousewheel ? (clearTimeout(r), N.call(n[0])) : e()
                        }, 100)
                    }
                    var n = t(this),
                        o = n.data(i),
                        a = o.opt;
                    if (!o.bindEvents) {
                        if (O.call(this), a.contentTouchScroll && I.call(this), A.call(this), a.mouseWheel.enable) {
                            var r;
                            e()
                        }
                        L.call(this), B.call(this), a.advanced.autoScrollOnFocus && $.call(this), a.scrollButtons.enable && F.call(this), a.keyboard.enable && H.call(this), o.bindEvents = !0
                    }
                },
                E = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = n.opt,
                        a = i + "_" + n.idx,
                        r = ".mCSB_" + n.idx + "_scrollbar",
                        s = t("#mCSB_" + n.idx + ",#mCSB_" + n.idx + "_container,#mCSB_" + n.idx + "_container_wrapper," + r + " ." + d[12] + ",#mCSB_" + n.idx + "_dragger_vertical,#mCSB_" + n.idx + "_dragger_horizontal," + r + ">a"),
                        l = t("#mCSB_" + n.idx + "_container");
                    o.advanced.releaseDraggableSelectors && s.add(t(o.advanced.releaseDraggableSelectors)), o.advanced.extraDraggableSelectors && s.add(t(o.advanced.extraDraggableSelectors)), n.bindEvents && (t(document).add(t(!P() || top.document)).unbind("." + a), s.each(function() {
                        t(this).unbind("." + a)
                    }), clearTimeout(e[0]._focusTimeout), Q(e[0], "_focusTimeout"), clearTimeout(n.sequential.step), Q(n.sequential, "step"), clearTimeout(l[0].onCompleteTimeout), Q(l[0], "onCompleteTimeout"), n.bindEvents = !1)
                },
                D = function(e) {
                    var n = t(this),
                        o = n.data(i),
                        a = o.opt,
                        r = t("#mCSB_" + o.idx + "_container_wrapper"),
                        s = r.length ? r : t("#mCSB_" + o.idx + "_container"),
                        l = [t("#mCSB_" + o.idx + "_scrollbar_vertical"), t("#mCSB_" + o.idx + "_scrollbar_horizontal")],
                        c = [l[0].find(".mCSB_dragger"), l[1].find(".mCSB_dragger")];
                    "x" !== a.axis && (o.overflowed[0] && !e ? (l[0].add(c[0]).add(l[0].children("a")).css("display", "block"), s.removeClass(d[8] + " " + d[10])) : (a.alwaysShowScrollbar ? (2 !== a.alwaysShowScrollbar && c[0].css("display", "none"), s.removeClass(d[10])) : (l[0].css("display", "none"), s.addClass(d[10])), s.addClass(d[8]))), "y" !== a.axis && (o.overflowed[1] && !e ? (l[1].add(c[1]).add(l[1].children("a")).css("display", "block"), s.removeClass(d[9] + " " + d[11])) : (a.alwaysShowScrollbar ? (2 !== a.alwaysShowScrollbar && c[1].css("display", "none"), s.removeClass(d[11])) : (l[1].css("display", "none"), s.addClass(d[11])), s.addClass(d[9]))), o.overflowed[0] || o.overflowed[1] ? n.removeClass(d[5]) : n.addClass(d[5])
                },
                M = function(e) {
                    var n = e.type,
                        i = e.target.ownerDocument !== document ? [t(frameElement).offset().top, t(frameElement).offset().left] : null,
                        o = P() && e.target.ownerDocument !== top.document ? [t(e.view.frameElement).offset().top, t(e.view.frameElement).offset().left] : [0, 0];
                    switch (n) {
                        case "pointerdown":
                        case "MSPointerDown":
                        case "pointermove":
                        case "MSPointerMove":
                        case "pointerup":
                        case "MSPointerUp":
                            return i ? [e.originalEvent.pageY - i[0] + o[0], e.originalEvent.pageX - i[1] + o[1], !1] : [e.originalEvent.pageY, e.originalEvent.pageX, !1];
                        case "touchstart":
                        case "touchmove":
                        case "touchend":
                            var a = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0],
                                r = e.originalEvent.touches.length || e.originalEvent.changedTouches.length;
                            return e.target.ownerDocument !== document ? [a.screenY, a.screenX, r > 1] : [a.pageY, a.pageX, r > 1];
                        default:
                            return i ? [e.pageY - i[0] + o[0], e.pageX - i[1] + o[1], !1] : [e.pageY, e.pageX, !1]
                    }
                },
                O = function() {
                    function e(t) {
                        var e = f.find("iframe");
                        if (e.length) {
                            var n = t ? "auto" : "none";
                            e.css("pointer-events", n)
                        }
                    }

                    function n(t, e, n, i) {
                        if (f[0].idleTimer = u.scrollInertia < 233 ? 250 : 0, o.attr("id") === h[1]) var a = "x",
                            r = (o[0].offsetLeft - e + i) * d.scrollRatio.x;
                        else var a = "y",
                            r = (o[0].offsetTop - t + n) * d.scrollRatio.y;
                        V(s, r.toString(), {
                            dir: a,
                            drag: !0
                        })
                    }
                    var o, a, r, s = t(this),
                        d = s.data(i),
                        u = d.opt,
                        p = i + "_" + d.idx,
                        h = ["mCSB_" + d.idx + "_dragger_vertical", "mCSB_" + d.idx + "_dragger_horizontal"],
                        f = t("#mCSB_" + d.idx + "_container"),
                        m = t("#" + h[0] + ",#" + h[1]),
                        g = u.advanced.releaseDraggableSelectors ? m.add(t(u.advanced.releaseDraggableSelectors)) : m,
                        v = u.advanced.extraDraggableSelectors ? t(!P() || top.document).add(t(u.advanced.extraDraggableSelectors)) : t(!P() || top.document);
                    m.bind("mousedown." + p + " touchstart." + p + " pointerdown." + p + " MSPointerDown." + p, function(n) {
                        if (n.stopImmediatePropagation(), n.preventDefault(), Z(n)) {
                            c = !0, l && (document.onselectstart = function() {
                                return !1
                            }), e(!1), Y(s), o = t(this);
                            var i = o.offset(),
                                d = M(n)[0] - i.top,
                                p = M(n)[1] - i.left,
                                h = o.height() + i.top,
                                f = o.width() + i.left;
                            h > d && d > 0 && f > p && p > 0 && (a = d, r = p), T(o, "active", u.autoExpandScrollbar)
                        }
                    }).bind("touchmove." + p, function(t) {
                        t.stopImmediatePropagation(), t.preventDefault();
                        var e = o.offset(),
                            i = M(t)[0] - e.top,
                            s = M(t)[1] - e.left;
                        n(a, r, i, s)
                    }), t(document).add(v).bind("mousemove." + p + " pointermove." + p + " MSPointerMove." + p, function(t) {
                        if (o) {
                            var e = o.offset(),
                                i = M(t)[0] - e.top,
                                s = M(t)[1] - e.left;
                            if (a === i && r === s) return;
                            n(a, r, i, s)
                        }
                    }).add(g).bind("mouseup." + p + " touchend." + p + " pointerup." + p + " MSPointerUp." + p, function(t) {
                        o && (T(o, "active", u.autoExpandScrollbar), o = null), c = !1, l && (document.onselectstart = null), e(!0)
                    })
                },
                I = function() {
                    function n(t) {
                        if (!J(t) || c || M(t)[2]) return void(e = 0);
                        e = 1, C = 0, T = 0, d = 1, S.removeClass("mCS_touch_action");
                        var n = O.offset();
                        u = M(t)[0] - n.top, p = M(t)[1] - n.left, $ = [M(t)[0], M(t)[1]]
                    }

                    function o(t) {
                        if (J(t) && !c && !M(t)[2] && (k.documentTouchScroll || t.preventDefault(), t.stopImmediatePropagation(), (!T || C) && d)) {
                            g = G();
                            var e = D.offset(),
                                n = M(t)[0] - e.top,
                                i = M(t)[1] - e.left,
                                o = "mcsLinearOut";
                            if (A.push(n), N.push(i), $[2] = Math.abs(M(t)[0] - $[0]), $[3] = Math.abs(M(t)[1] - $[1]), _.overflowed[0]) var a = I[0].parent().height() - I[0].height(),
                                r = u - n > 0 && n - u > -(a * _.scrollRatio.y) && (2 * $[3] < $[2] || "yx" === k.axis);
                            if (_.overflowed[1]) var s = I[1].parent().width() - I[1].width(),
                                h = p - i > 0 && i - p > -(s * _.scrollRatio.x) && (2 * $[2] < $[3] || "yx" === k.axis);
                            r || h ? (H || t.preventDefault(), C = 1) : (T = 1, S.addClass("mCS_touch_action")), H && t.preventDefault(), b = "yx" === k.axis ? [u - n, p - i] : "x" === k.axis ? [null, p - i] : [u - n, null], O[0].idleTimer = 250, _.overflowed[0] && l(b[0], z, o, "y", "all", !0), _.overflowed[1] && l(b[1], z, o, "x", L, !0)
                        }
                    }

                    function a(t) {
                        if (!J(t) || c || M(t)[2]) return void(e = 0);
                        e = 1, t.stopImmediatePropagation(), Y(S), m = G();
                        var n = D.offset();
                        h = M(t)[0] - n.top, f = M(t)[1] - n.left, A = [], N = []
                    }

                    function r(t) {
                        if (J(t) && !c && !M(t)[2]) {
                            d = 0, t.stopImmediatePropagation(), C = 0, T = 0, v = G();
                            var e = D.offset(),
                                n = M(t)[0] - e.top,
                                i = M(t)[1] - e.left;
                            if (!(v - g > 30)) {
                                w = 1e3 / (v - m);
                                var o = "mcsEaseOut",
                                    a = 2.5 > w,
                                    r = a ? [A[A.length - 2], N[N.length - 2]] : [0, 0];
                                y = a ? [n - r[0], i - r[1]] : [n - h, i - f];
                                var u = [Math.abs(y[0]), Math.abs(y[1])];
                                w = a ? [Math.abs(y[0] / 4), Math.abs(y[1] / 4)] : [w, w];
                                var p = [Math.abs(O[0].offsetTop) - y[0] * s(u[0] / w[0], w[0]), Math.abs(O[0].offsetLeft) - y[1] * s(u[1] / w[1], w[1])];
                                b = "yx" === k.axis ? [p[0], p[1]] : "x" === k.axis ? [null, p[1]] : [p[0], null], x = [4 * u[0] + k.scrollInertia, 4 * u[1] + k.scrollInertia];
                                var S = parseInt(k.contentTouchScroll) || 0;
                                b[0] = u[0] > S ? b[0] : 0, b[1] = u[1] > S ? b[1] : 0, _.overflowed[0] && l(b[0], x[0], o, "y", L, !1), _.overflowed[1] && l(b[1], x[1], o, "x", L, !1)
                            }
                        }
                    }

                    function s(t, e) {
                        var n = [1.5 * e, 2 * e, e / 1.5, e / 2];
                        return t > 90 ? e > 4 ? n[0] : n[3] : t > 60 ? e > 3 ? n[3] : n[2] : t > 30 ? e > 8 ? n[1] : e > 6 ? n[0] : e > 4 ? e : n[2] : e > 8 ? e : n[3]
                    }

                    function l(t, e, n, i, o, a) {
                        t && V(S, t.toString(), {
                            dur: e,
                            scrollEasing: n,
                            dir: i,
                            overwrite: o,
                            drag: a
                        })
                    }
                    var d, u, p, h, f, m, g, v, y, w, b, x, C, T, S = t(this),
                        _ = S.data(i),
                        k = _.opt,
                        E = i + "_" + _.idx,
                        D = t("#mCSB_" + _.idx),
                        O = t("#mCSB_" + _.idx + "_container"),
                        I = [t("#mCSB_" + _.idx + "_dragger_vertical"), t("#mCSB_" + _.idx + "_dragger_horizontal")],
                        A = [],
                        N = [],
                        z = 0,
                        L = "yx" === k.axis ? "none" : "all",
                        $ = [],
                        B = O.find("iframe"),
                        F = ["touchstart." + E + " pointerdown." + E + " MSPointerDown." + E, "touchmove." + E + " pointermove." + E + " MSPointerMove." + E, "touchend." + E + " pointerup." + E + " MSPointerUp." + E],
                        H = void 0 !== document.body.style.touchAction;
                    O.bind(F[0], function(t) {
                        n(t)
                    }).bind(F[1], function(t) {
                        o(t)
                    }), D.bind(F[0], function(t) {
                        a(t)
                    }).bind(F[2], function(t) {
                        r(t)
                    }), B.length && B.each(function() {
                        t(this).load(function() {
                            P(this) && t(this.contentDocument || this.contentWindow.document).bind(F[0], function(t) {
                                n(t), a(t)
                            }).bind(F[1], function(t) {
                                o(t)
                            }).bind(F[2], function(t) {
                                r(t)
                            })
                        })
                    })
                },
                A = function() {
                    function n() {
                        return window.getSelection ? window.getSelection().toString() : document.selection && "Control" != document.selection.type ? document.selection.createRange().text : 0
                    }

                    function o(t, e, n) {
                        d.type = n && a ? "stepped" : "stepless", d.scrollAmount = 10, j(r, t, e, "mcsLinearOut", n ? 60 : null)
                    }
                    var a, r = t(this),
                        s = r.data(i),
                        l = s.opt,
                        d = s.sequential,
                        u = i + "_" + s.idx,
                        p = t("#mCSB_" + s.idx + "_container"),
                        h = p.parent();
                    p.bind("mousedown." + u, function(t) {
                        e || a || (a = 1, c = !0)
                    }).add(document).bind("mousemove." + u, function(t) {
                        if (!e && a && n()) {
                            var i = p.offset(),
                                r = M(t)[0] - i.top + p[0].offsetTop,
                                c = M(t)[1] - i.left + p[0].offsetLeft;
                            r > 0 && r < h.height() && c > 0 && c < h.width() ? d.step && o("off", null, "stepped") : ("x" !== l.axis && s.overflowed[0] && (0 > r ? o("on", 38) : r > h.height() && o("on", 40)), "y" !== l.axis && s.overflowed[1] && (0 > c ? o("on", 37) : c > h.width() && o("on", 39)))
                        }
                    }).bind("mouseup." + u + " dragend." + u, function(t) {
                        e || (a && (a = 0, o("off", null)), c = !1)
                    })
                },
                N = function() {
                    function e(e, i) {
                        if (Y(n), !z(n, e.target)) {
                            var r = "auto" !== a.mouseWheel.deltaFactor ? parseInt(a.mouseWheel.deltaFactor) : l && e.deltaFactor < 100 ? 100 : e.deltaFactor || 100,
                                d = a.scrollInertia;
                            if ("x" === a.axis || "x" === a.mouseWheel.axis) var u = "x",
                                p = [Math.round(r * o.scrollRatio.x), parseInt(a.mouseWheel.scrollAmount)],
                                h = "auto" !== a.mouseWheel.scrollAmount ? p[1] : p[0] >= s.width() ? .9 * s.width() : p[0],
                                f = Math.abs(t("#mCSB_" + o.idx + "_container")[0].offsetLeft),
                                m = c[1][0].offsetLeft,
                                g = c[1].parent().width() - c[1].width(),
                                v = e.deltaX || e.deltaY || i;
                            else var u = "y",
                                p = [Math.round(r * o.scrollRatio.y), parseInt(a.mouseWheel.scrollAmount)],
                                h = "auto" !== a.mouseWheel.scrollAmount ? p[1] : p[0] >= s.height() ? .9 * s.height() : p[0],
                                f = Math.abs(t("#mCSB_" + o.idx + "_container")[0].offsetTop),
                                m = c[0][0].offsetTop,
                                g = c[0].parent().height() - c[0].height(),
                                v = e.deltaY || i;
                            "y" === u && !o.overflowed[0] || "x" === u && !o.overflowed[1] || ((a.mouseWheel.invert || e.webkitDirectionInvertedFromDevice) && (v = -v), a.mouseWheel.normalizeDelta && (v = 0 > v ? -1 : 1), (v > 0 && 0 !== m || 0 > v && m !== g || a.mouseWheel.preventDefault) && (e.stopImmediatePropagation(), e.preventDefault()), e.deltaFactor < 2 && !a.mouseWheel.normalizeDelta && (h = e.deltaFactor, d = 17), V(n, (f - v * h).toString(), {
                                dir: u,
                                dur: d
                            }))
                        }
                    }
                    if (t(this).data(i)) {
                        var n = t(this),
                            o = n.data(i),
                            a = o.opt,
                            r = i + "_" + o.idx,
                            s = t("#mCSB_" + o.idx),
                            c = [t("#mCSB_" + o.idx + "_dragger_vertical"), t("#mCSB_" + o.idx + "_dragger_horizontal")],
                            d = t("#mCSB_" + o.idx + "_container").find("iframe");
                        d.length && d.each(function() {
                            t(this).load(function() {
                                P(this) && t(this.contentDocument || this.contentWindow.document).bind("mousewheel." + r, function(t, n) {
                                    e(t, n)
                                })
                            })
                        }), s.bind("mousewheel." + r, function(t, n) {
                            e(t, n)
                        })
                    }
                },
                P = function(t) {
                    var e = null;
                    if (t) {
                        try {
                            var n = t.contentDocument || t.contentWindow.document;
                            e = n.body.innerHTML
                        } catch (i) {}
                        return null !== e
                    }
                    try {
                        var n = top.document;
                        e = n.body.innerHTML
                    } catch (i) {}
                    return null !== e
                },
                z = function(e, n) {
                    var o = n.nodeName.toLowerCase(),
                        a = e.data(i).opt.mouseWheel.disableOver,
                        r = ["select", "textarea"];
                    return t.inArray(o, a) > -1 && !(t.inArray(o, r) > -1 && !t(n).is(":focus"))
                },
                L = function() {
                    var e, n = t(this),
                        o = n.data(i),
                        a = i + "_" + o.idx,
                        r = t("#mCSB_" + o.idx + "_container"),
                        s = r.parent(),
                        l = t(".mCSB_" + o.idx + "_scrollbar ." + d[12]);
                    l.bind("mousedown." + a + " touchstart." + a + " pointerdown." + a + " MSPointerDown." + a, function(n) {
                        c = !0, t(n.target).hasClass("mCSB_dragger") || (e = 1)
                    }).bind("touchend." + a + " pointerup." + a + " MSPointerUp." + a, function(t) {
                        c = !1
                    }).bind("click." + a, function(i) {
                        if (e && (e = 0, t(i.target).hasClass(d[12]) || t(i.target).hasClass("mCSB_draggerRail"))) {
                            Y(n);
                            var a = t(this),
                                l = a.find(".mCSB_dragger");
                            if (a.parent(".mCSB_scrollTools_horizontal").length > 0) {
                                if (!o.overflowed[1]) return;
                                var c = "x",
                                    u = i.pageX > l.offset().left ? -1 : 1,
                                    p = Math.abs(r[0].offsetLeft) - .9 * u * s.width()
                            } else {
                                if (!o.overflowed[0]) return;
                                var c = "y",
                                    u = i.pageY > l.offset().top ? -1 : 1,
                                    p = Math.abs(r[0].offsetTop) - .9 * u * s.height()
                            }
                            V(n, p.toString(), {
                                dir: c,
                                scrollEasing: "mcsEaseInOut"
                            })
                        }
                    })
                },
                $ = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = n.opt,
                        a = i + "_" + n.idx,
                        r = t("#mCSB_" + n.idx + "_container"),
                        s = r.parent();
                    r.bind("focusin." + a, function(n) {
                        var i = t(document.activeElement),
                            a = r.find(".mCustomScrollBox").length,
                            l = 0;
                        i.is(o.advanced.autoScrollOnFocus) && (Y(e), clearTimeout(e[0]._focusTimeout), e[0]._focusTimer = a ? (l + 17) * a : 0, e[0]._focusTimeout = setTimeout(function() {
                            var t = [et(i)[0], et(i)[1]],
                                n = [r[0].offsetTop, r[0].offsetLeft],
                                a = [n[0] + t[0] >= 0 && n[0] + t[0] < s.height() - i.outerHeight(!1), n[1] + t[1] >= 0 && n[0] + t[1] < s.width() - i.outerWidth(!1)],
                                c = "yx" !== o.axis || a[0] || a[1] ? "all" : "none";
                            "x" === o.axis || a[0] || V(e, t[0].toString(), {
                                dir: "y",
                                scrollEasing: "mcsEaseInOut",
                                overwrite: c,
                                dur: l
                            }), "y" === o.axis || a[1] || V(e, t[1].toString(), {
                                dir: "x",
                                scrollEasing: "mcsEaseInOut",
                                overwrite: c,
                                dur: l
                            })
                        }, e[0]._focusTimer))
                    })
                },
                B = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = i + "_" + n.idx,
                        a = t("#mCSB_" + n.idx + "_container").parent();
                    a.bind("scroll." + o, function(e) {
                        (0 !== a.scrollTop() || 0 !== a.scrollLeft()) && t(".mCSB_" + n.idx + "_scrollbar").css("visibility", "hidden")
                    })
                },
                F = function() {
                    var e = t(this),
                        n = e.data(i),
                        o = n.opt,
                        a = n.sequential,
                        r = i + "_" + n.idx,
                        s = ".mCSB_" + n.idx + "_scrollbar",
                        l = t(s + ">a");
                    l.bind("mousedown." + r + " touchstart." + r + " pointerdown." + r + " MSPointerDown." + r + " mouseup." + r + " touchend." + r + " pointerup." + r + " MSPointerUp." + r + " mouseout." + r + " pointerout." + r + " MSPointerOut." + r + " click." + r, function(i) {
                        function r(t, n) {
                            a.scrollAmount = o.scrollButtons.scrollAmount, j(e, t, n)
                        }
                        if (i.preventDefault(), Z(i)) {
                            var s = t(this).attr("class");
                            switch (a.type = o.scrollButtons.scrollType, i.type) {
                                case "mousedown":
                                case "touchstart":
                                case "pointerdown":
                                case "MSPointerDown":
                                    if ("stepped" === a.type) return;
                                    c = !0, n.tweenRunning = !1, r("on", s);
                                    break;
                                case "mouseup":
                                case "touchend":
                                case "pointerup":
                                case "MSPointerUp":
                                case "mouseout":
                                case "pointerout":
                                case "MSPointerOut":
                                    if ("stepped" === a.type) return;
                                    c = !1, a.dir && r("off", s);
                                    break;
                                case "click":
                                    if ("stepped" !== a.type || n.tweenRunning) return;
                                    r("on", s)
                            }
                        }
                    })
                },
                H = function() {
                    function e(e) {
                        function i(t, e) {
                            r.type = a.keyboard.scrollType, r.scrollAmount = a.keyboard.scrollAmount, "stepped" === r.type && o.tweenRunning || j(n, t, e)
                        }
                        switch (e.type) {
                            case "blur":
                                o.tweenRunning && r.dir && i("off", null);
                                break;
                            case "keydown":
                            case "keyup":
                                var s = e.keyCode ? e.keyCode : e.which,
                                    l = "on";
                                if ("x" !== a.axis && (38 === s || 40 === s) || "y" !== a.axis && (37 === s || 39 === s)) {
                                    if ((38 === s || 40 === s) && !o.overflowed[0] || (37 === s || 39 === s) && !o.overflowed[1]) return;
                                    "keyup" === e.type && (l = "off"), t(document.activeElement).is(u) || (e.preventDefault(), e.stopImmediatePropagation(), i(l, s))
                                } else if (33 === s || 34 === s) {
                                    if ((o.overflowed[0] || o.overflowed[1]) && (e.preventDefault(), e.stopImmediatePropagation()), "keyup" === e.type) {
                                        Y(n);
                                        var p = 34 === s ? -1 : 1;
                                        if ("x" === a.axis || "yx" === a.axis && o.overflowed[1] && !o.overflowed[0]) var h = "x",
                                            f = Math.abs(c[0].offsetLeft) - .9 * p * d.width();
                                        else var h = "y",
                                            f = Math.abs(c[0].offsetTop) - .9 * p * d.height();
                                        V(n, f.toString(), {
                                            dir: h,
                                            scrollEasing: "mcsEaseInOut"
                                        })
                                    }
                                } else if ((35 === s || 36 === s) && !t(document.activeElement).is(u) && ((o.overflowed[0] || o.overflowed[1]) && (e.preventDefault(), e.stopImmediatePropagation()), "keyup" === e.type)) {
                                    if ("x" === a.axis || "yx" === a.axis && o.overflowed[1] && !o.overflowed[0]) var h = "x",
                                        f = 35 === s ? Math.abs(d.width() - c.outerWidth(!1)) : 0;
                                    else var h = "y",
                                        f = 35 === s ? Math.abs(d.height() - c.outerHeight(!1)) : 0;
                                    V(n, f.toString(), {
                                        dir: h,
                                        scrollEasing: "mcsEaseInOut"
                                    })
                                }
                        }
                    }
                    var n = t(this),
                        o = n.data(i),
                        a = o.opt,
                        r = o.sequential,
                        s = i + "_" + o.idx,
                        l = t("#mCSB_" + o.idx),
                        c = t("#mCSB_" + o.idx + "_container"),
                        d = c.parent(),
                        u = "input,textarea,select,datalist,keygen,[contenteditable='true']",
                        p = c.find("iframe"),
                        h = ["blur." + s + " keydown." + s + " keyup." + s];
                    p.length && p.each(function() {
                        t(this).load(function() {
                            P(this) && t(this.contentDocument || this.contentWindow.document).bind(h[0], function(t) {
                                e(t)
                            })
                        })
                    }), l.attr("tabindex", "0").bind(h[0], function(t) {
                        e(t)
                    })
                },
                j = function(e, n, o, a, r) {
                    function s(t) {
                        u.snapAmount && (p.scrollAmount = u.snapAmount instanceof Array ? "x" === p.dir[0] ? u.snapAmount[1] : u.snapAmount[0] : u.snapAmount);
                        var n = "stepped" !== p.type,
                            i = r ? r : t ? n ? m / 1.5 : g : 1e3 / 60,
                            o = t ? n ? 7.5 : 40 : 2.5,
                            l = [Math.abs(h[0].offsetTop), Math.abs(h[0].offsetLeft)],
                            d = [c.scrollRatio.y > 10 ? 10 : c.scrollRatio.y, c.scrollRatio.x > 10 ? 10 : c.scrollRatio.x],
                            f = "x" === p.dir[0] ? l[1] + p.dir[1] * d[1] * o : l[0] + p.dir[1] * d[0] * o,
                            v = "x" === p.dir[0] ? l[1] + p.dir[1] * parseInt(p.scrollAmount) : l[0] + p.dir[1] * parseInt(p.scrollAmount),
                            y = "auto" !== p.scrollAmount ? v : f,
                            w = a ? a : t ? n ? "mcsLinearOut" : "mcsEaseInOut" : "mcsLinear",
                            b = !!t;
                        return t && 17 > i && (y = "x" === p.dir[0] ? l[1] : l[0]), V(e, y.toString(), {
                            dir: p.dir[0],
                            scrollEasing: w,
                            dur: i,
                            onComplete: b
                        }), t ? void(p.dir = !1) : (clearTimeout(p.step), void(p.step = setTimeout(function() {
                            s()
                        }, i)))
                    }

                    function l() {
                        clearTimeout(p.step), Q(p, "step"), Y(e)
                    }
                    var c = e.data(i),
                        u = c.opt,
                        p = c.sequential,
                        h = t("#mCSB_" + c.idx + "_container"),
                        f = "stepped" === p.type,
                        m = u.scrollInertia < 26 ? 26 : u.scrollInertia,
                        g = u.scrollInertia < 1 ? 17 : u.scrollInertia;
                    switch (n) {
                        case "on":
                            if (p.dir = [o === d[16] || o === d[15] || 39 === o || 37 === o ? "x" : "y", o === d[13] || o === d[15] || 38 === o || 37 === o ? -1 : 1], Y(e), tt(o) && "stepped" === p.type) return;
                            s(f);
                            break;
                        case "off":
                            l(), (f || c.tweenRunning && p.dir) && s(!0)
                    }
                },
                R = function(e) {
                    var n = t(this).data(i).opt,
                        o = [];
                    return "function" == typeof e && (e = e()), e instanceof Array ? o = e.length > 1 ? [e[0], e[1]] : "x" === n.axis ? [null, e[0]] : [e[0], null] : (o[0] = e.y ? e.y : e.x || "x" === n.axis ? null : e, o[1] = e.x ? e.x : e.y || "y" === n.axis ? null : e), "function" == typeof o[0] && (o[0] = o[0]()), "function" == typeof o[1] && (o[1] = o[1]()), o
                },
                W = function(e, n) {
                    if (null != e && "undefined" != typeof e) {
                        var o = t(this),
                            a = o.data(i),
                            r = a.opt,
                            s = t("#mCSB_" + a.idx + "_container"),
                            l = s.parent(),
                            c = typeof e;
                        n || (n = "x" === r.axis ? "x" : "y");
                        var d = "x" === n ? s.outerWidth(!1) : s.outerHeight(!1),
                            p = "x" === n ? s[0].offsetLeft : s[0].offsetTop,
                            h = "x" === n ? "left" : "top";
                        switch (c) {
                            case "function":
                                return e();
                            case "object":
                                var f = e.jquery ? e : t(e);
                                if (!f.length) return;
                                return "x" === n ? et(f)[1] : et(f)[0];
                            case "string":
                            case "number":
                                if (tt(e)) return Math.abs(e);
                                if (-1 !== e.indexOf("%")) return Math.abs(d * parseInt(e) / 100);
                                if (-1 !== e.indexOf("-=")) return Math.abs(p - parseInt(e.split("-=")[1]));
                                if (-1 !== e.indexOf("+=")) {
                                    var m = p + parseInt(e.split("+=")[1]);
                                    return m >= 0 ? 0 : Math.abs(m)
                                }
                                if (-1 !== e.indexOf("px") && tt(e.split("px")[0])) return Math.abs(e.split("px")[0]);
                                if ("top" === e || "left" === e) return 0;
                                if ("bottom" === e) return Math.abs(l.height() - s.outerHeight(!1));
                                if ("right" === e) return Math.abs(l.width() - s.outerWidth(!1));
                                if ("first" === e || "last" === e) {
                                    var f = s.find(":" + e);
                                    return "x" === n ? et(f)[1] : et(f)[0]
                                }
                                return t(e).length ? "x" === n ? et(t(e))[1] : et(t(e))[0] : (s.css(h, e), void u.update.call(null, o[0]))
                        }
                    }
                },
                U = function(e) {
                    function n() {
                        return clearTimeout(p[0].autoUpdate), 0 === s.parents("html").length ? void(s = null) : void(p[0].autoUpdate = setTimeout(function() {
                            return c.advanced.updateOnSelectorChange && (l.poll.change.n = a(), l.poll.change.n !== l.poll.change.o) ? (l.poll.change.o = l.poll.change.n, void r(3)) : c.advanced.updateOnContentResize && (l.poll.size.n = s[0].scrollHeight + s[0].scrollWidth + p[0].offsetHeight + s[0].offsetHeight + s[0].offsetWidth, l.poll.size.n !== l.poll.size.o) ? (l.poll.size.o = l.poll.size.n, void r(1)) : !c.advanced.updateOnImageLoad || "auto" === c.advanced.updateOnImageLoad && "y" === c.axis || (l.poll.img.n = p.find("img").length, l.poll.img.n === l.poll.img.o) ? void((c.advanced.updateOnSelectorChange || c.advanced.updateOnContentResize || c.advanced.updateOnImageLoad) && n()) : (l.poll.img.o = l.poll.img.n, void p.find("img").each(function() {
                                o(this)
                            }))
                        }, c.advanced.autoUpdateTimeout))
                    }

                    function o(e) {
                        function n(t, e) {
                            return function() {
                                return e.apply(t, arguments)
                            }
                        }

                        function i() {
                            this.onload = null, t(e).addClass(d[2]), r(2)
                        }
                        if (t(e).hasClass(d[2])) return void r();
                        var o = new Image;
                        o.onload = n(o, i), o.src = e.src
                    }

                    function a() {
                        c.advanced.updateOnSelectorChange === !0 && (c.advanced.updateOnSelectorChange = "*");
                        var t = 0,
                            e = p.find(c.advanced.updateOnSelectorChange);
                        return c.advanced.updateOnSelectorChange && e.length > 0 && e.each(function() {
                            t += this.offsetHeight + this.offsetWidth
                        }), t
                    }

                    function r(t) {
                        clearTimeout(p[0].autoUpdate), u.update.call(null, s[0], t)
                    }
                    var s = t(this),
                        l = s.data(i),
                        c = l.opt,
                        p = t("#mCSB_" + l.idx + "_container");
                    return e ? (clearTimeout(p[0].autoUpdate), void Q(p[0], "autoUpdate")) : void n()
                },
                q = function(t, e, n) {
                    return Math.round(t / e) * e - n
                },
                Y = function(e) {
                    var n = e.data(i),
                        o = t("#mCSB_" + n.idx + "_container,#mCSB_" + n.idx + "_container_wrapper,#mCSB_" + n.idx + "_dragger_vertical,#mCSB_" + n.idx + "_dragger_horizontal");
                    o.each(function() {
                        K.call(this)
                    })
                },
                V = function(e, n, o) {
                    function a(t) {
                        return l && c.callbacks[t] && "function" == typeof c.callbacks[t]
                    }

                    function r() {
                        return [c.callbacks.alwaysTriggerOffsets || b >= x[0] + S, c.callbacks.alwaysTriggerOffsets || -_ >= b]
                    }

                    function s() {
                        var t = [h[0].offsetTop, h[0].offsetLeft],
                            n = [y[0].offsetTop, y[0].offsetLeft],
                            i = [h.outerHeight(!1), h.outerWidth(!1)],
                            a = [p.height(), p.width()];
                        e[0].mcs = {
                            content: h,
                            top: t[0],
                            left: t[1],
                            draggerTop: n[0],
                            draggerLeft: n[1],
                            topPct: Math.round(100 * Math.abs(t[0]) / (Math.abs(i[0]) - a[0])),
                            leftPct: Math.round(100 * Math.abs(t[1]) / (Math.abs(i[1]) - a[1])),
                            direction: o.dir
                        }
                    }
                    var l = e.data(i),
                        c = l.opt,
                        d = {
                            trigger: "internal",
                            dir: "y",
                            scrollEasing: "mcsEaseOut",
                            drag: !1,
                            dur: c.scrollInertia,
                            overwrite: "all",
                            callbacks: !0,
                            onStart: !0,
                            onUpdate: !0,
                            onComplete: !0
                        },
                        o = t.extend(d, o),
                        u = [o.dur, o.drag ? 0 : o.dur],
                        p = t("#mCSB_" + l.idx),
                        h = t("#mCSB_" + l.idx + "_container"),
                        f = h.parent(),
                        m = c.callbacks.onTotalScrollOffset ? R.call(e, c.callbacks.onTotalScrollOffset) : [0, 0],
                        g = c.callbacks.onTotalScrollBackOffset ? R.call(e, c.callbacks.onTotalScrollBackOffset) : [0, 0];
                    if (l.trigger = o.trigger, (0 !== f.scrollTop() || 0 !== f.scrollLeft()) && (t(".mCSB_" + l.idx + "_scrollbar").css("visibility", "visible"), f.scrollTop(0).scrollLeft(0)), "_resetY" !== n || l.contentReset.y || (a("onOverflowYNone") && c.callbacks.onOverflowYNone.call(e[0]), l.contentReset.y = 1), "_resetX" !== n || l.contentReset.x || (a("onOverflowXNone") && c.callbacks.onOverflowXNone.call(e[0]), l.contentReset.x = 1), "_resetY" !== n && "_resetX" !== n) {
                        if (!l.contentReset.y && e[0].mcs || !l.overflowed[0] || (a("onOverflowY") && c.callbacks.onOverflowY.call(e[0]), l.contentReset.x = null), !l.contentReset.x && e[0].mcs || !l.overflowed[1] || (a("onOverflowX") && c.callbacks.onOverflowX.call(e[0]), l.contentReset.x = null), c.snapAmount) {
                            var v = c.snapAmount instanceof Array ? "x" === o.dir ? c.snapAmount[1] : c.snapAmount[0] : c.snapAmount;
                            n = q(n, v, c.snapOffset)
                        }
                        switch (o.dir) {
                            case "x":
                                var y = t("#mCSB_" + l.idx + "_dragger_horizontal"),
                                    w = "left",
                                    b = h[0].offsetLeft,
                                    x = [p.width() - h.outerWidth(!1), y.parent().width() - y.width()],
                                    C = [n, 0 === n ? 0 : n / l.scrollRatio.x],
                                    S = m[1],
                                    _ = g[1],
                                    k = S > 0 ? S / l.scrollRatio.x : 0,
                                    E = _ > 0 ? _ / l.scrollRatio.x : 0;
                                break;
                            case "y":
                                var y = t("#mCSB_" + l.idx + "_dragger_vertical"),
                                    w = "top",
                                    b = h[0].offsetTop,
                                    x = [p.height() - h.outerHeight(!1), y.parent().height() - y.height()],
                                    C = [n, 0 === n ? 0 : n / l.scrollRatio.y],
                                    S = m[0],
                                    _ = g[0],
                                    k = S > 0 ? S / l.scrollRatio.y : 0,
                                    E = _ > 0 ? _ / l.scrollRatio.y : 0
                        }
                        C[1] < 0 || 0 === C[0] && 0 === C[1] ? C = [0, 0] : C[1] >= x[1] ? C = [x[0], x[1]] : C[0] = -C[0], e[0].mcs || (s(), a("onInit") && c.callbacks.onInit.call(e[0])), clearTimeout(h[0].onCompleteTimeout), X(y[0], w, Math.round(C[1]), u[1], o.scrollEasing), (l.tweenRunning || !(0 === b && C[0] >= 0 || b === x[0] && C[0] <= x[0])) && X(h[0], w, Math.round(C[0]), u[0], o.scrollEasing, o.overwrite, {
                            onStart: function() {
                                o.callbacks && o.onStart && !l.tweenRunning && (a("onScrollStart") && (s(), c.callbacks.onScrollStart.call(e[0])), l.tweenRunning = !0, T(y), l.cbOffsets = r())
                            },
                            onUpdate: function() {
                                o.callbacks && o.onUpdate && a("whileScrolling") && (s(), c.callbacks.whileScrolling.call(e[0]))
                            },
                            onComplete: function() {
                                if (o.callbacks && o.onComplete) {
                                    "yx" === c.axis && clearTimeout(h[0].onCompleteTimeout);
                                    var t = h[0].idleTimer || 0;
                                    h[0].onCompleteTimeout = setTimeout(function() {
                                        a("onScroll") && (s(), c.callbacks.onScroll.call(e[0])), a("onTotalScroll") && C[1] >= x[1] - k && l.cbOffsets[0] && (s(), c.callbacks.onTotalScroll.call(e[0])), a("onTotalScrollBack") && C[1] <= E && l.cbOffsets[1] && (s(), c.callbacks.onTotalScrollBack.call(e[0])), l.tweenRunning = !1, h[0].idleTimer = 0, T(y, "hide")
                                    }, t)
                                }
                            }
                        })
                    }
                },
                X = function(t, e, n, i, o, a, r) {
                    function s() {
                        x.stop || (y || f.call(), y = G() - v, l(), y >= x.time && (x.time = y > x.time ? y + p - (y - x.time) : y + p - 1, x.time < y + 1 && (x.time = y + 1)), x.time < i ? x.id = h(s) : g.call())
                    }

                    function l() {
                        i > 0 ? (x.currVal = u(x.time, w, C, i, o), b[e] = Math.round(x.currVal) + "px") : b[e] = n + "px", m.call()
                    }

                    function c() {
                        p = 1e3 / 60, x.time = y + p, h = window.requestAnimationFrame ? window.requestAnimationFrame : function(t) {
                            return l(), setTimeout(t, .01)
                        }, x.id = h(s)
                    }

                    function d() {
                        null != x.id && (window.requestAnimationFrame ? window.cancelAnimationFrame(x.id) : clearTimeout(x.id), x.id = null)
                    }

                    function u(t, e, n, i, o) {
                        switch (o) {
                            case "linear":
                            case "mcsLinear":
                                return n * t / i + e;
                            case "mcsLinearOut":
                                return t /= i, t--, n * Math.sqrt(1 - t * t) + e;
                            case "easeInOutSmooth":
                                return t /= i / 2, 1 > t ? n / 2 * t * t + e : (t--, -n / 2 * (t * (t - 2) - 1) + e);
                            case "easeInOutStrong":
                                return t /= i / 2, 1 > t ? n / 2 * Math.pow(2, 10 * (t - 1)) + e : (t--, n / 2 * (-Math.pow(2, -10 * t) + 2) + e);
                            case "easeInOut":
                            case "mcsEaseInOut":
                                return t /= i / 2, 1 > t ? n / 2 * t * t * t + e : (t -= 2, n / 2 * (t * t * t + 2) + e);
                            case "easeOutSmooth":
                                return t /= i, t--, -n * (t * t * t * t - 1) + e;
                            case "easeOutStrong":
                                return n * (-Math.pow(2, -10 * t / i) + 1) + e;
                            case "easeOut":
                            case "mcsEaseOut":
                            default:
                                var a = (t /= i) * t,
                                    r = a * t;
                                return e + n * (.499999999999997 * r * a + -2.5 * a * a + 5.5 * r + -6.5 * a + 4 * t)
                        }
                    }
                    t._mTween || (t._mTween = {
                        top: {},
                        left: {}
                    });
                    var p, h, r = r || {},
                        f = r.onStart || function() {},
                        m = r.onUpdate || function() {},
                        g = r.onComplete || function() {},
                        v = G(),
                        y = 0,
                        w = t.offsetTop,
                        b = t.style,
                        x = t._mTween[e];
                    "left" === e && (w = t.offsetLeft);
                    var C = n - w;
                    x.stop = 0, "none" !== a && d(), c()
                },
                G = function() {
                    return window.performance && window.performance.now ? window.performance.now() : window.performance && window.performance.webkitNow ? window.performance.webkitNow() : Date.now ? Date.now() : (new Date).getTime()
                },
                K = function() {
                    var t = this;
                    t._mTween || (t._mTween = {
                        top: {},
                        left: {}
                    });
                    for (var e = ["top", "left"], n = 0; n < e.length; n++) {
                        var i = e[n];
                        t._mTween[i].id && (window.requestAnimationFrame ? window.cancelAnimationFrame(t._mTween[i].id) : clearTimeout(t._mTween[i].id), t._mTween[i].id = null, t._mTween[i].stop = 1)
                    }
                },
                Q = function(t, e) {
                    try {
                        delete t[e]
                    } catch (n) {
                        t[e] = null
                    }
                },
                Z = function(t) {
                    return !(t.which && 1 !== t.which)
                },
                J = function(t) {
                    var e = t.originalEvent.pointerType;
                    return !(e && "touch" !== e && 2 !== e)
                },
                tt = function(t) {
                    return !isNaN(parseFloat(t)) && isFinite(t)
                },
                et = function(t) {
                    var e = t.parents(".mCSB_container");
                    return [t.offset().top - e.offset().top, t.offset().left - e.offset().left]
                },
                nt = function() {
                    function t() {
                        var t = ["webkit", "moz", "ms", "o"];
                        if ("hidden" in document) return "hidden";
                        for (var e = 0; e < t.length; e++)
                            if (t[e] + "Hidden" in document) return t[e] + "Hidden";
                        return null
                    }
                    var e = t();
                    return !!e && document[e]
                };
            t.fn[n] = function(e) {
                return u[e] ? u[e].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e ? void t.error("Method " + e + " does not exist") : u.init.apply(this, arguments)
            }, t[n] = function(e) {
                return u[e] ? u[e].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e ? void t.error("Method " + e + " does not exist") : u.init.apply(this, arguments)
            }, t[n].defaults = a, window[n] = !0, t(window).load(function() {
                t(o)[n](), t.extend(t.expr[":"], {
                    mcsInView: t.expr[":"].mcsInView || function(e) {
                        var n, i, o = t(e),
                            a = o.parents(".mCSB_container");
                        if (a.length) return n = a.parent(), i = [a[0].offsetTop, a[0].offsetLeft], i[0] + et(o)[0] >= 0 && i[0] + et(o)[0] < n.height() - o.outerHeight(!1) && i[1] + et(o)[1] >= 0 && i[1] + et(o)[1] < n.width() - o.outerWidth(!1)
                    },
                    mcsOverflow: t.expr[":"].mcsOverflow || function(e) {
                        var n = t(e).data(i);
                        if (n) return n.overflowed[0] || n.overflowed[1]
                    }
                })
            })
        })
    }), ! function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : t("object" == typeof module && module.exports ? require("jquery") : jQuery)
    }(function(t) {
        function e(e) {
            var n = {},
                i = /^jQuery\d+$/;
            return t.each(e.attributes, function(t, e) {
                e.specified && !i.test(e.name) && (n[e.name] = e.value)
            }), n
        }

        function n(e, n) {
            var i = this,
                a = t(this);
            if (i.value === a.attr(s ? "placeholder-x" : "placeholder") && a.hasClass(h.customClass))
                if (i.value = "", a.removeClass(h.customClass), a.data("placeholder-password")) {
                    if (a = a.hide().nextAll('input[type="password"]:first').show().attr("id", a.removeAttr("id").data("placeholder-id")), e === !0) return a[0].value = n, n;
                    a.focus()
                } else i == o() && i.select()
        }

        function i(i) {
            var o, a = this,
                r = t(this),
                l = a.id;
            if (!i || "blur" !== i.type || !r.hasClass(h.customClass))
                if ("" === a.value) {
                    if ("password" === a.type) {
                        if (!r.data("placeholder-textinput")) {
                            try {
                                o = r.clone().prop({
                                    type: "text"
                                })
                            } catch (c) {
                                o = t("<input>").attr(t.extend(e(this), {
                                    type: "text"
                                }))
                            }
                            o.removeAttr("name").data({
                                "placeholder-enabled": !0,
                                "placeholder-password": r,
                                "placeholder-id": l
                            }).bind("focus.placeholder", n), r.data({
                                "placeholder-textinput": o,
                                "placeholder-id": l
                            }).before(o)
                        }
                        a.value = "", r = r.removeAttr("id").hide().prevAll('input[type="text"]:first').attr("id", r.data("placeholder-id")).show()
                    } else {
                        var d = r.data("placeholder-password");
                        d && (d[0].value = "", r.attr("id", r.data("placeholder-id")).show().nextAll('input[type="password"]:last').hide().removeAttr("id"))
                    }
                    r.addClass(h.customClass), r[0].value = r.attr(s ? "placeholder-x" : "placeholder")
                } else r.removeClass(h.customClass)
        }

        function o() {
            try {
                return document.activeElement
            } catch (t) {}
        }
        var a, r, s = !1,
            l = "[object OperaMini]" === Object.prototype.toString.call(window.operamini),
            c = "placeholder" in document.createElement("input") && !l && !s,
            d = "placeholder" in document.createElement("textarea") && !l && !s,
            u = t.valHooks,
            p = t.propHooks,
            h = {};
        c && d ? (r = t.fn.placeholder = function() {
            return this
        }, r.input = !0, r.textarea = !0) : (r = t.fn.placeholder = function(e) {
            var o = {
                customClass: "placeholder"
            };
            return h = t.extend({}, o, e), this.filter((c ? "textarea" : ":input") + "[" + (s ? "placeholder-x" : "placeholder") + "]").not("." + h.customClass).not(":radio, :checkbox, [type=hidden]").bind({
                "focus.placeholder": n,
                "blur.placeholder": i
            }).data("placeholder-enabled", !0).trigger("blur.placeholder")
        }, r.input = c, r.textarea = d, a = {
            get: function(e) {
                var n = t(e),
                    i = n.data("placeholder-password");
                return i ? i[0].value : n.data("placeholder-enabled") && n.hasClass(h.customClass) ? "" : e.value
            },
            set: function(e, a) {
                var r, s, l = t(e);
                return "" !== a && (r = l.data("placeholder-textinput"), s = l.data("placeholder-password"), r ? (n.call(r[0], !0, a) || (e.value = a), r[0].value = a) : s && (n.call(e, !0, a) || (s[0].value = a), e.value = a)), l.data("placeholder-enabled") ? ("" === a ? (e.value = a, e != o() && i.call(e)) : (l.hasClass(h.customClass) && n.call(e), e.value = a), l) : (e.value = a, l)
            }
        }, c || (u.input = a, p.value = a), d || (u.textarea = a, p.value = a), t(function() {
            t(document).delegate("form", "submit.placeholder", function() {
                var e = t("." + h.customClass, this).each(function() {
                    n.call(this, !0, "")
                });
                setTimeout(function() {
                    e.each(i)
                }, 10)
            })
        }), t(window).bind("beforeunload.placeholder", function() {
            var e = !0;
            try {
                "javascript:void(0)" === document.activeElement.toString() && (e = !1)
            } catch (n) {}
            e && t("." + h.customClass).each(function() {
                this.value = ""
            })
        }))
    }),
    function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : "object" == typeof module && module.exports ? module.exports = t(require("jquery")) : t(jQuery)
    }(function(t) {
        var e = Array.prototype.slice,
            n = Array.prototype.splice,
            i = {
                topSpacing: 0,
                bottomSpacing: 0,
                className: "is-sticky",
                wrapperClassName: "sticky-wrapper",
                center: !1,
                getWidthFrom: "",
                widthFromWrapper: !0,
                responsiveWidth: !1,
                zIndex: "auto"
            },
            o = t(window),
            a = t(document),
            r = [],
            s = o.height(),
            l = function() {
                for (var e = o.scrollTop(), n = a.height(), i = n - s, l = e > i ? i - e : 0, c = 0, d = r.length; c < d; c++) {
                    var u = r[c],
                        p = u.stickyWrapper.offset().top,
                        h = p - u.topSpacing - l;
                    if (u.stickyWrapper.css("height", u.stickyElement.outerHeight()), e <= h) null !== u.currentTop && (u.stickyElement.css({
                        width: "",
                        position: "",
                        top: "",
                        "z-index": ""
                    }), u.stickyElement.parent().removeClass(u.className), u.stickyElement.trigger("sticky-end", [u]), u.currentTop = null);
                    else {
                        var f = n - u.stickyElement.outerHeight() - u.topSpacing - u.bottomSpacing - e - l;
                        if (f < 0 ? f += u.topSpacing : f = u.topSpacing, u.currentTop !== f) {
                            var m;
                            u.getWidthFrom ? m = t(u.getWidthFrom).width() || null : u.widthFromWrapper && (m = u.stickyWrapper.width()), null == m && (m = u.stickyElement.width()), u.stickyElement.css("width", m).css("position", "fixed").css("top", f).css("z-index", u.zIndex), u.stickyElement.parent().addClass(u.className), null === u.currentTop ? u.stickyElement.trigger("sticky-start", [u]) : u.stickyElement.trigger("sticky-update", [u]), u.currentTop === u.topSpacing && u.currentTop > f || null === u.currentTop && f < u.topSpacing ? u.stickyElement.trigger("sticky-bottom-reached", [u]) : null !== u.currentTop && f === u.topSpacing && u.currentTop < f && u.stickyElement.trigger("sticky-bottom-unreached", [u]), u.currentTop = f
                        }
                        var g = u.stickyWrapper.parent(),
                            v = u.stickyElement.offset().top + u.stickyElement.outerHeight() >= g.offset().top + g.outerHeight() && u.stickyElement.offset().top <= u.topSpacing;
                        v ? u.stickyElement.css("position", "absolute").css("top", "").css("bottom", 0).css("z-index", "") : u.stickyElement.css("position", "fixed").css("top", f).css("bottom", "").css("z-index", u.zIndex);
                    }
                }
            },
            c = function() {
                s = o.height();
                for (var e = 0, n = r.length; e < n; e++) {
                    var i = r[e],
                        a = null;
                    i.getWidthFrom ? i.responsiveWidth && (a = t(i.getWidthFrom).width()) : i.widthFromWrapper && (a = i.stickyWrapper.width()), null != a && i.stickyElement.css("width", a)
                }
            },
            d = {
                init: function(e) {
                    var n = t.extend({}, i, e);
                    return this.each(function() {
                        var e = t(this),
                            o = e.attr("id"),
                            a = o ? o + "-" + i.wrapperClassName : i.wrapperClassName,
                            s = t("<div></div>").attr("id", a).addClass(n.wrapperClassName);
                        e.wrapAll(function() {
                            if (0 == t(this).parent("#" + a).length) return s
                        });
                        var l = e.parent();
                        n.center && l.css({
                            width: e.outerWidth(),
                            marginLeft: "auto",
                            marginRight: "auto"
                        }), "right" === e.css("float") && e.css({
                            "float": "none"
                        }).parent().css({
                            "float": "right"
                        }), n.stickyElement = e, n.stickyWrapper = l, n.currentTop = null, r.push(n), d.setWrapperHeight(this), d.setupChangeListeners(this)
                    })
                },
                setWrapperHeight: function(e) {
                    var n = t(e),
                        i = n.parent();
                    i && i.css("height", n.outerHeight())
                },
                setupChangeListeners: function(t) {
                    if (window.MutationObserver) {
                        var e = new window.MutationObserver(function(e) {
                            (e[0].addedNodes.length || e[0].removedNodes.length) && d.setWrapperHeight(t)
                        });
                        e.observe(t, {
                            subtree: !0,
                            childList: !0
                        })
                    } else t.addEventListener("DOMNodeInserted", function() {
                        d.setWrapperHeight(t)
                    }, !1), t.addEventListener("DOMNodeRemoved", function() {
                        d.setWrapperHeight(t)
                    }, !1)
                },
                update: l,
                unstick: function(e) {
                    return this.each(function() {
                        for (var e = this, i = t(e), o = -1, a = r.length; a-- > 0;) r[a].stickyElement.get(0) === e && (n.call(r, a, 1), o = a);
                        o !== -1 && (i.unwrap(), i.css({
                            width: "",
                            position: "",
                            top: "",
                            "float": "",
                            "z-index": ""
                        }))
                    })
                }
            };
        window.addEventListener ? (window.addEventListener("scroll", l, !1), window.addEventListener("resize", c, !1)) : window.attachEvent && (window.attachEvent("onscroll", l), window.attachEvent("onresize", c)), t.fn.sticky = function(n) {
            return d[n] ? d[n].apply(this, e.call(arguments, 1)) : "object" != typeof n && n ? void t.error("Method " + n + " does not exist on jQuery.sticky") : d.init.apply(this, arguments)
        }, t.fn.unstick = function(n) {
            return d[n] ? d[n].apply(this, e.call(arguments, 1)) : "object" != typeof n && n ? void t.error("Method " + n + " does not exist on jQuery.sticky") : d.unstick.apply(this, arguments)
        }, t(function() {
            setTimeout(l, 0)
        })
    }), ! function(t) {
        "use strict";
        t.fn.succinct = function(e) {
            var n = t.extend({
                size: 240,
                omission: "...",
                ignore: !0
            }, e);
            return this.each(function() {
                var e, i, o = t(this),
                    a = /[!-\/:-@\[-`{-~]$/,
                    r = function() {
                        o.each(function() {
                            e = t(this).html(), e.length > n.size && (i = t.trim(e).substring(0, n.size).split(" ").slice(0, -1).join(" "), n.ignore && (i = i.replace(a, "")), t(this).html(i + n.omission))
                        })
                    };
                r()
            })
        }
    }(jQuery),
    function(t) {
        var e = !1;
        if ("function" == typeof define && define.amd && (define(t), e = !0), "object" == typeof exports && (module.exports = t(), e = !0), !e) {
            var n = window.Cookies,
                i = window.Cookies = t();
            i.noConflict = function() {
                return window.Cookies = n, i
            }
        }
    }(function() {
        function t() {
            for (var t = 0, e = {}; t < arguments.length; t++) {
                var n = arguments[t];
                for (var i in n) e[i] = n[i]
            }
            return e
        }

        function e(n) {
            function i(e, o, a) {
                var r;
                if ("undefined" != typeof document) {
                    if (arguments.length > 1) {
                        if (a = t({
                                path: "/"
                            }, i.defaults, a), "number" == typeof a.expires) {
                            var s = new Date;
                            s.setMilliseconds(s.getMilliseconds() + 864e5 * a.expires), a.expires = s
                        }
                        try {
                            r = JSON.stringify(o), /^[\{\[]/.test(r) && (o = r)
                        } catch (l) {}
                        return o = n.write ? n.write(o, e) : encodeURIComponent(String(o)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent), e = encodeURIComponent(String(e)), e = e.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent), e = e.replace(/[\(\)]/g, escape), document.cookie = [e, "=", o, a.expires ? "; expires=" + a.expires.toUTCString() : "", a.path ? "; path=" + a.path : "", a.domain ? "; domain=" + a.domain : "", a.secure ? "; secure" : ""].join("")
                    }
                    e || (r = {});
                    for (var c = document.cookie ? document.cookie.split("; ") : [], d = /(%[0-9A-Z]{2})+/g, u = 0; u < c.length; u++) {
                        var p = c[u].split("="),
                            h = p.slice(1).join("=");
                        '"' === h.charAt(0) && (h = h.slice(1, -1));
                        try {
                            var f = p[0].replace(d, decodeURIComponent);
                            if (h = n.read ? n.read(h, f) : n(h, f) || h.replace(d, decodeURIComponent), this.json) try {
                                h = JSON.parse(h)
                            } catch (l) {}
                            if (e === f) {
                                r = h;
                                break
                            }
                            e || (r[f] = h)
                        } catch (l) {}
                    }
                    return r
                }
            }
            return i.set = i, i.get = function(t) {
                return i.call(i, t)
            }, i.getJSON = function() {
                return i.apply({
                    json: !0
                }, [].slice.call(arguments))
            }, i.defaults = {}, i.remove = function(e, n) {
                i(e, "", t(n, {
                    expires: -1
                }))
            }, i.withConverter = e, i
        }
        return e(function() {})
    }), ! function(t) {
        if ("function" == typeof define && define.amd) define([], t);
        else if ("object" == typeof exports) {
            var e = require("fs");
            module.exports = t(), module.exports.css = function() {
                return e.readFileSync(__dirname + "/nouislider.min.css", "utf8")
            }
        } else window.noUiSlider = t()
    }(function() {
        "use strict";

        function t(t) {
            return t.filter(function(t) {
                return !this[t] && (this[t] = !0)
            }, {})
        }

        function e(t, e) {
            return Math.round(t / e) * e
        }

        function n(t) {
            var e = t.getBoundingClientRect(),
                n = t.ownerDocument,
                i = n.defaultView || n.parentWindow,
                o = n.documentElement,
                a = i.pageXOffset;
            return /webkit.*Chrome.*Mobile/i.test(navigator.userAgent) && (a = 0), {
                top: e.top + i.pageYOffset - o.clientTop,
                left: e.left + a - o.clientLeft
            }
        }

        function i(t) {
            return "number" == typeof t && !isNaN(t) && isFinite(t)
        }

        function o(t) {
            var e = Math.pow(10, 7);
            return Number((Math.round(t * e) / e).toFixed(7))
        }

        function a(t, e, n) {
            c(t, e), setTimeout(function() {
                d(t, e)
            }, n)
        }

        function r(t) {
            return Math.max(Math.min(t, 100), 0)
        }

        function s(t) {
            return Array.isArray(t) ? t : [t]
        }

        function l(t) {
            var e = t.split(".");
            return e.length > 1 ? e[1].length : 0
        }

        function c(t, e) {
            t.classList ? t.classList.add(e) : t.className += " " + e
        }

        function d(t, e) {
            t.classList ? t.classList.remove(e) : t.className = t.className.replace(new RegExp("(^|\\b)" + e.split(" ").join("|") + "(\\b|$)", "gi"), " ")
        }

        function u(t, e) {
            t.classList ? t.classList.contains(e) : new RegExp("(^| )" + e + "( |$)", "gi").test(t.className)
        }

        function p(t, e) {
            return 100 / (e - t)
        }

        function h(t, e) {
            return 100 * e / (t[1] - t[0])
        }

        function f(t, e) {
            return h(t, t[0] < 0 ? e + Math.abs(t[0]) : e - t[0])
        }

        function m(t, e) {
            return e * (t[1] - t[0]) / 100 + t[0]
        }

        function g(t, e) {
            for (var n = 1; t >= e[n];) n += 1;
            return n
        }

        function v(t, e, n) {
            if (n >= t.slice(-1)[0]) return 100;
            var i, o, a, r, s = g(n, t);
            return i = t[s - 1], o = t[s], a = e[s - 1], r = e[s], a + f([i, o], n) / p(a, r)
        }

        function y(t, e, n) {
            if (n >= 100) return t.slice(-1)[0];
            var i, o, a, r, s = g(n, e);
            return i = t[s - 1], o = t[s], a = e[s - 1], r = e[s], m([i, o], (n - a) * p(a, r))
        }

        function w(t, n, i, o) {
            if (100 === o) return o;
            var a, r, s = g(o, t);
            return i ? (a = t[s - 1], r = t[s], o - a > (r - a) / 2 ? r : a) : n[s - 1] ? t[s - 1] + e(o - t[s - 1], n[s - 1]) : o
        }

        function b(t, e, n) {
            var o;
            if ("number" == typeof e && (e = [e]), "[object Array]" !== Object.prototype.toString.call(e)) throw new Error("noUiSlider: 'range' contains invalid value.");
            if (o = "min" === t ? 0 : "max" === t ? 100 : parseFloat(t), !i(o) || !i(e[0])) throw new Error("noUiSlider: 'range' value isn't numeric.");
            n.xPct.push(o), n.xVal.push(e[0]), o ? n.xSteps.push(!isNaN(e[1]) && e[1]) : isNaN(e[1]) || (n.xSteps[0] = e[1])
        }

        function x(t, e, n) {
            return !e || void(n.xSteps[t] = h([n.xVal[t], n.xVal[t + 1]], e) / p(n.xPct[t], n.xPct[t + 1]))
        }

        function C(t, e, n, i) {
            this.xPct = [], this.xVal = [], this.xSteps = [i || !1], this.xNumSteps = [!1], this.snap = e, this.direction = n;
            var o, a = [];
            for (o in t) t.hasOwnProperty(o) && a.push([t[o], o]);
            for (a.sort(function(t, e) {
                    return t[0] - e[0]
                }), o = 0; o < a.length; o++) b(a[o][1], a[o][0], this);
            for (this.xNumSteps = this.xSteps.slice(0), o = 0; o < this.xNumSteps.length; o++) x(o, this.xNumSteps[o], this)
        }

        function T(t, e) {
            if (!i(e)) throw new Error("noUiSlider: 'step' is not numeric.");
            t.singleStep = e
        }

        function S(t, e) {
            if ("object" != typeof e || Array.isArray(e)) throw new Error("noUiSlider: 'range' is not an object.");
            if (void 0 === e.min || void 0 === e.max) throw new Error("noUiSlider: Missing 'min' or 'max' in 'range'.");
            t.spectrum = new C(e, t.snap, t.dir, t.singleStep)
        }

        function _(t, e) {
            if (e = s(e), !Array.isArray(e) || !e.length || e.length > 2) throw new Error("noUiSlider: 'start' option is incorrect.");
            t.handles = e.length, t.start = e
        }

        function k(t, e) {
            if (t.snap = e, "boolean" != typeof e) throw new Error("noUiSlider: 'snap' option must be a boolean.")
        }

        function E(t, e) {
            if (t.animate = e, "boolean" != typeof e) throw new Error("noUiSlider: 'animate' option must be a boolean.")
        }

        function D(t, e) {
            if ("lower" === e && 1 === t.handles) t.connect = 1;
            else if ("upper" === e && 1 === t.handles) t.connect = 2;
            else if (e === !0 && 2 === t.handles) t.connect = 3;
            else {
                if (e !== !1) throw new Error("noUiSlider: 'connect' option doesn't match handle count.");
                t.connect = 0
            }
        }

        function M(t, e) {
            switch (e) {
                case "horizontal":
                    t.ort = 0;
                    break;
                case "vertical":
                    t.ort = 1;
                    break;
                default:
                    throw new Error("noUiSlider: 'orientation' option is invalid.")
            }
        }

        function O(t, e) {
            if (!i(e)) throw new Error("noUiSlider: 'margin' option must be numeric.");
            if (t.margin = t.spectrum.getMargin(e), !t.margin) throw new Error("noUiSlider: 'margin' option is only supported on linear sliders.")
        }

        function I(t, e) {
            if (!i(e)) throw new Error("noUiSlider: 'limit' option must be numeric.");
            if (t.limit = t.spectrum.getMargin(e), !t.limit) throw new Error("noUiSlider: 'limit' option is only supported on linear sliders.")
        }

        function A(t, e) {
            switch (e) {
                case "ltr":
                    t.dir = 0;
                    break;
                case "rtl":
                    t.dir = 1, t.connect = [0, 2, 1, 3][t.connect];
                    break;
                default:
                    throw new Error("noUiSlider: 'direction' option was not recognized.")
            }
        }

        function N(t, e) {
            if ("string" != typeof e) throw new Error("noUiSlider: 'behaviour' must be a string containing options.");
            var n = e.indexOf("tap") >= 0,
                i = e.indexOf("drag") >= 0,
                o = e.indexOf("fixed") >= 0,
                a = e.indexOf("snap") >= 0;
            t.events = {
                tap: n || a,
                drag: i,
                fixed: o,
                snap: a
            }
        }

        function P(t, e) {
            if (t.format = e, "function" == typeof e.to && "function" == typeof e.from) return !0;
            throw new Error("noUiSlider: 'format' requires 'to' and 'from' methods.")
        }

        function z(t) {
            var e, n = {
                margin: 0,
                limit: 0,
                animate: !0,
                format: Y
            };
            e = {
                step: {
                    r: !1,
                    t: T
                },
                start: {
                    r: !0,
                    t: _
                },
                connect: {
                    r: !0,
                    t: D
                },
                direction: {
                    r: !0,
                    t: A
                },
                snap: {
                    r: !1,
                    t: k
                },
                animate: {
                    r: !1,
                    t: E
                },
                range: {
                    r: !0,
                    t: S
                },
                orientation: {
                    r: !1,
                    t: M
                },
                margin: {
                    r: !1,
                    t: O
                },
                limit: {
                    r: !1,
                    t: I
                },
                behaviour: {
                    r: !0,
                    t: N
                },
                format: {
                    r: !1,
                    t: P
                }
            };
            var i = {
                connect: !1,
                direction: "ltr",
                behaviour: "tap",
                orientation: "horizontal"
            };
            return Object.keys(i).forEach(function(e) {
                void 0 === t[e] && (t[e] = i[e])
            }), Object.keys(e).forEach(function(i) {
                var o = e[i];
                if (void 0 === t[i]) {
                    if (o.r) throw new Error("noUiSlider: '" + i + "' is required.");
                    return !0
                }
                o.t(n, t[i])
            }), n.pips = t.pips, n.style = n.ort ? "top" : "left", n
        }

        function L(t, e, n) {
            var i = t + e[0],
                o = t + e[1];
            return n ? (0 > i && (o += Math.abs(i)), o > 100 && (i -= o - 100), [r(i), r(o)]) : [i, o]
        }

        function $(t) {
            t.preventDefault();
            var e, n, i = 0 === t.type.indexOf("touch"),
                o = 0 === t.type.indexOf("mouse"),
                a = 0 === t.type.indexOf("pointer"),
                r = t;
            return 0 === t.type.indexOf("MSPointer") && (a = !0), i && (e = t.changedTouches[0].pageX, n = t.changedTouches[0].pageY), (o || a) && (e = t.clientX + window.pageXOffset, n = t.clientY + window.pageYOffset), r.points = [e, n], r.cursor = o || a, r
        }

        function B(t, e) {
            var n = document.createElement("div"),
                i = document.createElement("div"),
                o = ["-lower", "-upper"];
            return t && o.reverse(), c(i, q[3]), c(i, q[3] + o[e]), c(n, q[2]), n.appendChild(i), n
        }

        function F(t, e, n) {
            switch (t) {
                case 1:
                    c(e, q[7]), c(n[0], q[6]);
                    break;
                case 3:
                    c(n[1], q[6]);
                case 2:
                    c(n[0], q[7]);
                case 0:
                    c(e, q[6])
            }
        }

        function H(t, e, n) {
            var i, o = [];
            for (i = 0; t > i; i += 1) o.push(n.appendChild(B(e, i)));
            return o
        }

        function j(t, e, n) {
            c(n, q[0]), c(n, q[8 + t]), c(n, q[4 + e]);
            var i = document.createElement("div");
            return c(i, q[1]), n.appendChild(i), i
        }

        function R(e, i) {
            function o(t, e, n) {
                if ("range" === t || "steps" === t) return B.xVal;
                if ("count" === t) {
                    var i, o = 100 / (e - 1),
                        a = 0;
                    for (e = [];
                        (i = a++ * o) <= 100;) e.push(i);
                    t = "positions"
                }
                return "positions" === t ? e.map(function(t) {
                    return B.fromStepping(n ? B.getStep(t) : t)
                }) : "values" === t ? n ? e.map(function(t) {
                    return B.fromStepping(B.getStep(B.toStepping(t)))
                }) : e : void 0
            }

            function p(e, n, i) {
                var o = B.direction,
                    a = {},
                    r = B.xVal[0],
                    s = B.xVal[B.xVal.length - 1],
                    l = !1,
                    c = !1,
                    d = 0;
                return B.direction = 0, i = t(i.slice().sort(function(t, e) {
                    return t - e
                })), i[0] !== r && (i.unshift(r), l = !0), i[i.length - 1] !== s && (i.push(s), c = !0), i.forEach(function(t, o) {
                    var r, s, u, p, h, f, m, g, v, y, w = t,
                        b = i[o + 1];
                    if ("steps" === n && (r = B.xNumSteps[o]), r || (r = b - w), w !== !1 && void 0 !== b)
                        for (s = w; b >= s; s += r) {
                            for (p = B.toStepping(s), h = p - d, g = h / e, v = Math.round(g), y = h / v, u = 1; v >= u; u += 1) f = d + u * y, a[f.toFixed(5)] = ["x", 0];
                            m = i.indexOf(s) > -1 ? 1 : "steps" === n ? 2 : 0, !o && l && (m = 0), s === b && c || (a[p.toFixed(5)] = [s, m]), d = p
                        }
                }), B.direction = o, a
            }

            function h(t, e, n) {
                function o(t) {
                    return ["-normal", "-large", "-sub"][t]
                }

                function a(t, e, n) {
                    return 'class="' + e + " " + e + "-" + s + " " + e + o(n[1]) + '" style="' + i.style + ": " + t + '%"'
                }

                function r(t, i) {
                    B.direction && (t = 100 - t), i[1] = i[1] && e ? e(i[0], i[1]) : i[1], l.innerHTML += "<div " + a(t, "noUi-marker", i) + "></div>", i[1] && (l.innerHTML += "<div " + a(t, "noUi-value", i) + ">" + n.to(i[0]) + "</div>")
                }
                var s = ["horizontal", "vertical"][i.ort],
                    l = document.createElement("div");
                return c(l, "noUi-pips"), c(l, "noUi-pips-" + s), Object.keys(t).forEach(function(e) {
                    r(e, t[e])
                }), l
            }

            function f(t) {
                var e = t.mode,
                    n = t.density || 1,
                    i = t.filter || !1,
                    a = t.values || !1,
                    r = t.stepped || !1,
                    s = o(e, a, r),
                    l = p(n, e, s),
                    c = t.format || {
                        to: Math.round
                    };
                return P.appendChild(h(l, i, c))
            }

            function m() {
                return A["offset" + ["Width", "Height"][i.ort]]
            }

            function g(t, e) {
                void 0 !== e && (e = Math.abs(e - i.dir)), Object.keys(W).forEach(function(n) {
                    var i = n.split(".")[0];
                    t === i && W[n].forEach(function(t) {
                        t(s(E()), e, v(Array.prototype.slice.call(R)))
                    })
                })
            }

            function v(t) {
                return 1 === t.length ? t[0] : i.dir ? t.reverse() : t
            }

            function y(t, e, n, o) {
                var a = function(e) {
                        return !P.hasAttribute("disabled") && (!u(P, q[14]) && (e = $(e), !(t === U.start && void 0 !== e.buttons && e.buttons > 1) && (e.calcPoint = e.points[i.ort], void n(e, o))))
                    },
                    r = [];
                return t.split(" ").forEach(function(t) {
                    e.addEventListener(t, a, !1), r.push([t, a])
                }), r
            }

            function w(t, e) {
                var n, i, o = e.handles || N,
                    a = !1,
                    r = 100 * (t.calcPoint - e.start) / m(),
                    s = o[0] === N[0] ? 0 : 1;
                if (n = L(r, e.positions, o.length > 1), a = S(o[0], n[s], 1 === o.length), o.length > 1) {
                    if (a = S(o[1], n[s ? 0 : 1], !1) || a)
                        for (i = 0; i < e.handles.length; i++) g("slide", i)
                } else a && g("slide", s)
            }

            function b(t, e) {
                var n = A.getElementsByClassName(q[15]),
                    i = e.handles[0] === N[0] ? 0 : 1;
                n.length && d(n[0], q[15]), t.cursor && (document.body.style.cursor = "", document.body.removeEventListener("selectstart", document.body.noUiListener));
                var o = document.documentElement;
                o.noUiListeners.forEach(function(t) {
                    o.removeEventListener(t[0], t[1])
                }), d(P, q[12]), g("set", i), g("change", i)
            }

            function x(t, e) {
                var n = document.documentElement;
                if (1 === e.handles.length && (c(e.handles[0].children[0], q[15]), e.handles[0].hasAttribute("disabled"))) return !1;
                t.stopPropagation();
                var i = y(U.move, n, w, {
                        start: t.calcPoint,
                        handles: e.handles,
                        positions: [z[0], z[N.length - 1]]
                    }),
                    o = y(U.end, n, b, {
                        handles: e.handles
                    });
                if (n.noUiListeners = i.concat(o), t.cursor) {
                    document.body.style.cursor = getComputedStyle(t.target).cursor, N.length > 1 && c(P, q[12]);
                    var a = function() {
                        return !1
                    };
                    document.body.noUiListener = a, document.body.addEventListener("selectstart", a, !1)
                }
            }

            function C(t) {
                var e, o, r = t.calcPoint,
                    s = 0;
                return t.stopPropagation(), N.forEach(function(t) {
                    s += n(t)[i.style]
                }), e = s / 2 > r || 1 === N.length ? 0 : 1, r -= n(A)[i.style], o = 100 * r / m(), i.events.snap || a(P, q[14], 300), !N[e].hasAttribute("disabled") && (S(N[e], o), g("slide", e), g("set", e), g("change", e), void(i.events.snap && x(t, {
                    handles: [N[s]]
                })))
            }

            function T(t) {
                var e, n;
                if (!t.fixed)
                    for (e = 0; e < N.length; e += 1) y(U.start, N[e].children[0], x, {
                        handles: [N[e]]
                    });
                t.tap && y(U.start, A, C, {
                    handles: N
                }), t.drag && (n = [A.getElementsByClassName(q[7])[0]], c(n[0], q[10]), t.fixed && n.push(N[n[0] === N[0] ? 1 : 0].children[0]), n.forEach(function(t) {
                    y(U.start, t, x, {
                        handles: N
                    })
                }))
            }

            function S(t, e, n) {
                var o = t !== N[0] ? 1 : 0,
                    a = z[0] + i.margin,
                    s = z[1] - i.margin,
                    l = z[0] + i.limit,
                    u = z[1] - i.limit;
                return N.length > 1 && (e = o ? Math.max(e, a) : Math.min(e, s)), n !== !1 && i.limit && N.length > 1 && (e = o ? Math.min(e, l) : Math.max(e, u)), e = B.getStep(e), e = r(parseFloat(e.toFixed(7))), e !== z[o] && (t.style[i.style] = e + "%", t.previousSibling || (d(t, q[17]), e > 50 && c(t, q[17])), z[o] = e, R[o] = B.fromStepping(e), g("update", o), !0)
            }

            function _(t, e) {
                var n, o, a;
                for (i.limit && (t += 1), n = 0; t > n; n += 1) o = n % 2, a = e[o], null !== a && a !== !1 && ("number" == typeof a && (a = String(a)), a = i.format.from(a), (a === !1 || isNaN(a) || S(N[o], B.toStepping(a), n === 3 - i.dir) === !1) && g("update", o))
            }

            function k(t) {
                var e, n, o = s(t);
                for (i.dir && i.handles > 1 && o.reverse(), i.animate && -1 !== z[0] && a(P, q[14], 300), e = N.length > 1 ? 3 : 1, 1 === o.length && (e = 1), _(e, o), n = 0; n < N.length; n++) g("set", n)
            }

            function E() {
                var t, e = [];
                for (t = 0; t < i.handles; t += 1) e[t] = i.format.to(R[t]);
                return v(e)
            }

            function D() {
                q.forEach(function(t) {
                    t && d(P, t)
                }), P.innerHTML = "", delete P.noUiSlider
            }

            function M() {
                var t = z.map(function(t, e) {
                    var n = B.getApplicableStep(t),
                        i = l(String(n[2])),
                        o = R[e],
                        a = 100 === t ? null : n[2],
                        r = Number((o - n[2]).toFixed(i)),
                        s = 0 === t ? null : r >= n[1] ? n[2] : n[0] || !1;
                    return [s, a]
                });
                return v(t)
            }

            function O(t, e) {
                W[t] = W[t] || [], W[t].push(e), "update" === t.split(".")[0] && N.forEach(function(t, e) {
                    g("update", e)
                })
            }

            function I(t) {
                var e = t.split(".")[0],
                    n = t.substring(e.length);
                Object.keys(W).forEach(function(t) {
                    var i = t.split(".")[0],
                        o = t.substring(i.length);
                    e && e !== i || n && n !== o || delete W[t]
                })
            }
            var A, N, P = e,
                z = [-1, -1],
                B = i.spectrum,
                R = [],
                W = {};
            if (P.noUiSlider) throw new Error("Slider was already initialized.");
            return A = j(i.dir, i.ort, P), N = H(i.handles, i.dir, A), F(i.connect, P, N), T(i.events), i.pips && f(i.pips), {
                destroy: D,
                steps: M,
                on: O,
                off: I,
                get: E,
                set: k
            }
        }

        function W(t, e) {
            if (!t.nodeName) throw new Error("noUiSlider.create requires a single element.");
            var n = z(e, t),
                i = R(t, n);
            i.set(n.start), t.noUiSlider = i
        }
        var U = window.navigator.pointerEnabled ? {
                start: "pointerdown",
                move: "pointermove",
                end: "pointerup"
            } : window.navigator.msPointerEnabled ? {
                start: "MSPointerDown",
                move: "MSPointerMove",
                end: "MSPointerUp"
            } : {
                start: "mousedown touchstart",
                move: "mousemove touchmove",
                end: "mouseup touchend"
            },
            q = ["noUi-target", "noUi-base", "noUi-origin", "noUi-handle", "noUi-horizontal", "noUi-vertical", "noUi-background", "noUi-connect", "noUi-ltr", "noUi-rtl", "noUi-dragable", "", "noUi-state-drag", "", "noUi-state-tap", "noUi-active", "", "noUi-stacking"];
        C.prototype.getMargin = function(t) {
            return 2 === this.xPct.length && h(this.xVal, t)
        }, C.prototype.toStepping = function(t) {
            return t = v(this.xVal, this.xPct, t), this.direction && (t = 100 - t), t
        }, C.prototype.fromStepping = function(t) {
            return this.direction && (t = 100 - t), o(y(this.xVal, this.xPct, t))
        }, C.prototype.getStep = function(t) {
            return this.direction && (t = 100 - t), t = w(this.xPct, this.xSteps, this.snap, t), this.direction && (t = 100 - t), t
        }, C.prototype.getApplicableStep = function(t) {
            var e = g(t, this.xPct),
                n = 100 === t ? 2 : 1;
            return [this.xNumSteps[e - 2], this.xVal[e - n], this.xNumSteps[e - n]]
        }, C.prototype.convert = function(t) {
            return this.getStep(this.toStepping(t))
        };
        var Y = {
            to: function(t) {
                return t.toFixed(2)
            },
            from: Number
        };
        return {
            create: W
        }
    }), ! function(t, e, n, i) {
        function o(e, n) {
            this.settings = null, this.options = t.extend({}, o.Defaults, n), this.$element = t(e), this._handlers = {}, this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._widths = [], this._invalidated = {}, this._pipe = [], this._drag = {
                time: null,
                target: null,
                pointer: null,
                stage: {
                    start: null,
                    current: null
                },
                direction: null
            }, this._states = {
                current: {},
                tags: {
                    initializing: ["busy"],
                    animating: ["busy"],
                    dragging: ["interacting"]
                }
            }, t.each(["onResize", "onThrottledResize"], t.proxy(function(e, n) {
                this._handlers[n] = t.proxy(this[n], this)
            }, this)), t.each(o.Plugins, t.proxy(function(t, e) {
                this._plugins[t.charAt(0).toLowerCase() + t.slice(1)] = new e(this)
            }, this)), t.each(o.Workers, t.proxy(function(e, n) {
                this._pipe.push({
                    filter: n.filter,
                    run: t.proxy(n.run, this)
                })
            }, this)), this.setup(), this.initialize()
        }
        o.Defaults = {
            items: 3,
            loop: !1,
            center: !1,
            rewind: !1,
            mouseDrag: !0,
            touchDrag: !0,
            pullDrag: !0,
            freeDrag: !1,
            margin: 0,
            stagePadding: 0,
            merge: !1,
            mergeFit: !0,
            autoWidth: !1,
            startPosition: 0,
            rtl: !1,
            smartSpeed: 250,
            fluidSpeed: !1,
            dragEndSpeed: !1,
            responsive: {},
            responsiveRefreshRate: 200,
            responsiveBaseElement: e,
            fallbackEasing: "swing",
            info: !1,
            nestedItemSelector: !1,
            itemElement: "div",
            stageElement: "div",
            refreshClass: "owl-refresh",
            loadedClass: "owl-loaded",
            loadingClass: "owl-loading",
            rtlClass: "owl-rtl",
            responsiveClass: "owl-responsive",
            dragClass: "owl-drag",
            itemClass: "owl-item",
            stageClass: "owl-stage",
            stageOuterClass: "owl-stage-outer",
            grabClass: "owl-grab"
        }, o.Width = {
            Default: "default",
            Inner: "inner",
            Outer: "outer"
        }, o.Type = {
            Event: "event",
            State: "state"
        }, o.Plugins = {}, o.Workers = [{
            filter: ["width", "settings"],
            run: function() {
                this._width = this.$element.width()
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(t) {
                t.current = this._items && this._items[this.relative(this._current)]
            }
        }, {
            filter: ["items", "settings"],
            run: function() {
                this.$stage.children(".cloned").remove()
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(t) {
                var e = this.settings.margin || "",
                    n = !this.settings.autoWidth,
                    i = this.settings.rtl,
                    o = {
                        width: "auto",
                        "margin-left": i ? e : "",
                        "margin-right": i ? "" : e
                    };
                !n && this.$stage.children().css(o), t.css = o
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(t) {
                var e = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
                    n = null,
                    i = this._items.length,
                    o = !this.settings.autoWidth,
                    a = [];
                for (t.items = {
                        merge: !1,
                        width: e
                    }; i--;) n = this._mergers[i], n = this.settings.mergeFit && Math.min(n, this.settings.items) || n, t.items.merge = n > 1 || t.items.merge, a[i] = o ? e * n : this._items[i].width();
                this._widths = a
            }
        }, {
            filter: ["items", "settings"],
            run: function() {
                var e = [],
                    n = this._items,
                    i = this.settings,
                    o = Math.max(2 * i.items, 4),
                    a = 2 * Math.ceil(n.length / 2),
                    r = i.loop && n.length ? i.rewind ? o : Math.max(o, a) : 0,
                    s = "",
                    l = "";
                for (r /= 2; r--;) e.push(this.normalize(e.length / 2, !0)), s += n[e[e.length - 1]][0].outerHTML, e.push(this.normalize(n.length - 1 - (e.length - 1) / 2, !0)), l = n[e[e.length - 1]][0].outerHTML + l;
                this._clones = e, t(s).addClass("cloned").appendTo(this.$stage), t(l).addClass("cloned").prependTo(this.$stage)
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function() {
                for (var t = this.settings.rtl ? 1 : -1, e = this._clones.length + this._items.length, n = -1, i = 0, o = 0, a = []; ++n < e;) i = a[n - 1] || 0, o = this._widths[this.relative(n)] + this.settings.margin, a.push(i + o * t);
                this._coordinates = a
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function() {
                var t = this.settings.stagePadding,
                    e = this._coordinates,
                    n = {
                        width: Math.ceil(Math.abs(e[e.length - 1])) + 2 * t,
                        "padding-left": t || "",
                        "padding-right": t || ""
                    };
                this.$stage.css(n)
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(t) {
                var e = this._coordinates.length,
                    n = !this.settings.autoWidth,
                    i = this.$stage.children();
                if (n && t.items.merge)
                    for (; e--;) t.css.width = this._widths[this.relative(e)], i.eq(e).css(t.css);
                else n && (t.css.width = t.items.width, i.css(t.css))
            }
        }, {
            filter: ["items"],
            run: function() {
                this._coordinates.length < 1 && this.$stage.removeAttr("style")
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(t) {
                t.current = t.current ? this.$stage.children().index(t.current) : 0, t.current = Math.max(this.minimum(), Math.min(this.maximum(), t.current)), this.reset(t.current)
            }
        }, {
            filter: ["position"],
            run: function() {
                this.animate(this.coordinates(this._current))
            }
        }, {
            filter: ["width", "position", "items", "settings"],
            run: function() {
                var t, e, n, i, o = this.settings.rtl ? 1 : -1,
                    a = 2 * this.settings.stagePadding,
                    r = this.coordinates(this.current()) + a,
                    s = r + this.width() * o,
                    l = [];
                for (n = 0, i = this._coordinates.length; i > n; n++) t = this._coordinates[n - 1] || 0, e = Math.abs(this._coordinates[n]) + a * o, (this.op(t, "<=", r) && this.op(t, ">", s) || this.op(e, "<", r) && this.op(e, ">", s)) && l.push(n);
                this.$stage.children(".active").removeClass("active"), this.$stage.children(":eq(" + l.join("), :eq(") + ")").addClass("active"), this.settings.center && (this.$stage.children(".center").removeClass("center"), this.$stage.children().eq(this.current()).addClass("center"))
            }
        }], o.prototype.initialize = function() {
            if (this.enter("initializing"), this.trigger("initialize"), this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl), this.settings.autoWidth && !this.is("pre-loading")) {
                var e, n, o;
                e = this.$element.find("img"), n = this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : i, o = this.$element.children(n).width(), e.length && 0 >= o && this.preloadAutoWidthImages(e)
            }
            this.$element.addClass(this.options.loadingClass), this.$stage = t("<" + this.settings.stageElement + ' class="' + this.settings.stageClass + '"/>').wrap('<div class="' + this.settings.stageOuterClass + '"/>'), this.$element.append(this.$stage.parent()), this.replace(this.$element.children().not(this.$stage.parent())), this.$element.is(":visible") ? this.refresh() : this.invalidate("width"), this.$element.removeClass(this.options.loadingClass).addClass(this.options.loadedClass), this.registerEventHandlers(), this.leave("initializing"), this.trigger("initialized")
        }, o.prototype.setup = function() {
            var e = this.viewport(),
                n = this.options.responsive,
                i = -1,
                o = null;
            n ? (t.each(n, function(t) {
                e >= t && t > i && (i = Number(t))
            }), o = t.extend({}, this.options, n[i]), delete o.responsive, o.responsiveClass && this.$element.attr("class", this.$element.attr("class").replace(new RegExp("(" + this.options.responsiveClass + "-)\\S+\\s", "g"), "$1" + i))) : o = t.extend({}, this.options), null !== this.settings && this._breakpoint === i || (this.trigger("change", {
                property: {
                    name: "settings",
                    value: o
                }
            }), this._breakpoint = i, this.settings = o, this.invalidate("settings"), this.trigger("changed", {
                property: {
                    name: "settings",
                    value: this.settings
                }
            }))
        }, o.prototype.optionsLogic = function() {
            this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1)
        }, o.prototype.prepare = function(e) {
            var n = this.trigger("prepare", {
                content: e
            });
            return n.data || (n.data = t("<" + this.settings.itemElement + "/>").addClass(this.options.itemClass).append(e)), this.trigger("prepared", {
                content: n.data
            }), n.data
        }, o.prototype.update = function() {
            for (var e = 0, n = this._pipe.length, i = t.proxy(function(t) {
                    return this[t]
                }, this._invalidated), o = {}; n > e;)(this._invalidated.all || t.grep(this._pipe[e].filter, i).length > 0) && this._pipe[e].run(o), e++;
            this._invalidated = {}, !this.is("valid") && this.enter("valid")
        }, o.prototype.width = function(t) {
            switch (t = t || o.Width.Default) {
                case o.Width.Inner:
                case o.Width.Outer:
                    return this._width;
                default:
                    return this._width - 2 * this.settings.stagePadding + this.settings.margin
            }
        }, o.prototype.refresh = function() {
            this.enter("refreshing"), this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$element.addClass(this.options.refreshClass), this.update(), this.$element.removeClass(this.options.refreshClass), this.leave("refreshing"), this.trigger("refreshed")
        }, o.prototype.onThrottledResize = function() {
            e.clearTimeout(this.resizeTimer), this.resizeTimer = e.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate)
        }, o.prototype.onResize = function() {
            return !!this._items.length && (this._width !== this.$element.width() && (!!this.$element.is(":visible") && (this.enter("resizing"), this.trigger("resize").isDefaultPrevented() ? (this.leave("resizing"), !1) : (this.invalidate("width"), this.refresh(), this.leave("resizing"), void this.trigger("resized")))))
        }, o.prototype.registerEventHandlers = function() {
            t.support.transition && this.$stage.on(t.support.transition.end + ".owl.core", t.proxy(this.onTransitionEnd, this)), this.settings.responsive !== !1 && this.on(e, "resize", this._handlers.onThrottledResize), this.settings.mouseDrag && (this.$element.addClass(this.options.dragClass), this.$stage.on("mousedown.owl.core", t.proxy(this.onDragStart, this)), this.$stage.on("dragstart.owl.core selectstart.owl.core", function() {
                return !1
            })), this.settings.touchDrag && (this.$stage.on("touchstart.owl.core", t.proxy(this.onDragStart, this)), this.$stage.on("touchcancel.owl.core", t.proxy(this.onDragEnd, this)))
        }, o.prototype.onDragStart = function(e) {
            var i = null;
            3 !== e.which && (t.support.transform ? (i = this.$stage.css("transform").replace(/.*\(|\)| /g, "").split(","), i = {
                x: i[16 === i.length ? 12 : 4],
                y: i[16 === i.length ? 13 : 5]
            }) : (i = this.$stage.position(), i = {
                x: this.settings.rtl ? i.left + this.$stage.width() - this.width() + this.settings.margin : i.left,
                y: i.top
            }), this.is("animating") && (t.support.transform ? this.animate(i.x) : this.$stage.stop(), this.invalidate("position")), this.$element.toggleClass(this.options.grabClass, "mousedown" === e.type), this.speed(0), this._drag.time = (new Date).getTime(), this._drag.target = t(e.target), this._drag.stage.start = i, this._drag.stage.current = i, this._drag.pointer = this.pointer(e), t(n).on("mouseup.owl.core touchend.owl.core", t.proxy(this.onDragEnd, this)), t(n).one("mousemove.owl.core touchmove.owl.core", t.proxy(function(e) {
                var i = this.difference(this._drag.pointer, this.pointer(e));
                t(n).on("mousemove.owl.core touchmove.owl.core", t.proxy(this.onDragMove, this)), Math.abs(i.x) < Math.abs(i.y) && this.is("valid") || (e.preventDefault(), this.enter("dragging"), this.trigger("drag"))
            }, this)))
        }, o.prototype.onDragMove = function(t) {
            var e = null,
                n = null,
                i = null,
                o = this.difference(this._drag.pointer, this.pointer(t)),
                a = this.difference(this._drag.stage.start, o);
            this.is("dragging") && (t.preventDefault(), this.settings.loop ? (e = this.coordinates(this.minimum()), n = this.coordinates(this.maximum() + 1) - e, a.x = ((a.x - e) % n + n) % n + e) : (e = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum()), n = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum()), i = this.settings.pullDrag ? -1 * o.x / 5 : 0, a.x = Math.max(Math.min(a.x, e + i), n + i)), this._drag.stage.current = a, this.animate(a.x))
        }, o.prototype.onDragEnd = function(e) {
            var i = this.difference(this._drag.pointer, this.pointer(e)),
                o = this._drag.stage.current,
                a = i.x > 0 ^ this.settings.rtl ? "left" : "right";
            t(n).off(".owl.core"), this.$element.removeClass(this.options.grabClass), (0 !== i.x && this.is("dragging") || !this.is("valid")) && (this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(this.closest(o.x, 0 !== i.x ? a : this._drag.direction)), this.invalidate("position"), this.update(), this._drag.direction = a, (Math.abs(i.x) > 3 || (new Date).getTime() - this._drag.time > 300) && this._drag.target.one("click.owl.core", function() {
                return !1
            })), this.is("dragging") && (this.leave("dragging"), this.trigger("dragged"))
        }, o.prototype.closest = function(e, n) {
            var i = -1,
                o = 30,
                a = this.width(),
                r = this.coordinates();
            return this.settings.freeDrag || t.each(r, t.proxy(function(t, s) {
                return "left" === n && e > s - o && s + o > e ? i = t : "right" === n && e > s - a - o && s - a + o > e ? i = t + 1 : this.op(e, "<", s) && this.op(e, ">", r[t + 1] || s - a) && (i = "left" === n ? t + 1 : t), -1 === i
            }, this)), this.settings.loop || (this.op(e, ">", r[this.minimum()]) ? i = e = this.minimum() : this.op(e, "<", r[this.maximum()]) && (i = e = this.maximum())), i
        }, o.prototype.animate = function(e) {
            var n = this.speed() > 0;
            this.is("animating") && this.onTransitionEnd(), n && (this.enter("animating"), this.trigger("translate")), t.support.transform3d && t.support.transition ? this.$stage.css({
                transform: "translate3d(" + e + "px,0px,0px)",
                transition: this.speed() / 1e3 + "s"
            }) : n ? this.$stage.animate({
                left: e + "px"
            }, this.speed(), this.settings.fallbackEasing, t.proxy(this.onTransitionEnd, this)) : this.$stage.css({
                left: e + "px"
            })
        }, o.prototype.is = function(t) {
            return this._states.current[t] && this._states.current[t] > 0
        }, o.prototype.current = function(t) {
            if (t === i) return this._current;
            if (0 === this._items.length) return i;
            if (t = this.normalize(t), this._current !== t) {
                var e = this.trigger("change", {
                    property: {
                        name: "position",
                        value: t
                    }
                });
                e.data !== i && (t = this.normalize(e.data)), this._current = t, this.invalidate("position"), this.trigger("changed", {
                    property: {
                        name: "position",
                        value: this._current
                    }
                })
            }
            return this._current
        }, o.prototype.invalidate = function(e) {
            return "string" === t.type(e) && (this._invalidated[e] = !0, this.is("valid") && this.leave("valid")), t.map(this._invalidated, function(t, e) {
                return e
            })
        }, o.prototype.reset = function(t) {
            t = this.normalize(t), t !== i && (this._speed = 0, this._current = t, this.suppress(["translate", "translated"]), this.animate(this.coordinates(t)), this.release(["translate", "translated"]))
        }, o.prototype.normalize = function(t, e) {
            var n = this._items.length,
                o = e ? 0 : this._clones.length;
            return !this.isNumeric(t) || 1 > n ? t = i : (0 > t || t >= n + o) && (t = ((t - o / 2) % n + n) % n + o / 2), t
        }, o.prototype.relative = function(t) {
            return t -= this._clones.length / 2, this.normalize(t, !0)
        }, o.prototype.maximum = function(t) {
            var e, n = this.settings,
                i = this._coordinates.length,
                o = Math.abs(this._coordinates[i - 1]) - this._width,
                a = -1;
            if (n.loop) i = this._clones.length / 2 + this._items.length - 1;
            else if (n.autoWidth || n.merge)
                for (; i - a > 1;) Math.abs(this._coordinates[e = i + a >> 1]) < o ? a = e : i = e;
            else i = n.center ? this._items.length - 1 : this._items.length - n.items;
            return t && (i -= this._clones.length / 2), Math.max(i, 0)
        }, o.prototype.minimum = function(t) {
            return t ? 0 : this._clones.length / 2
        }, o.prototype.items = function(t) {
            return t === i ? this._items.slice() : (t = this.normalize(t, !0), this._items[t])
        }, o.prototype.mergers = function(t) {
            return t === i ? this._mergers.slice() : (t = this.normalize(t, !0), this._mergers[t])
        }, o.prototype.clones = function(e) {
            var n = this._clones.length / 2,
                o = n + this._items.length,
                a = function(t) {
                    return t % 2 === 0 ? o + t / 2 : n - (t + 1) / 2
                };
            return e === i ? t.map(this._clones, function(t, e) {
                return a(e)
            }) : t.map(this._clones, function(t, n) {
                return t === e ? a(n) : null
            })
        }, o.prototype.speed = function(t) {
            return t !== i && (this._speed = t), this._speed
        }, o.prototype.coordinates = function(e) {
            var n, o = 1,
                a = e - 1;
            return e === i ? t.map(this._coordinates, t.proxy(function(t, e) {
                return this.coordinates(e)
            }, this)) : (this.settings.center ? (this.settings.rtl && (o = -1, a = e + 1), n = this._coordinates[e], n += (this.width() - n + (this._coordinates[a] || 0)) / 2 * o) : n = this._coordinates[a] || 0,
                n = Math.ceil(n))
        }, o.prototype.duration = function(t, e, n) {
            return 0 === n ? 0 : Math.min(Math.max(Math.abs(e - t), 1), 6) * Math.abs(n || this.settings.smartSpeed)
        }, o.prototype.to = function(t, e) {
            var n = this.current(),
                i = null,
                o = t - this.relative(n),
                a = (o > 0) - (0 > o),
                r = this._items.length,
                s = this.minimum(),
                l = this.maximum();
            this.settings.loop ? (!this.settings.rewind && Math.abs(o) > r / 2 && (o += -1 * a * r), t = n + o, i = ((t - s) % r + r) % r + s, i !== t && l >= i - o && i - o > 0 && (n = i - o, t = i, this.reset(n))) : this.settings.rewind ? (l += 1, t = (t % l + l) % l) : t = Math.max(s, Math.min(l, t)), this.speed(this.duration(n, t, e)), this.current(t), this.$element.is(":visible") && this.update()
        }, o.prototype.next = function(t) {
            t = t || !1, this.to(this.relative(this.current()) + 1, t)
        }, o.prototype.prev = function(t) {
            t = t || !1, this.to(this.relative(this.current()) - 1, t)
        }, o.prototype.onTransitionEnd = function(t) {
            return (t === i || (t.stopPropagation(), (t.target || t.srcElement || t.originalTarget) === this.$stage.get(0))) && (this.leave("animating"), void this.trigger("translated"))
        }, o.prototype.viewport = function() {
            var i;
            if (this.options.responsiveBaseElement !== e) i = t(this.options.responsiveBaseElement).width();
            else if (e.innerWidth) i = e.innerWidth;
            else {
                if (!n.documentElement || !n.documentElement.clientWidth) throw "Can not detect viewport width.";
                i = n.documentElement.clientWidth
            }
            return i
        }, o.prototype.replace = function(e) {
            this.$stage.empty(), this._items = [], e && (e = e instanceof jQuery ? e : t(e)), this.settings.nestedItemSelector && (e = e.find("." + this.settings.nestedItemSelector)), e.filter(function() {
                return 1 === this.nodeType
            }).each(t.proxy(function(t, e) {
                e = this.prepare(e), this.$stage.append(e), this._items.push(e), this._mergers.push(1 * e.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)
            }, this)), this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items")
        }, o.prototype.add = function(e, n) {
            var o = this.relative(this._current);
            n = n === i ? this._items.length : this.normalize(n, !0), e = e instanceof jQuery ? e : t(e), this.trigger("add", {
                content: e,
                position: n
            }), e = this.prepare(e), 0 === this._items.length || n === this._items.length ? (0 === this._items.length && this.$stage.append(e), 0 !== this._items.length && this._items[n - 1].after(e), this._items.push(e), this._mergers.push(1 * e.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)) : (this._items[n].before(e), this._items.splice(n, 0, e), this._mergers.splice(n, 0, 1 * e.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)), this._items[o] && this.reset(this._items[o].index()), this.invalidate("items"), this.trigger("added", {
                content: e,
                position: n
            })
        }, o.prototype.remove = function(t) {
            t = this.normalize(t, !0), t !== i && (this.trigger("remove", {
                content: this._items[t],
                position: t
            }), this._items[t].remove(), this._items.splice(t, 1), this._mergers.splice(t, 1), this.invalidate("items"), this.trigger("removed", {
                content: null,
                position: t
            }))
        }, o.prototype.preloadAutoWidthImages = function(e) {
            e.each(t.proxy(function(e, n) {
                this.enter("pre-loading"), n = t(n), t(new Image).one("load", t.proxy(function(t) {
                    n.attr("src", t.target.src), n.css("opacity", 1), this.leave("pre-loading"), !this.is("pre-loading") && !this.is("initializing") && this.refresh()
                }, this)).attr("src", n.attr("src") || n.attr("data-src") || n.attr("data-src-retina"))
            }, this))
        }, o.prototype.destroy = function() {
            this.$element.off(".owl.core"), this.$stage.off(".owl.core"), t(n).off(".owl.core"), this.settings.responsive !== !1 && (e.clearTimeout(this.resizeTimer), this.off(e, "resize", this._handlers.onThrottledResize));
            for (var i in this._plugins) this._plugins[i].destroy();
            this.$stage.children(".cloned").remove(), this.$stage.unwrap(), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$element.removeClass(this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(this.options.dragClass).removeClass(this.options.grabClass).attr("class", this.$element.attr("class").replace(new RegExp(this.options.responsiveClass + "-\\S+\\s", "g"), "")).removeData("owl.carousel")
        }, o.prototype.op = function(t, e, n) {
            var i = this.settings.rtl;
            switch (e) {
                case "<":
                    return i ? t > n : n > t;
                case ">":
                    return i ? n > t : t > n;
                case ">=":
                    return i ? n >= t : t >= n;
                case "<=":
                    return i ? t >= n : n >= t
            }
        }, o.prototype.on = function(t, e, n, i) {
            t.addEventListener ? t.addEventListener(e, n, i) : t.attachEvent && t.attachEvent("on" + e, n)
        }, o.prototype.off = function(t, e, n, i) {
            t.removeEventListener ? t.removeEventListener(e, n, i) : t.detachEvent && t.detachEvent("on" + e, n)
        }, o.prototype.trigger = function(e, n, i, a, r) {
            var s = {
                    item: {
                        count: this._items.length,
                        index: this.current()
                    }
                },
                l = t.camelCase(t.grep(["on", e, i], function(t) {
                    return t
                }).join("-").toLowerCase()),
                c = t.Event([e, "owl", i || "carousel"].join(".").toLowerCase(), t.extend({
                    relatedTarget: this
                }, s, n));
            return this._supress[e] || (t.each(this._plugins, function(t, e) {
                e.onTrigger && e.onTrigger(c)
            }), this.register({
                type: o.Type.Event,
                name: e
            }), this.$element.trigger(c), this.settings && "function" == typeof this.settings[l] && this.settings[l].call(this, c)), c
        }, o.prototype.enter = function(e) {
            t.each([e].concat(this._states.tags[e] || []), t.proxy(function(t, e) {
                this._states.current[e] === i && (this._states.current[e] = 0), this._states.current[e]++
            }, this))
        }, o.prototype.leave = function(e) {
            t.each([e].concat(this._states.tags[e] || []), t.proxy(function(t, e) {
                this._states.current[e]--
            }, this))
        }, o.prototype.register = function(e) {
            if (e.type === o.Type.Event) {
                if (t.event.special[e.name] || (t.event.special[e.name] = {}), !t.event.special[e.name].owl) {
                    var n = t.event.special[e.name]._default;
                    t.event.special[e.name]._default = function(t) {
                        return !n || !n.apply || t.namespace && -1 !== t.namespace.indexOf("owl") ? t.namespace && t.namespace.indexOf("owl") > -1 : n.apply(this, arguments)
                    }, t.event.special[e.name].owl = !0
                }
            } else e.type === o.Type.State && (this._states.tags[e.name] ? this._states.tags[e.name] = this._states.tags[e.name].concat(e.tags) : this._states.tags[e.name] = e.tags, this._states.tags[e.name] = t.grep(this._states.tags[e.name], t.proxy(function(n, i) {
                return t.inArray(n, this._states.tags[e.name]) === i
            }, this)))
        }, o.prototype.suppress = function(e) {
            t.each(e, t.proxy(function(t, e) {
                this._supress[e] = !0
            }, this))
        }, o.prototype.release = function(e) {
            t.each(e, t.proxy(function(t, e) {
                delete this._supress[e]
            }, this))
        }, o.prototype.pointer = function(t) {
            var n = {
                x: null,
                y: null
            };
            return t = t.originalEvent || t || e.event, t = t.touches && t.touches.length ? t.touches[0] : t.changedTouches && t.changedTouches.length ? t.changedTouches[0] : t, t.pageX ? (n.x = t.pageX, n.y = t.pageY) : (n.x = t.clientX, n.y = t.clientY), n
        }, o.prototype.isNumeric = function(t) {
            return !isNaN(parseFloat(t))
        }, o.prototype.difference = function(t, e) {
            return {
                x: t.x - e.x,
                y: t.y - e.y
            }
        }, t.fn.owlCarousel = function(e) {
            var n = Array.prototype.slice.call(arguments, 1);
            return this.each(function() {
                var i = t(this),
                    a = i.data("owl.carousel");
                a || (a = new o(this, "object" == typeof e && e), i.data("owl.carousel", a), t.each(["next", "prev", "to", "destroy", "refresh", "replace", "add", "remove"], function(e, n) {
                    a.register({
                        type: o.Type.Event,
                        name: n
                    }), a.$element.on(n + ".owl.carousel.core", t.proxy(function(t) {
                        t.namespace && t.relatedTarget !== this && (this.suppress([n]), a[n].apply(this, [].slice.call(arguments, 1)), this.release([n]))
                    }, a))
                })), "string" == typeof e && "_" !== e.charAt(0) && a[e].apply(a, n)
            })
        }, t.fn.owlCarousel.Constructor = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        var o = function(e) {
            this._core = e, this._interval = null, this._visible = null, this._handlers = {
                "initialized.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.settings.autoRefresh && this.watch()
                }, this)
            }, this._core.options = t.extend({}, o.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        o.Defaults = {
            autoRefresh: !0,
            autoRefreshInterval: 500
        }, o.prototype.watch = function() {
            this._interval || (this._visible = this._core.$element.is(":visible"), this._interval = e.setInterval(t.proxy(this.refresh, this), this._core.settings.autoRefreshInterval))
        }, o.prototype.refresh = function() {
            this._core.$element.is(":visible") !== this._visible && (this._visible = !this._visible, this._core.$element.toggleClass("owl-hidden", !this._visible), this._visible && this._core.invalidate("width") && this._core.refresh())
        }, o.prototype.destroy = function() {
            var t, n;
            e.clearInterval(this._interval);
            for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
            for (n in Object.getOwnPropertyNames(this)) "function" != typeof this[n] && (this[n] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.AutoRefresh = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        var o = function(e) {
            this._core = e, this._loaded = [], this._handlers = {
                "initialized.owl.carousel change.owl.carousel resized.owl.carousel": t.proxy(function(e) {
                    if (e.namespace && this._core.settings && this._core.settings.lazyLoad && (e.property && "position" == e.property.name || "initialized" == e.type))
                        for (var n = this._core.settings, o = n.center && Math.ceil(n.items / 2) || n.items, a = n.center && -1 * o || 0, r = (e.property && e.property.value !== i ? e.property.value : this._core.current()) + a, s = this._core.clones().length, l = t.proxy(function(t, e) {
                                this.load(e)
                            }, this); a++ < o;) this.load(s / 2 + this._core.relative(r)), s && t.each(this._core.clones(this._core.relative(r)), l), r++
                }, this)
            }, this._core.options = t.extend({}, o.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        o.Defaults = {
            lazyLoad: !1
        }, o.prototype.load = function(n) {
            var i = this._core.$stage.children().eq(n),
                o = i && i.find(".owl-lazy");
            !o || t.inArray(i.get(0), this._loaded) > -1 || (o.each(t.proxy(function(n, i) {
                var o, a = t(i),
                    r = e.devicePixelRatio > 1 && a.attr("data-src-retina") || a.attr("data-src");
                this._core.trigger("load", {
                    element: a,
                    url: r
                }, "lazy"), a.is("img") ? a.one("load.owl.lazy", t.proxy(function() {
                    a.css("opacity", 1), this._core.trigger("loaded", {
                        element: a,
                        url: r
                    }, "lazy")
                }, this)).attr("src", r) : (o = new Image, o.onload = t.proxy(function() {
                    a.css({
                        "background-image": "url(" + r + ")",
                        opacity: "1"
                    }), this._core.trigger("loaded", {
                        element: a,
                        url: r
                    }, "lazy")
                }, this), o.src = r)
            }, this)), this._loaded.push(i.get(0)))
        }, o.prototype.destroy = function() {
            var t, e;
            for (t in this.handlers) this._core.$element.off(t, this.handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Lazy = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        var o = function(e) {
            this._core = e, this._handlers = {
                "initialized.owl.carousel refreshed.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.settings.autoHeight && this.update()
                }, this),
                "changed.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.settings.autoHeight && "position" == t.property.name && this.update()
                }, this),
                "loaded.owl.lazy": t.proxy(function(t) {
                    t.namespace && this._core.settings.autoHeight && t.element.closest("." + this._core.settings.itemClass).index() === this._core.current() && this.update()
                }, this)
            }, this._core.options = t.extend({}, o.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        o.Defaults = {
            autoHeight: !1,
            autoHeightClass: "owl-height"
        }, o.prototype.update = function() {
            var e = this._core._current,
                n = e + this._core.settings.items,
                i = this._core.$stage.children().toArray().slice(e, n),
                o = [],
                a = 0;
            t.each(i, function(e, n) {
                o.push(t(n).height())
            }), a = Math.max.apply(null, o), this._core.$stage.parent().height(a).addClass(this._core.settings.autoHeightClass)
        }, o.prototype.destroy = function() {
            var t, e;
            for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.AutoHeight = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        var o = function(e) {
            this._core = e, this._videos = {}, this._playing = null, this._handlers = {
                "initialized.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.register({
                        type: "state",
                        name: "playing",
                        tags: ["interacting"]
                    })
                }, this),
                "resize.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.settings.video && this.isInFullScreen() && t.preventDefault()
                }, this),
                "refreshed.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.is("resizing") && this._core.$stage.find(".cloned .owl-video-frame").remove()
                }, this),
                "changed.owl.carousel": t.proxy(function(t) {
                    t.namespace && "position" === t.property.name && this._playing && this.stop()
                }, this),
                "prepared.owl.carousel": t.proxy(function(e) {
                    if (e.namespace) {
                        var n = t(e.content).find(".owl-video");
                        n.length && (n.css("display", "none"), this.fetch(n, t(e.content)))
                    }
                }, this)
            }, this._core.options = t.extend({}, o.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", t.proxy(function(t) {
                this.play(t)
            }, this))
        };
        o.Defaults = {
            video: !1,
            videoHeight: !1,
            videoWidth: !1
        }, o.prototype.fetch = function(t, e) {
            var n = function() {
                    return t.attr("data-vimeo-id") ? "vimeo" : t.attr("data-vzaar-id") ? "vzaar" : "youtube"
                }(),
                i = t.attr("data-vimeo-id") || t.attr("data-youtube-id") || t.attr("data-vzaar-id"),
                o = t.attr("data-width") || this._core.settings.videoWidth,
                a = t.attr("data-height") || this._core.settings.videoHeight,
                r = t.attr("href");
            if (!r) throw new Error("Missing video URL.");
            if (i = r.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/), i[3].indexOf("youtu") > -1) n = "youtube";
            else if (i[3].indexOf("vimeo") > -1) n = "vimeo";
            else {
                if (!(i[3].indexOf("vzaar") > -1)) throw new Error("Video URL not supported.");
                n = "vzaar"
            }
            i = i[6], this._videos[r] = {
                type: n,
                id: i,
                width: o,
                height: a
            }, e.attr("data-video", r), this.thumbnail(t, this._videos[r])
        }, o.prototype.thumbnail = function(e, n) {
            var i, o, a, r = n.width && n.height ? 'style="width:' + n.width + "px;height:" + n.height + 'px;"' : "",
                s = e.find("img"),
                l = "src",
                c = "",
                d = this._core.settings,
                u = function(t) {
                    o = '<div class="owl-video-play-icon"></div>', i = d.lazyLoad ? '<div class="owl-video-tn ' + c + '" ' + l + '="' + t + '"></div>' : '<div class="owl-video-tn" style="opacity:1;background-image:url(' + t + ')"></div>', e.after(i), e.after(o)
                };
            return e.wrap('<div class="owl-video-wrapper"' + r + "></div>"), this._core.settings.lazyLoad && (l = "data-src", c = "owl-lazy"), s.length ? (u(s.attr(l)), s.remove(), !1) : void("youtube" === n.type ? (a = "//img.youtube.com/vi/" + n.id + "/hqdefault.jpg", u(a)) : "vimeo" === n.type ? t.ajax({
                type: "GET",
                url: "//vimeo.com/api/v2/video/" + n.id + ".json",
                jsonp: "callback",
                dataType: "jsonp",
                success: function(t) {
                    a = t[0].thumbnail_large, u(a)
                }
            }) : "vzaar" === n.type && t.ajax({
                type: "GET",
                url: "//vzaar.com/api/videos/" + n.id + ".json",
                jsonp: "callback",
                dataType: "jsonp",
                success: function(t) {
                    a = t.framegrab_url, u(a)
                }
            }))
        }, o.prototype.stop = function() {
            this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null, this._core.leave("playing"), this._core.trigger("stopped", null, "video")
        }, o.prototype.play = function(e) {
            var n, i = t(e.target),
                o = i.closest("." + this._core.settings.itemClass),
                a = this._videos[o.attr("data-video")],
                r = a.width || "100%",
                s = a.height || this._core.$stage.height();
            this._playing || (this._core.enter("playing"), this._core.trigger("play", null, "video"), o = this._core.items(this._core.relative(o.index())), this._core.reset(o.index()), "youtube" === a.type ? n = '<iframe width="' + r + '" height="' + s + '" src="//www.youtube.com/embed/' + a.id + "?autoplay=1&v=" + a.id + '" frameborder="0" allowfullscreen></iframe>' : "vimeo" === a.type ? n = '<iframe src="//player.vimeo.com/video/' + a.id + '?autoplay=1" width="' + r + '" height="' + s + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' : "vzaar" === a.type && (n = '<iframe frameborder="0"height="' + s + '"width="' + r + '" allowfullscreen mozallowfullscreen webkitAllowFullScreen src="//view.vzaar.com/' + a.id + '/player?autoplay=true"></iframe>'), t('<div class="owl-video-frame">' + n + "</div>").insertAfter(o.find(".owl-video")), this._playing = o.addClass("owl-video-playing"))
        }, o.prototype.isInFullScreen = function() {
            var e = n.fullscreenElement || n.mozFullScreenElement || n.webkitFullscreenElement;
            return e && t(e).parent().hasClass("owl-video-frame")
        }, o.prototype.destroy = function() {
            var t, e;
            this._core.$element.off("click.owl.video");
            for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Video = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        var o = function(e) {
            this.core = e, this.core.options = t.extend({}, o.Defaults, this.core.options), this.swapping = !0, this.previous = i, this.next = i, this.handlers = {
                "change.owl.carousel": t.proxy(function(t) {
                    t.namespace && "position" == t.property.name && (this.previous = this.core.current(), this.next = t.property.value)
                }, this),
                "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": t.proxy(function(t) {
                    t.namespace && (this.swapping = "translated" == t.type)
                }, this),
                "translate.owl.carousel": t.proxy(function(t) {
                    t.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap()
                }, this)
            }, this.core.$element.on(this.handlers)
        };
        o.Defaults = {
            animateOut: !1,
            animateIn: !1
        }, o.prototype.swap = function() {
            if (1 === this.core.settings.items && t.support.animation && t.support.transition) {
                this.core.speed(0);
                var e, n = t.proxy(this.clear, this),
                    i = this.core.$stage.children().eq(this.previous),
                    o = this.core.$stage.children().eq(this.next),
                    a = this.core.settings.animateIn,
                    r = this.core.settings.animateOut;
                this.core.current() !== this.previous && (r && (e = this.core.coordinates(this.previous) - this.core.coordinates(this.next), i.one(t.support.animation.end, n).css({
                    left: e + "px"
                }).addClass("animated owl-animated-out").addClass(r)), a && o.one(t.support.animation.end, n).addClass("animated owl-animated-in").addClass(a))
            }
        }, o.prototype.clear = function(e) {
            t(e.target).css({
                left: ""
            }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.onTransitionEnd()
        }, o.prototype.destroy = function() {
            var t, e;
            for (t in this.handlers) this.core.$element.off(t, this.handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Animate = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        var o = function(e) {
            this._core = e, this._timeout = null, this._paused = !1, this._handlers = {
                "changed.owl.carousel": t.proxy(function(t) {
                    t.namespace && "settings" === t.property.name ? this._core.settings.autoplay ? this.play() : this.stop() : t.namespace && "position" === t.property.name && this._core.settings.autoplay && this._setAutoPlayInterval()
                }, this),
                "initialized.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.settings.autoplay && this.play()
                }, this),
                "play.owl.autoplay": t.proxy(function(t, e, n) {
                    t.namespace && this.play(e, n)
                }, this),
                "stop.owl.autoplay": t.proxy(function(t) {
                    t.namespace && this.stop()
                }, this),
                "mouseover.owl.autoplay": t.proxy(function() {
                    this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause()
                }, this),
                "mouseleave.owl.autoplay": t.proxy(function() {
                    this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.play()
                }, this),
                "touchstart.owl.core": t.proxy(function() {
                    this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause()
                }, this),
                "touchend.owl.core": t.proxy(function() {
                    this._core.settings.autoplayHoverPause && this.play()
                }, this)
            }, this._core.$element.on(this._handlers), this._core.options = t.extend({}, o.Defaults, this._core.options)
        };
        o.Defaults = {
            autoplay: !1,
            autoplayTimeout: 5e3,
            autoplayHoverPause: !1,
            autoplaySpeed: !1
        }, o.prototype.play = function(t, e) {
            this._paused = !1, this._core.is("rotating") || (this._core.enter("rotating"), this._setAutoPlayInterval())
        }, o.prototype._getNextTimeout = function(i, o) {
            return this._timeout && e.clearTimeout(this._timeout), e.setTimeout(t.proxy(function() {
                this._paused || this._core.is("busy") || this._core.is("interacting") || n.hidden || this._core.next(o || this._core.settings.autoplaySpeed)
            }, this), i || this._core.settings.autoplayTimeout)
        }, o.prototype._setAutoPlayInterval = function() {
            this._timeout = this._getNextTimeout()
        }, o.prototype.stop = function() {
            this._core.is("rotating") && (e.clearTimeout(this._timeout), this._core.leave("rotating"))
        }, o.prototype.pause = function() {
            this._core.is("rotating") && (this._paused = !0)
        }, o.prototype.destroy = function() {
            var t, e;
            this.stop();
            for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.autoplay = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        "use strict";
        var o = function(e) {
            this._core = e, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = {
                next: this._core.next,
                prev: this._core.prev,
                to: this._core.to
            }, this._handlers = {
                "prepared.owl.carousel": t.proxy(function(e) {
                    e.namespace && this._core.settings.dotsData && this._templates.push('<div class="' + this._core.settings.dotClass + '">' + t(e.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot") + "</div>")
                }, this),
                "added.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.settings.dotsData && this._templates.splice(t.position, 0, this._templates.pop())
                }, this),
                "remove.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._core.settings.dotsData && this._templates.splice(t.position, 1)
                }, this),
                "changed.owl.carousel": t.proxy(function(t) {
                    t.namespace && "position" == t.property.name && this.draw()
                }, this),
                "initialized.owl.carousel": t.proxy(function(t) {
                    t.namespace && !this._initialized && (this._core.trigger("initialize", null, "navigation"), this.initialize(), this.update(), this.draw(), this._initialized = !0, this._core.trigger("initialized", null, "navigation"))
                }, this),
                "refreshed.owl.carousel": t.proxy(function(t) {
                    t.namespace && this._initialized && (this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation"))
                }, this)
            }, this._core.options = t.extend({}, o.Defaults, this._core.options), this.$element.on(this._handlers)
        };
        o.Defaults = {
            nav: !1,
            navText: ["prev", "next"],
            navSpeed: !1,
            navElement: "div",
            navContainer: !1,
            navContainerClass: "owl-nav",
            navClass: ["owl-prev", "owl-next"],
            slideBy: 1,
            dotClass: "owl-dot",
            dotsClass: "owl-dots",
            dots: !0,
            dotsEach: !1,
            dotsData: !1,
            dotsSpeed: !1,
            dotsContainer: !1
        }, o.prototype.initialize = function() {
            var e, n = this._core.settings;
            this._controls.$relative = (n.navContainer ? t(n.navContainer) : t("<div>").addClass(n.navContainerClass).appendTo(this.$element)).addClass("disabled"), this._controls.$previous = t("<" + n.navElement + ">").addClass(n.navClass[0]).html(n.navText[0]).prependTo(this._controls.$relative).on("click", t.proxy(function(t) {
                this.prev(n.navSpeed)
            }, this)), this._controls.$next = t("<" + n.navElement + ">").addClass(n.navClass[1]).html(n.navText[1]).appendTo(this._controls.$relative).on("click", t.proxy(function(t) {
                this.next(n.navSpeed)
            }, this)), n.dotsData || (this._templates = [t("<div>").addClass(n.dotClass).append(t("<span>")).prop("outerHTML")]), this._controls.$absolute = (n.dotsContainer ? t(n.dotsContainer) : t("<div>").addClass(n.dotsClass).appendTo(this.$element)).addClass("disabled"), this._controls.$absolute.on("click", "div", t.proxy(function(e) {
                var i = t(e.target).parent().is(this._controls.$absolute) ? t(e.target).index() : t(e.target).parent().index();
                e.preventDefault(), this.to(i, n.dotsSpeed)
            }, this));
            for (e in this._overrides) this._core[e] = t.proxy(this[e], this)
        }, o.prototype.destroy = function() {
            var t, e, n, i;
            for (t in this._handlers) this.$element.off(t, this._handlers[t]);
            for (e in this._controls) this._controls[e].remove();
            for (i in this.overides) this._core[i] = this._overrides[i];
            for (n in Object.getOwnPropertyNames(this)) "function" != typeof this[n] && (this[n] = null)
        }, o.prototype.update = function() {
            var t, e, n, i = this._core.clones().length / 2,
                o = i + this._core.items().length,
                a = this._core.maximum(!0),
                r = this._core.settings,
                s = r.center || r.autoWidth || r.dotsData ? 1 : r.dotsEach || r.items;
            if ("page" !== r.slideBy && (r.slideBy = Math.min(r.slideBy, r.items)), r.dots || "page" == r.slideBy)
                for (this._pages = [], t = i, e = 0, n = 0; o > t; t++) {
                    if (e >= s || 0 === e) {
                        if (this._pages.push({
                                start: Math.min(a, t - i),
                                end: t - i + s - 1
                            }), Math.min(a, t - i) === a) break;
                        e = 0, ++n
                    }
                    e += this._core.mergers(this._core.relative(t))
                }
        }, o.prototype.draw = function() {
            var e, n = this._core.settings,
                i = this._core.items().length <= n.items,
                o = this._core.relative(this._core.current()),
                a = n.loop || n.rewind;
            this._controls.$relative.toggleClass("disabled", !n.nav || i), n.nav && (this._controls.$previous.toggleClass("disabled", !a && o <= this._core.minimum(!0)), this._controls.$next.toggleClass("disabled", !a && o >= this._core.maximum(!0))), this._controls.$absolute.toggleClass("disabled", !n.dots || i), n.dots && (e = this._pages.length - this._controls.$absolute.children().length, n.dotsData && 0 !== e ? this._controls.$absolute.html(this._templates.join("")) : e > 0 ? this._controls.$absolute.append(new Array(e + 1).join(this._templates[0])) : 0 > e && this._controls.$absolute.children().slice(e).remove(), this._controls.$absolute.find(".active").removeClass("active"), this._controls.$absolute.children().eq(t.inArray(this.current(), this._pages)).addClass("active"))
        }, o.prototype.onTrigger = function(e) {
            var n = this._core.settings;
            e.page = {
                index: t.inArray(this.current(), this._pages),
                count: this._pages.length,
                size: n && (n.center || n.autoWidth || n.dotsData ? 1 : n.dotsEach || n.items)
            }
        }, o.prototype.current = function() {
            var e = this._core.relative(this._core.current());
            return t.grep(this._pages, t.proxy(function(t, n) {
                return t.start <= e && t.end >= e
            }, this)).pop()
        }, o.prototype.getPosition = function(e) {
            var n, i, o = this._core.settings;
            return "page" == o.slideBy ? (n = t.inArray(this.current(), this._pages), i = this._pages.length, e ? ++n : --n, n = this._pages[(n % i + i) % i].start) : (n = this._core.relative(this._core.current()), i = this._core.items().length, e ? n += o.slideBy : n -= o.slideBy), n
        }, o.prototype.next = function(e) {
            t.proxy(this._overrides.to, this._core)(this.getPosition(!0), e)
        }, o.prototype.prev = function(e) {
            t.proxy(this._overrides.to, this._core)(this.getPosition(!1), e)
        }, o.prototype.to = function(e, n, i) {
            var o;
            !i && this._pages.length ? (o = this._pages.length, t.proxy(this._overrides.to, this._core)(this._pages[(e % o + o) % o].start, n)) : t.proxy(this._overrides.to, this._core)(e, n)
        }, t.fn.owlCarousel.Constructor.Plugins.Navigation = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        "use strict";
        var o = function(n) {
            this._core = n, this._hashes = {}, this.$element = this._core.$element, this._handlers = {
                "initialized.owl.carousel": t.proxy(function(n) {
                    n.namespace && "URLHash" === this._core.settings.startPosition && t(e).trigger("hashchange.owl.navigation")
                }, this),
                "prepared.owl.carousel": t.proxy(function(e) {
                    if (e.namespace) {
                        var n = t(e.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash");
                        if (!n) return;
                        this._hashes[n] = e.content
                    }
                }, this),
                "changed.owl.carousel": t.proxy(function(n) {
                    if (n.namespace && "position" === n.property.name) {
                        var i = this._core.items(this._core.relative(this._core.current())),
                            o = t.map(this._hashes, function(t, e) {
                                return t === i ? e : null
                            }).join();
                        if (!o || e.location.hash.slice(1) === o) return;
                        e.location.hash = o
                    }
                }, this)
            }, this._core.options = t.extend({}, o.Defaults, this._core.options), this.$element.on(this._handlers), t(e).on("hashchange.owl.navigation", t.proxy(function(t) {
                var n = e.location.hash.substring(1),
                    o = this._core.$stage.children(),
                    a = this._hashes[n] && o.index(this._hashes[n]);
                a !== i && a !== this._core.current() && this._core.to(this._core.relative(a), !1, !0)
            }, this))
        };
        o.Defaults = {
            URLhashListener: !1
        }, o.prototype.destroy = function() {
            var n, i;
            t(e).off("hashchange.owl.navigation");
            for (n in this._handlers) this._core.$element.off(n, this._handlers[n]);
            for (i in Object.getOwnPropertyNames(this)) "function" != typeof this[i] && (this[i] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Hash = o
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, n, i) {
        function o(e, n) {
            var o = !1,
                a = e.charAt(0).toUpperCase() + e.slice(1);
            return t.each((e + " " + s.join(a + " ") + a).split(" "), function(t, e) {
                return r[e] !== i ? (o = !n || e, !1) : void 0
            }), o
        }

        function a(t) {
            return o(t, !0)
        }
        var r = t("<support>").get(0).style,
            s = "Webkit Moz O ms".split(" "),
            l = {
                transition: {
                    end: {
                        WebkitTransition: "webkitTransitionEnd",
                        MozTransition: "transitionend",
                        OTransition: "oTransitionEnd",
                        transition: "transitionend"
                    }
                },
                animation: {
                    end: {
                        WebkitAnimation: "webkitAnimationEnd",
                        MozAnimation: "animationend",
                        OAnimation: "oAnimationEnd",
                        animation: "animationend"
                    }
                }
            },
            c = {
                csstransforms: function() {
                    return !!o("transform")
                },
                csstransforms3d: function() {
                    return !!o("perspective")
                },
                csstransitions: function() {
                    return !!o("transition")
                },
                cssanimations: function() {
                    return !!o("animation")
                }
            };
        c.csstransitions() && (t.support.transition = new String(a("transition")), t.support.transition.end = l.transition.end[t.support.transition]), c.cssanimations() && (t.support.animation = new String(a("animation")), t.support.animation.end = l.animation.end[t.support.animation]), c.csstransforms() && (t.support.transform = new String(a("transform")), t.support.transform3d = c.csstransforms3d())
    }(window.Zepto || window.jQuery, window, document), ! function(t, e, n) {
        "use strict";

        function i(n) {
            if (o = e.documentElement, a = e.body, q(), st = this, n = n || {}, pt = n.constants || {}, n.easing)
                for (var i in n.easing) X[i] = n.easing[i];
            wt = n.edgeStrategy || "set", dt = {
                beforerender: n.beforerender,
                render: n.render,
                keyframe: n.keyframe
            }, ut = n.forceHeight !== !1, ut && (Lt = n.scale || 1), ht = n.mobileDeceleration || S, mt = n.smoothScrolling !== !1, gt = n.smoothScrollingDuration || k, vt = {
                targetTop: st.getScrollTop()
            }, Ut = (n.mobileCheck || function() {
                return /Android|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent || navigator.vendor || t.opera)
            })(), Ut ? (ct = e.getElementById(n.skrollrBody || _), ct && rt(), G(), Ot(o, [y, x], [w])) : Ot(o, [y, b], [w]), st.refresh(), Ct(t, "resize orientationchange", function() {
                var t = o.clientWidth,
                    e = o.clientHeight;
                (e !== jt || t !== Ht) && (jt = e, Ht = t, Rt = !0)
            });
            var r = Y();
            return function s() {
                Z(), xt = r(s)
            }(), st
        }
        var o, a, r = {
                get: function() {
                    return st
                },
                init: function(t) {
                    return st || new i(t)
                },
                VERSION: "0.6.30"
            },
            s = Object.prototype.hasOwnProperty,
            l = t.Math,
            c = t.getComputedStyle,
            d = "touchstart",
            u = "touchmove",
            p = "touchcancel",
            h = "touchend",
            f = "skrollable",
            m = f + "-before",
            g = f + "-between",
            v = f + "-after",
            y = "skrollr",
            w = "no-" + y,
            b = y + "-desktop",
            x = y + "-mobile",
            C = "linear",
            T = 1e3,
            S = .004,
            _ = "skrollr-body",
            k = 200,
            E = "start",
            D = "end",
            M = "center",
            O = "bottom",
            I = "___skrollable_id",
            A = /^(?:input|textarea|button|select)$/i,
            N = /^\s+|\s+$/g,
            P = /^data(?:-(_\w+))?(?:-?(-?\d*\.?\d+p?))?(?:-?(start|end|top|center|bottom))?(?:-?(top|center|bottom))?$/,
            z = /\s*(@?[\w\-\[\]]+)\s*:\s*(.+?)\s*(?:;|$)/gi,
            L = /^(@?[a-z\-]+)\[(\w+)\]$/,
            $ = /-([a-z0-9_])/g,
            B = function(t, e) {
                return e.toUpperCase()
            },
            F = /[\-+]?[\d]*\.?[\d]+/g,
            H = /\{\?\}/g,
            j = /rgba?\(\s*-?\d+\s*,\s*-?\d+\s*,\s*-?\d+/g,
            R = /[a-z\-]+-gradient/g,
            W = "",
            U = "",
            q = function() {
                var t = /^(?:O|Moz|webkit|ms)|(?:-(?:o|moz|webkit|ms)-)/;
                if (c) {
                    var e = c(a, null);
                    for (var n in e)
                        if (W = n.match(t) || +n == n && e[n].match(t)) break;
                    if (!W) return void(W = U = "");
                    W = W[0], "-" === W.slice(0, 1) ? (U = W, W = {
                        "-webkit-": "webkit",
                        "-moz-": "Moz",
                        "-ms-": "ms",
                        "-o-": "O"
                    }[W]) : U = "-" + W.toLowerCase() + "-"
                }
            },
            Y = function() {
                var e = t.requestAnimationFrame || t[W.toLowerCase() + "RequestAnimationFrame"],
                    n = Nt();
                return (Ut || !e) && (e = function(e) {
                    var i = Nt() - n,
                        o = l.max(0, 1e3 / 60 - i);
                    return t.setTimeout(function() {
                        n = Nt(), e()
                    }, o)
                }), e
            },
            V = function() {
                var e = t.cancelAnimationFrame || t[W.toLowerCase() + "CancelAnimationFrame"];
                return (Ut || !e) && (e = function(e) {
                    return t.clearTimeout(e)
                }), e
            },
            X = {
                begin: function() {
                    return 0
                },
                end: function() {
                    return 1
                },
                linear: function(t) {
                    return t
                },
                quadratic: function(t) {
                    return t * t
                },
                cubic: function(t) {
                    return t * t * t
                },
                swing: function(t) {
                    return -l.cos(t * l.PI) / 2 + .5
                },
                sqrt: function(t) {
                    return l.sqrt(t)
                },
                outCubic: function(t) {
                    return l.pow(t - 1, 3) + 1
                },
                bounce: function(t) {
                    var e;
                    if (.5083 >= t) e = 3;
                    else if (.8489 >= t) e = 9;
                    else if (.96208 >= t) e = 27;
                    else {
                        if (!(.99981 >= t)) return 1;
                        e = 91
                    }
                    return 1 - l.abs(3 * l.cos(t * e * 1.028) / e)
                }
            };
        i.prototype.refresh = function(t) {
            var i, o, a = !1;
            for (t === n ? (a = !0, lt = [], Wt = 0, t = e.getElementsByTagName("*")) : t.length === n && (t = [t]), i = 0, o = t.length; o > i; i++) {
                var r = t[i],
                    s = r,
                    l = [],
                    c = mt,
                    d = wt,
                    u = !1;
                if (a && I in r && delete r[I], r.attributes) {
                    for (var p = 0, h = r.attributes.length; h > p; p++) {
                        var m = r.attributes[p];
                        if ("data-anchor-target" !== m.name)
                            if ("data-smooth-scrolling" !== m.name)
                                if ("data-edge-strategy" !== m.name)
                                    if ("data-emit-events" !== m.name) {
                                        var g = m.name.match(P);
                                        if (null !== g) {
                                            var v = {
                                                props: m.value,
                                                element: r,
                                                eventType: m.name.replace($, B)
                                            };
                                            l.push(v);
                                            var y = g[1];
                                            y && (v.constant = y.substr(1));
                                            var w = g[2];
                                            /p$/.test(w) ? (v.isPercentage = !0, v.offset = (0 | w.slice(0, -1)) / 100) : v.offset = 0 | w;
                                            var b = g[3],
                                                x = g[4] || b;
                                            b && b !== E && b !== D ? (v.mode = "relative", v.anchors = [b, x]) : (v.mode = "absolute", b === D ? v.isEnd = !0 : v.isPercentage || (v.offset = v.offset * Lt))
                                        }
                                    } else u = !0;
                        else d = m.value;
                        else c = "off" !== m.value;
                        else if (s = e.querySelector(m.value),
                            null === s) throw 'Unable to find anchor target "' + m.value + '"'
                    }
                    if (l.length) {
                        var C, T, S;
                        !a && I in r ? (S = r[I], C = lt[S].styleAttr, T = lt[S].classAttr) : (S = r[I] = Wt++, C = r.style.cssText, T = Mt(r)), lt[S] = {
                            element: r,
                            styleAttr: C,
                            classAttr: T,
                            anchorTarget: s,
                            keyFrames: l,
                            smoothScrolling: c,
                            edgeStrategy: d,
                            emitEvents: u,
                            lastFrameIndex: -1
                        }, Ot(r, [f], [])
                    }
                }
            }
            for (kt(), i = 0, o = t.length; o > i; i++) {
                var _ = lt[t[i][I]];
                _ !== n && (J(_), et(_))
            }
            return st
        }, i.prototype.relativeToAbsolute = function(t, e, n) {
            var i = o.clientHeight,
                a = t.getBoundingClientRect(),
                r = a.top,
                s = a.bottom - a.top;
            return e === O ? r -= i : e === M && (r -= i / 2), n === O ? r += s : n === M && (r += s / 2), r += st.getScrollTop(), r + .5 | 0
        }, i.prototype.animateTo = function(t, e) {
            e = e || {};
            var i = Nt(),
                o = st.getScrollTop(),
                a = e.duration === n ? T : e.duration;
            return ft = {
                startTop: o,
                topDiff: t - o,
                targetTop: t,
                duration: a,
                startTime: i,
                endTime: i + a,
                easing: X[e.easing || C],
                done: e.done
            }, ft.topDiff || (ft.done && ft.done.call(st, !1), ft = n), st
        }, i.prototype.stopAnimateTo = function() {
            ft && ft.done && ft.done.call(st, !0), ft = n
        }, i.prototype.isAnimatingTo = function() {
            return !!ft
        }, i.prototype.isMobile = function() {
            return Ut
        }, i.prototype.setScrollTop = function(e, n) {
            return yt = n === !0, Ut ? qt = l.min(l.max(e, 0), zt) : t.scrollTo(0, e), st
        }, i.prototype.getScrollTop = function() {
            return Ut ? qt : t.pageYOffset || o.scrollTop || a.scrollTop || 0
        }, i.prototype.getMaxScrollTop = function() {
            return zt
        }, i.prototype.on = function(t, e) {
            return dt[t] = e, st
        }, i.prototype.off = function(t) {
            return delete dt[t], st
        }, i.prototype.destroy = function() {
            var t = V();
            t(xt), St(), Ot(o, [w], [y, b, x]);
            for (var e = 0, i = lt.length; i > e; e++) at(lt[e].element);
            o.style.overflow = a.style.overflow = "", o.style.height = a.style.height = "", ct && r.setStyle(ct, "transform", "none"), st = n, ct = n, dt = n, ut = n, zt = 0, Lt = 1, pt = n, ht = n, $t = "down", Bt = -1, Ht = 0, jt = 0, Rt = !1, ft = n, mt = n, gt = n, vt = n, yt = n, Wt = 0, wt = n, Ut = !1, qt = 0, bt = n
        };
        var G = function() {
                var i, r, s, c, f, m, g, v, y, w, b, x;
                Ct(o, [d, u, p, h].join(" "), function(t) {
                    var o = t.changedTouches[0];
                    for (c = t.target; 3 === c.nodeType;) c = c.parentNode;
                    switch (f = o.clientY, m = o.clientX, w = t.timeStamp, A.test(c.tagName) || t.preventDefault(), t.type) {
                        case d:
                            i && i.blur(), st.stopAnimateTo(), i = c, r = g = f, s = m, y = w;
                            break;
                        case u:
                            A.test(c.tagName) && e.activeElement !== c && t.preventDefault(), v = f - g, x = w - b, st.setScrollTop(qt - v, !0), g = f, b = w;
                            break;
                        default:
                        case p:
                        case h:
                            var a = r - f,
                                C = s - m,
                                T = C * C + a * a;
                            if (49 > T) {
                                if (!A.test(i.tagName)) {
                                    i.focus();
                                    var S = e.createEvent("MouseEvents");
                                    S.initMouseEvent("click", !0, !0, t.view, 1, o.screenX, o.screenY, o.clientX, o.clientY, t.ctrlKey, t.altKey, t.shiftKey, t.metaKey, 0, null), i.dispatchEvent(S)
                                }
                                return
                            }
                            i = n;
                            var _ = v / x;
                            _ = l.max(l.min(_, 3), -3);
                            var k = l.abs(_ / ht),
                                E = _ * k + .5 * ht * k * k,
                                D = st.getScrollTop() - E,
                                M = 0;
                            D > zt ? (M = (zt - D) / E, D = zt) : 0 > D && (M = -D / E, D = 0), k *= 1 - M, st.animateTo(D + .5 | 0, {
                                easing: "outCubic",
                                duration: k
                            })
                    }
                }), t.scrollTo(0, 0), o.style.overflow = a.style.overflow = "hidden"
            },
            K = function() {
                var t, e, n, i, a, r, s, c, d, u, p, h = o.clientHeight,
                    f = Et();
                for (c = 0, d = lt.length; d > c; c++)
                    for (t = lt[c], e = t.element, n = t.anchorTarget, i = t.keyFrames, a = 0, r = i.length; r > a; a++) s = i[a], u = s.offset, p = f[s.constant] || 0, s.frame = u, s.isPercentage && (u *= h, s.frame = u), "relative" === s.mode && (at(e), s.frame = st.relativeToAbsolute(n, s.anchors[0], s.anchors[1]) - u, at(e, !0)), s.frame += p, ut && !s.isEnd && s.frame > zt && (zt = s.frame);
                for (zt = l.max(zt, Dt()), c = 0, d = lt.length; d > c; c++) {
                    for (t = lt[c], i = t.keyFrames, a = 0, r = i.length; r > a; a++) s = i[a], p = f[s.constant] || 0, s.isEnd && (s.frame = zt - s.offset + p);
                    t.keyFrames.sort(Pt)
                }
            },
            Q = function(t, e) {
                for (var n = 0, i = lt.length; i > n; n++) {
                    var o, a, l = lt[n],
                        c = l.element,
                        d = l.smoothScrolling ? t : e,
                        u = l.keyFrames,
                        p = u.length,
                        h = u[0],
                        y = u[u.length - 1],
                        w = d < h.frame,
                        b = d > y.frame,
                        x = w ? h : y,
                        C = l.emitEvents,
                        T = l.lastFrameIndex;
                    if (w || b) {
                        if (w && -1 === l.edge || b && 1 === l.edge) continue;
                        switch (w ? (Ot(c, [m], [v, g]), C && T > -1 && (_t(c, h.eventType, $t), l.lastFrameIndex = -1)) : (Ot(c, [v], [m, g]), C && p > T && (_t(c, y.eventType, $t), l.lastFrameIndex = p)), l.edge = w ? -1 : 1, l.edgeStrategy) {
                            case "reset":
                                at(c);
                                continue;
                            case "ease":
                                d = x.frame;
                                break;
                            default:
                            case "set":
                                var S = x.props;
                                for (o in S) s.call(S, o) && (a = ot(S[o].value), 0 === o.indexOf("@") ? c.setAttribute(o.substr(1), a) : r.setStyle(c, o, a));
                                continue
                        }
                    } else 0 !== l.edge && (Ot(c, [f, g], [m, v]), l.edge = 0);
                    for (var _ = 0; p - 1 > _; _++)
                        if (d >= u[_].frame && d <= u[_ + 1].frame) {
                            var k = u[_],
                                E = u[_ + 1];
                            for (o in k.props)
                                if (s.call(k.props, o)) {
                                    var D = (d - k.frame) / (E.frame - k.frame);
                                    D = k.props[o].easing(D), a = it(k.props[o].value, E.props[o].value, D), a = ot(a), 0 === o.indexOf("@") ? c.setAttribute(o.substr(1), a) : r.setStyle(c, o, a)
                                }
                            C && T !== _ && ("down" === $t ? _t(c, k.eventType, $t) : _t(c, E.eventType, $t), l.lastFrameIndex = _);
                            break
                        }
                }
            },
            Z = function() {
                Rt && (Rt = !1, kt());
                var t, e, i = st.getScrollTop(),
                    o = Nt();
                if (ft) o >= ft.endTime ? (i = ft.targetTop, t = ft.done, ft = n) : (e = ft.easing((o - ft.startTime) / ft.duration), i = ft.startTop + e * ft.topDiff | 0), st.setScrollTop(i, !0);
                else if (!yt) {
                    var a = vt.targetTop - i;
                    a && (vt = {
                        startTop: Bt,
                        topDiff: i - Bt,
                        targetTop: i,
                        startTime: Ft,
                        endTime: Ft + gt
                    }), o <= vt.endTime && (e = X.sqrt((o - vt.startTime) / gt), i = vt.startTop + e * vt.topDiff | 0)
                }
                if (yt || Bt !== i) {
                    $t = i > Bt ? "down" : Bt > i ? "up" : $t, yt = !1;
                    var s = {
                            curTop: i,
                            lastTop: Bt,
                            maxTop: zt,
                            direction: $t
                        },
                        l = dt.beforerender && dt.beforerender.call(st, s);
                    l !== !1 && (Q(i, st.getScrollTop()), Ut && ct && r.setStyle(ct, "transform", "translate(0, " + -qt + "px) " + bt), Bt = i, dt.render && dt.render.call(st, s)), t && t.call(st, !1)
                }
                Ft = o
            },
            J = function(t) {
                for (var e = 0, n = t.keyFrames.length; n > e; e++) {
                    for (var i, o, a, r, s = t.keyFrames[e], l = {}; null !== (r = z.exec(s.props));) a = r[1], o = r[2], i = a.match(L), null !== i ? (a = i[1], i = i[2]) : i = C, o = o.indexOf("!") ? tt(o) : [o.slice(1)], l[a] = {
                        value: o,
                        easing: X[i]
                    };
                    s.props = l
                }
            },
            tt = function(t) {
                var e = [];
                return j.lastIndex = 0, t = t.replace(j, function(t) {
                    return t.replace(F, function(t) {
                        return t / 255 * 100 + "%"
                    })
                }), U && (R.lastIndex = 0, t = t.replace(R, function(t) {
                    return U + t
                })), t = t.replace(F, function(t) {
                    return e.push(+t), "{?}"
                }), e.unshift(t), e
            },
            et = function(t) {
                var e, n, i = {};
                for (e = 0, n = t.keyFrames.length; n > e; e++) nt(t.keyFrames[e], i);
                for (i = {}, e = t.keyFrames.length - 1; e >= 0; e--) nt(t.keyFrames[e], i)
            },
            nt = function(t, e) {
                var n;
                for (n in e) s.call(t.props, n) || (t.props[n] = e[n]);
                for (n in t.props) e[n] = t.props[n]
            },
            it = function(t, e, n) {
                var i, o = t.length;
                if (o !== e.length) throw "Can't interpolate between \"" + t[0] + '" and "' + e[0] + '"';
                var a = [t[0]];
                for (i = 1; o > i; i++) a[i] = t[i] + (e[i] - t[i]) * n;
                return a
            },
            ot = function(t) {
                var e = 1;
                return H.lastIndex = 0, t[0].replace(H, function() {
                    return t[e++]
                })
            },
            at = function(t, e) {
                t = [].concat(t);
                for (var n, i, o = 0, a = t.length; a > o; o++) i = t[o], n = lt[i[I]], n && (e ? (i.style.cssText = n.dirtyStyleAttr, Ot(i, n.dirtyClassAttr)) : (n.dirtyStyleAttr = i.style.cssText, n.dirtyClassAttr = Mt(i), i.style.cssText = n.styleAttr, Ot(i, n.classAttr)))
            },
            rt = function() {
                bt = "translateZ(0)", r.setStyle(ct, "transform", bt);
                var t = c(ct),
                    e = t.getPropertyValue("transform"),
                    n = t.getPropertyValue(U + "transform"),
                    i = e && "none" !== e || n && "none" !== n;
                i || (bt = "")
            };
        r.setStyle = function(t, e, n) {
            var i = t.style;
            if (e = e.replace($, B).replace("-", ""), "zIndex" === e) isNaN(n) ? i[e] = n : i[e] = "" + (0 | n);
            else if ("float" === e) i.styleFloat = i.cssFloat = n;
            else try {
                W && (i[W + e.slice(0, 1).toUpperCase() + e.slice(1)] = n), i[e] = n
            } catch (o) {}
        };
        var st, lt, ct, dt, ut, pt, ht, ft, mt, gt, vt, yt, wt, bt, xt, Ct = r.addEvent = function(e, n, i) {
                var o = function(e) {
                    return e = e || t.event, e.target || (e.target = e.srcElement), e.preventDefault || (e.preventDefault = function() {
                        e.returnValue = !1, e.defaultPrevented = !0
                    }), i.call(this, e)
                };
                n = n.split(" ");
                for (var a, r = 0, s = n.length; s > r; r++) a = n[r], e.addEventListener ? e.addEventListener(a, i, !1) : e.attachEvent("on" + a, o), Yt.push({
                    element: e,
                    name: a,
                    listener: i
                })
            },
            Tt = r.removeEvent = function(t, e, n) {
                e = e.split(" ");
                for (var i = 0, o = e.length; o > i; i++) t.removeEventListener ? t.removeEventListener(e[i], n, !1) : t.detachEvent("on" + e[i], n)
            },
            St = function() {
                for (var t, e = 0, n = Yt.length; n > e; e++) t = Yt[e], Tt(t.element, t.name, t.listener);
                Yt = []
            },
            _t = function(t, e, n) {
                dt.keyframe && dt.keyframe.call(st, t, e, n)
            },
            kt = function() {
                var t = st.getScrollTop();
                zt = 0, ut && !Ut && (a.style.height = ""), K(), ut && !Ut && (a.style.height = zt + o.clientHeight + "px"), Ut ? st.setScrollTop(l.min(st.getScrollTop(), zt)) : st.setScrollTop(t, !0), yt = !0
            },
            Et = function() {
                var t, e, n = o.clientHeight,
                    i = {};
                for (t in pt) e = pt[t], "function" == typeof e ? e = e.call(st) : /p$/.test(e) && (e = e.slice(0, -1) / 100 * n), i[t] = e;
                return i
            },
            Dt = function() {
                var t, e = 0;
                return ct && (e = l.max(ct.offsetHeight, ct.scrollHeight)), t = l.max(e, a.scrollHeight, a.offsetHeight, o.scrollHeight, o.offsetHeight, o.clientHeight), t - o.clientHeight
            },
            Mt = function(e) {
                var n = "className";
                return t.SVGElement && e instanceof t.SVGElement && (e = e[n], n = "baseVal"), e[n]
            },
            Ot = function(e, i, o) {
                var a = "className";
                if (t.SVGElement && e instanceof t.SVGElement && (e = e[a], a = "baseVal"), o === n) return void(e[a] = i);
                for (var r = e[a], s = 0, l = o.length; l > s; s++) r = At(r).replace(At(o[s]), " ");
                r = It(r);
                for (var c = 0, d = i.length; d > c; c++) - 1 === At(r).indexOf(At(i[c])) && (r += " " + i[c]);
                e[a] = It(r)
            },
            It = function(t) {
                return t.replace(N, "")
            },
            At = function(t) {
                return " " + t + " "
            },
            Nt = Date.now || function() {
                return +new Date
            },
            Pt = function(t, e) {
                return t.frame - e.frame
            },
            zt = 0,
            Lt = 1,
            $t = "down",
            Bt = -1,
            Ft = Nt(),
            Ht = 0,
            jt = 0,
            Rt = !1,
            Wt = 0,
            Ut = !1,
            qt = 0,
            Yt = [];
        "function" == typeof define && define.amd ? define([], function() {
            return r
        }) : "undefined" != typeof module && module.exports ? module.exports = r : t.skrollr = r
    }(window, document), ! function() {
        "use strict";

        function t(t) {
            t.fn.swiper = function(e) {
                var i;
                return t(this).each(function() {
                    var t = new n(this, e);
                    i || (i = t)
                }), i
            }
        }
        var e, n = function(t, o) {
            function a(t) {
                return Math.floor(t)
            }

            function r() {
                b.autoplayTimeoutId = setTimeout(function() {
                    b.params.loop ? (b.fixLoop(), b._slideNext(), b.emit("onAutoplay", b)) : b.isEnd ? o.autoplayStopOnLast ? b.stopAutoplay() : (b._slideTo(0), b.emit("onAutoplay", b)) : (b._slideNext(), b.emit("onAutoplay", b))
                }, b.params.autoplay)
            }

            function s(t, n) {
                var i = e(t.target);
                if (!i.is(n))
                    if ("string" == typeof n) i = i.parents(n);
                    else if (n.nodeType) {
                    var o;
                    return i.parents().each(function(t, e) {
                        e === n && (o = n)
                    }), o ? n : void 0
                }
                if (0 !== i.length) return i[0]
            }

            function l(t, e) {
                e = e || {};
                var n = window.MutationObserver || window.WebkitMutationObserver,
                    i = new n(function(t) {
                        t.forEach(function(t) {
                            b.onResize(!0), b.emit("onObserverUpdate", b, t)
                        })
                    });
                i.observe(t, {
                    attributes: "undefined" == typeof e.attributes || e.attributes,
                    childList: "undefined" == typeof e.childList || e.childList,
                    characterData: "undefined" == typeof e.characterData || e.characterData
                }), b.observers.push(i)
            }

            function c(t) {
                t.originalEvent && (t = t.originalEvent);
                var e = t.keyCode || t.charCode;
                if (!b.params.allowSwipeToNext && (b.isHorizontal() && 39 === e || !b.isHorizontal() && 40 === e)) return !1;
                if (!b.params.allowSwipeToPrev && (b.isHorizontal() && 37 === e || !b.isHorizontal() && 38 === e)) return !1;
                if (!(t.shiftKey || t.altKey || t.ctrlKey || t.metaKey || document.activeElement && document.activeElement.nodeName && ("input" === document.activeElement.nodeName.toLowerCase() || "textarea" === document.activeElement.nodeName.toLowerCase()))) {
                    if (37 === e || 39 === e || 38 === e || 40 === e) {
                        var n = !1;
                        if (b.container.parents(".swiper-slide").length > 0 && 0 === b.container.parents(".swiper-slide-active").length) return;
                        var i = {
                                left: window.pageXOffset,
                                top: window.pageYOffset
                            },
                            o = window.innerWidth,
                            a = window.innerHeight,
                            r = b.container.offset();
                        b.rtl && (r.left = r.left - b.container[0].scrollLeft);
                        for (var s = [
                                [r.left, r.top],
                                [r.left + b.width, r.top],
                                [r.left, r.top + b.height],
                                [r.left + b.width, r.top + b.height]
                            ], l = 0; l < s.length; l++) {
                            var c = s[l];
                            c[0] >= i.left && c[0] <= i.left + o && c[1] >= i.top && c[1] <= i.top + a && (n = !0)
                        }
                        if (!n) return
                    }
                    b.isHorizontal() ? ((37 === e || 39 === e) && (t.preventDefault ? t.preventDefault() : t.returnValue = !1), (39 === e && !b.rtl || 37 === e && b.rtl) && b.slideNext(), (37 === e && !b.rtl || 39 === e && b.rtl) && b.slidePrev()) : ((38 === e || 40 === e) && (t.preventDefault ? t.preventDefault() : t.returnValue = !1), 40 === e && b.slideNext(), 38 === e && b.slidePrev())
                }
            }

            function d(t) {
                t.originalEvent && (t = t.originalEvent);
                var e = b.mousewheel.event,
                    n = 0,
                    i = b.rtl ? -1 : 1;
                if (t.detail) n = -t.detail;
                else if ("mousewheel" === e)
                    if (b.params.mousewheelForceToAxis)
                        if (b.isHorizontal()) {
                            if (!(Math.abs(t.wheelDeltaX) > Math.abs(t.wheelDeltaY))) return;
                            n = t.wheelDeltaX * i
                        } else {
                            if (!(Math.abs(t.wheelDeltaY) > Math.abs(t.wheelDeltaX))) return;
                            n = t.wheelDeltaY
                        }
                else n = Math.abs(t.wheelDeltaX) > Math.abs(t.wheelDeltaY) ? -t.wheelDeltaX * i : -t.wheelDeltaY;
                else if ("DOMMouseScroll" === e) n = -t.detail;
                else if ("wheel" === e)
                    if (b.params.mousewheelForceToAxis)
                        if (b.isHorizontal()) {
                            if (!(Math.abs(t.deltaX) > Math.abs(t.deltaY))) return;
                            n = -t.deltaX * i
                        } else {
                            if (!(Math.abs(t.deltaY) > Math.abs(t.deltaX))) return;
                            n = -t.deltaY
                        }
                else n = Math.abs(t.deltaX) > Math.abs(t.deltaY) ? -t.deltaX * i : -t.deltaY;
                if (0 !== n) {
                    if (b.params.mousewheelInvert && (n = -n), b.params.freeMode) {
                        var o = b.getWrapperTranslate() + n * b.params.mousewheelSensitivity,
                            a = b.isBeginning,
                            r = b.isEnd;
                        if (o >= b.minTranslate() && (o = b.minTranslate()), o <= b.maxTranslate() && (o = b.maxTranslate()), b.setWrapperTransition(0), b.setWrapperTranslate(o), b.updateProgress(), b.updateActiveIndex(), (!a && b.isBeginning || !r && b.isEnd) && b.updateClasses(), b.params.freeModeSticky ? (clearTimeout(b.mousewheel.timeout), b.mousewheel.timeout = setTimeout(function() {
                                b.slideReset()
                            }, 300)) : b.params.lazyLoading && b.lazy && b.lazy.load(), 0 === o || o === b.maxTranslate()) return
                    } else {
                        if ((new window.Date).getTime() - b.mousewheel.lastScrollTime > 60)
                            if (0 > n)
                                if (b.isEnd && !b.params.loop || b.animating) {
                                    if (b.params.mousewheelReleaseOnEdges) return !0
                                } else b.slideNext();
                        else if (b.isBeginning && !b.params.loop || b.animating) {
                            if (b.params.mousewheelReleaseOnEdges) return !0
                        } else b.slidePrev();
                        b.mousewheel.lastScrollTime = (new window.Date).getTime()
                    }
                    return b.params.autoplay && b.stopAutoplay(), t.preventDefault ? t.preventDefault() : t.returnValue = !1, !1
                }
            }

            function u(t, n) {
                t = e(t);
                var i, o, a, r = b.rtl ? -1 : 1;
                i = t.attr("data-swiper-parallax") || "0", o = t.attr("data-swiper-parallax-x"), a = t.attr("data-swiper-parallax-y"), o || a ? (o = o || "0", a = a || "0") : b.isHorizontal() ? (o = i, a = "0") : (a = i, o = "0"), o = o.indexOf("%") >= 0 ? parseInt(o, 10) * n * r + "%" : o * n * r + "px", a = a.indexOf("%") >= 0 ? parseInt(a, 10) * n + "%" : a * n + "px", t.transform("translate3d(" + o + ", " + a + ",0px)")
            }

            function p(t) {
                return 0 !== t.indexOf("on") && (t = t[0] !== t[0].toUpperCase() ? "on" + t[0].toUpperCase() + t.substring(1) : "on" + t), t
            }
            if (!(this instanceof n)) return new n(t, o);
            var h = {
                    direction: "horizontal",
                    touchEventsTarget: "container",
                    initialSlide: 0,
                    speed: 300,
                    autoplay: !1,
                    autoplayDisableOnInteraction: !0,
                    autoplayStopOnLast: !1,
                    iOSEdgeSwipeDetection: !1,
                    iOSEdgeSwipeThreshold: 20,
                    freeMode: !1,
                    freeModeMomentum: !0,
                    freeModeMomentumRatio: 1,
                    freeModeMomentumBounce: !0,
                    freeModeMomentumBounceRatio: 1,
                    freeModeSticky: !1,
                    freeModeMinimumVelocity: .02,
                    autoHeight: !1,
                    setWrapperSize: !1,
                    virtualTranslate: !1,
                    effect: "slide",
                    coverflow: {
                        rotate: 50,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: !0
                    },
                    flip: {
                        slideShadows: !0,
                        limitRotation: !0
                    },
                    cube: {
                        slideShadows: !0,
                        shadow: !0,
                        shadowOffset: 20,
                        shadowScale: .94
                    },
                    fade: {
                        crossFade: !1
                    },
                    parallax: !1,
                    scrollbar: null,
                    scrollbarHide: !0,
                    scrollbarDraggable: !1,
                    scrollbarSnapOnRelease: !1,
                    keyboardControl: !1,
                    mousewheelControl: !1,
                    mousewheelReleaseOnEdges: !1,
                    mousewheelInvert: !1,
                    mousewheelForceToAxis: !1,
                    mousewheelSensitivity: 1,
                    hashnav: !1,
                    breakpoints: void 0,
                    spaceBetween: 0,
                    slidesPerView: 1,
                    slidesPerColumn: 1,
                    slidesPerColumnFill: "column",
                    slidesPerGroup: 1,
                    centeredSlides: !1,
                    slidesOffsetBefore: 0,
                    slidesOffsetAfter: 0,
                    roundLengths: !1,
                    touchRatio: 1,
                    touchAngle: 45,
                    simulateTouch: !0,
                    shortSwipes: !0,
                    longSwipes: !0,
                    longSwipesRatio: .5,
                    longSwipesMs: 300,
                    followFinger: !0,
                    onlyExternal: !1,
                    threshold: 0,
                    touchMoveStopPropagation: !0,
                    pagination: null,
                    paginationElement: "span",
                    paginationClickable: !1,
                    paginationHide: !1,
                    paginationBulletRender: null,
                    paginationProgressRender: null,
                    paginationFractionRender: null,
                    paginationCustomRender: null,
                    paginationType: "bullets",
                    resistance: !0,
                    resistanceRatio: .85,
                    nextButton: null,
                    prevButton: null,
                    watchSlidesProgress: !1,
                    watchSlidesVisibility: !1,
                    grabCursor: !1,
                    preventClicks: !0,
                    preventClicksPropagation: !0,
                    slideToClickedSlide: !1,
                    lazyLoading: !1,
                    lazyLoadingInPrevNext: !1,
                    lazyLoadingInPrevNextAmount: 1,
                    lazyLoadingOnTransitionStart: !1,
                    preloadImages: !0,
                    updateOnImagesReady: !0,
                    loop: !1,
                    loopAdditionalSlides: 0,
                    loopedSlides: null,
                    control: void 0,
                    controlInverse: !1,
                    controlBy: "slide",
                    allowSwipeToPrev: !0,
                    allowSwipeToNext: !0,
                    swipeHandler: null,
                    noSwiping: !0,
                    noSwipingClass: "swiper-no-swiping",
                    slideClass: "swiper-slide",
                    slideActiveClass: "swiper-slide-active",
                    slideVisibleClass: "swiper-slide-visible",
                    slideDuplicateClass: "swiper-slide-duplicate",
                    slideNextClass: "swiper-slide-next",
                    slidePrevClass: "swiper-slide-prev",
                    wrapperClass: "swiper-wrapper",
                    bulletClass: "swiper-pagination-bullet",
                    bulletActiveClass: "swiper-pagination-bullet-active",
                    buttonDisabledClass: "swiper-button-disabled",
                    paginationCurrentClass: "swiper-pagination-current",
                    paginationTotalClass: "swiper-pagination-total",
                    paginationHiddenClass: "swiper-pagination-hidden",
                    paginationProgressbarClass: "swiper-pagination-progressbar",
                    observer: !1,
                    observeParents: !1,
                    a11y: !1,
                    prevSlideMessage: "Previous slide",
                    nextSlideMessage: "Next slide",
                    firstSlideMessage: "This is the first slide",
                    lastSlideMessage: "This is the last slide",
                    paginationBulletMessage: "Go to slide {{index}}",
                    runCallbacksOnInit: !0
                },
                f = o && o.virtualTranslate;
            o = o || {};
            var m = {};
            for (var g in o)
                if ("object" != typeof o[g] || null === o[g] || o[g].nodeType || o[g] === window || o[g] === document || "undefined" != typeof i && o[g] instanceof i || "undefined" != typeof jQuery && o[g] instanceof jQuery) m[g] = o[g];
                else {
                    m[g] = {};
                    for (var v in o[g]) m[g][v] = o[g][v]
                }
            for (var y in h)
                if ("undefined" == typeof o[y]) o[y] = h[y];
                else if ("object" == typeof o[y])
                for (var w in h[y]) "undefined" == typeof o[y][w] && (o[y][w] = h[y][w]);
            var b = this;
            if (b.params = o, b.originalParams = m, b.classNames = [], "undefined" != typeof e && "undefined" != typeof i && (e = i), ("undefined" != typeof e || (e = "undefined" == typeof i ? window.Dom7 || window.Zepto || window.jQuery : i)) && (b.$ = e, b.currentBreakpoint = void 0, b.getActiveBreakpoint = function() {
                    if (!b.params.breakpoints) return !1;
                    var t, e = !1,
                        n = [];
                    for (t in b.params.breakpoints) b.params.breakpoints.hasOwnProperty(t) && n.push(t);
                    n.sort(function(t, e) {
                        return parseInt(t, 10) > parseInt(e, 10)
                    });
                    for (var i = 0; i < n.length; i++) t = n[i], t >= window.innerWidth && !e && (e = t);
                    return e || "max"
                }, b.setBreakpoint = function() {
                    var t = b.getActiveBreakpoint();
                    if (t && b.currentBreakpoint !== t) {
                        var e = t in b.params.breakpoints ? b.params.breakpoints[t] : b.originalParams;
                        for (var n in e) b.params[n] = e[n];
                        b.currentBreakpoint = t
                    }
                }, b.params.breakpoints && b.setBreakpoint(), b.container = e(t), 0 !== b.container.length)) {
                if (b.container.length > 1) return void b.container.each(function() {
                    new n(this, o)
                });
                b.container[0].swiper = b, b.container.data("swiper", b), b.classNames.push("swiper-container-" + b.params.direction), b.params.freeMode && b.classNames.push("swiper-container-free-mode"), b.support.flexbox || (b.classNames.push("swiper-container-no-flexbox"), b.params.slidesPerColumn = 1), b.params.autoHeight && b.classNames.push("swiper-container-autoheight"), (b.params.parallax || b.params.watchSlidesVisibility) && (b.params.watchSlidesProgress = !0), ["cube", "coverflow", "flip"].indexOf(b.params.effect) >= 0 && (b.support.transforms3d ? (b.params.watchSlidesProgress = !0, b.classNames.push("swiper-container-3d")) : b.params.effect = "slide"), "slide" !== b.params.effect && b.classNames.push("swiper-container-" + b.params.effect), "cube" === b.params.effect && (b.params.resistanceRatio = 0, b.params.slidesPerView = 1, b.params.slidesPerColumn = 1, b.params.slidesPerGroup = 1, b.params.centeredSlides = !1, b.params.spaceBetween = 0, b.params.virtualTranslate = !0, b.params.setWrapperSize = !1), ("fade" === b.params.effect || "flip" === b.params.effect) && (b.params.slidesPerView = 1, b.params.slidesPerColumn = 1, b.params.slidesPerGroup = 1, b.params.watchSlidesProgress = !0, b.params.spaceBetween = 0, b.params.setWrapperSize = !1, "undefined" == typeof f && (b.params.virtualTranslate = !0)), b.params.grabCursor && b.support.touch && (b.params.grabCursor = !1), b.wrapper = b.container.children("." + b.params.wrapperClass), b.params.pagination && (b.paginationContainer = e(b.params.pagination), "bullets" === b.params.paginationType && b.params.paginationClickable ? b.paginationContainer.addClass("swiper-pagination-clickable") : b.params.paginationClickable = !1, b.paginationContainer.addClass("swiper-pagination-" + b.params.paginationType)), b.isHorizontal = function() {
                    return "horizontal" === b.params.direction
                }, b.rtl = b.isHorizontal() && ("rtl" === b.container[0].dir.toLowerCase() || "rtl" === b.container.css("direction")), b.rtl && b.classNames.push("swiper-container-rtl"), b.rtl && (b.wrongRTL = "-webkit-box" === b.wrapper.css("display")), b.params.slidesPerColumn > 1 && b.classNames.push("swiper-container-multirow"), b.device.android && b.classNames.push("swiper-container-android"), b.container.addClass(b.classNames.join(" ")), b.translate = 0, b.progress = 0, b.velocity = 0, b.lockSwipeToNext = function() {
                    b.params.allowSwipeToNext = !1
                }, b.lockSwipeToPrev = function() {
                    b.params.allowSwipeToPrev = !1
                }, b.lockSwipes = function() {
                    b.params.allowSwipeToNext = b.params.allowSwipeToPrev = !1
                }, b.unlockSwipeToNext = function() {
                    b.params.allowSwipeToNext = !0
                }, b.unlockSwipeToPrev = function() {
                    b.params.allowSwipeToPrev = !0
                }, b.unlockSwipes = function() {
                    b.params.allowSwipeToNext = b.params.allowSwipeToPrev = !0
                }, b.params.grabCursor && (b.container[0].style.cursor = "move", b.container[0].style.cursor = "-webkit-grab", b.container[0].style.cursor = "-moz-grab", b.container[0].style.cursor = "grab"), b.imagesToLoad = [], b.imagesLoaded = 0, b.loadImage = function(t, e, n, i, o) {
                    function a() {
                        o && o()
                    }
                    var r;
                    t.complete && i ? a() : e ? (r = new window.Image, r.onload = a, r.onerror = a, n && (r.srcset = n), e && (r.src = e)) : a()
                }, b.preloadImages = function() {
                    function t() {
                        "undefined" != typeof b && null !== b && (void 0 !== b.imagesLoaded && b.imagesLoaded++, b.imagesLoaded === b.imagesToLoad.length && (b.params.updateOnImagesReady && b.update(), b.emit("onImagesReady", b)))
                    }
                    b.imagesToLoad = b.container.find("img");
                    for (var e = 0; e < b.imagesToLoad.length; e++) b.loadImage(b.imagesToLoad[e], b.imagesToLoad[e].currentSrc || b.imagesToLoad[e].getAttribute("src"), b.imagesToLoad[e].srcset || b.imagesToLoad[e].getAttribute("srcset"), !0, t)
                }, b.autoplayTimeoutId = void 0, b.autoplaying = !1, b.autoplayPaused = !1, b.startAutoplay = function() {
                    return "undefined" == typeof b.autoplayTimeoutId && (!!b.params.autoplay && (!b.autoplaying && (b.autoplaying = !0, b.emit("onAutoplayStart", b), void r())))
                }, b.stopAutoplay = function(t) {
                    b.autoplayTimeoutId && (b.autoplayTimeoutId && clearTimeout(b.autoplayTimeoutId), b.autoplaying = !1, b.autoplayTimeoutId = void 0, b.emit("onAutoplayStop", b))
                }, b.pauseAutoplay = function(t) {
                    b.autoplayPaused || (b.autoplayTimeoutId && clearTimeout(b.autoplayTimeoutId), b.autoplayPaused = !0, 0 === t ? (b.autoplayPaused = !1, r()) : b.wrapper.transitionEnd(function() {
                        b && (b.autoplayPaused = !1, b.autoplaying ? r() : b.stopAutoplay())
                    }))
                }, b.minTranslate = function() {
                    return -b.snapGrid[0]
                }, b.maxTranslate = function() {
                    return -b.snapGrid[b.snapGrid.length - 1]
                }, b.updateAutoHeight = function() {
                    var t = b.slides.eq(b.activeIndex)[0];
                    if ("undefined" != typeof t) {
                        var e = t.offsetHeight;
                        e && b.wrapper.css("height", e + "px")
                    }
                }, b.updateContainerSize = function() {
                    var t, e;
                    t = "undefined" != typeof b.params.width ? b.params.width : b.container[0].clientWidth, e = "undefined" != typeof b.params.height ? b.params.height : b.container[0].clientHeight, 0 === t && b.isHorizontal() || 0 === e && !b.isHorizontal() || (t = t - parseInt(b.container.css("padding-left"), 10) - parseInt(b.container.css("padding-right"), 10), e = e - parseInt(b.container.css("padding-top"), 10) - parseInt(b.container.css("padding-bottom"), 10), b.width = t, b.height = e, b.size = b.isHorizontal() ? b.width : b.height)
                }, b.updateSlidesSize = function() {
                    b.slides = b.wrapper.children("." + b.params.slideClass), b.snapGrid = [], b.slidesGrid = [], b.slidesSizesGrid = [];
                    var t, e = b.params.spaceBetween,
                        n = -b.params.slidesOffsetBefore,
                        i = 0,
                        o = 0;
                    "string" == typeof e && e.indexOf("%") >= 0 && (e = parseFloat(e.replace("%", "")) / 100 * b.size), b.virtualSize = -e, b.rtl ? b.slides.css({
                        marginLeft: "",
                        marginTop: ""
                    }) : b.slides.css({
                        marginRight: "",
                        marginBottom: ""
                    });
                    var r;
                    b.params.slidesPerColumn > 1 && (r = Math.floor(b.slides.length / b.params.slidesPerColumn) === b.slides.length / b.params.slidesPerColumn ? b.slides.length : Math.ceil(b.slides.length / b.params.slidesPerColumn) * b.params.slidesPerColumn, "auto" !== b.params.slidesPerView && "row" === b.params.slidesPerColumnFill && (r = Math.max(r, b.params.slidesPerView * b.params.slidesPerColumn)));
                    var s, l = b.params.slidesPerColumn,
                        c = r / l,
                        d = c - (b.params.slidesPerColumn * c - b.slides.length);
                    for (t = 0; t < b.slides.length; t++) {
                        s = 0;
                        var u = b.slides.eq(t);
                        if (b.params.slidesPerColumn > 1) {
                            var p, h, f;
                            "column" === b.params.slidesPerColumnFill ? (h = Math.floor(t / l), f = t - h * l, (h > d || h === d && f === l - 1) && ++f >= l && (f = 0, h++), p = h + f * r / l, u.css({
                                "-webkit-box-ordinal-group": p,
                                "-moz-box-ordinal-group": p,
                                "-ms-flex-order": p,
                                "-webkit-order": p,
                                order: p
                            })) : (f = Math.floor(t / c), h = t - f * c), u.css({
                                "margin-top": 0 !== f && b.params.spaceBetween && b.params.spaceBetween + "px"
                            }).attr("data-swiper-column", h).attr("data-swiper-row", f)
                        }
                        "none" !== u.css("display") && ("auto" === b.params.slidesPerView ? (s = b.isHorizontal() ? u.outerWidth(!0) : u.outerHeight(!0), b.params.roundLengths && (s = a(s))) : (s = (b.size - (b.params.slidesPerView - 1) * e) / b.params.slidesPerView, b.params.roundLengths && (s = a(s)), b.isHorizontal() ? b.slides[t].style.width = s + "px" : b.slides[t].style.height = s + "px"), b.slides[t].swiperSlideSize = s, b.slidesSizesGrid.push(s), b.params.centeredSlides ? (n = n + s / 2 + i / 2 + e, 0 === t && (n = n - b.size / 2 - e), Math.abs(n) < .001 && (n = 0), o % b.params.slidesPerGroup === 0 && b.snapGrid.push(n), b.slidesGrid.push(n)) : (o % b.params.slidesPerGroup === 0 && b.snapGrid.push(n), b.slidesGrid.push(n), n = n + s + e), b.virtualSize += s + e, i = s, o++)
                    }
                    b.virtualSize = Math.max(b.virtualSize, b.size) + b.params.slidesOffsetAfter;
                    var m;
                    if (b.rtl && b.wrongRTL && ("slide" === b.params.effect || "coverflow" === b.params.effect) && b.wrapper.css({
                            width: b.virtualSize + b.params.spaceBetween + "px"
                        }), (!b.support.flexbox || b.params.setWrapperSize) && (b.isHorizontal() ? b.wrapper.css({
                            width: b.virtualSize + b.params.spaceBetween + "px"
                        }) : b.wrapper.css({
                            height: b.virtualSize + b.params.spaceBetween + "px"
                        })), b.params.slidesPerColumn > 1 && (b.virtualSize = (s + b.params.spaceBetween) * r, b.virtualSize = Math.ceil(b.virtualSize / b.params.slidesPerColumn) - b.params.spaceBetween, b.wrapper.css({
                            width: b.virtualSize + b.params.spaceBetween + "px"
                        }), b.params.centeredSlides)) {
                        for (m = [], t = 0; t < b.snapGrid.length; t++) b.snapGrid[t] < b.virtualSize + b.snapGrid[0] && m.push(b.snapGrid[t]);
                        b.snapGrid = m
                    }
                    if (!b.params.centeredSlides) {
                        for (m = [], t = 0; t < b.snapGrid.length; t++) b.snapGrid[t] <= b.virtualSize - b.size && m.push(b.snapGrid[t]);
                        b.snapGrid = m, Math.floor(b.virtualSize - b.size) > Math.floor(b.snapGrid[b.snapGrid.length - 1]) && b.snapGrid.push(b.virtualSize - b.size)
                    }
                    0 === b.snapGrid.length && (b.snapGrid = [0]), 0 !== b.params.spaceBetween && (b.isHorizontal() ? b.rtl ? b.slides.css({
                        marginLeft: e + "px"
                    }) : b.slides.css({
                        marginRight: e + "px"
                    }) : b.slides.css({
                        marginBottom: e + "px"
                    })), b.params.watchSlidesProgress && b.updateSlidesOffset()
                }, b.updateSlidesOffset = function() {
                    for (var t = 0; t < b.slides.length; t++) b.slides[t].swiperSlideOffset = b.isHorizontal() ? b.slides[t].offsetLeft : b.slides[t].offsetTop
                }, b.updateSlidesProgress = function(t) {
                    if ("undefined" == typeof t && (t = b.translate || 0), 0 !== b.slides.length) {
                        "undefined" == typeof b.slides[0].swiperSlideOffset && b.updateSlidesOffset();
                        var e = -t;
                        b.rtl && (e = t), b.slides.removeClass(b.params.slideVisibleClass);
                        for (var n = 0; n < b.slides.length; n++) {
                            var i = b.slides[n],
                                o = (e - i.swiperSlideOffset) / (i.swiperSlideSize + b.params.spaceBetween);
                            if (b.params.watchSlidesVisibility) {
                                var a = -(e - i.swiperSlideOffset),
                                    r = a + b.slidesSizesGrid[n],
                                    s = a >= 0 && a < b.size || r > 0 && r <= b.size || 0 >= a && r >= b.size;
                                s && b.slides.eq(n).addClass(b.params.slideVisibleClass)
                            }
                            i.progress = b.rtl ? -o : o
                        }
                    }
                }, b.updateProgress = function(t) {
                    "undefined" == typeof t && (t = b.translate || 0);
                    var e = b.maxTranslate() - b.minTranslate(),
                        n = b.isBeginning,
                        i = b.isEnd;
                    0 === e ? (b.progress = 0, b.isBeginning = b.isEnd = !0) : (b.progress = (t - b.minTranslate()) / e, b.isBeginning = b.progress <= 0, b.isEnd = b.progress >= 1), b.isBeginning && !n && b.emit("onReachBeginning", b), b.isEnd && !i && b.emit("onReachEnd", b), b.params.watchSlidesProgress && b.updateSlidesProgress(t), b.emit("onProgress", b, b.progress)
                }, b.updateActiveIndex = function() {
                    var t, e, n, i = b.rtl ? b.translate : -b.translate;
                    for (e = 0; e < b.slidesGrid.length; e++) "undefined" != typeof b.slidesGrid[e + 1] ? i >= b.slidesGrid[e] && i < b.slidesGrid[e + 1] - (b.slidesGrid[e + 1] - b.slidesGrid[e]) / 2 ? t = e : i >= b.slidesGrid[e] && i < b.slidesGrid[e + 1] && (t = e + 1) : i >= b.slidesGrid[e] && (t = e);
                    (0 > t || "undefined" == typeof t) && (t = 0), n = Math.floor(t / b.params.slidesPerGroup), n >= b.snapGrid.length && (n = b.snapGrid.length - 1), t !== b.activeIndex && (b.snapIndex = n, b.previousIndex = b.activeIndex, b.activeIndex = t, b.updateClasses())
                }, b.updateClasses = function() {
                    b.slides.removeClass(b.params.slideActiveClass + " " + b.params.slideNextClass + " " + b.params.slidePrevClass);
                    var t = b.slides.eq(b.activeIndex);
                    if (t.addClass(b.params.slideActiveClass), t.next("." + b.params.slideClass).addClass(b.params.slideNextClass), t.prev("." + b.params.slideClass).addClass(b.params.slidePrevClass), b.paginationContainer && b.paginationContainer.length > 0) {
                        var n, i = b.params.loop ? Math.ceil((b.slides.length - 2 * b.loopedSlides) / b.params.slidesPerGroup) : b.snapGrid.length;
                        if (b.params.loop ? (n = Math.ceil(b.activeIndex - b.loopedSlides) / b.params.slidesPerGroup, n > b.slides.length - 1 - 2 * b.loopedSlides && (n -= b.slides.length - 2 * b.loopedSlides), n > i - 1 && (n -= i), 0 > n && "bullets" !== b.params.paginationType && (n = i + n)) : n = "undefined" != typeof b.snapIndex ? b.snapIndex : b.activeIndex || 0, "bullets" === b.params.paginationType && b.bullets && b.bullets.length > 0 && (b.bullets.removeClass(b.params.bulletActiveClass), b.paginationContainer.length > 1 ? b.bullets.each(function() {
                                e(this).index() === n && e(this).addClass(b.params.bulletActiveClass)
                            }) : b.bullets.eq(n).addClass(b.params.bulletActiveClass)), "fraction" === b.params.paginationType && (b.paginationContainer.find("." + b.params.paginationCurrentClass).text(n + 1), b.paginationContainer.find("." + b.params.paginationTotalClass).text(i)), "progress" === b.params.paginationType) {
                            var o = (n + 1) / i,
                                a = o,
                                r = 1;
                            b.isHorizontal() || (r = o, a = 1), b.paginationContainer.find("." + b.params.paginationProgressbarClass).transform("translate3d(0,0,0) scaleX(" + a + ") scaleY(" + r + ")").transition(b.params.speed)
                        }
                        "custom" === b.params.paginationType && b.params.paginationCustomRender && b.paginationContainer.html(b.params.paginationCustomRender(b, n + 1, i))
                    }
                    b.params.loop || (b.params.prevButton && (b.isBeginning ? (e(b.params.prevButton).addClass(b.params.buttonDisabledClass), b.params.a11y && b.a11y && b.a11y.disable(e(b.params.prevButton))) : (e(b.params.prevButton).removeClass(b.params.buttonDisabledClass), b.params.a11y && b.a11y && b.a11y.enable(e(b.params.prevButton)))), b.params.nextButton && (b.isEnd ? (e(b.params.nextButton).addClass(b.params.buttonDisabledClass), b.params.a11y && b.a11y && b.a11y.disable(e(b.params.nextButton))) : (e(b.params.nextButton).removeClass(b.params.buttonDisabledClass), b.params.a11y && b.a11y && b.a11y.enable(e(b.params.nextButton)))))
                }, b.updatePagination = function() {
                    if (b.params.pagination && b.paginationContainer && b.paginationContainer.length > 0) {
                        var t = "";
                        if ("bullets" === b.params.paginationType) {
                            for (var e = b.params.loop ? Math.ceil((b.slides.length - 2 * b.loopedSlides) / b.params.slidesPerGroup) : b.snapGrid.length, n = 0; e > n; n++) t += b.params.paginationBulletRender ? b.params.paginationBulletRender(n, b.params.bulletClass) : "<" + b.params.paginationElement + ' class="' + b.params.bulletClass + '"></' + b.params.paginationElement + ">";
                            b.paginationContainer.html(t), b.bullets = b.paginationContainer.find("." + b.params.bulletClass), b.params.paginationClickable && b.params.a11y && b.a11y && b.a11y.initPagination()
                        }
                        "fraction" === b.params.paginationType && (t = b.params.paginationFractionRender ? b.params.paginationFractionRender(b, b.params.paginationCurrentClass, b.params.paginationTotalClass) : '<span class="' + b.params.paginationCurrentClass + '"></span> / <span class="' + b.params.paginationTotalClass + '"></span>', b.paginationContainer.html(t)), "progress" === b.params.paginationType && (t = b.params.paginationProgressRender ? b.params.paginationProgressRender(b, b.params.paginationProgressbarClass) : '<span class="' + b.params.paginationProgressbarClass + '"></span>', b.paginationContainer.html(t))
                    }
                }, b.update = function(t) {
                    function e() {
                        i = Math.min(Math.max(b.translate, b.maxTranslate()), b.minTranslate()), b.setWrapperTranslate(i), b.updateActiveIndex(), b.updateClasses()
                    }
                    if (b.updateContainerSize(), b.updateSlidesSize(), b.updateProgress(), b.updatePagination(), b.updateClasses(), b.params.scrollbar && b.scrollbar && b.scrollbar.set(), t) {
                        var n, i;
                        b.controller && b.controller.spline && (b.controller.spline = void 0), b.params.freeMode ? (e(), b.params.autoHeight && b.updateAutoHeight()) : (n = ("auto" === b.params.slidesPerView || b.params.slidesPerView > 1) && b.isEnd && !b.params.centeredSlides ? b.slideTo(b.slides.length - 1, 0, !1, !0) : b.slideTo(b.activeIndex, 0, !1, !0), n || e())
                    } else b.params.autoHeight && b.updateAutoHeight()
                }, b.onResize = function(t) {
                    b.params.breakpoints && b.setBreakpoint();
                    var e = b.params.allowSwipeToPrev,
                        n = b.params.allowSwipeToNext;
                    if (b.params.allowSwipeToPrev = b.params.allowSwipeToNext = !0, b.updateContainerSize(), b.updateSlidesSize(), ("auto" === b.params.slidesPerView || b.params.freeMode || t) && b.updatePagination(),
                        b.params.scrollbar && b.scrollbar && b.scrollbar.set(), b.controller && b.controller.spline && (b.controller.spline = void 0), b.params.freeMode) {
                        var i = Math.min(Math.max(b.translate, b.maxTranslate()), b.minTranslate());
                        b.setWrapperTranslate(i), b.updateActiveIndex(), b.updateClasses(), b.params.autoHeight && b.updateAutoHeight()
                    } else b.updateClasses(), ("auto" === b.params.slidesPerView || b.params.slidesPerView > 1) && b.isEnd && !b.params.centeredSlides ? b.slideTo(b.slides.length - 1, 0, !1, !0) : b.slideTo(b.activeIndex, 0, !1, !0);
                    b.params.allowSwipeToPrev = e, b.params.allowSwipeToNext = n
                };
                var x = ["mousedown", "mousemove", "mouseup"];
                window.navigator.pointerEnabled ? x = ["pointerdown", "pointermove", "pointerup"] : window.navigator.msPointerEnabled && (x = ["MSPointerDown", "MSPointerMove", "MSPointerUp"]), b.touchEvents = {
                    start: b.support.touch || !b.params.simulateTouch ? "touchstart" : x[0],
                    move: b.support.touch || !b.params.simulateTouch ? "touchmove" : x[1],
                    end: b.support.touch || !b.params.simulateTouch ? "touchend" : x[2]
                }, (window.navigator.pointerEnabled || window.navigator.msPointerEnabled) && ("container" === b.params.touchEventsTarget ? b.container : b.wrapper).addClass("swiper-wp8-" + b.params.direction), b.initEvents = function(t) {
                    var n = t ? "off" : "on",
                        i = t ? "removeEventListener" : "addEventListener",
                        a = "container" === b.params.touchEventsTarget ? b.container[0] : b.wrapper[0],
                        r = b.support.touch ? a : document,
                        s = !!b.params.nested;
                    b.browser.ie ? (a[i](b.touchEvents.start, b.onTouchStart, !1), r[i](b.touchEvents.move, b.onTouchMove, s), r[i](b.touchEvents.end, b.onTouchEnd, !1)) : (b.support.touch && (a[i](b.touchEvents.start, b.onTouchStart, !1), a[i](b.touchEvents.move, b.onTouchMove, s), a[i](b.touchEvents.end, b.onTouchEnd, !1)), !o.simulateTouch || b.device.ios || b.device.android || (a[i]("mousedown", b.onTouchStart, !1), document[i]("mousemove", b.onTouchMove, s), document[i]("mouseup", b.onTouchEnd, !1))), window[i]("resize", b.onResize), b.params.nextButton && (e(b.params.nextButton)[n]("click", b.onClickNext), b.params.a11y && b.a11y && e(b.params.nextButton)[n]("keydown", b.a11y.onEnterKey)), b.params.prevButton && (e(b.params.prevButton)[n]("click", b.onClickPrev), b.params.a11y && b.a11y && e(b.params.prevButton)[n]("keydown", b.a11y.onEnterKey)), b.params.pagination && b.params.paginationClickable && (e(b.paginationContainer)[n]("click", "." + b.params.bulletClass, b.onClickIndex), b.params.a11y && b.a11y && e(b.paginationContainer)[n]("keydown", "." + b.params.bulletClass, b.a11y.onEnterKey)), (b.params.preventClicks || b.params.preventClicksPropagation) && a[i]("click", b.preventClicks, !0)
                }, b.attachEvents = function(t) {
                    b.initEvents()
                }, b.detachEvents = function() {
                    b.initEvents(!0)
                }, b.allowClick = !0, b.preventClicks = function(t) {
                    b.allowClick || (b.params.preventClicks && t.preventDefault(), b.params.preventClicksPropagation && b.animating && (t.stopPropagation(), t.stopImmediatePropagation()))
                }, b.onClickNext = function(t) {
                    t.preventDefault(), (!b.isEnd || b.params.loop) && b.slideNext()
                }, b.onClickPrev = function(t) {
                    t.preventDefault(), (!b.isBeginning || b.params.loop) && b.slidePrev()
                }, b.onClickIndex = function(t) {
                    t.preventDefault();
                    var n = e(this).index() * b.params.slidesPerGroup;
                    b.params.loop && (n += b.loopedSlides), b.slideTo(n)
                }, b.updateClickedSlide = function(t) {
                    var n = s(t, "." + b.params.slideClass),
                        i = !1;
                    if (n)
                        for (var o = 0; o < b.slides.length; o++) b.slides[o] === n && (i = !0);
                    if (!n || !i) return b.clickedSlide = void 0, void(b.clickedIndex = void 0);
                    if (b.clickedSlide = n, b.clickedIndex = e(n).index(), b.params.slideToClickedSlide && void 0 !== b.clickedIndex && b.clickedIndex !== b.activeIndex) {
                        var a, r = b.clickedIndex;
                        if (b.params.loop) {
                            if (b.animating) return;
                            a = e(b.clickedSlide).attr("data-swiper-slide-index"), b.params.centeredSlides ? r < b.loopedSlides - b.params.slidesPerView / 2 || r > b.slides.length - b.loopedSlides + b.params.slidesPerView / 2 ? (b.fixLoop(), r = b.wrapper.children("." + b.params.slideClass + '[data-swiper-slide-index="' + a + '"]:not(.swiper-slide-duplicate)').eq(0).index(), setTimeout(function() {
                                b.slideTo(r)
                            }, 0)) : b.slideTo(r) : r > b.slides.length - b.params.slidesPerView ? (b.fixLoop(), r = b.wrapper.children("." + b.params.slideClass + '[data-swiper-slide-index="' + a + '"]:not(.swiper-slide-duplicate)').eq(0).index(), setTimeout(function() {
                                b.slideTo(r)
                            }, 0)) : b.slideTo(r)
                        } else b.slideTo(r)
                    }
                };
                var C, T, S, _, k, E, D, M, O, I, A = "input, select, textarea, button",
                    N = Date.now(),
                    P = [];
                b.animating = !1, b.touches = {
                    startX: 0,
                    startY: 0,
                    currentX: 0,
                    currentY: 0,
                    diff: 0
                };
                var z, L;
                if (b.onTouchStart = function(t) {
                        if (t.originalEvent && (t = t.originalEvent), z = "touchstart" === t.type, z || !("which" in t) || 3 !== t.which) {
                            if (b.params.noSwiping && s(t, "." + b.params.noSwipingClass)) return void(b.allowClick = !0);
                            if (!b.params.swipeHandler || s(t, b.params.swipeHandler)) {
                                var n = b.touches.currentX = "touchstart" === t.type ? t.targetTouches[0].pageX : t.pageX,
                                    i = b.touches.currentY = "touchstart" === t.type ? t.targetTouches[0].pageY : t.pageY;
                                if (!(b.device.ios && b.params.iOSEdgeSwipeDetection && n <= b.params.iOSEdgeSwipeThreshold)) {
                                    if (C = !0, T = !1, S = !0, k = void 0, L = void 0, b.touches.startX = n, b.touches.startY = i, _ = Date.now(), b.allowClick = !0, b.updateContainerSize(), b.swipeDirection = void 0, b.params.threshold > 0 && (M = !1), "touchstart" !== t.type) {
                                        var o = !0;
                                        e(t.target).is(A) && (o = !1), document.activeElement && e(document.activeElement).is(A) && document.activeElement.blur(), o && t.preventDefault()
                                    }
                                    b.emit("onTouchStart", b, t)
                                }
                            }
                        }
                    }, b.onTouchMove = function(t) {
                        if (t.originalEvent && (t = t.originalEvent), !(z && "mousemove" === t.type || t.preventedByNestedSwiper)) {
                            if (b.params.onlyExternal) return b.allowClick = !1, void(C && (b.touches.startX = b.touches.currentX = "touchmove" === t.type ? t.targetTouches[0].pageX : t.pageX, b.touches.startY = b.touches.currentY = "touchmove" === t.type ? t.targetTouches[0].pageY : t.pageY, _ = Date.now()));
                            if (z && document.activeElement && t.target === document.activeElement && e(t.target).is(A)) return T = !0, void(b.allowClick = !1);
                            if (S && b.emit("onTouchMove", b, t), !(t.targetTouches && t.targetTouches.length > 1)) {
                                if (b.touches.currentX = "touchmove" === t.type ? t.targetTouches[0].pageX : t.pageX, b.touches.currentY = "touchmove" === t.type ? t.targetTouches[0].pageY : t.pageY, "undefined" == typeof k) {
                                    var n = 180 * Math.atan2(Math.abs(b.touches.currentY - b.touches.startY), Math.abs(b.touches.currentX - b.touches.startX)) / Math.PI;
                                    k = b.isHorizontal() ? n > b.params.touchAngle : 90 - n > b.params.touchAngle
                                }
                                if (k && b.emit("onTouchMoveOpposite", b, t), "undefined" == typeof L && b.browser.ieTouch && (b.touches.currentX !== b.touches.startX || b.touches.currentY !== b.touches.startY) && (L = !0), C) {
                                    if (k) return void(C = !1);
                                    if (L || !b.browser.ieTouch) {
                                        b.allowClick = !1, b.emit("onSliderMove", b, t), t.preventDefault(), b.params.touchMoveStopPropagation && !b.params.nested && t.stopPropagation(), T || (o.loop && b.fixLoop(), D = b.getWrapperTranslate(), b.setWrapperTransition(0), b.animating && b.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"), b.params.autoplay && b.autoplaying && (b.params.autoplayDisableOnInteraction ? b.stopAutoplay() : b.pauseAutoplay()), I = !1, b.params.grabCursor && (b.container[0].style.cursor = "move", b.container[0].style.cursor = "-webkit-grabbing", b.container[0].style.cursor = "-moz-grabbin", b.container[0].style.cursor = "grabbing")), T = !0;
                                        var i = b.touches.diff = b.isHorizontal() ? b.touches.currentX - b.touches.startX : b.touches.currentY - b.touches.startY;
                                        i *= b.params.touchRatio, b.rtl && (i = -i), b.swipeDirection = i > 0 ? "prev" : "next", E = i + D;
                                        var a = !0;
                                        if (i > 0 && E > b.minTranslate() ? (a = !1, b.params.resistance && (E = b.minTranslate() - 1 + Math.pow(-b.minTranslate() + D + i, b.params.resistanceRatio))) : 0 > i && E < b.maxTranslate() && (a = !1, b.params.resistance && (E = b.maxTranslate() + 1 - Math.pow(b.maxTranslate() - D - i, b.params.resistanceRatio))), a && (t.preventedByNestedSwiper = !0), !b.params.allowSwipeToNext && "next" === b.swipeDirection && D > E && (E = D), !b.params.allowSwipeToPrev && "prev" === b.swipeDirection && E > D && (E = D), b.params.followFinger) {
                                            if (b.params.threshold > 0) {
                                                if (!(Math.abs(i) > b.params.threshold || M)) return void(E = D);
                                                if (!M) return M = !0, b.touches.startX = b.touches.currentX, b.touches.startY = b.touches.currentY, E = D, void(b.touches.diff = b.isHorizontal() ? b.touches.currentX - b.touches.startX : b.touches.currentY - b.touches.startY)
                                            }(b.params.freeMode || b.params.watchSlidesProgress) && b.updateActiveIndex(), b.params.freeMode && (0 === P.length && P.push({
                                                position: b.touches[b.isHorizontal() ? "startX" : "startY"],
                                                time: _
                                            }), P.push({
                                                position: b.touches[b.isHorizontal() ? "currentX" : "currentY"],
                                                time: (new window.Date).getTime()
                                            })), b.updateProgress(E), b.setWrapperTranslate(E)
                                        }
                                    }
                                }
                            }
                        }
                    }, b.onTouchEnd = function(t) {
                        if (t.originalEvent && (t = t.originalEvent), S && b.emit("onTouchEnd", b, t), S = !1, C) {
                            b.params.grabCursor && T && C && (b.container[0].style.cursor = "move", b.container[0].style.cursor = "-webkit-grab", b.container[0].style.cursor = "-moz-grab", b.container[0].style.cursor = "grab");
                            var n = Date.now(),
                                i = n - _;
                            if (b.allowClick && (b.updateClickedSlide(t), b.emit("onTap", b, t), 300 > i && n - N > 300 && (O && clearTimeout(O), O = setTimeout(function() {
                                    b && (b.params.paginationHide && b.paginationContainer.length > 0 && !e(t.target).hasClass(b.params.bulletClass) && b.paginationContainer.toggleClass(b.params.paginationHiddenClass), b.emit("onClick", b, t))
                                }, 300)), 300 > i && 300 > n - N && (O && clearTimeout(O), b.emit("onDoubleTap", b, t))), N = Date.now(), setTimeout(function() {
                                    b && (b.allowClick = !0)
                                }, 0), !C || !T || !b.swipeDirection || 0 === b.touches.diff || E === D) return void(C = T = !1);
                            C = T = !1;
                            var o;
                            if (o = b.params.followFinger ? b.rtl ? b.translate : -b.translate : -E, b.params.freeMode) {
                                if (o < -b.minTranslate()) return void b.slideTo(b.activeIndex);
                                if (o > -b.maxTranslate()) return void(b.slides.length < b.snapGrid.length ? b.slideTo(b.snapGrid.length - 1) : b.slideTo(b.slides.length - 1));
                                if (b.params.freeModeMomentum) {
                                    if (P.length > 1) {
                                        var a = P.pop(),
                                            r = P.pop(),
                                            s = a.position - r.position,
                                            l = a.time - r.time;
                                        b.velocity = s / l, b.velocity = b.velocity / 2, Math.abs(b.velocity) < b.params.freeModeMinimumVelocity && (b.velocity = 0), (l > 150 || (new window.Date).getTime() - a.time > 300) && (b.velocity = 0)
                                    } else b.velocity = 0;
                                    P.length = 0;
                                    var c = 1e3 * b.params.freeModeMomentumRatio,
                                        d = b.velocity * c,
                                        u = b.translate + d;
                                    b.rtl && (u = -u);
                                    var p, h = !1,
                                        f = 20 * Math.abs(b.velocity) * b.params.freeModeMomentumBounceRatio;
                                    if (u < b.maxTranslate()) b.params.freeModeMomentumBounce ? (u + b.maxTranslate() < -f && (u = b.maxTranslate() - f), p = b.maxTranslate(), h = !0, I = !0) : u = b.maxTranslate();
                                    else if (u > b.minTranslate()) b.params.freeModeMomentumBounce ? (u - b.minTranslate() > f && (u = b.minTranslate() + f), p = b.minTranslate(), h = !0, I = !0) : u = b.minTranslate();
                                    else if (b.params.freeModeSticky) {
                                        var m, g = 0;
                                        for (g = 0; g < b.snapGrid.length; g += 1)
                                            if (b.snapGrid[g] > -u) {
                                                m = g;
                                                break
                                            }
                                        u = Math.abs(b.snapGrid[m] - u) < Math.abs(b.snapGrid[m - 1] - u) || "next" === b.swipeDirection ? b.snapGrid[m] : b.snapGrid[m - 1], b.rtl || (u = -u)
                                    }
                                    if (0 !== b.velocity) c = b.rtl ? Math.abs((-u - b.translate) / b.velocity) : Math.abs((u - b.translate) / b.velocity);
                                    else if (b.params.freeModeSticky) return void b.slideReset();
                                    b.params.freeModeMomentumBounce && h ? (b.updateProgress(p), b.setWrapperTransition(c), b.setWrapperTranslate(u), b.onTransitionStart(), b.animating = !0, b.wrapper.transitionEnd(function() {
                                        b && I && (b.emit("onMomentumBounce", b), b.setWrapperTransition(b.params.speed), b.setWrapperTranslate(p), b.wrapper.transitionEnd(function() {
                                            b && b.onTransitionEnd()
                                        }))
                                    })) : b.velocity ? (b.updateProgress(u), b.setWrapperTransition(c), b.setWrapperTranslate(u), b.onTransitionStart(), b.animating || (b.animating = !0, b.wrapper.transitionEnd(function() {
                                        b && b.onTransitionEnd()
                                    }))) : b.updateProgress(u), b.updateActiveIndex()
                                }
                                return void((!b.params.freeModeMomentum || i >= b.params.longSwipesMs) && (b.updateProgress(), b.updateActiveIndex()))
                            }
                            var v, y = 0,
                                w = b.slidesSizesGrid[0];
                            for (v = 0; v < b.slidesGrid.length; v += b.params.slidesPerGroup) "undefined" != typeof b.slidesGrid[v + b.params.slidesPerGroup] ? o >= b.slidesGrid[v] && o < b.slidesGrid[v + b.params.slidesPerGroup] && (y = v, w = b.slidesGrid[v + b.params.slidesPerGroup] - b.slidesGrid[v]) : o >= b.slidesGrid[v] && (y = v, w = b.slidesGrid[b.slidesGrid.length - 1] - b.slidesGrid[b.slidesGrid.length - 2]);
                            var x = (o - b.slidesGrid[y]) / w;
                            if (i > b.params.longSwipesMs) {
                                if (!b.params.longSwipes) return void b.slideTo(b.activeIndex);
                                "next" === b.swipeDirection && (x >= b.params.longSwipesRatio ? b.slideTo(y + b.params.slidesPerGroup) : b.slideTo(y)), "prev" === b.swipeDirection && (x > 1 - b.params.longSwipesRatio ? b.slideTo(y + b.params.slidesPerGroup) : b.slideTo(y))
                            } else {
                                if (!b.params.shortSwipes) return void b.slideTo(b.activeIndex);
                                "next" === b.swipeDirection && b.slideTo(y + b.params.slidesPerGroup), "prev" === b.swipeDirection && b.slideTo(y)
                            }
                        }
                    }, b._slideTo = function(t, e) {
                        return b.slideTo(t, e, !0, !0)
                    }, b.slideTo = function(t, e, n, i) {
                        "undefined" == typeof n && (n = !0), "undefined" == typeof t && (t = 0), 0 > t && (t = 0), b.snapIndex = Math.floor(t / b.params.slidesPerGroup), b.snapIndex >= b.snapGrid.length && (b.snapIndex = b.snapGrid.length - 1);
                        var o = -b.snapGrid[b.snapIndex];
                        b.params.autoplay && b.autoplaying && (i || !b.params.autoplayDisableOnInteraction ? b.pauseAutoplay(e) : b.stopAutoplay()), b.updateProgress(o);
                        for (var a = 0; a < b.slidesGrid.length; a++) - Math.floor(100 * o) >= Math.floor(100 * b.slidesGrid[a]) && (t = a);
                        return !(!b.params.allowSwipeToNext && o < b.translate && o < b.minTranslate()) && (!(!b.params.allowSwipeToPrev && o > b.translate && o > b.maxTranslate() && (b.activeIndex || 0) !== t) && ("undefined" == typeof e && (e = b.params.speed), b.previousIndex = b.activeIndex || 0, b.activeIndex = t, b.rtl && -o === b.translate || !b.rtl && o === b.translate ? (b.params.autoHeight && b.updateAutoHeight(), b.updateClasses(), "slide" !== b.params.effect && b.setWrapperTranslate(o), !1) : (b.updateClasses(), b.onTransitionStart(n), 0 === e ? (b.setWrapperTranslate(o), b.setWrapperTransition(0), b.onTransitionEnd(n)) : (b.setWrapperTranslate(o), b.setWrapperTransition(e), b.animating || (b.animating = !0, b.wrapper.transitionEnd(function() {
                            b && b.onTransitionEnd(n)
                        }))), !0)))
                    }, b.onTransitionStart = function(t) {
                        "undefined" == typeof t && (t = !0), b.params.autoHeight && b.updateAutoHeight(), b.lazy && b.lazy.onTransitionStart(), t && (b.emit("onTransitionStart", b), b.activeIndex !== b.previousIndex && (b.emit("onSlideChangeStart", b), b.activeIndex > b.previousIndex ? b.emit("onSlideNextStart", b) : b.emit("onSlidePrevStart", b)))
                    }, b.onTransitionEnd = function(t) {
                        b.animating = !1, b.setWrapperTransition(0), "undefined" == typeof t && (t = !0), b.lazy && b.lazy.onTransitionEnd(), t && (b.emit("onTransitionEnd", b), b.activeIndex !== b.previousIndex && (b.emit("onSlideChangeEnd", b), b.activeIndex > b.previousIndex ? b.emit("onSlideNextEnd", b) : b.emit("onSlidePrevEnd", b))), b.params.hashnav && b.hashnav && b.hashnav.setHash()
                    }, b.slideNext = function(t, e, n) {
                        return b.params.loop ? !b.animating && (b.fixLoop(), b.container[0].clientLeft, b.slideTo(b.activeIndex + b.params.slidesPerGroup, e, t, n)) : b.slideTo(b.activeIndex + b.params.slidesPerGroup, e, t, n)
                    }, b._slideNext = function(t) {
                        return b.slideNext(!0, t, !0)
                    }, b.slidePrev = function(t, e, n) {
                        return b.params.loop ? !b.animating && (b.fixLoop(), b.container[0].clientLeft, b.slideTo(b.activeIndex - 1, e, t, n)) : b.slideTo(b.activeIndex - 1, e, t, n)
                    }, b._slidePrev = function(t) {
                        return b.slidePrev(!0, t, !0)
                    }, b.slideReset = function(t, e, n) {
                        return b.slideTo(b.activeIndex, e, t)
                    }, b.setWrapperTransition = function(t, e) {
                        b.wrapper.transition(t), "slide" !== b.params.effect && b.effects[b.params.effect] && b.effects[b.params.effect].setTransition(t), b.params.parallax && b.parallax && b.parallax.setTransition(t), b.params.scrollbar && b.scrollbar && b.scrollbar.setTransition(t), b.params.control && b.controller && b.controller.setTransition(t, e), b.emit("onSetTransition", b, t)
                    }, b.setWrapperTranslate = function(t, e, n) {
                        var i = 0,
                            o = 0,
                            r = 0;
                        b.isHorizontal() ? i = b.rtl ? -t : t : o = t, b.params.roundLengths && (i = a(i), o = a(o)), b.params.virtualTranslate || (b.support.transforms3d ? b.wrapper.transform("translate3d(" + i + "px, " + o + "px, " + r + "px)") : b.wrapper.transform("translate(" + i + "px, " + o + "px)")), b.translate = b.isHorizontal() ? i : o;
                        var s, l = b.maxTranslate() - b.minTranslate();
                        s = 0 === l ? 0 : (t - b.minTranslate()) / l, s !== b.progress && b.updateProgress(t), e && b.updateActiveIndex(), "slide" !== b.params.effect && b.effects[b.params.effect] && b.effects[b.params.effect].setTranslate(b.translate), b.params.parallax && b.parallax && b.parallax.setTranslate(b.translate), b.params.scrollbar && b.scrollbar && b.scrollbar.setTranslate(b.translate), b.params.control && b.controller && b.controller.setTranslate(b.translate, n), b.emit("onSetTranslate", b, b.translate)
                    }, b.getTranslate = function(t, e) {
                        var n, i, o, a;
                        return "undefined" == typeof e && (e = "x"), b.params.virtualTranslate ? b.rtl ? -b.translate : b.translate : (o = window.getComputedStyle(t, null), window.WebKitCSSMatrix ? (i = o.transform || o.webkitTransform, i.split(",").length > 6 && (i = i.split(", ").map(function(t) {
                            return t.replace(",", ".")
                        }).join(", ")), a = new window.WebKitCSSMatrix("none" === i ? "" : i)) : (a = o.MozTransform || o.OTransform || o.MsTransform || o.msTransform || o.transform || o.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,"), n = a.toString().split(",")), "x" === e && (i = window.WebKitCSSMatrix ? a.m41 : 16 === n.length ? parseFloat(n[12]) : parseFloat(n[4])), "y" === e && (i = window.WebKitCSSMatrix ? a.m42 : 16 === n.length ? parseFloat(n[13]) : parseFloat(n[5])), b.rtl && i && (i = -i), i || 0)
                    }, b.getWrapperTranslate = function(t) {
                        return "undefined" == typeof t && (t = b.isHorizontal() ? "x" : "y"), b.getTranslate(b.wrapper[0], t)
                    }, b.observers = [], b.initObservers = function() {
                        if (b.params.observeParents)
                            for (var t = b.container.parents(), e = 0; e < t.length; e++) l(t[e]);
                        l(b.container[0], {
                            childList: !1
                        }), l(b.wrapper[0], {
                            attributes: !1
                        })
                    }, b.disconnectObservers = function() {
                        for (var t = 0; t < b.observers.length; t++) b.observers[t].disconnect();
                        b.observers = []
                    }, b.createLoop = function() {
                        b.wrapper.children("." + b.params.slideClass + "." + b.params.slideDuplicateClass).remove();
                        var t = b.wrapper.children("." + b.params.slideClass);
                        "auto" !== b.params.slidesPerView || b.params.loopedSlides || (b.params.loopedSlides = t.length), b.loopedSlides = parseInt(b.params.loopedSlides || b.params.slidesPerView, 10), b.loopedSlides = b.loopedSlides + b.params.loopAdditionalSlides, b.loopedSlides > t.length && (b.loopedSlides = t.length);
                        var n, i = [],
                            o = [];
                        for (t.each(function(n, a) {
                                var r = e(this);
                                n < b.loopedSlides && o.push(a), n < t.length && n >= t.length - b.loopedSlides && i.push(a), r.attr("data-swiper-slide-index", n)
                            }), n = 0; n < o.length; n++) b.wrapper.append(e(o[n].cloneNode(!0)).addClass(b.params.slideDuplicateClass));
                        for (n = i.length - 1; n >= 0; n--) b.wrapper.prepend(e(i[n].cloneNode(!0)).addClass(b.params.slideDuplicateClass))
                    }, b.destroyLoop = function() {
                        b.wrapper.children("." + b.params.slideClass + "." + b.params.slideDuplicateClass).remove(), b.slides.removeAttr("data-swiper-slide-index")
                    }, b.fixLoop = function() {
                        var t;
                        b.activeIndex < b.loopedSlides ? (t = b.slides.length - 3 * b.loopedSlides + b.activeIndex, t += b.loopedSlides, b.slideTo(t, 0, !1, !0)) : ("auto" === b.params.slidesPerView && b.activeIndex >= 2 * b.loopedSlides || b.activeIndex > b.slides.length - 2 * b.params.slidesPerView) && (t = -b.slides.length + b.activeIndex + b.loopedSlides, t += b.loopedSlides, b.slideTo(t, 0, !1, !0))
                    }, b.appendSlide = function(t) {
                        if (b.params.loop && b.destroyLoop(), "object" == typeof t && t.length)
                            for (var e = 0; e < t.length; e++) t[e] && b.wrapper.append(t[e]);
                        else b.wrapper.append(t);
                        b.params.loop && b.createLoop(), b.params.observer && b.support.observer || b.update(!0)
                    }, b.prependSlide = function(t) {
                        b.params.loop && b.destroyLoop();
                        var e = b.activeIndex + 1;
                        if ("object" == typeof t && t.length) {
                            for (var n = 0; n < t.length; n++) t[n] && b.wrapper.prepend(t[n]);
                            e = b.activeIndex + t.length
                        } else b.wrapper.prepend(t);
                        b.params.loop && b.createLoop(), b.params.observer && b.support.observer || b.update(!0), b.slideTo(e, 0, !1)
                    }, b.removeSlide = function(t) {
                        b.params.loop && (b.destroyLoop(), b.slides = b.wrapper.children("." + b.params.slideClass));
                        var e, n = b.activeIndex;
                        if ("object" == typeof t && t.length) {
                            for (var i = 0; i < t.length; i++) e = t[i], b.slides[e] && b.slides.eq(e).remove(), n > e && n--;
                            n = Math.max(n, 0)
                        } else e = t, b.slides[e] && b.slides.eq(e).remove(), n > e && n--, n = Math.max(n, 0);
                        b.params.loop && b.createLoop(), b.params.observer && b.support.observer || b.update(!0), b.params.loop ? b.slideTo(n + b.loopedSlides, 0, !1) : b.slideTo(n, 0, !1)
                    }, b.removeAllSlides = function() {
                        for (var t = [], e = 0; e < b.slides.length; e++) t.push(e);
                        b.removeSlide(t)
                    }, b.effects = {
                        fade: {
                            setTranslate: function() {
                                for (var t = 0; t < b.slides.length; t++) {
                                    var e = b.slides.eq(t),
                                        n = e[0].swiperSlideOffset,
                                        i = -n;
                                    b.params.virtualTranslate || (i -= b.translate);
                                    var o = 0;
                                    b.isHorizontal() || (o = i, i = 0);
                                    var a = b.params.fade.crossFade ? Math.max(1 - Math.abs(e[0].progress), 0) : 1 + Math.min(Math.max(e[0].progress, -1), 0);
                                    e.css({
                                        opacity: a
                                    }).transform("translate3d(" + i + "px, " + o + "px, 0px)")
                                }
                            },
                            setTransition: function(t) {
                                if (b.slides.transition(t), b.params.virtualTranslate && 0 !== t) {
                                    var e = !1;
                                    b.slides.transitionEnd(function() {
                                        if (!e && b) {
                                            e = !0, b.animating = !1;
                                            for (var t = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], n = 0; n < t.length; n++) b.wrapper.trigger(t[n])
                                        }
                                    })
                                }
                            }
                        },
                        flip: {
                            setTranslate: function() {
                                for (var t = 0; t < b.slides.length; t++) {
                                    var n = b.slides.eq(t),
                                        i = n[0].progress;
                                    b.params.flip.limitRotation && (i = Math.max(Math.min(n[0].progress, 1), -1));
                                    var o = n[0].swiperSlideOffset,
                                        a = -180 * i,
                                        r = a,
                                        s = 0,
                                        l = -o,
                                        c = 0;
                                    if (b.isHorizontal() ? b.rtl && (r = -r) : (c = l, l = 0, s = -r, r = 0), n[0].style.zIndex = -Math.abs(Math.round(i)) + b.slides.length, b.params.flip.slideShadows) {
                                        var d = b.isHorizontal() ? n.find(".swiper-slide-shadow-left") : n.find(".swiper-slide-shadow-top"),
                                            u = b.isHorizontal() ? n.find(".swiper-slide-shadow-right") : n.find(".swiper-slide-shadow-bottom");
                                        0 === d.length && (d = e('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "left" : "top") + '"></div>'), n.append(d)), 0 === u.length && (u = e('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "right" : "bottom") + '"></div>'), n.append(u)), d.length && (d[0].style.opacity = Math.max(-i, 0)), u.length && (u[0].style.opacity = Math.max(i, 0))
                                    }
                                    n.transform("translate3d(" + l + "px, " + c + "px, 0px) rotateX(" + s + "deg) rotateY(" + r + "deg)")
                                }
                            },
                            setTransition: function(t) {
                                if (b.slides.transition(t).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(t), b.params.virtualTranslate && 0 !== t) {
                                    var n = !1;
                                    b.slides.eq(b.activeIndex).transitionEnd(function() {
                                        if (!n && b && e(this).hasClass(b.params.slideActiveClass)) {
                                            n = !0, b.animating = !1;
                                            for (var t = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], i = 0; i < t.length; i++) b.wrapper.trigger(t[i])
                                        }
                                    })
                                }
                            }
                        },
                        cube: {
                            setTranslate: function() {
                                var t, n = 0;
                                b.params.cube.shadow && (b.isHorizontal() ? (t = b.wrapper.find(".swiper-cube-shadow"), 0 === t.length && (t = e('<div class="swiper-cube-shadow"></div>'), b.wrapper.append(t)), t.css({
                                    height: b.width + "px"
                                })) : (t = b.container.find(".swiper-cube-shadow"), 0 === t.length && (t = e('<div class="swiper-cube-shadow"></div>'), b.container.append(t))));
                                for (var i = 0; i < b.slides.length; i++) {
                                    var o = b.slides.eq(i),
                                        a = 90 * i,
                                        r = Math.floor(a / 360);
                                    b.rtl && (a = -a, r = Math.floor(-a / 360));
                                    var s = Math.max(Math.min(o[0].progress, 1), -1),
                                        l = 0,
                                        c = 0,
                                        d = 0;
                                    i % 4 === 0 ? (l = 4 * -r * b.size, d = 0) : (i - 1) % 4 === 0 ? (l = 0, d = 4 * -r * b.size) : (i - 2) % 4 === 0 ? (l = b.size + 4 * r * b.size, d = b.size) : (i - 3) % 4 === 0 && (l = -b.size, d = 3 * b.size + 4 * b.size * r), b.rtl && (l = -l), b.isHorizontal() || (c = l, l = 0);
                                    var u = "rotateX(" + (b.isHorizontal() ? 0 : -a) + "deg) rotateY(" + (b.isHorizontal() ? a : 0) + "deg) translate3d(" + l + "px, " + c + "px, " + d + "px)";
                                    if (1 >= s && s > -1 && (n = 90 * i + 90 * s, b.rtl && (n = 90 * -i - 90 * s)), o.transform(u), b.params.cube.slideShadows) {
                                        var p = b.isHorizontal() ? o.find(".swiper-slide-shadow-left") : o.find(".swiper-slide-shadow-top"),
                                            h = b.isHorizontal() ? o.find(".swiper-slide-shadow-right") : o.find(".swiper-slide-shadow-bottom");
                                        0 === p.length && (p = e('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "left" : "top") + '"></div>'), o.append(p)), 0 === h.length && (h = e('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "right" : "bottom") + '"></div>'), o.append(h)), p.length && (p[0].style.opacity = Math.max(-s, 0)), h.length && (h[0].style.opacity = Math.max(s, 0))
                                    }
                                }
                                if (b.wrapper.css({
                                        "-webkit-transform-origin": "50% 50% -" + b.size / 2 + "px",
                                        "-moz-transform-origin": "50% 50% -" + b.size / 2 + "px",
                                        "-ms-transform-origin": "50% 50% -" + b.size / 2 + "px",
                                        "transform-origin": "50% 50% -" + b.size / 2 + "px"
                                    }), b.params.cube.shadow)
                                    if (b.isHorizontal()) t.transform("translate3d(0px, " + (b.width / 2 + b.params.cube.shadowOffset) + "px, " + -b.width / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + b.params.cube.shadowScale + ")");
                                    else {
                                        var f = Math.abs(n) - 90 * Math.floor(Math.abs(n) / 90),
                                            m = 1.5 - (Math.sin(2 * f * Math.PI / 360) / 2 + Math.cos(2 * f * Math.PI / 360) / 2),
                                            g = b.params.cube.shadowScale,
                                            v = b.params.cube.shadowScale / m,
                                            y = b.params.cube.shadowOffset;
                                        t.transform("scale3d(" + g + ", 1, " + v + ") translate3d(0px, " + (b.height / 2 + y) + "px, " + -b.height / 2 / v + "px) rotateX(-90deg)")
                                    }
                                var w = b.isSafari || b.isUiWebView ? -b.size / 2 : 0;
                                b.wrapper.transform("translate3d(0px,0," + w + "px) rotateX(" + (b.isHorizontal() ? 0 : n) + "deg) rotateY(" + (b.isHorizontal() ? -n : 0) + "deg)")
                            },
                            setTransition: function(t) {
                                b.slides.transition(t).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(t), b.params.cube.shadow && !b.isHorizontal() && b.container.find(".swiper-cube-shadow").transition(t)
                            }
                        },
                        coverflow: {
                            setTranslate: function() {
                                for (var t = b.translate, n = b.isHorizontal() ? -t + b.width / 2 : -t + b.height / 2, i = b.isHorizontal() ? b.params.coverflow.rotate : -b.params.coverflow.rotate, o = b.params.coverflow.depth, a = 0, r = b.slides.length; r > a; a++) {
                                    var s = b.slides.eq(a),
                                        l = b.slidesSizesGrid[a],
                                        c = s[0].swiperSlideOffset,
                                        d = (n - c - l / 2) / l * b.params.coverflow.modifier,
                                        u = b.isHorizontal() ? i * d : 0,
                                        p = b.isHorizontal() ? 0 : i * d,
                                        h = -o * Math.abs(d),
                                        f = b.isHorizontal() ? 0 : b.params.coverflow.stretch * d,
                                        m = b.isHorizontal() ? b.params.coverflow.stretch * d : 0;
                                    Math.abs(m) < .001 && (m = 0), Math.abs(f) < .001 && (f = 0), Math.abs(h) < .001 && (h = 0), Math.abs(u) < .001 && (u = 0), Math.abs(p) < .001 && (p = 0);
                                    var g = "translate3d(" + m + "px," + f + "px," + h + "px)  rotateX(" + p + "deg) rotateY(" + u + "deg)";
                                    if (s.transform(g), s[0].style.zIndex = -Math.abs(Math.round(d)) + 1, b.params.coverflow.slideShadows) {
                                        var v = b.isHorizontal() ? s.find(".swiper-slide-shadow-left") : s.find(".swiper-slide-shadow-top"),
                                            y = b.isHorizontal() ? s.find(".swiper-slide-shadow-right") : s.find(".swiper-slide-shadow-bottom");
                                        0 === v.length && (v = e('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "left" : "top") + '"></div>'), s.append(v)), 0 === y.length && (y = e('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "right" : "bottom") + '"></div>'), s.append(y)), v.length && (v[0].style.opacity = d > 0 ? d : 0), y.length && (y[0].style.opacity = -d > 0 ? -d : 0)
                                    }
                                }
                                if (b.browser.ie) {
                                    var w = b.wrapper[0].style;
                                    w.perspectiveOrigin = n + "px 50%"
                                }
                            },
                            setTransition: function(t) {
                                b.slides.transition(t).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(t)
                            }
                        }
                    }, b.lazy = {
                        initialImageLoaded: !1,
                        loadImageInSlide: function(t, n) {
                            if ("undefined" != typeof t && ("undefined" == typeof n && (n = !0), 0 !== b.slides.length)) {
                                var i = b.slides.eq(t),
                                    o = i.find(".swiper-lazy:not(.swiper-lazy-loaded):not(.swiper-lazy-loading)");
                                !i.hasClass("swiper-lazy") || i.hasClass("swiper-lazy-loaded") || i.hasClass("swiper-lazy-loading") || (o = o.add(i[0])), 0 !== o.length && o.each(function() {
                                    var t = e(this);
                                    t.addClass("swiper-lazy-loading");
                                    var o = t.attr("data-background"),
                                        a = t.attr("data-src"),
                                        r = t.attr("data-srcset");
                                    b.loadImage(t[0], a || o, r, !1, function() {
                                        if (o ? (t.css("background-image", "url(" + o + ")"), t.removeAttr("data-background")) : (r && (t.attr("srcset", r), t.removeAttr("data-srcset")), a && (t.attr("src", a), t.removeAttr("data-src"))), t.addClass("swiper-lazy-loaded").removeClass("swiper-lazy-loading"), i.find(".swiper-lazy-preloader, .preloader").remove(), b.params.loop && n) {
                                            var e = i.attr("data-swiper-slide-index");
                                            if (i.hasClass(b.params.slideDuplicateClass)) {
                                                var s = b.wrapper.children('[data-swiper-slide-index="' + e + '"]:not(.' + b.params.slideDuplicateClass + ")");
                                                b.lazy.loadImageInSlide(s.index(), !1)
                                            } else {
                                                var l = b.wrapper.children("." + b.params.slideDuplicateClass + '[data-swiper-slide-index="' + e + '"]');
                                                b.lazy.loadImageInSlide(l.index(), !1)
                                            }
                                        }
                                        b.emit("onLazyImageReady", b, i[0], t[0])
                                    }), b.emit("onLazyImageLoad", b, i[0], t[0])
                                })
                            }
                        },
                        load: function() {
                            var t;
                            if (b.params.watchSlidesVisibility) b.wrapper.children("." + b.params.slideVisibleClass).each(function() {
                                b.lazy.loadImageInSlide(e(this).index())
                            });
                            else if (b.params.slidesPerView > 1)
                                for (t = b.activeIndex; t < b.activeIndex + b.params.slidesPerView; t++) b.slides[t] && b.lazy.loadImageInSlide(t);
                            else b.lazy.loadImageInSlide(b.activeIndex);
                            if (b.params.lazyLoadingInPrevNext)
                                if (b.params.slidesPerView > 1 || b.params.lazyLoadingInPrevNextAmount && b.params.lazyLoadingInPrevNextAmount > 1) {
                                    var n = b.params.lazyLoadingInPrevNextAmount,
                                        i = b.params.slidesPerView,
                                        o = Math.min(b.activeIndex + i + Math.max(n, i), b.slides.length),
                                        a = Math.max(b.activeIndex - Math.max(i, n), 0);
                                    for (t = b.activeIndex + b.params.slidesPerView; o > t; t++) b.slides[t] && b.lazy.loadImageInSlide(t);
                                    for (t = a; t < b.activeIndex; t++) b.slides[t] && b.lazy.loadImageInSlide(t)
                                } else {
                                    var r = b.wrapper.children("." + b.params.slideNextClass);
                                    r.length > 0 && b.lazy.loadImageInSlide(r.index());
                                    var s = b.wrapper.children("." + b.params.slidePrevClass);
                                    s.length > 0 && b.lazy.loadImageInSlide(s.index())
                                }
                        },
                        onTransitionStart: function() {
                            b.params.lazyLoading && (b.params.lazyLoadingOnTransitionStart || !b.params.lazyLoadingOnTransitionStart && !b.lazy.initialImageLoaded) && b.lazy.load()
                        },
                        onTransitionEnd: function() {
                            b.params.lazyLoading && !b.params.lazyLoadingOnTransitionStart && b.lazy.load()
                        }
                    }, b.scrollbar = {
                        isTouched: !1,
                        setDragPosition: function(t) {
                            var e = b.scrollbar,
                                n = b.isHorizontal() ? "touchstart" === t.type || "touchmove" === t.type ? t.targetTouches[0].pageX : t.pageX || t.clientX : "touchstart" === t.type || "touchmove" === t.type ? t.targetTouches[0].pageY : t.pageY || t.clientY,
                                i = n - e.track.offset()[b.isHorizontal() ? "left" : "top"] - e.dragSize / 2,
                                o = -b.minTranslate() * e.moveDivider,
                                a = -b.maxTranslate() * e.moveDivider;
                            o > i ? i = o : i > a && (i = a), i = -i / e.moveDivider, b.updateProgress(i), b.setWrapperTranslate(i, !0)
                        },
                        dragStart: function(t) {
                            var e = b.scrollbar;
                            e.isTouched = !0, t.preventDefault(), t.stopPropagation(), e.setDragPosition(t), clearTimeout(e.dragTimeout), e.track.transition(0), b.params.scrollbarHide && e.track.css("opacity", 1), b.wrapper.transition(100), e.drag.transition(100), b.emit("onScrollbarDragStart", b)
                        },
                        dragMove: function(t) {
                            var e = b.scrollbar;
                            e.isTouched && (t.preventDefault ? t.preventDefault() : t.returnValue = !1, e.setDragPosition(t), b.wrapper.transition(0), e.track.transition(0), e.drag.transition(0), b.emit("onScrollbarDragMove", b))
                        },
                        dragEnd: function(t) {
                            var e = b.scrollbar;
                            e.isTouched && (e.isTouched = !1, b.params.scrollbarHide && (clearTimeout(e.dragTimeout), e.dragTimeout = setTimeout(function() {
                                e.track.css("opacity", 0), e.track.transition(400)
                            }, 1e3)), b.emit("onScrollbarDragEnd", b), b.params.scrollbarSnapOnRelease && b.slideReset())
                        },
                        enableDraggable: function() {
                            var t = b.scrollbar,
                                n = b.support.touch ? t.track : document;
                            e(t.track).on(b.touchEvents.start, t.dragStart), e(n).on(b.touchEvents.move, t.dragMove), e(n).on(b.touchEvents.end, t.dragEnd)
                        },
                        disableDraggable: function() {
                            var t = b.scrollbar,
                                n = b.support.touch ? t.track : document;
                            e(t.track).off(b.touchEvents.start, t.dragStart), e(n).off(b.touchEvents.move, t.dragMove), e(n).off(b.touchEvents.end, t.dragEnd)
                        },
                        set: function() {
                            if (b.params.scrollbar) {
                                var t = b.scrollbar;
                                t.track = e(b.params.scrollbar), t.drag = t.track.find(".swiper-scrollbar-drag"), 0 === t.drag.length && (t.drag = e('<div class="swiper-scrollbar-drag"></div>'), t.track.append(t.drag)), t.drag[0].style.width = "", t.drag[0].style.height = "", t.trackSize = b.isHorizontal() ? t.track[0].offsetWidth : t.track[0].offsetHeight, t.divider = b.size / b.virtualSize, t.moveDivider = t.divider * (t.trackSize / b.size), t.dragSize = t.trackSize * t.divider, b.isHorizontal() ? t.drag[0].style.width = t.dragSize + "px" : t.drag[0].style.height = t.dragSize + "px", t.divider >= 1 ? t.track[0].style.display = "none" : t.track[0].style.display = "", b.params.scrollbarHide && (t.track[0].style.opacity = 0)
                            }
                        },
                        setTranslate: function() {
                            if (b.params.scrollbar) {
                                var t, e = b.scrollbar,
                                    n = (b.translate || 0, e.dragSize);
                                t = (e.trackSize - e.dragSize) * b.progress, b.rtl && b.isHorizontal() ? (t = -t, t > 0 ? (n = e.dragSize - t, t = 0) : -t + e.dragSize > e.trackSize && (n = e.trackSize + t)) : 0 > t ? (n = e.dragSize + t, t = 0) : t + e.dragSize > e.trackSize && (n = e.trackSize - t), b.isHorizontal() ? (b.support.transforms3d ? e.drag.transform("translate3d(" + t + "px, 0, 0)") : e.drag.transform("translateX(" + t + "px)"), e.drag[0].style.width = n + "px") : (b.support.transforms3d ? e.drag.transform("translate3d(0px, " + t + "px, 0)") : e.drag.transform("translateY(" + t + "px)"), e.drag[0].style.height = n + "px"), b.params.scrollbarHide && (clearTimeout(e.timeout), e.track[0].style.opacity = 1, e.timeout = setTimeout(function() {
                                    e.track[0].style.opacity = 0, e.track.transition(400)
                                }, 1e3))
                            }
                        },
                        setTransition: function(t) {
                            b.params.scrollbar && b.scrollbar.drag.transition(t)
                        }
                    }, b.controller = {
                        LinearSpline: function(t, e) {
                            this.x = t, this.y = e, this.lastIndex = t.length - 1;
                            var n, i;
                            this.x.length, this.interpolate = function(t) {
                                return t ? (i = o(this.x, t), n = i - 1, (t - this.x[n]) * (this.y[i] - this.y[n]) / (this.x[i] - this.x[n]) + this.y[n]) : 0
                            };
                            var o = function() {
                                var t, e, n;
                                return function(i, o) {
                                    for (e = -1, t = i.length; t - e > 1;) i[n = t + e >> 1] <= o ? e = n : t = n;
                                    return t
                                }
                            }()
                        },
                        getInterpolateFunction: function(t) {
                            b.controller.spline || (b.controller.spline = b.params.loop ? new b.controller.LinearSpline(b.slidesGrid, t.slidesGrid) : new b.controller.LinearSpline(b.snapGrid, t.snapGrid))
                        },
                        setTranslate: function(t, e) {
                            function i(e) {
                                t = e.rtl && "horizontal" === e.params.direction ? -b.translate : b.translate, "slide" === b.params.controlBy && (b.controller.getInterpolateFunction(e), a = -b.controller.spline.interpolate(-t)), a && "container" !== b.params.controlBy || (o = (e.maxTranslate() - e.minTranslate()) / (b.maxTranslate() - b.minTranslate()), a = (t - b.minTranslate()) * o + e.minTranslate()), b.params.controlInverse && (a = e.maxTranslate() - a), e.updateProgress(a), e.setWrapperTranslate(a, !1, b), e.updateActiveIndex()
                            }
                            var o, a, r = b.params.control;
                            if (b.isArray(r))
                                for (var s = 0; s < r.length; s++) r[s] !== e && r[s] instanceof n && i(r[s]);
                            else r instanceof n && e !== r && i(r)
                        },
                        setTransition: function(t, e) {
                            function i(e) {
                                e.setWrapperTransition(t, b), 0 !== t && (e.onTransitionStart(), e.wrapper.transitionEnd(function() {
                                    a && (e.params.loop && "slide" === b.params.controlBy && e.fixLoop(), e.onTransitionEnd())
                                }))
                            }
                            var o, a = b.params.control;
                            if (b.isArray(a))
                                for (o = 0; o < a.length; o++) a[o] !== e && a[o] instanceof n && i(a[o]);
                            else a instanceof n && e !== a && i(a)
                        }
                    }, b.hashnav = {
                        init: function() {
                            if (b.params.hashnav) {
                                b.hashnav.initialized = !0;
                                var t = document.location.hash.replace("#", "");
                                if (t)
                                    for (var e = 0, n = 0, i = b.slides.length; i > n; n++) {
                                        var o = b.slides.eq(n),
                                            a = o.attr("data-hash");
                                        if (a === t && !o.hasClass(b.params.slideDuplicateClass)) {
                                            var r = o.index();
                                            b.slideTo(r, e, b.params.runCallbacksOnInit, !0)
                                        }
                                    }
                            }
                        },
                        setHash: function() {
                            b.hashnav.initialized && b.params.hashnav && (document.location.hash = b.slides.eq(b.activeIndex).attr("data-hash") || "")
                        }
                    }, b.disableKeyboardControl = function() {
                        b.params.keyboardControl = !1, e(document).off("keydown", c)
                    }, b.enableKeyboardControl = function() {
                        b.params.keyboardControl = !0, e(document).on("keydown", c)
                    }, b.mousewheel = {
                        event: !1,
                        lastScrollTime: (new window.Date).getTime()
                    }, b.params.mousewheelControl) {
                    try {
                        new window.WheelEvent("wheel"), b.mousewheel.event = "wheel"
                    } catch ($) {}
                    b.mousewheel.event || void 0 === document.onmousewheel || (b.mousewheel.event = "mousewheel"), b.mousewheel.event || (b.mousewheel.event = "DOMMouseScroll")
                }
                b.disableMousewheelControl = function() {
                    return !!b.mousewheel.event && (b.container.off(b.mousewheel.event, d), !0)
                }, b.enableMousewheelControl = function() {
                    return !!b.mousewheel.event && (b.container.on(b.mousewheel.event, d), !0)
                }, b.parallax = {
                    setTranslate: function() {
                        b.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
                            u(this, b.progress)
                        }), b.slides.each(function() {
                            var t = e(this);
                            t.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
                                var e = Math.min(Math.max(t[0].progress, -1), 1);
                                u(this, e)
                            })
                        })
                    },
                    setTransition: function(t) {
                        "undefined" == typeof t && (t = b.params.speed), b.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
                            var n = e(this),
                                i = parseInt(n.attr("data-swiper-parallax-duration"), 10) || t;
                            0 === t && (i = 0), n.transition(i)
                        })
                    }
                }, b._plugins = [];
                for (var B in b.plugins) {
                    var F = b.plugins[B](b, b.params[B]);
                    F && b._plugins.push(F)
                }
                return b.callPlugins = function(t) {
                    for (var e = 0; e < b._plugins.length; e++) t in b._plugins[e] && b._plugins[e][t](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
                }, b.emitterEventListeners = {}, b.emit = function(t) {
                    b.params[t] && b.params[t](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                    var e;
                    if (b.emitterEventListeners[t])
                        for (e = 0; e < b.emitterEventListeners[t].length; e++) b.emitterEventListeners[t][e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                    b.callPlugins && b.callPlugins(t, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
                }, b.on = function(t, e) {
                    return t = p(t), b.emitterEventListeners[t] || (b.emitterEventListeners[t] = []), b.emitterEventListeners[t].push(e), b
                }, b.off = function(t, e) {
                    var n;
                    if (t = p(t), "undefined" == typeof e) return b.emitterEventListeners[t] = [], b;
                    if (b.emitterEventListeners[t] && 0 !== b.emitterEventListeners[t].length) {
                        for (n = 0; n < b.emitterEventListeners[t].length; n++) b.emitterEventListeners[t][n] === e && b.emitterEventListeners[t].splice(n, 1);
                        return b
                    }
                }, b.once = function(t, e) {
                    t = p(t);
                    var n = function() {
                        e(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]), b.off(t, n)
                    };
                    return b.on(t, n), b
                }, b.a11y = {
                    makeFocusable: function(t) {
                        return t.attr("tabIndex", "0"), t
                    },
                    addRole: function(t, e) {
                        return t.attr("role", e), t
                    },
                    addLabel: function(t, e) {
                        return t.attr("aria-label", e), t
                    },
                    disable: function(t) {
                        return t.attr("aria-disabled", !0), t
                    },
                    enable: function(t) {
                        return t.attr("aria-disabled", !1), t
                    },
                    onEnterKey: function(t) {
                        13 === t.keyCode && (e(t.target).is(b.params.nextButton) ? (b.onClickNext(t), b.isEnd ? b.a11y.notify(b.params.lastSlideMessage) : b.a11y.notify(b.params.nextSlideMessage)) : e(t.target).is(b.params.prevButton) && (b.onClickPrev(t), b.isBeginning ? b.a11y.notify(b.params.firstSlideMessage) : b.a11y.notify(b.params.prevSlideMessage)), e(t.target).is("." + b.params.bulletClass) && e(t.target)[0].click())
                    },
                    liveRegion: e('<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>'),
                    notify: function(t) {
                        var e = b.a11y.liveRegion;
                        0 !== e.length && (e.html(""), e.html(t))
                    },
                    init: function() {
                        if (b.params.nextButton) {
                            var t = e(b.params.nextButton);
                            b.a11y.makeFocusable(t), b.a11y.addRole(t, "button"), b.a11y.addLabel(t, b.params.nextSlideMessage)
                        }
                        if (b.params.prevButton) {
                            var n = e(b.params.prevButton);
                            b.a11y.makeFocusable(n), b.a11y.addRole(n, "button"), b.a11y.addLabel(n, b.params.prevSlideMessage)
                        }
                        e(b.container).append(b.a11y.liveRegion)
                    },
                    initPagination: function() {
                        b.params.pagination && b.params.paginationClickable && b.bullets && b.bullets.length && b.bullets.each(function() {
                            var t = e(this);
                            b.a11y.makeFocusable(t), b.a11y.addRole(t, "button"), b.a11y.addLabel(t, b.params.paginationBulletMessage.replace(/{{index}}/, t.index() + 1))
                        })
                    },
                    destroy: function() {
                        b.a11y.liveRegion && b.a11y.liveRegion.length > 0 && b.a11y.liveRegion.remove()
                    }
                }, b.init = function() {
                    b.params.loop && b.createLoop(), b.updateContainerSize(), b.updateSlidesSize(), b.updatePagination(), b.params.scrollbar && b.scrollbar && (b.scrollbar.set(), b.params.scrollbarDraggable && b.scrollbar.enableDraggable()), "slide" !== b.params.effect && b.effects[b.params.effect] && (b.params.loop || b.updateProgress(), b.effects[b.params.effect].setTranslate()), b.params.loop ? b.slideTo(b.params.initialSlide + b.loopedSlides, 0, b.params.runCallbacksOnInit) : (b.slideTo(b.params.initialSlide, 0, b.params.runCallbacksOnInit), 0 === b.params.initialSlide && (b.parallax && b.params.parallax && b.parallax.setTranslate(), b.lazy && b.params.lazyLoading && (b.lazy.load(), b.lazy.initialImageLoaded = !0))), b.attachEvents(), b.params.observer && b.support.observer && b.initObservers(), b.params.preloadImages && !b.params.lazyLoading && b.preloadImages(), b.params.autoplay && b.startAutoplay(), b.params.keyboardControl && b.enableKeyboardControl && b.enableKeyboardControl(), b.params.mousewheelControl && b.enableMousewheelControl && b.enableMousewheelControl(), b.params.hashnav && b.hashnav && b.hashnav.init(), b.params.a11y && b.a11y && b.a11y.init(), b.emit("onInit", b)
                }, b.cleanupStyles = function() {
                    b.container.removeClass(b.classNames.join(" ")).removeAttr("style"), b.wrapper.removeAttr("style"), b.slides && b.slides.length && b.slides.removeClass([b.params.slideVisibleClass, b.params.slideActiveClass, b.params.slideNextClass, b.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"), b.paginationContainer && b.paginationContainer.length && b.paginationContainer.removeClass(b.params.paginationHiddenClass), b.bullets && b.bullets.length && b.bullets.removeClass(b.params.bulletActiveClass), b.params.prevButton && e(b.params.prevButton).removeClass(b.params.buttonDisabledClass), b.params.nextButton && e(b.params.nextButton).removeClass(b.params.buttonDisabledClass), b.params.scrollbar && b.scrollbar && (b.scrollbar.track && b.scrollbar.track.length && b.scrollbar.track.removeAttr("style"), b.scrollbar.drag && b.scrollbar.drag.length && b.scrollbar.drag.removeAttr("style"))
                }, b.destroy = function(t, e) {
                    b.detachEvents(), b.stopAutoplay(), b.params.scrollbar && b.scrollbar && b.params.scrollbarDraggable && b.scrollbar.disableDraggable(), b.params.loop && b.destroyLoop(), e && b.cleanupStyles(), b.disconnectObservers(), b.params.keyboardControl && b.disableKeyboardControl && b.disableKeyboardControl(), b.params.mousewheelControl && b.disableMousewheelControl && b.disableMousewheelControl(), b.params.a11y && b.a11y && b.a11y.destroy(), b.emit("onDestroy"), t !== !1 && (b = null)
                }, b.init(), b
            }
        };
        n.prototype = {
            isSafari: function() {
                var t = navigator.userAgent.toLowerCase();
                return t.indexOf("safari") >= 0 && t.indexOf("chrome") < 0 && t.indexOf("android") < 0
            }(),
            isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(navigator.userAgent),
            isArray: function(t) {
                return "[object Array]" === Object.prototype.toString.apply(t)
            },
            browser: {
                ie: window.navigator.pointerEnabled || window.navigator.msPointerEnabled,
                ieTouch: window.navigator.msPointerEnabled && window.navigator.msMaxTouchPoints > 1 || window.navigator.pointerEnabled && window.navigator.maxTouchPoints > 1
            },
            device: function() {
                var t = navigator.userAgent,
                    e = t.match(/(Android);?[\s\/]+([\d.]+)?/),
                    n = t.match(/(iPad).*OS\s([\d_]+)/),
                    i = t.match(/(iPod)(.*OS\s([\d_]+))?/),
                    o = !n && t.match(/(iPhone\sOS)\s([\d_]+)/);
                return {
                    ios: n || o || i,
                    android: e
                }
            }(),
            support: {
                touch: window.Modernizr && Modernizr.touch === !0 || function() {
                    return !!("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch)
                }(),
                transforms3d: window.Modernizr && Modernizr.csstransforms3d === !0 || function() {
                    var t = document.createElement("div").style;
                    return "webkitPerspective" in t || "MozPerspective" in t || "OPerspective" in t || "MsPerspective" in t || "perspective" in t
                }(),
                flexbox: function() {
                    for (var t = document.createElement("div").style, e = "alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "), n = 0; n < e.length; n++)
                        if (e[n] in t) return !0
                }(),
                observer: function() {
                    return "MutationObserver" in window || "WebkitMutationObserver" in window
                }()
            },
            plugins: {}
        };
        for (var i = (function() {
                var t = function(t) {
                        var e = this,
                            n = 0;
                        for (n = 0; n < t.length; n++) e[n] = t[n];
                        return e.length = t.length, this
                    },
                    e = function(e, n) {
                        var i = [],
                            o = 0;
                        if (e && !n && e instanceof t) return e;
                        if (e)
                            if ("string" == typeof e) {
                                var a, r, s = e.trim();
                                if (s.indexOf("<") >= 0 && s.indexOf(">") >= 0) {
                                    var l = "div";
                                    for (0 === s.indexOf("<li") && (l = "ul"), 0 === s.indexOf("<tr") && (l = "tbody"), (0 === s.indexOf("<td") || 0 === s.indexOf("<th")) && (l = "tr"), 0 === s.indexOf("<tbody") && (l = "table"), 0 === s.indexOf("<option") && (l = "select"), r = document.createElement(l), r.innerHTML = e, o = 0; o < r.childNodes.length; o++) i.push(r.childNodes[o])
                                } else
                                    for (a = n || "#" !== e[0] || e.match(/[ .<>:~]/) ? (n || document).querySelectorAll(e) : [document.getElementById(e.split("#")[1])], o = 0; o < a.length; o++) a[o] && i.push(a[o])
                            } else if (e.nodeType || e === window || e === document) i.push(e);
                        else if (e.length > 0 && e[0].nodeType)
                            for (o = 0; o < e.length; o++) i.push(e[o]);
                        return new t(i)
                    };
                return t.prototype = {
                    addClass: function(t) {
                        if ("undefined" == typeof t) return this;
                        for (var e = t.split(" "), n = 0; n < e.length; n++)
                            for (var i = 0; i < this.length; i++) this[i].classList.add(e[n]);
                        return this
                    },
                    removeClass: function(t) {
                        for (var e = t.split(" "), n = 0; n < e.length; n++)
                            for (var i = 0; i < this.length; i++) this[i].classList.remove(e[n]);
                        return this
                    },
                    hasClass: function(t) {
                        return !!this[0] && this[0].classList.contains(t)
                    },
                    toggleClass: function(t) {
                        for (var e = t.split(" "), n = 0; n < e.length; n++)
                            for (var i = 0; i < this.length; i++) this[i].classList.toggle(e[n]);
                        return this
                    },
                    attr: function(t, e) {
                        if (1 === arguments.length && "string" == typeof t) return this[0] ? this[0].getAttribute(t) : void 0;
                        for (var n = 0; n < this.length; n++)
                            if (2 === arguments.length) this[n].setAttribute(t, e);
                            else
                                for (var i in t) this[n][i] = t[i], this[n].setAttribute(i, t[i]);
                        return this
                    },
                    removeAttr: function(t) {
                        for (var e = 0; e < this.length; e++) this[e].removeAttribute(t);
                        return this
                    },
                    data: function(t, e) {
                        if ("undefined" != typeof e) {
                            for (var n = 0; n < this.length; n++) {
                                var i = this[n];
                                i.dom7ElementDataStorage || (i.dom7ElementDataStorage = {}), i.dom7ElementDataStorage[t] = e
                            }
                            return this
                        }
                        if (this[0]) {
                            var o = this[0].getAttribute("data-" + t);
                            return o ? o : this[0].dom7ElementDataStorage && t in this[0].dom7ElementDataStorage ? this[0].dom7ElementDataStorage[t] : void 0
                        }
                    },
                    transform: function(t) {
                        for (var e = 0; e < this.length; e++) {
                            var n = this[e].style;
                            n.webkitTransform = n.MsTransform = n.msTransform = n.MozTransform = n.OTransform = n.transform = t
                        }
                        return this
                    },
                    transition: function(t) {
                        "string" != typeof t && (t += "ms");
                        for (var e = 0; e < this.length; e++) {
                            var n = this[e].style;
                            n.webkitTransitionDuration = n.MsTransitionDuration = n.msTransitionDuration = n.MozTransitionDuration = n.OTransitionDuration = n.transitionDuration = t
                        }
                        return this
                    },
                    on: function(t, n, i, o) {
                        function a(t) {
                            var o = t.target;
                            if (e(o).is(n)) i.call(o, t);
                            else
                                for (var a = e(o).parents(), r = 0; r < a.length; r++) e(a[r]).is(n) && i.call(a[r], t)
                        }
                        var r, s, l = t.split(" ");
                        for (r = 0; r < this.length; r++)
                            if ("function" == typeof n || n === !1)
                                for ("function" == typeof n && (i = arguments[1], o = arguments[2] || !1), s = 0; s < l.length; s++) this[r].addEventListener(l[s], i, o);
                            else
                                for (s = 0; s < l.length; s++) this[r].dom7LiveListeners || (this[r].dom7LiveListeners = []), this[r].dom7LiveListeners.push({
                                    listener: i,
                                    liveListener: a
                                }), this[r].addEventListener(l[s], a, o);
                        return this
                    },
                    off: function(t, e, n, i) {
                        for (var o = t.split(" "), a = 0; a < o.length; a++)
                            for (var r = 0; r < this.length; r++)
                                if ("function" == typeof e || e === !1) "function" == typeof e && (n = arguments[1], i = arguments[2] || !1), this[r].removeEventListener(o[a], n, i);
                                else if (this[r].dom7LiveListeners)
                            for (var s = 0; s < this[r].dom7LiveListeners.length; s++) this[r].dom7LiveListeners[s].listener === n && this[r].removeEventListener(o[a], this[r].dom7LiveListeners[s].liveListener, i);
                        return this
                    },
                    once: function(t, e, n, i) {
                        function o(r) {
                            n(r), a.off(t, e, o, i)
                        }
                        var a = this;
                        "function" == typeof e && (e = !1, n = arguments[1], i = arguments[2]), a.on(t, e, o, i)
                    },
                    trigger: function(t, e) {
                        for (var n = 0; n < this.length; n++) {
                            var i;
                            try {
                                i = new window.CustomEvent(t, {
                                    detail: e,
                                    bubbles: !0,
                                    cancelable: !0
                                })
                            } catch (o) {
                                i = document.createEvent("Event"), i.initEvent(t, !0, !0), i.detail = e
                            }
                            this[n].dispatchEvent(i)
                        }
                        return this
                    },
                    transitionEnd: function(t) {
                        function e(a) {
                            if (a.target === this)
                                for (t.call(this, a), n = 0; n < i.length; n++) o.off(i[n], e)
                        }
                        var n, i = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"],
                            o = this;
                        if (t)
                            for (n = 0; n < i.length; n++) o.on(i[n], e);
                        return this
                    },
                    width: function() {
                        return this[0] === window ? window.innerWidth : this.length > 0 ? parseFloat(this.css("width")) : null
                    },
                    outerWidth: function(t) {
                        return this.length > 0 ? t ? this[0].offsetWidth + parseFloat(this.css("margin-right")) + parseFloat(this.css("margin-left")) : this[0].offsetWidth : null
                    },
                    height: function() {
                        return this[0] === window ? window.innerHeight : this.length > 0 ? parseFloat(this.css("height")) : null
                    },
                    outerHeight: function(t) {
                        return this.length > 0 ? t ? this[0].offsetHeight + parseFloat(this.css("margin-top")) + parseFloat(this.css("margin-bottom")) : this[0].offsetHeight : null
                    },
                    offset: function() {
                        if (this.length > 0) {
                            var t = this[0],
                                e = t.getBoundingClientRect(),
                                n = document.body,
                                i = t.clientTop || n.clientTop || 0,
                                o = t.clientLeft || n.clientLeft || 0,
                                a = window.pageYOffset || t.scrollTop,
                                r = window.pageXOffset || t.scrollLeft;
                            return {
                                top: e.top + a - i,
                                left: e.left + r - o
                            }
                        }
                        return null
                    },
                    css: function(t, e) {
                        var n;
                        if (1 === arguments.length) {
                            if ("string" != typeof t) {
                                for (n = 0; n < this.length; n++)
                                    for (var i in t) this[n].style[i] = t[i];
                                return this
                            }
                            if (this[0]) return window.getComputedStyle(this[0], null).getPropertyValue(t)
                        }
                        if (2 === arguments.length && "string" == typeof t) {
                            for (n = 0; n < this.length; n++) this[n].style[t] = e;
                            return this
                        }
                        return this
                    },
                    each: function(t) {
                        for (var e = 0; e < this.length; e++) t.call(this[e], e, this[e]);
                        return this
                    },
                    html: function(t) {
                        if ("undefined" == typeof t) return this[0] ? this[0].innerHTML : void 0;
                        for (var e = 0; e < this.length; e++) this[e].innerHTML = t;
                        return this
                    },
                    text: function(t) {
                        if ("undefined" == typeof t) return this[0] ? this[0].textContent.trim() : null;
                        for (var e = 0; e < this.length; e++) this[e].textContent = t;
                        return this
                    },
                    is: function(n) {
                        if (!this[0]) return !1;
                        var i, o;
                        if ("string" == typeof n) {
                            var a = this[0];
                            if (a === document) return n === document;
                            if (a === window) return n === window;
                            if (a.matches) return a.matches(n);
                            if (a.webkitMatchesSelector) return a.webkitMatchesSelector(n);
                            if (a.mozMatchesSelector) return a.mozMatchesSelector(n);
                            if (a.msMatchesSelector) return a.msMatchesSelector(n);
                            for (i = e(n), o = 0; o < i.length; o++)
                                if (i[o] === this[0]) return !0;
                            return !1
                        }
                        if (n === document) return this[0] === document;
                        if (n === window) return this[0] === window;
                        if (n.nodeType || n instanceof t) {
                            for (i = n.nodeType ? [n] : n, o = 0; o < i.length; o++)
                                if (i[o] === this[0]) return !0;
                            return !1
                        }
                        return !1
                    },
                    index: function() {
                        if (this[0]) {
                            for (var t = this[0], e = 0; null !== (t = t.previousSibling);) 1 === t.nodeType && e++;
                            return e
                        }
                    },
                    eq: function(e) {
                        if ("undefined" == typeof e) return this;
                        var n, i = this.length;
                        return e > i - 1 ? new t([]) : 0 > e ? (n = i + e, new t(0 > n ? [] : [this[n]])) : new t([this[e]])
                    },
                    append: function(e) {
                        var n, i;
                        for (n = 0; n < this.length; n++)
                            if ("string" == typeof e) {
                                var o = document.createElement("div");
                                for (o.innerHTML = e; o.firstChild;) this[n].appendChild(o.firstChild)
                            } else if (e instanceof t)
                            for (i = 0; i < e.length; i++) this[n].appendChild(e[i]);
                        else this[n].appendChild(e);
                        return this
                    },
                    prepend: function(e) {
                        var n, i;
                        for (n = 0; n < this.length; n++)
                            if ("string" == typeof e) {
                                var o = document.createElement("div");
                                for (o.innerHTML = e, i = o.childNodes.length - 1; i >= 0; i--) this[n].insertBefore(o.childNodes[i], this[n].childNodes[0])
                            } else if (e instanceof t)
                            for (i = 0; i < e.length; i++) this[n].insertBefore(e[i], this[n].childNodes[0]);
                        else this[n].insertBefore(e, this[n].childNodes[0]);
                        return this
                    },
                    insertBefore: function(t) {
                        for (var n = e(t), i = 0; i < this.length; i++)
                            if (1 === n.length) n[0].parentNode.insertBefore(this[i], n[0]);
                            else if (n.length > 1)
                            for (var o = 0; o < n.length; o++) n[o].parentNode.insertBefore(this[i].cloneNode(!0), n[o])
                    },
                    insertAfter: function(t) {
                        for (var n = e(t), i = 0; i < this.length; i++)
                            if (1 === n.length) n[0].parentNode.insertBefore(this[i], n[0].nextSibling);
                            else if (n.length > 1)
                            for (var o = 0; o < n.length; o++) n[o].parentNode.insertBefore(this[i].cloneNode(!0), n[o].nextSibling)
                    },
                    next: function(n) {
                        return new t(this.length > 0 ? n ? this[0].nextElementSibling && e(this[0].nextElementSibling).is(n) ? [this[0].nextElementSibling] : [] : this[0].nextElementSibling ? [this[0].nextElementSibling] : [] : [])
                    },
                    nextAll: function(n) {
                        var i = [],
                            o = this[0];
                        if (!o) return new t([]);
                        for (; o.nextElementSibling;) {
                            var a = o.nextElementSibling;
                            n ? e(a).is(n) && i.push(a) : i.push(a), o = a
                        }
                        return new t(i)
                    },
                    prev: function(n) {
                        return new t(this.length > 0 ? n ? this[0].previousElementSibling && e(this[0].previousElementSibling).is(n) ? [this[0].previousElementSibling] : [] : this[0].previousElementSibling ? [this[0].previousElementSibling] : [] : [])
                    },
                    prevAll: function(n) {
                        var i = [],
                            o = this[0];
                        if (!o) return new t([]);
                        for (; o.previousElementSibling;) {
                            var a = o.previousElementSibling;
                            n ? e(a).is(n) && i.push(a) : i.push(a), o = a
                        }
                        return new t(i)
                    },
                    parent: function(t) {
                        for (var n = [], i = 0; i < this.length; i++) t ? e(this[i].parentNode).is(t) && n.push(this[i].parentNode) : n.push(this[i].parentNode);
                        return e(e.unique(n))
                    },
                    parents: function(t) {
                        for (var n = [], i = 0; i < this.length; i++)
                            for (var o = this[i].parentNode; o;) t ? e(o).is(t) && n.push(o) : n.push(o), o = o.parentNode;
                        return e(e.unique(n))
                    },
                    find: function(e) {
                        for (var n = [], i = 0; i < this.length; i++)
                            for (var o = this[i].querySelectorAll(e), a = 0; a < o.length; a++) n.push(o[a]);
                        return new t(n)
                    },
                    children: function(n) {
                        for (var i = [], o = 0; o < this.length; o++)
                            for (var a = this[o].childNodes, r = 0; r < a.length; r++) n ? 1 === a[r].nodeType && e(a[r]).is(n) && i.push(a[r]) : 1 === a[r].nodeType && i.push(a[r]);
                        return new t(e.unique(i))
                    },
                    remove: function() {
                        for (var t = 0; t < this.length; t++) this[t].parentNode && this[t].parentNode.removeChild(this[t]);
                        return this
                    },
                    add: function() {
                        var t, n, i = this;
                        for (t = 0; t < arguments.length; t++) {
                            var o = e(arguments[t]);
                            for (n = 0; n < o.length; n++) i[i.length] = o[n], i.length++
                        }
                        return i
                    }
                }, e.fn = t.prototype, e.unique = function(t) {
                    for (var e = [], n = 0; n < t.length; n++) - 1 === e.indexOf(t[n]) && e.push(t[n]);
                    return e
                }, e
            }()), o = ["jQuery", "Zepto", "Dom7"], a = 0; a < o.length; a++) window[o[a]] && t(window[o[a]]);
        var r;
        r = "undefined" == typeof i ? window.Dom7 || window.Zepto || window.jQuery : i, r && ("transitionEnd" in r.fn || (r.fn.transitionEnd = function(t) {
            function e(a) {
                if (a.target === this)
                    for (t.call(this, a), n = 0; n < i.length; n++) o.off(i[n], e)
            }
            var n, i = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"],
                o = this;
            if (t)
                for (n = 0; n < i.length; n++) o.on(i[n], e);
            return this
        }), "transform" in r.fn || (r.fn.transform = function(t) {
            for (var e = 0; e < this.length; e++) {
                var n = this[e].style;
                n.webkitTransform = n.MsTransform = n.msTransform = n.MozTransform = n.OTransform = n.transform = t
            }
            return this
        }), "transition" in r.fn || (r.fn.transition = function(t) {
            "string" != typeof t && (t += "ms");
            for (var e = 0; e < this.length; e++) {
                var n = this[e].style;
                n.webkitTransitionDuration = n.MsTransitionDuration = n.msTransitionDuration = n.MozTransitionDuration = n.OTransitionDuration = n.transitionDuration = t
            }
            return this
        })), window.Swiper = n
    }(), "undefined" != typeof module ? module.exports = window.Swiper : "function" == typeof define && define.amd && define([], function() {
        "use strict";
        return window.Swiper
    });
/* ========================================================================
  Config