<?php
/*
 * Author: Louie Zhu
 * Date: 12/24/2014
 * Name: index.class.php
 * Description: This class defines the method "display" that displays the home page.
 */
namespace warehouse_mvc\views\welcome;

class Index extends \warehouse_mvc\views\IndexView {

    public function display() {
        //display page header
        parent::displayHeader("Louiz Warehouse Home");
        ?>    


       

        <div id="thumbnails" style="text-align: center; border: none">
            <p></p>

            <a href="<?= BASE_URL ?>/electronic/index">
                <img src="<?= BASE_URL ?>/www/img/electronics.png" title="Electronics"/>
            </a>
            <a href="<?= BASE_URL ?>/furniture/index">
                <img src="<?= BASE_URL ?>/www/img/furniture.png" title="Furniture"/>
            </a>
        </div>
        
        <br>
        
        <?php
        //display page footer
        parent::displayFooter();
    }

}
