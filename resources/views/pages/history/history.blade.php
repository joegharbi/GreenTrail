<!-- CSS -->
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
<!-- <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.css')}}">  -->
<!-- <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}"> -->

<style>
    .top_spacing{
        margin-top: 75px;
    }
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

    /* .table tr {
        text-align: left;
    } */
    .table thead tr:first-child{
        background-color: #d1f0d1;
        text-align: center;
    }
</style>


<div class="">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">History Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Chosen Transportation</th>
                    <th>Reduced Emission (g)</th>
                    <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $idx = 1;
                    @endphp
                    @foreach($histories as $history)

                        @php
                        $stat = '';
                        $stat = 'warning';
                        // $stat = 'success';
                        // $stat = 'danger';
                        @endphp

                        <tr>
                            <td>@php echo $idx; @endphp</td>
                            <td>{{ $history->source }}</td>
                            <td>{{ $history->destination }}</td>
                            <td>{{ $history->chosen_transportation }}</td>
                            <td>{{ $history->reduced_emission }}</td>
                            <td>{{ $history->created_at }}</td>

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
