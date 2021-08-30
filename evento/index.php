<?php
/*
 * EVENTOS
 */

require_once '../config.php';
$status_session = chama_sessao(); // RESTAURA A SESSÃO ATIVA SE EXISTIR

$tabela = 'evento';
$self_path = $home_evento_path;

include_once '../classes/com.index.php';

?>