	<?php if (!isset($section)) $section = ""; if (!isset($selection)) $selection = ""; ?>
	<h1 id="sidebar-title"><a href="#">CMS Admin</a></h1>
  
	<!-- Logo (221px wide) -->
	<a href="#"><img id="logo" src="<?=base_url()?>images/admin/logo.png" alt="logo" /></a>
  
	<!-- Sidebar Profile links -->
	<div id="profile-links">
		Hello, <a href="#"><?=$this->session->userdata('faculty_firstname') . " " . $this->session->userdata('faculty_lastname')?></a><br />
		<br />
		<a href="<?=base_url()?>" title="View the Site">View the Site</a> | <a href="<?=base_url('index.php/admin/logout')?>" title="Sign Out">Sign Out</a>
	</div>        
	
	<ul id="main-nav">  <!-- Accordion Menu -->
		<?php if($this->user_model->currentUserHasAuthority("PROFILE_OWNER")) {?>
		<li>
			<a href="<?=base_url('index.php/admin')?>" class="nav-top-item no-submenu<?=($section == "DB" ? " current" : "")?>"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
				Profile
			</a>       
		</li>
		<?php }?>
		<?php if($this->user_model->currentUserHasAuthority("ADD_FACULTY")) {?>
		<li>
			<a href="#" class="nav-top-item<?=($section == "FAC" ? " current" : "")?>">
				Faculty
			</a>
			<ul>
				<li><a <?=($selection == "CFAC" ? "class=\"current\"" : "")?> href="<?=base_url('index.php/admin/create_faculty')?>">Create Faculty</a></li>
			</ul>
		</li>
		<?php }?>
		<?php if($this->user_model->currentUserHasAuthority("VIEW_FACULTY_PROFILE") || $this->user_model->currentUserHasAuthority("VIEW_STUDENT_PROFILE")){?>
		<li>
			<a href="#" class="nav-top-item<?=($section == "PRO" ? " current" : "")?>">
				View Others Profiles
			</a>
			<ul>
				<?php if($this->user_model->currentUserHasAuthority("VIEW_STUDENT_PROFILE")) {?>
				<li><a <?=($selection == "SPRO" ? "class=\"current\"" : "")?> href="<?=base_url('index.php/admin/list_student')?>">View Student List</a></li>
				<?php }?>
				<?php if($this->user_model->currentUserHasAuthority("VIEW_FACULTY_PROFILE")) {?>
				<li><a <?=($selection == "FPRO" ? "class=\"current\"" : "")?> href="<?=base_url('index.php/admin/list_faculty')?>">View Faculty List</a></li>
				<?php }?>
			</ul>
		</li>
		<?php }?>
		<?php if($this->user_model->currentUserHasAuthority("VIEW_COURSE") || $this->user_model->currentUserHasAuthority("UPDATE_MARKS")) {?>
		<li>
			<a href="#" class="nav-top-item<?=($section == "COURSE" ? " current" : "")?>">
				Courses
			</a>
			<ul>
				<li><a <?=($selection == "COURSE" ? "class=\"current\"" : "")?> href="<?=base_url('index.php/admin/list_course')?>">View Course List</a></li>
			</ul>
		</li>
		<?php }?>
	</ul> <!-- End #main-nav -->