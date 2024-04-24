<?php
require_once '../config.php';
class Login extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}
	public function login(){
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT * from accounts where `email` = ? and password = ? and `status` != 3 ");
		$stmt->bind_param('ss',$email,$password);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			$data = $result->fetch_array();
			foreach($data as $k => $v){
				if(!is_numeric($k) && $k != 'password'){
					$this->settings->set_userdata($k,$v);
				}
			}
			$this->settings->set_userdata('status',$data['status']);
			$this->settings->set_userdata('login_type',3);
			if($this->settings->userdata('account_type') == 2){
				redirect('user');
			} else {
				redirect('admin');
			}
		}else{
		return json_encode(array('status'=>'incorrect','last_qry'=>"SELECT * from accounts where `email` = '$email' and password = $password "));
		}
	}
	public function logout(){
		if($this->settings->sess_des()){
			redirect('./login_form.php');
		}
	}
	public function register(){
		extract($_POST);
		// Prepare and bind parameters for the accounts table
		$stmtAccounts = $this->conn->prepare('INSERT INTO accounts (firstname, lastname, email, password) VALUES (?, ?, ?, ?)');
		$stmtAccounts->bind_param('ssss', $firstname, $lastname, $email, $password);
		if($stmtAccounts->execute()){
			// Prepare and bind parameters for the clients_list table
			$stmtClients = $this->conn->prepare('INSERT INTO clients_list (firstname, lastname, contact, address) VALUES (?, ?, ?, ?)');
			$stmtClients->bind_param('ssss', $firstname, $lastname, $contact, $address);
			if($stmtClients->execute()){
				$stmt = $this->conn->prepare("SELECT * from accounts where `email` = ? and password = ? and `status` != 3 ");
				$stmt->bind_param('ss',$email,$password);
				$stmt->execute();
				$result = $stmt->get_result();
				if($result->num_rows > 0){
					$data = $result->fetch_array();
					foreach($data as $k => $v){
						if(!is_numeric($k) && $k != 'password'){
							$this->settings->set_userdata($k,$v);
						}
					}
					$this->settings->set_userdata('status',$data['status']);
					$this->settings->set_userdata('login_type',3);
					if($this->settings->userdata('account_type') == 2){
						redirect('user');
					} else {
						redirect('admin');
					}
				}
			} else {
				return json_encode(array('status'=>'failed','last_qry'=>"INSERT INTO clients_list set firstname = '$firstname', lastname = '$lastname', contact = '$contact', address = '$address'"));
			}
		}else{
			return json_encode(array('status'=>'failed','last_qry'=>"INSERT INTO accounts set firstname = '$firstname', lastname = '$lastname', contact = '$contact', email = '$email', password = '$password'"));
		}
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	case 'register':
		echo $auth->register();
		break;
	default:
		echo $auth->index();
		break;
}

