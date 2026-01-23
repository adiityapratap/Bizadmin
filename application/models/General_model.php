<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class General_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	}
	public function fetchIncompleteChecklist(){
	    $query = $this->tenantDb->query("SELECT GC.id
FROM Global_checklist GC
LEFT JOIN Global_checklistToDateCompleted GCTDC ON GC.checklist_id = GCTDC.checklist_id
WHERE
    (GCTDC.checklist_id IS NULL)
    OR (
        GCTDC.is_completed = 0
        AND DATE(GCTDC.date_completed) = CURDATE()
        AND DATE(GC.checklist_date) = CURDATE()
    );
");
// echo  $lastQuery = $this->tenantDb->last_query(); exit;
	    if ($query !== false) {
         return $res=	$query->result();
        } else {
         return $res = array();
        }
	}

	public function fetchScheduledChecklist($roleId=''){
	    //  0 =Daily, 1= weekly, 2= 15days, 3=monthly,4=yearly, 5=custom dates
	 // We are filtering checklist to display based on role in view file rather than in Query here
	 
	   $location_id = $this->session->userdata('location_id');
	   $query = $this->tenantDb->query("SELECT DISTINCT
    GC.id,
    GC.title,
    GC.role_id,
    GC.created_at,
    GC.is_temp_checked,
    GC.checklist_start_date,
    GC.checklist_end_date,
    GC.has_subtask,
    GC.schedule_at,
    GC.deadline_time,
    GC.urlSystem,
    GC.descr,
    GC.system_id,
    (
        SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
                'subChecklistDescr', GSC.descr,
                'subChecklistId', GSC.id,
                'subchecklist_time', GSC.subchecklist_time,
                'is_temp_checked', GSC.is_temp_checked,
                'subchecklist_time', GSC.subchecklist_time,
                'file_uploaded', GSC.file_uploaded,
                'subchecklist_is_completed', GSC.is_completed
            )
        )
        FROM Global_subchecklist GSC
        WHERE GC.id = GSC.parent_checklistId
    ) AS subchecklists
FROM Global_checklist GC
LEFT JOIN Global_subchecklist GSC ON GC.id = GSC.parent_checklistId
WHERE
    GC.status = 1 
    AND GC.is_deleted = 0
    AND GC.location_id = ".$location_id."
    AND (
        (GC.schedule_at = 0)
        OR (
            GC.schedule_at = 1 
            AND (
                DAYOFWEEK(CURDATE()) = DAYOFWEEK(GC.checklist_start_date)
            )
        )
        OR (
            GC.schedule_at = 2 
            AND (
                DATEDIFF(CURDATE(), GC.checklist_start_date) % 15 = 0
            )
        )
        OR (GC.schedule_at = 3 AND DAYOFMONTH(CURDATE()) = DAYOFMONTH(GC.checklist_start_date))
        OR (GC.schedule_at = 4 AND DAYOFYEAR(CURDATE()) = DAYOFYEAR(GC.checklist_start_date))
        OR (
            (GC.checklist_end_date IS NULL AND CURDATE() = GC.checklist_start_date)
            OR
            (GC.checklist_end_date IS NOT NULL AND CURDATE() BETWEEN GC.checklist_start_date AND GC.checklist_end_date)
        )
    )
ORDER BY GC.sort_order ASC;
");


// this is for fetching checklist which are completed for today
$queryCK = $this->tenantDb->query("SELECT checklist_id,is_completed , date_completed  from Global_checklistToDateCompleted  where  date_completed = CURDATE()");
 $completedChecklist = $queryCK->result();

// echo "<pre>"; print_r($checkListData); exit;

    //   echo  $lastQuery = $this->tenantDb->last_query(); exit;
	    if ($query !== false) {
         return mergeArrayBasedOnCommonKey($query->result(),$queryCK->result());
        } else {
         return  array();
        }
	}
	
	public function deleteMultiple($table_name,$selected_values){
	    if($table_name == 'Global_users'){
	        $data['is_deleted'] = 1;
	        $data['active'] = 0;
	    }else{
	        $data['is_deleted'] = 1;
	    }
	    $this->tenantDb->where_in('id', $selected_values)->update($table_name, $data);
	    return true;
	}
	public function fetchAllRecordForThisUser($table_name,$colName='',$id='',$fieldToRetrieve='',$result_type='',$sort=false){
	    if($id != '' && $colName !=''){
	        $whereCon = $colName." = ".$id;
	    }else{
	        $whereCon = 1;
	    }
	    
	    if($sort == true){
	     $sortBy = ' ORDER BY sort_order ASC';   
	    }else{
	       $sortBy = ''; 
	    }
	   $fieldToRetrieve  = ($fieldToRetrieve == '' ? '*' : $fieldToRetrieve);
	   
		$query=$this->tenantDb->query("SELECT ".$fieldToRetrieve." FROM ".$table_name." WHERE is_deleted = 0  AND ".$whereCon.$sortBy );
		if ($query !== false) {
         $res=	($result_type == '' ? $query->result() : $query->result_array());
  
       } else {
         $res = '';
          echo "Technical Error with location: ";
          exit;
       }
	    

		return $res;
	}
   public function updateCheckListForTodays($checkListid='',$data='',$attachmentCall=FALSE){
       
      
      $curDate = date('Y-m-d');
      $arrr= array();

       if(!$attachmentCall){
        
        $arrr['is_completed'] = $data['is_completed'];
        $arrr['date_completed'] = $curDate;
       }
       
       if($attachmentCall){
          $arrr['date_modified'] = $curDate; 
          $arrr['attachment'] = (isset($data['attachment']) ? $data['attachment'] : '');
          $arrr['checklistComments']= (isset($data['checklistComments']) ? $data['checklistComments'] :'');
       }
      
    
      
      
       $this->tenantDb->select('*');
       $this->tenantDb->from('Global_checklistToDateCompleted');
       $this->tenantDb->where('checklist_id', $checkListid);
       $this->tenantDb->group_start();
       $this->tenantDb->where('date_completed', $curDate);
       $this->tenantDb->or_where('date_modified', $curDate);
       $this->tenantDb->group_end();

       $query = $this->tenantDb->get();

      if ($query->num_rows() > 0) {
        //   echo "w<pre>"; print_r($query->num_rows()); print_r($query->result()); 
       $this->tenantDb->where('checklist_id', $checkListid);
        $this->tenantDb->where('date_completed', $curDate);  
        $this->tenantDb->or_where('date_modified', $curDate);
      
       $this->tenantDb->update('Global_checklistToDateCompleted', $arrr);
    //   echo  $lastQuery = $this->tenantDb->last_query();
    //   exit;
       } else {
       $arrr['checklist_id'] = $checkListid; 
       $this->tenantDb->insert('Global_checklistToDateCompleted', $arrr);
    //   echo  $lastQuery = $this->tenantDb->last_query();
    //   echo "<pre>"; print_r($arrr); exit;
      }
       return true;
   }
   
   public function viewChecklistAttachments(){
       $location_id = $this->session->userdata('location_id');
        $this->tenantDb->select('Global_checklist.title,Global_checklist.id,Global_checklistToDateCompleted.id as checklistHostoryId, Global_checklistToDateCompleted.date_completed,Global_checklist.checklist_start_date,Global_checklist.checklist_end_date, Global_checklist.deadline_time,Global_checklist.role_id, Global_checklistToDateCompleted.attachment, Global_checklistToDateCompleted.checklistComments,Global_checklistToDateCompleted.date_modified,Global_checklistToDateCompleted.id as attachId');
$this->tenantDb->from('Global_checklistToDateCompleted');
$this->tenantDb->join('Global_checklist', 'Global_checklist.id = Global_checklistToDateCompleted.checklist_id');
$this->tenantDb->where('Global_checklist.location_id', $location_id);
$this->tenantDb->where('Global_checklistToDateCompleted.is_deleted', 0);
$this->tenantDb->where('Global_checklistToDateCompleted.attachment IS NOT NULL', NULL, FALSE);
$this->tenantDb->order_by('Global_checklistToDateCompleted.date_modified', 'DESC');
$query = $this->tenantDb->get();
return $result = $query->result();
   }
	
	public function fetchAllRecord($table_name,$id='',$result_type=''){
	    if($id != ''){
	        $whereCon = $table_name."_id = ".$id;
	    }else{
	        $whereCon = 1;
	    }
		$query=$this->db->query("SELECT * FROM ".$table_name." WHERE ".$whereCon );
    	$res=	($result_type == '' ? $query->result() : $query->result_array());
	
		return $res;
	}
	public function fetchRecord($table_name,$id='',$columnsToFetch=''){
	    if($id != ''){
	        $whereCon = $table_name."_id = ".$id;
	    }else{
	        $whereCon = 1;
	    }
	    if($columnsToFetch==''){
	      $columnsToFetch = '*';  
	    }
		$query=$this->db->query("SELECT ".$columnsToFetch." FROM ".$table_name." WHERE ".$table_name."_status != 0 AND ".$whereCon );
		$res=$query->result();
		return $res;
	}
	public function add($table_name,$data){
		return $this->db->insert($table_name, $data);
	}
	public function insertDataInOrzDb($table_name,$data){
		 $this->tenantDb->insert($table_name, $data);
		 return $this->tenantDb->insert_id();
	}
	public function updateDataInOrzDb($table_name,$columnName,$id,$data){
       
		$this->tenantDb->where($columnName, $id);
        return $this->tenantDb->update($table_name, $data);
	}
    public function update($table_name,$id,$data,$columnForWhereCond=''){
        if($columnForWhereCond !=''){
	        $idName = $columnForWhereCond;    
	    }else
	    if($id != ''){
	        $idName = $table_name."_id";
	    }else{
	        $idName = 0;
	    }
		$this->tenantDb->where($idName, $id);
         return $this->tenantDb->update($table_name, $data);
        // echo  $lastQuery = $this->db->last_query();
	}
	
	public function fetchSmtpSettings($location_id, $system_id) {
    $query = $this->tenantDb->query("SELECT smtp_host,mail_protocol,mail_from,reply_to, smtp_port,smtp_username, smtp_pass FROM Global_SmtpSettings WHERE location_id = " . (int)$location_id . " AND system_id = " . (int)$system_id);
    if (!$query) {
        log_message('error', 'DB error: ' . $this->tenantDb->error()['message']);
        return null;
    }
    return $query->row();
}
	
}
