{!! Form::open(['route' => ['registrar_incidencia'], 'enctype' => 'multipart/form-data', 'method' => 'POST', 'name' => 'registrar_incidencia', 'id' => 'registrar_incidencia', 'data-parsley-validate']) !!}
        @csrf
    <div class="modal fade" id="crearIncidencia" role="dialog">
        <div class="modal-dialog modals-default border border-danger">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Reportar incidencia <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Las indicidencias se agragarán como recargas a los residentes por daños en los equipos e instalaciones</p>
                    <center>
                        <div class="form-group">
                            <label>Residente <b class="text-danger">*</b></label>
                            <select class="form-control select2" id="id_residente" onchange="buscarTodo(this.value)" name="id_residente" required>
                                <option disabled>Seleccione residente</option>
                                @foreach($residentes as $key)
                                    <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
                                @endforeach()
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Motivo <b class="text-danger">*</b></label>
                            <input type="text" name="motivo" class="form-control" required placeholder="Romper ventanas de la oficina">
                        </div>
                        <div class="form-group">
                            <label>Observación (Opcional)</label>
                            <textarea class="form-control" name="observacion" placeholder="¿Algo que desee acotar?"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Monto <b class="text-danger">*</b></label>
                            <input type="number" name="monto" class="form-control" placeholder="15000" required>
                    </center>
                    <div align="center">
                        <button type="submit" class="btn btn-danger">Guardar incidencia</button>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
{!! Form::close() !!}