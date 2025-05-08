<?php
// クッキーが存在する場合、login.phpにリダイレクト
if (isset($_COOKIE['login'])) {
    header('Location: login.php');
    exit();
}

// フォームが送信された場合
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if ($password === 'mlh03443') {
        // クッキーを設定
        setcookie('login', 'true', time() + 3600, '/'); // 1時間有効
        header('Location: login.php');
        exit();
    } else {
        $error = 'パスワードが間違っています。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログインページ</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label for="password">パスワード:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>
