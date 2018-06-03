<?php
ini_set('max_execution_time', 7200); //300 seconds = 5 minutes
 //error_reporting(0);
?>
<!doctype html>
<html>
<head>
	<title>
		</title>
		</head>
<body>


	<table>
<thead>
<td>Domain</td>
<td>Email</td>
</thead>
<tbody>

	<?php
// Include the library
include('simplehtmldom/simple_html_dom.php');

$list = false;

if(isset($_POST['domainlist'])){
    $list = $_POST['domainlist'];
 } 
  $start = microtime(true);
$lists = explode("\n",$list);
 $lists = array_map('trim',$lists);
 foreach ($lists as $domain)
 {
if (!empty($domain)) {

 $a = "http://". $domain;
 
 $url = $a;

extractmail($url,$domain);
}
}


function extractmail($url, $domain)
{

	$html = file_get_html($url);

	$res = preg_match_all(
"/[a-z0-9]+[_a-z0-9.-]*[a-z0-9]+@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})/i",$html,$matches);
if ($res) {
foreach(array_unique($matches[0]) as $email) {
	if ($email=== "nr@wrapped" || $email=== "nr@context" || $email=== "nr@original" || strpos($email,".jpg") || strpos($email,".png") || strpos($email,".js") || strpos($email,".css") || strpos($email,"example.com") || strpos($email,"facebook") || strpos($email,"twitter") || strpos($email,"instagram") || strpos($email,"email.com") || strpos($email,"opencart.com") || strpos($email,"@N0") || strpos($email,"domain.com") || strpos($email,"sentry.io") || strpos($email,".gif") || strpos($email,"youremail") || strpos($email,"prestashop.com") || strpos($email,"google.com") || strpos($email,"@email") || strpos($email,"getsentry.com") || strpos($email,"abc.com") || strpos($email,"xyz.com") || strpos($email,"@amazon.com") ){

	}
	else {
	echo "<tr>";
	echo "<td>". $domain . "</td>";
	echo "<td>" .$email . "</td>";
	echo "</tr>";
}
}
}
else {
	}
}

$time_elapsed_secs = microtime(true) - $start;
echo $time_elapsed_secs;
?>
<tbody>
	</table>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<textarea name="domainlist" cols="50" rows="25"></textarea>
	<button type="submit">Send</button>
</form>

</body>
</html>