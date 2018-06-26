<?php 
function taxAmount($yIncome = 0){
	$edgeIncome = [50000000,250000000,500000000,500000000]; // Level Penghasilan Kena Pajak 
	$taxRate = [5,15,25,30];								// Rate Pajak Penghasilan
	$incomeTax = 0; 										// Pajak Penghasilan
	$tmpAdjust = 0; 										// temporary hasil penyesuaian
	foreach ($edgeIncome as $key => $value) {
		if($yIncome >= $tmpAdjust){
			
			if($yIncome >= $value){
				if($key == 0){
					$calRate = $value * ($taxRate[$key]/100);
					$tmpAdjust = $tmpAdjust + $value;
				}
				elseif($key == (count($edgeIncome)-1)){
					$left = $yIncome - $value;
					$calRate = $left * ($taxRate[$key]/100);
					$tmpAdjust = $tmpAdjust + $value;	
				}
				else{
					$calRate = ($value-$edgeIncome[$key-1]) * ($taxRate[$key]/100);
					$tmpAdjust = $tmpAdjust + ($value-$edgeIncome[$key-1]);
				}
			}
			else{
				if($key == 0){
					$calRate = 0;
					$tmpAdjust = $yIncome;
				}
				else{ 
					
					$left = $yIncome - $tmpAdjust;
					$calRate = $left * ($taxRate[$key]/100);
					$tmpAdjust = $tmpAdjust + $left;
				}
			}
			$incomeTax = $incomeTax + $calRate;
			
		}
		
	}
	return $incomeTax;
}

echo "Tax a year For Rp.75.000.000  = <b>".number_format(taxAmount(75000000))."</b><br>";
echo "Tax a year For Rp.750.000.000 = <b>".number_format(taxAmount(750000000))."</b><br>";

/*
	Uncomment Code Below For Dynamic Form Post Submit
*/
// if (isset($_POST['submit'])) {
// 	// echo $tmpAdjust."<br/>";
// 	$yIncome = $_POST['yIncome'];
// 	echo "Tax a year = <b>".number_format(taxAmount($yIncome))."</b><br>";
// 	echo "Tax a month <b>".number_format(taxAmount($yIncome)/12)."<b>";
// }
?>

<!-- 
	Uncomment Code Below For Use Form Input as calculate any Taxable Income

-->

<!-- <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input placeholder="Fill With Yearly Annual Taxable Income. Ex: 75000000" style="width:50%;" type="text" name="yIncome" value="">
	<button type="submit" name="submit">CHECK PAJAK</button>
</form> -->
