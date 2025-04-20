<?php
    require_once __DIR__ . '/../config/init.php';
    require_once CORE_PATH . '/App.php';
?>

<?php
    include_once INC_PATH . '/layouts/head.php';
    include_once INC_PATH . '/layouts/header.php'; 
?>




<main class="my-auto">
    <div class="py-5">
        <div class="container">
            <form action="">
                <fieldset>
                    <legend style="display : none">견적서 추가</legend>
                    <!-- 견적 정보 -->
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="issued_at" name="issued_at" placeholder="견적날짜">
                        <label for="issued_at">견적날짜</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="estimate_code" name="estimate_code"
                            placeholder="견적번호">
                        <label for="estimate_code">견적번호</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="expired_at" name="expired_at" placeholder="유효기간">
                        <label for="expired_at">견적유효날짜</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="client_name" name="client_name" placeholder="이름">
                        <label for="client_name">견적 금액</label>
                    </div>

                    <hr>

                    <!-- 담당자 정보 -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="staff_name" name="staff_name" placeholder="담당자 성함">
                        <label for="staff_name">담당자 성함</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="staff_position" name="staff_position"
                            placeholder="직책">
                        <label for="staff_position">담당자 직책</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="staff_phone" name="staff_phone" placeholder="연락처">
                        <label for="staff_phone">담당자 연락처</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="staff_email" name="staff_email" placeholder="이메일">
                        <label for="staff_email">담당자 이메일</label>
                    </div>

                    <hr>

                    <!-- 클라이언트 정보 -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="회사명">
                        <label for="company_name">클라이언트 회사명</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="client_name" name="client_name" placeholder="이름">
                        <label for="client_name">클라이언트 성함</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="client_position" name="client_position"
                            placeholder="직책">
                        <label for="client_position">클라이언트 직책</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="client_phone" name="client_phone" placeholder="연락처">
                        <label for="client_phone">클라이언트 연락처</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="client_email" name="client_email"
                            placeholder="이메일">
                        <label for="client_email">클라이언트 이메일</label>
                    </div>
                    <hr>
                    <!-- 부가세 -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault1">
                        <label class="form-check-label" for="radioDefault1">
                            부가세 포함
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2" checked>
                        <label class="form-check-label" for="radioDefault2">
                            부가세 미포함
                        </label>
                    </div>
                    <hr>
                    <!-- 견적 그룹 생성 -->
                    <div class="no-estimate-wrap"></div>

                    <hr>

                    <!-- 견적 아이템 생성 -->
                    <button type="submit" class="btn btn-primary">최종저장</button>
                    <button type="submit" class="btn btn-secondary">임시저장</button>
                </fieldset>
            </form>
        </div>
    </div>
</main>

<script src="<?=ASSETS_URL?>/js/app.js?v=<?=cacheInit?>"></script>



<?php include_once INC_PATH . '/layouts/footer.php'; ?>