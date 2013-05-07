<?php
    include "/var/www/lcs/includes/headerauth.inc.php";
    include "/var/www/Annu/includes/ldap.inc.php";
    include "/var/www/Annu/includes/ihm.inc.php";
    session_start();
    //session_name('LLB');
    /*
    $login = $_POST['login'];
    $motdepasse = $_POST['motdepasse'];

    if (user_valid_passwd($login, $motdepasse) == TRUE){
        $_SESSION['login'] = $login;
    }
    */
    
    if(isset($_POST['deconnexion'])){ session_destroy(); header("Location:index.php");} 
    $login = $_SESSION['login'];
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
    <?php flush(); ?>
    <body>
        <div data-role="page" class="ui-responsive-panel "  data-dom-cache="true">
            <div data-role="header" data-theme="a" data-position="fixed" >         
               <div data-role="navbar" class="nav-glyphish-example" data-grid="d">
                    <ul>
                        <li><a href="#panel" id="menu" data-icon="custom">Menu</a></li>
                        <li></li>
                        <li><center><?php if (isset($_SESSION['login'])){
                            list($user, $groups)= people_get_variables($login,true); echo "Bonjour ".$user['nom']; 
                            } else{
                                ?> LLB <?
                              }?>
                        </center></li>
                        <li></li>
                        <li><a href="#" id="email" data-icon="custom" onclick="window.location = 'mailto:email@domain.com';return false;">Email</a></li>
                    </ul>
                </div>
            </div>
            <div data-role="content" class="jqm-content">  

                <ul data-role="listview" data-split-icon="gear" data-split-theme="d" data-inset="false" class="ui-listview">			
                    
                <?php
                $toto = is_eleve($login);
                if ($toto == true){
                    echo "<p>Vous êtes un eleve</p><br>";
                }
                else {
                    echo "Bonjour profess<br>";
                }
                echo $user['fullname'].'<br>';
                echo $groups[0]['cn'].'<br>';
                echo $groups[0]['description'].'<br>';
                
                $connexion = mysql_connect('localhost', 'root', 'mysqladmin');
                mysql_select_db('gepi_plug',$connexion);// Connexion MySQL
                
                $groupsss = $groups[0]['description'];
                $id_classe = mysql_query("SELECT id FROM classes WHERE classe = '$groupsss'") or die(mysql_error());
                $id_classe = mysql_fetch_array($id_classe);
                $id_group = mysql_query("SELECT id_groupe FROM j_groupes_classes WHERE id_classe = $id_classe[0]") or die(mysql_error());
                $id = 0;
                $id2 = 0;
                while($id_group = mysql_fetch_array($id_group)){
                    echo $id_group[0]."<br />";
                    echo $id_group[1]."<br />";
                    echo $id_group[2]."<br />";
                    echo $id_group[3]."<br />";
                    echo $id_group[4]."<br />";
                    echo $id_group[5]."<br />";

                    $contenu = mysql_query("SELECT contenu FROM ct_devoirs_entry WHERE id_groupe = '$id_group[$id]' AND contenu != '' ");
                    while ($contenu = mysql_fetch_array($contenu)){
                        echo 'BONJOUR : '.$contenu[$id2];
                        $id2 = $id2 + 1;
                    }
                    $id = $id + 1;
                }
                
//                while($cont = mysql_fetch_array($contenu)){
//                    echo $cont[0].'<br>';
//                    $cont++;
//                }
                
//                $login = isauth();
//                    if ( $login == "0" ) {
//                        echo " Vous n'etes pas authentifié";
//                    }
//                    else { 
//                        echo "Vous etes authentifié avec le login $login";
//                    }
//                $dn = "dc=llbtest,dc=fr";
//                $filter="";
//                $justthese = array("cn");
//                $classe = array();
//                list($classe) = search_groups($filter);
//                
//                echo $classe;
//                echo "bonjour";
//                $sr=  ldap_search($ds, $dn, $filter, $justthese);
//                echo $sr;
//                $entries=  ldap_get_entries($ds, $sr);
//                echo $entries['count'];
//                for($i = 0; $i < $entries['count']; $i++){
//                    echo ($entries[$i]['cn'][0]);
//                }
                ?>
                </ul>
            </div>            
            <div data-role="panel" id="panel" data-theme="a" data-position-fixed="true" data-dismissible="false">
                <div class="panel-content">
                    <div data-role="header">
                        <div data-role="navbar" data-iconpos="left"> 
                            <ul>
                                <li><a href="tel:0603391860" data-role="button" data-icon="phone">Appeller</a></li>                     
                            <?php if (isset($_SESSION['login'])){?>
                            <form method="POST">
                                <input name="deconnexion" type="submit" value="Déconnexion">
                            </form>
                            <?php }?>
                            </ul>
                        </div>
                    </div>                   
                    
                    <div data-role="collapsible-set"  data-inset="false" data-theme="a" data-content-theme="d" data-collapsed-icon="arrow-r" data-iconpos="right" data-icon="arrow-r">
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
            <div data-role="footer" data-position="fixed">		
                <div data-role="navbar" data-inline="true">
                    <ul>
			<li><a href="#">Chronologique</a></li>
			<li><a href="#">Matieres</a></li>
			<li><a href="#">Aide</a></li>
                    </ul>
                </div>
                </div>
            </div>
    </body>
</html>

 while($group = mysql_fetch_array($id_group)){
                      ?><li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-up-c ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-last-child"><div class="ui-btn-inner ui-li ui-li-has-alt"><div class="ui-btn-text"><a href="#" class="ui-link-inherit">                      
                        <h3 class="ui-li-heading"><?php echo $group[0]; ?></h3>
                        <p class="ui-li-desc"><?php while($cont = mysql_fetch_array($contenu)){ 
                                      echo $cont[0];
                                      $cont++;
                                  }?></p>
			</a>