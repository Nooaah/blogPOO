<?php
session_start();
require_once '../includes/config.php';

$pt = new PostTable();

if (empty($_GET['cat']))
{
    $posts = $pt->all();
}
else
{
    $posts = $pt->getCat(intval($_GET['cat']));
}

$cat = new CategoriesTable();
$categories = $cat->all();


if (isset($_GET['del']))
{
    $getid = intval($_GET['del']);
    $post = new Post();
    $post->setId($getid);
    $pt->delete($post);
    header('location:index.php');
}


if (isset($_POST['pseudoRegister']) && isset($_POST['emailRegister']) && isset($_POST['passwordRegister']))
{
    $pseudo = htmlspecialchars($_POST['pseudoRegister']);
    $email = htmlspecialchars($_POST['emailRegister']);
    $mdp = sha1(htmlspecialchars($_POST['passwordRegister']));
    
    $us = new UsersTable();
    $userinfo = new User();
    $userinfo->setPseudo($pseudo);
    $userinfo->setMail($email);
    $userinfo->setPassword($mdp);
    $userinfo->setImage('https://forums.mfgg.net/uploads/avatars/avatar_239.png?dateline=1516570676');
    $us->create($userinfo);
    
}


if (isset($_POST['login'])) {
    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);

        $user = new User();
        $user->setMail($mail);
        $user->setPassword(sha1($password));

        $userRequest = new UsersTable();
        $requser = $userRequest->get_user_by_mail_and_password($user);

        $nbUsers = $requser->rowcount();

        if ($nbUsers == 1) {
            $requser = $requser->fetch();
            $_SESSION['id'] = $requser['id'];
            $_SESSION['pseudo'] = $requser['pseudo'];
            $_SESSION['mail'] = $requser['mail'];
            $_SESSION['password'] = $requser['password'];
        }
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BloggyHarinck - l'actualité complétement givrante !</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCRvu70-oIYJSrEyR7HO64_TmcTr26UhsHB34a2GWZGERfKT2L">
    <style>
        *
        {
            scroll-behavior: smooth;
        }
        .modal-dialog.modal-notify .modal-body {
            padding: 0.5rem;
            color: #616161;
        }
        #linkProfil
        {
            color:white;
        }
        #linkProfil:hover
        {
            color:lightgrey;
        }
    </style>
</head>
<body>



<!-- MODALE CONNEXION -->


<form action="" method="POST">
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Connexion</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
      <i>Compte de Noah : noah.chtl@gmail.com & 123</i>
        <br>
        <i>Compte de Test : sebastien.harinck@domaine.com & 123</i>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input id="mail" name="mail" type="email" id="defaultForm-email" class="form-control validate">
          <label for="mail" data-error="wrong" data-success="right" for="defaultForm-email">Email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input id="password" name="password" type="password" id="defaultForm-pass" class="form-control validate">
          <label for="password" data-error="wrong" data-success="right" for="defaultForm-pass">Mot de passe</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button id="login" name="login" class="btn elegant-color white-text">Se connecter</button>
      </div>
    </div>
  </div>
</div>

</form>





<form method="POST" action="">


<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Inscription</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body mx-3">
        <div class="md-form mb-5">
        <i class="fas fa-user prefix grey-text"></i>
        <input  type="text" id="pseudoRegister" name="pseudoRegister" class="form-control validate">
        <label data-error="wrong" data-success="right" for="pseudoRegister">Pseudo</label>
        </div>
        <div class="md-form mb-5">
        <i class="fas fa-envelope prefix grey-text"></i>
        <input type="email" id="emailRegister" name="emailRegister" class="form-control validate">
        <label data-error="wrong" data-success="right" for="emailRegister">Email</label>
        </div>

        <div class="md-form mb-4">
        <i class="fas fa-lock prefix grey-text"></i>
        <input type="password" id="passwordRegister" name="passwordRegister" class="form-control validate">
        <label data-error="wrong" data-success="right" for="passwordRegister">Mot de passe</label>
        </div>

    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button id="submitRegister" name="submitRegister" class="btn btn-primary white-text">S'inscrire</button>
    </div>
    </div>
