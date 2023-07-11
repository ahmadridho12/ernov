<?php

$conn = mysqli_connect("localhost","root","","ernov");

//menambah barang////////////////////////////////////////////////////////////////////////



if (isset($_POST['addnewbarang'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
    $kategorinya = $_POST['kategorinya'];

    $cekkategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori = '$kategorinya'");
    $ambildatanya = mysqli_fetch_array($cekkategori);
    $id_kategori = $ambildatanya['id_kategori'];

    $image = NULL;

    if ($_FILES['file']['name']) {
        $allowed_extensions = array('png', 'jpg');
        $nama = $_FILES['file']['name'];
        $dot = explode('.', $nama);
        $ekstensi = strtolower(end($dot));

        if (!in_array($ekstensi, $allowed_extensions)) {
            echo '
            <script>
                alert("File harus PNG atau JPG");
                window.location.href = "stock.php";
            </script>';
            return;
        }

        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi;

        if ($ukuran > 15000000) {
            echo '
            <script>
                alert("Ukuran gambar terlalu besar");
                window.location.href = "stock.php";
            </script>';
            return;
        }

        move_uploaded_file($file_tmp, 'images/' . $image);
    }

    $cek = mysqli_query($conn, "SELECT * FROM stok WHERE nama_barang = '$nama_barang'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung < 1) {
        $addtotable = mysqli_prepare($conn, "INSERT INTO stok (id_kategori, nama_barang, harga, deskripsi, stock, image) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($addtotable, "isssis", $id_kategori, $nama_barang, $harga, $deskripsi, $stock, $image);
        mysqli_stmt_execute($addtotable);

        if (mysqli_stmt_affected_rows($addtotable) > 0) {
            echo '
            <script>
                alert("Barang Berhasil Ditambahkan");
                window.location.href="stock.php";
            </script>';
        } else {
            echo 'gagal';
            header('location: stock.php');
        }
    } else {
        echo '
        <script>
            alert("Nama Barang sudah terdaftar");
            window.location.href="stock.php";
        </script>';
    }
}

       




//menambah Kategori////////////////////////////////////////////////////////////////////////

if (isset($_POST['addnewkategori'])) {
    $nama_kategori = $_POST['nama_kategori'];

    $cek = mysqli_query($conn, "SELECT * FROM kategori WHERE nama_kategori = '$nama_kategori'");
    $hitung = mysqli_num_rows($cek);

    if($hitung<1){

    $addtokategori = mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");
    if ($addtokategori) {
        echo '
        <script>
            alert("Kategori Berhasil Ditambahkan");
            window.location.href="kategori.php";
        </script>';
    } else {
        echo 'gagal';
        header('location: kategori.php');
    }
} else {
    // Jika sudah ada
    echo '
    <script>
        alert("Nama Kategori sudah terdaftar");
        window.location.href="kategori.php";
    </script>';
}
};


    //edit kategori
    if (isset($_POST['editkategori'])) {
        $idkategori = $_POST['id_kategori'];
        $namakategori = $_POST['nama_kategori'];

        $updatekategori = mysqli_query($conn, "UPDATE kategori SET nama_kategori = '$namakategori' WHERE id_kategori = '$idkategori'");
        if ($updatekategori) {
            header('location: kategori.php');
        } else {
            echo 'gagal';
            header('location: kategori.php');
        }
    };

    //hapus kategori
    if (isset($_POST['hapuskategori'])) {
        $idkategori = $_POST['id_kategori'];

        $hapuskategori = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = '$idkategori'");
        if ($hapuskategori) {
            header('location: kategori.php');
        } else {
            echo 'gagal';
            header('location: kategori.php');
        }
    }
    //edit user
    if (isset($_POST['edituser'])) {
        $iduser = $_POST['id_user'];
        $email = $_POST['email'];
        $username = $_POST['username'];

        $updateuser = mysqli_query($conn, "UPDATE login SET email = '$email', username= '$username' WHERE id_user = '$iduser'");
        if ($updateuser) {
            header('location: list-user.php');
        } else {
            echo 'gagal';
            header('location: list-user.php');
        }
    };

    //hapus user
    if (isset($_POST['hapususer'])) {
        $iduser = $_POST['id_user'];

        $hapususer = mysqli_query($conn, "DELETE FROM login WHERE id_user = '$iduser'");
        if ($hapususer) {
            header('location: list-user.php');
        } else {
            echo 'gagal';
            header('location: list-user.php');
        }
    }




//Menambah barang masuk/////////////////////////////////////////////////////////////////////////////////////////////////

 if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $Penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stok where id_barang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahakanstocksekarangdenganquantity = $stocksekarang+$qty;



    $addtomasuk = mysqli_query($conn, "insert into masuk (id_barang, keterangan, qty) values ('$barangnya', '$Penerima','$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stok set stock ='$tambahakanstocksekarangdenganquantity' where id_barang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        echo '
        <script>
            alert("Barang masuk berhasil ditambahkan");
            window.location.href="masuk.php";
        </script>';
    }else {
        echo 'gagal';
        header('location: masuk.php');
}

 };




 //Menambah barang keluar//////////////////////////////////////////////////////////

 if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $Penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stok where id_barang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];


    if($stocksekarang>= $qty){
        // Kalau stock/barang cukup//////
        $tambahakanstocksekarangdenganquantity = $stocksekarang-$qty;
        
        
        
        $addtokeluar = mysqli_query($conn, "insert into keluar (id_barang, penerima, qty) values ('$barangnya', '$Penerima','$qty')");
        $updatestockmasuk = mysqli_query($conn,"update stok set stock ='$tambahakanstocksekarangdenganquantity' where id_barang='$barangnya'");
        if($addtokeluar&&$updatestockmasuk){
            echo '
        <script>
            alert("Barang keluar berhasil ditambahkan");
            window.location.href="keluar.php";
        </script>';
        }else {
            echo 'gagal';
            header('location: keluar.php');
        }
    } else {
        //kalau barangnya/stocknya ga cukup//////
        echo '
        <script>
            alert("Stock saat ini tidak mencukupi");
            window.location.href = "keluar.php";
        </script>
        ';
    }

 };





 //update info barang///////////////////////////////////////////////////////////////////////////////////////////////////////////////

 if(isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    

     //soal gambar
     $allowed_extension = array('png', 'jpg');
     $nama = $_FILES['file']['name']; // ambil nama gambar
     $dot = explode('.',$nama);
     $ekstensi = strtolower(end($dot));
     $ukuran = $_FILES['file']['size'];
     $file_tmp = $_FILES['file']['tmp_name'];
 
     /// penamaan file -> enkripsi
 
     $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; // menggabungkan nama fie yang dienkripsi dengan ekstensinya
 

    if($ukuran==0){
        // jika tidak inginn upload
        $update = mysqli_query($conn, "update stok set nama_barang='$nama_barang',harga='$harga',deskripsi='$deskripsi' where id_barang='$idb'");
        if($update){
            header('location: stock.php');
        }else {
            echo 'gagal';
            header('location: stock.php');
        }
    } else {
        // jika ingin
        move_uploaded_file($file_tmp, 'images/'.$image);
        $update = mysqli_query($conn, "update stok set nama_barang='$nama_barang',harga='$harga',deskripsi='$deskripsi', image='$image' where id_barang='$idb'");
        if($update){
            header('location: stock.php');
        }else {
            echo 'gagal';
            header('location: stock.php');
        }
    }
 };






 //hapus bara dari stok/////////////////////////////////////////////////////////////////////////////////////////////////////////

 if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb']; // idbarang

    $gambar = mysqli_query($conn, "select * from stok where id_barang = '$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/'.$get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "delete from stok where id_barang = '$idb'");
    if($hapus){
        header('location: stock.php');
    }else {
        echo 'gagal';
        header('location: stock.php');
 }
};







        //mengubah/edit  data barang masuk///////////////////////////////////////////////////////////////////////////////////////////////


    if(isset($_POST['updatebarangmasuk'])){
        $idb = $_POST['idb'];
        $idm = $_POST['idm'];
        $keterangan = $_POST['keterangan'];
        $qty = $_POST['qty'];

        $lihatstock = mysqli_query($conn, "select * from stok where id_barang='$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['stok'];

        $qtyskrg = mysqli_query($conn, "select * from masuk where id_masuk='$idm'");
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya['qty'];

        if($qty>$qtyskrg){
            $selisih = $qty-$qtyskrg;
            $kurangin = $stockskrg + $selisih;
            $kurangistocknya = mysqli_query($conn, "update stok set stock='$kurangin' where id_barang='$idb'");
            $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where id_masuk='$idm'");

            if($kurangistocknya&&$updatenya){
                header('location: masuk.php');
                }else {
                    echo 'gagal';
                    header('location: masuk.php');
                }
        
        } else {
            
                $selisih = $qtyskrg-$qty;
                $kurangin = $stockskrg-$selisih;
                $kurangistocknya = mysqli_query($conn, "update stok set stock='$kurangin' where id_barang='$idb'");
                $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where id_masuk='$idm'");
                if($kurangistocknya&&$updatenya){
                    header('location: masuk.php');
                }else {
                    echo 'gagal';
                    header('location: masuk.php');
                }
            }
    };






    //////////////////////////hapus barang masuk////////////////////////////

    if(isset($_POST['hapusbarangmasuk'])){
        $idb = $_POST['idb'];
        $qty = $_POST['kty'];
        $idm = $_POST['idm']; 

        $getdatastock = mysqli_query($conn, "select * from stok where id_barang='$idb'");
        $data = mysqli_fetch_array($getdatastock);
        $stok = $data['stock'];

        $selisih = $stok-$qty;

        $update = mysqli_query($conn,"update stok set stock='$selisih' where id_barang='$idb'");
        $hapusdata = mysqli_query($conn, "delete from masuk where id_masuk='$idm'");

        if($update&&$hapusdata){
            header('location: masuk.php');
        } else {
            header('location: masuk.php');
        }        

        





    };






        //mengubah/edit  data barang keluar///////////////////////////////////////////////////////////////////////////////////////////////


        if(isset($_POST['updatebarangkeluar'])){
            $idb = $_POST['idb'];
            $idk = $_POST['idk'];
            $penerima = $_POST['penerima'];
            $qty = $_POST['qty'];
    
            $lihatstock = mysqli_query($conn, "select * from stok where id_barang='$idb'");
            $stocknya = mysqli_fetch_array($lihatstock);
            $stockskrg = $stocknya['stok'];
    
            $qtyskrg = mysqli_query($conn, "select * from keluar where id_keluar='$idk'");
            $qtynya = mysqli_fetch_array($qtyskrg);
            $qtyskrg = $qtynya['qty'];
    
            if($qty>$qtyskrg){
                $selisih = $qty-$qtyskrg;
                $kurangin = $stockskrg-$selisih;
                $kurangistocknya = mysqli_query($conn, "update stok set stock='$kurangin' where id_barang='$idb'");
                $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where id_keluar='$idk'");
    
                if($kurangistocknya&&$updatenya){
                    header('location: keluar.php');
                    }else {
                        echo 'gagal';
                        header('location: keluar.php');
                    }
            
            } else {
                
                    $selisih = $qtyskrg-$qty;
                    $kurangin = $stockskrg + $selisih;
                    $kurangistocknya = mysqli_query($conn, "update stok set stock='$kurangin' where id_barang='$idb'");
                    $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where id_keluar='$idk'");
                    if($kurangistocknya&&$updatenya){
                        header('location: keluar.php');
                    }else {
                        echo 'gagal';
                        header('location: keluar.php');
                    }
                }
        };
    
    
    
    
    
    
        //////////////////////////hapus barang keluar////////////////////////////
    
        if(isset($_POST['hapusbarangkeluar'])){
            $idb = $_POST['idb'];
            $qty = $_POST['kty'];
            $idk = $_POST['idk']; 
    
            $getdatastock = mysqli_query($conn, "select * from stok where id_barang='$idb'");
            $data = mysqli_fetch_array($getdatastock);
            $stok = $data['stock'];
    
            $selisih = $stok+$qty;
    
            $update = mysqli_query($conn,"update stok set stock='$selisih' where id_barang='$idb'");
            $hapusdata = mysqli_query($conn, "delete from keluar where id_keluar='$idk'");
    
            if($update&&$hapusdata){
                header('location: keluar.php');
            } else {
                header('location: keluar.php');
            }        
        }

        if (isset($_POST['edituser'])) {
            $idl = $_POST['idl'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            // Mengambil data user berdasarkan ID
            $getUserQuery = mysqli_query($conn, "SELECT * FROM login WHERE id_user='$idl'");
        
            if ($getUserQuery) {
                $userData = mysqli_fetch_array($getUserQuery);
        
                if ($userData) {
                    // Update data user dengan data baru
                    // Hash atau enkripsi password sebelum mengupdate ke database
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
                    $updateQuery = mysqli_query($conn, "UPDATE login SET email = '$email', username = '$username', password = '$hashedPassword' WHERE id_user = '$idl'");
        
                    if ($updateQuery) {
                        // Periksa jumlah baris yang terpengaruh oleh permintaan UPDATE
                        $affectedRows = mysqli_affected_rows($conn);
                        if ($affectedRows > 0) {
                            echo '
                            <script>
                                alert("user berhasil diubah");
                                window.location.href = "list-user.php";
                            </script>';
                        } else {
                            echo "Tidak ada perubahan pada data user";
                        }
                    } else {
                        echo '
                        <script>
                            alert("gagal");
                            window.location.href = "list-user.php";
                        </script>';
                    }
                } else {
                    echo "User tidak ditemukan";
                }
            } 
        }
        
        
        
        

        
?>