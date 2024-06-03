<?php
require_once '../db_conn.php';
session_start();
ob_start();
if (!$_SESSION) {
    header('Location:signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/head.php' ?>
</head>

<body>
    <?php include '../include/navigation.php' ?>


    <?php
    $sql_all_blogs = "SELECT blogs.*, users.username FROM blogs INNER JOIN users ON blogs.user_id = users.id";
    $stmt = $pdo->prepare($sql_all_blogs);
    $stmt->execute();
    $blog_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

                <?php foreach ($blog_result as $row) { ?>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('../assets/img/uav1.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center text-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>
                            <h2 class="post-title"><?php echo $row['title'] ?></h2>
                        </h1>
                        <!-- <span class="meta">
                                11 Mart 2024 tarihinde
                                <a href="#!">Akıncı41170</a>
                                tarafından yayınlandı.
                            </span> -->
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Main Content-->
    <div class="container px-4 px-lg-5">

        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">

                ?>
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.php">
                            <h2 class="post-title"><?php echo $row['title'] ?></h2>
                            <h3 class="post-subtitle"><?php echo $row["text"]; ?></h3>
                        </a>
                        <br>
                        <p class="post-meta">
                            <?= $row['time'] ?> tarihinde
                            <a href="#!"><?= $row['username'] ?></a>
                            tarafından yayınlandı.
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                <!-- Pager
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Devamı →</a></div> -->
            </div>
        </div>
    </div>
    <?php } ?>

    <?php include '../include/footer.php' ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
</body>

</html>