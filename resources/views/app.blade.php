<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
{{--      <link rel="shortcut icon" type="image/x-icon" href="{{ asset("/") }}/images/favicon.ico">--}}
      <link rel="shortcut icon" type="image/x-icon" href="{{ config("app.url")."/storage/".get_setting(\App\Properties::$fIcon)   }}">

      <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>
