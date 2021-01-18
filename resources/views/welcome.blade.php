<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
  <link rel=" stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <style>
    div.dt-buttons {
      float: right;
    }
  </style>

  <title>Responsive DataTable UI Design</title>
</head>

<body>
  <div class="container pt-5">
    <table id="example" class="display" style="width:100%">
      <thead>
        <tr>
          <th>Name</th>
          <th>File Name</th>
          <th>File Size</th>
          <th style="width: 50px;"></th>
        </tr>
      </thead>
    </table>

    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>

    <button id="button">Button</button>
  </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="{{ 'libraries/datatables/jquery.dataTables.min.js' }}"></script>
  <script src="{{ 'libraries/datatables/dataTables.buttons.min.js' }}"></script>
  <script src="{{ 'libraries/datatables/buttons.colVis.min.js' }}"></script>
  <script src="{{ 'libraries/datatables/buttons.print.min.js' }}"></script>
  <script src="{{ 'libraries/datatables/buttons.flash.min.js' }}"></script>
  <script src="{{ 'libraries/datatables/buttons.html5.js' }}"></script>
  <script src="{{ 'libraries/datatables/buttons.html5.min.js' }}"></script>

  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $("#example").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blrtip',
        buttons: [
          'colvis',
          'print',
          'csv',
        ],
        ajax: {
          url: "{{ route('app.index') }}",
          type: 'GET'
        },
        columns: [{
          "data": 'name',
        }, {
          "data": 'fileName',
        }, {
          "data": 'fileSize',
        }, {
          "data": 'action',
        }, ]
      });


      $(document).on('click', '.but-drop', function() {
        console.log($(this).attr('id'));
      })

      var table = $('#example').DataTable();

      $('#example tbody').on('click', 'tr', function() {
        $(this).toggleClass('selected');
      });

      $('#button').click(function() {
        alert(table.rows('.selected').data().length + ' row(s) selected');
      });
    });
  </script>
</body>

</html>