<?php
// FORMULÁRIO PARA NOVO NOME
function nome(){
	return ("
		<div class='modal-header'>
			<h4>EDITAR >> NOVO NOME</h4>
		</div>
		<div class='modal-body'>
			<div class='form-group'>
				<label class='control-label'>Digite o novo nome</label>
				<input type='text' class='form-control input-sm' id='nome' placeholder='Digite o novo nome' maxlength='45' />
			</div>
			<div class='form-group'>
				<label class='control-label'>Digite sua senha atual</label>
				<div class='input-group'>
					<input type='password' class='form-control input-sm' id='senha' placeholder='Digite sua senha atual' maxlength='16' />
					<span class='input-group-btn'>
						<button class='btn btn-primary input-sm' title='Salvar' onclick=\"save_input_usuario('nome', '')\"><span class='glyphicon glyphicon-save'></span></button>
						<button type='cancel' class='btn btn-warning input-sm' title='Cancelar' onclick=\"cancel_edit_usuario('nome')\"><span class='glyphicon glyphicon-erase'></span></button>
					</span>
				</div>
			</div>
			<input type='password' hidden />
		</div>
	");
}
// FORMULÁRIO PARA NOVO TELEFONE
function telefone() {
	return ("
		<div class='modal-header'>
			<h4>EDITAR >> NOVO TELEFONE</h4>
		</div>
		<div class='modal-body'>
			<div class='form-group'>
				<label class='control-label'>Digite o novo telefone</label>
				<input type='tel' class='form-control input-sm' id='telefone' placeholder='Digite o novo telefone' maxlength='11' />
			</div>
			<div class='form-group'>
				<label class='control-label'>Digite sua senha atual</label>
				<div class='input-group'>
					<input type='password' class='form-control input-sm' id='senha' placeholder='Digite sua senha atual' maxlength='16' />
					<span class='input-group-btn'>
						<button class='btn btn-primary input-sm' title='Salvar' onclick=\"save_input_usuario('telefone', '')\"><span class='glyphicon glyphicon-save'></span></button>
						<button type='cancel' class='btn btn-warning input-sm' title='Cancelar' onclick=\"cancel_edit_usuario('telefone')\"><span class='glyphicon glyphicon-erase'></span></button>
					</span>
				</div>
			</div>
			<input type='password' hidden />
		</div>
	");
}
// FORMULÁRIO PARA NOVA SENHA
function nsenha() {
	return ("
		<div class='modal-header'>
			<h4>EDITAR >> NOVA SENHA</h4>
		</div>
		<div class='modal-body'>
			<div class='form-group'>
				<label class='control-label'>Digite a nova senha</label>
				<input type='password' class='form-control input-sm' id='nsenha' placeholder='Digite a nova senha' maxlength='16' />
			</div>
			<div class='form-group'>
				<label class='control-label'>Repita a nova senha</label>
				<input type='password' class='form-control input-sm' id='nsenha2' placeholder='Repita a nova senha' maxlength='16' />
			</div>
			<div class='form-group'>
				<label class='control-label'>Digite sua senha atual</label>
				<div class='input-group'>
					<input type='password' class='form-control input-sm' id='senha' placeholder='Digite sua senha atual' maxlength='16' />
					<span class='input-group-btn'>
						<button class='btn btn-primary input-sm' title='Salvar' onclick=\"save_input_usuario('nsenha', 'nsenha2')\"><span class='glyphicon glyphicon-save'></span></button>
						<button type='cancel' class='btn btn-warning input-sm' title='Cancelar' onclick=\"cancel_edit_usuario('senha')\"><span class='glyphicon glyphicon-erase'></span></button>
					</span>
				</div>
			</div>
			<input type='password' hidden />
		</div>
	");
}
// FORMULÁRIO DE CONFIRMAÇÃO DA EXCLUSÃO DA CONTA DO USUÁRIO
function form_confirma_exclusao(){
	echo("
	<div class='row blackboard'>
		<div class='col-md-8 col-md-offset-2'>
			<div class='alert alert-warning alert-dismissible' role='atenção'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Fechar'><span aria-hidden='true'>&times;</span></button>
				<strong>Se ligue!</strong> Todas as suas publicações serão excluídas dos nossos registros.
			</div>		
			<div class='panel panel-default'>
				<div class='panel-heading'>FORMULÁRIO DE CONFIRMAÇÃO DE EXCLUSÃO</div>
				<div class='panel-body'>
					<form id='form-exclusao-usuario' method='POST' action='/'>
						<input type='hidden' name='ordem' value='excluir' required>
						<input type='hidden' name='tipo' value='conta' required>
						<div class='form-group'>
							<label for='inputSenha' class='control-label'>Confirme sua senha atual</label>
							<input type='password' class='form-control' id='inputSenha' name='senha' maxlength='16' required>
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
}
?>