<!DOCTYPE html>

<html>

<?php $this->load->view('part/head'); ?>



<body class="fixed-left">



	<!-- Begin page -->

	<div id="wrapper">



		<?php $this->load->view('part/topbar'); ?>

		<?php $this->load->view('part/sidebar'); ?>



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

								<form class="form-inline" role="form" method="POST" action="<?= base_url(); ?>absen/change/day">

									<div class="form-group">

										<input type="text" class="form-control" id="datepicker" name="date" value="<?= $date; ?>" required>

									</div>

									<button type="submit" class="btn btn-default waves-effect waves-light m-l-10 btn-md">Ubah</button>

								</form>

							</div>



							<?php $this->load->view('part/title'); ?>

						</div>

					</div>

					<?php $this->load->view('part/alert'); ?>





					<!-- Main-Content -->



					<div class="row">

						<div class="col-sm-12">

							<div class="card-box">

								<div class="btn-group pull-right">

									<a href="<?= base_url(); ?>absen/<?= date("Y-m-d", strtotime($date)); ?>/daily_print" target="_blank" class="btn btn-primary pull-right">Download PDF <i class="fa fa-download"></i></a>

								</div>

								<h4 class="m-t-0 header-title"><b><?= date("j F Y", strtotime($date)) ?></b></h4>

								<p class="text-muted font-13">

									List

								</p>

								<div class="">

									<table class="table table-sm table-striped table-bordered text-nowrap" id="all" style="font-size:10pt;">

										<thead style="background-color:#5b5a5a">

											<tr>

												<th style="color:white;vertical-align:middle;">No</th>

												<th style="color:white;vertical-align:middle;">Nama</th>

												<th style="color:white;vertical-align:middle;">NIP</th>

												<th style="color:white;vertical-align:middle;">Jabatan</th>

												<th style="color:white;vertical-align:middle;">Absen Masuk</th>

												<th style="color:white;vertical-align:middle;">Absen Pulang</th>

												<th style="color:white;vertical-align:middle;">Status Kehadiran</th>

												<th style="color:white;vertical-align:middle;">Deskripsi</th>



											</tr>

										</thead>

										<tbody>

											<?php $no = 1;
											foreach ($pegawai as $p) : ?>

												<tr>

													<td><?= $no++; ?>.</td>

													<td><?= $p->nama; ?></td>

													<td><?= $p->nip; ?></td>

													<td><?= $p->jabatan; ?></td>

													<td><?= (isset($status[$date][$p->finger]['masuk'])) ? date("H:i:s", $status[$date][$p->finger]['masuk']) : ""; ?></td>

													<td><?= (isset($status[$date][$p->finger]['pulang'])) ? date("H:i:s", $status[$date][$p->finger]['pulang']) : ""; ?></td>

													<?php if (isset($flag[$date][$p->id])) : ?>

														<td>

															<?php $param = date("Ymd", strtotime($date)) . $p->finger; ?>

															<a onclick="get(<?= $param; ?>)" class="btn btn-block" data-toggle="tooltip" data-placement="left" data-original-title="*Flag: <?= $flag[$date][$p->id]->name; ?>" style="background-color:<?= $flag[$date][$p->id]->color; ?>;color:<?= $flag[$date][$p->id]->text; ?>">

																<i>*<?= $flag[$date][$p->id]->code; ?></i>

															</a>

														</td>

														<td><?= $flag[$date][$p->id]->name; ?></td>

													<?php elseif (!isset($flag[$date][$p->id]) && isset($status[$date][$p->finger]['status'])) : ?>

														<td>

															<?php $param = date("Ymd", strtotime($date)) . $p->finger; ?>

															<a onclick="get(<?= $param; ?>)" class="btn btn-block" data-toggle="tooltip" data-placement="left" data-original-title="<?= $status[$date][$p->finger]['status']['name']; ?>" style="background-color:<?= $status[$date][$p->finger]['status']['color']; ?>;color:<?= $status[$date][$p->finger]['status']['text']; ?>">

																<?= $status[$date][$p->finger]['status']['code']; ?>

															</a>

														</td>

														<td><?= $status[$date][$p->finger]['status']['name']; ?></td>

													<?php else : ?>

														<td></td>

														<td></td>

													<?php endif; ?>

												</tr>

											<?php endforeach; ?>

										</tbody>

									</table>

								</div>

							</div>

						</div>

					</div>









				</div> <!-- container -->



			</div> <!-- content -->



			<?php $this->load->view('part/foot'); ?>



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

				url: "<?php echo site_url('/absen/get') ?>/" + id,

				type: "GET",

				dataType: "JSON",

				success: function(data)

				{

					$('[name="name"]').val(data.pegawai.nama);

					$('[name="jabatan"]').val(data.pegawai.jabatan);

					$('[name="date"]').val(data.date);



					$('[name="button"]').text(data.status.status.code);

					$('[name="button"]').css("background-color", data.status.status.color);

					$('[name="button"]').css("color", data.status.status.text);

					$('[name="desc"]').text(data.status.status.name);



					if (data.last_flag != null) {

						$('[name="button_flag"]').text(data.last_flag.code);

						$('[name="button_flag"]').css("background-color", data.last_flag.color);

						$('[name="button_flag"]').css("color", data.last_flag.text);

						$('[name="desc_flag"]').text(data.last_flag.name);

					}



					$('[name="detail"]').attr("href", "<?php echo site_url('/absen/detail') ?>/" + id);





					$('#timetable').dataTable({

						destroy: true,

						searching: false,

						ordering: false,

						paging: false,

						info: false,

						data: data.absen,

						columns: [

							{
								"width": "20%",
								"data": "no",
								"defaultContent": ""
							},

							{
								"width": "80%",
								"data": "datetime",
								"defaultContent": ""
							}

						]

					});







					$('#modalget').modal('show'); // show bootstrap modal when complete loaded

				},

				error: function(jqXHR, textStatus, errorThrown)

				{

					alert('Error get data from ajax');

				}

			});

		}
	</script>



	<?php $this->load->view('part/script'); ?>



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