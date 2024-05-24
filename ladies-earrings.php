<?php
    require('config.php');

    $sql = "SELECT * FROM glitterdetails
    WHERE genderclass = 'ladies' AND  category = 'earrings'";
    
    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        $data = array();

        while ($row = $results->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        echo json_encode(['message' => 'no results found!']);
    }

    $conn->close();
?>