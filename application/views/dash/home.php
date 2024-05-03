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
                            <div class="col-lg-3">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-custom pull-left">
                                        <i class="ion ion-calendar text-custom"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?= date("j M Y")?></b></h3>
                                        <p class="text-muted">Hari ini</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon bg-icon-custom pull-left">
                                        <i class="md md-assignment-ind text-custom"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?= number_format($pegawai);?> pegawai</b></h3>
                                        <p class="text-muted">Jumlah Pegawai</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-custom pull-left">
                                        <i class="md md-group-add text-custom"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?= number_format($hadir);?> pegawai</b></h3>
                                        <p class="text-muted">Jumlah Pegawai Hadir Hari ini</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-custom pull-left">
                                        <i class="md md-announcement text-custom"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><?= ($kegiatan == null)? "Tidak ada kegiatan":$kegiatan->name;?></h3>
                                        <p class="text-muted">Pemberitahuan</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-box text-center">
									<table class="table table-sm">
                                        <thead>
                                            <tr">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Waktu Sinkron Data</th>
                                                <th class="text-center">Dikirim</th>
                                                <th class="text-center">Tersimpan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;foreach ($last as $l):?>
                                                <tr>
                                                    <td><?=$no++;?>.</td>
                                                    <td class="text-left">
                                                        <?=date("Y-m-d H:i:s",$l->datetime);?>
                                                        <?php if(date("Y-m-d",$l->datetime) == date("Y-m-d")):?>
                                                            <span class="label label-success">Hari ini</span>
                                                        <?php endif;?>
                                                    </td>
                                                    <td><?=$l->data;?></td>
                                                    <td><?=$l->success;?></td>
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
								</div>
                            </div>
							<div class="col-lg-6">
								<div class="card-box text-center">
									<img src="<?= base_url();?>assets/images/dash.png" width="100%">
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
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        <?php foreach ($month as $m): ?>
                            '<?= date("j-M", strtotime($m['date']));?>',
                        <?php endforeach ;?>
                    ],
                    datasets: [
                        {
                            label: 'Revenue',
                            data: [
                                <?php foreach ($month as $m): ?>
                                    '<?= $m['data']->pay_whole-$m['data']->pay_retail;?>',
                                <?php endforeach ;?>
                            ],
                            borderColor: '#5fbeaa',
                            backgroundColor: 'rgba(0,0,0,0)'

                        },
                        {
                            label: 'Omzet',
                            data: [
                                <?php foreach ($month as $m): ?>
                                    '<?= $m['data']->pay_whole;?>',
                                <?php endforeach ;?>
                            ],
                            borderColor: '#f05050',
                            backgroundColor: 'rgba(0,0,0,0)'
                        }
                        
                    ]
                },
                options: {
					responsive: true
				}
            });
        </script>
        

	</body>
</html>