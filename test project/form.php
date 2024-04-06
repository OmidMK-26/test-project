<?php
include 'config/db_connect.php';

$email = $title = $ingredients = '';

$errors = array('email' => '', 'title' => '', 'ingredients' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required <br>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is not valid <br>';
        }
    }

    if (empty($_POST['title'])) {
        $errors['title'] = 'Name required <br>';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Name must be letters and spaces only <br>';
        }
    }

    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'Fill This Part <br>';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^[a-zA-Z\s]+(,\s?[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'text must be letters and spaces only <br>';
        }
    }

    if (!array_filter($errors)) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "INSERT INTO `my_job` (`title`, `email`, `ingredients`) VALUES ('$title', '$email', '$ingredients')";

        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Query faild' . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html>

<?php include 'header.php' ?>

<section class="container grey-text">
    <h4 class="center"><b>Tell me about your Oppinion</b></h4>

    <form class="blur" action="index.php" method="POST">
        <label class="black-text">your email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><?php echo $errors['email'] ?></div>
        <label class="black-text">Your Name</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
        <div class="red-text"><?php echo $errors['title'] ?></div>
        <label class="black-text">your Oppinion</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
        <div class="red-text"><?php echo $errors['ingredients'] ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>

</section>

<?php include 'footer.php' ?>

</html>