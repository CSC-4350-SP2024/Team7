<?php
    if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Choose Image</title>
<style>
	* {
		box-sizing: border-box}
	body {
	font-family: Verdana, sans-serif;
  	margin:0;
	background: linear-gradient(to bottom, #0e4c92, #ffea61);
    transition: background 0.5s ease;}
	.mySlides {
		display: none
		}
	img {
		vertical-align: middle;
		}

	.slideshow-container {
	  max-width: 1000px;
	  position: relative;
	  margin: auto;
	}

	.prev, .next {
	  cursor: pointer;
	  position: absolute;
	  top: 50%;
	  width: auto;
	  padding: 16px;
	  margin-top: -22px;
	  color: white;
	  font-weight: bold;
	  font-size: 18px;
	  transition: 0.6s ease;
	  border-radius: 0 3px 3px 0;
	  user-select: none;
	}

	.next {
	  right: 0;
	  border-radius: 3px 0 0 3px;
	}
  .prev:hover, .next:hover {
    background-color: rgba(0,0,0,0.8);
  }

  .text {
    color: #f2f2f2;
    font-size: 15px;
    padding: 8px 12px;
    position: absolute;
    bottom: 8px;
    width: 100%;
    text-align: center;
  }

  .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
  }

  .dot {
    cursor: pointer;
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
  }

  .active, .dot:hover {
    background-color: #717171;
  }

  .fade {
    animation-name: fade;
    animation-duration: 1.5s;
  }

  @keyframes fade {
    from {opacity: .4} 
    to {opacity: 1}
  }

  @media only screen and (max-width: 300px) {
    .prev, .next,.text {font-size: 11px}
  }
  .mySlides img {
  display: block;
  margin-top: 100px; 
  margin-left: auto; 
  margin-right: auto; 
  max-width: 100%;
  height: auto;
  width: 300px;
}
</style>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
	<form action="logout.php" method="post" class="logout-button" onclick="return onLogoutClick(); ">
        <button type="submit" id="logout">Logout</button>
    </form>
<div class="slideshow-container">
<?php
    $imageDirectory = 'images/';

    $imageFiles = glob($imageDirectory . '*.{jpg,png}', GLOB_BRACE);
    ?>

    <?php foreach ($imageFiles as $index => $imageFile): ?>
        <div class="mySlides fade">
            <div class="numbertext"><?php echo $index + 1; ?> / <?php echo count($imageFiles); ?></div>
            <a href="scramble_image.php?image=<?php echo urlencode($imageFile); ?>">
                <img src="<?php echo $imageFile; ?>" alt="Image <?php echo $index + 1; ?>">
            </a>
        </div>
    <?php endforeach; ?>
  
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>

  let slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
  }
</script>

</body>
</html>


