$(function() {
    $(".code-form button").click(function() {
        if ($("#input-code").val() !== "") {
            $.ajax({
                url: "/api/checkcode",
                type: "post",
                data: {code: $("#input-code").val().toUpperCase()}
            }).done(function(data) {
                response = $.parseJSON(data);
                if (response.state === true) {
                    $("#vote-id-item").val(response.infos.item_id);
                    $("#vote-code").val(response.infos.code);
                    $("#vote-placename").html(response.infos.item_name);
                    $(".code-form").slideUp();
                    $(".vote-form").slideDown();
                }
                else {
                    $(".code-form div").addClass("has-warning");
                    var error = $.i18n.t("vote.code_form." + response.error); // get the translated error message with i18n
                    $(".code-error").html(error);
                }
            });
        }
    });

    $('.vote-form form').validate({
        errorClass: "text-danger",
        focusInvalid: false,
        onkeyup: false,
        onclick: false,
        onfocusout: false,
        errorPlacement: function(error, element) {
            error.appendTo(element.parent().parent().parent().find("div.error"));
        },
        rules: {
            vote_email: {
                required: true,
                email: true
            },
            vote_grade_cleanliness: {
                required: true
            },
            vote_grade_confort: {
                required: true
            },
            vote_grade_location: {
                required: true
            },
            vote_grade_services: {
                required: true
            },
            vote_grade_personal: {
                required: true
            },
            vote_grade_pqratio: {
                required: true
            }
        },
        messages: {
            vote_email: {
                required: "Email is required",
                email: "Your email is not a valid email"
            },
            vote_grade_cleanliness: "Please select a grade",
            vote_grade_confort: "Please select a grade",
            vote_grade_location: "Please select a grade",
            vote_grade_services: "Please select a grade",
            vote_grade_personal: "Please select a grade",
            vote_grade_pqratio: "Please select a grade"
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
