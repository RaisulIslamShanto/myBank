$(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();
});
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 80) {
        $(".sidebar").addClass("topPosition");
    } else {
        $(".sidebar").removeClass("topPosition");
    }
});

$( window ).on("load", function() {
    // executes when complete page is fully loaded, including all frames, objects and images
    
    $("html").removeAttr('data-bs-theme' , 'dark');
   });
$( document ).ready(function() {

$("body").delegate("#dark-mode", "click", function(){ 
   
  $(this).hide();
  $('#light-mode').show();
  localStorage.setItem("mode", 'theme-dark'); 
  $("html").attr('data-bs-theme' , 'dark');
  
});
  
$("body").delegate("#light-mode", "click", function(){

  $(this).hide();
  $('#dark-mode').show();
  window.localStorage.clear()
  $("html").removeAttr('data-bs-theme' , 'dark');
});

if(localStorage.key('theme-dark')){ 
  $("html").attr('data-bs-theme' , 'dark');
}
    $('#datatable').DataTable({
        responsive: true
    });
    $('.filter').click(function(){
       $('.filterbox').toggle();
    })


    
});
