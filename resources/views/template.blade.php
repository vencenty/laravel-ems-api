<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{sleep(2)}}

@foreach($students as $student)
    @foreach(Schema::getColumnListing((new \App\Models\Student())->getTable()) as $property)
        {{$student->$property}}
    @endforeach
    <br>
@endforeach


</body>
</html>
