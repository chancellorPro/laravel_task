@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/profile_avatar" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @if (file_exists(public_path() . '/avatars/' . $user->avatar))
                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Avatar</label>
                                    <img id="avatar" class="col-md-6" src="/avatars/{{ $user->avatar }}">
                            </div>
                            @endif

                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">

                                <label class="col-md-4 control-label">
                                    @if (!file_exists(public_path() . '/avatars/' . $user->avatar))
                                        Avatar
                                    @endif
                                </label>

                                <div class="col-md-6">
                                    <input
                                            @if (file_exists(public_path() . '/avatars/' . $user->avatar))
                                                style="display: none"
                                            @endif
                                            type="file" class="form-control-file" name="avatar" id="avatarFile"
                                           aria-describedby="fileHelp" onchange="this.form.submit()">
                                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file.
                                        Size of image should not be more than 2MB.
                                    </small>
                                </div>
                            </div>

                        </form>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">User name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') ? old('name') : $user->name }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{ old('phone') ? old('phone') : $user->phone }}">

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_extra')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $("#phone").mask("+(999) 999-9999");

            $("#avatar").on("click", function () {
                $('input[type="file"]').click();
            });
        });
    </script>
@endsection
