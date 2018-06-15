<?php

namespace common\lib;

use Yii;
use common\models\FoodIngredients ;
use common\lib\CommonMailer;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SiteUtil {
    const STATUS_DELETED = 2;
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const FILE_TYPE_YES = 1;
    const FILE_TYPE_NO = 2;
    const FILE_TYPE_GOOD = 1;
    const FILE_TYPE_AV = 2;
    const FILE_TYPE_POOR = 3;
    const PETROL    =   1;
    CONST DIESEL    =   2;
    /*
     * Function for image save in multiple sizes
     */
    public static function getresizedimage($name,$size=null){
        
        if(\Yii::$app->params['islive'] == 0){
            $filepath = 'https://farmeruncle.com/images/';
        } else{
            $filepath = Yii::$app->params['frontendUrl'].'images/';
        }
        if(!empty($name)){
            if(!empty($size)){
               
                $_img_extn = explode('.', $name);
                if($size == '60')
                  return $filepath.'thumb_60/'.$_img_extn[0].'_x60.'.$_img_extn[1];
                else if($size=='480')
                     return $filepath.'thumb_480/'.$_img_extn[0].'_x480.'.$_img_extn[1];
                else if($size=='600')
                     return $filepath.'thumb_600/'.$_img_extn[0].'_x600.'.$_img_extn[1];
                else if($size=='300')
                     return $filepath.'thumb_300/'.$_img_extn[0].'_x300.'.$_img_extn[1];
                else
                    return $filepath.'original/'.$name;
            }else{
                return $filepath.'original/'.$name;
            }
        }
        else{
            return $filepath.'images/default-cover.jpg';
        }
    }
    
  /*
   * Function for Show Starclass
   */  

    public static function getStarClass($rating){ 
        switch ($rating){
            case (($rating < 1) && ($rating > 0)) :
                return 'half-star';
                break;
            case ($rating == 1):
                return 'one-star';
                break;
            case (($rating < 2) && ($rating > 1)) :
                return 'onehalf-star';
                break;
            case ($rating == 2):
                return 'two-star';
                break;
            case (($rating < 3) && ($rating > 2)) :
                return 'twohalf-star';
                break;
            case ($rating == 3):
                return 'three-star';
                break;
            case (($rating < 4) && ($rating > 3)) :
                return 'threehalf-star';
                break;
            case ($rating == 4):
                return 'four-star';
                break;
            case (($rating < 5) && ($rating > 4)) :
                return 'fourhalf-star';
                break;
            case ($rating == 5):
                return 'five-star';
                break; 
        }
    }  
   /*
    * function for Send message
    */
    public static function sendMessage($phone_no,$message){
        $request =""; //initialise the request variable
        
        $param['user']= "saazid";
        $param['pass'] = '12345';
        $param['sender'] = 'FARMER';
        $param['phone'] = $phone_no;
        $param['text'] = $message;
        $param['priority'] = "ndnd";//2000142951//2000147496
        $param['password'] = "5Lk9TdYmn";//5H1TTppOB//v7S5MmTxC
        $param['stype'] = "normal";
        foreach($param as $key=>$val) {
        $request.= $key."=".urlencode($val);
        //we have to urlencode the values
        $request.= "&";
        //append the ampersand (&) sign after each parameter/value pair
        }
        
        $request = substr($request, 0, strlen($request)-1);
        //remove final (&) sign from the request
        //echo $request;die;
        $url =
        "http://sms.logixgrid.com/api/sendmsg.php?"
        .$request;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
 //       echo '<pre>';        print_r($curl_scraped_page); die();
        curl_close($ch);
        //echo $curl_scraped_page;die;
        return 'sucess'; 
    }
    /*
     * Generate randam number for security code
     */
    public static function generateRandomNumber(){
        $characters = '0123456789';
        $code = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 5; $i++) {
            $rand_str = $characters[mt_rand(0, $max)];
            $code .= $rand_str;
        }
        return $code;
    }
    /*
     * Check parameter is empty or not
     */
    public static function isNotEmptyWithParams($dataarray, $param) {
        return isset($dataarray[$param]) && !empty($dataarray[$param]);
    }
    public static function isNotEmpty($param) {
        return isset($param) && !empty($param);
    }
    
    public static function makecomma($input) {
        if (strlen($input) <= 2) {
            return $input;
        }
        $length = substr($input, 0, strlen($input) - 2);
        $formatted_input = SiteUtil::makecomma($length) . "," . substr($input, -2);
        return $formatted_input;
    }
    public static function Getmoneyformat($num,$flag) {

          if (strpos($num, '.') !== false) {
              $decimal = explode(".", (string) $num);
              $flag = true;
          }
          $num = (int) $num;
          $pos = strpos((string) $num, ".");
          if (strlen($num) > 3 & strlen($num) <= 12) {
              $last3digits = substr($num, -3);
              $numexceptlastdigits = substr($num, 0, -3);
              $formatted = SiteUtil::makecomma($numexceptlastdigits);
              $stringtoreturn = $formatted . "," . $last3digits;
          } elseif (strlen($num) <= 3) {
              $stringtoreturn = $num;
          } elseif (strlen($num) > 12) {
              $stringtoreturn = number_format($num, 2);
          }
          if (substr($stringtoreturn, 0, 2) == "-,") {
              $stringtoreturn = "-" . substr($stringtoreturn, 2);
          }
          if ($flag != 112) {
              return $stringtoreturn;
          } else {
              if(isset($decimal[1])){
                   if (strlen($decimal[1]) < 2)
                       return $stringtoreturn . '.' . $decimal[1] . '0';
                   else
                       return $stringtoreturn . '.' . $decimal[1];
              }else{
                  return $stringtoreturn.'.00';
              }
          }
      }     
      
    public static function getIndianCurrency($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise ;
    }
    /*
     * string to urlencode
     */
    public static function getUrlFormate($name){
        $cstring = str_replace(' & ', '-', $name);
        $cstring = str_replace('  -  ', '-', $cstring);
        $cstring = str_replace('  - ', '-', $cstring);
        $cstring = str_replace('---', '-', $cstring);
        $cstring = str_replace('--', '-', $cstring);
        $cstring = str_replace(' ', '-', $cstring);
        $cstr= strtolower($cstring);
        return $cstr;        
    }
    public static function getStatusList()
    {
        $statusArray = [
            self::STATUS_ACTIVE     => 'Active',
            self::STATUS_NOT_ACTIVE => 'Inactive',
            self::STATUS_DELETED    => 'Deleted'
        ];

        return $statusArray;
    }
    public static function getFileTypeList($status)
    {
       if($status == self::FILE_TYPE_YES){
            $statusArray = [
                self::FILE_TYPE_YES => 'Yes',
                self::FILE_TYPE_NO  => 'No'
            ];
       }else{
            $statusArray = [
                self::FILE_TYPE_GOOD     => 'Good',
                self::FILE_TYPE_AV => 'Average',
                self::FILE_TYPE_POOR => 'Poor'
            ];
       }

        return $statusArray;
    }
    public static function getFuelType()
    {
        $statusArray = [
            self::STATUS_ACTIVE     => 'Petrol',
            self::STATUS_DELETED => 'Diesel'
        ];

        return $statusArray;
    }
    public static function getYearList()
    {
        $statusArray = [];
        $startYear = date('Y', time());
        $lastYear = \Yii::$app->params['baseYear'];

        for($i = $startYear; $i >= $lastYear; $i--){
            $statusArray[$i] = $i ;
        }
        return $statusArray;
    }
    public static function getTypeName($status,$val)
    {
       if($status == self::FILE_TYPE_YES){
            if($val == self::FILE_TYPE_YES){
                $name = 'Yes';
            }else{
                $name = 'No';
            }
       }else{
           if($val == self::FILE_TYPE_GOOD){
                $name = 'Good';
            }elseif($val == self::FILE_TYPE_AV){
                $name = 'Average';
            }else{
                $name = 'Poor';
            }
       }

        return $name;
    }
}
