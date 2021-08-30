<?php
// EXIBE AS PUBLICAÇÕES DO USUÁRIO
$con = bdcon();
$id = $_SESSION['codusuario'];
$tabelas = array('eletronico', 'evento', 'imovel', 'outros', 'servico');
echo ("<div class='row blackboard'>
	<div class='col-md-10 col-md-offset-1'>
		<div class='panel-group' id='pain-accordion'>");
foreach ($tabelas as $tabela) {
	
	switch ($tabela) {
		case 'eletronico':
		case 'imovel':
			$addon = 'tipo';
			break;

		case 'evento':
			$addon = 'titulo';
			break;

		case 'servico':
			$addon = 'servico';
			break;
	}

	$query = "SELECT $tabela.id$tabela, $tabela.$addon, $tabela.visitas, $tabela.oculto, $tabela.bloqueado FROM $tabela WHERE $tabela.codusuario = $id";
	$consul = mysqli_query($con, $query);
	$qtd = mysqli_affected_rows($con);

			echo ("<div class='panel panel-primary'>
				<div class='panel-heading'><h4 class='panel-title'><a data-toggle='collapse' data-parent='#pain-accordion' href='#pain-$tabela'>".strtoupper($tabela)." <span class='badge'>$qtd</span></a></h4></div>
				<div id='pain-$tabela' class='panel-collapse collapse'>
					<div class='panel-body'>
						<table class='table table-colapsed'>
							<tr><th width='20%'>#ID</th><th width='70%'>DETALHES</th><th width='10%'>CONTROLES</th></tr>");
							while($row = mysqli_fetch_row($consul)) {
								echo("<tr id='pub-$tabela-".$row[0]."'>
									<td>".$row[0]."</td>
									<td>".$row[1]." [visto ".$row[2]." vezes]</td>
									<td>");
								if($row[4] == 1) echo("<button class='btn btn-default' title='Publicação bloqueada' disabled><span class='glyphicon glyphicon-lock'></span></button> ");
								else {
									if($row[3] == 0) echo("<button id='ex-$tabela-".$row[0]."' class='btn btn-success' title='Ocutar publicação' onclick=\"exibicao('$tabela', ".$row[0].")\"><span class='glyphicon glyphicon-eye-open'></span></button> ");
									else echo("<button id='ex-$tabela-".$row[0]."' class='btn btn-default' title='Exibir publicação' onclick=\"exibicao('$tabela', ".$row[0].")\"><span class='glyphicon glyphicon-eye-close'></span></button> ");
									echo("<button class='btn btn-danger' title='Excluir publicação' onclick=\"excluir('$tabela', ".$row[0].")\"><span class='glyphicon glyphicon-remove'></span></button>");
								}
								echo("</td>
								</tr>");
							}
						echo("</table>
					</div>
				</div>
			</div>");
}
		echo("</div>
	</div>
</div>");

mysqli_close($con);
?>