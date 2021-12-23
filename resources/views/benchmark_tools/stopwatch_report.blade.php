@php
    $previousTime = 0;
@endphp
<html lang="th">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous">
        <style>
            body {
                padding: 10px;
            }

            body, td, th {
                font-size: 15px !important;
                font-family: 'Source Code Pro', monospace;
                font-weight: 300;
            }
        </style>
    </head>
    <body>
        <h1>{{ $name }}</h1>
        <table class="pure-table pure-table-bordered g-font-noto">
            <thead>
                <tr style="text-align:center;">
                    <th></th>
                    <th>DESCRIPTION</th>
                    <th>TIME (SECOND)</th>
                    <th>TIME LAP (SECOND)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $key => $list)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->time }}</td>
                        <td>{{ $list->time - $previousTime }}</td>
                    </tr>
                    @php
                        $previousTime = $list->time;
                    @endphp
                @endforeach
            </tbody>

        </table>
    </body>
</html>
