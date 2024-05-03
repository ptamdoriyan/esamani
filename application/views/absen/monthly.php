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
                                    <form class="form-inline" role="form" method="POST" action="<?=base_url();?>absen/change/month">
                                        <div class="form-group">
                                            <select name="year" class="form-control">
                                                <?php $year_now = date("Y");for($i=$year_now; $i >= 2016; $i--):?>
                                                    <option <?=($ym[0] == $i)?"selected":"";?> value="<?= $i?>"><?= $i?></option>
                                                <?php endfor;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="month" class="form-control">
                                                <option <?=($ym[1] == "01")?"selected":"";?> value="01">Januari</option>
                                                <option <?=($ym[1] == "02")?"selected":"";?> value="02">Februari</option>
                                                <option <?=($ym[1] == "03")?"selected":"";?> value="03">Maret</option>
                                                <option <?=($ym[1] == "04")?"selected":"";?> value="04">April</option>
                                                <option <?=($ym[1] == "05")?"selected":"";?> value="05">Mei</option>
                                                <option <?=($ym[1] == "06")?"selected":"";?> value="06">Juni</option>
                                                <option <?=($ym[1] == "07")?"selected":"";?> value="07">Juli</option>
                                                <option <?=($ym[1] == "08")?"selected":"";?> value="08">Agustus</option>
                                                <option <?=($ym[1] == "09")?"selected":"";?> value="09">September</option>
                                                <option <?=($ym[1] == "10")?"selected":"";?> value="10">Oktober</option>
                                                <option <?=($ym[1] == "11")?"selected":"";?> value="11">November</option>
                                                <option <?=($ym[1] == "12")?"selected":"";?> value="12">Desember</option>
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
                                    <div class="btn-group pull-right">
                                        <a href="<?= base_url();?>absen/<?=$ym[0]."-".$ym[1];?>/monthly_print" target="_blank" class="btn btn-primary pull-right">Download PDF <i class="fa fa-download"></i></a>
                                    </div>
									<h4 class="m-t-0 header-title"><b>Data Absen</b></h4>
									<p class="text-muted font-13">
										List
									</p>

                                    <table class="table table-sm table-bordered text-nowrap" id="all" style="font-size:8pt;">
                                        <thead style="background-color:#5b5a5a">
                                            <tr>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">No</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Nama</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Jabatan</th>
                                                <th colspan="<?=$d;?>" style="color:white;vertical-align:middle;" class="text-center"><?= date("F", strtotime($ym[0]."-".$ym[1]."-01"))?></th>
                                                
                                            </tr>
                                            <tr>
                                                <?php 
                                                    for ($i=1; $i <= $d; $i++): 
                                                    
                                                ?>
                                                <?php $date = $ym[0]."-".$ym[1]."-".sprintf("%02s", $i);?>
                                                <th
                                                    <?php if($libur[$date]): ?>
                                                        style="color:white;background-color:#ff4000"
                                                    <?php elseif(!$libur[$date] && $date == date("Y-m-d")): ?>
                                                        style="color:white;background-color:#337ef8"
                                                    <?php elseif(!$libur[$date] && $date != date("Y-m-d") && (date('D',strtotime($date)) == "Sat" || date('D',strtotime($date)) == "Sun")): ?>
                                                        style="color:white;background-color:#ffb500"
                                                    <?php else: ?>
                                                        style="color:white"
                                                    <?php endif; ?>
                                                >
                                                    <a 
                                                        href="<?= base_url();?>absen/<?=$date?>/daily" 
                                                        target="_blank" 
                                                        style="color:white"
                                                        <?php if($libur[$date]):?>
                                                            data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$libur[$date]->name;?>"
                                                        <?php endif?>
                                                    >
                                                        <?php if($puasa[$date]):?>
                                                            <span class="badge badge-success" data-toggle="tooltip" data-placement="left" title="" data-original-title="Puasa">p</span>
                                                        <?php endif?>
                                                        <?php if($kegiatan[$date]):?>
                                                            <span class="badge badge-primary" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$kegiatan[$date]->name;?>">k</span>
                                                        <?php endif?>
                                                        <center><?php echo date("j",strtotime($date)) ?></center>
                                                        <center style="font-size:6pt"><?php echo date("D",strtotime($date)) ?></center>
                                                    </a>
                                                </th>
                                                <?php endfor;?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach($pegawai as $p):?>
                                            <tr height="10px">
                                                <td><?= $no++;?>.</td>
                                                <td><?= $p->nama;?></td>
                                                <td><?= $p->jabatan;?></td>
                                                <?php for ($i=1; $i <= $d; $i++):?> 
                                                    <?php $date = $ym[0]."-".$ym[1]."-".sprintf("%02s", $i);?>
                                                    <?php if(isset($flag[$date][$p->id])):?>
                                                        <td style="background-color:<?= $flag[$date][$p->id]->color;?>" width="10px" class="text-center" href="#" target="_blank">
                                                            <?php $param = $ym[0].$ym[1].sprintf("%02s", $i).$p->finger;?>
                                                            <a onclick="get(<?=$param;?>)" style="color:<?= $flag[$date][$p->id]->text;?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="*Flag: <?= $flag[$date][$p->id]->name;?>">
                                                                <i>*<?= $flag[$date][$p->id]->code;?></i>
                                                            </a>
                                                        </td>
                                                    <?php elseif(!isset($flag[$date][$p->id]) && isset($status[$date][$p->finger]['status'])):?>
                                                        <td style="background-color:<?= $status[$date][$p->finger]['status']['color'];?>" width="10px" class="text-center" href="#" target="_blank">
                                                            <?php $param = $ym[0].$ym[1].sprintf("%02s", $i).$p->finger;?>
                                                            <a onclick="get(<?=$param;?>)" style="color:<?= $status[$date][$p->finger]['status']['text'];?>"  data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= $status[$date][$p->finger]['status']['name'];?>">
                                                                <?= $status[$date][$p->finger]['status']['code'];?>
                                                            </a>
                                                        </td>
                                                    <?php else:?>
                                                        <td></td>
                                                    <?php endif;?>
                                                <?php endfor;?>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h4 class="m-t-15 header-title"><b>Rekap</b></h4>
									<p class="text-muted font-13">
										List
									</p>
                                    <table class="table table-sm table-bordered text-nowrap" id="all2" style="font-size:8pt;">
                                        <thead style="background-color:#5b5a5a">
                                            <tr>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">No</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Nama</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Jabatan</th>
                                                <th colspan="<?=count($ref_status);?>" style="color:white;vertical-align:middle;">Status</th>
                                                <th colspan="<?=count($ref_flag);?>" style="color:white;vertical-align:middle;">Flag</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Total</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Potongan</th>
                                                <th rowspan="2" style="color:white;vertical-align:middle;">Waktu Absen</th>
                                            </tr>
                                            <tr>
                                                <?php foreach ($ref_status as $rs):?>
                                                <th style="background-color:<?=$rs['color'];?>;color:<?=$rs['text'];?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?=$rs['name'];?>">
                                                        <center><?=$rs['code'];?></center>
                                                        <center style="font-size:6pt"><?=$rs['potongan'];?>%</center>
                                                </th>
                                                <?php endforeach;?>
                                                <?php foreach ($ref_flag as $rf):?>
                                                <th style="background-color:<?=$rf->color;?>;color:<?=$rf->text;?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?=$rf->name;?>">
                                                        <center><?=$rf->code;?></center>
                                                        <center style="font-size:6pt"><?=$rf->potongan;?>%</center>
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
                                                    <?=($count[$p->finger][$rs['code']]['count']==0)? "":"(".$count[$p->finger][$rs['code']]['potongan']."%)";?>
                                                </td>
                                                <?php endforeach;?>
                                                <?php foreach ($ref_flag as $rf):?>
                                                <td>
                                                    <?=($countflag[$p->finger][$rf->code]['count']==0)? "":$countflag[$p->finger][$rf->code]['count'];?>
                                                    <?=($countflag[$p->finger][$rf->code]['count']==0)? "":"(".$countflag[$p->finger][$rf->code]['potongan']."%)";?>
                                                </td>
                                                <?php endforeach;?>
                                                <td>
                                                    <?=$total[$p->finger]['count'];?>
                                                </td>
                                                <td>
                                                    <?=($total[$p->finger]['potongan']==0)? "":"".$total[$p->finger]['potongan']."%";?>
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

        <script>
            function get(id)
                {
                //Ajax Load data from ajax
                    // console.log(id);
                    $.ajax({
                    url : "<?php echo site_url('/absen/get')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('[name="name"]').val(data.pegawai.nama);
                        $('[name="jabatan"]').val(data.pegawai.jabatan);
                        $('[name="date"]').val(data.date);

                        $('[name="button"]').text(data.status.status.code);
                        $('[name="button"]').css("background-color",data.status.status.color);
                        $('[name="button"]').css("color",data.status.status.text);
                        $('[name="desc"]').text(data.status.status.name);

                        if (data.last_flag != null){
                            $('[name="button_flag"]').text(data.last_flag.code);
                            $('[name="button_flag"]').css("background-color",data.last_flag.color);
                            $('[name="button_flag"]').css("color",data.last_flag.text);
                            $('[name="desc_flag"]').text(data.last_flag.name);
                        }

                        $('[name="detail"]').attr("href", "<?php echo site_url('/absen/detail')?>/" + id);
                        
                        
                        $('#timetable').dataTable( {
                            destroy:        true,
                            searching:      false,
                            ordering:       false,
                            paging:         false,
                            info:           false,
                            data:           data.absen,
                            columns :       [
                                                { "width": "20%","data" : "no","defaultContent": "" },
                                                { "width": "80%","data" : "datetime","defaultContent": "" }
                                            ]
                        } );



                        $('#modalget').modal('show'); // show bootstrap modal when complete loaded
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                    });
                }

            </script>

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