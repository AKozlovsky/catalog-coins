$(function () {
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

    // Media upload
    const previewTemplate = `<div class="dz-preview dz-file-preview">
    <div class="dz-details">
      <div class="dz-thumbnail">
        <img data-dz-thumbnail>
        <span class="dz-nopreview">No preview</span>
        <div class="dz-success-mark"></div>
        <div class="dz-error-mark"></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
        <div class="progress">
          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
        </div>
      </div>
      <div class="dz-filename" data-dz-name></div>
      <div class="dz-size" data-dz-size></div>
    </div>
    </div>`;

    const dropzoneBasic = document.querySelector("#dropzone-basic");

    if (dropzoneBasic) {
        const myDropzone = new Dropzone(dropzoneBasic, {
            previewTemplate: previewTemplate,
            parallelUploads: 1,
            maxFilesize: 5,
            acceptedFiles: ".jpg,.jpeg,.png,.gif",
            addRemoveLinks: true,
            maxFiles: 1,
        });
    }

    // Form Validation
    const formAddItem = document.getElementById("formAddItem");

    const validation = FormValidation.formValidation(formAddItem, {
        fields: {
            continent: {
                validators: {
                    notEmpty: {
                        message: "Please select a continent",
                    },
                },
            },
            country: {
                validators: {
                    notEmpty: {
                        message: "Please select a country",
                    },
                },
            },
            currency: {
                validators: {
                    notEmpty: {
                        message: "Please select a currency",
                    },
                },
            },
            currencyValue: {
                validators: {
                    notEmpty: {
                        message: "Please select a currency value",
                    },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "",
                rowSelector: function (field, ele) {
                    switch (field) {
                        case "continent":
                        case "country":
                        case "currency":
                        case "currencyValue":
                            return ".col-md-6";
                        default:
                            return ".row";
                    }
                },
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
        init: (instance) => {
            instance.on("plugins.message.placed", function (e) {
                //* Move the error message out of the `input-group` element
                if (e.element.parentElement.classList.contains("input-group")) {
                    // `e.field`: The field name
                    // `e.messageElement`: The message element
                    // `e.element`: The field element
                    e.element.parentElement.insertAdjacentElement(
                        "afterend",
                        e.messageElement
                    );
                }
                //* Move the error message out of the `row` element for custom-options
                if (
                    e.element.parentElement.parentElement.classList.contains(
                        "custom-option"
                    )
                ) {
                    e.element
                        .closest(".row")
                        .insertAdjacentElement("afterend", e.messageElement);
                }
            });
        },
    }).on("core.form.valid", function () {
        $.ajax({
            data: $("#formAddItem").serialize(),
            url: `${baseUrl}submit`,
            type: "POST",
            success: function (status) {
                Swal.fire({
                    icon: "success",
                    title: `Successfully!`,
                    text: `Item was added successfully.`,
                    customClass: {
                        confirmButton: "btn btn-success",
                    },
                });
            },
            error: function (err) {
                Swal.fire({
                    title: "Error!",
                    text: err,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-success",
                    },
                });
            },
        });
    });

    // Continent selector
    var selectContinent = $("#continent"),
        selectCountry = $("#country"),
        selectCurrency = $("#currency");

    if (selectContinent.length) {
        select2Focus(selectContinent);
        selectContinent.wrap('<div class="position-relative"></div>');
        selectContinent
            .select2({
                placeholder: "Select continent",
                dropdownParent: selectContinent.parent(),
            })
            .on("change", function () {
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

                validation.revalidateField("continent");
                validation.resetField("country");
            });
    }

    if (selectCountry.length) {
        select2Focus(selectCountry);
        selectCountry.wrap('<div class="position-relative"></div>');
        selectCountry
            .select2({
                placeholder: "Select country",
                dropdownParent: selectCountry.parent(),
            })
            .on("change", function () {
                validation.revalidateField("country");
            });
    }

    if (selectCurrency.length) {
        select2Focus(selectCurrency);
        selectCurrency.wrap('<div class="position-relative"></div>');
        selectCurrency
            .select2({
                placeholder: "Select currency",
                dropdownParent: selectCurrency.parent(),
            })
            .on("change", function () {
                validation.revalidateField("currency");
            });
    }
});
