<?php

class Test extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Test_model');
    }

    public function index()
    {
        $Alltest = $this->Test_model->getAlltest();
        $Allunit = $this->Test_model->getAllunit();
        $Alldepartment = $this->Test_model->getAlldepartment();

        $loggedInId = $_COOKIE['loggedInId'];
        $loggedData = $this->Test_model->getuserbyID($loggedInId);
        $loggedData = $loggedData[0];

        $data = array('Alltest' => $Alltest,'loggedData'=>$loggedData, 'Allunit' => $Allunit, 'Alldepartment' => $Alldepartment);
        $this->load->view('test/index.php', $data);
    }
    public function addTest()
    {

        if ($this->input->post('department')) {
            $department = $this->input->post('department');
            $testName = $this->input->post('testName');
            $test_amount = $this->input->post('test_amount');
            $test_status = $this->input->post('test_status');

            $add = $this->Test_model->addtest($department, $testName, $test_amount, $test_status);

            if ($add) {
                $resultss = array('success' => 1, 'msg' => 'Test Added.', 'redirect_url' => '');
                echo json_encode($resultss);
                exit();
            } else {

                $resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
                echo json_encode($resultss);
                exit();
            }
        } else {
            header('location:' . BASE_URL);
        }
    }

    public function testEdit()
    {
        $id = $this->input->post('id');
        $testData = $this->Test_model->testEdit($id);
        $testData = $testData[0];
        echo json_encode($testData);
    }
    public function updateTest()
    {
        if ($this->input->post('department')) {
            $department = $this->input->post('department');
            $testName = $this->input->post('testName');
            $test_amount = $this->input->post('test_amount');
            $edit_test_status = $this->input->post('edit_test_status');

            $id = $this->input->post('id');

            $update = $this->Test_model->testUpdate($department, $testName, $test_amount, $edit_test_status, $id);

            if ($update) {
                $resultss = array('success' => 1, 'msg' => 'Test updated.', 'redirect_url' => '');
                echo json_encode($resultss);
                exit();
            } else {

                $resultss = array('success' => 0, 'msg' => 'Error occured.', 'redirect_url' => '');
                echo json_encode($resultss);
                exit();
            }
        } else {
            header('location:' . BASE_URL);
        }
    }
    public function getAutoComplete()
    {
        $search = $_GET['term'];
        if (!empty($search)) {
            $data = $this->Test_model->testSearch($search);
            echo json_encode($data);
            exit;
        }
    }
    public function selectTest()
    {
        $department = $_POST['department'];
        $test = [];
        if (isset($_POST['test'])) {
            $test[] = implode(',', $_POST['test']);
        }

        if (!empty($department)) {
            $data = $this->Test_model->getTestByDepartment($department);
            if (count($data) > 0) {
                $ulData = "<ul class='test-list'>";
                foreach ($data as $dd) {
                    if ($test && in_array($dd->id, $test)) {
                        $ulData .= "<li class='check-group'><input type='checkbox' checked='true' disabled name='test_list[]' id='test_list" . $dd->id . "' class='check_list' value='" . $dd->id . "'><label for='test_list" . $dd->id . "'>" . $dd->test_name . "</label></li>";
                    } else {
                        $ulData .= "<li class='check-group'><input type='checkbox' name='test_list[]' id='test_list" . $dd->id . "' class='check_list' value='" . $dd->id . "'><label for='test_list" . $dd->id . "'>" . $dd->test_name . "</label></li>";
                    }
                }
                $ulData .= "</ul>";
            } else {
                $ulData = '<ul class="test-list"><h6>No Test Found </h6></ul>';
            }
            echo json_encode($ulData);
            exit;
        }
    }
    public function testSubmit()
    {
        $temp_value = $this->input->post('temp');
        if (isset($temp_value)) {

            $temp = implode(",", $temp_value);
            $data = $this->Test_model->testWhereIn($temp);
            $list = "";
            if (count($data) > 0) {
                foreach ($data as $dd) {
                    $list .= "<tr><td>" . $dd->test_name . "<input type='hidden' name='testId[]' id='testId' value='" . $dd->id . "' class='form-control testId' readonly></td>
                    <td><input type='text' name='testAmount[]' id='testAmount' value='" . $dd->amount . "' class='form-control testAmount' readonly><input type='hidden' name='discount_value[]' id='discount_value' value='0'><input type='hidden' name='discountAmount[]' id='discountAmount' value='0' class='form-control testAmount' readonly></td><td><a href='#' class='remove_this btn btn-danger'>X</a></td></tr>";
                }
            }

            echo json_encode($list);
        }
    }
}
