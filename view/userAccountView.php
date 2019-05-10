<?php ob_start(); ?>
    <div class="forms_account_view">
        <div class="account_information">
            <h2>About you</h2>
            <?
                $user_data = getAccountData();
            ?>
                <p><strong>Name <br></strong><?= $user_data['name'] ?></p>
                <p><strong>Email <br></strong><?= $user_data['email'] ?></p>
                <!-- pass php variable to javascript : -->
                <div id="dom-target" style="display: none;">
                    <?php 
                        echo htmlspecialchars($user_data['notifications']);
                    ?>
                </div>
                <!-- ... -->
                <p id="notifications_tag"><strong>Notifications <br></strong></p>
                <div>
                    <?php
                        if ($user_data['notifications'] == 0)
                        {
                            $notification_value = "Turn notifications on";
                        } 
                        else if ($user_data['notifications'] == 1)
                        {
                            $notification_value = "Turn notifications off";
                        }
                    ?>
                    <?php
                        $user_id = $user_data['user_id'];
                        echo '<input type="submit" value="'.$notification_value.'" onclick="refreshPage(\'' . $user_data['user_id'] . '\', \'' . $notification_value . '\')"/>'; 
                    ?>
    
                </div>
                <p><strong>Pictures <br></strong></p><?= $user_data['pictures_taken'] ?></p>
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
                    <label for="password">Confirm new password</label><br />
                    <input class="input" id="c_password" type="password" name="c_passwd" value="" />
                </div>
                <p id="password_confirm_message" class="password_confirm_message"></p>
                <br>
                <div>
                    <label for="password">Enter your current password to confirm</label><br />
                    <input class="input" type="password" name="old_passwd" value="" required/>
                    <a href="index.php?view=forgotPassword" >(Forgot your password ?)</a>
                </div>
                <br>
                <div>
                    <input type="submit" value="Modify" />
                </div>
                <?
                    if ($username_error_message)
                    {
                        echo '<p>'.$username_error_message.'</p>';
                        echo '<br>';
                    }
                    if ($email_error_message)
                    {
                        echo '<p>'.$email_error_message.'</p>';
                        echo '<br>';
                    }
                    if ($password_error_message)
                    {
                        echo '<p>'.$password_error_message.'</p>';
                        echo '<br>';
                    }
                    if ($msg)
                        echo '<p>'.$msg.'</p>';
                ?>
            </form>
        </div>
    </div>

<script src="javascript/notifications.js"></script>
<script src="javascript/check_password.js"></script>
<script src="javascript/check_email.js"></script>
<script src="javascript/check_name.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>