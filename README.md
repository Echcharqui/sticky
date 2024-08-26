# Sticky Notes App - Version 1.0.0

Sticky Notes is a PHP-based web application designed for managing personal notes. This version (1.0.0) introduces core functionality, including user registration, login, note management, and user settings.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [File Structure](#file-structure)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Features

- **User Registration & Login:** Secure user authentication with form validation.
- **Note Management:** Create, edit, and delete personal sticky notes.
- **User Profile Management:** Update user information, change password, and upload a custom avatar.
- **Responsive Design:** Optimized for various devices.

## Technologies Used

- **Frontend:**
  - HTML, CSS, JavaScript for structure, styling, and interactivity.
  - Custom static assets: `main-CObkJrV3.css`, `main-D_J3YjDD.js`.
  
- **Backend:**
  - **PHP:** Server-side logic and page rendering.
  - **MVC Pattern:** Organized codebase with controllers, views, and utilities.
  - **Database:** MySQL (or similar) for data persistence, managed via `Database.php`.
  
- **Validation:**
  - Custom PHP scripts for form and data validation.

## Installation

To set up the Sticky Notes App locally:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/sticky-notes-app.git
   ```

2. **Navigate to the project directory:**

   ```bash
   cd sticky-notes-app
   ```

3. **Set up the Database:**
   - Import the SQL schema to create necessary tables.
   - Configure the `Database.php` file with your database credentials.

4. **Start a Local Server:**
   - Use Apache or a similar server to host the PHP application.
   - Ensure the root directory is correctly pointed to the project folder.

5. **Open your browser and visit:**

   ```
   http://localhost/sticky-notes-app
   ```

## Usage

- **User Registration:** Sign up by providing your details.
- **Login:** Access your account using your credentials.
- **Manage Notes:** 
  - Create a new note using the "Add Note" feature.
  - Edit an existing note by clicking on it.
  - Delete a note using the delete option.
- **Profile Management:**
  - Update your personal information.
  - Change your password.
  - Upload an avatar image.

## File Structure

Here's an overview of the project structure:

```plaintext
├── assets
│   ├── main-CObkJrV3.css
│   ├── main-D_J3YjDD.js
│   └── uploads
│       └── avatars
├── controllers
│   ├── add-note.controller.php
│   ├── delete-note.controller.php
│   ├── edit-avatar.controller.php
│   ├── edit-note.controller.php
│   ├── edit-password.controller.php
│   ├── edit-user-info.controller.php
│   ├── home.controller.php
│   ├── login.controller.php
│   ├── logout.controller.php
│   ├── registration.controller.php
│   └── settings.controller.php
├── database
│   └── Database.php
├── index.php
├── layouts
│   ├── footer.php
│   └── header.php
├── LICENSE
├── partials
│   └── navBar.php
├── README.md
├── router.php
├── util
│   └── util.php
├── validations
│   ├── add-note.validation.php
│   ├── avatar-editing.validation.php
│   ├── edit-password.validation.php
│   ├── edit-user-info.validation.php
│   ├── login.validation.php
│   └── registration.validation.php
└── views
    ├── 403.view.php
    ├── 404.view.php
    ├── 500.view.php
    ├── add-note.view.php
    ├── edit-note.view.php
    ├── home.view.php
    ├── login.view.php
    ├── registration-successful.view.php
    ├── registration.view.php
    └── settings.view.php
```

## Contributing

Contributions are welcome! If you have suggestions or want to report a bug, please create an issue or submit a pull request. Ensure that your code adheres to the project's coding standards.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

For any questions or feedback, please reach out at [echcharqui.dev@gmail.com](mailto:echcharqui.devl@gmail.com).
