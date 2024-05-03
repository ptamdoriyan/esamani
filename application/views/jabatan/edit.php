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
										<?=$title;?>
									</p>
									
                                    <form action="<?= base_url()?>ref/jabatan/update/" data-parsley-validate novalidate class="form-horizontal" method="POST">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nama</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control hidden" name="id" required value="<?= $data->id;?>">
                                                <input type="text" class="form-control" name="nama" required value="<?= $data->nama;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Deskripsi</label>
                                            <div class="col-md-10">
                                                <textarea name="deskripsi" class="form-control" cols="20" rows="5"><?= $data->deskripsi;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="offset-2 col-md-10 pull-right">
                                                <a href="<?= base_url();?>ref/jabatan" class="btn btn-white"><i class="fa fa-arrow-left"></i> Kembali</a>
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>  Simpan Perubahan</button>
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