<?php
/*
 * Author: Louie Zhu
 * Date: Dec. 24, 2014
 * Name: index.class.php
 * Description: This class defines a method called "display", which displays all furnitures.
 */
namespace warehouse_mvc\views\furniture\index;

class Index extends \warehouse_mvc\views\furniture\FurnitureIndexView {
    /*
     * the display method accepts an array of furniture objects and displays
     * them in a grid.
     */

    public function display($furnitures) {
        //display page header
        parent::displayHeader("List All Furnitures");
        ?>
        <div id="main-header">Furniture in the Library</div>

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

                    echo "<div class='col'><p><a href='", BASE_URL, "/furniture/detail/$id'><img src='" . $image .
                    "'></a><span>$product<br> Price: $$price<br>" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($furnitures) - 1) {
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
