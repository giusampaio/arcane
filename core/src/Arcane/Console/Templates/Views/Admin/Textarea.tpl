<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="{{name}}">
  	{{label}} <span class="required">{{required}}</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
        <label for="message">Message (20 chars min, 100 max) :</label>
        <textarea id="{{name}}" name="{{name}}" required="required" value="{{value}}" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
   </div>
</div>