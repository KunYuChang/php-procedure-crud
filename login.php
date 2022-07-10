<?php

require 'includes/url.php';

session_start();

require 'includes/header.php';

if ($_SESSION['REQUEST_METHOD'] == "POST") {

    if ($_POST['username'] == 'kunyu' && $_POST['password'] == 'secret') {

        // Prevent Session Fixation Attacks
        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;

        redirect('/');
    } else {
        $error = 'login incorrect';
    }
}

?>

<h2>登入</h2>

<?php if (!empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label for="username">帳號</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">密碼</label>
        <input type="password" name="password" id="password">
    </div>
</form>

<?php require 'includes/footer.php'; ?>