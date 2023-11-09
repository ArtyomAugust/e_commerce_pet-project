<?php include($base_path . 'src\\modules\\view\\__header.inc.php'); ?>
<?php if (!empty($_POST['findProduct'])) {
  echo $valueInput = $_POST['findProduct'];
} ?>
<!------------------------navbar------------------------>

<header id="navbar">
  <nav class="navbar-container container">
    <a href="/" class="home-link">
      <div class="navbar-logo"></div>
      Website Name
    </a>
    <button type="button" id="navbar-toggle" aria-controls="navbar-menu" aria-label="Toggle menu" aria-expanded="false">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <div id="navbar-menu" aria-labelledby="navbar-toggle">
      <ul class="navbar-links">
        <li class="navbar-item"><a class="navbar-link" href="/pet_project/about">About</a></li>
        <li class="navbar-item"><a class="navbar-link" href="/blog">Blog</a></li>
        <li class="navbar-item"><a class="navbar-link" href="/careers">Careers</a></li>
        <li class="navbar-item"><a class="navbar-link" href="/contact">Contact</a></li>
      </ul>
    </div>
  </nav>
</header>
<!------------------------navbar------------------------>

<nav class="input">
  <form id="myInputForm" class="myInputForm" method="post">
    <input 
    type="text" 
    placeholder="Search.." 
    value="" 
    id="search-bar"
    name="findProduct">
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
  import createGrid from "./src/js/createGrid.js";
  import filter from "./src/js/filter.js";
  import fetchWFilter from "./src/js/fetchWFilter.js";


  const dataFPHP = <?php echo $context; ?>;
  console.log(dataFPHP);

  const fromInput = document.querySelector("#search-bar");

  console.log(fromInput.value.length);

  if (fromInput.value.length == 0) {
    try {
      filter(dataFPHP);
      createGrid(dataFPHP);
      fetchWFilter(dataFPHP);
    } catch (e) {
      console.log(e, 'do not work');
    }

  }

  fromInput.addEventListener("keypress", (e) => {
    // e.preventDefault();
    // console.log(e.key);
    if (e.key === 'Enter') {
      // console.log(fromInput.value);
      let searchBar = fromInput.value;

      filter(dataFPHP);
      createGrid(dataFPHP);
      fetchWFilter(dataFPHP);

    }
  }); 
</script>


<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>