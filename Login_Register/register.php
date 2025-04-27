<?php
include('../config/connect.php');
 // Connect to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $nid_passport = mysqli_real_escape_string($conn, $_POST['nid_passport']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $land_address = mysqli_real_escape_string($conn, $_POST['land_address']);

    // Handle uploads
    $uploads_dir = 'uploads/';
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $legal_documents = [];

    // Upload legal documents
    if (!empty($_FILES['legal_documents']['name'][0])) {
        foreach ($_FILES['legal_documents']['tmp_name'] as $key => $tmp_name) {
            $name = basename($_FILES['legal_documents']['name'][$key]);
            $target_path = $uploads_dir . $name;
            move_uploaded_file($tmp_name, $target_path);
            $legal_documents[] = $name;
        }
    }

    // Upload fingerprint
    $fingerprint_name = '';
    if (!empty($_FILES['fingerprint']['name'])) {
        $fingerprint_name = basename($_FILES['fingerprint']['name']);
        move_uploaded_file($_FILES['fingerprint']['tmp_name'], $uploads_dir . $fingerprint_name);
    }

    // Upload face photo
    $face_photo_name = '';
    if (!empty($_FILES['face_photo']['name'])) {
        $face_photo_name = basename($_FILES['face_photo']['name']);
        move_uploaded_file($_FILES['face_photo']['tmp_name'], $uploads_dir . $face_photo_name);
    }

    // Generate unique IDs
    $land_id = uniqid('land_');
    $owner_id = uniqid('owner_');

    // Prepare the SQL query
    $legal_documents_json = json_encode($legal_documents); // Save multiple documents as JSON

    $sql = "INSERT INTO registration 
        (full_name, nid_passport, address, contact, land_address, legal_documents, fingerprint, face_photo, land_id, owner_id) 
        VALUES 
        ('$fullname', '$nid_passport', '$address', '$contact', '$land_address', '$legal_documents_json', '$fingerprint_name', '$face_photo_name', '$land_id', '$owner_id')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<h2>Registration Successful!</h2>";
        echo "<p><strong>Assigned Land ID:</strong> $land_id</p>";
        echo "<p><strong>Assigned Owner ID:</strong> $owner_id</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid Request.";
}

$conn->close();
?>
