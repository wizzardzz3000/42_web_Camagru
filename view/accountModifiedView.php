<?php ob_start(); ?>

    <div class="forms_account_view">

        <div class="account_modified_view">

            <?
                if ($username_message)
                {
                    echo '<p>'.$username_message.'</p>';
                }
                if ($email_message)
                {
                    echo '<p>'.$email_message.'</p>';
                }
                if ($password_message)
                {
                    echo '<p>'.$password_message.'</p>';
                }
                if ($relog_message)
                {
                    echo '<p>'.$relog_message.'</p>';
                }
            ?>

        </div>

    </div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>