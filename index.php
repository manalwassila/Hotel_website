<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30, '/');
   header('location:index.php');
}

if(isset($_POST['check'])){

   $check_in = $_POST['check_in'];
   $check_in = filter_var($check_in, FILTER_SANITIZE_STRING);

   $total_rooms = 0;

   $check_bookings = $conn->prepare("SELECT * FROM `bookings` WHERE check_in = ?");
   $check_bookings->execute([$check_in]);

   while($fetch_bookings = $check_bookings->fetch(PDO::FETCH_ASSOC)){
      $total_rooms += $fetch_bookings['rooms'];
   }

   // if the hotel has total 30 rooms 
   if($total_rooms >= 30){
      $warning_msg[] = 'rooms are not available';
   }else{
      $success_msg[] = 'rooms are available';
   }

}

if(isset($_POST['book'])){

   $booking_id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $rooms = $_POST['rooms'];
   $rooms = filter_var($rooms, FILTER_SANITIZE_STRING);
   $check_in = $_POST['check_in'];
   $check_in = filter_var($check_in, FILTER_SANITIZE_STRING);
   $check_out = $_POST['check_out'];
   $check_out = filter_var($check_out, FILTER_SANITIZE_STRING);
   $adults = $_POST['adults'];
   $adults = filter_var($adults, FILTER_SANITIZE_STRING);
   $childs = $_POST['childs'];
   $childs = filter_var($childs, FILTER_SANITIZE_STRING);

   $total_rooms = 0;

   $check_bookings = $conn->prepare("SELECT * FROM `bookings` WHERE check_in = ?");
   $check_bookings->execute([$check_in]);

   while($fetch_bookings = $check_bookings->fetch(PDO::FETCH_ASSOC)){
      $total_rooms += $fetch_bookings['rooms'];
   }

   if($total_rooms >= 30){
      $warning_msg[] = 'rooms are not available';
   }else{

      $verify_bookings = $conn->prepare("SELECT * FROM `bookings` WHERE user_id = ? AND name = ? AND email = ? AND number = ? AND rooms = ? AND check_in = ? AND check_out = ? AND adults = ? AND childs = ?");
      $verify_bookings->execute([$user_id, $name, $email, $number, $rooms, $check_in, $check_out, $adults, $childs]);

      if($verify_bookings->rowCount() > 0){
         $warning_msg[] = 'room booked alredy!';
      }else{
         $book_room = $conn->prepare("INSERT INTO `bookings`(booking_id, user_id, name, email, number, rooms, check_in, check_out, adults, childs) VALUES(?,?,?,?,?,?,?,?,?,?)");
         $book_room->execute([$booking_id, $user_id, $name, $email, $number, $rooms, $check_in, $check_out, $adults, $childs]);
         $success_msg[] = 'room booked successfully!';
      }

   }

}

