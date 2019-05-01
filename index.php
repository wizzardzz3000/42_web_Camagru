<?php
require('controller/controller.php');
require('controller/userController.php');

try {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == 'account')
        {
            account();
        }
        else if ($_GET['view'] == 'camera')
        {
            showMainView();
        }
        else if ($_GET['view'] == 'gallery')
        {
            showGallery();
        }
    }
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'user')
        {
            user();
        }
        else if ($_GET['action'] == 'login')
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
            if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['hash']))
            {
                verify($_GET['name'], $_GET['email'], $_GET['hash']);
            }
        }
        else if ($_GET['action'] == 'modify')
        {
            if ($_POST['old_passwd'] )
            {
                modify($_POST['old_passwd'], $_POST['new_name'], $_POST['new_email'], $_POST['new_passwd']);
            }
            // && ($_POST['name'] || $_POST['email'] || $_POST['password'])
        }
        else if ($_GET['action'] == 'resend')
        {
            if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['hash']))
            {
                resend($_GET['name'], $_GET['email'], $_GET['hash']);
            }
        }
        else if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        else if ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
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
                comment();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    if (!isset($_GET['view']) && !isset($_GET['action'])) {
        showGallery();
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
