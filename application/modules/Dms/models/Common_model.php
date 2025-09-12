<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model{
	

	function __construct() {
		parent::__construct();
		$this->selected_location_id = $this->session->userdata('location_id');
	}

	   public function add($data,$tableName){
	       // echo "<pre>"; print_r($data); exit;
	    return $this->tenantDb->insert($tableName,$data);
		}

     function change_status($data){
     $Newdata = array(
		'status' => $data['status'],
		'updated_date'=> date("Y-m-d")
		 );
	$this->tenantDb->set($Newdata);
	$this->tenantDb->where('id',$data['id']);
	$this->tenantDb->update($tableName);
return true;
} 
  function fetchAllFolders(){
      $query = $this->tenantDb->query("SELECT * from DMS_folders df  where df.is_deleted = 0 AND  df.location_id = ".$this->selected_location_id." order by df.sort_order ASC");
	    if ($query !== false) {
         return $res=	$query->result_array();
        } else {
         return $res = array();
        }
  }
  function fetchAllSubFolders($folderId=''){
      if($folderId!=''){
       $where=' AND dsf.folder_id='.$folderId;  
      }else{
       $where=''; 
      }
      $query = $this->tenantDb->query("SELECT * from DMS_sub_folders dsf  where dsf.is_deleted = 0 AND  dsf.location_id = ".$this->selected_location_id." ".$where." order by dsf.sort_order ASC");
	    if ($query !== false) {
         return $res=	$query->result_array();
        } else {
         return $res = array();
        }
  }
  
  function fetchAllDocsOfThisFolders($folderId='',$subFolderId=''){
      if($folderId!=''){
       $where=' AND dmsD.folder_id='.$folderId;  
      }else{
       $where=''; 
      }
      if($subFolderId !=''){
       $whereSub=' AND dmsD.subfolder_id='.$subFolderId;  
      }else{
       $whereSub=' AND dmsD.subfolder_id=0'; 
      }
      $query = $this->tenantDb->query("SELECT * from DMS_documents dmsD  where dmsD.is_deleted = 0 AND  dmsD.location_id = ".$this->selected_location_id." ".$where." ".$whereSub." order by dmsD.sort_order ASC");
	    if ($query !== false) {
         return $res=	$query->result_array();
        } else {
         return $res = array();
        }
  }
  
  
  function deleteFolder($id,$tableName){	
     	$data = array(
		'is_deleted' => 1,
		'updated_date'=> date("Y-m-d")
		 );
		 
 $this->tenantDb->set($data);
 $this->tenantDb->where('id', $id);
 $this->tenantDb->update($tableName);
return true;
} 
		
   public function update($data,$id,$tableName){
		
// echo "<pre>";print_r($data); exit;
 $this->tenantDb->set($data);
 $this->tenantDb->where('id', $id);
 $this->tenantDb->update($tableName);
return true;
		}
		

		
   	public function fetchDashboardData(){
		    $query = $this->tenantDb->query("SELECT 
    DMS_documents.*, 
    DMS_sub_folders.subfolder_name,
    DMS_sub_folders.role_ids as subFolderRoleIds,
    DMS_folders.role_ids as folderRoleIds,
    DMS_folders.folder_name
FROM 
    DMS_documents
LEFT JOIN 
    DMS_sub_folders ON DMS_sub_folders.id = DMS_documents.subfolder_id
LEFT JOIN 
    DMS_folders ON DMS_folders.id = DMS_documents.folder_id
WHERE 
    DMS_documents.is_deleted = 0
    AND DMS_documents.location_id = ".$this->selected_location_id."
    AND DMS_documents.status = 1
    ");
		  
       $DocsUnderSubFolder = [];
       $DocsWithoutSubFolder = [];
        foreach ($query->result_array() as $row) {
            
        $subfolderId = $row['subfolder_id'];
            
        if($subfolderId == 0){
            
         $folder_id = $row['folder_id'];
         if (!isset($DocsWithoutSubFolder[$folder_id])) {
             
           $DocsWithoutSubFolder[$folder_id] = [
            'subfolder_id' => $row['subfolder_id'],
            'folder_id' => $row['folder_id'], 
            'folder_name' => $row['folder_name'], 
            'subfolder_name' => $row['subfolder_name'],
            'subFolderRoleIds' => $row['subFolderRoleIds'],
            'folderRoleIds' => $row['folderRoleIds'],
            'documents' => [], // Array to store docs data
             ];
          }
        
      $DocsWithoutSubFolder[$folder_id]['documents'][] = [
        'id' => $row['id'],
        'file_display_name' => $row['file_display_name'],
        'file_name' => $row['name'],
        'status' => $row['status'],
        'is_deleted' => $row['is_deleted'],
        'created_date' => $row['created_date'],
        'location_id' => $row['location_id'],
        'folder_id' => $row['folder_id'],
        'subfolder_name' => $row['subfolder_name'],
     ];  
            
        } else{
            
       
    if (!isset($DocsUnderSubFolder[$subfolderId])) {
           $DocsUnderSubFolder[$subfolderId] = [
            'subfolder_id' => $row['subfolder_id'],
            'folder_id' => $row['folder_id'], 
            'folder_name' => $row['folder_name'], 
            'subfolder_name' => $row['subfolder_name'],
            'subFolderRoleIds' => $row['subFolderRoleIds'],
            'folderRoleIds' => $row['folderRoleIds'],
            'documents' => [], // Array to store docs data
             ];
          }
        
    $DocsUnderSubFolder[$subfolderId]['documents'][] = [
        'id' => $row['id'],
        'file_display_name' => $row['file_display_name'],
        'file_name' => $row['name'],
        'status' => $row['status'],
        'is_deleted' => $row['is_deleted'],
        'created_date' => $row['created_date'],
        'location_id' => $row['location_id'],
        'folder_id' => $row['folder_id'],
        'subfolder_name' => $row['subfolder_name'],
     ];
        } 
     
     
          }
          
       
          $resultArray['DocsUnderSubFolder'] = $DocsUnderSubFolder;
          $resultArray['DocsWithoutSubFolder'] = $DocsWithoutSubFolder;
            return $resultArray;
            	    
		}		
}