(function(e){function n(n){for(var r,o,i=n[0],c=n[1],l=n[2],s=0,p=[];s<i.length;s++)o=i[s],Object.prototype.hasOwnProperty.call(a,o)&&a[o]&&p.push(a[o][0]),a[o]=0;for(r in c)Object.prototype.hasOwnProperty.call(c,r)&&(e[r]=c[r]);f&&f(n);while(p.length)p.shift()();return u.push.apply(u,l||[]),t()}function t(){for(var e,n=0;n<u.length;n++){for(var t=u[n],r=!0,o=1;o<t.length;o++){var i=t[o];0!==a[i]&&(r=!1)}r&&(u.splice(n--,1),e=c(c.s=t[0]))}return e}var r={},o={3:0},a={3:0},u=[];function i(e){return c.p+"js/"+({}[e]||e)+"."+{1:"7158b277",2:"3908ada4",4:"399f991f",5:"a94311e9",6:"04ca3687"}[e]+".js"}function c(n){if(r[n])return r[n].exports;var t=r[n]={i:n,l:!1,exports:{}};return e[n].call(t.exports,t,t.exports,c),t.l=!0,t.exports}c.e=function(e){var n=[],t={2:1,4:1};o[e]?n.push(o[e]):0!==o[e]&&t[e]&&n.push(o[e]=new Promise((function(n,t){for(var r="css/"+({}[e]||e)+"."+{1:"31d6cfe0",2:"4826b31c",4:"face47d1",5:"31d6cfe0",6:"31d6cfe0"}[e]+".css",a=c.p+r,u=document.getElementsByTagName("link"),i=0;i<u.length;i++){var l=u[i],s=l.getAttribute("data-href")||l.getAttribute("href");if("stylesheet"===l.rel&&(s===r||s===a))return n()}var p=document.getElementsByTagName("style");for(i=0;i<p.length;i++){l=p[i],s=l.getAttribute("data-href");if(s===r||s===a)return n()}var f=document.createElement("link");f.rel="stylesheet",f.type="text/css",f.onload=n,f.onerror=function(n){var r=n&&n.target&&n.target.src||a,u=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");u.code="CSS_CHUNK_LOAD_FAILED",u.request=r,delete o[e],f.parentNode.removeChild(f),t(u)},f.href=a;var d=document.getElementsByTagName("head")[0];d.appendChild(f)})).then((function(){o[e]=0})));var r=a[e];if(0!==r)if(r)n.push(r[2]);else{var u=new Promise((function(n,t){r=a[e]=[n,t]}));n.push(r[2]=u);var l,s=document.createElement("script");s.charset="utf-8",s.timeout=120,c.nc&&s.setAttribute("nonce",c.nc),s.src=i(e);var p=new Error;l=function(n){s.onerror=s.onload=null,clearTimeout(f);var t=a[e];if(0!==t){if(t){var r=n&&("load"===n.type?"missing":n.type),o=n&&n.target&&n.target.src;p.message="Loading chunk "+e+" failed.\n("+r+": "+o+")",p.name="ChunkLoadError",p.type=r,p.request=o,t[1](p)}a[e]=void 0}};var f=setTimeout((function(){l({type:"timeout",target:s})}),12e4);s.onerror=s.onload=l,document.head.appendChild(s)}return Promise.all(n)},c.m=e,c.c=r,c.d=function(e,n,t){c.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:t})},c.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},c.t=function(e,n){if(1&n&&(e=c(e)),8&n)return e;if(4&n&&"object"===typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(c.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var r in e)c.d(t,r,function(n){return e[n]}.bind(null,r));return t},c.n=function(e){var n=e&&e.__esModule?function(){return e["default"]}:function(){return e};return c.d(n,"a",n),n},c.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},c.p="/klips/",c.oe=function(e){throw console.error(e),e};var l=window["webpackJsonp"]=window["webpackJsonp"]||[],s=l.push.bind(l);l.push=n,l=l.slice();for(var p=0;p<l.length;p++)n(l[p]);var f=s;u.push([0,0]),t()})({0:function(e,n,t){e.exports=t("2f39")},"2f39":function(e,n,t){"use strict";t.r(n);t("ac1f"),t("5319"),t("96cf");var r=t("c973"),o=t.n(r),a=(t("5c7d"),t("7d6e"),t("e54f"),t("0ca9"),t("5b0d"),t("2b0e")),u=t("1f91"),i=t("42d2"),c=t("b05d"),l=t("2a19"),s=t("436b"),p=t("a639");a["a"].use(c["a"],{config:{brand:{primary:"#0166B3",secondary:"#26A69A",accent:"#9C27B0",dark:"#1d1d1d",positive:"#21BA45",negative:"#C10015",info:"#31CCEC",warning:"#F2C037"}},lang:u["a"],iconSet:i["a"],plugins:{Notify:l["a"],Dialog:s["a"],SessionStorage:p["a"]}});var f=function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("div",{attrs:{id:"q-app"}},[t("router-view")],1)},d=[],h={name:"App"},b=h,m=t("2877"),v=Object(m["a"])(b,f,d,!1,null,null,null),g=v.exports,y=t("2f62");a["a"].use(y["a"]);var w=function(){var e=new y["a"].Store({modules:{},strict:!1});return e},P=t("8c4f"),k=(t("d3b7"),t("e6cf"),[{path:"/chart",component:function(){return Promise.all([t.e(0),t.e(1)]).then(t.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([t.e(0),t.e(5)]).then(t.bind(null,"af1b"))}}]},{path:"/khp",component:function(){return Promise.all([t.e(0),t.e(1)]).then(t.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([t.e(0),t.e(4)]).then(t.bind(null,"3bea"))}}]},{path:"/",component:function(){return Promise.all([t.e(0),t.e(1)]).then(t.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([t.e(0),t.e(2)]).then(t.bind(null,"8b24"))}}]},{path:"/smartklips.html",component:function(){return Promise.all([t.e(0),t.e(1)]).then(t.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([t.e(0),t.e(2)]).then(t.bind(null,"8b24"))}}]},{path:"/webstata.html",component:function(){return Promise.all([t.e(0),t.e(1)]).then(t.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([t.e(0),t.e(2)]).then(t.bind(null,"8b24"))}}]},{path:"/smartklips.do",component:function(){return Promise.all([t.e(0),t.e(1)]).then(t.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([t.e(0),t.e(2)]).then(t.bind(null,"8b24"))}}]},{path:"/smartklips",component:function(){return Promise.all([t.e(0),t.e(1)]).then(t.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([t.e(0),t.e(2)]).then(t.bind(null,"8b24"))}}]},{path:"*",component:function(){return Promise.all([t.e(0),t.e(6)]).then(t.bind(null,"e51e"))}}]),x=k;a["a"].use(P["a"]);var C=function(){var e=new P["a"]({scrollBehavior:function(){return{x:0,y:0}},routes:x,mode:"history",base:"/klips/"});return e},O=function(){return j.apply(this,arguments)};function j(){return j=o()(regeneratorRuntime.mark((function e(){var n,t,r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if("function"!==typeof w){e.next=6;break}return e.next=3,w({Vue:a["a"]});case 3:e.t0=e.sent,e.next=7;break;case 6:e.t0=w;case 7:if(n=e.t0,"function"!==typeof C){e.next=14;break}return e.next=11,C({Vue:a["a"],store:n});case 11:e.t1=e.sent,e.next=15;break;case 14:e.t1=C;case 15:return t=e.t1,n.$router=t,r={router:t,store:n,render:function(e){return e(g)}},r.el="#q-app",e.abrupt("return",{app:r,store:n,router:t});case 20:case"end":return e.stop()}}),e)}))),j.apply(this,arguments)}var S=t("bc3a"),E=t.n(S);a["a"].prototype.$axios=E.a;var _=t("2ef0"),A=t.n(_);a["a"].use(A.a);var B="/klips/",T=/\/\//,N=function(e){return(B+e).replace(T,"/")};function L(){return q.apply(this,arguments)}function q(){return q=o()(regeneratorRuntime.mark((function e(){var n,t,r,o,u,i,c,l,s;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,O();case 2:n=e.sent,t=n.app,r=n.store,o=n.router,u=!1,i=function(e){u=!0;var n=Object(e)===e?N(o.resolve(e).route.fullPath):e;window.location.href=n},c=window.location.href.replace(window.location.origin,""),l=[void 0,void 0],s=0;case 11:if(!(!1===u&&s<l.length)){e.next=29;break}if("function"===typeof l[s]){e.next=14;break}return e.abrupt("continue",26);case 14:return e.prev=14,e.next=17,l[s]({app:t,router:o,store:r,Vue:a["a"],ssrContext:null,redirect:i,urlPath:c,publicPath:B});case 17:e.next=26;break;case 19:if(e.prev=19,e.t0=e["catch"](14),!e.t0||!e.t0.url){e.next=24;break}return window.location.href=e.t0.url,e.abrupt("return");case 24:return console.error("[Quasar] boot error:",e.t0),e.abrupt("return");case 26:s++,e.next=11;break;case 29:if(!0!==u){e.next=31;break}return e.abrupt("return");case 31:new a["a"](t);case 32:case"end":return e.stop()}}),e,null,[[14,19]])}))),q.apply(this,arguments)}L()},"5b0d":function(e,n,t){}});