<?php
	echo '<p>Daftar Survey KMB Dhammañano ITB</p>';
	echo '<table>
			<tr><td>Daftar Survey</td><td>Penerbit</td><td>Deadline</td></tr>';
	$arrayLength = count($table);
	for ($i=0; $i < $arrayLength ; $i++) { 
		if($table[$i] != NULL && $surveyid[$i] != NULL){
			echo '<tr><td><a href="/survey/index.php?token='.$table[$i]->token.
			'&sid='.$surveyid[$i]->surveyls_survey_id.'&lang=id">'.$surveyid[$i]->surveyls_title.'<a/></td>
			<td>'.$admin[$i]->admin.'</td><td>'.$table[$i]->validuntil.'</td></tr>';
		}
	}
	echo '</table>';
?>