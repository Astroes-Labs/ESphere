<?php

define('WEBSITE_NAME', 'Elonsphere');
$hostname = $encryptionHelper->de($hostname);
$username = $encryptionHelper->de($username);
$password = $encryptionHelper->de($password);
$database = $encryptionHelper->de($database);
$controller = new mainController($hostname, $username, $password, $database);
//schema logs
<tr class="odd">
    <td class="sorting_1"><span class="avatar-img"><img
                src="https://passport.cmaxtrade.com/assets/global/images/RFX3Btq5Aob18L32ae0x.png" alt=""></span>

    </td>
    <td><strong> SILVER PLAN <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                data-lucide="arrow-big-right" icon-name="arrow-big-right" class="lucide lucide-arrow-big-right">
                <path d="M6 9h6V5l7 7-7 7v-4H6V9z"></path>
            </svg> $89000</strong>
        <div class="date">Jul 05 2024 09:34
            <script>
                'use strict';
                lucide.createIcons();
            </script>
        </div>
    </td>
    <td><strong>
            28%
        </strong>

    </td>
    <td><strong>0 x 24920 = 0 USD</strong>
    </td>
    <td>31 Times</td>
    <td>
        <div class="site-badge warnning">No</div>

    </td>
    <td>
        <div class="site-badge warnning">Pending</div>
    </td>
</tr>


// all transactions
<tr>
    <td>
        <div class="table-description">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left-right
                                    " icon-name="arrow-left-right
                                    " class="lucide lucide-arrow-left-right">
                    <path d="M8 3 4 7l4 4"></path>
                    <path d="M4 7h16"></path>
                    <path d="m16 21 4-4-4-4"></path>
                    <path d="M20 17H4"></path>
                </svg>
            </div>
            <div class="description">
                <strong>SILVER PLAN Invested</strong>
                <div class="date">Jul 13 2024 09:02</div>
            </div>
        </div>
    </td>
    <td><strong>TRXXF9CPWTEZJ</strong></td>
    <td>
        <div class="site-badge primary-bg">investment</div>
    </td>
    <td><strong class="green-color">+60500 </strong>
    </td>
    <td><strong>0 USD</strong></td>
    <td>
        <div class="site-badge warnning">Pending</div>
    </td>
    <td><strong>ETH</strong></td>
</tr>





//with photo uploaded

<div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">Review and Confirm Investment</h3>
                </div>
                <div class="site-card-body">
                    <form action="https://passport.cmaxtrade.com/user/invest-now" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="BG8QIRqelrttAoTf3cEy4iHdRWSuJEX2dlosTvY3">                        <div class="progress-steps-form">
                            <div class="transaction-list table-responsive">
                                <table class="table preview-table">
                                    <tbody>
                                    <tr>
                                        <td><strong>Select Schema:</strong></td>
                                        <td>
                                            <div class="input-group mb-0">
                                                <select class="site-nice-select" aria-label="Default select example" id="select-schema" name="schema_id" required="" style="display: none;">
                                                                                                            <option value="1">SILVER PLAN</option>
                                                                                                            <option value="2">ROOKIE PLAN</option>
                                                                                                            <option value="3" selected="">PRO PLAN</option>
                                                                                                            <option value="4">MASTER PLAN</option>
                                                                                                    </select><div class="nice-select site-nice-select" tabindex="0"><span class="current">PRO PLAN</span><ul class="list"><li data-value="1" class="option">SILVER PLAN</li><li data-value="2" class="option">ROOKIE PLAN</li><li data-value="3" class="option selected">PRO PLAN</li><li data-value="4" class="option">MASTER PLAN</li></ul></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Profit Holiday:</strong></td>
                                        <td id="holiday">
                                             No                                         </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Amount:</strong></td>
                                        <td id="amount">
                                            Minimum 11000 USD - Maximum 49000 USD
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Enter Amount:</strong></td>
                                        <td>
                                            <div class="input-group mb-0">
                                                <input type="text" class="form-control" placeholder="Enter Amount" oninput="this.value = validateDouble(this.value)" aria-label="Amount" name="invest_amount" id="enter-amount" aria-describedby="basic-addon1" required="">
                                                <span class="input-group-text" id="basic-addon1">USD</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Select Wallet:</strong></td>
                                        <td>
                                            <div class="input-group mb-0">
                                                <select class="site-nice-select" aria-label="Default select example" name="wallet" required="" id="selectWallet" style="display: none;">
                                                    <option value="main">Main Wallet ( 0 USD
                                                        )
                                                    </option>
                                                    <option value="profit">Profit Wallet ( 0 USD
                                                        )
                                                    </option>
                                                    <option value="gateway">Direct Gateway</option>
                                                </select><div class="nice-select site-nice-select" tabindex="0"><span class="current">Direct Gateway</span><ul class="list"><li data-value="main" class="option">Main Wallet ( 0 USD
                                                        )
                                                    </li><li data-value="profit" class="option focus">Profit Wallet ( 0 USD
                                                        )
                                                    </li><li data-value="gateway" class="option selected">Direct Gateway</li></ul></div>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr class="gatewaySelect"><td><strong>Payment Method:</strong></td>
