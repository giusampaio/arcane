<html>
  <head>
    {{#css}}
    <link rel="stylesheet" type="text/css" href="/arcane{{.}}" />
    {{/css}}

    {{#loadFonts}}
    <link rel="stylesheet" type="text/css" href="panel/starter/assets/{{.}}" />
    {{/loadFonts}}
  </head>

  {{{getContent}}}

  {{#js}}
  <script type="text/javascript" src="/arcane{{.}}"></script>
  {{/js}}

</html>