<!DOCTYPE html>
<html lang="en">
<head>
    <title>my cool title</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
<header>
    <a href="/">
        <div class="headerButton">
            Home
        </div>
    </a>
    <?php
    if (isset($_SESSION['message'])){ ?>
            <div>
                <?= $_SESSION['message']?>
            </div>
        <?php
    }
    if (isset($_SESSION['auth'])){ ?>
        <a href="/userEdit">
            <div class="headerButton">
                Edit User Data
            </div>
        </a>
        <a href="/logout">
            <div class="headerButton">
                logout
            </div>
        </a>
        <?php
    } else{ ?>
        <a href="/login">
            <div class="headerButton">
                sign in
            </div>
        </a>
        <a href="/userCreate">
            <div class="headerButton">
                sign up
            </div>
        </a>
        <?php
    }
    ?>
</header>
<main>
    <?= $content??'not found' ?>
</main>
</body>
</html>
<?php