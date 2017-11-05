@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Find Contacts</div>

                    <div class="panel-body">
                        iTunes # <a target="_blank" href="{{$dev->url}}">{{$dev->as_id}}</a><br>
                        Feed: {{$dev->found_feed}}<br>
                        @if($dev->site)
                            <spam class="hint--bottom"
                                  aria-label="{{$dev->site}}">
                                Developer: <a target="_blank" href="{{$dev->site}}">{{$dev->name}}</a>
                            </spam>
                        @else
                            Developer: {{$dev->name}}
                        @endif
                        <br>

                        Apps:
                        @if($dev->applications)
                            @foreach($dev->applications as $application)
                                <a target="_blank"
                                   href="{{$application->url}}">{{$application->country_code}}</a>
                            @endforeach
                        @endif

                        <form class="form-inline" method="POST"
                              action="{{ route('developers.update', $dev->id) }}">
                            {!! csrf_field() !!}
                            {!! method_field('PUT') !!}

                            <input style="width: 200px" type="text" class="form-control"
                                   id="email"
                                   placeholder="Email or Url"
                                   name="email" value="{{ old('email') }}">
                            <button class="btn btn-success" type="submit">Add</button>

                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif

                            <a href="{{ route('developers.changeStatus', ['id' => $dev->id, 'status'=> 'en']) }}"
                               class="btn btn-default" type="submit">en</a>
                            <a href="{{ route('developers.changeStatus', ['id' => $dev->id, 'status'=> 'hidden']) }}"
                               class="btn btn-danger" type="submit">Hide</a>
                        </form>
                        <hr>
                        <div style="margin-top: 20px">
                            <iframe src="{{$dev->site}}" frameborder="0" width="100%" height="500px">

                            </iframe>
                        </div>

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