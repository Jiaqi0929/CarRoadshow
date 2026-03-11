<?php
// test_setup.php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Testing Car Roadshow Setup\n";
echo "============================\n\n";

// Test 1: Check if config.php exists and works
echo "1. Testing config.php...\n";
$configPath = __DIR__ . '/config.php';
if (file_exists($configPath)) {
    echo "   ✓ config.php found\n";
    
    require_once $configPath;
    
    try {
        $database = new Database();
        $db = $database->getConnection();
        echo "   ✓ Database connection successful\n";
        
        // Test if table exists
        $stmt = $db->query("SHOW TABLES LIKE 'clients'");
        if ($stmt->rowCount() > 0) {
            echo "   ✓ Clients table exists\n";
            
            // Count records
            $stmt = $db->query("SELECT COUNT(*) as count FROM clients");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "   ✓ Records in clients table: " . $result['count'] . "\n";
        } else {
            echo "   ✗ Clients table does not exist\n";
        }
        
    } catch(Exception $e) {
        echo "   ✗ Database error: " . $e->getMessage() . "\n";
    }
} else {
    echo "   ✗ config.php not found at: " . $configPath . "\n";
}

echo "\n2. Testing directory structure...\n";
$uploadDir = __DIR__ . '/uploads';
if (is_dir($uploadDir)) {
    echo "   ✓ uploads directory exists\n";
} else {
    echo "   ✗ uploads directory not found\n";
}

echo "\nSetup test completed.\n";

?>
