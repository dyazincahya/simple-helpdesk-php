<?php include('header.php');?>

<div class="container">
    <div class="page-header"><h1>Data Barang</h1></div>

    <div class="row">
        <div class="col-md-4">
            <form method="post">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">KODE:</label>
                        <input type="text" name="kodebarang" class="form-control">
                    </div>
                    <div class="col-md-8 form-group">
                        <label for="">NAMA:</label>
                        <input type ="text" name="namabarang" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 form-group">
                        <label for="">JENIS:</label>
                        <select name="jenis" class="form-control">
                            <option value="Tahan Air">Tahan Air</option>
                            <option value="Mudah Robek">Mudah Robek</option>
                            <option value="Pecah Belah">Pecah Belah</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">SATUAN:</label>
                        <select name="satuan" class="form-control">
                            <option value="Gram">Gram</option>
                            <option value="KG">KG</option>
                            <option value="Butir">Butir</option>
                            <option value="Lusin">Lusin</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 form-group">
                        <label for="">HARGA:</label>
                        <input type ="number" name="harga" class="form-control">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="">JUMLAH:</label>
                        <input type ="number" name="jumlah" class="form-control">
                    </div>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary btn-block">SIMPAN</button>
            </form>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr style="font-weight:bold;">
                    <td>KODE</td>
                    <td>NAMA</td>
                    <td>JENIS</td>
                    <td>SATUAN</td>
                    <td>HARGA</td>
                    <td>JUMLAH</td>
                </tr>
                <?php
                    if(isset($_POST['simpan'])){
                        echo "
                            <tr>
                                <td>".$_POST['kodebarang']."</td>
                                <td>".$_POST['namabarang']."</td>
                                <td>".$_POST['jenis']."</td>
                                <td>".$_POST['satuan']."</td>
                                <td>".$_POST['harga']."</td>
                                <td>".$_POST['jumlah']."</td>
                            </tr>
                        ";
                    } else {
                        echo "<tr><td colspan='6' align='center'>NO DATA!</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php');?>