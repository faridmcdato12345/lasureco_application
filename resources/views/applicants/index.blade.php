@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Applicants</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Applicants</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-12 -->
        <div class="col-lg-12">
            <div class="row input-daterange p-3">
                <div class="col-md-4">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                </div>
                <div class="col-md-4">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                    
                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                </div>
            </div>
            <table class="table table-bordered data-table" id="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>MIDDLE NAME</th>
                        <th>LAST NAME</th>
                        <th>APPLIED ON</th>
                        <th width="280px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
@endsection
@section('modal')
<div class="modal-dialog">
    <div class="modal-content" style="background-color:#343a40;color:#ffffff;">
        <div class="modal-header">
            <h4 class="modal-title" id="modelHeading">ADD MATERIAL</h4>
        </div>
        <div class="modal-body">
            <form id="materialRequest" name="materialRequest" class="form-horizontal">
                <input type="hidden" name="material_id" id="material_id">
                <div class="form-group">
                    <label for="name" class="control-label">Item Code Number</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="code_number" name="code_number" placeholder="Enter Material Name" value="" readonly maxlength="50" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <div class="col-sm-offset-2">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Material Name" value="" maxlength="50" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="control-label">Quantity</label>
                    <div class="col-sm-offset-2">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" value="" maxlength="50" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="control-label"> Requested Quantity</label>
                    <div class="col-sm-offset-2">
                        <input type="number" class="form-control" autofocus id="req_quantity" name="req_quantity" placeholder="Enter Requested Quantity" value="" maxlength="50" required>
                    </div>
                </div>
                <div class="col-sm-offset-2 form-group">
                    <button type="submit" class="btn btn-success form-control submitBttn" id="saveMaterial" value="create">Save
                    </button>
                </div>
            </form>
            <button class="btn btn-primary form-control saveToVoucher" style="display:none;">Add to Voucher</button>
        </div>
    </div>
</div>
@endsection
@section('check')
<div class="modal fade" id="checkApplicant" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:#343a40;color:#ffffff;">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">APPLICANT</h4>
            </div>
            <div class="modal-body">
                <form id="materialRequest" name="materialRequest" class="form-horizontal">
                    <input type="hidden" name="material_id" id="material_id">
                    <div class="form-group">
                        <label for="applicant_classification" class="control-label">Applicant Photo:</label>
                        <div class="col-sm-offset-2">
                            <img alt="applicant photo" class="applicant_photo" style="width:150px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Name:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_name"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Address</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_address"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Date of Birth:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_dob"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Place of Birth:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_dop"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="civil_status" class="control-label">Civil Status:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_civil_status"></p>
                        </div>
                    </div>
                    <div class="spouse_info" style="display: none;">
                        <div class="form-group">
                            <label for="applicant_spouse" class="control-label">Spouse Name:</label>
                            <div class="col-sm-offset-2">
                                <p class="applicant_spouse"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="applicant_spouse" class="control-label">Spouse Date of Birth:</label>
                            <div class="col-sm-offset-2">
                                <p class="applicant_spouse_dob"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="applicant_spouse" class="control-label">Spouse Place of Birth:</label>
                            <div class="col-sm-offset-2">
                                <p class="applicant_spouse_dop"></p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="applicant_contact" class="control-label">Contact Number:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_contact_number"></p>
                        </div>
                    </div>
                    <div class="form-group email">
                        <label for="applicant_email" class="control-label">Email Address:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_email_address"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="applicant_type_of_consumer" class="control-label">Type of Consumer:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_type_of_consumer"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="applicant_proprietorship" class="control-label">Proprietorship:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_proprietorship"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="applicant_classification" class="control-label">Classification of Consumer:</label>
                        <div class="col-sm-offset-2">
                            <p class="applicant_classification"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="applicant_house" class="control-label">Applicant House Perspective:</label>
                        <div class="col-sm-offset-2">
                            <img alt="applicant house" class="applicant_house" style="width:150px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!----script--->
