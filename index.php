<!--
# Criado por Elicio Junior - Elicio.Junior@claro.com.br
# Versão: v4.0
# Data: 14/04/2021
# Data Center Cluster Baixada Santista
# -------------------------------------- #
# Manutenção por Rodrigo Prazim - rodrigo.prazim@claro.com.br
# Data: 21/10/2023
# Datacenter Belém
# https://github.com/rodrigoprazim/claro-dtc-niveis
# -------------------------------------- #
-->
<?php include('variables.php');?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="assets/img/favicon.ico">
<title><?php echo $vGlobal['nome_cidade']; ?> - Claro S.A.</title>
<meta name="viewport" content="width=device-width" />
<!-- Bootstrap core CSS -->
<link href="./assets/css/bootstrap.min.css?v=4.5.2" rel="stylesheet">
<!-- Bootstrap Dark CSS -->
<link href="./assets/css/dark.css" rel="stylesheet">

<!-- Bootstrap core JavaScript -->
<script src="./assets/js/jquery.min.js?v=3.5.1"></script>
<script src="./assets/js/bootstrap.bundle.min.js?v=4.5.2"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js?v=4.5.2"></script>
<!--  Fonts and icons     -->
<link href="./assets/css/font-awesome.min.css?v=4.7.0" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Roboto', sans-serif;
  font-size: .9em;
}

#form-Consulta {
  display: flex;
  justify-content: center;
  align-itens: center;
}

#claro-logo {
 width: 90px;
 heigth: 70px;
}

#operacao-text {
  font-weight: bold;
  font-size: 1.2rem;
}

#content {
  margin-left: auto;
  margin-right: auto;
}

.table td, .table th {
  padding: .2em;
  vertical-align: middle !important;
}

.loading {
  display: flex;
  justify-content: center;
}

.loading_modal {
  display: flex;
  justify-content: center;
}

.loader {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: inline-block;
  border-top: 4px solid #F3F3F3;
  border-right: 4px solid transparent;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}
