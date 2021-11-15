<link href="{{asset('css/textfieldvalidation/SpryValidationTextField.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('js/textfieldvalidation/SpryValidationTextField.js')}}" type="text/javascript"></script>

<link href="{{asset('css/textareavalidation/SpryValidationTextarea.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('js/textareavalidation/SpryValidationTextarea.js')}}" type="text/javascript"></script>


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><b>Schedule Event</b></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" action="{{ url('/calendar/post_schedule') }}" method="post">
    @csrf <!-- {{ csrf_field() }} -->
    <div class="box-body">
      
    <div class="form-group">
        <div class="row">
            <div class="col-xs-6">
                <label>Source</label>
                <span id="sprytf_source">
                <input type="text" name="source" class="form-control" placeholder="Source">
                <span class="textfieldRequiredMsg">Source is required</span>
                </span>
            </div>
            <div class="col-xs-6">
                <label>Destination</label>
                <span id="sprytf_destination">
                <input type="text" name="destination" class="form-control" placeholder="Destination">
                <span class="textfieldRequiredMsg">Destination is required.</span>
                </span>
            </div>
        </div>
	  </div>

	  <div class="form-group">
      <label for="exampleInputEmail1">Descrbtion</label>
      <span id="sprytf_comment">
          <textarea name="comment" class="form-control input-sm" placeholder="Descrbtion" id="comment"></textarea>
          <span class="textareaRequiredMsg">Descrbtion is required.</span>
          <span class="textareaMinCharsMsg">Descrbtion must specify at least 10 characters.</span>	
      </span>
    </div>
	
      <div class="form-group">
        <div class="row">
            <div class="col-xs-6">
                <label>Reservation Date</label>
                <span id="sprytf_rdate">
                <input type="text" name="rdate" class="form-control" placeholder="YYYY-mm-dd">
                <span class="textfieldRequiredMsg">Date is required.</span>
                <span class="textfieldInvalidFormatMsg">Invalid date Format.</span>
                </span>
            </div>
            <div class="col-xs-6">
                <label>Reservation Time</label>
                <span id="sprytf_rtime">
                <input type="text" name="rtime" class="form-control" placeholder="HH:mm">
                <span class="textfieldRequiredMsg">Time is required.</span>
                <span class="textfieldInvalidFormatMsg">Invalid time Format.</span>
                </span>
            </div>
        </div>
	  </div>
				  

    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      
      <button type="button" class="btn btn-secondary"><a href="{{ url('/calendar/schedules') }}" style="color: white;text-decoration: none;">List Schedules</a></button>
    </div>
  </form>
</div>
<!-- /.box -->
<script type="text/javascript">
<!--
var sprytf_comment 	= new Spry.Widget.ValidationTextarea("sprytf_comment", {minChars:6, isRequired:true, validateOn:["blur", "change"]});
var sprytf_rdate 	= new Spry.Widget.ValidationTextField("sprytf_rdate", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_rtime 	= new Spry.Widget.ValidationTextField("sprytf_rtime", "time", {hint:"i.e 20:10", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_source 	= new Spry.Widget.ValidationTextField("sprytf_source", "custom", {minChars:3, isRequired:true, validateOn:["blur", "change"]});
var sprytf_destination 	= new Spry.Widget.ValidationTextField("sprytf_destination", "custom", {minChars:3, isRequired:true, validateOn:["blur", "change"]});

//-->
</script>
