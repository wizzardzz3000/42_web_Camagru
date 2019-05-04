<?php
require('controller/picturesController.php');
require('controller/mailController.php');
require('controller/userController.php');

try {
    // VIEWS
    // ---------------------------------------------------------------
    if (isset($_GET['view']))
    {
        if ($_GET['view'] == 'account')
        {
            require('view/userAccountView.php');
        }
        else if ($_GET['view'] == 'user')
        {
            require('view/userView.php');
        }
        else if ($_GET['view'] == 'camera')
        {
            require('view/mainView.php');
        }
        else if ($_GET['view'] == 'picture' && isset($_GET['id']))
        {
            showMedia("picture", $_GET['id']);
        }
        else if ($_GET['view'] == 'gallery')
        {
            showMedia("gallery", "");
        }
        else if ($_GET['view'] == 'forgotPassword')
        {
            require('view/forgotPasswordView.php');
        }
    }
    // ACTIONS
    // ---------------------------------------------------------------
    if (isset($_GET['action']))
    {
        // USER ACTIONS
        if ($_GET['action'] == 'login')
        {
            login($_POST['login'], $_POST['passwd']);
        }
        else if ($_GET['action'] == 'logout')
        {
            logout($_POST['login'], $_POST['passwd']);
        }
        else if ($_GET['action'] == 'register')
        {
            register($_POST['name'], $_POST['email'], $_POST['passwd'], $_POST['c_passwd']);
        }
        else if ($_GET['action'] == 'verify')
        {
            if(isset($_GET['email']) && isset($_GET['hash']))
            {
                verify($_GET['email'], $_GET['hash']);
            }
        }
        else if ($_GET['action'] == 'modify')
        {
            if ($_POST['old_passwd'] )
            {
                modify($_POST['old_passwd'], $_POST['new_name'], $_POST['new_email'], $_POST['new_passwd'], $_POST['c_passwd']);
            } else {
                echo("Please enter your current password to make changes");
            }
        }
        // COMMENTS ACTIONS
        else if ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        else if ($_GET['action'] == 'modifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    modifyComment($_GET['id'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        else if ($_GET['action'] == 'comment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                getComment($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        // RESET PASSWORD ACTIONS
        else if ($_GET['action'] == 'sendPasswordResetEmail')
        {
            if (!empty($_POST['email']))
            {
                sendPasswordResetEmail($_POST['email']);
            }
        }
        else if ($_GET['action'] == 'verifyAccountForReset')
        {
            if (isset($_GET['email']) && isset($_GET['hash']))
            {
                verifyAccountForReset($_GET['email'], $_GET['hash']);
            }
            else {
                throw new Exception('Paramètres de reset incorrects');
            }
        }
        else if ($_GET['action'] == 'resetPassword')
        {
            if (isset($_GET['email']) && isset($_GET['hash']) && !empty($_POST['r_password']) && !empty($_POST['c_password']))
            {
                resetPassword($_GET['email'], $_GET['hash'], $_POST['r_password'], $_POST['c_password']);
            }
        }
    }
    // LOAD THE GALLERY BY DEFAULT
    if (!isset($_GET['view']) && !isset($_GET['action'])) {
        showMedia("gallery", "");
    }
}
// CATCH EXCEPTION
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}

        // else if ($_GET['action'] == 'resend')
        // {
        //     if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['hash']))
        //     {
        //         resend($_GET['name'], $_GET['email'], $_GET['hash']);
        //     }
        // }