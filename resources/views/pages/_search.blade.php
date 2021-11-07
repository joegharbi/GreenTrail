<div class="p-4 border rounded border-success m-4">
    <H2>
        Please choose your source and destination:
    </H2>
    <div class="mb-3">
        <div class="mb-3">
            <label for="source" class="form-label">
                <i class="bi bi-geo-alt"></i>
                <h5>Source</h5>
            </label>
            <div class="row p-0">
                <div class="col-11">
                    <input type="text" class="form-control" id="from" onkeydown="onInputEnter('from')" onfocusout="onFocusOut('from')">
                </div>
                <div class="col-1 d-grid gap-2">
                    <button id="gps" class="btn btn-success btn-lg p-1" onclick="useGPS()">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512">
                            <path fill="#eeeeee" fill-rule="evenodd" d="M257.13,125.11c40.21,0,72.52,30.23,72.52,70.43,0,38.59-32.31,70.76-72.52,70.76-40.52,0-72.85-32.17-72.85-70.76,0-40.2,32.33-70.43,72.85-70.43Zm181.54,52.42C438.67,78.79,358,0,257.13,0c-101,0-183.8,78.79-183.8,177.53,0,4.18,0,10.3,2.09,14.15H73.33c0,96.81,183.8,320.32,183.8,320.32S438.67,288.49,438.67,191.68h0V177.53Z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="destination" class="form-label">
                <h5>Destination</h5>
            </label>
            <input type="text" class="form-control" id="to" onkeydown="onInputEnter('to')" onfocusout="onFocusOut('to')">
        </div>
        <button id="go" class="btn btn-success btn-lg">GO</button>
    </div>
</div>
<script type="text/javascript">
    function getAPI_URL() {
        return "{{ asset('resources/api') }}";
    }
</script>
<script type="text/javascript" src="{{ asset('resources/js/search.js') }}"></script>