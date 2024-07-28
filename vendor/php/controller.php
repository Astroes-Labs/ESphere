<?php
session_start();

class mainController {
	private $hostname;
	private $username;
	private $password;
	private $database;
	private $loginPage;
	private $dashboardPage;
	public $db;

	public function __construct($hostname, $username, $password, $database, $loginPage, $dashboardPage){
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
		$this->loginPage = $loginPage;
		$this->dashboardPage = $dashboardPage;
	}

	public function dbConnect(){
		$this->db = new mysqli($this->hostname,$this->username,$this->password,$this->database);
		if(mysqli_connect_errno()){
			echo "Error: Counld not connect to the database";
			exit;
		}
	}

	//Create User
	public function createUser($username, $fullname, $email, $phone, $country, $password, $referral) {
	    // Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    
	    // Sanitize inputs
	    $username = $this->db->real_escape_string($username);
	    $fullname = $this->db->real_escape_string($fullname);
	    $email = $this->db->real_escape_string($email);
	    $phone = $this->db->real_escape_string($phone);
	    $country = $this->db->real_escape_string($country);
	    $password = $this->db->real_escape_string($password);
	    $referral = $this->db->real_escape_string($referral);
	    
	    // Hash the password (you may want to use a more secure method than md5)
	    $hashed_password = md5($password);
	    
	    // Check if username already exists
	    $stmt = $this->db->prepare("SELECT id FROM clients WHERE username = ?");
	    $stmt->bind_param("s", $username);
	    $stmt->execute();
	    $stmt->store_result();
	    
	    if ($stmt->num_rows > 0) {
	        // Username already exists
	        return "UAE"; // Username already exists
	    }
	    
	    $stmt->close();
	    
	    // Check if email already exists
	    $stmt = $this->db->prepare("SELECT id FROM clients WHERE email = ?");
	    $stmt->bind_param("s", $email);
	    $stmt->execute();
	    $stmt->store_result();
	    
	    if ($stmt->num_rows > 0) {
	        // Email already exists
	        return "EAE"; // Email already exists
	    }
	    
	    $stmt->close();
	    
	    // Insert new user into database
	    $stmt = $this->db->prepare("INSERT INTO clients (username, fullname, email, phone, country, password, referral) VALUES (?, ?, ?, ?, ?, ?, ?)");
	    $stmt->bind_param("sssssss", $username, $fullname, $email, $phone, $country, $hashed_password, $referral);
	    
	    if ($stmt->execute()) {
	        // Insert successful
	        return 'RS';
	    } else {
	        // Insert failed
	        return false;
	    }
	}

	//Create User 2: with use of CRUD methods
	public function createUser2($data) {
	    // Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    
	    $tableName = "clients"; // Example table name
	    
	    if ($this->valueExists($tableName, "username", $data['username'])) {
	        // Username already exists
	        return "UAE"; // Username already exists
	    }

	    if ($this->valueExists($tableName, "username", $data['email'])) {
	        // Email already exists
	        return "EAE"; // Email already exists
	    }

		// Insert user data into table
		$result = $this->insertData($tableName, $data);

	    if ($result) {
	        // Insert successful
	        return 'RS';
	    } else {
	        // Insert failed
	        return false;
	    }
	}

	//User Login
    public function validateUser($username, $password){
        if(!$this->db) {
            $this->dbConnect();
        }

        // Sanitize inputs
        $username = $this->db->real_escape_string($username);
        $password = $this->db->real_escape_string($password);
        $password = md5($password);

        // Prepare and bind SQL statement
       
   		$stmt = $this->db->prepare("SELECT * FROM clients WHERE (email = ?) AND password = ?");
        $stmt->bind_param("ss", $username, $password);

        // Execute query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check if a user was found
        if ($result->num_rows == 1) {
            // Login successful
            $row = $result->fetch_assoc();
            $_SESSION['lid'] = $row['id'];
            return true;
        } else {
            // Login failed
            return false;
        }

    }

	 public static function setGenderOptions($gender = '') {

	        // Assign the gender to session if provided
	        $_SESSION['gender'] = $gender;

	        // Initialize $settingsGenderOptions with default options
	        $settingsGenderOptions = '
	            <option value="male">male</option>
	            <option value="female">female</option>
	            <option value="other">other</option>
	        ';

	        // Check if $_SESSION['gender'] is set and not empty
	        if (isset($_SESSION['gender']) && !empty($_SESSION['gender'])) {
	            // Determine which option to mark as selected
	            switch ($_SESSION['gender']) {
	                case 'male':
	                    $settingsGenderOptions = '
	                        <option value="male" selected>male</option>
	                        <option value="female">female</option>
	                        <option value="other">other</option>
	                    ';
	                    break;
	                case 'female':
	                    $settingsGenderOptions = '
	                        <option value="male">male</option>
	                        <option value="female" selected>female</option>
	                        <option value="other">other</option>
	                    ';
	                    break;
	                case 'other':
	                    $settingsGenderOptions = '
	                        <option value="male">male</option>
	                        <option value="female">female</option>
	                        <option value="other" selected>other</option>
	                    ';
	                    break;
	                default:
	                    // If $_SESSION['gender'] is set but not 'male', 'female', or 'other', revert to default options
	                    $settingsGenderOptions = '
	                        <option value="male">male</option>
	                        <option value="female">female</option>
	                        <option value="other">other</option>
	                    ';
	                    break;
	            }
	        }

	        // Assign the options to $_SESSION['settingsGenderOptions']
	        $_SESSION['settingsGenderOptions'] = $settingsGenderOptions;
	    }
    //Fetch User Data
	public function fetchData() {
	    if (!$this->db) {
	        $this->dbConnect();
	        $lid = $_SESSION['lid'];
	    }
	    $tableName = 'clients';
	    $conditions = array(
            'id' => $lid
        );

        $data = $this->readData($tableName, $conditions);
        $dataClient = $data[0];
	    $_SESSION['balance'] = $dataClient['balance'];
	    $splitBalance = $this->separateAndFormatDecimal($_SESSION['balance']);
	    $_SESSION['balanceWhole'] = $splitBalance['whole'];
	    $_SESSION['balanceDecimal'] = $splitBalance['decimal'];
	    $_SESSION['username'] = $dataClient['username'];
	    $_SESSION['fullname'] = $dataClient['fullname'];
	    $fullname = explode(' ', $_SESSION['fullname'], 2);
	    $_SESSION['firstName'] = $fullname[0];
	    if(isset($fullname[1])){
	    	$_SESSION['lastName'] = $fullname[1];
	    }else{
	    	$_SESSION['lastName'] = " ";
	    }
	    $_SESSION['email'] = $dataClient['email'];
	    //FIX PROFIT
	    $_SESSION['profit'] = $profit = $dataClient['profit'];;
	    $splitBalance = $this->separateAndFormatDecimal($_SESSION['profit']);
	    $_SESSION['profitWhole'] = $splitBalance['whole'];
	    $_SESSION['profitDecimal'] = $splitBalance['decimal'];
	    $_SESSION['badgeInfo'] = $this->userBadge($profit);
	    $_SESSION['referralUrl'] = getBaseUrl()."/home/register.html?invite=$lid";
	    if ($dataClient['image_id'] !== "null") {
	    	
		    $tableName = 'images';
		    $id = (int) $dataClient['image_id'];
		    $conditions = array(
	            'id' => $id
	        );
	        $data = $this->readData($tableName, $conditions);
	        $imgUrl =  $data[0]['url'];

			$_SESSION['profilePic'] = "../vendor/php/uploads/$imgUrl";
	    }else{
			$_SESSION['profilePic'] = "../assets/global/materials/user.png";
	    }
	    $_SESSION['gender'] = $dataClient['gender'];
	    $this->setGenderOptions($_SESSION['gender']);
	    $_SESSION['phone'] = $dataClient['phone'];
	    $_SESSION['country'] = $dataClient['country'];
	    $_SESSION['city'] = $dataClient['city'];
	    $_SESSION['zip'] = $dataClient['zip'];
	    $_SESSION['address'] = $dataClient['address'];
	    $_SESSION['dob'] = $dataClient['dob'];
		$timestamp = strtotime($dataClient['date_created']);
		$_SESSION['dateJoined'] = date("D, M d, Y g:i A", $timestamp);
		$this->kycData();
		$this->referralLog();
		$this->sendMoneyLog();
	    $this->allSchemas();
	    $this->schemaLogs();
	    $this->transactions();
	    $this->depositLog();
	    $this->depositBonusLog();
	    $this->withdrawLog();
	    $this->notifications();
	    $this->supportTickets();
	    return true;
	}
	//Fetch Kyc Data
	public function kycData()
	{
		
	    $lid = $_SESSION['lid'];
	    $tableName = 'veridata';
	    $conditions = array(
            'uid' => $lid
        );
        $data = $this->readData($tableName, $conditions);
		$_SESSION['kycStatus'] = "";
        if(count($data) === 1){
        	$_SESSION['kycFormVisibility'] = "d-none";
        	$_SESSION['kycInfoVisibility'] = "";
			$_SESSION['kycStatus'] = $data[0]['status'];
		    if($data[0]['status'] === "pending"){
		    	$innerClass = "warnning";
		    	$innerMessage = "Your Kyc Is Pending";
	        	$_SESSION['kycAlert'] = "
	        	<div class=\"alert site-alert alert-dismissible fade show\" role=\"alert\">
				    <div class=\"content\">
				        <div class=\"icon\"><i class=\"anticon anticon-warning\"></i></div>
				        <strong>KYC Pending</strong>
				    </div>
				</div>";

	        	$_SESSION['kycAlertMobile'] = "
				<div class=\"user-kyc-mobile\">
                    <i icon-name=\"fingerprint\" class=\"kyc-star\"></i>
                    KYC Pending
                </div>";
		    }else{
		    	$innerClass = "success";
		    	$innerMessage = "Your Kyc Is Verified";
	        	$_SESSION['kycAlert'] = " ";
	        	$_SESSION['kycAlertMobile'] = " ";
		    }

	    	$inner = ucfirst($data[0]['status']);
	    	$_SESSION['kycFormMessage'] = "<div class=\"site-badge $innerClass\">$innerMessage</div>";
        }else{
        	$_SESSION['kycFormVisibility'] = "";
        	$_SESSION['kycInfoVisibility'] = "d-none";
			$_SESSION['kycStatus'] = "pending";
        	$_SESSION['kycAlert'] = "
        	<div class=\"alert site-alert alert-dismissible fade show\" role=\"alert\">
			    <div class=\"content\">
			        <div class=\"icon\"><i class=\"anticon anticon-warning\"></i></div>
			        You need to submit your
			        <strong>KYC and Other Documents</strong> before proceed to the system.
			    </div>
			    <div class=\"action\">
			        <a href=\"../user/kyc.html\" class=\"site-btn-sm grad-btn\"><i class=\"anticon anticon-info-circle\"></i>Submit Now</a>
			        <a href=\"\" class=\"site-btn-sm red-btn ms-2\" type=\"button\" data-bs-dismiss=\"alert\" aria-label=\"Close\"><i
			                class=\"anticon anticon-close\"></i>Later</a>
			    </div>
			</div>";
	        	$_SESSION['kycAlertMobile'] = "
				<div class=\"user-kyc-mobile\">
                    <i icon-name=\"fingerprint\" class=\"kyc-star\"></i>
                    Please Verify Your Identity <a href=\"../user/kyc.html\">Submit Now</a>
                </div>";
        }
	}
	//Change Password
	public function changePassword($data)
	{
	    
	    $id = (int) $_SESSION['lid'];
	    $tableName = 'clients';
	    $conditions = array(
            'id' => $id
        );
        $oldpassword = $this->readData($tableName, $conditions);
        $oldpassword = $oldpassword[0]['password'];
        if(md5($data['current_password']) === $oldpassword){
	    	$tableName = 'clients';
		    $conditions = array(
	            'id' => $id
	        ); 
	        $dataone = array();
	        $dataone['password'] = md5($data['new_password']);
	        // Call the updateData method internally
	        $result = $this->updateData($tableName, $dataone, $conditions);

		    if ($result) {
		    	return true;
		    }else{
		    	return false;
		    }
	    }else{
	    	return false;
	    }
		
	}

	//Change Settings
	public function changeSettings($data){
	    $tableName = 'clients';
	    if($data['image_id'] === 'null'){
	    	unset($data['image_id']);
	    }
	    $id = (int) $_SESSION['lid'];
	    $conditions = array(
            'id' => $id
        ); 
        // Call the updateData method internally
        $result = $this->updateData($tableName, $data, $conditions);

	    if ($result) {
	    	return true;
	    }else{
	    	return false;
	    }
	}

	//Submit KYC
	public function submitKyc($data)
	{
		$tableName = 'veridata';
	    $id = (int) $_SESSION['lid'];
	    $data['uid'] = $id;
        // Call the updateData method internally
		$result = $this->insertData($tableName, $data);

	    if ($result) {
	    	return true;
	    }else{
	    	return false;
	    }
	}

	//Schema Preview
	public function schemaPreview($schemaId){
	    $tableName = 'schemas_list';
	    $schemaId = (int) $schemaId;
	    $conditions = array(
            'id' => $schemaId
        );
        $data = $this->readData($tableName, $conditions);
        $_SESSION['schemaPreview'] =  $data[0];
	    $tableName = 'schemas_list';
	    $conditions = "";
        $allSchemas = $this->readData($tableName, $conditions);
        //print_r($allSchemas[0]);
        $_SESSION['schemasFormOptions'] = "";
	    foreach($allSchemas as $option) {
	        $optionId = $option['id'];
	        $isSelected = ($optionId === $schemaId) ? 'selected' : '';
	        
	    	$_SESSION['schemasFormOptions'] .= '<option value="'. $optionId. '" ' . $isSelected . '>' . htmlspecialchars($option['name']) . '</option>';
	    }

	        //print_r($_SESSION['schemasFormOptions']);
	    return true;
	}

