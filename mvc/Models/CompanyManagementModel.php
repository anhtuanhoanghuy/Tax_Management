<?php
    class CompanyManagementModel extends Database{
        //lấy danh sách tất cả công ty
        public function getCompanyList($username){
            $sql = "SELECT company.company_name, company.MST, company.pass_word FROM company
                    JOIN account ON company.account_id = account.account_id
                    WHERE account.user_name = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$username]);
            $row = $result -> fetchAll(PDO::FETCH_ASSOC);
            return ($row);
        } 

        public function addCompany($username,$company_name,$MST,$password){
            $sql = "SELECT company.company_name, company.MST, company.pass_word FROM company
                    JOIN account ON company.account_id = account.account_id
                    WHERE account.user_name = ? AND company.MST = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$username,$MST]);
            if ($result->rowCount() > 0) {
                // Có bản ghi -> trùng lặp
                return 0;
            } else {
                $sql = "INSERT INTO company (company_name, MST, pass_word, account_id)
                        SELECT ?, ?, ?, account_id FROM account WHERE user_name = ?";
                $result = $this ->conn->prepare($sql);
                $result->execute([$company_name,$MST,$password,$username]);
                if ($result->rowCount() > 0) { //thành công
                    return 1;
                } else { // Không có dòng nào được thêm
                    return -1;
                }
            
            }
            
        } 
//nếu mst không tha đổi thì sửa thông tin, mst thay đổi thì check mst mới có trùng khôngkhông
        public function changeCompanyInfo($username,$old_MST,$company_name,$MST,$password) {
            if ($MST == $old_MST) { //khong thay doi MST
                $sql = "UPDATE company
                SET company_name = ?, MST = ?, pass_word = ?
                WHERE MST = ?";
                $result = $this -> conn->prepare($sql);
                $result->execute([$company_name, $MST, $password, $old_MST]);
                if ($result->rowCount() > 0) { //thành công
                    return 1;
                } else { //không thay đổi
                    return 2;
                }
            } else {
                $sql = "SELECT * FROM company WHERE MST = ? OR company_name = ?";
                $result = $this -> conn->prepare($sql);
                $result->execute([$MST, $company_name]);
                $row= $result->fetchAll(PDO::FETCH_ASSOC);
    
                if (count($row) > 0) { //đã tồn tại MST này.
                    return 0;
                } else {
                    $sql = "UPDATE company
                            SET company_name = ?, MST = ?, pass_word = ?
                            WHERE MST = ?";
                    $result = $this -> conn->prepare($sql);
                    $result->execute([$company_name, $MST, $password, $old_MST]);
                    if ($result->rowCount() > 0) { //thành công
                        return 1;
                    } else { //lỗi
                        return -1;
                    }
                }
            }
        }

        public function deleteCompany($MST){
            $sql = "DELETE FROM company WHERE MST = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$MST]);
            if ($result->rowCount() > 0) { //Xoá thành công.
                return 1;
            } else {
                return 0;
            }         
        } 

    } 

?>