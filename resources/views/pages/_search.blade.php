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
                        <img src="{{ asset('public/svg/gps.svg') }}" />
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