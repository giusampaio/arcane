<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>
              Addresss
              <small>
                   &nbsp; &nbsp; 
                  <button class="btn btn-dark btn-xs" type="button" onclick="go('/worknova/panel/address/create')">
                    <i class="fa fa-bolt"></i>&nbsp;Add a new Address                    
                  </button>
              </small>
          </h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          
          <!-- header form -->
          <div class="x_title">
            <h2>New Address <small>List  Address</small></h2>

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

          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              
            </p>
            <table id="datatable-buttons" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>address</th>
      <th>city</th>
      <th>state</th>
      <th>neighborhood</th>
      <th>postalcode</th>
    </tr>
  </thead>
  <tbody>
  {{#address}}
    <tr>
        <td>{{address}}</td>
        <td>{{city}}</td>
        <td>{{state}}</td>
        <td>{{neighborhood}}</td>
        <td>{{postalcode}}</td>
    </tr>
  {{/address}}
  </tbody>
</table>
          </div>
        </div>
      </div>
</div>
<!-- /page content -->


<!-- index  script-->
<script type="text/javascript">

function go(url) {
  window.location.href = url;
}

</script>
<!-- /index  script-->