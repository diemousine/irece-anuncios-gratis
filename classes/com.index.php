<?php

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
	include_once 'model.php';
	switch ($ordem) {
		case 'view':			
			// CABEÇALHO PADRÃO E TOPO PADRÃO
			include_once '../index_cabecalho.php';
			include_once '../index_topo.php';
			
			switch ($tipo) {
					case "novo": // CHAMA O FORMULÁRIO DE NOVO CADASTRO
						if($status_session) {
							include_once 'novo_view.php';
						} else {
							echo "<script>alert('Sessão expirada.'); window.location.href ='$self_path';</script>";
						}
						break;

					default: // CHAMA O FORMULÁRIO DE EXIBIÇÃO
						include_once 'display_view.php';
						echo "<script type='text/javascript' src='//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53cdf80422a47317'></script>";
						break;
				}
			echo "<script src='../js/$tabela.js'></script>";
			// RODAPÉ PADARÃO
			include_once '../index_rodape.php';
			break;
		case 'registrar':
			switch ($tipo) {
				case 'novo': // REALIZA O REGISTRO DE NOVO CADASTRO
					if($status_session) {
						if(($_SESSION['qtdanuncios']/$_SESSION['premium']) <= 10) { // ISSO EVITA QUE O USUÁRIOS FAÇAM MUITAS PUBLICAÇÕES
							$r = _model::registrar($dados, $_FILES);
							if($r === true) header("Location: $self_path");
							else {
								header('Content-type: text/html; charset=UTF-8');
								echo "<script>alert('".$r."'); window.history.back();</script>";
							}
						} else {
							echo "<script>alert('Você atingiu o limite de publicações.'); window.location.href ='$self_path';</script>";
						}
					} else {
						header('Content-type: text/html; charset=UTF-8');
						echo "<script>alert('Sessão expirada.'); window.location.href ='$self_path';</script>";
					}
					break;
			}
			break;
		case 'listar':
			switch ($tipo) {
				case 'cidades': // LISTA AS CIDADES QUE PERTECEM AO ESTADO PASSADO
					if(isset($_POST['ufid']) && is_numeric($_POST['ufid'])) {
						$con = bdcon();
						$ufid = $_POST['ufid'];
						$lista = "";
						$consul = mysqli_query($con, "SELECT cidade.id, cidade.nmCidade FROM cidade WHERE cidade.idEstado = $ufid");
						if(mysqli_affected_rows($con) > 0) {
							while ($row = mysqli_fetch_row($consul)) {
								$lista .= "<option value='".$row[0]."'>".$row[1]."</option>";
							}
							echo $lista;
						} else echo "<option>Algo errado não está certo.</option>";
					} else echo "<option value=''>SELECIONE UM ESTADO</option>";
					break;
				
				default: // CHAMA O FORMULÁRIO COM MAIS PUBLICAÇÕES
						echo _model::publicacoes($dados, $pagina);
					break;
			}
			break;
	}
}
?>