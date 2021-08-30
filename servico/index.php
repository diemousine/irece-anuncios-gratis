<?php
/*
 * SERVIÇOS
 */

require_once '../config.php';
$status_session = chama_sessao(); // RESTAURA A SESSÃO ATIVA SE EXISTIR

$tabela = 'servico';
$self_path = $home_servico_path;

include_once '../classes/com.index.php';

?>