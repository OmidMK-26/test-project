<?php

include 'config/db_connect.php';

if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM `my job` WHERE Id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo 'Query Failed ' . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM `my job` WHERE Id = $id ";

    $result = mysqli_query($conn, $sql);

    $job = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>
<div class="container center">
    <?php if ($job) { ?>
        <img src="img/profile.PNG" width="20%">
        <h4><?php echo $job['title']; ?></h4>
        <p>created by <?php echo $job['email']; ?></p>
        <p><?php echo date($job['created_at']); ?></p>
        <h5>Opinion:</h5>
        <p><?php echo $job['ingredients'] ?></p>

        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $job['Id'] ?>">
            <input type="submit" name="delete" value="delet" class="btn brand z-depth-0">
        </form>
    <?php } else { ?>
        <h5>NOT FOUND</h5>
    <?php } ?>
</div>
<?php include 'footer.php'; ?>

</html>