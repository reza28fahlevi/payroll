<div class="modal fade" id="modalShift" tabindex="-1" role="dialog" aria-labelledby="modalShift" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitle">Shift Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" name="form1" id="form1">
            <div class="modal-body">
                <input type="hidden" id="shift_id" name="shift_id" value="">
                <div class="form-group">
                    <label for="shift_name">Shift Name</label>
                    <input type="text" class="form-control" id="shift_name" name="shift_name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="shift_day_start">Start Day</label>
                    <select class="form-control" id="shift_day_start" name="shift_day_start" aria-label="Default select example"></select>
                </div>
                <div class="form-group">
                    <label for="shift_day_end">End Day</label>                    
                    <select class="form-control" id="shift_day_end" name="shift_day_end" aria-label="Default select example"></select>
                </div>
                <div class="form-group">
                    <label for="time_in">Time In</label>
                    <input type="text" class="form-control" id="time_in" name="time_in" placeholder="HH:mm:ss">
                </div>
                <div class="form-group">
                    <label for="time_out">Time Out</label>
                    <input type="text" class="form-control" id="time_out" name="time_out" placeholder="HH:mm:ss">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>