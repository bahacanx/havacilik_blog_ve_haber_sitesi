<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="main.php">Hero Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../pages/main.php">Anasayfa</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../pages/news.php">Haberler</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../pages/blogs.php">Bloglar</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../pages/contact.php">İletİşİm</a></li>
            </ul>
            <li class="nav-item dropdown btn btn-outline-light px-2 py-1">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa-regular fa-user px-1"></i>
                <?php echo $username = $_SESSION["username"]; ?></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../logout.php">Çıkış</a></li>
                </ul>
            </li>

        </div>
    </div>
</nav>