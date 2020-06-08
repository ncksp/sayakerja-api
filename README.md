BASE_URL = https://sayakerja-api.herokuapp.com/

---User
    - Liat semua data user{
        URL : /users
        Method : GET
    }
    - Lihat detail 1 user{
        URL : /users/{id_user}
        Method : GET
    }
    - Lihat lamaran yang dikirim user{
        URL: /users/{id}/application
        Method: GET
    }
    - Lihat company user{
        URL: /users/{id}/company
        Method: GET
    }
    - Lihat lamaran di company user{
        URL: /users/{id}/company/application
        Method: GET
    }
    - Tambah user{
        URL: /users
        Method: POST
        Params: {
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'gender' => 'required',
            'address' => 'required',
            'phone' => 'required',
        }
    }
    - Hapus user{
       URL: /users/{id}
       Method: DELETE
    }
    - Update user{
        URL: /users/{id}
        Method: PUT
        Params: {
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'gender' => 'required',
            'address' => 'required',
            'phone' => 'required',
        }
    }

--Company
    - Lihat data company{
        URL : /company
        Method : GET
    }
    - Lihat detail 1 company{
        URL : /company/{id}
        Method : GET
    }
    - Tambah company{
        URL : /company
        Method : POST
        Params: {
            'name' => 'required',
            'address' => 'required',
            'user_id' => 'required|numeric',
            'contact' => 'required',
        }
    }
    - Delete company{
        URL: /company/{id}
        Method: DELETE
    }
    - Edit company{
        URL : /company/{id}
        Method : PUT
        Params: {
            'name' => 'required',
            'address' => 'required',
            'user_id' => 'required|numeric',
            'contact' => 'required',
        }
    }
    - Lihat jobs yang ada di company tersebut {
        URL: /company/{id}/jobs
        Method: GET
    }

--Jobs
    -Lihat semua jobs{
        URL : /jobs
        Method: GET
    }
    - Lihat detail 1 jobs{
        URL : /jobs/{id}
        Method : GET
    }
    - Tambah jobs {
        URL : /jobs
        Method : POST
        Params :{
            'user_id' => 'required',
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'description' => 'required',
        }
    }
    - Delete Jobs{
        URL : /jobs/{id}
        Method: DELETE
    }
    - Edit Jobs {
        URL : /jobs
        Method : PUT
        Params :{
            'user_id' => 'required',
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'description' => 'required',
        }
    }


- Application
    - Kirim lamaran{
        URL : /application
        Method: POST
        Params:{
            'company_id' => 'required',
            'user_id' => 'required|numeric',
            'additional' => 'required',
        }
    }
