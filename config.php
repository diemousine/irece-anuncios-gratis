<?php
/* VARIÁVEIS PSEUDO-GLOBAIS */
$home_path = '/ircan';
//$home_path = 'http://'.$_SERVER['HTTP_HOST'];
$help_path = "$home_path/ajuda";
$usuario_path = "$home_path/usuario";
$eletronico_path = "$home_path/eletronico";
$home_eletronico_path = "$eletronico_path/?ordem=view";
$evento_path = "$home_path/evento";
$home_evento_path = "$evento_path/?ordem=view";
$imovel_path = "$home_path/imovel";
$home_imovel_path = "$imovel_path/?ordem=view";
$outros_path = "$home_path/outros";
$home_outros_path = "$outros_path/?ordem=view";
$painel_path = "$home_path/painel";
$home_painel_path = "$painel_path/?ordem=view";
$servico_path = "$home_path/servico";
$home_servico_path = "$servico_path/?ordem=view";

/* OUTRAS CONFIGURAÇÕES */
date_default_timezone_set('America/Bahia');

/* FUNÇÕES MAIS COMUNS */

// CONEXÃO AO BANCO DE DADOS
function bdcon() {
	$con = mysqli_connect('localhost','root','admin2','tnns') or die('Servidor de Banco de Dados não respondeu.');
/*	if($_SERVER['HTTP_HOST'] == 'ireceanuncios.byethost15.com' || $_SERVER['HTTP_HOST'] == 'www.ireceanuncios.byethost15.com') {
		$con = mysqli_connect('sql203.byethost15.com','b15_18323901','Diebyet.0','b15_18323901_bdirc') or die('Servidor de Banco de Dados não respondeu.');
	} else { die('Solicitação de origem não confiável.'); }
*/	mysqli_set_charset($con,'utf8');
	return $con;
}

// RESTAURA A SESSÃO ATIVA
function chama_sessao() {
	if(isset($_COOKIE['PHPSESSID'])) { 
		session_id($_COOKIE['PHPSESSID']);
		session_start();
		$con = bdcon();
		$consul = mysqli_fetch_assoc(mysqli_query($con, "SELECT usuario.bloqueado FROM usuario WHERE usuario.codusuario = ".$_SESSION['codusuario']));
		if($consul['bloqueado']) {
			setcookie("PHPSESSID", "", strtotime("-1 hour"), '/');
			echo "<script>alert('Sua conta foi bloqueada');</script>";
			return 0;
		}
		if(isset($_SESSION['cliente']) && $_SESSION['cliente'] != $_SERVER['REMOTE_ADDR'] || !isset($_SESSION['ativo'])) {
			setcookie("PHPSESSID", "", strtotime("-1 hour"), '/');
			return 0;
		}
		return 1;
	} else return 0;
}

/* MASCARAS */

// TELEFONE
function maskTel($x) {
  	if(strlen($x)==10) {
       	return("(".substr($x,0,2).") ".substr($x,2,4)."-".substr($x,6,4));
	} else if(strlen($x)==11) {
       	return("(".substr($x,0,2).") <u>".substr($x,2,1)."</u>".substr($x,3,4)."-".substr($x,7,4));
	}
}

?>