<?php
include('variables.php');
include($vGlobal['dirPath']."ldap_local.php");

//set headers to NOT cache a page
header("Content-type: text/html; charset=utf-8"); //Charset
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

function searchContrato($dataSearch){
  global $vGlobal;
  global $ds_local;
  $contexto = "dc=".$vGlobal['dc_ldap'];

  if (!$ds_local){
    die ("Impossivel conectar ao server LDAP .... contate o Datacenter");
  }
  
  $r = ldap_bind($ds_local,"uid=datacenter,dc=virtua", "dc2003");
  if ($r == FALSE){
    die ("Usuario ou senha invalidos ");
  }
  
  $sr = ldap_search($ds_local,$contexto,"(&(docsiscontrato=$dataSearch)(objectclass=docsismodem))");
  $info = ldap_get_entries($ds_local, $sr);
  return json_encode($info);
}

function searchMacLdap($dataSearch){
  global $vGlobal;
  global $ds_local;
  $contexto = "dc=".$vGlobal['dc_ldap'];

  if (!$ds_local){
    die ("Impossivel conectar ao server LDAP .... contate o Datacenter");
  }

  $r = ldap_bind($ds_local,"uid=datacenter,dc=virtua", "dc2003");
  if ($r == FALSE){
    die ("Usuario ou senha invalidos ");
  }

  $sr = ldap_search($ds_local,$contexto,"(&(docsismodemmacaddress=$dataSearch)(objectclass=docsismodem))");
  $info = ldap_get_entries($ds_local, $sr);
  return $info;
}

function searchMac($dataSearch){
  $strPath  = "/dados/coletor/";
  $cfg_file = $strPath."cmts.cfg";
  $str = $strPath."consulta_cable_ng31 -m ".$dataSearch." -f ".$cfg_file;
  $data = exec($str, $array);
  $data = "";
  foreach($array as $value){
    $data .=  $value;
  }

  return $data;
}

if(isset($_POST)){
  $search = $_POST["search"];
  $consulta = $_POST["consulta"];
  $result = array('docsis' => '', 'ldap' => '');
  if($search == "contrato"){
    print searchContrato($consulta);
  } else if($search == "mac"){
    $result['docsis'] = searchMac($consulta);
    $ldapmac = "1,6,".substr($consulta,0,2).":".substr($consulta,2,2).":".substr($consulta,4,2).":".substr($consulta,6,2).":".substr($consulta,8,2).":".substr($consulta,10,2);
    $result['ldap'] = searchMacLdap($ldapmac);
    print json_encode($result);
  }
}
?>
