@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Templates</div>

                    <div class="panel-body">
                        <a href="{{ route('templates.create') }}">Add New</a>

                        <div id="test"></div>

                        @if($templates)
                            {{--<p>Count: {{$count}}</p>--}}
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($templates as $template)
                                    <tr>
                                        <th>
                                            <a href="{{ route('templates.show', $template->id) }}">{{$template->id}}</a>
                                        </th>
                                        <td>{{$template->name}}</td>
                                        <td>{{$template->created_at}}</td>
                                        <td>
                                            <a class="btn btn-success btn-sm"
                                               href="{{ route('delivery.create', ['template_id' => $template->id]) }}">Send</a>

                                            <a class="btn btn-default btn-sm"
                                               href="{{ route('templates.edit', $template->id) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ URL::route('templates.destroy',$template->id) }}"
                                                  method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {!! csrf_field() !!}
                                                <button onclick="return confirm('Are you sure you want to delete this item?');"
                                                        class="btn btn-danger  btn-sm">Delete
                                                </button>
                                            </form>
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
