# Employee Management System

## Overview

The Employee Management System is a web application designed to manage employee records, departmental information, and user authentication. Built with PHP, HTML, Bootstrap, and MySQL, it provides a user-friendly interface for administrators to efficiently handle organizational data.
---

## Features

- **User Authentication:** Secure login system for administrators.
- **Employee Management:** Add, edit, view, and delete employee records.
- **Department Management:** Manage departmental information.
- **Responsive Design:** Utilizes Bootstrap for mobile-friendly interfaces.
---

## Technologies Used

- **Frontend:** HTML, Bootstrap
- **Backend:** PHP
- **Database:** MySQL
---

## Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/Mostafa-Ashour/Final-Demo.git
2. **Navigate to the Directory**  
   Move into the project folder:  
   ```bash
   cd Final-Demo

3. **Set Up the Database:** 
   - Create a MySQL database named `employee_management`.  
   - Import the SQL file located in the `database/` folder to set up the necessary tables.

4. **Configure the Database:**
   - Update the database settings in the app/config.php file with your MySQL credentials.

5. **Run the Application:**
   - Place the project files in your server's root folder (e.g., htdocs for XAMPP).
   - Access the application in your browser via:
      ```bash
      http://localhost/Final-Demo
---

## How to Use

1. **Login:**
   - Navigate to http://localhost/Final-Demo/login.php.
   - Enter admin credentials to access the admin panel.

2. **Dashboard:**
   - View summaries of employees and departments.
   - Access quick links to manage employees and departments.

3. **Manage Employees:**
   - Add, edit, delete, or view employee records.

4. **Manage Departments:**
   - Add, edit, delete, or view department details.
---

## Functionalities Overview

1. **User Authentication:**
   - Secure login system with session management to restrict access to authorized users.
   - Logout feature for secure session termination.

2. **Dashboard:**
   - Central hub showing the total number of employees and departments.
   - Quick links to employee and department management sections.

3. **Employee Management:**
   - Add new employees with details like name, department, and designation.
   - Edit and update existing employee information.
   - Delete employee records when no longer needed.
   - View a paginated and searchable list of all employees.

4. **Department Management:**
   - Add new departments with names and descriptions.
   - Edit and update existing department details.
   - Delete departments no longer relevant to the organization.
   - View a list of all departments.
---

### Folder Details

#### `app/`
Contains the core application logic and configuration files necessary for initializing and managing the project.

#### `assets/`
Houses static assets such as:
- CSS for styling
- JavaScript files for client-side functionality
- Images and other media

#### `database/`
Includes all SQL files and configurations for setting up the project database schema and initializing data.

#### `department/`
Manages the functionalities related to departments in the application. 
Example functionalities:
- Adding or updating departments
- Fetching department data

#### `employees/`
Handles employee-related features, such as:
- Employee registration
- Viewing and updating employee details

#### `shared/`
Stores shared components, such as:
- `header.php` - For consistent navigation headers across pages
- `footer.php` - For page footers

#### `index.php`
The main entry point for the application, serving as the homepage.

#### `login.php`
Manages user authentication, including:
- Login forms
- Session handling

#### `README.md`
Documentation for the project, including setup and usage instructions.
---

## Technologies Used

- Frontend: HTML, Bootstrap
- Backend: PHP
- Database: MySQL
---

## Contributing
- Contributions are welcome! To contribute:
   1. Fork the repository.
   2. Create a new branch (feature/my-feature).
   3. Commit your changes (git commit -m "Add my feature").
   4. Push the branch (git push origin feature/my-feature).
   5. Open a pull request.
