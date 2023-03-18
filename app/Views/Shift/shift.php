<?= $this->include('header') ?>
    <h2 id="headers">Employees</h2>
    <button type="button" id="add" class="btn btn-sm btn-success float-right">Add +</button>
    <table id="shiftTable" class="table table-hover display" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Start Day</th>
                <th>End Day</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th data-orderable="false">Function</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <?= $this->include('Shift/shift_modal') ?>
    <?= $this->include('footer') ?>
<script>
    var dataTables = $('#shiftTable').DataTable( {
            ajax: {
                url: '<?php echo base_url('api/shift') ?>',
                type: 'GET',
                dataSrc: 'shifts'
            },
            "columns": [
                { 
                    "target" : [0],
                    "data" : 'shift_name'
                },
                { 
                    "target" : [1],
                    "data" : 'shift_day_start'
                },
                { 
                    "target" : [2],
                    "data" : 'shift_day_end'
                },
                { 
                    "target" : [3],
                    "data" : 'time_in'
                },
                { 
                    "target" : [4],
                    "data" : 'time_out'
                },
                { 
                    "target" : [5],
                    "data" : 'shift_id',
                    render: function (data) {
                        return "<button type='button' class='btn btn-sm btn-secondary mx-1' onClick='edit(this)' data-id='"+ data +"'>Edit</button><button type='button' class='btn btn-sm btn-danger mx-1' onClick='deleteEmployee(this)' data-id='"+ data +"'>Delete</button>";
                    }
                },
            ]
        });
    $(document).ready(function(){

        var days =
            { 
                "1": "Monday",
                "2": "Tuesday",
                "3": "Wednesday",
                "4": "Thursday",
                "5": "Friday",
                "6": "Saturday",
                "7": "Sunday",
            };

        $.each(days, function(key, value) {   
            $('#shift_day_start')
                .append($("<option></option>")
                            .attr("value", key)
                            .text(value)); 
        });

        $.each(days, function(key, value) {   
            $('#shift_day_end')
                .append($("<option></option>")
                            .attr("value", key)
                            .text(value)); 
        });
        
        $("#add").click(function(){
            $('#form1')[0].reset();
            $('#modalShift').modal('show');
        })
        
    })

    $('#form1').on('submit', function() {
        var shift_name = $('#shift_name').val();
        var shift_day_start = $('#shift_day_start').val();
        var shift_day_end = $('#shift_day_end').val();
        var time_in = $('#time_in').val();
        var time_out = $('#time_out').val();
        var shift_id = $('#shift_id').val();
        if(shift_id!=""){
            var url = "<?php echo base_url('api/shift/update/');?>" + shift_id
        }else{
            var url = "<?php echo base_url('api/shift');?>"
        }
        
        $.ajax({
                type: "POST",
                url: url,
                data: {
                    shift_name: shift_name,
                    shift_day_start: shift_day_start,
                    shift_day_end: shift_day_end,
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
                        $("#modalShift").modal('hide');
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
        var shift_id = $(val).attr("data-id");
        
        $('#form1')[0].reset();        
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('api/shift/')?>' + shift_id,
            data: {"data":"shifts"},
            success: function(data){
                console.log(data);
                $('#shift_id').val(data.shift_id);
                $('#shift_name').val(data.shift_name);
                $('#shift_day_start').val(data.shift_day_start);
                $('#shift_day_end').val(data.shift_day_end);
                $('#time_in').val(data.time_in);
                $('#time_out').val(data.time_out);
            }
        });
        $('#modalShift').modal('show');
    }

    function deleteEmployee(val){
        var shift_id = $(val).attr("data-id");
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
                        url: "<?php echo base_url('api/shift/')?>" + shift_id,
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