<?php include($base_path . 'src\\modules\\view\\__headerForSeller.ini.php'); ?>
<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Return to a previous page</a>

<form class="edit" method="post">
    <label for="label">Label</label>
    <input name="label" type="text" placeholder="Type label" required>
    <!-- <label for="filename">Upload phpto</label>
        <input type="file" id="myFile" name="photo_name"> -->
    <label for="description">Description</label>
    <textarea name="description" id="" cols="30" rows="5" placeholder="Type description" required></textarea>
    <label for="price">Price</label>
    <input name="price" type="text" placeholder="Type price" required>
    <label for="discount">Discount</label>
    <input name="discount" type="text" placeholder="Type discount">
    <!-- <div class="select"> -->
    <label for="category">Choose a category:</label>
    <select name="category[]" id="category">
        <?php foreach ($category as $key => $value) { ?>
            <option value="<?php echo $value["id"] ?>"><?php echo $value["name_category"] ?>
            </option>
        <?php } ?>
    </select>
    <!-- </div> -->

    <button type="submit">submit</button>
</form>

<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>