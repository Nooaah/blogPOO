<?
session_start();
require_once '../includes/config.php';

if (isset($_GET['id']))
{
    $getid = intval($_GET['id']);

    $pt = new PostTable();
    $post = $pt->get($getid);

    $pt->add_view($post);
    
    $us = new UsersTable();
    $user = $us->get($post->getIdUser());

    $commentaire = new CommentairesTable();
    $com = $commentaire->all($post);
}
else
{
    header('location:index.php');
}

$cat = new CategoriesTable();
$categories = $cat->all();

if (isset($_POST['commentaire']))
{
    $newcomment = htmlspecialchars($_POST['commentaire']);

    //add_comment($getid, $_SESSION['id'], $commentaire);

    $com = new Commentaire();
    $com->setUserId($_SESSION['id']);
    $com->setIdPost($getid);
    $com->setContent($newcomment);
    $commentaire->create($com);

    header('location:article.php?id='.$getid.'#commentaires');
}

if (isset($_POST['login'])) {
    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);

        $requser = $pt->get_user_by_mail_and_password($mail, $password);

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
    <title><?= $post->getTitle() ?></title>
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
        <!--
            <input class="form-control mr-sm-2" type="text" id="rechercher" name="rechercher" placeholder="Rechercher" aria-label="Rechercher">
        -->
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
        <span style="background-color:#F9D848;border-radius:5px;padding:5px 10px;color:white;font-weight:bold;text-align:center;">
        <a class="white-text" href="index.php?cat=<?= $post->getCategorie() ?>"><?= $categorie['name'] ?></a>
        </span>
        <h1 class="mt-4"><b><b><?= $post->getTitle() ?></b></b></h1>
        <div class="row">
            <div class="col-md-0 mt-2">
                <a href="profil.php?id=<?= $user->getId() ?>">
                    <img src="<?= $user->getImage() ?>" width="50px" style="border-radius:100%;" alt="">
                </a>
            </div>
            <div class="col-md-11" style="color:#BDBDBD;font-size:14px;">
                <b><b><?= 'Ajouté le ' . date('d/m/Y à H:m', $post->getDate()); ?></b></b>
                <br>
                Par <span style="color:black;"><a style="color:black;" href="profil.php?id=<?= $post->getIdUser() ?>"><b><b><?= $user->getPseudo() ?></b></b></a></span>
                <br>
                <b>Cet article à été vu <b><?= $post->getViews() + 1 ?> fois</b>
            </div>
        </div>
        <hr>
        <div class="row">

            <div class="col-md-8">
                <img class="mb-4" src="<?= $post->getImage() ?>" width="100%">
                
                <div class="row">
                    <div class="col-md-1">
                        <!-- <a target="_blank" href="https://www.facebook.com/sharer.php?u=article.php?id=<?= $post->getId() ?>"><img class="mt-4" style="border-radius:100%;" src="https://image.flaticon.com/icons/png/512/124/124010.png" width="35px" alt=""></a> -->
                        <a target="_blank" href="https://www.facebook.com/sharer.php?u=http://noah-chatelain.fr/bloggy/article.php?id=28"><img class="mt-4" style="border-radius:100%;" src="https://image.flaticon.com/icons/png/512/124/124010.png" width="35px" alt=""></a>
                        <a target="_blank" href="https://twitter.com/intent/tweet?text=<?= $post->getTitle() ?>&url=http://noah-chatelain.fr/bloggy/article.php?id=28"><img class="mt-3" style="border-radius:35px;" src="https://dragonsniortais.fr/wp-content/uploads/2019/04/logo-twitter-circle-png-transparent-image-1.png" width="35px" alt=""></a>
                        <a target="_blank" href="http://Pinterest.com"><img class="mt-3" style="border-radius:35px;" src="https://www.stickpng.com/assets/images/580b57fcd9996e24bc43c52e.png" width="35px" alt=""></a>
                        <a target="_blank" href="mailto:noah.chtl@gmail.com"><img class="mt-3" style="border-radius:10%;margin-left:2px;" src="http://lcdgg.thomascyrix.com/wp-content/uploads/2019/04/Gmail_Icon.png" width="35px" alt=""></a>
        
                    </div>
                    <div class="col-md-11 mt-3">
                        <p style="font-size:19px;">
                            <?= $post->getContent() ?>
                        </p>

                    </div>
                </div>
            
                <?php
                if (!empty($_SESSION['id']) && $_SESSION['id'] == $post->getIdUser())
                {
                    ?>
                        <a title="Modifier" style="padding:10px 15px;" href="modifier.php?id=<?= $post->getId() ?>" class="btn btn-success text-white mt-5"><i class="far fa-edit mr-2"></i>Modifier</a> 
                        <a style="padding:10px 15px;" href="index.php?del=<?= $post->getId() ?>" class="btn btn-danger mt-5"><i class="fas fa-trash-alt mr-2"></i>Supprimer</a>
                    <?php
                }
                ?>
            </div>

                <div class="col-md-4" style="margin-top:-80px;">
                        <div class="row">
                            <div class="col-md-12 text-center mb-5" >
                                <i><h5 style="font-size:20px;background-color:#555555;color:white;width:150px;margin:auto;margin-top:95px;"><b>Les plus vus</b></h5></i>
                            <hr style="margin-top:-14px;">
                            </div>
                        <?php
                            foreach($pt->get_most_famous_posts() as $famousPost):
                                ?>
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <a href="article.php?id=<?= $famousPost['id'] ?>"><img src="<?= $famousPost['image'] ?>" width="100%" alt=""></a>
                                        </div>
                                        <div class="col-md-7 mb-3 pl-0">
                                            <a style="color:black;" class="articleMostView" href="article.php?id=<?= $famousPost['id'] ?>"><b><b><?= $famousPost['title'] ?></b></b></a>
                                            <br>
                                            <?= $famousPost['views'] ?> vues
                                        </div>
                                    </div>
                                <?php
                            endforeach;
                            ?>
                            <div class="col-md-12 text-center mb-5">
                                <i><h5 style="font-size:20px;background-color:#555555;color:white;width:170px;margin:auto;margin-top:50px;"><b>Les nouveautés</b></h5></i>
                                <hr style="margin-top:-14px;">
                            
                            </div>
                        <?php
                            foreach($pt->get_new_posts() as $famousPost):
                                ?>
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <a href="article.php?id=<?= $famousPost['id'] ?>"><img src="<?= $famousPost['image'] ?>" width="100%" alt=""></a>
                                        </div>
                                        <div class="col-md-7 mb-3 pl-0">
                                            <a style="color:black;" class="articleMostView" href="article.php?id=<?= $famousPost['id'] ?>"><b><b><?= $famousPost['title'] ?></b></b></a>
                                            <br>
                                            <?= $famousPost['views'] ?> vues
                                        </div>
                                    </div>
                                <?php
                            endforeach;
                        ?>
                            

                        </div>
                </div>
            </div>






            <h2 class="mt-4" id="commentaires">Commentaires</h2>
            <hr>

            <?php
            $coms = $commentaire->get_com_by_id($getid);
            $nbCom = $coms->rowcount();
            if ($nbCom == 0)
            {
                echo '<br>Il n\'y a aucun commentaire ! Soyez le premier à poster un commentaire sur cet article';
            }
            else
            {
                ?>
                    <?php
                    foreach($coms as $com):
                        $cuser = $us->retrieve_user($com['id_user']);
                        ?>
                        <div class="row pt-3">
                            <div class="col-md-1 mb-5">
                                <a href="profil.php?id=<?= $cuser['id'] ?>">
                                    <img src="<?= $cuser['image'] ?>" width="75px" alt="">
                                </a>
                            </div>
                            <div class="col-md-11" style="margin-top:-5px;">
                                <b><b><a style="color:black;" href="profil.php?id=<?= $cuser['id'] ?>"><?= ucfirst($cuser['pseudo']) ?></a></b></b> à commenté le <?= date('d/m/Y à H:i', $com['date']) ?>
                                <p class="mt-1">
                                    <?= $com['content'] ?>
                                </p>
                            </div>
                        </div>
               

                    <?php
                    endforeach;
            }
            ?>





            <h3 class="mt-5">Ajouter un commentaire</h3>
            <hr>
            
            <?php
            if (isset($_SESSION['id']))
            {
                ?>
                    <form action="" method="POST">
                        
                        <!--Material textarea-->
                        <div class="md-form">
                            <textarea style="font-size:18px;" id="commentaire" name="commentaire" class="md-textarea form-control" rows="5"></textarea>
                            <label style="font-size:18px;" for="commentaire">Ajouter un commentaire sous le pseudo de <?= $_SESSION['pseudo'] ?></label>
                        </div>
        
                        <input type="submit" id="submitCommentaire" name="submitCommentaire" class="btn btn-success" value="Envoyer le commentaire">
        
                    </form>
                <?php
            }
            else
            {
                ?>
                

                Vous devez
                <a class="text-primary" data-toggle="modal" data-target="#modalLoginForm"><b>vous connecter</b></a>
                pour écrire un commentaire à propos de l'article : 
                <br>
                <i><?= $a['titre'] ?></i>
                <?php
            }
            ?>
            

        </div>
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
    <!-- VueJS
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>-->
    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <!-- SCRIPTS
    <script src="js/app.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/script.js"></script>
-->
<script>
$("#sideModalTLInfo").on('shown.bs.modal', function(){
   alert("Hello World!");
});
</script>

</body>
</html>
