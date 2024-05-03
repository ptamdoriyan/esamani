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
									
                                    <form action="<?= base_url()?>pegawai/add/" data-parsley-validate novalidate class="form-horizontal" method="POST">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nama</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="nama" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">NIP</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" name="nip" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Jabatan</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="jabatan_id" required>
                                                    <option>--Pilih--</option>
                                                    <?php foreach($jabatan as $j):?>
                                                        <option value="<?=$j->id;?>"><?=$j->nama;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Gender</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="gender" required>
                                                    <option value="1">Laki-laki</option>
                                                    <option value="0">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Aktif Sejak</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="active" data-date-format="yyyy-mm-dd" id="datepicker" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">ID Finger</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" name="finger" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="offset-md-2 col-md-10 pull-right">
                                                <a href="<?= base_url();?>pegawai" class="btn btn-white"><i class="fa fa-arrow-left"></i> Kembali</a>
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>  Submit</button>
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