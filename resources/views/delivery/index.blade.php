@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Deliveries</div>

                    <div class="panel-body">
                        @if($deliveries)
                            {{ $deliveries->links() }}
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sender</th>
                                    <th>Subject</th>
                                    <th>Count</th>
                                    <th>Created At</th>
                                    <th>Sent At</th>
                                    <th>Receivers</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($deliveries as $delivery)
                                    <tr>
                                        <th>{{$delivery->id}}</th>
                                        <td>{{$delivery->account->email}}</td>
                                        <td>{{$delivery->subject}}</td>
                                        <td>{{$delivery->emails->count()}}</td>
                                        <td>{{$delivery->created_at}}</td>
                                        <td>{{($delivery->sent_at) ? $delivery->sent_at : '-'}}</td>
                                        <td>
                                            <a href="{{ route('delivery.show', $delivery->id) }}">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $deliveries->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection