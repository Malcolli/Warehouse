<?php
/*
 * Authors: Spencer, Vince, Malcum
 */

namespace warehouse_mvc\views\user;

class UserIndexView extends \warehouse_mvc\views\IndexView {

    public static function displayHeader($user) {
        parent::displayHeader($user)
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title> <?php echo $page_title ?> </title>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <link rel='shortcut icon' href='<?= BASE_URL ?>/www/img/favicon.ico' type='image/x-icon' />
                <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/app_style.css' />
                <script>
                    //create the JavaScript variable for the base url
                    var base_url = "<?= BASE_URL ?>";
                </script>
            </head>
            <body>
                <div id="logbar">
                        <ul>
                            <li> <a href="<?= BASE_URL ?>/user/login">Log In</a></li>
                            <li> <a href="<?= BASE_URL ?>/user/logout">Log Out</a></li>
                            <li> <a href="<?= BASE_URL ?>/user/create">Create</a></li>
                         
                        </ul>
                </div>
                
                <div id="top"></div>
                <div id='wrapper'>
                    <center><div id="banner">
                        <a href="<?= BASE_URL ?>/index.php" style="text-decoration: none" title="BANNER">
                            
                                <center><img src='<?= BASE_URL ?>/www/img/LWHLogo-1.png' style="width: 280px; border: none" /></center>
                             
                        </a>
                        <div id="right">
                           
                        </div>
                    </div>
                    </center>
                    <?php
                }//end of displayHeader function
                
                //this method displays the page footer
                public static function displayFooter() {
                    ?>
                    
           
                <div id="footer"><br>
                    <p style="font-style: italic">This application is created as a course project for I211. It is solely for teaching and learning purposes. Plus if you actually take the time to use it, you may find it does not work at times</p>
                    <br>&copy 2015 Louiz Warehouse. Almost No Rights Reserved, so take it easy.
                    <br>
                
                </div>
                <script type="text/javascript" src="<?= BASE_URL ?>/www/js/ajax_autosuggestion.js"></script>
            </body>
        </html>
        <?php
    } //end of displayFooter function
}
