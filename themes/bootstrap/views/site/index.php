<div id="topcontainer">
	<div id="slide">
		<div id='slider'>
			<ul>
				<?php
					for ($i=1;$i<11;$i++)
					{
						echo "<li>";
						echo "<a href='".Yii::app()->request->baseUrl."/images/slide/".$i.".JPG' target='_blank'>";
						//$file= $_SERVER['DOCUMENT_ROOT']."/betterkmb/images/slide/".$i.".JPG";
						//$img = Yii::app()->simpleImage->load($file);
						//$img->resizeToWidth(534);
						//$img->resizeToHeight(400);
						//$img->save($file);
						echo CHtml::image(Yii::app()->request->baseUrl."/images/slide/".$i.".JPG", "", array(""));
						echo "</a>";
						echo "</li>";
					}
				?>
			</ul>
		</div>
	</div>
	<div id="events">
		<?php
			$isi=Event::model()->findAll();
			foreach($isi as $data)
			{
				list($year, $month, $day) = split('[/.-]', $data->waktu);
				$dayn = date('j',time());
				$monthn = date('n',time());
				$yearn = date('Y',time());
				$bulan=array(31,28,31,30,31,30,31,31,30,31,30,31);
				$temp=0;
				$temp2=0;
				$hari=$day;
				if ((($yearn%4==0)&&($yearn%100!=0))||($yearn%400==0))
					$bulan[2]=29;
				if ($monthn>$month)
				{
					for ($i=$monthn+1;$i<13;$i++)
						$temp+=$bulan[i];
					if (((($yearn+1)%4==0)&&(($yearn+1)%100!=0))||(($yearn+1)%400==0))
						$bulan[2]=29;
					else
						$bulan[2]=28;
					for ($i=1;$i<$month;$i++)
						$temp+=$bulan[i];
				}
				else 
					for ($i=$monthn+1;$i<$month;$i++)
						$temp+=$bulan[i];
				for ($i=$yearn+1;$i<$year;$i++)
				{
					if ((($i%4==0)&&($i%100!=0))||($i%400==0))
						$bulan[2]=29;
					else
						$bulan[2]=28;
					for ($i=1;$i<13;$i++)
						$temp2+=$bulan[i];
				}
				$mark=0;
				if ($year==$yearn)
				{
					if ($month==$monthn)
					{
						if ($day>$dayn)
							$hari=$day-$dayn;
						else if ($day==$dayn)
							$mark=-2;
						else
							$mark=-1;
					}
					else if ($month>$monthn)
						$hari=$bulan[$monthn]-$dayn+$temp+$day;
					else
						$mark=-1;
				}
				else if ($year>$yearn)
					$hari=$bulan[$monthn]-$dayn+$temp+$day+$temp2;
				else
					$mark=-1;
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
						$mark=-1;
				}
				else
					if (($mark==-2)&&($jam==$jamn))
						$mark=-3;
				if ($menitn>$menit)
				{
					$menit=60-$menitn+$menit;
					if ($mark==-3)
						$mark=-1;
				}
				else
					if (($mark==-3)&&($menit==$menitn))
						$mark=-1;
				if ($mark==-1)
					Event::model()->findByPk($data->ID)->delete();
			}
			$dataProvider=new CActiveDataProvider('Event',array(
				'criteria'=>array(
					'limit'=>3,
				),
				'pagination'=>false,
			));
			$this->renderPartial('/event/index',array(
				'dataProvider'=>$dataProvider,
				)
			);
		?>
	</div>
</div>