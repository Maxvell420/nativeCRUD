<?php
if (isset($_SESSION['errors'])){
    foreach ($_SESSION['errors'] as $error) { ?>
        <div>
            <?= $error?>
        </div>
            <?php
    }
}
?>
<div>
    <form action="/userSave" method="POST">
        <div
                style="height: 100px"
                id="captcha-container"
                class="smart-captcha"
                data-sitekey="ysc1_tTMTCm6eMrBFWqjrNeXTN4gNRwej8qqvCAKCCom4c3881b6b"
        ></div>
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="<?=$_SESSION['data']['name']??null?>">
        </div>
        <div>
            <label for="auth">Phone Number or mail</label>
            <input type="text" id="auth" name="auth" value="<?=$_SESSION['data']['auth']??null?>">
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" value="<?=$_SESSION['data']['password']??null?>">
        </div>
        <div>
            <label for="passwordRepeat">Repeat password</label>
            <input id="passwordRepeat" type="password" name="passwordRepeat">
        </div>
        <button type="submit"> Save </button>
    </form>
</div>
