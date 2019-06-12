<?php 

   class Proses {
   
        public function konek()
        {
            $mysqli = new mysqli("localhost", "root", "", "indonesia");

            /* check connection */
            if ($mysqli->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                exit();
            }
            return $mysqli;
        }


        function select_provinsi(){
            $mysqli= $this->konek();
            $sql = "Select * from provinces";
            $result = $mysqli->query($sql);

            $data = [];
            while($row=$result->fetch_assoc()){
                $data[]=$row;
            }

            return $data;
        }


        public function response($data)
        {
            header('Content-Type: application/json');
            echo json_encode($data);
        }


        function select_kabupaten($provinsi_id){
            $mysqli= $this->konek();
            $sql = "Select * from regencies where province_id = {$provinsi_id}";
            $result = $mysqli->query($sql);
            $data = [];
            while($row=$result->fetch_assoc()){
                $data[]=$row;
            }
            return $data;
        }
   }



   
    if(isset($_GET['provinsi']) && $_GET['provinsi']==0){
        $proses = new Proses;
        $proses->response($proses->select_provinsi());
    }


    if(isset($_GET['kabupaten']) && isset($_GET['provinsi'])){
        $proses      = new Proses;
        $provinsi_id = $_GET['provinsi'];
        $proses->response($proses->select_kabupaten($provinsi_id));
    }
   
   