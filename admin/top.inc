<header id="header" class="alt">
    <a href="home.php" ><h2 style="color: white;">UnifePost</h2></a>
    <nav id="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li>
                <a href="#" class="icon solid fa-angle-down">Benvenuto <?php echo $_SESSION["uname"]; ?></a>
                <ul>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>	