$(document).ready(function(){

	$('.navbar .btn-menu').click(function(){
		$(this).toggleClass('activo');
		$('#sidebar').toggleClass('activo');
		$('#sistema').toggleClass('activo');
	});
    
    $('#sidebar').hover(function(){
		$(this).toggleClass('mostrar');
	});
    
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

});
