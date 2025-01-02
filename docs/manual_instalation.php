<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/header.php'; ?>

<div class="container">
    <header>
        <h1>Windows Installation Manual</h1>
    </header>

    <section>
        <h2>Server Requirements</h2>
        <p>
            To install and run the web application correctly on a Windows system, make sure you meet the following requirements.
        </p>
        <ul>
            <li><strong>Apache:</strong> Web server with PHP support.</li>
            <li><strong>MariaDB:</strong> Database management system to store the system's information.</li>
            <li><strong>PHP 7.4 or higher:</strong> Programming language required to run the server-side code.</li>
        </ul>
    </section>

    <section>
        <h2>Installation Steps</h2>
        <h3>1. Install XAMPP (Apache, MariaDB, and PHP)</h3>
        <p>
            A simple way to install Apache, MariaDB, and PHP on Windows is through XAMPP, a package that includes these three components in a single installer.
        </p>
        <ul>
            <li><strong>Download XAMPP:</strong> Go to the official XAMPP website and download the appropriate version for Windows:
                <a href="https://www.apachefriends.org/en/index.html" target="_blank">Download XAMPP</a>.
            </li>
            <li><strong>Install XAMPP:</strong> Run the downloaded installer and follow the default installation steps. Make sure to select Apache and MySQL (MariaDB) during the installation process.</li>
            <li><strong>Start XAMPP:</strong> Once installed, open the "XAMPP Control Panel" and start the Apache and MySQL (MariaDB) services by clicking the "Start" buttons.</li>
        </ul>

        <h3>2. Configure MariaDB</h3>
        <p>
            MariaDB is installed with XAMPP, but you need to configure it so that your database works correctly.
        </p>
        <ul>
            <li><strong>Access phpMyAdmin:</strong> Open your browser and go to `http://localhost/phpmyadmin/` to manage your database.</li>
            <li><strong>Create a database:</strong> Inside phpMyAdmin, click on "Databases" and create a new database for your project.</li>
        </ul>

        <h3>3. Configure Apache</h3>
        <p>
            Apache is already installed with XAMPP, but you need to configure the server to host your web application.
        </p>
        <ul>
            <li><strong>Project Files Location:</strong> Copy your application's files into the `htdocs` folder inside the XAMPP installation. By default, this folder is located at `C:\xampp\htdocs\miraclehotel`.</li>
            <li><strong>Configure Apache:</strong> If you need to change Apache's configuration, you can edit the `httpd.conf` file located in the XAMPP installation folder (by default at `C:\xampp\apache\conf\httpd.conf`).</li>
        </ul>

        <h3>4. Upload Application Files</h3>
        <p>
            To upload your web application files, simply copy them to the `htdocs` folder mentioned above.
        </p>
        <ul>
            <li><strong>Upload files:</strong> Place your project files in the `C:\xampp\htdocs\miraclehotel` folder.</li>
            <li><strong>Configure database connection file:</strong> Make sure that the file managing the database connection is correctly configured with the database name, username, and password you created in phpMyAdmin.</li>
        </ul>

        <h3>5. Verify the Installation</h3>
        <p>
            Once you've uploaded the application files, open your browser and go to:
        </p>
        <ul>
            <li><strong>Access the application:</strong> Open your browser and go to `http://localhost/your_site_name` to verify that the application is displayed correctly.</li>
            <li><strong>Verify database connection:</strong> Ensure that the application can connect to the database and perform CRUD operations correctly.</li>
        </ul>

        <h3>6. Final Configuration</h3>
        <ul>
            <li><strong>Check that Apache and MySQL start correctly:</strong> Whenever you start XAMPP, ensure that the Apache and MySQL services are running.</li>
            <li><strong>Restart Apache and MySQL:</strong> If you make changes to the configuration or database, restart Apache and MySQL from the XAMPP control panel.</li>
        </ul>
    </section>

    <footer>
        <p>&copy; 2024 / 2025 Windows Installation Manual. Joan Saura Martinez.</p>
    </footer>
    <a href=""></a>
</div>

<?php include $root . '/student071/dwes/files/common-files/footer.php'; ?>
