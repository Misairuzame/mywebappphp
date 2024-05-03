<?php
require_once 'db.php';
require_once 'test_input.php';

/**
 * VULNERABILE
 */
function search_posts($testo){
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM posts WHERE testo LIKE '%".$testo."%'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_all_posts(){
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM posts ORDER BY date DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$srch = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $srch = $_GET["text"];
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Benvenuto</title>
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
                <h2>Lista dei post</h2>
                <?php if (isset($_GET['error']) && $_GET['error'] != '') {
                    echo '<div class="col-12 col-12-mobile"><h3 class="error">'.$_GET['error'].'</h3></div>';
                } ?>
                <?php
                try {
                    if (strlen($srch) > 0) {
                        $rows = search_posts($srch);
                    } else {
                        $rows = get_all_posts();
                    }
                    if (count($rows) == 0) {
                        echo '<div class="col-12 col-12-mobile"><h3>Nessun post trovato nel database</h3></div>';
                    } else {
                        echo '
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <th>Id</th><th>Data</th><th>Testo</th><th>Utente</th>
                                </thead>
                                <tbody>';
                        foreach ($rows as $r) {
                            echo '<tr>';
                            foreach ($r as $c) {
                                echo '<td>' . $c . '</td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody></table>';
                    }
                } catch (Exception $e) {
                    echo '<h3 class="error">'.$e.'</h3>';
                }
                
                ?>
            <input type="button" onclick="location.href='./searchPosts.php';" value="Clicca qui cercare fra i post" />
            <input type="button" onclick="location.href='./new-post.php';" value="Inserisci un post" />
            </div>
        </div>
    </section>
</div>
<?php include 'bottom.inc';?>
</body>
</html>
