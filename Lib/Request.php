<?php
/**
 * Request
 * 
 * @author Keven Ages <kages@gmail.com>
 * @version 1.0
 * @since 1.0
 *
 */
class Request {
	/**
	 * Returns true if the current call a POST request
	 *
	 * @return boolean True if call is a POST
	 * @access public
	 */
	function isPost() {
		return (strtolower(getenv('REQUEST_METHOD')) == 'post');
	}
	/**
	 * Returns true if the current call a PUT request
	 *
	 * @return boolean True if call is a PUT
	 * @access public
	 */
	function isPut() {
		return (strtolower(getenv('REQUEST_METHOD')) == 'put');
	}
	/**
	 * Returns true if the current call a GET request
	 *
	 * @return boolean True if call is a GET
	 * @access public
	 */
	function isGet() {
		return (strtolower(getenv('REQUEST_METHOD')) == 'get');
	}
	/**
	 * Returns true if the current call a DELETE request
	 *
	 * @return boolean True if call is a DELETE
	 * @access public
	 */
	function isDelete() {
		return (strtolower(getenv('REQUEST_METHOD')) == 'delete');
	}
	/**
	 * Returns true if user agent string matches a mobile web browser, or if the
	 * client accepts WAP content.
	 *
	 * @return boolean True if user agent is a mobile web browser
	 * @access public
	 */
	function isMobile() {
		preg_match('/' . MOBILE_AGENT . '/i', getenv('HTTP_USER_AGENT'), $match);
		if (!empty($match)) {
			return true;
		}
		return false;
	}
	/**
	 * Returns true if the current HTTP request is Ajax, false otherwise
	 *
	 * @return boolean True if call is Ajax
	 * @access public
	 */
	function isAjax() {
		return getenv('HTTP_X_REQUESTED_WITH') === "XMLHttpRequest";
	}
}