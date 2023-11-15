<?php include($base_path . 'src\\modules\\view\\__headerForSeller.ini.php'); ?>

<form class="edit" method="post">
    <?php echo $result['label']; ?>
        
        <input type="file" id="myFile" name="filename">
        <input type="text" value="<?php echo !empty($result['label']) ? $result['label'] : ''; ?>" required>
        <textarea name="" id="" cols="10" rows="5" required>
                <?php echo !empty($result['description']) ? $result['description'] : ''; ?>"
                </textarea>
        <input type="text" value="<?php echo !empty($result['price']) ? $result['price'] : ''; ?>" required>
        <input type="text" value="<?php echo !empty($result['discount']) ? $result['discount'] : ''; ?>">
        <input type="text" value="<?php echo !empty($result['']) ? $result[''] : ''; ?>">
        <input type="text" value="<?php echo !empty($resultInput) ? $result[''] : ''; ?>">


    <button type="submit">submit</button>
</form>
<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>