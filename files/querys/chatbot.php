<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<p>Error: User not authenticated. No user_id found in session.</p>";
    exit;
} else {
    $root = $_SERVER['DOCUMENT_ROOT'];
    include($root . '/student071/dwes/files/common-files/db_connection.php');

    $client_id = $_SESSION['user_id'];

    $query_customer = "SELECT client_id FROM 071_customers WHERE client_id = '$client_id'";
    $result_customer = mysqli_query($conn, $query_customer);

    if (mysqli_num_rows($result_customer) === 0) {
        echo "<p>Error: Customer not found</p>";
        exit;
    }

    $customer = mysqli_fetch_assoc($result_customer);
    $customer_id = $customer['client_id'];

    $type = $_POST['tipo'] ?? '';

    if (!in_array($type, ['reservations', 'reviews', 'services'])) {
        echo "<p>Error: Invalid request type</p>";
        exit;
    }

    switch ($type) {
        case 'reservations':
            $query = "SELECT rm.room_number AS room_number,  
                      rt.room_type_name AS room_type, 
                      r.reservation_price_per_day AS price_per_day, 
                      r.date_in AS check_in_date, 
                      r.date_out AS check_out_date, 
                      DATEDIFF(r.date_out, r.date_in) AS total_days, 
                      (DATEDIFF(r.date_out, r.date_in) * r.reservation_price_per_day) AS total_price
              FROM 071_reservations r
              JOIN 071_rooms rm ON r.room_id = rm.room_id  
              JOIN 071_room_type rt ON rm.room_type_id = rt.room_type_id
              WHERE r.client_id = '$customer_id'";
            break;

        case 'reviews':
            $query = "SELECT review_title, customer_review, customer_score, inserted_on
                      FROM 071_reviews 
                      WHERE user_id = '$client_id'";
            break;

        case 'services':
            $query = "SELECT s.service_name, rs.quantity, rs.rs_price, rs.rs_date, rs.rs_state
                      FROM 071_reservation_services rs
                      JOIN 071_services s ON rs.service_id = s.service_id
                      WHERE rs.reservation_id IN (SELECT reservation_id FROM 071_reservations WHERE client_id = '$customer_id')";
            break;
    }

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p>Error in query: " . mysqli_error($conn) . "</p>";
        exit;
    }

    if (mysqli_num_rows($result) == 0) {
        echo "<p>No results found.</p>";
        exit;
    }

    echo "<table border='1'>";
    echo "<tr>";

    switch ($type) {
        case 'reservations':
            echo "<th>Room Number</th><th>Room Type</th><th>Price per Day</th><th>Check-in Date</th><th>Check-out Date</th><th>Total Days</th><th>Total Price</th>";
            break;
        case 'reviews':
            echo "<th>Review Title</th><th>Comment</th><th>Score</th><th>Date</th>";
            break;
        case 'services':
            echo "<th>Service</th><th>Quantity</th><th>Price</th><th>Service Date</th><th>Status</th>";
            break;
    }

    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}
?>
