<?php
// FORMULÁRIO DE CADASTRO DE OUTROS PRODUTOS
$con = bdcon();
$vars = new _model;
echo("
<div class='row blackboard'>
	<div class='col-md-8 col-md-offset-2'>
		<form class='form-horizontal' id='form-cadastro' method='POST' action='$outros_path/' enctype='multipart/form-data'>
			<div class='panel panel-default'>
				<div class='panel-heading'>FORMULÁRIO DE CADASTRO DE NOVOS PRODUTOS</div>
				<div class='panel-body'>
					<input type='hidden' name='ordem' value='registrar' required>
					<input type='hidden' name='tipo' value='novo' required>
					<div class='form-group'>
						<label for='inputImagem' class='col-md-2 control-label'>Imagem</label>
						<div class='col-md-10'>
							<input type='file' class='form-control' id='inputImagem' name='imagem' accept='image/*' required>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputTrnas' class='col-md-2 control-label'>Transação</label>
						<div class='col-md-3'>
							<select class='form-control' id='inputTrans' name='transacao' required>");
							$transacao = $vars->opcoes('transacao');
							asort($transacao);
							foreach($transacao as $i => $item) {
								echo "<option value='".$i."'>".$item."</option>";
							}
							echo("
							</select>
						</div>
						<label for='inputTipo' class='col-md-2 control-label'>Produto</label>
						<div class='col-md-5'>
							<input type='text' class='form-control' id='inputTipo' name='produto' maxlength='45' placeholder='Ex.: CAMA BOX DE CASAL' required>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputUf' class='col-md-2 control-label'>Estado</label>
						<div class='col-md-2'>								
							<select class='form-control' id='inputUf' name='uf' required>
								<option value=''>CLIQUE</option>");
							$uf = mysqli_query($con, "SELECT estado.id, estado.uf FROM estado");
							while ($row = mysqli_fetch_row($uf)) {
								echo "<option value='".$row[0]."'>".$row[1]."</option>";
							}
							echo("
							</select>
						</div>
						<label for='inputCidade' class='col-md-2 control-label'>Cidade</label>
						<div class='col-md-6'>
							<select class='form-control' id='inputCidade' name='cidade' required>
								<option value=''>SELECIONE UM ESTADO</option>
							</select>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputValor' class='col-md-2 control-label'>Valor</label>
						<div class='col-md-3'>
							<input type='text' class='form-control' id='inputValor' name='valor' maxlength='10' required>
						</div>
					</div>
				</div>
				<div class='panel-heading'>ITENS OPCIONAIS</div>
				<div class='panel-body'>
					<div class='form-group'>
						<label for='inputObs' class='col-md-2 control-label'>Mais detalhes</label>
						<div class='col-md-10'>
							<textarea class='form-control' id='inputObs' name='obs' maxlength='255' rows='4' placeholder='Aproveite este espaço para dar mais informações para quem visualizar sua publicação. Máx.: 255 caracteres.'></textarea>
						</div>
					</div>
					<div class='form-group'>
						<div class='col-md-2 col-md-offset-4'>
							<input type='button' id='btn-sbt-frm-cad' class='btn btn-primary' value='Enviar tudo'>
						</div>
						<div class='col-md-2'>
							<a class='btn btn-default' href='$home_outros_path'>Cancelar</a>
						</div>
					</div>
				</div>				
			</div>
		</form>
	</div>
</div>
");
mysqli_close($con);
?>