	//All Schema
	public function allSchemas(){
	    $tableName = 'schemas_list';
	    $conditions = "";
        $data = $this->readData($tableName, $conditions);
        $_SESSION['allSchemas'] = "";
        foreach ($data as $row) {

			$_SESSION['allSchemas'] .= "
	        	<div class=\"col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12\">
				    <div class=\"single-investment-plan\">
				        <img class=\"investment-plan-icon\" src=\"".$row['icon']."\" alt=\"\">
				        <div class=\"feature-plan\">".$row['name']."</div>

				        <h3>".$row['name']."</h3>
				        <p>Daily ".$row['roi']."%</p>
				        <ul>
				            <li>Investment <span class=\"special\">
				                   $".$row['min']."-$".$row['max']."
				                </span></li>
				            <li>Capital Back
				                <span>".$row['capital_back']."</span>
				            </li>
				            <li>Return Type <span>".$row['return_type']."</span>
				            </li>
				            <li>Number of Period
				                <span>".$row['period']." Times</span>
				            </li>
				            <li>Profit Withdraw <span>".$row['profit_withdraw']."</span></li>
				            <li>Cancel <span> ".$row['cancel']." </span></li>
				        </ul>
				        <div class=\"holidays\"><span class=\"star\">*</span> No Profit Holidays
				        </div>
				        <a href=\"javascript:void(0);\" class=\"site-btn grad-btn w-100 centered\" onclick=\"schemaPreview('".$row['id']."')\"><i
				                class=\"anticon anticon-check\"></i>Invest Now</a>
				    </div>
				</div>
			";
        }
	    return true;
	}


	//Toggle Support Ticket 
	public function toggleTicketStatus($ticketId, $ticketStatus){
	    $tableName = 'support_ticket';
	    $ticketId = (int) $ticketId;
	    $conditions = array(
            'id' => $ticketId
        );
        if ($ticketStatus === 'completed') {
		    $newStatus = 'opened';
		} else {
		    $newStatus = 'completed';
		    unset($_SESSION['showTicket']);
		    unset($_SESSION['ticketMessages']);
		}
        $data = array('status' => $newStatus); 
        $conditions = array('id' => $ticketId); 
        // Call the updateData method internally
        $result = $this->updateData($tableName, $data, $conditions);	
	    if ($result) {
	    	return true;
	    }
	}


	//Show Support Ticket
	public function showTicket($showTicketId){
	    $email = $_SESSION['email'];
	    $fullname = ucfirst($_SESSION['fullname']);
	    $tableName = 'support_ticket';
	    $showTicketId = (int) $showTicketId;
	    $conditions = array(
            'id' => $showTicketId
        );
	    $_SESSION['showTicket'] = "";
        $data = $this->readData($tableName, $conditions);
        $_SESSION['showTicket'] =  $data[0];
	    $tableName = 'support_ticket_messages';
	    $conditions = array(
            'ticket_id' => $_SESSION['showTicket']['id']
        );
		$orderBy = "date_created ASC";
        $ticketData = $this->readData($tableName, $conditions, $orderBy);
        $_SESSION['ticketMessages'] = "";
        $i = 0;
        $totalItems = count($ticketData);
        $scrollTo = "";
	    foreach($ticketData as $option) {
	    	$i++;
			if ($i === $totalItems) {
			    // This is the last element
        		$scrollTo = "id=\"currentMessage\"";
			}else{
        		$scrollTo = "";
			}
	        $message = $option['message'];
	        $imageId = $option['image_id'];
	        $attachment = "";
	        if ($imageId !== 'null') {
		         $tableName = 'images';
			    $conditions = array(
		            'id' => $imageId
		        );
		        $data = $this->readData($tableName, $conditions);
		        $imgUrl =  $data[0]['url'];

		        $attachment = "
				    <div class=\"message-attachments\">
				        <div class=\"title\">Attachments</div>
				        <div class=\"single-attachment\">

				            <div class=\"attach\">
				                <a href=\"../vendor/php/uploads/$imgUrl\" target=\"_blank\"><i class=\"anticon anticon-picture\"></i>$imgUrl</a>
				            </div>
				        </div>
				    </div>
		        ";
	        }

	        
	    	$_SESSION['ticketMessages'] .= "
	    		<div class=\"support-ticket-single-message user\" $scrollTo> 
				    <div class=\"logo\">
				        <img class=\"avatar\" src=\"".$_SESSION['profilePic']."\" alt=\"\" height=\"40\" width=\"40\">
				    </div>
				    <div class=\"message-body\">
				       $message
				    </div>


				    <div class=\"message-footer\">
				        <div class=\"name\">$fullname</div>
				        <div class=\"email\"><a href=\"mailto:\" >$email</a>
				        </div>
				    </div>
				    $attachment
				</div>


	    	";
	    }

	    return true;
	}

	//Creat Support Ticket
	public function createTicket($data)
	{
		// Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    $data['uid'] =  $_SESSION['lid'];
	    $data['unique_id'] = generateRandomString($length = 6, $characters = '0123456789', $randomString = 'SUPT');
        while($this->valueExists("support_ticket", "unique_id", $data['unique_id'])){
	    	$data['unique_id'] = generateRandomString($length = 6, $characters = '0123456789', $randomString = 'SUPT');
	    }

	    $tableName = "support_ticket"; 
	    $newdata['message'] = $data['message'];
	    $newdata['image_id'] = $data['image_id'];
	    unset($data['message']);
	    unset($data['image_id']);

		$result = $this->insertData($tableName, $data);
		if($result){
			$conditions = array(
			    'unique_id' => $data['unique_id'],
			);
			$ticketData = $this->readData($tableName, $conditions);
			$newdata['ticket_id'] = $_SESSION['tempTicketId'] = $ticketData[0]['id'];
			$updateClient = $this->replyTicket($newdata);
		    if ($updateClient) {
		        return true;
		    } else {
		        return false;
		    }
		}
		
	}

	//Reply Ticket 
	public function replyTicket($data)
	{
		$newTableName = 'support_ticket_messages';
		$updateClient = $this->insertData($newTableName, $data);
		if ($updateClient) {
			return true;
		}else{
			return false;
		}
	}

	//Support Tickets List 
	public function supportTickets()
	{	$fullname = ucfirst($_SESSION['fullname']);
		$table = 'support_ticket';
		$conditions = array(
		    'uid' => $_SESSION['lid'],
		);
		$orderBy = "date_created DESC";

		$supportTickets = $this->readData($table, $conditions);
		$counter = 0;
		$_SESSION['supportTickets'] = "";
		$inner = "";
		$openedTickets = "";
		$completedTickets = "";
		$inner = "";
		$readClass = "";
        foreach ($supportTickets as $row) {

			$statusClass = "";
			$secondIcon = "";
			$onclickFunction = "";
        	$status = $row['status'];
        	$title = $row['tname'];
        	$id = $row['id'];
        	$dateString = $row['date_created'];
			$date = new DateTime($dateString);
			$formattedDate = $date->format('M d Y H:i');
        	$timeago = $this->getTimeElapsedString($row['date_created']);
        	if ($status === "opened") {
				$statusClass = "badge-pending";
				
				$firstanchor = "
				<a href=\"javascript:void(0);\" class=\"cancel\" onclick=\"toggleTicketStatus('$id','$status')\" data-bs-toggle=\"tooltip\" title=\"\" data-bs-original-title=\"Complete Ticket\" aria-label=\"Complete Ticket\">
				";
				$secondIcon = "
					<svg
	                    xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\"
	                    stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"
	                    data-lucide=\"eye\" icon-name=\"eye\" class=\"lucide lucide-eye\">
	                    <path d=\"M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z\"></path>
	                    <circle cx=\"12\" cy=\"12\" r=\"3\"></circle>
	                </svg>
				";
				$onclickFunction = "showTicket('$id')";
        	}else{
				$statusClass = "badge-success";
				$firstanchor = "
					<a href=\"javascript:void(0);\" class=\"cancel disabled\">
				";
				$secondIcon = "
					<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"
					    stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" data-lucide=\"book-open\" icon-name=\"book-open\"
					    class=\"lucide lucide-book-open\">
					    <path d=\"M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z\"></path>
					    <path d=\"M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z\"></path>
					</svg>
				";
				$onclickFunction = "toggleTicketStatus('$id','$status','reopen')";
        	}       

			
        	
        	$statusText = ucfirst($status);	
			$inner = "
	        	<div class=\"single\">
				    <div class=\"left\">
				        <div class=\"icon\">
				            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\"
				                stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" data-lucide=\"flag\"
				                icon-name=\"flag\" class=\"lucide lucide-flag\">
				                <path d=\"M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z\"></path>
				                <line x1=\"4\" x2=\"4\" y1=\"22\" y2=\"15\"></line>
				            </svg>
				        </div>
				        <div class=\"content\">
				            <div class=\"title\">$title</div>
				            <div class=\"date\">Created $formattedDate
				                <span class=\"ms-2 status site-badge $statusClass\">$statusText</span>

				            </div>
				        </div>
				    </div>

				    <div class=\"right\">
				        <div class=\"action\">
				        	$firstanchor
				            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\"
				                    viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"
				                    stroke-linejoin=\"round\" data-lucide=\"check\" icon-name=\"check\" class=\"lucide lucide-check\">
				                    <polyline points=\"20 6 9 17 4 12\"></polyline>
				                </svg></a>
				            <a href=\"javascript:void(0);\" data-bs-toggle=\"tooltip\"
				                title=\"\" data-bs-original-title=\"Show Ticket\" aria-label=\"Show Ticket\" onclick=\"$onclickFunction\">
				                $secondIcon
				            </a>


				        </div>
				    </div>
				</div>
			";

        	if ($status === "opened") {
				$openedTickets .= $inner;
        	}else{
				$completedTickets .= $inner;
        	}       

        }


        $arrayCount = count($supportTickets);

        if($arrayCount === 0){
        	$_SESSION['supportTickets'] = "<p class=\"centered\">No Data Found</p>";
        }else {
        	$_SESSION['supportTickets'] .= $openedTickets;
        	$_SESSION['supportTickets'] .= $completedTickets;
        }
 
	}

	//Notification List 
	public function notifications()
	{	$fullname = ucfirst($_SESSION['fullname']);
		$table = 'notification';
		$conditions = array(
		    'uid' => $_SESSION['lid']
		);

		$notifications = $this->readData($table, $conditions);
		$counter = 0;
		$_SESSION['allNotice'] = "";
		$dropDownInner  = "";
		$readClass = "";
        foreach ($notifications as $row) {

			$readClass = "";
        	if ($row['status'] === "read") {
				$readClass = $row['status'];
        	}else{
				$counter += 1;
        	}        	$message = $row['message'];
        	$id = $row['id'];
        	$timeago = $this->getTimeElapsedString($row['date_created']);

        	$dropDownInner .= "
				<div class=\"single-noti\">
	                <a href=\"javascript:void(0);\" onclick=\"openNotice('$id')\" class=\"$readClass\">
	                    <div class=\"icon\">
	                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\"
	                            stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"
	                            data-lucide=\"landmark\" icon-name=\"landmark\" class=\"lucide lucide-landmark\">
	                            <line x1=\"3\" x2=\"21\" y1=\"22\" y2=\"22\"></line>
	                            <line x1=\"6\" x2=\"6\" y1=\"18\" y2=\"11\"></line>
	                            <line x1=\"10\" x2=\"10\" y1=\"18\" y2=\"11\"></line>
	                            <line x1=\"14\" x2=\"14\" y1=\"18\" y2=\"11\"></line>
	                            <line x1=\"18\" x2=\"18\" y1=\"18\" y2=\"11\"></line>
	                            <polygon points=\"12 2 20 7 4 7\"></polygon>
	                        </svg>
	                    </div>
	                    <div class=\"content\">
	                        <div class=\"main-cont\">
	                            <span>$fullname</span> $message
	                        </div>
	                        <div class=\"time\">$timeago</div>
	                    </div>
	                </a>
	            </div>
        	";
			$_SESSION['allNotice'] .= "
	        	<div class=\"single-list $readClass\">
				    <div class=\"cont\">
				        <div class=\"icon\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\"
				                stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"
				                data-lucide=\"landmark\" icon-name=\"landmark\" class=\"lucide lucide-landmark\">
				                <line x1=\"3\" x2=\"21\" y1=\"22\" y2=\"22\"></line>
				                <line x1=\"6\" x2=\"6\" y1=\"18\" y2=\"11\"></line>
				                <line x1=\"10\" x2=\"10\" y1=\"18\" y2=\"11\"></line>
				                <line x1=\"14\" x2=\"14\" y1=\"18\" y2=\"11\"></line>
				                <line x1=\"18\" x2=\"18\" y1=\"18\" y2=\"11\"></line>
				                <polygon points=\"12 2 20 7 4 7\"></polygon>
				            </svg></div>
				        <div class=\"contents\">
				           $message
				            <div class=\"time\"> $timeago</div>
				        </div>
				    </div>
				    <div class=\"link\">
				        <a href=\"javascript:void(0);\" class=\"site-btn-sm red-btn\" onclick=\"openNotice('$id')\"><svg
				                xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\"
				                stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"
				                data-lucide=\"external-link\" icon-name=\"external-link\" class=\"lucide lucide-external-link\">
				                <path d=\"M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6\"></path>
				                <polyline points=\"15 3 21 3 21 9\"></polyline>
				                <line x1=\"10\" x2=\"21\" y1=\"14\" y2=\"3\"></line>
				            </svg>Explore
				        </a>
				    </div>
				</div>
			";
        }


        $iconClass = ($counter > 0) ? "bell-ringng" : " ";

        $arrayCount = count($notifications);

        if($arrayCount === 0){
        	
        	$dropDownInner = "<p class=\"text-center\">Notification Not Found</p>";
        }
        $_SESSION['noticeDropDown'] = "";
        $_SESSION['noticeDropDown'] = "
				<div class=\"single-nav-right user-notifications109\">
				    <button type=\"button\" class=\"item notification-dot \" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
				        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\"
				            stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"
				            data-lucide=\"bell-ring\" icon-name=\"bell-ring\" class=\"lucide lucide-bell-ring $iconClass\">
				            <path d=\"M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9\"></path>
				            <path d=\"M10.3 21a1.94 1.94 0 0 0 3.4 0\"></path>
				            <path d=\"M4 2C2.8 3.7 2 5.7 2 8\"></path>
				            <path d=\"M22 8c0-2.3-.8-4.3-2-6\"></path>
				        </svg>
				        <div class=\"number\">$counter</div>
				    </button>
				    <div class=\"dropdown-menu dropdown-menu-end notification-pop \" data-popper-placement=\"bottom-end\"
				        style=\"position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-183px, 52px, 0px);\">
				        <div class=\"noti-head\">Notifications <span>$counter</span></div>
				        <div class=\"all-noti\">
				            $dropDownInner
				        </div>

				        <div class=\"noti-footer mt-3\">
				            <a class=\"noti-btn-1 me-1 w-100\" href=\"javascript:void(0);\"  onclick=\"markAllAsRead()\">Mark All as
				                Read</a>
				            <a class=\"noti-btn-2 ms-1 w-100\" href=\"notification-all.html\">See all
				                Notifications</a>
				        </div>
				    </div>


				</div>
				";
	}


