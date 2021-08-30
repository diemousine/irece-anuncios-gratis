//////////////////////////////////////////////////////////////
/* FUNÇÕES DESTINADAS AO PAINEL DE CONTROLE DE PUBLICAÇÕES */

// Função para alternar o modo de exibição das publicações
function exibicao(tipo, id) {
	$.post("index.php", {ordem: 'exibicao', tipo: tipo, id: id}, function(result) {
		if(result == 0) {
			$("#ex-"+tipo+"-"+id).attr('class', 'btn btn-success');
			$("#ex-"+tipo+"-"+id).attr('title', 'Ocultar publicação');
			$("#ex-"+tipo+"-"+id).html("<span class='glyphicon glyphicon-eye-open'></span>")
		} else if(result == 1) {
			$("#ex-"+tipo+"-"+id).attr('class', 'btn btn-default');
			$("#ex-"+tipo+"-"+id).attr('title', 'Exibir publicação');
			$("#ex-"+tipo+"-"+id).html("<span class='glyphicon glyphicon-eye-close'></span>")
		}
	});
}

// Função para excluir uma publicação
function excluir(tipo, id) {
	var x = confirm("Tem certeza que quer apagar esta publicação?");
	if(x == true) {
		$.post("index.php", {ordem: 'excluir', tipo: tipo, id: id}, function(result) {
			if(result == 1) {
				$("#pub-"+tipo+"-"+id).hide('slow');
			} else alert("Aconteceu um erro interno. Tente novamente mais tarde.");
		});
	}
}