<td>
    <div class="input-group mb-0">
        <select class="site-nice-select" aria-label="Default select example" name="gateway_code" id="gatewaySelect" required="" style="display: none;">
                            <option value="BTC">BTC</option>
                            <option value="ETH">ETH</option>
                    </select><div class="nice-select site-nice-select" tabindex="0"><span class="current">ETH</span><ul class="list"><li data-value="BTC" class="option focus">BTC</li><li data-value="ETH" class="option selected">ETH</li></ul></div>
    </div>
</td>
</tr>

                                    <tr>
                                        <td colspan="2">
                                            <div class="row manual-row"><div class="col-xl-12 col-md-12">
    <div class="frontend-editor-data">
        <p>Kindly send only ETH to this deposit address, Sending any other coin or token to this address may result in loss of your crypto.</p>

<p>ADDRESS:&nbsp;<span style="font-weight:bolder;">0xaF16f345B66d9eE0008190CFD62C8c9B2F188418</span></p>

<p>Please scan Barcode for wallet payment&nbsp;confirmation below:</p>

<p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXIAAAFyAQMAAADS6sNKAAAABlBMVEX///8AAABVwtN+AAAACXBIWXMAAA7EAAAOxAGVKw4bAAABpElEQVR4nO2aTY7DIAyFLeUAORJXz5FygEgU8A8QouluZl703oKW+HM3McaGilAURVEU9TfKpksknTIOsrvtII/L62S/iue5FWOgR3k2IuQx+bCl8qU82XJzt98ogUL+FXyLB6WGZ+Tfwhsqcw4gj86HTRf9aVMbOkIeko96TBf4ODzWY+Sh+Ju0KDs8FL6K/D/n7Y3vHhRVutRT3b7bQB6ZbwEg0UpVRVK3Go08MJ+vwdY8pTZVfSMnD8z7shZf6s639vlhqyYPxmdrm3oC9/3anMgD83noiOcEntSwzUFBHpLvDfKcwNMps8iD8bXU1lVe6zGrvCPH2/ZNHpVXp7hP1KOQPs2PmzZ5GN4DoDtNlxIaI+SB+fbhBVibWvvcQmHpv8iD8X62pZndqmx3X89DyIPxAdjZpVEeD/d+ijwUP3nWpH4u04dDEfIovL33aJqTZ3Ef1vMQ8kh8o6JLtlbK3Z/6L/JY/O2/WR4AOUT+PbzM9ZgsIo/LD/eJEhcVP8QDeQS+fexh80Prr/mfPARv6u++A1v2HEAelacoiqIo6jf1AaJ5LWX+HBo6AAAAAElFTkSuQmCC" alt="mfPARv6u++A1v2HEAelacoiqIo6jf1AaJ5LWX+HBo6AAAAAElFTkSuQmCC" style="width:370px;"></p>
    </div>