    // Method to mark a notice as read
    public function markNoticeAsRead($noticeId) {
        $table = 'notification'; 
        $data = array('status' => 'read'); 
        $conditions = array('id' => $noticeId); 
        // Call the updateData method internally
        $result = $this->updateData($table, $data, $conditions);	
	    if ($result) {
	    	return true;
	    }
    }

    // Method to mark all notices as read
	public function markAllNoticesAsRead() {
	    $table = 'notification';
	    $data = array('status' => 'read');
	    $conditions = array('uid' => $_SESSION['lid']);
	    
	    // Assuming you have an updateData method that updates records based on conditions
	    $result = $this->updateData($table, $data, $conditions);
	    
	    if ($result) {
	        return true;
	    } else {
	        return false;
	    }
	}


	public function checkOutPage($header, $message, $tid, $url, $buttonText)
	{	$page = "
	        	<div class=\"transaction-status centered\">
				    <div class=\"icon success\">
				        <i class=\"anticon anticon-check\"></i>
				    </div>
				    <h2>$header</h2>
				    <p>$message</p>
				    <p>Transaction ID: $tid</p>
				    <a href=\"$url\" class=\"site-btn\">
				        <i class=\"anticon anticon-plus\"></i>$buttonText
				    </a>
				</div>
	        ";
		return $page;
	}


	//Deposit into Account
	public function deposit($data)
	{
 		// Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    $tid = generateRandomString();
        while($this->valueExists("transactions", "tid", $tid)){
	        $tid = generateRandomString();
	    }
	    $data['uid'] = $_SESSION['lid'];
	    $data['tid'] = $tid;
	    $tableName = "transactions"; 
	    //( 'type', 'amount', 'fee', 'gateway', 'status', 'description', 'imageid', 'schemaid')
		// Insert user data into table
		$result = $this->insertData($tableName, $data);
		global $depositPage;
	    if ($result) {
	        // Insert successful
	        $header = "$ ".$data['amount']." Deposit Pending";
	        $url = $depositPage;
	        $message = 'The amount has been Pending added into your account';
	        $buttonText = 'Deposit again';
	        $_SESSION['depositPendingPage'] = $this->checkOutPage($header, $message, $tid, $url, $buttonText);
	        return true;
	    } else {
	        // Insert failed
	        return false;
	    }
	}





	public function getAllEmail()
	{
		 if(!$this->db) {
            $this->dbConnect();
        }

        
	    $tableName = 'clients';
	    $conditions = "";
        $clientData = $this->readData($tableName, $conditions);
        if (count($clientData) > 0) {
            $data = array();
            $datatwo = array();
	        foreach ($clientData as $row) 
	        {
                $data[] = $row['email'];
                $datatwo[$row['email']] = ucfirst($row['fullname']);
	        }
            return [
            'emails' => $data,
            'names' => $datatwo,
            ];
        } else {
            // Login failed
            return false;
        }
	}

	//Wallet Exchange
	public function walletExchange($data)
	{
 		// Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    $tid = generateRandomString();
        while($this->valueExists("transactions", "tid", $tid)){
	        $tid = generateRandomString();
	    }

	    $arrayFrom = $data['arrayFrom'];
	    $arrayTo = $data['arrayTo'];
	    $amount = $data['amount'];
	    $charge = $data['fee'];
	    $_SESSION[$arrayTo] = $_SESSION[$arrayTo] + $amount - $charge;
	    $_SESSION[$arrayTo] = round($_SESSION[$arrayTo], 2);
	    $_SESSION[$arrayFrom] = $_SESSION[$arrayFrom] - $amount;
	    $_SESSION[$arrayFrom] = round($_SESSION[$arrayFrom], 2);

		$table = 'clients';
		$data2 = array(
		    'balance' => $_SESSION['balance'],
		    'profit' => $_SESSION['profit'],
		);
		$conditions = array(
		    'id' => $_SESSION['lid']
		);

		$updateClient = $this->updateData($table, $data2, $conditions);

	    $message = $data['message'];
	    unset($data['message']);
	    unset($data['arrayFrom']);
	    unset($data['arrayTo']);
	    $data['uid'] = $_SESSION['lid'];
	    $data['tid'] = $tid;
	    $tableName = "transactions"; 
	    
		$result = $this->insertData($tableName, $data);
		global $exchangePage;
	    if ($result) {
	        $header = "$ ".$data['amount']." Exchange Wallet Money Successfully";
	        $url = $exchangePage;
	        $buttonText = 'EXCHANGE WALLET MONEY AGAIN';
	        $_SESSION['exchangePendingPage'] = $this->checkOutPage($header, $message, $tid, $url, $buttonText);
	        return true;
	    } else {
	        // Insert failed
	        return false;
	    }
	}

	//Withdraw 
	public function withdraw($data)	{
 		// Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    $tid = generateRandomString();
        while($this->valueExists("transactions", "tid", $tid)){
	        $tid = generateRandomString();
	    }

	    $arrayFrom = $data['arrayFrom'];
	    $amount = $data['amount'];
	    $charge = $data['fee'];
	    $_SESSION[$arrayFrom] = $_SESSION[$arrayFrom] - $amount - $charge;
	    $_SESSION[$arrayFrom] = round($_SESSION[$arrayFrom], 2);

		$table = 'clients';
		$data2 = array(
		    'balance' => $_SESSION['balance'],
		    'profit' => $_SESSION['profit'],
		);
		$conditions = array(
		    'id' => $_SESSION['lid']
		);

		$updateClient = $this->updateData($table, $data2, $conditions);

	    $message = $data['message'];
	    unset($data['message']);
	    unset($data['arrayFrom']);
	    $data['uid'] = $_SESSION['lid'];
	    $data['tid'] = $tid;
	    $tableName = "transactions"; 
	    
        
	       // $data = compact( 'type', 'amount', 'fee', 'gateway', 'status', 'description', 'imageid', 'schemaid', 'message', 'arrayFrom');
		// Insert user data into table
		$result = $this->insertData($tableName, $data);
		global $withdrawPage;
	    if ($result) {
	        $header = "$ ".$data['amount']." Withdrawal Successful";
	        $url = $withdrawPage;
	        $buttonText = 'WITHDRAW MONEY AGAIN';
	        $_SESSION['exchangePendingPage'] = $this->checkOutPage($header, $message, $tid, $url, $buttonText);
	        return true;
	    } else {
	        // Insert failed
	        return false;
	    }
	}


	//Send Money
	public function sendMoney($data)
	{
 		// Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    $tid = generateRandomString();
        while($this->valueExists("transactions", "tid", $tid)){
	        $tid = generateRandomString();
	    }

	    $amount = $data['amount'];
	    $charge = $data['fee'];
	    $email = $data['email'];
	    $_SESSION['balance'] = $_SESSION['balance'] - (float)$amount - (float)$charge;

		$table = 'clients';
		$data2 = array(
		    'balance' => $_SESSION['balance'],
		);
		$conditions = array(
		    'id' => $_SESSION['lid']
		);
		$updateClient = $this->updateData($table, $data2, $conditions);



		//get receiver Details
	    
		$conditions = array(
		    'email' => $data['email']
		);
        $receiverData = $this->readData($table, $conditions);
        $receiverBal = $receiverData[0]['balance'];
        $receiverName = $receiverData[0]['fullname'];
        $receiverId = $receiverData[0]['id'];
        $note = $data['note'];
	    $receiverMessage = "Hello $receiverName! you have recieved  \$$amount from ".$_SESSION['email']." <br>$note";
        $receiverBal = (float)$receiverBal + (float)$amount;

		$data2 = array(
		    'balance' => $receiverBal
		);
		$newReceiverBal = $this->updateData($table, $data2, $conditions);



	    $message = $data['message'];
	    unset($data['message']);
	    unset($data['email']);
	    unset($data['note']);
	    $data['uid'] = $_SESSION['lid'];
	    $data['tid'] = $tid;
	    $tableName = "transactions"; 
	    
        
	    //$data = compact( 'type', 'amount', 'fee', 'gateway', 'status', 'description', 'imageid', 'schemaid', 'message');
		// Insert user data into table
		$result = $this->insertData($tableName, $data);
		global $sendMoneyPage;
	    if ($result) {
	    	$noticeTable = "notification";
	    	$noticeData = array(
	                'message' => $message,
	                'uid' => $_SESSION['lid'],
	                'status' => "Unread",
	            );
	    	$noticeData2 = array(
	                'message' => $receiverMessage,
	                'uid' => $receiverId,
	                'status' => "Unread",
	            );
	        // Insert successful
			$noticeInsert = $this->insertData($noticeTable , $noticeData);
			$noticeInsert2 = $this->insertData($noticeTable , $noticeData2);


		    $tableName = "transactions";
		    $tid = generateRandomString();
	        while($this->valueExists("transactions", "tid", $tid)){
		        $tid = generateRandomString();
		    }
	    	$tranData = array(
	                'uid' => $receiverId,
	                'type' => "Transfer Deposit",
	                'fee' => "0",
	                'amount' => $amount,
	                'gateway' => "Transfer",
	                'description' => "\$$amount Transfer Deposit from ".$_SESSION['email'],
	                'imageid' => "null",
	                'schemaid' => "null",
	                'tid' => $tid,
	                'status' => "Success",
	            ); 
		    //( 'type', 'amount', 'fee', 'gateway', 'status', 'description', 'imageid', 'schemaid')
			// Insert user data into table
			$result = $this->insertData($tableName, $tranData);
	        $header = "$ ".$data['amount']." Transfer to ".$email." Processing";
	        $url = $sendMoneyPage;
	        $buttonText = 'SEND MONEY AGAIN';
	        $_SESSION['transferPendingPage'] = $this->checkOutPage($header, $message, $tid, $url, $buttonText);
	        return true;
	    } else {
	        // Insert failed
	        return false;
	    }
	}

	//Invest in Schema xyz
	public function investInSchema($data)
	{
 		// Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    $gateway = ($data['gateway_code'] === "NOT SET") ? $data['source'] :  $data['gateway_code'];
	    $tid = generateRandomString();
        while($this->valueExists("transactions", "tid", $tid)){
	        $tid = generateRandomString();
	    }
	    $description = $_SESSION['schemaPreview']['name']." Invested";
	    $schemaid = $_SESSION['schemaPreview']['id'];
	    $tableName = "transactions"; 
	    $newData = array(
	                'type' => "Investment",
	                'amount' => $data['invest_amount'],
	                'fee' => "0",
	                'gateway' => $gateway,
	                'status' => "Pending",
	                'tid' => $tid,
	                'description' => $description,
	                'imageid' => $data['url'],
	                'schemaid' => $schemaid,
	                'uid' => $_SESSION['lid'],

	            );
		// Insert user data into table
		$result = $this->insertData($tableName, $newData);
	    if ($result) {
	    	$noticeTable = "notification";
	    	$noticeData = array(
	                'message' => "Hello! $tid. 'Successful Investment ".$_SESSION['schemaPreview']['name']." ".$data['invest_amount']."USD'",
	                'uid' => $_SESSION['lid'],
	                'status' => "Unread",
	            );
	        // Insert successful
			$noticeInsert = $this->insertData($noticeTable , $noticeData);
			$source = $data['wallet'];
			$_SESSION[$source] = $_SESSION[$source] - $data['invest_amount'];

		    $clientTable = 'clients';
		    $clientData = array(
	            $source => $_SESSION[$source]
	        ); 
		    $conditions = array(
	            'id' => $_SESSION['lid'],
	        ); 
	        // Call the updateData method internally
	        $clientInsert = $this->updateData($clientTable, $clientData, $conditions);

	        return true;
	    } else {
	        // Insert failed
	        return false;
	    }
	}

	
	//Schema Logs
	public function schemaLogs()
	{
 		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Investment',
        );
        $schemaLogs = $this->readData($tableName, $conditions);
        $_SESSION['schemaLogs'] = "";
        $_SESSION['schemaCountAmount'] = 0;

