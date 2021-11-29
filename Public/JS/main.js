$(document).ready(function () {
    $(".customerAccountEmail").hide();
    $(".customerAccountPassword").hide();

    $(".createCustomerAccount").on("change", function () {
        $this = $(this);
        if ($this.is(":checked")) {
            $(".customerAccountEmail").show();
            $(".customerAccountPassword").show();
        } else {
            $(".customerAccountEmail").hide();
            $(".customerAccountPassword").hide();
        }
    });
});
