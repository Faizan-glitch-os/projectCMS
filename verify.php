<?php
echo "<h2>Environment Variables Debug</h2>";

// Check if .env file exists
$env_file = __DIR__ . '/.env';
echo "<p>.env file exists: " . (file_exists($env_file) ? "✅ Yes" : "❌ No") . "</p>";

if (file_exists($env_file)) {
    echo "<p>.env file contents:</p>";
    echo "<pre>";
    echo htmlspecialchars(file_get_contents($env_file));
    echo "</pre>";
}

// Get environment variables
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$name = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

echo "<h3>Loaded Values:</h3>";
echo "DB_HOST: " . ($host ?: "❌ NOT SET") . "<br>";
echo "DB_PORT: " . ($port ?: "❌ NOT SET") . "<br>";
echo "DB_NAME: " . ($name ?: "❌ NOT SET") . "<br>";
echo "DB_USER: " . ($user ?: "❌ NOT SET") . "<br>";
echo "DB_PASSWORD: " . ($password ? "✓ SET (length: " . strlen($password) . ")" : "❌ NOT SET") . "<br>";

// Show what connection string would be
if ($host && $port && $name) {
    $dsn = "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4";
    echo "<h3>Connection DSN:</h3>";
    echo "<code>" . htmlspecialchars($dsn) . "</code><br>";
    
    echo "<h3>Connection Type:</h3>";
    if ($host === 'localhost') {
        echo "⚠️ Using 'localhost' will try to use a Unix socket file<br>";
    } elseif ($host === '127.0.0.1') {
        echo "✅ Using '127.0.0.1' will use TCP/IP connection<br>";
    }
    
    // Test the connection
    echo "<h3>Test Connection:</h3>";
    try {
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        echo "✅ Connection successful!<br>";
    } catch (PDOException $e) {
        echo "❌ Connection failed: " . $e->getMessage() . "<br>";
    }
}
?>