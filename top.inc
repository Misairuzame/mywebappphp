<?php session_start(); ?>
<header id="header" class="alt">
    <a href="home.php" ><h2 style="color: white; margin-left: 5px;">UnifePost</h2></a>
    <nav id="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li>
                <?php
                $lgd = isset($_SESSION["uname"]);
                if ($lgd) {
                    $text = "Benvenuto ".$_SESSION["uname"];
                }
                else {
                    $text = "Login";
                }
                ?>
                <a href="#" class="icon solid fa-angle-down"><?php echo $text; ?></a>
                <ul>
                <?php
                if ($lgd) {
                ?>
                    <li><a href="posts.php">Posts</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php
                } else {
                ?>
                    <li><a href="login.php">Login</a></li>
                <?php
                }
                ?>
                </ul>
            </li>
        </ul>
    </nav>
</header>	