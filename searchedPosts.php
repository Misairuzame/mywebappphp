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
                <h2>Hai cercato: <?php echo test_input($srch) ?></h2>
                <?php
                try {
                    $rows = search_posts($srch);
                    if (count($rows) == 0) {
                        echo '<div class="col-12 col-12-mobile"><h3>Nessun post trovato</h3></div>';
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
                echo '<input type="button" onclick="location.href=\'./searchPosts.php\';" value="Clicca qui per effettuare una nuova ricerca" />';
                ?>
            </div>
        </div>
    </section>
</div>
<?php include 'bottom.inc';?>
</body>
</html>
