# Project: PHP CRUD Operation with Sign In and Sign Up

This project demonstrates a basic CRUD (Create, Read, Update, Delete) operation using PHP. The application includes a user-friendly interface for signing up and signing in, with options to update user details. This README outlines the project features, known issues, and planned improvements.

---

## Features

### 1. **Sign Up Functionality**
   - Users can register by providing their name, email, and password.
   - Data is stored in a MySQL database using prepared statements to prevent SQL injection.

### 2. **Sign In Functionality**
   - Registered users can log in using their email and password.
   - Includes error handling for incorrect credentials.

### 3. **Update User Information**
   - Users can update their name and email via a dedicated update form.
   - Includes server-side validation using a custom `FormValidation` class.

### 4. **Error Handling**
   - Displays detailed error messages for validation issues.
   - Redirects users to the home page if an invalid ID is provided.

### 5. **UI/UX**
   - Responsive design implemented with Bootstrap.
   - Clean and modern layout with accessibility considerations.

---

## Known Issues

### 1. **Password Authorization in Sign In Form**
   - The current implementation does not correctly authorize passwords during sign-in. This is a known bug and will be addressed in a future update.

### 2. **UI and Accessibility Improvements**
   - The user interface and accessibility features (e.g., keyboard navigation, ARIA labels) will be improved in subsequent versions.

---

## Planned Improvements

1. **Fixing Password Authorization**
   - Implement proper hashing and verification for passwords using PHP's `password_hash` and `password_verify` functions.

2. **Enhanced UI/UX**
   - Update the forms and navigation for better user experience.
   - Add tooltips and inline form validation feedback.

3. **Accessibility Enhancements**
   - Add ARIA roles and labels for improved screen reader support.

4. **Additional Features**
   - Add functionality to delete user accounts.
   - Include email verification for sign-up.

---

## Technical Stack

- **Backend**: PHP 7+  
- **Database**: MySQL  
- **Frontend**: HTML, CSS, JavaScript (jQuery, Bootstrap)  
- **Libraries**: jQuery UI for modal dialogs

---

## Setup Instructions

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-repo-link
   cd project-directory
   ```

2. **Set Up Database**:
   - Import the `database.sql` file into your MySQL server.
   - Update the `Config/db_config.php` file with your database credentials.

3. **Start the Server**:
   - Use a local server (e.g., XAMPP, WAMP, or MAMP).
   - Place the project folder in the `htdocs` directory.

4. **Access the Application**:
   - Open a web browser and navigate to `http://localhost/project-folder-name`.

---

## File Structure

```
project-folder/
|-- assets/                # Images and static files
|-- Config/
|   |-- db_config.php      # Database connection
|-- includes/
|   |-- FormValidation.php # Form validation class
|-- index.php              # Entry point for the application
|-- Home.php               # Home page after login
|-- SignIn.php             # Sign-in form
|-- SignUp.php             # Sign-up form
|-- UpdateUser.php         # User update form
|-- README.md              # Project documentation
```

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature-name`.
3. Commit your changes: `git commit -m 'Add feature-name'`.
4. Push to the branch: `git push origin feature-name`.
5. Create a pull request.

---

## License

This project is open-source and available under the MIT License.

---

## Contact

For any queries or suggestions, please contact:

- **Email**: your-email@example.com
- **GitHub**: [your-github-username](https://github.com/your-github-username)

