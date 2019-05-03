<?php ob_start(); ?>

    <div class="forms_account_view">
            <form action="index.php?action=sendPasswordResetEmail" method="post">
                <div>
                    <label for="email">Enter your email address to reset your password</label><br />
                    <br>
                    <input class="input" name="email" value="" required/>
                </div>
                <br>
                <div>
                    <input type="submit" value="OK" />
                </div>
                <?
                    if ($msg)
                        echo '<p>'.$msg.'</p>';
                ?>
            </form>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>