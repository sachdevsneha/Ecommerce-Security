
<?php
include "includes/connection.php";
include "includes/functions.php";
?>
<?php
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

?>
<a href="add_item.php">Add New Inventory Item</a>


<?php
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
    echo 'Do you really want to delete item with ID of ' . $_GET['deleteid'] . '? <a href="admin_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="admin_list.php">No</a>';
    exit();
}
if (isset($_GET['yesdelete'])) {
    // remove item from system
    // delete from database
    $id_to_delete = $_GET['yesdelete'];
    $sql = mysqli_query($mysqli, "DELETE FROM inventory_info WHERE item_id='$id_to_delete' LIMIT 1") or die ("Cannot delete");
    // unlink the image from server
    // Remove The Pic -------------------------------------------
    //$pictodelete = ("../inventory_images/$id_to_delete.jpg");
    //if (file_exists($pictodelete)) {
    //   unlink($pictodelete);
    // }
    header("location: admin_list.php");
    exit();
}
?>
<?php
// Parse the form data and add inventory item to the system
if (isset($_POST['item_name'])) {

    $item_name = mysqli_real_escape_string($_POST['item_name']);
    $item_description = mysqli_real_escape_string($_POST['item_description']);
    $price = mysqli_real_escape_string($_POST['price']);
    $category = mysqli_real_escape_string($_POST['category']);
 //   $date_added = mysqli_real_escape_string($_POST['date_added']);

    // See if that product name is an identical match to another product in the system
    $sql = mysqli_query($mysqli, "SELECT item_id FROM inventory_info WHERE item_name='$item_name' LIMIT 1");
    $productMatch = mysqli_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
        echo 'Sorry you tried to place a duplicate "Item Name" into the system, <a href="admin_list.php">click here</a>';
        exit();
    }
    // Add this product into the database no
    $sql = mysqli_query($mysqli, "INSERT INTO inventory_info (item_name,item_description, price,category)
        VALUES('$item_name','$item_description','$price','$category')" )or die (mysqli_error());
    $item_id = mysqli_insert_id();
    // Place image in the folder
    // $newname = "$pid.jpg";
    // move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
    header("location: admin_list.php");
    exit();
}
?>
<?php
// This block grabs the whole list for viewing
$item_id = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_NUMBER_INT);
$item_list = "";
$sql = mysqli_query($mysqli, "SELECT * FROM inventory_info ORDER BY price DESC");
$itemCount = mysqli_num_rows($sql); // count the output amount
if ($itemCount > 0) {
    while($row = mysqli_fetch_array($sql)){
        $item_id = $row["item_id"];
        $item_name = $row["item_name"];
        $price = $row["price"];
        $item_description = $row["item_description"];
       // $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        $item_list .= "Item ID: $item_id  <strong> $item_name </strong> $$price &nbsp; &nbsp; &nbsp; <a href='edit_list.php?item_id=$item_id'>edit</a> &bull; <a href='admin_list.php?deleteid=$item_id'> Delete </a><br />";
    }
} else {
    $item_list = "You have no products listed in your store yet";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Inventory List</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>



<body>
<div align="left" id="mainWrapper">

    <div id="pageContent"><br />
        <div align="left" style="margin-left:24px;">
            <h2>Inventory list</h2>
            <?php echo $item_list; ?>
        </div>
       <!-- <div align="right" style="margin-right:32px;"><a href="admin_list.php#inventoryForm">+ Add New Inventory Item</a></div> -->

        <!-- <a name="inventoryForm" id="inventoryForm"></a>
        <h3>
            &darr; Add New Inventory Item Form &darr;
        </h3>
        <form action="admin_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
            <table width="90%" border="0" cellspacing="0" cellpadding="6">
                <tr>
                    <td width="20%" align="right">Item Name</td>
                    <td width="80%"><label>
                            <input name="item_name" type="text" id="item_name" size="64" />
                        </label></td>
                </tr>
                <tr>
                    <td align="right">Item Description</td>
                    <td><label>
                            $
                            <input name="item_description" type="text" id="item_description" size="12" />
                        </label></td>
                </tr>
                <tr>
                    <td align="right">Price</td>
                    <td><label>
                            $
                            <input name="price" type="text" id="price" size="12" />
                        </label></td>
                </tr>
                <tr>
                    <td align="right">Category</td>
                    <td><label>
                            <select name="category" id="category">
                                <option value="Clothing">Clothing</option>
                                <option value="Shoes">Shoes</option>
                            </select>
                        </label></td>
                </tr>


                <tr>
                    <td>&nbsp;</td>
                    <td><label>
                            <input type="submit" name="button" id="button" value="Add This Item Now" />
                        </label></td>
                </tr>
            </table>
        </form>
        <br />
        <br />
    </div>

</div>-->
</body>
</html>