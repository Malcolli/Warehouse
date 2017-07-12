<?php
/*
 * Author: Louie Zhu
 * Date: Dec. 24, 2014
 * Name: search.class.php
 * Description: this script defines the SearchElectronic class. The class contains a method named display, which
 *     accepts an array of Electronic objects and displays them in a grid.
 */
namespace warehouse_mvc\views\electronic\search;

class Search extends \warehouse_mvc\views\electronic\ElectronicIndexView {
    /*
     * the displays accepts an array of electronic objects and displays
     * them in a grid.
     */

     public function display($terms, $electronics) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($electronics)) ? "( 0 - 0 )" : "( 1 - " . count($electronics) . " )");
            ?>
        </span>
        <hr>

       <!-- display all records in a grid -->
               <div class="grid-container">
            <?php
            if ($electronics === 0) {
                echo "No electronic was found.<br><br><br><br><br>";
            } else {
                //display electronics in a grid; six electronics per row
                foreach ($electronics as $i => $electronic) {
                    $id = $electronic->getId();
                    $product = $electronic->getProduct();
                    $category = $electronic->getCategory();
                    $price = $electronic->getPrice();
                    $model = $electronic->getModel();
                    $sku = $electronic->getSKU();
                    $year_model = $year_model = new \DateTime($electronic->getYearModel());
                    $image = $electronic->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . ELECTRONIC_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='" . BASE_URL . "/electronic/detail/$id'><img src='" . $image .
                    "'></a><span>$product<br>Category $category<br>" . $year_model->format('m-d-Y') . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($electronics) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
      <div id="back">
        <a href="<?= BASE_URL ?>/electronic/index">Return to electronics list</a>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}