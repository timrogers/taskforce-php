<?php
/*
Copyright 2011 Tyrant Inc.

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/
class Taskforce
{
	private $username;
	private $password;
	public $lastUrl;
	public $curlObject;
	
	public function __construct($username, $password) {
		$this->username = $username;
		$this->password = $password;
	}
	
	public static function createUser($email, $password) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/user.json";
		$curlObject = curl_init($lastUrl);
		
		
		$post = array();
		$post["email"] = $email;
		$post["password"] = $password;
		
		
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObject, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curlObject, CURLOPT_POST, 1);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObject, CURLOPT_POSTFIELDS, $post);
		
		$result = curl_exec($curlObject);
		$info = curl_getinfo($curlObject);
		die(var_dump($info));
		if ($info['http_code'] == 200) { return true; } else { return false; }
		curl_close($curlObject);
	}
	
	
	public function getUser() {
		$lastUrl = "https://www.taskforceapp.com/api/v1/user.json";
		$curlObject = curl_init($lastUrl);
		
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObject, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObject, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		
		$result = curl_exec($curlObject);
		$info = curl_getinfo($curlObject);
		if ($info['http_code'] != 200) { return false; } else {
		return json_decode($result); }
	}
	public function getTasks() {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks.json";
		$curlObject = curl_init($lastUrl);
		
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObject, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObject, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		
		$result = curl_exec($curlObject);
		$info = curl_getinfo($curlObject);
		
		if ($info['http_code'] != 200) { return false; } else {
		return json_decode($result); }
	}
		public function countTasks() {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/count.json";
		$curlObject = curl_init($lastUrl);
		
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObject, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObject, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		
		$result = curl_exec($curlObject);
		$info = curl_getinfo($curlObject);
		
		if ($info['http_code'] != 200) { return false; } else {
		return json_decode($result); }
	}
	public function createTask($name, $list_id, $details = null) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks.json";
		$curlObject = curl_init($lastUrl);
		$post = array();
		$post["name"] = $name;
		$post["list_id"] = $list_id;
		if ($details != null) { $post["details"] = $details; }
		
		
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObject, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObject, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		curl_setopt($curlObject, CURLOPT_POST, true);
		curl_setopt($curlObject, CURLOPT_POSTFIELDS, $post);
		
		$result = curl_exec($curlObject);
		$info = curl_getinfo($curlObject);
		if ($info['http_code'] != 200) { return false; } else {
		return json_decode($result); }
	}
	public function getTask($id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . ".json";
		$curlObject = curl_init($lastUrl);
		
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObject, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObject, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		
		$result = curl_exec($curlObject);
		$info = curl_getinfo($curlObject);
		$result = json_decode($result);
		
		if ($result->success != true) { return false; } else {
		return $result; }
	}
	public function updateTask($id, $name = null, $details = null) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . ".json";
		$curlObject = curl_init($lastUrl);
		
		$post = array();
		if ($name != null) { $post["name"] = $name; }
		if ($details != null) { $post["details"] = $details; }
		
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObject, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObject, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		curl_setopt($curlObject, CURLOPT_POST, true);
		curl_setopt($curlObject, CURLOPT_POSTFIELDS, $post);
		
		$result = curl_exec($curlObject);
		$info = curl_getinfo($curlObject);
		$result = json_decode($result);
		
		if ($result->success != true) { return false; } else {
		return $result; }
	}
	public function createList($name, $description = null) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/lists.json";
		$curlObject = curl_init($lastUrl);
		$post = array();
		$post["name"] = $name;
		if ($description != null) { $post["description"] = $description; }
		
		
		curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObject, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObject, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		curl_setopt($curlObject, CURLOPT_POST, true);
		curl_setopt($curlObject, CURLOPT_POSTFIELDS, $post);
		
		$result = curl_exec($curlObject);
		$info = curl_getinfo($curlObject);
		if ($info['http_code'] != 200) { return false; } else {
		return json_decode($result); }
	}
}
?>