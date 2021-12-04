@php
    date_default_timezone_set('Europe/Budapest');   
@endphp

<!-- CSS -->
<!-- Theme style -->
{{--<link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">--}}
<!-- <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}"> -->

<style>
    .label{
        padding: 2%;
    }

    .deleteButton {
        background: transparent;
        border: 1px solid #f00;
        border-radius: 2em;
        color: #f00;
        display: inline-block;
        font-size: 12px;
        height: 20px;
        line-height: 2px;
        margin: 0 0 8px;
        padding: 0;
        text-align: center;
        width: 20px;
    }

    .table-bordered{
        text-align: center;
    }

    .label{
        border-radius: 10%;
    }

    .table thead tr:first-child{
        background-color: #d1f0d1;
    }
</style>

<div class="">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Schedules Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Comment</th>
                    <th>Schedule Date</th>
                    <th style="width: 100px">Status</th>
                    <th>Suggested Transportation</th>
                    <th>Reduced Emission (g)</th>
                    <th >Action</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $idx = 1;
                    @endphp
                    @foreach($calendars as $calendar)

                        @php
                        $stat = '';
                        $stat = 'warning';
                        // $stat = 'success';
                        // $stat = 'danger';
                        @endphp

                        <tr>
                            <td>@php echo $idx; @endphp</td>
                            <td>{{ $calendar->source }}</td>
                            <td>{{ $calendar->destination }}</td>
                            <td>{{ $calendar->comments }}</td>
                            <td>{{ $calendar->rdate }}</td>
                            @php 
                            $d1 = strtotime($calendar->rdate.":00");
                            $d2 = strtotime(date("Y-m-d H:i:s", strtotime('+10 minutes')));

                            $from_lat= $calendar->from_lat;
                            $from_lng= $calendar->from_lng;
                            $to_lat= $calendar->to_lat;
                            $to_lng= $calendar->to_lng;
                            $event_id= $calendar->id;

                            $suggest_link = "/suggest?from_lat=$from_lat&from_lng=$from_lng&to_lat=$to_lat&to_lng=$to_lng&id=$event_id";
                            if($d1<=$d2 && $calendar->state=="pending"){
                                echo '<td>
                                        <a href="'.$suggest_link.'">
                                            <button type="button" class="btn btn-success btn-sm">ROUTE</button>                                        
                                        </a>
                                    </td>';
                            }else if($d1<=$d2 && $calendar->state=="done"){
                                echo '<td>
                                        <button type="button" class="btn btn-info btn-sm" disabled style="color:white;">SUGGESTED</button>
                                    </td>';
                            }else{
                                echo '<td>
                                        <button type="button" class="btn btn-warning btn-sm" disabled>PENDING</button>
                                    </td>';
                            }
                            @endphp
                            
                            <td>{{ $calendar->chosen_transportation == "" ? "---" : $calendar->chosen_transportation }}</td>
                            <td>{{ $calendar->reduced_emission == 0 ? "---" : $calendar->reduced_emission }}</td>
                            <td>
                                <a href="javascript:deleteEvent({{ $calendar->id }});"><button class="deleteButton">-</button></a>
                            </td>

                        </tr>
                        @php
                            $idx++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            </div>

            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    <!-- /.box -->
    </div>

</div>
<script language="javascript">

function deleteEvent(eventId) {
	if(confirm('Are you sure you want to proceed ?')) {
        // window.location.href = 'api/process.php?cmd=delete&eventId='+eventId;
		window.location.href = "{{ url('/calendar/schedules/delete') }}"+"/"+eventId;
	}
}

</script>
