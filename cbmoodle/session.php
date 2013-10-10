 <?php
require_once('../config.php');

    require_once($CFG->dirroot .'/course/lib.php');
    require_once($CFG->libdir .'/filelib.php');

    redirect_if_major_upgrade_required();

    if ($CFG->forcelogin) {
        require_login();
    } else {
        user_accesstime_log();
    }

    $hassiteconfig = has_capability('moodle/site:config', get_context_instance(CONTEXT_SYSTEM));

    $PAGE->set_url('/');
    $PAGE->set_course($SITE);
	
/*
$cmid = required_param('id', PARAM_INT);
$course = $DB->get_record('course', array('id' => $wcid->course), '*', MUST_EXIST);
*/
//require_login($course, true, $cm);
//session_start();
$uid = $USER->id;
//$wcid = (int) $_GET['CourseId'];
//echo "Course ID is ".$wcid; 
//$uid = 3;  $PAGE->context 
?>
