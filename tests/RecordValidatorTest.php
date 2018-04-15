<?php

/**
 * Created by PhpStorm.
 * User: logan_000
 * Date: 4/15/2018
 * Time: 12:33 PM
 */
use PHPUnit\Framework\TestCase;
require_once(__DIR__ . "/../validator.php");

class RecordValidatorTest extends PHPUnit_Framework_TestCase
{

    function test_EmailShouldBeInvalid()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidEmail("sdf");
        $this->assertFalse($validity);
    }

    function test_EmailShouldExist()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidEmail();
        $this->assertFalse($validity);
    }

    function test_EmailShouldBeValid()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidEmail("sdf@gmail.com");
        $this->assertTrue($validity);
    }

    function test_StringIsAlphaOnly()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidAlpha("james");
        $this->assertTrue($validity);
    }

    function test_StringIsNotAlphaOnly()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidAlpha("Bob232");
        $this->assertFalse($validity);
    }

    function test_StringShouldExist()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidAlpha();
        $this->assertFalse($validity);
    }

    function test_IsNumberValid()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidNumber(2);
        $this->assertTrue($validity);
    }

    function test_NumberNotValid()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidNumber("abc");
        $this->assertFalse($validity);
    }

    function test_NumberShouldExist()
    {
        $validator = new RecordValidator();
        $validity=$validator->IsValidNumber();
        $this->assertFalse($validity);
    }
}
