<?php
/*
 * Author: Louie Zhu
 * Date: Oct 27, 2012
 * File: edit.class.php
 * Description:
 *
 */
namespace warehouse_mvc\views\furniture\edit;

class Edit extends \warehouse_mvc\views\furniture\FurnitureIndexView {

    public function display($furniture) {
        //display page header
        parent::displayHeader("Edit Product");

        //get movie ratings from a session variable
        if (isset($_SESSION['furniture_categories'])) {
            $categories = $_SESSION['furniture_categories'];
        }
        
        //retrieve movie details by calling get methods
        $id = $furniture->getId();
        $product = $furniture->getProduct();
        $brand = $furniture->getBrand();
        $category = $furniture->getCategory();
        $material = $furniture->getMaterial();
        $price = $furniture->getPrice();
        $image = $furniture->getImage();
        ?>

        <div id="main-header">Edit Product Details</div>

        <!-- display movie details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/furniture/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Product</strong><br>
                <input name="product" type="text" size="100" value="<?= $product ?>" required autofocus></p>
            <p><strong>Brand</strong><br><input name="brand" type="text" size="40" value="<?= $brand ?>" required=""></p>
            <p><strong>Material</strong><br><input name="material" type="text" size="50" value="<?= $material ?>" required=""></p>
            <p><strong>Category</strong></p>
             <?php
             
                foreach ($categories as $m_category => $m_id) {
                    $checked = ($category == $m_category ) ? "checked" : "";
                    echo "<input type='radio' name='category' value='$m_id' $checked> $m_category &nbsp;&nbsp;";
                }
                ?>
            <br>
            <p><strong>Price</strong><br><input name="price" type="text" size="40" value="<?= $price ?>" required=""></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="image" type="text" size="100" required value="<?= $image ?>"></p>
            
            <input type="submit" name="action" value="Update Product">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/furniture/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}


