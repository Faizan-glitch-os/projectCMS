<?php
/**
 * Load environment variables from .env file
 * This file MUST be required at the beginning of your application
 */

function loadEnvFile($filePath = null) {
    // Default to .env in the same directory
    if ($filePath === null) {
        $filePath = __DIR__ . '/../.env';
    }
    
    // Check if file exists
    if (!file_exists($filePath)) {
        error_log("WARNING: .env file not found at: $filePath");
        return false;
    }
    
    // Read the file
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    if ($lines === false) {
        error_log("ERROR: Could not read .env file");
        return false;
    }
    
    $loadedCount = 0;
    
    foreach ($lines as $line) {
        // Trim whitespace
        $line = trim($line);
        
        // Skip comments and empty lines
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }
        
        // Find the equals sign
        $equalsPos = strpos($line, '=');
        if ($equalsPos === false) {
            continue;
        }
        
        // Extract key and value
        $key = trim(substr($line, 0, $equalsPos));
        $value = trim(substr($line, $equalsPos + 1));
        
        // Remove quotes if present
        if (strlen($value) > 0) {
            if ($value[0] === '"' && substr($value, -1) === '"') {
                $value = substr($value, 1, -1);
            } elseif ($value[0] === "'" && substr($value, -1) === "'") {
                $value = substr($value, 1, -1);
            }
        }
        
        // Set the environment variable using multiple methods
        putenv("$key=$value");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
        
        $loadedCount++;
    }
    
    error_log("Loaded $loadedCount environment variables from .env file");
    return true;
}

// Load the .env file
loadEnvFile();

// Debug: Display loaded variables (remove in production)
if (getenv('APP_DEBUG') === 'true' || !empty($_GET['debug_env'])) {
    $debug = [
        'DB_HOST' => getenv('DB_HOST'),
        'DB_PORT' => getenv('DB_PORT'),
        'DB_NAME' => getenv('DB_NAME'),
        'DB_USER' => getenv('DB_USER'),
        'DB_PASSWORD_SET' => getenv('DB_PASSWORD') ? 'Yes (length: ' . strlen(getenv('DB_PASSWORD')) . ')' : 'No'
    ];
    error_log("Loaded database config: " . json_encode($debug));
}