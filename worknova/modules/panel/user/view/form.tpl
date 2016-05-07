<!-- page content -->
<div class="right_col" role="main">
  <br />
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        
        <div class="x_panel">
          
            <!-- header form -->
            <div class="x_title">
                <h2>New User <small>Create or edit a User</small></h2>

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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user[firstname]">
                  	First name <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="user[firstname]" name="user[firstname]" required="required" value="{{firstname}}" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user[lastname]">
                  	Last name <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="user[lastname]" name="user[lastname]" required="required" value="{{lastname}}" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user[password]">
                  	Password <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="user[password]" name="user[password]" required="required" value="" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user[dob]">
                    Date of Birthday <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="user[dob]" id="dob_id" data-inputmask="'mask': '99/99/9999'" />
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