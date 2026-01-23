<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        // Load models used by this controller
        $this->load->model('task_model');
        $this->load->model('prep_model');
        $this->load->model('general_model');

        $this->selected_location_id = $this->session->userdata('location_id');

        // Form validation library already autoloaded in many apps, otherwise:
        $this->load->library('form_validation');
    }

    /**
     * Show add form
     */
    public function index($system_id = '')
    {
       
        $data['prep_detail'] = $this->prep_model->fetchAllPrepArea('Compliance_prepArea','Compliance_sites');
        $data['roles'] = get_all_roles($this->ion_auth, $this->selected_location_id);

        $this->load->view('general/header');
        $this->load->view('task/taskAdd', $data);
        $this->load->view('general/footer');
    }

    /**
     * Validate common task fields
     */
    protected function validate_task_input()
    {
        $this->form_validation->set_rules('task_name', 'Task name', 'trim|required');
        $this->form_validation->set_rules('prep_id', 'Prep area', 'required|integer');
        $this->form_validation->set_rules('schedule_at', 'Schedule', 'required|integer');
        // role_id[] can be optional but if present must be an array
        // Using callback to check array existence
        $this->form_validation->set_rules('role_id[]', 'Roles', 'callback__roles_check');
        $this->form_validation->set_rules('task_time[]', 'Task time', 'callback__task_time_check');
    }

    // Callback to validate roles array
    public function _roles_check($val)
    {
        $roles = $this->input->post('role_id');
        if (empty($roles) || !is_array($roles)) {
            // If you want roles to be required, return false here
            return TRUE; // allow empty roles but ensure type
        }
        return TRUE;
    }

    // Callback to validate task_time array
    public function _task_time_check($val)
    {
        $times = $this->input->post('task_time');
        if (empty($times) || !is_array($times)) {
            $this->form_validation->set_message('_task_time_check', 'Please provide at least one time.');
            return FALSE;
        }
        // Optionally validate time format for each value
        return TRUE;
    }

    /**
     * Build array for DB insert/update from POST + single $taskTime
     */
    protected function build_task_data($taskTime)
    {
        $scheduleDateRaw = $this->input->post('schedule_date', TRUE);
        $timestamp = ($scheduleDateRaw ? strtotime($scheduleDateRaw) : false);
        $schedule_date = ($timestamp ? date('Y-m-d', $timestamp) : null);

        $roles = $this->input->post('role_id', TRUE);
        // ensure we always serialize an array
        $roles_serialized = (!empty($roles) && is_array($roles)) ? serialize($roles) : serialize([]);

        return [
            'task_name' => $this->input->post('task_name', TRUE),
            'role_id' => $roles_serialized,
            'schedule_date' => $schedule_date,
            'schedule_type' => $this->input->post('schedule_type', TRUE) ?: '',
            'schedule_dayName' => $this->input->post('schedule_dayName', TRUE) ?: '',
            'repeatWhichWeek' => $this->input->post('repeatWhichWeek', TRUE) ?: '',
            'task_time' => $taskTime,
            'prep_id' => $this->input->post('prep_id', TRUE) ?: '',
            'schedule_at' => $this->input->post('schedule_at', TRUE),
            'is_attchmentRequired' => ($this->input->post('is_attchmentRequired') ? 1 : 0),
            'status' => 1,
            'location_id' => $this->session->userdata('location_id'),
            'created_date' => date('Y-m-d'),
        ];
    }

    /**
     * Add task(s)
     * Inserts one DB record per task_time[] value inside a DB transaction.
     */
    public function add()
    {
        $this->validate_task_input();

        if ($this->form_validation->run() === FALSE) {
            // Show form with validation errors
            $data['message'] = validation_errors();
            $data['prep_detail'] = $this->prep_model->fetchAllPrepArea('Compliance_prepArea','Compliance_sites');
            $data['roles'] = get_all_roles($this->ion_auth, $this->selected_location_id);

            $this->load->view('general/header');
            $this->load->view('task/taskAdd', $data);
            $this->load->view('general/footer');
            return;
        }

        $taskTimes = $this->input->post('task_time', TRUE);
        if (empty($taskTimes) || !is_array($taskTimes)) {
            $this->session->set_flashdata('error', 'Please provide at least one task time.');
            redirect('Compliance/Task', 'refresh');
        }

        // Use DB transaction to ensure atomicity for multiple inserts
        $this->tenantDb->trans_start();

        foreach ($taskTimes as $taskTime) {
            $taskTime = trim($taskTime);
            if ($taskTime === '') {
                continue; // skip empty entries
            }

            $equip_data = $this->build_task_data($taskTime);

            // Insert and optionally check result
            $this->task_model->add_task($equip_data);
        }

        $this->tenantDb->trans_complete();

        if ($this->tenantDb->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Unable to save task(s). Please try again.');
            redirect('Compliance/Task', 'refresh');
        }

        $this->session->set_flashdata('success', 'Task(s) saved successfully.');
        redirect('Compliance/Task/fetchTaskList', 'refresh');
    }

    /**
     * Edit a single task record (by $id)
     * - Updates the given record with the first task_time value
     * - For additional task_time[] items, inserts new rows only if not already present (avoid duplicates)
     */
    public function edit($id = null)
    {
        // Ensure ID provided and valid
        if (empty($id) || !is_numeric($id)) {
            show_404();
        }

        // Fetch existing task (or 404)
        $existing = $this->task_model->fetchTaskList($id);
        if (empty($existing)) {
            show_404();
        }

        // If no POST, show edit form
        if ($this->input->post() === NULL) {
            $data['taskData'] = $existing[0];
           $data['prep_detail'] = $this->prep_model->fetchAllPrepArea('Compliance_prepArea','Compliance_sites');
            $data['roles'] = get_all_roles($this->ion_auth, $this->selected_location_id);

            $this->load->view('general/header');
            $this->load->view('task/taskAdd', $data);
            $this->load->view('general/footer');
            return;
        }

        // Validate input
        $this->validate_task_input();

        if ($this->form_validation->run() === FALSE) {
            $data['message'] = validation_errors();
            $data['taskData'] = $existing[0];
            $data['prep_detail'] = $this->prep_model->fetchAllPrepArea('Compliance_prepArea','Compliance_sites');
            $data['roles'] = get_all_roles($this->ion_auth, $this->selected_location_id);

            $this->load->view('general/header');
            $this->load->view('task/taskAdd', $data);
            $this->load->view('general/footer');
            return;
        }

        $taskTimes = $this->input->post('task_time', TRUE);
        if (empty($taskTimes) || !is_array($taskTimes)) {
            $this->session->set_flashdata('error', 'Please provide at least one task time.');
            redirect('Compliance/Task/edit/' . $id, 'refresh');
        }

        // Start transaction for update + potential inserts
        $this->tenantDb->trans_start();

        // 1) Update the existing record with the first non-empty task_time
        $firstTime = null;
        foreach ($taskTimes as $tt) {
            if (trim($tt) !== '') {
                $firstTime = trim($tt);
                break;
            }
        }

        if ($firstTime === null) {
            $this->tenantDb->trans_rollback();
            $this->session->set_flashdata('error', 'Please provide a valid time for the task.');
            redirect('Compliance/Task/edit/' . $id, 'refresh');
        }

        $updateData = $this->build_task_data($firstTime);
        // Remove created_date for update (keep original)
        unset($updateData['created_date']);

        $this->general_model->updateDataInOrzDb('Compliance_tasks', 'id', $id, $updateData);

        // 2) For remaining times: insert only if a record with same task_name, prep_id and task_time doesn't already exist.
        if (count($taskTimes) > 1) {
            array_shift($taskTimes); // remove firstTime already used for update
            foreach ($taskTimes as $tt) {
                $tt = trim($tt);
                if ($tt === '') continue;

                // Check for existing duplicate
                $exists = $this->task_model->task_exists([
                    'task_name' => $this->input->post('task_name', TRUE),
                    'prep_id' => $this->input->post('prep_id', TRUE),
                    'task_time' => $tt,
                ]);

                if (!$exists) {
                    $insertData = $this->build_task_data($tt);
                    $this->task_model->add_task($insertData);
                }
                // if exists, skip to avoid duplicate rows
            }
        }

        $this->tenantDb->trans_complete();

        if ($this->tenantDb->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Unable to update task. Please try again.');
            redirect('Compliance/Task/edit/' . $id, 'refresh');
        }

        $this->session->set_flashdata('success', 'Task updated successfully.');
        redirect('Compliance/Task/fetchTaskList', 'refresh');
    }

    /**
     * List tasks view
     */
    public function fetchTaskList()
    {
        $result = $this->task_model->fetchTaskList();
        $data['taskList'] = $result;

        $this->load->view('general/header');
        $this->load->view('task/taskList', $data);
        $this->load->view('general/footer');
    }

    /**
     * Update sort order (expects array order[] from JS)
     */
    public function updateSortOrder()
    {
        $newOrder = $this->input->post('order', TRUE);
        if (empty($newOrder) || !is_array($newOrder)) {
            echo "error";
            return;
        }

        $this->tenantDb->trans_start();

        foreach ($newOrder as $index => $itemId) {
            // Your JS may prefix item id with 'row_' etc - adjust accordingly
            // Example original used substr($itemId, 4)
            if (strpos($itemId, '_') !== false) {
                $parts = explode('_', $itemId);
                $equipID = end($parts);
            } else {
                $equipID = $itemId;
            }

            $this->tenantDb->set('sort_order', $index + 1);
            $this->tenantDb->where('id', (int)$equipID);
            $this->tenantDb->update('Compliance_tasks');
        }

        $this->tenantDb->trans_complete();

        if ($this->tenantDb->trans_status() === FALSE) {
            echo "error";
        } else {
            echo "success";
        }
    }

    /**
     * Delete multiple rows (expects table_name and selected_values[])
     */
    public function deleteMultiple()
    {
        $table_name = $this->input->post('table_name', TRUE);
        $selected_values = $this->input->post('selected_values', TRUE);

        if (empty($table_name) || empty($selected_values) || !is_array($selected_values)) {
            echo json_encode(['status' => false, 'message' => 'Invalid parameters']);
            return;
        }

        $deleted = $this->general_model->deleteMultiple($table_name, $selected_values);

        if ($deleted) {
            echo json_encode(['status' => true, 'message' => 'Deleted successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Delete failed']);
        }
    }
}
?>