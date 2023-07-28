$("#submit").click(function () {
    $.post($("#product_form").attr("action"),
      $("#product_form :input").serializeArray(),
      function (info) {
        $("#response").empty();
        $("#response").html(info);
      });
    $("#product_form").submit(function () {
      return false;
    });
  });