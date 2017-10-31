@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Template</div>

                    <div class="panel-body">


                        <form class="form-horizontal" method="POST" action="{{ route('templates.store') }}">
                            {!! csrf_field() !!}

                            <div class="form-group" {{ $errors->has('language_code') ? 'has-error' : '' }}>
                                <label for="language_code" class="col-sm-2 control-label">Language</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="language_code" id="language_code">
                                        <option value="ru">ru</option>
                                        <option value="en">en</option>
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
                                           value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" {{ $errors->has('subject') ? 'has-error' : '' }}>
                                <label for="alias" class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject"
                                           name="subject" value="{{ old('subject') }}">
                                    @if ($errors->has('subject'))
                                        <span class="help-block">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" {{ $errors->has('body') ? 'has-error' : '' }}>
                                <div class="col-sm-offset-1 col-sm-8">
                                    <textarea class="form-control" name="body" id="body" cols="30"
                                              rows="10">{{ (old('body')) }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="help-block">{{ $errors->first('body') }}</span>
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
    @include('parts.tinymce')
@endsection

{{--@section('script')--}}
    {{--<link href="{{ asset('js/tinymce/skins/lightgray/skin.min.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ asset('js/tinymce/skins/lightgray/content.min.css') }}" rel="stylesheet">--}}
    {{--<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>--}}
    {{--<script src="{{ asset('js/tinymce/themes/modern/theme.min.js') }}"></script>--}}
    {{--<script>tinymce.init({--}}
            {{--selector: 'textarea',--}}
            {{--menubar: false,--}}
            {{--plugins: [--}}
                {{--'advlist autolink lists link image charmap print preview anchor',--}}
                {{--'searchreplace visualblocks code fullscreen',--}}
                {{--'insertdatetime media table contextmenu paste code'--}}
            {{--],--}}
            {{--toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',--}}

            {{--// without images_upload_url set, Upload tab won't show up--}}
            {{--images_upload_url: '/upload/images',--}}
{{--//--}}
{{--//            // we override default upload handler to simulate successful upload--}}
{{--//            images_upload_handler: function (blobInfo, success, failure) {--}}
{{--//                setTimeout(function() {--}}
{{--//                    // no matter what you upload, we will turn it into TinyMCE logo :)--}}
{{--//                    success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');--}}
{{--//                }, 2000);--}}
{{--//            }--}}
        {{--});</script>--}}
{{--@endsection--}}