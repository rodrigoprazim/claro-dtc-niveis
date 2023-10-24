<?php
header("Content-type: text/html; charset=utf-8");
$cmtsIp = $_POST["cmtsIp"];
$cmtsName = strtolower($_POST["cmtsName"]);
$interface = $_POST["interface"];
$if_idx_cache = "/tmp/cableresult.if_idx_cache";
$community = "n0cn3t";

if(file_exists($if_idx_cache)){
  $fh = fopen($if_idx_cache,"r");
  $if_idxs = unserialize(fread($fh,filesize($if_idx_cache)));
  fclose($fh);
}

//Get CMTS Interface Descriptions
$if_desc = shell_exec("/usr/local/bin/snmpget -v2c -c $community $cmtsIp .1.3.6.1.2.1.2.2.1.2.".$if_idxs[$cmtsName][$interface]);

if(!preg_match("|".$interface."|",$if_desc)){
  exec("/usr/local/bin/snmpwalk -v2c -c $community $cmtsIp ifDescr",$output);
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
$if_snr = shell_exec("/usr/local/bin/snmpget -v2c -c $community $cmtsIp .1.3.6.1.2.1.10.127.1.1.4.1.5.".$if_idxs[$cmtsName][$interface]);

preg_match("/^.*=\s*INTEGER:\s*([^=]+)$/",$if_snr,$match);
$if_snr = $match[1]/10;

//Check empty variable
if($if_snr == "" || $if_snr == null){
  print "undefined";
} else {
  print $if_snr;
}
?>