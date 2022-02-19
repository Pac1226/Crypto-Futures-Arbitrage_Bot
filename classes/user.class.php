<?php
require_once("dbh.class.php");



class User extends Dbh{



	//UPDATE USERS FINANCIALS
	public function updateUserFinancials($userID, $creditScore, $monthlyIncome, $monthlyDebt)
	{


		$sql = "UPDATE users SET creditScore = ?, monthlyIncome = ?, monthlyDebt = ? WHERE userID = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$creditScore, $monthlyIncome, $monthlyDebt, $userID])){

			return "success";

		}
		else
		{
			return "error";
		}


	}



	//GET PROFILE DETAILS
	public function getUserProfileDetails($userID)
	{


		$sql = "SELECT * FROM users WHERE userID = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$userID])){

			$result = $stmt->fetch();
			return $result;

		}
		else
		{
			return "error";
		}


	}







	//VERIFY CUSTOMER LOGGEDIN
	public function verifyCustomerLoggedIn($customerName, $customerSession, $customerID)
	{


		$sql = "SELECT * FROM customers WHERE id= ? AND name = ? AND customerSession = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$customerID, $customerName, $customerSession])){

			$result = $stmt->fetchAll();
			return $result;

		}
		else
		{
			return "error";
		}


	}



	//CHECK IF USER EXISTS
	public function check_if_user_exist($email)
	{


		$sql = "SELECT email FROM users WHERE email = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$email])){

			$result = $stmt->fetchAll();
			return $result;

		}
		else
		{
			return "error";
		}


	}



	//GET USER
	public function getUser($email)
	{
		$sql = "SELECT * FROM users WHERE email = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$email])){

			$result = $stmt->fetch();
			return $result;

		}
		else
		{
			return "error";
		}

	}




	//CREATE THE USER
	public function create_customer($email, $pass, $first, $last, $uniqueID, $date_time, $session_id)
	{
		$sql = "INSERT INTO users (userID, first, last, email, creditScore, password, created, session_id, monthlyIncome, monthlyDebt, dateCreated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$uniqueID, $first, $last, $email, 0, $pass, $date_time, $session_id, 0, 0, $date_time]))
		{

			return "success";

		}
		else
		{
			return "error";
		}
	}





	//ADD USERS PRELIM
	public function add_user_prelimary($simple_trader_user_id, $monthly_income, $monthly_debt, $credit_score)
	{

		$sql = "UPDATE users SET creditScore = ?, monthlyIncome = ?, monthlyDebt = ? WHERE userID = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$credit_score, $monthly_income, $monthly_debt, $simple_trader_user_id]))
		{

			return "success";

		}
		else
		{
			return "error";
		}

	}







	//GET USERS TRADES
	public function getUserTrades($userID)
	{

		$sql = "SELECT * FROM transactionLog WHERE userID = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$userID])){

			$result = $stmt->fetchAll();
			return $result;

		}
		else
		{
			return "error";
		}


	}








}