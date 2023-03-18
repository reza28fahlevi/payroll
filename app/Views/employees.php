<?= $this->include('header') ?>
    <h2 id="headers">Employees</h2>
    <button type="button" id="add" class="btn btn-sm btn-success float-right">Add +</button>
    <table id="employeeTable" class="table table-hover display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Departement</th>
                <th>Position</th>
                <th data-orderable="false">Function</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <?= $this->include('employee_modal') ?>
    <?= $this->include('footer') ?>
<script>
    var dataTables = $('#employeeTable').DataTable( {
            ajax: {
                url: '<?php echo base_url('api/employees') ?>',
                type: 'GET',
                dataSrc: 'employees'
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
                    "data" : 'employee_id',
                    render: function (data) {
                        return "<button type='button' class='btn btn-sm btn-secondary mx-1' onClick='edit(this)' data-id='"+ data +"'>Edit</button><button type='button' class='btn btn-sm btn-danger mx-1' onClick='deleteEmployee(this)' data-id='"+ data +"'>Delete</button>";
                    }
                },
            ]
        });
    $(document).ready(function(){
        
        $("#add").click(function(){
            $('#form1')[0].reset();
            $('#modalEmployee').modal('show');
        })
        
    })

    $('#form1').on('submit', function() {
        var employee_name = $('#employee_name').val();
        var employee_departement = $('#employee_departement').val();
        var employee_position = $('#employee_position').val();
        var employee_id = $('#employee_id').val();
        if(employee_id!=""){
            var url = "<?php echo base_url('api/employees/update/');?>" + employee_id
        }else{
            var url = "<?php echo base_url('api/employees');?>"
        }
        
        $.ajax({
                type: "POST",
                url: url,
                data: {
                    employee_name: employee_name,
                    employee_departement: employee_departement,
                    employee_position: employee_position
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
                        $("#modalEmployee").modal('hide');
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
        var employee_id = $(val).attr("data-id");
        
        $('#form1')[0].reset();        
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('api/employees/')?>' + employee_id,
            data: {"data":"employee"},
            success: function(data){
                console.log(data);
                $('#employee_id').val(data.employee_id);
                $('#employee_name').val(data.employee_name);
                $('#employee_departement').val(data.employee_departement);
                $('#employee_position').val(data.employee_position);
            }
        });
        $('#modalEmployee').modal('show');
    }

    function deleteEmployee(val){
        var employee_id = $(val).attr("data-id");
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
                        url: "<?php echo base_url('api/employees/')?>" + employee_id,
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