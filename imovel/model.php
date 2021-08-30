<?php
/*
 * IMÓVEIS
 */
include_once '../classes/com.model.php';

class _model extends MODEL {
	/* VARIÁVEIS DE AMBIENTE */
	public function opcoes($x) {
		switch ($x) {
			case 'transacao':
				return array('1' => 'VENDER', '2' => 'ALUGAR', '3' => 'TROCAR', '4' => 'ARRENDAR');
				break;
			
			case 'imovel':
				return array('1' => 'CASA', '2' => 'ROÇA', '3' => 'SÍTIO', '4' => 'CHÁCARA', '5' => 'CHALÉ', '6' => 'TERRENO', '7' => 'LOTE', '8' => 'ESPAÇO P/ EVENTO', '9' => 'PONTO COMERCIAL', '10' => 'EMPRESA', '11' => 'GARAGEM', '12' => 'QUARTO EM RESIDÊNCIA', '13' => 'FAZENDA', '14' => 'APARTAMENTO', '15' => 'COBERTURA', '16' => 'DUPLEX', '17' => 'MANSÃO', '18' => 'SALA COMERCIAL', '19' => 'QUARTO EM REPÚBLICA', '20' => 'TRIPLEX', '21' => 'FLAT', '22' => 'ESTACIONAMENTO', '23' => 'ESCRITÓRIO');
				break;

			case 'medida':
				return array('1' => 'm2', '2' => 'km2', '3' => 'hectare', '4' => 'are', '5' => 'braça', '6' => 'tarefa');
				break;
		}
	}

