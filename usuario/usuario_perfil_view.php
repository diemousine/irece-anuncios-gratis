<?php
// FORMULÁRIO DE EXIBIÇÃO DE PERFIL DO USUÁRIO
$con = bdcon();
$idusuario = $_SESSION['idusuario'];
$usuario = mysqli_fetch_assoc(mysqli_query($con, "SELECT usuario.nome, usuario.telefone FROM usuario WHERE usuario.idusuario = $idusuario"));
echo("
<div class='row blackboard'>
	<div class='col-md-8 col-md-offset-2'>
		<div class='panel panel-default'>
			<div class='panel-heading'>PAINEL DO USUÁRIOS</div>
			<div class='panel-body'>
				<div class='form-group'>
					<label for='inputNome' class='col-md-2 control-label'>Nome</label>
					<div class='col-md-10' id='static-nome'>
						<p>".$usuario['nome']." <a class='none-link' onclick=\"edit_usuario('nome')\"><span class='glyphicon glyphicon-edit'></span></a></p>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputTel' class='col-md-2 control-label'>Telefone</label>
					<div class='col-md-10' id='static-telefone'>
						<p>".$usuario['telefone']." <a class='none-link' onclick=\"edit_usuario('telefone')\"><span class='glyphicon glyphicon-edit'></span></a></p>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputSenha' class='col-md-2 control-label'>Senha</label>
					<div class='col-md-10'>
						<p>*************** <a class='none-link' onclick=\"edit_usuario('nsenha')\"><span class='glyphicon glyphicon-edit'></span></a></p>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputConta' class='col-md-2 control-label'>Conta</label>
					<div class='col-md-10'>
						<form id='form-excluir-usuario' method='GET' action='$usuario_path/'>
							<input type='hidden' name='ordem' value='view' />
							<input type='hidden' name='tipo' value='excluir' />
							<a class='none-link' id='btn-excluir-conta'>Excluir Conta</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
");
mysqli_close($con);
?>