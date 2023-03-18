<?= $this->include('header') ?>
    <h2 id="headers">Employee Salary Report</h2>

    <form action="<?= base_url('payroll/report') ?>" name="form1" method="POST">
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
            <label for="year">Year Period</label>
            <select class="form-control" id="year" name="year">
                <option value="2022">2022</option>
                <option value="2023" selected>2023</option>
                <option value="2024">2024</option>
            </select>
        </div>
        <div class="form-group">
            <label for="period">Month Period</label>
            <select class="form-control" id="period" name="period">
                <option></option>
                <?php foreach($months as $key => $val){
                    ?>
                    <option value="<?= $key ?>"><?= $val ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>

    <?= $this->include('footer') ?>
<script>
</script>