<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK BAKTI ILHAM</title>
    <link rel="icon" type="image/png" href="{{ asset('images/smk.png') }}"/>
    <link rel="stylesheet" href="{{ asset('css/table2.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script></head>
    <style>
table {
   border: 1px solid #999;
   border-collapse: collapse;
   font-family: Georgia, Times, serif;
   }
   th {
   border: 1px solid #999;
   font-size: 70%;
   text-transform: uppercase;
   }
   td {
   border: 1px solid #999;
   height: 5em;
   width:5em;
   padding: 5px;
   vertical-align: top;
   }
   caption {
   font-size: 300%;
   font-style: italic;
   }
   .day {
   text-align: right;
   }
   .notes {
   font-family: Arial, Helvetica, sans-serif;
   font-size: 80%;
   text-align: right;
   padding-left: 20px;
   }
   .birthday {
   background-color: #ECE;
   }
   .weekend {
   background-color: #F3F3F3;
   }
   tr:nth-child(even) {
       background-color: #f2f2f2;
    }

    </style>
<body class="bg-sky-700">
@yield('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
<script src="{{ asset('js/test.js') }}"></script>

<script>
    function openModal(){
        $('#modal-form').modal('show');
    }

</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
