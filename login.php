<?php
// クッキーがない場合、index.phpにリダイレクト
if (!isset($_COOKIE['login'])) {
    header('Location: index.php');
    exit();
}

// ログアウト処理
if (isset($_POST['logout'])) {
    setcookie('login', '', time() - 3600, '/'); // クッキーを削除
    header('Location: index.php');
    exit();
}

// 解読処理
$decoded = '';
if (isset($_POST['decode'])) {
    $encoded = $_POST['encoded'];
    // Base64デコード
    $decoded = base64_decode($encoded);
    if ($decoded === false) {
        $decoded = '解読に失敗しました。無効なBase64文字列です。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン後のページ</title>
</head>
<body>
    <h1>ログイン成功</h1>
    <form method="post">
        <button type="submit" name="logout">ログアウト</button>
    </form>
    <h2>Base64エンコードされた文字列の解読</h2>
    <form method="post">
        <label for="encoded">エンコードされた文字列:</label>
        <input type="text" name="encoded" id="encoded" required>
        <button type="submit" name="decode">解読</button>
    </form>
    <?php if ($decoded) echo "<p>解読結果: $decoded</p>"; ?>
</body>
</html>
