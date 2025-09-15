<?php ob_start();?>

<h1>This is the Login page .</h1>

<?php 

    $content = ob_get_clean();
    require __DIR__ .'/Layout.php';
?>