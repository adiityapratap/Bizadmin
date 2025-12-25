<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generalcomp_model extends CI_Model {
    private $selected_location_id;

    public function __construct() {
        parent::__construct();
        $this->selected_location_id = $this->session->userdata('location_id') ?? 0;
        $this->load->model('common_model');
    }

    public function get_all_sitesQuestion(): array {
        $where_conditions = [
            'is_deleted' => 0,
            'location_id' => $this->selected_location_id
        ];

        $query = $this->tenantDb->select(['staff_comments', 'manager_comments'])
            ->where($where_conditions)
            ->order_by('created_at', 'ASC')
            ->get('Compliance_sites');

        return is_object($query) ? ($query->result_array() ?? []) : [];
    }

    public function get_allActive_sites(): array {
        $query = $this->tenantDb->select('*')
            ->where([
                'is_deleted' => 0,
                'status' => 1,
                'location_id' => $this->selected_location_id
            ])
            ->order_by('created_at', 'ASC')
            ->get('Compliance_sites');

        return is_object($query) ? ($query->result_array() ?? []) : [];
    }

    public function get_allSitesForDash(): array {
        $query = $this->tenantDb->select('Compliance_sites.*, JSON_ARRAYAGG(JSON_OBJECT("id", Compliance_prepArea.id, "prep_name", Compliance_prepArea.prep_name)) as prep_areas', false)
            ->from('Compliance_sites')
            ->join('Compliance_prepArea', 'Compliance_prepArea.site_id = Compliance_sites.id', 'inner')
            ->group_by('Compliance_sites.id')
            ->where([
                'Compliance_sites.location_id' => $this->selected_location_id,
                'Compliance_sites.is_deleted' => 0,
                'Compliance_sites.status' => 1
            ])
            ->get();

        return is_object($query) ? ($query->result_array() ?? []) : [];
    }

    public function fetchAttachmentUploadedToday(int $task_id): array {
        if (empty($task_id)) {
            return [];
        }

        $curDate = date('Y-m-d');
        $query = $this->tenantDb->select('attachment')
            ->from('Compliance_record_History')
            ->where([
                'task_id' => $task_id,
                'date_entered' => $curDate
            ])
            ->get();

        return is_object($query) ? ($query->result_array() ?? []) : [];
    }

    public function updateRecordForTodays(int $task_id, array $data): bool {
        if (empty($task_id) || empty($data)) {
            return false;
        }

        $curDate = date('Y-m-d');
        $query = $this->tenantDb->select('*')
            ->from('Compliance_wasteManagement_history')
            ->where([
                'task_id' => $task_id,
                'date_entered' => $curDate
            ])
            ->get();

        if (!is_object($query)) {
            return false;
        }

        if ($query->num_rows() > 0) {
            $this->tenantDb->where([
                'task_id' => $task_id,
                'date_entered' => $curDate
            ]);
            return $this->tenantDb->update('Compliance_wasteManagement_history', $data);
        }

        return $this->tenantDb->insert('Compliance_wasteManagement_history', $data);
    }

    public function fetchTodaysEnteredData(): array {
        $query = $this->tenantDb->select('Compliance_record_History.*')
            ->from('Compliance_record_History')
            ->where([
                'Compliance_record_History.date_entered' => date('Y-m-d'),
                'Compliance_record_History.is_completed' => 1,
                'Compliance_record_History.location_id' => $this->selected_location_id
            ])
            ->get();

        $newArray = [];
        if (is_object($query)) {
            $result = $query->result_array() ?? [];
            foreach ($result as $item) {
                if (!empty($item['task_id'])) {
                    $newArray[$item['task_id']] = $item;
                }
            }
        }

        return $newArray;
    }

    public function fetchTodaysEnteredDataForCakeDisplay(): array {
        $query = $this->tenantDb->select('Compliance_cake_records_history.*')
            ->from('Compliance_cake_records_history')
            ->where([
                'Compliance_cake_records_history.date_entered' => date('Y-m-d'),
                'Compliance_cake_records_history.location_id' => $this->selected_location_id
            ])
            ->get();

        $newArray = [];
        if (is_object($query)) {
            $result = $query->result_array() ?? [];
            foreach ($result as $item) {
                if (!empty($item['product_id'])) {
                    $newArray[$item['product_id']] = $item;
                }
            }
        }

        return $newArray;
    }
    
    public function fetchTodaysEnteredDataForIncomingGoods(): array {
    $query = $this->tenantDb->select('Compliance_IncomingGoods_history.*')
        ->from('Compliance_IncomingGoods_history')
        ->where([
            'Compliance_IncomingGoods_history.date_entered' => date('Y-m-d'),
            'Compliance_IncomingGoods_history.location_id' => $this->selected_location_id
        ])
        ->get();
    
    $newArray = [];
    if (is_object($query)) {
        $result = $query->result_array() ?? [];
        foreach ($result as $item) {
            if (!empty($item['supplier_id'])) {
                $newArray[$item['supplier_id']] = $item;
            }
        }
    }
    return $newArray;
}

    public function fetchHistoryData(string $fromDate, string $toDate, int $site_id): array {
        if (empty($fromDate) || empty($toDate) || empty($site_id)) {
            return [];
        }

        $query = $this->tenantDb->select('Compliance_record_History.*, Compliance_sites.site_name, Compliance_prepArea.prep_name, Compliance_tasks.task_name')
            ->from('Compliance_record_History')
            ->join('Compliance_prepArea', 'Compliance_prepArea.id = Compliance_record_History.prep_id', 'left')
            ->join('Compliance_sites', 'Compliance_sites.id = Compliance_record_History.site_id', 'left')
            ->join('Compliance_tasks', 'Compliance_tasks.id = Compliance_record_History.task_id', 'left')
            ->where([
                'Compliance_record_History.location_id' => $this->selected_location_id,
                'Compliance_record_History.site_id' => $site_id,
                'Compliance_record_History.date_entered >=' => $fromDate,
                'Compliance_record_History.date_entered <=' => $toDate
            ])
            ->get();

        $restructuredArray = [];
        if (is_object($query)) {
            $result = $query->result_array() ?? [];
            foreach ($result as $item) {
                if (!empty($item['date_entered']) && !empty($item['task_id'])) {
                    $date_entered = $item['date_entered'];
                    $taskId = $item['task_id'];
                    $restructuredArray[$date_entered] = ($restructuredArray[$date_entered] ?? []);
                    $restructuredArray[$date_entered][$taskId] = $item;
                }
            }
        }

        return $restructuredArray;
    }

    public function getSiteNameFromId(int $site_id): ?string {
        if (empty($site_id)) {
            return null;
        }

        $query = $this->tenantDb->select('site_name')
            ->where(['id' => $site_id])
            ->get('Compliance_sites');

        if (!is_object($query)) {
            return null;
        }

        $result = $query->row();
        return $result ? $result->site_name : null;
    }

    public function getPrepNameFromId(int $prep_id): ?string {
        if (empty($prep_id)) {
            return null;
        }

        $query = $this->tenantDb->select('prep_name')
            ->where(['id' => $prep_id])
            ->get('Compliance_prepArea');

        if (!is_object($query)) {
            return null;
        }

        $result = $query->row();
        return $result ? $result->prep_name : null;
    }

    public function getEquipNameFromId(int $task_id, string $additionalFields = '', bool $mailFrequency = false): ?stdClass {
        if (empty($task_id)) {
            return null;
        }

        $where_conditions = ['id' => $task_id];
        if ($mailFrequency) {
            $where_conditions['mailFrequency'] = 'daily';
        }

        $select = 'task_name';
        if (!empty($additionalFields)) {
            $select .= ',' . $this->tenantDb->escape_str($additionalFields);
        }

        $query = $this->tenantDb->select($select)
            ->where($where_conditions)
            ->get('Compliance_tasks');

        if (!is_object($query)) {
            return null;
        }

        return $query->row() ?: null;
    }

    public function getRecordsByDateRange(string $from, string $to): array {
        if (empty($from) || empty($to)) {
            return [];
        }

        $query = $this->tenantDb->select('cp.product_name, cr.no_of_cake, cr.best_before, DATE_FORMAT(cr.date_entered, "%d-%m-%Y") as date_entered_formatted')
            ->from('Compliance_cake_records_history cr')
            ->join('Compliance_cakeproducts cp', 'cp.id = cr.product_id', 'left')
            ->where('cr.date_entered >=', $from)
            ->where('cr.date_entered <=', $to)
            ->order_by('cr.date_entered', 'DESC')
            ->get();

        return is_object($query) ? ($query->result_array() ?? []) : [];
    }
    
    public function fetchWasteManagementHistoryData($fromDate, $toDate, $site_id = '') {
        $condition = array(
            'date_entered >=' => $fromDate,
            'date_entered <=' => $toDate,
            'location_id' => $this->session->userdata('selected_location_id')
        );
        if ($site_id != '') {
            $condition['site_id'] = $site_id;
        }
        $history_data = $this->common_model->fetchRecordsDynamically('Compliance_record_History', '', $condition);

        // Restructure data by date and product_id
        $restructuredArray = array();
        foreach ($history_data as $item) {
            $date_entered = $item['date_entered'];
            $product_id = $item['product_id'];
            if (!isset($restructuredArray[$date_entered])) {
                $restructuredArray[$date_entered] = array();
            }
            $restructuredArray[$date_entered][$product_id] = $item;
        }
        return $restructuredArray;
    }
}
?>