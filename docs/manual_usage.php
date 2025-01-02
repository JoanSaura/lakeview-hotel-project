<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/header.php'; ?>

<div class="container">
    <header>
        <h1>User Manual: Administrator</h1>
    </header>

    <section>
        <h2>Introduction</h2>
        <p>
            This manual is designed to guide the administrators of the application in using the key features of the system.
            Here, you will find detailed instructions on how to manage customer data, how to navigate through the application,
            and how to use the available tools for administration.
        </p>
    </section>

    <section>
        <h2>Accessing the Application</h2>
        <p>
            To access the application locally, open your browser and go to the address: <strong>http://localhost/student071/dwes/index.php</strong>.
        </p>
        <p>
        To access the application on remote, open your browser and go to the address: <strong>https://remotehost.es/student071/dwes/</strong>.

        </p>
        <p>
            The administrator must log in with their credentials to access the administration interface.
        </p>
        <ul>
            <li><strong>Username:</strong> (Your Username)</li>
            <li><strong>Password:</strong> (The password you set during installation)</li>
        </ul>
        <p>Once logged in, you will be redirected to the administration panel where you can manage all functionalities.</p>
    </section>

    <section>
        <h2>Managing Customers</h2>
        <p>
            From the administration panel, the administrator can perform CRUD (Create, Read, Update, Delete) operations on customer data.
        </p>
        <ul>
            <li><strong>Manage Customers</strong>On the admin panel you will have all acces to check/create/update/delete rooms information.</li>
            <li><strong>Manage Rooms:</strong>On the admin panel you will have all acces to check/create/update/delete rooms information.</li>
            <li><strong>Manage Reservations:</strong> On the admin panel you will have all acces to check/create/update/delete reservations information.</li>
        </ul>
        <p>Remember to validate that the customer information is correct before saving it.</p>
    </section>

    <section>
        <h2>Responsive Interface</h2>
        <p>
            The application automatically adapts to mobile and desktop devices thanks to a responsive design.
            This allows easy management of the application from any device.
        </p>
        <p>
            If you are using a mobile device, the interface will adjust so that buttons and forms are easy to use on smaller screens.
        </p>
    </section>

    <section>
        <h2>Data Validation</h2>
        <p>
            The application performs validations on forms to ensure that the entered data is correct. If any information is incorrect or incomplete,
            the system will show an error message and ask you to correct the data before submitting it.
        </p>
    </section>

    <section>
        <h2>Security and Best Practices</h2>
        <p>
            As an administrator, it is crucial to follow certain best practices to maintain the application's security:
        </p>
        <ul>
            <li><strong>Change the password regularly:</strong> Ensure that your password is secure and change it periodically.</li>
            <li><strong>Do not share credentials:</strong> Administrator credentials should be kept private.</li>
            <li><strong>Backup regularly:</strong> Make regular backups of the database to avoid losing important data.</li>
        </ul>
    </section>

    <section>
        <h2>Common Issues</h2>
        <p>
            Below are some common issues and their solutions:
        </p>
        <ul>
            <li><strong>The system is not loading:</strong> Make sure Apache and MySQL are running in XAMPP. Check the XAMPP control panel.</li>
            <li><strong>Database issues:</strong> Ensure the database is correctly configured and that the database connection file is properly set up.</li>
            <li><strong>Authentication issues:</strong> If you cannot log in, make sure your credentials are correct. If you have forgotten your password, you can reset it directly from the system (if the functionality is implemented).</li>
        </ul>
    </section>

    <footer>
        <p>&copy; 2024 / 2025 User Manual. Joan Saura Martinez.</p>
    </footer>
    <a href=""></a>
</div>

<?php include $root . '/student071/dwes/files/common-files/footer.php'; ?>
