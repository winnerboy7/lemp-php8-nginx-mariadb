<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileInput'])) {
  $uploadDir = 'uploads/'; // Directory to store uploaded files
  $uploadedFile = $uploadDir . basename($_FILES['fileInput']['name']);
  $uploadOk = true;

  // Check if the file is an image
  $imageFileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
  if (!getimagesize($_FILES['fileInput']['tmp_name'])) {
    echo 'Invalid file. Please upload an image.';
    $uploadOk = false;
  }

  // Check file size (adjust this value as needed)
  if ($_FILES['fileInput']['size'] > 5 * 1024 * 1024) { // 5MB limit
    echo 'File is too large. Please upload a smaller image.';
    $uploadOk = false;
  }

  // Allow only certain file formats (e.g., jpg, png)
  if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
    echo 'Only JPG, JPEG, and PNG files are allowed.';
    $uploadOk = false;
  }

  if ($uploadOk) {
    if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadedFile)) {
      echo $uploadedFile; // Return the path to the uploaded image
    } else {
      echo 'Error uploading the file.';
    }
  }
} else {
  echo 'Invalid request.';
}