	    foreach($schemaLogs as $option) {
	    	$tableName = 'schemas_list';
		    $conditions = array(
	            'id' => $option['schemaid']
	        );
	        $data = $this->readData($tableName, $conditions);
	        $schemaData =  $data[0];
	        $schemaIcon = $schemaData['icon'];
	        $schemaName = $schemaData['name'];
	        $schemaRoi = $schemaData['roi'];
	        $schemaPeriod = $schemaData['period'];
	        $schemaCapitalback = $schemaData['capital_back'];
	        $optionId = $option['id'];
	        $amount = $option['amount'];
	        $dateString = $option['date_created'];
			$date = new DateTime($dateString);
			$formattedDate = $date->format('M d Y H:i');
	        $schemaRoiAmount = ($schemaRoi/100) * $amount;
	        $status = $option['status'];
	        if($status === "Success"){
	        	$className = "success";
        		$_SESSION['schemaCountAmount'] += $amount;
	        }
	        if($status === "Pending"){
	        	$className = "warnning";
	        }
	        if($status === "Failed"){
	        	$className = "failed";
	        }
	        
	    	$_SESSION['schemaLogs'] .= "

				<tr class=\"odd\">
				    <td class=\"sorting_1\"><span class=\"avatar-img\"><img
				                src=\"$schemaIcon\" alt=\"\"></span>

				    </td>
				    <td><strong> $schemaName <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"
				                fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"
				                data-lucide=\"arrow-big-right\" icon-name=\"arrow-big-right\" class=\"lucide lucide-arrow-big-right\">
				                <path d=\"M6 9h6V5l7 7-7 7v-4H6V9z\"></path>
				            </svg> $amount</strong>
				        <div class=\"date\">$formattedDate
				            <script>
				                'use strict';
				                lucide.createIcons();
				            </script>
				        </div>
				    </td>
				    <td><strong>
				            $schemaRoi%
				        </strong>

				    </td>
				    <td><strong> 0 x $schemaRoiAmount = 0 USD</strong>
				    </td>
				    <td>$schemaPeriod Times</td>
				    <td>
				        <div class=\"site-badge warnning\">$schemaCapitalback</div>

				    </td>
				    <td>
				        <div class=\"site-badge $className\">$status</div>
				    </td>
				</tr>
	    	";
	    }

