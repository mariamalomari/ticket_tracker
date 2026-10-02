# Ticket Tracker Application

A full-stack web application for managing issues.

Some features:
* **Navbar:** global top bar, quickly filters for a specific project, or search for a ticket, or access your profile.
* **Sidebar:** to easily jump from Dashboard (includes some stats, and option to create a new ticket), All Tickets and My Tickets
* **Search & Filtering:** filter through the projects by one of its inputs
* **Ticket Management:** create a new ticket or edit an old one (Create, Edit, View, Delete options)

Built with PHP, MySQL, Bootstrap 5, and Vanilla JS.

The backend follows an MVC (Model-View-Controller) architecture.
* **Controller:** application logic and request handling.
* **Model:** database interactions
* **Public:** publicly accessable documents, route handling
* **Views:** frontend HTML + PHP + JS

Controllers receive request from the public/ entry points, validate input server-side, then they call the appropriate database models and finally pass the necessary data to the view files.

Models use PDO with prepared statements to run secure SQL queries.
Views are the pure presentation files that include the bootstrap HTML templates. 
    - Data passed from the controller is rendered safely is the view using htmlspecialchars()

PHP sessions manage authenticated state across pages and automaticallly redirecting the user to the login route when needed.



## Setup Steps
1. Open phpMyAdmin or your MySQL CLI and create a database:
    ```sql 
    CREATE DATABASE ticket_tracker_application;
    ```
2. Import the database_setup.sql SQL schema into the ticket_tracker_application database to create the required tables which are: users, tickets and projects.
3. Update your database connection settings in `config/db.php`.
4. Running locally:
    - Start PHP's built-in development server from the project directory pointing to the public/ directory:
    ```bash 
    php -S localhost:8000 -t public
    ```
    - Access the application in the browser at: http://localhost:8000/login.php


update about admin thingy