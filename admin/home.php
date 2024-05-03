<?php
require_once 'logged.php';
require_once 'test_input.php';
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>benvenuto</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>
<body class="landing is-preload">
<div id="page-wrapper">
    <?php include 'top.inc';?>
    <section id="main" class="container">
        <div class="row">
            <div class="col-12">
                <?php if(admin()) { echo '<h2>Benvenuto amministratore!<br>Hai completato l\'esercizio! 🥳</h2>';
                } else {
                    header("Location: login.php?error=Effettua il login da amministratore per vedere questa pagina");
                }?>
            </div>
        </div>
    </section>
</div>
<?php include 'bottom.inc';?>
</body>
</html>
