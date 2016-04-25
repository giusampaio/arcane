<html>
  <head>
    {{#css}}
    <link rel="stylesheet" type="text/css" href="{{.}}" />
    {{/css}}

    {{#loadFonts}}
    <link rel="stylesheet" type="text/css" href="panel/starter/assets/{{.}}" />
    {{/loadFonts}}
  </head>

  {{{getContent}}}

  {{#js}}
  <script type="text/javascript" src="{{.}}"></script>
  {{/js}}

</html>