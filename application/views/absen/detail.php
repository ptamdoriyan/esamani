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
							<div class="col-sm-6">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Data</b></h4>
									<hr>
                                    <div class="form-group">
                                        <label class="control-label">Nama</label>
                                        <input type="text" class="form-control" name="name" disabled value="<?=$pegawai->nama;?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan" disabled value="<?=$pegawai->jabatan;?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal</label>
                                        <input type="text" class="form-control" name="date" disabled value="<?=$date;?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">Status Absensi</label><br>
                                                <span class="label" name="button" style="color:<?=$status['status']['text'];?>;background-color: <?=$status['status']['color'];?>"><?=$status['status']['code'];?></span> : <span name="desc"><?=$status['status']['name'];?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">Status Flag Terbaru</label><br>
                                                <?php if(isset($last_flag)):?>
                                                    <span class="label" name="button" style="color:<?=$last_flag->text;?>;background-color: <?=$last_flag->color;?>"><?=$last_flag->status;?></span> : <span name="desc"><?=$last_flag->name;?></span>
                                                <?php else:?>
                                                   <span name="desc">-</span>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" id="timetable" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Waktu Absen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($absen as $a): ?>
                                                <tr>
                                                    <td><?=$a['no'];?>.</td>
                                                    <td><?=$a['datetime'];?></td>
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
								</div>
                            </div>
                            <div class="col-sm-6">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Flagging</b></h4>
                                    <hr>
                                    <form action="<?= base_url();?>absen/add_flag" method="post">
                                        <div class="form-group">
                                            <label class="control-label">Flag Status</label>
                                            <input name="finger" type="text" value="<?=$pegawai->finger;?>" hidden>
                                            <input name="pegawai" type="text" value="<?=$pegawai->id;?>" hidden>
                                            <input name="date" type="text" value="<?=$date;?>" hidden>
                                            <select name="status" id="" class="form-control">
                                                <?php foreach ($flag as $f):?>
                                                    <option value="<?=$f->code;?>"><?=$f->code." - ".$f->name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Keterangan</label>
                                            <textarea name="keterangan" id="" cols="30" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
								</div>
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Data Flag</b></h4>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id="timetable" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kode</th>
                                                    <th>Status</th>
                                                    <th>Dibuat</th>
                                                    <th>Oleh</th>
                                                    <th>Keterangan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1;foreach ($data_flag as $df): ?>
                                                    <tr>
                                                        <td><?=$i++;?>.</td>
                                                        <td>
                                                            <span class="label text-white" style="background-color:<?=$df->color;?>"><?=$df->status;?></span>
                                                        </td>
                                                        <td><?=$df->name;?></td>
                                                        <td><?=date("Y-m-d H:i:s",$df->time);?></td>
                                                        <td><?=$df->operator;?></td>
                                                        <td><?=$df->keterangan;?></td>
                                                        <td><a href="<?=base_url();?>absen/delete_flag/<?=str_replace("-","",$date).$pegawai->finger;?>/<?=$df->id;?>" class="btn btn-danger"><i class="fa fa-close"></i></a></td>
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