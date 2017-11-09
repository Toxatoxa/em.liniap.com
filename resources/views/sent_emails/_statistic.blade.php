<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-4 control-label">All</label>
        <div class="col-sm-8">
            <p class="form-control-static">{{$stat->count_all}}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Sent</label>
        <div class="col-sm-8">
            <p class="form-control-static">{{$stat->count_sent}} <span
                        class="help-block inline">({{ ($stat->count_all) ? round($stat->count_sent * 100 / $stat->count_all ) : 0 }}
                    %)</span></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Received</label>
        <div class="col-sm-8">
            <p class="form-control-static">{{$stat->count_received}} <span
                        class="help-block inline">({{ ($stat->count_sent) ? round($stat->count_received * 100 / $stat->count_sent ) : 0  }}
                    %)</span></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Opened</label>
        <div class="col-sm-8">
            <p class="form-control-static">{{$stat->count_opened}} <span
                        class="help-block inline">({{ ($stat->count_received) ? round($stat->count_opened * 100 / $stat->count_received ) : 0  }}
                    %)</span></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Clicked</label>
        <div class="col-sm-8">
            <p class="form-control-static">{{$stat->count_clicked}} <span
                        class="help-block inline">({{ ($stat->count_opened) ? round($stat->count_clicked * 100 / $stat->count_opened ) : 0  }}
                    %)</span></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">With Errors</label>
        <div class="col-sm-8">
            <p class="form-control-static">{{$stat->count_errors}} <span
                        class="help-block inline">({{ ($stat->count_all) ? round($stat->count_errors * 100 / $stat->count_all ) : 0  }}
                    %)</span></p>
        </div>
    </div>
</form>