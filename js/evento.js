///////////////////////////////////////////////
/* BOTÕES DESTINADOS AOS CONTROLES DIVERSOS */
// Botão de submissão do formulário de cadastro de novos eventos
$("#btn-sbt-frm-cad").on("click", function() {
	if($("#inputImagem").val() == "") alert("É obrigatório enviar a imagem do cartaz.");
	else if($("#inputUf").val() == "") alert("Selecione um Estado.");
	else if($("#inputCidade").val() == "") alert("Selecione uma cidade.");
	else if($("#inputEnd").val() == "") alert("Informe o endereço do imóvel.");
	else if($("#inputBairro").val() == "") alert("Informe o bairro do imóvel.");
	else if($("#inputData").val() == "") alert("Data inválida.");
	else if($("#inputHorario").val() == "") alert("Horário inválido.");
	else if($("#inputValor").val() == "") alert("Informe o valor para participar do evento.");
	else $("#form-cadastro").submit();
});