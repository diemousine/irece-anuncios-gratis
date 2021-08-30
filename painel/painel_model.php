<?php
// CONTROLE DE IMÓVEIS
function exibicao($tipo, $dados) {
	if(isset($dados['id']) && is_numeric($dados['id'])) {
		$con = bdcon();
		$id = $dados['id'];
		$codusuario = $_SESSION['codusuario'];
		$consul = mysqli_query($con, "SELECT $tipo.oculto, $tipo.bloqueado FROM $tipo WHERE $tipo.id$tipo = $id AND $tipo.codusuario = $codusuario AND $tipo.bloqueado = 0");
		if(mysqli_affected_rows($con) > 0) {
			$resul = mysqli_fetch_assoc($consul);
			$nwstatus = ($resul['oculto'] == 0) ? 1 : 0;
			mysqli_query($con, "UPDATE $tipo SET $tipo.oculto = $nwstatus WHERE $tipo.id$tipo = $id");
			if(mysqli_affected_rows($con) > 0) {
				mysqli_close($con);
				return $nwstatus;
			}
		}
		mysqli_close($con);
	}
	return $resul['oculto'];
}

function excluir($tipo, $dados){
	if(isset($dados['id']) && is_numeric($dados['id'])) {
		$con = bdcon();
		$id = $dados['id'];
		$codusuario = $_SESSION['codusuario'];
		$consul = mysqli_fetch_assoc(mysqli_query($con, "SELECT $tipo.imagem FROM $tipo WHERE $tipo.id$tipo = $id AND $tipo.codusuario = $codusuario AND $tipo.bloqueado = 0"));
		if(mysqli_affected_rows($con) > 0) {
			mysqli_query($con, "DELETE FROM $tipo WHERE $tipo.id$tipo = $id");
			if(mysqli_affected_rows($con) > 0) {
				if($consul['imagem'] != 'imagem.svg') {
					unlink("../img/$tipo/".$consul['imagem']);
				}
				mysqli_query($con, "UPDATE usuario SET usuario.qtdanuncios = usuario.qtdanuncios-1 WHERE codusuario = ".$_SESSION['codusuario']);
				$_SESSION['qtdanuncios']--;
				mysqli_close($con);
				return 1;
			}
		}
		mysqli_close($con);
	}
}
?>