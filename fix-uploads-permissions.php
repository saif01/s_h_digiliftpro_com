<?php
/**
 * Fix Uploads Folder Permissions Script
 * 
 * This script fixes file and folder permissions for the uploads directory
 * to ensure images are accessible when uploaded via cPanel File Manager.
 * 
 * Usage:
 * 1. Upload this file to your Laravel root directory
 * 2. Access it via browser: https://yourdomain.com/fix-uploads-permissions.php
 * 3. Or run via command line: php fix-uploads-permissions.php
 * 
 * IMPORTANT: Delete this file after running it for security!
 */

// Security: Only allow access from localhost or specific IP (uncomment and set your IP)
// $allowedIPs = ['127.0.0.1', '::1', 'YOUR_IP_HERE'];
// if (php_sapi_name() !== 'cli' && !in_array($_SERVER['REMOTE_ADDR'], $allowedIPs)) {
//     die('Access denied');
// }

$basePath = __DIR__ . '/public/uploads';
$fixedFiles = 0;
$fixedDirs = 0;
$errors = [];

/**
 * Recursively fix permissions for files and directories
 */
function fixPermissions($path, &$fixedFiles, &$fixedDirs, &$errors) {
    if (!file_exists($path)) {
        $errors[] = "Path does not exist: $path";
        return;
    }

    if (is_dir($path)) {
        // Fix directory permissions (755 = rwxr-xr-x)
        if (chmod($path, 0755)) {
            $fixedDirs++;
        } else {
            $errors[] = "Failed to set permissions on directory: $path";
        }

        // Recursively process subdirectories and files
        $items = scandir($path);
        foreach ($items as $item) {
            if ($item != '.' && $item != '..') {
                $itemPath = $path . '/' . $item;
                fixPermissions($itemPath, $fixedFiles, $fixedDirs, $errors);
            }
        }
    } elseif (is_file($path)) {
        // Fix file permissions (644 = rw-r--r--)
        if (chmod($path, 0644)) {
            $fixedFiles++;
        } else {
            $errors[] = "Failed to set permissions on file: $path";
        }
    }
}

// Check if running from command line or web
$isCli = php_sapi_name() === 'cli';

if ($isCli) {
    echo "Fixing permissions for uploads folder...\n";
    echo "Base path: $basePath\n\n";
} else {
    header('Content-Type: text/html; charset=utf-8');
    echo "<!DOCTYPE html><html><head><title>Fix Uploads Permissions</title>";
    echo "<style>body{font-family:Arial,sans-serif;max-width:800px;margin:50px auto;padding:20px;}";
    echo ".success{color:green;}.error{color:red;}.info{color:blue;}</style></head><body>";
    echo "<h1>Fix Uploads Folder Permissions</h1>";
}

// Fix permissions
if (file_exists($basePath)) {
    fixPermissions($basePath, $fixedFiles, $fixedDirs, $errors);
    
    if ($isCli) {
        echo "✓ Fixed permissions for $fixedDirs directories\n";
        echo "✓ Fixed permissions for $fixedFiles files\n";
    } else {
        echo "<div class='success'>";
        echo "<h2>✓ Permissions Fixed Successfully!</h2>";
        echo "<p>Fixed permissions for <strong>$fixedDirs</strong> directories</p>";
        echo "<p>Fixed permissions for <strong>$fixedFiles</strong> files</p>";
        echo "</div>";
    }
} else {
    $error = "Uploads directory not found: $basePath";
    $errors[] = $error;
    if ($isCli) {
        echo "ERROR: $error\n";
    } else {
        echo "<div class='error'><h2>ERROR</h2><p>$error</p></div>";
    }
}

// Display errors
if (!empty($errors)) {
    if ($isCli) {
        echo "\nErrors:\n";
        foreach ($errors as $error) {
            echo "  - $error\n";
        }
    } else {
        echo "<div class='error'><h2>Errors:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
}

if (!$isCli) {
    echo "<div class='info' style='margin-top:30px;padding:15px;background:#f0f0f0;border-radius:5px;'>";
    echo "<h3>Next Steps:</h3>";
    echo "<ol>";
    echo "<li>Test if your images are now accessible</li>";
    echo "<li><strong>DELETE THIS FILE</strong> for security reasons</li>";
    echo "<li>If images still don't work, check your cPanel File Manager permissions</li>";
    echo "</ol>";
    echo "</div>";
    echo "</body></html>";
}

echo "\n";

