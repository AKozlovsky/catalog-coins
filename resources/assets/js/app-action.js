$(function () {
    var select2 = $(".select2");
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                dropdownParent: $this.parent(),
                placeholder: $this.data("placeholder"),
            });
        });
    }

    var formRepeater = $(".form-repeater");

    if (formRepeater.length) {
        var row = 2;
        var col = 1;
        formRepeater.on("submit", function (e) {
            e.preventDefault();
        });
        formRepeater.repeater({
            show: function () {
                var fromControl = $(this).find(".form-control, .form-select");
                var formLabel = $(this).find(".form-label");

                fromControl.each(function (i) {
                    var id = "form-repeater-" + row + "-" + col;
                    $(fromControl[i]).attr("id", id);
                    $(formLabel[i]).attr("for", id);
                    col++;
                });

                row++;
                $(this).slideDown();
                $(".select2-container").remove();
                $(".select2.form-select").select2({
                    placeholder: "Placeholder text",
                });
                $(".select2-container").css("width", "100%");
                var $this = $(this);
                select2Focus($this);
                $(".form-repeater:first .form-select").select2({
                    dropdownParent: $(this).parent(),
                    placeholder: "Placeholder text",
                });
                $(".position-relative .select2").each(function () {
                    $(this).select2({
                        dropdownParent: $(this).closest(".position-relative"),
                    });
                });
            },
        });
    }
});
