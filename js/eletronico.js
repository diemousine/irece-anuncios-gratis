///////////////////////////////////////////////
/* BOTÕES DESTINADOS AOS CONTROLES DIVERSOS */
// Botão de submissão do formulário de cadastro de novos eletrônicos
$("#btn-sbt-frm-cad").on("click", function() {
	if($("#inputImagem").val() == "") alert("É obrigatório enviar a imagem do produto.");
	else if($("#inputTrans").val() == "") alert("Selecione um tipo de transação.");
	else if($("#inputTipo").val() == "") alert("Infrome o tipo de produto.");
	else if($("#inputUf").val() == "") alert("Selecione um Estado.");
	else if($("#inputCidade").val() == "") alert("Selecione uma cidade.");
	else if($("#inputValor").val() == "") alert("Informe o valor do produto.");
	else $("#form-cadastro").submit();
});