</div>

            <div class="col-xl-12 col-md-12">
            <div class="body-title">Proof of Payment</div>
            <div class="wrap-custom-file">
                <input type="file" name="manual_data[Proof of Payment]" id="1" accept=".gif, .jpg, .png" required="">
                <label for="1" class="file-ok" style="background-image: url(&quot;blob:https://passport.cmaxtrade.com/5774e065-bcee-4057-afb0-e489e58656db&quot;);">
                    <img class="upload-icon" src="https://passport.cmaxtrade.com/assets/global/materials/upload.svg" alt="">
                    <span>2.png</span>
                </label>
            </div>
        </div>
    

</div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Return of Interest:</strong></td>
                                        <td id="return-interest">23% (Daily)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Number of Period:</strong></td>
                                        <td id="number-period">31 Times </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Capital Back:</strong></td>
                                        <td id="capital_back">No</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Investment Amount:</strong></td>
                                        <td><span id="total-amount"> 0</span> USD
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="button">
                                <button type="submit" class="site-btn primary-btn me-3">
                                    <i class="anticon anticon-check"></i>Invest Now
                                </button>
                                <a href="https://passport.cmaxtrade.com/user/schemas" class="site-btn black-btn">
                                    <i class="anticon anticon-stop"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



                //without picture uploaded



                <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">Review and Confirm Investment</h3>
                </div>
                <div class="site-card-body">
                    <form action="https://passport.cmaxtrade.com/user/invest-now" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="BG8QIRqelrttAoTf3cEy4iHdRWSuJEX2dlosTvY3">                        <div class="progress-steps-form">
                            <div class="transaction-list table-responsive">
                                <table class="table preview-table">
                                    <tbody>
                                    <tr>
                                        <td><strong>Select Schema:</strong></td>
                                        <td>
                                            <div class="input-group mb-0">
                                                <select class="site-nice-select" aria-label="Default select example" id="select-schema" name="schema_id" required="" style="display: none;">
                                                                                                            <option value="1">SILVER PLAN</option>
                                                                                                            <option value="2">ROOKIE PLAN</option>
                                                                                                            <option value="3" selected="">PRO PLAN</option>
                                                                                                            <option value="4">MASTER PLAN</option>
                                                                                                    </select><div class="nice-select site-nice-select" tabindex="0"><span class="current">PRO PLAN</span><ul class="list"><li data-value="1" class="option">SILVER PLAN</li><li data-value="2" class="option">ROOKIE PLAN</li><li data-value="3" class="option selected">PRO PLAN</li><li data-value="4" class="option">MASTER PLAN</li></ul></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Profit Holiday:</strong></td>
                                        <td id="holiday">
                                             No                                         </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Amount:</strong></td>
                                        <td id="amount">
                                            Minimum 11000 USD - Maximum 49000 USD
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Enter Amount:</strong></td>
                                        <td>
                                            <div class="input-group mb-0">
                                                <input type="text" class="form-control" placeholder="Enter Amount" oninput="this.value = validateDouble(this.value)" aria-label="Amount" name="invest_amount" id="enter-amount" aria-describedby="basic-addon1" required="">
                                                <span class="input-group-text" id="basic-addon1">USD</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Select Wallet:</strong></td>
                                        <td>
                                            <div class="input-group mb-0">
                                                <select class="site-nice-select" aria-label="Default select example" name="wallet" required="" id="selectWallet" style="display: none;">
                                                    <option value="main">Main Wallet ( 0 USD
                                                        )
                                                    </option>
                                                    <option value="profit">Profit Wallet ( 0 USD
                                                        )
                                                    </option>
                                                    <option value="gateway">Direct Gateway</option>
                                                </select><div class="nice-select site-nice-select" tabindex="0"><span class="current">Direct Gateway</span><ul class="list"><li data-value="main" class="option">Main Wallet ( 0 USD
                                                        )
                                                    </li><li data-value="profit" class="option focus">Profit Wallet ( 0 USD
                                                        )
                                                    </li><li data-value="gateway" class="option selected">Direct Gateway</li></ul></div>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr class="gatewaySelect"><td><strong>Payment Method:</strong></td>