<script>
    $(document).ready(function() {
        generateVoucherCode()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });
        function generateVoucherCode(){
            let theDate = new Date()
            let voucherCode = "" + theDate.getFullYear()+(theDate.getMonth() + 1)+theDate.getDate()+theDate.getHours()+theDate.getMinutes()+theDate.getSeconds()
            $('.voucher-number').html('BL-'+ voucherCode)
        }
        load_data();
        function load_data(from_date = '', to_date = ''){
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url:"{{ route('application.index') }}",
                    data: {from_date:from_date,to_date:to_date} 
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'middle_name', name: 'middle_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'created_at',name:'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: true},
                ],
                "columnDefs": [
                    {
                        // The `data` parameter refers to the data for the cell (defined by the
                        // `data` option, which defaults to the column being worked with, in
                        // this case `data: 0`.
                        "render": function ( data, type, row ) {
                            return data +' '+ row['middle_name']+'' +' '+ row['last_name']+'' ;
                        },
                        "targets": 1
                    },
                    { "visible": false,  "targets": [ 2,3 ] }
                ]
            });
        }
        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
                $('#data-table').DataTable().destroy();
                load_data(from_date, to_date);
            }
            else
            {
                alert('Both Date is required');
            }
        });
        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#data-table').DataTable().destroy();
            load_data();
        });
        $('body').on('click','.checkApplicant',function(){
            var u = $(this).data('id');
            var urlGet = "{{route('application.show',':id')}}";
            urlGet = urlGet.replace(':id',u);
            $.ajax({
                url: urlGet,
                type: "GET",
                success: function(data){
                    let fullname = data.first_name + " " + data.middle_name + " " + data.last_name;
                    let fulladdress = data.house_number + " " + data.street + ", " + data.barangay + ", " + data.city; 
                    $('.applicant_name').html(fullname.toUpperCase())
                    $('.applicant_address').html(fulladdress.toUpperCase());
                    $('.applicant_civil_status').html(data.civil_status.toUpperCase())
                    if(data.civil_status == "married"){
                        $('.applicant_spouse').html(data.name_of_spouse.toUpperCase())
                        $('.applicant_spouse_dob').html(data.dob_spouse.toUpperCase())
                        $('.applicant_spouse_dop').html(data.dop_spouse.toUpperCase())
                        $('.spouse_info').css('display','block')
                    }
                    $('.applicant_dob').html(data.dob_applicant.toUpperCase())
                    $('.applicant_dop').html(data.dop_applicant.toUpperCase())
                    $('.applicant_contact_number').html(data.contact_number.toUpperCase())
                    $('.applicant_email').html(data.email)
                    $('.applicant_type_of_consumer').html(data.type_of_consumer.toUpperCase())
                    $('.applicant_proprietorship').html(data.proprietorship.toUpperCase())
                    $('.applicant_classification').html(data.classification_of_consumer.toUpperCase())
                    $('.applicant_photo').attr('src',data.photo.path)
                    $('.applicant_house').attr('src',data.house.path)
                    $('#checkApplicant').modal("show");
                    
                }
            });
        });
        $('body').on('click','.inspectionApplicant',function () {
        var u = $(this).data('id');
        var urlUpdate = "{{route('applicant.forinspection',':id')}}";
        urlUpdate = urlUpdate.replace(':id',u);
        $(this).html('Updating..');
        $.ajax({
            url: urlUpdate,
            type: "PATCH",
            dataType: 'json',
            success: function (data) {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#data-table').DataTable().destroy();
                load_data();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#updateBtn').html('User Updated');
            }
        });
      });
      $('body').on('click','.declineApplicant',function () {
        var u = $(this).data('id');
        var urlUpdate = "{{route('applicant.decline',':id')}}";
        urlUpdate = urlUpdate.replace(':id',u);
        $(this).html('Updating..');
    
            $.ajax({
            url: urlUpdate,
            type: "PATCH",
            dataType: 'json',
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#updateBtn').html('User Updated');
            }
        });
      });
    });
</script>
@endsection
