@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron mt-3">
            <h1>Urls</h1>

        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">Original</th>
                    <th scope="col">Url</th>
                    <th scope="col">Expira em</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            </div>
        @endif
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="./js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            loadTable();
            //$('#table').DataTable();
        });
                
        
        function loadTable(){

            var urls = "";
            $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/api/generate-url',
                cache: true,
                success: function (data) {
                    $('#table').DataTable( {
                        dom: 'Bfrtip',
                        paging: true,
                        searching: true,
                        info: true,    
                        data: data.data,                         
                        columns: [
                            { "data": "link" },
                            { "data": "code" },
                            { "data": "expiration_date" },
                            { "data": function(item) {
                                return '<a href="'+ item.code + '" target="_blank">Ir</a>';
                                }
                            }
                        ]
                    }); 
                    
                }
                       
            });
        }
          
     
    </script>
@endsection