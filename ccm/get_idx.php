<?php
include('../variables.php');

header("Content-type: text/html; charset=utf-8");
$cmtsIp = $_POST["cmtsIp"];
$cmtsName = strtolower($_POST["cmtsName"]);
$interface = $_POST["interface"];
$idx_primary = $_POST["idx_primary"];
$if_idx_cache = "/tmp/cableresult.if_idx_cache";

/* // Configuração antiga.
if(file_exists($if_idx_cache)){
  $fh = fopen($if_idx_cache,"r");
  $if_idxs = unserialize(fread($fh,filesize($if_idx_cache)));
  fclose($fh);
}

//Get CMTS Interface Descriptions
$if_desc = shell_exec("/usr/local/bin/snmpget -v2c -c ".$vGlobal['community_cmts']." ".$cmtsIp." .1.3.6.1.2.1.2.2.1.2.".$if_idxs[$cmtsName][$interface]);

if(!preg_match("|".$interface."|",$if_desc)){
  exec("/usr/local/bin/snmpwalk -v2c -c ".$vGlobal['community_cmts']." ".$cmtsIp." ifDescr", $output);
  $if_idxs = array();
  foreach ($output as $desc){
    if (preg_match("/\.([0-9]+)\s*=\s*STRING:\s*(.*)$/",$desc,$match)){
      $if_idxs[$cmtsName][$match[2]] = $match[1];
    };
  };
  $fh = fopen($if_idx_cache,"w");
  fwrite($fh,serialize($if_idxs));
  fclose($fh);
};

//Get SNR Interface Upstream
$if_snr = shell_exec("/usr/local/bin/snmpget -v2c -c ".$vGlobal['community_cmts']." ".$cmtsIp." .1.3.6.1.2.1.10.127.1.1.4.1.5.".$if_idxs[$cmtsName][$interface]);
*/

//Get SNR Interface Upstream
$if_snr = shell_exec("/usr/local/bin/snmpget -v2c -c ".$vGlobal['community_cmts']." ".$cmtsIp." .1.3.6.1.2.1.10.127.1.1.4.1.5.".$idx_primary);

preg_match("/^.*=\s*INTEGER:\s*([^=]+)$/",$if_snr,$match);

$if_snr = $match[1]/10;

// Get Description (NODE) of interface
$if_desc = shell_exec("/usr/local/bin/snmpget -v2c -c ".$vGlobal['community_cmts']." ".$cmtsIp." .1.3.6.1.2.1.31.1.1.1.18.".$idx_primary);

preg_match("/^.*=\s*STRING:\s*([^=]+)$/",$if_desc,$match);

$if_desc = strtoupper(preg_replace('/[^0-9a-zA-Z]/', '', $match[1]));

//Check empty variable
if(empty($if_snr)){
  print '<font color="red">Erro</font>';
} else {
  if($if_snr >= 35){
    print '<font color="green">'.$if_snr.' dbmV</font> <b>('.$if_desc.')</b>';
  }else{
    print '<font color="red">'.$if_snr.' dbmV</font> <b>('.$if_desc.')</b>';
  }
}
?>