<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stupid Student Store</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e0e9f3;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
    }
    header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  text-align: center;
  margin-bottom: 2rem;
}
    .account {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      margin-bottom: 2rem;
    }
    .avatar {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: 1rem;
    }
    .items {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    .item {
      width: calc(33.33% - 1rem);
      margin-bottom: 1rem;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .item:hover {
      transform: translateY(-10px);
    }
    .item img {
      width: 100%;
      height: auto;
      object-fit: cover;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    .item-content {
      padding: 1rem;
    }
    .item h2 {
      margin-bottom: 0.5rem;
      font-size: 1.2rem;
    }
    .item p {
      margin-bottom: 0.5rem;
      font-size: 1rem;
      color: #555;
    }
    .item a {
      text-decoration: none;
      color: #4CAF50;
      font-weight: bold;
    }
    .item a:hover {
      text-decoration: underline;
    }
    .header-right {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}

.search-bar {
  display: flex;
  align-items: center;
  background-color: #f2f2f2;
  padding: 5px;
  border-radius: 5px;
  margin-right: 1rem;
}

.search-bar input[type="text"] {
  border: none;
  padding: 5px;
  width: 200px;
}

.search-bar input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 5px;
  border: none;
  border-radius: 5px;
}
.search-results-title {
  text-align: center;
}

  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Stupid Student Store</h1>
      <div class="header-right">
      <form class="search-bar" action="index.php" method="get">
        <input type="text" name="search" placeholder="Search for items...">
        <input type="submit" value="Search">
      </form>
      </div>
    </header>
    </div class="search-result">
       <?php 
        if (isset($_GET['search'])) {
    	      echo '<h3 style="text-align:center;">Search results for "' . $_GET['search'] . '":</h3>';
    	  }
  	  ?>
     </div>
    
     <div class="items">
      <div class="item">
        <img src="https://purepng.com/public/uploads/large/purepng.com-mens-jeansgarmentlower-bodydenimjeansblue-1421526362760kjplj.png" alt="Item 1" />
        <div class="item-content">
          <h2>Jeans</h2>
          <p>$70</p>
          <a href="post.php?id=1">Details</a>
        </div>
      </div>
      <div class="item">
        <img src="http://www.freepngimg.com/download/jacket/2-leather-jacket-png-image.png" alt="Item 2" />
        <div class="item-content">
          <h2>Jacket</h2>
          <p>$30</p>
          <a href="post.php?id=2">Details</a>
        </div>
      </div>
      <div class="item">
        <img src="http://pluspng.com/img-png/pants-png-hd-cargo-pant-png-image-trousers-png-hd-966.png" alt="Item 3" />
        <div class="item-content">
          <h2>Pants</h2>
          <p>$40</p>
          <a href="post.php?id=3">Details</a>
        </div>
      </div>
      <div class="item">
        <img src="https://pngimg.com/uploads/tshirt/tshirt_PNG5448.png" alt="Item 4" />
        <div class="item-content">
          <h2>T-shirt</h2>
          <p>$50</p>
          <a href="post.php?id=4">Details</a>
        </div>
      </div>
      <div class="item">
        <img src="https://pngimg.com/uploads/sweater/sweater_PNG3.png" alt="Item 5" />
        <div class="item-content">
          <h2>Sweater</h2>
          <p>$60</p>
          <a href="post.php?id=5">Details</a>
        </div>
      </div>
      <div class="item">
        <img src="http://www.pngall.com/wp-content/uploads/2016/09/Shorts-PNG.png" alt="Item 6" />
        <div class="item-content">
          <h2>Shorts</h2>
          <p>$70</p>
          <a href="post.php?id=6">Details</a>
        </div>
      </div>
      
    </div>
  </div>
</body>
</html>
