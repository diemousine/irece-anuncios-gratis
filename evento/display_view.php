<?php
// EXIBE A PÁGINA PRINCIPAL DE VISUALIAÇÃO DE EVENTOS
echo("<div class='row blackboard'>
		<div class='col-md-10 col-md-offset-1' id='divdisplay'>
		<div class='page-header'><h1>Eventos <small>vai ter o que? onde?</small></h1></div>");
if(($publicacoes = _model::publicacoes($dados, 0)) != "") echo($publicacoes."</div>
	</div>
	<div class='row blackboard' id='divbuscarmais'>
		<div class='col-md-10 col-md-offset-1'>
				<input type='button' class='btn btn-info center-block' id='btn-busca-mais' value='Ver se tem mais eventos' />
				<br />
		</div>
	</div>");
else echo ("<div class='row blackboard'>
				<center>
				<div class='col-md-4 col-md-offset-4'>
					<p><img src='$home_path/img/eventos.png' title='Eventos' /></p>
					<div class='alert alert-info' role='alert'><b>Opa.</b> Parece que não tem nada para mostrar aqui no momento.</div>
				</div>
				</center>
			</div>
		</div>
	</div>");
?>