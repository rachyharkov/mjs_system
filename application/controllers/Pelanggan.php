<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Pelanggan_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $pelanggan = $this->Pelanggan_model->get_all();
        $data = array(
            'pelanggan_data' => $pelanggan,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','pelanggan/pelanggan_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Pelanggan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'pelangan_id' => $row->pelangan_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'kode_pelanggan' => $row->kode_pelanggan,
		'nama_pelanggan' => $row->nama_pelanggan,
		'alamat' => $row->alamat,
		'kota' => $row->kota,
		'provinsi' => $row->provinsi,
		'kode_pos' => $row->kode_pos,
		'telepon' => $row->telepon,
		'personal_kontak' => $row->personal_kontak,
		'email' => $row->email,
		'halaman_web' => $row->halaman_web,
		'catatan' => $row->catatan,
	    );
            $this->template->load('template','pelanggan/pelanggan_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('pelanggan/create_action'),
	    'pelangan_id' => set_value('pelangan_id'),
	    'kode_pelanggan' => set_value('kode_pelanggan'),
	    'nama_pelanggan' => set_value('nama_pelanggan'),
	    'alamat' => set_value('alamat'),
	    'kota' => set_value('kota'),
	    'provinsi' => set_value('provinsi'),
	    'kode_pos' => set_value('kode_pos'),
	    'telepon' => set_value('telepon'),
	    'personal_kontak' => set_value('personal_kontak'),
	    'email' => set_value('email'),
	    'halaman_web' => set_value('halaman_web'),
	    'catatan' => set_value('catatan'),
	);
        $this->template->load('template','pelanggan/pelanggan_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_pelanggan' => $this->input->post('kode_pelanggan',TRUE),
		'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'kota' => $this->input->post('kota',TRUE),
		'provinsi' => $this->input->post('provinsi',TRUE),
		'kode_pos' => $this->input->post('kode_pos',TRUE),
		'telepon' => $this->input->post('telepon',TRUE),
		'personal_kontak' => $this->input->post('personal_kontak',TRUE),
		'email' => $this->input->post('email',TRUE),
		'halaman_web' => $this->input->post('halaman_web',TRUE),
		'catatan' => $this->input->post('catatan',TRUE),
	    );

            $this->Pelanggan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Pelanggan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('pelanggan/update_action'),
		'pelangan_id' => set_value('pelangan_id', $row->pelangan_id),
		'kode_pelanggan' => set_value('kode_pelanggan', $row->kode_pelanggan),
		'nama_pelanggan' => set_value('nama_pelanggan', $row->nama_pelanggan),
		'alamat' => set_value('alamat', $row->alamat),
		'kota' => set_value('kota', $row->kota),
		'provinsi' => set_value('provinsi', $row->provinsi),
		'kode_pos' => set_value('kode_pos', $row->kode_pos),
		'telepon' => set_value('telepon', $row->telepon),
		'personal_kontak' => set_value('personal_kontak', $row->personal_kontak),
		'email' => set_value('email', $row->email),
		'halaman_web' => set_value('halaman_web', $row->halaman_web),
		'catatan' => set_value('catatan', $row->catatan),
	    );
            $this->template->load('template','pelanggan/pelanggan_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pelangan_id', TRUE));
        } else {
            $data = array(
		'kode_pelanggan' => $this->input->post('kode_pelanggan',TRUE),
		'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'kota' => $this->input->post('kota',TRUE),
		'provinsi' => $this->input->post('provinsi',TRUE),
		'kode_pos' => $this->input->post('kode_pos',TRUE),
		'telepon' => $this->input->post('telepon',TRUE),
		'personal_kontak' => $this->input->post('personal_kontak',TRUE),
		'email' => $this->input->post('email',TRUE),
		'halaman_web' => $this->input->post('halaman_web',TRUE),
		'catatan' => $this->input->post('catatan',TRUE),
	    );

            $this->Pelanggan_model->update($this->input->post('pelangan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Pelanggan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Pelanggan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pelanggan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_pelanggan', 'kode pelanggan', 'trim|required');
	$this->form_validation->set_rules('nama_pelanggan', 'nama pelanggan', 'trim|required');
	// $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	// $this->form_validation->set_rules('kota', 'kota', 'trim|required');
	// $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
	// $this->form_validation->set_rules('kode_pos', 'kode pos', 'trim|required');
	// $this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
	// $this->form_validation->set_rules('personal_kontak', 'personal kontak', 'trim|required');
	// $this->form_validation->set_rules('email', 'email', 'trim|required');
	// $this->form_validation->set_rules('halaman_web', 'halaman web', 'trim|required');
	// $this->form_validation->set_rules('catatan', 'catatan', 'trim|required');

	$this->form_validation->set_rules('pelangan_id', 'pelangan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "pelanggan.xls";
        $judul = "pelanggan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Kota");
	xlsWriteLabel($tablehead, $kolomhead++, "Provinsi");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pos");
	xlsWriteLabel($tablehead, $kolomhead++, "Telepon");
	xlsWriteLabel($tablehead, $kolomhead++, "Personal Kontak");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Halaman Web");
	xlsWriteLabel($tablehead, $kolomhead++, "Catatan");

	foreach ($this->Pelanggan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pelanggan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kota);
	    xlsWriteLabel($tablebody, $kolombody++, $data->provinsi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pos);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telepon);
	    xlsWriteLabel($tablebody, $kolombody++, $data->personal_kontak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->halaman_web);
	    xlsWriteLabel($tablebody, $kolombody++, $data->catatan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-09-25 16:31:48 */
/* http://harviacode.com */