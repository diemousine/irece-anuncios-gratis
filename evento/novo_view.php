<?php
// FORMULÁRIO DE CADASTRO DE EVENTO
$con = bdcon();	
echo("
<div class='row blackboard'>
	<div class='col-md-8 col-md-offset-2'>
		<form class='form-horizontal' id='form-cadastro' method='POST' action='$evento_path/' enctype='multipart/form-data'>
			<div class='panel panel-default'>
				<div class='panel-heading'>FORMULÁRIO DE CADASTRO DE NOVOS EVENTOS</div>
				<div class='panel-body'>
					<input type='hidden' name='ordem' value='registrar' required>
					<input type='hidden' name='tipo' value='novo' required>
					<div class='form-group'>
						<label for='inputTitulo' class='col-md-2 control-label'>Titulo</label>
						<div class='col-md-10'>
							<input type='text' class='form-control' id='inputTitulo' name='titulo' maxlength='45' required>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputImagem' class='col-md-2 control-label'>Cartaz</label>
						<div class='col-md-10'>
							<input type='file' class='form-control' id='inputImagem' name='imagem' accept='image/*' required>
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
						<label for='inputEnd' class='col-md-2 control-label'>Local</label>
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
						<label for='inputData' class='col-md-2 control-label'>Data</label>
						<div class='col-md-3'>
							<input type='date' class='form-control' id='inputData' name='data' min='".date('Y-m-d', strtotime('today'))."' max='".date('Y-m-d', strtotime('+5 years'))."' required>
						</div>
						<label for='inputHorario' class='col-md-1 control-label'>Horário</label>
						<div class='col-md-2'>
							<input type='time' class='form-control' id='inputHorario' name='horario' required>
						</div>
						<label for='inputValor' class='col-md-1 control-label'>Valor</label>
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
							<a class='btn btn-default' href='$home_evento_path'>Cancelar</a>
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