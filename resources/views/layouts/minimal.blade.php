<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'TreeHouse Italia')</title>
<style>
body{margin:0;font-family:system-ui,sans-serif;background:#0b1220;color:#fff}
.wrap{max-width:900px;margin:0 auto;padding:20px}
h1{font-size:32px;margin:20px 0}
p{line-height:1.6;color:#ccc}
a{color:#3fd08b;text-decoration:none}
a:hover{text-decoration:underline}
.btn{display:inline-block;padding:12px 24px;margin:10px 10px 0 0;background:#3fd08b;color:#000;border-radius:8px;font-weight:600}
.btn:hover{background:#2fc080}
</style>
</head>
<body>
<div class="wrap">
@yield('content')
</div>
</body>
</html>
