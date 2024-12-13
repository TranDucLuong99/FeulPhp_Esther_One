<?php

use Aws\S3\S3Client;
use GuzzleHttp\Stream\Stream;
use Fuel\Core\Config;

/* Func_File
 * aws SDKを利用してファイルの読み書きを行う
 */

class Func_File
{
	/**
	 * @param string $file_path
	 * 
	 * @return boolean
	 */
	public static function delete(string $file_path = '')
	{

		$ret = FALSE;

		if (!empty($file_path)) {
			try {
				// aws s3オブジェクトの生成
				$s3 = new S3Client(Config::get('app.aws_sdk'));
				$s3->deleteObject(array(
					'Bucket' => Config::get('app.aws_sdk.bucket'),
					'Key'    => ltrim($file_path, '/')			// 頭の[/]は削除
				));
				$ret = TRUE;
			} catch (Exception $e) {
				Log::error($e, 'AWS S3 オブジェクト削除エラー');
			}
		}
		return $ret;
	}

	/**
	 * @param string $path
	 * 
	 * @return boolean
	 */
	public static function isAnimationGif(string $path)
	{
		$fp = fopen($path, 'rb');
		$filecontent = fread($fp, filesize($path));
		fclose($fp);
		//アニメーションgif
		return	strpos($filecontent, chr(0x21) . chr(0xff) . chr(0x0b) . 'NETSCAPE2.0') === FALSE ? false : true;
	}

	/**
	 * @param string $file_name
	 * @param string $from_path
	 * @param string $to_path
	 * @param ?string $new_name
	 * @param boolean $ws_delflg
	 * 
	 * @param 第5引数⇒Webサーバーの画像を消すかどうかのフラグ（初期値はtrue）
	 * @return boolean
	 */
	public static function move($file_name = '', $from_path = '', $to_path = '', $new_name = null, $ws_delflg = true)
	{
		// 初期化
		$ret = FALSE;
		if (empty($file_name) || empty($from_path) || empty($to_path)) {
			return $ret;
		}

		// リネームの必要が有る場合（第四引数に値が入っている場合）
		if (!empty($new_name)) {
			$key = $to_path . $new_name;
		} else {
			$key = $to_path . $file_name;
		}
		// 画像タイプを取得
		$pathinfo = pathinfo($from_path . $file_name);
		if (!empty($pathinfo['extension'])) {
			$mimetype = 'image/' . str_replace('JPG', 'jpeg', str_replace('jpg', 'jpeg', $pathinfo['extension']));
		} else {
			if (!empty($new_name)) {
				$exts = explode('.', $new_name);
			} else {
				$exts = explode('.', $file_name);
			}

			$extt = $exts[1];
			$mimetype = 'image/' . str_replace('JPG', 'jpeg', str_replace('jpg', 'jpeg', $extt));
		}

		// 画像以外の場合
		if (
			str_replace('image/', '', $mimetype) !== 'jpeg'
			&& str_replace('image/', '', $mimetype) !== 'JPEG'
			&& str_replace('image/', '', $mimetype) !== 'png'
			&& str_replace('image/', '', $mimetype) !== 'PNG'
			&& str_replace('image/', '', $mimetype) !== 'gif'
			&& str_replace('image/', '', $mimetype) !== 'GIF'
		) {
			$mimetype = '';
		}

		$s3 = new S3Client(Config::get('app.aws_sdk'));

		$put_object_param = [
			'Bucket'        => Config::get('app.aws_sdk.bucket'),
			'Key'           => ltrim($key, '/'),
			'Body'          => Stream::factory(file_get_contents($from_path . $file_name)),
			'ACL'           => 'public-read-write',
		];

		if ($mimetype !== '') {
			$put_object_param['ContentType'] = $mimetype;
		}

		$s3->putObject($put_object_param);

		//第5引数がtrueまたは何も無いときはwebサーバー上の画像を削除
		if ($ws_delflg) {
			\Func_File::delete(str_replace('https://' . Config::get('app.aws_sdk.bucket'), '', $from_path) . $file_name);
		}

		$ret = TRUE;
		return $ret;
	}
}
