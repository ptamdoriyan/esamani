<!-- ========== Left Sidebar Start ========== -->



<div class="left side-menu">

	<div class="sidebar-inner slimscrollleft">

		<!--- Divider -->

		<div id="sidebar-menu">

			<ul>



				<li class="text-muted menu-title">Main</li>



				<li>

					<a href="<?= base_url(); ?>home" class="waves-effect"><i class="ti-home"></i> <span> Beranda </span></a>

				</li>

				<?php if (

					in_array("main-absensi-harian", $this->session->userdata['logged_in']['permissions']) ||

					in_array("main-absensi-bulanan", $this->session->userdata['logged_in']['permissions']) ||

					in_array("main-absensi-tahunan", $this->session->userdata['logged_in']['permissions'])

				) : ?>

					<li class="has_sub">

						<a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i> <span> Absensi </span> <span class="menu-arrow"></span></a>

						<ul class="list-unstyled">

							<?php if (in_array("main-absensi-harian", $this->session->userdata['logged_in']['permissions'])) : ?>

								<li><a href="<?= base_url(); ?>absen/0/daily/">Harian</a></li>

							<?php endif; ?>
							<?php if (in_array("main-absensi-harian", $this->session->userdata['logged_in']['permissions'])) : ?>

								<li><a href="<?= base_url(); ?>absen/siang/">Siang</a></li>

							<?php endif; ?>

							<?php if (in_array("main-absensi-bulanan", $this->session->userdata['logged_in']['permissions'])) : ?>

								<li><a href="<?= base_url(); ?>absen/0/monthly/">Bulanan</a></li>

							<?php endif; ?>

							<?php if (in_array("main-absensi-tahunan", $this->session->userdata['logged_in']['permissions'])) : ?>

								<li><a href="<?= base_url(); ?>absen/0/yearly/">Tahunan</a></li>

							<?php endif; ?>

						</ul>

					</li>

				<?php endif; ?>



				<?php if (in_array("main-pegawai", $this->session->userdata['logged_in']['permissions'])) : ?>

					<li class="has_sub">

						<a href="javascript:void(0);" class="waves-effect"><i class="ti-id-badge"></i> <span> Pegawai </span> <span class="menu-arrow"></span></a>

						<ul class="list-unstyled">

							<li><a href="<?= base_url(); ?>pegawai">Daftar</a></li>

							<li><a href="<?= base_url(); ?>pegawai/create">Tambah</a></li>

						</ul>

					</li>

				<?php endif; ?>



				<?php if (

					in_array("ref-jabatan", $this->session->userdata['logged_in']['permissions']) ||

					in_array("ref-pengaturan-jam", $this->session->userdata['logged_in']['permissions']) ||

					in_array("ref-pengaturan-libur", $this->session->userdata['logged_in']['permissions']) ||

					in_array("ref-pengaturan-puasa", $this->session->userdata['logged_in']['permissions']) ||

					in_array("ref-pengaturan-kegiatan", $this->session->userdata['logged_in']['permissions'])

				) : ?>

					<li class="text-muted menu-title">Reference</li>

				<?php endif; ?>



				<?php if (in_array("ref-jabatan", $this->session->userdata['logged_in']['permissions'])) : ?>

					<li class="has_sub">

						<a href="javascript:void(0);" class="waves-effect"><i class="ti-id-badge"></i> <span> Jabatan </span> <span class="menu-arrow"></span></a>

						<ul class="list-unstyled">

							<li><a href="<?= base_url(); ?>ref/jabatan">Daftar</a></li>

							<li><a href="<?= base_url(); ?>ref/jabatan/create">Tambah</a></li>

						</ul>

					</li>

				<?php endif; ?>



				<?php if (

					in_array("ref-pengaturan-jam", $this->session->userdata['logged_in']['permissions']) ||

					in_array("ref-pengaturan-libur", $this->session->userdata['logged_in']['permissions']) ||

					in_array("ref-pengaturan-puasa", $this->session->userdata['logged_in']['permissions']) ||

					in_array("ref-pengaturan-kegiatan", $this->session->userdata['logged_in']['permissions'])

				) : ?>

					<li class="has_sub">

						<a href="javascript:void(0);" class="waves-effect"><i class="ti-settings"></i> <span> Pengaturan </span> <span class="menu-arrow"></span></a>

						<ul class="list-unstyled">

							<?php if (in_array("ref-pengaturan-jam", $this->session->userdata['logged_in']['permissions'])) : ?>

								<li><a href="<?= base_url(); ?>ref/settings">Jam Absensi</a></li>

							<?php endif; ?>

							<?php if (in_array("ref-pengaturan-libur", $this->session->userdata['logged_in']['permissions'])) : ?>

								<li><a href="<?= base_url(); ?>ref/libur">Hari Libur</a></li>

							<?php endif; ?>

							<?php if (in_array("ref-pengaturan-puasa", $this->session->userdata['logged_in']['permissions'])) : ?>

								<li><a href="<?= base_url(); ?>ref/puasa">Hari Puasa</a></li>

							<?php endif; ?>

							<?php if (in_array("ref-pengaturan-kegiatan", $this->session->userdata['logged_in']['permissions'])) : ?>

								<li><a href="<?= base_url(); ?>ref/kegiatan">Hari Kegiatan</a></li>

							<?php endif; ?>

						</ul>

					</li>

				<?php endif; ?>







				<?php if (

					in_array("auth-user", $this->session->userdata['logged_in']['permissions']) ||

					in_array("auth-role", $this->session->userdata['logged_in']['permissions']) ||

					in_array("auth-permission", $this->session->userdata['logged_in']['permissions'])

				) : ?>

					<li class="text-muted menu-title">Auth</li>

				<?php endif; ?>



				<?php if (in_array("auth-user", $this->session->userdata['logged_in']['permissions'])) : ?>

					<li class="has_sub">

						<a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i> <span> User </span> <span class="menu-arrow"></span></a>

						<ul class="list-unstyled">

							<li><a href="<?= base_url(); ?>auth/users">Daftar</a></li>

							<li><a href="<?= base_url(); ?>auth/users/create">Tambah</a></li>

						</ul>

					</li>

				<?php endif; ?>



				<?php if (in_array("auth-role", $this->session->userdata['logged_in']['permissions'])) : ?>

					<li class="has_sub">

						<a href="javascript:void(0);" class="waves-effect"><i class="ti-tag"></i> <span> Role </span> <span class="menu-arrow"></span></a>

						<ul class="list-unstyled">

							<li><a href="<?= base_url(); ?>auth/roles">Daftar</a></li>

							<li><a href="<?= base_url(); ?>auth/roles/create">Tambah</a></li>

						</ul>

					</li>

				<?php endif; ?>



				<?php if (in_array("auth-permission", $this->session->userdata['logged_in']['permissions'])) : ?>

					<!-- <li class="has_sub">

                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-check-box"></i> <span> Permissions </span> <span class="menu-arrow"></span></a>

                    <ul class="list-unstyled">

                        <li><a href="<?= base_url(); ?>auth/permissions">Daftar</a></li>

                        <li><a href="<?= base_url(); ?>auth/permissions/create">Tambah</a></li>

                    </ul>

                </li> -->

					<li>

						<a href="<?= base_url(); ?>auth/permissions" class="waves-effect"><i class="ti-check-box"></i> <span> Permissions </span></a>

					</li>

				<?php endif; ?>



			</ul>

			<div class="clearfix"></div>

		</div>

		<div class="clearfix"></div>

	</div>

</div>

<!-- Left Sidebar End -->
