<?php
class DBO
{
	public $conn;
	function __construct()
	{
		$this->conn=mysqli_connect('localhost', 'root', '', 'matrixstore');  
		if(!$this->conn) {
			die("Database connection failed");
		}
	}
	public function Del_admin($id){
		$Que="UPDATE admin SET ad_status = '0' WHERE ad_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function Act_admin($id){
		$Que="UPDATE admin SET ad_status = '1' WHERE ad_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function chick_user($email,$password)
	{
		$Que="SELECT vin_id FROM vindor where vin_email='".$email."' AND vin_pass='".$password."'";
		$res=mysqli_query($this->conn,$Que);
		$vin=mysqli_fetch_assoc($res);
		return $vin;
	}
	public function chick_admin($email,$pass){
		$Que="SELECT * FROM admin where ad_email='".$email."' AND ad_pass='".$pass."'";
		$res=mysqli_query($this->conn,$Que);
		$ad=mysqli_fetch_assoc($res);
		return $ad;
	}
	public function chick_admin2($email){
		$Que="SELECT * FROM admin where ad_email='".$email."'";
		$res=mysqli_query($this->conn,$Que);
		$ad=mysqli_fetch_assoc($res);
		return $ad;
	}
	public function get_admin($id){
		$Que="SELECT * FROM admin where ad_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$adm=mysqli_fetch_assoc($res);
		return $adm;
	}
	public function get_vin($id){
		$Que="SELECT * FROM vindor where vin_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$vin=mysqli_fetch_assoc($res);
		return $vin;
	}
	public function add_admin($fname,$mname,$lname,$email,$pass,$img,$phone,$address){
		$Que="INSERT INTO admin (ad_fname, ad_mname, ad_lname,ad_email, ad_pass,ad_img, ad_phone, ad_address, ad_status) VALUES ('$fname','$mname', '$lname','$email', '$pass', '$img', '$phone', '$address', '1')";
		$res=mysqli_query($this->conn,$Que);
	}
	public function Edit_admin($fname,$mname,$lname,$email,$pass,$img,$phone,$address,$id){
		$Que="UPDATE admin SET ad_fname = '$fname', ad_mname = '$mname', ad_lname = '$lname', ad_email = '$email', ad_pass = '$pass', ad_img = '$img', ad_phone = '$phone', ad_address = '$address' WHERE ad_id =".$id;
		$res=mysqli_query($this->conn,$Que);
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
	public function advin($fname,$mname,$lname,$email,$mobile,$pass,$address,$img,$bigcat_id,$aid){
		$Que="INSERT INTO vindor (vin_fname, vin_mname, vin_lname, vin_pass, vin_email, bigcat_id, vin_mobile, vin_img, vin_address, vin_sdate, ad_id, vin_status) 
		VALUES ('$fname', '$mname', '$lname', '$pass', '$email', '$bigcat_id', '$mobile', '$img', '$address', '".date("Y-m-d")."', '$aid', '1')";
		$res=mysqli_query($this->conn,$Que);
	}
	public function updvin($id,$aid,$fname,$mname,$lname,$email,$mobile,$pass,$address,$img,$sta,$bigcat_id){
		$Que="UPDATE vindor SET vin_fname = '$fname', vin_mname = '$mname', vin_lname = '$lname', vin_pass 
		='$pass', vin_email = '$email', bigcat_id = '$bigcat_id', vin_mobile = '$mobile', vin_img = '$img', vin_address = '$address', ad_id = '$aid' WHERE vin_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function act_vin($id){
		$Que="UPDATE vindor SET vin_status = '1' WHERE vin_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function dis_vin($id){
		$Que="UPDATE vindor SET vin_status = '0' WHERE vin_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function storeimg($id,$img){
		$Que="INSERT INTO pro_img (pro_id, pro_img) VALUES (".$id.", '".$img."')";
		$res=mysqli_query($this->conn,$Que);
	}
	public function get_cat($cid){
		$Que="SELECT * FROM bigcat WHERE bigcat_id=".$cid;
		$res=mysqli_query($this->conn,$Que);
		$cat=$res->fetch_assoc();
		return $cat;
	}
	public function get_sub_cat($cid){
		$Que="SELECT * FROM subcat WHERE subcat_id=".$cid;
		$res=mysqli_query($this->conn,$Que);
		$cat=$res->fetch_assoc();
		return $cat;
	}
	public function Act_cat($id){
		$Que="UPDATE bigcat SET bigcat_sta = '1' WHERE bigcat_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function Deact_cat($id){
		$Que="UPDATE bigcat SET bigcat_sta = '0' WHERE bigcat_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function add_cat($name,$imgname){
		$Que="INSERT INTO bigcat (bigcat_name, bigcat_img, bigcat_sta) VALUES ('$name', '$imgname', '1')";
		$res=mysqli_query($this->conn,$Que);
	}
	public function add_sub_cat($name,$id){
		$Que="INSERT INTO subcat (subcat_name, subcat_sta, bigcat_id) VALUES ('$name', '1', '$id')";
		$res=mysqli_query($this->conn,$Que);
	}
	public function update_cat($id,$name,$img){
		$Que="UPDATE bigcat SET bigcat_name = '$name', bigcat_img = '$img' WHERE bigcat_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function dis_sub($id){
		$Que="UPDATE subcat SET subcat_sta = '0' WHERE subcat_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function act_sub($id){
		$Que="UPDATE subcat SET subcat_sta = '1' WHERE subcat_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function update_sub($name,$bid,$sid){
		$Que="UPDATE subcat SET subcat_name = '$name', bigcat_id = '$bid' WHERE subcat_id =".$sid;
		$res=mysqli_query($this->conn,$Que);	
	}
	public function act_bra($id){
		$Que="UPDATE brand SET br_sta = '1' WHERE br_id=".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function dis_bra($id){
		$Que="UPDATE brand SET br_sta = '0' WHERE br_id=".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function add_br($name,$img,$bigcat){
		$Que="INSERT INTO brand (br_name, br_img, br_sta, bigcat_id) VALUES ('$name', '$img', '1', '$bigcat')";
		$res=mysqli_query($this->conn,$Que);
	}
	public function get_bra($id){
		$Que="SELECT * FROM brand WHERE br_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$ref=$res->fetch_assoc();
		return $ref;
	}
	public function upd_bra($name,$img,$Cid,$Bid){
		$Que="UPDATE brand SET br_name = '$name', br_img = '$img', bigcat_id = '$Cid' WHERE br_id =".$Bid;
		$res=mysqli_query($this->conn,$Que);
	}

	public function up_pass($pass,$id){
		$Que="UPDATE admin SET ad_pass = '$pass' WHERE ad_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}
	public function get_cos($id){
		$Que="SELECT * FROM customer where cos_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$COS=$res->fetch_assoc();
		return $COS;
	}
	public function get_add($id){
		$Que="SELECT * FROM address WHERE add_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$add=$res->fetch_assoc();
		return $add;
	}
	public function get_qty($id){
		$Que="SELECT COUNT(order_d_id) FROM or_det where order_id=".$id;
		$res=mysqli_query($this->conn,$Que);
		$count=$res->fetch_assoc();
		return $count;
	}public function act_cos($id){
		$Que="UPDATE customer SET cos_status = '1' WHERE cos_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}public function diact_cos($id){
		$Que="UPDATE customer SET cos_status = '0' WHERE cos_id =".$id;
		$res=mysqli_query($this->conn,$Que);
	}public function add_cos($fname,$mname,$lname,$email,$password,$mobile){
		$Que="INSERT INTO customer (cos_fname, cos_mname, cos_lname, cos_email, cos_pass, cos_mobile, cos_status) VALUES ('$fname', '$mname', '$lname', '$email', '$password', '$mobile', '1');";
		$res=mysqli_query($this->conn,$Que);
	}public function up_cos($fname,$mname,$lname,$email,$password,$mobile,$id){
		$Que="UPDATE customer SET cos_fname = '$fname', cos_mname = '$mname', cos_lname = '$lname', cos_email = '$email', cos_pass = '$mobile', cos_mobile = '07762197478' WHERE cos_id=".$id;
		$res=mysqli_query($this->conn,$Que);
	}public function add_prvlage($id,$priv){
		$Que="INSERT INTO ad_privileges (ad_id, privileges) VALUES ('$id', '$priv')";
		$res=mysqli_query($this->conn,$Que);
	}public function drop_priv($id){
		$Que="DELETE from ad_privileges where ad_id".$id;
		$res=mysqli_query($this->conn,$Que);
	}public function chick_privileges($id,$privileges){
		$Que="SELECT * FROM ad_privileges WHERE ad_id=".$id." AND privileges=".$privileges;
		$res=mysqli_query($this->conn,$Que);
		$TR=$res->fetch_assoc();
		return $TR;
	}
} 