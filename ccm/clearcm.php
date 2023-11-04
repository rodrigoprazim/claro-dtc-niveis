<?php
if(isset($_POST)){
  $mac = $_POST["mac"];
  $str = "/dados/coletor/clear_cable_docsis -m ".$mac." -f /dados/coletor/cmts.cfg";
  exec($str, $array);
  if ($array[0] = 1){
    print '0';
  } else {
    print '1';
  }
}
?>
