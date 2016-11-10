<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
<body>

<?php

//change mysql credentials

  require 'inidata.php';

  $local = 'mysql:host=192.168.1.116';
  $user = 'lore';
  $pass = 'lore';

  $local = 'mysql:host=localhost';
  $user = 'root';
  $pass = '';

  //$local = 'mysql:host=localhost';
  //$user = 'rosetta';
  //$pass = 'tezeus';

  $snoname = 'snomed-current_201611';
  $snonameA = 'snomed-current-active_201611';

  $ontoIni = new PDO($local . ';dbname='. $snoname, $user, $pass);
  $onto = new PDO($local . ';dbname='. $snonameA, $user, $pass);

  //initialize tables
  //iniSnomed($ontoIni); // snomed snapshot data
  //loadSnomed($ontoIni); // at this point, this does not work, but it echoes the sql commands
  // that can be used directly in phpmyadmin

  //iniSnomed($onto); // only active concepts
  //cleanSnomed($onto, $snoname, $snonameA);
  
  //form ontology tables
  //createOntologies($onto);

  //add Synon
  //findSynonims($onto);

  //removeQuotes($onto, 'pluginconcept');

  //write to file
  //exportJSON($onto, 'pluginontology');
  //exportJSON($onto, 'pluginconcept');
  //exportJSON($onto, 'pluginrelation');

  $sno = null;
  $onto = null;
  $ontoIni = null;

?>

</body>
</html>