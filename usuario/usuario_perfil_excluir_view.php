<?php
// FORMULÁRIO DE CONFIRMAÇÃO DA EXCLUSÃO DA CONTA DO USUÁRIO
echo("
<div class='row blackboard'>
	<div class='col-md-8 col-md-offset-2'>
		<div class='alert alert-warning alert-dismissible' role='atenção'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Fechar'><span aria-hidden='true'>&times;</span></button>
			<strong>Se ligue!</strong> Todas as suas publicações continuarão nos nossos registros.
		</div>		
		<div class='panel panel-default'>
			<div class='panel-heading'>FORMULÁRIO DE CONFIRMAÇÃO DE EXCLUSÃO</div>
			<div class='panel-body'>
				<form id='form-exclusao-usuario' method='POST' action='$usuario_path/'>
					<input type='hidden' name='ordem' value='excluir' required>
					<div class='form-group'>
						<label for='inputPin' class='control-label'>Para apagar sua conta é necessário informar seu PIN</label>
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