<?php
/*
 * SERVIÇOS
 */
include_once '../classes/com.model.php';

class _model extends MODEL {
	
	// REGISTRO DE SERVIÇOS NO BANCO DE DADOS
	public static function registrar($dados, $img) {
		$con = bdcon();

		// SERVIÇO
		if(isset($dados['servico']) && ($servico = mysqli_real_escape_string($con, trim(filter_var($dados['servico'], 513)))) == '') {
			mysqli_close($con);
			return 'Erro: serviço inválido.';
		}

		// ATIVIDADES
		if(isset($dados['atividades']) && ($atividades = mysqli_real_escape_string($con, trim(filter_var($dados['atividades'], 513)))) == '') {
			mysqli_close($con);
			return 'Erro: atividades inválidas.';
		}

		// UF
		if(isset($dados['uf']) && is_numeric($dados['uf'])) {
			$ufid = $dados['uf'];
			$consul = mysqli_query($con, "SELECT estado.nmEstado FROM estado WHERE estado.id = $ufid");
			if(mysqli_affected_rows($con) > 0) {
				$uf = mysqli_fetch_assoc($consul)['nmEstado'];
			} else return "Erro: estado inválido.";
		} else return "Erro: estado inválido.";

		// CIDADE
		if(isset($dados['cidade']) && is_numeric($dados['cidade'])) {
			$cidid = $dados['cidade'];
			$consul = mysqli_query($con, "SELECT cidade.nmCidade FROM cidade WHERE cidade.id= $cidid AND cidade.idEstado = $ufid");
			if(mysqli_affected_rows($con)) {
				$cidade = mysqli_fetch_assoc($consul)['nmCidade'];
			} else return "Erro: cidade inválida.";
		} else return "Erro: cidade inválida.";

		// ENDEREÇO
		if(isset($dados['endereco']) && ($endereco = mysqli_real_escape_string($con, trim(filter_var($dados['endereco'], 513)))) == '') $endereco = 'sem endereço';
		
		// BAIRRO
		if(isset($dados['bairro']) && ($bairro = mysqli_real_escape_string($con, trim(filter_var($dados['bairro'], 513)))) == '') $bairro = 'sem bairro';
		
		// COMPLEMENTO
		if(isset($dados['complemento']) && ($comp = mysqli_real_escape_string($con, trim(filter_var($dados['complemento'], 513)))) == '') $comp = 'sem complemento';
		
		// VALOR
		if(isset($dados['valor'])) {
			$s = array('.', ',');
			$r = array('', '.');
			if(!is_numeric($valor = str_replace($s, $r, $dados['valor']))) {
				mysqli_close($con);
				return 'Erro: valor inválido.';
			}
		}
		
		// DETALHES
		if(isset($dados['obs']) && ($obs = mysqli_real_escape_string($con, trim(filter_var($dados['obs'], 513)))) == '') $obs = 'Nada.';

		// KEYWORDS
		$keywords = $servico.' '. $atividades .' '.$uf.' '.$cidade.' '.$endereco.' '.$bairro.' '.$comp.' '.$valor.' '.$obs.' ';

		$query = "INSERT INTO servico(codusuario, servico, atividades, uf, cidade, endereco, bairro, complemento, valor, contato, telefone, observacao, keywords, dtcadastro) VALUES (".$_SESSION['codusuario'].", '$servico', '$atividades', '$uf', '$cidade', '$endereco', '$bairro', '$comp', $valor, '".$_SESSION['nome']."', '".$_SESSION['telefone']."', '$obs', '$keywords', '".date('Y-m-d', time())."')";

		mysqli_query($con, $query);

		if(mysqli_affected_rows($con) > 0) {
			$codservico = mysqli_insert_id($con);
			$idservico = $codservico.time();

			// IMAGEM
			if(isset($img['imagem']) && !empty($img['imagem']['name'])) {
				include_once '../classes/com.imagem.php';
				$consul = IMAGEM::salvar('../img/servico/', $img);
				if($consul[0] === true) {
					$imagem = $consul[1];
					$destino = $consul[2];
				} else {
					mysqli_query($con, "DELETE FROM servico WHERE codservico = $codservico");
					mysqli_close($con);
					return $consul[1];
				}
			} else $imagem = 'imagem.svg';

			mysqli_query($con, "UPDATE servico SET idservico = $idservico, imagem = '$imagem' WHERE codservico = $codservico");
			if(mysqli_affected_rows($con) <= 0) {
				
				if($imagem != 'imagem.svg') delete($destino);
				mysqli_query($con, "DELETE FROM servico WHERE codservico = $codservico");
				if(mysqli_affected_rows($con) > 0) {
					mysqli_close($con);
					return "Desculpe. Seu registro não foi realizado por conta de uma falha grave no sistema. Tente novamente mais tarde.";
				} else {
					mysqli_close($con);
					return "Desculpe. Uma falha no momento do registro pode impossibilitar que a publicação seja vista. Algum desenvolvedor deve resolver o seu problema.";
				}
			} else {
				mysqli_query($con, "UPDATE usuario SET usuario.qtdanuncios = usuario.qtdanuncios+1 WHERE codusuario = ".$_SESSION['codusuario']);
				$_SESSION['qtdanuncios']++;
				mysqli_close($con);
				return true;
			}
		} else {
			$e = filter_var(mysqli_error($con), 521);
			mysqli_close($con);
			return "Não foi possível realizar sua publicação devido ao seguinte erro:\\n$e";
		}
	}

