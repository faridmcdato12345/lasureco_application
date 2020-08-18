<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{asset('js/app.js')}}"></script>
    </head>
    <body>
        <div class="position-ref full-height container pt-10">
            {{-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}
            <header>
                <div class="row">
                    <div class="col-lg-3 logo">
                    <img src="{{asset('images/logo.gif')}}" alt="lasureco logo">
                    </div>
                    <div class="col-lg-9 header">
                        <h3>LANAO DEL SUR ELECTRIC COOPERATIVE, INC.</h3>
                        <h4>Satellite Office, Provincial Capitol Complex, Marawi City 9700</h4>
                        <h5><a href="mailto:teamlasureco@ymail.com">teamlasureco@ymail.com</a></h5>
                    </div>
                </div>
                
                
            </header>
            <div class="note">
                <h3>LASURECO ONLINE APPLICATION FOR MEMBERSHIP</h3>
                <p>The undersigned, herein after called the "APPLICANT" hereby applies for membership in the Lanao Del Sur Electric Cooperative, Inc. hereinafter referred to as the "COOPERATIVE", and in consideration for acceptance of this application do hereby state the following:</p>
                <span class="required-note">* Required</span>
            </div>
            <div class="content wrapper">
                <div>
                    {!! Form::open(['method'=>'POST','action'=>'ApplicantController@store','files'=>true]) !!}
                    {{-- <div class="form-group">
                        <h3>Name of the Applicant:</h3>
                    </div> --}}
                    <div class="form-group">
                        {!! Form::label('first_name','First Name:') !!}<span class="required-note">*</span>
                        {!! Form::text('first_name',null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('middle_name','Middle Name:') !!}<span>( Optional )</span>
                        {!! Form::text('middle_name',null,['class'=>'form-control']) !!}
                        {{--{{ Form::hidden('type_id', '2') }}--}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('family_name','Family Name / Surname:') !!}<span class="required-note">*</span>
                        {!! Form::text('last_name',null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('house_number','House Number:') !!}<span>( Optional )</span>
                        {!! Form::text('house_number',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('street','Street:') !!}<span class="required-note">*</span>
                        {!! Form::text('street',null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('barangay','Barangay:') !!}<span class="required-note">*</span>
                        {!! Form::text('barangay',null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('city','City / Municipality:') !!}<span class="required-note">*</span>
                        {!! Form::text('city',null,['class'=>'form-control','required']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('file','Upload Applicant Photo:') !!}<span class="required-note">*</span>
                        {!! Form::file('photo_id',['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('file','Upload House Perspective:') !!}<span class="required-note">*</span>
                        {!! Form::file('house_id',['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('dob','Date of Birth: (For Applicant)') !!}<span class="required-note">*</span>
                        {!! Form::date('dob_applicant',\Carbon\Carbon::now(),['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('dop','Place of Birth: (For Applicant)') !!}<span class="required-note">*</span>
                        {!! Form::text('dop_applicant',null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('civil_status','Civil Status:') !!}<span class="required-note">*</span>
                        {!! Form::select('civil_status',[''=>'Choose option','single'=>'Single','married'=>'Married','divorce'=>'Divorced','widow'=>'Widow','single-parent'=>'Single Parent'],null,['class'=>'form-control civil_status','required']) !!}
                    </div>
                    <div class="spouse-div" style="display:none;">
                        <div class="form-group">
                            {!! Form::label('spouse','Name of Spouse:') !!}
                            {!! Form::text('name_of_spouse',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('dob','Date of Birth: (For Spouse)') !!}
                            {!! Form::date('dob_spouse',\Carbon\Carbon::now(),['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('dop','Place of Birth: (For Spouse)') !!}
                            {!! Form::text('dop_spouse',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('contact_number','Contact Number:') !!}<span class="required-note">*</span>
                        {!! Form::text('contact_number',null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email','Email Address:') !!} <span>( Optional )</span>
                        {!! Form::email('email',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('type_of_consumer','Type of Consumer:') !!}<span class="required-note">*</span>
                        {!! Form::select('type_of_consumer',[''=>'Choose option','residential'=>'Residential','commercial'=>'Commercial','industrial'=>'Industrial','public-building'=>'Public Building','street-light'=>'Street Light','water-system'=>'Water System'],null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('proprietorship','Proprietorship:') !!}<span class="required-note">*</span>
                        {!! Form::select('proprietorship',[''=>'Choose option','house-owner'=>'House Owner','tenant'=>'Tenant'],null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('classification_of_consumer','Classification of Consumer:') !!}<span class="required-note">*</span>
                        {!! Form::select('classification_of_consumer',[''=>'Choose option','individual'=>'Individual','joint'=>'Joint','juridical'=>'Juridical'],null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Submit',['class'=>'form-control btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).on('change', '.civil_status', function() {
            console.log($(this).val()); // the selected options’s value
            if($(this).val() == 'married'){
                $('.spouse-div').toggle('slow');
            }
            else{
                $('.spouse-div').hide('slow')
                
            }
            // if you want to do stuff based on the OPTION element:
            // var opt = $(this).find('option:selected')[0];
            // use switch or if/else etc.
        });
    </script>
</html>
