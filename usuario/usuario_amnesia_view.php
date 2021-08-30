<?php
// FORMULÁRIO DE RECUPERAÇÃO DE SENHA
echo("
<div class='row blackboard'>
	<div class='col-md-8 col-md-offset-2'>
		<div class='panel panel-default'>
			<div class='panel-heading'>FORMULÁRIO DE RECUPERAÇÃO DE SENHA</div>
			<div class='panel-body'>
				<form id='form-amnesia' method='POST' action='$usuario_path/'>
					<input type='hidden' name='ordem' value='amnesia' required>
					<div class='form-group'>
						<label for='inputTel' class='control-label'>Informe seu número de telefone</label>
						<input type='tel' class='form-control' id='inputTel' name='telefone' maxlength='11' required>
						<label for='inputPin' class='control-label'>Informe seu PIN</label>
						<input type='password' class='form-control' id='inputPin' name='pin' maxlength='6' required>
					</div>
					<div class='form-group'>
						<div class='col-md-2 col-md-offset-5'>
							<input type='submit' class='btn btn-primary' value='Enviar'>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
");
?>