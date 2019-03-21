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
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGAb1kOI/0aD04EL6br
X81csy3xaSAKOezF1n/g+mbyTR4rYQMWl4QMiG8XHx8E1KgERNjenbwePO0YcqH0
FJP01sDPfiqleLK7FcoXJ00K9COcBCOzBf3OlSmpGYaPQ00O9pMGxXjyOc8a/wef
//dPXIeXBeTxMrkR99vScWyck5ECAwEAAQKBgEhyGNExjBMJH5AhemMKqpWp/rf3
MLAfbVjyOt6wvFWQm4izCa/rKnxaSyDkfbAe4SgqMi1OiB375TwwQy5gVZvEVQvc
rWlEHsDY/XA+QAfmChoIeqdqF6WO1nEkcYI6hiHNpJT4988k6wZ9uO5HXt5+bA/s
BWPSgk4z35ZYacABAkEAzSih4lMrHGBRq6PJPvYGevP8WbKAnQwERYi25K2zAIUr
UdSWVVOQ7UjuVC1Tfw1Hg57Wal+/jTXjUcmRPgJr0QJBAIrxBIV0wMENmZ0qBKYk
pTFvEP7OkgeGoGn2T6Smo4jo6lr/cuBNDldWRXtBnG0JRoCwJn8lq+U4AWLa/mSW
W8ECQQCLMPYkR6kIJ5FBkm4HeYQMB10+vgzkgDKluovbur2nrLInYsRcP8YkN0b7
dYUgvjG26x0uLqgXdmg0JT2VhK8BAkAP8m3Ua3wcLFVvRn1WHGqha+AFfuwf1QHg
Z5bojP/EHQeY/izPNcjpmUtMRFGR6jifWJhyi35ZRr5R/FSqct+BAkEAkeZ+2rPq
ijIf0uW7MK7v9OHw7+eecPxXbbZAlDNxIUZeMdPuAR/JBUPPS2rqvIb0BJG28dwy
aSAIaSfxqJoH4g==
-----END RSA PRIVATE KEY-----";

		/* Public Key for RSA Encryption and Decryption - U can genarate these from online. */
		$publicKey = "-----BEGIN PUBLIC KEY-----
MIGeMA0GCSqGSIb3DQEBAQUAA4GMADCBiAKBgG9ZDiP9Gg9OBC+m61/NXLMt8Wkg
CjnsxdZ/4Ppm8k0eK2EDFpeEDIhvFx8fBNSoBETY3p28HjztGHKh9BST9NbAz34q
pXiyuxXKFydNCvQjnAQjswX9zpUpqRmGj0NNDvaTBsV48jnPGv8Hn//3T1yHlwXk
8TK5Effb0nFsnJORAgMBAAE=
-----END PUBLIC KEY-----";
		
		/* Key for AES Encryption - 256bit - U can either use 128 to 256 bits */
		//$key = "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3";  // or get any random key
		$key = "Q+vDrDhVtIWkzC35on/v07dslaTEEsgPJOP2n4ZmYJUSrFVDsZKJKyaudvIHc9zA3OL342wR6McEwPWI76abZuXsxOdhffkuDdP2cVeQifCUpqaQAxCwHo7XMQ6hsmGjDiu8ky7j//KMRmf9qPwPfAyoyB14aCFX9vy2r3bRkkw=";
		//$plaintext = "Dilan"; //The STRING u want to ENCRYPT
		//$valAES = self::aesEn($key,$plaintext); //Calling AES Encryption
		//$valRSA = self::ntben($key,$publicKey); //Calling RSA eNCRYPTION
		$val2RSA = self::rsaDe($key,$privateKey); //calling RSA Decryption
		//$val1AES = self::aesDe($key,$valAES); //Calling AES Decryption

		echo $val2RSA;

		//echo $valAES."*-*-*-*|".$valRSA; //Cancandidanate Enctypted Values
		//echo $val2RSA; //Decrypted RSA
		//echo $val1AES; // Decrypted AES
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
