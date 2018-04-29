<?php
require 'tools.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css"> </head>

<body>
  <nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="../index.php">LOJA</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <br>
              <a class="dropdown-item" href="<?php if($_GET['cat'] == 'cel'){print '#';}else{print 'index.php?cat=cel';} ?>">Celulares</a>
              <a class="dropdown-item" href="<?php if($_GET['cat'] == 'eletro'){print '#';}else{print 'index.php?cat=eletro';} ?>">Eletronicos</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../about/about.html">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Contact us</a>
          </li>
        </ul>
        <form class="form-inline m-0">
          <input class="form-control mr-2" type="text" placeholder="Oque você está procurando?">
          <button class="btn btn-primary" type="submit">Procurar</button>
        </form>
        <a class="btn btn-default navbar-btn" href="../Card/carrinho.php">
          <i class="fa fa-user fa-fw"></i>Carrinho
          <span class="badge badge-pill badge-primary">1</span>
        </a>
        <!--IF LOGADO IS TRUE-->
        <?php if (isLoggedIn()): ?>
          <a>Olá, <?php echo $_SESSION['user_name']; ?>.</a>
          <a class="btn btn-default navbar-btn" href="../Login/logout.php">Sair</a>
        <?php else: ?>
          <a class="btn btn-default navbar-btn" href="../Login/index.php">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  <div class="p-2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="../index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">Link</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class=""><?php print $cat; ?></h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="" class="active nav-link" data-toggle="tab" data-target="#tabone">Principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" data-toggle="tab" data-target="#tabtwo">Menor Preço</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" data-toggle="tab" data-target="#tabthree">Maior Preço</a>
            </li>
          </ul>
          <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="tabone" role="tabpanel">
              <?php ?>
                <p class="">Tab pane one. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="row">
                  <?php
                  ///busca produtos mais comprados
                  $sql = "SELECT valor, img, titulo, descricao FROM produtos WHERE idTotalCompras >= 0 AND idCat = '$idCat' ORDER BY idTotalCompras DESC";
                  $prod = $PDO->query($sql);
                  while ($item = $prod->fetch()) {
                  ?>
                    <div class="col-md-3">
                      <div class="card">
                        <img class="card-img-top" src="../src/<?php print "{$item['img']}"?>" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title"><?php print "{$item['titulo']}"?></h5>
                          <p class="card-text"><?php print "{$item['descricao']}"?></p>
                          <p class="card-text">R$ <?php print "{$item['valor']}"?></p>
                          <a href="#" class="btn btn-primary">Comprar</a>
                        </div>
                      </div>
                    </div>
                  <?php } $prod->closeCursor();?>
                </div>
              <?php  ?>
            </div>
            <div class="tab-pane fade" id="tabtwo" role="tabpanel">
              <p class="">Tab pane two. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <div class="row">
                <?php
                ///busca produtos com menor valor para maior valor
                $sql = "SELECT valor, img, titulo, descricao FROM produtos WHERE idCat = '$idCat' ORDER BY valor ASC";
                $prod = $PDO->query($sql);
                while ($item = $prod->fetch()) {
                ?>
                  <div class="col-md-3">
                    <div class="card">
                      <img class="card-img-top" src="../src/<?php print "{$item['img']}"?>" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title"><?php print "{$item['titulo']}"?></h5>
                        <p class="card-text"><?php print "{$item['descricao']}"?></p>
                        <p class="card-text">R$ <?php print "{$item['valor']}"?></p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                      </div>
                    </div>
                  </div>
                <?php } $prod->closeCursor();?>
              </div>
            </div>
            <div class="tab-pane fade" id="tabthree" role="tabpanel">
              <p class="">Tab pane three. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <div class="row">
                <?php
                ///busca produtos do maior valor para o menor
                $sql = "SELECT valor, img, titulo, descricao FROM produtos WHERE idCat = '$idCat' ORDER BY valor DESC";
                $prod = $PDO->query($sql);
                while ($item = $prod->fetch()) {
                ?>
                  <div class="col-md-3">
                    <div class="card">
                      <img class="card-img-top" src="../src/<?php print "{$item['img']}"?>" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title"><?php print "{$item['titulo']}"?></h5>
                        <p class="card-text"><?php print "{$item['descricao']}"?></p>
                        <p class="card-text">R$ <?php print "{$item['valor']}"?></p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                      </div>
                    </div>
                  </div>
                <?php } $prod->closeCursor();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="p-4 col-md-3">
          <h2 class="mb-4 text-secondary">Pingendo</h2>
          <p class="text-white">A company for whatever you may need, from website prototyping to publishing</p>
        </div>
        <div class="p-4 col-md-3">
          <h2 class="mb-4 text-secondary">Mapsite</h2>
          <ul class="list-unstyled">
            <a href="#" class="text-white">Home</a>
            <br>
            <a href="#" class="text-white">About us</a>
            <br>
            <a href="#" class="text-white">Our services</a>
            <br>
            <a href="#" class="text-white">Stories</a>
          </ul>
        </div>
        <div class="p-4 col-md-3">
          <h2 class="mb-4">Contact</h2>
          <p>
            <a href="tel:+246 - 542 550 5462" class="text-white">
              <i class="fa d-inline mr-3 text-secondary fa-phone"></i>+246 - 542 550 5462</a>
          </p>
          <p>
            <a href="mailto:info@pingendo.com" class="text-white">
              <i class="fa d-inline mr-3 text-secondary fa-envelope-o"></i>info@pingendo.com</a>
          </p>
          <p>
            <a href="https://goo.gl/maps/AUq7b9W7yYJ2" class="text-white" target="_blank">
              <i class="fa d-inline mr-3 fa-map-marker text-secondary"></i>365 Park Street, NY</a>
          </p>
        </div>
        <div class="p-4 col-md-3">
          <h2 class="mb-4 text-light">Subscribe</h2>
          <form>
            <fieldset class="form-group text-white">
              <label for="exampleInputEmail1">Get our newsletter</label>
              <input type="email" class="form-control" placeholder="Enter email"> </fieldset>
            <button type="submit" class="btn btn-outline-secondary">Submit</button>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3">
          <p class="text-center text-white">© Copyright 2017 Pingendo - All rights reserved. </p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 10px;right:10px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:180px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo&nbsp;&nbsp;
    <img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16">
  </pingendo>
</body>

</html>