<td>
    <div class="input-group mb-0">
        <select class="site-nice-select" aria-label="Default select example" name="gateway_code" id="gatewaySelect" required="" style="display: none;">
                            <option value="BTC">BTC</option>
                            <option value="ETH">ETH</option>
                    </select><div class="nice-select site-nice-select" tabindex="0"><span class="current">ETH</span><ul class="list"><li data-value="BTC" class="option focus">BTC</li><li data-value="ETH" class="option selected">ETH</li></ul></div>
    </div>
</td>
</tr>

                                    <tr>
                                        <td colspan="2">
                                            <div class="row manual-row"><div class="col-xl-12 col-md-12">
    <div class="frontend-editor-data">
        <p>Kindly send only ETH to this deposit address, Sending any other coin or token to this address may result in loss of your crypto.</p>

<p>ADDRESS:&nbsp;<span style="font-weight:bolder;">0xaF16f345B66d9eE0008190CFD62C8c9B2F188418</span></p>

<p>Please scan Barcode for wallet payment&nbsp;confirmation below:</p>

<p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXIAAAFyAQMAAADS6sNKAAAABlBMVEX///8AAABVwtN+AAAACXBIWXMAAA7EAAAOxAGVKw4bAAABpElEQVR4nO2aTY7DIAyFLeUAORJXz5FygEgU8A8QouluZl703oKW+HM3McaGilAURVEU9TfKpksknTIOsrvtII/L62S/iue5FWOgR3k2IuQx+bCl8qU82XJzt98ogUL+FXyLB6WGZ+Tfwhsqcw4gj86HTRf9aVMbOkIeko96TBf4ODzWY+Sh+Ju0KDs8FL6K/D/n7Y3vHhRVutRT3b7bQB6ZbwEg0UpVRVK3Go08MJ+vwdY8pTZVfSMnD8z7shZf6s639vlhqyYPxmdrm3oC9/3anMgD83noiOcEntSwzUFBHpLvDfKcwNMps8iD8bXU1lVe6zGrvCPH2/ZNHpVXp7hP1KOQPs2PmzZ5GN4DoDtNlxIaI+SB+fbhBVibWvvcQmHpv8iD8X62pZndqmx3X89DyIPxAdjZpVEeD/d+ijwUP3nWpH4u04dDEfIovL33aJqTZ3Ef1vMQ8kh8o6JLtlbK3Z/6L/JY/O2/WR4AOUT+PbzM9ZgsIo/LD/eJEhcVP8QDeQS+fexh80Prr/mfPARv6u++A1v2HEAelacoiqIo6jf1AaJ5LWX+HBo6AAAAAElFTkSuQmCC" alt="mfPARv6u++A1v2HEAelacoiqIo6jf1AaJ5LWX+HBo6AAAAAElFTkSuQmCC" style="width:370px;"></p>
    </div>
</div>

            <div class="col-xl-12 col-md-12">
            <div class="body-title">Proof of Payment</div>
            <div class="wrap-custom-file">
                <input type="file" name="manual_data[Proof of Payment]" id="1" accept=".gif, .jpg, .png" required="">
                <label for="1">
                    <img class="upload-icon" src="https://passport.cmaxtrade.com/assets/global/materials/upload.svg" alt="">
                    <span>Select Proof of Payment</span>
                </label>
            </div>
        </div>
    

