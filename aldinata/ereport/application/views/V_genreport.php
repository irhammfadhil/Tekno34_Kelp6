<style type="text/css">
	.card{
		border: 1px solid rgba(0,0,0,.125)!important;
	}
</style>

<?php
$t = 1;
$a = 1;
$p = 1;
$i = 1;
if ($list_menu->code != 404 ) {
	$id_template = $id_template;
	foreach ($list_menu->data as $menu){
		foreach ($menu->menu as $child) { ?>
			<div class="card" style="border-bottom: 1px;">
				<div class="card-header" id="heading'.$p++.'">
					<h2 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $t++?>" aria-expanded="true" aria-controls="collapseOne">
							<?php echo $child->menu_name; ?>
						</button>
					</h2>
				</div>
				<div id="collapse<?php echo $a++?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<div class="row justify-content-left">
							<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
							<div class="col-sm-8">
								<input type="hidden" name="id_menu[]" value="<?php echo $child->id_menu?>">
								<textarea class="form-control" rows="5" name="insight[]"></textarea>
								<br>
							</div>
							<div class="col-sm-2">
							</div>
							<br>
							<div class="col-sm-12 table-responsive" style="padding:25px">
								<?php $this->load->view('V_table'.$child->id_menu.'') ?>
							</div>
						</div>
						<br>
						<hr>
						<?php 
						foreach ($child->menu_child as $mc ) { ?>
							<div class="card" style="margin-left: 100px;border-bottom: 1px;">
								<div class="card-header" id="heading <?php echo $p++ ?>" >
									<h2 class="mb-0">
										<button class="btn" type="button" aria-controls="collapseOne" style="color:#007bff;background-color:transparent">
											<u><?php echo $mc->menu_name ?></u>
										</button>
									</h2>
								</div>
								<br>
								<div class="row justify-content-left">
									<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
									<div class="col-sm-8">
										<input type="hidden" name="id_menu[]" value="<?php echo $mc->id_menu?>">
										<textarea class="form-control" rows="5" name="insight[]"></textarea>
										<br>
									</div>
									<div class="col-sm-2">
									</div>
									<br>

									<div class="col-sm-12 table-responsive" style="padding:25px">
										<?php $this->load->view('V_table'.$mc->id_menu.'') ?>
									</div>
									
								</div>
							</div>
							<br>
							<hr>
							<?php 
							foreach ($mc->menu_child as $mcc ) { ?>
								<div class="card" style="margin-left: 200px;border-bottom: 1px;">
									<div class="card-header" >
										<h2 class="mb-0">
											<button class="btn" type="button" aria-controls="collapseOne" style="color:#007bff;background-color:transparent">
												<u><?php echo $mcc->menu_name ?></u>
											</button>
										</h2>
									</div>
									<br>
									<div class="row justify-content-left">
										<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
										<div class="col-sm-8">
											<input type="hidden" name="id_menu[]" value="<?php echo $mcc->id_menu?>">
											<textarea class="form-control" rows="5" name="insight[]"></textarea>
											<br>
										</div>
										<div class="col-sm-2">
										</div>
										<br>

										<div class="col-sm-12 table-responsive" style="padding:25px">
											<?php $this->load->view('V_table'.$mcc->id_menu.'') ?>
										</div>
										
									</div>
								</div>
								<br>
								<hr>
							<?php	}
						} ?>
					</div>
				</div>
			</div>
			<br>
		<?php 	}

	}
} else {
	echo "No Data Avalaible";
} ?>