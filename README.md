# Assignment Tracker 📝

A simple and efficient web application built to help keep track of assignments and tasks. This project follows the Model-View-Controller (MVC) design pattern and uses modern Sass features like variables, mixins, and nesting for clean, maintainable styling. It was developed to serve as a portfolio project showcasing backend database CRUD operations and functional application routing.

## 🛠️ Tech Stack

- **Backend:** PHP
- **Database:** MariaDB / MySQL
- **Frontend Styling:** Sass (SCSS)
- **Local Server:** XAMPP (Apache/PHP)
- **Production Environment:** Docker deployed on Render
- **Architecture:** MVC (Model-View-Controller)

---

## ☁️ Deployment Strategy

### THE PROBLEM

Hosting a full-stack application with a relational database (MariaDB) often requires a paid database subscription. To avoid these fees, this application is containerized using Docker and deployed on Render's free tier. However, Render puts low-traffic web services to sleep. Because the database is hosted within the ephemeral container to save costs, the application lacks persistent memory; any data entered is lost when the container spins down.

### THE SOLUTION

To ensure the application is always presentable for portfolio reviews, recruiters, and user testing, the Docker container is configured with a script manager. Every time Render wakes the container up, this script automatically populates the MariaDB database with a fresh set of dummy data. This guarantees that visitors will always see a fully populated, working application with data ready to be manipulated, bypassing the limitations of ephemeral storage on a free tier.

---

## 📁 Folder Structure (MVC)

- **`/model`**: Handles the database connection and SQL CRUD operations (e.g., fetching, adding, or deleting assignments).
- **`/view`**: Contains the frontend layout and HTML structure (headers, footers, lists).
- **`/controller`**: Manages the data flow, receives user input, and routes actions between the model and the view.
- **`/css`**: Contains the compiled CSS from the Sass files.
- **`/sass`**: Contains the `.scss` files used for styling.

---

## 🐳 Running the Project with Docker

Think of Docker as a tool that helps package up software and everything it needs to run—like libraries and settings—into a neat little box called a "container". This container can then be easily moved around and run on different computers, making it simpler to build, share, and run applications consistently across various environments.

### Prerequisites

Download Docker Desktop: [https://docs.docker.com/get-docker/](https://docs.docker.com/get-docker/)

### Essential Docker Commands

If you want to set up and manage this project locally using Docker, use the following commands in your terminal:

- **Build the image:**
  ```bash
  docker build -t image-name .
  ```
- **List all images:**
  ```bash
  docker image ls
  ```
- **Run the image (using Docker Compose):**
  ```bash
  docker-compose up
  ```
- **Run the image in the background (detached mode):**
  ```bash
  docker-compose up -d
  ```
- **Explore a running container:**
  ```bash
  docker exec -it container-name bash
  ```
- **Restart a container:**
  ```bash
  docker restart container-name
  ```
- **Remove a container:**
  ```bash
  docker rm container-name
  ```
- **Remove an image:**
  ```bash
  docker image rm image-name
  ```
- **Remove all stopped containers (including "none" containers):**
  ```bash
  docker system prune
  ```

---

## 🚀 How to Run Locally (Using XAMPP)

If you prefer traditional local development without Docker:

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/your-username/assignment_tracker.git](https://github.com/your-username/assignment_tracker.git)
    cd assignment_tracker
    ```
2.  **Move the project:**
    Place the `assignment_tracker` folder inside your XAMPP `htdocs` directory (usually located at `C:\xampp\htdocs\`).
3.  **Start XAMPP:**
    Open the XAMPP Control Panel and start the **Apache** and **MySQL** modules.
4.  **Set up the Database:**
    - Open your browser and navigate to `http://localhost/phpmyadmin`.
    - Create a new database (e.g., `assignment_tracker_db`).
    - Import the provided `.sql` file to set up your tables.
    - Update the database connection settings in the `model/database.php` file to match your local setup.
5.  **Compile Sass (Optional):**
    If you want to edit the styles, compile the Sass file to CSS.
    ```bash
    sass sass/main.scss css/main.css --watch
    ```
6.  **Run the App:**
    Open your browser and visit `http://localhost/assignment_tracker`.
