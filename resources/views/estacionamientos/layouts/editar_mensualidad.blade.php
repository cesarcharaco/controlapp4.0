{!! Form::open(['route' => ['estacionamientos.editar_mensualidad'],'method' => 'POST', 'name' => 'editar_mensualidad', 'id' => 'editar_mensualidad', 'data-parsley-validate']) !!}
    @csrf
    <div class="modal fade" id="editarMensualidad" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar mensualidad <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Especifique el año para editar la mensualidad <b class="text-danger">*</b></label>
                                    <select name="anio" id="SelectAnio2" class="form-control" onchange="accionM(2,this.value);">
                                        <option value="0">Seleccionar año</option>
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
                                <div id="buttonEdit"></div>
                                <div id="editMensuality1"></div>
                                <div id="editMensuality2"></div>
                            </div>
                        </div>
                    </center>
                </div> 

                <div class="modal-footer">
                    <input type="hidden" name="id_estacionamiento" id="idEditM">
                    <input type="hidden" name="anio" id="anioEditM">
                    <input type="hidden" id="accionEdit" name="accion" value="1">
                    <button type="submit" id="buttonE" disabled class="btn btn-warning" style="border-radius: 50px;"><i data-feather="check-circle"></i></button>
                </div>                                                  
            </div>
        </div>
    </div>
{!! Form::close() !!}