<div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php">PhoneBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add.php">Add Contact</a>
      </li>
    </ul>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-inline my-2 my-lg-0">
      <input name="search_field" class="form-control mr-sm-2" type="text" placeholder="Search">
      <input name="search" class="btn btn-secondary my-2 my-sm-0" type="submit" value="Searech">
    </form>
  </div>
</nav>
</div>