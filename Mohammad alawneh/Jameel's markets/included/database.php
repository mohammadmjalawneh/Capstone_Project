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
		$Que = "SELECT * FROM product_img where product_id=" . $id;
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
		$Que = "SELECT * FROM product where product_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function getbrand($id)
	{
		$Que = "SELECT * FROM brand where brand_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function getvin($id)
	{
		$Que = "SELECT * FROM vindor where vindor_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		$I = $res->fetch_assoc();
		return $I;
	}

	public function getproduct_count()
	{
		$C = 0;
		$Que = "SELECT * FROM product where product_sta='1'";
		$res = mysqli_query($this->conn, $Que);
		while ($I = $res->fetch_assoc()) {
			$big = $this->getcat($I['bigcat_id']);
			if ($big['bigcat_sta']) {
				$sub = $this->getsub($I['subcat_id']);
				if ($sub['subcat_sta']) {
					$br = $this->getbrand($I['brand_id']);
					if ($br['brand_sta']) {
						$vin = $this->getvin($I['vindor_id']);
						if ($vin['vindor_status']) {
							$C++;
						}
					}
				}
			}
		}

		return $C;
	}

	public function subproduct_count($id)
	{
		$C = 0;
		$Que = "SELECT * FROM product where product_sta='1' AND subcat_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		while ($I = $res->fetch_assoc()) {
			$big = $this->getcat($I['bigcat_id']);
			if ($big['bigcat_sta']) {
				$br = $this->getbrand($I['brand_id']);
				if ($br['brand_sta']) {
					$vin = $this->getvin($I['vindor_id']);
					if ($vin['vindor_status']) {
						$C++;
					}
				}
			}
		}

		return $C;
	}

	public function bigcatproduct_count($id)
	{
		$C = 0;
		$Que = "SELECT * FROM product where product_sta='1' AND bigcat_id=" . $id;
		$res = mysqli_query($this->conn, $Que);
		while ($I = $res->fetch_assoc()) {
			$sub = $this->getsub($I['subcat_id']);
			if ($sub['subcat_sta']) {
				$br = $this->getbrand($I['brand_id']);
				if ($br['brand_sta']) {
					$vin = $this->getvin($I['vindor_id']);
					if ($vin['vindor_status']) {
						$C++;
					}
				}
			}
		}

		return $C;
	}

	public function brproduct_count($id)
	{
		$C = 0;
		$Que = "SELECT * FROM product where brand_id='$id'";
		$res = mysqli_query($this->conn, $Que);
		while ($I = $res->fetch_assoc()) {
			$big = $this->getcat($I['bigcat_id']);
			if ($big['bigcat_sta']) {
				$sub = $this->getsub($I['subcat_id']);
				if ($sub['subcat_sta']) {
					$vin = $this->getvin($I['vindor_id']);
					if ($vin['vindor_status']) {
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
		$Que = "INSERT INTO customer (customer_fname, customer_mname, customer_lname,customer_email, customer_pass, customer_mobile, customer_img, customer_status) VALUES ('$fname', '$mname', '$lname', '$email', '$pass', '$mobile', '$img', '1')";
		$res = mysqli_query($this->conn, $Que);
	}

	public function chick_cos($email, $pass)
	{
		$Que = "SELECT * FROM customer where customer_email='" . $email . "' AND customer_pass='" . $pass . "'";
		$res = mysqli_query($this->conn, $Que);
		$cos = $res->fetch_assoc();
		return $cos;
	}

	public function add_address($country, $city, $sr_name, $bil_num)
	{
		$Que = "INSERT INTO address (country, city, sr_name, bil_num) VALUES ('$country', '$city', '$sr_name', '$bil_num')";
		mysqli_query($this->conn, $Que);
	}

	public function add_search($country, $city, $sr_name, $bil_num)
	{
		$Que = "SELECT * FROM address WHERE country='$country' AND city='$city' AND sr_name='$sr_name' AND bil_num='$bil_num'";
		$res = mysqli_query($this->conn, $Que);
		$add = $res->fetch_assoc();
		return $add;
	}

	public function add_order($customer_id, $add_id, $total, $or_notes)
	{
		$Que = "INSERT INTO orders (or_date, customer_id, add_id, total, or_notes, or_status) VALUES ('" . date('Y-m-d') . "', '$customer_id', '$add_id', '$total', '$or_notes', '1')";
		$res = mysqli_query($this->conn, $Que);
	}

	public function search_ord($customer_id, $add_id, $total)
	{
		$Que = "SELECT * FROM orders WHERE customer_id='$customer_id' AND add_id='$add_id' AND total=$total";
		$res = mysqli_query($this->conn, $Que);
		$add = $res->fetch_assoc();
		return $add;
	}

	public function add_pro($order_id, $product_id, $product_price)
	{
		$Que = "INSERT INTO or_det (order_id, product_id, product_price) VALUES ('$order_id', '$product_id', '$product_price')";
		$res = mysqli_query($this->conn, $Que);
	}

	public function update_qty($value, $id)
	{
		$Que = "UPDATE product SET product_qty = '$value' WHERE product_id = $id";
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

	public function add_com($product_id, $email, $com_name, $mobile, $com_time, $com_text)
	{
		$Que = "INSERT INTO reviews (product_id,email,com_name, mobile, com_time, com_text) VALUES ($product_id, '$email', '$com_name', '$mobile', '$com_time', '$com_text')";
		$res = mysqli_query($this->conn, $Que);
	}

	public function check_cos($email)
	{
		$Que = "SELECT * FROM customer WHERE customer_email = '$email'";
		$res = mysqli_query($this->conn, $Que);
		$cos = $res->fetch_assoc();
		return $cos;
	}

	public function up_pass_cos($id, $pass)
	{
		$Que = "UPDATE customer SET customer_pass = '$pass' WHERE customer_id =" . $id;
		$res = mysqli_query($this->conn, $Que);
	}

	public function get_cos($id)
	{
		$Que = "SELECT * FROM customer where customer_id=" . $id;
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
