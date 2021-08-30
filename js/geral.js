///////////////////////////////////////////////
/* FUNÇÕES DESTINADAS AO CONTROLES DIVERSOS */
// Função de trabalhando...
function working_here() {
	alert('Estamos trabalhando aqui.\nEm breve estará disponível.');
}

// Chama o modal
function chama_modal(id){
	$('#modal-content').load(id+'_index.php', function() { $('#modal-display').modal('show'); });
}

/* BOTÕES DESTINADOS AOS CONTROLES DIVERSOS */
// Seleção de estados e cidades
$("#inputUf").on("change", function() {
	$("#inputCidade").html("<option>CARREGANDO...</option>");
	$.post("index.php", { ordem: "listar", tipo: "cidades", ufid: $("#inputUf").val() }, function(result) {
		$("#inputCidade").html(result);
	});
});

// Botão de submissão do formulário entrar
$("#btn-sbt-frm-ent").on("click", function() {
	if($("#inputEntTel").val() == "") alert("Preencha o campo Telefone.");
	else if($("#inputEntSenha").val() == "") alert("Preencha o campo Senha.");
	else {
		$("#form-entrar").append("<input type='hidden' name='url-atual' value='"+location.href+"' />");
		$("#form-entrar").submit();
	}
});

// Botão de carregamento de mais eletrônicos
var pagina = 1
$("#btn-busca-mais").on("click", function() {
	$("#divbuscarmais").hide();
	var uri = $(location).attr('search');
	$.get("index.php"+uri, {ordem: 'listar', pagina: pagina}, function(result) {
		$("#divdisplay").append(result);
		if(result != "") {
			$("#divbuscarmais").show();
			pagina++;
		} else alert("Isso é tudo.");
	});
});
