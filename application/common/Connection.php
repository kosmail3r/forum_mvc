<?php
	class Connection {
		static public $conn;
		const DB_HOST = 'localhost';
		const DB_NAME = 'forum';
		const DB_USER = 'root';
		const DB_PASSWORD = '';

		static public function connect() {
			self::$conn = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);
            self::$conn->set_charset('utf8');
			if (!self::$conn) {
				die ('Oops something happened');
			}
		}

		static public function makeQuery($sql, $isResultNeed = true) {
			$r = mysqli_query(self::$conn, $sql);
			if (!$isResultNeed) {
				return (is_bool($r) ? $r : mysqli_num_rows($r) > 0);
			}

			$result = [];
			while ($row = mysqli_fetch_assoc($r)) {
				$result[] = $row;
			}

			return $result;
		}
	}