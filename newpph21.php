<div style="width: 100%">
    <div style="margin: 0 auto; width: 400px;border: 1px solid #000000; padding: 10px;text-align: center">
        <h5> Peraturan Direktur Jenderal Pajak No. PER-16/PJ/2016, </h5>
        <h5> Peraturan Menteri Keuangan yaitu PMK No. 101/PMK.010/2016 </h5>
        <h5>dan PMK No. 102/PMK.010/2016 pada tanggal 22 Juni 2016</h5>
        <h5>dan berlaku sejak tanggal 1 Januari 2016</h5>
    </div>
</div><br/>
<?php

/*  
    Peraturan Direktur Jenderal Pajak No. PER-16/PJ/2016, 
    Peraturan Menteri Keuangan yaitu PMK No. 101/PMK.010/2016 
    dan PMK No. 102/PMK.010/2016 pada tanggal 22 Juni 2016
    dan berlaku sejak tanggal 1 Januari 2016
*/
// echo "\n";
// echo "Berapa pendapatan (gaji dan lainnya) Anda per bulan? ";
// $handle = fopen ("php://stdin","r");

if (isset($_POST['submit'])) {
    $gaji = isset($_POST['gaji']) ? $_POST['gaji'] : 0;
    // echo "Berapa pengeluaran (asuransi, jamsostek, dll) Anda per bulan? ";
    // $handle = fopen ("php://stdin","r");
    $pengurangan = isset($_POST['pengurangan']) ? $_POST['pengurangan'] : 0;
    // echo "Berapa bonus dan THR Anda peroleh dalam setahun? ";
    // $handle = fopen ("php://stdin","r");
    $thrbonus = isset($_POST['thrbonus']) ? $_POST['thrbonus'] : 0;
    // echo "Anda sudah menikah (Y/T)? ";
    // $handle = fopen ("php://stdin","r");
    $nikah = isset($_POST['nikah']) ? $_POST['nikah'] : 0;
    if(trim($nikah) === 'Y' || trim($nikah) === 'y'){
        $nikah = true;
    } else {
        $nikah = false;
    }
    // echo "Jumlah tanggungan? ";
    // $handle = fopen ("php://stdin","r");
    $tanggungan = isset($_POST['tanggungan']) ? $_POST['tanggungan'] : 0;
    // $istribekerja = isset($_POST['istribekerja']) ? $_POST['istribekerja'] : 0;
    if(trim($_POST['istribekerja']) === 'Y' || trim($_POST['istribekerja']) === 'y'){
        $istribekerja = true;
    } else {
        $istribekerja = false;
    }
    if ($nikah) {
        if ($istribekerja) {
            if ($tanggungan >= 3) {
                $ptkps = "126000000";
            } elseif ($tanggungan === 2) {
                $ptkps = "121500000";
            } elseif ($tanggungan === 1) {
                $ptkps = "117000000";
            } else {
                $ptkps = "112500000";
            }
        } else {
            if ($tanggungan >= 3) {
                $ptkps = "72000000";
            } elseif ($tanggungan === 2) {
                $ptkps = "67500000";
            } elseif ($tanggungan === 1) {
                $ptkps = "63000000";
            } else {
                $ptkps = "58500000";
            }
        }
        $ptkp = $ptkps;

    } else { 
        if ($tanggungan >= 3) {
            $ptkp = "67500000";
        } elseif ($tanggungan === 2) {
            $ptkp = "63000000";
        } elseif ($tanggungan === 1) {
            $ptkp = "58500000";
        } else {
            $ptkp = "54000000";
        }
    }
    $gajiTahunan = (12 * ($gaji - $pengurangan)) + $thrbonus;
    $biayaJabatan = 0.05 * $gajiTahunan;
    $gajiKenaPajak = $gajiTahunan - $biayaJabatan - $ptkp;
    $pajak = 0;
    if ($gajiKenaPajak > 0) {
        if ($gajiKenaPajak > 500000000) {
            // $tier1 = 0.05 * 50000000;
            // $tier2 = 0.15 * 200000000;
            // $tier3 = 0.25 * 250000000;
            // $tier4 = 0.3 * ($gajiKenaPajak - 500000000);
            // $pajak = $tier1 + $tier2 + $tier3 + $tier4;
            $pajak = 0.3 * $gajiKenaPajak;
        } elseif ($gajiKenaPajak > 250000000) {
            // $tier1 = 0.05 * 50000000;
            // $tier2 = 0.15 * 200000000;
            // $tier3 = 0.25 * ($gajiKenaPajak - 250000000);
            // $pajak = $tier1 + $tier2 + $tier3;
            $pajak = 0.25 * $gajiKenaPajak;
        } elseif ($gajiKenaPajak > 50000000) {
            // $tier1 = 0.05 * 50000000;
            // $tier2 = 0.15 * ($gajiKenaPajak - 50000000);
            // $pajak = $tier1 + $tier2;
            $pajak = 0.15 * $gajiKenaPajak;
        } else {
            // $tier1 = 0.05 * $gajiKenaPajak;
            // $pajak = $tier1;
            $pajak = 0.05 * $gajiKenaPajak;
        }
    }
    echo "\n";
    echo "==========================================\n <br/>";
    echo "= Pajak per tahun : ".str_pad(number_format($pajak), 20, " ", STR_PAD_LEFT)." =\n<br/>";
    echo "= Pajak per bulan : ".str_pad(number_format($pajak/12), 20, " ", STR_PAD_LEFT)." =\n<br/>";
    echo "==========================================\n";
}
?>
<div style="width: 100%">
    <div style="margin: 0 auto; width: 400px;border: 1px solid #000000; padding: 10px;">
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input placeholder="Gaji Bulanan. Ex: 75000000" style="width:100%;" type="text" name="gaji" value=""><br/><br/>
        <input placeholder="Pengeluaran (asuransi, jamsostek, dll). Ex: 75000000" style="width:100%;" type="text" name="pengurangan" value=""><br/><br/>
        <input placeholder="Bonus dan THR. Ex: 75000000" style="width:100%;" type="text" name="thrbonus" value=""><br/><br/>
        <select name="nikah" style="width: 100%;">
            <option value=""> Pilih Status Pernikahan</option>
            <option value="Y"> Ya</option>
            <option value="T"> Tidak</option>
        </select><br/><br/>
        <p style="color: red; font-size: 10px;">* Pilih Istri Bekerja Hanya Jika Pajak Penghasilan Suami Dan Istri Digabung</p>
        <select name="istribekerja" style="width: 100%;">
            <option value=""> Apakah Istri Bekerja ?</option>
            <option value="Y"> Ya</option>
            <option value="T"> Tidak</option>
        </select><br/><br/>
        <select name="tanggungan" style="width: 100%;">
            <option value="0"> Pilih Jumlah Tanggungan</option>
            <option value="1"> 1</option>
            <option value="2"> 2</option>
            <option value="3"> 3</option>
        </select><br/><br/>
        <button type="submit" name="submit" style="width: 100%;">CHECK PAJAK</button>
    </form>  
    </div>
</div>