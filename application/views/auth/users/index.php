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
                                    <a href="<?= base_url();?>auth/users/create" class="btn btn-default">Tambah <i class="fa fa-plus"></i></a>
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
										Data user
									</p>
									
                                    <table class="table table-bordered" id="datatable">
										<thead>
											<tr>
												<th data-field="no">#</th>
												<th data-field="name">Name</th>
												<th data-field="username">Username</th>
												<th data-field="role">Role</th>
												<th data-field="action">Action</th>

											</tr>
										</thead>
										<tbody>
                                            <?php $no=1; foreach($data as $data):?>
                                            <tr>
                                                <td><?= $no++;?>.</td>
                                                <td><?= $data->fullname;?></td>
                                                <td><?= $data->username;?></td>
                                                <td><?= $data->roles_title;?></td>
                                                <td>
                                                    <a href="<?= base_url()?>auth/users/detail/<?= $data->id;?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
											<?php endforeach;?>
										</tbody>
									</table>
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