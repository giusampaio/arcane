<table id="datatable-buttons" class="table table-striped table-bordered">
  <thead>
    <tr>
      {{# collumns}}
      <th>{{{ . }}}</th>
      {{/ collumns}}
    </tr>
  </thead>
  <tbody>
  {{module_init}}
    <tr>
    {{# rows}}
        <td>{{{ . }}}</td>
    {{/ rows}}
    </tr>
  {{module_end}}
  </tbody>
</table>