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
                                <div class="btn-group pull-right m-t-15">
									<a href="<?= base_url();?>pegawai/create" class="btn btn-default">Tambah <i class="fa fa-plus"></i></a>                                    
                                </div>

								<?php $this->load->view('part/title');?>
							</div>
						</div>
                        <?php $this->load->view('part/alert');?>
						

                        <!-- Main-Content -->
                        
                        <div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>List</b></h4>
									<p class="text-muted font-13">
										List
									</p>
									<div class="table-responsive">
										<table class="table table-sm table-striped text-nowrap" id="datatable">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>NIP</th>
													<th>Jabatan</th>
													<th>Status</th>
													<th>Gender</th>
													<th>ID Finger</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach($data as $data):?>
												<tr>
													<td><?= $no++;?>.</td>
													<td><?= $data->nama;?></td>
													<td><?= $data->nip;?></td>
													<td><?= $data->jabatan;?></td>
													<td>
														<?php if($data->deactive == null):?>
															<span class="label label-success">Active</span>
														<?php else:?>
															<span class="label label-danger">Deactive</span>
														<?php endif;?>
													</td>
													<td><?= ($data->gender == 0)? "Perempuan":"Laki-laki";?></td>
													<td><?= $data->finger;?></td>
													<td>
														<a href="<?= base_url();?>pegawai/detail/<?= $data->id;?>" class="btn btn-sm btn-default">Detail <i class="fa fa-arrow-right"></i> </a>
													</td>
												</tr>
												<?php endforeach;?>
											</tbody>
										</table>
									</div>
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