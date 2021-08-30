<?php
echo("<script src='https://www.google.com/recaptcha/api.js'></script>
<div class='row blackboard'>
	<div class='col-md-8 col-md-offset-2'>
		<div class='alert alert-warning alert-dismissible' role='atenção'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Fechar'><span aria-hidden='true'>&times;</span></button>
			<center><b>Se ligue!</b></center><br />
				<p>Seu nome e telefone aparecerão automaticamente nas suas publicações como sendo a pessoa e o número para contato.</p>
		</div>		
		<div class='panel panel-default'>
			<div class='panel-heading'>FORMULÁRIO DE CADASTRO DE NOVOS USUÁRIOS</div>
			<div class='panel-body'>
				<form class='form-horizontal' id='form-cadastro-usuario' method='POST' action='$usuario_path/'>
					<input type='hidden' name='ordem' value='registrar' required>
					<input type='hidden' name='tipo' value='usuario-novo' required>
					<div class='form-group'>
						<label for='inputNome' class='col-md-2 control-label'>Nome</label>
						<div class='col-md-9'>
							<input type='text' class='form-control' id='inputNome' name='nome' maxlength='45' placeholder='Qual seu nome?' required>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputTel' class='col-md-2 control-label'>Telefone</label>
						<div class='col-md-3'>
							<input type='tel' class='form-control' id='inputTel' name='telefone' maxlength='11' required>
						</div>
						<label for='inputTel2' class='col-md-3 control-label'>Repetir Telefone</label>
						<div class='col-md-3'>
							<input type='tel' class='form-control' id='inputTel2' name='telefone2' maxlength='11' required>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputSenha' class='col-md-2 control-label'>Senha</label>
						<div class='col-md-3'>
							<input type='password' class='form-control' id='inputSenha' name='senha' maxlength='16' required>
						</div>
						<label for='inputSenha2' class='col-md-3 control-label'>Repetir Senha</label>
						<div class='col-md-3'>
							<input type='password' class='form-control' id='inputSenha2' name='senha2' maxlength='16' required>
						</div>
					</div>
					<div class='form-group'>
						<center><div class='g-recaptcha' data-sitekey='6LfjzB8TAAAAAGLcWQoKS7q3ttcFlxIbceqq1Osd'></div></center>
					</div>
					<div class='form-group'>
						<div class='col-md-2 col-md-offset-5'>
							<input type='button' id='btn-sbt-frm-cad-us' class='btn btn-primary' value='Enviar'>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>");
?>