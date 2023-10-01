<?php
// Lisez le contenu du fichier JSON
$jsonFile = './verification.json'; // Remplacez par le chemin réel de votre fichier JSON

// Lisez le fichier JSON en tant qu'objet PHP
$data = json_decode(file_get_contents($jsonFile));

// Récupérez les données envoyées depuis Roblox
$dataFromRoblox = json_decode(file_get_contents("php://input"));

// Recherchez l'ID et la clé dans le fichier JSON
$idToCheck = $dataFromRoblox->id;
$keyToCheck = $dataFromRoblox->key;

$valid = false;

foreach ($data->utilisateurs as $utilisateur) {
    if ($utilisateur->id === $idToCheck && $utilisateur->cle === $keyToCheck) {
        $valid = true;
        break; // Sortez de la boucle dès que vous avez une correspondance
    }
}

// Répondez à Roblox avec le résultat au format JSON
$response = array("valid" => $valid);
header("Content-Type: application/json");
echo json_encode($response);
?>