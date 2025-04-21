<?php
    require_once __DIR__ . '/../config/init.php';
    require_once CORE_PATH . '/App.php';
?>

<?php
    include_once INC_PATH . '/layouts/head.php';
    include_once INC_PATH . '/layouts/header.php'; 
?>

<?php

$db = DB::getInstance();

$estimates = $db->query("
    SELECT 
        e.id AS no,
        e.estimate_code,
        e.issued_at,
        e.expired_at,
        e.total_price,
        c.company_name,
        s.name AS staff_name
    FROM nb_estimate e
    JOIN nb_client c ON e.client_id = c.id
    JOIN nb_staff s ON e.staff_id = s.id
    ORDER BY e.id DESC
");


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
                            <th>NO</th>
                            <th>견적번호</th>
                            <th>회사명</th>
                            <th>담당자</th>
                            <th>금액</th>
                            <th>발행일</th>
                            <th>유효기간</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estimates as $row): ?>
                        <tr>
                            <td><?= $row['no'] ?></td>
                            <td><a href="./view.php?id=<?= $row['no'] ?>"><?= $row['estimate_code'] ?></a></td>
                            <td><?= $row['company_name'] ?></td>
                            <td><?= $row['staff_name'] ?></td>
                            <td><?= number_format($row['total_price']) ?>원</td>
                            <td><?= $row['issued_at'] ?></td>
                            <td><?= $row['expired_at'] ?></td>
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