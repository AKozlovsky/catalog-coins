$(function () {
    // Select2
    var select2 = $(".select2");
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                dropdownParent: $this.parent(),
                placeholder: $this.data("placeholder"), // for dynamic placeholder
            });
        });
    }

    var formRepeater = $(".form-repeater");

    // Form Repeater
    // ! Using jQuery each loop to add dynamic id and class for inputs. You may need to improve it based on form fields.
    // -----------------------------------------------------------------------------------------------------------------

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

    var selectContinent = $("#continent");
    var selectCountry = $("#country");

    selectContinent.on("change", function () {
        var selectedContinent = $(this).val();
        selectCountry.find("option").remove().end();

        $.getJSON("assets/json/countries.json", function (country) {
            $.each(country, function (key, value) {
                if (value.continent == selectedContinent) {
                    selectCountry.append(
                        '<option value="' +
                            value.name +
                            '">' +
                            value.name +
                            "</option>"
                    );
                }
            });
        });
    });
});