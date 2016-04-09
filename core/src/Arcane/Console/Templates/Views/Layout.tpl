<html>
  <head>
    {{#loadCSS}}
    <link rel="stylesheet" type="text/css" href="{{.}}" />
    {{/loadCSS}}

    {{#loadFonts}}
    <link rel="stylesheet" type="text/css" href="panel/starter/assets/{{.}}" />
    {{/loadFonts}}
  </head>

  {{{getContent}}}

  {{#loadJS}}
  <script type="text/javascript" src="{{.}}"></script>
  {{/loadJS}}

</html>