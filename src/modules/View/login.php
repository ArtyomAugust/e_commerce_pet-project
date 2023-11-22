<?php include($base_path . 'src\\modules\\view\\__header.inc.php'); ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissable fade in" onclick="this.style.display='none';">
        <button type=" button" data-dismiss="alert" aria-label="close" class="close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Error!</strong>
        <?= $error['user_name'] . ' or ' . $error['password'] ?>
    </div>
    </div>

    </div>
<?php endif ?>

<div class="login-wrap">
    <h2>Login</h2>
    <form class="form" method="post">
        <input type="text" placeholder="Username" name="username" required />
        <span></span>
        <input type="password" placeholder="Password" name="password" required />
        <button type="submit"> Sign in </button>
        <a href="register">
            <p> Don't have an account? Register! </p>
        </a>
    </form>
</div>
<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>