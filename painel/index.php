<?php
// INFORMAÇÕES PADRÕES USADAS COM FREQUÊNCIA
require_once '../config.php';
$status_session = chama_sessao(); // RESTAURA A SESSÃO ATIVA SE EXISTIR

if(isset($_GET['ordem'])) {
	$ordem = htmlspecialchars($_GET['ordem']);
	$tipo = isset($_GET['tipo']) ? htmlspecialchars($_GET['tipo']) : '';
	$pagina = (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) ? $_GET['pagina'] : 1;
	$dados = $_GET;
} else if(isset($_POST['ordem'])) {
	$ordem = htmlspecialchars($_POST['ordem']);
	$tipo = isset($_POST['tipo']) ? htmlspecialchars($_POST['tipo']) : '';
	$dados = $_POST;
}
if(!(empty($_GET) && empty($_POST))) {
	switch ($ordem) {
		case 'view':			
			// CABEÇALHO PADRÃO E TOPO PADRÃO
			include_once '../index_cabecalho.php';
			include_once '../index_topo.php';			
			echo "<script>$('#form-pesquisar').hide()</script>";

			if($status_session) {
				include_once 'painel_view.php';
			}
			echo "<script src='../js/painel.js'></script>";
			
			// RODAPÉ PADARÃO
			include_once '../index_rodape.php';
			break;

		case 'exibicao': // EXIBE OU OCULTA PUBLICAÇÕES
			include_once 'painel_model.php';
			echo exibicao($tipo, $dados);
			break;

		case 'excluir': // EXCLUI PUBLICAÇÕES
			include_once 'painel_model.php';
			echo excluir($tipo, $dados);
			break;
	}
}
?>