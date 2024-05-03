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
                                    <form class="form-inline" role="form" method="POST" action="<?=base_url();?>absen/change/year">
                                        <div class="form-group">
                                            <select name="year" class="form-control">
                                                <?php $year_now = date("Y");for($i=$year_now; $i >= 2016; $i--):?>
                                                    <option <?=($year == $i)?"selected":"";?> value="<?= $i?>"><?= $i?></option>
                                                <?php endfor;?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default waves-effect waves-light m-l-10 btn-md">Ubah</button>
                                    </form>                                     
                                </div>

								<?php $this->load->view('part/title');?>
							</div>
						</div>
                        <?php $this->load->view('part/alert');?>
						

                        <!-- Main-Content -->
                        
                        <div class="row">
							<div class="col-sm-12">
								<div class="card-box">
                                    <!-- <div class="btn-group pull-right">
                                        <a href="<?= base_url();?>absen/<?=$year;?>/monthly_print" target="_blank" class="btn btn-primary pull-right">Download PDF <i class="fa fa-download"></i></a>
                                    </div> -->

                                    <h4 class="m-t-15 header-title"><b>Rekap</b></h4>
									<p class="text-muted font-13">
										List
									</p>
                                    <table class="table table-sm table-bordered text-nowrap" id="all3" style="font-size:8pt;">
                                        <thead style="background-color:#5b5a5a">
                                            <tr>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">No</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Nama</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Jabatan</th>
                                                <th colspan="<?=count($ref_status);?>" style="color:white;vertical-align:middle;">Status</th>
                                                <th colspan="<?=count($ref_flag);?>" style="color:white;vertical-align:middle;">Flag</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Total</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Waktu Absen</th>
                                            </tr>
                                            <tr>
                                                <?php foreach ($ref_status as $rs):?>
                                                <th style="background-color:<?=$rs['color'];?>;color:<?=$rs['text'];?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?=$rs['name'];?>">
                                                        <center><?=$rs['code'];?></center>
                                                </th>
                                                <?php endforeach;?>
                                                <?php foreach ($ref_flag as $rf):?>
                                                <th style="background-color:<?=$rf->color;?>;color:<?=$rf->text;?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?=$rf->name;?>">
                                                        <center><?=$rf->code;?></center>
                                                </th>
                                                <?php endforeach;?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach($pegawai as $p):?>
                                            <tr height="10px">
                                                <td><?= $no++;?>.</td>
                                                <td><?= $p->nama;?></td>
                                                <td><?= $p->jabatan;?></td>
                                                <?php foreach ($ref_status as $rs):?>
                                                <td>
                                                    <?=($count[$p->finger][$rs['code']]['count']==0)? "":$count[$p->finger][$rs['code']]['count'];?>
                                                </td>
                                                <?php endforeach;?>
                                                <?php foreach ($ref_flag as $rf):?>
                                                <td>
                                                    <?=($countflag[$p->finger][$rf->code]['count']==0)? "":$countflag[$p->finger][$rf->code]['count'];?>
                                                </td>
                                                <?php endforeach;?>
                                                <td>
                                                    <?=$total[$p->finger]['count'];?>
                                                </td>
                                                <td>
                                                    <?=
                                                        (
                                                            $total[$p->finger]['absen']==0 &&
                                                            $total[$p->finger]['terlambat']['hari']==0
                                                        )? 
                                                            "":
                                                            $total[$p->finger]['absen']+$total[$p->finger]['terlambat']['hari']." hari kerja"
                                                    ;?>
                                                    <?=($total[$p->finger]['terlambat']['detik']>0 && gmdate("H", $total[$p->finger]['terlambat']['detik']) != "00")? " ".gmdate("H", $total[$p->finger]['terlambat']['detik'])." Jam":"";?>
                                                    <?=($total[$p->finger]['terlambat']['detik']>0 && gmdate("i", $total[$p->finger]['terlambat']['detik']) != "00")? " ".gmdate("i", $total[$p->finger]['terlambat']['detik'])." Menit":"";?>
                                                    <?=($total[$p->finger]['terlambat']['detik']>0 && gmdate("s", $total[$p->finger]['terlambat']['detik']) != "00")? " ".gmdate("s", $total[$p->finger]['terlambat']['detik'])." Detik":"";?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
									<div class="">
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

        <div class="modal fade" id="modalget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Absen</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" disabled>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" disabled>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal</label>
                        <input type="text" class="form-control" name="date" disabled>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Status Absensi</label><br>
                                <span class="label" name="button">Kode</span> : <span name="desc">Keterangan</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Status Flag Terbaru</label><br>
                                <span class="label" name="button_flag">-</span> : <span name="desc_flag">-</span>
                            </div>
                        </div>
                    </div>
                    <table class="display" id="timetable" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Waktu Absen</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a name="detail" target="_blank" class="btn btn-primary">Detail <i class="fa fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
        </div>

	</body>
</html>