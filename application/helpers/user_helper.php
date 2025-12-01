<?php

	function isadmin() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'admin') {
			redirect('auth');
		}
	}

	function ispimpinan() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'pimpinan') {
			redirect('auth');
		}
	}

	function ispegawai() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'pegawai') {
			redirect('auth');
		}
	}