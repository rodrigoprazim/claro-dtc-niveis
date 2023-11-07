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
    'QAM_SIGNAL_QUALITY_LEVEL_PERCENT' => 'QS'
  );

  foreach($array as $chave => $valor){
    $dados_ex = explode("=",$valor);
    $key = array_search(trim($dados_ex[0]), array_keys($permitidos));
    if($key !== FALSE){
      $htmlStb .= '    <tr>';
      $htmlStb .= '      <th scope="row">'.$permitidos[trim($dados_ex[0])].'</th>';
      $htmlStb .= '      <td nowrap="nowrap">'.trim($dados_ex[1]).'</td>';
      $htmlStb .= '    </tr>';
    }
  }

  $htmlStb .= '  </tbody>';
  $htmlStb .= '</table>';
//  echo '<pre>';
  print $htmlStb;
//  echo '</pre>';
}else{
  print "Parametro vazio.";
}
?>
