<?php
// FORMULÁRIO DE CADASTRO DE IMÓVEL
$con = bdcon();
$vars = new _model;
echo("
<div class='row blackboard'>
	<div class='col-md-8 col-md-offset-2'>
		<form class='form-horizontal' id='form-cadastro' method='POST' action='$imovel_path/' enctype='multipart/form-data'>
			<div class='panel panel-default'>
				<div class='panel-heading'>FORMULÁRIO DE CADASTRO DE NOVOS IMÓVEIS</div>
				<div class='panel-body'>
					<input type='hidden' name='ordem' value='registrar' required>
					<input type='hidden' name='tipo' value='novo' required>
					<div class='form-group'>
						<label for='inputTrnas' class='col-md-2 control-label'>Transação</label>
						<div class='col-md-4'>
							<select class='form-control' id='inputTrans' name='transacao' required>");
							$transacao = $vars->opcoes('transacao');
							asort($transacao);
							foreach($transacao as $i => $item) {
								echo "<option value='".$i."'>".$item."</option>";
							}
							echo("
							</select>
						</div>
						<label for='inputTipo' class='col-md-2 control-label'>Imovel</label>
						<div class='col-md-4'>
							<select class='form-control' id='inputTipo' name='tpimovel' required>");
							$imovel = $vars->opcoes('imovel');
							asort($imovel);
							foreach($imovel as $i => $item) {
								echo "<option value='".$i."'>".$item."</option>";
							}
							echo("
							</select>
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
						<label for='inputEnd' class='col-md-2 control-label'>Endereço</label>
						<div class='col-md-10'>
							<input type='text' class='form-control' id='inputEnd' name='endereco' maxlength='90' placeholder='Ex.: Rua de exemplo, 1000' required>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputBairro' class='col-md-2 control-label'>Bairro</label>
						<div class='col-md-4'>
							<input type='text' class='form-control' id='inputBairro' name='bairro' maxlength='45' required>
						</div>
						<label for='inputComp' class='col-md-2 control-label'>Complemento</label>
						<div class='col-md-4'>
							<input type='text' class='form-control' id='inputComp' name='complemento' maxlength='45' placeholder='Item opcional.'>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputAreattl' class='col-md-2 control-label'>Área total</label>
						<div class='col-md-2'>
							<input type='tel' class='form-control' id='inputAreattl' name='areattl' maxlength='10' required>
						</div>
						<div class='col-md-2'>
							<select class='form-control' id='inputTipoareattl' name='tpareattl' required>");
							$medida = $vars->opcoes('medida');
							for($i = 1; isset($medida[$i]); $i++) {
								echo "<option value='".$i."'>".$medida[$i]."</option>";
							}
							echo("
							</select>
						</div>
						<label for='inputValor' class='col-md-2 control-label'>Valor</label>
						<div class='col-md-2'>
							<input type='text' class='form-control' id='inputValor' name='valor' maxlength='10' required>
						</div>
					</div>
				</div>
				<div class='panel-heading'>ITENS OPCIONAIS</div>
				<div class='panel-body'>
					<div class='form-group'>
						<label for='inputImagem' class='col-md-2 control-label'>Imagem</label>
						<div class='col-md-10'>
							<input type='file' class='form-control' id='inputImagem' name='imagem' accept='image/*'>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputAreacon' class='col-md-3 control-label'>Área Construída</label>
						<div class='col-md-2'>
							<input type='tel' class='form-control' id='inputAreacon' name='areacon' maxlength='10'>
						</div>
						<div class='col-md-2'>
							<select class='form-control' id='inputTipoareacon' name='tpareacon'>");
							$medida = $vars->opcoes('medida');
							for($i = 1; isset($medida[$i]); $i++) {
								echo "<option value='".$i."'>".$medida[$i]."</option>";
							}
							echo("
							</select>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputComodos' class='col-md-2 col-md-offset-1 control-label'>Comodos</label>
						<div class='col-md-2'>
							<input type='tel' class='form-control' id='inputComodos' name='comodos' maxlength='3'>
						</div>
						<label for='inputQuartos' class='col-md-1 control-label'>Quartos</label>
						<div class='col-md-2'>
							<input type='tel' class='form-control' id='inputQuartos' name='quartos' maxlength='3'>
						</div>
						<label for='inputSuites' class='col-md-1 control-label'>Suites</label>
						<div class='col-md-2'>
							<input type='tel' class='form-control' id='inputSuites' name='suites' maxlength='3'>
						</div>
					</div>
					<div class='form-group'>
						<div class='col-md-3 col-md-offset-1'>
							<div class='input-group'>
								<span class='input-group-addon'>
									<input type='checkbox' id='inputGaragem' name='garagem'>
								</span>
								<label for='inputGaragem' class='form-control'>Possui Garagem</label>
							</div>
						</div>
						<div class='col-md-4'>
							<div class='input-group'>
								<span class='input-group-addon'>
									<input type='checkbox' id='inputSeguranca' name='seguranca'>
								</span>
								<label for='inputSeguranca' class='form-control'>Sistema de Segurança</label>
							</div>
						</div>
						<div class='col-md-3'>
							<div class='input-group'>
								<span class='input-group-addon'>
									<input type='checkbox' id='inputEscritura' name='escritura'>
								</span>
								<label for='inputEscritura' class='form-control'>Escriturada</label>
							</div>
						</div>
					</div>
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
							<a class='btn btn-default' href='$home_imovel_path'>Cancelar</a>
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