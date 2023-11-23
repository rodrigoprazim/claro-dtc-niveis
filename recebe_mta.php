<?php
include('variables.php');
$ds_local = ldap_connect($vGlobal['ip_ldap']);

//set headers to NOT cache a page
header("Content-type: text/html; charset=utf-8"); //Charset
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); //Date in the past

$modem = $_POST['mta_mac'];
$contexto = "dc=mta,dc=".$vGlobal['dc_ldap'];
$prog = "/dados/coletor/mta_query";

if(!$ds_local){
  die ("Impossivel conectar ao server LDAP, Contate o Datacenter.");
}

$r = ldap_bind($ds_local,"uid=datacenter,dc=virtua","dc2003");
if($r == FALSE){
  die("LDAP: Usuario ou senha invalidos.");
}

if($modem != ""){
  $mac = "1,6,".substr($modem,0,2).":".substr($modem,2,2).":".substr($modem,4,2).":".substr($modem,6,2).":".substr($modem,8,2).":".substr($modem,10,2);

  $sr = ldap_search($ds_local,$contexto, "docsismodemmacaddress=$mac");
  $info = ldap_get_entries($ds_local, $sr);

  if($info["count"] > 0){
    $obj->mac = $modem;
    $obj->num_tel1 = $info[0]['docsisntel'][0];
    $obj->num_tel2 = $info[0]['docsisntel'][1];
    $obj->policy_name = $info[0]['docsispolicyname'][0];
    $obj->contrato = $info[0]['docsiscontrato'][0];
    $obj->fqdn = $info[0]['docsishostname'][0];
  }
}

$provstate_desc = array("IDX0","PASS","IN_PROGRESS","FAIL CONFIG FILE ERROR","PASS WITH WARNINGS","PASS WITH INCOMPLETE PARSING","FAILURE INTERNAL ERROR","FAILURE OTHER REASON");

/* verifica se o DNS esta de acordo */
$fqdn = $info[0]['docsishostname'][0].".".$vGlobal['sigla_cidade'].".virtua.com.br";
$cmdline = ("/usr/sbin/dig @".$vGlobal['dns_proxy']." ".$fqdn." +noall +answer +short");
$result = shell_exec($cmdline);
if($result != ''){
  $obj->dns = 1;
} else {
  $obj->dns = 0;
}
print json_encode($obj);
?>
