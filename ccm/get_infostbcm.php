<?php
if(isset($_POST)){
  $ip_stb = $_POST["ip_stb"];
  $str = "/dados/coletor/consulta_stb -i ".$ip_stb;
  exec($str, $array);
 
  // echo '<pre>';
  // print_r($array);
  // echo '</pre>';
 
  $htmlStb = '<table class="table table-sm table-bordered table-hover">';
  $htmlStb .= ' <tbody>';

  $permitidos = array(
    'HARDWARE_VERSION' => 'Versão do Hardware',
    'SOFTWARE_VERSION' => 'Versão do Software',
    'SMARTCARD' => 'Smartcard',
    'AUTHORISED_SERVICES_TV' => 'Serviços de TV',
    'USAGE_ID' => 'Update ID',
    'MODULATION' => 'Modulação',
    'FREQUENCY' => 'Frequencia',
    'DISK_CAPACITY' => 'Capacidade do HD',
    'DISK_STATUS' => 'Status do HD',
    'DISK_AVAILABLE' => 'Espaço disponível no HD',
    'AUDIO_LANGUAGE' => 'Idioma Audio',
    'SUBTITLE_LANGUAGE' => 'Idioma Legenda',
    'QAM_LOCK_STATUS' => 'QAM',
    'HDMI_OUTPUT' => 'Saida HDMI',
    'CURRENT_SERVICE_ID' => 'Canal Sintonizado',
    'HDMI_CONECT' => 'HDMI Conectado',
    'QAM_INPUT_POWER_LEVEL_PERCENT' => 'PS',
    'QAM_SIGNAL_QUALITY_LEVEL_PERCENT' => 'QS',
    'SNR' => 'SNR',
    'FREQ_QAM' => 'Frequencia do Canal'
  );

  $status_update_id = array(
    '1' => 'GRAVAÇÃO: 🔴 | NOW : 🟢',
    '2' => 'GRAVAÇÃO: 🔴 | NOW : 🔴',
    '5' => 'GRAVAÇÃO: 🟢 | NOW : 🔴',
    '6' => 'GRAVAÇÃO: 🟢 | NOW : 🟢',
    '10' => 'Teste NG 2018 | GRAVAÇÃO: 🟢 | NOW : 🟢',
    '59' => 'Teste NG/4K',
    '60' => 'GRAVAÇÃO: 🟢 | NOW : 🟢'
  );

  $count = 0;
  $filename = "channels.json";
  $handle = fopen($filename, "r");
  
  $contents = fread($handle, filesize($filename));
  $json = (array) json_decode($contents);

  foreach($array as $chave => $valor){
    $dados_ex = explode("=",$valor);
    $key = array_search(trim($dados_ex[0]), array_keys($permitidos));
    if($key !== FALSE){
      $value_ = trim($dados_ex[1]);
      if(trim($dados_ex[0]) == 'CURRENT_SERVICE_ID'){
        if(isset($json['channels']->{trim($dados_ex[1])})){
          $value_ = '('.trim($dados_ex[1]).') <span style="font-size: 0.9em;"><b>'.$json['channels']->{trim($dados_ex[1])}->channel_name.'</b></span>';
        }
      }else if(trim($dados_ex[0]) == 'USAGE_ID'){
        if(isset($status_update_id[trim($dados_ex[1])])){
          $value_ = '('.trim($dados_ex[1]).') <span style="font-size: 0.9em;"><b>'.$status_update_id[trim($dados_ex[1])].'</b></span>';
        }
      }

      $htmlStb .= '    <tr>';
      $htmlStb .= '      <th scope="row">'.$permitidos[trim($dados_ex[0])].'</th>';
      $htmlStb .= '      <td nowrap="nowrap">'.$value_.'</td>';
      $htmlStb .= '    </tr>';
      
      $count++;
    }
  }

  fclose($handle);

  $htmlStb .= '  </tbody>';
  $htmlStb .= '</table>';
//  echo '<pre>';
  if($count > 0){
    print $htmlStb;
  }else{
    print "<b>IP sem Informações adicionais.</b>";
  }
//  echo '</pre>';
}else{
  print "Parametro vazio.";
}
?>
