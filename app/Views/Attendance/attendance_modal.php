<div class="modal fade" id="modalAttendance" tabindex="-1" role="dialog" aria-labelledby="modalAttendance" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitle">Attendance Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" name="form1" id="form1">
            <div class="modal-body">
                <input type="hidden" id="attendance_id" name="attendance_id" value="">
                <div class="form-group">
                    <label for="employee_id">Employee Name</label>
                    <select class="form-control" id="employee_id" name="employee_id">\
                        <option></option>
                        <?php foreach($employeeData as $employee){
                            ?>
                            <option value="<?= $employee->employee_id ?>"><?= $employee->employee_name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Presence Date</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="dd/mm/yyyy">
                </div>
                <div class="form-group">
                    <label for="time_in">Time In</label>
                    <input type="time" class="form-control" id="time_in" name="time_in" placeholder="HH:mm:ss">
                </div>
                <div class="form-group">
                    <label for="time_out">Time Out</label>
                    <input type="time" class="form-control" id="time_out" name="time_out" placeholder="HH:mm:ss">
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