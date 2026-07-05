<!-- This file will interact with the database through the db file
Combine PHP and SQL -->

<!-- Logic for interaction with the courses table -->

<?php
//1. READ/SELECT COURSES DATA
function get_courses()
{
    global $db;
    $query = 'SELECT * FROM courses ORDER BY courseID';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();
    return $courses;
}

//2. READ/SELECT COURSES DATA BY NAME
function get_course_name(?int $course_id = null)
{
    global $db;
    if ($course_id === null || $course_id == 0) {
        return "All Courses";
    }
    $query = 'SELECT * FROM courses WHERE courseID = :course_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id, PDO::PARAM_INT);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
    $course_name = $course['courseName'] ?? null;
    return $course_name;
}


//2. DELETE COURSE DATA
function delete_course(int $course_id)
{
    global $db;
    $query = 'DELETE FROM courses WHERE courseID = :course_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}

//3. INSERT/ADD COURSE DATA
function add_course(string $course_name)
{
    global $db;
    $query = 'INSERT INTO courses (courseName) VALUES (:courseName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':courseName', $course_name, PDO::PARAM_STR);
    $statement->execute();
    $statement->closeCursor();
}

/* Personal Added Feature */
//3. UPDATE/EDIT COURSE DATA
function update_course(int $course_id, string $update_name)
{
    global $db;
    $query = 'UPDATE courses SET courseName = :update_name WHERE courseID = :course_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':update_name', $update_name, PDO::PARAM_STR);
    $statement->bindValue(':course_id', $course_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}
?>