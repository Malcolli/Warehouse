<?php
/*
 * Author: Louie Zhu
 * Date: Dec. 24, 2014
 * Name: index.class.php
 * Description: This class defines a method called "display", which displays all electronics.
 */

namespace warehouse_mvc\views\electronic\index;

class Index extends \warehouse_mvc\views\electronic\ElectronicIndexView {
    /*
     * the display method accepts an array of electronic objects and displays
     * them in a grid.
     */

    public function display($electronics) {
        //display page header
        parent::displayHeader("List All Electronics");
        ?>
        <div id="main-header">Electronics in the Warehouse</div>

        <div class="grid-container">
            <?php
            if ($electronics=== 0) {
                echo "No electronics were found.<br><br><br><br><br>";
            } else {
                //display electronics in a grid; six electronics per row
                foreach ($electronics as $i => $electronic) {
                    $product = $electronic->getProduct();
                    $id = $electronic->getId();
                    $price = $electronic->getPrice();
                    $category = $electronic->getCategory();
                    $year_model =$electronic->getYearModel();
                    $image = $electronic->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . ELECTRONIC_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/electronic/detail/$id'><img src='" . $image .
                    "'></a><span>$product<br>Price $ $price<br>" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($electronics) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
       
        <?php
        //display page footer
        parent::displayFooter();
    } //end of display method
}
