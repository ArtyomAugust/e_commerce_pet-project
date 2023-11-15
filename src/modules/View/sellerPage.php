<?php include($base_path . 'src\\modules\\view\\__headerForSeller.ini.php'); ?>
<h1>Seller: <?php echo $_SESSION['user_name'] ?></h1>
<div class="table-container">
    <table class="fixed-table">
        <thead>
            <tr>
                <th>Label</th>
                <th>description</th>
                <th>photo_name</th>
                <th>category</th>
                <th>price</th>
                <th>discount</th>
                <th>uploaded</th>
            </tr>
        </thead>
        <tbody>
        </tbody>

    </table>
</div>

<script type="module">
    import { createGridFSeller } from "../src/js/createGrid.js";

    const data = <?php echo $context ?>;


    createGridFSeller(data);

</script>
<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>