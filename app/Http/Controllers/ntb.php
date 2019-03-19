<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Crypt_RSA;
use Crypt_AES;


class ntb extends Controller {



public function phpEn(){
	$plaintext = 'Dilan';
	$Randomkey = '3sc3RLrpd17'; // need to add random genarated key

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
		

	// CBC has an IV and thus needs randomness every time a message is encrypted
	$method = 'aes-256-cbc';

	// Must be exact 32 chars (256 bit)
	// You must store this secret random key in a safe place of your system.
	$key = substr(hash('sha256', $Randomkey, true), 0, 32);
	

	// Most secure key
	//$key = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));

	// IV must be exact 16 chars (128 bit)
	$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

	// Most secure iv
	// Never ever use iv=0 in real life. Better use this iv:
	// $ivlen = openssl_cipher_iv_length($method);
	// $iv = openssl_random_pseudo_bytes($ivlen);

	// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
	$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv));

	// My secret message 1234
	$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $key, OPENSSL_RAW_DATA, $iv);

	echo 'plaintext=' . $plaintext . "\n";
	echo 'cipher=' . $method . "\n";
	echo 'encrypted to: ' . $encrypted . "\n";
	echo 'decrypted to: ' . $decrypted . "\n\n";

	echo "</br>";


	$test = "HjA748u8F/xHKUZL8aZOckgYEfsO9k9tuWmjf9zo23DrxB0vCTZkCtMkkB3sMyxmH/IQAzSz/J1QXvUvrmpuztaYYZrHrW7JqWLtTm3qAdakUY4zjumpk2MoECwm6QUI6x4CIdVs2mld6bCahXfjDipoBoHAKMzLs9NXk8IiMcM=";
	$valRSA = self::rsaDe($test,$privateKey);
		echo "</br>".$valRSA;
}






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
		$key ="3sc3RLrpd17";// "6BCD0D46F786491688FAC17C5F27A181";  // or get any random key

		$plaintext = "Dilan"; //The STRING u want to ENCRYPT
		$valAES = self::aesEn($key,$plaintext); //Calling AES Encryption
		$valRSA = self::ntben($key,$publicKey); //Calling RSA eNCRYPTION
		$val2RSA = self::rsaDe($key,$valRSA); //calling RSA Decryption
		$val1AES = self::aesDe($key,$valAES); //Calling AES Decryption

	//	echo $valAES."*-*-*-*|".$valRSA; //Cancandidanate Enctypted Values
	//	echo $val2RSA; //Decrypted RSA
		echo base64_encode($valRSA); // Decrypted AES
	}


	/* (01) AES Encryption  */
	public function aesEn($key,$plaintext){

		$aes = new \Crypt_AES();
		//Setting the AES KEY 
		$aes->setKey($key); 
		$aes->setBlockLength(0x80);
		$aes->setIV("6BCD0D46F786491688FAC17C5F27A181");

		//Setting the AES KEY as 256bit STRING
		$aes->setKeyLength(256);
		
		
		//AES Encrypting by above given STRING and AES KEY 
		$val1 = $aes->encrypt($plaintext);
		return $val1;
	}


	/* (02) RSA Encryption  */
	public function ntben($key,$publicKey){

		$rsa = new \Crypt_RSA();
		//Setting RSA Encryption MODE
		$rsa->setEncryptionMode("CRYPT_RSA_ENCRYPTION_PKCS1"); 
		//Setting the KEY that u want to encrypt
	    $rsa->loadKey($publicKey);
	    //Encrypting the key using RSA PUBLIC KEY
	    $val2 = $rsa->encrypt($key);
	    return base64_encode($val2);

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
