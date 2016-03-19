<?php
class MyEncryption {

    public static function generate_salt($length)
    {
        $unique_random_string = md5(uniqid(mt_rand(),true));
        $base64_string = base64_encode($unique_random_string);
        $modified_base64_string = str_replace("+",".",$base64_string);
        $salt = substr($modified_base64_string,0,$length);
        return $salt;
    }
    public static function password_encrypt($password)
    {
        $hash_format = "$2y$11$"; //use blowfish and has 2^11 times
        $salt_length = 22;
        $salt = MyEncryption::generate_salt($salt_length);
        $format_and_salt = $hash_format . $salt;
        $hash = crypt($password,$format_and_salt);
        return $hash;
    }

    public static function password_check($password,$existing_hash){
        $hash = crypt($password,$existing_hash);
        return $hash == $existing_hash;
    }


}