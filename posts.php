<?php
require_once 'logged.php';
require_once 'test_input.php';

if(logged()){
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $rows = print_posts();
    } else {
        header("Location: login.php?error=request method error");
        die();
    }
}

function print_posts(){
    $conn = connect();
    $sql = "SELECT * FROM posts WHERE username=:uname";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":uname", $_SESSION["uname"]);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>I tuoi post</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="landing is-preload">
<div id="page-wrapper">
    <?php include 'top.inc';?>
    <section id="main" class="container">
        <div class="row">
            <div class="col-12">
                <h2>Posts</h2>
                <a href="new-post.php" class="button">Inserisci un nuovo post</a>
                <br><hr>
                <?php
                if(count($rows)==0){
                    echo '<div class="col-12 col-12-mobile"><h3>Non hai ancora scritto nessun post.</h3></div>';
                } else {
                    echo '<div class="table-wrapper"><table><thead><tr><th>Data</th><th>Testo</th></tr></thead><tbody>';
                    $tot = 0;
                    $totp = 0;
                    $totn = 0;
                    foreach ($rows as $r) {
                        echo '<tr><td>'.$r['date'].'</td>
                            <td class="max-table">'.substr($r['testo'],0,32).' '.(strlen($r['testo'])>32? " ...":"").'</td>
                        </tr>';
                    }
                }
                ?>
            </div>
        </div>
    </section>
</div>
<?php include 'bottom.inc';?>
</body>
</html>
