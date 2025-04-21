<?php

require_once __DIR__ . '/../config/init.php';
require_once CORE_PATH . '/DB.class.php';

$db = DB::getInstance();

try {
    $db->beginTransaction();

    // 1. staff 저장
    $staff_id = $db->insert('nb_staff', [
        'name' => $_POST['staff_name'],
        'email' => $_POST['staff_email'],
        'phone' => $_POST['staff_phone'],
        'position' => $_POST['staff_position'],
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 2. client 저장
    $client_id = $db->insert('nb_client', [
        'name' => $_POST['client_name'],
        'email' => $_POST['client_email'],
        'phone' => $_POST['client_phone'],
        'position' => $_POST['client_position'],
        'company_name' => $_POST['company_name'],
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 3. estimate 저장
    $estimate_id = $db->insert('nb_estimate', [
        'estimate_code' => $_POST['estimate_code'],
        'issued_at' => $_POST['issued_at'],
        'expired_at' => $_POST['expired_at'],
        'staff_id' => $staff_id,
        'client_id' => $client_id,
        'total_price' => 0, // 추후 계산
        'var_inclued' => ($_POST['radioDefault'] ?? '') === 'vat' ? 1 : 0,
        'price_mode' => 1,
        'terms' => '',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null
    ]);

    // 4. 그룹 + 항목 저장
    $groups = json_decode($_POST['groups'], true);
    $total_price = 0;

    foreach ($groups as $gIndex => $group) {
        $group_id = $db->insert('nb_estimate_group', [
            'estimate_id' => $estimate_id,
            'group_order' => $group['group_order'],
            'title' => $group['title'],
            'price' => $group['price'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $total_price += (int) $group['price'];

        foreach ($group['items'] as $itemIndex => $item) {
            $db->insert('nb_estimate_item', [
                'group_id' => $group_id,
                'item_order' => $item['item_order'],
                'description' => $item['description'],
                'price' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

    // 5. total_price 업데이트
    $db->update('nb_estimate', ['total_price' => $total_price], ['id' => $estimate_id]);

    $db->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $db->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}