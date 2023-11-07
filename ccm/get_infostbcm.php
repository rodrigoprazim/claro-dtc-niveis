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

  $permitidos = array('HARDWARE_VERSION','SOFTWARE_VERSION','SMARTCARD','AUTHORISED_SERVICES_TV','USAGE_ID','MODULATION','FREQUENCY','DISK_CAPACITY','DISK_STATUS','DISK_AVAILABLE','AUDIO_LANGUAGE','SUBTITLE_LANGUAGE','QAM_LOCK_STATUS','HDMI_OUTPUT','CURRENT_SERVICE_ID','HDMI_CONECT','QAM_INPUT_POWER_LEVEL_PERCENT','QAM_SIGNAL_QUALITY_LEVEL_PERCENT');

  for ($i = 0; $i < count($array); $i++){
    $dados_ex = explode("=",$array[$i]);
    $key = array_search(trim($dados_ex[0]), $permitidos);
    if($key !== FALSE){
      $htmlStb .= '    <tr>';
      $htmlStb .= '      <th scope="row">'.trim($dados_ex[0]).'</th>';
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
