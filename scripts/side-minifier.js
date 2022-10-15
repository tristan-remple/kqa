$(document).ready(function() {

$("#go-mini").click(function(){
   $(".sidebar").addClass("hidden");
   $(".mini-side").removeClass("hidden");
   $(".full").removeClass("hidden");
   $(".ship-text").removeClass("hidden");
});

$("#go-big").click(function(){
    $(".sidebar").removeClass("hidden");
    $(".mini-side").addClass("hidden");
    $(".full").addClass("hidden");
    $(".ship-text").addClass("hidden");
});

$('#go-mini').keypress(function(event) {
  if ((event.keyCode == 13) || (event.keyCode == 32)) {
    $(this).click();
  }
});

$('#go-big').keypress(function(event) {
  if ((event.keyCode == 13) || (event.keyCode == 32)) {
    $(this).click();
  }
});

});