	    //print_r($_SESSION['schemaLogs']);
	    return true;
	}

	public function generateTransactionArrays($logs) {
    // Initialize arrays to store transactions
    $desktopTrans = '';
    $mobileTrans = '';
    $depositLog = '';
    $totalDep = 0; 
    $withdrawLog = '';
    $totalWit = 0; 
    $depositBonusLog = '';
    $totalDepBonus = 0; 
    $referralLog = '';
    $sendMoneyLog = '';
    $totalSendMoney = 0;
    $totalRef = 0;  
    $desktopRecent = '';
    $mobileRecent = '';
    $counter = 0;


    if (empty($logs)) {
        // Return HTML for no data found
        $desktopTrans = $desktopRecent = '<tr><td colspan="7" class="text-center">No transactions found.</td></tr>';
        $mobileTrans = $mobileRecent = '<div class="no-data-found text-center">No transactions found.</div>';

        $referralLog = $sendMoneyLog = '<tr><td colspan="7" class="text-center">No referral data found.</td></tr>';
    } else {
        foreach ($logs as $option) {
            $optionId = $option['id'];
            $fee = $option['fee'];
            $type = $option['type'];
            $tid = $option['tid'];
            $amount = $option['amount'];
            $gateway = $option['gateway'];
            $description = $option['description'];
            $formattedAmount = number_format($amount, '2', ',');
            $dateString = $option['date_created'];
            $date = new DateTime($dateString);
            $formattedDate = $date->format('M d Y H:i');
            $status = $option['status'];

            // Initialize variables for schema-specific data (used for Investment type)
            $schemaIcon = '';
            $schemaName = '';
            $schemaRoiAmount = 0;
            $schemaPeriod = '';

            // Retrieve schema-specific data if type is Investment
            if ($type === "Investment") {
                $tableName = 'schemas_list';
                $conditions = array(
                    'id' => $option['schemaid']
                );
                $data = $this->readData($tableName, $conditions);
                $schemaData =  $data[0];
                $schemaIcon = $schemaData['icon'];
                $schemaName = $schemaData['name'];
                $schemaRoi = $schemaData['roi'];
                $schemaRoiAmount = ($schemaRoi / 100) * $amount;
                $schemaPeriod = $schemaData['period'];
            }

            // Determine classes and description based on transaction type
            if ($type === "Investment") {
                $typeClass = "primary-bg";
                $typeClass2 = "green-color";
                $sym = "+";
                $desc = $schemaName . " Invested";
                $icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" data-lucide=\"arrow-left-right\" icon-name=\"arrow-left-right\" class=\"lucide lucide-arrow-left-right\"><path d=\"M8 3 4 7l4 4\"></path><path d=\"M4 7h16\"></path><path d=\"m16 21 4-4-4-4\"></path><path d=\"M20 17H4\"></path></svg>";
            } elseif ($type === "Manual Deposit") {
                if ($status === 'Success') {
                    $totalDep += $amount; 
                }
                $typeClass = "primary-bg";
                $typeClass2 = "green-color";
                $sym = "+";
                $desc = "Deposit with ".$gateway;
                $icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" data-lucide=\"arrow-down-left\" icon-name=\"arrow-down-left\" class=\"lucide lucide-arrow-down-left\"><path d=\"M17 7 7 17\"></path><path d=\"M17 17H7V7\"></path></svg>";
            }elseif ($type === "Deposit Bonus") {
                if ($status === 'Success') {
                    $totalDepBonus += $amount; 
                }
                $typeClass = "primary-bg";
                $typeClass2 = "green-color";
                $sym = "+";
                $desc = $description;
                $icon = "<i class=\"anticon anticon-gift\"></i>";
            } elseif ($type === "Exchange") {
                $typeClass = "primary-bg";
                $typeClass2 = "green-color";
                $sym = "+";
                $desc = $description;
                $icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" data-lucide=\"backpack\" icon-name=\"backpack\" class=\"lucide lucide-backpack\"><path d=\"M4 20V10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z\"></path><path d=\"M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2\"></path><path d=\"M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5\"></path><path d=\"M8 10h8\"></path><path d=\"M8 18h8\"></path></svg>";
            }elseif ($type === "Transfer") {
            	if ($status === 'Success') {
            		
            		$totalSendMoney += $amount; 
            	}
	            	
                $typeClass = "primary-bg";
                $typeClass2 = "red-color";
                $sym = "-";
                $desc = $description;
                $icon = "<i class=\"anticon anticon-export\"></i>";
            } elseif ($type === "Transfer Deposit") {
            	if ($status === 'Success') {
            		
            		$totalDep += $amount; 
            	}
                $typeClass = "primary-bg";
                $typeClass2 = "green-color";
                $sym = "+";
                $desc = $description;
                $icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" data-lucide=\"arrow-down-left\" icon-name=\"arrow-down-left\" class=\"lucide lucide-arrow-down-left\"><path d=\"M17 7 7 17\"></path><path d=\"M17 17H7V7\"></path></svg>";
            }  elseif ($type === "Referral") {
                if ($status === 'Success') {
                    $totalRef += $amount; 
                }
                $typeClass = "primary-bg";
                $typeClass2 = "green-color";
                $sym = "+";
                $desc = $description;
                $icon = "<i class=\"anticon anticon-usergroup-add\"></i>";
            } elseif ($type === "Withdrawal") {
                if ($status === 'Success') {
                    $totalWit += $amount; 
                }
                $typeClass = "primary-bg";
                $typeClass2 = "red-color";
                $sym = "-";
                $desc = $description;
                $icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" data-lucide=\"arrow-down-left\" icon-name=\"arrow-down-left\" class=\"lucide lucide-arrow-down-left\"  transform=\"rotate(180, 0, 0)\" ><path d=\"M17 7 7 17\"></path><path d=\"M17 17H7V7\"></path></svg>";
            }

            // Determine classes based on transaction status
            if ($status === "Success") {
                $statusClass = "success";
                $statusClass2 = "success";
            } elseif ($status === "Pending") {
                $statusClass = "warnning";
                $statusClass2 = "pending";
            } elseif ($status === "Failed") {
                $statusClass = "failed";
                $statusClass2 = "cancel";
            }

            // Build HTML for desktop view
            $desktopHtml = "
                <tr>
                    <td>
                        <div class=\"table-description\">
                            <div class=\"icon\">
                                $icon
                            </div>
                            <div class=\"description\">
                                <strong>$desc</strong>
                                <div class=\"date\">$formattedDate</div>
                            </div>
                        </div>
                    </td>
                    <td><strong>$tid</strong></td>
                    <td>
                        <div class=\"site-badge $typeClass\">$type</div>
                    </td>
                    <td><strong class=\"$typeClass2\">$sym $amount</strong></td>
                    <td><strong>$fee USD</strong></td>
                    <td>
                        <div class=\"site-badge $statusClass\">$status</div>
                    </td>
                    <td><strong>$gateway</strong></td>
                </tr>
            ";  
            $logHtml = "
                <tr>
                    <td>
                        <div class=\"table-description\">
                            <div class=\"icon\">
                                $icon
                            </div>
                            <div class=\"description\">
                                <strong>$desc</strong>
                                <div class=\"date\">$formattedDate</div>
                            </div>
                        </div>
                    </td>
                    <td><strong>$tid</strong></td>
                    <td><strong class=\"$typeClass2\">$sym $amount</strong></td>
                    <td><strong>$fee USD</strong></td>
                    <td>
                        <div class=\"site-badge $statusClass\">$status</div>
                    </td>
                    <td><strong>$gateway</strong></td>
                </tr>
            "; 

            $referralLog .= "
                <tr>
                    <td>
                        <div class=\"table-description\">
                            <div class=\"icon\">
                                $icon
                            </div>
                            <div class=\"description\">
                                <strong>$desc</strong>
                                <div class=\"date\">$formattedDate</div>
                            </div>
                        </div>
                    </td>
                    <td><strong>$tid</strong></td>
                    <td><strong class=\"$typeClass2\">$sym $amount</strong></td>
                    <td>
                        <div class=\"site-badge $statusClass\">$status</div>
                    </td>
                </tr>
            "; 
            // Build HTML for mobile view
            $mobileHtml = "
                <div class=\"single-transaction\">
                    <div class=\"transaction-left\">
                        <div class=\"transaction-des\">
                            <div class=\"transaction-title\">$desc</div>
                            <div class=\"transaction-id\">$tid</div>
                            <div class=\"transaction-date\">$formattedDate</div>
                        </div>
                    </div>
                    <div class=\"transaction-right\">
                        <div class=\"transaction-amount\">-$amount USD</div>
                        <div class=\"transaction-fee sub\">-$fee USD Fee</div>
                        <div class=\"transaction-gateway\">$gateway</div>
                        <div class=\"transaction-status $statusClass2\">$status</div>
                    </div>
                </div>
            ";

            // Concatenate to respective variables based on counter value
            if ($counter < 5) {
                $desktopRecent .= $desktopHtml;
                $mobileRecent .= $mobileHtml;
            }

            // Always concatenate to main transaction logs
            $desktopTrans .= $desktopHtml;
            $depositLog .= $logHtml;
            $sendMoneyLog .= $logHtml;
            $depositBonusLog .= $desktopHtml;
            $mobileTrans .= $mobileHtml;
		    $withdrawLog .=  $logHtml;


            // Increment counter
            $counter++;
        }
    }

    // Return transactions as arrays with session-like keys
    return [
        'desktopTrans' => $desktopTrans,
        'mobileTrans' => $mobileTrans,
        'depositLog' => $depositLog,
        'totalDep' => $totalDep,
        'withdrawLog' => $withdrawLog,
        'totalWit' => $totalWit,
        'depositBonusLog' => $depositBonusLog,
        'sendMoneyLog' => $sendMoneyLog,
        'totalSendMoney' => $totalSendMoney,
        'totalDepBonus' => $totalDepBonus,
        'referralLog' => $referralLog,
        'totalRef' => $totalRef,
        'desktopRecent' => $desktopRecent,
        'mobileRecent' => $mobileRecent
    ];
}

	//Get all Transactions
	public function transactions()
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
        );
        $trans = $this->readData($tableName, $conditions);
        $_SESSION['transCount'] = count($trans);
		$result = $this->generateTransactionArrays($trans);
        $_SESSION['desktopTrans'] = $result['desktopTrans'];
        $_SESSION['mobileTrans'] = $result['mobileTrans'];
        $_SESSION['desktopRecent'] = $result['desktopRecent'];
        $_SESSION['mobileRecent'] = $result['mobileRecent'];

	    //print_r($_SESSION['schemaLogs']);
	    return true;
	}
	//Get all deposits
	public function depositLog()
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Manual Deposit',
        );
        $trans = $this->readData($tableName, $conditions);
		$result = $this->generateTransactionArrays($trans);
        $_SESSION['depositLog'] = $result['depositLog'];
        $_SESSION['totalDep'] = $result['totalDep'];

	    //print_r($_SESSION['schemaLogs']);
	    return true;
	}
	//Get all withdraw
	public function withdrawLog()
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Withdrawal',
        );
        $trans = $this->readData($tableName, $conditions);
		$result = $this->generateTransactionArrays($trans);
        $_SESSION['withdrawLog'] = $result['withdrawLog'];
        $_SESSION['totalWit'] = $result['totalWit'];

	    //print_r($_SESSION['schemaLogs']);
	    return true;
	}
	//Get all deposits Bonus
	public function depositBonusLog()
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Deposit Bonus',
        );
        $trans = $this->readData($tableName, $conditions);
		$result = $this->generateTransactionArrays($trans);
        $_SESSION['depositBonusLog'] = $result['depositBonusLog'];
        $_SESSION['totalDepBonus'] = $result['totalDepBonus'];

	    //print_r($_SESSION['schemaLogs']);
	    return true;
	}
	

	//Fetch Referral Data
	public function referralLog()
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Referral',
        );
        $trans = $this->readData($tableName, $conditions);
		$result = $this->generateTransactionArrays($trans);
        $_SESSION['referralLog'] = $result['referralLog'];
        $_SESSION['totalRef'] = $result['totalRef'];
        $_SESSION['referralCount'] = count($trans);
	}

	//Fetch sendMoneyLog Log
	public function sendMoneyLog()
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Transfer',
        );
        $trans = $this->readData($tableName, $conditions);
		$result = $this->generateTransactionArrays($trans);
        $_SESSION['sendMoneyLog'] = $result['sendMoneyLog'];
        $_SESSION['totalSendMoney'] = $result['totalSendMoney'];
	}

	//search Transactions
	public function searchTransactions($searchTerm = null, $searchDate = null)
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
        );
        
        //$trans = $this->readData($tableName, $conditions);
		$trans = $this->searchData($tableName, $searchTerm, $searchDate, 'date_created DESC', $conditions);
		$result = $this->generateTransactionArrays($trans);

	    // Return transactions as arrays with session-like keys
	    return [
	        'desktopTrans' => $result['desktopTrans'],
	        'mobileTrans' => $result['mobileTrans']
	    ];

	}//search Transactions depositSearch
	public function searchDeposit($searchTerm = null, $searchDate = null)
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Manual Deposit',
        );
        
        //$trans = $this->readData($tableName, $conditions);
		$trans = $this->searchData($tableName, $searchTerm, $searchDate, 'date_created DESC', $conditions);
		$result = $this->generateTransactionArrays($trans);

	    // Return transactions as arrays with session-like keys
	    return [
	        'depositLog' => $result['depositLog']
	    ];

	}//search Transactions Withdraw Search
	public function searchWithdraw($searchTerm = null, $searchDate = null)
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Withdrawal',
        );
        
        //$trans = $this->readData($tableName, $conditions);
		$trans = $this->searchData($tableName, $searchTerm, $searchDate, 'date_created DESC', $conditions);
		$result = $this->generateTransactionArrays($trans);

	    // Return transactions as arrays with session-like keys
	    return [
	        'withdrawLog' => $result['withdrawLog']
	    ];

	}
	//search Send Money 
	public function searchSendMoney($searchTerm = null, $searchDate = null)
	{
		$tableName = 'transactions';
	    $uid = $_SESSION['lid'];
	    $conditions = array(
            'uid' => $uid,
            'type' => 'Transfer',
        );
        
        //$trans = $this->readData($tableName, $conditions);
		$trans = $this->searchData($tableName, $searchTerm, $searchDate, 'date_created DESC', $conditions);
		$result = $this->generateTransactionArrays($trans);

	    // Return transactions as arrays with session-like keys
	    return [
	        'sendMoneyLog' => $result['sendMoneyLog']
	    ];

	}

	
	public function userBadge($profit){

		$badgeLock1 = "locked";
		$badgeLock2 = "locked";
		$badgeLock3 = "locked";
		$badgeLock4 = "locked";

		if($profit < 50){
	        $badgeIcon = "../assets/global/images/sCQgIyl0OKzFiO73nmWF.svg";
	        $badgeLevel = "1";
	        $badgeTitle = "Hyip Member";
	        $badgeDesc = "By signing up to the account";
	        $badgeLock1 = "";
		}
			
		if($profit >= 50){
	        $badgeIcon = "../assets/global/images/TQDUvbD48kmhmV9qifzh.svg";
	        $badgeLevel = "2";
	        $badgeTitle = "Hyip Leader";
	        $badgeDesc = "By earning $50 from the site";
	        $badgeLock2 = "";
		}
			
		if($profit >= 200){
	        $badgeIcon = "../assets/global/images/hGHllGGCIYfpx5Z2VKrW.svg";
	        $bad1geLevel = "3";
	        $badgeTitle = "Hyip Captain";
	        $badgeDesc = "By earning $200 from the site";
	        $badgeLock3 = "";
		}
			
		if($profit >= 500){
	        $badgeIcon = "../assets/global/images/SaNfYL7WD2pzAAME8Sqb.svg";
	        $badgeLevel = "4";
	        $badgeTitle = "Hyip Victor";
	        $badgeDesc = "By earning $500 from the site";
	        $badgeLock4 = "";
		}

	    $badge = array(
	        'badgeIcon' => $badgeIcon,
	        'badgeLevel' => $badgeLevel,
	        'badgeTitle' => $badgeTitle,
	        'badgeDesc' => $badgeDesc,
	    );
	    $_SESSION['allBadges'] = "
	    	<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12\">
			    <div class=\"single-badge $badgeLock1\">
			        <div class=\"badge\">
			            <div class=\"img\"><img src=\"../assets/global/images/sCQgIyl0OKzFiO73nmWF.svg\" alt=\"\"></div>
			        </div>
			        <div class=\"content\">
			            <h3 class=\"title\">Hyip Member</h3>
			            <p class=\"description\">By signing up to the account</p>
			        </div>
			    </div>
			</div>
			<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12\">
			    <div class=\"single-badge $badgeLock2 \">
			        <div class=\"badge\">
			            <div class=\"img\"><img src=\"../assets/global/images/TQDUvbD48kmhmV9qifzh.svg\" alt=\"\"></div>
			        </div>
			        <div class=\"content\">
			            <h3 class=\"title\">Hyip Leader</h3>
			            <p class=\"description\">By earning $50 from the site</p>
			        </div>
			    </div>
			</div>
			<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12\">
			    <div class=\"single-badge $badgeLock3 \">
			        <div class=\"badge\">
			            <div class=\"img\"><img src=\"../assets/global/images/hGHllGGCIYfpx5Z2VKrW.svg\" alt=\"\"></div>
			        </div>
			        <div class=\"content\">
			            <h3 class=\"title\">Hyip Captain</h3>
			            <p class=\"description\">By earning $200 from the site</p>
			        </div>
			    </div>
			</div>
			<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12\">
			    <div class=\"single-badge $badgeLock4 \">
			        <div class=\"badge\">
			            <div class=\"img\"><img src=\"../assets/global/images/SaNfYL7WD2pzAAME8Sqb.svg\" alt=\"\"></div>
			        </div>
			        <div class=\"content\">
			            <h3 class=\"title\">Hyip Victor</h3>
			            <p class=\"description\">By earning $500 from the site</p>
			        </div>
			    </div>
			</div>

	    ";
	    return $badge;
	}

	public function separateAndFormatDecimal($number) {
	    // Initialize variables
	    $wholeNumber = '';
	    $formattedDecimal = '.00';
	    
	    // Check if the number contains a decimal point
	    if (strpos($number, '.') !== false) {
	        // Split the number into whole and decimal parts
	        list($whole, $decimal) = explode('.', $number, 2);
	        
	        // Remove leading zeros from the decimal part
	        $decimal = ltrim($decimal, '0');
	        
	        // If decimal becomes empty after removing zeros, set it to '00'
	        if (empty($decimal)) {
	            $decimal = '00';
	        } elseif (strlen($decimal) === 1) {
	            $decimal = $decimal . '0'; // Add trailing zero if there's only one digit
	        }
	        
	        // Assign values to variables
	        $wholeNumber = $whole;
	        $formattedDecimal = '.' . $decimal;
	    } else {
	        // If there's no decimal point, set the whole number and decimal to default values
	        $wholeNumber = $number;
	    }
	    
	    return array('whole' => $wholeNumber, 'decimal' => $formattedDecimal);
	}

	public function getTimeElapsedString($dateTimeString) {
	    // Current date and time
	    $currentDateTime = new DateTime();

	    // Date string to compare with
	    $compareDateTime = new DateTime($dateTimeString);

	    // Calculate the difference
	    $timeDiff = $currentDateTime->diff($compareDateTime);

	    // Output time elapsed
	    if ($timeDiff->y > 0) {
	        return $timeDiff->y . " year" . ($timeDiff->y > 1 ? "s" : "") . " ago";
	    } elseif ($timeDiff->m > 0) {
	        return $timeDiff->m . " month" . ($timeDiff->m > 1 ? "s" : "") . " ago";
	    } elseif ($timeDiff->d > 0) {
	        return $timeDiff->d . " day" . ($timeDiff->d > 1 ? "s" : "") . " ago";
	    } elseif ($timeDiff->h > 0) {
	        return $timeDiff->h . " hour" . ($timeDiff->h > 1 ? "s" : "") . " ago";
	    } elseif ($timeDiff->i > 0) {
	        return $timeDiff->i . " minute" . ($timeDiff->i > 1 ? "s" : "") . " ago";
	    } else {
	        return "Just now";
	    }
	}

	 // Function to check if a value exists in a specific field of a table
    public function valueExists($table, $field, $value) {
        // Validate inputs
        if (!is_string($table) || empty($table) || !is_string($field) || empty($field)) {
            return false;
        }

        // Prepare statement
        $stmt = $this->db->prepare("SELECT id FROM $table WHERE $field = ?");
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $stmt->store_result();
        
        $exists = ($stmt->num_rows > 0);
        
        $stmt->close();

        return $exists;
    }

    //Create Data
    public function insertData($table, $data) {
	    // Validate inputs
	    if (!is_string($table) || empty($table) || !is_array($data) || empty($data)) {
	        return false;
	    }

	    // Prepare placeholders and values arrays
	    $placeholders = array();
	    $values = array();
	    $types = "";

	    foreach ($data as $key => $value) {
	        $placeholders[] = "?";
	        $values[] = $value;

	        // Determine the type for bind_param based on value type
	        if (is_int($value)) {
	            $types .= "i"; // Integer
	        } elseif (is_float($value)) {
	            $types .= "d"; // Double
	        } else {
	            $types .= "s"; // String, default for all other types
	        }
	    }

	    // Construct the SQL query
	    $sql = "INSERT INTO $table (" . implode(", ", array_keys($data)) . ") VALUES (" . implode(", ", $placeholders) . ")";

	    // Prepare statement
	    $stmt = $this->db->prepare($sql);

	    if ($stmt === false) {
	        return false;
	    }

	    // Bind parameters dynamically
	    $bindParams = array_merge(array($types), $values);
	    $bindParamsReferences = array();
	    foreach ($bindParams as $key => $value) {
	        $bindParamsReferences[$key] = &$bindParams[$key];
	    }

	    // Call bind_param dynamically
	    call_user_func_array(array($stmt, 'bind_param'), $bindParamsReferences);

	    // Execute statement
	    $stmt->execute();

	    // Check for successful insertion
	    $inserted = ($stmt->affected_rows > 0);

	    // Close statement
	    $stmt->close();

	    return $inserted;
	}

	//Read Single Field Data
    public function readFieldData($id, $field, $table){
	    if(!$this->db) {
	        $this->dbConnect();
	    }
	    
	    $user = $_SESSION['lid'];
	    
	    // Sanitize inputs
	    $id = $this->db->real_escape_string($id);
	    $table = $this->db->real_escape_string($table); // Sanitize table name if necessary
	    
	    // Prepare and bind SQL statement
	    $stmt = $this->db->prepare("SELECT * FROM $table WHERE id = ?");
	    $stmt->bind_param("i", $id); // Assuming id is an integer
	    
	    // Execute query
	    $stmt->execute();
	    
	    // Check for errors
	    if ($stmt->error) {
	        // Handle error (e.g., log it, return an error message)
	        return false;
	    }
	    
	    // Get result
	    $result = $stmt->get_result();
	    
	    // Check if a record was found
	    if ($result->num_rows > 0) {
	        $row = $result->fetch_assoc();
	        $value = $row[$field]; // Assuming $field is a valid column name
	        return $value;
	    } else {
	        // No record found
	        return null;
	    }
	}

	// Read Data with Optional Default Order
	public function readData($table, $conditions = array(), $orderBy = 'id DESC') {
	    // Validate inputs
	    if (!is_string($table) || empty($table)) {
	        return false;
	    }

	    // Construct the WHERE clause for conditions
	    $whereClause = "";
	    $values = array();
	    $types = "";

	    if (!empty($conditions) && is_array($conditions)) {
	        $whereClause = " WHERE ";
	        $whereArr = array();
	        foreach ($conditions as $key => $value) {
	            $whereArr[] = "$key = ?";
	            $values[] = $value;

	            // Determine the type for bind_param based on value type
	            if (is_int($value)) {
	                $types .= "i"; // Integer
	            } elseif (is_float($value)) {
	                $types .= "d"; // Double
	            } else {
	                $types .= "s"; // String, default for all other types
	            }
	        }
	        $whereClause .= implode(" AND ", $whereArr);
	    }

	    // Construct the SQL query with ORDER BY clause
	    $orderByClause = " ORDER BY $orderBy";

	    // Construct the SQL query
	    $sql = "SELECT * FROM $table" . $whereClause . $orderByClause;

	    // Prepare statement
	    $stmt = $this->db->prepare($sql);

	    if ($stmt === false) {
	        return false;
	    }

	    // Bind parameters dynamically
	    if (!empty($values)) {
	        $bindParams = array_merge(array($types), $values);
	        $bindParamsReferences = array();
	        foreach ($bindParams as $key => $value) {
	            $bindParamsReferences[$key] = &$bindParams[$key];
	        }

	        // Call bind_param dynamically
	        call_user_func_array(array($stmt, 'bind_param'), $bindParamsReferences);
	    }

	    // Execute statement
	    $stmt->execute();

	    // Get result
	    $result = $stmt->get_result();

	    // Fetch data as associative array
	    $data = array();
	    while ($row = $result->fetch_assoc()) {
	        $data[] = $row;
	    }

	    // Close statement
	    $stmt->close();

	    return $data;
	}

	// Search Data with Optional Default Order, Keyword, Date, and Additional Conditions
	public function searchData($table, $searchTerm = null, $searchDate = null, $orderBy = 'id DESC', $conditions = array()) {
	    // Validate inputs
	    if (!is_string($table) || empty($table)) {
	        return false;
	    }

	    // Initialize variables for WHERE clause construction
	    $whereClause = "";
	    $values = array();
	    $types = "";

	    // If search term is provided, construct search conditions
	    if (!is_null($searchTerm) && !empty($searchTerm)) {
	        // Define columns to search in (modify as per your table structure)
	        $searchColumns = array('description', 'type', 'amount', 'gateway'); // Adjust as per your table columns

	        $whereArr = array();
	        foreach ($searchColumns as $column) {
	            $whereArr[] = "$column LIKE ?";
	            $values[] = '%' . $searchTerm . '%'; // Search with wildcard on both sides for partial match
	        }

	        $whereClause .= "(" . implode(" OR ", $whereArr) . ")";
	    }

	     // If search date is provided, add it to the WHERE clause
	    if (!is_null($searchDate) && !empty($searchDate)) {
	        if (!empty($whereClause)) {
	            $whereClause .= " AND ";
	        }
	        // Modify the condition to match the date part only
	        $whereClause .= "DATE(date_created) = ?";
	        $values[] = $searchDate;
	    }

	    // If additional conditions are provided, add them to the WHERE clause
	    if (!empty($conditions) && is_array($conditions)) {
	        if (!empty($whereClause)) {
	            $whereClause .= " AND ";
	        }

	        $whereArr = array();
	        foreach ($conditions as $key => $value) {
	            $whereArr[] = "$key = ?";
	            $values[] = $value;
	        }

	        $whereClause .= implode(" AND ", $whereArr);
	    }

	    // If neither search term, search date, nor additional conditions are provided, return false (no valid search criteria)
	    if (empty($whereClause)) {
	        return false;
	    }

	    // Construct the SQL query with ORDER BY clause
	    $orderByClause = " ORDER BY $orderBy";

	    // Construct the SQL query
	    $sql = "SELECT * FROM $table WHERE $whereClause" . $orderByClause;

	    // Prepare statement
	    $stmt = $this->db->prepare($sql);

	    if ($stmt === false) {
	        return false;
	    }

	    // Bind parameters dynamically
	    if (!empty($values)) {
	        $bindParams = array(str_repeat('s', count($values)), ...$values); // All parameters are strings
	        $stmt->bind_param(...$bindParams);
	    }

	    // Execute statement
	    $stmt->execute();

	    // Get result
	    $result = $stmt->get_result();

	    // Fetch data as associative array
	    $data = array();
	    while ($row = $result->fetch_assoc()) {
	        $data[] = $row;
	    }

	    // Close statement
	    $stmt->close();

	    return $data;
	}


	//Update Data
    public function updateData($table, $data, $conditions) {
        // Validate inputs
        if (!is_string($table) || empty($table) || !is_array($data) || empty($data) || !is_array($conditions) || empty($conditions)) {
            return false;
        }

        // Prepare set statements
        $setStatements = array();
        $values = array();
        $types = "";

        foreach ($data as $key => $value) {
            $setStatements[] = "$key = ?";
            $values[] = $value;

            // Determine the type for bind_param based on value type
            if (is_int($value)) {
                $types .= "i"; // Integer
            } elseif (is_float($value)) {
                $types .= "d"; // Double
            } else {
                $types .= "s"; // String, default for all other types
            }
        }

        // Construct the WHERE clause for conditions
        $whereClause = array();
        foreach ($conditions as $key => $value) {
            $whereClause[] = "$key = ?";
            $values[] = $value;

            // Determine the type for bind_param based on value type
            if (is_int($value)) {
                $types .= "i"; // Integer
            } elseif (is_float($value)) {
                $types .= "d"; // Double
            } else {
                $types .= "s"; // String, default for all other types
            }
        }

        // Construct the SQL query
        $sql = "UPDATE $table SET " . implode(", ", $setStatements) . " WHERE " . implode(" AND ", $whereClause);


        // Prepare statement
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        // Bind parameters dynamically
        $bindParams = array_merge(array($types), $values);
        $bindParamsReferences = array();
        foreach ($bindParams as $key => $value) {
            $bindParamsReferences[$key] = &$bindParams[$key];
        }

        // Call bind_param dynamically
        call_user_func_array(array($stmt, 'bind_param'), $bindParamsReferences);

        // Execute statement
        $stmt->execute();

        // Check for successful update
        $updated = ($stmt->affected_rows > 0);

        // Close statement
        $stmt->close();
        return $updated;
    }

    //Delete Data
    public function deleteData($table, $conditions) {
        // Validate inputs
        if (!is_string($table) || empty($table) || !is_array($conditions) || empty($conditions)) {
            return false;
        }

        // Construct the WHERE clause for conditions
        $whereClause = array();
        $values = array();
        $types = "";

        foreach ($conditions as $key => $value) {
            $whereClause[] = "$key = ?";
            $values[] = $value;

            // Determine the type for bind_param based on value type
            if (is_int($value)) {
                $types .= "i"; // Integer
            } elseif (is_float($value)) {
                $types .= "d"; // Double
            } else {
                $types .= "s"; // String, default for all other types
            }
        }

        // Construct the SQL query
        $sql = "DELETE FROM $table WHERE " . implode(" AND ", $whereClause);

        // Prepare statement
        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        // Bind parameters dynamically
        $bindParams = array_merge(array($types), $values);
        $bindParamsReferences = array();
        foreach ($bindParams as $key => $value) {
            $bindParamsReferences[$key] = &$bindParams[$key];
        }

        // Call bind_param dynamically
        call_user_func_array(array($stmt, 'bind_param'), $bindParamsReferences);

        // Execute statement
        $stmt->execute();

        // Check for successful deletion
        $deleted = ($stmt->affected_rows > 0);

        // Close statement
        $stmt->close();

        return $deleted;
    }
	// Method to Upload Image
	public function uploadFile($fileInputName, $uploadDir) {
	    // Check if file was uploaded without errors
	    if (isset($_FILES[$fileInputName]['error']) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
	        // File information
	        $file_name = $_FILES[$fileInputName]['name'];
	        $file_tmp = $_FILES[$fileInputName]['tmp_name'];

	        // Ensure the upload directory exists
	        if (!file_exists($uploadDir)) {
	            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
	        }

	        // Generate unique file name to avoid overwriting existing files
	        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
	        $new_file_name = uniqid() . '.' . $file_extension;
	        $destination = $uploadDir . $new_file_name;
	        while($this->valueExists("images", "url", $new_file_name)){
	        	// Generate unique file name to avoid overwriting existing files
		        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
		        $new_file_name = uniqid() . '.' . $file_extension;
		        $destination = $uploadDir . $new_file_name;
	        }
	        // Move uploaded file to desired directory
	        if (move_uploaded_file($file_tmp, $destination)) {
	        	$imgid = $this->insertImg($new_file_name);
	            //return $new_file_name; 
	            return $imgid;
	        } else {
	            echo "Error uploading file.";
	            return false;
	        }
	    } else {
	        echo "Upload error: " . $_FILES[$fileInputName]['error'];
	        return false;
	    }
	}
	//insert image in table
	public function insertImg($name)
	{
		 // Check if database connection is null
	    if (!$this->db) {
	        $this->dbConnect(); // Reconnect if not connected
	    }
	    $tableName = "images"; 
	    $url = $name;
	    $data = compact('url');
		// Insert user data into table
		$result = $this->insertData($tableName, $data);
	    if ($result) {
		    $conditions = array(
	            'url' => $url
	        );

	        $data = $this->readData($tableName, $conditions);
	        $dataClient = $data[0];
	        return $dataClient['id'];
	    } else {
	        return false;
	    }
	}

    // Method to check if the user is logged in
    public function isLoggedIn() {
        if (isset($_SESSION['lid']) && $_SESSION['lid'] > 0) {
            return true; // User is logged in
        } else {
            return false; // User is not logged in
        }
    }
    
    // Method to enforce login for 'user' directory
    public function requireLoginForUserDirectory() {
        $currentDirectory = basename(dirname($_SERVER['PHP_SELF']));
        
        if ($currentDirectory === 'user' && !$this->isLoggedIn()) {
            $this->redirect(0.5, $this->loginPage);
        }
    }
    
    // Method to enforce logout for 'home' directory
    public function requireLogoutForHomeDirectory() {
        $currentDirectory = basename(dirname($_SERVER['PHP_SELF']));
        
        if ($currentDirectory === 'home' && $this->isLoggedIn()) {
            $this->redirect(3, $this->dashboardPage); // Example redirect to user dashboard
        }
    }

    public function pageRequireVerifiedKyc()
    {
    	if (basename($_SERVER['REQUEST_URI']) === 'withdraw.html' || basename($_SERVER['REQUEST_URI']) === 'withdraw-log.html' && $_SESSION['kycStatus'] !== 'verified') {
    		$previousPage = $_SERVER['HTTP_REFERER'];
    		if (isset($previousPage)) {
    			$page = $previousPage;
    		}else {
    			$page = $this->dashboardPage;
    		}
    		$_SESSION['showKycToast'] = "set";
    		$this->redirect(0.5, $page);
    	}
    }
    
    public function requireShowTicket()
    {	
    	global $supportPage;
	    if(!isset($_SESSION['showTicket'])){
	        $this->redirect(0.5, $supportPage);
	    }
    }
    // Helper method to perform redirection
    private function redirect($timeout, $url) {
        //header("Location: $url");
        header("Refresh: $timeout ;url=$url");
        exit;
    }


}

