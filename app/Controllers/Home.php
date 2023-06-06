<?php

namespace App\Controllers;

use App\Models\Tabledataobjek;
use App\Controllers\BaseController;

class Home extends BaseController
{
    protected $tabledataobjek;

    public function __construct()
    {
        $this->tabledataobjek = new Tabledataobjek();
    }

    public function index()
    {
        //mengambil kolom dataobjek
        $data['dataobjek'] = $this->tabledataobjek->findAll();
        return view('v_index', $data);
    }
    public function input()
    {
        session();
        return view('v_input');
    }
    public function about()
    {
        session();
        return view('v_about');
    }
    public function simpan_tambah_data()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Latitude harus diisi'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Longitude harus diisi'
                ]
            ],

        ])) {
            return redirect()->to(base_url('home/input'))->with(
                'message',
                array(
                    'type' => 'danger',
                    'content' => $this->validator->listErrors()
                )
            );
        }   

        //file upload
        $foto = $this->request->getFile('foto');

        if ($foto->getError() == 4) {
            $nama_foto = 'NULL';
         } else {

        //membuat folder foto
        $foto_dir = 'upload/foto/';
        if (!is_dir($foto_dir)) {
            mkdir($foto_dir, 0777, true);
        }
        // get foto name (nama file foto)
        $nama_foto = preg_replace('/\s+/', '_', $foto->getName());

        //memindah file
        $foto->move($foto_dir, $nama_foto);
        }

        $data = [
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi'],
            'latitude' => $_POST['latitude'],
            'longitude' => $_POST['longitude'],
            'foto' => $nama_foto,
        ];

        if (!$this->tabledataobjek->save($data)) {
            return redirect()->to(base_url('home/input'))->with(
                'message',
                array(
                    'type' => 'danger',
                    'content' => 'Data gagal disimpan'
                )
            );
        }

        return redirect()->to(base_url('home/input'))->with(
            'message',
            array(
                'type' => 'success',
                'content' => 'Data berhasil disimpan'
            )
        );
    }

    public function table()
    {
        $data['dataobjek'] = $this->tabledataobjek->findAll();

        return view('v_table', $data);
    }
    // Kontroler untuk menghapus data dengan retrun pada halaman table setelah menghapus data dan menampilkan notifikasi Data berhasil dihapus
    public function hapus_data($id)
    {   
        $this->tabledataobjek->delete($id);
        return redirect()->to(base_url('home/table'))->with(
            'message',
            array(
                'type' => 'success',
                'content' => 'Data berhasil dihapus'
            )
        );
    }
    // Kontroler untuk mengedit data dengan public function edit data dengan parameter $id untuk mengedit data yang dimasukan pada tampilan form v_edit 
    public function edit_data($id)
    {
        $data['dataobjek'] = $this->tabledataobjek->find($id);
        return view('v_edit', $data);
    }
    public function simpan_edit_data($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Latitude harus diisi'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Longitude harus diisi'
                ]
            ],

        ])) {
            return redirect()->to(base_url('home/input'))->with(
                'message',
                array(
                    'type' => 'danger',
                    'content' => $this->validator->listErrors()
                )
            );
        }   

        //menangkap file upload
        $foto = $this->request->getFile('foto');
        $fotolama =$_POST['fotolama'];

        if ($foto->getError() == 4) {
            $nama_foto = $fotolama;
         } else {

        //membuat folder foto
        $foto_dir = 'upload/foto/';
        if (!is_dir($foto_dir)) {
            mkdir($foto_dir, 0777, true);
        }
        //menghapus foto lama
        if (!empty($fotolama) && file_exists($foto_dir . $fotolama)) {
            unlink($foto_dir . $fotolama);
        }
        // get foto name (nama file foto)
        $nama_foto = preg_replace('/\s+/', '_', $foto->getName());

        //memindah file
        $foto->move($foto_dir, $nama_foto);
        }

        $data = [
            'id' => $id,
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi'],
            'latitude' => $_POST['latitude'],
            'longitude' => $_POST['longitude'],
            'foto' => $nama_foto,

        ];

        if (!$this->tabledataobjek->save($data)) {
            return redirect()->to(base_url('home/table'))->with(
                'message',
                array(
                    'type' => 'danger',
                    'content' => 'Data gagal diedit'
                )
            );
        }

        return redirect()->to(base_url('home/table'))->with(
            'message',
            array(
                'type' => 'success',
                'content' => 'Data berhasil diedit'
            )
        );
    }
    //function retrun view ke peta
    public function peta()
    {
        return view('v_peta');
    }
    //Mengetes sesuatu sudah login atau belum
    public function test()
    {
        if(auth()->loggedln()){
            echo "Muncul tombol Logout";
        }else{
            echo "Muncul tombol Login";
        }
    }
    
}
