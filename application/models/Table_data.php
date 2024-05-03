<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Table_data extends CI_Model

{

	private $table = "data";



	public function __construct()

	{

		parent::__construct();
	}



	public function filter_date($date)

	{

		$absen = array();

		$time_start = strtotime($date . " 00:00:00");

		$time_end = strtotime($date . " 23:59:59");

		$this->db->where('time >=', $time_start);

		$this->db->where('time <=', $time_end);

		$data = $this->db->get($this->table)->result();



		foreach ($data as $d) {

			$absen[$d->pin][]['time'] = $d->time;
		}

		return $absen;
	}

	public function count_date($date)

	{

		$absen = array();

		$time_start = strtotime($date . " 00:00:00");

		$time_end = strtotime($date . " 23:59:59");



		$this->db->select('COUNT(id) as total');

		$this->db->where('time >=', $time_start);

		$this->db->where('time <=', $time_end);

		$this->db->group_by('pin');

		return $this->db->get($this->table)->num_rows();
	}



	public function filter_finger_date($date, $finger)

	{

		$time_start = strtotime($date . " 00:00:00");

		$time_end = strtotime($date . " 23:59:59");



		$this->db->where('time >=', $time_start);

		$this->db->where('time <=', $time_end);

		$this->db->where('pin', $finger);

		$data = $this->db->get($this->table)->result();



		if ($data) {

			$i = 0;

			foreach ($data as $d) {

				$absen[$i]['no'] = $i + 1;

				$absen[$i]['datetime'] = date("Y-m-d H:i:s", $d->time);

				$absen[$i]['time'] = $d->time;

				$i++;
			}



			return $absen;
		} else {

			$absen[0]['no'] = "";

			$absen[0]['datetime'] = "";

			$absen[0]['time'] = "";

			return $absen;
		}
	}



	public function insert($data)

	{

		$this->db->insert($this->table, $data);
	}



	public function get($data)

	{

		$this->db->where($data);

		$result = $this->db->get($this->table)->row();



		if ($result != null) {

			return 1;
		} else {

			return 0;
		}
	}
}
