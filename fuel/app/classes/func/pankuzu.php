<?php

/**
 * パンくずを作成する
 *
 * 使い方
 * インスタンス化する
 * add()で随時、パンくずの階層を追加していく
 * コントローラのbefore()でインスタンス化して途中のメソッドなどでadd()してafter()でrender()する感じ
 */

class Func_Pankuzu
{
	/** @var array<array{name: string, url: string}> | array{} パンくず用配列 */
	private $pankuzu_list = [];

	/**
	 * パンくずリストにパンくずを１つ追加する
	 *
	 * @param string name パンくず名
	 * @param string url リンク(省略可)
	 * @return Func_Pankuzu thisを返す
	 * thisを返しているので連続してadd出来るようになってる
	 */
	public function add(string $name, string $url = ''): Func_Pankuzu
	{
		if ($name === '') {
			throw new InvalidArgumentException('パンくず名が空文字です。');
		}

		$this->pankuzu_list[] = [
			'name' => $name,
			'url'  => $url,
		];

		return $this;
	}

	/**
	 * パンくずを返す
	 *
	 * @return array<array{name: string, url: string}> | array{} パンくず用配列
	 */
	public function getPankuzuList(): array
	{
		return $this->pankuzu_list;
	}

}
