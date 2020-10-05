<?php  
include_once 'included/connect.php';
include_once 'included/database.php';
$output = '';$query='';
if(isset($_POST["query"])){
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "SELECT * FROM product 
	WHERE pro_name LIKE '%".$search."%'
	OR pro_desc LIKE '%".$search."%'";
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0)
	{
		$output .= '<ul>';
		while($row = mysqli_fetch_array($result))
		{
			
			$output .= "<li class='text-justify text-decoration-none' style='font-size:1rem'><a href='single-product.php?S={$row['pro_id']}' style='color: #FFFFFF'>".$row["pro_name"]."</a></li><hr>";
			
		}
		echo'</ul>';
		echo $output;
	}
	else
	{
		echo 'Data Not Found';
	}
}