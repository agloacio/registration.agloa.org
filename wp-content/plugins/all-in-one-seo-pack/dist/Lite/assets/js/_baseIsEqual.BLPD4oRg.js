import{M as b,S,w as m,U as x,c as D,x as E,d as F,b as M,h as I}from"./helpers.yjC6K_2A.js";import{c as $,g as G}from"./_getTag.KnvRqur7.js";var q="__lodash_hash_undefined__";function K(n){return this.__data__.set(n,q),this}function J(n){return this.__data__.has(n)}function L(n){var e=-1,a=n==null?0:n.length;for(this.__data__=new b;++e<a;)this.add(n[e])}L.prototype.add=L.prototype.push=K;L.prototype.has=J;function Q(n,e){for(var a=-1,f=n==null?0:n.length;++a<f;)if(e(n[a],a,n))return!0;return!1}function X(n,e){return n.has(e)}var Y=1,Z=2;function H(n,e,a,f,u,r){var s=a&Y,l=n.length,t=e.length;if(l!=t&&!(s&&t>l))return!1;var g=r.get(n),d=r.get(e);if(g&&d)return g==e&&d==n;var _=-1,i=!0,v=a&Z?new L:void 0;for(r.set(n,e),r.set(e,n);++_<l;){var p=n[_],A=e[_];if(f)var y=s?f(A,p,_,e,n,r):f(p,A,_,n,e,r);if(y!==void 0){if(y)continue;i=!1;break}if(v){if(!Q(e,function(T,O){if(!X(v,O)&&(p===T||u(p,T,a,f,r)))return v.push(O)})){i=!1;break}}else if(!(p===A||u(p,A,a,f,r))){i=!1;break}}return r.delete(n),r.delete(e),i}function W(n){var e=-1,a=Array(n.size);return n.forEach(function(f,u){a[++e]=[u,f]}),a}function h(n){var e=-1,a=Array(n.size);return n.forEach(function(f){a[++e]=f}),a}var z=1,j=2,V="[object Boolean]",k="[object Date]",nn="[object Error]",en="[object Map]",rn="[object Number]",an="[object RegExp]",fn="[object Set]",sn="[object String]",un="[object Symbol]",tn="[object ArrayBuffer]",ln="[object DataView]",U=S?S.prototype:void 0,o=U?U.valueOf:void 0;function gn(n,e,a,f,u,r,s){switch(a){case ln:if(n.byteLength!=e.byteLength||n.byteOffset!=e.byteOffset)return!1;n=n.buffer,e=e.buffer;case tn:return!(n.byteLength!=e.byteLength||!r(new x(n),new x(e)));case V:case k:case rn:return m(+n,+e);case nn:return n.name==e.name&&n.message==e.message;case an:case sn:return n==e+"";case en:var l=W;case fn:var t=f&z;if(l||(l=h),n.size!=e.size&&!t)return!1;var g=s.get(n);if(g)return g==e;f|=j,s.set(n,e);var d=H(l(n),l(e),f,u,r,s);return s.delete(n),d;case un:if(o)return o.call(n)==o.call(e)}return!1}var _n=1,pn=Object.prototype,An=pn.hasOwnProperty;function dn(n,e,a,f,u,r){var s=a&_n,l=$(n),t=l.length,g=$(e),d=g.length;if(t!=d&&!s)return!1;for(var _=t;_--;){var i=l[_];if(!(s?i in e:An.call(e,i)))return!1}var v=r.get(n),p=r.get(e);if(v&&p)return v==e&&p==n;var A=!0;r.set(n,e),r.set(e,n);for(var y=s;++_<t;){i=l[_];var T=n[i],O=e[i];if(f)var R=s?f(O,T,i,e,n,r):f(T,O,i,n,e,r);if(!(R===void 0?T===O||u(T,O,a,f,r):R)){A=!1;break}y||(y=i=="constructor")}if(A&&!y){var w=n.constructor,P=e.constructor;w!=P&&"constructor"in n&&"constructor"in e&&!(typeof w=="function"&&w instanceof w&&typeof P=="function"&&P instanceof P)&&(A=!1)}return r.delete(n),r.delete(e),A}var vn=1,B="[object Arguments]",C="[object Array]",c="[object Object]",yn=Object.prototype,N=yn.hasOwnProperty;function Tn(n,e,a,f,u,r){var s=M(n),l=M(e),t=s?C:G(n),g=l?C:G(e);t=t==B?c:t,g=g==B?c:g;var d=t==c,_=g==c,i=t==g;if(i&&D(n)){if(!D(e))return!1;s=!0,d=!1}if(i&&!d)return r||(r=new E),s||F(n)?H(n,e,a,f,u,r):gn(n,e,t,a,f,u,r);if(!(a&vn)){var v=d&&N.call(n,"__wrapped__"),p=_&&N.call(e,"__wrapped__");if(v||p){var A=v?n.value():n,y=p?e.value():e;return r||(r=new E),u(A,y,a,f,r)}}return i?(r||(r=new E),dn(n,e,a,f,u,r)):!1}function On(n,e,a,f,u){return n===e?!0:n==null||e==null||!I(n)&&!I(e)?n!==n&&e!==e:Tn(n,e,a,f,On,u)}export{L as S,On as b,X as c,h as s};
