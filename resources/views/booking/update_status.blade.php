
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="updateStatusModalLabel">Update Booking Status</h3>
    </div>
    <div class="modal-body">
        <h3>{{$booking->first_name}} {{$booking->last_name}}</h3>

        New Status: <strong style="text-transform: uppercase">{{$status}}</strong>

        <br>

        @if($status == 'completed')

            <span style="display: none" class="text-danger bookingError">Booking date and time required.</span>
            <br>

            <label for="booking_date">Booking Date: </label>
            <input type="text" class="span2 date-picker" id="booking_date" name="booking_date">

            <label for="booking_time">Booking Time: </label>
            <input type="text" class="span2 timepicker3" id="booking_time" name="booking_time">

            <br>
        @endif

        <br>
        Are these details correct?

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary btn-confirm-status">Save changes</button>
    </div>

    <script>
        $(document).on('click', '.btn-confirm-status', function(e) {
            e.preventDefault();

            var href = $(this).data('href');
            var booking_date = $('#booking_date').val();
            var booking_time = $('#booking_time').val();

            var status = '{{$status}}';

            if(!(booking_date && booking_time) && status == 'completed') {
                $('.bookingError').show();
            } else {
                $('.bookingError').hide();

                $.ajax({
                    url: href,
                    type: 'POST',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        booking_date: booking_date,
                        booking_time: booking_time
                    },
                    success: function (data, index) {
                        window.location.reload();
                        console.log('Status Changed');
                    },
                    error: function (jqXHR) {
                        console.log("Failed to change status");
                    }
                });
            }
        });
    </script>