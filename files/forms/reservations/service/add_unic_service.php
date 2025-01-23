<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include($root . '/student071/dwes/files/common-files/db_connection.php'); 

include($root . '/student071/dwes/files/common-files/header.php');

$sql = 'SELECT * FROM 071_services';

$result = mysqli_query($conn, $sql);
?>

<form action="" class="login-form">
    <h1>Add a service</h1>
    <select name="service-inter" id="">
        <option value="">Add a service</option>
        <?php 
        if ($result && mysqli_num_rows($result) > 0) {
            while ($service = mysqli_fetch_assoc($result)) {
        ?>
                <option value="<?php echo htmlspecialchars($service['service_id']); ?>">
                    <?php echo htmlspecialchars($service['service_name']); ?>
                </option>
        <?php 
            }
        } else {
            echo '<option>No services found</option>';
        }
        ?>
    </select>
</form>

<?php 
include($root . '/student071/dwes/files/common-files/footer.php');
?>
