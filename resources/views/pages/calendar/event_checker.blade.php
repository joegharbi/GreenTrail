<?php

?>
<script>
    function getAPI_URL_Event() {
        return "{{ URL('/calendar/checkEvents') }}";
    }
</script>
<script src="{{ asset('/js/js.cookie.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/event_checker.js') }}"></script>