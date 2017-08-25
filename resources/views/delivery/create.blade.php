@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('delivery.send') }}">
                            {!! csrf_field() !!}

                            <div class="form-group" {{ $errors->has('account_id') ? 'has-error' : '' }}>
                                <label for="account_id" class="col-sm-3 control-label">From Account</label>
                                <div class="col-sm-6">
                                    @if($accounts->count())
                                        <select class="form-control" name="account_id" id="account_id">
                                            @foreach($accounts as $account)
                                                <option {{ ($account->id == old('account_id') || $account->id == $delivery->account_id) ? 'selected' : '' }} value="{{$account->id}}">{{$account->name}} ({{$account->email}})</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('account_id'))
                                            <span class="help-block">{{ $errors->first('account_id') }}</span>
                                        @endif
                                    @else
                                        <p class="form-control-static"><a href="{{ route('accounts.create') }}">Add an account</a></p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" {{ $errors->has('recipients') ? 'has-error' : '' }}>
                                <label for="recipients" class="col-sm-3 control-label">Recipients</label>
                                <div class="col-sm-6">
                                    <input type="text" data-role="tagsinput" class="form-control" id="recipients"
                                           name="recipients"
                                           value="{{ (old('recipients')) ? str_replace(',', ' ', old('recipients')) : '' }}">
                                    @if ($errors->has('recipients'))
                                        <span class="help-block">{{ $errors->first('recipients') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" {{ $errors->has('subject') ? 'has-error' : '' }}>
                                <label for="subject" class="col-sm-3 control-label">Subject</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject"
                                           name="subject"
                                           value="{{ (old('subject')) ? old('subject') : $delivery->subject }}">
                                    @if ($errors->has('subject'))
                                        <span class="help-block">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" {{ $errors->has('body') ? 'has-error' : '' }}>
                                <div class="col-sm-offset-1 col-sm-8">
                                    <textarea class="form-control" name="body" id="body" cols="30"
                                              rows="10">{{ (old('body')) ? old('body') : $delivery->body }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="help-block">{{ $errors->first('body') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button class="btn btn-success" type="submit">Send</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link href="{{ asset('js/tinymce/skins/lightgray/skin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/tinymce/skins/lightgray/content.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/tinymce/themes/modern/theme.min.js') }}"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
@endsection