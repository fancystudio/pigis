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
				$pageItems[$blogCount]["date"] = $row->cgblog_date;
				$pageItems[$blogCount]["summary"] = $row->summary;
				$pageItems[$blogCount]["content"] = $row->cgblog_data;
				$pageItems[$blogCount]["img"] = "uploads/cgblog/id".$row->cgblog_id."/".$row->value;
				$blogCount++;
			}
		}else{
			echo "nie je null";
		}
		return $pageItems;
	}
}
?>