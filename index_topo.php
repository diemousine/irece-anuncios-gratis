<?php
echo ("
<!-- TOPO --><div class='row blackboard'>
  <nav class='navbar navbar-default navbar-static-top'>
    <div class='container-fluid'>
      <div class='navbar-header'>
        <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-index-topo' aria-expanded='false'>
          <span class='sr-only'>Alternar navegação</span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
        </button>
        <a class='navbar-brand' href='$home_path'>
          <img src='$home_path/img/logo.png' height='100%'>
        </a>
      </div>
      <div class='collapse navbar-collapse' id='navbar-index-topo'>
        <form id='form-pesquisar' class='navbar-form navbar-nav' role='pesquisar'>
          <div class='form-group'>
            <input type='hidden' name='ordem' value='view'>
            <input type='search' class='form-control' name='entrada' placeholder='O que você está procurando?' size='100'>
          </div>
        </form>
        <ul class='nav navbar-nav navbar-right'>
          <li class='dropdown'>
            <a class='dropdown-toggle none-link' data-toggle='dropdown' role='sessão' aria-haspopup='true' aria-expanded='false'>Ir para <span class='caret'></span></a>
            <ul class='dropdown-menu'>
              <li class='working'><a class='navbar-link none-link' onclick='working_here()'><span class='glyphicon glyphicon-road'></span> Automóveis</a></li>
              <li><a class='navbar-link' href='$home_eletronico_path'><span class='glyphicon glyphicon-phone'></span> Eletrônicos</a></li>
              <li><a class='navbar-link' href='$home_evento_path'><span class='glyphicon glyphicon-music'></span> Eventos</a></li>
              <li><a class='navbar-link' href='$home_imovel_path'><span class='glyphicon glyphicon-home'></span> Imóveis</a></li>
              <li><a class='navbar-link' href='$home_outros_path'><span class='glyphicon glyphicon-bed'></span> Outros produtos</a></li>
              <li><a class='navbar-link' href='$home_servico_path'><span class='glyphicon glyphicon-wrench'></span> Serviços</a></li>
            </ul>
          </li>");
          if($status_session) { // BARRA DE NAVEGAÇÃO PARA USUÁRIOS AUTENTICADOS
            echo("
            <li class='dropdown'>
              <a class='dropdown-toggle none-link' data-toggle='dropdown' role='gerenciar' aria-haspopup='true' aria-expanded='false'>Gerenciar <span class='caret'></span></a>
              <ul class='dropdown-menu'>
                <li><a class='navbar-link' href='$home_painel_path'><span class='glyphicon glyphicon-book'></span> Publicações</a></li>
                <li role='separador' class='divider'></li>
                <li><a class='navbar-link' href='$usuario_path/?ordem=view&tipo=perfil'><span class='glyphicon glyphicon-user'></span> Perfil</a></li>
              </ul>
            </li>");
            if(($_SESSION['qtdanuncios']/$_SESSION['premium']) <= 10) {
              echo("
            <li class='dropdown'>
              <a class='dropdown-toggle none-link' data-toggle='dropdown' role='publicar' aria-haspopup='true' aria-expanded='false'>Publicar <span class='caret'></span></a>
              <ul class='dropdown-menu'>
                <li class='working'><a class='navbar-link none-link' onclick='working_here()'><span class='glyphicon glyphicon-road'></span> Automóvel</a></li>
                <li><a class='navbar-link' href='$eletronico_path/?ordem=view&tipo=novo'><span class='glyphicon glyphicon-phone'></span> Eletrônico</a></li>
                <li><a class='navbar-link' href='$evento_path/?ordem=view&tipo=novo'><span class='glyphicon glyphicon-music'></span> Evento</a></li>
                <li><a class='navbar-link' href='$imovel_path/?ordem=view&tipo=novo'><span class='glyphicon glyphicon-home'></span> Imóvel</a></li>
                <li><a class='navbar-link' href='$outros_path/?ordem=view&tipo=novo'><span class='glyphicon glyphicon-bed'></span> Outro produto</a></li>
                <li><a class='navbar-link' href='$servico_path/?ordem=view&tipo=novo'><span class='glyphicon glyphicon-wrench'></span> Serviço</a></li>
              </ul>
            </li>");
            }
            echo("
            <li>
              <form id='form-sair' class='navbar-form navbar-nav' role='sair' method='POST' action='$usuario_path/'>
                <input type='hidden' name='ordem' value='sair'>
                <input type='submit' class='btn btn-default center-block' form='form-sair' value='Sair'>
              </form>
            </li>
          ");
          } else { // BARRA DE NAVEGAÇÃO PARA VISITANTES
            echo("
            <li class='dropdown'>
              <a class='dropdown-toggle none-link' data-toggle='dropdown' role='entrar' aria-haspopup='true' aria-expanded='false'>Entrar <span class='caret'></span></a>
              <ul class='dropdown-menu'>
                <li>
                  <form id='form-entrar' class='navbar-form navbar-nav' role='dados do usuário' method='POST' action='$usuario_path/'>
                    <div class='form-group'>
                      <input type='hidden' name='ordem' value='entrar'>
                      <input type='tel' id='inputEntTel' class='form-control' name='telefone' placeholder='telefone' maxlength='11'>
                      <input type='password' id='inputEntSenha' class='form-control' name='senha' placeholder='senha' maxlength='16'>
                      <div class='col-md-12'>
                        <input type='button' id='btn-sbt-frm-ent' class='btn btn-default center-block' value='Entrar'>
                      </div>
                    </div>
                  </form>
                </li>
                <li role='separador' class='divider'></li>
                <li><center><a class='none-link' href='$usuario_path/?ordem=view&tipo=amnesia'>Esqueci a senha</a></center></li>
              </ul>
            </li>
            <li><a class='navbar-link' href='$usuario_path/?ordem=view&tipo=usuario-novo'>Registre-se</a></li>
            ");            
          }
          echo("
        </ul>
      </div><!-- navbar-content -->
    </div>
  </nav>
</div><!-- FIM TOPO -->
");
?>