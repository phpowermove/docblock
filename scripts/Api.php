<?php declare(strict_types=1);

namespace gossi\docblock\scripts;

/**
 * Class to generate api. Useful for composer script.
 */
class Api {
	public static function generateApi(): void {
		if (!file_exists('sami.phar')) {
			self::downloadSami();
		}

		if (strpos(phpversion(), '7.4') !== false) {
			die("
Sami cannot run on PHP 7.4 due to some deprecations.
If you have installed some other php versions, you could manually run it:

 php7.3 sami.phar update sami.php

"
			);
		}

		exec("php sami.phar update sami.php");
	}

	private static function downloadSami(): void {
		if (!extension_loaded('curl')) {
			die("
You should enable `curl` extensions in your php.ini, to download sami.
Alternatively, you can download it manually from http://get.sensiolabs.org/sami.phar
");
		}

		$fp = fopen('./sami.phar', 'wb');

		echo "Donload sami...";
		$ch = curl_init('http://get.sensiolabs.org/sami.phar');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		echo "done!\n";

		fclose($fp);
	}
}