function generateRandomString($length = 11, $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', $randomString = 'TR') {
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
//Null If Not Set
function nullIfNotSet(&$variable) {
    if (!isset($variable)) {
        $variable = null;
    }
}





// Usage

define('WEBSITE_NAME', 'Elonsphere');
$hostname = $encryptionHelper->de($hostname);
$username = $encryptionHelper->de($username);
$password = $encryptionHelper->de($password);
$database = $encryptionHelper->de($database);
$loginPage = '../home/login.html';
$dashboardPage = '../user/dashboard.html';
$depositPage = '../user/deposit.html';
$exchangePage = '../user/wallet-exchange.html';
$withdrawPage = '../user/withdraw.html';
$sendMoneyPage = '../user/send-money.html';
$supportPage = '../user/support-ticket-index.html';
$logoutUrl = '../vendor/php/logout.php';
$controller = new mainController($hostname, $username, $password, $database, $loginPage, $dashboardPage);
//session
$controller->requireLoginForUserDirectory();
$controller->requireLogoutForHomeDirectory();
$controller->pageRequireVerifiedKyc();
$globalCharge = 0;

	if(isset($_SESSION['lid'])){
		//header("location: login.html");
		$lid = $_SESSION['lid'];
		$controller->fetchData();
		$navMenu = "
		    <ul class=\"side-nav-menu\">
		        <li class=\"side-nav-item \">
		            <a href=\"../user/dashboard.html\"><i class=\"anticon anticon-appstore\"></i><span>Dashboard</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/schemas.html\"><i class=\"anticon anticon-check-square\"></i><span>All Schema</span></a>
		        </li>
		        <li class=\"side-nav-item \">
		            <a href=\"../user/invest-logs.html\"><i class=\"anticon anticon-copy\"></i><span>Schema Logs</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/transactions.html\"><i class=\"anticon anticon-inbox\"></i><span>All Transactions</span></a>
		        </li>


		        <li class=\"side-nav-item \">
		            <a href=\"../user/deposit.html\"><i class=\"anticon anticon-file-add\"></i><span>Add Money</span></a>
		        </li>
		        <li class=\"side-nav-item \">
		            <a href=\"../user/deposit-log.html\"><i class=\"anticon anticon-folder-add\"></i><span>Add Money Log</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/wallet-exchange.html\"><i class=\"anticon anticon-transaction\"></i><span>Wallet
		                    Exchange</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/send-money.html\"><i class=\"anticon anticon-export\"></i><span>Send Money</span></a>
		        </li>
		        <li class=\"side-nav-item \">
		            <a href=\"../user/send-money-log.html\"><i class=\"anticon anticon-cloud\"></i><span>Send Money Log</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/withdraw.html\"><i class=\"anticon anticon-bank\"></i><span>Withdraw</span></a>
		        </li>
		        <li class=\"side-nav-item \">
		            <a href=\"../user/withdraw-log.html\"><i class=\"anticon anticon-credit-card\"></i><span>Withdraw Log</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/ranking-badge.html\"><i class=\"anticon anticon-star\"></i><span>Ranking Badge</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/referral.html\"><i class=\"anticon anticon-usergroup-add\"></i><span>Referral</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/settings.html\"><i class=\"anticon anticon-setting\"></i><span>Settings</span></a>
		        </li>
		        <li class=\"side-nav-item \">
		            <a href=\"../user/support-ticket-index.html\"><i class=\"anticon anticon-tool\"></i><span>Support
		                    Tickets</span></a>
		        </li>

		        <li class=\"side-nav-item \">
		            <a href=\"../user/notification-all.html\"><i class=\"anticon
		                    anticon-notification\"></i><span>Notifications</span></a>
		        </li>

		        <li class=\"side-nav-item\">
		            <!-- Authentication -->
		            <form method=\"POST\" action=\"$logoutUrl\">
		                <input type=\"hidden\" name=\"logout\" value=\"logout\"> <button type=\"submit\" class=\"site-btn grad-btn
		                    w-100\">
		                    <i class=\"anticon anticon-logout\"></i><span>Logout</span>
		                </button>
		            </form>
		        </li>
		    </ul>
		";

		$navMini = "
		    <ul class=\"dropdown-menu dropdown-menu-end\">
		        <li>
		            <a href=\"../user/settings.html\" class=\"dropdown-item\" type=\"button\"><i
		                    class=\"anticon anticon-setting\"></i>Settings</a>
		        </li>
		        <li>
		            <a href=\"../user/change-password.html\" class=\"dropdown-item\" type=\"button\">
		                <i class=\"anticon anticon-lock\"></i>Change Password
		            </a>
		        </li>
		        <li>
		            <a href=\"../user/support-ticket-index.html\" class=\"dropdown-item\" type=\"button\">
		                <i class=\"anticon anticon-customer-service\"></i>Support Tickets
		            </a>
		        </li>
		        <li class=\"logout\">
		            <form method=\"POST\" action=\"\" id=\"logout-form\">
		                <input type=\"hidden\" name=\"logout\" value=\"logout\">
		                <a href=\"$logoutUrl\" class=\"dropdown-item\"><i class=\"anticon anticon-logout\"></i>Logout</a>
		            </form>
		        </li>
		    </ul>
		";
		$navMobile = "
		   <div class=\"bottom-appbar\">
		    <a href=\"../user/dashboard.html\" class=\"active\">
		        <i icon-name=\"layout-dashboard\"></i>
		    </a>
		    <a href=\"../user/deposit.html\" class=\"\">
		        <i icon-name=\"download\"></i>
		    </a>
		    <a href=\"../user/schemas.html\" class=\"\">
		        <i icon-name=\"box\"></i>
		    </a>
		    <a href=\"../user/referral.html\" class=\"\">
		        <i icon-name=\"gift\"></i>
		    </a>
		    <a href=\"../user/settings.html\" class=\"\">
		        <i icon-name=\"settings\"></i>
		    </a>
		</div>
		";

		$mobileAllNav = "
			<div class=\"contents row\">
			    <div class=\"col-4\">
			        <div class=\"single\">
			            <a href=\"../user/schemas.html\">
			                <div class=\"icon\"><img src=\"../assets/frontend/materials/schema.png\" alt=\"\">
			                </div>
			                <div class=\"name\">Schemas</div>
			            </a>
			        </div>
			    </div>
			    <div class=\"col-4\">
			        <div class=\"single\">
			            <a href=\"../user/invest-logs.html\">
			                <div class=\"icon\"><img src=\"../assets/frontend/materials/schema-log.png\" alt=\"\">
			                </div>
			                <div class=\"name\">Investment</div>
			            </a>
			        </div>
			    </div>
			    <div class=\"col-4\">
			        <div class=\"single\">
			            <a href=\"../user/transactions\">
			                <div class=\"icon\"><img src=\"../assets/frontend/materials/transactions.png\" alt=\"\">
			                </div>
			                <div class=\"name\">Transactions</div>
			            </a>
			        </div>
			    </div>
			    <div class=\"col-4\">
			        <div class=\"single\">
			            <a href=\"../user/deposit.html\">
			                <div class=\"icon\"><img src=\"../assets/frontend/materials/deposit.png\" alt=\"\">
			                </div>
			                <div class=\"name\">Deposit</div>
			            </a>
			        </div>
			    </div>
			    <div class=\"col-4\">
			        <div class=\"single\">
			            <a href=\"../user/deposit/log.html\">
			                <div class=\"icon\"><img src=\"../assets/frontend/materials/deposit-log.png\" alt=\"\">
			                </div>
			                <div class=\"name\">Deposit Log</div>
			            </a>
			        </div>
			    </div>
			    <div class=\"col-4\">
			        <div class=\"single\">
			            <a href=\"../user/wallet-exchange.html\">
			                <div class=\"icon\"><img src=\"../assets/frontend/materials/wallet-exchange.png\" alt=\"\">
			                </div>
			                <div class=\"name\">Wallet Exch.</div>
			            </a>
			        </div>
			    </div>
			</div>

			<div class=\"moretext\">
			    <div class=\"row contents\">
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/send-money.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/transfer.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Transfer</div>
			                </a>
			            </div>
			        </div>
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/send-money/log.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/transfer-log.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Transfer Log</div>
			                </a>
			            </div>
			        </div>
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/withdraw.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/withdraw.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Withdraw</div>
			                </a>
			            </div>
			        </div>
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/withdraw/log.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/withdraw-log.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Withdraw Log</div>
			                </a>
			            </div>
			        </div>
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/ranking-badge.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/ranking.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Ranking Badge</div>
			                </a>
			            </div>
			        </div>
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/referral.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/referral.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Referral</div>
			                </a>
			            </div>
			        </div>
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/settings.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/settings.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Settings</div>
			                </a>
			            </div>
			        </div>
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/support-ticket/index.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/support-ticket.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Support Ticket</div>
			                </a>
			            </div>
			        </div>
			        <div class=\"col-4\">
			            <div class=\"single\">
			                <a href=\"../user/notification/all.html\">
			                    <div class=\"icon\"><img src=\"../assets/frontend/materials/profile.png\" alt=\"\">
			                    </div>
			                    <div class=\"name\">Notifications</div>
			                </a>
			            </div>
			        </div>
			    </div>
			</div>
		";

		$balanceHolder = "
		   <div class=\"user-balance-card\">
		        <div class=\"wallet-name\">
		            <div class=\"name\">Account Balance</div>
		            <div class=\"default\">Wallet</div>
		        </div>
		        <div class=\"wallet-info\">
		            <div class=\"wallet-id\"><i icon-name=\"wallet\"></i>Main Wallet</div>
		            <div class=\"balance\"  id=\"mainBalance\">$".$_SESSION['balance']."</div>
		        </div>
		        <div class=\"wallet-info\">
		            <div class=\"wallet-id\"><i icon-name=\"landmark\"></i>Profit Wallet</div>
		            <div class=\"balance\"  id=\"profitBalance\">$".$_SESSION['profit']."</div>
		        </div>
		    </div>
		    <div class=\"actions\">
		        <a href=\"../user/deposit.html\" class=\"user-sidebar-btn\"><i class=\"anticon anticon-file-add\"></i>Deposit</a>
		        <a href=\"../user/schemas.html\" class=\"user-sidebar-btn red-btn\"><i class=\"anticon anticon-export\"></i>Invest Now</a>
		    </div>
		";
	}

	if (isset($_POST['depositData']) && isset($_POST['gateway_code']) && isset($_POST['amount']) ) {
    	extract($_POST);


	    if (isset($_FILES['paymentProof'])) {
	        $uploadDir = 'uploads/';
	        $imageid = $controller->uploadFile('paymentProof', $uploadDir);
	    }

        $gateway = $gateway_code;
        $type = 'Manual Deposit';
        $fee = '0';
        $status = 'Pending';
        $description = "\$$amount Deposit Pending";
        $schemaid = 'null';
        $data = compact( 'type', 'amount', 'fee', 'gateway', 'status', 'description', 'imageid', 'schemaid');

        $controller = $controller->deposit($data);
        
	    if ($controller) {
		    	$response = array(
	                'message' => 'success',
	                'checkout' => $_SESSION['depositPendingPage'],

	            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'message' => 'error',
                'error' => 'Error uploading paymentProof file'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
	}

	//wallet Exchange
	if (isset($_POST['charge']) && isset($_POST['from_wallet'])&& isset($_POST['to_wallet']) && isset($_POST['amount']) ) {
    	extract($_POST);


	   $descFrom = ($from_wallet === '1') ? "Main" : "Profit";
	   $descTo = ($to_wallet === '1') ? "Main" : "Profit";

	   $arrayFrom = ($from_wallet === '1') ? "balance" : "profit";
	   $arrayTo = ($to_wallet === '1') ? "balance" : "profit";

	   if((float)$_SESSION[$arrayFrom] > (float)$amount){
	        $imageid = 'null';
	        $gateway = 'System';
	        $type = 'Exchange';
	        $fee = $charge;
	        $status = 'Success';
	        $description = "$descFrom to $descTo Wallet Exchanged";
	        $schemaid = 'null';
	        $message = "$descFrom to $descTo Wallet Exchanged";
	        $data = compact( 'type', 'amount', 'fee', 'gateway', 'status', 'description', 'imageid', 'schemaid', 'message', 'arrayFrom', 'arrayTo');

	        $controller = $controller->walletExchange($data);
	        
		    if ($controller) {
			    	$response = array(
		                'message' => 'success',
		                'checkout' => $_SESSION['exchangePendingPage'],
		                'mainBalance' => $_SESSION['balance'],
		                'profitBalance' => $_SESSION['profit'],

		            );

	            header('Content-Type: application/json');
	            echo json_encode($response);
	        } 
	   }else {
            $response = array(
                'message' => 'error',
                'error' => "Insufficient Balance in your $descFrom Wallet"
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
	}



	//withdraw
	if (isset($_POST['charge']) && isset($_POST['withdraw'])&& isset($_POST['wallet']) && isset($_POST['from_wallet'])  && isset($_POST['amount'])  && isset($_POST['gateway_code']) ) {
    	extract($_POST);


	   $descFrom = ($from_wallet === '1') ? "Main" : "Profit";
	   $arrayFrom = ($from_wallet === '1') ? "balance" : "profit";

	   if((float)$_SESSION[$arrayFrom] > (float)$amount){
	        $imageid = 'null';
	        $gateway = $gateway_code;
	        $type = 'Withdrawal';
	        $fee = $charge;
	        $status = 'Success';
	        $description = "Withdrawal with $gateway_code \n <i>($wallet)</i>";
	        $schemaid = 'null';
	        $message = "Withdrawal Pending";
	        $data = compact( 'type', 'amount', 'fee', 'gateway', 'status', 'description', 'imageid', 'schemaid', 'message', 'arrayFrom');

	        $controller = $controller->withdraw($data);
	        
		    if ($controller) {
			    	$response = array(
		                'message' => 'success',
		                'checkout' => $_SESSION['exchangePendingPage'],
		                'mainBalance' => $_SESSION['balance'],
		                'profitBalance' => $_SESSION['profit'],

		            );

	            header('Content-Type: application/json');
	            echo json_encode($response);
	        } 
	   }else {
            $response = array(
                'message' => 'error',
                'error' => "Insufficient Balance in your $descFrom Wallet"
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
	}

	if (isset($_POST['schema_id']) && isset($_POST['wallet']) && isset($_POST['invest_amount']) ) {
    	extract($_POST);

    	if($_POST['wallet'] === "main" ){
    		$wallet = 'balance';
    		$source = "Main Balance";
    	}
    	if($_POST['wallet'] === "profit" ){
    		$wallet = 'profit';
    		$source = "Profit Balance";
    	}
    	if($_POST['wallet'] === "gateway" ){
    		$wallet = 'gateway';
    		$source = "Gateway";
    		$_SESSION[$wallet] = $invest_amount;
    	}
    	if($_SESSION[$wallet] >= $invest_amount && $invest_amount >= $_SESSION['schemaPreview']['min'] ){

		    if (isset($_FILES['paymentProof'])) {
		        $uploadDir = 'uploads/';
		        $imgUrl = $controller->uploadFile('paymentProof', $uploadDir);
		    }else {
		        $imgUrl = "null";
		        $gateway_code = "NOT SET";
		    }

            $url = $imgUrl;
            $data = compact('url', 'schema_id', 'invest_amount', 'source', 'gateway_code', 'wallet');

            $controller = $controller->investInSchema($data);
            
		    if ($controller) {
			    	$response = array(
		                'message' => 'success'
		            );

	            header('Content-Type: application/json');
	            echo json_encode($response);
	        } else {
	            $response = array(
	                'message' => 'Error uploading paymentProof file'
	            );

	            header('Content-Type: application/json');
	            echo json_encode($response);
	        }
    	}else{
    		 $response = array(
		            'message' => 'IB' //Insufficient Balance
		        );

		        header('Content-Type: application/json');
		        echo json_encode($response);
    	}
	}

	if(isset($_POST['username']) && isset($_POST['newUser'])){
		extract($_REQUEST);
	 	$password = md5($password);
	 	$fullname = $name;
	 	$referral = $coach;
	 	$balance = 0;
		$data = compact('username', 'fullname', 'email', 'phone', 'country', 'password', 'referral','balance');
	    $controller = $controller->createUser2($data);

	    if($controller === 'RS'){
	    	$message = 'success';
	    }
	    if($controller === 'EAE'){
	    	$message = 'EAE';
	    }
	    if($controller === 'UAE'){
	    	$message = 'UAE';
	    }
	    if($controller === false){
	    	$message = 'An error Occurred';
	    }
	    $data = array(
	        'message' => $message
	    );

	    header('Content-Type: application/json');
	    echo json_encode($data);
	}


	if(isset($_POST['lemail'])){
		extract($_REQUEST);
	    $controller = $controller->validateUser($lemail, $lpassword);

	    if($controller === true){
	    	$message = 'success';
	    }else{
	    	$message = 'failed';
	    }
	    $data = array(
	        'message' => $message
	    );

	    header('Content-Type: application/json');
	    echo json_encode($data);
	}


	if(isset($_POST['schemaId'])){
		extract($_REQUEST);
	    $controller = $controller->schemaPreview($schemaId);

	    if($controller === true){
	    	$message = 'success';
	    }else{
	    	$message = 'failed';
	    }

	    $credentials = array(
	        'amount_range' => "Minimum ".$_SESSION['schemaPreview']['min']." USD - Maximum ".$_SESSION['schemaPreview']['max']." USD",
	        'holiday' => "No",
	        'return_interest' => $_SESSION['schemaPreview']['roi']."% (Daily)",
	        'number_period' => $_SESSION['schemaPreview']['period']." Times" ,
	        'capital_back' => $_SESSION['schemaPreview']['capital_back'],
	    );
	    $data = array(
	        'message' => $message,
	        'credentials' => $credentials
	    );

	    header('Content-Type: application/json');
	    echo json_encode($data);
	}

	if(isset($_POST['gateway'])){
		extract($_REQUEST);
		$data = '
		    <td><strong>Payment Method:</strong></td>
		    <td>
		        <div class="input-group mb-0">
		            <select class="site-nice-select" aria-label="Default select example" name="gateway_code" id="gatewaySelect"
		                 style="display: none;">
		                <option value="" >Select</option>
		                <option value="BTC">BTC</option>
		                <option value="ETH">ETH</option>
		            </select>
		        </div>
		    </td>
		';

	    header('Content-Type: application/json');
	    echo json_encode($data);
	}
	$gatewayInfo = array(
		"qrBTC" => "../assets/frontend/materials/btc.png",
		"addrBTC" => "btcbtcbtcbtcbtcbtc",
		"iconBTC" => "../assets/global/images/d2EA89BmzCMyYFXyIv5v.png",
		"qrETH" => "../assets/frontend/materials/eth.png",
		"addrETH" => "ethethethethethetheth",
		"iconETH" => "../assets/global/images/g8293TJZVMPFkpSSLO0V.png",
	);
	if(isset($_POST['gatewayCode'])){
		extract($_REQUEST);
		$imgUrl = $gatewayInfo['qr'.$gatewayCode];
		$addr = $gatewayInfo['addr'.$gatewayCode];
		$icon = $gatewayInfo['icon'.$gatewayCode];
		
		$gatewayInfo ="
			    <div class=\"col-xl-12 col-md-12\">
			        <div class=\"frontend-editor-data\">
			            <p>Kindly send only $gatewayCode to this deposit address, Sending any other coin or token to this address may result
			                in loss of your crypto.</p>

			            <p>ADDRESS:&nbsp;<span style=\"font-weight:bolder;\">$addr</span></p>

			            <p>Please scan Barcode for wallet payment&nbsp;confirmation below:</p>

			            <p><img src=\"$imgUrl\"
			                    alt=\"QR CODE\" style=\"width:370px;\"></p>
			        </div>
			    </div>

			    <div class=\"col-xl-12 col-md-12\">
			        <div class=\"body-title\">Proof of Payment</div>
			        <div class=\"wrap-custom-file\">
			            <input type=\"file\" name=\"paymentProof\" id=\"1\" accept=\".gif, .jpg, .png\" required=\"\">
			            <label for=\"1\">
			                <img class=\"upload-icon\" src=\"../assets/global/materials/upload.svg\" alt=\"\">
			                <span>Select Proof of Payment</span>
			            </label>
			        </div>
			    </div>
			";
		$data = array(
        	'credentials' => $gatewayInfo,
        	'icon' => $icon,
        	'charge' => $globalCharge,
        	'charge_type' => 'percentage',
        	'minimum_deposit' => 300,
        	'maximum_deposit' => 999999,
	    );
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}


	if(isset($_GET['query']) || isset($_GET['date']) ){
		nullIfNotSet($_GET['date']);
		nullIfNotSet($_GET['query']);
		extract($_REQUEST);

	    $controller = $controller->searchTransactions($query, $date);
		$data = array(
        	'desktopTrans' => $controller['desktopTrans'],
	        'mobileTrans' => $controller['mobileTrans']
	    );
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}
	if(isset($_GET['query2']) || isset($_GET['date2'])){
		nullIfNotSet($_GET['date2']);
		nullIfNotSet($_GET['query2']);
		extract($_REQUEST);

	    $controller = $controller->searchDeposit($query2, $date2);
		$data = array(
        	'depositSearch' => $controller['depositLog']
	    );
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}
	if(isset($_GET['query3']) || isset($_GET['date3'])){
		nullIfNotSet($_GET['date3']);
		nullIfNotSet($_GET['query3']);
		extract($_REQUEST);

	    $controller = $controller->searchSendMoney($query3, $date3);
		$data = array(
        	'sendMoneySearch' => $controller['sendMoneyLog']

	    );
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}
	if(isset($_GET['query4']) || isset($_GET['date4'])){
		nullIfNotSet($_GET['date4']);
		nullIfNotSet($_GET['query4']);
		extract($_REQUEST);

	    $controller = $controller->searchWithdraw($query4, $date4);
		$data = array(
        	'withdrawSearch' => $controller['withdrawLog']

	    );
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}

	if (isset($_POST['noticeId'])) {
		extract($_REQUEST);
		$controller = $controller->markNoticeAsRead($noticeId);
		if ($controller) {
	    	$data = array(
	        	'message' => 'success'
		    );
		    header('Content-Type: application/json');
		    echo json_encode($data);
	    }
	}

	if (isset($_POST['markAll'])) {
		extract($_REQUEST);
		$controller = $controller->markAllNoticesAsRead();
		if ($controller) {
	    	$data = array(
	        	'message' => 'success'
		    );
		    header('Content-Type: application/json');
		    echo json_encode($data);
	    }
	}

	if (isset($_POST['showTicketId'])) {
		extract($_REQUEST);
		$controller = $controller->showTicket($showTicketId);
		if ($controller) {
	    	$data = array(
	        	'message' => 'success'
		    );
		    header('Content-Type: application/json');
		    echo json_encode($data);
	    }
	}

	if (isset($_POST['reOpenTicketId']) && isset($_POST['ticketStatus'])) {
		extract($_REQUEST);
		$controller = $controller->toggleTicketStatus($reOpenTicketId, $ticketStatus);
		if ($controller) {
	    	$data = array(
	        	'message' => 'success'
		    );
		    header('Content-Type: application/json');
		    echo json_encode($data);
	    }
	}


	if (isset($_POST['createTicket']) && isset($_POST['title']) && isset($_POST['message']) ) {
    	extract($_POST);

		if (isset($_FILES['attach']) && $_FILES['attach']['error'] === UPLOAD_ERR_OK) {
		    $uploadDir = 'uploads/';
		    $image_id = $controller->uploadFile('attach', $uploadDir);
		} else {
		    $image_id = 'null';
		}
	
        $tname = $title;
        $status = 'opened';
        $data = compact( 'tname', 'status', 'message', 'image_id');

        $controller = $controller->createTicket($data);
        
	    if ($controller) {
		    	$response = array(
	                'message' => 'success',
	                'ticketId' => $_SESSION['tempTicketId'],

	            );
	            unset($_SESSION['tempTicketId']);

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'message' => 'error',
                'error' => 'Error Creating New Support Ticket'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
	}

	if (isset($_POST['replyTicket']) && isset($_POST['message']) ) {
    	extract($_POST);

		if (isset($_FILES['attach']) && $_FILES['attach']['error'] === UPLOAD_ERR_OK) {
		    $uploadDir = 'uploads/';
		    $image_id = $controller->uploadFile('attach', $uploadDir);
		} else {
		    $image_id = 'null';
		}
	
        $ticket_id = $_SESSION['showTicket']['id'];
        $data = compact( 'ticket_id', 'message', 'image_id');

        $controller = $controller->replyTicket($data);
        
	    if ($controller) {
		    	$response = array(
	                'message' => 'success',
	                'ticketId' => $ticket_id,

	            );

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array(
                'message' => 'error',
                'error' => 'Error Replying Ticket'
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
	}

	function setEmptyStringIfNotSet(&$variable) {
	    $variable = $variable ?? " ";
	}


	if (isset($_POST['changeSettings'])) {
    	extract($_POST);
    	setEmptyStringIfNotSet($first_name);
    	setEmptyStringIfNotSet($last_name);
    	setEmptyStringIfNotSet($username);
    	setEmptyStringIfNotSet($gender);
    	setEmptyStringIfNotSet($date_of_birth);
    	setEmptyStringIfNotSet($phone);
    	setEmptyStringIfNotSet($city);
    	setEmptyStringIfNotSet($address);
    	setEmptyStringIfNotSet($zip_code);

		if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
		    $uploadDir = 'uploads/';
		    $image_id = $controller->uploadFile('avatar', $uploadDir);
		} else {
		    $image_id = 'null';
		}

		$fullname = $first_name." ".$last_name;
		$dob = $date_of_birth;
		$zip = $zip_code;
	    $date_modified = new DateTime();
	    $date_modified = $date_modified->format('Y-m-d H:i:s');
        $data = compact( 'fullname', 'username', 'gender', 'dob', 'phone', 'city', 'address', 'zip', 'date_modified', 'image_id');

        $controller = $controller->changeSettings($data);
        
        //print_r($data);	
	    if ($controller) {
		    	$response = array(
	                'message' => 'success',

	            );
        } else {
            $response = array(
                'message' => 'error',
                'error' => 'Error Updating Profile'
            );

        }
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	if(isset($_POST['getKycData'])){
		extract($_REQUEST);
		
		$credentials ="
		<div class=\"col-xl-12 col-md-12\">
		    <div class=\"progress-steps-form\">
		        <label for=\"exampleFormControlInput1\" class=\"form-label\">Name</label>
		        <div class=\"input-group\">
		            <input type=\"text\" name=\"name\" required=\"\" class=\"form-control\" aria-label=\"Name\"
		                id=\"name\" aria-describedby=\"basic-addon1\" required>
		        </div>
		    </div>
		</div>


		<div class=\"col-xl-12 col-md-12\">
		    <div class=\"progress-steps-form\">
		        <label for=\"exampleFormControlInput1\" class=\"form-label\">State</label>
		        <div class=\"input-group\">
		            <input type=\"text\" name=\"state\" required=\"\" class=\"form-control\" aria-label=\"State\"
		                id=\"state\" aria-describedby=\"basic-addon1\" required>
		        </div>
		    </div>
		</div>


		<div class=\"col-xl-12 col-md-12\">
		    <div class=\"body-title\">Front of ID</div>
		    <div class=\"wrap-custom-file\">
		        <input type=\"file\" name=\"idfront\" id=\"5\" class=\"idfront\" accept=\".gif, .jpg, .png\" required=\"\">
		        <label for=\"5\">
		            <img class=\"upload-icon\" src=\"../assets/global/materials/upload.svg\" alt=\"\">
		            <span  id=\"fileNameLabel\">Select Front of ID</span>
		        </label>
		    </div>
		</div>";

		$data = array(
        	'credentials' => $credentials,
	    );
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}

	

	if (isset($_POST['submitKyc'])) {
    	extract($_POST);

		if (isset($_FILES['idfront']) && $_FILES['idfront']['error'] === UPLOAD_ERR_OK) {
		    $uploadDir = 'uploads/';
		    $image_id = $controller->uploadFile('idfront', $uploadDir);
		} else {
		    $image_id = 'null';
		}
		$status = 'pending';
        $data = compact( 'name', 'state', 'image_id', 'status');

        $controller = $controller->submitKyc($data);
        
        //print_r($data);	
	    if ($controller) {
		    	$response = array(
	                'message' => 'success',

	            );
        } else {
            $response = array(
                'message' => 'error',
                'error' => 'Error Updating Profile'
            );

        }
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	if (isset($_POST['changePassword'])) {
    	extract($_POST);

	    if ($new_password === $new_confirm_password) {
	    	$data = compact( 'current_password', 'new_password', 'new_confirm_password');

	        $controller = $controller->changePassword($data);
	        
	        //print_r($data);	
		    if ($controller) {
			    	$response = array(
		                'message' => 'success',

		            );
	        } else {
	            $response = array(
	                'message' => 'error',
	                'error' => 'The Current Password is Not a Match with the Old Password'
	            );

	        }
        } else {
            $response = array(
                'message' => 'error',
                'error' => 'Passwords Do Not Match'
            );

        }
	        
        header('Content-Type: application/json');
        echo json_encode($response);
	}

	if(isset($_POST['getAllEmail'])){
	    $controller = $controller->getAllEmail();
	     if ($controller) {
			    
		    $response = array(
                	'message' => 'success',
	                'emails' => $controller['emails'],
	                'names' => $controller['names'],
	            );
        } else {
            $response = array(
                'message' => 'error',
                'error' => 'No Data Found'
            );

        }
	    header('Content-Type: application/json');
	    echo json_encode($response);
	}

	
	//Send Money
	if (isset($_POST['sendMoney']) && isset($_POST['amount'])&& isset($_POST['email']) ) {
    	extract($_POST);
       	setEmptyStringIfNotSet($note);
       	$totalcharge = $amount + $charge;
	   if((float)$_SESSION["balance"] > (float)$totalcharge){
	        $imageid = 'null';
	        $gateway = 'Main Balance';
	        $type = 'Transfer';
	        $fee = $charge;
	        $status = 'Success';
	        $description = "Transfer to $email";
	        $schemaid = 'null';
	        $message = "Hello ".$_SESSION['fullname']."! \$$amount Transfer  to $email has been Initiated <br>";
	        $data = compact( 'type', 'amount', 'fee', 'gateway', 'status', 'description', 'imageid', 'schemaid', 'message', 'email', 'note');

	        $controller = $controller->sendMoney($data);
	        
		    if ($controller) {
			    	$response = array(
		                'message' => 'success',
		                'checkout' => $_SESSION['transferPendingPage'],
		                'mainBalance' => $_SESSION['balance'],
		                'profitBalance' => $_SESSION['profit'],

		            );

	            header('Content-Type: application/json');
	            echo json_encode($response);
	        } 
	   }else {
            $response = array(
                'message' => 'error',
                'error' => "Insufficient Balance in your Main Wallet"
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
	}
	
	if (isset($_POST['getKycStatus']) ) {
    		$kycStatus = $_SESSION['kycStatus'];
    		$showKycToast = $_SESSION['showKycToast'];
    		
    		$_SESSION['showKycToast'] = 'unset';
            $response = array(
                'showKycToast' => $showKycToast,
                'kycStatus' =>  $kycStatus,
            );

            header('Content-Type: application/json');
            echo json_encode($response);
    	}


?>