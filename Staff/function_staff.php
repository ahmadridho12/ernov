<?php

$conn = mysqli_connect("localhost","root","","ernov");

//menambah barang////////////////////////////////////////////////////////////////////////





       









//Menambah barang masuk/////////////////////////////////////////////////////////////////////////////////////////////////

 if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $Penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    // Validasi qty tidak boleh nol atau minus
    if ($qty <= 0) {
        echo '
        <script>
            alert("Jumlah barang masuk tidak valid");
            window.location.href = "staff_masuk.php";
        </script>
        ';
        exit(); // Hentikan eksekusi jika qty tidak valid
    }
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
            window.location.href="staff_masuk.php";
        </script>';
    }else {
        echo 'gagal';
        header('location: staff_masuk.php');
}

 };




 //Menambah barang keluar//////////////////////////////////////////////////////////

 if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $Penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    // Validasi qty tidak boleh nol atau minus
    if ($qty <= 0) {
        echo '
        <script>
            alert("Jumlah barang keluar tidak valid");
            window.location.href = "staff_keluar.php";
        </script>
        ';
        exit(); // Hentikan eksekusi jika qty tidak valid
    }
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
            window.location.href="staff_keluar.php";
        </script>';
        }else {
            echo 'gagal';
            header('location: staff_keluar.php');
        }
    } else {
        //kalau barangnya/stocknya ga cukup//////
        echo '
        <script>
            alert("Stock saat ini tidak mencukupi");
            window.location.href = "staff_keluar.php";
        </script>
        ';
    }

 };




















        //mengubah/edit  data barang masuk///////////////////////////////////////////////////////////////////////////////////////////////


    if(isset($_POST['updatebarangmasuk'])){
        $idb = $_POST['idb'];
        $idm = $_POST['idm'];
        $keterangan = $_POST['keterangan'];
        $qty = $_POST['qty'];

        // Validasi qty tidak boleh nol atau minus
         if ($qty <= 0) {
        echo '
        <script>
            alert("Jumlah barang masuk tidak valid");
            window.location.href = "staff_masuk.php";
        </script>
        ';
        exit(); // Hentikan eksekusi jika qty tidak valid
        }

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
                header('location: staff_masuk.php');
                }else {
                    echo 'gagal';
                    header('location: staff_masuk.php');
                }
        
        } else {
            
                $selisih = $qtyskrg-$qty;
                $kurangin = $stockskrg-$selisih;
                $kurangistocknya = mysqli_query($conn, "update stok set stock='$kurangin' where id_barang='$idb'");
                $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where id_masuk='$idm'");
                if($kurangistocknya&&$updatenya){
                    header('location: staff_masuk.php');
                }else {
                    echo 'gagal';
                    header('location: staff_masuk.php');
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
            header('location: staff_masuk.php');
        } else {
            header('location: staff_masuk.php');
        }        

        





    };






        //mengubah/edit  data barang keluar///////////////////////////////////////////////////////////////////////////////////////////////


        if(isset($_POST['updatebarangkeluar'])){
            $idb = $_POST['idb'];
            $idk = $_POST['idk'];
            $penerima = $_POST['penerima'];
            $qty = $_POST['qty'];
            
            // Validasi qty tidak boleh nol atau minus
             if ($qty <= 0) {
            echo '
            <script>
                alert("Quantity tidak valid");
                window.location.href = "staff_keluar.php";
            </script>
            ';
            exit(); // Hentikan eksekusi jika qty tidak valid
            }
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
                    header('location: staff_keluar.php');
                    }else {
                        echo 'gagal';
                        header('location: staff_keluar.php');
                    }
            
            } else {
                
                    $selisih = $qtyskrg-$qty;
                    $kurangin = $stockskrg + $selisih;
                    $kurangistocknya = mysqli_query($conn, "update stok set stock='$kurangin' where id_barang='$idb'");
                    $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where id_keluar='$idk'");
                    if($kurangistocknya&&$updatenya){
                        header('location: staff_keluar.php');
                    }else {
                        echo 'gagal';
                        header('location: staff_keluar.php');
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
                header('location: staff_keluar.php');
            } else {
                header('location: staff_keluar.php');
            }        
        }

        
        
        
        
        
        

        
?>