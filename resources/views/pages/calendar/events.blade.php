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

    .table tr:first-child{
        background-color: #d1f0d1;
    }
</style>

<div class="container">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Schedules Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-bordered">
                <tr>
                <th style="width: 10px">#</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Comment</th>
                <th>Schedule Date</th>
                <th style="width: 100px">Status</th>
                <th >Action</th>

                </tr>

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
                        <td><span class="label label-warning">PENDING</span></td>
                        <td>
                            <a href="javascript:deleteEvent({{ $calendar->id }});"><button class="deleteButton">-</button></a>
                        </td>

                    </tr>
                    @php
                        $idx++;
                    @endphp
                @endforeach

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
