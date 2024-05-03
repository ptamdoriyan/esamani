<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_absen extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		if (!($this->session->userdata('logged_in'))) {
			redirect('login');
		}

		$this->load->model('auth/table_users');
		$this->load->model('table_pegawai');
		$this->load->model('table_data');
		$this->load->model('table_flag');
		$this->load->model('table_flag_data');
		$this->load->model('table_ref');

		$this->status     = $this->table_ref->status();
		$this->settings   = $this->table_ref->settings();
		$this->flag       = $this->table_flag->all();
	}

	public function yearly($year)
	{
		if (!in_array("main-absensi-tahunan", $this->session->userdata('logged_in')['permissions'])) {
			redirect('home');
		}
		if ($year == 0) {
			$date  = date("Y-m");
		}

		if ($year == 0) {
			$year  = date("Y");
		}

		$begin = new DateTime($year . "-01-01");
		$end   = new DateTime(($year + 1) . "-01-01");

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);

		$title      = "Data Absen Tahunan - " . $year;
		$pegawai    = $this->table_pegawai->all();
		$ref_status = $this->status;
		$ref_flag   = $this->flag;

		foreach ($pegawai as $p) {
			foreach ($ref_status as $rs) {
				$count[$p->finger][$rs['code']]['count'] = 0;
			}
			foreach ($ref_flag as $rf) {
				$countflag[$p->finger][$rf->code]['count'] = 0;
			}
			$total[$p->finger]['count'] = 0;
			$total[$p->finger]['potongan'] = 0;
			$total[$p->finger]['waktu'] = 0;
			$total[$p->finger]['absen'] = 0;
			$total[$p->finger]['terlambat']['hari'] = 0;
			$total[$p->finger]['terlambat']['waktu'] = 0;
		}

		foreach ($period as $dt) {
			$date = $dt->format("Y-m-d");

			if ($date == date("Y-m-d")) {
				break;
			}
			$absen[$date]   = $this->table_data->filter_date($date);

			$puasa[$date]    = $this->table_ref->puasa(strtotime($date));
			$libur[$date]    = $this->table_ref->libur($date);
			$kegiatan[$date] = $this->table_ref->kegiatan($date);

			foreach ($pegawai as $p) {
				if ($libur[$date]) {
					$flag[$date][$p->finger]             = null;
					$status[$date][$p->finger]['status'] = $this->status['ld'];
				} else {
					$flag[$date][$p->id] = $this->table_flag_data->filter_month($date, $p->id);

					if (strtotime($date) > time()) {
						$status[$date][$p->finger]['status'] = null;
					} elseif (strtotime($date) <= time() && !$kegiatan[$date] && (date("D", strtotime($date)) == "Sat" || date("D", strtotime($date)) == "Sun")) {
						$status[$date][$p->finger]['status'] = $this->status['l'];
					} else {

						if (isset($absen[$date][$p->finger])) {
							$status[$date][$p->finger] = $this->check_status($date, $absen[$date][$p->finger]);
						} else {
							$status[$date][$p->finger] = $this->check_status($date, null);
						}
					}
				}
				if (isset($status[$date][$p->finger]['status'])) {
					$total[$p->finger]['count']++;
				}
				if (isset($status[$date][$p->finger]['status']['code'])) {
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['count']++;
				}
				if (isset($flag[$date][$p->id])) {
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['count']--;

					$countflag[$p->finger][$flag[$date][$p->id]->code]['count']++;
				} else {
					if (isset($status[$date][$p->finger]['waktu'])) {
						$total[$p->finger]['waktu'] += $status[$date][$p->finger]['waktu'];
					}
				}
			}
		}

		foreach ($pegawai as $p) {
			$total[$p->finger]['absen'] = $count[$p->finger]['tk']['count'] + $countflag[$p->finger]['tk']['count'] + $countflag[$p->finger]['cs5']['count'];
			$total[$p->finger]['terlambat'] = $this->secondsToTime($total[$p->finger]['waktu']);
		}
		// echo "<pre>";
		// echo print_r(compact('flag'));
		// echo "</pre>";
		// die();


		$this->load->view('absen/yearly', compact('title', 'pegawai', 'year', 'absen', 'status', 'flag', 'libur', 'puasa', 'kegiatan', 'ref_status', 'ref_flag', 'count', 'countflag', 'total'));
	}

	public function monthly($date)
	{
		if (!in_array("main-absensi-bulanan", $this->session->userdata('logged_in')['permissions'])) {
			redirect('home');
		}
		if ($date == 0) {
			$date  = date("Y-m");
		}
		$ym         = explode("-", $date);
		// $d          = cal_days_in_month(CAL_GREGORIAN, $ym[1], $ym[0]);
		$d          = date('t', mktime(0, 0, 0, $ym[1], 1, $ym[0]));

		$title      = "Data Absen Bulanan - " . date("F Y", strtotime($date . "-01"));
		$pegawai    = $this->table_pegawai->all();
		$ref_status = $this->status;
		$ref_flag   = $this->flag;

		foreach ($pegawai as $p) {
			foreach ($ref_status as $rs) {
				$count[$p->finger][$rs['code']]['count'] = 0;
				$count[$p->finger][$rs['code']]['potongan'] = 0;
			}
			foreach ($ref_flag as $rf) {
				$countflag[$p->finger][$rf->code]['count'] = 0;
				$countflag[$p->finger][$rf->code]['potongan'] = 0;
			}
			$total[$p->finger]['count'] = 0;
			$total[$p->finger]['potongan'] = 0;
			$total[$p->finger]['waktu'] = 0;
			$total[$p->finger]['absen'] = 0;
			$total[$p->finger]['terlambat']['hari'] = 0;
			$total[$p->finger]['terlambat']['waktu'] = 0;
		}

		for ($i = 1; $i <= $d; $i++) {
			$date = $ym[0] . "-" . $ym[1] . "-" . sprintf("%02s", $i);
			$absen[$date]   = $this->table_data->filter_date($date);

			$puasa[$date]    = $this->table_ref->puasa(strtotime($date));
			$libur[$date]    = $this->table_ref->libur($date);
			$kegiatan[$date] = $this->table_ref->kegiatan($date);

			foreach ($pegawai as $p) {
				if ($libur[$date]) {
					$flag[$date][$p->finger]             = null;
					$status[$date][$p->finger]['status'] = $this->status['ld'];
				} else {
					$flag[$date][$p->id] = $this->table_flag_data->filter_month($date, $p->id);

					if (strtotime($date) > time()) {
						$status[$date][$p->finger]['status'] = null;
					} elseif (strtotime($date) <= time() && !$kegiatan[$date] && (date("D", strtotime($date)) == "Sat" || date("D", strtotime($date)) == "Sun")) {
						$status[$date][$p->finger]['status'] = $this->status['l'];
					} else {

						if (isset($absen[$date][$p->finger])) {
							$status[$date][$p->finger] = $this->check_status($date, $absen[$date][$p->finger]);
						} else {
							$status[$date][$p->finger] = $this->check_status($date, null);
						}
					}
				}
				if (isset($status[$date][$p->finger]['status'])) {
					$total[$p->finger]['count']++;
				}
				if (isset($status[$date][$p->finger]['status']['code'])) {
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['count']++;
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['potongan'] += $ref_status[$status[$date][$p->finger]['status']['code']]['potongan'];
					$total[$p->finger]['potongan'] += $ref_status[$status[$date][$p->finger]['status']['code']]['potongan'];
				}
				if (isset($flag[$date][$p->id])) {
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['count']--;
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['potongan'] -= $ref_status[$status[$date][$p->finger]['status']['code']]['potongan'];
					$total[$p->finger]['potongan'] += $ref_status[$status[$date][$p->finger]['status']['code']]['potongan'];

					$countflag[$p->finger][$flag[$date][$p->id]->code]['count']++;
					$countflag[$p->finger][$flag[$date][$p->id]->code]['potongan'] += $flag[$date][$p->id]->potongan;
					$total[$p->finger]['potongan'] += $flag[$date][$p->id]->potongan;
				} else {
					if (isset($status[$date][$p->finger]['waktu'])) {
						$total[$p->finger]['waktu'] += $status[$date][$p->finger]['waktu'];
					}
				}
			}
		}

		foreach ($pegawai as $p) {
			$total[$p->finger]['absen'] = $count[$p->finger]['tk']['count'] + $countflag[$p->finger]['tk']['count'] + $countflag[$p->finger]['cs5']['count'];
			$total[$p->finger]['terlambat'] = $this->secondsToTime($total[$p->finger]['waktu']);
		}
		// echo "<pre>";
		// echo print_r(compact('total'));
		// echo "</pre>";
		// die();


		$this->load->view('absen/monthly', compact('title', 'pegawai', 'ym', 'd', 'absen', 'status', 'flag', 'libur', 'puasa', 'kegiatan', 'ref_status', 'ref_flag', 'count', 'countflag', 'total'));
	}

	public function daily($date)
	{
		if (!in_array("main-absensi-harian", $this->session->userdata('logged_in')['permissions'])) {
			redirect('home');
		}
		if ($date == 0) {
			$date  = date("Y-m-d");
		}

		$title      = "Data Absen Harian - " . date("j M Y", strtotime($date));
		$pegawai    = $this->table_pegawai->all();

		$absen[$date]    = $this->table_data->filter_date($date);

		// var_dump($absen[$date]);
		// die;


		$libur[$date]    = $this->table_ref->libur($date);
		$kegiatan[$date] = $this->table_ref->kegiatan($date);
		foreach ($pegawai as $p) {
			if ($libur[$date]) {
				$flag[$date][$p->finger]             = null;
				$status[$date][$p->finger]['status'] = $this->status['ld'];
			} else {
				$flag[$date][$p->id] = $this->table_flag_data->filter_month($date, $p->id);

				if (strtotime($date) > time()) {
					$status[$date][$p->finger]['status'] = null;
				} elseif (strtotime($date) <= time() && !$kegiatan[$date] && (date("D", strtotime($date)) == "Sat" || date("D", strtotime($date)) == "Sun")) {
					$status[$date][$p->finger]['status'] = $this->status['l'];
				} else {

					if (isset($absen[$date][$p->finger])) {
						$status[$date][$p->finger] = $this->check_status($date, $absen[$date][$p->finger]);
					} else {
						$status[$date][$p->finger] = $this->check_status($date, null);
					}
				}
			}
		}
		// echo "<pre>";
		// echo print_r(compact('ref_status'));
		// echo "</pre>";
		// die();


		$this->load->view('absen/daily', compact('title', 'pegawai', 'date', 'absen', 'status', 'flag'));
	}

	public function change($param)
	{
		if ($param == "day") {
			$date   = $this->input->post('date');
			redirect("absen/" . $date . "/daily");
		} elseif ($param == "month") {
			$year   = $this->input->post('year');
			$month  = $this->input->post('month');
			redirect("absen/" . $year . "-" . $month . "/monthly");
		} elseif ($param == "year") {
			$year   = $this->input->post('year');
			redirect("absen/" . $year . "/yearly");
		}
	}

	public function get($param)
	{

		$date       = date("Y-m-d", strtotime(substr($param, 0, 8)));
		$finger     = substr($param, 8);
		$pegawai    = $this->table_pegawai->get_finger($finger);
		$absen      = $this->table_data->filter_finger_date($date, $finger);
		$last_flag  = $this->table_flag_data->get_last($date, $pegawai->id);

		$libur      = $this->table_ref->libur($date);
		$kegiatan    = $this->table_ref->kegiatan($date);


		if ($libur) {
			$status['status'] = $this->status['ld'];
		} else {
			if (!$kegiatan && (date("D", strtotime($date)) == "Sat" || date("D", strtotime($date)) == "Sun")) {
				$status['status'] = $this->status['l'];
			} else {
				$status = $this->check_status($date, $absen);
			}
		}


		// $status     = $this->check_status($absen);
		echo json_encode(compact('pegawai', 'absen', 'date', 'status', 'last_flag'));

		// echo "<pre>";
		// echo print_r(compact('pegawai','data'));
		// echo "</pre>";
		// die();

	}

	private function check_status($date, $absen = null)
	{

		if ($absen == null) {
			$data['status'] = $this->status['tk'];
		} else {
			$count = count($absen);

			if ($count == 0 || ($count == 1 && $absen[0]['time'] == "")) {
				$data['status'] =  $this->status['tk'];
			} else {

				$kegiatan = $this->table_ref->kegiatan($date);
				$puasa    = $this->table_ref->puasa($absen[0]['time']);
				if ($kegiatan) {
					$m  = $kegiatan->time_from;
					$p  = $kegiatan->time_to;
				} else {
					if (date("D", strtotime($date)) == "Fri") {
						if ($puasa) {
							$m  = $puasa->time_fri_from;
							$p  = $puasa->time_fri_to;
						} else {
							$m  = $this->settings['masuk_jumat'];
							$p  = $this->settings['pulang_jumat'];
						}
					} else {
						if ($puasa) {
							$m  = $puasa->time_from;
							$p  = $puasa->time_to;
						} else {
							$m  = $this->settings['masuk'];
							$p  = $this->settings['pulang'];
						}
					}
				}

				$tengah = date("H:i:s", (strtotime($m) + strtotime($p)) / 2);
				if ($count == 1 && $absen[0]['time'] != "") {
					if ($absen[0]['time'] <= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $tengah)) {
						$data['masuk']  = $absen[0]['time'];
						$data['status'] =  $this->status['tap'];
					} else {
						$data['pulang'] = $absen[0]['time'];
						$data['status'] =  $this->status['tam'];
					}
				} else {

					if (
						min((array_column($absen, 'time'))) <= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $tengah) &&
						max((array_column($absen, 'time'))) <= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $tengah)
					) {
						$data['masuk']  = min((array_column($absen, 'time')));
						$data['status'] =  $this->status['tap'];
					} elseif (
						min((array_column($absen, 'time'))) >= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $tengah) &&
						max((array_column($absen, 'time'))) >= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $tengah)
					) {
						$data['pulang']  = max((array_column($absen, 'time')));
						$data['status'] =  $this->status['tam'];
					} else {
						$data['masuk']  = min((array_column($absen, 'time')));
						$data['pulang'] = max((array_column($absen, 'time')));

						if (
							min((array_column($absen, 'time'))) <= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $m) &&
							max((array_column($absen, 'time'))) >= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $p)
						) {
							$data['status'] =  $this->status['v'];
						} elseif (
							min((array_column($absen, 'time'))) <= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $m) &&
							max((array_column($absen, 'time'))) <= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $p)
						) {
							$data['status'] =  $this->status['bw'];
							$data['waktu'] =  strtotime(date("Y-m-d", $absen[0]['time']) . " " . $p) - max((array_column($absen, 'time')));
						} elseif (
							min((array_column($absen, 'time'))) >= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $m) &&
							max((array_column($absen, 'time'))) >= strtotime(date("Y-m-d", $absen[0]['time']) . " " . $p)
						) {
							$data['status'] =  $this->status['t'];
							$data['waktu'] =  min((array_column($absen, 'time'))) - strtotime(date("Y-m-d", $absen[0]['time']) . " " . $m);
						} else {
							$data['status'] =  $this->status['t'];
							$data['waktu'] =  (min((array_column($absen, 'time'))) - strtotime(date("Y-m-d", $absen[0]['time']) . " " . $m)) + ($data['waktu'] =  strtotime(date("Y-m-d", $absen[0]['time']) . " " . $p) - max((array_column($absen, 'time'))));
						}
					}
				}
			}
		}
		return $data;
	}

	public function detail($param)
	{
		$title      = "Detail Absensi";
		$date       = date("Y-m-d", strtotime(substr($param, 0, 8)));
		$finger     = substr($param, 8);
		$pegawai    = $this->table_pegawai->get_finger($finger);
		$absen      = $this->table_data->filter_finger_date($date, $finger);
		$flag       = $this->table_flag->all();
		$data_flag  = $this->table_flag_data->filter($date, $pegawai->id);
		$last_flag  = $this->table_flag_data->get_last($date, $pegawai->id);

		$libur      = $this->table_ref->libur($date);
		$kegiatan    = $this->table_ref->kegiatan($date);

		if ($libur) {
			$status['status'] = $this->status['ld'];
		} else {
			if (!$kegiatan && (date("D", strtotime($date)) == "Sat" || date("D", strtotime($date)) == "Sun")) {
				$status['status'] = $this->status['l'];
			} else {
				$status = $this->check_status($date, $absen);
			}
		}


		// echo "<pre>";
		// echo print_r(compact('date','pegawai','absen','status','flag','data_flag'));
		// echo "</pre>";
		// die();

		$this->load->view('absen/detail', compact('title', 'date', 'pegawai', 'absen', 'status', 'flag', 'data_flag', 'last_flag'));
	}

	public function add_flag()
	{
		if (!in_array("main-flagging", $this->session->userdata('logged_in')['permissions'])) {
			$this->session->set_flashdata('error', "Gagal! Anda tidak dapat membuat flag absen.");
			redirect("absen/detail/" . str_replace("-", "", $this->input->post('date')) . $this->input->post('finger'));
		}
		$data['pegawai']    = $this->input->post('pegawai');
		$data['tanggal']    = $this->input->post('date');
		$data['status']     = $this->input->post('status');
		$data['keterangan'] = $this->input->post('keterangan');
		$data['operator']   = $this->session->userdata['logged_in']['id'];
		$data['time']       = time();

		// echo "<pre>";
		// echo print_r(compact('data'));
		// echo "</pre>";
		// die();

		$this->table_flag_data->add($data);

		$this->session->set_flashdata('success', "Berhasil! Data berhasil terinput.");
		redirect("absen/detail/" . str_replace("-", "", $this->input->post('date')) . $this->input->post('finger'));
	}

	public function delete_flag($param, $id)
	{
		$this->table_flag_data->delete($id);

		$this->session->set_flashdata('warning', "Berhasil! Data berhasil terhapus.");
		redirect("absen/detail/" . $param);
	}

	public function monthly_print($date)
	{

		if ($date == 0) {
			$date  = date("Y-m");
		}
		$ym         = explode("-", $date);
		// $d          = cal_days_in_month(CAL_GREGORIAN, $ym[1], $ym[0]);
		$d          = date('t', mktime(0, 0, 0, $ym[1], 1, $ym[0]));

		$title      = "Data Absen Bulanan - " . date("F Y", strtotime($date . "-01"));
		$pegawai    = $this->table_pegawai->all();
		$ref_status = $this->status;
		$ref_flag   = $this->flag;

		foreach ($pegawai as $p) {
			foreach ($ref_status as $rs) {
				$count[$p->finger][$rs['code']]['count'] = 0;
				$count[$p->finger][$rs['code']]['potongan'] = 0;
			}
			foreach ($ref_flag as $rf) {
				$countflag[$p->finger][$rf->code]['count'] = 0;
				$countflag[$p->finger][$rf->code]['potongan'] = 0;
			}
			$total[$p->finger]['count'] = 0;
			$total[$p->finger]['potongan'] = 0;
			$total[$p->finger]['waktu'] = 0;
			$total[$p->finger]['absen'] = 0;
			$total[$p->finger]['terlambat']['hari'] = 0;
			$total[$p->finger]['terlambat']['waktu'] = 0;
		}

		for ($i = 1; $i <= $d; $i++) {
			$date = $ym[0] . "-" . $ym[1] . "-" . sprintf("%02s", $i);
			$absen[$date]   = $this->table_data->filter_date($date);

			$puasa[$date]    = $this->table_ref->puasa(strtotime($date));
			$libur[$date]    = $this->table_ref->libur($date);
			$kegiatan[$date] = $this->table_ref->kegiatan($date);

			foreach ($pegawai as $p) {
				if ($libur[$date]) {
					$flag[$date][$p->finger]             = null;
					$status[$date][$p->finger]['status'] = $this->status['ld'];
				} else {
					$flag[$date][$p->id] = $this->table_flag_data->filter_month($date, $p->id);

					if (strtotime($date) > time()) {
						$status[$date][$p->finger]['status'] = null;
					} elseif (strtotime($date) <= time() && !$kegiatan[$date] && (date("D", strtotime($date)) == "Sat" || date("D", strtotime($date)) == "Sun")) {
						$status[$date][$p->finger]['status'] = $this->status['l'];
					} else {

						if (isset($absen[$date][$p->finger])) {
							$status[$date][$p->finger] = $this->check_status($date, $absen[$date][$p->finger]);
						} else {
							$status[$date][$p->finger] = $this->check_status($date, null);
						}
					}
				}
				if (isset($status[$date][$p->finger]['status'])) {
					$total[$p->finger]['count']++;
				}
				if (isset($status[$date][$p->finger]['status']['code'])) {
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['count']++;
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['potongan'] += $ref_status[$status[$date][$p->finger]['status']['code']]['potongan'];
					$total[$p->finger]['potongan'] += $ref_status[$status[$date][$p->finger]['status']['code']]['potongan'];
				}
				if (isset($flag[$date][$p->id])) {
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['count']--;
					$count[$p->finger][$status[$date][$p->finger]['status']['code']]['potongan'] -= $ref_status[$status[$date][$p->finger]['status']['code']]['potongan'];
					$total[$p->finger]['potongan'] += $ref_status[$status[$date][$p->finger]['status']['code']]['potongan'];

					$countflag[$p->finger][$flag[$date][$p->id]->code]['count']++;
					$countflag[$p->finger][$flag[$date][$p->id]->code]['potongan'] += $flag[$date][$p->id]->potongan;
					$total[$p->finger]['potongan'] += $flag[$date][$p->id]->potongan;
				}
				if (isset($status[$date][$p->finger]['waktu'])) {
					$total[$p->finger]['waktu'] += $status[$date][$p->finger]['waktu'];
				}
			}
		}

		foreach ($pegawai as $p) {
			$total[$p->finger]['absen'] = $count[$p->finger]['tk']['count'] + $countflag[$p->finger]['tk']['count'] + $countflag[$p->finger]['cs5']['count'];
			$total[$p->finger]['terlambat'] = $this->secondsToTime($total[$p->finger]['waktu']);
		}
		// echo "<pre>";
		// echo print_r(compact('countflag'));
		// echo "</pre>";
		// die();


		$this->load->view('absen/monthly_print', compact('title', 'pegawai', 'ym', 'd', 'absen', 'status', 'flag', 'libur', 'puasa', 'kegiatan', 'ref_status', 'ref_flag', 'count', 'countflag', 'total'));


		$mpdf = new \Mpdf\Mpdf(['format' => 'A4'], ['tempDir' => __DIR__ . '/custom/temp/dir/path']);
		$data = $this->load->view('absen/monthly_print', compact('title', 'pegawai', 'ym', 'd', 'absen', 'status', 'flag', 'libur', 'puasa', 'kegiatan', 'ref_status', 'ref_flag', 'count', 'countflag', 'total'), TRUE);
		$mpdf->AddPage('L');
		$mpdf->WriteHTML($data);
		$mpdf->Output($title . " " . date("Ymd") . ".pdf", "D");
	}

	public function daily_print($date)
	{
		if ($date == 0) {
			$date  = date("Y-m-d");
		}

		$title      = "Data Absen Harian - " . date("j M Y", strtotime($date));
		$pegawai    = $this->table_pegawai->all();

		$absen[$date]    = $this->table_data->filter_date($date);

		$libur[$date]    = $this->table_ref->libur($date);
		$kegiatan[$date] = $this->table_ref->kegiatan($date);
		foreach ($pegawai as $p) {
			if ($libur[$date]) {
				$flag[$date][$p->finger]             = null;
				$status[$date][$p->finger]['status'] = $this->status['ld'];
			} else {
				$flag[$date][$p->id] = $this->table_flag_data->filter_month($date, $p->id);

				if (strtotime($date) > time()) {
					$status[$date][$p->finger]['status'] = null;
				} elseif (strtotime($date) <= time() && !$kegiatan[$date] && (date("D", strtotime($date)) == "Sat" || date("D", strtotime($date)) == "Sun")) {
					$status[$date][$p->finger]['status'] = $this->status['l'];
				} else {

					if (isset($absen[$date][$p->finger])) {
						$status[$date][$p->finger] = $this->check_status($date, $absen[$date][$p->finger]);
					} else {
						$status[$date][$p->finger] = $this->check_status($date, null);
					}
				}
			}
		}
		// echo "<pre>";
		// echo print_r(compact('ref_status'));
		// echo "</pre>";
		// die();


		// $this->load->view('absen/daily_print', compact('title','pegawai','date','absen','status','flag'));


		$mpdf = new \Mpdf\Mpdf(['format' => 'A4'], ['tempDir' => __DIR__ . '/custom/temp/dir/path']);
		$data = $this->load->view('absen/daily_print', compact('title', 'pegawai', 'date', 'absen', 'status', 'flag'), TRUE);
		$mpdf->AddPage('P');
		$mpdf->WriteHTML($data);
		$mpdf->Output($title . " " . date("Ymd") . ".pdf", "D");
	}

	private function secondsToTime($detik)
	{

		$jam_kerja = 7.5 * 3600;
		if ($jam_kerja < $detik) {
			$hari = $detik / $jam_kerja;
			$data['hari'] = (int)$hari;
			$data['detik'] = $detik - ($data['hari'] * $jam_kerja);
		} else {
			$data['hari'] = 0;
			$data['detik'] = $detik;
		}

		return $data;
	}
}

/* End of file Controllername.php */
