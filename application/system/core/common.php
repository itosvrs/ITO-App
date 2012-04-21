<?php
/**
* 
* @version 1.0
* @author Justin Wilson <justin@itrackoffers.com>
* @copyright Copyright (c) 2012, iTrack Solutions, LLC.
* @license This script and any files it may cooperate with may not be redistributed, 
* used or modified in any way without written permission from its rightful author.
* 
* This file was called via kickstart.php (application/kickstart.php). common.php will contain
* common functions to use within our application.
* 
*/

function escape($string)
{
    if (!is_array($string))
    {
        // Magic Quotes
        if (get_magic_quotes_gpc())
        {
                //$string = stripslashes($string);
        }

        // Protect from SQL injection
        $string = mysql_real_escape_string($string);
        /*if (function_exists('mysql_real_escape_string'))
        {
                $string = mysqli_real_escape_string($string);
        }
        else
        {
                $string = addslashes($string);
        }*/

        // Trim string
        $string = trim($string);

        return $string;
    }
}

function output($string)
{
    if (!empty($string) && !is_array($string))
    {
        $string = htmlentities($string);
        $string = str_replace('\r\n', "\r\n", $string);
        $string = stripslashes($string);
    }

    return $string;
}

function input_output($string)
{
    if (!empty($string) && !is_array($string))
    {
        $string = str_replace('\r\n', "\r\n", $string);
        $string = stripslashes($string);
    }

    return $string;
}

function timeStamp()
{
    return date('m-d-y h:i:s a');
}

function val_int($string, $cash = false)
{
    if ($cash == true)
    {
        if (abs($string) && is_numeric($string))
                return true;
    }
    else
    {
        if (abs($string) && is_numeric($string) && ctype_digit($string))
                return true;
    }
    
    return false;
}

function val_username($username)
{
    if (!preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/', $username))
            return false;
    else
            return true;
}

function val_name($name)
{
    if (!preg_match("#^[-A-Za-z' ]*$#", $name))
        return false;
    
    return true;
}

function val_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        return false;
    
    return true;
}

function val_url($url)
{
    if (!filter_var($url, FILTER_VALIDATE_URL))
        return false;
    
    return true;
}

function val_ip($ip)
{
    if (!filter_var($ip, FILTER_VALIDATE_IP))
        return false;
    
    return true;
}

function val_address($string)
{
    if (!preg_match('/^[A-Z0-9 \'.-]{1,255}$/i', $string))
        return false;
    
    return true;
}

function rand_string($length)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $str = '';
    $size = strlen($chars);
    for ($i=0; $i < $length; $i++)
    {
            $str .= $chars[rand(0, $size-1)];
    }

    return $str;
}

function messages($msg, $type)
{
    $_SESSION['msg'] = base64_encode($msg);
    $_SESSION['msg_type'] = $type;
}

function debug($array, $exit = false)
{
    // Start time
    $start = explode(' ', microtime());
    $start = $start[1] + $start[0];
    
    // Display debug info
    echo '<b>Debug Start</b><br />';
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    
    $end = explode(' ', microtime());
    $end = $end[1] + $end[0];
    $end = round(($end - $start), 4);
    
    echo '<b>Debug End - Page generated in \''.$end.' second(s)\'</b><br />';
    
    // If exit was set, lets exit the page
    if ($exit == true)
        exit;
}

function delete_dir($dirname)
{
    if (is_file($dirname)) return unlink($dirname);

    // Loop the files so we may unlink them
    $dir = dir($dirname);
    while(false !== $entry = $dir->read())
    {
        // Continue the process
        if ($entry == '.' || $entry == '..') continue;

        // Remove all the files in root
        if (is_file($dirname . '/' . $entry))
        {
                // Remove files
                unlink($dirname . '/' . $entry);
        }

        // Remove sub directories & everything in it
        if (is_dir($dirname . '/' . $entry))
        {
                // Remove files
                delete_dir($dirname . '/' . $entry, 1);

                // Remove directory
                rmdir($dirname . '/' . $entry);
        }
    }
    $dir->close();

    // Now that everything is empty, lets remove the main directory..
    rmdir($dirname);
}

function string_encrypt($string, $key, $base64=true)
{
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $string, MCRYPT_MODE_ECB, $iv);

    if ($base64==true)
        return trim(base64_encode($encrypted));
    else
        return trim($encrypted);
}

function string_decrypt($hash, $key, $base64=true)
{
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    if ($base64==true)
        $decrypted = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, base64_decode($hash), MCRYPT_MODE_ECB, $iv);
    else
        $decrypted = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $hash, MCRYPT_MODE_ECB, $iv);

    return trim($decrypted);
}