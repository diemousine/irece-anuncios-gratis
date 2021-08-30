<?php
class MODEL {
	// OPÇÕES
	public function opcoes($x) {}

	// REGISTRO DE SERVIÇOS NO BANCO DE DADOS
	public static function registrar($dados, $img) {}

	// LISTA OS SERVIÇOS DE ACORDO COM OS DADOS PASSADOS
	protected static function listar($tabela, $dados, $pagina, $where=null) {
		$con = bdcon();
		$pagina = $pagina*4;

		$query = "SELECT * FROM $tabela WHERE ";

		if(isset($dados['entrada'])) {
			$entrada = mysqli_real_escape_string($con, trim(filter_var($dados['entrada'], 513)));
			$s = array('de', 'para', 'em', 'no', 'na', 'com', '&');
			$entrada = str_replace($s, "", $entrada);
			$entrada = explode(' ', $entrada);
			foreach ($entrada as $value) {
				$query .= "$tabela.keywords LIKE '%$value%' AND ";
			}
		}
		if($where!=null) $query .= $where;
		else $query .= "$tabela.oculto = 0 AND $tabela.bloqueado = 0 ORDER BY $tabela.cod$tabela DESC LIMIT 4 OFFSET $pagina";
		$consul = mysqli_query($con, $query);
		mysqli_close($con);
		return $consul;
	}
}
?>