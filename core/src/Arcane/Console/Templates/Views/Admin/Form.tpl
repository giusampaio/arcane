<!-- page content -->
<div class="right_col" role="main">
  <br />
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        
        <div class="x_panel">
          
            <!-- header form -->
            <div class="x_title">
                <h2>{{title}} <small>{{subtitle}}</small></h2>

                <!-- header options -->
                {{#options}}
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                      <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            {{#settings}}  
                            <li>
                                <a href="#">Settings 1</a>
                            </li>
                            {{/settings}}
                        </ul>
                    </li>
                    <li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                {{/options}}
                <!-- /header options -->

                <div class="clearfix"></div>
            </div>
            <!-- /header form -->

            <!-- content form -->
            <div class="x_content">
              <br />
              <form id="{{form-id}}" method="post" data-parsley-validate class="form-horizontal form-label-left">
                {{{fields}}}

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="button" class="btn btn-primary"  onclick="go('{{back}}');">Cancel</button>
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