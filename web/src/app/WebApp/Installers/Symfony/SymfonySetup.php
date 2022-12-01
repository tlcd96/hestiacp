<?php

namespace Hestia\WebApp\Installers\Symfony;

use Hestia\WebApp\Installers\BaseSetup as BaseSetup;

class SymfonySetup extends BaseSetup {
	protected $appInfo = [
		"name" => "Symfony",
		"group" => "framework",
		"enabled" => true,
		"version" => "latest",
		"thumbnail" => "symfony-thumb.png",
	];

	protected $appname = "symfony";

	protected $config = [
		"form" => [],
		"database" => true,
		"resources" => [
			"composer" => ["src" => "symfony/website-skeleton", "dst" => "/"],
		],
		"server" => [
			"nginx" => [
				"template" => "symfony4-5",
			],
			"php" => [
				"supported" => ["8.0", "8.1"],
			],
		],
	];

	public function install(array $options = null): bool {
		parent::install($options);
		$result = null;

		$htaccess_rewrite = '
<IfModule mod_rewrite.c>
		RewriteEngine On
		RewriteRule ^(.*)$ public/$1 [L]
</IfModule>';

		$this->appcontext->runComposer(
			["config", "-d " . $this->getDocRoot(), "extra.symfony.allow-contrib", "true"],
			$result,
		);
		$this->appcontext->runComposer(
			["require", "-d " . $this->getDocRoot(), "symfony/apache-pack"],
			$result,
		);

		$tmp_configpath = $this->saveTempFile($htaccess_rewrite);
		$this->appcontext->runUser(
			"v-move-fs-file",
			[$tmp_configpath, $this->getDocRoot(".htaccess")],
			$result,
		);

		return $result->code === 0;
	}
}
