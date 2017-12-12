@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Find Contacts</div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">iTunes #</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><a target="_blank"
                                                                              href="{{$dev->url}}">{{$dev->as_id}}</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Found Feed</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">{{$dev->found_feed}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Developer Name</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">{{$dev->name}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Developer Site</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">
                                                @if($dev->site)
                                                    <a target="_blank" href="{{$dev->site}}">{{$dev->site}}</a>
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Applications</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">
                                                @if($dev->applications)
                                                    @foreach($dev->applications as $application)
                                                        <a target="_blank"
                                                           href="{{$application->url}}">{{$application->country_code}}</a>
                                                    @endforeach
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                @include('developers._edit_form')
                            </div>
                        </div>


                        {{--<hr>--}}
                        {{--<div style="margin-top: 20px">--}}
                            {{--<iframe src="{{$dev->site}}" frameborder="0" width="100%" height="500px">--}}

                            {{--</iframe>--}}
                        {{--</div>--}}

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