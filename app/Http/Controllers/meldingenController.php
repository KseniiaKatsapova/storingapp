<?php

//Variabelen vullen
$attractie = $_POST['attractie'] ?? "";

if(is_numeric($_POST['capaciteit'])){
    $capaciteit = $_POST['capaciteit'];
} else {
    $capaciteit = 0;
}
$melder = $_POST['melder'] ?? "";

$allowed_types = ['achtbaan', 'draaiend', 'water', 'overig'];
if(in_array($_POST['type'], $allowed_types, true)){
    $type = $_POST['type'];
} else {
    $type = "";
}
$overige = $_POST['overige'] ?? "";
//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = "
   INSERT INTO meldingen 
          (melder, attractie, capaciteit, type, overige_info)
   VALUES 
        (:melder, :attractie, :capaciteit, :type, :overige)
";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
":melder" =>$melder,
":capaciteit" =>$capaciteit,
":attractie" =>$attractie,
":type" =>$type,
":overige" =>$overige
]);

header('Location: '. $base_url .'/resources/views/meldingen/index.php?msg=Je melding is opgeslagen');
exit;