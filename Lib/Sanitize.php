<?php
/**
 * Sanitize
 * 
 * @author Keven Ages <kages@gmail.com>
 * @version 1.0
 * @since 1.0
 *
 */
class Sanitize {
/**
 * Returns given string safe for display as HTML. Renders entities.
 *
 * @param string $string String from where to strip tags
 * @param boolean $remove If true, the string is stripped of all HTML tags
 * @return string Sanitized string
 * @access public
 * @static
 */
	public static function html($string, $remove = false) {
		if ($remove) {
			$string = strip_tags($string);
		} else {
			$patterns = array("/\&/", "/%/", "/</", "/>/", '/"/', "/'/", "/\(/", "/\)/", "/\+/", "/-/");
			$replacements = array("&amp;", "&#37;", "&lt;", "&gt;", "&quot;", "&#39;", "&#40;", "&#41;", "&#43;", "&#45;");
			$string = preg_replace($patterns, $replacements, $string);
		}
		return $string;
	}
/**
 * Sanitizes given array or value for safe input. Use the options to specify
 * the connection to use, and what filters should be applied (with a boolean
 * value). Valid filters: odd_spaces, encode, dollar, carriage, unicode, backslash.
 *
 * @param mixed $data Data to sanitize
 * @param mixed $options Set of options
 * @return mixed Sanitized data
 * @access public
 * @static
 */
	public static function clean($data, $options = array()) {
		if (empty($data)) {
			return $data;
		}

		$options = array_merge(array(
			'odd_spaces' => true,
			'encode' => true,
			'dollar' => true,
			'carriage' => true,
			'unicode' => true,
			'backslash' => true
		), $options);

		if (is_array($data)) {
			foreach ($data as $key => $val) {
				$data[$key] = self::clean($val, $options);
			}
			return $data;
		} else {
			if ($options['odd_spaces']) {
				$data = str_replace(chr(0xCA), '', str_replace(' ', ' ', $data));
			}
			if ($options['encode']) {
				$data = self::html($data);
			}
			if ($options['dollar']) {
				$data = str_replace("\\\$", "$", $data);
			}
			if ($options['carriage']) {
				$data = str_replace("\r", "", $data);
			}

			$data = str_replace("'", "'", str_replace("!", "!", $data));

			if ($options['unicode']) {
				$data = preg_replace("/&amp;#([0-9]+);/s", "&#\\1;", $data);
			}
			if ($options['backslash']) {
				$data = preg_replace("/\\\(?!&amp;#|\?#)/", "\\", $data);
			}
			return $data;
		}
	}
}