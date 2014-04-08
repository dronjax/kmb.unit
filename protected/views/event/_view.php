<div class="view viewevents">

	Nama acara: <?php echo CHtml::encode($data->nama); ?> <br />
	Tempat: <?php echo CHtml::encode($data->tempat); ?> <br />
	Waktu: <?php list($year, $month, $day) = split('[/.-]', $data->waktu);
		  echo date('d F Y',mktime(0,0,0,$month,$day,$year));
		//echo CHtml::encode($data->waktu); ?> <br />
	<div class="countdown<?php echo $data->ID; ?>"></div>
	<script>
		<?php
			list($year, $month, $day) = split('[/.-]', $data->waktu);
			$dayn = date('j',time());
			$monthn = date('n',time());
			$yearn = date('Y',time());
			$bulan=array(31,28,31,30,31,30,31,31,30,31,30,31);
			$temp=0;
			$temp2=0;
			$hari=$day;
			if ((($yearn%4==0)&&($yearn%100!=0))||($yearn%400==0))
			{
				$bulan[2]=29;
			}
			if ($monthn>$month)
			{
				for ($i=$monthn+1;$i<13;$i++)
				{
					$temp+=$bulan[i];
				}
				if (((($yearn+1)%4==0)&&(($yearn+1)%100!=0))||(($yearn+1)%400==0))
				{
					$bulan[2]=29;
				}
				else
				{
					$bulan[2]=28;
				}
				for ($i=1;$i<$month;$i++)
				{
					$temp+=$bulan[i];
				}
			}
			else 
			{
				for ($i=$monthn+1;$i<$month;$i++)
				{
					$temp+=$bulan[i];
				}
			}
			for ($i=$yearn+1;$i<$year;$i++)
			{
				if ((($i%4==0)&&($i%100!=0))||($i%400==0))
				{
					$bulan[2]=29;
				}
				else
				{
					$bulan[2]=28;
				}
				for ($i=1;$i<13;$i++)
				{
					$temp2+=$bulan[i];
				}
			}
			$mark=0;
			if ($year==$yearn)
			{
				if ($month==$monthn)
				{
					if ($day>$dayn)
					{
						$hari=$day-$dayn;
					}
					else if ($day==$dayn)
					{
						$mark=-2;
					}
					else
					{
						$mark=-1;
					}
				}
				else if ($month>$monthn)
				{
					$hari=$bulan[$monthn]-$dayn+$temp+$day;
				}
				else
				{
					$mark=-1;
				}
			}
			else if ($year>$yearn)
			{
				$hari=$bulan[$monthn]-$dayn+$temp+$day+$temp2;
			}
			else
			{
				$mark=-1;
			}
			$jam=$data->jam;
			$menit=$data->menit;
			$detik=0;
			$jamn=date('H',time());
			$menitn=date('i',time());
			$detikn=date('s',time());
			$jamn-=1;
			if ($jamn>$jam)
			{
				$jam=25-$jamn+$jam;
				if ($mark==-2)
				{
					$mark=-1;
				}
				$day-=1;
			}
			else
			{
				if (($mark==-2)&&($jam==$jamn))
				{
					$mark=-3;
				}
				$jam=$jam-$jamn;
			}
			if ($menitn>$menit)
			{
				$menit=60-$menitn+$menit;
				if ($mark==-3)
				{
					$mark=-1;
				}
				$jam-=1;
			}
			else
			{
				if (($mark==-3)&&($menit==$menitn))
				{
					$mark=-1;
				}
				$menit=$menit-$menitn;
			}
			$detik=60-$detikn;
			$menit-=1;
		?>
		$(document).ready(function(){
			  var mark = <?php echo $mark; ?>;
			  var countdetik<?php echo $data->ID; ?> = <?php echo date('s',mktime($jam,$menit,$detik,$month,$hari,$year)); ?>;
			  var countmenit<?php echo $data->ID; ?> = <?php echo date('i',mktime($jam,$menit,$detik,$month,$hari,$year)); ?>;
			  var countjam<?php echo $data->ID; ?> = <?php echo date('H',mktime($jam,$menit,$detik,$month,$hari,$year)); ?>;
			  var counthari<?php echo $data->ID; ?> = <?php echo date('j',mktime($jam,$menit,$detik,$month,$hari,$year)); ?>;
			  if (mark==-2)
			  {
				counthari<?php echo $data->ID; ?>=0;
				mark=0;
			  }
			  if (mark==-3)
			  {
				counthari<?php echo $data->ID; ?>=0;
				countjam<?php echo $data->ID; ?>=0;
				mark=0;
			  }
			  countdown<?php echo $data->ID; ?> = setInterval(function(){
				if (mark==0)
				{
					$(".countdown<?php echo $data->ID; ?>").html(counthari<?php echo $data->ID; ?> + " <sup>hari</sup> " + countjam<?php echo $data->ID; ?> + " <sup>jam</sup> " + countmenit<?php echo $data->ID; ?> + " <sup>menit</sup>" + countdetik<?php echo $data->ID; ?> + " <sup>detik</sup>");
				}
				else
				{
					$(".countdown<?php echo $data->ID; ?>").html('Sudah sampai waktu.');
				}
				countdetik<?php echo $data->ID; ?>--;
				if (countdetik<?php echo $data->ID; ?>==-1)
				{
					countdetik<?php echo $data->ID; ?>=59;
					countmenit<?php echo $data->ID; ?>-=1;
				}
				if (countmenit<?php echo $data->ID; ?>==-1)
				{
					countmenit<?php echo $data->ID; ?>=59;
					countjam<?php echo $data->ID; ?>-=1;
				}
				if (countjam<?php echo $data->ID; ?>==-1)
				{
					countjam<?php echo $data->ID; ?>=23;
					counthari<?php echo $data->ID; ?>-=1;
					if (counthari<?php echo $data->ID; ?>==-1)
					{
						mark=-1;
					}
				}
			  }, 1000);
		});
		countdown<?php echo $data->ID; ?> = setInterval(function(){}, 1000);
	</script>

</div>