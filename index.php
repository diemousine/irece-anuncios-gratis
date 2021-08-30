<?php
// INFORMAÇÕES PADRÕES USADAS COM FREQUÊNCIA
require_once 'config.php';
$status_session = chama_sessao(); // RESTAURA A SESSÃO ATIVA

// CABEÇALHO PADRÃO E TOPO PADRÃO
include_once 'index_cabecalho.php';
include_once 'index_topo.php';
echo "<script>$('#form-pesquisar').hide()</script>";

// DISPLAY DE OPÇÕES
include_once 'index_display.php';

// RODAPÉ PADRÃO
include_once 'index_rodape.php';
?>