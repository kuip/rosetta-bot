<?php

$sct_id = '138875005';
$sct_r_typeid = '116680003';
$sct_d_typeid = '900000000000003001';
$langs = ['en', 'dk', 'es', 'se'];
$files = (object) [
    'en' => [
      'sct2_Concept_Snapshot_INT_20160731.txt',
      'sct2_Description_Snapshot-en_INT_20160731.txt',
      'sct2_Relationship_Snapshot_INT_20160731.txt',
      'der2_cRefset_LanguageSnapshot-en_INT_20160731.txt',
      'sct2_TextDefinition_Snapshot-en_INT_20160731.txt'
    ],
    'dk' => [
      'sct2_Concept_Snapshot_DK1000005_20160215.txt',
      'sct2_Description_Snapshot_DK1000005_20160215.txt',
      'sct2_Relationship_Snapshot_DK1000005_20160215.txt',
      'der2_cRefset_LanguageSnapshot-da_DK1000005_20160215.txt'
    ],
    'es' => [
      'sct2_Concept_SpanishExtensionSnapshot_INT_20161031.txt',
      'sct2_Description_SpanishExtensionSnapshot-es_INT_20161031.txt',
      'sct2_Relationship_SpanishExtensionSnapshot_INT_20161031.txt',
      'der2_cRefset_LanguageSpanishExtensionSnapshot-es_INT_20161031.txt',
      'sct2_TextDefinition_SpanishExtensionSnapshot-es_INT_20161031.txt'
    ],
    'se' => [
      'sct2_Concept_Snapshot_SE1000052_20160531.txt',
      'sct2_Description_Snapshot_sv_SE1000052_20160531.txt',
      'sct2_Relationship_Snapshot_SE1000052_20160531.txt',
      'der2_cRefset_LanguageSnapshot-sv_SE1000052_20160531.txt'
    ],
  ];

function iniSnomed($pdohandle) {
  global $langs;

  foreach($langs as $lang) {
    iniSnomedLanguage($pdohandle, $lang);
  }
}

