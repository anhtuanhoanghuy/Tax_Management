<?php 
    require_once("JWT.php");
    class Controller {
        public static $secret_signature = "tax_management_admin";
        public static function model($model) {
            require_once("./mvc/Models/".$model.".php");
            return new $model;
        }

        public static function view($view, $data = []) {
            require_once ("./mvc/Views/".$view.".php");
        }

         // ✅ Phương thức kiểm tra token và session
        public static function verifyRequest() {
            $headers = getallheaders();

            if (!isset($headers["Authorization"])) {
                http_response_code(401);
                echo json_encode(["error" => "Missing token"]);
                exit;
            }

            $token = str_replace("Bearer ", "", $headers["Authorization"]);

            try {
                $decoded = JWT::decode($token, self::$secret_signature,true);

                if (!isset($_SESSION["account"]) || $_SESSION["account"] !== $decoded) {
                    http_response_code(403);
                    echo json_encode(["error" => "Invalid session"]);
                    exit;
                }

                // ✅ Nếu cần, bạn có thể trả về thông tin user:
                return $decoded;

            } catch (Exception $e) {
                http_response_code(401);
                echo json_encode(["error" => "Invalid token"]);
                exit;
            }
        }
    } 
?>