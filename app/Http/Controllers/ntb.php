<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Crypt_RSA;
use Crypt_AES;


class ntb extends Controller {


	public function obEn(){
		/* Private Key for RSA Encryption and Decryption - U can genarate these from online.*/
		$privateKey = "-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgG9ZDiP9Gg9OBC+m61/NXLMt8WkgCjnsxdZ/4Ppm8k0eK2EDFpeE
DIhvFx8fBNSoBETY3p28HjztGHKh9BST9NbAz34qpXiyuxXKFydNCvQjnAQjswX9
zpUpqRmGj0NNDvaTBsV48jnPGv8Hn//3T1yHlwXk8TK5Effb0nFsnJORAgMBAAEC
gYBIchjRMYwTCR+QIXpjCqqVqf639zCwH21Y8jresLxVkJuIswmv6yp8Wksg5H2w
HuEoKjItTogd++U8MEMuYFWbxFUL3K1pRB7A2P1wPkAH5goaCHqnaheljtZxJHGC
OoYhzaSU+PfPJOsGfbjuR17efmwP7AVj0oJOM9+WWGnAAQJBAM0ooeJTKxxgUauj
yT72Bnrz/FmygJ0MBEWItuStswCFK1HUllVTkO1I7lQtU38NR4Oe1mpfv40141HJ
kT4Ca9ECQQCK8QSFdMDBDZmdKgSmJKUxbxD+zpIHhqBp9k+kpqOI6Opa/3LgTQ5X
VkV7QZxtCUaAsCZ/JavlOAFi2v5kllvBAkEAizD2JEepCCeRQZJuB3mEDAddPr4M
5IAypbqL27q9p6yyJ2LEXD/GJDdG+3WFIL4xtusdLi6oF3ZoNCU9lYSvAQJAD/Jt
1Gt8HCxVb0Z9VhxqoWvgBX7sH9UB4GeW6Iz/xB0HmP4szzXI6ZlLTERRkeo4n1iY
cot+WUa+UfxUqnLfgQJBAJHmftqz6ooyH9LluzCu7/Th8O/nnnD8V222QJQzcSFG
XjHT7gEfyQVDz0tq6ryG9ASRtvHcMmkgCGkn8aiaB+I=
-----END RSA PRIVATE KEY-----";

		/* Public Key for RSA Encryption and Decryption - U can genarate these from online. */
		$publicKey = "-----BEGIN PUBLIC KEY-----
MIGeMA0GCSqGSIb3DQEBAQUAA4GMADCBiAKBgG9ZDiP9Gg9OBC+m61/NXLMt8Wkg
CjnsxdZ/4Ppm8k0eK2EDFpeEDIhvFx8fBNSoBETY3p28HjztGHKh9BST9NbAz34q
pXiyuxXKFydNCvQjnAQjswX9zpUpqRmGj0NNDvaTBsV48jnPGv8Hn//3T1yHlwXk
8TK5Effb0nFsnJORAgMBAAE=
-----END PUBLIC KEY-----";
		
		/* Key for AES Encryption - 256bit - U can either use 128 to 256 bits */
		$key = "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3";  // or get any random key

		$plaintext = "Dilan"; //The STRING u want to ENCRYPT
		$valAES = self::aesEn($key,$plaintext); //Calling AES Encryption
		$valRSA = self::ntben($key,$publicKey); //Calling RSA eNCRYPTION
		$val2RSA = self::rsaDe($key,$valRSA); //calling RSA Decryption
		$val1AES = self::aesDe($key,$valAES); //Calling AES Decryption

		echo $valAES."|".$valRSA; //Cancandidanate Enctypted Values
		echo $val2RSA; //Decrypted RSA
		echo $val1AES; // Decrypted AES
	}


	/* (01) AES Encryption  */
	public function aesEn($key,$plaintext){

		$aes = new \Crypt_AES();
		//Setting the AES KEY 
		$aes->setKey($key); 
		//Setting the AES KEY as 256bit STRING
		$aes->setKeyLength(256);
		
		//AES Encrypting by above given STRING and AES KEY 
		$val1 = $aes->encrypt($plaintext);
		return $val1;
	}


	/* (02) RSA Encryption  */
	public function ntben($publicKey,$key){

		$rsa = new \Crypt_RSA();
		//Setting RSA Encryption MODE
		$rsa->setEncryptionMode("CRYPT_RSA_ENCRYPTION_PKCS1");
		//Setting the KEY that u want to encrypt
	    $rsa->loadKey($key);
	    //Encrypting the key using RSA PUBLIC KEY
	    $val2 = $rsa->encrypt($publicKey);
	    return $val2;

	}

	/* (03) RSA Decryption  */
	public function rsaDe($val2,$privateKey){
		
		$rsa = new \Crypt_RSA();
	    //Setting the RSA PRIVATE Key
	    $rsa->loadKey($privateKey);
	    //Decrypting the [(02 function)] RSA Encrypted value in RSA
	    $val4 = $rsa->decrypt($val2);
	    return $val4;
	}

	/* (04) AES Decryption  */
	public function aesDe($val2RSA,$valAES){
		
		$aes = new \Crypt_AES();
		//Setting the RSA Decypted Key(AES Key) as Decrypting key in AES
		$aes->setKey($val2RSA);
		//Decrypting the Encrypted value [(01) function] by using [(03) function] decrypted key
		$val3 = $aes->decrypt($valAES);
		return $val3;

	}

	

}