</div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Return of Interest:</strong></td>
                                        <td id="return-interest">23% (Daily)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Number of Period:</strong></td>
                                        <td id="number-period">31 Times </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Capital Back:</strong></td>
                                        <td id="capital_back">No</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Investment Amount:</strong></td>
                                        <td><span id="total-amount"> 0</span> USD
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="button">
                                <button type="submit" class="site-btn primary-btn me-3">
                                    <i class="anticon anticon-check"></i>Invest Now
                                </button>
                                <a href="https://passport.cmaxtrade.com/user/schemas" class="site-btn black-btn">
                                    <i class="anticon anticon-stop"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php
class Database {
    private $db;

    // Constructor to initialize database connection
    public function __construct($host, $username, $password, $database) {
        $this->db = new mysqli($host, $username, $password, $database);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // Function to insert data into any table
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

    // Destructor to close database connection
    public function __destruct() {
        $this->db->close();
    }
}

// Example usage:
$database = new Database("localhost", "username", "password", "database_name");

// Example data to insert
$data = array(
    "name" => "John Doe",
    "age" => 30,
    "email" => "john.doe@example.com",
    // Add more fields as needed
);

$tableName = "users"; // Example table name

// Insert data into table
$result = $database->insertData($tableName, $data);

if ($result) {
    echo "Data inserted successfully.";
} else {
    echo "Failed to insert data.";
}
?>



    /*
    //Read Data 
    public function readData($table, $conditions = array()) {
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

        // Construct the SQL query
        $sql = "SELECT * FROM $table" . $whereClause;

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
    }*/


    //mobile transactions
     <!--  <div class="single-transaction">
                    <div class="transaction-left">
                        <div class="transaction-des">
                            <div class="transaction-title">SILVER PLAN Invested</div>
                            <div class="transaction-id">TRXXF9CPWTEZJ</div>
                            <div class="transaction-date">Jul 13 2024 09:02</div>
                        </div>
                    </div>
                    <div class="transaction-right">
                        <div class="transaction-amount">-60500 USD</div>
                        <div class="transaction-fee sub">-0 USD Fee</div>
                        <div class="transaction-gateway">ETH</div>
                        <div class="transaction-status pending">Pending</div>
                    </div>
                </div>
                <div class="single-transaction">
                    <div class="transaction-left">
                        <div class="transaction-des">
                            <div class="transaction-title">SILVER PLAN Invested</div>
                            <div class="transaction-id">TRX7EPHFB5J1R</div>
                            <div class="transaction-date">Jul 05 2024 09:34</div>
                        </div>
                    </div>
                    <div class="transaction-right">
                        <div class="transaction-amount">-89000 USD</div>
                        <div class="transaction-fee sub">-0 USD Fee</div>
                        <div class="transaction-gateway">BTC</div>
                        <div class="transaction-status pending">Pending</div>
                    </div>
                </div> -->


                //desktop transactions

                  <!--  <tr>
                                    <td>
                                        <div class="table-description">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left-right" icon-name="arrow-left-right"
                                                    class="lucide lucide-arrow-left-right">
                                                    <path d="M8 3 4 7l4 4"></path>
                                                    <path d="M4 7h16"></path>
                                                    <path d="m16 21 4-4-4-4"></path>
                                                    <path d="M20 17H4"></path>
                                                </svg>
                                            </div>
                                            <div class="description">
                                                <strong>SILVER PLAN Invested</strong>
                                                <div class="date">Jul 13 2024 09:02</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong>TRXXF9CPWTEZJ</strong></td>
                                    <td>
                                        <div class="site-badge primary-bg">investment</div>
                                    </td>
                                    <td><strong class="green-color">+60500 </strong></td>
                                    <td><strong>0 USD</strong></td>
                                    <td>
                                        <div class="site-badge warnning">Pending</div>
                                    </td>
                                    <td><strong>ETH</strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-description">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left-right" icon-name="arrow-left-right"
                                                    class="lucide lucide-arrow-left-right">
                                                    <path d="M8 3 4 7l4 4"></path>
                                                    <path d="M4 7h16"></path>
                                                    <path d="m16 21 4-4-4"></path>
                                                    <path d="M20 17H4"></path>
                                                </svg>
                                            </div>
                                            <div class="description">
                                                <strong>SILVER PLAN Invested</strong>
                                                <div class="date">Jul 05 2024 09:34</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong>TRX7EPHFB5J1R</strong></td>
                                    <td>
                                        <div class="site-badge primary-bg">investment</div>
                                    </td>
                                    <td><strong class="green-color">+89000 </strong></td>
                                    <td><strong>0 USD</strong></td>
                                    <td>
                                        <div class="site-badge warnning">Pending</div>
                                    </td>
                                    <td><strong>BTC</strong></td>
                                </tr> -->


