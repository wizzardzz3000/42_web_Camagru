<?php ob_start(); ?>
    <div class="forms">
        <div class="login_form">
            <h2>Login</h2>
            <form action="index.php?action=login" method="POST">
                <div>
                    <label for="login">Name (or Email...)</label><br />
                    <input type="text" id="login" name="login" />
                </div>
                <br>
                <div>
                    <label for="password">Password</label><br />
                    <input type="password" name="passwd" value="" />
                </div>
                <br>
                <div>
                    <input type="submit" value="Login"/>
                </div>
            </form>
        </div>
        <div class="register_form">
            <h2>Register</h2>
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <div>
                    <label for="name">Name</label><br />
                    <input type="text" id="name" name="name" />
                </div>
                <br>
                <div>
                    <label for="email">Email</label><br />
                    <input type="text" id="email" name="email" />
                </div>
                <br>
                <div>
                    <label for="password">Password</label><br />
                    <input type="password" name="passwd" value="" />
                </div>
                <br>
                <div>
                    <input type="submit" value="Register" />
                </div>
            </form>
        </div>
    </div>
        

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>