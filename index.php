<!-- This file will serve as the Controller for the Application
 according to the MVC architecture we are implementing -->
<!-- It's the center processing unit for the application -->

<?php

/* importing what we need from the models file */
require('model/database.php');
require('model/assignments_db.php');
require('model/course_db.php');

/* Listing the data the Controller will Receive such as Input data from the User.
These are mostly through a post method*/
// Grab the text from the form in each file from assignment_list, course_list & course_db
$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$description = htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES, 'UTF-8');
$course_name = htmlspecialchars($_POST['course_name'] ?? '', ENT_QUOTES, 'UTF-8');
$update_name = htmlspecialchars($_POST['update'] ?? '', ENT_QUOTES, 'UTF-8');
$course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
if (!$course_id) {
    $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
}

//The Route
/* The Action Variable help us to pick the different route to go throughout our Controller
   This will be bury inside our form */
$action = htmlspecialchars($_POST['action'] ?? '', ENT_QUOTES, 'UTF-8');
if (!$action) {
    $action = htmlspecialchars($_GET['action'] ?? '', ENT_QUOTES, 'UTF-8');
    if (!$action) {
        $action = 'list_assignments';
    }
}

//The Handling of the Routing
/* Using a Control flow statement */
switch ($action) {
    case "list_courses":
        $courses = get_courses();
        include('view/course_list.php');
        break;
    case "add_course":
        // Check if the variable actually has text inside it
        if (!empty($course_name)) {
            // If it's good, add it to the database
            add_course($course_name);
            header("Location: .?action=list_courses");
        } else {
            // If it's empty, stop and show them an error screen
            $error = "Invalid course data. Please enter a valid course name.";
            include('view/error.php');
            exit(); // Stop the script from running any further
        }
        break;
    case "add_assignment":
        if ($course_id && $description) {
            add_assignment($course_id, $description);
            header("Location: .?course_id=$course_id");
        } else {
            $error = "Invalid assignment data. Check all fields and try again.";
            include('view/error.php');
            exit();
        }
        break;
    case "delete_course":
        if ($course_id) {
            try {
                delete_course($course_id);
            } catch (PDOException $e) {
                $error = "You cannot delete a course if assignments exist in the course.";
                include('view/error.php');
                exit();
            }
            //We can a redirect route.
            header("Location: .?action=list_courses");
        }
        break;
    case "delete_assignment":
        if ($assignment_id) {
            delete_assignment($assignment_id);
            $message = "You have successfully deleted your assignment";
            include('view/error.php');
            // header("Location: .?course_id=$course_id");
        } else {
            $error = "Missing or Incorrect assignment Id.";
            include('view/error.php');
        }
        break;
    case "update_course":
        if ($course_id && !empty($update_name)) {
            try {
                update_course($course_id, $update_name);
                $message = "You have successfully updated your course!";
                include('view/error.php');
            } catch (PDOException $e) {
                $error = "Something went wrong editing this course.";
                include('view/error.php');
            }
        }
        break;
    default:
        $course_name = get_course_name($course_id);
        $courses = get_courses();
        $assignments = get_assignment_by_course($course_id);
        include('view/assignments_list.php');
        break;
}

?>