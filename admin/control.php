<!DOCTYPE html>
<?php
    require("../includes/conexao.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_dpto']=='ADMIN')){
        $id = $_SESSION['usuario_id'];
        
        $query = "select * from tb_usuarios where usuario_id='$id'";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);
        
        $usuario_nome = $row['usuario_nome'];
        $usuario_sobrenome = $row['usuario_sobrenome'];
        $usuario_departamento = $row['usuario_departamento'];
        $usuario_tipo = $row['usuario_tipo'];
    }else{
        header('location: ../403');
    }

    if(isset($_SESSION['usuario_id'])){
        if((time() - $_SESSION['ultimo_login']) > 1800){
            header("location: ../includes/logout.php");
        }else{
            $_SESSION['ultimo_login'] = time();
        }
    }

?>
<html lang="pt-PT">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controlo - Analítica</title>
    
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    
    <!-- Goole Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../css/control.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    
    
</head>

<body>
  
   <div class="sidebar">
       <div class="brand">
           <a href="control">
               <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                  <g fill="none" fill-rule="evenodd">
                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z"></path>
                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z"></path>
                  </g>
                </svg>
                <span class="brand__name">Control Painel</span>
           </a>
       </div>
       <div class="sidemenus">
           <ul class="sidemenus__list">
               <li><a href="control" class="links"><i class="fa fa-bar-chart-o"></i><span>Analítica</span></a></li>
               <li><a href="users" class="links"><i class="fa fa-users"></i><span>Usuários</span></a></li>
               <li><a href="enviar-lembrete" class="links"><i class="fa fa-envelope"></i><span>E-mail</span></a></li>
               <li><a href="saude" class="links"><i class="fa fa-heart"></i><span>Saúde</span></a></li>
               <li><a href="users-profile" class="links"><i class="fa fa-user"></i><span>Perfil</span></a></li>             
           </ul>
       </div>
   </div>
   <div class="nav">
      
       <div class="account">
         <button class="dropdown__button" id="btn-dropdown-menu">
             <div class="account__img">
              <img src="../imagens/perfil/warren-wong-bh4LQHcOcxE-unsplash.jpg" alt="Foto de Perfil" class="account__img">
              </div>
              <div class="account__name">
                  <span><?php echo $usuario_nome." ".$usuario_sobrenome ?></span>
              </div>
              <div class="account__arrow">
                  <i class="fa fa-sort-down"></i>
              </div>
         </button>
         <div class="dropdown__menu">
             <div class="menu__body">
                 <ul class="menu">
                    <li><a href="../admin/users-profile"><button class="menu__list"><i class="fa fa-user"></i> <span>Perfil</span></button></a></li>
                     <li><a href="../includes/logout.php"><button class="menu__list"><i class="fa fa-sign-out"></i><span>Sair</span></button></a></li>
                 </ul>
             </div>
         </div>
          
       </div>
       <div class="notifications">
           <i class="fa fa-bell-o"></i>
       </div>
   </div>
   <div class="content">
      <div class="activity">
          <div class="activity__board">
              <div class="activity__header">
                  <div class="header">
                      <div class="header__title">
                          <span>Actividade de Usuários</span>
                      </div>
                      <div class="header__date">
                          <span>12 Dez, 2019 - 30 Dez, 2019</span><i class="fa fa-sort-down"></i>
                      </div>
                      
                  </div>
                  <div class="header__bottom">
                      <div class="data__card">
                          <div class="data__title"><span>Sessões</span></div>
                          <div class="data__number"><span id="n_sessions"><!--?php echo ler_active_sessions($db); ?--></span></div>
                          <div class="data__percentage"><span>20%</span> <i class="fa fa-arrow-up"></i></div>
                      </div>
                      <div class="data__card">
                          <div class="data__title"><span>Taxa de rejeição</span></div>
                          <div class="data__number"><span>36.9%</span></div>
                          <div class="data__percentage-negative"><span>7%</span> <i class="fa fa-arrow-down"></i></div>
                      </div>
                      <div class="data__card">
                          <div class="data__title"><span>duração de sessão</span></div>
                          <div class="data__number"><span>4min 49s</span></div>
                          <div class="data__percentage"><span>20%</span> <i class="fa fa-arrow-up"></i></div>
                      </div>
                  </div>
              </div>
              <div class="activity__graph">
                  <canvas id="usersActivity" width="500" height="150"></canvas>
              </div>
          </div>
      </div>
       <div class="info">
           <div class="info__data">
               <div class="card__header">
                   <div class="card__title"><span>Sessões por Dispositivo</span></div>
                   <div class="card__functions"></div>
               </div>
               <div class="card__body">
                   <canvas id="myChart" width="500" height="300"></canvas>
               </div>
               <div class="card__footer">
                   <div class="devices">
                       <div class="device__card">
                           <div class="device__img"><i class="fa fa-desktop"></i></div>
                           <div class="device__type"><span>Computer</span></div>
                           <div class="device__percentage"><span><?php echo ler_computer($db).".0%";?></span></div>
                       </div>
                       <div class="device__card">
                           <div class="device__img"><i class="fa fa-tablet"></i></div>
                           <div class="device__type"><span>Tablet</span></div>
                           <div class="device__percentage"><span><?php echo ler_tablet($db).".0%"; ?></span></div>
                       </div>
                       <div class="device__card">
                           <div class="device__img"><i class="fa fa-mobile"></i></div>
                           <div class="device__type"><span>Mobile</span></div>
                           <div class="device__percentage"><span><?php echo ler_mobile($db).".0%"; ?></span></div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="info__data">
               <div class="card__header">
                   <div class="card__title"><span>Visualizações de Páginas</span></div>
                   <div class="card__functions"></div>
               </div>
               <div class="card__bodyX">
                   <table class="table" align="center" >
                       <thead>
                           <tr>
                               <th>Páginas</th>
                               <th>Visualizações</th>
                           </tr>
                       </thead>
                       
                       <tbody>
                          <?php ler_paginas_views($db); ?>
                           
                       </tbody>
                   </table>
               </div>
           </div>
           <div class="info__data">
               <div class="card__header">
                   <div class="card__title"><span>Últimos Acessos</span></div>
                   <div class="card__functions"></div>
               </div>
               <div class="card__bodyX">
                   <table class="table" align="center" >
                       <thead>
                           <tr>
                               <th>IP</th>
                               <th>Data</th>
                           </tr>
                       </thead>
                       
                       <tbody>
                          <?php ler_ip_visitantes($db); ?>
                       </tbody>
                   </table>
               </div>
           </div>
           
       </div>
       
       <div class="tables">
           <div class="header">
              <div class="header__title">
                  <span>Actividade de Usuários</span>
              </div>
            </div>
           <table class="ip__table" id="ipTable">
               <thead>
                   <tr>
                       <th>IP</th>
                       <th>Dispositivo</th>
                       <th>SO</th>
                       <th>Navegador</th>
                       <th>Página</th>
                       <th>Data</th>
                       <th>Hora</th>
                       <th><i class="fa fa-cog"></i></th>
                   </tr>
               </thead>
               <tbody id="access-history">
                  <?php 
                       ler_historico_visitantes($db); 
                   ?>
                   
               </tbody>
           </table>
           <div class="pagination-container">
               <nav>
                   <ul class="pagination"></ul>
               </nav>
           </div>
       </div>
   </div>
   
   <div class="modal-ipDetails">
    <div class="modal-content">
        <span class="close-button">×</span>
        <h1>Detalhes de Acesso</h1>
        <hr>
        <div class="modal__body">
            <form action="" method="post">
                <div class="name__container">
                    <div class="name__box">
                        <div class="label__name">
                            <span>IP</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_ip" name="usr_ip" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Dispositivo</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_dispositivo" name="usr_dispositivo" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>SO</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_so" name="usr_so" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Navegador</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_navegador" name="usr_navegador" disabled>
                        </div>
                    </div>
                </div>
                <div class="name__container">
                    
                    <div class="name__box">
                        <div class="label__name">
                            <span>País</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_pais" name="usr_pais" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Código do País</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_pais_codigo" name="usr_pais_codigo" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Região</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_regiao" name="usr_regiao" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Cidade</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_cidade" name="usr_cidade" disabled>
                        </div>
                    </div>
                    
                </div>
                <div class="name__container">
                    <div class="name__box">
                        <div class="label__name">
                            <span>ISP</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_isp" name="usr_isp" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>AS</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_as" name="usr_as" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Organização</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_org" name="usr_org" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>latitude</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_latitude" name="usr_latitude" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>longitude</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_longitude" name="usr_longitude" disabled>
                        </div>
                    </div>
                </div>
                <div class="name__container">
                    <div class="name__box">
                        <div class="label__name">
                            <span>Página</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_page" name="usr_page" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Data</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_data" name="usr_data" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Hora</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_hora" name="usr_hora" disabled>
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Timezone</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_timezone" name="usr_timezone" disabled>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
  <script src="../js/dropdown-menu.js"></script>
   <script type="text/javascript">
       function check_sessions(){
           const xhr = new XMLHttpRequest();
       
           xhr.onreadystatechange = function(){
               if(xhr.readyState == 4){
                   if(xhr.status == 200){
                       document.getElementById('n_sessions').innerHTML = JSON.parse(xhr.response);
                   }

                   if(xhr.status == 404){
                       console.log("Informção não encontrada !");
                   }
               }
           };

           xhr.open('post','../includes/read_data.php', true);
           xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
           xhr.send('n_sessions=n_sessions');
       }
       
       setInterval(function(){
           check_sessions();
       }, 5000);
       
    </script>
   <script src="../js/activityChart.js"></script>
    <script>
        let myChart = document.getElementById('myChart').getContext('2d');

        let deviceChart = new Chart(myChart, {
                    type:'doughnut', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
                    data:{
                        labels:['Desktop', 'Tablets', 'Mobile'],
                        datasets:[{
                            label:'Dispositivos',
                            data:[
                                "<?php echo ler_computer($db); ?>",
                                "<?php echo ler_tablet($db); ?>",
                                "<?php echo ler_mobile($db); ?>"
                            ],
                            backgroundColor:[
                                '#007bff', 
                                '#29b6f6', 
                                '#13cae1'
                            ]
                        }]
                    },
                    options:{}
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
           /*$("#ipTable").DataTable();*/
            
            //Português
            $('#ipTable').DataTable({
                "language": {
                    "sProcessing":    "Porcessando...",
                    "sLengthMenu":    "Mostrar _MENU_ registros",
                    "sZeroRecords":   "Nenhum resultado encontrado",
                    "sEmptyTable":    "Sem dados disponíveis",
                    "sInfo":          "Mostrando registros de _START_ á _END_ de um total de _TOTAL_ registros",
                    "sInfoEmpty":     "Mostrando registros de 0 á 0 de um total de 0 registros",
                    "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Procurar:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Carregando...",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sLast":    "Último",
                        "sNext":    "Seguinte",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>
    <script> 
        $(document).ready(function() { 
            $("#search").on("keyup", function() { 
                var value = $(this).val().toLowerCase(); 
                $("#access-history tr").filter(function() { 
                    $(this).toggle($(this).text() 
                    .toLowerCase().indexOf(value) > -1) 
                }); 
            }); 
        }); 
    </script>
    <script src="../js/modal_acessos.js"></script>
    <script src="../js/check_token.js"></script>
</body>
</html>
