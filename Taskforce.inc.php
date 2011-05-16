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
	public function addCollaborator($id, $email) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/add_collaborator.json";
		$curlObject = curl_init($lastUrl);
		
		$post = array();
		$post["email"] = $email;
		
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
		public function removeCollaborator($id, $email) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/remove_collaborator.json";
		$curlObject = curl_init($lastUrl);
		
		$post = array();
		$post["email"] = $email;
		
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
	public function completeTask($id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/complete.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
			
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
	public function uncompleteTask($id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/uncomplete.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
			
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
	public function setDueDate($id, $date) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/set_due_date.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
		$post["date"] = $date;
			
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
	public function setStartDate($id, $date) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/set_start_date.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
		$post["date"] = $date;
			
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
	public function addToList($id, $list_id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/add_to_list.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
		$post["list_id"] = $list_id;
			
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
	public function removeFromList($id, $list_id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/remove_from_list.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
		$post["list_id"] = $list_id;
			
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
	public function addComment($id, $comment) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/add_comment.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
		$post["comment"] = $comment;
			
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
	public function deleteTask($id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/tasks/" . $id . "/delete.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
			
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
	public function getLists() {
		$lastUrl = "https://www.taskforceapp.com/api/v1/lists.json";
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
	public function getList($id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/lists/" . $id . ".json";
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
	public function updateList($id, $name = null, $description = null) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/lists/" . $id . ".json";
		$curlObject = curl_init($lastUrl);
		
		$post = array();
		if ($name != null) { $post["name"] = $name; }
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
		$result = json_decode($result);
		
		if ($result->success != true) { return false; } else {
		return $result; }
	}
	public function listGetTasks($id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/lists/" . $id . "/tasks.json";
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
	public function reorderTasks($id, $task_ids) {
		// Reorder Tasks method not yet implemented - coming soon!
	}
	public function listAddCollaborator($id, $email) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/lists/" . $id . "/add_collaborator.json";
		$curlObject = curl_init($lastUrl);
		
		$post = array();
		$post["email"] = $email;
		
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
	public function listRemoveCollaborator($id, $email) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/lists/" . $id . "/remove_collaborator.json";
		$curlObject = curl_init($lastUrl);
		
		$post = array();
		$post["email"] = $email;
		
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
	public function deleteList($id) {
		$lastUrl = "https://www.taskforceapp.com/api/v1/lists/" . $id . "/delete.json";
		$curlObject = curl_init($lastUrl);
		$post = array();	
			
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
}
?>