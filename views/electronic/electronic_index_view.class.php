<?php
namespace warehouse_mvc\views\electronic;
/*
 * Author: Louie Zhu
 * Date: 04/07/2015
 * Name: electronic_index_view.class.php
 * Description: the parent class that displays a search box. The search form is commented out here since the search feature is not implemented. 
 */

class ElectronicIndexView extends \warehouse_mvc\views\IndexView {

    public static function displayHeader($product) {
        parent::displayHeader($product)
        ?>
        <script>
            //the media type
            var media = "electronic";
        </script>
        <!--create the search bar -->
                <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/electronic/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search electronics by product" autocomplete="off">
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