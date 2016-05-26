<?php
namespace Home\Util;

//随机生成字符串类
class RandomStr{
	/**
	 +----------------------------------------------------------
	 * 生成随机字符串
	 +----------------------------------------------------------
	 * @param int       $length  要生成的随机字符串长度
	 * @param string    $type    随机码类型：0，数字+大小写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；5，数字+大小写字母+特殊字符
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 */
	public function rand_code($length = 5, $type = 0) {
		$arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
		if ($type == 0) {
			array_pop($arr);
			$string = implode("", $arr);
		} elseif ($type == "-1") {
			$string = implode("", $arr);
		} else {
			$string = $arr[$type];
		}
		$count = strlen($string) - 1;
		$code = '';
		for ($i = 0; $i < $length; $i++) {
			$code .= $string[rand(0, $count)];
		}
		return $code;
	}
}