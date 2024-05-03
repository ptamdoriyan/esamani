<!DOCTYPE html>
<html>
    <?php $this->load->view('part/head');?>
	
	<body class="fixed-left">

		<!-- Begin page -->
		<div id="wrapper">

            <?php $this->load->view('part/topbar');?>
            <?php $this->load->view('part/sidebar');?>

			<!-- ============================================================== -->
			<!-- Start right Content here -->
			<!-- ============================================================== -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<?php $this->load->view('part/title');?>
							</div>
						</div>
                        <?php $this->load->view('part/alert');?>
						

                        <!-- Main-Content -->
                        
                        <div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b><?=$title;?></b></h4>
									<p class="text-muted font-13">
										List
                                    </p>
                                    <form action="<?= base_url()?>ref/settings/update/" class="form-horizontal" method="POST">
                                    
									<div class="table-responsive">
										<table class="table table-sm table-striped text-nowrap">
											<thead>
												<tr>
													<th>#</th>
													<th>Name</th>
													<th>Desc</th>   
													<th width="40%">Value</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach($data as $data):?>
												<tr>
													<td><?= $no++;?>.</td>
                                                    <td><?= $data->name;?></td>
													<td><?= $data->description;?></td>
													<td>
                                                        <input type="text" class="form-control hidden" name="id[]" value="<?= $data->id;?>">
                                                        <input type="time" class="form-control" name="value[]" value="<?= $data->value;?>" required>
                                                    </td>
												</tr>
												<?php endforeach;?>
											</tbody>
										</table>
                                    </div>
                                    <div class="m-t-5 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg"> <i class="fa fa-check"></i> Submit</button>
                                    </div>
                                    </form>
								</div>
							</div>
						</div>

                       


                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <?php $this->load->view('part/foot');?>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



        </div>
        <!-- END wrapper -->

        <?php $this->load->view('part/script');?>

	</body>
</html>