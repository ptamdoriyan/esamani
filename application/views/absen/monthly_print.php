<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
        <h3><u>LAPORAN ABSENSI BULANAN</u></h3>
    </div>
    <table class="items" width="100%" style="font-size: 8pt; border-collapse: collapse; " cellpadding="8">
      <thead style="background-color:#5b5a5a">
        <tr>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">No</th>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Nama</th>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Jabatan</th>
          <th colspan="<?=$d;?>" style="background-color:#5b5a5a;color:white;vertical-align:middle;" class="text-center"><?= date("F", strtotime($ym[0]."-".$ym[1]."-01"))?></th>
          
      </tr>
      <tr>
          <?php 
              for ($i=1; $i <= $d; $i++): 
              
          ?>
          <?php $date = $ym[0]."-".$ym[1]."-".sprintf("%02s", $i);?>
          <th
              <?php if($libur[$date]): ?>
                  style="background-color:#5b5a5a;color:white;background-color:#ff4000"
              <?php elseif(!$libur[$date] && $date == date("Y-m-d")): ?>
                  style="background-color:#5b5a5a;color:white;background-color:#337ef8"
              <?php elseif(!$libur[$date] && $date != date("Y-m-d") && (date('D',strtotime($date)) == "Sat" || date('D',strtotime($date)) == "Sun")): ?>
                  style="background-color:#5b5a5a;color:white;background-color:#ffb500"
              <?php else: ?>
                  style="background-color:#5b5a5a;color:white"
              <?php endif; ?>
          >
              <?php if($puasa[$date]):?>
                  <span class="badge badge-success">p</span>
              <?php endif?>
              <?php if($kegiatan[$date]):?>
                  <span class="badge badge-primary">k</span>
              <?php endif?>
              <center><?php echo date("j",strtotime($date)) ?></center>
              <center style="font-size:6pt"><?php echo date("D",strtotime($date)) ?></center>
          </th>
          <?php endfor;?>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach($pegawai as $p):?>
        <tr height="10px">
          <td><?= $no++;?>.</td>
          <td><?= $p->nama;?></td>
          <td><?= $p->jabatan;?></td>
          <?php for ($i=1; $i <= $d; $i++):?> 
              <?php $date = $ym[0]."-".$ym[1]."-".sprintf("%02s", $i);?>
              <?php if(isset($flag[$date][$p->id])):?>
                  <td style="background-color:<?= $flag[$date][$p->id]->color;?>" width="10px" class="text-center" href="#" target="_blank">
                      <?php $param = $ym[0].$ym[1].sprintf("%02s", $i).$p->finger;?>
                      <a style="color:<?= $flag[$date][$p->id]->text;?>">
                          <i>*<?= $flag[$date][$p->id]->code;?></i>
                      </a>
                  </td>
              <?php elseif(!isset($flag[$date][$p->id]) && isset($status[$date][$p->finger]['status'])):?>
                  <td style="background-color:<?= $status[$date][$p->finger]['status']['color'];?>" width="10px" class="text-center" href="#" target="_blank">
                      <?php $param = $ym[0].$ym[1].sprintf("%02s", $i).$p->finger;?>
                      <a style="color:<?= $status[$date][$p->finger]['status']['text'];?>">
                          <?= $status[$date][$p->finger]['status']['code'];?>
                      </a>
                  </td>
              <?php else:?>
                  <td></td>
              <?php endif;?>
          <?php endfor;?>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <br>
    
    <div style="text-align: center">
        <h3><u>REKAP ABSENSI BULANAN</u></h3>
    </div>
    <table class="items" width="100%" style="font-size: 8pt; border-collapse: collapse; " cellpadding="8">
      <thead style="background-color:#5b5a5a">
        <tr>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">No</th>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Nama</th>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Jabatan</th>
          <th colspan="<?=count($ref_status);?>" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Status</th>
          <th colspan="<?=count($ref_flag);?>" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Flag</th>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Total</th>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Potongan</th>
          <th rowspan="2" style="background-color:#5b5a5a;color:white;vertical-align:middle;">Waktu Absen</th>
        </tr>
        <tr>
          <?php foreach ($ref_status as $rs):?>
          <th style="background-color:<?=$rs['color'];?>;color:<?=$rs['text'];?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?=$rs['name'];?>">
                  <center><?=$rs['code'];?></center>
                  <center style="font-size:6pt"><?=$rs['potongan'];?>%</center>
          </th>
          <?php endforeach;?>
          <?php foreach ($ref_flag as $rf):?>
          <th style="background-color:<?=$rf->color;?>;color:<?=$rf->text;?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?=$rf->name;?>">
                  <center><?=$rf->code;?></center>
                  <center style="font-size:6pt"><?=$rf->potongan;?>%</center>
          </th>
          <?php endforeach;?>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach($pegawai as $p):?>
        <tr height="10px">
          <td><?= $no++;?>.</td>
          <td><?= $p->nama;?></td>
          <td><?= $p->jabatan;?></td>
          <?php foreach ($ref_status as $rs):?>
          <td>
              <?=($count[$p->finger][$rs['code']]['count']==0)? "":$count[$p->finger][$rs['code']]['count'];?>
              <?=($count[$p->finger][$rs['code']]['count']==0)? "":"(".$count[$p->finger][$rs['code']]['potongan']."%)";?>
          </td>
          <?php endforeach;?>
          <?php foreach ($ref_flag as $rf):?>
          <td>
              <?=($countflag[$p->finger][$rf->code]['count']==0)? "":$countflag[$p->finger][$rf->code]['count'];?>
              <?=($countflag[$p->finger][$rf->code]['count']==0)? "":"(".$countflag[$p->finger][$rf->code]['potongan']."%)";?>
          </td>
          <?php endforeach;?>
          <td>
              <?=$total[$p->finger]['count'];?>
          </td>
          <td>
              <?=($total[$p->finger]['potongan']==0)? "":"".$total[$p->finger]['potongan']."%";?>
          </td>
          <td>
              <?=
                  (
                      $total[$p->finger]['absen']==0 &&
                      $total[$p->finger]['terlambat']['hari']==0
                  )? 
                      "":
                      $total[$p->finger]['absen']+$total[$p->finger]['terlambat']['hari']." hari kerja"
              ;?>
              <?=($total[$p->finger]['terlambat']['detik']>0 && gmdate("H", $total[$p->finger]['terlambat']['detik']) != "00")? " ".gmdate("H", $total[$p->finger]['terlambat']['detik'])." Jam":"";?>
              <?=($total[$p->finger]['terlambat']['detik']>0 && gmdate("i", $total[$p->finger]['terlambat']['detik']) != "00")? " ".gmdate("i", $total[$p->finger]['terlambat']['detik'])." Menit":"";?>
              <?=($total[$p->finger]['terlambat']['detik']>0 && gmdate("s", $total[$p->finger]['terlambat']['detik']) != "00")? " ".gmdate("s", $total[$p->finger]['terlambat']['detik'])." Detik":"";?>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
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
    <!-- <br>
    <p style="text-align: center; font-style: italic">
      Sumber: E-SAMANI (Elektronik Sistem Aplikasi Monitoring Absensi)
      <br>
      <?= date("j M Y H:i:s");?>
    </p> -->
  </body>
</html>