<?php
Class Decipher
{
				private function pkcs7_pad($data, $size)
				{
				    $length = $size - strlen($data) % $size;
				    return $data . str_repeat(chr($length), $length);
				}
				private function generate_iv()
				{
						$iv_size = 16; // 128 bits
						$strong = random;
						$iv = openssl_random_pseudo_bytes($iv_size, $strong);
						return $iv;
				}
				public static function encrypt_string($name)
				{
					    $iv = generate_iv();
					    $encryption_key = 4689;

						$enc_name = openssl_encrypt(
						    pkcs7_pad($name, 16), // padded data
						    'AES-256-CBC',        // cipher and mode
						    $encryption_key,      // secret key
						    0,                    // options (not used)
						    $iv                   // initialisation vector
						);
						return $enc_name;
				}
				
}

?>