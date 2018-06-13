@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-8">
            <div class="jumbotron">
              <h1 class="display-4">Hello, world!</h1>
              <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
              <hr class="my-4">
              <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
              <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="userlogin">
                        @csrf

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
        

        <a href="meeting">
            <button type="submit" class="btn btn-primary">
                {{ __('Go to Meeting') }}
            </button>  
        </a>
              
    </div>
</div>
@endsection
