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
									
                                    <form action="<?= base_url()?>auth/roles/permissions/update" data-parsley-validate novalidate class="form-horizontal" method="POST">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Title</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control hidden" name="roles_id" required value="<?= $data->id;?>">
                                                <input type="text" class="form-control" name="title" disabled value="<?= $data->title;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Description</label>
                                            <div class="col-md-10">
                                                <textarea name="description" class="form-control" cols="20" rows="5" disabled><?= $data->description;?></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Permissions</label>
                                            <div class="col-md-8 offset-md-2">
                                                <div class="row">
                                                    <?php foreach ($permissions as $p): ?>
                                                        <div class="col-md-4">
                                                            <div class="checkbox checkbox-primary">
                                                                <input id="checkbox<?=$p->id;?>" name="checkbox<?=$p->id;?>" type="checkbox" <?=(isset($has[$p->id]))? "checked":"";?>   >
                                                                <label for="checkbox<?=$p->id;?>">
                                                                    <?= $p->title;?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ;?>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
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