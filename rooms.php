<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Rooms</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

  <section class="room-listing">
    <h2 class="section-title">Our Rooms</h2>

    
      <div class="rooms-container">
      <div class="room-box">
        <img src="media/CARRE2.jpg" alt="Classic Room">
        <div class="room-info">
          <h3>Classic Room</h3>
          <p class="price">Price: 2500 MAD/night</p>
          <p class="desc">Cozy room with a queen bed, garden view, and contemporary decor.</p>
          <br>
          <br>
          <br>
          
          <a href="index.php#reservation" class="btn">make a reservation</a>
        </div>
       </div>

      
      
      <div class="room-box">
        <img src="media/CARRE1.jpg" alt="Deluxe Room">
        <div class="room-info">
          <h3>Duplexe</h3>
          <p class="price">Price: 3500 MAD/night</p>
          <p class="desc">Spacious room with sea view, king-sized bed, and modern bathroom.</p>
          <br>
          <br>
          <br>

          <a href="index.php#reservation" class="btn">make a reservation</a>
        </div>
      </div>

      

      <div class="room-box">
        <img src="media/CARRE4.jpg" alt="Family Suite">
        <div class="room-info">
          <h3> Royal Riad</h3>
          <p class="price">Price: 15 000 MAD/night</p>
          <p class="desc">Perfect for families: 2 bedrooms, living area, and private balcony.</p>
          <br>
          <br>
          <br>
          
          <a href="index.php#reservation" class="btn">make a reservation</a>
        </div>
      </div>
    <div class="room-box">
        <img src="media/CARRE3.jpg" alt="Family Suite">
        <div class="room-info">
          <h3>Diplomatic Suite </h3>
          <p class="price">Price: 24 500 MAD/night</p>
          <p class="desc">Perfect for families: 2 bedrooms, living area, and private balcony.</p>
          <br>
          <br>
          <br>
          
          <a href="index.php#reservation" class="btn">make a reservation</a>
        </div>
      </div>
      <!-- Add more rooms here -->

    </div>
  </section>

</body>
</html>
