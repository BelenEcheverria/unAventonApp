<?php
	function conectar(){
		$link = mysqli_connect ('localhost', 'root', '', 'unaventon') or die ("error". mysqli_error ($link));
		mysqli_set_charset($link, 'utf8');
		return ($link);
		}
?>