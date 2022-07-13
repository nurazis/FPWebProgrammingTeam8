$(document).ready(function(){
	$('#keyword').on('keyup', function(){
		$('.tabelpaket').load('ajax/paket.php?keyword='+$('#keyword').val());
	});
});