$(document).ready(function(){
	$('#keyword').on('keyup', function(){
		$('.tabelpaket').load('ajax/kupon.php?keyword='+$('#keyword').val());
	});
});