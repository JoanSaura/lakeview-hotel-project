<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/header.php'; 
//echo 'PHP version: ' . phpversion();    
?>

<div class="container">
    <header>
        <h1>Technical Manual</h1>
    </header>

    <section>
        <h2>Overview</h2>
        <p>
            This manual provides a detailed description of the technologies and programming languages used in
            this web project. It covers the software components, programming languages, database systems, and
            various tools that form the technical foundation of the project.
        </p>
        <p>
            The project focuses on a web platform that allows managing client information through a
            database system, with a user-friendly interface and CRUD (Create, Read, Update, Delete) functionalities
            for managing customer data.
        </p>
    </section>

    <section>
        <h2>Software Components</h2>
        <ul>
            <li><strong>HTML</strong>: Markup language used to structure content on web pages.</li>
            <li><strong>CSS</strong>: Styling language used to define the visual appearance of HTML content.</li>
            <li><strong>PHP</strong>: Server-side programming language used to handle business logic and
                database queries.</li>
            <li><strong>JavaScript</strong>: Client-side programming language used to enhance user interaction.</li>
            <li><strong>MariaDB</strong>: Database management system used to store customer data.</li>
        </ul>
    </section>

    <section>
        <h2>Additional Tools and Technologies</h2>
        <ul>
            <li><strong>Apache</strong>: Web server used to host the application.</li>
            <li><strong>Git</strong>: Version control system used to manage the source code.</li>
        </ul>
    </section>

    <section>
        <h2>Implemented Features</h2>
        <ul>
            <li><strong>Client Management:</strong> Allows creating, reading, updating, and deleting client data.</li>
            <li><strong>Responsive Interface:</strong> The application adapts to different devices using Bootstrap.</li>
            <li><strong>Form Validation:</strong> Input data is validated before being sent to the server.</li>
        </ul>
    </section>

    <section>
        <h2>Pending Features for Development</h2>
        <ul>
            <li><strong>User Authentication:</strong> Implement login and registration.</li>
            <li><strong>Improved Security:</strong> Prevent SQL injections and XSS attacks.</li>
        </ul>
    </section>

    <section>
        <h2>System Requirements</h2>
        <ul>
            <li><strong>Apache</strong> with support for PHP and MariaDB.</li>
            <li><strong>PHP 7.4 or above</strong>.</li>
            <li><strong>MariaDB</strong> or MySQL.</li>
        </ul>
    </section>

    <footer>
        <p>&copy; 2024 / 2025 Technical Manual. Joan Saura Martinez.</p>
    </footer>
    <a href=""></a>
</div>

<?php include $root . '/student071/dwes/files/common-files/footer.php'; ?>
