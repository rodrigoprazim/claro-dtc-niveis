<?php
if(isset($_POST)){
  $IP = $_POST["ip_cm"];
  if($_POST['funcao'] == 'clearlog'){

    $str = "/usr/local/bin/snmpset -v2c -c public ".$IP." .1.3.6.1.2.1.69.1.5.1.0 i 1";

  }elseif($_POST['funcao'] == 'forceupdate'){

    $str = "/usr/local/bin/snmpset -v2c -c public ".$IP." .1.3.6.1.2.1.69.1.3.3.0 i 1";

  }elseif($_POST['funcao'] == 'forcereboot'){

    $str = "/usr/local/bin/snmpset -v2c -c public ".$IP." .1.3.6.1.2.1.69.1.1.3.0 i 1";

  }
  
  if(isset($str)){
    exec($str,$output,$exitCode);
    print $exitCode;
  }else{
    print '1';
  }
}
?>