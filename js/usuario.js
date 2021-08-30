/////////////////////////////////////////////////
/* FUNÇÕES DESTINADAS AO CONTROLE DE USUÁRIOS */

// Botão de submissão do formulário de cadastro de novos usuários
$("#btn-sbt-frm-cad-us").on("click", function() {
	if($("#inputNome").val() == '') alert('Digite um nome.');
	else if($("#inputTel").val() =='' || $("#inputTel2").val() == '') alert('Digite os números de telefones.');
	else if($("#inputTel").val() != $("#inputTel2").val()) alert("Os números de telefone estão diferentes.");
	else if($("#inputSenha").val() == '' || $("#inputSenha2").val() == '') alert('Digite as senhas.');
	else if($("#inputSenha").val() != $("#inputSenha2").val()) alert("As senhas estão diferentes.");
	else {
		$("#form-cadastro-usuario").append("<input type='hidden' name='url-atual' value='"+location.href+"' />");
		$("#form-cadastro-usuario").submit();
	}
});

// Funções para edição de dados do usuário
function edit_usuario(input) {
	$.post("index.php", {ordem: 'editar', tipo: input}, function(result) {
		$("#modal-content").html(result);
		$("#modal-display").modal('show');
	});
}
function cancel_edit_usuario(input) {
	$("#"+input).val("");
	$("#senha").val("");
	$("#modal-content").html('');
	$("#modal-display").modal('hide');
}
function save_input_usuario(input, input2) {
	valor = $("#"+input).val();
	valor2 = $("#"+input2).val();
	senha = $("#senha").val();
	if(senha != "" && valor != "") {
		if(input == 'nsenha' && valor != valor2) {
			alert("A primeira nova senha está diferente da segunda.");
		} else {
			$.post("index.php", {ordem: 'registrar', tipo: input, valor: valor, senha: senha}, function(result) {
				if(result == 1) {
					cancel_edit_usuario(input);
					$("#static-"+input).html("<p>"+valor+" <a class='none-link' onclick=\"edit_usuario('"+input+"')\"><span class='glyphicon glyphicon-edit'></span></a></p>");
				} else {
					alert(result);
				}
			});
		}
	}
}

// Botão de exclusão de usuário
$("#btn-excluir-conta").on("click", function(){
	var confirmar = confirm("Tem certeza que quer excluir sua conta?");
	if(confirmar) $("#form-excluir-usuario").submit();
});