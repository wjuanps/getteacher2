<?php

if (!isset($_SESSION['usuario'])) {
	$arquivo = fopen("cont.txt", "r");
	$visitantes = fread($arquivo, filesize("cont.txt"));
	fclose($arquivo);

	$arquivo = fopen("cont.txt", "r+");
	$visitantes++;
	fputs($arquivo, $visitantes);
	fclose($arquivo);
}