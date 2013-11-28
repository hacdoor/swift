<?php
class SluggableBehavior extends CActiveRecordBehavior {
	private $_delimiter = '-';
	private $_replace = array();

	public function beforeValidate($event) {
		$this->owner->slug = $this->generateSlug();
	}

	public function findBySlug($slug) {
		$criteria = new CDbCriteria;
		$criteria->condition = 'slug = :slug';
		$criteria->params = array(':slug' => $slug);
		return $this->owner->model()->find($criteria);
	}

	public function generateSlug() {
		$titleColumn = (isset($this->owner->title)) ? 'title' : 'name';

		$candidate = $this->_makeSlug($this->owner->$titleColumn);

		if ($this->owner->isNewRecord)
			$query = 'SELECT COUNT(id) FROM ' . $this->owner->tableName() . ' WHERE slug = "' . $candidate . '"';
		else
			$query = 'SELECT COUNT(id) FROM ' . $this->owner->tableName() . ' WHERE slug = "' . $candidate . '" AND id <> ' . $this->owner->id;

		$command = Yii::app()->db->createCommand($query);
		$exists = $command->queryScalar();
		
		if ($exists) {
			if ($this->owner->isNewRecord)
				$query = 'SELECT COUNT(id) FROM ' . $this->owner->tableName() . ' WHERE slug LIKE "' . $candidate . '-%"';
			else
				$query = 'SELECT COUNT(id) FROM ' . $this->owner->tableName() . ' WHERE slug LIKE "' . $candidate . '-%" AND id <> ' . $this->owner->id;

			$command = Yii::app()->db->createCommand($query);
			$exists = $command->queryScalar();
			
			if ($exists) {
				$num = $exists + 1;
			} else {
				$num = '1';
			}
			
			$slug = $candidate . '-' . $num;
		} else {
			$slug = $candidate;
		}

		return $slug;
	}
	
	private function _makeSlug($str) {
		setlocale(LC_ALL, 'en_US.UTF8');
		if( !empty($this->_replace) ) {
			$str = str_replace((array)$this->_replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $this->_delimiter, $clean);

		return $clean;
	}
}