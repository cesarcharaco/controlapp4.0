{!! Form::open(['route' => ['estacionamientos.eliminar_mensualidad'],'method' => 'POST', 'name' => 'eliminar_mensualidad', 'id' => 'eliminar_mensualidad', 'data-parsley-validate']) !!} 
    @csrf   
    <div class="modal fade" id="deleteMensualidad" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Eliminar una mensualidad</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Especifique el año para eliminar la mensualidad</label>
                                    <select name="anio" id="SelectAnio3" class="form-control" onchange="accionM(3,this.value);">
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
                                <div id="deleteMensuality"></div>
                            </div>
                        </div>
                    </center>
                </div> 

                <div class="modal-footer">
                    <input type="hidden" name="id_estacionamiento" id="idDeleteM">
                    <input type="hidden" name="anio" id="anioDeleteM">
                    <button type="submit" class="btn btn-danger" id="buttonD" disabled style="border-radius: 50px;"><i data-feather="trash-2"></i></button>
                </div>                            
            </div>
        </div>
    </div>
{!! Form::close() !!}