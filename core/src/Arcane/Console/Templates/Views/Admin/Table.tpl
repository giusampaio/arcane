
<table id="datatable-buttons" class="table table-striped table-bordered">
  <thead>
    <tr>
      {{# collumns}}
      <th>{{{ . }}}</th>
      {{/ collumns}}
      <th width="15%">actions</th>
    </tr>
  </thead>
  <tbody>
  {{module_init}}
    <tr>
    {{# rows}}
        <td>{{{ . }}}</td>
    {{/ rows}}
        <td>
          <div class="row">
            <div class="col-md-4">
              <button class="btn btn-link" onclick="go('{{view}}');" sr-only="show">
                <i class="fa fa-eye"></i>
              </button>
            </div>
            <div class="col-md-4">
              <button class="btn btn-link"  onclick="go('{{edit}}');" sr-only="show">
                <i class="fa fa-pencil"></i>
              </button>
            </div>
            <div class="col-md-4">
              <button class="btn btn-link" data-toggle="modal" data-target=".warning" sr-only="show">
                <i class="glyphicon glyphicon-trash"></i>
              </button>
            </div>                        
        </td>
    </tr>
  {{module_end}}
  </tbody>
</table>
<div class="modal fade warning" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Attention!</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="go('{{remove}}');" >Execute</button>
      </div>
    </div>
  </div>
</div>