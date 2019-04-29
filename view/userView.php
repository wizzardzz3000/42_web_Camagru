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
            <form action="index.php?action=register" method="POST">
                <div>
                    <label for="name">Name</label><br />
                    <input id="r_name" type="text" name="name" />
                </div>
                <p id="name_message" class="name_message"></p>
                <br>
                <div>
                    <label for="email">Email</label><br />
                    <input id="r_email" type="text" name="email" value="" onkeyup="checkEmail()"/>
                </div>
                <p id="email_message" class="email_message"></p>
                <br>
                <div>
                    <label for="password">Password</label><br />
                    <input id="r_password" type="password" name="passwd" value="" onkeyup="checkPassword()"/>
                </div>
                <p id="password_len_message" class="password_len_message"></p>
                <p id="password_up_message" class="password_up_message"></p>
                <p id="password_num_message" class="password_num_message"></p>
                <p id="password_spe_message" class="password_spe_message"></p>
                <br>
                <div>
                    <input type="submit" value="Register"/>
                </div>
            </form>
            <?
                if ($res == 1)
                {
                    echo '<p>Success!</p>';
                    echo '<p>Please check your email to validate your account</p>';
                }
                if ($res == 2)
                {
                    echo '<p>Sorry!</p>';
                    echo '<p>This user already exists, please login or register with a different name</p>';
                }
            ?>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="javascript/check_password.js"></script>
<script src="javascript/check_email.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>