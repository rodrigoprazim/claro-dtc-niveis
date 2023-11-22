<?php
if(isset($_GET)){
  $IP = $_GET["ip_cm"];
  $MODELO = $_GET["modelo"];

  // Array['MODELO' => 'ID_OID'];
  $terminais_permitidos = array(
    'HI3120'      => 1,
    'TG3442A-NT'  => 1,
    'TG1692A'     => 3,
    'HGJ310'      => 1,
    'HGB10R-02'   => 1,
    'CG3000'      => 1,
    'CG3600T'     => 1,
    'CGA4233CLB'  => 1,
    'CGA437ACLB'  => 1,
    'TC3102'      => 1,
    'TC3106'      => 1,
    'CH8568'      => 1,
    'FAST3895'    => 2,
    'FAST3890V2'  => 2,
    'FAST3896'    => 2,
    'FAST3896-15' => 2,
    'F@ST3486AC'  => 2,
    'TC7337'      => 2
  );

  if($terminais_permitidos[$MODELO] == 1){
    $oids = array( //HI3120, HGJ310, HGB10R-02, CG3000, CG3600T, CGA4233CLB, CGA437ACLB, TC3102, TC3106, CH8568
      'ssid_24' => '1.3.6.1.4.1.4491.2.5.1.1.4.1.10.10001',
      'ssid_54' => '1.3.6.1.4.1.4491.2.5.1.1.4.1.10.10101',
      'pwd_24' => '1.3.6.1.4.1.4491.2.5.1.1.7.1.5.10001',
      'pwd_54' => '1.3.6.1.4.1.4491.2.5.1.1.7.1.5.10101',
      'apply' => '1.3.6.1.4.1.4491.2.5.1.1.1.6.0',
      'steering' => '1.3.6.1.4.1.4491.2.5.1.1.1.5.0'
    );
  }else if($terminais_permitidos[$MODELO] == 2){ // FAST3895, FAST3890V2, FAST3896, FAST3896-15, F@ST3486AC, TC7337
    $oids = array(
      'ssid_24' => '1.3.6.1.4.1.4413.2.2.2.1.18.1.2.1.1.3.10001',
      'ssid_54' => '1.3.6.1.4.1.4413.2.2.2.1.18.1.2.1.1.3.10101',
      'pwd_24' => '1.3.6.1.4.1.4413.2.2.2.1.18.1.2.3.4.1.2.10001',
      'pwd_54' => '1.3.6.1.4.1.4413.2.2.2.1.18.1.2.3.4.1.2.10101',
      'apply' => '1.3.6.1.4.1.4413.2.2.2.1.18.1.1.1.0',
      'steering' => '1.3.6.1.4.1.4413.2.2.2.1.18.1.1.7.0'
    );
  }else if($terminais_permitidos[$MODELO] == 3){ // TG1692A
    $oids = array(
      'ssid_24' => '1.3.6.1.4.1.4115.1.20.1.1.3.22.1.2.10001',
      'ssid_54' => '1.3.6.1.4.1.4115.1.20.1.1.3.22.1.2.10101',
      'pwd_24' => '1.3.6.1.4.1.4115.1.20.1.1.3.26.1.2.10001',
      'pwd_54' => '1.3.6.1.4.1.4115.1.20.1.1.3.26.1.2.10101',
      'apply' => '1.3.6.1.4.1.4115.1.20.1.1.9.0',
      'steering' => '1.3.6.1.4.1.4115.1.20.1.1.3.67.2.0'
    );
  }

  if($MODELO == 'TG3442A-NT'){
    $oids['steering'] = '1.3.6.1.4.1.4115.1.20.4.1.3.0';
  }else if($MODELO == 'CH8568'){
    $oids['steering'] = '1.3.6.1.4.1.35604.2.3.19.1.0';
  }else if($MODELO == 'HI3120'){
    $oids['steering'] = '1.3.6.1.4.1.4491.2.5.1.1.1.7.0';
  }else if($MODELO == 'TC7337'){
    $oids['steering'] = NULL;
  }

  $key = array_search($MODELO, array_keys($terminais_permitidos));
  if($key !== FALSE){
    echo '<pre>';
    print_r($key);
    echo '<br>';
    print_r($oids);
    echo '<br>';
    //--------------------------------

    $str1 = "/usr/local/bin/snmpget -On -v2c -c public ".$IP." ".$oids['ssid_24'];
    exec($str1,$output1);
    $data1 = explode('STRING:',$output1[0]);
    print_r($data1);
    echo '<br>';
    //--------------------------------

    $str2 = "/usr/local/bin/snmpget -On -v2c -c public ".$IP." ".$oids['ssid_54'];
    exec($str2,$output2);
    $data2 = explode('STRING:',$output2[0]);
    print_r($data2);
    echo '<br>';
    //--------------------------------

    $str3 = "/usr/local/bin/snmpget -On -v2c -c public ".$IP." ".$oids['pwd_24'];
    exec($str3,$output3);
    $data3 = explode('STRING:',$output3[0]);
    print_r($data3);
    echo '<br>';
    //--------------------------------

    $str4 = "/usr/local/bin/snmpget -On -v2c -c public ".$IP." ".$oids['pwd_54'];
    exec($str4,$output4);
    $data4 = explode('STRING:',$output4[0]);
    print_r($data4);
    echo '</pre>';
  }
/*
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
*/
}
?>