<!-- page content -->
<div class="right_col" role="main">
  <br />
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        
        <div class="x_panel">
          
            <!-- header form -->
            <div class="x_title">
                <h2>New Opportunity <small>Create or edit a Opportunity</small></h2>

                <!-- header options -->
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                      <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        </ul>
                    </li>
                    <li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <!-- /header options -->

                <div class="clearfix"></div>
            </div>
            <!-- /header form -->

            <!-- content form -->
            <div class="x_content">
              <br />
              <form id="" method="post" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opportunity[title]">
  	title <span class="required"></span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="opportunity[title]" name="opportunity[title]" required="required" value="{{title}}" class="form-control col-md-7 col-xs-12">
  </div>
</div><div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opportunity[description]">
  	description <span class="required"></span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
        <label for="message">Message (20 chars min, 100 max) :</label>
        <textarea id="opportunity[description]" name="opportunity[description]" required="required" value="{{description}}" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
   </div>
</div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </form>  
            <!-- /content form -->
            </div>
        </div>
      </div>
  </div>
</div>