.loader::after {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 0;
  top: 0;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  border-left: 4px solid #FF3D00;
  border-bottom: 4px solid transparent;
  animation: rotation 0.5s linear infinite reverse;
}
@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 
</style>
</head>
<body class="bg-white">
<div class="wrapper">
  <div id="header">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="javascript:void(0);">
        <img src="./assets/img/logo-claro.png" id="claro-logo" alt="claro-logo"/>
      </a>
      <a class="navbar-brand" id="operacao-text" href="javascript:void(0);">Datacenter - Níveis</a>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav" id="navbar-menu">
          <li class="nav-item active">
            <a onclick="window.location.reload();" class="nav-link" href="javascript:void(0);">
              <i class="fa fa-search" aria-hidden="true" style="font-size: 1.2rem;"></i> <b>Consulta Modem</b><span class="sr-only">(current)</span>
            </a>
          </li>
          <!-- <li class="nav-item dropdown">
            <span class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-server" aria-hidden="true" style="font-size: 1.2rem;"> Monitoramento</i>
            </span>
            <div class="dropdown-menu" id="navbarDropdownMenuDescription" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item busca" href="novo-monitoramento.php"><span class="monitor-text">Novo Monitoramento</span></a>
              <a class="dropdown-item busca" href="consulta-monitoramento.php"><span class="monitor-text">Consultar Monitoramento</span></a>
            </div>
          </li> -->
        </ul>
      </div>
      <!-- Formulário de consulta de cable -->
      <div id="form-Consulta">
        <div id="clearInputField" style="display:none;">
          <button type="button" class="btn btn-outline-danger" id="clearInput">Limpar</button>
        </div>
        <div id="type-Consulta" class="inputConsulta">
          <input class="form-control mr-sm-2 input-Consulta" id="inputSearchField" type="search" name="input-Consulta" placeholder="MAC ou Contrato" aria-label="Search"/>
        </div>
        <button class="btn btn-outline-success btn-sm" id="btn-Consulta" name="btn-Consulta">Consulta</button>
      </div>
          <!-- Dark Theme Toglle -->
      <div class="custom-control custom-switch">
        &nbsp;<input type="checkbox" class="custom-control-input" id="darkSwitch" />
        &nbsp;<label class="custom-control-label" for="darkSwitch"><i class="fa fa-moon-o" aria-hidden="true"></i></label>
      </div>
      <script src="./assets/js/dark.min.js"></script>
    </nav>
    <!-- END NAVBAR -->
  </div>
  <!-- END HEADER -->
  <div id="container">
    <div class="loading">
    </div>
    <div id="content">
    </div>
  </div>
  <div id="footer">
    <p><center>Copyright ©<?php echo date('Y');?> Datacenter Cluster Norte, All Rights Reserved</center></p>
  </div>
  <script>
  $(document).ready(function(){
    //Aqui a ativa a imagem de load
    function loading_show(){
      $('.loading').html("<div class='loader'></div>").fadeIn('fast');
    };
    function loading_modal_show(){
      $('.loading_modal').html("<div class='loader'></div>").fadeIn('fast');
    };
    //Aqui desativa a imagem de loading
    function loading_hide(){
      $('.loading').fadeOut('fast');
    };
    function loading_modal_hide(){
      $('.loading_modal').fadeOut('fast');
    };
    //Limpa o campo de busca por contrato
    $("#clearInput").click(function(){
      //$("#content").empty();
      $("input").trigger('reset');
      $('#selectSearchField').css("display", "none");
      $('#type-Consulta').html('<input class="form-control mr-sm-2 input-Consulta" id="inputSearchField" type="search" name="input-Consulta" placeholder="MAC ou Contrato" aria-label="Search" value=""/>');
      $('#clearInputField').css("display", "none");
    });
    //Aqui funcao que busca a pagina desejada pelo usuario
    $(".busca").click(function(){
      //Aqui estou retirando o conteudo da propriedade href "o link destino" e colocando em uma variavel
      var link = $(this).attr('href');
      $.ajax({
        dataType: 'html',
        url: link, //link da pagina que o ajax buscará
        success: function(data){
          $("#content").html(data).fadeIn(340); //Inserindo o retorno da pagina ajax
        },
        error: function(data){
          $("#content").html("<center><p>ERRO ao carregar outra pagina.</p></center>").fadeIn(300); //Em caso de erro ele exibe esta mensagem
        }
      });
    });
    $("#inputSearchField").keyup(function(event) {
      if (event.which === 13) {
        $("#btn-Consulta").click();
      };
    });
    $("#btn-Consulta").click(function() {
      $("#content").empty();
      var mac = $(".input-Consulta").val();
      var consulta = mac.replace(/[^a-zA-Z0-9s]/g, "");
      if(consulta.length === 12){
        loading_show();
          $.post("recebe_new.php",{
          search: "mac",
          consulta: consulta
        },
        function(retorna){
          var cable = JSON.parse(retorna);
          var cableSanitized = cable.docsis.replace(/'/g, '"');
          var obj = JSON.parse(cableSanitized);
          //console.log(obj);
          if(typeof cable.ldap[0] !== "undefined"){
            var clientClass = cable.ldap[0]['docsisclientclass'][0];
            var virtuaclass;
            if (clientClass === "Virtua") {
              virtuaclass = "alert-success";
              virtuaclassdescription = "Virtua";
              virtuaicon = "fa fa-desktop fa-lg";
            } else if (clientClass === "Virtua_NAT") {
              virtuaclass = "alert-info";
              virtuaclassdescription = "Virtua NAT";
              virtuaicon = "fa fa-desktop fa-lg";
            } else if (clientClass === "Virtua_PME") {
              virtuaclass = "alert-warning";
              virtuaclassdescription = "Virtua PME";
              virtuaicon = "fa fa-desktop fa-lg";
            } else if (clientClass === "Virtua_TV") {
              virtuaclass = "alert-dark";
              virtuaclassdescription = "Virtua HDTV";
              virtuaicon = "fa fa-tv fa-lg";
            } else if (clientClass === "Disable") {
              virtuaclass = "alert-light";
              virtuaclassdescription = "Desabilitado";
              virtuaicon = "fa fa-times-circle fa-lg";
            } else {
              virtuaclass = "alert-light";
              virtuaclassdescription = clientClass;
              virtuaicon = "fa fa-times-circle fa-lg";
            };
            
            docsisnode = cable.ldap[0]['docsisnode'][0];

          }else{
            virtuaclass = "alert-light";
            virtuaclassdescription = "Sem Contrato";
            virtuaicon = "fa fa-times-circle fa-lg";
            docsisnode = '';
          }
          if(obj['CMTS']['Ip'] != "NOT FOUND" && obj['CMTS']['Status'] == "Online"){

            if(typeof cable.ldap[0] !== "undefined"){
              //FUNCAO DE DESCRIPTION DO PROFILE
              var policyname = cable.ldap[0]['docsispolicyname'][0];
              $.getJSON("profiles.json", function(data) {
                let profilesjson = data.profiles;
                  for(index = 0; index < Object.keys(profilesjson).length; index++){
                    if(policyname == Object.keys(profilesjson)[index]){
                      description = Object.values(profilesjson)[index].name;
                      $("#velocidade").html(description);
                    };
                  };
              });
              var docsiscontrato = cable.ldap[0]['docsiscontrato'][0];
            }else{
              var policyname = "N/A";
              var docsiscontrato = "";
            }

            //FUNCAO DE VERSAO DOCSIS
            var docsisversion = obj['Cable Modem']['Docsis Version'];
            var docsismode = '';
            if (docsisversion == 4) {
              docsismode = "3.1";
            } else if (docsisversion == 3) {
              docsismode = "3.0";
            } else if (docsisversion == 2) {
              docsismode = "2.0";
            } else {
              docsismode = "undefined";
            };

            // CORES DO NIVEIS
            var colorTxModem = "";
            var colorRxModem = "";
            var colorSnrCmts = "";
            var colorTxOfdma = "";
            
            if(obj['Cable Modem']['Prim. Up TX Level'] >= 40 && obj['Cable Modem']['Prim. Up TX Level'] <= 50){
              colorTxModem = 'green';
            }else if(obj['Cable Modem']['Prim. Up TX Level'] >= 30 && obj['Cable Modem']['Prim. Up TX Level'] < 40){
              colorTxModem = '#ffb83e';
            }else{
              colorTxModem = 'red';
            }

            

            if(docsisversion == 4){
              if(obj['Docsis 3.1']['Up OFDMA Channels']['Tx Level'] >= 40 && obj['Docsis 3.1']['Up OFDMA Channels']['Tx Level'] <= 50){
                colorTxOfdma = 'green';
              }else if(obj['Docsis 3.1']['Up OFDMA Channels']['Tx Level'] >= 30 && obj['Docsis 3.1']['Up OFDMA Channels']['Tx Level'] < 40){
                colorTxOfdma = '#ffb83e';
              }else{
                colorTxOfdma = 'red';
              }
              var txOfdma = "Erro";
              if(obj['Docsis 3.1']['Up OFDMA Channels']['Tx Level'] !== "undefined"){
                txOfdma = obj['Docsis 3.1']['Up OFDMA Channels']['Tx Level'] + ' dbmV';
              }
            }

            if(obj['Cable Modem']['Downstreams']['Count'] > 0){

              if(obj['Cable Modem']['Downstreams']['Down #0']['RX Level'] >= -15 && obj['Cable Modem']['Downstreams']['Down #0']['RX Level'] <= 15){
                colorRxModem = 'green';
              }else{
                colorRxModem = 'red';
              }

              rxLevel = obj['Cable Modem']['Downstreams']['Down #0']['RX Level']+' dbmV';

            }else{
              colorRxModem = 'green';
              rxLevel = 'Error';
            }

            if(obj['CMTS']['Cmts SNR'] >= 35){
              colorSnrCmts = 'green';
            }else{
              colorSnrCmts = 'red';
            }

            //FUNCAO DE MODELO DE MODEM
            var linkHttpUserPass = "";
            if(obj['Cable Modem']['Modelo'] != '123456789'){
              linkHttpUserPass = ' <a href="javascript:void(0);" style="color:inherit; text-decoration:inherit; data-toggle="tooltipHttpAccess" title="HTTP Access CM"><i class="fa fa-unlock" aria-hidden="true" data-toggle="modal" data-target="#staticBackdropHttpUserPass"></i></a>';
            }

            //FUNCAO DE SNR DA UPSTREAM
            var snrUp = '';
            $.post("ccm/get_idx.php",{
              cmtsIp: obj['CMTS']['Ip'],
              interface: obj['CMTS']['Primary UP']
            },function(res){
              res = res + ' dBmV';
              $(".snrUp").html(res);
            });
            $('[data-toggle="tooltipUp"]').tooltip();
            $('[data-toggle="tooltipDw"]').tooltip();
            $('[data-toggle="tooltipMTA"]').tooltip();
            $('[data-toggle="tooltipOfdmInfo"]').tooltip();
            $('[data-toggle="tooltipOfdmFreq"]').tooltip();
            var flows = obj['Flows'];
            var cpes = obj['CPES'];
            $(function(){
              // Cria a tabela de Service Flows
              htmlFlows = '';
              htmlFlows = '<table class="table table-sm table-bordered table-hover">';
              htmlFlows += '   <thead class="thead-dark">';
              htmlFlows += '   <tr>';
              htmlFlows += '     <th scope="col">#</th>';
              htmlFlows += '     <th scope="col">Flow</th>';
              htmlFlows += '     <th scope="col">Type</th>';
              htmlFlows += '     <th scope="col">Velocidade</th>';
              htmlFlows += '   </tr>';
              htmlFlows += ' </thead>';
              htmlFlows += ' <tbody>';
              for(indexFlows = 1; indexFlows < Object.keys(flows).length -1; indexFlows++){
                htmlFlows += '    <tr>';
                htmlFlows += '      <th scope="row">'+indexFlows+'</th>';
                htmlFlows += '      <td>'+Object.values(flows)[indexFlows]['BW']+'</td>';
                if(Object.values(flows)[indexFlows]['Dir'] == 1){
                  htmlFlows += '      <td>Downstream</td>';
                }else{
                  htmlFlows += '      <td>Upstream</td>';
                }
                var bw = Object.values(flows)[indexFlows]['BW'].replace(/000000000$/g, "GB").replace(/000000$/g, "MB").replace(/000$/g, "Kb");
                htmlFlows += '      <th scope="row">'+bw+'</th>';
                htmlFlows += '    </tr>';
              };
              htmlFlows += '  </tbody>';
              htmlFlows += '</table>';
              // Cria a tabela de IPs CPE
              htmlCPEs = '';
              htmlCPEs = '<table class="table table-sm table-bordered table-hover">';
              htmlCPEs += '   <thead class="thead-dark">';
              htmlCPEs += '   <tr>';
              htmlCPEs += '     <th scope="col">#</th>';
              htmlCPEs += '     <th scope="col">MAC</th>';
              htmlCPEs += '     <th scope="col">CPE IP</th>';
              htmlCPEs += '   </tr>';
              htmlCPEs += ' </thead>';
              htmlCPEs += ' <tbody>';
              for(indexCPE = 1; indexCPE < Object.keys(cpes).length -1; indexCPE++){
                if(Object.values(cpes)[indexCPE]['IP'] != obj['Cable Modem']['End IP'] && Object.values(cpes)[indexCPE]['IP'] != '0.0.0.0' && Object.values(cpes)[indexCPE]['IP'] != 'N/A'){
                  if(Object.values(cpes)[indexCPE]['IP'].substring(0, 4) != '10.9' || Object.values(cpes)[indexCPE]['IP'].substring(0, 4) != '100.'){
                    if(clientClass !== "Virtua_TV" && (Object.values(cpes)[indexCPE]['IP'].substring(0, 3) == '10.' || Object.values(cpes)[indexCPE]['IP'].substring(0, 3) == '11.' || Object.values(cpes)[indexCPE]['IP'].substring(0, 4) == '172.')){
                      htmlCPEs += '    <tr>';
                      htmlCPEs += '      <th scope="row">'+indexCPE+'</th>';
                      htmlCPEs += '      <td>'+Object.values(cpes)[indexCPE]['MAC']+'</td>';
                      htmlCPEs += '      <td>'+Object.values(cpes)[indexCPE]['IP']+'&nbsp;&nbsp;<a href="javascript:void(0);" style="color:inherit; text-decoration:inherit;" data-toggle="modal" data-target="#staticBackdropMta" title="Info de MTA"><i class="fa fa-bars" aria-hidden="true"></i></a></td>';
                      htmlCPEs += '    </tr>';
                    } else if (clientClass === "Virtua_TV") {
                      ip_stb = Object.values(cpes)[indexCPE]['IP'];
                      htmlCPEs += '    <tr>';
                      htmlCPEs += '      <th scope="row">'+indexCPE+'</th>';
                      htmlCPEs += '      <td>'+Object.values(cpes)[indexCPE]['MAC']+'</td>';
                      htmlCPEs += '      <td>'+Object.values(cpes)[indexCPE]['IP']+'&nbsp;&nbsp;<a href="javascript:void(0);" style="color:inherit; text-decoration:inherit;" data-toggle="modal" data-target="#staticBackdropStb" title="Info de STB"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></td>';
                      htmlCPEs += '    </tr>';
                    } else {
                      htmlCPEs += '    <tr>';
                      htmlCPEs += '      <th scope="row">'+indexCPE+'</th>';
                      htmlCPEs += '      <td>'+Object.values(cpes)[indexCPE]['MAC']+'</td>';
                      htmlCPEs += '      <td>'+Object.values(cpes)[indexCPE]['IP']+'</td>';
                      htmlCPEs += '    </tr>';
                    };
                  };
                };
              };
              htmlCPEs += '  </tbody>';
              htmlCPEs += '</table>';
              document.getElementById('serviceflows').innerHTML = htmlFlows;
              document.getElementById('cpeips').innerHTML = htmlCPEs;
            });
            // INICIO DO CORPO DE RESPOSTA
            htmlData  = '<div class="container-fluid">';
            htmlData += '  <div class="alert ' + virtuaclass + '" style="font-size: 1.2em;">';
            htmlData += '    <i class="' + virtuaicon + '" aria-hidden="true"></i>';
            htmlData += '    <span><b> ' + virtuaclassdescription + ' | ' + obj['Cable Modem']['MAC'].toUpperCase() + '</b></span>';
            htmlData += '  </div>';
            htmlData += '    <div class="row">';
            htmlData += '     <!-- STATUS -->';
            htmlData += '     <div class="col-sm-6">';
            htmlData += '       <div class="card">';
            htmlData += '         <div class="header">';
            htmlData += '           <h5 class="category">Informações sobre o Cable Modem no CMTS</h5>';
            htmlData += '         </div>';
            htmlData += '         <!-- STATUS TABLE -->';
            htmlData += '         <div class="content table-responsive table-full-width">';
            htmlData += '           <table class="table table-striped">';
            htmlData += '             <thead>';
            htmlData += '               <th></th>';
            htmlData += '               <th></th>';
            htmlData += '             </thead>';
            htmlData += '             <tbody>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Status:</td>';
            htmlData += '                 <td><b><font color="green">' + obj['CMTS']['Status'] + '</font></b>';
            htmlData += '                 </td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Receive Power:</td>';
            htmlData += '                 <td><b><font color="green">' + obj['CMTS']['Cmts Receive Power'] + ' dB</font></b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Sinal/Ruído:</td>';
            htmlData += '                 <td><b><font color="'+ colorSnrCmts +'">' + obj['CMTS']['Cmts SNR'] + ' dBmV</font></b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Docsis Mode:</td>';
            htmlData += '                 <td><b>' + docsismode + '&nbsp;&nbsp;(' + obj['Cable Modem']['Capability (Down/Up)'] + ')</b></td>';
            htmlData += '               </tr>';
            htmlData += '             </tbody>';
            htmlData += '           </table>';
            htmlData += '         </div>';
            htmlData += '         <!-- END STATUS TABLE -->';
            htmlData += '       </div>';
            htmlData += '     </div>';
            htmlData += '     <!-- END STATUS -->';
            htmlData += '     <!-- NODE -->';
            htmlData += '     <div class="col-sm-6">';
            htmlData += '       <div class="card">';
            htmlData += '         <div class="header">';
            htmlData += '           <h5 class="category">Informações sobre o Node no CMTS</h5>';
            htmlData += '         </div>';
            htmlData += '         <!-- NODE TABLE -->';
            htmlData += '         <div class="content table-responsive table-full-width">';
            htmlData += '           <table class="table table-striped">';
            htmlData += '             <thead>';
            htmlData += '               <th></th>';
            htmlData += '               <th></th>';
            htmlData += '             </thead>';
            htmlData += '             <tbody>';
            htmlData += '               <tr>';
            htmlData += '                 <td>CMTS:</td>';
            htmlData += '                 <td><b>' + obj['CMTS']['Ip'] + ' (' + obj['CMTS']['Nome'] + ')</b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Receive Power Configurado:</td>';
            htmlData += '                 <td><b>' + obj['CMTS']['Cmts Config Rec. Power'] + ' dB</b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Placa/Up:</td>';
            htmlData += '                 <td><b>' + obj['CMTS']['Primary UP'] + '</b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Node:</td>';
            htmlData += '                 <td><b>' + docsisnode + '</b>';
            htmlData += '                 </td>';
            htmlData += '               </tr>';
            htmlData += '             </tbody>';
            htmlData += '           </table>';
            htmlData += '         </div>';
            htmlData += '         <!-- END NODE TABLE -->';
            htmlData += '       </div>';
            htmlData += '     </div>';
            htmlData += '     <!-- END NODE -->';
            htmlData += '     <!-- CABLE MODEM -->';
            htmlData += '     <div class="col-sm-12">';
            htmlData += '       <div class="card">';
            htmlData += '         <div class="header">';
            htmlData += '           <h5 class="category">Informações sobre o Cable Modem</h5>';
            htmlData += '         </div>';
            htmlData += '         <!-- CABLE TABLE -->';
            htmlData += '         <div class="content table-responsive table-full-width">';
            htmlData += '           <table class="table table-striped">';
            htmlData += '             <thead>';
            htmlData += '               <th></th>';
            htmlData += '               <th></th>';
            htmlData += '             </thead>';
            htmlData += '             <tbody>';
            htmlData += '               <tr>';
            htmlData += '                 <td>';
            htmlData += '                   <div class="btn-group" role="group" aria-label="Group Button Functions">';
            htmlData += '                     <button type="button" class="btn btn-outline-info btn-sm" id="clearcable"><i class="fa fa-refresh" aria-hidden="true"></i> Clear</button>';
            htmlData += '                     <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#staticBackdropLog"><i class="fa fa-tasks" aria-hidden="true"></i> Log</button>';
            htmlData += '                     <button type="button" class="btn btn-outline-secondary btn-sm" id="forceupdate"><i class="fa fa-download" aria-hidden="true"></i> Force Update</button>';
            htmlData += '                     <button type="button" class="btn btn-outline-danger btn-sm" id="forcereboot"><i class="fa fa-power-off" aria-hidden="true"></i> Reboot CM</button>';
            htmlData += '                   </div>';
            htmlData += '                 </td>';
            htmlData += '                 <td></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Contrato: <b>' + docsiscontrato + '</b></td>';
            htmlData += '                 <td>IP Cable: <b><a href="http://'+ obj['Cable Modem']['End IP']+'" target="_blank" title="Acessar CM">' + obj['Cable Modem']['End IP'] + '</a>'+linkHttpUserPass+'</b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Vendor: <b>' + obj['Cable Modem']['Vendor'] + '</b></td>';
            htmlData += '                 <td>Sinal/Ruído: <b><font color="green"><span class="snrUp"></span></font></b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Modelo: <b>' + obj['Cable Modem']['Modelo'] + '</b></td>';
            htmlData += '                 <td>TX: <b><font color="'+ colorTxModem +'">' + obj['Cable Modem']['Prim. Up TX Level'] + ' dBmV</font></b>&nbsp;&nbsp;<a href="javascript:void(0);" style="color:inherit; text-decoration:inherit;" data-toggle="tooltipUp" title="Freq. de Ups"><i class="fa fa-bars" aria-hidden="true" data-toggle="modal" data-target="#staticBackdropUpstreams"></i></a></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Versão: <b>' + obj['Cable Modem']['Sw_Rev'] + '</b></td>';
            htmlData += '                 <td>RX: <b><font color="'+ colorRxModem +'"> '+ rxLevel + '</font></b>&nbsp;&nbsp;<a href="javascript:void(0);" style="color:inherit; text-decoration:inherit; data-toggle="tooltipUp" title="Freq. de Downs"><i class="fa fa-bars" aria-hidden="true" data-toggle="modal" data-target="#staticBackdropDownstreams"></i></a></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Tempo online: <b>' + obj['Cable Modem']['Uptime'] + '</b></td>';
            htmlData += '                 <td>Profile LDAP: <b>' + policyname + '</b></td>';
            htmlData += '               </tr>';
            /* BLOCO OFDM */
            if(docsisversion == 4){
              htmlData += '               <tr>';
              htmlData += '                 <td>OFDM: <b><font color="green">OK</font></b>&nbsp;&nbsp;<a href="javascript:void(0);" style="color:inherit; text-decoration:inherit; data-toggle="tooltipOfdmInfo" title="OFDM Channel Info"><i class="fa fa-bars" aria-hidden="true" data-toggle="modal" data-target="#staticBackdropOfdmInfo"></i></a></td>';
              htmlData += '                 <td>Down OFDM Channels:&nbsp;&nbsp;<a href="javascript:void(0);" style="color:inherit; text-decoration:inherit; data-toggle="tooltipOfdmFreq" title="OFDM Channel Freq"><i class="fa fa-bars" aria-hidden="true" data-toggle="modal" data-target="#staticBackdropOfdmFreq"></i></a></td>';
              htmlData += '               </tr>';
            /* EOF BLOCO OFDM */
            /* BLOCO OFDMA */
              htmlData += '               <tr>';
              htmlData += '                 <td>OFDMA: <b><font color="'+ colorTxOfdma +'">'+ txOfdma +'</font></b></td>';
              htmlData += '                 <td>Up OFDMA Channels:&nbsp;&nbsp;<a href="javascript:void(0);" style="color:inherit; text-decoration:inherit; data-toggle="tooltipOfdmaFreq" title="OFDMA Channel Freq"><i class="fa fa-bars" aria-hidden="true" data-toggle="modal" data-target="#staticBackdropOfdmaFreq"></i></a></td>';
              htmlData += '               </tr>';
            };
            /* EOF BLOCO OFDMA */
            htmlData += '               <tr>';
            htmlData += '                 <td>Service Flows: <b>' + obj['Flows']['Count'] + '</b>&nbsp;&nbsp;<a style="color:inherit; text-decoration:inherit;" data-toggle="collapse" href="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-bars" aria-hidden="true"></i></a></td>';
            htmlData += '                 <td>Velocidade: <b><span id="velocidade"></span></b>&nbsp;&nbsp;<a style="color:inherit; text-decoration:inherit;" data-toggle="collapse" href="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2"><i class="fa fa-bars" aria-hidden="true"></i></a></td>';
            htmlData += '                 <tr>';
            htmlData += '                   <td>';
            htmlData += '                     <div class="row">';
            htmlData += '                       <div class="col">';
            htmlData += '                         <div class="collapse multi-collapse" id="multiCollapseExample1">';
            htmlData += '                           <div class="card card-body">';
            htmlData += '                             <span id="serviceflows"></span>';
            htmlData += '                           </div>';
            htmlData += '                         </div>';
            htmlData += '                       </div>';
            htmlData += '                     </div>';
            htmlData += '                   </td>';
            htmlData += '                   <td>';
            htmlData += '                     <div class="row">';
            htmlData += '                       <div class="col">';
            htmlData += '                         <div class="collapse multi-collapse" id="multiCollapseExample2">';
            htmlData += '                           <div class="card card-body">';
            htmlData += '                             <span id="cpeips"></span>';
            htmlData += '                           </div>';
            htmlData += '                         </div>';
            htmlData += '                       </div>';
            htmlData += '                     </div>';
            htmlData += '                   </td>';
            htmlData += '                 </tr>';
            htmlData += '               </tr>';
            htmlData += '             </tbody>';
            htmlData += '           </table>';
            htmlData += '         </div>';
            htmlData += '         <!-- END CABLE TABLE -->';
            htmlData += '         <!-- UPSTREAM MODAL -->';
            htmlData += '         <div class="modal fade" id="staticBackdropUpstreams" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropUpstreamsLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-danger">';
            htmlData += '                 <i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropUpstreamsLabel">Upstreams</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <span id="upstreamsTable"></span>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END UPSTREAM MODAL -->';
            htmlData += '         <!-- DOWNSTREAM MODAL -->';
            htmlData += '         <div class="modal fade" id="staticBackdropDownstreams" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropDownstreamsLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog modal-dialog-scrollable">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-danger">';
            htmlData += '                 <i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropDownstreamsLabel">Downstreams</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <span id="downstreamsTable"></span>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END DOWNSTREAM MODAL -->';
            htmlData += '         <!-- MTA MODAL -->';
            htmlData += '         <div class="modal fade" id="staticBackdropMta" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropMtaLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog modal-xl">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-danger">';
            htmlData += '                 <i class="fa fa-phone fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropMtaLabel">MTA</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <div class="loading_modal"></div>';
            htmlData += '                 <span id="mtaTable"></span>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END MTA MODAL -->';
            htmlData += '         <!-- STB MODAL -->';
            htmlData += '         <div class="modal fade" id="staticBackdropStb" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropStbLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-warning">';
            htmlData += '                 <i class="fa fa-youtube-play fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropStbLabel">Set Top Box</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <div class="loading_modal"></div>';
            htmlData += '                 <span id="stbTable"></span>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END STB MODAL -->';
            htmlData += '         <!-- OFDM INFO MODAL -->';
            htmlData += '         <div class="modal fade" id="staticBackdropOfdmInfo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropOfdmInfoLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog modal-dialog-scrollable">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-danger">';
            htmlData += '                 <i class="fa fa-cloud-download fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropOfdmInfoLabel">BLOCO OFDM</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <span id="ofdmInfoTable"></span>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END OFDM INFO MODAL -->';
            htmlData += '         <!-- OFDM FREQ MODAL -->';
            htmlData += '         <div class="modal fade" id="staticBackdropOfdmFreq" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropOfdmFreqLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog modal-dialog-scrollable">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-danger">';
            htmlData += '                 <i class="fa fa-cloud-download fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropOfdmFreqLabel">FREQs OFDM</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <span id="OfdmFreqTable"></span>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END OFDM FREQ MODAL -->';
            htmlData += '         <!-- OFDMA FREQ MODAL -->';
            htmlData += '         <div class="modal fade" id="staticBackdropOfdmaFreq" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropOfdmaFreqLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog modal-dialog-scrollable">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-danger">';
            htmlData += '                 <i class="fa fa-cloud-upload fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropOfdmaFreqLabel">FREQs OFDMA</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <span id="OfdmaFreqTable"></span>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END OFDMA FREQ MODAL -->';
            htmlData += '         <!-- LOG MODAL -->';
            htmlData += '         <!-- Modal -->';
            htmlData += '         <div class="modal fade" id="staticBackdropLog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLogLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog modal-xl">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-info">';
            htmlData += '                 <i class="fa fa-info fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropLogLabel">Log Cable</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <div class="container_modal"></div>';
            htmlData += '                 <div class="loading_modal"></div>';
            htmlData += '                 <span id="log"></span>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <div class="btn-group" role="group" aria-label="Group Button Functions">';
            htmlData += '                   <button type="button" class="btn btn-outline-danger" id="clearlog"><i class="fa fa-eraser" aria-hidden="true"></i> Limpar Log</button>';
            htmlData += '                   <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '                 </div>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END LOG MODAL -->';
            htmlData += '         <!-- HTTP USER PASS MODAL -->';
            htmlData += '         <!-- Modal -->';
            htmlData += '         <div class="modal fade" id="staticBackdropHttpUserPass" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropHttpUserPassLabel" aria-hidden="true">';
            htmlData += '           <div class="modal-dialog">';
            htmlData += '             <div class="modal-content">';
            htmlData += '               <div class="modal-header alert alert-info">';
            htmlData += '                 <i class="fa fa-unlock fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;';
            htmlData += '                 <h5 class="modal-title" id="staticBackdropHttpUserPassLabel">Credenciais HTTP</h5>';
            htmlData += '                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">';
            htmlData += '                   <span aria-hidden="true">&times;</span>';
            htmlData += '                 </button>';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-body">';
            htmlData += '                 <div class="container_modal"></div>';
            htmlData += '                   <div class="loading_modal"></div>';
            htmlData += '                   <span id="httpuserpass"></span>';
            htmlData += '                 </div';
            htmlData += '               </div>';
            htmlData += '               <div class="modal-footer">';
            htmlData += '                 <div class="btn-group" role="group" aria-label="Group Button Functions">';
            htmlData += '                   <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>';
            htmlData += '                 </div>';
            htmlData += '               </div>';
            htmlData += '             </div>';
            htmlData += '           </div>';
            htmlData += '         </div>';
            htmlData += '         <!-- END USER PASS MODAL -->';
            htmlData += '       </div>';
            htmlData += '     </div>';
            htmlData += '     <!-- END CABLE MODEM -->';
            htmlData += '   </div>';
            htmlData += ' </div>';
          } else if(obj['CMTS']['Ip'] != "NOT FOUND" && obj['CMTS']['Status'] != "Online"){

            var virtuaclass = "alert-danger";
            var virtuaicon = "fa fa-power-off fa-lg";

            htmlData  = '<div class="container-fluid">';
            htmlData += '  <div class="alert ' + virtuaclass + '" style="font-size: 1.2em;">';
            htmlData += '    <i class="' + virtuaicon + '" aria-hidden="true"></i>';
            htmlData += '    <span><b> ' + virtuaclassdescription + ' | ' + consulta.toUpperCase() + '</b></span>';
            htmlData += '  </div>';
            htmlData += '    <div class="row">';
            htmlData += '     <!-- STATUS -->';
            htmlData += '     <div class="col-sm-6">';
            htmlData += '       <div class="card">';
            htmlData += '         <div class="header">';
            htmlData += '           <h5 class="category">Informações sobre o Cable Modem no CMTS</h5>';
            htmlData += '         </div>';
            htmlData += '         <!-- STATUS TABLE -->';
            htmlData += '         <div class="content table-responsive table-full-width">';
            htmlData += '           <table class="table table-striped">';
            htmlData += '             <thead>';
            htmlData += '               <th></th>';
            htmlData += '               <th></th>';
            htmlData += '             </thead>';
            htmlData += '             <tbody>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Status:</td>';
            htmlData += '                 <td><b><font color="red">' + obj['CMTS']['Status'] + '</font></b>';
            htmlData += '                 </td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Receive Power:</td>';
            htmlData += '                 <td><b><font color="green">' + obj['CMTS']['Cmts Receive Power'] + ' dB</font></b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Sinal/Ruído:</td>';
            htmlData += '                 <td><b><font color="green">' + obj['CMTS']['Cmts SNR'] + ' dBmV</font></b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Docsis Mode:</td>';
            htmlData += '                 <td><b>' + obj['CMTS']['Regmode'] + '</b></td>';
            htmlData += '               </tr>';
            htmlData += '             </tbody>';
            htmlData += '           </table>';
            htmlData += '         </div>';
            htmlData += '         <!-- END STATUS TABLE -->';
            htmlData += '       </div>';
            htmlData += '     </div>';
            htmlData += '     <!-- END STATUS -->';
            htmlData += '     <!-- NODE -->';
            htmlData += '     <div class="col-sm-6">';
            htmlData += '       <div class="card">';
            htmlData += '         <div class="header">';
            htmlData += '           <h5 class="category">Informações sobre o Node no CMTS</h5>';
            htmlData += '         </div>';
            htmlData += '         <!-- NODE TABLE -->';
            htmlData += '         <div class="content table-responsive table-full-width">';
            htmlData += '           <table class="table table-striped">';
            htmlData += '             <thead>';
            htmlData += '               <th></th>';
            htmlData += '               <th></th>';
            htmlData += '             </thead>';
            htmlData += '             <tbody>';
            htmlData += '               <tr>';
            htmlData += '                 <td>CMTS:</td>';
            htmlData += '                 <td><b>' + obj['CMTS']['Ip'] + ' (' + obj['CMTS']['Nome'] + ')</b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Receive Power Configurado:</td>';
            htmlData += '                 <td><b>' + obj['CMTS']['Cmts Config Rec. Power'] + ' dB</b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Placa/Up:</td>';
            htmlData += '                 <td><b>' + obj['CMTS']['Primary UP'] + '</b></td>';
            htmlData += '               </tr>';
            htmlData += '               <tr>';
            htmlData += '                 <td>Node:</td>';
            htmlData += '                 <td><b>' + docsisnode + '</b>';
            htmlData += '                 </td>';
            htmlData += '               </tr>';
            htmlData += '             </tbody>';
            htmlData += '           </table>';
            htmlData += '         </div>';
            htmlData += '         <!-- END NODE TABLE -->';
            htmlData += '       </div>';
            htmlData += '     </div>';
            htmlData += '     <!-- END NODE -->';
          } else {
            $.post("recebe_new.php",{
              search: "contrato",
              consulta: consulta
            },
            function(retorna){
              loading_hide();
              var obj = JSON.parse(retorna);
              if (obj.count > 0){
                $("#content").empty();
                var option = '<select class="custom-select input-Consulta" id="selectSearchField">';
                $.each(obj, function(i, info){
                  if(i != 'count'){
                    var mac = info['docsismodemmacaddress']['0'].replace(/1,6,|:/g, "");
                    option += '<option value="' +mac.toUpperCase()+ '">' +mac.toUpperCase()+ '</option>';
                  };
                })
                option += '</select>';
                document.getElementById('type-Consulta').innerHTML = option;
                document.getElementById('clearInputField').style.display = "block";
              }else{
                $("#content").empty();
                htmlData  = '<div class="container-fluid">';
                htmlData += '  <div class="alert alert-danger" style="text-align: center;">';
                htmlData += '    <span style="font-size: 1.2em;"><b>MAC ou Contrato não Encontrado</b></span>';
                htmlData += ' </div>';
                htmlData += '</div>';
                loading_hide();
                $("#content").html(htmlData);
              }
            });
          };
          
          if(typeof htmlData !== "undefined"){
            loading_hide();
            $("#content").html(htmlData);
          }
          $("#staticBackdropLog").on('show.bs.modal', function(e) {
            var ip_cm = obj['Cable Modem']['End IP'];
            $("#log").empty();
            loading_modal_show();
            $.post("ccm/get_logcm.php",{
              ip_cm: ip_cm
            },
            function(retorna){
              loading_modal_hide();
              $("#log").html(retorna);
            });
          });
          $("#staticBackdropHttpUserPass").on('show.bs.modal', function(e) {
            var ip_cm = obj['Cable Modem']['End IP'];
            $("#httpuserpass").empty();
            loading_modal_show();
            $.post("ccm/get_httpuserpasscm.php",{
              ip_cm: ip_cm,
              modelo: obj['Cable Modem']['Modelo']
            },
            function(retorna){
              loading_modal_hide();
              $("#httpuserpass").html(retorna);
            });
          });
          $("#staticBackdropStb").on('show.bs.modal', function(e) {
            var stb_ip = ip_stb;
            $("#stbTable").empty();
            loading_modal_show();
            $.post("ccm/get_infostbcm.php",{
              ip_stb: stb_ip
            },
            function(retorna){
              loading_modal_hide();
              $("#stbTable").html(retorna);
            });
          });
          $("#staticBackdropUpstreams").on('show.bs.modal', function(e) {
            var upstreams = obj['Cable Modem']['Upstreams'];
            htmlUp = '<table class="table table-sm table-bordered table-hover">';
            htmlUp += '   <thead class="thead-dark">';
            htmlUp += '   <tr>';
            htmlUp += '     <th scope="col">#</th>';
            htmlUp += '     <th scope="col">Frequencia</th>';
            htmlUp += '     <th scope="col">Tx Level</th>';
            htmlUp += '     <th scope="col">Width</th>';
            htmlUp += '   </tr>';
            htmlUp += ' </thead>';
            htmlUp += ' <tbody>';
            for(indexUp = 1; indexUp < Object.keys(upstreams).length - 1; indexUp++){
              htmlUp += '    <tr>';
              htmlUp += '      <th scope="row">'+indexUp+'</th>';
              htmlUp += '      <td>'+(Object.values(upstreams)[indexUp]['Freq'])/1000000+' MHz</td>';
              htmlUp += '      <td>'+Object.values(upstreams)[indexUp]['TX Level']+'</td>';
              htmlUp += '      <td>'+(Object.values(upstreams)[indexUp]['Width'])/1000000+' MHz</td>';
              htmlUp += '    </tr>';
            };
            htmlUp += '  </tbody>';
            htmlUp += '</table>';
            document.getElementById('upstreamsTable').innerHTML = htmlUp;
          });
          $("#staticBackdropDownstreams").on('show.bs.modal', function(e) {
            var downstreams = obj['Cable Modem']['Downstreams'];
            htmlDown = '<table class="table table-sm table-bordered table-hover">';
            htmlDown += '   <thead class="thead-dark">';
            htmlDown += '   <tr>';
            htmlDown += '     <th scope="col">#</th>';
            htmlDown += '     <th scope="col">Frequencia</th>';
            htmlDown += '     <th scope="col">RX Level</th>';
            htmlDown += '     <th scope="col">SNR</th>';
            htmlDown += '   </tr>';
            htmlDown += ' </thead>';
            htmlDown += ' <tbody>';
            for(indexDown = 1; indexDown < Object.keys(downstreams).length - 1; indexDown++){
              htmlDown += '    <tr>';
              htmlDown += '      <th scope="row">'+indexDown+'</th>';
              htmlDown += '      <td>'+(Object.values(downstreams)[indexDown]['Freq'])/1000000+' MHz</td>';
              htmlDown += '      <td>'+Object.values(downstreams)[indexDown]['RX Level']+'</td>';
              htmlDown += '      <td>'+Object.values(downstreams)[indexDown]['SNR']+'</td>';
              htmlDown += '    </tr>';
            };
            htmlDown += '  </tbody>';
            htmlDown += '</table>';
            document.getElementById('downstreamsTable').innerHTML = htmlDown;
          });
          $("#staticBackdropMta").on('show.bs.modal', function(e) {
            loading_modal_show();
            var mta = obj['MTA'];
            $.post("recebe_mta.php",{
              mta_mac: mta['Mac'].toUpperCase()
            },
            function(retorna){
              let mta_data = JSON.parse(retorna);
              htmlMta = '<table class="table table-sm table-bordered table-hover">';
              htmlMta += '   <thead class="thead-dark">';
              htmlMta += '   <tr>';
              htmlMta += '     <th scope="col">FQDN</th>';
              htmlMta += '     <th scope="col">MTA Mac</th>';
              htmlMta += '     <th scope="col">Policy Name</th>';
              htmlMta += '     <th scope="col">Prov</th>';
              if(mta['Rsip Line1'] == '1'){
                htmlMta += '     <th scope="col">Linha 1</th>';
                htmlMta += '     <th scope="col">Tel 1</th>';
              };
              if(mta['Rsip Line2'] == '1'){
                htmlMta += '     <th scope="col">Linha 2</th>';
                htmlMta += '     <th scope="col">Tel 1</th>';
              };
              htmlMta += '     <th scope="col">Soft Switch</th>';
              htmlMta += '   </tr>';
              htmlMta += ' </thead>';
              htmlMta += ' <tbody>';
              htmlMta += '    <tr>';
              htmlMta += '      <th scope="row">'+mta['FQDN']+'</th>';
              htmlMta += '      <th>'+mta['Mac'].toUpperCase()+'</th>';
              htmlMta += '      <th>'+mta_data['policy_name']+'</th>';
              if(mta['Prov State'] == '4'){
                htmlMta += '      <td><font color="green"><b>OK</b></font></td>';
              } else {
                htmlMta += '      <td><font color="red"><b>FALHA</b></font></td>';
              };
              if(mta['Rsip Line1'] == '1'){
                htmlMta += '      <td><font color="green"><b>OK</b></font></td>';
                htmlMta += '      <td><font color="green"><b>'+mta_data['num_tel1']+'</b></font></td>';
              };
              if(mta['Rsip Line2'] == '1'){
                htmlMta += '      <td><font color="green"><b>OK</b></font></td>';
                htmlMta += '      <td><font color="green"><b>'+mta_data['num_tel2']+'</b></font></td>';
              };
              if(mta_data['dns']){
                htmlMta += '      <td><font color="green"><b>OK</b></font></td>';
              } else {
                htmlMta += '      <td><font color="red"><b>FALHA</b></font></td>';
              };
              htmlMta += '    </tr>';
              htmlMta += '  </tbody>';
              htmlMta += '</table>';
              loading_modal_hide();
              document.getElementById('mtaTable').innerHTML = htmlMta;
            });
          });
          $("#staticBackdropOfdmInfo").on('show.bs.modal', function(e) {
            var ofdm = obj['Docsis 3.1']['Down OFDM Channels'];
            htmlOfdmInfo = '<table class="table table-sm table-bordered table-hover">';
            htmlOfdmInfo += '   <thead class="thead-dark">';
            htmlOfdmInfo += '   <tr>';
            htmlOfdmInfo += '     <th scope="col">CHAN SLOPE</th>';
            htmlOfdmInfo += '     <th scope="col">INDEX</th>';
            htmlOfdmInfo += '     <th scope="col">RX MER (Mean)</th>';
            htmlOfdmInfo += '     <th scope="col">RX MER (Stddev)</th>';
            htmlOfdmInfo += '   </tr>';
            htmlOfdmInfo += ' </thead>';
            htmlOfdmInfo += ' <tbody>';
            htmlOfdmInfo += '      <td>'+ofdm['OFDM #0']['Chan Slope']+'</td>';
            htmlOfdmInfo += '      <td>'+ofdm['OFDM #0']['Index']+'</td>';
            htmlOfdmInfo += '      <td>'+ofdm['OFDM #0']['RxMer (Mean)']+'</td>';
            htmlOfdmInfo += '      <td>'+ofdm['OFDM #0']['RxMer (Stddev)']+'</td>';
            htmlOfdmInfo += '    </tr>';
            htmlOfdmInfo += '  </tbody>';
            htmlOfdmInfo += '</table>';
            document.getElementById('ofdmInfoTable').innerHTML = htmlOfdmInfo;
          });
          $("#staticBackdropOfdmFreq").on('show.bs.modal', function(e) {
            var ofdm = obj['Docsis 3.1']['Down OFDM Channels'];
            htmlOfdmFreq = '<table class="table table-sm table-bordered table-hover">';
            htmlOfdmFreq += '   <thead class="thead-dark">';
            htmlOfdmFreq += '   <tr>';
            htmlOfdmFreq += '     <th scope="col">#</th>';
            htmlOfdmFreq += '     <th scope="col">Frequencia</th>';
            htmlOfdmFreq += '     <th scope="col">RX Power</th>';
            htmlOfdmFreq += '   </tr>';
            htmlOfdmFreq += ' </thead>';
            htmlOfdmFreq += ' <tbody>';
            for(indexOfdm = 0; indexOfdm < Object.values(ofdm)[1]['6MHz Slices']['Count']; indexOfdm++){
              htmlOfdmFreq += '      <td>'+indexOfdm+'</td>';
              htmlOfdmFreq += '      <td>'+(Object.values(ofdm)[1]['6MHz Slices']['Slice '+indexOfdm+'']['Cfreq'])/1000000+' MHz</td>';
              htmlOfdmFreq += '      <td>'+Object.values(ofdm)[1]['6MHz Slices']['Slice '+indexOfdm+'']['RX Power']+'</td>';
              htmlOfdmFreq += '    </tr>';
            };
            htmlOfdmFreq += '  </tbody>';
            htmlOfdmFreq += '</table>';
            document.getElementById('OfdmFreqTable').innerHTML = htmlOfdmFreq;
          });
          $("#staticBackdropOfdmaFreq").on('show.bs.modal', function(e) {
            var ofdma = obj['Docsis 3.1']['Up OFDMA Channels'];
            htmlOfdmaFreq = '<table class="table table-sm table-bordered table-hover">';
            htmlOfdmaFreq += '   <thead class="thead-dark">';
            htmlOfdmaFreq += '   <tr>';
            htmlOfdmaFreq += '     <th scope="col">Frequencia Base</th>';
            htmlOfdmaFreq += '     <th scope="col">Channel Width</th>';
            htmlOfdmaFreq += '   </tr>';
            htmlOfdmaFreq += ' </thead>';
            htmlOfdmaFreq += ' <tbody>';
            htmlOfdmaFreq += '      <td>'+(ofdma['Base Freq.'])/1000000+' MHz</td>';
            htmlOfdmaFreq += '      <td>'+(ofdma['Channel Width'])/1000000+' MHz</td>';
            htmlOfdmaFreq += '    </tr>';
            htmlOfdmaFreq += '  </tbody>';
            htmlOfdmaFreq += '</table>';
            document.getElementById('OfdmaFreqTable').innerHTML = htmlOfdmaFreq;
          });
          $("#clearcable").click(function(){
            $.post("ccm/clearcm.php",{
              mac: mac
            },
            function(response){
              if(response == 0){
                alert('Comando enviado com sucesso.');
              } else {
                alert('Falha ao enviar comando para o CM!');
              };
            });
          });
          $("#forceupdate").click(function(){
            var ip_cm = obj['Cable Modem']['End IP'];
            $.post("ccm/executor.php",{
              ip_cm: ip_cm,
              funcao: 'forceupdate'
            },
            function(response){
              if(response == 0){
                alert('Comando enviado com sucesso. Consultar Logs.');
              } else {
                alert('Falha ao enviar comando para o CM!');
              };
            });
          });
          $("#forcereboot").click(function(){
            var ip_cm = obj['Cable Modem']['End IP'];
            var msg = "Tem certeza que deseja reiniciar o CM?";
            if(confirm(msg)){
              $.post("ccm/executor.php",{
                ip_cm: ip_cm,
                funcao: 'forcereboot'
              },
              function(response){
                if(response == 0){
                  alert('Comando enviado com sucesso.');
                } else {
                  alert('Falha ao enviar comando para o CM!');
                };
              });
            }
          });
          $("#clearlog").click(function(){
            var ip_cm = obj['Cable Modem']['End IP'];
            $.post("ccm/executor.php",{
              ip_cm: ip_cm,
              funcao: 'clearlog'
            },
            function(response){
              if(response == 0){
                alert('Log deletado com sucesso!');
              } else {
                alert('Erro ao deletar o log!');
              };
            });
          });
        });
      } else {
        loading_show();
        $.post("recebe_new.php",{
          search: "contrato",
          consulta: consulta
        },
        function(retorna){
          loading_hide();
          var obj = JSON.parse(retorna);
          if (obj.count > 0){
            $("#content").empty();
            var option = '<select class="custom-select input-Consulta" id="selectSearchField">';
            $.each(obj, function(i, info){
              if(i != 'count'){
                var mac = info['docsismodemmacaddress']['0'].replace(/1,6,|:/g, "");
                option += '<option value="' +mac.toUpperCase()+ '">' +mac.toUpperCase()+ '</option>';
              };
            })
            option += '</select>';
            document.getElementById('type-Consulta').innerHTML = option;
            document.getElementById('clearInputField').style.display = "block";
          }else{
            $("#content").empty();
            htmlData  = '<div class="container-fluid">';
            htmlData += '  <div class="alert alert-danger" style="text-align: center;">';
            htmlData += '    <span style="font-size: 1.2em;"><b>MAC ou Contrato não Encontrado</b></span>';
            htmlData += ' </div>';
            htmlData += '</div>';
            loading_hide();
            $("#content").html(htmlData);
          }
        });
      };
    });
  });
  </script>
</div>
<!-- END WRAPPER -->
</body>
</html>