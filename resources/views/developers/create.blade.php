@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Account</div>

                    <div class="panel-body">


                        <form class="form-horizontal" method="POST" action="{{ route('accounts.store') }}">
                            {!! csrf_field() !!}

                            <div class="form-group" {{ $errors->has('name') ? 'has-error' : '' }}>
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-5">
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" {{ $errors->has('alias') ? 'has-error' : '' }}>
                                <label for="alias" class="col-sm-2 control-label">Alias</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="alias" placeholder="Alias" name="alias" value="{{ old('alias') }}">
                                        <span class="input-group-addon">&commat;{{ env('MAILGUN_DOMAIN') }}</span>
                                    </div>
                                    @if ($errors->has('alias'))
                                        <span class="help-block">{{ $errors->first('alias') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-success" type="submit">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection