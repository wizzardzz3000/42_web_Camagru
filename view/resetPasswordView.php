<?php ob_start(); ?>

    <div class="forms_account_view">
        <form action="index.php?action=resetPassword&email=<?= $email ?>&hash=<?= $hash ?>" method="POST">
            <div>
                <br>
                <label for="password">Please choose a new password for your account :</label><br />
                <input class="input" id="r_password" type="password" name="r_password" value="" onkeyup="checkPassword()" required/>
            </div>
            <p id="password_len_message" class="password_len_message"></p>
            <p id="password_up_message" class="password_up_message"></p>
            <p id="password_num_message" class="password_num_message"></p>
            <p id="password_spe_message" class="password_spe_message"></p>
            <br>
            <div>
                <label for="password">Confirm password</label><br />
                <input class="input" id="c_password" type="password" name="c_password" value="" required/>
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="javascript/check_password.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>