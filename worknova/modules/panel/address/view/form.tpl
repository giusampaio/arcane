<!-- page content -->
<div class="right_col" role="main">
  <br />
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        
        <div class="x_panel">
          
            <!-- header form -->
            <div class="x_title">
                <h2>New Address <small>Create or edit a Address</small></h2>

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
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address[address]">
  	address <span class="required"></span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="address[address]" name="address[address]" required="required" value="{{address}}" class="form-control col-md-7 col-xs-12">
  </div>
</div><div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address[city]">
  	city <span class="required"></span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="address[city]" name="address[city]" required="required" value="{{city}}" class="form-control col-md-7 col-xs-12">
  </div>
</div><div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address[state]">
  	state <span class="required"></span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="address[state]" name="address[state]" required="required" value="{{state}}" class="form-control col-md-7 col-xs-12">
  </div>
</div><div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address[neighborhood]">
  	neighborhood <span class="required"></span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="address[neighborhood]" name="address[neighborhood]" required="required" value="{{neighborhood}}" class="form-control col-md-7 col-xs-12">
  </div>
</div><div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address[postalcode]">
  	postalcode <span class="required"></span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="address[postalcode]" name="address[postalcode]" required="required" value="{{postalcode}}" class="form-control col-md-7 col-xs-12">
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