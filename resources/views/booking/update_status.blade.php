
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="updateStatusModalLabel">Update Booking Status</h3>
    </div>
    <div class="modal-body">
        <h3>{{$booking->first_name}} {{$booking->last_name}}</h3>

        New Status: <strong style="text-transform: uppercase">{{$status}}</strong>

        <br>
        Are these details correct?

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary btn-confirm-status">Save changes</button>
    </div>