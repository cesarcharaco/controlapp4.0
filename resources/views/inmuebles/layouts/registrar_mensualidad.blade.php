{!! Form::open(['route' => ['inmuebles.registrar_mensualidad'],'method' => 'POST', 'name' => 'registrar_mensualidad', 'id' => 'registrar_mensualidad', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="createMensualidad" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Registrar una nueva mensualidad</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Especifique el año para la mensualidad</label>
                                    <select name="anio" id="SelectAnio1" class="form-control" onchange="accionM(1,this.value);">
                                        <option value="0">Seleccione el año</option>
                                        <?php $anio=date('Y');?>
                                        @for($i=0; $i<10; $i++)
                                            <option value="{{$anio++}}">{{$anio-1}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="buttonCreate"></div>
                                <div id="createMensuality1"></div>
                                <div id="createMensuality2"></div>
                            </div>
                        </div>
                    </center>
                </div> 

                <div class="modal-footer">
                    <input type="hidden" name="id_inmueble" id="idCreateM">
                    <input type="hidden" name="anio" id="anioCreateM">
                    <input type="hidden" id="accionCreate" name="accion" value="1">
                    <button type="submit" class="btn btn-success" disabled id="buttonC" style="border-radius: 50px;">Guardar</button>
                </div>                           
            </div>
        </div>
    </div>
{!! Form::close() !!}