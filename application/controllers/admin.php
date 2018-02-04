<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');

class Admin extends Base {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() {
	
		if ($this->user_model->isLoggedIn()) {
		
			redirect('admin/profile/' . $this->session->userdata('faculty_id'));
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	public function login() {
		$this->load->view('login');
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('admin');
	}
	
	public function authenticate() {
		if ($this->user_model->isLoggedIn()) {
			redirect('admin');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[30]');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[30]');
			
			if ($this->form_validation->run() == FALSE) {
				$this->login();
			} else {
				$username = trim($this->input->post('username'));
				$password = md5($this->input->post('password'));
				$result = $this->user_model->isValidUser($username, $password);			
				if ($result) {
					$this->user_model->createSession($result);
					redirect('admin', 'refresh');
				} else {
					$this->session->set_flashdata('error', 'Invalid username or password!');
					redirect('admin/login', 'refresh');
				}
			}
		}
	}
	
	public function unauthorised() {
		if (!$this->user_model->isLoggedIn())
			redirect('admin');
		
		$this->set_title("Unauthorized");
		$this->add_to_left("admin/","sidebar");
		$this->add_to_center("admin/","unauthorised");
		$this->load_lc_template_admin();
	}
	
	public function profile($fId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
			
		if($this->user_model->currentUserHasAuthority("PROFILE_OWNER")) {

			$user = $this->user_model->getFacultyInfo($fId);
			$faculty = array();
			
				$faculty['institute'] = $this->user_model->getInstituteName($user["faculty_institue_id"]);
				$faculty['id'] = $fId;
				$faculty['name'] = $user["faculty_firstname"] . " " . $user["faculty_lastname"];
				$faculty['education'] = $user["faculty_qualification"];
				$faculty['nic'] = $user["faculty_nic"];
				$faculty['email'] = $user["faculty_email"];
				$faculty['address'] = $user["faculty_address"];
				$faculty['phone'] = $user["faculty_landline"];
				$faculty['mobile'] = $user["faculty_mobile"];
				$faculty['image'] = $user["faculty_image"];
			
			$category = $this->user_model->getFacultyCategory($user["faculty_id"]);
			$faculty['cat_name'] = $this->user_model->getFacultyCategoryName($category["faculty_category_id"]);
			
			$course = $this->user_model->getCoursesTaughtByInstructor($user["faculty_id"]);
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "SETTINGS", "selection" => "AUTH"));
			$this->add_to_center("admin/","index", array("faculty" => $faculty, "courses" => $course, "category" => $category));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/list_course');
		}
	}
	
		public function edit_profile($fId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
			
		if($this->user_model->currentUserHasAuthority("PROFILE_OWNER") || $this->user_model->currentUserHasAuthority("ADD_FACULTY")) {

			$user = $this->user_model->getFacultyInfo($fId);
			$faculty = array();
			
			$faculty['institute'] = $this->user_model->getInstituteName($user["faculty_institue_id"]);
			$faculty['id'] = $fId;
			$faculty['firstname'] = $user["faculty_firstname"];
			$faculty['lastname'] = $user["faculty_lastname"];
			$faculty['username'] = $user["faculty_username"];
			$faculty['password'] = $user["faculty_password"];
			$faculty['education'] = $user["faculty_qualification"];
			$faculty['nic'] = $user["faculty_nic"];
			$faculty['email'] = $user["faculty_email"];
			$faculty['address'] = $user["faculty_address"];
			$faculty['phone'] = $user["faculty_landline"];
			$faculty['mobile'] = $user["faculty_mobile"];
			$faculty['image'] = $user["faculty_image"];
		
			$category = $this->user_model->getFacultyCategory($user["faculty_id"]);
			$faculty['cat_id'] = $category["faculty_category_id"];
			
			$categories = $this->user_model->getAllCategories();
			$cat = array();
			foreach($categories as $category) {
				$cat[$category["category_id"]] = $category["category_name"];
			}
			$catId = $this->user_model->getFacultyCategory($this->session->userdata('faculty_id'));
			$checkCatId = $catId["faculty_category_id"];
			
			$course = $this->user_model->getCoursesTaughtByInstructor($user["faculty_id"]);
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "SETTINGS", "selection" => "AUTH"));
			$this->add_to_center("admin/","edit_profile", array("faculty" => $faculty, "courses" => $course, "categories" => $cat, "checkCatId" => $checkCatId));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/list_course');
		}
	}
	
	public function edit_faculty_process($fId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("ADD_FACULTY") || $this->user_model->currentUserHasAuthority("PROFILE_OWNER")){
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[30]');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required|max_length[30]');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required|max_length[30]');
			$this->form_validation->set_rules('nic', 'NIC', 'required|max_length[30]');
			$this->form_validation->set_rules('qualification', 'Qualification', 'required|max_length[50]');
			
			if($this->input->post('password'))
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]|max_length[30]');
			
			if ($this->form_validation->run() == FALSE) {
				$this->edit_profile($fId);
			} else {
				$this->load->helper('directory');
				$config['upload_path'] = './images/uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '100000';
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if($this->input->post('image')) {
					if ( ! $this->upload->do_upload('image')) {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/edit_profile/' . $fId);
					}
				} else {
					$catId = $this->user_model->getFacultyCategory($this->session->userdata('faculty_id'));
					$data = array('upload_data' => $this->upload->data());
					$image = $data['upload_data']['file_name'];
				
					$username = trim($this->input->post('username'));
					if($this->input->post('password'))
						$password = md5($this->input->post('password'));
					else
						$password = NULL;
					$firstname = $this->input->post('firstname');
					$lastname = $this->input->post('lastname');
					$email = $this->input->post('email');
					$nic = $this->input->post('nic');
					$qualification = $this->input->post('qualification');
					$address = $this->input->post('address');
					$phone = $this->input->post('phone');
					$mobile = $this->input->post('mobile');
					if($catId["faculty_category_id"] == 1)
						$category = $this->input->post('category');
				
					$id = $this->user_model->editFaculty($fId, $username, $password, $firstname, $lastname, $email, $nic, $qualification, $address, $phone, $mobile, $category, $image);
					if($catId["faculty_category_id"] == 1) {
						$catId = $this->user_model->getFacultyCategory($id);
						$roles = $this->user_model->getCategoryRoles($catId["faculty_category_id"]);
						$userRoles = array();
						$i = 0;
						foreach($roles as $role) {
							$userRoles[$role["role_id"]]  = $role["role_id"];
						}
						
						$this->user_model->addUserRoles($id, $userRoles);
						redirect('admin/set_privileges/' . $fId);
					} else {
						redirect('admin/profile/' . $fId);
					}
				}
			}
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function list_faculty() {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("VIEW_FACULTY_PROFILE")){
			$faculty = $this->user_model->getAllFaculty();
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "PRO", "selection" => "FPRO"));
			$this->add_to_center("admin/","list_faculty", array("faculty" => $faculty));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function student_profile($sId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
			
		if($this->user_model->currentUserHasAuthority("PROFILE_OWNER")) {

			$user = $this->user_model->getStudentInfo($sId);
			$student = array();
			
				$student['institute'] = $this->user_model->getInstituteName($user["student_institute_id"]);
				$student['name'] = $user["student_name"];
				$student['rno'] = $user["student_roll_number"];
			
			$course = $this->user_model->getCoursesStudiedByStudent($user["student_id"]);
			// var_dump($student);
			// var_dump($course);
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "SETTINGS", "selection" => "AUTH"));
			$this->add_to_center("admin/","student_profile", array("student" => $student, "courses" => $course));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function list_student() {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("VIEW_STUDENT_PROFILE")){
			$students = $this->user_model->getAllStudent();
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "PRO", "selection" => "SPRO"));
			$this->add_to_center("admin/","list_student", array("students" => $students));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function list_course() {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("VIEW_COURSE")){
			$courses = $this->user_model->getAllCourses();
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
			$this->add_to_center("admin/","list_course", array("courses" => $courses));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function view_course_detail($cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("VIEW_COURSE")){
			$details = $this->user_model->getCourseDetails($cId);
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
			$this->add_to_center("admin/","course_details", array("details" => $details));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function lecture_update($cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("LECTURE_UPDATE")){
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
			$this->add_to_center("admin/","lecture_update", array("cId" => $cId));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function mark_attendence($cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("MARK_ATTENDENCE")){
			$this->form_validation->set_rules('number', 'Number', 'integer|required|max_length[30]');
			$this->form_validation->set_rules('description', 'Decription', 'required|max_length[30]');
			$this->form_validation->set_rules('date', 'Date', 'required|max_length[30]');
			$this->form_validation->set_rules('duration', 'Duration', 'integer|required|max_length[30]');
			
			if ($this->form_validation->run() == FALSE) {
				$this->lecture_update($cId);
			} else {
				$number = $this->input->post('number');
				$description = $this->input->post('description');
				$date = $this->input->post('date');
				$duration = $this->input->post('duration');
				
				$lId = $this->user_model->lectureUpdate($number, $cId, $description, $date, $duration);
				$list = $this->user_model->getRegisteredStudent($cId);
				$this->user_model->insertAttendence($list, $lId);
				$attendence = $this->user_model->getLectureAttendence($lId);

				$data = array();
				$i = 0;
				foreach ($list as $each) {
					foreach($attendence as $status) {
						if($each["student_id"] ==  $status["lecture_attendence_student_id"]) {
							$data[] = array("student_id" => $each["student_id"], "student_roll_number" => $each["student_roll_number"] , 
											"student_name" => $each["student_name"], "status" => $status["lecture_attendence_status"]);
						}
						if($i==0) {
							$lId = $status["lecture_attendence_lecture_id"];
							$i++;
						}
					}
				}
				$status = array(
							"P" => "Present",
							"A" => "Absent");
				$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
				$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
				$this->add_to_center("admin/","course_attendence", array("students" => $data, "status" => $status, "lId" => $lId, "cId" => $cId));
				$this->load_lc_template_admin();
			}
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function change_attendence($lId = 0, $cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("UPDATE_ATTENDENCE")){
				
				$list = $this->user_model->getRegisteredStudent($cId);
				$attendence = $this->user_model->getLectureAttendence($lId);

				$data = array();
				$i = 0;
				foreach ($list as $each) {
					foreach($attendence as $status) {
						if($each["student_id"] ==  $status["lecture_attendence_student_id"]) {
							$data[] = array("student_id" => $each["student_id"], "student_roll_number" => $each["student_roll_number"] , 
											"student_name" => $each["student_name"], "status" => $status["lecture_attendence_status"]);
						}
						if($i==0) {
							$lId = $status["lecture_attendence_lecture_id"];
							$i++;
						}
					}
				}
				$status = array(
							"P" => "Present",
							"A" => "Absent");
				$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
				$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
				$this->add_to_center("admin/","course_attendence", array("students" => $data, "status" => $status, "lId" => $lId, "cId" => $cId));
				$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function update_attendence($lId = 0, $cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("MARK_ATTENDENCE") || $this->user_model->currentUserHasAuthority("UPDATE_ATTENDENCE")){
			$status = $this->input->post('status');
			$stdId = $this->input->post('stdId');
			$data = array();
			$size = sizeOf($stdId);
			$i=0;
			while($i < $size) {
				$data[] = array("lecture_id" => $lId, "student_id" => $stdId[$i] , "student_status" => $status[$i]);
				$i++;
			}
			$this->user_model->updateAttendence($data, $lId);
			redirect('admin/view_lecture_details/' . $lId . "/" . $cId);
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function view_attendence($lId = 0, $cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("UPDATE_ATTENDENCE")){
				
				$list = $this->user_model->getRegisteredStudent($cId);
				$attendence = $this->user_model->getLectureAttendence($lId);

				$data = array();
				$i = 0;
				foreach ($list as $each) {
					foreach($attendence as $status) {
						if($each["student_id"] ==  $status["lecture_attendence_student_id"]) {
							$data[] = array("student_id" => $each["student_id"], "student_roll_number" => $each["student_roll_number"] , 
											"student_name" => $each["student_name"], "status" => $status["lecture_attendence_status"]);
						}
						if($i==0) {
							$lId = $status["lecture_attendence_lecture_id"];
							$i++;
						}
					}
				}
				$status = array(
							"P" => "Present",
							"A" => "Absent");
				$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
				$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
				$this->add_to_center("admin/","view_attendence", array("students" => $data, "status" => $status, "lId" => $lId));
				$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function view_lectures($cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("VIEW_LECTURE_UPDATE") || $this->user_model->currentUserHasAuthority("LECTURE_UPDATE")){
			$lectures = $this->user_model->getLectures($cId);
			$details = $this->user_model->getCourseDetails($cId);
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
			$this->add_to_center("admin/","course_lectures", array("lectures" => $lectures, "details" => $details, "cId" => $cId));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function edit_lecture_updates($lId = 0, $cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("LECTURE_UPDATE")){
			$lecture = $this->user_model->getLectureDetails($lId);
			$details = $this->user_model->getCourseDetails($cId);
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
			$this->add_to_center("admin/","edit_lecture_updates", array("lectures" => $lecture, "details" => $details, "cId" => $cId, "lId" => $lId));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function update_lecture($lId = 0,  $cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("MARK_ATTENDENCE")){
			$this->form_validation->set_rules('number', 'Number', 'integer|required|max_length[30]');
			$this->form_validation->set_rules('description', 'Decription', 'required|max_length[30]');
			$this->form_validation->set_rules('date', 'Date', 'required|max_length[30]');
			$this->form_validation->set_rules('duration', 'Duration', 'integer|required|max_length[30]');
			
			if ($this->form_validation->run() == FALSE) {
				$this->lecture_update($cId);
			} else {
				$number = $this->input->post('number');
				$description = $this->input->post('description');
				$date = $this->input->post('date');
				$duration = $this->input->post('duration');
				
				$lId = $this->user_model->changelectureUpdate($lId, $number, $cId, $description, $date, $duration);
				redirect('admin/view_lectures/' . $cId);
			}
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function delete_lecture_updates($lId = 0, $cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("LECTURE_UPDATE")){
			$this->user_model->deleteLectureUpdate($lId);
			redirect('admin/view_lectures/' . $cId);
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function view_lecture_details($lId = 0, $cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("VIEW_LECTURE_UPDATE") || $this->user_model->currentUserHasAuthority("LECTURE_UPDATE")){
			$lecture = $this->user_model->getLectureDetails($lId);
			$details = $this->user_model->getCourseDetails($cId);
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
			$this->add_to_center("admin/","lecture_details", array("lectures" => $lecture, "details" => $details, "cId" => $cId, "lId" => $lId));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function update_course_marks($cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")){
		
				$list = $this->user_model->getRegisteredStudent($cId);
				//$marks = $this->user_model->getStudentCourseMarks($list, $cId);

				$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
				$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
				$this->add_to_center("admin/","update_student_marks", array("students" => $list, "cId" => $cId));
				$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function update_course_marks_process($cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")){
		
			$stdMarks = $this->input->post('stdMarks');
			$stdId = $this->input->post('stdId');
			$data = array();
			$size = sizeOf($stdId);
			$i=0;
			while($i < $size) {
				$data[] = array("course_id" => $cId, "student_id" => $stdId[$i] , "student_marks" => $stdMarks[$i]);
				$i++;
			}
			$this->user_model->updateStudentMarks($data, $cId);
			redirect('admin/list_course');
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function edit_course_marks($cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")){
		
				$list = $this->user_model->getRegisteredStudent($cId);
				$marks = $this->user_model->getStudentCourseMarks($cId);
				
				$data = array();
				$i = 0;
				foreach ($list as $each) {
					foreach($marks as $mark) {
						if($each["student_id"] ==  $mark["course_marks_student_id"]) {
							$data[] = array("student_id" => $each["student_id"], "student_roll_number" => $each["student_roll_number"] , 
											"student_name" => $each["student_name"], "marks" => $mark["course_marks_marks"]);
						}
					}
				}
				$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
				$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
				$this->add_to_center("admin/","edit_student_marks", array("students" => $data, "cId" => $cId));
				$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function edit_course_marks_process($cId = 0) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("UPDATE_MARKS")){
		
			$stdMarks = $this->input->post('stdMarks');
			$stdId = $this->input->post('stdId');
			$data = array();
			$size = sizeOf($stdId);
			$i=0;
			while($i < $size) {
				$data[] = array("course_id" => $cId, "student_id" => $stdId[$i] , "student_marks" => $stdMarks[$i]);
				$i++;
			}
			$this->user_model->editStudentMarks($data, $cId);
			redirect('admin/list_course');
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	
	public function view_course_marks($cId) {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("VIEW_STUDENT_MARKS") || $this->user_model->currentUserHasAuthority("UPDATE_MARKS")){
			$list = $this->user_model->getRegisteredStudent($cId);
				$marks = $this->user_model->getStudentCourseMarks($cId);
				
				$data = array();
				$i = 0;
				foreach ($list as $each) {
					foreach($marks as $mark) {
						if($each["student_id"] ==  $mark["course_marks_student_id"]) {
							$data[] = array("student_id" => $each["student_id"], "student_roll_number" => $each["student_roll_number"] , 
											"student_name" => $each["student_name"], "marks" => $mark["course_marks_marks"]);
						}
					}
				}
				$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
				$this->add_to_left("admin/","sidebar", array("section" => "COURSE", "selection" => "COURSE"));
				$this->add_to_center("admin/","view_student_marks", array("students" => $data, "cId" => $cId));
				$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function create_faculty() {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("ADD_FACULTY")){
			$categories = $this->user_model->getAllCategories();
			$cat = array();
			foreach($categories as $category) {
				$cat[$category["category_id"]] = $category["category_name"];
			}
			
			$this->set_title($this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname'));
			$this->add_to_left("admin/","sidebar", array("section" => "FAC", "selection" => "CFAC"));
			$this->add_to_center("admin/","add_faculty", array("categories" => $cat));
			$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function create_faculty_process() {
		if (!$this->user_model->isLoggedIn())
			redirect('admin/login');
		
		if($this->user_model->currentUserHasAuthority("ADD_FACULTY")){
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[30]');
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[30]');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required|max_length[30]');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required|max_length[30]');
			$this->form_validation->set_rules('nic', 'NIC', 'required|max_length[30]');
			$this->form_validation->set_rules('qualification', 'Qualification', 'required|max_length[50]');
			
			if ($this->form_validation->run() == FALSE) {
				$this->create_faculty();
			} else {
				if ($this->user_model->doesUsernameExist($this->input->post('username'))) {
					$this->session->set_flashdata('error', 'username already exist');
					redirect('admin/create_faculty');
				}
				$username = trim($this->input->post('username'));
				$password = md5($this->input->post('password'));
				$firstname = $this->input->post('firstname');
				$lastname = $this->input->post('lastname');
				$email = $this->input->post('email');
				$nic = $this->input->post('nic');
				$qualification = $this->input->post('qualification');
				$address = $this->input->post('address');
				$phone = $this->input->post('phone');
				$mobile = $this->input->post('mobile');
				$category = $this->input->post('category');
				
				$id = $this->user_model->addFaculty($username, $password, $firstname, $lastname, $email, $nic, $qualification, $address, $phone, $mobile, $category);
				$catId = $this->user_model->getFacultyCategory($id);
				$roles = $this->user_model->getCategoryRoles($catId["faculty_category_id"]);
				$userRoles = array();
				$i = 0;
				foreach($roles as $role) {
					$userRoles[$role["role_id"]]  = $role["role_id"];
				}
				$this->user_model->addUserRoles($id, $userRoles);
				redirect('admin/set_privileges/' . $id);
			}
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function set_privileges($id = -1) {
		if (!$this->user_model->isLoggedIn() || !$this->user_model->userExists($id))
			redirect('admin');
		
		if($this->user_model->currentUserHasAuthority("ADD_FACULTY")){
		$categories = $this->user_model->getRoleCategories();
		for ($i = 0; $i<count($categories); $i++) {
			$categories[$i]["roles"] = $this->user_model->getRolesByCategory($categories[$i]["category_id"]);
			for ($j = 0; $j<count($categories[$i]["roles"]); $j++) {
				$categories[$i]["roles"][$j]["has_role"] = $this->user_model->userHasRole($id, $categories[$i]["roles"][$j]["role_name"]);
			}
		}
		$this->set_title("User Privileges");
		$this->add_to_left("admin/","sidebar", array("section" => "SETTINGS", "selection" => "UAP"));
		$this->add_to_center("admin/","user_privileges", array("categories" => $categories, "id" => $id, "user" => $this->user_model->getFacultyInfo($id)));
		$this->load_lc_template_admin();
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function set_privileges_process($id = 0) {
		if (!$this->user_model->isLoggedIn() || !$this->user_model->userExists($id))
			redirect('admin');
		
		if($this->user_model->currentUserHasAuthority("ADD_FACULTY")){
		$this->user_model->removeAllUserRoles($id);
		$privileges = $this->input->post('privileges');
		$this->user_model->addUserRoles($id, $privileges);
		$this->session->set_flashdata('success','Privileges updated successfully!');
		redirect('admin/set_privileges/' . $id);
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function delete_faculty($fId = 0) {
		if (!$this->user_model->isLoggedIn() || !$this->user_model->userExists($fId))
			redirect('admin');
		
		if($this->user_model->currentUserHasAuthority("ADD_FACULTY")){
			$this->user_model->deleteFaculty($fId);
			redirect('admin/list_faculty');
		} else {
			redirect('admin/unauthorised');
		}
	}
	
	public function delete_faculty_bulk_process() {
		$faculty = $this->input->post('faculty');
		$action = $this->input->post('action');
		if (trim($action) == "delete" && count($faculty) > 0) {
			
			if ($this->user_model->currentUserHasAuthority('ADD_FACULTY')) {
				$this->user_model->deleteMultipleFaculty($faculty);
				redirect('admin/list_faculty');
			} else {
				redirect('admin/unauthorised');
			}
		}
	}
}

?>