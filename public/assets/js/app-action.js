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
    const previewTemplate = `
    <div class="dz-preview dz-file-preview">
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
    </div>
    `;

    Dropzone.autoDiscover = false;
    var dropzone = document.querySelector("#formDropzone");
    let dataTransfer = new DataTransfer();

    $("#formDropzone").dropzone({
        previewTemplate: previewTemplate,
        // url: "/form-submit",
        addRemoveLinks: true,
        // autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        acceptedFiles: ".jpeg, .jpg, .png, .gif",
        paramName: "file",
        init: function () {
            dropzone = this;

            this.on("removedfile", function (file) {
                for (var i = 0; i < dataTransfer.items.length; i++) {
                    if (dataTransfer.items[i].getAsFile() == file) {
                        dataTransfer.items.remove(i);
                    }
                }
            });
        },
        success: function (file) {
            dataTransfer.items.add(file);
        },
    });

    $("#formSubmit").on("click", function (e) {
        e.preventDefault();
        dropzone.processQueue();
        $("#files")[0].files = dataTransfer.files;
        $("#formDropzone").trigger("submit");
    });

    // Form Add Validation
    var formId;

    if (location.pathname.includes("/add-currency")) {
        formId = "formAddCurrency";
    } else if (location.pathname.includes("/add")) {
        formId = "formAddItem";
    } else if (location.pathname.includes("/edit-currency")) {
        formId = "formEditCurrency";
    } else if (location.pathname.includes("/edit")) {
        formId = "formEditItem";
    }

    const form = document.getElementById(formId);

    const validation = FormValidation.formValidation(form, {
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
                        message: "Please enter a currency value",
                    },
                },
            },
            currencyName: {
                validators: {
                    notEmpty: {
                        message: "Please enter a name of the currency",
                    },
                },
            },
            currencyCode: {
                validators: {
                    notEmpty: {
                        message: "Please enter a code of the currency",
                    },
                },
            },
            currencySymbol: {
                validators: {
                    notEmpty: {
                        message: "Please enter a symbol of the currency",
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
        var text = "",
            url = "",
            redirectedUrl = "";

        if (location.pathname.includes("/add-currency")) {
            text = "Currency was added successfully.";
            url = "add-currency-submit";
            redirectedUrl = `${baseUrl}currencies`;
        } else if (location.pathname.includes("/add")) {
            text = "Item was added successfully.";
            url = "add-submit";
            redirectedUrl = `${baseUrl}`;
        } else if (location.pathname.includes("/edit-currency")) {
            text = "Currency was edited successfully.";
            url = "edit-currency-submit/" + $("#id").val();
            redirectedUrl = `${baseUrl}currencies`;
        } else if (location.pathname.includes("/edit")) {
            text = "Item was edited successfully.";
            url = "edit-submit/" + $("#collectionId").val();
            redirectedUrl = $("#httpReferer").val();
        }

        $.ajax({
            data: $("#" + formId).serialize(),
            url: `${baseUrl}` + url,
            type: "POST",
            success: function (status) {
                Swal.fire({
                    icon: "success",
                    title: `Successfully!`,
                    text: text,
                    customClass: {
                        confirmButton: "btn btn-success",
                    },
                }).then(function () {
                    window.location = redirectedUrl;
                });
            },
            error: function (err) {
                var title;

                if (err.responseJSON.message.includes("Duplicate entry")) {
                    title = "Duplicate Error!";
                    err = "The field 'Code' should be unique.";
                } else {
                    title = "Error!";
                }

                Swal.fire({
                    title: title,
                    text: err,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-success",
                    },
                });
            },
        });
    });

    // Continent, country and currency selectors
    var continent = $("#continent"),
        country = $("#country");

    if (continent.length) {
        select2Focus(continent);
        continent.wrap('<div class="position-relative"></div>');
        continent
            .select2({
                placeholder: "Select continent",
                dropdownParent: continent.parent(),
            })
            .on("change", function () {
                country.find("option").remove().end();
                setCountryOptions($(this), country);
                validation.revalidateField("continent");
                validation.resetField("country");
            });

        if (location.pathname.includes("/edit")) {
            setCountryOptions(continent, country);
        }
    }

    if (country.length) {
        select2Focus(country);
        country.wrap('<div class="position-relative"></div>');
        country
            .select2({
                placeholder: "Select country",
                dropdownParent: country.parent(),
            })
            .on("change", function () {
                validation.revalidateField("country");
            });
    }

    var currency = $("#currency");

    if (currency.length) {
        select2Focus(currency);
        currency.wrap('<div class="position-relative"></div>');
        currency
            .select2({
                placeholder: "Select currency",
                dropdownParent: currency.parent(),
            })
            .on("change", function () {
                validation.revalidateField("currency");
            });
    }

    function setCountryOptions(continent, country) {
        $.getJSON(assetsPath + "json/countries.json", function (item) {
            $.each(item, function (key, value) {
                if (value.continent == continent.val()) {
                    if ($("#countryToSelect").val() != value.name) {
                        country.append(
                            '<option value="' +
                                value.name +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    } else {
                        country.append(
                            '<option selected value="' +
                                value.name +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    }
                }
            });
        });
    }
});
