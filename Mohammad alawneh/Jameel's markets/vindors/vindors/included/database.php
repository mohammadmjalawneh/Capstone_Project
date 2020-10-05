<?php
class DBO
{
	public $conn;
	function __construct(){
		$this->conn=mysqli_connect('localhost', 'root', '', 'matrixstore');  
		if(!$this->conn) {
			die("Database connection failed");
		}
	}
	public function chick_vindor($mail){
		$Que="SELECT * FROM vindor WHERE vin_email='$mail'";
		$res=mysqli_query($this->conn,$Que);
		$vin=$res->fetch_assoc();
		return $vin;
	}
	public function chick_user($email,$password){
		$Que="SELECT * FROM vindor where vin_email='".$email."' AND vin_pass='".$password."'";
		$res=mysqli_query($this->conn,$Que);
		$vin=mysqli_fetch_assoc($res);
		return $vin;
	}
	public function get_vin($id){
		$Que="SELECT * FROM vindor where vin_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$vin=mysqli_fetch_assoc($res);
		return $vin;
	}
	public function get_pass($email,$mobile,$date){
		$Que="SELECT vin_id FROM vindor where vin_email='".$email."' AND vin_mobile='".$mobile."' AND vin_sdate=".$date;
		$res=mysqli_query($this->conn,$Que);
		$vin=mysqli_fetch_assoc($res);
		return $vin;
	}
	public function getdata($id){
		$Que="SELECT * FROM product where pro_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$pro=mysqli_fetch_assoc($res);
		return $pro;
	}
	public function delpro($id){
		$Que="UPDATE product SET pro_sta = '0' WHERE pro_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function actpro($id){
		$Que="UPDATE product SET pro_sta = '1' WHERE pro_id =".$id;
		$res=mysqli_query($this->conn,$Que);	
	}
	public function updvin($id,$fname,$mname,$lname,$email,$mobile,$pass,$address,$img,$sta){
		$Que="UPDATE vindor SET vin_fname = '".$fname."', vin_mname = '".$mname."', vin_lname = '".$lname."', vin_pass = '".$pass."', vin_email = '".$email."', vin_mobile = '".$mobile."', vin_img = '".$img."', vin_address = '".$address."', vin_status = '".$sta."'WHERE vin_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function getpro($name,$desc,$decs,$br_id,$bigcat_id,$subcat_id,$vin_id){
		$Que='SELECT pro_id FROM product where pro_name="'.$name.'"AND pro_desc="'.$desc.'" AND br_id='.$br_id.' AND bigcat_id='.$bigcat_id.' AND subcat_id='.$subcat_id.' AND vin_id='.$vin_id;
		$res=mysqli_query($this->conn,$Que);
		$pro_id=mysqli_fetch_assoc($res);
		return $pro_id['pro_id'];	
	}
	public function updpro($name,$desc,$price,$dess,$qty,$br_id,$bigcat_id,$pro_id){
		$Que='UPDATE product SET pro_name = "$name", pro_desc ="'.$desc.'", pro_price = "$price", pro_descount = "$dess", pro_qty = $qty, br_id = $br_id, bigcat_id = $bigcat_id WHERE pro_id ='.$pro_id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function storepro($name,$desc,$price,$decs,$qty,$br_id,$bigcat_id,$subcat_id,$vin_id){
		$Que='INSERT INTO product (pro_name, pro_desc, pro_price, pro_descount, pro_qty, br_id, bigcat_id, subcat_id, vin_id, pro_sta) VALUES ("'.$name.'", "'.$desc.'", '.$price.', "'.$decs.'", '.$qty.', '.$br_id.', '.$bigcat_id.', '.$subcat_id.', '.$vin_id.', "1")';
		$res=mysqli_query($this->conn,$Que);
	}
	public function storeimg($id,$img){
		$Que="INSERT INTO pro_img (pro_id, pro_img) VALUES (".$id.", '".$img."')";
		$res=mysqli_query($this->conn,$Que);
	}
	public function Deimg($id){
		$Que="DELETE from pro_img where pro_id".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function get_cat($id){
		$Que="SELECT * from bigcat where bigcat_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$C=$res->fetch_assoc();
		return $C;
	}
	public function up_pass($pass,$id){
		$Que="UPDATE vindor SET vin_pass = '$pass' WHERE vin_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function cos_info($id){
		$Que="SELECT * FROM customer WHERE cos_id =".$id;
		$res=mysqli_query($this->conn,$Que);
		$cos=$res->fetch_assoc();
		return $cos;
	}public function get_count($id){
		$Que="SELECT COUNT(pro_id) FROM or_det WHERE order_id =".$id;
		$res=mysqli_query($this->conn,$Que);
		$cos=$res->fetch_assoc();
		return $cos;
	}public function get_add($id){
		$Que="SELECT * FROM address WHERE add_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$add=$res->fetch_assoc();
		return $add;
	}
} 