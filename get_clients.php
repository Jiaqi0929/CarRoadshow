<?php
// get_clients.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Include database configuration with proper path
$configPath = __DIR__ . '/config.php';
if (!file_exists($configPath)) {
    echo json_encode([
        'success' => false,
        'message' => 'Config file not found at: ' . $configPath
    ]);
    exit;
}

require_once $configPath;

$response = ['success' => false, 'message' => 'Unknown error', 'clients' => [], 'count' => 0];

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Test if connection works
    if (!$db) {
        throw new Exception("Failed to connect to database");
    }
    
    $query = "SELECT * FROM clients ORDER BY registration_date DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $clients = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $clients[] = [
            'id' => $row['id'],
            'fullName' => $row['full_name'],
            'contactNumber' => $row['contact_number'],
            'email' => $row['email'],
            'gender' => $row['gender'],
            'ageRange' => $row['age_range'],
            'monthlyIncome' => $row['monthly_income'],
            'consultant' => $row['consultant'],
            'carModel' => json_decode($row['car_model'], true) ?: [],
            'testDrive' => $row['test_drive'],
            'drivingLicenseExpiryDate' => $row['driving_license_expiry'],
            'registrationDate' => $row['registration_date'],
            'fileName' => $row['file_name']
        ];
    }
    
    $response = [
        'success' => true,
        'clients' => $clients,
        'count' => count($clients)
    ];
    
} catch(PDOException $exception) {
    error_log("Database error in get_clients.php: " . $exception->getMessage());
    $response['message'] = 'Database error: ' . $exception->getMessage();
} catch(Exception $e) {
    error_log("Error in get_clients.php: " . $e->getMessage());
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>