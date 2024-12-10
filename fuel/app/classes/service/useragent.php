<?php

/**
 * UserAgent Service
 */
class Service_Useragent extends Fuel\Core\Agent
{
	public static function _init()
	{
		parent::_init();

		// smartphone ua keywords
		$sp_list = [
			'iPhone',
			'iPod',
			'Android',
			'IEMobile',
			'dream',
			'CUPCAKE',
			'blackberry9500',
			'blackberry9530',
			'blackberry9520',
			'blackberry9550',
			'blackberry9800',
			'webOS',
			'incognito',
			'webmate'
		];

		$pattern = '/' . implode('|', $sp_list) . '/i';
		static::$properties['x_issmartphone'] = preg_match($pattern, static::$user_agent) ? true : false;

		// docomo
		static::$properties['x_isdocomo'] = preg_match('/DoCoMo/', static::$user_agent) ? true : false;

		// softbank
		static::$properties['x_issoftbank'] = preg_match('/Vodafone|J\-PHONE|MOT|SoftBank/', static::$user_agent) ? true : false;

		// au
		static::$properties['x_isau'] = preg_match('/UP\.Browser/', static::$user_agent) ? true : false;

		// feature phone
		static::$properties['x_isfeaturephone'] = (static::is_docomo() || static::is_softbank() || static::is_au());

		// ブラウザ情報
		$browser = static::get_browser_custom();
		// #ブラウザ名
		static::$properties['browser'] = $browser['name'];
		// #ブラウザのバージョン
		static::$properties['version'] = $browser['version'];
		// #ブラウザのレンダリングエンジン
		static::$properties['x_rendering_engine'] = $browser['rendering_engine'];

	}

	public static function is_smartphone()
	{
		$has_mozilla = (strstr(static::$user_agent, 'Mozilla') !== false);
		$has_android = (strstr(static::$user_agent, 'Android') !== false);
		$has_galaxy = (
			strstr(static::$user_agent, 'SC-01D') !== false
			|| strstr(static::$user_agent, 'SC-02D') !== false
			|| strstr(static::$user_agent, 'SC-01C') !== false
			|| strstr(static::$user_agent, 'A500') !== false
			|| !strstr(static::$user_agent, 'Mobile')
		);
		// galaxy tablet
		if ($has_mozilla && $has_android && $has_galaxy) {
			return false;
		}
		return static::$properties['x_issmartphone'];
	}

	public static function is_docomo()
	{
		return static::$properties['x_isdocomo'];
	}

	public static function is_softbank()
	{
		return static::$properties['x_issoftbank'];
	}

	public static function is_au()
	{
		return static::$properties['x_isau'];
	}

    public static function is_feature_phone()
    {
        return static::$properties['x_isfeaturephone'];
    }

	/**
	 * get_browser() custom method
	 * @return array
	 */
	public static function get_browser_custom(): array
	{

		$u_agent = static::$user_agent; // useragent
		$bname = static::$properties['browser']; // browser name
		$version = static::$properties['version']; // version
		$ub = ''; // browser identification name
		$rnd_engine = ''; // rendering engine name

		$is_msie = (bool)preg_match('/MSIE/i', $u_agent);
		$is_opera = (bool)preg_match('/Opera\//i', $u_agent);
		$is_sleipnir = (bool)preg_match('/Sleipnir\//i', $u_agent);
		$is_lunascape = (bool)preg_match('/Lunascape/i', $u_agent);
		$is_trident = (bool)preg_match('/Trident\//i', $u_agent);
		$is_rv = (bool)preg_match('/rv:/i', $u_agent);
		$is_gecko = (bool)preg_match('/like Gecko/i', $u_agent);
		$is_firefox = (bool)preg_match('/Firefox\//i', $u_agent);
		$is_chrome = (bool)preg_match('/Chrome\//i', $u_agent);
		$is_safari = (bool)preg_match('/Safari\//i', $u_agent);


		// get browser name
		if ($is_msie && !$is_opera && !$is_sleipnir && !$is_lunascape) {
			// ~IE10
			$bname = 'IE';
			$ub = 'MSIE';
		} else if ($is_trident && $is_rv && $is_gecko && !$is_opera && !$is_sleipnir && !$is_lunascape) {
			// IE11~
			$bname = 'IE';
		} else if ($is_firefox && !$is_sleipnir && !$is_lunascape) {
			// Firefox
			$bname = 'Firefox';
			$ub = 'Firefox';
		} else if ($is_chrome && !$is_sleipnir) {
			// Chrome
			$bname = 'Chrome';
			$ub = 'Chrome';
		} else if ($is_sleipnir) {
			// Sleipnir
			$bname = 'Sleipnir';
			$ub = 'Sleipnir';
		} else if ($is_opera || preg_match('/OPR\//i', $u_agent)) {
			// Opera
			$bname = 'Opera';
			$ub = 'Opera';
		} else if ($is_safari && !$is_lunascape) {
			// Safari
			$bname = 'Safari';
			$ub = 'Safari';
		} else if ($is_lunascape) {
			// Lunascape
			$bname = 'Lunascape';
			$ub = 'Lunascape';
		}

		// get browser version
		$known = ($ub != '') ? ['Version', 'rv', $ub] : ['Version', 'rv'];
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ :]+(?<version>[0-9.|a-zA-Z.]*)#'; // search pattern
		$result = preg_match_all($pattern, $u_agent, $matches); // search

