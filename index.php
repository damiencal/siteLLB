<?php
    include "/var/www/lcs/includes/headerauth.inc.php";
    include "/var/www/Annu/includes/ldap.inc.php";
    include "paternité/var/www/Annu/includes/ihm.inc.php";
    session_start();
    //session_name('LLB');
    
    $login = $_POST['login'];
    $motdepasse = $_POST['motdepasse'];

    if (user_valid_passwd($login, $motdepasse) == TRUE){
        $_SESSION['login'] = $login;
    }
    
    if(isset($_POST['deconnexion'])){ session_destroy(); header("Location:index.php");}
?>
<!DOCTYPE html>
<html>  
    <head><title>LLB</title>     
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">       
        <meta name="description" content="Site officiel Lycee Laetitia Bonapate" />
        <meta name="keywords" content="Laetitia Bonaparte, site, ajaccio, education, ac-corse" />
        <meta name="author" content="btssio">
        <meta name="robots" content="index, follow">
        <meta name="revisit-after" content="3 month">
        
        <link href="//css.cdn.tl/normalize.css" rel="stylesheet"><!--NORMALIZATION-->
        <link href="//code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet">
        <link href="//cdn.jsdelivr.net/foundation/4.0.4/css/foundation.min.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script><!--OPTIONAL-->
        <script src="//code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/dojo/1.8.3/dojo/dojo.js"></script><!--Graphic--> 
        <script type="text/javascript">window.onload = function (event) {
                if (window.innerWidth > 800) {window.setTimeout(openPanel, 1);}
                if (window.innerWidth < 800) {window.setTimeout(closePanel, 1);}};
            function closePanel() {
                $("#panel").panel("close");
            }
            function openPanel() {
                $("#panel").panel("open");
            }
        </script>
        <style>
            #menu .ui-icon{background:url(img/menu.png) 50% 50% no-repeat;background-size: 24px 16px;}
            #email .ui-icon{background:url(img/email.png) 50% 50% no-repeat;background-size: 24px 16px;}
            .nav-glyphish-example .ui-btn .ui-icon {width:30px;height:30px;margin-left:-15px;}
        </style>
    </head>
    <body>
        <div data-role="page" class="ui-responsive-panel "  data-dom-cache="true">
            <div data-role="header" data-theme="a" data-position="fixed" >         
               <div data-role="navbar" class="nav-glyphish-example" data-grid="d">
                    <ul>
                        <li><a href="#panel" id="menu" data-icon="custom">Menu</a></li>
                        <li></li>
                        <li><center><?php if (isset($_SESSION['login'])){list($user)= people_get_variables($login,true); echo "Bonjour ".$user['nom']; } else{?> LLB <?}?></center></li>
                        <li></li>
                        <li><a href="#" id="email" data-icon="custom" onclick="window.location = 'mailto:email@domain.com';return false;">Email</a></li>
                    </ul>
                </div>
            </div>
            <div data-role="content" class="jqm-content">
                <div class="row">
                    <div class="large-12 columns">
                        <div class="hide-for-small">
                            <div id="featured">
                                <img src="img/ajaccio.jpg" alt="slide image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 show-for-small"><br>
                                <img src="img/ajaccio.jpg" alt="slide image">
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="large-12 columns">
                        <div class="row">
                            <div class="large-3 small-6 columns">
                                <img src="img/article.png" alt="articles">                              
                            </div>
                            <div class="large-3 small-6 columns">
                                <img src="img/evenement.png" alt="evenments">                              
                            </div>
                            <div class="large-3 small-6 columns">
                                <img src="img/info.png" alt="info">                               
                            </div>
                            <div class="large-3 small-6 columns">
                                <img src="img/news.png" alt="news">                              
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="large-12 columns">
                        <div class="row">
                            <div class="large-8 columns">
                                <div class="panel radius">
                                    <div class="row">
                                        <div class="large-6 small-6 columns">
                                            <h4>News</h4><hr/>
                                            <h5 class="subheader">Restez aux courant des derniere nouvelles du lycee</h5>
                                        </div>
                                        <div class="large-6 small-6 columns">
                                            <p>Le lycée Laetitia agrandit son offre de formation avec l’option développeur SLAM (Solutions Logicielles et Applications Métiers) en complément de l’option réseau SISR (Solutions d’Infrastructures, Systèmes et Réseaux). Pour en savoir plus sur les contenus : http://llb.ac-corse.fr/btssio. Venez nombreux aux JPO le 13 février afin de rencontrer l’équipe et les étudiants !</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['login'])){?>
                            <div class="large-4 columns hide-for-small">
                                <h4>Que faire</h4><hr/>
                                <a href="#">
                                    <div class="panel radius callout">
                                        <p>Consultez les notes de vos enfants</p>
                                    </div>
                                </a>
                                <a href="cahierdetexte.php">
                                    <div class="panel radius callout">
                                        <p>Consultez le cahier de texte en ligne</p>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <footer class="row">
                    <div class="large-12 columns">
                        <hr>
                        <div class="row">
                            <div class="large-6 columns">
                                <p>&copy; Copyright LLB.</p>
                            </div>
                            <div class="large-6 columns">
                            </div>
                        </div>
                    </div>
                </footer>     
            </div>            
           <div data-role="panel" id="panel" data-theme="a" data-position-fixed="true" data-dismissible="false">
                <div class="panel-content">
                    <div data-role="header">
                        <div data-role="navbar" data-iconpos="left"> 
                            <ul>
                                <li><a href="tel:" data-role="button" data-icon="phone">Appeller</a></li>                     
                            <?php if (isset($_SESSION['login'])){?>
                            <form method="POST">
                                <li><input name="deconnexion" type="submit" value="Déconnexion"></li>
                            </form>
                            <?php } else{?>
                                <li><a href="#popupLogin" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-icon="check" data-theme="a" data-transition="pop">Connexion</a></li>
                            <?php }?>
                            </ul>
                        </div>
                    </div>
                    </div>
                        <div data-role="popup" id="popupMenu" data-theme="a">
                            <div data-role="popup" id="popupLogin" data-overlay-theme="a" data-theme="a" class="ui-corner-all">
                                <form method="POST" action="index.php">
                                    <div style="padding:10px 20px;">
                                        <h3 style="color: white">Connexion</h3>
                                        <label for="un" class="ui-hidden-accessible">Nom :</label>
                                        <input type="text" name="login" id="un" value="" placeholder="identifiant" data-theme="b">
                                        <label for="pw" class="ui-hidden-accessible">Mot de passe :</label>
                                        <input type="password" name="motdepasse" id="pw" value="" placeholder="mot de passe" data-theme="b">
                                        <button type="submit" data-theme="b" data-icon="check">Envoyer</button>
                                    </div>
                                </form>
                            </div>
                        </div>                    
                    
                    <div data-role="collapsible-set"  data-inset="false" data-theme="a" data-content-theme="d" data-collapsed-icon="arrow-r" data-iconpos="right" data-icon="arrow-r" data-expanded-icon="arrow-d">
                    <div data-role="collapsible" >  
                    <h3>Le Lycee</h3>
                       <ul data-role="listview">
                        <li><a href="#">Presentation General</a></li>
                        <li><a href="#">Info Administratives</a></li>
                        <li><a href="#">Les filieres proposer</a></li>
                       </ul>
                  </div>
                  <div data-role="collapsible">  
                    <h3>Les activites</h3>
                       <ul data-role="listview">
                        <li><a href="#">Astronomie et Philosofie</a></li>
                        <li><a href="#">Cineclub</a></li>
                        <li><a href="#">La presse</a></li>
                        <li><a href="#">Les voyages</a></li>
                       </ul>
                  </div>
                  <div data-role="collapsible">  
                    <h3>Vie du lycee</h3>
                       <ul data-role="listview">
                        <li><a href="#">Presentation General</a></li>
                        <li><a href="#">Info Administratives</a></li>
                        <li><a href="#">Les filieres proposer</a></li>
                       </ul>
                  </div>
                  <div data-role="collapsible">  
                    <h3>Pedagogie</h3>
                       <ul data-role="listview">
                        <li><a href="#">Presentation General</a></li>
                        <li><a href="#">Info Administratives</a></li>
                        <li><a href="#">Les filieres proposer</a></li>
                       </ul>
                  </div>
                </div>
                <div data-role="footer">		
                <div data-role="navbar" data-inline="true">
                    <ul>
			<li><a href="#">FB</a></li>
			<li><a href="#">TW</a></li>
			<li><a href="#">RSS</a></li>
                    </ul>
                </div>
                </div>
                </div>     
                </div>
            </div>
    </body>
</html>
