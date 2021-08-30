<?php
// INFORMAÇÕES PADRÕES USADAS COM FREQUÊNCIA
require_once '../config.php';
$status_session = chama_sessao(); // RESTAURA A SESSÃO ATIVA SE EXISTIR

if(isset($_GET['ordem'])) {
	$ordem = htmlspecialchars($_GET['ordem']);
	$tipo = isset($_GET['tipo']) ? htmlspecialchars($_GET['tipo']) : '';
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
			
			switch ($tipo) {
				case 'usuario-novo': // CHAMA O FORMULÁRIO DE CADASTRO DE NOVOS USUÁRIOS
					if($status_session) {
						echo "<script>window.location.href = '$usuario_path/?ordem=view&tipo=perfil';</script>";
					} else {
						include 'usuario_novo_view.php';
					}
					break;

				case 'perfil': // CHAMA A PÁGINA DO PERFIL DO USUÁRIO
					if($status_session) {
						include 'usuario_perfil_view.php';
					}
					break;

				case 'amnesia':
					include_once 'usuario_model.php';
					if($status_session) {
						echo "<script>window.location.href = '$usuario_path/?ordem=view&tipo=perfil';</script>";
					} else {
						include 'usuario_amnesia_view.php';
					}
					break;

				case 'excluir': // CHAMA A PÁGINA DO PERFIL DO USUÁRIO
					if($status_session) {
						include 'usuario_perfil_excluir_view.php';
					}
					break;
			}
			echo "<script src='../js/usuario.js'></script>";
			
			// RODAPÉ PADARÃO
			include_once '../index_rodape.php';
			break;

		case 'registrar':
			include_once 'usuario_model.php';
			switch ($tipo) {
				case 'usuario-novo': // REALIZA O REGISTRO DE NOVOS USUÁRIOS
					if($status_session) {
						echo "<script>window.location.href = '$usuario_path/?ordem=view&tipo=perfil';</script>";
					} else {
						$r = registrar_usuario($dados);
						if($r === true) {
							header('Content-type: text/html; charset=UTF-8');
							echo "<script>alert('Registrado com sucesso.\\nAnote e guarde este PIN com segurança:\\n".$_SESSION['pin']."'); window.location.href = '$usuario_path/?ordem=view&tipo=perfil';</script>";
						} else {
							header('Content-type: text/html; charset=UTF-8');
							echo "<script>alert('".$r."'); window.history.back();</script>";
						}
					}
					break;

				case 'nome': // ALTERA O NOME DO USUÁRIO
					if($status_session) echo alterar_dados($tipo, $dados);
					break;

				case 'telefone': // ALTERA O TELEFONE DO USUÁRIO
					if($status_session) echo alterar_dados($tipo, $dados);
					break;

				case 'nsenha': // ALTERA O SENHA DO USUÁRIO
					if($status_session) echo alterar_dados('senha', $dados);
					break;
			}
			break;

		case 'entrar': // REALIZA A AUTENTICAÇÃO DO USUÁRIO NO SISTEMA
			include_once 'usuario_model.php';
			$r = login($dados);
			if($r === true) header('Location: '.$dados['url-atual']);
			else {
				header('Content-type: text/html; charset=UTF-8');
				echo "<script>alert('".$r."'); window.location.href = '".$dados['url-atual']."';</script>";
			}
			break;

		case 'sair': // REALIZA A DESAUTENTICAÇÃO DO USUÁRIO NO SISTEMA
			include_once 'usuario_model.php';
			if($status_session) logout();
			header("Location: $home_path");
			break;

		case 'editar':
			include 'usuario_perfil_edit_view.php';
			switch ($tipo) {
				case 'nome':
					if($status_session) echo nome();
					break;

				case 'telefone':
					if($status_session) echo telefone();
					break;

				case 'nsenha':
					if($status_session) echo nsenha();
					break;
			}
			break;

		case 'amnesia':
			include_once 'usuario_model.php';
			header('Content-type: text/html; charset=UTF-8');
			echo "<script>alert('Sua senha atual é: ".amnesia($dados)."'); window.location.href = '$home_path';</script>";
			break;

		case 'excluir':
			include_once 'usuario_model.php';
			if($status_session) {
				$r = excluir_conta($dados);
				if($r === true) header("Location: $home_path");
				else {
					header('Content-type: text/html; charset=UTF-8');
					echo "<script>alert('".$r."'); window.location.href = '$usuario_path/?ordem=view&tipo=perfil';</script>";
				}
			}
			break;
	}
}
?>