# Recipe Hub

A web-based recipe management application built with PHP, MySQL, HTML, CSS, and JavaScript.

## Project Overview

Recipe Hub is a comprehensive recipe sharing platform that allows users to browse, search, add, edit, and favorite recipes. The application features a user-friendly interface and an admin panel for managing recipes.

## Architecture

The project follows a three-layer architecture:

### 1. Presentation Layer
- HTML templates for user interface
- CSS styling (GeneralStyles.css, AdminStyles.css)
- JavaScript functionality (scripts.js)

### 2. Business Layer
- PHP scripts for application logic
- Recipe management (add, edit, delete)
- User favorites functionality
- Category filtering

### 3. Data Layer
- MySQL database (recipe_hub.sql)
- Data access and storage operations

## Project Structure

```
Project_RecipeHubIT390/
├── Database/
│   ├── NOTE.txt
│   └── recipe_hub.sql          # Database schema and data
├── Documentation (READ FIRST)/
│   ├── Recipe Hub Group Project.pdf
│   └── Recipe Hub Group Project.pptx
└── RecipeHub/
    ├── index.php               # Home page
    ├── recipes.php             # Recipe listing
    ├── recipe-detail.php       # Individual recipe view
    ├── add_recipe.php          # Add new recipe form
    ├── edit_recipe.php         # Edit existing recipe
    ├── delete_recipe.php       # Delete recipe
    ├── categories.php          # Recipe categories
    ├── favorites.php           # User favorites
    ├── favorite.php            # Add to favorites
    ├── about_us.php            # About page
    ├── admin_login.php         # Admin login
    ├── admin_panel.php         # Admin dashboard
    ├── logout.php              # User logout
    ├── fetch_recipes.php       # API for fetching recipes
    ├── css/
    │   ├── GeneralStyles.css   # Main stylesheet
    │   └── AdminStyles.css     # Admin panel styles
    ├── js/
    │   └── scripts.js          # Client-side scripts
    └── Images/
        └── [Recipe images]
```

## Features

- **Browse Recipes**: View all available recipes on the home page
- **Recipe Details**: View detailed recipe information including ingredients and instructions
- **Categories**: Filter recipes by category
- **Search**: Find specific recipes
- **Favorites**: Save favorite recipes for quick access
- **Admin Panel**: Manage recipes (add, edit, delete)
- **User Authentication**: Admin login system

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache (XAMPP/WAMP)

## Database

The database `recipe_hub.sql` contains tables for:
- Recipes
- Categories
- Users (admin)

## Team Members

### Basics of Architecture

The following team members contributed to the architectural design of the project:

- **Turki Alshalaan**
- **Abdulrahman Alsalehi**
- **Fahad AlGhamdi**
- **Meshari Alhussainan**

### Web Systems

The following team members contributed to the database design, website design, and code implementation:

- **Turki Alshalaan**
- **Alwaleed Alhamdan**
- **Tariq Alharbi**
- **Meshari Alhussainan**

## Installation

1. Install XAMPP or WAMP server
2. Start Apache and MySQL services
3. Create a new database named `recipe_hub`
4. Import the `recipe_hub.sql` file into the database
5. Copy the `RecipeHub` folder to your web server's htdocs directory
6. Access the application at `http://localhost/RecipeHub/`

## Default Admin Credentials

- **Username**: admin
- **Password**: admin123

*(Note: Change these credentials in production)*

## License

This project was created for educational purposes as a group project.
