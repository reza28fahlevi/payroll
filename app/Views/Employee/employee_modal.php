<div class="modal fade" id="modalEmployee" tabindex="-1" role="dialog" aria-labelledby="modalEmployee" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitle">Employee Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" name="form1" id="form1">
            <div class="modal-body">
                <input type="hidden" id="employee_id" name="employee_id" value="">
                <div class="form-group">
                    <label for="employee_name">Employee Name</label>
                    <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="employee_departement">Employee Departement</label>
                    <input type="text" class="form-control" id="employee_departement" name="employee_departement" placeholder="Departement">
                </div>
                <div class="form-group">
                    <label for="employee_position">Employee Position</label>
                    <input type="text" class="form-control" id="employee_position" name="employee_position" placeholder="Position">
                </div>
                <div class="form-group">
                    <label for="shift_id">Employee Shift</label>
                    <select class="form-control" id="shift_id" name="shift_id">\
                        <option></option>
                        <?php foreach($shifts as $shift){
                            ?>
                            <option value="<?= $shift->shift_id ?>"><?= $shift->shift_name ?></option>
                            <?php
                        }
                        ?>
                    </select>
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