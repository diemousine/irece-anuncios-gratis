///////////////////////////////////////////////
/* BOTÕES DESTINADOS AOS CONTROLES DIVERSOS */
// Botão de submissão do formulário de cadastro de novos imóveis
$("#btn-sbt-frm-cad").on("click", function() {
	if($("#inputServico").val() == "") alert("Serviço não informado.");
	else if($("#inputAtividades").val() == "") alert("Atividade não informada.");
	else if($("#inputUf").val() == "") alert("Selecione um Estado.");
	else if($("#inputCidade").val() == "") alert("Selecione uma cidade.");
	else if($("#inputValor").val() == "") alert("Informe o valor do serviço.");
	else $("#form-cadastro").submit();
});