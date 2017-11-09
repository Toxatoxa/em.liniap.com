@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Developers <a href="{{ route('developers.create') }}">Add New</a></div>

                    <div class="panel-body">

                        <form class="form-inline" method="GET" action="{{ route('developers.index') }}">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Search by ID or Name"
                                       name="search" value="{{(request()->get('search'))}}">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="language_code" id="language_code">
                                    <option value="">All Lang</option>
                                    <option {{ (request()->get('language_code') == 'ru') ? 'selected' : '' }} value="ru">
                                        ru
                                    </option>
                                    <option {{ (request()->get('language_code') == 'en') ? 'selected' : '' }} value="en">
                                        en
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="status" id="status">
                                    <option value="">All Statuses</option>
                                    @foreach($statuses as $status)
                                        <option {{ (request()->get('status') == $status) ? 'selected' : '' }} value="{{$status}}">@lang('developers.statuses.'.$status)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('developers.index') }}" class="btn btn-default">Clear</a>
                            </div>
                        </form>

                        @if($devs)
                            <p style="margin-top: 10px;">Found records: {{$devs->count()}}</p>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 100px">iTunes #</th>
                                    <th>Name</th>
                                    <th style="max-width: 150px">Persona</th>
                                    <th style="max-width: 150px">Lang</th>
                                    <th style="width: 200px">Contacts</th>
                                    <th style="width: 120px">Contacted At</th>
                                    <th style="width: 80px"></th>
                                    <th style="width: 80px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($devs as $dev)
                                    <tr>
                                        <td>
                                            <a target="_blank" href="{{$dev->url}}">{{$dev->as_id}}</a>
                                        </td>
                                        <td>
                                            @if($dev->site)
                                                <spam class="hint--bottom"
                                                      aria-label="{{$dev->site}}">
                                                    <a target="_blank"
                                                       href="{{$dev->site}}">{{$dev->name}}</a>
                                                </spam>
                                            @else
                                                {{$dev->name}}
                                            @endif
                                        </td>
                                        <td>
                                            {{ ($dev->contact_persona) ? $dev->contact_persona : '-'}}
                                        </td>
                                        <td>
                                            {{ ($dev->language_code) ? $dev->language_code : '-'}}
                                        </td>
                                        <td>
                                            @if($dev->email)
                                                <a href="{{ route('delivery.create', ['developer_id' => $dev->id, 'template_id' => 1]) }}">{{$dev->email}}</a>

                                            @endif
                                            @if($dev->contact_url)
                                                <br>
                                                <a target="_blank"
                                                   href="{{$dev->contact_url}}">{{str_limit($dev->contact_url, 30)}}</a>
                                            @endif
                                        </td>
                                        <td>{{($dev->contacted_at) ? $dev->contacted_at->format('d.m.Y') : '-'}}</td>
                                        <td>
                                            <div class="show-on-hover">
                                                @if($dev->contact_url)
                                                    <a href="{{ route('developers.setContacted', ['id' => $dev->id]) }}"
                                                       class="btn btn-primary btn-sm">c</a>
                                                @endif
                                                @if($dev->contacted_at)
                                                    <a href="{{ route('developers.setSignedUp', ['id' => $dev->id]) }}"
                                                       class="btn btn-success btn-sm">c</a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="show-on-hover">
                                                <a href="{{ route('developers.edit', ['id' => $dev->id]) }}"
                                                   class="btn btn-default btn-sm">e</a>
                                                <a href="{{ route('developers.delete', ['id' => $dev->id]) }}"
                                                   class="btn btn-danger btn-sm">d</a>
                                            </div>
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
