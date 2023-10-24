<?php
if(isset($_POST)){
  $ip_cm = $_POST["ip_cm"];
  $str = "/dados/coletor/get_log -m ".$ip_cm;
  exec($str, $array);
  $htmlLog = '<table class="table table-sm table-bordered table-hover">';
  $htmlLog .= ' <thead class="thead-dark">';
  $htmlLog .= '   <tr>';
  $htmlLog .= '     <th scope="col">#</th>';
  $htmlLog .= '     <th scope="col">Início</th>';
  $htmlLog .= '     <th scope="col">Fim</th>';
  $htmlLog .= '     <th scope="col">Total</th>';
  $htmlLog .= '     <th scope="col">Evento</th>';
  $htmlLog .= '   </tr>';
  $htmlLog .= ' </thead>';
  $htmlLog .= ' <tbody>';

  for ($i = 1; $i < count($array); $i++){
    $htmlLog .= '    <tr>';
    $htmlLog .= '      <th scope="row" style="font-size:.8em; text-align:center">'.substr($array[$i],strpos($array[$i],"=") + 1).'</th>';
    $i++;
    $htmlLog .= '      <td nowrap="nowrap" style="font-size:.8em;">'.date('d/m/Y H:i:s', strtotime(substr($array[$i],strpos($array[$i],"=") + 1))).'</td>';
    $i++;
    $htmlLog .= '      <td nowrap="nowrap" style="font-size:.8em;">'.date('d/m/Y H:i:s', strtotime(substr($array[$i],strpos($array[$i],"=") + 1))).'</td>';
    $i++;
    $htmlLog .= '      <td style="font-size:.8em; text-align:center">'.substr($array[$i],strpos($array[$i],"=") + 1).'</td>';
    $i++;
    $htmlLog .= '      <td style="font-size:.8em;">'.substr($array[$i],strpos($array[$i],"=") + 1).'</td>';
    $htmlLog .= '    </tr>';
  }

  $htmlLog .= '  </tbody>';
  $htmlLog .= '</table>';

  print $htmlLog;
}else{
  print "Parametro vazio.";
}
?>
