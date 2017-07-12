<?php

/*
 * Author: Louie Zhu
 * Date: 04/07/2015
 * Name: furniture_index_view.class.php
 * Description: the parent class that displays a search box. The search form is commented out here since the search feature is not implemented. 
 */
namespace warehouse_mvc\views\furniture;
class FurnitureIndexView extends \warehouse_mvc\views\IndexView {

    public static function displayHeader($product) {
        parent::displayHeader($product)
        ?>
        <script>
            //the media type
            var media = "furniture";
        </script>
       
        <!--create the search bar -->
                <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/furniture/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search furnitures by product name" autocomplete="off">
                <input type="submit" value="Go" />
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}