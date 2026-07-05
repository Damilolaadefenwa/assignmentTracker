<!--List All of the Courses and Add a Course -->

<?php include('view/header.php') ?>

<?php if (!empty($courses)) { ?>
    <section id="list" class="list">
        <header class="list__row list__header">
            <h1>Course List</h1>
        </header>

        <?php foreach ($courses as $course) : ?>
            <div class="list__row">

                <div class="list__item">
                    <p class="bold"><?= $course['courseName'] ?></p>
                </div>

                <div class="list__removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_course">
                        <input type="hidden" name="course_id" value="<?= $course['courseID'] ?>">
                        <button class="remove-button">❌</button>
                    </form>
                </div>

            </div>
        <?php endforeach ?>
    </section>
<?php } else { ?>
    <p>No courses exit yet.</p>
<?php } ?>

<section id="add" class="add">
    <h2>Add Course</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_course">
        <div class="add__inputs">
            <label>Name:</label>
            <input type="text" name="course_name" maxlength="50" placeholder="Name" autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<br>
<p><a href=".">View &amp; Add Assignments</a></p>

<!-- My Personal Added Feature -->
<section id="add" class="add">
    <h2>Update A Course</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="update_course">
        <div class="add__inputs">
            <label>Course:</label>
            <select name="course_id" required>
                <option value="">Please Select</option>
                <?php if (isset($courses)) { ?>
                    <?php foreach ($courses as $course) : ?>
                        <option value="<?= $course['courseID'] ?>">
                            <?= $course['courseName']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php } ?>
            </select>
            <label>Update:</label>
            <input type="text" name="update" placeholder="Edit a Course ✏️" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Update</button>
        </div>
    </form>
</section>
<?php include('view/footer.php') ?>