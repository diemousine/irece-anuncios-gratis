<?php
/*
 * IMÓVEIS
 */

require_once '../config.php';
$status_session = chama_sessao(); // RESTAURA A SESSÃO ATIVA SE EXISTIR

$tabela = 'imovel';
$self_path = $home_imovel_path;

include_once '../classes/com.index.php';

?>