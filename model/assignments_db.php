<!-- This file will interact with my database thgh the db file -->
<!-- Combine php and sql -->

<!-- Logic for Interaction with the assignment table using CRUD STATEMENT
-->

<?php

//1. READ/SELECT ASSIGNMENT DATA
function get_assignment_by_course(?int $course_id = null)
{
    global $db;
    if ($course_id !== null && $course_id != 0) {
        $query = 'SELECT A.assignmentID, A.Description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID WHERE A.courseID = :course_id ORDER BY A.assignmentID';
    } else {
        $query = 'SELECT A.assignmentID, A.Description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID ORDER BY C.courseID';
    }
    $statement = $db->prepare($query);
    if ($course_id !== null && $course_id != 0) {
        $statement->bindValue(':course_id', $course_id, PDO::PARAM_INT);
    }
    $statement->execute();
    $assignments = $statement->fetchAll();
    $statement->closeCursor();
    return $assignments;
}

//2. DELETE ASSIGNMENT DATA
function delete_assignment(int $assignment_id)
{
    global $db;
    $query = 'DELETE FROM assignments WHERE assignmentID = :assign_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':assign_id', $assignment_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}

//3. INSERT/ADD ASSIGNMENT DATA
function add_assignment(int $course_id, string $description)
{
    global $db;
    $query = 'INSERT INTO assignments (Description, courseID) VALUES (:descr, :courseID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':descr', $description, PDO::PARAM_STR);
    $statement->bindValue(':courseID', $course_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}

?>