	// REGISTRO DE IMÓVEIS NO BANCO DE DADOS
	public static function registrar($dados, $img) {
		$con = bdcon();
		$transacao = self::opcoes('transacao');
		$imovel = self::opcoes('imovel');
		$medida = self::opcoes('medida');

		// TRANSAÇÃO
		if(isset($dados['transacao']) && is_numeric($dados['transacao']) && isset($transacao[$dados['transacao']])) $transacao = $transacao[$dados['transacao']]; else {
			mysqli_close($con);
			return 'Erro: transação inválida.';
		}
		
		// TIPO DE IMÓVEL
		if(isset($dados['tpimovel']) && is_numeric($dados['tpimovel']) && isset($imovel[$dados['tpimovel']])) $imovel = $imovel[$dados['tpimovel']]; else {
			mysqli_close($con);
			return 'Erro: imóvel inválido.';
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
		if(isset($dados['endereco']) && ($endereco = mysqli_real_escape_string($con, trim(filter_var($dados['endereco'], 513)))) == '') {
			mysqli_close($con);
			return 'Erro: endereco inválido.';
		}
		
		// BAIRRO
		if(isset($dados['bairro']) && ($bairro = mysqli_real_escape_string($con, trim(filter_var($dados['bairro'], 513)))) == '') {
			mysqli_close($con);
			return 'Erro: bairro inválido.';
		}
		
		// COMPLEMENTO
		if(isset($dados['complemento']) && ($comp = mysqli_real_escape_string($con, trim(filter_var($dados['complemento'], 513)))) == '') $comp = 'sem complemento';
		
		// AREA TOTAL
		if(isset($dados['areattl'])) {
			$s = array('.', ',');
			$r = array('', '.');
			if(!is_numeric($areattl = str_replace($s, $r, $dados['areattl']))) {
				mysqli_close($con);
				return 'Erro: área total inválida.';
			}
		}
		
		// MEDIDA DE AREA TOTAL
		if(isset($dados['tpareattl']) && is_numeric($dados['tpareattl']) && isset($medida[$dados['tpareattl']])) $tpareattl = $medida[$dados['tpareattl']]; else {
			mysqli_close($con);
			return 'Erro: unidade de medida inválida.';
		}
		
		// VALOR
		if(isset($dados['valor'])) {
			$s = array('.', ',');
			$r = array('', '.');
			if(!is_numeric($valor = str_replace($s, $r, $dados['valor']))) {
				mysqli_close($con);
				return 'Erro: valor inválido.';
			}
		}
		
		// AREA CONSTRUÍDA
		if(isset($dados['areacon'])) {
			$s = array('.', ',');
			$r = array('', '.');
			if(!is_numeric($areacon = str_replace($s, $r, $dados['areacon']))) {
				$areacon = 0;
			}
		}

		// MEDIDA DE AREA CONSTRUÍDA
		if(isset($dados['tpareacon']) && is_numeric($dados['tpareacon']) && isset($medida[$dados['tpareacon']])) $tpareacon = $medida[$dados['tpareacon']]; else $tpmddcon = '';
		
		// COMODOS
		$comodos = (isset($dados['comodos']) && is_numeric($dados['comodos'])) ? $dados['comodos'] : 0;
		
		// QUARTOS
		$quartos = (isset($dados['quartos']) && is_numeric($dados['quartos'])) ? $dados['quartos'] : 0;
		
		// SUITES
		$suites = (isset($dados['suites']) && is_numeric($dados['suites'])) ? $dados['suites'] : 0;
		
		// GARAGEM
		$garagem = (isset($dados['garagem'])) ? 'Sim' : 'Não';
		
		// SISTEMA DE SEGURANÇA
		$seguranca = (isset($dados['seguranca'])) ? 'Sim' : 'Não';
		
		// ESCRITURA
		$escritura = (isset($dados['escritura'])) ? 'Sim' : 'Não';
		
		// DETALHES
		if(isset($dados['obs']) && ($obs = mysqli_real_escape_string($con, trim(filter_var($dados['obs'], 513)))) == '') $obs = 'Nada.';

		// KEYWORDS
		$keywords = $transacao.' '.$imovel.' '.$uf.' '.$cidade.' '.$endereco.' '.$bairro.' '.$comp.' '.$valor.' '.$obs.' ';
		$keywords .= ($comodos > 0) ? $comodos.' comodo comodos ' : '';
		$keywords .= ($quartos > 0) ? $quartos.' quarto quartos ' : '';
		$keywords .= ($suites > 0) ? $suites.' suite suites ' : '';
		$keywords .= ($garagem == 'Sim') ? 'garagem garagens ' : '';
		$keywords .= ($seguranca == 'Sim') ? 'segurança ' : '';
		$keywords .= ($escritura == 'Sim') ? 'escritura' : '';

		$query = "INSERT INTO imovel(codusuario, transacao, tipo, uf, cidade, endereco, bairro, complemento, areatotal, tipoareattl, valor, contato, telefone, areaconstruida, tipoareacon, qtdcomodos, qtdquarto, qtdsuite, garagem, seguranca, escritura, observacao, keywords, dtcadastro) VALUES (".$_SESSION['codusuario'].", '$transacao', '$imovel', '$uf', '$cidade', '$endereco', '$bairro', '$comp', $areattl, '$tpareattl', $valor, '".$_SESSION['nome']."', '".$_SESSION['telefone']."', $areacon, '$tpareacon', $comodos, $quartos, $suites, '$garagem', '$seguranca', '$escritura', '$obs', '$keywords', '".date('Y-m-d', time())."')";

		mysqli_query($con, $query);

		if(mysqli_affected_rows($con) > 0) {
			$codimovel = mysqli_insert_id($con);
			$idimovel = $codimovel.time();

			// IMAGEM
			if(isset($img['imagem']) && !empty($img['imagem']['name'])) {
				include_once '../classes/com.imagem.php';
				$consul = IMAGEM::salvar('../img/imovel/', $img);
				if($consul[0] === true) {
					$imagem = $consul[1];
					$destino = $consul[2];
				} else {
					mysqli_query($con, "DELETE FROM imovel WHERE codimovel = $codimovel");
					mysqli_close($con);
					return $consul[1];
				}
			} else $imagem = 'imagem.svg';

			mysqli_query($con, "UPDATE imovel SET idimovel = $idimovel, imagem = '$imagem' WHERE codimovel = $codimovel");
			if(mysqli_affected_rows($con) <= 0) {
				
				if($imagem != 'imagem.svg') delete($destino);
				mysqli_query($con, "DELETE FROM imovel WHERE codimovel = $codimovel");
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

	// ÁREA PRINCIPAL DA PÁGINA DE VISUALIZAÇÃO DE IMÓVEIS
	public static function publicacoes($dados, $pagina) {
		$con = bdcon();
		$resul = "";
		if(($imovel = self::listar('imovel', $dados, $pagina)) !== false) {
			$count = 0;
			while($row = mysqli_fetch_assoc($imovel)) {
				$imgsize = @getimagesize("../img/imovel/".$row['imagem']);
				$tamanho = ($imgsize[0] >= $imgsize[1]) ? 'width' : 'height';
				$resul .= (($count % 2) == 0) ? "<div class='row'>" : ""; // CRIA UMA NOVA LINHA PARA CADA 2 PUBLICACÕES
				$resul .= ("
					<div class='col-md-6'>
						<div class='panel panel-primary'>
							<div class='panel-heading'><strong>".mb_strtoupper($row['tipo'], 'UTF-8')." PARA ".$row['transacao']." #".$row['idimovel']."</strong></div>
							<div class='panel-body' style='overflow: hidden'>
								<center><img src='../img/imovel/".$row['imagem']."' ".$tamanho."='100%' alt='miniatura'></center>
								<table class='table table-colapsed'>
									<tr><td><strong>Preço:</strong></td><td class='text-primary'><strong>R$ ".number_format($row['valor'], 2, ",", ".")."</strong></td></tr>
									<tr><td><strong>Endereço:</strong></td><td>".$row['endereco'].", ".$row['bairro'].", ".$row['cidade']." - ".$row['uf']." - ".$row['complemento']."</td></tr>
									<tr><td><strong>Contato:</strong></td><td>".$row['contato']."</td></tr>
									<tr><td><strong>Telefone:</strong></td><td>".maskTel($row['telefone'])."</td></tr>
									<tr><td><strong>Área total:</strong></td><td>".number_format($row['areatotal'], 2, ",", ".")." ".$row['tipoareattl']."</td></tr>
									<tr><td><strong>Área construída:</strong></td><td>".number_format($row['areaconstruida'], 2, ",", ".")." ".$row['tipoareacon']."</td></tr>
									<tr><td><strong>Comodos:</strong></td><td>".$row['qtdcomodos']."</td></tr>
									<tr><td><strong>Quartos:</strong></td><td>".$row['qtdquarto']."</td></tr>
									<tr><td><strong>Suites:</strong></td><td>".$row['qtdsuite']."</td></tr>
									<tr><td><strong>Garagem:</strong></td><td>".$row['garagem']."</td></tr>
									<tr><td><strong>Sistema de Segurança:</strong></td><td>".$row['seguranca']."</td></tr>
									<tr><td><strong>Escriturada:</strong></td><td>".$row['escritura']."</td></tr>
									<tr><td><strong>Observação:</strong></td><td>".nl2br($row['observacao'])."</td></tr>
									<tr><td><strong>Publicado em:</strong></td><td>".date('d/m/Y', strtotime($row['dtcadastro']))."</td></tr>
								</table>
							</div>
						</div>
					</div>
				");

				// ATUALIZA O NÚMERO DE VISITAS
				$query = "UPDATE imovel SET imovel.visitas = (imovel.visitas+1) WHERE codimovel = ".$row['codimovel'];
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