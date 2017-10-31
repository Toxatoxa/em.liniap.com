@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Template ID: {{$template->id}}</div>

                    <div class="panel-body document">

                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">language</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$template->language_code}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$template->name}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$template->subject}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Body</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{!! $template->body !!}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="{{ route('templates.edit', $template->id) }}"
                                       class="btn btn-success">Edit</a>
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
    <script type="text/javascript">

    </script>
@endsection