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
									
                                    <form action="<?= base_url()?>pegawai/update/" data-parsley-validate novalidate class="form-horizontal" method="POST">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nama</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control hidden" name="id" value="<?=$data->id;?>">
                                                <input type="text" class="form-control" name="nama" value="<?=$data->nama;?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">NIP</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" name="nip" value="<?=$data->nip;?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Jabatan</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="jabatan_id" required>
                                                    <?php foreach($jabatan as $j):?>
                                                        <option <?=($data->jabatan_id == $j->id)? "selected":"";?> value="<?=$j->id;?>"><?=$j->nama;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Gender</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="gender" required>
                                                    <option <?=($data->gender == 1)? "selected":"";?> value="1">Laki-laki</option>
                                                    <option <?=($data->gender == 0)? "selected":"";?> value="0">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Aktif Sejak</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="active" data-date-format="yyyy-mm-dd" id="datepicker" value="<?=$data->active;?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Status</label>
                                            <?php if($data->deactive == null):?>
                                                <div class="col-md-10">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#deactivate">Active</button>
                                                </div>
                                             <?php else:?>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#activate">Deactive</button>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="<?=$data->deactive;?>" disabled>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">ID Finger</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" name="finger" value="<?=$data->finger;?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="offset-md-2 col-md-10 pull-right">
                                                <a href="<?= base_url();?>pegawai" class="btn btn-white"><i class="fa fa-arrow-left"></i> Kembali</a>
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

        <div class="modal fade" id="activate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Aktivasi Pegawai</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <blockquote>
                        <p>Apa anda yakin untuk aktivasi data pegawai ini?</p>
                        <footer>Harap konfirmasi</footer>
                    </blockquote>
                </div>
                <div class="modal-footer">
                    <form action="<?= base_url();?>pegawai/activate" method="post">
                        <input type="text" name="id2" value="<?=$data->id;?>" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
              </div>
            </div>
        </div>

        <div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Aktivasi Pegawai</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <blockquote>
                        <p>Apa anda yakin untuk non-aktivasi data pegawai ini?</p>
                        <footer>Harap konfirmasi</footer>
                    </blockquote>
                </div>
                <div class="modal-footer">
                    <form action="<?= base_url();?>pegawai/deactivate" method="post">
                        <input type="text" name="id3" value="<?=$data->id;?>" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
              </div>
            </div>
        </div>

        <?php $this->load->view('part/script');?>

	</body>
</html>