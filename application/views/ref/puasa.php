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
									<a data-toggle="modal" data-target="#tambah" class="btn btn-default">Tambah <i class="fa fa-plus"></i></a>                                    
                                </div>

								<?php $this->load->view('part/title');?>
							</div>
						</div>
                        <?php $this->load->view('part/alert');?>
						

                        <!-- Main-Content -->
                        
                        <div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b><?=$title;?></b></h4>
									<p class="text-muted font-13">
										List
									</p>
									<div class="table-responsive">
										<table class="table table-sm table-striped text-nowrap" id="datatable">
											<thead>
												<tr>
													<th>No</th>
													<th>Tahun</th>
													<th>Dari</th>
													<th>Hingga</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach($data as $data):?>
												<tr>
													<td><?= $no++;?>.</td>
													<td><?= $data->year;?></td>
													<td><?= date("j M Y",strtotime($data->date_from));?></td>
													<td><?= date("j M Y",strtotime($data->date_to));?></td>
													<td>
														<a onclick="delete_puasa(<?=$data->id;?>)" class="btn btn-sm btn-danger"><i class="fa fa-close"></i></a>
													</td>
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

        <script>
            function delete_puasa(id)
                {
                //Ajax Load data from ajax
                    // console.log(id);
                    $.ajax({
                    url : "<?php echo site_url('ref/puasa/get')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('[name="id"]').val(data.id);
                        $('[name="date2"]').text(data.date_from+ " hingga " +data.date_to);


                        $('#hapus').modal('show'); // show bootstrap modal when complete loaded
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                    });
                }

            </script>

        
        <!-- Modal -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Hari Puasa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url();?>ref/puasa/add" method="POST" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Tanggal</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="date" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        
        <!-- Modal -->
        <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Hari Puasa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url();?>ref/puasa/delete" method="POST" class="form-horizontal">
                            <div class="modal-body">
                        <blockquote>
                            <p>
                                Apa anda yakin untuk menghapus hari puasa ini?
                            </p>
                            <br>
                            <!-- <span name="name2">Hari</span> -->
                            <h3>
                                <footer>
                                    <b><span name="date2">Source Title</citspane></b>
                                </footer>
                            </h3>
                        </blockquote>
                        <input type="text" class="form-control hidden" name="id">
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <?php $this->load->view('part/script');?>
        <script>
            $(function() {
                $('input[name="date"]').daterangepicker({
                    opens: 'left',
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
            });
            </script>

	</body>
</html>