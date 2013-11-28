<?php
class TimestampBehavior extends CActiveRecordBehavior {
	public function beforeSave($event) {
		$tstamp = date('Y-m-d H:i:s');

		if ($this->owner->isNewRecord) {
			$this->owner->create_time = $tstamp;
		}
		$this->owner->update_time = $tstamp;
	}
}