<?php ob_start(); ?>
    <div class="forms">
        <div class="login_form">
            <h2>Login</h2>
            <form action="index.php?action=login" method="POST">
                <div>
                    <label for="login">Name</label><br />
                    <input class="input" type="text" id="login" name="login" required/>
                </div>
                <br>
                <div>
                    <label for="password">Password</label><br />
                    <input class="input" type="password" name="passwd" value="" required/>
                    <a href="index.php?view=forgotPassword" >(Forgot your password ?)</a>
                </div>
                <br>
                <br />
                <div>
                    <input type="submit" value="Login"/>
                </div>
                <?
                    if ($wrong_username)
                    {
                        echo    '<p>'.$wrong_username.'</p>';
                    }
                    if ($wrong_password)
                    {
                        echo    '<p>'.$wrong_password.'</p>';
                    }
                ?>
            </form>
        </div>
        <?
            if ($verify == 1 || $verify == 2)
            {
                echo    '<p>'.$verifyMessage.'</p>';
            } else {
                echo    '<div class="register_form">
                        <h2>Register</h2>
                        <form action="index.php?action=register" method="POST">
                            <div>
                                <label for="name">Name</label><br />
                                <input class="input" id="r_name" type="text" name="name" value="" onkeyup="checkName()" required/>
                            </div>
                            <p id="name_message" class="name_message"></p>
                            <br>
                            <div>
                                <label for="email">Email</label><br />
                                <input class="input" id="r_email" type="text" name="email" value="" onkeyup="checkEmail()" required/>
                            </div>
                            <p id="email_message" class="email_message"></p>
                            <br>
                            <div>
                                <label for="password">Password</label><br />
                                <input class="input" id="r_password" type="password" name="passwd" value="" onkeyup="checkPassword()" required/>
                            </div>
                            <p id="password_len_message" class="password_len_message"></p>
                            <p id="password_up_message" class="password_up_message"></p>
                            <p id="password_num_message" class="password_num_message"></p>
                            <p id="password_spe_message" class="password_spe_message"></p>
                            <br>
                            <div>
                                <label for="password">Confirm password</label><br />
                                <input class="input" id="c_password" type="password" name="c_passwd" value="" required/>
                            </div>
                            <p id="password_confirm_message" class="password_confirm_message"></p>
                            <br>
                            <div>
                                <input type="submit" value="Register"/>
                            </div>
                        </form>';
            }
        ?>
            <?
            if ($res)
            {
                if ($res == 3)
                {
                    echo    '<p>Success!</p>';
                    echo    '<p>Please check your email to validate your account.</p>';
                    // echo    '<form action="index.php?action=resend&name='.$name.'&email='.$email.'&hash='.$hash.'" method="POST">
                    //             <div>
                    //                 <input type="submit" value="Resend email"/>
                    //             </div>
                    //         </form>';
                }
                if ($res == 2)
                {
                    echo '<p>Sorry!</p>';
                    echo '<p>This email address is already linked to an account, please login or register with a different email</p>';
                }
                if ($res == 1)
                {
                    echo '<p>Sorry!</p>';
                    echo '<p>This user already exists, please login or register with a different name</p>';
                }
                if ($res == 0)
                {
                    echo '<p>Sorry!</p>';
                    echo '<p>Passwords don\'t match</p>';
                }
            }
            ?>
        </div>
    </div>

    <script src="javascript/check_password.js"></script>
    <script src="javascript/check_email.js"></script>
    <script src="javascript/check_name.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>