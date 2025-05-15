jQuery(function ($) {
    function loadProducts(category = "all", filter = "default", page = 1) {
      $.ajax({
        url: ajax_object.ajax_url,
        type: "POST",
        data: {
          action: "filter_products",
          category: category,
          filter: filter,
          page: page,
        },
        beforeSend: function () {
          $("#product-container").html("<p>Loading...</p>");
        },
        success: function (response) {
          if (response.success) {
            $("#product-container").html(response.data);
            // Scroll to the top of the product container
            $('html, body').animate({
              scrollTop: $("#product-container").offset().top - 100
            }, 500);
          } else {
            $("#product-container").html("<p>Error loading products.</p>");
          }
        },
        error: function () {
          $("#product-container").html("<p>Error loading products.</p>");
        },
      });
    }
  
    // Initial load
    loadProducts();
  
    // Category filter
    $(".category-filter a").on("click", function (e) {
      e.preventDefault();
      $(".category-filter a").removeClass("active");
      $(this).addClass("active");
      var category = $(this).data("category");
      var filter = $("#product-filter").val();
      loadProducts(category, filter, 1); // Reset to page 1 when changing category
    });
  
    // Sort filter
    $("#product-filter").on("change", function () {
      var filter = $(this).val();
      var category = $(".category-filter a.active").data("category") || "all";
      loadProducts(category, filter, 1); // Reset to page 1 when changing filter
    });
  
    // Pagination
    $(document).on("click", ".pagination a.page-numbers", function (e) {
      e.preventDefault();
      var page = $(this).data("page");
      var category = $(".category-filter a.active").data("category") || "all";
      var filter = $("#product-filter").val();
      loadProducts(category, filter, page);
    });
  });