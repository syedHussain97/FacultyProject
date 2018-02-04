<?php
class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function userHasRole($userId, $roleName) {
		$this->db->select('*')
					->from(APP_TABLE_CATEGORY_ROLES . ' r')
					->join(APP_TABLE_FACULTY_ROLES . ' x', 'r.role_id = x.faculty_roles_id')
					->where(array('r.role_name' => $roleName, 'x.faculty_roles_faculty_id' => $userId));
		$q = $this->db->get();
		return ($q->num_rows() > 0);
	}
	
	function currentUserHasAuthority($roleName) {
		$this->db->select('*')
					->from(APP_TABLE_CATEGORY_ROLES . ' r')
					->join(APP_TABLE_FACULTY_ROLES . ' x', 'r.role_id = x.faculty_roles_id ')
					->where(array('r.role_name' => $roleName, 'x.faculty_roles_faculty_id' => $this->session->userdata('faculty_id')));
		$q = $this->db->get();
		return ($q->num_rows() > 0);
	}
	
	function getCategoryRoles($catId) {
		$q = $this->db->select('role_id')->from(APP_TABLE_CATEGORY_ROLES)->where("category_id", $catId)->get();
		return $q->result_array();
	}
	
	function getAllCategories() {
		$q = $this->db->select('category_id, category_name')->from(APP_TABLE_CATEGORIES)->get();
		return $q->result_array();
	}
	
	function addFaculty($username, $password, $firstname, $lastname, $email, $nic, $qualification, $address, $phone, $mobile, $category) {
		$data = array(
					"faculty_firstname" => $firstname,
					"faculty_lastname" => $lastname,
					"faculty_username" => $username,
					"faculty_password" => $password,
					"faculty_email" => $email,
					"faculty_nic" => $nic,
					"faculty_qualification" => $qualification,
					"faculty_address" => $address,
					"faculty_landline" => $phone,
					"faculty_mobile" => $mobile,
					"faculty_institue_id" => $this->session->userdata('faculty_institue_id'));
		$this->db->insert(APP_TABLE_FACULTY, $data);
		$id = $this->db->insert_id();
		$this->db->insert(APP_TABLE_FACULTY_CATEGORY, array("faculty_category_id" => $category, "faculty_id" => $id));
		return $id;
	}
	
	function editFaculty($fId, $username, $password, $firstname, $lastname, $email, $nic, $qualification, $address, $phone, $mobile, $category, $image) {
		if(!$password) {
			$user = $this->user_model->getFacultyInfo($fId);
			$password = $user["faculty_password"];
		}
		$data = array(
					"faculty_firstname" => $firstname,
					"faculty_lastname" => $lastname,
					"faculty_username" => $username,
					"faculty_password" => $password,
					"faculty_email" => $email,
					"faculty_nic" => $nic,
					"faculty_qualification" => $qualification,
					"faculty_address" => $address,
					"faculty_landline" => $phone,
					"faculty_mobile" => $mobile,
					"faculty_image" => $image,
					"faculty_institue_id" => $this->session->userdata('faculty_institue_id'));
		
		$this->db->where("faculty_id", $fId);
		$this->db->update(APP_TABLE_FACULTY, $data);
		$id = $this->db->insert_id();
		$this->db->where("faculty_id", $fId);
		$this->db->update(APP_TABLE_FACULTY_CATEGORY, array("faculty_category_id" => $category, "faculty_id" => $fId));
		return $id;
	}
	
	function getFacultyInfo($fId) {
		$q = $this->db->get_where(APP_TABLE_FACULTY, array("faculty_id" => $fId));
		return $q->row_array();
	}
	
	function getInstituteName($instituteId) {
		$q = $this->db->select('institute_name')->from(APP_TABLE_INSTITUTE)->where('institue_id', $instituteId)->get();
		if ($q->num_rows() > 0) {
			$row = $q->row_array();
			return $row['institute_name'];
		}
	}
	
	function getFacultyCategory($fId) {
		$q = $this->db->select('faculty_category_id')->from(APP_TABLE_FACULTY_CATEGORY)->where('faculty_id', $fId)->get();
			if ($q->num_rows() > 0) {
				return $q->row_array();
			}
	}
	
	function getFacultyCategoryName($catId) {
		$q = $this->db->select('category_name')->from(APP_TABLE_CATEGORIES)->where('category_id', $catId)->get();
		if ($q->num_rows() > 0) {
			$row = $q->row_array();
			return $row['category_name'];
		}
	}
	
	function getCoursesTaughtByInstructor($fId) {
	$q = $this->db->select('course_id, course_name, course_code')->from(APP_TABLE_COURSE)->where('course_instructor', $fId)->get();
		if ($q->num_rows() > 0) {
			return $q->result_array();
		}
	}
	
	function getUserRoleArray($userId) {
		$q = $this->db->get_where(APP_TABLE_FACULTY_ROLES, array('user_id' => $userId));
		$result = array();
		foreach ($q->result_array() as $row) {
			$result[] = $row["role_id"];
		}
		return $result;
	}
	
	function getAllFaculty() {
		$this->db->select('f.faculty_id, f.faculty_firstname, f.faculty_lastname, c.faculty_category_id')
		->from(APP_TABLE_FACULTY_CATEGORY . ' c')
		->join(APP_TABLE_FACULTY . ' f', 'f.faculty_id = c.faculty_id ')
		->where(array('f.faculty_institue_id' => $this->session->userdata('faculty_institue_id')));
		$q = $this->db->get();
		
		if ($q->num_rows() > 0) {
			$user = array();
			foreach ($q->result_array() as $row) {
				$user[] = array(
					"faculty_id" => $row["faculty_id"],
					"name" => $row["faculty_firstname"] . " " . $row["faculty_lastname"],
					"category" => $this->getFacultyCategoryName($row["faculty_category_id"])
				);
			}
			
			return $user;
		}
	}
	
	function getAllStudent() {
		$this->db->select('student_id, student_roll_number, student_name')
		->from(APP_TABLE_STUDENT)->where(array('student_institute_id' => $this->session->userdata('faculty_institue_id')));
		$q = $this->db->get();
		
		if ($q->num_rows() > 0) {			
			return $q->result_array();
		}
	}
	
	function getStudentInfo($sId) {
		$q = $this->db->get_where(APP_TABLE_STUDENT, array("student_id" => $sId));
		return $q->row_array();
	}
	
	function getCoursesStudiedByStudent($sId) {
		$this->db->select('c.course_id, c.course_code, c.course_name')
		->from(APP_TABLE_COURSE . ' c')
		->join(APP_TABLE_STUDENT_COURSE . ' s', 's.registered_course_id = c.course_id')
		->where(array('s.registered_student_id' => $sId));
		$q = $this->db->get();
		
		if ($q->num_rows() > 0) {			
			return $q->result_array();
		}
	}
	
	function getAllCourses() {
		$this->db->select('*')
		->from(APP_TABLE_COURSE . ' c')
		->join(APP_TABLE_COURSE_OFFERED . ' f', 'f.course_id = c.course_id')
		->where(array('f.course_institute_id' => $this->session->userdata('faculty_institue_id')));
		$q = $this->db->get();
		
		if ($q->num_rows() > 0) {			
			return $q->result_array();
		} 
	}
	
	function getCourseDetails($cId) {
		$this->db->select('*')
		->from(APP_TABLE_COURSE)
		->where(array('course_id' => $cId));
		$q = $this->db->get();
		
		if ($q->num_rows() > 0) {			
			return $q->result_array();
		}
	}
	
	function removeAllUserRoles($userId) {
		$this->db->delete(APP_TABLE_FACULTY_ROLES, array('faculty_roles_faculty_id' => $userId));
	}
	
	function addUserRoles($userId, $roles = array()) {
		$data = array();
		if (is_array($roles) && count($roles) > 0) {
			foreach ($roles as $role) {
				$data[] = array("faculty_roles_id" => $role, "faculty_roles_faculty_id" => $userId);
			}
			$this->db->insert_batch(APP_TABLE_FACULTY_ROLES, $data);
		}
		return $data; 
	}
	
	function lectureUpdate($number, $cId, $description, $date, $duration) {
		$this->db->insert(APP_TABLE_COURSE_LECTURE, array("lecture_number" => $number, "lecture_course_id" => $cId, "lecture_updates" => $description, "lecture_date" => $date, "lecture_duration" => $duration));
		return $this->db->insert_id();
	}
	
	function changelectureUpdate($lId, $number, $cId, $description, $date, $duration) {
		$this->db->where("lecture_id", $lId);
		$this->db->update(APP_TABLE_COURSE_LECTURE, array("lecture_number" => $number, "lecture_course_id" => $cId, "lecture_updates" => $description, "lecture_date" => $date, "lecture_duration" => $duration));
		return $this->db->insert_id();
	}
	
	function deleteLectureUpdate($lId) {
		$this->db->delete(APP_TABLE_COURSE_LECTURE, array("lecture_id" => $lId));
	}
	
	function insertAttendence($list = array(), $lId) {
		$data = array();
		if (is_array($list) && count($list) > 0) {
			foreach ($list as $each) {
				$data[] = array("lecture_attendence_lecture_id" => $lId, "lecture_attendence_student_id" => $each["student_id"] , "lecture_attendence_status" => 'P');
			}
			$this->db->insert_batch(APP_TABLE_LECUTRE_ATTENDENCE, $data);
		}
		return $data;
	}
	
	function updateAttendence($list = array(), $lId) {
		$data = array();
		if (is_array($list) && count($list) > 0) {
			foreach ($list as $each) {
				$data[] = array("lecture_attendence_lecture_id" => $lId ,"lecture_attendence_student_id" => $each["student_id"] , "lecture_attendence_status" => $each["student_status"]);
			}
			$this->db->delete(APP_TABLE_LECUTRE_ATTENDENCE,array("lecture_attendence_lecture_id" => $lId));
			$this->db->insert_batch(APP_TABLE_LECUTRE_ATTENDENCE, $data);
		}
		return $data;
	}
	
	function updateStudentMarks($list = array(), $cId) {
		$data = array();
		if (is_array($list) && count($list) > 0) {
			foreach ($list as $each) {
				$data[] = array("course_marks_course_id" => $cId ,"course_marks_student_id" => $each["student_id"] , "course_marks_marks" => $each["student_marks"]);
			}
			$this->db->insert_batch(APP_TABLE_COURSE_MARKS, $data);
		}
		return $data;
	}
	
	function editStudentMarks($list = array(), $cId) {
		$data = array();
		if (is_array($list) && count($list) > 0) {
			foreach ($list as $each) {
				$data[] = array("course_marks_course_id" => $cId ,"course_marks_student_id" => $each["student_id"] , "course_marks_marks" => $each["student_marks"]);
			}
			$this->db->delete(APP_TABLE_COURSE_MARKS,array("course_marks_course_id" => $cId));			
			$this->db->insert_batch(APP_TABLE_COURSE_MARKS, $data);
		}
		return $data;
	}
	
	function getStudentCourseMarks($cId) {
		$q = $this->db->get_where(APP_TABLE_COURSE_MARKS, array("course_marks_course_id" => $cId));
		return $q->result_array();
	}
	
	function getLectureAttendence($lId) {
		$q = $this->db->get_where(APP_TABLE_LECUTRE_ATTENDENCE, array("lecture_attendence_lecture_id" => $lId));
		return $q->result_array();
	}
	
	function getLectureDetails($lId) {
		$q = $this->db->get_where(APP_TABLE_COURSE_LECTURE, array("lecture_id" => $lId));
		return $q->row_array();
	}
	
	function getLectures($cId) {
		$q = $this->db->get_where(APP_TABLE_COURSE_LECTURE, array("lecture_course_id" => $cId));
		return $q->result_array();
	}
	
	function getRegisteredStudent($cId) {
		$this->db->select('s.student_id, s.student_roll_number, s.student_name')
		->from(APP_TABLE_STUDENT . ' s')
		->join(APP_TABLE_STUDENT_COURSE . ' c', 'c.registered_student_id = s.student_id')
		->where(array('c.registered_course_id' => $cId, 'student_institute_id' => $this->session->userdata('faculty_institue_id')));
		$q = $this->db->get();
		
		if ($q->num_rows() > 0) {			
			return $q->result_array();
		} 
	}
	
	function userExists($id = 0) {
		$q = $this->db->get_where(APP_TABLE_FACULTY, array("faculty_id" => $id));
		return ($q->num_rows() > 0);
	}
	
	function isValidUser($username, $password) {
		$user = $this->db->get_where(APP_TABLE_FACULTY, 
					array('faculty_username' => $username, 'faculty_password' => $password));
		if ($user->num_rows() > 0) {
			return $user->row_array();
		} else {
			return false;
		}
	}
	
	function createSession($userData = array()) {
		if (is_array($userData) && count($userData) > 0) {
			$this->session->set_userdata('logged_in', true);
			$this->session->set_userdata($userData);
			return true;
		}
		return false;
	}
	
	function isLoggedIn() {
		if ($this->session->userdata('logged_in')) {
			return true;
		}
		return false;
	}
	
	function doesUsernameExist($username) {
		$q = $this->db->get_where(APP_TABLE_FACULTY, array('faculty_username' => $username));
		return ($q->num_rows() > 0);
	}
	
	function getRoleCategories() {
		$q = $this->db->get(APP_TABLE_CATEGORIES);
		return $q->result_array();
	}
	
	function getRolesByCategory($catId) {
		$q = $this->db->get_where(APP_TABLE_CATEGORY_ROLES, array('category_id' => $catId));
		return $q->result_array();
	}
	
	function registerUser($username, $password, $fname, $lname) {
		$data = array('user_username' => $username,
					'user_password' => $password,
					'user_firstname' => $fname,
					'user_lastname' => $lname);
					
		$this->db->insert(APP_TABLE_FACULTY, $data); 
		return $this->db->insert_id();
	}
	
	function deleteFaculty($fId) {
		$this->db->delete(APP_TABLE_FACULTY, array('faculty_id' => $fId));
	}
	
	function deleteMultipleFaculty($fIds = array()) {
		foreach ($fIds as $fId) {
			$this->db->delete(APP_TABLE_FACULTY, array("faculty_id" => $fId));
		}
	}
	}

?>