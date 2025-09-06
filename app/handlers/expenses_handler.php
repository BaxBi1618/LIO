<?php
    require_once render_view(CONFIG_PATH, "db.php");

    $conn = db_connect();

    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("
        SELECT 
            expenses.type,
            expenses.amount,
            expenses_cat.name AS category_name,
            expenses_cat.bg_color AS category_bg_color,
            expenses_cat.text_color AS category_text_color
        FROM expenses
        JOIN expenses_cat ON expenses.category_id = expenses_cat.id
        WHERE expenses.user_id = ?
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $expenses = $result->fetch_all(MYSQLI_ASSOC);

    require_once __DIR__ . '/../../public/views/expenses/expensesDashboard.php';