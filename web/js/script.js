// Timer de l"horloge
function checkTime(i) {
  if (i < 10) {
      i = "0" + i;
  }
  return i;
}
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  m = checkTime(m);
  document.getElementById("time").innerHTML = h + ":" + m;
  t = setTimeout(function () {
      startTime()
  }, 500);
}
startTime();

$(document).ready(function(){
  // Chargement
  $("#loading").delay(3500).fadeOut();

  $(".window").draggable({
    handle: ".title"
  });

  $(".about .times, #about, #task-item-1").click(function(){
    $(".about").toggleClass("display-none");
  });
  $(".projects .times, #projects, #task-item-2").click(function(){
    $(".projects").toggleClass("display-none");
  });
  $(".social .times, #social, #task-item-3").click(function(){
    $(".social").toggleClass("display-none");
  });
  $(".paint .times, #paint, #task-item-4").click(function(){
    $(".paint").toggleClass("display-none");
  });
  $(".demineur .times, #demineur, #task-item-5").click(function(){
    $(".demineur").toggleClass("display-none");
  });
  
  $(".closeme").click(function() {
    $(this).parent().parent().hide();
    $(this).toggleClass("active");
  });
  
  $(".clickme").click(function() {
    $(".window").show();
    $(".clickme").toggleClass("active");
  });
  
  $(".checkbox").click(function() {
    $(this).toggleClass("checked");
  });
  $(".start").click(function () {
    $("#startMenu").toggleClass("display-none");
    $(this).toggleClass("clickme");
  });
  $("#shutdown").click(function(){
     $(".display-none").fadeIn(500).delay(1000).fadeOut(500);
  });
});
