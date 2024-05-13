<?php

require_once __DIR__ . '/../model/db_connect.php';


function findAllCarRequests()
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `car_request`';

    try {
        $result = $conn->query($selectQuery);

        // Check if the query was successful
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $rows = array();

        // Fetch rows one by one
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Check for an empty result set
        if (empty($rows)) {
            throw new Exception("No rows found in the 'user' table.");
        }

        return $rows;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function findCarRequestByID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `car_request` WHERE `id` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the user as an associative array
        $user = $result->fetch_assoc();

        // Check for an empty result set
        if (!$user) {
            throw new Exception("No user found with ID: " . $id);
        }

        // Close the statement
        $stmt->close();

        return $user;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function findCarRequestsBySellerID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `car_request` WHERE `seller_id` = '.$id;

    try {
        $result = $conn->query($selectQuery);

        // Check if the query was successful
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $rows = array();

        // Fetch rows one by one
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Check for an empty result set
        if (empty($rows)) {
            throw new Exception("No rows found in the 'user' table.");
        }

        return $rows;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function updateCarRequest($appointment_date, $appointment_time, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `car_request` SET 
                    
                    WHERE id = ?";

    try {
//        $stmt = $conn->prepare($updateQuery);
//        if (!$stmt) {
//            throw new Exception("Prepare statement failed: " . $conn->error);
//        }
//        $stmt->bind_param('ssi', $appointment_date, $appointment_time, $id);
//        $stmt->execute();
//        return true;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
//        $stmt->close();
        $conn->close();
    }
}

function updateCarRequestStatusWithDate($date, $status, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `car_request` SET 
                    date = ?,
                    status = ?
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('ssi', $date, $status,  $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}

function deleteCarRequest($id) {
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "DELETE FROM `car_request` WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameter
        $stmt->bind_param('i', $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
        $data['status'] = "De-Activated";
    }
}

function createCarRequest($car_id, $seller_id, $customer_id, $date, $status, $request_type) {
    $conn = db_conn();

    // Hash the password using a secure hashing algorithm (e.g., password_hash)
//    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Construct the SQL query
    $insertQuery = "INSERT INTO `car_request` (car_id, seller_id, customer_id, date, status, request_type) VALUES (?, ?, ?, ?, ?, ?)";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($insertQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('iiisss', $car_id, $seller_id, $customer_id, $date, $status, $request_type);

        // Execute the query
        $stmt->execute();

        // Return the ID of the newly inserted user
        $newUserId = $conn->insert_id;

        // Close the statement
        $stmt->close();

        return $newUserId;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return -1;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function UpdateSingleCarRequestInfoByUserID($colName, $data, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `car_request` SET ".$colName." = ?
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('si', $data, $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}