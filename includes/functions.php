<?php

require_once 'classes/Post.php';
require_once 'classes/User.php';
require_once 'classes/Categorie.php';
require_once 'tables/PostTable.php';
require_once 'tables/UsersTable.php';
require_once 'tables/CategoriesTable.php';

function retrieve_user($id)
{
    global $db;
    $get = $db->prepare('SELECT * FROM users WHERE id = ?');
    $get->execute(array($id));
    return $get->fetch();
}

function get_user_by_mail_and_password($mail, $password)
{
    global $db;
    $password = sha1($password);
    $get = $db->prepare('SELECT * FROM users WHERE mail = ? AND password = ?');
    $get->execute(array($mail, $password));
    return $get;
}