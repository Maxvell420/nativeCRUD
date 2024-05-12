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
    <form action="/userUpdate" method="POST">
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="<?=$user['name']?>">
        </div>
        <div>
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" value="<?=$user['phone']?>">
        </div>
        <div>
            <label for="mail">Mail</label>
            <input type="text" id="mail" name="email" value="<?=$user['email']?>">
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password">
        </div>
        <button type="submit"> Update </button>
    </form>
</div>
