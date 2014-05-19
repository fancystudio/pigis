<?php  
error_reporting( E_ALL );
ini_set('display_errors', 1);
class Helper
{	
	private $db;
	public function __construct($config) {
		try{  
			$this->db = new PDO("mysql:host=".$config['db_hostname'].";port=".$config['db_port'].";unix_socket=/tmp/mariadb55.sock;dbname=".$config['db_name'], $config['db_username'], $config['db_password']);
			$this->db->exec("SET CHARACTER SET utf8");
		}catch (Exception $e) {
			echo "Failed: " . $e->getMessage();
  			$this->db->rollBack();
		}
    }
	public function getBlogPageCount(){
		$select = $this->db->prepare("SELECT count(cgblog_id) as blog_count from cms_module_cgblog where status = 'published'");
		$select->execute();
		while ($row = $select->fetch(PDO::FETCH_OBJ)){
			$blogPageCount = $row->blog_count;
		}
		return ceil($blogPageCount/3);
	}
	public function getCurrentBlogPage($currentPage, $blogName){
		$pageItems = array();
		if($blogName == null){
			$select = $this->db->prepare("SELECT mb.cgblog_id, mb.cgblog_title, mb.cgblog_date, mb.summary, mb.cgblog_data, mbf.value from cms_module_cgblog mb
											left join cms_module_cgblog_fieldvals mbf on mb.cgblog_id = mbf.cgblog_id 
											where mb.status = 'published' limit ".(($currentPage-1)*3).",".((($currentPage-1)*3)+3));
			$select->execute();
			$blogCount = 0;
			while ($row = $select->fetch(PDO::FETCH_OBJ)){
				$pageItems[$blogCount]["id"] = $row->cgblog_id;
				$pageItems[$blogCount]["title"] = $row->cgblog_title;
				$pageItems[$blogCount]["date"] = date("d.m.Y h:i:s", strtotime($row->cgblog_date));
				$pageItems[$blogCount]["summary"] = $this->truncate($row->summary, 450);
				$pageItems[$blogCount]["img"] = "uploads/cgblog/id".$row->cgblog_id."/".$row->value;
				$blogCount++;
			}
		}else{
			echo "nie je null";
		}
		return $pageItems;
	}
	public function getBlogDetail($blogId){
		$pageItems = array();
		$select = $this->db->prepare("SELECT cgblog_id, cgblog_title, cgblog_date, cgblog_data, status from cms_module_cgblog mb
										where cgblog_id = ".$blogId);
		$select->execute();
		$blogCount = 0;
		while ($row = $select->fetch(PDO::FETCH_OBJ)){
			$pageItems[$blogCount]["id"] = $row->cgblog_id;
			$pageItems[$blogCount]["title"] = $row->cgblog_title;
			$pageItems[$blogCount]["date"] = date("d.m.Y h:i:s", strtotime($row->cgblog_date));
			$pageItems[$blogCount]["content"] = $row->cgblog_data;
			$pageItems[$blogCount]["status"] = $row->status;
			$blogCount++;
		}
		return $pageItems;
	}
	public function insertMailToNewsletter($mail){
		try{
			$insert = $this->db->prepare("INSERT INTO cms_module_nms_users (uniqueid, email, username, disabled, confirmed, htmlemail, dateadded, dateconfirmed, error_count, bounce_count) VALUES (?,?,?,?,?,?,?,?,?,?)");
			$insert->execute(array(md5(uniqid(rand(),1)), $mail,"", 0, 0, 1, date("Y-m-d H:i:s"), null, null, null));
			return true;		
		}catch(Exception $e) {
			return false;
		}
	}
	function truncate($text, $chars = 25) {
	    $text = $text." ";
	    $text = substr($text,0,$chars);
	    $text = substr($text,0,strrpos($text,' '));
	    $text = $text."...";
	    return $text;
	}
}
?>