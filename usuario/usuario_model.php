<?php
// REGISTRO DE USUÁRIOS NO BANCO DE DADOS
function registrar_usuario($dados) {
	if(isset($dados['g-recaptcha-response']) && !empty($dados['g-recaptcha-response'])) { 
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfjzB8TAAAAAP9r5Bh276zsx8d27BTFgu2t96uq&response=".$dados['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		if(!$response['success']) return 'Recaptcha inválido. Espere o recaptcha carregar até ficar verde antes de clicar no botão Enviar.';
	} else return 'Recaptcha não respondido. Veja se você clicou no lugar certo.';
	$con = bdcon();
	if(isset($dados['nome']) && ($nome = mysqli_real_escape_string($con, trim(filter_var($dados['nome'], 513)))) == '') {
		mysqli_close($con);
		return 'Erro: nome inválido.';
	}
	if(isset($dados['telefone']) && ($tel = mysqli_real_escape_string($con, trim(filter_var($dados['telefone'], 519)))) == '' || strlen($tel) < 10) {
		mysqli_close($con);
		return 'Erro: telefone inválido.';
	}
	if(isset($dados['senha']) && ($senha = mysqli_real_escape_string($con, trim(filter_var($dados['senha'], 513)))) == '') {
		mysqli_close($con);
		return 'Erro: senha inválida.';
	}
	$pin = rand(100000, 999999);

	$query = "INSERT INTO usuario(nome, telefone, senha, pin) VALUES ('$nome', $tel, '$senha', $pin)";
	mysqli_query($con, $query);

	if(mysqli_affected_rows($con) > 0) {
		$codusuario = mysqli_insert_id($con);
		$idusuario = $codusuario.time();

		mysqli_query($con, "UPDATE usuario SET idusuario = $idusuario WHERE codusuario = $codusuario");
		if(mysqli_affected_rows($con) < 1) {
			
			mysqli_query($con, "DELETE FROM usuario WHERE codusuario = $codusuario");
			if(mysqli_affected_rows($con) > 0) {
				mysqli_close($con);
				return 'Desculpe. Seu registro não foi realizado por conta de uma falha grave no sistema. Tente novamente mais tarde.';
			} else {
			mysqli_close($con);
			return 'Desculpe. Uma falha no momento do seu registro pode impossibilitar algumas ações no site. Algum desenvolvedor deve resolver o seu problema.';
			// IMPLEMENTAR ROTINA PARA INSERIR O ERRO NO LOG DE ERROS
		}
		} else {
			$dados_login = array('telefone' => $tel, 'senha' => $senha);
			login($dados_login);
			mysqli_close($con);
			return true;
		}

	} else {
		$e = filter_var(mysqli_error($con), 521);
		mysqli_close($con);
		return "Não foi possível realizar seu cadastro devido ao seguinte erro:\\n$e";
	}
}

// AUTENTICAÇÃO DO USUÁRIO NO SISTEMA
function login($dados) {
	$con = bdcon();
	if(isset($dados['telefone']) && ($tel = mysqli_real_escape_string($con, trim(filter_var($dados['telefone'], 519)))) == '' || strlen($tel) < 10) return 'Erro: telefone inválido';
	if(isset($dados['senha']) && ($senha = mysqli_real_escape_string($con, trim(filter_var($dados['senha'], 513)))) == '') return 'Erro: senha inválida';
	
	$query = "SELECT * FROM usuario WHERE telefone = $tel AND senha = '$senha'";
	$consul = mysqli_query($con, $query);

	if(mysqli_affected_rows($con) > 0){
		$resul = mysqli_fetch_assoc($consul);
		if($resul['bloqueado']) {
			mysqli_close($con);
			return 'Esta conta foi bloqueada.';
		}
		session_id($resul['idusuario']);
		session_start();
		$_SESSION['ativo'] = 1;
		$_SESSION['codusuario'] = $resul['codusuario'];
		$_SESSION['idusuario'] = $resul['idusuario'];
		$_SESSION['nome'] = $resul['nome'];
		$_SESSION['telefone'] = $resul['telefone'];
		$_SESSION['pin'] = $resul['pin'];
		$_SESSION['qtdanuncios'] = $resul['qtdanuncios'];
		$_SESSION['premium'] = $resul['premium'];
		$_SESSION['cliente'] = $_SERVER['REMOTE_ADDR'];
		mysqli_close($con);
		return true;
	} else {
		mysqli_close($con);
		return 'Falha na autenticação. Verifique seus dados e tente novamente.';
	}
}

// DESAUTENTICAÇÃO DO USUÁRIO NO SISTEMA
function logout() {
	if(session_id() != '') {
		session_unset();
		session_destroy();
		setcookie("PHPSESSID", "", strtotime("-1 hour"), '/');
		return true;
	}
}

