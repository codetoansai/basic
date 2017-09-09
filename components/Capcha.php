<?php
/**
 * Created by PhpStorm.
 * User: Phong
 * Date: 6/28/2017
 * Time: 4:16 PM
 */

namespace app\components;


class Capcha
{
    private $key;
    public function __construct($key)
    {
        $this->key = $key;
    }
    public function UploadCaptcha($image)
    {
        $value = $this->bc_submit_captcha($this->key,  $image);
        return $value;
    }
    function bc_post_data($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;
    }

    // split fields
    function bc_split($data)
    {
        $ret = array();

        $lines = explode("\n", $data);
        if($lines)
        {
            foreach($lines as $line)
            {
                $x = trim($line);
                if(strlen($x) == 0) continue;

                $value = strstr($x, " ");
                $name = "";
                if($value === FALSE)
                {
                    $name = $x;
                    $value = "";
                }
                else
                {
                    $name = substr($x, 0, strlen($x) - strlen($value));
                    $value = trim($value);
                }
                $ret[$name] = $value;
            }
        }
        return $ret;
    }

    // return NULL if decode failed
    function bc_submit_captcha($key, $img_file_name)
    {
        global $bc_task_id;
        $bc_task_id = -1;

        // read image data of image
        $fp = fopen($img_file_name, "rb");
        if(!$fp) return NULL;
        $file_size = filesize($img_file_name);
        if($file_size <= 0) return NULL;
        $data = fread($fp, $file_size);
        fclose($fp);

        // use base64 encoding to encode it
        $enc_data = base64_encode($data);

        // submit it to server
        if(strlen($key) != 40 && strlen($key) != 32) return NULL;
        $data = $this->bc_post_data("http://bypasscaptcha.com/upload.php",
            array( "key" => $key, "file" => $enc_data, "submit" => "Submit",
                "gen_task_id" => 1, "base64_code" => 1));

        // dict
        $dict = $this->bc_split($data);

        if(array_key_exists("TaskId", $dict) && array_key_exists("Value", $dict))
        {
            $bc_task_id = $dict["TaskId"];
            return $dict["Value"];
        }
        return NULL;
    }

    // after using the captcha value, you can send the feedback
    function bc_submit_feedback($key, $is_input_correct)
    {
        global $bc_task_id;

        $this->bc_post_data("http://bypasscaptcha.com/check_value.php",
            array( "key" => $key, "task_id" => $bc_task_id,
                "cv" => ($is_input_correct ? 1 : 0),
                "submit" => "Submit"));
    }

    // get left number
    function bc_get_left($key)
    {
        $ret = $this->bc_post_data("http://bypasscaptcha.com/ex_left.php",
            array( "key" => $key ));
        $dict = $this->bc_split($ret);
        //print_r($dict);
        //return json_encode($dict);
        if(isset($dict['Left']))
            return $dict['Left'];
        else
            return 0;
    }
}