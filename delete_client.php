<?php
// delete_client.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Include database configuration
$configPath = __DIR__ . '/config.php';
if (!file_exists($configPath)) {
    echo json_encode([
        'success' => false,
        'message' => 'Config file not found'
    ]);
    exit;
}

require_once $configPath;

$response = ['success' => false, 'message' => 'Unknown error'];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the raw POST data
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        $clientId = $data['id'] ?? null;
        
        if (!$clientId) {
            throw new Exception('Client ID is required');
        }
        
        // Connect to database
        $database = new Database();
        $db = $database->getConnection();
        
        // First, get the file name to delete the uploaded file
        $query = "SELECT file_name FROM clients WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $clientId);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $client = $stmt->fetch(PDO::FETCH_ASSOC);
            $fileName = $client['file_name'];
            
            // Delete the client record
            $query = "DELETE FROM clients WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $clientId);
            
            if ($stmt->execute()) {
                // Delete the associated file if it exists
                if ($fileName && file_exists('uploads/' . $fileName)) {
                    unlink('uploads/' . $fileName);
                }
                
                $response = [
                    'success' => true,
                    'message' => 'Client deleted successfully'
                ];
            } else {
                throw new Exception('Failed to delete client from database');
            }
        } else {
            throw new Exception('Client not found');
        }
        
    } else {
        $response['message'] = 'Invalid request method';
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>