</div>
</div>

</form>




<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark elegant-color">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCRvu70-oIYJSrEyR7HO64_TmcTr26UhsHB34a2GWZGERfKT2L" class="mr-2" width="30px;" alt=""> BloggyHarinck</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="http://github.com/Nooaah"><i class="fab fa-github mr-2"></i>Nooaah</a>
      </li>

      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Catégories</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="index.php">Toutes les catégories</a>
        <?php foreach($categories as $categorie): ?>
           <a class="dropdown-item" href="index.php?cat=<?= $categorie['id'] ?>"><?= $categorie['name'] ?></a>
        <?php endforeach; ?>
        </div>
      </li>

      <?php
        if (empty($_SESSION['id']))
        {
            ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#modalLoginForm"><i class="far fa-laugh-wink"></i> Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#modalRegisterForm"><i class="fas fa-user-astronaut"></i> Inscription</a>
                </li>
            <?php
        }
        else
        {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="ajouter.php"><i class="fas fa-plus-circle mr-2"></i>Ajouter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion<i class="fas fa-sign-out-alt ml-2"></i></a>
            </li>
            <?php
        }
      ?>
    </ul>
    <!-- Links -->

    <form class="form-inline" action="" method="POST">
        <div class="md-form my-0">
        <?php
        if (isset($_SESSION['id']))
        {
            ?>
                <span class="white-text">Connecté en tant que <b><a id="linkProfil" href="profil.php?id=<?= $_SESSION['id'] ?>"><?=ucfirst($_SESSION['pseudo'])?></a></b></span>
            <?php
        }
        ?>
        </div>
    </form>

  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->






    <div class="container mt-5">
        <section id="articles">
            <div class="row">
                <div class="col-md-12 text-center mb-3">
                    <i><h5 style="background-color:#555555;color:white;width:220px;margin:auto;"><b>Dernières actualités</b></h5></i>
                </div>
            </div>
            <hr style="margin-top:-30px;">
<?php


?>
            <? foreach($posts as $post):
                $thisPost = $pt->get($post['id']);
            ?>

            <div class="row mt-5">
                <div class="col-md-4 mt-3 mb-4">
                <!--Zoom effect-->
                <a href="article.php?id=<?= $thisPost->getID() ?>">
                <div class="view overlay zoom">
                <img src="<?= $post['image'] ?>" class="img-fluid " alt="zoom">
                <div class="mask flex-center waves-effect waves-light">
                    <p class="white-text"></p>
                </div>
                </div>
                </a>

            </div>

            <div class="col-md-8">
                    <p style="font-size:19px;" class="mt-2">
                        <div class="date" style="font-size:13px;"><b><b><?= $cat->get_categorie_by_id($thisPost->getCategorie()) ?> / </b></b>Le <?= date('d/m/Y à H:i', $thisPost->getDate()); ?></div>
                        <h2 class="mb-3"><a style="color:black;" href="article.php?id=<?= $thisPost->getID() ?>"><b><b><?= $thisPost->getTitle() ?></b></b></a></h2>
                        <?php
                        $text = $thisPost->getContent();
                        $text = substr($text, 0, 300);
                        $text = $text . ' ... <br><a href="article.php?id=' . $thisPost->getID() . '">Lire la suite</a>';
                        echo $text;
                       ?>

                    </p>
                </div>
            </div>

            <? endforeach; ?>
        </section>
    </div>





<!-- Footer -->
<footer class="page-footer font-small elegant-color mt-5 pt-2">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© <?= date('Y') ?> Copyright
    <a href="http://noah-chatelain.fr"> Noah Châtelain</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->





    <!-- /FIN DU PROJET-->

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/js/mdb.js"></script>


</body>
</html>