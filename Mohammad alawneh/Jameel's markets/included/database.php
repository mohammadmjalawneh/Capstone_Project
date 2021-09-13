<?php
class DBO
{
	public $conn;
	function __construct()
	{
		$this->conn = mysqli_connect('localhost', 'root', '', 'matrixstore');
		if (!$this->conn) {
			die("Database connection failed");
		}
	}

	public function getcat($id)
	{
		$Que = "SELECT * FROM bigcat where bigcat_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function getimg($id)
	{
		$Que = "SELECT * FROM pro_img where pro_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function getsub($id)
	{
		$Que = "SELECT * FROM subcat where subcat_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function proinfo($id)
	{
		$Que = "SELECT * FROM product where pro_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function getbrand($id)
	{
		$Que = "SELECT * FROM brand where br_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function getvin($id)
	{
		$Que = "SELECT * FROM vindor where vin_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function getpro_count()
	{
		$C = 0;
		$Que = "SELECT * FROM product where pro_sta='1'";
		$res = mysqli_query($this->conn, $Que);
		while ($I = $res->fetch_assoc()) {
			$big = $this->getcat($I['bigcat_id']);
			if ($big['bigcat_sta']) {
				$sub = $this->getsub($I['subcat_id']);
				if ($sub['subcat_sta']) {
					$br = $this->getbrand($I['br_id']);
					if ($br['br_sta']) {
						$vin = $this->getvin($I['vin_id']);
						if ($vin['vin_status']) {
							$C++;
						}
					}
				}
			}
		}

		return $C;
	}

	public function subpro_count($id)
	{
		$C = 0;
		$Que = "SELECT * FROM product where pro_sta='1' AND subcat_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		while ($I = $res->fetch_assoc()) {
			$big = $this->getcat($I['bigcat_id']);
			if ($big['bigcat_sta']) {
				$br = $this->getbrand($I['br_id']);
				if ($br['br_sta']) {
					$vin = $this->getvin($I['vin_id']);
					if ($vin['vin_status']) {
						$C++;
					}
				}
			}
		}

		return $C;
	}

	public function bigcatpro_count($id)
	{
		$C = 0;
		$Que = "SELECT * FROM product where pro_sta='1' AND bigcat_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		while ($I = $res->fetch_assoc()) {
			$sub = $this->getsub($I['subcat_id']);
			if ($sub['subcat_sta']) {
				$br = $this->getbrand($I['br_id']);
				if ($br['br_sta']) {
					$vin = $this->getvin($I['vin_id']);
					if ($vin['vin_status']) {
						$C++;
					}
				}
			}
		}

		return $C;
	}

	public function brpro_count($id)
	{
		$C = 0;
		$Que = "SELECT * FROM product where br_id='$id'";
		$res = mysqli_query($this->conn, $Que);
		while ($I = $res->fetch_assoc()) {
			$big = $this->getcat($I['bigcat_id']);
			if ($big['bigcat_sta']) {
				$sub = $this->getsub($I['subcat_id']);
				if ($sub['subcat_sta']) {
					$vin = $this->getvin($I['vin_id']);
					if ($vin['vin_status']) {
						$C++;
					}
				}
			}
		}

		return $C;
	}

	public function cal_price($price, $descount)
	{
		return $price - ($price * ($descount / 100));
	}

	public function addcos($fname, $mname, $lname, $email, $pass, $mobile, $img)
	{
		$Que = "INSERT INTO customer (cos_fname, cos_mname, cos_lname,cos_email, cos_pass, cos_mobile, cos_img, cos_status) VALUES ('$fname', '$mname', '$lname', '$email', '$pass', '$mobile', '$img', '1')";
		$res = mysqli_query($this->conn, $Que);
	}

	public function chick_cos($email, $pass)
	{
		$Que = "SELECT * FROM customer where cos_email='" . $email . "' AND cos_pass='" . $pass . "'";
		$res = mysqli_query($this->conn, $Que);
		$cos = $res->fetch_assoc();
		return $cos;
	}

	public function add_address($country, $city, $sr_name, $bil_num)
	{
		$Que = "INSERT INTO address (country, city, sr_name, bil_num) VALUES ('$country', '$city', '$sr_name', '$bil_num')";
		$res = mysqli_query($this->conn, $Que);
		echo '<h1>' . $Que . '</h1>';
	}

	public function add_search($country, $city, $sr_name, $bil_num)
	{
		$Que = "SELECT * FROM address WHERE country='$country' AND city='$city' AND sr_name='$sr_name' AND bil_num='$bil_num'";
		$res = mysqli_query($this->conn, $Que);
		$add = $res->fetch_assoc();
		return $add;
	}

	public function add_order($cos_id, $add_id, $total, $or_notes)
	{
		$Que = "INSERT INTO orders (or_date, cos_id, add_id, total, or_notes, or_status) VALUES ('" . date('Y-m-d') . "', '$cos_id', '$add_id', '$total', '$or_notes', '1')";
		$res = mysqli_query($this->conn, $Que);
	}

	public function search_ord($cos_id, $add_id, $total)
	{
		$Que = "SELECT * FROM orders WHERE cos_id='$cos_id' AND add_id='$add_id' AND total=$total";
		$res = mysqli_query($this->conn, $Que);
		$add = $res->fetch_assoc();
		return $add;
	}

	public function add_pro($order_id, $pro_id, $pro_price)
	{
		$Que = "INSERT INTO or_det (order_id, pro_id, pro_price) VALUES ('$order_id', '$pro_id', '$pro_price')";
		$res = mysqli_query($this->conn, $Que);
	}

	public function update_qty($value, $id)
	{
		$Que = "UPDATE product SET pro_qty = '$value' WHERE pro_id = $id";
		$res = mysqli_query($this->conn, $Que);
	}

	public function order_info($id)
	{
		$Que = "SELECT * FROM orders WHERE or_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$add = $res->fetch_assoc();
		return $add;
	}

	public function ad_info($id)
	{
		$Que = "SELECT * FROM address where add_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$ad = $res->fetch_assoc();
		return $ad;
	}

	public function add_com($pro_id, $email, $com_name, $mobile, $com_time, $com_text)
	{
		$Que = "INSERT INTO reviews (pro_id,email,com_name, mobile, com_time, com_text) VALUES ($pro_id, '$email', '$com_name', '$mobile', '$com_time', '$com_text')";
		$res = mysqli_query($this->conn, $Que);
	}

	public function check_cos($email)
	{
		$Que = "SELECT * FROM customer WHERE cos_email = '$email'";
		$res = mysqli_query($this->conn, $Que);
		$cos = $res->fetch_assoc();
		return $cos;
	}

	public function up_pass_cos($id, $pass)
	{
		$Que = "UPDATE customer SET cos_pass = '$pass' WHERE cos_id =" . $id;
		$res = mysqli_query($this->conn, $Que);
	}

	public function get_cos($id)
	{
		$Que = "SELECT * FROM customer where cos_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$COS = $res->fetch_assoc();
		return $COS;
	}

	public function get_add($id)
	{
		$Que = "SELECT * FROM address WHERE add_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$add = $res->fetch_assoc();
		return $add;
	}
}
