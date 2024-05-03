<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	
  margin: 0pt; 
	font-size: 8pt;

}

.kop {
  height :100px;
  text-align : center;
}
.img {
  position: absolute; 
}
.img img{
  margin: 0px 0px 0px 50px;
  
}
table.items {
  border: 0.1mm solid #000000;
}
th { vertical-align: middle; }
.items th {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
  border-bottom: 0.1mm solid #000000;
  
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-bottom: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead th { 
  background-color: #EEEEEE;
	text-align: center;
  border: 0.1mm solid #000000;
}
.items tr.programs {
	background-color: #fafafa;
	font-weight: 600;
	border: 0.1mm solid #000000;
	border-bottom: 0.1mm solid #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items tr.totals {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
}
.items tr.totals td{
	text-align: right;
}
.items td.money {
	text-align: right;
	white-space: nowrap;
}
</style>
</head>
  <body>
    <div class="img">
      <img src="<?= base_url();?>assets/images/logo-pta.png" style="height: 80px;">
    </div>
    <div class="kop">
      <div>
          <h2>PENGADILAN TINGGI AGAMA MANADO</h2>
          <p>Jl. 17 Agustus No. 46 A, Bumi Beringin, Wenang</p>
          <p>Kota Manado - Provinsi Sulawesi Utara</p>
          <p>0431-858322</p>
          <br>
          <hr>
        </div>
    </div>
    <div style="text-align: center">
        <h3><u>LAPORAN ABSENSI HARIAN</u></h3>
        <h4 style="margin-top:-10"><?= date("j F Y", strtotime($date))?></h4>
    </div>
    <table class="items" width="100%" style="font-size: 7pt; border-collapse: collapse; " cellpadding="8">
        <thead>
            <tr>
                <th style="background-color:#5b5a5a;color:white;vertical-align:middle;">No</th>
                <th style="background-color:#5b5a5a;color:white;vertical-align:middle;">Nama</th>
                <th style="background-color:#5b5a5a;color:white;vertical-align:middle;">NIP</th>
                <th style="background-color:#5b5a5a;color:white;vertical-align:middle;">Jabatan</th>
                <th style="background-color:#5b5a5a;color:white;vertical-align:middle;">Absen Masuk</th>
                <th style="background-color:#5b5a5a;color:white;vertical-align:middle;">Absen Pulang</th>
                <th style="background-color:#5b5a5a;color:white;vertical-align:middle;">Status Kehadiran</th>
                <th style="background-color:#5b5a5a;color:white;vertical-align:middle;">Deskripsi</th>
    
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($pegawai as $p):?>
            <tr>
                <td><?= $no++;?>.</td>
                <td><?= $p->nama;?></td>
                <td><?= $p->nip;?></td>
                <td><?= $p->jabatan;?></td>
                <td><?= (isset($status[$date][$p->finger]['masuk']))? date("H:i:s",$status[$date][$p->finger]['masuk']):"";?></td>
                <td><?= (isset($status[$date][$p->finger]['pulang']))? date("H:i:s",$status[$date][$p->finger]['pulang']):"";?></td>
                <?php if(isset($flag[$date][$p->id])):?>
                    <td style="background-color:<?= $flag[$date][$p->id]->color;?>;color:<?= $flag[$date][$p->id]->text;?>">
                        <?php $param = date("Ymd",strtotime($date)).$p->finger;?>
                        <center>
                            <i>*<?= $flag[$date][$p->id]->code;?></i>
                        </center>
                    </td>
                    <td><?= $flag[$date][$p->id]->name;?></td>
                <?php elseif(!isset($flag[$date][$p->id]) && isset($status[$date][$p->finger]['status'])):?>
                    <td style="background-color:<?= $status[$date][$p->finger]['status']['color'];?>;color:<?= $status[$date][$p->finger]['status']['text'];?>">
                        <?php $param = date("Ymd",strtotime($date)).$p->finger;?>
                        <center>
                            <?= $status[$date][$p->finger]['status']['code'];?>
                        </center>
                    </td>
                    <td><?= $status[$date][$p->finger]['status']['name'];?></td>
                <?php else:?>
                    <td></td>
                    <td></td>
                <?php endif;?>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <br>
    <p style="text-align: center; font-style: italic">
      Sumber: E-SAMANI (Elektronik Sistem Aplikasi Monitoring Absensi)
      <br>
      <?= date("j M Y H:i:s");?>
    </p>
    <br>
    <br>
    
    <table width="100%" style="font-size: 8pt; border-collapse: collapse;text-align: center; " cellpadding="1">
      <tbody>
        <tr>
          <td>PENANGGUNG JAWAB ABSENSI</td>
          <td>PETUGAS ABSENSI</td>
        </tr>
        <tr>
          <td>
            <br><br><br><br><br><br><br><br>
          </td>
          <td>
            <br><br><br><br><br><br><br><br>
          </td>
        </tr>
        <tr>
          <td>Drs. H. DAMSIR, S.H., M.H.</td>
          <td>ASTRIANI LANTUKA, Amd.Kep</td>
        </tr>
        <tr>
          <td>NIP. 19590215 198703 1 003</td>
          <td>NIP. 19850802 200902 2 006</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>