if(isset($_POST['send'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $message = $_POST['message'];
   $message = filter_var($message, FILTER_SANITIZE_STRING);

   $verify_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $verify_message->execute([$name, $email, $number, $message]);

   if($verify_message->rowCount() > 0){
      $warning_msg[] = 'message sent already!';
   }else{
      $insert_message = $conn->prepare("INSERT INTO `messages`(id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$id, $name, $email, $number, $message]);
      $success_msg[] = 'message send successfully!';
   }

}

?>
<?php
if (isset($_GET['login']) && $_GET['login'] === 'success' && isset($_COOKIE['client_name'])) {
    $client_name = htmlspecialchars($_COOKIE['client_name']);
    echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            swal('Welcome back!', 'Hello $client_name, you have successfully logged in!', 'success');
        });
    </script>";
    setcookie('client_name', '', time() - 3600, '/'); // Supprimer le cookie pour ne l'afficher qu'une seule fois
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Leyth Hotel</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
   <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>


</head>

<script>
var gallerySwiper = new Swiper('.gallery-slider', {
  loop: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  slidesPerView: 1,
  spaceBetween: 10,
});
</script>

<body>



<!-- home section starts  -->
<section class="home" id="home">
   <?php include 'components/user_header.php'; ?>
   <div class="overlay">
    <div class="content">
      <h1>Leyth</h1>
      <p> Grand Hotel</p>
       <a href="#availability" class="btn">check availability</a> 
       </div>
         </div>
  </section>


<!-- home section ends -->

<!-- availability section starts  -->

<section class="availability" id="availability">

   <form action="" method="post">
      <div class="flex">
         <div class="box">
  <p>check in <span>*</span></p>
  <input type="date" name="check_in" id="check_in" class="input" required>
</div>
<div class="box">
  <p>check out <span>*</span></p>
  <input type="date" name="check_out" id="check_out" class="input" required>
</div>

<script>
  // Met la date d'aujourd'hui au minimum du check-in
  const checkIn = document.getElementById('check_in');
  const checkOut = document.getElementById('check_out');
  const today = new Date().toISOString().split('T')[0];
  checkIn.min = today;

  // Quand la date de check-in change
  checkIn.addEventListener('change', function () {
    // La date de check-out doit être au moins le lendemain
    let selectedDate = new Date(this.value);
    selectedDate.setDate(selectedDate.getDate() + 1);
    checkOut.min = selectedDate.toISOString().split('T')[0];

    // Réinitialiser la valeur de check-out si elle est invalide
    if (checkOut.value && checkOut.value <= checkIn.value) {
      checkOut.value = '';
    }
  });
</script>

         <div class="box">
            <p>adults <span>*</span></p>
            <select name="adults" class="input" required>
               <option value="1">1 adult</option>
               <option value="2">2 adults</option>
               <option value="3">3 adults</option>
               <option value="4">4 adults</option>
               <option value="5">5 adults</option>
               <option value="6">6 adults</option>
            </select>
         </div>
         <div class="box">
            <p>childs <span>*</span></p>
            <select name="childs" class="input" required>
               <option value="-">0 child</option>
               <option value="1">1 child</option>
               <option value="2">2 childs</option>
               <option value="3">3 childs</option>
               <option value="4">4 childs</option>
               <option value="5">5 childs</option>
               <option value="6">6 childs</option>
            </select>
         </div>
         <div class="box">
            <p>rooms <span>*</span></p>
            <select name="rooms" class="input" required>
               <option value="1">Classic room</option>
               <option value="2">Duplexe </option>
               <option value="3">Royal Riad</option>
               <option value="4">Diplomatic suite</option>
               
            </select>
         </div>
      </div>
      <input type="submit" value="check availability" name="check" class="btn">
   </form>

</section>

<!-- availability section ends -->

<!-- about section starts  -->

<section class="about" id="about">

<div class="container">
   
<div id="container">
   
  <div id="texte">
    <h2>Bienvenue </h2>
  
  </div>
  <div id="videobox">
    <video src="..\media\ideo.mp4" autoplay muted loop controls></video>
  </div>
</div>

   
   <div class="row">
      <div class="image">
       <img src="media/staff.jpg" alt="">
      </div>
      <div class="content">
         <h3>best staff</h3>
         <p>Our dedicated team is always here to ensure your stay is unforgettable. Whether it’s attending to your needs or offering friendly, attentive service, our staff goes above and beyond to make you feel welcome.</p>
         <a href="#reservation" class="btn">make a reservation</a>
      </div>
   </div>

   <div class="row revers">
      <div class="image">
         <img src="media\canape.jpg" alt="">
      </div>
      <div class="content">
         <h3>best Rooms</h3>
         <p>Enjoy the comfort and elegance of our finest rooms, designed to provide a relaxing and luxurious experience. Each room features modern amenities, stylish décor, and a peaceful atmosphere to make your stay truly exceptional.</p>
         <a href="rooms.php" class="btn">Rooms </a>
      </div>
   </div>

   <div class="row">
      <div class="image">
          <img src="media/pool.jpg" alt="">
      </div>
      <div class="content">
         <h3>swimming pool</h3>
         <p>Refresh and unwind in our crystal-clear swimming pool. Whether you want to take a leisurely swim, relax by the water, or enjoy the sun, our pool area offers the perfect escape during your stay.</p>
         <a href="#availability" class="btn">check availability</a>
      </div>
   </div>

</section>


<!-- services section starts  -->

<section class="services">

   <div class="box-container">

      <div class="box">
         <img src="media/icon-1.png" alt="">
         <h3>food & drinks</h3>
         <p>Delight in a variety of delicious dishes and refreshing drinks, carefully prepared to satisfy every taste.</p>
      </div>

      <div class="box">
         <img src="media/icon-2.png" alt="">
         <h3>outdoor dining</h3>
         <p>Enjoy your meals in a serene outdoor setting, surrounded by nature and fresh air for a truly relaxing experience.</p>
      </div>

      <div class="box">
         <img src="media/icon-3.png" alt="">
         <h3>beach view</h3>
         <p>Relax with stunning views of the ocean right from your room — the perfect setting for a peaceful getaway.</p>
      </div>

      <div class="box">
         <img src="media/icon-4.png" alt="">
         <h3>decorations</h3>
         <p>Enjoy elegant and tasteful decor that creates a warm, inviting atmosphere throughout the hotel.</p>
      </div>

      <div class="box">
         <img src="media/icon-5.png" alt="">
         <h3>swimming pool</h3>
         <p>Relax and unwind in our crystal-clear swimming pool, perfect for a refreshing dip any time of day.</p>
      </div>

      <div class="box">
         <img src="media/icon-6.png" alt="">
         <h3>resort beach</h3>
         <p>Enjoy direct access to a pristine private beach with golden sands, gentle waves, and stunning ocean views your perfect seaside escape.</p>
      </div>

   </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
 document.addEventListener('DOMContentLoaded', function() {
  // Texte à associer aux images selon leur src
  const captions = {
    'media/ROOM33.jpg': ' 1',
    'images/gallery-img-2.webp': 'Texte pour image 2',
    'images/gallery-img-3.webp': 'Texte pour image 3',
    'images/gallery-img-4.webp': 'Texte pour image 4',
    'images/gallery-img-5.webp': 'Texte pour image 5',
    'images/gallery-img-6.webp': 'Texte pour image 6',
  };

  document.querySelectorAll('.swiper-slide img').forEach(img => {
    const src = img.getAttribute('src');
    if(captions[src]) {
      const captionDiv = document.createElement('div');
      captionDiv.classList.add('caption');
      captionDiv.textContent = captions[src];
      img.parentElement.appendChild(captionDiv);
    }
  });

  // Initialiser Swiper
  new Swiper('.gallery-slider', {
    loop: true,
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    slidesPerView: 1,
    spaceBetween: 20,
  });
});
</script>


<section class="reservation" id="reservation">

   <form action="" method="post">
      <h3>make a reservation</h3>
      <div class="flex">
         <div class="box">
            <p>your name <span>*</span></p>
            <input type="text" name="name" maxlength="50" required placeholder="enter your name" class="input">
         </div>
         <div class="box">
            <p>your email <span>*</span></p>
            <input type="email" name="email" maxlength="50" required placeholder="enter your email" class="input">
         </div>
         <div class="box">
            <p>your number <span>*</span></p>
            <input type="number" name="number" maxlength="10" min="0" max="9999999999" required placeholder="enter your number" class="input">
         </div>
         <div class="box">
            <p>rooms <span>*</span></p>
            <select name="rooms" class="input" required>
               <option value="1" selected>Classic room</option>
               <option value="2">Duplexe</option>
               <option value="3">Riad</option>
               <option value="4">Diplomatic Suite</option>
            
            </select>
         </div>
       <div class="box">
  <p>check in <span>*</span></p>
  <input type="date" name="check_in" id="check_in" class="input" required>
</div>
<div class="box">
  <p>check out <span>*</span></p>
  <input type="date" name="check_out" id="check_out" class="input" required>
</div>

<script>
  // Met la date d'aujourd'hui au minimum du check-in
  const checkIn = document.getElementById('check_in');
  const checkOut = document.getElementById('check_out');
  const today = new Date().toISOString().split('T')[0];
  checkIn.min = today;

  // Quand la date de check-in change
  checkIn.addEventListener('change', function () {
    // La date de check-out doit être au moins le lendemain
    let selectedDate = new Date(this.value);
    selectedDate.setDate(selectedDate.getDate() + 1);
    checkOut.min = selectedDate.toISOString().split('T')[0];

    // Réinitialiser la valeur de check-out si elle est invalide
    if (checkOut.value && checkOut.value <= checkIn.value) {
      checkOut.value = '';
    }
  });
</script>

         <div class="box">
            <p>adults <span>*</span></p>
            <select name="adults" class="input" required>
               <option value="1" selected>1 adult</option>
               <option value="2">2 adults</option>
               <option value="3">3 adults</option>
               <option value="4">4 adults</option>
               <option value="5">5 adults</option>
               <option value="6">6 adults</option>
            </select>
         </div>
         <div class="box">
            <p>childs <span>*</span></p>
            <select name="childs" class="input" required>
               <option value="0" selected>0 child</option>
               <option value="1">1 child</option>
               <option value="2">2 childs</option>
               <option value="3">3 childs</option>
               <option value="4">4 childs</option>
               <option value="5">5 childs</option>
               <option value="6">6 childs</option>
            </select>
         </div>
      </div>
      <input type="submit" value="book now" name="book" class="btn">
   </form>

</section>

<!-- reservation section ends -->

<!-- gallery section starts -->
<section class="gallery" id="gallery">
  <h2 class="section-title">Gallery</h2>
  <div class="swiper gallery-slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="media/gal8.jpg" alt="Gallery image 1"></div>
      <div class="swiper-slide"><img src="media/gal1.jpg" alt="Gallery image 1"></div>
      <div class="swiper-slide"><img src="media/gal2.jpg" alt="Gallery image 1"></div>
      <div class="swiper-slide"><img src="media/gal3.jpg" alt="Gallery image 1"></div>
      <div class="swiper-slide"><img src="media/gal4.jpg" alt="Gallery image 1"></div>
      <div class="swiper-slide"><img src="media/gal5.jpg" alt="Gallery image 1"></div>
      <div class="swiper-slide"><img src="media/gal6.jpg" alt="Gallery image 1"></div>
      <div class="swiper-slide"><img src="media/gal7.jpg" alt="Gallery image 1"></div>
      <div class="swiper-slide"><img src="media/gal9.jpg" alt="Gallery image 1"></div>
   
   </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</section>

<!-- gallery section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

   <div class="row">

      <form action="" method="post">
         <h3>send us message</h3>
         <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="number" name="number" required maxlength="10" min="0" max="9999999999" placeholder="enter your number" class="box">
         <textarea name="message" class="box" required maxlength="1000" placeholder="enter your message" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
      </form>


</section>

<!-- contact section ends -->

<!-- reviews section starts  -->

<section class="reviews" id="reviews">
  <h2 class="section-title">What Our Guests Say</h2>
  <div class="reviews-container">
    <div class="review-box">
      <p>"Amazing hotel with excellent staff and great food. Highly recommended!"</p>
      <h4>- Sarah L.</h4>
    </div>
    <div class="review-box">
      <p>"Beautiful pool and comfortable rooms. We loved our stay!"</p>
      <h4>- James M.</h4>
    </div>
    <div class="review-box">
      <p>"Perfect location and lovely decorations. We will come back for sure."</p>
      <h4>- Fatima R.</h4>
    </div>
  </div>
</section>
<!-- reviews section ends -->

<!-- Add this CSS inside your style.css or in a style tag -->
<style>
  .section-title   {
    text-align: center;
    margin: 2rem 0;
    font-size: 2.5rem;
    font-weight: bold;
  }

  /* Gallery */
  .gallery {
    padding: 2rem 0;
    max-width: 900px;
    margin: 0 auto;
  }
  .swiper-slide img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 10px;
  }

  /* Reviews */
  .reviews {
    background: #311d18;
    padding: 3rem 1rem;
  }
  .reviews-container {
    max-width: 900px;
    margin: 0 auto;
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
    justify-content: center;
  }
  .review-box {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgb(0 0 0 / 0.1);
    flex: 1 1 250px;
    max-width: 300px;
  }
  .review-box p {
    font-style: italic;
    margin-bottom: 1rem;
  }
  .review-box h4 {
    text-align: right;
    color: #555;
    font-weight: 600;
  }
   
</style>

<!-- Add this JS after loading Swiper.js -->
<script>
  var gallerySwiper = new Swiper('.gallery-slider', {
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    slidesPerView: 1,
    spaceBetween: 20,
  });
</script>

<!-- Make sure to include Swiper CSS and JS in your <head> or before this script -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<!-- reviews section ends  -->





<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->

<?php include 'components/message.php'; ?>



</body>


</html>