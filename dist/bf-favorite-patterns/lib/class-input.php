<?php

namespace BFBase;


class Input extends BaseObject {

	/**
	 * $_GETの内容をコピーして保持する
	 */
	private $get;
	
	/**
	 * $_POSTの内容をコピーして保持する
	 */
	private $post;

	/**
	 * $_REQUESTの内容をコピーして保持する
	 */
	private $request;	
	

	function __construct() {}
	
	function get($key = null) {
		if ( ! is_null($key) && isset($_GET[$key])) {
			return $_GET[$key];
		}
		return $_GET;
	}
	
	function post($key = null) {
		if ( ! is_null($key) && isset($_POST[$key])) {
			return $_POST[$key];
		}
		return $_POST;
	}	
	
	function request($key = null) {
		if ( ! is_null($key)) {
			return $this->request[$key];
		}
		return $_REQUEST;
	}	

}