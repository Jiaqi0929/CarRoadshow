<?php
// submit_client.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle preflight request
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

$response = ['success' => false, 'message' => 'Unknown error'];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Get form data
        $fullName = $_POST['fullName'] ?? '';
        $contactNumber = $_POST['contactNumber'] ?? '';
        $email = $_POST['email'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $ageRange = $_POST['ageRange'] ?? '';
        $monthlyIncome = $_POST['monthlyIncome'] ?? '';
        $consultant = $_POST['consultant'] ?? '';
        $carModels = $_POST['carModel'] ?? [];
        $testDrive = $_POST['testDrive'] ?? '';
        $drivingLicenseExpiryDate = $_POST['drivingLicenseExpiryDate'] ?? '';
        
        // Validate required fields
        if (empty($fullName) || empty($contactNumber) || empty($email)) {
            throw new Exception('Please fill in all required fields');
        }
        
        // Handle file upload
        $fileName = '';
        if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';

            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    throw new Exception('Failed to create upload directory');
                }
                chmod($uploadDir, 0755);
            }

            // Check if directory is writable
            if (!is_writable($uploadDir)) {
                throw new Exception('Upload directory is not writable');
            }
            
            $fileName = basename($_FILES['fileUpload']['name']);
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];
            
            if (!in_array($fileExtension, $allowedExtensions)) {
                throw new Exception('Invalid file type. Allowed: JPG, PNG, PDF, DOC, DOCX');
            }
            
            if ($_FILES['fileUpload']['size'] > 10 * 1024 * 1024) {
                throw new Exception('File size must be less than 10MB');
            }
            
            $newFileName = uniqid() . '_' . $fileName;
            $filePath = $uploadDir . $newFileName;
            
            if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $filePath)) {
                $fileName = $newFileName;
            } else {
                throw new Exception('Failed to upload file');
            }
        } else {
            throw new Exception('Please upload your driving license');
        }
        
        // Connect to database and insert data
        $database = new Database();
        $db = $database->getConnection();
        
        // Convert car models array to JSON for storage
        $carModelsJson = json_encode($carModels);
        
        $query = "INSERT INTO clients (full_name, contact_number, email, gender, age_range, monthly_income, consultant, car_model, test_drive, driving_license_expiry, file_name, registration_date) 
                  VALUES (:full_name, :contact_number, :email, :gender, :age_range, :monthly_income, :consultant, :car_model, :test_drive, :driving_license_expiry, :file_name, NOW())";
        
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':contact_number', $contactNumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':age_range', $ageRange);
        $stmt->bindParam(':monthly_income', $monthlyIncome);
        $stmt->bindParam(':consultant', $consultant);
        $stmt->bindParam(':car_model', $carModelsJson);
        $stmt->bindParam(':test_drive', $testDrive);
        $stmt->bindParam(':driving_license_expiry', $drivingLicenseExpiryDate);
        $stmt->bindParam(':file_name', $fileName);
        
        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Registration submitted successfully!'
            ];
        } else {
            throw new Exception('Failed to save data to database');
        }
        
    } else {
        $response['message'] = 'Invalid request method';
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>