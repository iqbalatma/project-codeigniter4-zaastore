<?php

namespace App\Controllers;

class Auth extends BaseController
{


    /*
        AUTHOR      : Iqbal Atma Muliawan
        CONTROLLER  : Auth
        METHOD      :   -index()
                        -list_account()
                        -progress_registration()
                        -progress_login()
                        -progress_logout()
        DESCRIPTION : Controller ini digunakan untuk melakukan login, logout, regis, dan lainnya berkaitan dengan akun.
        TODO        : 
    */


    // Description : Untuk menampilkan form login
    public function index()
    {
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        if ($this->session->get("is_logged_in") == true) {
            return redirect()->to("/dashboard");
        }
        $data = [
            "title" => "Login",
            "flashdata" => $flashdata,
        ];
        return view("view_auth/view_login", $data);
    }


    // Description : menampilkan list akun dan dapat menambah serta melakukan edit pada akun
    public function list_account()
    {
        $role = $_SESSION["role"];
        if ($role == 3 || $role == 4 || $role == 5 || $role == 6) {
            return redirect()->to("HttpRequest");
        }
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Daftar Akun",
            "flashdata" => $flashdata,
            "content" => "view_list_account",
            "users" => $this->users_model->getDataAccount(),
            "role" => $this->role_model->findAll()
        ];
        return view('view_auth/view_list_account', $data);
    }


    // PROGRESS ---


    // Description : progress untuk registrasi dengan mendapatkan data dari form
    public function progress_registration()
    {
        //untuk cek role sudah di pilih atau belum
        if ($this->request->getPost("id_role") == null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Tambah Data Gagal ! Role Belum Dipilih</div>');
            return redirect()->to('/list-account');
        } else {

            //ambil data pada tabel user
            $check_username = $this->users_model->where('username', $this->request->getPost("username"))
                ->findAll();

            // check username apakah ada atau tidak, jika tidak ada maka masuk ke proses selanjutnya
            if (count($check_username) == 0) {
                $query_insert_user = $this->users_model->insert($this->request->getPost());
                if ($query_insert_user) {
                    $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
                 Tambah User Berhasil
                </div>');
                    return redirect()->to('/list-account');
                }
            } else {
                $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Username sudah digunakan, gunakan username yang lain !</div>');
                return redirect()->to('/list-account');
            }
        }
    }


    // Description : progres untuk melakukan edit data akun pada tampilan list_account()
    public function progress_edit_registration()
    {
        $id_user = $this->request->getPost("id_user");
        $data = [
            "fullname" => $this->request->getPost("fullname"),
            "username" => $this->request->getPost("username"),
            "password" => $this->request->getPost("password"),
            "phonenumber" => $this->request->getPost("phonenumber"),
            "id_role" => $this->request->getPost("id_role"),
            "is_deleted" => $this->request->getPost("is_deleted")
        ];
        $query = $this->users_model->update($id_user, $data);

        if ($query) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Ubah data akun berhasil</div>');
            return redirect()->to("/list-account");
        }
    }


    // Description : progres untuk melakukan verifikasi data login
    public function progress_login()
    {
        // ambil data dari form
        $username_form = $this->request->getPost("username");
        $password_form = $this->request->getPost("password");

        //where clause
        $where = [
            "username" => $username_form,
            "password" => $password_form
        ];

        // ambil data dari database
        $check_user = $this->users_model->where($where)->where(["is_deleted" => 0])->findAll();



        // check username dan password
        if ($check_user) {
            $check_user = $check_user[0];
            // ambil role name
            $role_name = $this->role_model->where("id_role", $check_user["id_role"])->findAll()[0]["role_name"];
            $session_data = [
                "is_logged_in" => true,
                "id_user" => $check_user["id_user"],
                "username" => $check_user["username"],
                "fullname" => $check_user["fullname"],
                "role" => $check_user["id_role"],
                "role_name" => $role_name
            ];
            $this->session->set($session_data);
            return redirect()->to("Dashboard");
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Username atau passowrd salah !</div>');
            return redirect()->to('/');
        }
    }


    // Description : progres logout untuk menghapus session
    public function progress_logout()
    {
        unset($_SESSION);
        $this->session->destroy();
        return redirect()->to("/");
    }
}
