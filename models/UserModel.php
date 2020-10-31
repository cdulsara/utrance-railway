<?php

include_once "../classes/core/Model.php";








class UserModel extends Model
{

    public $first_name;
    public $last_name;
    public $street_line1;
    public $street_line2;
    public $city;
    public $contact_num;
    public $user_password;
    public $email_id;
    public $user_role="user";
    public $user_confirmPassword;
    
  public function register(){
      
    

    echo $this->first_name;

        
    if($this->first_name == NULL || $this->last_name == NULL ||  $this->street_line1 == NULL || $this->contact_num  == NULL  || $this->user_password  == NULL || $this->email_id  == NULL){
         return false;
    }else{
      $query = App::$APP->db->pdo->prepare("INSERT INTO users (first_name, last_name,street_line1,street_line2,city,contact_num,user_password,email_id,user_role) VALUES (:fn, :ln,:st1,:st2,:city,:cn,:up,:eid,:us)");

    $query->bindValue(":fn", $this->first_name);
    $query->bindValue(":ln", $this->last_name);
    $query->bindValue(":st1", $this->street_line1);
    $query->bindValue(":st2", $this->street_line2);
    $query->bindValue(":city", $this->city);
    $query->bindValue(":cn", $this->contact_num);
    $query->bindValue(":up", $this->user_password);
    $query->bindValue(":eid", $this->email_id);
    $query->bindValue(":us", $this->user_role);
      return $query->execute();
    }

  public function signIn(){
          
	if(isset($_POST["login"])){
		if(empty($_POST["id"])||empty($_POST["user_password"])){
			$message = 'All fields are required';
		}	
		else{
			$query = "SELECT * FROM users WHERE id = :id AND user_password = :user_password";
			$statement = $connect->prepare($query);
			$statement->execute(
				array(
					'id' => $_POST["id"],
					'user_password' => $_POST["user_password"]
				)
			);
			$count = $statement->rowCount();
			if($count>0)
			{
				$_SESSION["id"]=$_POST["id"];
				header("location:home.php");
			}
			else{
				$message='Wrong Data';
			}

		}
	}
            
            

    }
    
   
    
  }

   public function valid(){
     if($this->first_name == NULL){
       return 0;
     }else if($this->last_name == NULL){
       return 1;
     }else if($this ->street_line1 == NULL){
       return 2;
     }else if($this->street_line2 == NULL){
       return 3;
     }elseif($this->city == NULL){
       return 4;
     }else if($this->contact_num == NULL){
       return 5;
     }
   }

  

  /*public function rules():array{
    return[
        'first_name' => [self::RULE_REQUIRED],
        'last_name' =>[self::RULE_REQUIRED],
        'street_line1' =>[self::RULE_REQUIRED],
        'street_line2'=>[self::RULE_REQUIRED],
        'city' => [self::RULE_REQUIRED],
        'contact_num' =>[self::RULE_REQUIRED],
        'user_password' =>[self::RULE_REQUIRED],
         'user_confirmPassword'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'user_password']],
        'email_id' =>[self::RULE_REQUIRED,self::RULE_EMAIL],
        'user_role' =>[self::RULE_REQUIRED],
       
    ];
}*/
//[self::RULE_MIN,'min=>8'],[self::RULE_MAX,'max'<=24]

   


        
    
  



}
