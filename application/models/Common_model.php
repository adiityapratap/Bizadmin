<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function fetchAllLocations($id = '') {
        $whereCon = ($id !== '') ? "location_id = " . (int)$id : "1";
        $query = $this->tenantDb->query("SELECT * FROM locations_list WHERE is_deleted = 0 AND $whereCon");
        return $query->result_array();
    }

    public function fetchRecordsDynamically($table, $fields = [], $conditions = [], $order_by = '') {
    // Validate table name
    if (empty($table) || !is_string($table)) {
        log_message('error', 'Invalid table name provided to fetchRecordsDynamically');
        return [];
    }

    // Validate that $fields is an array
    if (is_array($fields) && !empty($fields)) {
        $this->tenantDb->select(implode(',', $fields));
    } else {
        $this->tenantDb->select('*');
    }

    $this->tenantDb->from($table);

    // Apply conditions if provided
    if (!empty($conditions) && is_array($conditions)) {
        $this->tenantDb->where($conditions);
    }

    // Apply order by if provided
    if (!empty($order_by) && is_string($order_by)) {
        $this->tenantDb->order_by($order_by);
    }

    // Execute query and check for success
    $query = $this->tenantDb->get();

    if ($query === false) {
        log_message('error', 'Database query failed: ' . $this->tenantDb->last_query());
        return [];
    }

    return $query->result_array();
}

    public function commonRecordUpdate($table, $fieldname = '', $id = null, $data = []) {
        if ($fieldname && $id !== null && !empty($data)) {
            $this->tenantDb->where($fieldname, $id);
            $this->tenantDb->update($table, $data);
        }
     
       
    }

    public function commonRecordUpdateMultipleConditions($tableName, $fields = [], $data = []) {
        if (!empty($fields) && !empty($data)) {
            foreach ($fields as $fieldName => $fieldValue) {
                $this->tenantDb->where($fieldName, $fieldValue);
            }
            $this->tenantDb->update($tableName, $data);
        } else {
            return true;
        }
    }

    public function commonRecordDelete($table, $id, $uniqueColumnName = 'id') {
        if (!empty($id)) {
            $this->tenantDb->where($uniqueColumnName, $id);
            $this->tenantDb->delete($table);
        }
    }

    public function commonBulkRecordDelete($table, $ids = [], $uniqueColumnName = 'id') {
        if (!empty($ids)) {
            $this->tenantDb->where_in($uniqueColumnName, $ids);
            $this->tenantDb->delete($table);
        }
    }

    public function commonRecordCreate($table, $data = []) {
        if (!empty($data)) {
            $this->tenantDb->insert($table, $data);
            return $this->tenantDb->insert_id();
        }
        return false;
    }

    public function commonRecordUpsert($table, $uniqueColumnName, $uniqueColumnVal, $data = []) {
        if (!empty($data)) {
            $this->tenantDb->insert($table, $data);
            if ($this->tenantDb->affected_rows() == 0) {
                $this->tenantDb->where($uniqueColumnName, $uniqueColumnVal);
                $this->tenantDb->update($table, $data);
            }
        }
        return true;
    }

    public function uploadAttachment($uploadedFiles, $uploadPath = './uploaded_files/') {
        $uploaded_files = [];

        if (!isset($uploadedFiles['userfile']['name']) || !is_array($uploadedFiles['userfile']['name'])) {
            return 'Invalid upload data.';
        }

        $countfiles = count($uploadedFiles['userfile']['name']);
        for ($i = 0; $i < $countfiles; $i++) {
            if (!empty($uploadedFiles['userfile']['name'][$i])) {
                $_FILES['file'] = [
                    'name'     => $uploadedFiles['userfile']['name'][$i],
                    'type'     => $uploadedFiles['userfile']['type'][$i],
                    'tmp_name' => $uploadedFiles['userfile']['tmp_name'][$i],
                    'error'    => $uploadedFiles['userfile']['error'][$i],
                    'size'     => $uploadedFiles['userfile']['size'][$i]
                ];

                $config = [
                    'upload_path'   => $uploadPath,
                    'allowed_types' => 'jpg|jpeg|png|gif|pdf|doc|docx',
                    'max_size'      => 8000,
                    'file_name'     => $_FILES['file']['name']
                ];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $uploaded_files[$i] = $uploadData['file_name'];
                } else {
                    return $this->upload->display_errors();
                }
            }
        }

        return serialize($uploaded_files);
    }

    public function commonBulkRecordCreate($tableName, $data = [], $additionalData = []) {
        if (!empty($data)) {
            if (!empty($additionalData)) {
                foreach ($data as &$row) {
                    $row = array_merge($row, $additionalData);
                }
            }
            return $this->tenantDb->insert_batch($tableName, $data);
        }
        return false;
    }

    public function softDeleteRecord($table, $column, $id) {
        if (!empty($table) && !empty($column) && !empty($id)) {
            $this->tenantDb->where($column, $id);
            $this->tenantDb->update($table, ['status' => 0]);
            return true;
        }
        return false;
    }
}
?>
