<?php
      echo("<!-- RODAPÉ --><div class='row'>
        <div class='col-md-10 col-md-offset-1 text-center'>
          <table class='table table-condensed'>
            <tr>
              <td><a class='none-link' title='sobre o site' onclick=\"javascript: $('#modal-content').load('$home_path/index_sobre.php'); $('#modal-display').modal('show');\">Sobre o site</a></td>
              <td><a class='none-link' title='sobre o autor' href='https://br.linkedin.com/in/diegosocrates' target='_blank'>Sobre o autor</a></td>
              <td><a class='none-link' title='base de dados' onclick=\"javascript: $('#modal-content').load('$help_path/index.php'); $('#modal-display').modal('show');\">Base de conhecimento</a></td>
            </tr>
            <tr>
              <td colspan='3'>Última atualização: 13/06/2016 - 21:30</td>
            </tr>
          </table>
        </div>
      </div><!-- FIM RODAPÉ -->
    </div>
    <div class='modal fade' id='modal-display' tabindex='-1' role='dialog'>
      <div class='modal-dialog'>
        <div class='modal-content' id='modal-content'>
        </div>
      </div>
    </div>
    <script src='$home_path/js/geral.js'></script>
  </body>
</html>");
?>