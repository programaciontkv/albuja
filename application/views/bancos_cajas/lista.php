<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<section class="content-header">
	<form id="exp_excel" style="float:right;padding:0px;margin: 0px;" method="post" action="<?php echo base_url();?>bancos_cajas/excel/<?php echo $permisos->opc_id?>" onsubmit="return exportar_excel()"  >
        	<input type="submit" value="EXCEL" class="btn btn-success" />
        	<input type="hidden" id="datatodisplay" name="datatodisplay">
       	</form>
      <h1>
        Bancos y Cajas
      </h1>
</section>
<section class="content">
	<div class="box box-solid">
		<div class="box box-body">
			
			<div class="row">
				<div class="col-md-12">
					<?php 
					if($permisos->rop_insertar){
					?>
						<a href="<?php echo base_url();?>bancos_cajas/nuevo/<?php echo $permisos->opc_id?>" class="btn btn-success btn-flat"><span class="fa fa-plus"></span> Crear registros</a>
					<?php 
					}
					?>
				</div>	
			</div>
			<br>
			<div class="row" >
				<div class="col-md-12">
					<table id="tbl_list" class="table table-bordered table-list table-hover" style="margin-left:-18px">
						<thead>
						<!-- 	<th>No</th> -->
							<th >Tipo</th>
							<th>Referencia</th>
							<th class="hidden-mobile">Cuenta Contable</th>
							<th  >Descripción de la cuenta contable</th>
							<th class="hidden-mobile">Estado</th>
							<th>Ajustes</th>
						</thead>
						<tbody>
							
						<?php 
						$n=0;
						if(!empty($bancos_cajas)){
							foreach ($bancos_cajas as $banco_caja) {
								$n++;
								if ($banco_caja->byc_tipo==0) {
									$tipo='Banco';
								}elseif ($banco_caja->byc_tipo==1) {
									$tipo='Caja';
								}elseif ($banco_caja->byc_tipo==2) {
									$tipo='Caja Chica';
								}
								
								
						?>
							<tr>
								<!-- <td><?php echo $n?></td> -->
								<td><?php echo $tipo ?></td>
								<td><?php echo $banco_caja->byc_referencia?></td>
								<td class="hidden-mobile"><?php echo $banco_caja->byc_cuenta_contable?></td>
								<td><?php echo $banco_caja->pln_descripcion?></td>
							<!-- 	<td><?php echo $banco_tarjeta->est_descripcion?></td> -->

							<?php
								if($banco_caja->byc_estado == 1){

								?>
								<td class="hidden-mobile">
								
									 <img title="Inactivar Bancos/Tarjetas" width="40px" height="40px" onclick="cambiar_es(2,<?php echo $banco_caja->byc_id?>)" src="../imagenes/activo.png"> 
									
								</td>
								<?php
								}else{
								?>
								<td class="hidden-mobile">
									 <img title="Activar Bancos/Tarjetas" width="40px" height="40px" onclick="cambiar_es(1,<?php echo $banco_caja->byc_id?>)" src="../imagenes/inactivo.png"> 
									
								</td>
								<?php
								}
								?>
								<td align="center">
									<div class="btn-group">
										<?php 
										if($permisos->rop_reporte){
										?>
											<button title="Ver detalles" type="button" class="btn btn-info btn-view" data-toggle="modal" data-target="#modal-default" value="<?php echo base_url();?>bancos_cajas/visualizar/<?php echo $banco_caja->byc_id?>"><span class="fa fa-eye"></span>
								            </button>
							            <?php
							        	}
										if($permisos->rop_actualizar){
										?>
											<a title="Editar Banco/tarjeta" href="<?php echo base_url();?>bancos_cajas/editar/<?php echo $banco_caja->byc_id?>/<?php echo $permisos->opc_id?>" class="btn btn-primary"> <span class="fa fa-edit"></span></a>
										<?php 
										}
										if($permisos->rop_eliminar){
										?>
										<!-- <a href="<?php echo base_url();?>bancos_tarjetas/eliminar/<?php echo $banco_tarjeta->btr_id?>/<?php echo $banco_tarjeta->btr_descripcion?>" class="btn btn-danger btn-remove"><span class="fa fa-trash"></span></a> -->
										<?php 
										}
										?>
									</div>
								</td>
							</tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>


</section>

<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bancos Y Cajas</h4>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
</div>
<script type="text/javascript">
	function cambiar_es(estado,id){
		 var base_url='<?php echo base_url();?>';
		 var op = <?php echo $actual_opc; ?>;
		
		Swal.fire({
		  title: 'Desea cambiar de estado al registro?',
		  showCancelButton: true,
		  confirmButtonText: 'Guardar',
		  denyButtonText: `Cancelar`,
		}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {

		    var  uri=base_url+"bancos_cajas/cambiar_estado/"+estado+"/"+id+"/"+op;
				      $.ajax({
				              url: uri,
				              type: 'POST',
				              success: function(dt){
				              	if(dt==1){
				              	   window.location.href = window.location.href;
				              	}else{
				              		swal("Error!", "No se pudo modificar .!", "warning");
				              	}
				                
				              } 
				        });

		  } else if (result.isDenied) {
		    // Swal.fire('No ha registrado cambios', '', 'info');
		  }
		})
	   
		 
	}
	
</script>
<script>
 function mostrar(){
    if($('#btr_tipo').val()=='2'){
      $('#div_dias').prop('style','display:block');
    }
 } 
</script>