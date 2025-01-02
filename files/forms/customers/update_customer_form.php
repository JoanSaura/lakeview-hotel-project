<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root . '/student071/dwes/files/common-files/db_connection.php');
$errors = [];

$selectedClientId = isset($_GET['client-id']) ? intval($_GET['client-id']) : null;

$firstName = $lastName = $identification = $email = $phoneNumber = $password = '';

$sqlCustomers = "SELECT client_id, client_first_name, client_last_name, client_identification, client_email, client_phone_number 
                 FROM 071_customers;";
$resultCustomers = mysqli_query($conn, $sqlCustomers);

if (!$resultCustomers) {
    echo "Error en la consulta de clientes: " . mysqli_error($conn);
    exit();
}

if ($selectedClientId) {
    $sqlSelectedCustomer = "SELECT client_first_name, client_last_name, client_identification, client_email, client_phone_number 
                            FROM 071_customers WHERE client_id = $selectedClientId;";
    $resultSelectedCustomer = mysqli_query($conn, $sqlSelectedCustomer);

    if ($resultSelectedCustomer && mysqli_num_rows($resultSelectedCustomer) > 0) {
        $selectedCustomer = mysqli_fetch_assoc($resultSelectedCustomer);
        $firstName = $selectedCustomer['client_first_name'];
        $lastName = $selectedCustomer['client_last_name'];
        $identification = $selectedCustomer['client_identification'];
        $email = $selectedCustomer['client_email'];
        $phoneNumber = $selectedCustomer['client_phone_number'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim(htmlspecialchars($_POST['first-name']));
    $lastName = trim(htmlspecialchars($_POST['last-name']));
    $identification = trim(htmlspecialchars($_POST['identification']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phoneNumber = trim(htmlspecialchars($_POST['phone']));
    $password = trim(htmlspecialchars($_POST['c-password']));

    if (!preg_match('/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*$/', $firstName)) {
        $errors['first-name'] = "First Name must start with a capital letter and contain only letters.";
    }

    if (!preg_match('/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*$/', $lastName)) {
        $errors['last-name'] = "Last Name must start with a capital letter and contain only letters.";
    }

    if (empty($identification)) {
        $errors['identification'] = "Identification cannot be empty.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (!preg_match('/^[0-9]{7,}$/', $phoneNumber)) {
        $errors['phone'] = "Phone Number must contain at least 7 digits.";
    }

    if (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long.";
    }

    if (empty($errors)) {
        header("Location: /student071/dwes/files/querys/customers/update_customers.php?first-name=$firstName&last-name=$lastName&identification=$identification&email=$email&phone=$phoneNumber&password=$password");
        exit;
    }
}
?>

<?php include($root . '/student071/dwes/files/common-files/header.php'); ?>

<section id="container-form">
    <form class="login-form" id="update-customer-form" action="/student071/dwes/files/querys/customers/update_customers.php" method="POST">
        <h3>Update Customer</h3>

        <label for="customer-select">Select Customer to Update</label>
        <select name="client-id" id="customer-select" required onchange="populateCustomerDetails(this.value)">
            <option value="">Choose a customer</option>
            <?php while ($customer = mysqli_fetch_assoc($resultCustomers)) { 
                $isSelected = ($selectedClientId === intval($customer['client_id'])) ? 'selected' : '';
            ?>
                <option value="<?php echo intval($customer['client_id']); ?>" 
                        data-first-name="<?php echo htmlspecialchars($customer['client_first_name']); ?>"
                        data-last-name="<?php echo htmlspecialchars($customer['client_last_name']); ?>"
                        data-identification="<?php echo htmlspecialchars($customer['client_identification']); ?>"
                        data-email="<?php echo htmlspecialchars($customer['client_email']); ?>"
                        data-phone="<?php echo htmlspecialchars($customer['client_phone_number']); ?>"
                        <?php echo $isSelected; ?>>
                    <?php echo htmlspecialchars($customer['client_first_name'] . ' ' . $customer['client_last_name']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="first-name-input">First Name</label>
        <input type="text" name="first-name" id="first-name-input" value="<?php echo htmlspecialchars($firstName); ?>" required>
        <p class="error-display" id="error-first-name"><?php echo $errors['first-name'] ?? ''; ?></p>

        <label for="last-name-input">Last Name</label>
        <input type="text" name="last-name" id="last-name-input" value="<?php echo htmlspecialchars($lastName); ?>" required>
        <p class="error-display" id="error-last-name"><?php echo $errors['last-name'] ?? ''; ?></p>

        <label for="identification-input">Identification</label>
        <input type="text" name="identification" id="identification-input" value="<?php echo htmlspecialchars($identification); ?>" required>
        <p class="error-display" id="error-identification"><?php echo $errors['identification'] ?? ''; ?></p>

        <label for="email-input">Email</label>
        <input type="email" name="email" id="email-input" value="<?php echo htmlspecialchars($email); ?>" required>
        <p class="error-display" id="error-email"><?php echo $errors['email'] ?? ''; ?></p>

        <label for="phone-input">Phone Number</label>
        <input type="text" name="phone" id="phone-input" value="<?php echo htmlspecialchars($phoneNumber); ?>" required>
        <p class="error-display" id="error-phone"><?php echo $errors['phone'] ?? ''; ?></p>

        <label for="password">Password</label>
        <input type="password" name="c-password" id="password" required>
        <p class="error-display" id="error-password"><?php echo $errors['password'] ?? ''; ?></p>

        <div class="submit-button">
            <input class="submit" type="submit" name="submit" value="Update Customer">
        </div>
    </form>
</section>

<?php include($root . '/student071/dwes/files/common-files/footer.php'); ?>
