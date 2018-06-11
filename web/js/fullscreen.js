// toggle full screen
function toggleFullScreen() {
  if (!document.fullscreenElement &&
    !document.mozFullScreenElement && !document.webkitFullscreenElement) {
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.cancelFullScreen) {
      document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
      document.webkitCancelFullScreen();
    }
  }
}

function menu(n){if(n){$("nav.menu").addClass("open"),$("nav.menu .default span").html($("nav.menu .default span").attr("data-opened"));var e={page:"menu"};history.pushState(e,document.title,"#menu")}else $("nav.menu").removeClass("open"),$("nav.menu .default span").html($("nav.menu .default span").attr("data-closed")),history.pushState("",document.title,window.location.pathname)}window.location.hash&&"#menu"==window.location.hash&&menu(!0),$(function(){(document.fullscreenEnabled||document.webkitFullscreenEnabled||document.mozFullScreenEnabled||document.msFullscreenEnabled)&&$(".switch").removeClass("hidden"),$(".switch:not(.hidden) span").click(function(){$(this).toggleClass("active"),toggleFullScreen()}),$("nav.menu .default").click(function(){menu($("nav.menu").hasClass("open")?!1:!0)})});