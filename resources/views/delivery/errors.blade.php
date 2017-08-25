@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">ID # {{$delivery->id}} <a
                                href="{{route('delivery.create', ['copy_id'=>$delivery->id])}}">Copy</a></div>

                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sender</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$delivery->account->name}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$delivery->subject}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Body</label>
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-link" data-toggle="modal"
                                            data-target="#myModal">Show Text
                                    </button>
                                    <!-- Modal -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Body</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $delivery->body !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Created At</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$delivery->created_at}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sent At</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{($delivery->sent_at) ? $delivery->sent_at : '-'}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Errors</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">
                                        <a href="{{route('delivery.errors', $delivery->id)}}">Show</a>
                                    </p>
                                </div>
                            </div>

                        </form>
                        @if($delivery->emails)
                            @foreach($delivery->emails as $email)
                                    {{$email->recipient_email}}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        channel.bind('update_email', function (data) {
            console.log(data.email);
            console.log(data.email.id);
            console.log(data.email['id']);
            if (data.email) {
                $("tr#e" + data.email.id + " td.s_sent_at").html((data.email.sent_at) ? data.email.sent_at : '-');
                $("tr#e" + data.email.id + " td.s_received_at").html((data.email.received_at) ? data.email.received_at : '-');
                $("tr#e" + data.email.id + " td.s_opened_at").html((data.email.opened_at) ? data.email.opened_at : '-');
                $("tr#e" + data.email.id + " td.s_opened_at").html((data.email.opened_at) ? data.email.opened_at : '-');
                $("tr#e" + data.email.id + " td.s_error_at").html((data.email.error_at) ? data.email.error_at : '-');
            }
        });

        @if(Session::has('undo'))
        $.notify.addStyle('foo', {
            html: "<div>" +
            "<div class='clearfix'><a href='{{ route('delivery.undo', Session::get('undo')) }}'>" +
            "<div class='title' data-notify-html='title'/></a>" +
            "<div class='buttons'>" +
            "</div>" +
            "</div>" +
            "</div>"
        });

        $.notify({
            title: 'UNDO'
        }, {
            style: 'foo',
            autoHideDelay: 10000,
            clickToHide: false,
            className: 'info',
        });
        @endif
    </script>
@endsection