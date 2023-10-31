<?php
if(isset($_POST)){
  $IP = $_POST["ip_cm"];
  $str = "/usr/local/bin/snmpset -v2c -c public ".$IP." .1.3.6.1.2.1.69.1.5.1.0 i 1";
  exec($str,$output,$exitCode);
  print $exitCode;
}
?>