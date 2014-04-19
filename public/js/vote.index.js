$(function(){	
	$(".code-form button").click(function() {
		if ($("#input-code").val() !== "") {
			$.ajax({
				url: "/api/checkcode",
				type: "post",
				data : { code : $("#input-code").val().toUpperCase()}
			}).done(function(data) {
				response = $.parseJSON(data);
				if (response.state === true) {
					$("#vote-id-item").val(response.infos.id_item);		
					$("#vote-code").val(response.infos.code);
					$("#vote-placename").html(response.infos.item_name);	
					$(".code-form").slideUp();					
					$(".vote-form").slideDown();
				}
				else {
					console.log(response.message);
					$(".code-form div").addClass("has-warning");
					$(".code-error").html(response.message);
				}
			});			
		}
	});
	
	
	$('.vote-form form').validate({
		errorClass: "text-danger",
		focusInvalid:false,
		onkeyup:false,
		onclick:false,
		onfocusout:false,
		errorPlacement: function(error, element) {
			error.appendTo( element.parent().parent().parent().find("div.error") );
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
			vote_email : {
				required 			: "You have to put your email",
				email				: "Your email is not a valid email"
			},
			vote_grade_cleanliness 	: "Debe seleccionar una nota",
			vote_grade_confort 		: "Debe seleccionar una nota",
			vote_grade_location 	: "Debe seleccionar una nota",
			vote_grade_services 	: "Debe seleccionar una nota",
			vote_grade_personal 	: "Debe seleccionar una nota",
			vote_grade_pqratio 		: "Debe seleccionar una nota"
		},
		submitHandler: function(form) {
			console.log("submit OK");
			form.submit();
		},
		invalidHandler : function() {
			console.log("submit KO");
		}
	});		
});
