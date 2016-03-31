<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{getTitle}} </title>

    {{#css}}
    <link href="{{fileCSS}}" rel="stylesheet">
    {{/css}}

  </head>

  <body>
	
    {{getContent}}	
    
    {{#js}}
    <script src="{{fileJS}}"></script>
    {{/js}}

  </body>
</html>
