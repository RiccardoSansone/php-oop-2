<?php

    require_once __DIR__ . '/Traits/PositiveMess.php';
    class categories {

        use PositiveMess;

      public $species;
      public $icon;

      public function __construct($species, $icon)
      {
        $this->species = $species;
        $this->icon = $icon;
      }

    }

    class productsType extends categories {
        use PositiveMess;
        public $typeName;

        public function __construct($species, $icon, $typeName)
        {
            parent::__construct($species, $icon);
            $this->typeName = $typeName;
        }
    }

    class products extends productsType {
        use PositiveMess;
        public $brand;
        public $description;
        public $images;
        public $price;

        public function __construct($species, $icon, $typeName, $brand,$description, $images, $price)
        {
            parent::__construct($species, $icon, $typeName);
            $this->brand = $brand;
            $this->description = $description;
            $this->images = $images;
            $this->price = $price;

        }

        // exception 
        public function calcDiscount(){

            $discount = 10;

            if(!is_numeric($this->price)){
                throw new Exception('Sorry but it\'s not a number');
            }

            return $this->price - $discount;
        }

    }

    // $discountedProduct = new products('dog', './assets/img/dog.png/', 'feed', 'Virtus', '100% vegan','https://picsum.photos/200/300', 20);

    // try {
    //     $reducedPrice = $discountedProduct->calcDiscount();
    //     var_dump($reducedPrice);
    // } catch (Exception $error) {
    //     echo 'Errore: '. $error->getMessage();
    // }
        // end exception 

    

    $products = [];

    $dog = new categories("dog", "./assets/img/dog.png");
    $cat = new categories("cat", "./assets/img/cat.png");

    // var_dump($dog->positive());

    $feedCat = new productsType($cat->species, $cat->icon,"feed");
    $feedDog = new productsType($dog->species, $dog->icon, "feed");

    $kennelCat = new productsType($cat->species, $cat->icon,"kennel");
    $kennelDog = new productsType($dog->species, $dog->icon, "kennel");

    $gameCat = new productsType($cat->species, $cat->icon,"game");
    $gameDog = new productsType($dog->species, $dog->icon, "game");

    $virtusCat = new products($feedCat->species,$feedCat->icon,$feedCat->typeName, "Virtus", "100% animal protein", "https://picsum.photos/200/300", 25);

    try {
        $reducedPrice = $virtusCat->calcDiscount();
        // var_dump($reducedPrice);
    } catch (Exception $error) {
        echo 'Errore: '. $error->getMessage();
    }

    $loveCat = new products($kennelCat->species,$kennelCat->icon,$kennelCat->typeName, "Love", "100% cotton", "https://picsum.photos/200/300", 39.99);
    $yesCat = new products($gameCat->species,$gameCat->icon,$gameCat->typeName, "Yes", "100% rubber", "https://picsum.photos/200/300", 9.99);
    
    $virtusDog = new products($feedDog->species,$feedDog->icon,$feedDog->typeName, "Virtus", "100% animal protein", "https://picsum.photos/200/300", 19.99);
    $loveDog = new products($kennelDog->species,$kennelDog->icon,$kennelDog->typeName, "Love", "100% cotton", "https://picsum.photos/200/300", 39.99);
    $yesDog = new products($gameDog->species,$gameDog->icon,$gameDog->typeName, "Yes", "100% rubber", "https://picsum.photos/200/300", 9.99);

    $products = [$virtusCat, $loveCat, $yesCat, $virtusDog, $loveDog, $yesDog];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animal Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>

    <header class="mb-5">
        <div style="width: 100%;" class="navbar shadow d-flex justify-content-around p-3">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contacts</a>
        </div>
    </header>
    <!-- /header -->

    <main>
        <div class="container d-flex justify-content-around flex-wrap gap-3">

        <?php foreach ($products as $product) : ?>
            <div class="col-3 width_30 mb-2">
                <div style="height: 500px;" class="card shadow p-3 flex-column gap-2 width_30 mh-100">
                    <img src="<?= $product->images;?>" alt="">
                    <h4><?= $product->brand;?></h4>
                    <h6><?= $product->typeName;?></h6>
                    <p><?= $product->description ;?></p>
                    <img style="width: 30px; aspect-ratio: 1; border-radius: 50%; object-fit:cover;" src="<?= $product->icon; ?>" alt="">
                    <small><?= $product->price ;?></small>
                    <small class="text-danger"><?= $product->positive();?></small>
                    <?php if($product->price == 25): ;?>
                        <small>Discounted price: <?= $reducedPrice ?></small>
                    <?php else:;?>
                        <small>non hai nessuno sconto</small>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
            

        </div>  
    </main>
    <!-- /main -->


    <footer class="mt-5">
        <div style="width: 100%;" class="p-5 d-flex justify-content-around bg-dark text-light gap-4">
            <div class="col">
                <h1 class="text-center">Lorem</h1>
                <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae eveniet autem culpa minus perspiciatis at.</p>
            </div>
            <div class="col">
                <h1 class="text-center">Lorem</h1>
                <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae eveniet autem culpa minus perspiciatis at.</p>
            </div>
            <div class="col">
                <h1 class="text-center">Lorem</h1>
                <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae eveniet autem culpa minus perspiciatis at.</p>
            </div>
        </div>
    </footer>
    <!-- /footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>