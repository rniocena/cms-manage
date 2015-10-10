$(document).on('focus click', '#booking_date', function(e) {
    e.preventDefault();

    $('.date-picker').datepicker({
        orientation: "top auto",
        autoclose: true,
        startDate: "today",
        format: "dd M yyyy"
    });

    $('.date-range-picker').datepicker({
        orientation: "top auto",
        autoclose: true,
        format: "dd M yyyy"
    });

    $('.timepicker3').timepicker({
        minuteStep: 5,
        showInputs: false,
        disableFocus: true,
        defaultTime: "9:00 AM"
    })
});

$(document).on('click', '.updateStatus', function(e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('href'),
        type: 'GET',
        success: function (data, index) {

            var html = $(data);

            var modal = $('.generic');

            modal
                .find('.modal-content')
                .html(html)
            ;

            $('.btn-confirm-status').data('href', $('.updateStatus').attr('href'));

            modal.modal('show');

            console.log('status selected successfully');
        },
        error: function (jqXHR) {
            console.log("Failed to select status");
        }
    });
});