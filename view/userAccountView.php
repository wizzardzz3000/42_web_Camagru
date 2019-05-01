<?php ob_start(); ?>
    <div class="forms_account_view">
        <div class="account_information">
            <h2>About you</h2>
            <?
                $user_data = getAccountData();
            ?>
                <p><strong>Name <br></strong><?= $user_data['name'] ?></p>
                <p><strong>Email <br></strong><?= $user_data['email'] ?></p>
                <p><strong>Pictures <br></strong></p>
                <p><strong>Comments <br></strong></p>
                <p><strong>Likes <br></strong></p>
        </div>
        <div class="modify_form">
            <h2>Modify your informations</h2>
            <form action="index.php?action=modify" method="post">
                <div>
                    <label for="name">New name</label><br />
                    <input class="input" type="text" id="r_name" name="new_name" onkeyup="checkName()"/>
                </div>
                <p id="name_message" class="name_message"></p>
                <br>
                <div>
                    <label for="email">New email</label><br />
                    <input class="input" type="text" id="r_email" name="new_email" onkeyup="checkEmail()"/>
                </div>
                <p id="email_message" class="email_message"></p>
                <br>
                <div>
                    <label for="password">New password</label><br />
                    <input class="input" type="password" id="r_password" name="new_passwd" value="" onkeyup="checkPassword()"/>
                </div>
                <p id="password_len_message" class="password_len_message"></p>
                <p id="password_up_message" class="password_up_message"></p>
                <p id="password_num_message" class="password_num_message"></p>
                <p id="password_spe_message" class="password_spe_message"></p>
                <br>
                <div>
                    <label for="password">Enter your current password to confirm</label><br />
                    <input class="input" type="password" name="old_passwd" value="" />
                    <a href="index.php?view=forgotPassword" >(Forgot your password ?)</a>
                </div>
                <br>
                <div>
                    <input type="submit" value="Modify" />
                </div>
                <?
                    if ($msg)
                        echo '<p>'.$msg.'</p>';
                ?>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="javascript/check_password.js"></script>
<script src="javascript/check_email.js"></script>
<script src="javascript/check_name.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>