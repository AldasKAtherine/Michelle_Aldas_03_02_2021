@extends('layouts.app')
@push('css-plugins')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

@endpush

@push('head')
<style>
#docentesTabla_paginate{
    text-align: center;
}
span a{
    padding: 0 10px;
}
</style>


<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script>
$(function() {
  $('#docentesTabla').DataTable({
    language: {
                url: "https://raw.githubusercontent.com/DataTables/Plugins/master/i18n/es_es.json"
            },
            "ordering": false,
            "info": false,
            "lengthChange": false,
            "pageLength": 5
  }
  
   

  );
} )

</script>

@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Docentes</h3>
                    
                </div>

                <div class="card-body" >
                <form action="{{ route('docentes.import.excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(Session::has('mensaje'))
                        <div class="alert alert-success" role="alert">
                        {{ Session::get('mensaje')}}
                        </div>
                        @endif
                        
                        <div class="mb-3">
                        <label class="form-label">Agrege el archivo Excel(.xlsx .xls) de docentes</label>
                        <input style="padding: 0;height: auto;" class="form-control" type="file"  name="file" >
                        @error('file')
                           <span class="invalid-feedback" style="display: block" role="alert">
                               <strong>{!! $message !!}</strong>
                            </span>
                        @enderror
                        </div>
                       
                    <button class="btn btn-primary">Actualizar Listado</button>
                    </form>

                   
                    <br>
                    <div class="table-responsive">
                        <table class="table table-hover" id="docentesTabla">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cédula</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo UTA</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Teléfono</th>

                                </tr>
                            </thead>
                        <tbody>
                        @foreach($docentes as $doc )
                            <tr>
                            
                                <td scope="col">{{$doc->id}}</td>
                                <td scope="col">{{$doc->cedula}} </td>
                                <td scope="col">{{$doc->nombres}} </td>
                                <td scope="col">{{$doc->correoUTA}}</td>
                                <td scope="col">{{$doc->correo}}</td>
                                <td scope="col">{{$doc->ceular}}</td>
                                <td scope="col">{{$doc->telefono}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                        
                        </table>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection