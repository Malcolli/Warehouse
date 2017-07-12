<?php
/*
 * Author: Louie Zhu
 * Date: Dec. 24, 2014
 * Name: search.class.php
 * Description: this script defines the SearchFurniture class. The class contains a method named display, which
 *     accepts an array of Furniture objects and displays them in a grid.
 */
namespace warehouse_mvc\views\furniture\search;

class Search extends \warehouse_mvc\views\furniture\FurnitureIndexView {
    /*
     * the displays accepts an array of furniture objects and displays
     * them in a grid.
     */

     public function display($terms, $furnitures) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($furnitures)) ? "( 0 - 0 )" : "( 1 - " . count($furnitures) . " )");
            ?>
        </span>
        <hr>

       <!-- display all records in a grid -->
               <div class="grid-container">
            <?php
            if ($furnitures === 0) {
                echo "No furniture was found.<br><br><br><br><br>";
            } else {
                //display furnitures in a grid; six furnitures per row
                foreach ($furnitures as $i => $furniture) {
                    $id = $furniture->getId();
                    $product = $furniture->getProduct();
                    $brand = $furniture->getBrand();
                    $material = $furniture->getMaterial();
                    $category = $furniture->getCategory();
                    $price = $furniture->getPrice();
                    $image = $furniture->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . FURNITURE_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='" . BASE_URL . "/furniture/detail/$id'><img src='" . $image .
                    "'></a><span>$product<br>$price<br>" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($furnitures) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <div id="back">
        <a href="<?= BASE_URL ?>/furniture/index">Go to furniture list</a>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}