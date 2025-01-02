<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/header.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /student071/dwes/index.php");
    exit();
}
?>


<div id="admin-page">
    <div id="admin-container">
        <h1 id="admin-title">Admin Page</h1>
        <div class='admin-list'>
            <h3>Rooms</h3>
            <ul>
                <li><a href="/student071/dwes/files/forms/rooms/select_room_forms.php">Search Room</a></li>
                <li><a href="/student071/dwes/files/forms/rooms/insert_room_forms.php">Create a Room</a></li>
                <li><a href="/student071/dwes/files/forms/rooms/update_room_forms.php">Change Room Data</a></li>
                <li><a href="/student071/dwes/files/forms/rooms/delete_room_forms.php">Delete a Room</a></li>
            </ul>
        </div>
        <div class='admin-list'>
            <h3>Customers</h3>
            <ul>
                <li><a href="/student071/dwes/files/forms/customers/select_customer_form.php">Search customer data</a></li>
                <li><a href="/student071/dwes/files/register.php">Register a customer</a></li>
                <li><a href="/student071/dwes/files/forms/customers/update_customer_form.php">Update customer data</a></li>
                <li><a href="/student071/dwes/files/forms/customers/delete_customer_form.php">Delete customer</a></li>
            </ul>
        </div>
        <div class='admin-list'>
            <h3>Reservations</h3>
            <ul>
                <li><a href="/student071/dwes/files/forms/reservations/select_reservations_forms.php">Search an existing reservation</a></li>
                <li><a href="/student071/dwes/files/forms/reservations/insert_reservation_forms.php">Create a reservation</a></li>
                <li><a href="/student071/dwes/files/forms/reservations/update_reservation_forms.php">Update an existing reservation</a></li>
                <li><a href="/student071/dwes/files/forms/reservations/delete_reservation_forms.php">Delete a reservation</a></li>
                <li><a href="/student071/dwes/files/querys/reservations/assign_random_extras.php">Generate Random Extras to all reservations</a></li>
            </ul>
        </div>
    </div>
</div>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>
