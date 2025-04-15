<?php
    require_once __DIR__ . '/config/init.php';
    require_once CORE_PATH . '/App.php';
?>

<?php
    include_once INC_PATH . '/layouts/head.php';
    include_once INC_PATH . '/layouts/header.php'; 
?>

<?php
    $departments = DB::query('SELECT id, name FROM departments');
?>

<main>
    <?php foreach($departments as $k=>$v) :?>
    <p><?=$v['name']?></p>
    <?php endforeach;?>
</main>


<?php include_once INC_PATH . '/layouts/footer.php'; ?>