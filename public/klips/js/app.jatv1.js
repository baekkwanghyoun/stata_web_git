(function(e){function t(t){for(var r,o,i=t[0],c=t[1],l=t[2],s=0,p=[];s<i.length;s++)o=i[s],Object.prototype.hasOwnProperty.call(a,o)&&a[o]&&p.push(a[o][0]),a[o]=0;for(r in c)Object.prototype.hasOwnProperty.call(c,r)&&(e[r]=c[r]);f&&f(t);while(p.length)p.shift()();return u.push.apply(u,l||[]),n()}function n(){for(var e,t=0;t<u.length;t++){for(var n=u[t],r=!0,o=1;o<n.length;o++){var i=n[o];0!==a[i]&&(r=!1)}r&&(u.splice(t--,1),e=c(c.s=n[0]))}return e}var r={},o={3:0},a={3:0},u=[];function i(e){return c.p+"js/"+({}[e]||e)+"."+{1:"5d4bd551",2:"a0902ee5",4:"91130bf0"}[e]+".js"}function c(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,c),n.l=!0,n.exports}c.e=function(e){var t=[],n={1:1};o[e]?t.push(o[e]):0!==o[e]&&n[e]&&t.push(o[e]=new Promise((function(t,n){for(var r="css/"+({}[e]||e)+"."+{1:"face47d1",2:"31d6cfe0",4:"31d6cfe0"}[e]+".css",a=c.p+r,u=document.getElementsByTagName("link"),i=0;i<u.length;i++){var l=u[i],s=l.getAttribute("data-href")||l.getAttribute("href");if("stylesheet"===l.rel&&(s===r||s===a))return t()}var p=document.getElementsByTagName("style");for(i=0;i<p.length;i++){l=p[i],s=l.getAttribute("data-href");if(s===r||s===a)return t()}var f=document.createElement("link");f.rel="stylesheet",f.type="text/css",f.onload=t,f.onerror=function(t){var r=t&&t.target&&t.target.src||a,u=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");u.code="CSS_CHUNK_LOAD_FAILED",u.request=r,delete o[e],f.parentNode.removeChild(f),n(u)},f.href=a;var d=document.getElementsByTagName("head")[0];d.appendChild(f)})).then((function(){o[e]=0})));var r=a[e];if(0!==r)if(r)t.push(r[2]);else{var u=new Promise((function(t,n){r=a[e]=[t,n]}));t.push(r[2]=u);var l,s=document.createElement("script");s.charset="utf-8",s.timeout=120,c.nc&&s.setAttribute("nonce",c.nc),s.src=i(e);var p=new Error;l=function(t){s.onerror=s.onload=null,clearTimeout(f);var n=a[e];if(0!==n){if(n){var r=t&&("load"===t.type?"missing":t.type),o=t&&t.target&&t.target.src;p.message="Loading chunk "+e+" failed.\n("+r+": "+o+")",p.name="ChunkLoadError",p.type=r,p.request=o,n[1](p)}a[e]=void 0}};var f=setTimeout((function(){l({type:"timeout",target:s})}),12e4);s.onerror=s.onload=l,document.head.appendChild(s)}return Promise.all(t)},c.m=e,c.c=r,c.d=function(e,t,n){c.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},c.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},c.t=function(e,t){if(1&t&&(e=c(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(c.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)c.d(n,r,function(t){return e[t]}.bind(null,r));return n},c.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return c.d(t,"a",t),t},c.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},c.p="/klips/",c.oe=function(e){throw console.error(e),e};var l=window["webpackJsonp"]=window["webpackJsonp"]||[],s=l.push.bind(l);l.push=t,l=l.slice();for(var p=0;p<l.length;p++)t(l[p]);var f=s;u.push([0,0]),n()})({0:function(e,t,n){e.exports=n("2f39")},"2f39":function(e,t,n){"use strict";n.r(t);n("ac1f"),n("5319"),n("96cf");var r=n("c973"),o=n.n(r),a=(n("5c7d"),n("7d6e"),n("e54f"),n("0ca9"),n("5b0d"),n("2b0e")),u=n("1f91"),i=n("42d2"),c=n("b05d"),l=n("2a19"),s=n("436b"),p=n("a639");a["a"].use(c["a"],{config:{brand:{primary:"#00977B",secondary:"#26A69A",accent:"#9C27B0",dark:"#1d1d1d",positive:"#21BA45",negative:"#C10015",info:"#31CCEC",warning:"#F2C037"}},lang:u["a"],iconSet:i["a"],plugins:{Notify:l["a"],Dialog:s["a"],SessionStorage:p["a"]}});var f=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"q-app"}},[n("router-view")],1)},d=[],h={name:"App"},b=h,m=n("2877"),v=Object(m["a"])(b,f,d,!1,null,null,null),g=v.exports,y=n("2f62");a["a"].use(y["a"]);var w=function(){var e=new y["a"].Store({modules:{},strict:!1});return e},x=n("8c4f"),k=(n("d3b7"),n("e6cf"),[{path:"/",component:function(){return Promise.all([n.e(0),n.e(2)]).then(n.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"8b24"))}}]},{path:"/smartklips.html",component:function(){return Promise.all([n.e(0),n.e(2)]).then(n.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"8b24"))}}]},{path:"/smartklips.do",component:function(){return Promise.all([n.e(0),n.e(2)]).then(n.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"8b24"))}}]},{path:"/smartklips",component:function(){return Promise.all([n.e(0),n.e(2)]).then(n.bind(null,"713b"))},children:[{path:"",component:function(){return Promise.all([n.e(0),n.e(1)]).then(n.bind(null,"8b24"))}}]},{path:"*",component:function(){return Promise.all([n.e(0),n.e(4)]).then(n.bind(null,"e51e"))}}]),P=k;a["a"].use(x["a"]);var O=function(){var e=new x["a"]({scrollBehavior:function(){return{x:0,y:0}},routes:P,mode:"history",base:"/klips/"});return e},C=function(){return j.apply(this,arguments)};function j(){return j=o()(regeneratorRuntime.mark((function e(){var t,n,r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if("function"!==typeof w){e.next=6;break}return e.next=3,w({Vue:a["a"]});case 3:e.t0=e.sent,e.next=7;break;case 6:e.t0=w;case 7:if(t=e.t0,"function"!==typeof O){e.next=14;break}return e.next=11,O({Vue:a["a"],store:t});case 11:e.t1=e.sent,e.next=15;break;case 14:e.t1=O;case 15:return n=e.t1,t.$router=n,r={router:n,store:t,render:function(e){return e(g)}},r.el="#q-app",e.abrupt("return",{app:r,store:t,router:n});case 20:case"end":return e.stop()}}),e)}))),j.apply(this,arguments)}var S=n("bc3a"),E=n.n(S);a["a"].prototype.$axios=E.a;var _=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"positive";l["a"].create({message:e,color:t,position:"top-right",progress:!0,icon:"announcement",classes:"glossy"})},A=_,B=function(e){var t=e.Vue;t.prototype.$msg=A},T=n("c01e"),N=function(e){var t=e.Vue;t.prototype.$alert=T["a"]},L=n("2ef0"),V=n.n(L);a["a"].use(V.a);var $="/klips/",q=/\/\//,M=function(e){return($+e).replace(q,"/")};function R(){return D.apply(this,arguments)}function D(){return D=o()(regeneratorRuntime.mark((function e(){var t,n,r,o,u,i,c,l,s;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,C();case 2:t=e.sent,n=t.app,r=t.store,o=t.router,u=!1,i=function(e){u=!0;var t=Object(e)===e?M(o.resolve(e).route.fullPath):e;window.location.href=t},c=window.location.href.replace(window.location.origin,""),l=[void 0,B,N,void 0],s=0;case 11:if(!(!1===u&&s<l.length)){e.next=29;break}if("function"===typeof l[s]){e.next=14;break}return e.abrupt("continue",26);case 14:return e.prev=14,e.next=17,l[s]({app:n,router:o,store:r,Vue:a["a"],ssrContext:null,redirect:i,urlPath:c,publicPath:$});case 17:e.next=26;break;case 19:if(e.prev=19,e.t0=e["catch"](14),!e.t0||!e.t0.url){e.next=24;break}return window.location.href=e.t0.url,e.abrupt("return");case 24:return console.error("[Quasar] boot error:",e.t0),e.abrupt("return");case 26:s++,e.next=11;break;case 29:if(!0!==u){e.next=31;break}return e.abrupt("return");case 31:new a["a"](n);case 32:case"end":return e.stop()}}),e,null,[[14,19]])}))),D.apply(this,arguments)}R()},"5b0d":function(e,t,n){},c01e:function(e,t,n){"use strict";var r=n("3d20"),o=n.n(r),a=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"success";o.a.fire({title:t,text:e,icon:t,confirmButtonText:"OK"})};t["a"]=a}});