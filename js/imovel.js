///////////////////////////////////////////////
/* BOTÕES DESTINADOS AOS CONTROLES DIVERSOS */
// Botão de submissão do formulário de cadastro de novos imóveis
$("#btn-sbt-frm-cad").on("click", function() {
	if($("#inputTrans").val() == "") alert("Selecione um tipo de transação.");
	else if($("#inputTipo").val() == "") alert("Selecione um tipo de imóvel.");
	else if($("#inputUf").val() == "") alert("Selecione um Estado.");
	else if($("#inputCidade").val() == "") alert("Selecione uma cidade.");
	else if($("#inputEnd").val() == "") alert("Informe o endereço do imóvel.");
	else if($("#inputBairro").val() == "") alert("Informe o bairro do imóvel.");
	else if($("#inputAreattl").val() == "") alert("Informe a área total do imóvel.");
	else if($("#inputTipoareattl").val() == "") alert("Informe a medida da área. Se é em m², km², etc.");
	else if($("#inputValor").val() == "") alert("Informe o valor do imóvel.");
	else $("#form-cadastro").submit();
});