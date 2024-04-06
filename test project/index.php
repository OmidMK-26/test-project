<?php

include 'config/db_connect.php';

// ایجاد query
$sql = "SELECT * FROM `my job`;";

// ساخت query
$result = mysqli_query($conn, $sql);
// دریافت اطلاعات
$jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);

?>



<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>

<h4 class="center #1a237e"><b>About me</b></h4>
<div class="img">
    <a href="https://t.me/omidmakhouniki"><img src="img/IMG_4056.jpg" width="100%" alt="omid"></a>
</div>

<div class="me">
    <h3>Hi!</h3>
    <p>My name is Omid Makhouniki; A 23-year-old boy, with a deep passion for what he's doing. At the beginning of his career, not only did he know little about programming, but also had no idea that one day he love it and dedicate so much time to progress. This is extraordinary. you have to got passion for it, this brings strong perseverance along with it. <br><b>comment me your Oppinion.</b>💖 </p>
</div>

<div class="container">
    <div class="row">

        <?php foreach ($jobs as $job) { ?>

            <div>
                <div class="card z-depth-6 bl">
                    <img src="img/profile.PNG" width="40%" class="profile">
                    <div class="card-content center ">
                        <h5><?php echo htmlspecialchars($job['title']) ?></h5>
                        <ul>
                            <p><?php foreach (explode(',', $job['ingredients']) as $ing) { ?>
                                    <li><?php echo htmlspecialchars($ing); ?></li>
                                <?php } ?>
                            </p>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php?id=<?php echo $job['Id']; ?>">more info</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'footer.php'; ?>


</html>