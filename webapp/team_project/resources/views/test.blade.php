<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<title>test</title>
</head>
<body>
<section>
    <form method="POST" action="./codepage/api">
    {{ csrf_field() }}
        <input type="submit">
    </form>
</section>
</body>
</html>