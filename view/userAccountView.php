<?php ob_start(); ?>
    <div class="forms_account_view">
        <div class="account_information">
            <h2>About you</h2>
                <p><strong>Name <br></strong><?= $user_name ?></p>
                <p><strong>Email <br></strong><?= $user_email ?></p>
                <p><strong>Pictures <br></strong></p>
                <p><strong>Comments <br></strong></p>
                <p><strong>Likes <br></strong></p>
        </div>
        <div class="modify_form">
            <h2>Modify your informations</h2>
            <form action="index.php?action= ?>" method="post">
                <div>
                    <label for="name">New name</label><br />
                    <input class="input" type="text" id="name" name="name" />
                </div>
                <br>
                <div>
                    <label for="email">New email</label><br />
                    <input class="input" type="text" id="email" name="email" />
                </div>
                <br>
                <div>
                    <label for="password">New password</label><br />
                    <input class="input" type="password" name="passwd" value="" />
                </div>
                <br>
                <div>
                    <label for="password">Enter your current password to confirm</label><br />
                    <input class="input" type="password" name="passwd" value="" />
                    <a href="" >(Forgot your password ?)</a>
                </div>
                <br>
                <div>
                    <input type="submit" value="Modify" />
                </div>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>