<?= $this->include('header') ?>
    <h2 id="headers">Employees</h2>
    <button type="button" id="add" class="btn btn-sm btn-success float-right">Add +</button>
    <table id="employeeTable" class="table table-hover display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Departement</th>
                <th>Position</th>
                <th>Date Presence</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th data-orderable="false">Function</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <?= $this->include('Attendance/attendance_modal') ?>
    <?= $this->include('footer') ?>
<script>
    var dataTables = $('#employeeTable').DataTable( {
            ajax: {
                url: '<?php echo base_url('api/attendance') ?>',
                type: 'GET',
                dataSrc: 'attendances'
            },
            "columns": [
                { 
                    "target" : [0],
                    "data" : 'employee_name'
                },
                { 
                    "target" : [1],
                    "data" : 'employee_departement'
                },
                { 
                    "target" : [2],
                    "data" : 'employee_position'
                },
                { 
                    "target" : [3],
                    "data" : 'date'
                },
                { 
                    "target" : [4],
                    "data" : 'time_in'
                },
                { 
                    "target" : [5],
                    "data" : 'time_out'
                },
                { 
                    "target" : [6],
                    "data" : 'attendance_id',
                    render: function (data) {
                        return "<button type='button' class='btn btn-sm btn-secondary mx-1' onClick='edit(this)' data-id='"+ data +"'>Edit</button><button type='button' class='btn btn-sm btn-danger mx-1' onClick='deleteAttendance(this)' data-id='"+ data +"'>Delete</button>";
                    }
                },
            ]
        });
    $(document).ready(function(){
        
        $("#add").click(function(){
            $('#form1')[0].reset();
            $('#modalAttendance').modal('show');
        })
        
    })

    $('#form1').on('submit', function() {
        var employee_id = $('#employee_id').val();
        var date = $('#date').val();
        var time_in = $('#time_in').val();
        var time_out = $('#time_out').val();
        var attendance_id = $('#attendance_id').val();
        if(attendance_id!=""){
            var url = "<?php echo base_url('api/attendance/update/');?>" + attendance_id
        }else{
            var url = "<?php echo base_url('api/attendance');?>"
        }
        
        $.ajax({
                type: "POST",
                url: url,
                data: {
                    employee_id: employee_id,
                    date: date,
                    time_in: time_in,
                    time_out: time_out,
                },
                success: function(responses) {
                    if(responses.status==200)
                    {
                        Swal.fire({
                            title: 'Success',
                            text: responses.messages.success,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        })
                        $("#modalAttendance").modal('hide');
                        dataTables.ajax.reload();
                    }
                    else
                    {
                        alert('Server error');
                    }
                }
            });
            
        return false;
    });
    
    function edit(val){
        var attendance_id = $(val).attr("data-id");
        
        $('#form1')[0].reset();        
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('api/attendance/')?>' + attendance_id,
            data: {"data":"employee"},
            success: function(data){
                console.log(data);
                $('#attendance_id').val(data.attendance_id);
                $('#employee_id').val(data.employee_id);
                $('#date').val(data.date);
                $('#time_in').val(data.time_in);
                $('#time_out').val(data.time_out);
            }
        });
        $('#modalAttendance').modal('show');
    }

    function deleteAttendance(val){
        var attendance_id = $(val).attr("data-id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo base_url('api/attendance/')?>" + attendance_id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result.messages.success){
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                dataTables.ajax.reload();
                            }
                        }
                    });
                }
            })
        
    }
</script>