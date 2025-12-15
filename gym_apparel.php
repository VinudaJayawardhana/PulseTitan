<DOCTYPE! html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>
                Gym Apparel
            </title>
            <link rel="stylesheet" href="./gym_apparel.css">
        </head>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Bitter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

        <body>


            <script src="./gym_apparel.js"></script>
          <section class="backimage">
            <h1 class="topic" id="topic">Gym Apparels</h1>
            

            <div class="gallery backimage">
              <div class="gallery-category">
               
                <img src="./background -image/gym_apparel1.jpg" alt="">
                  
            
                  
                </div>
            </section>

                <section class="content">
                    
                <div>  <h1 class="heading " id="heading1">All Products</h1></div>


                <div class="controls">
                    <label for="filter">Filter by Category:</label>
                    <select id="filter">
                        <option value="all">All</option>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                    </select>
                    
                    <label for="sort">Sort by:</label>
                    <select id="sort">
                        <option value="price-asc">Price: Low to High</option>
                        <option value="price-desc">Price: High to Low</option>
                        <option value="rating-asc">Rating: Low to High</option>
                        <option value="rating-desc">Rating: High to Low</option>
                    </select>
                </div>
                <section class="content">
                <div class="main-content">
                
            <div class="product-grid">
                
              <!-- Product 1  --> 
              <div class="product product-card fit"   data-category="men" data-price="4000" data-rating="4.0" >
                  <div class="row-img">
                      <img class="product-image" src="./Apparel/men trackbottom.jpeg" alt="Men's Trackbottom">
                  </div>
                  <h3>Men's Trackbottom</h3>
                  <div class="rating">
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span> 
                        <a href="#">4.0/5</a>
                    </div>
                    
                  </div>
                  <div class="row-in">
                      <div class="row-left">
                          
                          <a href="./add-to-cart.html"><img class="cart" src="https://img.icons8.com/?size=100&id=59997&format=png&color=000000" alt="Cart Icon"></a>
                      </div>
                      <div class="row-right">
                          <h4>LKR 4000.00</h4>
                      </div>
                  </div>
                  <a href="./trackbottom.html"><button class="button">View-Product</button></a>
              </div>

              

              <!-- Product 9 add -->
              <div class="product product-card  " data-category="men" data-price="3400" data-rating="4.5">
                  <div class="row-img">
                      <img class="product-image" src="./Apparel/sport_jersy.png" alt="Sport Jersy">
                  </div>
                  <h3>Sport-Jersy</h3>
                  <div class="rating">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9734;</span> 
                      <a href="#">4.5/5</a>
                  </div>
                  <div class="row-in">
                      <div class="row-left">
                         
                          <a href="#"><img class="cart" src="https://img.icons8.com/?size=100&id=59997&format=png&color=000000" alt="Cart Icon"></a>
                      </div>
                      <div class="row-right">
                          <h4>LKR 3400.00</h4>
                      </div>
                  </div>
                  <a href="./sport_jersy.html"><button class="button">View-Product</button></a>
              </div>
                          
              

               <!-- Product 10 add -->
               <div class="product product-card"  data-category="women" data-price="2000" data-rating="3.8">
                <div class="row-img">
                    <img class="product-image" src="./Apparel/women_sportt-shirt.jpeg" alt="Women Sport t-shirt">
                </div>
                <h3>Women-Sport t-shirt</h3>
                <div class="rating">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9734;</span> 
                    <a href="#">3.8/5</a>
                </div>
                <div class="row-in">
                    <div class="row-left">
                      
                        <a href="./add-to-cart.html"><img class="cart" src="https://img.icons8.com/?size=100&id=59997&format=png&color=000000" alt="Cart Icon"></a>
                    </div>
                    <div class="row-right">
                        <h4>LKR 2000.00</h4>
                    </div>
                </div>
                <a href="./women_sport-tshirt.html"><button class="button">View-Product</button></a>
            </div>

            

         

  




  



                </div>

                
            </section>
            <?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pulsetitandb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch only supplement products
$result = $conn->query("SELECT * FROM products WHERE product_category = 'Apparel' and product_id>24  ORDER BY product_id DESC");

if ($result->num_rows > 0) {
    echo '<div class="product-grid">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product product-card">';
        echo '<div class="row-img">';
        echo '<img class="product-image" src="' . $row["product_image"] . '" alt="' . $row["product_name"] . '">';
        echo '</div>';
        echo '<h3>' . $row["product_name"] . '</h3>';
        
        
        echo '<div class="rating">';
        for ($i = 1; $i <= 5; $i++) {
            echo ($i <= $row["product_rating"]) ? '<span class="star">&#9733;</span>' : '<span class="star">&#9734;</span>';
        }
        echo '<a href="#">' . $row["product_rating"] . '/5</a>';
        echo '</div>';
        
        echo '<div class="row-in">';
        echo '<div class="row-left">';
        echo '<a href="#" class="add-to-cart-btn" data-name="' . $row["product_name"] . '" data-price="' . $row["product_price"] . '" data-image="' . $row["product_image"] . '">';
        echo '<img class="cart" src="https://img.icons8.com/?size=100&id=59997&format=png&color=000000" alt="Cart Icon">';
        echo '</a>';
        echo '</div>';
        echo '<div class="row-right">';
        echo '<h3>LKR ' . number_format($row["product_price"], 2) . '</h3>';
        echo '</div>';
        echo '</div>';
        echo '<a href="./' . strtolower(str_replace(' ', '_', $row["product_name"])) . '.html"><button class="button">View Product</button></a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<p>No supplements available.</p>";
}

$conn->close();
?>

            </div>

            <script src="shop.js"></script>
        </body>
    </html>
</DOCTYPE>


