jQuery(document).ready(function () {
  startOwlSlider();
  setHamburgerActiveToggle();
  // initMap();
  setParalaxScroll();
  setAnimations();
  setFaqOpen();
  initMasonry();
  // initFancybox(); //this needs to be checked have not confirmed this works
});
jQuery(window).scroll(function () {});
jQuery(window).resize(function () {});

function setHamburgerActiveToggle() {
  jQuery(".hamburger").on("click", function () {
    jQuery(".cross").addClass("is-active");
    jQuery(".hamburger").removeClass("is-active");
    jQuery("#nav-menu").addClass("is-active");
    jQuery("body, html").addClass("scroll-block");
  });
  jQuery(".cross").on("click", function () {
    jQuery(".hamburger").addClass("is-active");
    jQuery(".cross").removeClass("is-active");
    jQuery("#nav-menu").removeClass("is-active");
    jQuery("body, html").removeClass("scroll-block");
  });
}

function setFaqOpen() {
  jQuery(".faq-question").on("click", function () {
    var item = jQuery(this).closest(".faq-item");
    jQuery(".faq-item").not(item).removeClass("active");
    item.toggleClass("active");
  });
}
function hideOnScroll() {
  //needs work
  var currentScrollTop = jQuery(window).scrollTop();
  if (togglePosition < currentScrollTop && togglePosition > 180 && !isMobile) {
    mainHeader.addClass("hide");
  } else {
    mainHeader.removeClass("hide");
  }
  togglePosition = currentScrollTop;
}

function startOwlSlider() {
  jQuery(".owl-1").owlCarousel({
    dots: false,
    nav: true,
    margin: 12,
    items: 1,
    loop: true,
    autoplay: true,
    autoplayTimeout: 3000,
    // dots:true,
  });
  jQuery(".owl-2").owlCarousel({
    dots: false,
    nav: true,
    margin: 12,
    loop: true,

    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 2,
      },
    },
  });
  jQuery(".owl-3").owlCarousel({
    loop: true,
    margin: 20,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    smartSpeed: 1500,
    animateIn: "fadeIn",
    animateOut: "fadeOut",
    center: true,
    responsive: {
      0: {
        items: 3,
      },
      600: {
        items: 4,
      },
      1000: {
        items: 5,
      },
    },
  });
}

async function initMap() {
  const mapElement = document.getElementById("map");
  if (!mapElement) {
    return;
  }
  const zoom = parseInt(mapElement.getAttribute("data-zoom"));
  const lat = parseFloat(mapElement.getAttribute("data-lat"));
  const lng = parseFloat(mapElement.getAttribute("data-lng"));

  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
    "marker"
  );
  const map = new Map(document.getElementById("map"), {
    center: { lat, lng },
    zoom: zoom,
    mapId: "4504f8b37365c3d0",
  });

  const logoMarkerUrl = document.createElement("img");
  if (document.getElementById("logo-marker").src)
    logoMarkerUrl.src = document.getElementById("logo-marker").src;

  const marker = new google.maps.marker.AdvancedMarkerElement({
    map,
    position: { lat, lng },
    content: logoMarkerUrl,
  });
}

function initMasonry() {
  var grid = document.querySelector(".masonry-grid");
  if (grid) {
    var msnry = new Masonry(grid, {
      itemSelector: ".masonry-item",
      columnWidth: ".masonry-item",
      percentPosition: true,
      gutter: 20,
      fitWidth: true,
    });
    imagesLoaded(grid).on("progress", function () {
      msnry.layout();
    });
    window.addEventListener("resize", function () {
      msnry.layout();
    });
  }
}

function setParalaxScroll() {
  var scrollTop = jQuery(window).scrollTop();
  var slowScrollRate = 0.4;

  jQuery(".slow-scroll").each(function () {
    var offset = scrollTop * slowScrollRate;
    jQuery(this).css("transform", "translateY(" + offset + "px)");
  });
}

function setAnimations() {
  const animateElements = document.querySelectorAll(
    "[data-animate^='fade'], [data-animate^='zoom']"
  );

  inView("[data-animate]").on("enter", (el) => {
    el.classList.add("animate");
  });

  inView(".deco-img").on("enter", (el) => {
    el.classList.add("animate");
  });

  animateElements.forEach((el) => {
    if (inView.is(el)) {
      el.classList.add("animate");
    }
  });
}

function initFancybox() {
  Fancybox.bind("[data-fancybox]", {
    // Your options here
  });
  Ï;

  Fancybox.bind("[data-fancybox]", {
    on: {
      closing: (fancybox, slide) => {
        setTimeout(() => {
          masonryInstance.layout();
        }, 250);
      },
    },
  });
}
