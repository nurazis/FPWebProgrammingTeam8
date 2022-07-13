$(document).ready(function(){
	$('#keyword').on('keyup', function(){
		$('.tabelakun').load('ajax/akun.php?keyword='+$('#keyword').val());
	});
});