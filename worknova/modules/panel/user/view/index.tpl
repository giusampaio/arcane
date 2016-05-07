<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="clearfix"></div>

      <!-- message alert -->
      {{#danger}}
      <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span> Enter a valid email address
      </div>
      {{/danger}}
      <!-- /message alert -->

      <!-- message success -->
      {{#success}}
      <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span> Enter a valid email address
      </div>
      {{/success}}
      <!-- /message sucess -->
        

      <div class="title_left">
        <h3>
              Users
              <small>
                   &nbsp; &nbsp; 
                  <button class="btn btn-dark btn-xs" type="button" onclick="go('/arcane/worknova/panel/user/create')">
                    <i class="fa fa-bolt"></i>&nbsp;Add a new User                    
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
            <h2>New User <small>List  User</small></h2>

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
      <th>firstname</th>
      <th>lastname</th>
      <th>password</th>
      <th>dob</th>
      <th>actions</th>
    </tr>
  </thead>
  <tbody>
  {{#user}}
    <tr>
        <td>{{firstname}}</td>
        <td>{{lastname}}</td>
        <td>{{password}}</td>
        <td>{{dob}}</td>
        <td>
          <a href="/arcane/worknova/panel/user/show/{{id}}" sr-only="show">
            <i class="fa fa-eye"></i>
          </a>
          <a href="/arcane/worknova/panel/user/edit/{{id}}" sr-only="show">
            <i class="fa fa-pencil"></i>
          </a>
        </td>
    </tr>
  {{/user}}
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