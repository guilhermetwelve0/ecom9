$(document).ready(function () {
    $("#sort").on("change", function () {
        // this.form.submit();
        var sort = $("#sort").val();
        var url = $("#url").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            method: "POST",
            data: { sort: sort, url: url },
            success: function (data) {
                $(".filter_products").html(data);
            },
            error: function () {
                alert("Error");
            },
        });
    });
});
