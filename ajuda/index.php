<?php
require_once '../config.php';
echo("
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'><span aria-hidden='true'>&times;</span></button>
		<h4>BASE DE CONHECIMENTO</h4>
	</div>
	<div class='modal-body'>
		<div class='row'>
			<div class='col-md-12'>
				<div class='panel-group' id='accordion'>
				  <div class='panel panel-default'>
				    <div class='panel-heading'>
				      <h4 class='panel-title'>
				        <a data-toggle='collapse' data-parent='#accordion' href='#collapse0'>
				        Barra de navegação - visitante</a>
				      </h4>
				    </div>
				    <div id='collapse0' class='panel-collapse collapse'>
				      <div class='panel-body'>
				      	<p style='text-align:justify'><b>Logo</b> - Ao clicar na logo em qualquer momento, a navegação é redirecionada para a página inicial do site.</p>
				      	<p style='text-align:justify'><b>Pesquisar</b> - Esta barra só aparece depois que o usuário escolhe uma das opções na página inicial. O usuário deve digitar o que ele busca no site e depois pressionar a tecla \"Enter\" (no celular, pressionar a tecla \"lupa\" ou \"lente de almento\", como muitos conhecem).</p>
				      	<p style='text-align:justify'><b>Ir para</b> - Permite navegar entre as várias sessões do site.</p>
				      	<p style='text-align:justify'><b>Entrar</b> - Esta opção permite que usuários já registrados possam usar suas credenciais para acessar as opções de publicação.<br />
				      	A primeira caixa de texto pede o número do telefone, que deve ser digitado da mesma forma que o usuário cadastrou no momento do registro.<br />
				      	A segunda caixa de texto pede a senha, que deve ser digitada da mesma fora que o usuário cadastrou no momento do registro.<br />
				      	Após preencer as duas opções, o usuário deve clicar no botão \"Entrar\" (só pressionar a tecla \"Enter\" não vai funcionar)</p>
				      	<p style='text-align:justify'><b>Registre-se</b> - Leva o usuário para o formulário de cadastro de novo usuário.</p>
				      </div>
				    </div>
				  </div>
				  <div class='panel panel-default'>
				    <div class='panel-heading'>
				      <h4 class='panel-title'>
				        <a data-toggle='collapse' data-parent='#accordion' href='#collapse1'>
				        Barra de navegação - usuário</a>
				      </h4>
				    </div>
				    <div id='collapse1' class='panel-collapse collapse'>
				      <div class='panel-body'>
				      	<p style='text-align:justify'><b>Logo</b> - Ao clicar na logo em qualquer momento, a navegação é redirecionada para a página inicial do site.</p>
				      	<p style='text-align:justify'><b>Pesquisar</b> - Esta barra só aparece depois que o usuário escolhe uma das opções na página inicial. O usuário deve digitar o que ele busca no site e depois pressionar a tecla \"Enter\" (no celular, pressionar a tecla \"lupa\" ou \"lente de almento\", como muitos conhecem).</p>
				      	<p style='text-align:justify'><b>Ir para</b> - Permite navegar entre as várias sessões do site.</p>
				      	<p style='text-align:justify'><b>Gerenciar >> Publicações</b> - Leva o usuário até a página onde é possível gerenciar suas publicações. Lá poderá ocultar, exibir, ou excluir publicações.</p>
				      	<p style='text-align:justify'><b>Gerenciar >> Perfil</b> - Leva o usuário para a página de perfil do usuário. Lá poderá mudar suas informações ou até mesmo excluir sua conta.</p>
				      	<p style='text-align:justify'><b>Publicar</b> - Permite publicar novos anúncios no site.</p>
				      	<p style='text-align:justify'><b>Sair</b> - Ao cliar neste botão o usuário desregistra suas credenciais do site, deixando livre para que outros usuários possam acessar.</p>
				      </div>
				    </div>
				  </div>
				  <div class='panel panel-default'>
				    <div class='panel-heading'>
				      <h4 class='panel-title'>
				        <a data-toggle='collapse' data-parent='#accordion' href='#collapse2'>
				        Página de cadastro de novos usuários</a>
				      </h4>
				    </div>
				    <div id='collapse2' class='panel-collapse collapse'>
				      <div class='panel-body'>
				      	<p style='text-align:justify'><b>Nome</b> - Digite seu nome completo ou apelido. O nome digitado nesta caixa de texto será exibido automáticamente em suas publicações, referindo a você como possível contato para aquilo que estiver divulgando.</p>
				      	<p style='text-align:justify'><b>Data de nascimento</b> - Digite sua data de nascimento. Esta informação somente será usada em dois casos: 1. Quando o usuário precisar recuperar a senha, em caso de esquecimento. 2. Quando existirem publicações proibidas para menos de 16 anos. <b>Nota</b>: <em>O sistema recusa cadastro de menores de 16 anos automáticamente</em></p>
				      	<p style='text-align:justify'><b>Telefone</b> - Esta é a informação principal que você deve fornecer, para poder ter acesso às funções principais. Sem o número de telefone, o usuário não pode entrar na parte destinada a gerenciar publicações. <b>Nota</b>: <em>o número de telefone pode ser trocado posteriormente, mas todas as suas publicações irão mudar também. Assim sendo, o número do telefone é único e não pode haver dois usuários cadastrados com o mesmo número</em>.<br />
				      	O número, neste momento deve ser digitado todo junto, com o DDD sem o 0, sem traços ou barras. Ex.: 74123456789</p>
				      	<p style='text-align:justify'><b>Senha</b> - Pode ter até 16 caracteres alfanuméricos, ou seja: letras e números. Uma vez esquecida, poderá ser recuperada através da página recuperação de senha.</p>
				      	<p style='text-align:justify'><b>Recaptcha</b> - Esta função garante que você não tem a intenção de usar conhecimentos avançados de informática para prejudicar o site. Clique no quadrado e espere aparecer um \"V\" verde, antes de clicar no botão \"Enviar\".</p>
				      	<p style='text-align:justify'><b>Obs.</b>: <em>Para cancelar o cadastro, basta clicar na logo do Irecê Anúncios no canto superior esquerdo do site</em>.</p>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div class='modal-footer'>
		<button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
	</div>
	");
?>