<?php
namespace Custom\UserNameVowes\Events;

use Bitrix\Main\SystemException;

class RestService
{
	public static function getDescription()
	{
		return array(
			'vowes' => array(
				'vowes.get.usernamevovwes' =>  array(__CLASS__, 'GetUserNameVowes'),
			)
		);
	}
	public static function GetUserNameVowes($query, $n, \CRestServer $server)
	{
		try
		{
			$UserId = null;
			if($query['user_id']){
				$UserId = intval($query['user_id']);
			}			
			$name = (new \Custom\UserNameVowes\PrepareUserName())->getUserNameVowels($UserId);

			return ['status' => 'success' , 'result' => $name];
		}
		catch (SystemException $exception)
		{
			return ['status' => 'error' , 'error_msg' => $exception->getMessage()];
		}
	}
}