                                //old transactions method
                                //Transactions Logs
    public function transactions2()
    {
        $tableName = 'transactions';
        $uid = $_SESSION['lid'];
        $conditions = array(
            'uid' => $uid,
        );
        $trans = $this->readData($tableName, $conditions);
        $_SESSION['desktopTrans'] = "";
        $_SESSION['mobileTrans'] = "";
        foreach($trans as $option) {
            
            $optionId = $option['id'];
            $fee = $option['fee'];
            $type = $option['type'];
            $tid = $option['tid'];
            $amount = $option['amount'];
            $gateway = $option['gateway'];
            $formattedAmount = number_format($amount,'2', ',');
            $dateString = $option['date_created'];
            $date = new DateTime($dateString);
            $formattedDate = $date->format('M d Y H:i');
            $status = $option['status'];
            if($type === "Investment"){
                $tableName = 'schemas_list';
                $conditions = array(
                    'id' => $option['schemaid']
                );
                $data = $this->readData($tableName, $conditions);
                $schemaData =  $data[0];
                $schemaIcon = $schemaData['icon'];
                $schemaName = $schemaData['name'];
                $schemaRoi = $schemaData['roi'];
                $schemaRoiAmount = ($schemaRoi/100) * $amount;
                $schemaPeriod = $schemaData['period'];

                $typeClass = "primary-bg";
                $typeClass2 = "green-color";
                $sym = "+";
                $desc = $schemaData['name']." Invested";
            }
            if($type === "Deposit"){
                $typeClass = "success";
                $typeClass2 = "green-color";
                $sym = "+";
                $desc = $formattedAmount." Deposited";
            }
            if($type === "Withdrawal"){
                $typeClass = "primary-bg";
                $typeClass2 = "red-color";
                $sym = "-";
                $desc = $formattedAmount." Withdrawn";
            }

            if($status === "Confirmed"){
                $statusClass = "success";
                $statusClass2 = "success";
            }
            if($status === "Pending"){
                $statusClass = "warnning";
                $statusClass2 = "pending";
            }
            if($status === "Failed"){
                $statusClass = "failed";
                $statusClass2 = "cancel";
            }
            
            $_SESSION['desktopTrans'] .= "

                <tr>
                    <td>
                        <div class=\"table-description\">
                            <div class=\"icon\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\"
                                    stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"
                                    data-lucide=\"arrow-left-right\" icon-name=\"arrow-left-right\" class=\"lucide lucide-arrow-left-right\">
                                    <path d=\"M8 3 4 7l4 4\"></path>
                                    <path d=\"M4 7h16\"></path>
                                    <path d=\"m16 21 4-4-4-4\"></path>
                                    <path d=\"M20 17H4\"></path>
                                </svg>
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


        $_SESSION['mobileTrans'] .= "
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
        }

        //print_r($_SESSION['schemaLogs']);
        return true;
    }



