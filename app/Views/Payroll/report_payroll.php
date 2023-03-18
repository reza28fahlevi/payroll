<?= $this->include('header') ?>
    <h2 id="headers">Employee Salary Report</h2>
        <table>
            <tr>
                <td>Name</td>
                <td>: <?= $detail_employee->employee_name ?></td>
            </tr>
            <tr>
                <td>Departement</td>
                <td>: <?= $detail_employee->employee_departement ?></td>
            </tr>
            <tr>
                <td>Position</td>
                <td>: <?= $detail_employee->employee_position ?></td>
            </tr>
        </table>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Total Working Days</th>
                <th scope="col">Total Presence</th>
                <th scope="col">Total Not Present</th>
                <th scope="col">Total Late</th>
                <th scope="col">Basic Salary</th>
                <th scope="col">Your Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th><?= $total_working_days ?></th>
                <td><?= $total_presence ?></td>
                <td><?= ($total_working_days-$total_presence) ?></td>
                <td><?= $total_late ?></td>
                <td>Rp. <?= number_format(($detail_employee->salary/100), 2); ?></td>
                <td>Rp. <?= number_format(($total_salary/100), 2); ?></td>
                </tr>
            </tbody>
        </table>
    <?= $this->include('footer') ?>
<script>
</script>