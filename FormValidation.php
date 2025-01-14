<?php

class FormValidation{
      private $data;
      private $errors = [];
      private static $fields1 = ['name','email','pass','confpass'];
      private static $fields2 = ['name','email'];

public function __construct($Data_Array)
{
    $this->data = $Data_Array;
}

public function ValidateSignUp(){
    foreach(self::$fields1 as $field){
         if(!key_exists($field,$this->data)){
             trigger_error('Field Doesn\'t Exist');
             return;
         }
    }
 
    $this->ValidateName();
    $this->ValidateEmail();
    $this->ValidatePassword();
    return $this->errors;
}

public function ValidateSignIn(){
   foreach(self::$fields2 as $field){
        if(!key_exists($field,$this->data)){
            trigger_error('Field Doesn\'t Exist');
            return;
        }
   }

   $this->ValidateName();
   $this->ValidateEmail();
   return $this->errors;
}



private function ValidateName(){
      // Validate name
      $value = $this->data['name'];
        if (empty($value)) {
            $this->addError('name','UserName must not be Empty');
        } 
        else {
              if (!preg_match('/^[a-zA-Z\s]+$/', $value)) {
                $this->addError('name','UserName should only contain Letters and Space(s)');
              }
         }
}

private function ValidateEmail(){
        // Validate name
        $value = $this->data['email'];
        if (empty($value)) {
            $this->addError('email','Email must not be Empty');
        } else {
            if (!filter_var($value,FILTER_VALIDATE_EMAIL)) {
                $this->addError('email','Enter valid Email');
            }
        }
}

private function ValidatePassword(){
        $password1 = $this->data['pass'];
        $password2 = $this->data['confpass'];
        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"; 

        if(empty($password1)){
            $this->addError('pass','Password cannot be empty');
        }
        else{
            if(!preg_match($password_regex,$password1)){
                $this->addError('pass','Must contain 1-UpperCase,1-symbol, and Numbers');
            }
            if(strlen($password1)>8){
                $this->addError('pass','Password must within 8 Chracters');
            }
        }

        if(empty($password2)){
            $this->addError('confpass','Need to be filled');
        }
        else{
            if($password1 != $password2){
                $this->addError('confpass','Password Mismatch');
            }
        }

       
}


private function addError($key,$value){
    $this->errors[$key]=$value;
}
}

?>