<!--This file display Message(error and success detail) template  -->
<?php
// Only default to empty if the variables do not exist
$message = $message ?? "";
$error = $error ?? "";
?>

<?php include('header.php') ?>
<?php if ($message) { ?>
    <section class="message">
        <h2>Congratulation</h2>
        <p><?= $message ?></p>
    </section>
<?php } else { ?>
    <section class="message">
        <h2>Opps!</h2>
        <p><?= $error ?>></p>
    </section>
<?php } ?>
<br>
<div class="message-div">
    <p><a href=".">Back to List</a></p>
</div>
<?php include('footer.php') ?>