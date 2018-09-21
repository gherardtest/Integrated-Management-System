@extends('layouts.app')

@section('content')

            <div class="panel panel-primary">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Proyecto</th>
                            <th>Categoría</th>
                            <th>Fecha de Envío</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="incident_key">{{ $incident->id }}</td>
                            <td id="incident_project">{{ $incident->project->name }}</td>
                            <td id="incident_category">{{ $incident->category_name }}</td>
                            <td id="incident_created_at">{{ $incident->created_at }}</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th>Asignada a</th>
                            <th>Visibilidad</th>
                            <th>Estado</th>
                            <th>Severidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="incident_responsible">{{ $incident->support_name }}</td>
                            <td>Público</td>
                            <td id="incident_state">{{ $incident->state }}</td>
                            <td id="incident_severity">{{ $incident->severity_full }}</td>
                        </tr>
                    </tbody>  
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <td id="incident_summary">{{ $incident->title }}</td>    
                        </tr>

                        <tr>
                            <th>Descripción</th>
                            <td id="incident_description">{{ $incident->description }}</td>    
                        </tr>

                        <tr>
                            <th>Adjuntos</th>
                            <td id="incident_attachment">No se han adjuntado archivos</td>    
                        </tr>
                    </tbody>
                </table>

                @if ($incident->support_id == null && $incident->active)
                <a href="/incidencia/{{ $incident->id }}/atender" class="btn btn-primary btn-sm" id="incident_btn_apply">
                    Atender Incidencia
                </a>
                @endif

                @if (auth()->user()->id == $incident->client_id)
                 @if ($incident->active)
                    <a href="/incidencia/{{ $incident->id }}/resolver" class="btn btn-info btn-sm" id="incident_btn_solve">
                        Marcar como resuelto
                    </a>
                 @else
                <a href="/incidencia/{{ $incident->id }}/abrir" class="btn btn-info btn-sm" id="incident_btn_open">
                    Volver a abrir incidencia
                </a>
                 @endif
                @endif

                <a href="/incidencia/{{ $incident->id }}/editar" class="btn btn-success btn-sm" id="incident_btn_edit">
                    Editar Incidencia
                </a>

                @if (auth()->user()->id == $incident->support_id && $incident->active)
                <a href="/incidencia/{{ $incident->id }}/derivar" class="btn btn-danger btn-sm" id="incident_btn_derive">
                    Derivar al siguiente nivel
                </a>
                @endif

                </div>
            </div>
@endsection