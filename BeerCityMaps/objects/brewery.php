<?php
class Brewery{
 
    // database connection and table name
    private $conn;
    private $table_name = "breweries";
 
    // object properties
    public $id;
    public $name;
    public $link;
    public $email;
    public $contact_number;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $ad_text;
    public $status;
    public $created;
    public $modified;
    public $description;
    public $lat;
    public $lng;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
// create new user record
function create(){
 
    // to get time stamp for 'created' field
    $this->created=date('Y-m-d H:i:s');
 
    // insert query
    $query = "INSERT INTO " . $this->table_name . "
            SET
        name = :name,
        link = :link,
        email = :email,
        contact_number = :contact_number,
        address = :address,
        city = :city,
        state = :state,
        zip = :zip,
        ad_text = :ad_text,
        status = :status,
        description = :description,
        lat = :lat,
        lng = :lng,
        logo = :logo,
        created = :created";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->link=htmlspecialchars(strip_tags($this->link));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->contact_number=htmlspecialchars(strip_tags($this->contact_number));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->state=htmlspecialchars(strip_tags($this->state));
    $this->zip=htmlspecialchars(strip_tags($this->zip));
    $this->ad_text=htmlspecialchars(strip_tags($this->ad_text));
    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->lat=htmlspecialchars(strip_tags($this->lat));
    $this->lng=htmlspecialchars(strip_tags($this->lng));
 
    // bind the values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':link', $this->link);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':contact_number', $this->contact_number);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':city', $this->city);
    $stmt->bindParam(':state', $this->state);
    $stmt->bindParam(':zip', $this->zip);
    $stmt->bindParam(':ad_text', $this->ad_text);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':lat', $this->lat);
    $stmt->bindParam(':lng', $this->lng);
    $stmt->bindParam(':logo', $this->logo);
 
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':created', $this->created);
 
    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }else{
        $this->showError($stmt);
        return false;
    }
 }
public function showError($stmt){
    echo "<pre>";
        print_r($stmt->errorInfo());
    echo "</pre>";
}
// read all user records
function readAll($from_record_num, $records_per_page){
 
    // query to read all user records, with limit clause for pagination
    $query = "SELECT
                id,
                name,
                link,
                email,
                contact_number,
                address,
                city,
                state,
                zip,
                ad_text,
                status,
                description,
                lat,
                lng,
                logo,
                created
            FROM " . $this->table_name . "
            ORDER BY id DESC
            LIMIT ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind limit clause variables
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values
    return $stmt;
}
// used for paging users
public function countAll(){
 
    // query to select all user records
    $query = "SELECT id FROM " . $this->table_name . "";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // return row count
    return $num;
}
}