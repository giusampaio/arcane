<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="{{name}}">
    {{label}} <span class="required">{{required}}</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" class="form-control has-feedback-left" name="{{name}}" id="{{name}}" placeholder="{{label}}" aria-describedby="inputSuccess2Status">
    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      $('#single_cal1').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
    });
</script>