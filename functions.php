<?php
include('includes/db.php');
function deleteRecord($id, $tableName) {
    global $conn;
    if ($id && $tableName) {
        
        $stmt = $conn->prepare("DELETE FROM $tableName WHERE id = ?");
        $stmt->bind_param('i', $id);
        
        if ($stmt->execute()) {
            return array('status' => 'success', 'message' => 'Record deleted successfully');
        } else {
            return array('status' => 'error', 'message' => 'Failed to delete record');
        }
        
        $stmt->close();
    } else {
        return array('status' => 'error', 'message' => 'Invalid ID or table name');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];
    $tableName = $_POST['tablename'];
    
    $response = deleteRecord($id, $tableName);
    echo json_encode($response);
    exit;
}


// validate admin login

function validateLogin($email, $password) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if (md5($password) === $row['password']) {
            return true;
        }
    }
    return false;
} 
?>
