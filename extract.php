<?php
/**
 * Deployment Extraction Helper for Youssi Market
 * This script unzips the uploaded deploy.zip file.
 */

// Simple security token - should be passed as ?token=...
// In a real scenario, this should match a secret in GitHub Actions
$secretToken = "youssi_market_deploy_2026";
$providedToken = $_GET['token'] ?? '';

if ($providedToken !== $secretToken) {
    header('HTTP/1.0 403 Forbidden');
    echo "Access Denied";
    exit;
}

$zipFile = 'deploy.zip';

if (!file_exists($zipFile)) {
    echo "Error: $zipFile not found.";
    exit;
}

$zip = new ZipArchive;
$res = $zip->open($zipFile);

if ($res === TRUE) {
    echo "Extracting $zipFile...<br>";
    $zip->extractTo(__DIR__);
    $zip->close();
    echo "Extraction successful.<br>";
    
    // Cleanup
    unlink($zipFile);
    echo "Deleted $zipFile.<br>";
    
    // Self-destruct
    // unlink(__FILE__);
    // echo "Script self-destructed.";
} else {
    echo "Error: Failed to open $zipFile. Error code: $res";
}
?>
