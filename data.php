<!DOCTYPE html>
<html lang="id">
<head>
<title>Data Pasien Virus Covid-19</title>
<link rel="stylesheet" href="assets/css/styles2.css">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/logo.png">
</head>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileWrite = fopen('./data.txt', 'w');
    $dataPost = [
      "Nama_Wilayah" => $_POST['Nama_Wilayah'],
      "Jumlah_Positif" => $_POST['Jumlah_Positif'],
      "Jumlah_Dirawat" => $_POST['Jumlah_Dirawat'],
      "Jumlah_Sembuh" => $_POST['Jumlah_Sembuh'],
      "Jumlah_Meninggal" => $_POST['Jumlah_Meninggal'],
      "Nama_Operator" => $_POST['Nama_Operator'],
      "NIM_Mahasiswa" => $_POST['NIM_Mahasiswa'],
    ];
    fwrite($fileWrite, json_encode($dataPost));
    fclose($fileWrite);
  }
?>

<?php
      $file = fopen('./data.txt', 'r') or die ('File Gagal di Akses!');
      $data = json_decode(fread($file, filesize('./data.txt')));
      fclose($file);
    ?>

<div class="form-hasil">
  <p>
      Data Pemantauan Covid19 Wilayah <?= $data->Nama_Wilayah; ?>
  </p>
<?php
        function tgl ($tanggal) {
	        $bulan = array (
	        1 => 'Januari',
	        'Februari',
	        'Maret',
	        'April',
	        'Mei',
	        'Juni',
	        'Juli',
	        'Agustus',
	        'September',
	        'Oktober',
	        'November',
	        'Desember'
	    );
	        $tanda = explode('-', $tanggal);
	        return $tanda[2] . ' ' . $bulan[(int)$tanda[1] ] . ' ' . $tanda[0];
    }
        date_default_timezone_set('Asia/Jakarta');
        $jam = date('H:i:s');
?>

<?php
    echo "Per " . tgl(date('Y-m-d'));
    echo " " . $jam . "<br>";
?>

<p>
    <?= $data->Nama_Operator; ?> / <?=  $data->NIM_Mahasiswa; ?>
</p>

  <table align="center" width="65%" border="1px" cellspacing="0" cellpadding="3"> 
    <tbody>
        <tr>
          <td style="border: 1px solid white;"><b>Positif</b></td>
          <td style="border: 1px solid white;"><b>Dirawat</b></td>
          <td style="border: 1px solid white;"><b>Sembuh</b></td>
          <td style="border: 1px solid white;"><b>Meninggal</b></td>
      </tr>
        <tr>
          <td style="border: 1px solid white;"><?= number_format($data->Jumlah_Positif, 0, '.', '.'); ?></td>
          <td style="border: 1px solid white;"><?= number_format($data->Jumlah_Dirawat, 0, '.', '.'); ?></td>
          <td style="border: 1px solid white;"><?= number_format($data->Jumlah_Sembuh, 0, '.', '.'); ?></td>
          <td style="border: 1px solid white;"><?= number_format($data->Jumlah_Meninggal, 0, '.', '.'); ?></td>
      </tr>
    </tbody>
  </table>
</div>