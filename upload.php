<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileExtension = pathinfo($_FILES['certificate']['name'], PATHINFO_EXTENSION);
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                $fileName = 'certificate_template.' . $fileExtension;
                $destination = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['certificate']['tmp_name'], $destination)) {
                    echo json_encode(['success' => true, 'message' => 'File uploaded successfully', 'path' => $destination]);
                } else {
                    throw new Exception('Error moving uploaded file');
                }
            } else {
                throw new Exception('Invalid file type');
            }
        } else {
            throw new Exception('No file uploaded or upload error');
        }
    } else {
        throw new Exception('Invalid request method');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>