<?php
/**
 * Created by PhpStorm.
 * User: logan_000
 * Date: 4/15/2018
 * Time: 11:22 AM
 */

class RecordValidator
{
    public $errorMsg="";

    function ValidatePerson($record)
    {
        if(!$this->IsValidNumber($record["person_id"])) {
            $this->errorMsg="Invalid person_id: ".$record["person_id"];
            return false;
        }
        if(!$this->IsValidAlpha($record["first_name"])) {
            $this->errorMsg="Invalid first_name: ".$record["first_name"];
            return false;
        }
        if(!$this->IsValidAlpha($record["last_name"])) {
            $this->errorMsg="Invalid last_name: ".$record["last_name"];
            return false;
        }
        if(!$this->IsValidEmail($record["email_address"])) {
            $this->errorMsg="Invalid email address: ".$record["email_address"];
            return false;
        }
        if(!$this->IsValidNumber($record["group_id"])) {
            $this->errorMsg="Invalid group id: ".$record["group_id"];
            return false;
        }
        if(!$this->IsValidAlpha($record["state"])) {
            $this->errorMsg="Invalid state: ".$record["state"];
            return false;
        }

        return true;
    }

    function ValidateGroup($record)
    {
        if(!$this->IsValidNumber($record["group_id"])) {
            $this->errorMsg="Invalid group id: ".$record["group_id"];
            return false;
        }
        if(!$this->IsValidAlpha($record["group_name"])) {
            $this->errorMsg="Invalid group name: ".$record["group_name"];
            return false;
        }

        return true;
    }

    function IsValidNumber($val = null)
    {
        if(isset($val)) {
            if(!is_numeric($val)) {return false;}
        }else{
            return false;
        }

        return true;
    }

    function IsValidAlpha($val = null)
    {
        $sanitizedValue=str_replace("-","",$val);
        $sanitizedValue=str_replace(" ","",$sanitizedValue);

        if(isset($val)) {
            if(!ctype_alpha($sanitizedValue)) return false;
        }else{
            return false;
        }

        return true;
    }

    function IsValidEmail($email = null){
        if(!isset($email)) return false;

        $sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($sanitized, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $domain = explode("@", $email, 2);
        return checkdnsrr($domain[1]);
    }
}