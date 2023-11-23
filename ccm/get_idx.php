<?php
include('../variables.php');

header("Content-type: text/html; charset=utf-8");
$cmtsIp = $_POST["cmtsIp"];
$idx_primary = $_POST["idx_primary"];

//Get SNR Interface Upstream
$if_snr = shell_exec("/usr/local/bin/snmpget -v2c -c ".$vGlobal['community_cmts']." ".$cmtsIp." .1.3.6.1.2.1.10.127.1.1.4.1.5.".$idx_primary);

preg_match("/^.*=\s*INTEGER:\s*([^=]+)$/",$if_snr,$match);

$if_snr = $match[1]/10;

// Get Description (NODE) of interface
$if_desc = shell_exec("/usr/local/bin/snmpget -v2c -c ".$vGlobal['community_cmts']." ".$cmtsIp." .1.3.6.1.2.1.31.1.1.1.18.".$idx_primary);

preg_match("/^.*=\s*STRING:\s*([^=]+)$/",$if_desc,$match);

$if_desc = strtoupper(preg_replace('/[^0-9a-zA-Z]/', '', $match[1]));

$obj->if_desc = '('.$if_desc.')';

//Check empty variable
if(empty($if_snr)){
  $obj->snr = '<font color="red">Erro</font>';
} else {
  if($if_snr >= 35){
    $obj->snr = '<font color="green">'.$if_snr.' dbmV</font>';
  }else{
    $obj->snr = '<font color="red">'.$if_snr.' dbmV</font>';
  }
}

print json_encode($obj);
?>