<?php
if(isset($_POST)){
  $IP = $_POST["ip_cm"];
  $MODELO = $_POST["modelo"];

  $htmlUserPass = '<table class="table table-sm table-bordered table-hover">';
  $htmlUserPass .= ' <thead class="thead-dark">';
  $htmlUserPass .= '   <tr>';
  $htmlUserPass .= '     <th scope="col">#</th>';
  $htmlUserPass .= '     <th scope="col">User</th>';
  $htmlUserPass .= '     <th scope="col">Password</th>';
  $htmlUserPass .= '   </tr>';
  $htmlUserPass .= ' </thead>';
  $htmlUserPass .= ' <tbody>';

  if($MODELO != 'CH8568'){

    $str = "/usr/local/bin/snmpwalk -On -v2c -c public ".$IP." .1.3.6.1.4.1.4413.2.2.2.1.1.3 | awk '{print $4}'";
  
    exec($str,$output);
  
    #print_r($output);

    for ($i = 0; $i < count($output); $i++){
      if($i <= 3){
        if(preg_match('/(CLARO_|NET_|admin)/',$output[$i])){
          $htmlUserPass .= '    <tr>';
          $htmlUserPass .= '      <th scope="row" style="text-align:center">'.$i.'</th>';
          $htmlUserPass .= '      <td nowrap="nowrap">'.trim($output[$i],'"').'</td>';
          $i++;
          $htmlUserPass .= '      <td nowrap="nowrap">'.trim($output[$i],'"').'</td>';
          $htmlUserPass .= '    </tr>';
        }
      }
    }
  }else{

    $str = "/usr/local/bin/snmpwalk -On -v2c -c public ".$IP." .1.3.6.1.4.1.35604.2.2.1 | awk '{print $4}'";
  
    exec($str,$output);
    
    #print_r($output);
    for ($i = 0; $i < 12; $i++){
      if(preg_match('/(CLARO_|NET_)/',$output[$i])){
        $htmlUserPass .= '    <tr>';
        $htmlUserPass .= '      <th scope="row" style="text-align:center">1</th>';
        $htmlUserPass .= '      <td nowrap="nowrap">'.trim($output[$i],'"').'</td>';
        $i++;
        $htmlUserPass .= '      <td nowrap="nowrap">'.trim($output[$i],'"').'</td>';
        $htmlUserPass .= '    </tr>';
      }
    }
  }

  $htmlUserPass .= '  </tbody>';
  $htmlUserPass .= '</table>';

  print $htmlUserPass;

}
?>