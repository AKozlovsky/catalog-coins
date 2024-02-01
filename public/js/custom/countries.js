"use strict";

$(function () {
    $("#select-country").on("change", function () {
        $("#card-countries-2").empty();

        if (this.value == "") {
            $("#card-countries-1").show();
            $("#card-countries-2").hide();
        } else {
            $("#card-countries-2").show();
            $("#card-countries-1").hide();
            var clone = $(
                "#" + this.value.replace(" ", "-").toLowerCase()
            ).clone(true);
            $("#card-countries-2").append(clone);
        }
    });
});
