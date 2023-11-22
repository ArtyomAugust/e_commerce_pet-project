<?php include($base_path . 'src\\modules\\view\\__header.inc.php'); ?>
<?php if (!empty($_GET['findproduct'])) {
  $valueInput = $_GET['findproduct'];
} ?>


<nav class="input">
  <form id="myInputForm" class="myInputForm" method="get">
    <input type="text" placeholder="Search.." value="<?php echo !empty($valueInput) ? $valueInput : ''; ?>"
      id="search-bar" name="findproduct">
    <button type="submit"><i class="bi bi-search"></i></button>
  </form>
</nav>

<!-- Filter -->
<aside>
  <form action="" method="post">
    <div class="content-filter">
      <div class="label">
        <h1 style="text-align: center;">Filter</h1>
      </div>
      <div style="border-style: dotted; border-width: 2px;"></div>
      <div id="filterCheckbox" class="checkbox"></div>
    </div>
  </form>
</aside>
<!-- Grid -->
<div class="wrapper-goods">
  <div class="grid" id="demoB"></div>
</div>

<script type="module">
  import { createGridFHome } from "./src/js/createGrid.js";
  import filter from "./src/js/filter.js";
  import fetchWFilter from "./src/js/fetchWFilter.js";


  const dataFPHP = <?php echo $context = !empty($context) ? $context : 0 ?>;
  // console.log(dataFPHP);

  const fromInput = document.querySelector("#search-bar");

  console.log(fromInput.value.length);

  if (fromInput.value.length !== 0) {

    filter(dataFPHP);
    createGridFHome(dataFPHP);
    fetchWFilter(dataFPHP);

  }

  if (fromInput.value.length === 0) {
    window.location.href = '/pet-project/';
  }

</script>


<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>