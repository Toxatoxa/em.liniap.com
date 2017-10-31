@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Template ID: {{$template->id}}</div>

                    <div class="panel-body">

                        <form class="form-horizontal" method="POST"
                              action="{{ route('templates.update', $template->id) }}">
                            {!! csrf_field() !!}
                            {!! method_field('PUT') !!}

                            <div class="form-group" {{ $errors->has('language_code') ? 'has-error' : '' }}>
                                <label for="language_code" class="col-sm-2 control-label">Language</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="language_code" id="language_code">
                                        <option {{ ($template->language_code === 'ru') ? 'selected' : '' }} value="ru">
                                            ru
                                        </option>
                                        <option {{ ($template->language_code === 'en') ? 'selected' : '' }} value="en">
                                            en
                                        </option>
                                    </select>
                                    @if ($errors->has('language_code'))
                                        <span class="help-block">{{ $errors->first('language_code') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" {{ $errors->has('name') ? 'has-error' : '' }}>
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                           value="{{ $template->name }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" {{ $errors->has('subject') ? 'has-error' : '' }}>
                                <label for="subject" class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject"
                                           name="subject" value="{{ $template->subject }}">
                                    @if ($errors->has('subject'))
                                        <span class="help-block">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" {{ $errors->has('body') ? 'has-error' : '' }}>
                                <div class="col-sm-offset-1 col-sm-8">
                                    <textarea class="form-control" name="body" id="body" cols="30"
                                              rows="10">{{ $template->body }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="help-block">{{ $errors->first('body') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('parts.tinymce')
@endsection