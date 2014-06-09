<?php 

function cf($otot, $kaki, $gerak, $kepala, $lidah, $sesak, $kejang)
{
	$workcf=0;
	$otot= 0.9*$otot;
	$kaki= 0.7*$kaki;
	$gerak=0.3*$gerak;
	$kepala=1*$kepala;
	$lidah=0.4*$lidah;
	$sesak=0.4*$sesak;
	$kejang=0.6*$kejang;

	$rule=array($otot,$kaki,$gerak,$kepala,$lidah,$sesak,$kejang);
	for ($i=0; $i < 7; $i++) { 
		$workcf=$workcf+($rule[$i] * (1-$workcf));
	}
	return $workcf;
}


 ?>


<?php 

function cf2($otot, $kaki, $gerak, $kepala, $lidah, $sesak, $kejang, $kembung, $batuk, $rahang, $raisa, $kelopak)
{
	$workcfbotol=0.000;
	$workcftetanus=0.000;
	$otot1= 0.200*$otot;
	$kaki1= 0.500*$kaki;
	$gerak1=0.300*$gerak;
	$kepala1=0.800*$kepala;
	$lidah1=0.300*$lidah;
	$sesak1=0.300*$sesak;
	$kejang1=0.600*$kejang;
	$kembung1=0.600*$kembung;
	$batuk1=0.500*$batuk;
	$rahang1=0.700*$rahang;

	$raisa1=0.700*$raisa;
	$kelopak1=0.900*$kelopak;
	$ruletet=array($otot1,$kaki1,$gerak1,$kepala1,$lidah1,$sesak1,$kejang1,$kembung1,$batuk1,$rahang1,$raisa1,$kelopak1);

	/*
	buat botulism
	 */
	$otot2= 0.900*$otot;
	$kaki2= 0.700*$kaki;
	$gerak2=0.300*$gerak;
	$kepala2=1.00*$kepala;
	$lida21=0.400*$lidah;
	$sesak2=0.400*$sesak;
	$kejang2=0.600*$kejang;
	$kembung2=0.300*$kembung;
	$batuk2=0.500*$batuk;
	$rahang2=0.600*$rahang;

	$raisa2=0.400*$raisa;
	$kelopak2=0.200*$kelopak;
	$rulebot=array($otot2,$kaki2,$gerak2,$kepala2,$lidah2,$sesak2,$kejang2,$kembung2,$batuk2,$rahang2,$raisa2,$kelopak2);

	for ($i=0; $i < 12; $i++) { 
		$workcfbotol=$workcfbotol + ($rulebot[$i]*(1-$workcfbotol));
		$workcftetanus=$workcftetanus + ($ruletet[$i]*(1-$workcftetanus));
		
	}
	$hasil = array($workcfbotol,$workcftetanus);
	return $hasil;

}


 ?>