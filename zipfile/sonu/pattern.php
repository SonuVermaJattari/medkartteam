<?php

		for($i=1; $i<=3; $i++){

			for($k=1; $k<$i; $k++){
				echo "&nbsp&nbsp";
			}

			for($j=$i; $j<=$i; $j++)
			{

				
				if($i==1){
					echo "[[[*]]]";
				} else if($i==2) {
					echo "[[*]]";
				} else {
					echo "[*]";
				}
			}
			echo "<br>";
		}

?>