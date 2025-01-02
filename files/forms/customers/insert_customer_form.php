<?php
$errors = [];
$firstName = $lastName = $identification = $email = $phoneNumber = $password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim(htmlspecialchars($_POST['c-first-name']));
    $lastName = trim(htmlspecialchars($_POST['c-last-name']));
    $identification = trim(htmlspecialchars($_POST['c-identification']));
    $email = trim(htmlspecialchars($_POST['c-email']));
    $phoneNumber = trim(htmlspecialchars($_POST['c-phonenumber']));
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
        $errors['phonenumber'] = "Phone Number must contain at least 7 digits.";
    }

    if (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long.";
    }

    if (empty($errors)) {
        header("Location: /student071/dwes/files/querys/customers/insert_customers.php?c-first-name=$firstName&c-last-name=$lastName&c-identification=$identification&c-email=$email&c-phonenumber=$phoneNumber&c-password=$password");
        exit;
    }
}
?>

<section id="container-form">
    <form class="login-form" action="/student071/dwes/files/querys/customers/insert_customers.php" method="POST" id="registerForm">
        <h3>Register Customer</h3>

        <label for="first-name">First Name</label>
        <input type="text" name="c-first-name" id="first-name" value="<?php echo htmlspecialchars($firstName); ?>" required>
        <p class="error-display" id="error-first-name"><?php echo $errors['first-name'] ?? ''; ?></p>

        <label for="last-name">Last Name</label>
        <input type="text" name="c-last-name" id="last-name" value="<?php echo htmlspecialchars($lastName); ?>" required>
        <p class="error-display" id="error-last-name"><?php echo $errors['last-name'] ?? ''; ?></p>

        <label for="identification">Identification</label>
        <input type="text" name="c-identification" id="identification" value="<?php echo htmlspecialchars($identification); ?>" required>
        <p class="error-display" id="error-identification"><?php echo $errors['identification'] ?? ''; ?></p>

        <label for="email">Email</label>
        <input type="email" name="c-email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <p class="error-display" id="error-email"><?php echo $errors['email'] ?? ''; ?></p>

        <label for="phonenumber">Phone Number</label>
        <input type="text" name="c-phonenumber" id="phonenumber" value="<?php echo htmlspecialchars($phoneNumber); ?>" required>
        <p class="error-display" id="error-phonenumber"><?php echo $errors['phonenumber'] ?? ''; ?></p>

        <label for="password">Password</label>
        <input type="password" name="c-password" id="password" required>
        <p class="error-display" id="error-password"><?php echo $errors['password'] ?? ''; ?></p>

        <div class="submit-button">
            <input class="submit" type="submit" name="submit" value="Register">
        </div>
    </form>
</section>

