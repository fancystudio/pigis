/**
 * fullPage 2.0.7
 * https://github.com/alvarotrigo/fullPage.js
 * MIT licensed
 *
 * Copyright (C) 2013 alvarotrigo.com - A project by Alvaro Trigo
 */

(function(a){a.fn.fullpage=function(c){function $(b){var e=b.originalEvent;c.autoScrolling&&b.preventDefault();if(!L(b.target)&&(b=a(".section.active"),!t&&!s))if(e=M(e),w=e.y,A=e.x,b.find(".slides").length&&Math.abs(B-A)>Math.abs(x-w))Math.abs(B-A)>a(window).width()/100*c.touchSensitivity&&(B>A?a.fn.fullpage.moveSlideRight():a.fn.fullpage.moveSlideLeft());else if(c.autoScrolling&&(e=b.find(".slides").length?b.find(".slide.active").find(".scrollable"):b.find(".scrollable"),Math.abs(x-w)>a(window).height()/
100*c.touchSensitivity))if(x>w)if(0<e.length)if(C("bottom",e))a.fn.fullpage.moveSectionDown();else return!0;else a.fn.fullpage.moveSectionDown();else if(w>x)if(0<e.length)if(C("top",e))a.fn.fullpage.moveSectionUp();else return!0;else a.fn.fullpage.moveSectionUp()}function L(b,e){e=e||0;var d=a(b).parent();return e<c.normalScrollElementTouchThreshold&&d.is(c.normalScrollElements)?!0:e==c.normalScrollElementTouchThreshold?!1:L(d,++e)}function aa(b){b=M(b.originalEvent);x=b.y;B=b.x}function n(b){if(c.autoScrolling){b=
window.event||b;b=Math.max(-1,Math.min(1,b.wheelDelta||-b.deltaY||-b.detail));var e;e=a(".section.active");if(!t)if(e=e.find(".slides").length?e.find(".slide.active").find(".scrollable"):e.find(".scrollable"),0>b)if(0<e.length)if(C("bottom",e))a.fn.fullpage.moveSectionDown();else return!0;else a.fn.fullpage.moveSectionDown();else if(0<e.length)if(C("top",e))a.fn.fullpage.moveSectionUp();else return!0;else a.fn.fullpage.moveSectionUp();return!1}}function N(b){var e=a(".section.active").find(".slides");
if(e.length&&!s){var d=e.find(".slide.active"),f=null,f="prev"===b?d.prev(".slide"):d.next(".slide");if(!f.length){if(!c.loopHorizontal)return;f="prev"===b?d.siblings(":last"):d.siblings(":first")}s=!0;p(e,f)}}function h(b,e,d){var f={},g=b.position();if("undefined"!==typeof g){var g=g.top,l=H(b),q=b.data("anchor"),y=b.index(".section"),k=b.find(".slide.active"),r=a(".section.active"),s=r.index(".section")+1,E=D;if(k.length)var n=k.data("anchor"),p=k.index();if(c.autoScrolling&&c.continuousVertical&&
"undefined"!==typeof d&&(!d&&"up"==l||d&&"down"==l)){d?a(".section.active").before(r.nextAll(".section")):a(".section.active").after(r.prevAll(".section").get().reverse());z(a(".section.active").position().top);var h=r,g=b.position(),g=g.top,l=H(b)}b.addClass("active").siblings().removeClass("active");t=!0;"undefined"!==typeof q&&O(p,n,q);c.autoScrolling?(f.top=-g,b=u.selector):(f.scrollTop=g,b="html, body");var m=function(){h&&h.length&&(d?a(".section:first").before(h):a(".section:last").after(h),
z(a(".section.active").position().top))};c.css3&&c.autoScrolling?(a.isFunction(c.onLeave)&&!E&&c.onLeave.call(this,s,y+1,l),P("translate3d(0px, -"+g+"px, 0px)",!0),setTimeout(function(){m();a.isFunction(c.afterLoad)&&!E&&c.afterLoad.call(this,q,y+1);setTimeout(function(){t=!1;a.isFunction(e)&&e.call(this)},Q)},c.scrollingSpeed)):(a.isFunction(c.onLeave)&&!E&&c.onLeave.call(this,s,y+1,l),a(b).animate(f,c.scrollingSpeed,c.easing,function(){m();a.isFunction(c.afterLoad)&&!E&&c.afterLoad.call(this,q,
y+1);setTimeout(function(){t=!1;a.isFunction(e)&&e.call(this)},Q)}));v=q;c.autoScrolling&&(R(q),S(q,y))}}function p(b,e){var d=e.position(),f=b.find(".slidesContainer").parent(),g=e.index(),l=b.closest(".section"),q=l.index(".section"),h=l.data("anchor"),k=l.find(".fullPage-slidesNav"),r=e.data("anchor"),m=D;if(c.onSlideLeave){var n=l.find(".slide.active").index(),p;p=n==g?"none":n>g?"left":"right";m||a.isFunction(c.onSlideLeave)&&c.onSlideLeave.call(this,h,q+1,n,p)}e.addClass("active").siblings().removeClass("active");
"undefined"===typeof r&&(r=g);l.hasClass("active")&&(c.loopHorizontal||(l.find(".controlArrow.prev").toggle(0!=g),l.find(".controlArrow.next").toggle(!e.is(":last-child"))),O(g,r,h));c.css3?(d="translate3d(-"+d.left+"px, 0px, 0px)",b.find(".slidesContainer").toggleClass("easing",0<c.scrollingSpeed).css(T(d)),setTimeout(function(){m||a.isFunction(c.afterSlideLoad)&&c.afterSlideLoad.call(this,h,q+1,r,g);s=!1},c.scrollingSpeed,c.easing)):f.animate({scrollLeft:d.left},c.scrollingSpeed,c.easing,function(){m||
a.isFunction(c.afterSlideLoad)&&c.afterSlideLoad.call(this,h,q+1,r,g);s=!1});k.find(".active").removeClass("active");k.find("li").eq(g).find("a").addClass("active")}function U(){D=!0;var b=a(window).width();k=a(window).height();c.resize&&ba(k,b);a(".section").each(function(){parseInt(a(this).css("padding-bottom"));parseInt(a(this).css("padding-top"));c.verticalCentered&&a(this).find(".tableCell").css("height",V(a(this))+"px");a(this).css("height",k+"px");if(c.scrollOverflow){var b=a(this).find(".slide");
b.length?b.each(function(){F(a(this))}):F(a(this))}b=a(this).find(".slides");b.length&&p(b,b.find(".slide.active"))});a(".section.active").position();b=a(".section.active");b.index(".section")&&h(b);D=!1;a.isFunction(c.afterResize)&&c.afterResize.call(this)}function ba(b,c){var d=825,f=b;825>b||900>c?(900>c&&(f=c,d=900),d=(100*f/d).toFixed(2),a("body").css("font-size",d+"%")):a("body").css("font-size","100%")}function S(b,e){c.navigation&&(a("#fullPage-nav").find(".active").removeClass("active"),
b?a("#fullPage-nav").find('a[href="#'+b+'"]').addClass("active"):a("#fullPage-nav").find("li").eq(e).find("a").addClass("active"))}function R(b){c.menu&&(a(c.menu).find(".active").removeClass("active"),a(c.menu).find('[data-menuanchor="'+b+'"]').addClass("active"))}function C(b,a){if("top"===b)return!a.scrollTop();if("bottom"===b)return a.scrollTop()+a.innerHeight()>=a[0].scrollHeight}function H(b){var c=a(".section.active").index(".section");b=b.index(".section");return c>b?"up":"down"}function F(b){b.css("overflow",
"hidden");var a=b.closest(".section"),d=b.find(".scrollable");if(d.length)var f=b.find(".scrollable").get(0).scrollHeight;else f=b.get(0).scrollHeight,c.verticalCentered&&(f=b.find(".tableCell").get(0).scrollHeight);a=k-parseInt(a.css("padding-bottom"))-parseInt(a.css("padding-top"));f>a?d.length?d.css("height",a+"px").parent().css("height",a+"px"):(c.verticalCentered?b.find(".tableCell").wrapInner('<div class="scrollable" />'):b.wrapInner('<div class="scrollable" />'),b.find(".scrollable").slimScroll({height:a+
"px",size:"10px",alwaysVisible:!0})):(b.find(".scrollable").children().first().unwrap().unwrap(),b.find(".slimScrollBar").remove(),b.find(".slimScrollRail").remove());b.css("overflow","")}function W(b){b.addClass("table").wrapInner('<div class="tableCell" style="height:'+V(b)+'px;" />')}function V(b){var a=k;if(c.paddingTop||c.paddingBottom)a=b,a.hasClass("section")||(a=b.closest(".section")),b=parseInt(a.css("padding-top"))+parseInt(a.css("padding-bottom")),a=k-b;return a}function P(b,a){u.toggleClass("easing",
a);u.css(T(b))}function I(b,c){"undefined"===typeof c&&(c=0);var d=isNaN(b)?a('[data-anchor="'+b+'"]'):a(".section").eq(b-1);b===v||d.hasClass("active")?X(d,c):h(d,function(){X(d,c)})}function X(b,a){if("undefined"!=typeof a){var c=b.find(".slides"),f=c.find('[data-anchor="'+a+'"]');f.length||(f=c.find(".slide").eq(a));f.length&&p(c,f)}}function ca(b,a){b.append('<div class="fullPage-slidesNav"><ul></ul></div>');var d=b.find(".fullPage-slidesNav");d.addClass(c.slidesNavPosition);for(var f=0;f<a;f++)d.find("ul").append('<li><a href="#"><span></span></a></li>');
d.css("margin-left","-"+d.width()/2+"px");d.find("li").first().find("a").addClass("active")}function O(b,a,d){var f="";c.anchors.length&&(b?("undefined"!==typeof d&&(f=d),"undefined"===typeof a&&(a=b),J=a,location.hash=f+"/"+a):("undefined"!==typeof b&&(J=a),location.hash=d))}function da(){var b=document.createElement("p"),a,c={webkitTransform:"-webkit-transform",OTransform:"-o-transform",msTransform:"-ms-transform",MozTransform:"-moz-transform",transform:"transform"};document.body.insertBefore(b,
null);for(var f in c)void 0!==b.style[f]&&(b.style[f]="translate3d(1px,1px,1px)",a=window.getComputedStyle(b).getPropertyValue(c[f]));document.body.removeChild(b);return void 0!==a&&0<a.length&&"none"!==a}function M(b){var a=[];window.navigator.msPointerEnabled?(a.y=b.pageY,a.x=b.pageX):(a.y=b.touches[0].pageY,a.x=b.touches[0].pageX);return a}function z(a){c.css3?P("translate3d(0px, -"+a+"px, 0px)",!1):u.css("top",-a)}function T(a){return{"-webkit-transform":a,"-moz-transform":a,"-ms-transform":a,
transform:a}}c=a.extend({verticalCentered:!0,resize:!0,slidesColor:[],anchors:[],scrollingSpeed:700,easing:"easeInQuart",menu:!1,navigation:!1,navigationPosition:"right",navigationColor:"#000",navigationTooltips:[],slidesNavigation:!1,slidesNavPosition:"bottom",controlArrowColor:"#fff",loopBottom:!1,loopTop:!1,loopHorizontal:!0,autoScrolling:!0,scrollOverflow:!1,css3:!1,paddingTop:0,paddingBottom:0,fixedElements:null,normalScrollElements:null,keyboardScrolling:!0,touchSensitivity:5,continuousVertical:!1,
animateAnchor:!0,normalScrollElementTouchThreshold:5,afterLoad:null,onLeave:null,afterRender:null,afterResize:null,afterSlideLoad:null,onSlideLeave:null},c);c.continuousVertical&&(c.loopTop||c.loopBottom)&&(c.continuousVertical=!1,console&&console.log&&console.log("Option loopTop/loopBottom is mutually exclusive with continuousVertical; continuousVertical disabled"));var Q=600;a.fn.fullpage.setAutoScrolling=function(b){c.autoScrolling=b;b=a(".section.active");c.autoScrolling?(a("html, body").css({overflow:"hidden",
height:"100%"}),b.length&&z(b.position().top)):(a("html, body").css({overflow:"auto",height:"auto"}),z(0),a("html, body").scrollTop(b.position().top))};a.fn.fullpage.setScrollingSpeed=function(a){c.scrollingSpeed=a};a.fn.fullpage.setMouseWheelScrolling=function(a){a?document.addEventListener?(document.addEventListener("mousewheel",n,!1),document.addEventListener("wheel",n,!1)):document.attachEvent("onmousewheel",n):document.addEventListener?(document.removeEventListener("mousewheel",n,!1),document.removeEventListener("wheel",
n,!1)):document.detachEvent("onmousewheel",n)};a.fn.fullpage.setAllowScrolling=function(b){b?(a.fn.fullpage.setMouseWheelScrolling(!0),G&&(a(document).off("touchstart MSPointerDown").on("touchstart MSPointerDown",aa),a(document).off("touchmove MSPointerMove").on("touchmove MSPointerMove",$))):(a.fn.fullpage.setMouseWheelScrolling(!1),G&&(a(document).off("touchstart MSPointerDown"),a(document).off("touchmove MSPointerMove")))};a.fn.fullpage.setKeyboardScrolling=function(a){c.keyboardScrolling=a};var s=
!1,G=navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|Windows Phone)/),u=a(this),k=a(window).height(),t=!1,D=!1,v,J;a.fn.fullpage.setAllowScrolling(!0);c.css3&&(c.css3=da());a(this).length?u.css({height:"100%",position:"relative","-ms-touch-action":"none"}):(a("body").wrapInner('<div id="superContainer" />'),u=a("#superContainer"));if(c.navigation){a("body").append('<div id="fullPage-nav"><ul></ul></div>');var m=a("#fullPage-nav");m.css("color",c.navigationColor);m.addClass(c.navigationPosition)}a(".section").each(function(b){var e=
a(this),d=a(this).find(".slide"),f=d.length;b||0!==a(".section.active").length||a(this).addClass("active");a(this).css("height",k+"px");(c.paddingTop||c.paddingBottom)&&a(this).css("padding",c.paddingTop+" 0 "+c.paddingBottom+" 0");"undefined"!==typeof c.slidesColor[b]&&a(this).css("background-color",c.slidesColor[b]);"undefined"!==typeof c.anchors[b]&&a(this).attr("data-anchor",c.anchors[b]);if(c.navigation){var g="";c.anchors.length&&(g=c.anchors[b]);b=c.navigationTooltips[b];"undefined"===typeof b&&
(b="");m.find("ul").append('<li data-tooltip="'+b+'"><a href="#'+g+'"><span></span></a></li>')}if(0<f){var g=100*f,h=100/f;d.wrapAll('<div class="slidesContainer" />');d.parent().wrap('<div class="slides" />');a(this).find(".slidesContainer").css("width",g+"%");a(this).find(".slides").after('<div class="controlArrow prev"></div><div class="controlArrow next"></div>');"#fff"!=c.controlArrowColor&&(a(this).find(".controlArrow.next").css("border-color","transparent transparent transparent "+c.controlArrowColor),
a(this).find(".controlArrow.prev").css("border-color","transparent "+c.controlArrowColor+" transparent transparent"));c.loopHorizontal||a(this).find(".controlArrow.prev").hide();c.slidesNavigation&&ca(a(this),f);d.each(function(b){b||0!=e.find(".slide.active").length||a(this).addClass("active");a(this).css("width",h+"%");c.verticalCentered&&W(a(this))})}else c.verticalCentered&&W(a(this))}).promise().done(function(){a.fn.fullpage.setAutoScrolling(c.autoScrolling);var b=a(".section.active").find(".slide.active");
if(b.length&&(0!=a(".section.active").index(".section")||0==a(".section.active").index(".section")&&0!=b.index())){var e=c.scrollingSpeed;a.fn.fullpage.setScrollingSpeed(0);p(a(".section.active").find(".slides"),b);a.fn.fullpage.setScrollingSpeed(e)}c.fixedElements&&c.css3&&a(c.fixedElements).appendTo("body");c.navigation&&(m.css("margin-top","-"+m.height()/2+"px"),m.find("li").eq(a(".section.active").index(".section")).find("a").addClass("active"));c.menu&&c.css3&&a(c.menu).appendTo("body");if(c.scrollOverflow)a(window).on("load",
function(){a(".section").each(function(){var b=a(this).find(".slide");b.length?b.each(function(){F(a(this))}):F(a(this))});a.isFunction(c.afterRender)&&c.afterRender.call(this)});else a.isFunction(c.afterRender)&&c.afterRender.call(this);b=window.location.hash.replace("#","").split("/")[0];b.length&&(e=a('[data-anchor="'+b+'"]'),!c.animateAnchor&&e.length&&(z(e.position().top),a.isFunction(c.afterLoad)&&c.afterLoad.call(this,b,e.index(".section")+1),e.addClass("active").siblings().removeClass("active")));
a(window).on("load",function(){var a=window.location.hash.replace("#","").split("/"),b=a[0],a=a[1];b&&I(b,a)})});var Y,K=!1;a(window).scroll(function(b){if(!c.autoScrolling){var e=a(window).scrollTop();b=a(".section").map(function(){if(a(this).offset().top<e+100)return a(this)});b=b[b.length-1];if(!b.hasClass("active")){var d=a(".section.active").index(".section")+1;K=!0;var f=H(b);b.addClass("active").siblings().removeClass("active");var g=b.data("anchor");a.isFunction(c.onLeave)&&c.onLeave.call(this,
d,b.index(".section")+1,f);a.isFunction(c.afterLoad)&&c.afterLoad.call(this,g,b.index(".section")+1);R(g);S(g,0);c.anchors.length&&!t&&(v=g,location.hash=g);clearTimeout(Y);Y=setTimeout(function(){K=!1},100)}}});var x=0,B=0,w=0,A=0;a.fn.fullpage.moveSectionUp=function(){var b=a(".section.active").prev(".section");b.length||!c.loopTop&&!c.continuousVertical||(b=a(".section").last());b.length&&h(b,null,!0)};a.fn.fullpage.moveSectionDown=function(){var b=a(".section.active").next(".section");b.length||
!c.loopBottom&&!c.continuousVertical||(b=a(".section").first());(0<b.length||!b.length&&(c.loopBottom||c.continuousVertical))&&h(b,null,!1)};a.fn.fullpage.moveTo=function(b,c){var d="",d=isNaN(b)?a('[data-anchor="'+b+'"]'):a(".section").eq(b-1);"undefined"!==typeof c?I(b,c):0<d.length&&h(d)};a.fn.fullpage.moveSlideRight=function(){N("next")};a.fn.fullpage.moveSlideLeft=function(){N("prev")};a(window).on("hashchange",function(){if(!K){var a=window.location.hash.replace("#","").split("/"),c=a[0],a=
a[1],d="undefined"===typeof v,f="undefined"===typeof v&&"undefined"===typeof a;(c&&c!==v&&!d||f||!s&&J!=a)&&I(c,a)}});a(document).keydown(function(b){if(c.keyboardScrolling&&!t)switch(b.which){case 38:case 33:a.fn.fullpage.moveSectionUp();break;case 40:case 34:a.fn.fullpage.moveSectionDown();break;case 37:a.fn.fullpage.moveSlideLeft();break;case 39:a.fn.fullpage.moveSlideRight()}});a(document).on("click","#fullPage-nav a",function(b){b.preventDefault();b=a(this).parent().index();h(a(".section").eq(b))});
a(document).on({mouseenter:function(){var b=a(this).data("tooltip");a('<div class="fullPage-tooltip '+c.navigationPosition+'">'+b+"</div>").hide().appendTo(a(this)).fadeIn(200)},mouseleave:function(){a(this).find(".fullPage-tooltip").fadeOut().remove()}},"#fullPage-nav li");c.normalScrollElements&&(a(document).on("mouseover",c.normalScrollElements,function(){a.fn.fullpage.setMouseWheelScrolling(!1)}),a(document).on("mouseout",c.normalScrollElements,function(){a.fn.fullpage.setMouseWheelScrolling(!0)}));
a(".section").on("click",".controlArrow",function(){a(this).hasClass("prev")?a.fn.fullpage.moveSlideLeft():a.fn.fullpage.moveSlideRight()});a(".section").on("click",".toSlide",function(b){b.preventDefault();b=a(this).closest(".section").find(".slides");b.find(".slide.active");var c=null,c=b.find(".slide").eq(a(this).data("index")-1);0<c.length&&p(b,c)});if(!G){var Z;a(window).resize(function(){clearTimeout(Z);Z=setTimeout(U,500)})}var ea="onorientationchange"in window?"orientationchange":"resize";
a(window).bind(ea,function(){G&&U()});a(document).on("click",".fullPage-slidesNav a",function(b){b.preventDefault();b=a(this).closest(".section").find(".slides");var c=b.find(".slide").eq(a(this).closest("li").index());p(b,c)})}})(jQuery);