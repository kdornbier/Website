<<<<<<< HEAD
// JS Contact Form
// https://bootstraptemple.com/p/how-to-build-a-working-bootstrap-contact-form

=======
>>>>>>> f28d7fb1b51076f308fbcd81e4be9172b63882e4
$(function () {

    $('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
<<<<<<< HEAD
            var url = "js/contact.php";
            $("#messages").html("<div style=\"padding-bottom:20px\" ><i class=\"fa fa-circle-o-notch fa-spin fa-3x fa-fw\"></i></div>");
            
=======
            var url = "contact.php";

>>>>>>> f28d7fb1b51076f308fbcd81e4be9172b63882e4
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                    }
                }
            });
            return false;
        }
    })
});