<?php
    class StatisticsModel extends Database{
        //lấy danh sách tất cả hoas đơn bán ra
        public function getTaxInfoBySold($MST,$start_date,$end_date){
            $sql = "SELECT tax_info_sold.* FROM tax_info_sold
                    INNER JOIN company ON tax_info_sold.company_id = company.company_id
                    WHERE company.MST = :MST";
            $params['MST'] = $MST;
            // Xử lý điều kiện ngày
            if (!empty($start_date) && !empty($end_date)) {
                $sql .= " AND tax_info_sold.invoice_date BETWEEN :start_date AND :end_date";
                $params['start_date'] = $start_date;
                $params['end_date'] = $end_date;
            } else if (!empty($start_date)) {
                $sql .= " AND tax_info_sold.invoice_date >= :start_date";
                $params['start_date'] = $start_date;
            } else if (!empty($end_date)) {
                $sql .= " AND tax_info_sold.invoice_date <= :end_date";
                $params['end_date'] = $end_date;
            }
            $result = $this ->conn->prepare($sql);
            $result->execute($params);
            $row = $result -> fetchAll(PDO::FETCH_ASSOC);
            return ($row);
        } 

        //lấy danh sách tất cả hóa đơn mua vào được cấp mã
        public function getTaxInfoByPurchase($MST,$start_date,$end_date,$result){
            $sql = "SELECT tax_info_purchase.* FROM tax_info_purchase
                    INNER JOIN company ON tax_info_purchase.company_id = company.company_id
                    WHERE company.MST = :MST AND tax_info_purchase.invoice_result = :result";
            $params['MST'] = $MST;
            $params['result'] = $result;
            // Xử lý điều kiện ngày
            if (!empty($start_date) && !empty($end_date)) {
                $sql .= " AND tax_info_sold.invoice_date BETWEEN :start_date AND :end_date";
                $params['start_date'] = $start_date;
                $params['end_date'] = $end_date;
            } else if (!empty($start_date)) {
                $sql .= " AND tax_info_sold.invoice_date >= :start_date";
                $params['start_date'] = $start_date;
            } else if (!empty($end_date)) {
                $sql .= " AND tax_info_sold.invoice_date <= :end_date";
                $params['end_date'] = $end_date;
            }
            $result = $this ->conn->prepare($sql);
            $result->execute($params);
            $row = $result -> fetchAll(PDO::FETCH_ASSOC);
            return ($row);
        } 

    } 

?>