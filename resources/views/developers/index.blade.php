@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Developers</div>

                    <div class="panel-body">

                        {{--<div id="test"></div>--}}

                        <form class="form-inline" method="GET" action="{{ route('developers.index') }}">
                            <div class="form-group">
                                <select class="form-control" name="status" id="status">
                                    @foreach($statuses as $status)
                                        <option {{ (request()->get('status') == $status) ? 'selected' : '' }} value="{{$status}}">{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="needs_email">Needs Email</label>
                                <input {{ (request()->get('needs_email')) ? 'checked' : '' }} type="checkbox"
                                       name="needs_email" value="1">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>

                        @if($devs)
                            {{--<p>Count: {{$count}}</p>--}}
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>iTunes #</th>
                                    <th>Feed</th>
                                    <th style="width: 200px">Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th style="width: 50px">Apps</th>
                                    <th>Emailed At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($devs as $dev)
                                    <tr>
                                        <th>{{$dev->id}}</th>

                                        <td>
                                            <a target="_blank" href="{{$dev->url}}">{{$dev->as_id}}</a>
                                        </td>
                                        <td>{{$dev->found_feed}}</td>
                                        <td>
                                            @if($dev->site)
                                                <spam class="hint--bottom"
                                                      aria-label="{{$dev->site}}">
                                                    <a target="_blank" href="{{$dev->site}}">{{$dev->name}}</a>
                                                </spam>
                                            @else
                                                {{$dev->name}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($dev->email)
                                                {{$dev->email}}
                                            @else
                                                <form class="form-inline" method="POST"
                                                      action="{{ route('developers.update', $dev->id) }}">
                                                    {!! csrf_field() !!}
                                                    {!! method_field('PUT') !!}

                                                    <input style="width: 130px" type="text" class="form-control"
                                                           id="email"
                                                           placeholder="email@gmail.com"
                                                           name="email" value="{{ old('email') }}">
                                                    <button class="btn btn-success btn-sm" type="submit">Add</button>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </form>
                                            @endif
                                        </td>
                                        <td>{{$dev->created_at->format('d.m.Y')}}</td>
                                        <td>
                                            @if($dev->applications)
                                                @foreach($dev->applications as $application)
                                                    <a target="_blank"
                                                       href="{{$application->url}}">{{$application->country_code}}</a>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($dev->emailed_at)
                                                {{$dev->emailed_at}}
                                            @else
                                                <a href="{{ route('developers.send', $dev->id) }}"
                                                   class="btn btn-primary btn-sm" type="submit">Email</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('developers.changeStatus', ['id' => $dev->id, 'status'=> 'en']) }}"
                                               class="btn btn-default btn-sm" type="submit">en</a>
                                            <a href="{{ route('developers.changeStatus', ['id' => $dev->id, 'status'=> 'hidden']) }}"
                                               class="btn btn-danger btn-sm" type="submit">Hide</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$devs->appends(request()->all())->links()}}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