		if ($result !== false && $result != 0) {
			// hit
			if (count($matches['browser']) > 1) {
				if ($ub != '') {
					$strpos_version = strripos($u_agent, 'Version');
					$strpos_rv = strripos($u_agent, 'rv');
					$strpos_ub = strripos($u_agent, $ub);
					$version_key_version = array_search('Version', $matches['browser']);
					$version_key_rv = array_search('rv', $matches['browser']);
					$version_key_ub = array_search($ub, $matches['browser']);

					if ($strpos_version !== false && $strpos_ub !== false) {
						if ($strpos_version < $strpos_ub) {
							$version = $matches['version'][$version_key_version];
						} else if ($ub == 'Opera') {
							$version = $matches['version'][$version_key_version];
						} else {
							$version = $matches['version'][$version_key_ub];
						}
					} else if ($strpos_rv !== false && $strpos_ub !== false) {
						$version = $matches['version'][$version_key_ub];
					}
				}
			} else {
				$version = $matches['version'][0];
			}
		}

		$is_apple_web_kit = (bool)preg_match('/AppleWebKit\//i', $u_agent);

		// get rendering engine name
		if ($bname == 'IE') {
			$rnd_engine = 'Trident';// #IE
		} else if ($bname == 'Firefox') {
			$rnd_engine = 'Gecko';// #Firefox
		} else if ($bname == 'Chrome') {
			$rnd_engine = (static::compare_version_num($version, '28.0') >= 0) ? 'Blink' : 'WebKit';
		} else if ($bname == 'Sleipnir') {
			// Sleipnir
			if (static::compare_version_num($version, '4.3.0') >= 0) {
				$rnd_engine = 'Blink';
			} elseif (static::compare_version_num($version, '3.5.0.4000') >= 0) {
				$rnd_engine = ($is_apple_web_kit) ? 'WebKit' : 'Trident';
			} else {
				$rnd_engine = ($is_gecko) ? 'Gecko' : 'Trident';
			}
		} else if ($bname == 'Opera') {
			// Opera
			$rnd_engine = (static::compare_version_num($version, '15.0') >= 0) ? 'Blink' : 'Presto';
		} else if ($bname == 'Safari') {
			// Safari
			$rnd_engine = 'WebKit';
		} else {
			// etc
			if ($is_apple_web_kit) {
				$rnd_engine = 'WebKit';
			} else if ($is_gecko) {
				$rnd_engine = 'Gecko';
			} else if ($is_trident) {
				$rnd_engine = 'Trident';
			}
		}
		return [
			'name' => $bname,
			'version' => $version,
			'rendering_engine' => $rnd_engine,
		];
	}

	/**
	 * compare_version_num
	 * バージョン番号の比較
	 * @access public static
	 * @return array
	 */
	protected static function compare_version_num($version1, $version2)
	{
		// 比較結果
		// #より大きい（最初のバージョン（$version1）が大きい）
		$op_gt = 1;
		// #等しい
		$op_eq = 0;
		// #より小さい（最初のバージョン（$version1）が小さい）
		$op_lt = -1;

		//バージョン内の番号の比較回数
		$compare_turn = 0;
		//比較結果
		$compare_result = '';
		//バージョン内の番号数が多い方のバージョン
		$longer_version = '';

		//バージョン文字列をドットへ置換
		$version1 = trim(preg_replace('/(-|_|\+)/', '.', $version1));
		$version2 = trim(preg_replace('/(-|_|\+)/', '.', $version2));

		//バージョン番号が共に等しい場合、等しいを返す
		if ($version1 == $version2) {
			return $op_eq;
		}

		// 配列へ変換
		$version1_array = explode('.', $version1);
		$version2_array = explode('.', $version2);

		// 各バージョンの配列の要素数を設定
		$version1_element_num = count($version1_array);
		$version2_element_num = count($version2_array);

		// バージョンの番号数が少ない側の要素数を比較回数として設定
		// 最初のバージョンの要素数が比較対象のバージョンより多い場合
		if ($version1_element_num > $version2_element_num) {
			$compare_turn = $version2_element_num;
			$longer_version = 'version1';
		} // 最初のバージョンの要素数が比較対象のバージョンより少ない場合
		elseif ($version1_element_num < $version2_element_num) {
			$compare_turn = $version1_element_num;
			$longer_version = 'version2';
		} // 要素数が等しい場合
		else {
			$compare_turn = $version1_element_num;
		}

		// バージョンの番号の比較
		for ($i = 0; $i < $compare_turn; $i++) {
			// バージョン内の番号を取得（int型へキャスト）
			$version1_num = (int)$version1_array[$i];
			$version2_num = (int)$version2_array[$i];

			// 最初のバージョンの番号が比較対象のバージョンの番号より大きい場合
			if ($version1_num > $version2_num) {
				// 比較結果「より大きい」を設定
				$compare_result = $op_gt;
				break;
			} elseif ($version1_num < $version2_num) {
				// 比較結果「より小さい」を設定
				$compare_result = $op_lt;
				break;
			} else {
				// 比較結果「等しい」を設定
				// ※次の番号比較を続行
				$compare_result = $op_eq;
			}
		}

		// バージョンの比較結果が等しく、かつ、片方のバージョンの番号が残っている場合
		if ($compare_result == $op_eq && $longer_version != '') {
			while ($i < count(${$longer_version . '_element_num'})) {
				// バージョン内の番号を取得（int型へキャスト）
				$longer_version_num = (int)$longer_version[$i];

				// バージョン内の番号が0でない場合
				if ($longer_version_num != 0) {
					// 最初のバージョンの場合
					if ($longer_version == 'version1') {
						//比較結果「より大きい」を設定
						$compare_result = $op_gt;
						break;
					} // 比較対象のバージョンの場合
					elseif ($longer_version == 'version2') {
						// 比較結果「より小さい」を設定
						$compare_result = $op_lt;
						break;
					}
				} // バージョン内の番号が0の場合
				else {
					// 比較結果「等しい」を設定
					// ※次の番号チェックを続行
					$compare_result = $op_eq;
				}
				$i++;
			}
		}

		return $compare_result;
	}
}
