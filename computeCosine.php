<?php
function cosineSimilarity(&$tokensA, &$tokensB)
{
	$a = $b = $c = 0;
	$uniqueTokensA = $uniqueTokensB = array();
	$uniqueMergedTokens = array_merge($tokensA, $tokensB);
	foreach ($tokensA as $token=>$val) $uniqueTokensA[$token] = $val;
	foreach ($tokensB as $token=>$val) $uniqueTokensB[$token] = $val;
	$x2=0;
	$y2=0;
	$xArray=array();
	$yArray=array();
	$address=0;
	foreach ($uniqueMergedTokens as $token=>$v) {
		$xArray[$address] = isset($tokensA[$token]) ?  $tokensA[$token]: 0;
		$yArray[$address] = isset($tokensB[$token]) ?  $tokensB[$token]: 0;
		$x2+=$xArray[$address]*$xArray[$address];
		$y2+=$yArray[$address]*$yArray[$address];
		$address++;
		}
	$x2=sqrt($x2);
	$y2=sqrt($y2);
	for($k=0;$k<$address;$k++)
		{
		$xArray[$k]/=$x2;
		$yArray[$k]/=$y2;
		$a+=$xArray[$k]*$yArray[$k];
		$b+=$xArray[$k]*$xArray[$k];
		$c+=$yArray[$k]*$yArray[$k];
		}
	return $b * $c != 0 ? $a / sqrt($b * $c) : 0;
}

$array = preg_split('/[^[:alnum:]]+/', strtolower(file_get_contents($argv[1])));
foreach($array as $item)
	{
	if(strlen($item)>2)
		@$tokens1[$item]++;
	}
$array = preg_split('/[^[:alnum:]]+/', strtolower(file_get_contents($argv[2])));
foreach($array as $item)
        {
        if(strlen($item)>2)
                @$tokens2[$item]++;
        }
echo cosineSimilarity($tokens1, $tokens2)
?>
