<?php
class SettingComponent extends CApplicationComponent {
	private $_settings = array();

	public function init() {
		$this->_populateSettings();

		parent::init();
	}

	public function get($name) {
		return (isset($this->_settings[$name])) ? $this->_settings[$name] : false;
	}

	public function getAll() {
		return $this->_settings;
	}

	public function clearCache() {
		@unlink(Yii::app()->getRuntimePath() . '/settings.json');
	}

	private function _populateSettings() {
		$settingsFile = Yii::app()->getRuntimePath() . '/settings.json';

		if (!file_exists($settingsFile)) {
			$settings = Setting::model()->findAll();

			foreach ($settings as $s) {
				$this->_settings[$s->name] = $s->value;
			}

			$encodedSettings = json_encode($this->_settings);

			// Save cached version
			$fp = fopen($settingsFile, 'w');
			fwrite($fp, $encodedSettings);
		} else {
			// Retrieve from cache
			$encodedSettings = file_get_contents($settingsFile);
			$this->_settings = json_decode($encodedSettings, true);
		}
	}
}