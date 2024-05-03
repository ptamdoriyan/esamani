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
									<h4 class="m-t-0 header-title"><b>Form</b></h4>
									<p class="text-muted font-13">
										Ubah user
									</p>
									
                                    <form action="<?= base_url()?>auth/users/update/" class="form-horizontal" method="POST">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Full Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control hidden" name="id" value="<?= $data->id;?>">
                                                <input type="text" class="form-control" name="fullname" value="<?= $data->fullname;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Username</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control hidden" name="username_before" value="<?= $data->username;?>">
                                                <input type="text" class="form-control" name="username" value="<?= $data->username;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Role</label>
                                            <div class="col-md-10">
                                                <select name="role" class="form-control">
                                                    <?php foreach ($roles as $r):?>
                                                        <option <?= ($r->id == $data->roles_id)? "selected":""; ?> value="<?=$r->id?>"><?=$r->title;?></option>
                                                    <?php endforeach ;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="offset-2 col-md-10 pull-right">
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </div>
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