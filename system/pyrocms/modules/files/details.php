<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Files extends Module {

	public $version = '1.1beta';

	public function info()
	{
		return array(
			'name' => array(
				'sl' => 'Datoteke',
				'en' => 'Files',
				'pt' => 'Arquivos',
				'de' => 'Dateien',
				'nl' => 'Bestanden',
				'fr' => 'Fichiers',
				'zh' => '檔案',
				'it' => 'File',
				'ru' => 'Файлы',
				'ar' => 'الملفّات',
				'cs' => 'Soubory',
				'es' => 'Archivos',
				'fi' => 'Tiedostot',
				'el' => 'Αρχεία',
				'he' => 'קבצים',
				'lt' => 'Failai'
			),
			'description' => array(
				'sl' => 'Uredi datoteke in mape na vaši strani',
				'en' => 'Manages files and folders for your site.',
				'pt' => 'Permite gerenciar facilmente os arquivos de seu site.',
				'de' => 'Verwalte Dateien und Verzeichnisse.',
				'nl' => 'Beheer bestanden en folders op uw website.',
				'fr' => 'Gérer les fichiers et dossiers de votre site.',
				'zh' => '管理網站中的檔案與目錄',
				'it' => 'Gestisci file e cartelle del tuo sito.',
				'ru' => 'Управление файлами и папками вашего сайта.',
				'ar' => 'إدارة ملفات ومجلّدات موقعك.',
				'cs' => 'Spravujte soubory a složky na vašem webu.',
				'es' => 'Administra archivos y carpetas en tu sitio.',
				'fi' => 'Hallitse sivustosi tiedostoja ja kansioita.',
				'el' => 'Διαχειρίζεται αρχεία και φακέλους για το ιστότοπό σας.',
				'he' => 'ניהול תיקיות וקבצים שבאתר',
				'lt' => 'Katalogų ir bylų valdymas.'
			),
			'frontend' => FALSE,
			'backend'  => TRUE,
			'menu'	  => 'content'
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('files');
		$this->dbforge->drop_table('file_folders');

		$files = "
			CREATE TABLE `files` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `folder_id` int(11) NOT NULL DEFAULT '0',
			  `user_id` int(11) NOT NULL DEFAULT '1',
			  `type` enum('a','v','d','i','o') COLLATE utf8_unicode_ci DEFAULT NULL,
			  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			  `extension` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
			  `mimetype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
			  `width` int(5) DEFAULT NULL,
			  `height` int(5) DEFAULT NULL,
			  `filesize` int(11) NOT NULL DEFAULT 0,
			  `date_added` int(11) NOT NULL DEFAULT 0,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		";

		$file_folders = "
			CREATE TABLE `file_folders` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `parent_id` int(11) DEFAULT '0',
			  `slug` varchar(100) NOT NULL,
			  `name` varchar(50) NOT NULL,
			  `date_added` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		";

		$files_attached = "
			CREATE TABLE `files_attached` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `key` varchar(40) NOT NULL DEFAULT '',
			  `type` varchar(20) NOT NULL,
			  `value` varchar(32) NOT NULL,
			  `title` varchar(255) NOT NULL,
			  `extra` text,
			  `order` int(11) NOT NULL DEFAULT '0',
			  `created_on` int(11) NOT NULL DEFAULT '0',
			  `updated_on` int(11) NOT NULL DEFAULT '0',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8
		";

		if ($this->db->query($files)
			&& $this->db->query($file_folders)
			&& $this->db->query($files_attached))
		{
			return TRUE;
		}
	}

	public function uninstall()
	{
		//it's a core module, lets keep it around
		return FALSE;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		return TRUE;
	}
}
/* End of file details.php */
