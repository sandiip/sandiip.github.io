/**
 * Created by Sandeep on 8/30/2017.
 */
(function($) {
    "use strict";

    jQuery(document).ready(function(){

        $('#cform').submit(function(e){

            e.preventDefault();
            var $form = $(this);
            var action = $(this).attr('action');

            $("#message").slideUp(750,function() {
                $('#message').hide();

                $('#submit')
                    .before('<img src="img/ajax-loader.gif" class="contact-loader" />')
                    .attr('disabled','disabled');


                var data = {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    comments: document.getElementById('comments').value
                };

                //name = $.trim($form.find('input[name="name"]').val()),

                jQuery.ajax({
                    type: "POST",
                    url: "https://formspree.io/sandeep.panwar0094@gmail.com",
                    data: $form.serialize(),
                    dataType: "json",
                    success: function (data) {
                        document.getElementById('message').innerHTML = 'Email Sent !!';
                        $('#message').slideDown('slow');
                        $('#cform img.contact-loader').fadeOut('slow', function () {
                            $(this).remove()
                        });
                        $('#submit').removeAttr('disabled');
                        $('#cform')[0].reset();
                    },
                    error: function () {
                        document.getElementById('message').innerHTML = 'There is some problem,may be you did not fill all details correct or some other issu. please try again !!';
                    }
                });

                // $.ajax({
                // 	method: 'POST',
                // 	url: 'http://formspree.io/akshat2@gmail.com/',
                // 	dataType: 'json',
                // 	data: data,
                // 	headers: {
                // 		'Accept': 'application/json',
                // 		'Content-Type': 'application/x-www-form-urlencoded'
                // 	},
                //
                // 	beforeSend: function() {
                // 	},
                // 	success: function(data) {
                // 		document.getElementById('message').innerHTML = 'Email Sent !!';
                // 		$('#message').slideDown('slow');
                // 		$('#cform img.contact-loader').fadeOut('slow', function () {
                // 			$(this).remove()
                // 		});
                // 		$('#submit').removeAttr('disabled');
                // 		$('#cform')[0].reset();
                //
                // 	},
                // 	error: function(err) {
                // 		document.getElementById('message').innerHTML = 'There is some problem, please try again !!';
                // 	}
                // });



            });

            return false;

        });

    });

}(jQuery));
