<?php
if(isset($_POST)){
  $mac = $_POST["mac"];
  $strPath  = "/dados/coletor/";
  $cfg_file = $strPath."cmts.cfg";
  $community = 'public';
  
  $str = $strPath."get_cable_wifi_data -m ".$mac." -c ".$community." -f ".$cfg_file;

  exec($str, $result);

  $data = "";
  foreach($result as $value){
    $data .=  $value;
  }
  $str_sanitize = str_replace("'", '"', $data);
  $data = json_decode($str_sanitize);
  //print($data);

  $htmlWifi = '<table class="table table-sm table-bordered table-hover">';
  $htmlWifi .= '  <tbody>';
  foreach($data->{'SSID Table'} as $key => $row){
    if(preg_match('/^Item #/',$key)){
      if(!empty($row->{'Enabled'}) && $row->{'Enabled'} == 1){
        $htmlWifi .= '    <tr>';
        $htmlWifi .= '      <th scope="col">SSID</th>';
        $htmlWifi .= '      <td nowrap="nowrap"><b>'.$row->{'SSID'}.'</b></td>';
        $htmlWifi .= '    </tr>';

        $htmlWifi .= '    <tr>';
        $htmlWifi .= '      <th scope="col">Status</th>';
        $htmlWifi .= '      <td nowrap="nowrap"><b>'.$row->{'Status'}.'</b></td>';
        $htmlWifi .= '    </tr>';

        $htmlWifi .= '    <tr>';
        $htmlWifi .= '      <th scope="col">Clientes Conectados</th>';
        $htmlWifi .= '      <td nowrap="nowrap"><b>'.$row->{'Connected Clients'}.'</b></td>';
        $htmlWifi .= '    </tr>';
      }
    }
  }
  $htmlWifi .= '  </tbody>';
  $htmlWifi .= '</table>';

  print $htmlWifi;
}
?>