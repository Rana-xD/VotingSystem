@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-8">
            <div class="jumbotron landingPage bg-white">
                <h1>Log into the Company Meeting</h1>
                <hr class="py-4">
                <div class="text-center">
                    <p class="text-body">
                        To use ShareHolderVote.com.au you will need to login with the following details which are 
                        located on the front page of your proxy form.
                    </p>
                    <p>SRN or HIN</p>
                    <p>Meeting ID</p>
                    <p>Pin Number</p>

                    <p>
                        Once you have entered those details in the login area, please click on the LOGIN button and 
                        you will begin the process of voting in the meeting. If you experience any problems with the login process, please contact us at

                        <a href="">
                            <span class="quote text-weight-light text-primary">info@shareholdervote.com.au</span>
                        </a>

                        or on 1800 799 085 quoting your name, address and the details above and one of our client services team will contact you.
                    </p>
                    <p>For more information regarding the login details, refer to the table below.</p>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Definition</th>
                        <th scope="col">Meaning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">SRN</th>
                            <td>Your Security Reference Number (Issuer Sponsored)</td>
                        </tr>
                        <tr>
                            <th scope="row">HIN</th>
                            <td>Your Holder Identification Number (Chess Sponsored)</td>
                        </tr>
                        <tr>
                            <th scope="row">Meeting ID</th>
                            <td>The meeting identifier for the current meeting.</td>
                        </tr>
                        <tr>
                            <th scope="row">PIN Number</th>
                            <td>This is unique to each shareholder for the current meeting.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="userlogin">
                        @csrf
                        <input type="hidden" name="current_date">
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('HIN/SRN') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="meetingid" class="col-md-4 col-form-label text-md-right">{{ __('MeetingID') }}</label>

                            <div class="col-md-6">
                                <input id="meetingid" type="meetingid" class="form-control{{ $errors->has('meetingid') ? ' is-invalid' : '' }}" name="meetingid">

                                @if ($errors->has('meetingid'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('meetingid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('PIN Number') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
              
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="{{ asset('js/libraries.js') }}" ></script>
<script>
jQuery(document).ready(function(e){
    var date = Math.floor(new Date().getTime() / 1000);
    console.log(date)
    $('input[name=current_date]').val(date);

    var status = <?= $status ?>;
    switch(status.code){
        case 0:
            swal('Oop!', status.message, 'error', {
	 			button: false
             });
        break;
        default:
        break;
       
    }
});
</script>
