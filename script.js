const password = document.getElementById("password");
const toggle = document.getElementById("toggle");

function showHide() {
  if (password.type === "password") {
    password.setAttribute("type", "text");
    toggle.classList.add("hide");
  } else {
    password.setAttribute("type", "password");
    toggle.classList.remove("hide");
  }
}
$(document).ready(function () {
  // Add smooth scrolling to all links
  $("a").on("click", function (event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $("html, body").animate(
        {
          scrollTop: $(hash).offset().top,
        },
        800,
        function () {
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        }
      );
    } // End if
  });
  $("#1").click(function () {
    //$(".detail1").animate( { "opacity": "show", top:"150" } , 5000 );
    $(".detail1").fadeIn(5000);
  });
  $("#2").click(function () {
    //$(".detail1").animate( { "opacity": "show", top:"150" } , 5000 );
    $(".detail2").fadeIn(5000);
  });
  $("#3").click(function () {
    //$(".detail1").animate( { "opacity": "show", top:"150" } , 5000 );
    $(".detail3").fadeIn(5000);
  });
  // $(".navbar a").click(function () {
  //   $(".navbar a").removeClass("active");
  //   $(this).addClass("active");
  // });
  // $(".button-add").click(function () {
  //   $(".adddata").show();
  //   $(".adddata").css("display","flex");
  // });
  // $(".fas fa-edit fa-2x").click(function () {
  //   $(".adddata").css("display","flex");
  // });
});
