$(document).ready(function () {
  $(".customerAccountEmail").hide();
  $(".customerAccountPassword").hide();

  $(".createCustomerAccount").on("change", function () {
    $this = $(this);
    if ($this.is(":checked")) {
      $(".customerAccountEmail").show();
      $(".customerAccountEmail input").attr("required", true);
      $(".customerAccountPassword").show();
      $(".customerAccountPassword input").attr("required", true);
    } else {
      $(".customerAccountEmail").hide();
      $(".customerAccountEmail input").attr("required", false);
      $(".customerAccountPassword").hide();
      $(".customerAccountPassword input").attr("required", false);
    }
  });

  $.urlParam = function (name) {
    var results = new RegExp("[?&]" + name + "=([^&#]*)").exec(window.location.href);
    if (results == null) {
      return null;
    } else {
      return results[1] || 0;
    }
  };

  if($.urlParam('payment') == 'success') {
      $('#myModal').modal('show');
  }
});
