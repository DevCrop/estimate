<?php
    require_once __DIR__ . '/../config/init.php';
    require_once CORE_PATH . '/App.php';
?>

<?php
    include_once INC_PATH . '/layouts/head.php';
    include_once INC_PATH . '/layouts/header.php'; 
?>

<?php

$doctors = [
    ['no' => 1, 'center' => '서울센터', 'name' => '홍길동', 'photo' => 'photo1.jpg'],
    ['no' => 2, 'center' => '부산센터', 'name' => '이순신', 'photo' => 'photo2.jpg'],
    ['no' => 3, 'center' => '대구센터', 'name' => '강감찬', 'photo' => 'photo3.jpg'],
];
?>


<main class="my-auto">
    <div class="container">
        <a href="./new.php" class="btn btn-primary">
            의료진 추가
        </a>
        <div class="m-3"></div>
        <form action="">
            <fieldset>
                <legend style="display : none">의료진 관리</legend>
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>NO</th>
                            <th>센터</th>
                            <th>성함</th>
                            <th>사진</th>
                            <th>수정</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($doctors as $index => $doc): ?>
                        <tr>
                            <td><input type="checkbox" class="row-check"></td>
                            <td><?= $doc['no'] ?></td>
                            <td><?= $doc['center'] ?></td>
                            <td>
                                <a href="./view.php">
                                    <?= $doc['name'] ?>
                                </a>
                            </td>
                            <td>
                                <img src="/uploads/<?= $doc['photo'] ?>" alt="<?= $doc['name'] ?>" width="50">
                            </td>
                            <td><a href="#" class="btn-edit">수정</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </fieldset>
        </form>
    </div>
</main>

<script src="./js/app.js"></script>



<?php include_once INC_PATH . '/layouts/footer.php'; ?>