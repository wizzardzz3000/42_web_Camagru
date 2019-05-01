<?php ob_start(); ?>

    <div class="forms_account_view">
        <?
            if ($username_message)
            {
                echo '<p>'.$username_message.'</p>';
                echo '<br>';
            }
            if ($email_message)
            {
                echo '<p>'.$email_message.'</p>';
                echo '<br>';
            }
            if ($password_message)
            {
                echo '<p>'.$password_message.'</p>';
                echo '<br>';
            }
            if ($relog_message)
            {
                echo '<p>'.$relog_message.'</p>';
                echo '<br>';
            }
        ?>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>