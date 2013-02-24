<?php
/**
 * Validate
 * 
 * @author Keven Ages <kages@gmail.com>
 * @version 1.0
 * @since 1.0
 *
 */
class Validate{

	public static function valuesMatch($val1 = null, $val2 = 1, $friendlyName = null){
		if($val1 !== $val2){
			throw new Exception(sprintf(VALUES_MATCH, $friendlyName));
		}
	}

	public static function soldOut($current_total = 0, $max_buys = 0, $str_title = ''){
		if((0 != $max_buys) && ($current_total > $max_buys)){
			throw new Exception(sprintf(ERROR_SOLD_OUT, $str_title));
		}
	}

	public static function maxQuantity($quantity = 1, $max_quantity = 0){
		if(($max_quantity != 0) && ($quantity > $max_quantity)){
			throw new Exception(sprintf(ERROR_MAX_DEAL, $max_quantity));
		}
	}
	/**
	 * Validate a postal code
	 */
	public static function postalCode($code = null){
		$code = trim($code);
		preg_match(REGEX_POSTAL_CA, $code, $matches);
		if(empty($matches)){
			throw new Exception(sprintf(POSTAL_CODE_INVALID, $code));
		}
	}

	public static function phoneNumber($number = null){
		$number = trim($number);
		preg_match(REGEX_PHONE, $number, $matches);
		if(empty($matches)){
			throw new Exception(sprintf(PHONE_INVALID, $number));
		}
	}

	public static function emailAddress($email = null){
		$email = trim($email);
		preg_match(REGEX_EMAIL, $email, $matches);
		if(empty($matches)){
			throw new Exception(sprintf(EMAIL_INVALID, $email));
		}
	}

	public static function notEmpty($field = null, $friendlyName = null){
		$field = trim($field);
		preg_match(REGEX_NOT_EMPTY, $field, $matches);
		if(empty($matches)){
			throw new Exception(sprintf(EMPTY_VALUE, $friendlyName));
		}
	}

	public static function creditCard($card = null){
		$card = trim($card);
		preg_match(REGEX_CC_GENERAL, $card, $matches);
		if(empty($matches)){
			throw new Exception(INVALID_CREDIT_CARD);
		}
	}

	public static function creditCardMonthYear($month = null){
		$month = trim($month);
		preg_match(REGEX_CC_MONTH_YEAR, $month, $matches);
		if(empty($matches)){
			throw new Exception(INVALID_MONTH_YEAR);
		}
	}

	public static function creditCardCvv($cvv = null){
		$cvv = trim($cvv);
		preg_match(REGEX_CC_CVV, $cvv, $matches);
		if(empty($matches)){
			throw new Exception(INVALID_CVV);
		}
	}
	/**
	 * Public Static validateAmount
	 * Compares 2 values 
	 * @var amount 	float 	amount to compare
	 * @var cost  	float 	cost of product
	 * @throws 		Exception	if cost > amount
	 */
	public static function validateAmount($amount = null, $cost = null){
		if($amount && $cost){
			if($amount > $cost){
				throw new Exception(sprintf(AMOUNT_GREATER_THAN_COST, $amount, $cost));				
			}
		}
	}
	/**
	 * Like checkExpiry but with the inclusion of a fieldname for messaging.
	 */
	public static function checkExpiryUtil($end_date = null, $fieldName = null){
		if(strtotime($end_date) <= strtotime("now")){
			throw new Exception(sprintf(EXPIRED, $fieldName));
		}
	}
	/**
	 * Check to see if a deal is active and also not ended (<sarcasm>Cause you know, you need both</sarcasm>)
	 * @var 	end_date	end date of deal
	 * @var 	active 		deal is set to active/inactive
	 * @throws  Exception 	Deal has expired
	 */
	public static function checkExpiry($end_date = null){
		if(strtotime($end_date) <= strtotime("now")){
			throw new Exception(DEAL_EXPIRED);
		}
	}

	public static function activeDeal($active = 'inactive'){
		if($active === 'inactive'){
			throw new Exception(DEAL_EXPIRED);
		}
	}
}