// ALTERAR DADOS DO USUÁRIO
function alterar_dados($ind, $dados) {
	$con = bdcon();
	$codusuario = $_SESSION['codusuario'];
	if(isset($dados['senha']) && ($senha = mysqli_real_escape_string($con, trim(filter_var($dados['senha'], 513)))) == '') {
		mysqli_close($con);
		return 'Erro: senha inválida.';
	}
	switch ($ind) {
		case 'nome':
			if(isset($dados['valor']) && ($valor = mysqli_real_escape_string($con, trim(filter_var($dados['valor'], 513)))) == '') {
				mysqli_close($con);
				return 'Erro: nome inválido.';
			} else {
				mysqli_query($con, "UPDATE usuario SET usuario.nome = '$valor' WHERE usuario.codusuario = $codusuario AND usuario.senha = '$senha'");
				if(mysqli_affected_rows($con) > 0) {
					mysqli_query($con, "UPDATE eletronico SET eletronico.contato = '$valor' WHERE eletronico.codusuario = $codusuario");
					mysqli_query($con, "UPDATE evento SET evento.contato = '$valor' WHERE evento.codusuario = $codusuario");
					mysqli_query($con, "UPDATE imovel SET imovel.contato = '$valor' WHERE imovel.codusuario = $codusuario");
					mysqli_query($con, "UPDATE servico SET servico.contato = '$valor' WHERE servico.codusuario = $codusuario");
					mysqli_close($con);
					$_SESSION['nome'] = $valor;
					return 1;
				} else {
					mysqli_close($con);
					return "Alguma coisa deu errada.\nVerifique sua senha.\nPode ser isso.";
				}
			}
			break;
		
		case 'telefone':
			if(isset($dados['valor']) && ($valor = mysqli_real_escape_string($con, trim(filter_var($dados['valor'], 519)))) == '' || strlen($valor) < 10) {
				mysqli_close($con);
				return 'Erro: telefone inválido.';
			} else {
				mysqli_query($con, "UPDATE usuario SET usuario.telefone = $valor WHERE usuario.codusuario = $codusuario AND usuario.senha = '$senha'");
				if(mysqli_affected_rows($con) > 0) {
					mysqli_query($con, "UPDATE eletronico SET eletronico.telefone = $valor WHERE eletronico.codusuario = $codusuario");
					mysqli_query($con, "UPDATE imovel SET imovel.telefone = $valor WHERE imovel.codusuario = $codusuario");
					mysqli_query($con, "UPDATE servico SET servico.telefone = $valor WHERE servico.codusuario = $codusuario");
					mysqli_close($con);
					$_SESSION['telefone'] = $valor;
					return 1;
				} else {
					$e = filter_var(mysqli_error($con), 521);
					mysqli_close($con);
					return "Alguma coisa deu errada.\nVerifique sua senha.\nPode ser isso.\n$e";
				}
			}

		case 'senha':
			if(isset($dados['valor']) && ($valor = mysqli_real_escape_string($con, trim(filter_var($dados['valor'], 513)))) == '') {
				mysqli_close($con);
				return 'Erro: nova senha inválida.';
			} else {
				mysqli_query($con, "UPDATE usuario SET usuario.senha = '$valor' WHERE usuario.codusuario = $codusuario AND usuario.senha = '$senha'");
				if(mysqli_affected_rows($con) > 0) {
					mysqli_close($con);
					return 1;
				} else {
					mysqli_close($con);
					return "Alguma coisa deu errada.\nVerifique sua senha.\nPode ser isso.";
				}
			}
			break;
	}
}

// RETORNA A SENHA ATUAL DO USUÁRIO QUE NÃO LEMBRA
function amnesia($dados) {
	$con = bdcon();
	if(isset($dados['telefone']) && ($tel = mysqli_real_escape_string($con, trim(filter_var($dados['telefone'], 519)))) == '' || strlen($tel) < 10) {
		mysqli_close($con);
		return 'Erro: telefone inválido.';
	}
	if(isset($dados['pin']) && ($pin = mysqli_real_escape_string($con, trim(filter_var($dados['pin'], 519)))) == '') {
		mysqli_close($con);
		return 'Erro: pin inválido.';
	}
	$consul = mysqli_query($con, "SELECT usuario.senha FROM usuario WHERE usuario.telefone = $tel AND usuario.pin = $pin");
	if(mysqli_affected_rows($con) > 0) {
		$resul = mysqli_fetch_assoc($consul);
		mysqli_close($con);
		return $resul['senha'];
	} else return 'Erro: Telefone ou PIN inválido.';
}

// EXCLUI A CONTA DO USUÁRIO
function excluir_conta($dados) {
	$con = bdcon();
	$codusuario = $_SESSION['codusuario'];
	if(isset($dados['pin']) && ($pin = mysqli_real_escape_string($con, trim(filter_var($dados['pin'], 519)))) == "") {
		mysqli_close($con);
		return "Erro: pin inválido.";
	}
	mysqli_query($con, "DELETE FROM usuario WHERE usuario.codusuario = $codusuario AND usuario.pin = '$pin'");
	if(mysqli_affected_rows($con) > 0) {
		logout();
		mysqli_close($con);
		return true;
	} else {
		mysqli_close($con);
		return "Não foi possível excluir a conta especificada.";
	}
}
?>