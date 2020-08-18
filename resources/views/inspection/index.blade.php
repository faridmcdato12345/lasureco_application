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
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>MIDDLE NAME</th>
                        <th>LAST NAME</th>
                        <th>ADDRESS</th>
                        <th>STREET</th>
                        <th>BARANGAY</th>
                        <th>CITY</th>
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
        function generateVoucherCode(){
            let theDate = new Date()
            let voucherCode = "" + theDate.getFullYear()+(theDate.getMonth() + 1)+theDate.getDate()+theDate.getHours()+theDate.getMinutes()+theDate.getSeconds()
            $('.voucher-number').html('BL-'+ voucherCode)
        }
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inspection.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'middle_name', name: 'middle_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'house_number', name: 'house_number'},
                {data: 'street', name: 'street'},
                {data: 'barangay', name: 'barangay'},
                {data: 'city', name: 'city'},
                {data: 'created_at',name:'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: true},
            ],
            "columnDefs": [
                {
                    "render": function ( data, type, row ) {
                        return data != null ? data +' '+ row['middle_name']+'' +' '+ row['last_name']+'':data +' '+ row['last_name']+'' ;
                    },
                    "targets": 1,
                },
                {
                    "render": function ( data, type, row ) {
                        return data != null ? data +', '+ row['street']+'' +', '+ row['barangay']+'' +', '+ row['city']+'':' '+ row['street']+'' +', '+ row['barangay']+'' +', '+ row['city']+'' ;
                    },
                    "targets": 4,
                },
                { "visible": false,  "targets": [ 2,3,5,6,7 ] }
            ]
        });
        $('body').on('click','.applicantPaid',function () {
            var u = $(this).data('id');
            var urlUpdate = "{{route('applicant.paid',':id')}}";
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
