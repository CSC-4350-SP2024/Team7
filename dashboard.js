
function addListeners() {

    const imagePasswordContainers = document.getElementsByClassName("image-password");
    for (let i = 0; i < imagePasswordContainers.length; i++) {
        imagePasswordContainers[i].addEventListener('click', onViewImagePassword);
    }


    const addImagePasswordButton = document.getElementById("add-image-password-button");
    if (addImagePasswordButton) {
        addImagePasswordButton.addEventListener('click', onAddImagePasswordClick);
    }
}
function onLogoutClick(event){
    const logoutButton = document.getElementById("logout");
    logoutButton.click();
}
function onViewImagePassword(event) {

    const imagePasswordContainer = event.currentTarget;
    const password = imagePasswordContainer.dataset.password; 
    
}

function onAddImagePasswordClick() {
	
    window.location.href = "add_password.php";
}
function toggleNavbar() {
  var navbar = document.getElementById("myNavbar");
  if (navbar.className === "navbar-collapse") {
    navbar.className += " responsive";
  } else {
    navbar.className = "navbar-collapse";
  }
}
$(document).ready( function() {
  
  $('body').on("click", ".larg div h3", function(){
    if ($(this).children('span').hasClass('close')) {
      $(this).children('span').removeClass('close');
    }
    else {
      $(this).children('span').addClass('close');
    }
    $(this).parent().children('p').slideToggle(250);
  });
  
  $('body').on("click", "nav ul li a", function(){
    var title = $(this).data('title');
    $('.title').children('h2').html(title);
  });
});