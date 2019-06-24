<?php

// Database configuration
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'dbbook';

// Connect with the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Get search term
$searchTerm = $_GET['term'];

// Get matched data from skills table
$query = $db->query("SELECT * FROM register WHERE name LIKE '%".$searchTerm."%' AND status = '1' ORDER BY skill ASC");

// Generate skills data array
$skillData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        //$data['id'] = $row['id'];
        $data['name'] = $row['name'];
        array_push($skillData, $data);
    }
}

// Return results as json encoded array
echo json_encode($skillData);

?>