    <div class="row manual-row"><div class="col-xl-12 col-md-12">
    <div class="frontend-editor-data">
        <p>Kindly send only BTC to this deposit address, Sending any other coin or token to this address may result in loss of your crypto.</p>

<p>ADDRESS:&nbsp;<span style="font-weight:bolder;">bc1q0ca6vdpu6t973ggnurarq97mp8k3jl80dyym7j</span></p>

<p>Please scan Barcode for wallet payment&nbsp;confirmation below:</p>

<p><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXIAAAFyAQMAAADS6sNKAAAABlBMVEX///8AAABVwtN+AAAACXBIWXMAAA7EAAAOxAGVKw4bAAABwElEQVR4nO2aS46EMAxELXGAHImrcyQOgOQGf+IQurczKlS1AJI82OD4ByIURVEURf2PNHSc1+0Q3a65rZ0zdjBt5HF5Hxja7CZVG8ahEPKYvL/7WltO3g7XMy5DIf8K3tdcu8gwR/4NvKwnJat59tMeyL+Et5Ot7Rd1bfVVu3svhDwkHwrgdsg18rj8oFUtFYt87BdFHoqPN27vfs+tbvHah7ulZ+SB+QAqwZaK15s8/Tl5ID4SsKqSs5Tym/xB5HH5mI5tHem3zf0K1eSB+Ey7DglX7lcaTZG4Io/K21bP2CxeNEdl1cIeJqMgD8X32jg2+C3f1mhvksflywp0DNqZdD/sgTwS7w583vTm1C2Gt9n/kwfjeypWXyE2KX++zP0x8lB87136eLVtv/dCWg+5iTwcX2hEbvF+SBZasz2Qx+IjFaugnfagOjyNPCQ/3Omlcsbryre/NlHIY/BhAJpRun80DkOZ+5nkwfjNTq03rV2L/rIH8mC8pdXdqZsGz25Onfw7+COLquyHWNFM/j18/vSRPZJv+Rt5KN5OvUGt2eXyhef/HuSx+FDf6t0yvMf56IeQh+IpiqIoivpLfQDlPAR9uswItgAAAABJRU5ErkJggg==" alt="HuSx+FDf6t0yvMf56IeQh+IpiqIoivpLfQDlPAR9uswItgAAAABJRU5ErkJggg==" style="width:370px;"></p>
    </div>
</div>

            <div class="col-xl-12 col-md-12">
            <div class="body-title">Proof of Payment</div>
            <div class="wrap-custom-file">
                <input type="file" name="manual_data[Proof of Payment]" id="1" accept=".gif, .jpg, .png" required="">
                <label for="1" class="file-ok" style="background-image: url(&quot;blob:https://passport.cmaxtrade.com/9f21c066-0ffa-4da0-920a-7507bfa8dd30&quot;);">
                    <img class="upload-icon" src="https://passport.cmaxtrade.com/assets/global/materials/upload.svg" alt="">
                    <span>2.png</span>
                </label>
            </div>
        </div>
    

</div>




<div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">Add Money</h3>
                    <div class="card-header-links">
                        <a href="https://passport.cmaxtrade.com/user/deposit/log" class="card-header-link">Deposit History</a>
                    </div>
                </div>
                <div class="site-card-body">
                    <div class="progress-steps">
                        <div class="single-step current">
                            <div class="number">01</div>
                            <div class="content">
                                <h4>Deposit Amount</h4>
                                <p>Enter your deposit details</p>
                            </div>
                        </div>
                        <div class="single-step current">
                            <div class="number">02</div>
                            <div class="content">
                                <h4>Success</h4>
                                <p>Pending Your Deposit Process</p>
                            </div>
                        </div>
                    </div>
                        <div class="progress-steps-form">
        <div class="transaction-status centered">
            <div class="icon success">
                <i class="anticon anticon-check"></i>
            </div>
            <h2>$ 9000 Deposit Pending</h2>
            <p>The amount has been Pending added into your account</p>
            <p>Transaction ID: TRXMECUSO4I78</p>
            <a href="https://passport.cmaxtrade.com/user/deposit" class="site-btn">
                <i class="anticon anticon-plus"></i>Deposit again
            </a>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
?>
