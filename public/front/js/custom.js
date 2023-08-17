$(document).ready(function () {
  $("#getPrice").change(function () {
    var size = $(this).val();
    var product_id = $(this).attr("product-id");
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: "/get-product-price",
      data: { size: size, product_id: product_id },
      type: 'post',
      success: function (resp) {
        // alert(resp['final_price']);
        if (resp['discount'] > 0) {
          $(".getAttributePrice").html("<div class='price'><h4>Rs." + resp['final_price'] + "</h4></div><div class='original-price'><span>Original Price:</span><span> Rs." + resp['product_price'] + "</span></div>");
        } else {
          $(".getAttributePrice").html("<div class='price'><h4>Rs." + resp['final_price'] + "</h4></div>");
        }
      }, error: function () {
        // alert("Error");
      }
    })
  });
  //Update Cart Item Qty
  $(document).on('click', '.updateCartItem', function () {
    if ($(this).hasClass('plus-a')) {
      //Get Qty
      var quantity = $(this).data('qty');
      // increase the qty by 1
      new_qty = parseInt(quantity) + 1;
      //  alert(new_qty);
    }
    if ($(this).hasClass('minus-a')) {
      //Get Qty
      var quantity = $(this).data('qty');
      //Check Qty is at least 1
      if (quantity <= 1) {
        alert("Item quantity must be 1 or greater");
        return false;
      }
      // increase the qty by 1
      new_qty = parseInt(quantity) - 1;
      //  alert(new_qty);
    }
    var cartid = $(this).data('cartid');
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      data: { cartid: cartid, qty: new_qty },
      url: '/cart/update',
      type: 'post',
      success: function (resp) {
        if (resp.status == false) {
          alert(resp.message);
        }
        $("#appendCartItems").html(resp.view);
      }, error: function () {
        alert("Error");
      }
    });
  });

  //Delete Cart Item
  $(document).on('click', '.deleteCartitem', function () {
    var cartid = $(this).data('cartid');
    var result = confirm("Are you sure to delete this Cart Item?");
    if (result) {
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: { cartid: cartid },
        url: '/cart/delete',
        type: 'post',
        success: function (resp) {
          $("#appendCartItems").html(resp.view);
        }, error: function () {
          // alert("Error");
        }
      })
    }
  });

  // Register Form Validation
  $("#registerForm").submit(function () {
    $(".loader").show();
    var formdata = $(this).serialize();
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: "/user/register",
      type: "POST",
      data: formdata,
      success: function (resp) {
        if (resp.type == "error") {
          $(".loader").hide();
          $.each(resp.errors, function (i, error) {
            $("#register-" + i).attr('style', 'color:red');
            $("#register-" + i).html(error);
            setTimeout(function () {
              $("#register-" + i).css({
                'display': 'none'
              });
            }, 6000);
          });
        } else if (resp.type == "success") {
          // alert(resp.message);
          $(".loader").hide();
          $("#register-success").attr('style', 'color:green');
          $("#register-success").html(resp.message);
        }
      }, error: function () {
        alert("Error");
      }
    })
  });
   // Login Form Validation
  $("#loginForm").submit(function () {
    var formdata = $(this).serialize();
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: "/user/login",
      type: "POST",
      data: formdata,
      success: function (resp) {
        if (resp.type == "error") {
          $.each(resp.errors, function (i, error) {
            $("#login-" + i).attr('style', 'color:red');
            $("#login-" + i).html(error);
            setTimeout(function () {
              $("#login-" + i).css({
                'display': 'none'
              });
            }, 6000);
          });
        } else if (resp.type == "incorrect") {
          // alert(resp.message);
          $("#login-error").attr('style', 'color:red');
          $("#login-error").html(resp.message);
        }else if (resp.type == "inactive") {
          // alert(resp.message);
          $("#login-error").attr('style', 'color:red');
          $("#login-error").html(resp.message);
        } else if (resp.type == "success") {
          window.location.href = resp.url;
        }
      }, error: function () {
        alert("Error");
      }
    })
  });
});


function get_filter(class_name) {
  var filter = [];
  $("." + class_name + ":checked").each(function () {
    filter.push($(this).val());
  });
  return filter;
}
