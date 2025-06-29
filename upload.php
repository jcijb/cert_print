<?php
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
                echo json_encode(['success' => false, 'message' => 'Error moving uploaded file']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid file type']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>