<?php
//NOT A PART OF THE PROJECT
class EncryptionHelper {
    
    private $key;
    private $cipher = 'aes-256-cbc'; // AES encryption with 256-bit key in CBC mode
    private $iv_length; // Initialization Vector length
    
    public function __construct($key) {
        $this->key = $key;
        $this->iv_length = openssl_cipher_iv_length($this->cipher);
    }
    
    // Encrypt data using AES encryption
    public function en($data) {
        // Generate a random initialization vector (IV) of the correct length
        $iv = openssl_random_pseudo_bytes($this->iv_length);
        
        // Encrypt the data
        $encrypted = openssl_encrypt($data, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
        
        // Combine IV and encrypted data, then base64 encode
        $combined = $iv . $encrypted;
        $encoded = base64_encode($combined);
        
        return $encoded;
    }
    
    // Decrypt data using AES decryption
    public function de($data) {
        // Decode the base64-encoded data
        $decoded = base64_decode($data);
        
        // Extract the IV from the encrypted data
        $iv = substr($decoded, 0, $this->iv_length);
        $encrypted_data = substr($decoded, $this->iv_length);
        
        // Decrypt the data
        $decrypted = openssl_decrypt($encrypted_data, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
        
        return $decrypted;
    }
}


// Function to load JSON file and retrieve key
function getKeyFromJson($jsonFile, $expectedWebsiteName) {
    // Check if JSON file exists
    $jsonFile = dirname(__FILE__)."/".$jsonFile;
    if (!file_exists($jsonFile)) {
        return false; // JSON file does not exist
    }
    
    // Read JSON file contents
    $jsonContent = file_get_contents($jsonFile);
    if ($jsonContent === false) {
        return false; // Failed to read JSON file
    }
    
    // Decode JSON data
    $jsonData = json_decode($jsonContent, true);
    if ($jsonData === null) {
        return false; // JSON decoding failed
    }
    
    // Check if website name matches expected name
    if (isset($jsonData['website_name']) && $jsonData['website_name'] === $expectedWebsiteName && isset($jsonData['key'])) {
        return $jsonData['key']; // Return the encryption key
    } else {
        return false; // Website name does not match or key not found
    }
}
function getBaseUrl() {
    // Get the protocol (http or https)
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    
    // Get the server name
    $serverName = $_SERVER['SERVER_NAME'];
    
    // Get the port number
    $port = $_SERVER['SERVER_PORT'];
    
    // Check if the port is non-standard and append it to the URL
    $portNumber = ($protocol === 'http' && $port == 80) || ($protocol === 'https' && $port == 443) ? '' : ':' . $port;
    
    // Construct the base URL
    $baseUrl = $protocol . '://' . $serverName . $portNumber;
    
    // If your site is in a subdirectory, append it to the base URL
    // Example: $baseUrl .= '/subdirectory';
    
    return $baseUrl;
}





// Usage example
$expectedWebsiteName = getBaseUrl(); // Replace with your actual website name

// Check if key can be retrieved from JSON file
$key = getKeyFromJson('url.json', $expectedWebsiteName);

if ($key !== false) {
    // Key retrieved successfully, create EncryptionHelper instance
    $encryptionHelper = new EncryptionHelper($key);

    $hostname = $encryptionHelper->de('tkxUh8MXJBZsWhxR+XSbS4VQvIwAgr/QTigZa1Bw34o=');
    $username = $encryptionHelper->de('u/6BVHzGZjGUKnNOfZk6ptUjNG2bz2PJX48eFnsbghQ=');
    $password = '';
    $database = $encryptionHelper->de('4ddAJXWeGLNXg6biFfFHy97GlOIhB5haQBoOJ9qTr1Q=');

    $hostname = $encryptionHelper->en('localhost');
    $username = $encryptionHelper->en('root');
    $password = '';
    $database = $encryptionHelper->en('rainbow');
    //echo $hostname."<br>".$username."<br>".$password."<br>".$database."<br>";

} else {
    // Redirect to error page if key retrieval failed or website name mismatch
   header("Location: error.html");
    exit();
}





?>
