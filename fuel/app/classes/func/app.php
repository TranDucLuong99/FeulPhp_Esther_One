<?php

use Fuel\Core\Uri;

class Func_App
{
	/**
	 * @return string
	 * リモートIPを取得する
	 */
	public static function real_ip()
	{
		$ip = '';

		// ロードバランサーを経由したときだけ取得する
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			$ip_array = explode(',', $ip);
			$ip = $ip_array[0];
		} else {
			$ip = Input::real_ip();
		}
		return $ip;
	}

	/**
	 * IPアドレスが社内のものかどうかをチェックする
	 * @return bool
	 */
	public static function chk_ip(): bool
	{
		// IPアドレス取得
		$ip = self::real_ip();

		// 社内IPアドレス
		$agent_ip = Config::get('app.agent_login_ip');

		return in_array($ip, $agent_ip);
	}

	/**
	 * trim_fespace
	 * 前後の空白を削除する
	 * return string
	 * */
	public static function trim_fespace($target = '')
	{
		$ret = '';
		$ret = preg_replace('/^[\s|　]+|[\s|　]+$/u', '', $target);

		return $ret;
	}
}
