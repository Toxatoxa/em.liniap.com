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
                                {{--<input type="text" style="width: 250px;" class="form-control" name="search" id="search"--}}
                                {{--placeholder="Search by ID, Name or Email" value="{{ request('search') }}">--}}
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
                                    <th>Name</th>
                                    <th>Web Site</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Apps</th>
                                    <th>Emailed At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($devs as $dev)
                                    <tr>
                                        <th>
                                            {{$dev->id}}
                                        </th>
                                        <td>
                                            <a target="_blank" href="{{$dev->url}}">{{$dev->as_id}}</a>
                                        </td>
                                        <td>{{$dev->name}}</td>
                                        <td>
                                            @if($dev->site)
                                                <a target="_blank"
                                                   href="{{$dev->site}}">{{str_limit($dev->site, 30)}}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($dev->email)
                                                {{$dev->email}}
                                            @else
                                                <form class="form-horizontal" method="POST"
                                                      action="{{ route('developers.update', $dev->id) }}">
                                                    {!! csrf_field() !!}
                                                    {!! method_field('PUT') !!}

                                                    <input type="text" class="form-control" id="email"
                                                           placeholder="email@gmail.com"
                                                           name="email" value="{{ old('email') }}">
                                                    <button class="btn btn-success btn-sm" type="submit">Add</button>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </form>
                                            @endif
                                        </td>
                                        <td>{{$dev->created_at}}</td>
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
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
