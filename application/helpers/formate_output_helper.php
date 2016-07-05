<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// 自定义格式化输出的函数
	function p($arr){
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		die;
	}
	/**
	 * 成功跳转函数
	 * @param [type] $url 跳转地址
	 * @param [type] $msg 提示信息
	 */
	function s($url,$msg){
		header('Content-Type:text/html;charset=utf-8');
		$url = base_url($url);
		$str="<script type='text/javascript'>alert('$msg');";
		$str.="location.href='$url';</script>";
		echo $str;die;
	}
	/**
	 * 失败跳转函数
	 * @param [type] $msg 提示信息
	 */
	function e($msg){
		header('Content-Type:text/html;charset=utf-8');
		echo "<script type='text/javascript'>alert('$msg');window.history.back();</script>";
		die;
	}