function iniSnomedLanguage($pdohandle, $lang) {
  $concept = "curr_concept_s_" . $lang;
  $relation = "curr_relationship_s_" . $lang;
  $description = "curr_description_s_" . $lang;
  $textdef = "curr_textdefinition_s_" . $lang;
  //$relationst = "curr_stated_relationship_s_" . $lang;
  $langrefset = "curr_langrefset_s_" . $lang;
  //$asocrefset = "curr_associationrefset_s_" . $lang;
  //$attrrefset = "curr_attributevaluerefset_s_" . $lang;
  //$maprefset = "curr_simplemaprefset_s_" . $lang;
  //$simplemaprefset = "curr_simplerefset_s_" . $lang;
  //$complexmaprefset = "curr_complexmaprefset_s_" . $lang;

  $pdohandle->query("

    drop table if exists " . $concept . ";
    create table " . $concept . "(
    id varchar(18) not null,
    effectivetime char(8) not null,
    active char(1) not null,
    moduleid varchar(18) not null,
    definitionstatusid varchar(18) not null,
    key idx_id(id),
    key idx_effectivetime(effectivetime),
    key idx_active(active),
    key idx_moduleid(moduleid),
    key idx_definitionstatusid(definitionstatusid)
    ) engine=myisam default charset=utf8;


    drop table if exists " . $description . ";
    create table " . $description . "(
    id varchar(18) not null,
    effectivetime char(8) not null,
    active char(1) not null,
    moduleid varchar(18) not null,
    conceptid varchar(18) not null,
    languagecode varchar(2) not null,
    typeid varchar(18) not null,
    term varchar(255) not null,
    casesignificanceid varchar(18) not null,
    key idx_id(id),
    key idx_effectivetime(effectivetime),
    key idx_active(active),
    key idx_moduleid(moduleid),
    key idx_conceptid(conceptid),
    key idx_languagecode(languagecode),
    key idx_typeid(typeid),
    key idx_casesignificanceid(casesignificanceid)
    ) engine=myisam default charset=utf8;

    drop table if exists " . $relation . ";
    create table " . $relation . "(
    id varchar(18) not null,
    effectivetime char(8) not null,
    active char(1) not null,
    moduleid varchar(18) not null,
    sourceid varchar(18) not null,
    destinationid varchar(18) not null,
    relationshipgroup varchar(18) not null,
    typeid varchar(18) not null,
    characteristictypeid varchar(18) not null,
    modifierid varchar(18) not null,
    key idx_id(id),
    key idx_effectivetime(effectivetime),
    key idx_active(active),
    key idx_moduleid(moduleid),
    key idx_sourceid(sourceid),
    key idx_destinationid(destinationid),
    key idx_relationshipgroup(relationshipgroup),
    key idx_typeid(typeid),
    key idx_characteristictypeid(characteristictypeid),
    key idx_modifierid(modifierid)
    ) engine=myisam default charset=utf8;

    drop table if exists " . $langrefset . ";
    create table " . $langrefset . "(
    id varchar(36) not null,
    effectivetime char(8) not null,
    active char(1) not null,
    moduleid varchar(18) not null,
    refsetid varchar(18) not null,
    referencedcomponentid varchar(18) not null,
    acceptabilityid varchar(18) not null,
    key idx_id(id),
    key idx_effectivetime(effectivetime),
    key idx_active(active),
    key idx_moduleid(moduleid),
    key idx_refsetid(refsetid),
    key idx_referencedcomponentid(referencedcomponentid),
    key idx_acceptabilityid(acceptabilityid)
    ) engine=myisam default charset=utf8;

    drop table if exists " . $textdef . ";
    create table " . $textdef . "(
    id varchar(18) not null,
    effectivetime char(8) not null,
    active char(1) not null,
    moduleid varchar(18) not null,
    conceptid varchar(18) not null,
    languagecode varchar(2) not null,
    typeid varchar(18) not null,
    term varchar(1024) not null,
    casesignificanceid varchar(18) not null,
    key idx_id(id),
    key idx_effectivetime(effectivetime),
    key idx_active(active),
    key idx_moduleid(moduleid),
    key idx_conceptid(conceptid),
    key idx_languagecode(languagecode),
    key idx_typeid(typeid),
    key idx_casesignificanceid(casesignificanceid)
    ) engine=myisam default charset=utf8;

  ");
  
}

function loadSnomed($pdohandle) {
  global $langs;

  foreach($langs as $lang) {
    loadSnomedLanguage($pdohandle, $lang);
  }
}

function loadSnomedLanguage($pdohandle, $lang) {
  $concept = "curr_concept_s_" . $lang;
  $relation = "curr_relationship_s_" . $lang;
  $description = "curr_description_s_" . $lang;
  $textdef = "curr_textdefinition_s_" . $lang;
  //$relationst = "curr_stated_relationship_s_" . $lang;
  $langrefset = "curr_langrefset_s_" . $lang;
  //$asocrefset = "curr_associationrefset_s_" . $lang;
  //$attrrefset = "curr_attributevaluerefset_s_" . $lang;
  //$maprefset = "curr_simplemaprefset_s_" . $lang;
  //$simplemaprefset = "curr_simplerefset_s_" . $lang;
  //$complexmaprefset = "curr_complexmaprefset_s_" . $lang;

  global $files, $langs;

  $fileNames = $files->{$lang};

  $query = "
    load data local 
      infile '/Applications/XAMPP/xamppfiles/htdocs/snomeddata/20161105/" . $fileNames[0] . "'  
      into table " . $concept . "
      columns terminated by '\\t' 
      lines terminated by '\\r\\n' 
      ignore 1 lines;

  
    load data local 
      infile '/Applications/XAMPP/xamppfiles/htdocs/snomeddata/20161105/" . $fileNames[1] . "' 
      into table " . $description . "
      columns terminated by '\\t' 
      lines terminated by '\\r\\n' 
      ignore 1 lines;


    load data local 
      infile '/Applications/XAMPP/xamppfiles/htdocs/snomeddata/20161105/" . $fileNames[2] . "'
      into table " . $relation . "
      columns terminated by '\\t' 
      lines terminated by '\\r\\n' 
      ignore 1 lines;


    load data local 
      infile '/Applications/XAMPP/xamppfiles/htdocs/snomeddata/20161105/" . $fileNames[3] . "' 
      into table " . $langrefset . "
      columns terminated by '\\t' 
      lines terminated by '\\r\\n' 
      ignore 1 lines;

  ";
  echo $query . "<br>";
  //$result = $pdohandle->query($query);

  if(count($fileNames) == 5) {
    $query2 = "
      load data local 
        infile '/Applications/XAMPP/xamppfiles/htdocs/snomeddata/20161105/" . $fileNames[4] . "' 
        into table " . $textdef . "
        columns terminated by '\\t' 
        lines terminated by '\\r\\n' 
        ignore 1 lines;

    ";
    echo $query2 . "<br>";
    //$pdohandle->query($query2);
  }


}

function cleanSnomed($pdohandle, $dbsrc, $dbdest) {
  global $langs;

  foreach($langs as $lang) {
    cleanSnomedLanguage($pdohandle, $dbsrc, $dbdest, $lang);
  }
}

function cleanSnomedLanguage($pdohandle, $dbsrc, $dbdest, $lang) {
  $concept = "curr_concept_s_" . $lang;
  $relation = "curr_relationship_s_" . $lang;
  $description = "curr_description_s_" . $lang;
  $langrefset = "curr_langrefset_s_" . $lang;

  $q = "
    INSERT INTO `" . $dbdest . "`.`" . $concept . "` (id, effectivetime, active, moduleid, definitionstatusid)
    SELECT `c`.* FROM `" . $dbsrc . "`.`" . $concept . "` AS `c`
        WHERE `active` = '1';

    INSERT INTO `" . $dbdest . "`.`" . $relation . "` (`id`, effectivetime, active, moduleid, sourceid, destinationid, relationshipgroup, typeid, characteristictypeid, modifierid)
    SELECT `c`.* FROM `" . $dbsrc . "`.`" . $relation . "` AS `c`
        WHERE `active` = '1';


    INSERT INTO `" . $dbdest . "`.`" . $description . "` (`id`, effectivetime, active, moduleid, conceptid, languagecode, typeid, term, casesignificanceid)
    SELECT `c`.* FROM `" . $dbsrc . "`.`" . $description . "` AS `c`
        WHERE `active` = '1';


    INSERT INTO `" . $dbdest . "`.`" . $langrefset . "` (`id`, effectivetime, active, moduleid, refsetid, referencedcomponentid, acceptabilityid)
    SELECT `c`.* FROM `" . $dbsrc . "`.`" . $langrefset . "` AS `c`
        WHERE `active` = '1';
  ";
  
  echo $q;
  $pdohandle->query($q);
}

function createConceptTable($pdohandle, $name=null) {
  if($name)
    $name = 'pluginconcept_' . $name;
  else
    $name = 'pluginconcept';

  $q = "
    drop table if exists " . $name . ";
    CREATE TABLE `" . $name . "` (
      `uuid` varchar(40) NOT NULL,
      `subject` varchar(255) NOT NULL,
      `lang` varchar(4) NOT NULL,
      `ontology` varchar(40) NOT NULL,
      `path` varchar(3000) NOT NULL,
      `synonyms` varchar(3000) NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    ALTER TABLE `" . $name . "`
      ADD KEY `uuid` (`uuid`),
      ADD KEY `ontology` (`ontology`);
      ADD KEY `lang` (`lang`);
      ADD key `subject` (`subject`);
  ";

  $pdohandle->query($q);

  return $name;
}

function createRelationTable($pdohandle, $name=null) {
  if($name)
    $name = "pluginrelation_" . $name;
  else
    $name = "pluginrelation";

  $q = "
    drop table if exists " . $name . ";
    CREATE TABLE `" . $name . "` (
      `uuid1` varchar(40) NOT NULL,
      `uuid2` varchar(40) NOT NULL,
      `relation` varchar(18) NOT NULL,
      `ordering` int(8) DEFAULT 1,
      `ontology` varchar(40) DEFAULT NULL,
      `upd` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

    ALTER TABLE `" . $name . "`
      ADD KEY `uuid1` (`uuid1`),
      ADD KEY `uuid2` (`uuid2`),
      ADD KEY `ontology` (`ontology`);
      ADD KEY `relation` (`relation`);
  ";

  $pdohandle->query($q);

  return $name;
}

function createOntologyTable($pdohandle) {

  $q = "
    drop table if exists pluginontology;
    CREATE TABLE `pluginontology` (
      `uuid` varchar(40) NOT NULL,
      `title` varchar(255) NOT NULL,
      `description` varchar(255) NOT NULL,
      `lang` varchar(4) NOT NULL,
      `relation_type` varchar(18) NOT NULL,
      `upd` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  
    ALTER TABLE `pluginontology`
      ADD KEY `uuid` (`uuid`),
      ADD KEY `lang` (`lang`);
      ADD KEY `relation_type` (`relation_type`);
  ";

  $pdohandle->query($q);

  return 'pluginontology';
}

function createOntologies($pdohandle) {
  createOntologyTable($pdohandle);
  createConceptTable($pdohandle);
  createRelationTable($pdohandle);

  // Create SNOMED CT ontology entry for language code
  global $sct_id, $sct_r_typeid;
  $snouuid = UUID::v4();
  $pdohandle->query("
      INSERT INTO `pluginontology` (uuid, title, description, lang, relation_type) VALUES ('" . $snouuid . "', '" . $sct_id . "', 'SNOMED Clinical Terms', 'code', '" . $sct_r_typeid . "');
    ");

  global $langs;

  foreach($langs as $lang) {
    createOntologiesLanguage($pdohandle, $lang, $snouuid);
  }
}

function createOntologiesLanguage($pdohandle, $lang, $snouuid) {
  global $sct_id, $sct_d_typeid;
  $concept = "curr_concept_s_" . $lang;
  $relation = "curr_relationship_s_" . $lang;
  $description = "curr_description_s_" . $lang;
  $langrefset = "curr_langrefset_s_" . $lang;

  // Create SNOMED CT ontology entry for that language
  $snomedq = "
    SELECT DISTINCT c.id, d.term, d.languagecode, r.typeid, STR_TO_DATE(r.effectivetime,'%Y%m%d %h%i%s') as effectivetime FROM `" . $concept . "` c INNER JOIN (`" . $description . "` d, `" . $relation . "` r) ON c.id = d.conceptid AND c.id = '" . $sct_id . "' AND d.typeid = '" . $sct_d_typeid . "' ORDER BY effectivetime DESC LIMIt 1;
  ";
  $snomed = $pdohandle->query($snomedq);

  foreach($snomed as $ind=>$row) {
    $qu = "
      INSERT INTO `pluginontology` (uuid, title, description, lang, relation_type) VALUES ('" . $snouuid . "', '" . $row["term"] . "', '" . $row["term"] . "', '" . $row["languagecode"] . "', '" . $row["typeid"] . "');
    ";
    $pdohandle->query($qu);
    $pdohandle->query("
        INSERT INTO `pluginontology` (uuid, title, description, lang, relation_type) VALUES ('" . $snouuid . "', '" . $row['id'] . "', '" . $row["term"] . "', 'code', '" . $row["typeid"] . "');
      ");
    $pdohandle->query("
        INSERT INTO `pluginconcept` (uuid, subject, lang, ontology) VALUES ('" . $snouuid . "', '" . $row["term"] . "', '" . $row["languagecode"] . "', '" . $snouuid . "');
      ");

    $pdohandle->query("
        INSERT INTO `pluginconcept` (uuid, subject, lang, ontology) VALUES ('"  . $snouuid . "', '" . $row["id"] . "', 'code', '" . $snouuid . "');
      ");
  }

  $path = [$snouuid];

  insertChildren($pdohandle, $lang, "pluginconcept", "pluginrelation", $sct_id, $snouuid, $snouuid, $path);
}

function insertChildren($pdohandle, $lang, $conceptsName, $relationsName, $conceptId, $uuid, $ontoid, $path) {
  global $sct_d_typeid;
  $concept = "curr_concept_s_" . $lang;
  $relation = "curr_relationship_s_" . $lang;
  $description = "curr_description_s_" . $lang;
  $langrefset = "curr_langrefset_s_" . $lang;
  
  $q = "
    SELECT DISTINCT
      c.id,
      d.term,
      d.languagecode,
      r.sourceid,
      r.typeid,
      STR_TO_DATE(r.effectivetime,'%Y%m%d %h%i%s') as effectivetime
      FROM `" . $concept . "` c
      INNER JOIN (`" . $description . "` d, `" . $relation . "` r)
      ON c.id = d.conceptid AND r.sourceid = c.id AND r.destinationid = '" . $conceptId . "' AND d.typeid = '" . $sct_d_typeid . "';
  ";

  $res = $pdohandle->query($q);

  if(!$res)
    echo $conceptId . '<br>';
  else {
    foreach($res as $ind=>$row) {
      // Calculate concept's structural path
      $path_c = $path;
      // See if concept exists in the db at all. If not, insert language code
      // We look for the id, because this is language code
      $exists = $pdohandle->query("
        SELECT * FROM `" . $conceptsName . "` WHERE subject = '" . $row["id"] . "'
      ");

      if(!$exists || $exists->rowCount() === 0) {
        $kuuid = UUID::v4();

        // Hierarchical path value
        $path_c[] = $kuuid;

        // Insert language and code
        $pdohandle->query("
          INSERT INTO `" . $conceptsName . "` (uuid, subject, lang, ontology, path) VALUES ('"  . $kuuid .  "', '" . $row["id"] . "', 'code', '" . $ontoid . "', '" . join(",", $path_c) . "');
        ");

        // Insert relation between concept and this kid
        $pdohandle->query("
          INSERT INTO `" . $relationsName . "` (uuid1, uuid2, relation, upd, ontology)
            VALUES ('"  . $kuuid . "', '" . $uuid . "', '" . $row["typeid"] . "', '" . $row["effectivetime"] . "', '" . $ontoid . "');
        ");
      }
      else {
        $r = $exists->fetch(PDO::FETCH_ASSOC);
        $kuuid = $r['uuid'];
        $path_c[] = $kuuid;
      }

      // Check if concept exists for this language
      $exists = $pdohandle->query("
        SELECT subject FROM `" . $conceptsName . "` WHERE uuid = '" . $kuuid . "' AND lang = '" . $row["languagecode"] . "'
      ");

      if(!$exists || $exists->rowCount() === 0) {

        // Insert subject in this language
        $qi = "INSERT INTO `" . $conceptsName . "` (uuid, subject, lang, ontology, path)
          VALUES ('"  . $kuuid .  "', '" . $row["term"] . "', '" . $row["languagecode"] . "', '" . $ontoid . "', '" . join(",", $path_c) . "');
        ";
        $pdohandle->query($qi);
      }

      //insert all relations found on this $concept as destinationid as part of this ontology
      $hasrel = $pdohandle->query("
        SELECT uuid1, uuid2, relation FROM `" . $relationsName . "` WHERE uuid1 = '" . $kuuid . "' AND uuid2 = '" . $uuid . "' AND relation = '" . $row["typeid"] . "'
      ");

      if(!$hasrel || $hasrel->rowCount() === 0) {
        // Insert relation between concept and this kid
        $pdohandle->query("
          INSERT INTO `" . $relationsName . "` (uuid1, uuid2, relation, upd, ontology)
            VALUES ('"  . $kuuid . "', '" . $uuid . "', '" . $row["typeid"] . "', '" . $row["effectivetime"] . "', '" . $ontoid . "');
        ");
      }

      //check if the relation is : "is a" and loop through its descendants.
      if($row['typeid'] === '116680003') {
        insertChildren($pdohandle, $lang, $conceptsName, $relationsName, $row["id"], $kuuid, $ontoid, $path_c);
      }
    }
  }
}


function removeQuotes($pdohandle, $name) {
  $q = "
    UPDATE `" . $name . "`
      SET term = REPLACE(term, '\"',\"'\"), synonyms = REPLACE(synonyms, '\"',\"'\")
      WHERE term LIKE '%\"%' OR synonyms LIKE '%\"%'
  ";

  $pdohandle->query($q);
}


function findSynonims($pdohandle) {
  $find = $pdohandle->query("
    SELECT subject FROM `pluginconcept` WHERE lang = 'code'
  ");

  foreach($find as $row) {
    $synon = $pdohandle->query("
      SELECT term FROM `" . $description . "` WHERE conceptid = '" . $row['subject'] . "'
    ");

    if($synon) {
      $synon = $synon->fetch();
      $synon = implode('|||', $synon);
    }

    $q = "
      UPDATE `pluginconcept` SET synonyms = '" . $synon . "'
      WHERE uuid = '" . $row['uuid'] . "' AND lang = 'en'
    ";

    $pdohandle->query($q);
  }
  
}

function getFields($pdohandle, $table) {
  $rs = $pdohandle->query("SELECT * FROM `" . $table . "` LIMIT 0");
  for ($i = 0; $i < $rs->columnCount(); $i++) {
      $col = $rs->getColumnMeta($i);
      $columns[] = $col['name'];
  }
  return $columns;
}

function exportJSON($pdohandle, $table) {
  $f = '/Applications/XAMPP/xamppfiles/htdocs/snomeddata/' . $table . '.json';
  file_put_contents($f, '');

  $fields = getFields($pdohandle, $table);

  if(($key = array_search('id', $fields)) !== false) {
    unset($fields[$key]);
  }

  
  $q = "SELECT * FROM `" . $table . "` WHERE 1";

  $rows = $pdohandle->query($q);
  foreach($rows as $row) {

    $json = '{';

    foreach($fields as $fi) {
      $json = $json . '"' . $fi . '": "' . $row[$fi] . '", ';
    }

    $json = substr($json, 0, strlen($json)-2);
    $json = $json . "}" . "\n";

    //echo $json . '<br>';

    file_put_contents($f, $json, FILE_APPEND | LOCK_EX);
  }
}


class UUID {
  public static function v3($namespace, $name) {
    if(!self::is_valid($namespace)) return false;

    // Get hexadecimal components of namespace
    $nhex = str_replace(array('-','{','}'), '', $namespace);

    // Binary Value
    $nstr = '';

    // Convert Namespace UUID to bits
    for($i = 0; $i < strlen($nhex); $i+=2) {
      $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
    }

    // Calculate hash value
    $hash = md5($nstr . $name);

    return sprintf('%08s-%04s-%04x-%04x-%12s',

      // 32 bits for "time_low"
      substr($hash, 0, 8),

      // 16 bits for "time_mid"
      substr($hash, 8, 4),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 3
      (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

      // 48 bits for "node"
      substr($hash, 20, 12)
    );
  }

  public static function v4() {
    return sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',

      // 32 bits for "time_low"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

      // 16 bits for "time_mid"
      mt_rand(0, 0xffff),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 4
      mt_rand(0, 0x0fff) | 0x4000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      mt_rand(0, 0x3fff) | 0x8000,

      // 48 bits for "node"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
  }

  public static function v5($namespace, $name) {
    if(!self::is_valid($namespace)) return false;

    // Get hexadecimal components of namespace
    $nhex = str_replace(array('-','{','}'), '', $namespace);

    // Binary Value
    $nstr = '';

    // Convert Namespace UUID to bits
    for($i = 0; $i < strlen($nhex); $i+=2) {
      $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
    }

    // Calculate hash value
    $hash = sha1($nstr . $name);

    return sprintf('%08s-%04s-%04x-%04x-%12s',

      // 32 bits for "time_low"
      substr($hash, 0, 8),

      // 16 bits for "time_mid"
      substr($hash, 8, 4),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 5
      (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

      // 48 bits for "node"
      substr($hash, 20, 12)
    );
  }

  public static function is_valid($uuid) {
    return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
                      '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
  }
}

// Usage
// Named-based UUID.
//$v3uuid = UUID::v3('1546058f-5a25-4334-85ae-e68f2a44bbaf', 'SomeRandomString');
//$v5uuid = UUID::v5('1546058f-5a25-4334-85ae-e68f2a44bbaf', 'SomeRandomString');

// Pseudo-random UUID

//$v4uuid = UUID::v4();


/* structure:

concept:
uuid
subject
lang
ontology
synonyms
optional

relation:
concept1
concept2
relation
ordering
updatedAt
ontology

ontology
concept
title
description
language
relation_type
updatedAt

*/

?>