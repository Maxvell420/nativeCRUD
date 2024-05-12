<?php
if (isset($_SESSION['error'])){ ?>
    <div>
        <?= $_SESSION['error']?>
    </div>
    <?php
}
if (isset($_SESSION['message'])){ ?>
    <div>
        <?= $_SESSION['message']?>
    </div>
    <?php
}
?>
<div>
    <form action="/auth" method="POST">
        <div>
            <label for="auth">Phone Number or mail</label>
            <input type="text" id="auth" name="auth" value="<?=$_SESSION['data']['auth']??null?>">
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" value="<?=$_SESSION['data']['password']??null?>">
        </div>
        <button type="submit"> log in </button>
    </form>
</div>