	// ÁREA PRINCIPAL DA PÁGINA DE VISUALIZAÇÃO DE SERVIÇOS
	public static function publicacoes($dados, $pagina) {
		$con = bdcon();
		$resul = "";
		if(($servico = self::listar('servico', $dados, $pagina)) !== false) {
			$count = 0;
			while($row = mysqli_fetch_assoc($servico)) {
				$imgsize = @getimagesize("../img/servico/".$row['imagem']);
				$tamanho = ($imgsize[0] >= $imgsize[1]) ? 'width' : 'height';
				$resul .= (($count % 2) == 0) ? "<div class='row'>" : ""; // CRIA UMA NOVA LINHA PARA CADA 2 PUBLICACÕES
				$resul .= ("
					<div class='col-md-6'>
						<div class='panel panel-primary'>
							<div class='panel-heading'><strong>".mb_strtoupper($row['servico'], 'UTF-8')."</strong></div>
							<div class='panel-body' style='overflow: hidden'>
								<center><img src='../img/servico/".$row['imagem']."' ".$tamanho."='100%' alt='miniatura'></center>
								<table class='table table-colapsed'>
									<tr><td><strong>Valor mínimo:</strong></td><td class='text-primary'><strong>R$ ".number_format($row['valor'], 2, ",", ".")."</strong></td></tr>
									<tr><td><strong>Endereço:</strong></td><td>".$row['endereco'].", ".$row['bairro'].", ".$row['cidade']." - ".$row['uf']." - ".$row['complemento']."</td></tr>
									<tr><td><strong>Contato:</strong></td><td>".$row['contato']."</td></tr>
									<tr><td><strong>Telefone:</strong></td><td>".maskTel($row['telefone'])."</td></tr>
									<tr><td><strong>Atividades:</strong></td><td>".$row['atividades']."</td></tr>
									<tr><td><strong>Detalhes:</strong></td><td>".nl2br($row['observacao'])."</td></tr>
									<tr><td><strong>Publicado em:</strong></td><td>".date('d/m/Y', strtotime($row['dtcadastro']))."</td></tr>
								</table>
							</div>
						</div>
					</div>
				");

				// ATUALIZA O NÚMERO DE VISITAS
				$query = "UPDATE servico SET servico.visitas = (servico.visitas+1) WHERE codservico = ".$row['codservico'];
				mysqli_query($con, $query);

				$resul .= (($count % 2) != 0) ? "</div>" : ""; // FECHA A LINHA A CADA 2 PUBLICAÇÕES
				$count++;
			}
			$resul .= (($count % 2) != 0) ? "</div>" : "";
			mysqli_close($con);
			return $resul;
		} else {
			mysqli_close($con);
			return "<center>Nada foi encontrado nos nossos registros.</center><br />";
		}
	}
}
?>