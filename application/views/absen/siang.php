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
						<div class="mb-3 col-4">
							<label for="exampleFormControlInput1" class="form-label">Pilih Tanggal</label>
							<input type="date" class="form-control" id="datePicker">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-sm table-striped table-bordered text-nowrap">
								<thead>
									<tr>
										<th>Nomor</th>
										<th scope="col">Nama</th>
										<th scope="col">Kembali Istirahat</th>
									</tr>
								</thead>
								<tbody id="isi">

								</tbody>
							</table>
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

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
			//tentukan kalo date = null
			let date = null;
			// jalankan fungsi ambeData()
			ambeData(date);

			$('#datePicker').change(function(e) {
				e.preventDefault();

				let date = $('#datePicker').val();
				console.log(date);
				//jalankan fungsi ambeData() dengan tanggal yang baru
				$('#isi').empty();
				ambeData(date);

			});


			//simpan di function biar lebih functional, mudah dipanggil
			function ambeData(date) {
				$.ajax({
					type: "GET",
					url: "https://develop.pta-manado.go.id/api-absen/absen",
					data: {
						'date': date
					},
					dataType: "json",
					success: function(response) {
						console.log(response);
						let nomor = 1;
						$.each(response.absen_masuk, function(i, val) {
							if (val.jam_istirahat !== null) {
								let unix = val.jam_istirahat * 1000;
								var date = new Date(unix);
								var time = date.toLocaleTimeString("en-US");
								console.log(time);
								$('#isi').append(`
                                        <tr>
                                            <td>${nomor}</td>
                                            <td>${val.nama}</td>
                                            <td class = "masuk${i}">${time}</td>
                                        </tr>
                    					 `);
							} else {
								var time = "";
								$('#isi').append(`
                                        <tr>
                                            <td>${nomor}</td>
                                            <td>${val.nama}</td>
                                            <td class = "masuk${i} bg-danger">${time}</td>
                                        </tr>
                    					 `);
							}


							nomor++;
						});

						// $.each(response.absen_masuk, function(i, val) {
						// 	if (val.time !== null) {
						// 		let unix = val.time * 1000;
						// 		var date = new Date(unix);
						// 		var time = date.toLocaleTimeString("en-US");
						// 		console.log(time);

						// 		$('.masuk' + i).after(`
						//                     <td>${time}</td>
						// 					   `);
						// 	} else {
						// 		var time = "";
						// 		$('.masuk' + i).after(`
						//                     <td class="bg-danger">${time}</td>
						// 					   `);
						// 	}

						// });

					}
				});
			}



		});
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
