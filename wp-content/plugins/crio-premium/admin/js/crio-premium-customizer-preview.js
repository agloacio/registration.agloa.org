!function(t){var n={};function o(e){if(n[e])return n[e].exports;var r=n[e]={i:e,l:!1,exports:{}};return t[e].call(r.exports,r,r.exports,o),r.l=!0,r.exports}o.m=t,o.c=n,o.d=function(t,n,e){o.o(t,n)||Object.defineProperty(t,n,{enumerable:!0,get:e})},o.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},o.t=function(t,n){if(1&n&&(t=o(t)),8&n)return t;if(4&n&&"object"==typeof t&&t&&t.__esModule)return t;var e=Object.create(null);if(o.r(e),Object.defineProperty(e,"default",{enumerable:!0,value:t}),2&n&&"string"!=typeof t)for(var r in t)o.d(e,r,function(n){return t[n]}.bind(null,r));return e},o.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return o.d(n,"a",n),n},o.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},o.p="",o(o.s=2)}({2:function(t,n){!function(t){"use strict";var n=wp.customize,o=parent.wp.customize,e=window.bgtfwButtonClasses||[];["bgtfw_comments_header_background","bgtfw_comments_body_background","bgtfw_comments_footer_background"].forEach((function(e){n(e,(function(n){n.bind((function(n){var r=n.split(":")[0],c=r,a=t(o.control(e).params.choices.selector);"color-neutral"!==r&&(r=r.replace("-","")),a.each((function(n,o){t(o).removeClass((function(t,n){var o=n.match(/(^|\s)color(\d+|-)\S+background/g)||[],e=n.match(/(^|\s)color(\d+|-)\S+text-contrast/g)||[];return o.concat(e).join(" ")})),t(o).addClass(r+"-background "+c+"-text-contrast")}))}))}))})),["bgtfw_comments_header_links","bgtfw_comments_body_links","bgtfw_comments_footer_links"].forEach((function(e){n(e,(function(n){n.bind((function(n){var r=n.split(":")[0];t(o.control(e).params.choices.selector).each((function(n,o){t(o).removeClass((function(t,n){return(n.match(/(^|\s)color-\S+-link-color/g)||[]).join(" ")})),t(o).addClass(r+"-link-color")}))}))}))})),n("bgtfw_comment_reply_button_class",(function(n){n.bind((function(n){t(".comments ol.comment-list .comment .comment-body .panel-footer .comment-reply-link").each((function(o,r){t(r).removeClass((function(t,n){var o=n.match(/(^|\s)btn?\S+/g)||[],e=n.match(/(^|\s)button+\S+/g)||[];return o.concat(e).join(" ")})),t(r).addClass(n),e[n]&&t(r).addClass(e[n])}))}))}))}(jQuery)}});