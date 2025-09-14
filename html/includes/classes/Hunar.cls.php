<?php
class Hunar extends SiteData {
    public $file_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp", "application/pdf"); 

    function getTotalPages() {
        $sql = "SELECT COUNT(*) as total_pages FROM ".HUNAR;
        $res = $this->getData($sql);
        return $res['oDATA'][0]['total_pages'] ?? 0;
    }

    function getAllData($page = 0, $orderby = "id", $order = "DESC") {
        $page = (int)$page;
        $sql = "SELECT * FROM ".HUNAR." ORDER BY $orderby $order LIMIT $page, ".PAGE_LIMIT;
        return $this->getData($sql);
    }

    function getActiveData($type = "") {
        $type = $this->escapeString($type);
        $sql = "SELECT * FROM ".HUNAR." WHERE h_status = '1' AND h_type = '$type' ORDER BY id DESC";
        return $this->getData($sql);
    }

    function getNewsLimit($limit = 6) {
        $limit = (int)$limit;
        $sql = "SELECT * FROM ".HUNAR." WHERE status = '1' ORDER BY id DESC, sort_order ASC LIMIT $limit";
        return $this->getData($sql);
    }

    function getAllActNews() {
        $sql = "SELECT * FROM ".HUNAR." WHERE status = '1' ORDER BY id DESC, sort_order ASC";
        return $this->getData($sql);
    }

    function getDataById($id) {
        $id = $this->escapeString($id);
        $sql = "SELECT * FROM ".HUNAR." WHERE md5(id) = '$id'";
        return $this->getData($sql);
    }

    function getNewsByUrl($url) {
        $url = $this->escapeString($url);
        $sql = "SELECT * FROM ".HUNAR." WHERE url = '$url' AND url != ''";
        return $this->getData($sql);
    }

    function addData($request) { 
        $h_type = $this->escapeString($request['h_type'] ?? '');
        $h_title = $this->escapeString($request['h_title'] ?? '');
        $h_updated = date("Y-m-d");

        if ($h_title == "") {
            setMessage('Please Provide Title.', "error");
            return false;
        }

        $h_file = "";
        if (!empty($_FILES['h_file']['name'])) {
            $h_file = $this->upload($_FILES['h_file'], "hunar");
        }

        $sql = "INSERT INTO ".HUNAR." (h_type, h_title, h_file, h_updated) VALUES ('$h_type', '$h_title', '$h_file', '$h_updated')";
        return $this->insert($sql);
    }

    function updateData($request) {
        $id = $this->escapeString($request['id'] ?? '');
        $h_type = $this->escapeString($request['h_type'] ?? '');
        $h_title = $this->escapeString($request['h_title'] ?? '');

        if ($h_title == "") {
            setMessage('Please Provide Title.', "error");
            return false;
        }

        if (!empty($_FILES['h_file']['name'])) {
            $h_file = $this->upload($_FILES['h_file'], "hunar");
            $sql = "UPDATE ".HUNAR." SET h_type = '$h_type', h_title = '$h_title', h_file = '$h_file' WHERE md5(id) = '$id'";
        } else {
            $sql = "UPDATE ".HUNAR." SET h_type = '$h_type', h_title = '$h_title' WHERE md5(id) = '$id'";
        }

        return $this->update($sql);
    }

    function disableStatus($id) {
        $id = $this->escapeString($id);
        $sql = "UPDATE ".HUNAR." SET h_status = '0' WHERE md5(id) = '$id'";
        return $this->update($sql);
    }

    function enableStatus($id) {
        $id = $this->escapeString($id);
        $sql = "UPDATE ".HUNAR." SET h_status = '1' WHERE md5(id) = '$id'";
        return $this->update($sql);
    }

    function deleteData($id) {
        $id = $this->escapeString($id);
        $sql = "SELECT h_file FROM ".HUNAR." WHERE md5(id) = '$id'";
        $res = $this->getData($sql);

        if (!empty($res['oDATA'][0]['h_file'])) {
            @unlink("../documents/" . $res['oDATA'][0]['h_file']);
        }

        $sql = "DELETE FROM ".HUNAR." WHERE md5(id) = '$id'";
        return $this->deleterecord($sql);
    }

    function upload($files, $t_name) {
        $file_type = $this->file_type;
        $photo_name = $files["name"];
        $paths = pathinfo($photo_name);
        $ext = $paths['extension'];
        $time = time();
        $target_file_name = $t_name . "_" . $time . "." . $ext;
        $target_file_path = "../documents/" . $target_file_name;

        move_uploaded_file($files["tmp_name"], $target_file_path);
        return $target_file_name;
    }

    function escapeString($value) {
        return $this->dbLink->real_escape_string(trim($value));
    }
}
?>
