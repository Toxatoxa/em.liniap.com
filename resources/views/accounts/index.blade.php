@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Gmail Accounts</div>

                    <div class="panel-body">
                        <a href="{{ route('accounts.create') }}">Add New</a>

                        <div id="test"></div>

                        @if($accounts)
                            {{--<p>Count: {{$count}}</p>--}}
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($accounts as $account)
                                    <tr>
                                        <th>
                                            <a href="{{ route('accounts.show', $account->id) }}">{{$account->id}}</a>
                                        </th>
                                        <td>{{$account->name}}</td>
                                        <td>{{$account->email}}</td>
                                        <td>{{$account->created_at}}</td>
                                        <td>
                                            <a class="btn btn-default btn-sm"
                                               href="{{ route('accounts.show', $account->id) }}">Show</a>

                                            <form action="{{ URL::route('accounts.destroy',$account->id) }}"
                                                  method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {!! csrf_field() !!}
                                                <button onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</button>
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
