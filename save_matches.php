<?php
// save_matches.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$input = json_decode(file_get_contents('php://input'), true);

if ($input) {
    $file = 'matches.json';
    $currentData = json_decode(file_get_contents($file), true);
    
    // Mettre à jour les données
    $currentData['matches'] = $input['matches'];
    $currentData['currentMatch'] = $input['currentMatch'];
    
    // Sauvegarder
    file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT));
    
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Données invalides']);
}
?>