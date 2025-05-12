<?php
    class App{
        protected $controller = "Home";
        protected $action = "showMainPage";
        protected $params = [];
    function __construct() {
    $arr = $this->UrlProcess();

    // Cho phép những request AJAX đặc biệt không cần đăng nhập
    $allowedNoLogin = [
        ['Login', 'checkLoginAccount'],
        // Thêm các controller/action khác nếu cần
    ];

    $controllerCheck = isset($arr[0]) ? $arr[0] : $this->controller;
    $actionCheck = isset($arr[1]) ? $arr[1] : $this->action;

    $skipLogin = false;
    foreach ($allowedNoLogin as $route) {
        if ($route[0] == $controllerCheck && $route[1] == $actionCheck) {
            $skipLogin = true;
            break;
        }
    }

    // Nếu không được phép và chưa đăng nhập thì chặn
    if (!$skipLogin && !isset($_SESSION['account'])) {
        require_once("./mvc/Views/Login.php");
        exit();
    }

    // Xử lý routing bình thường
    if ($arr != null) {
        if (file_exists("./mvc/Controllers/" . $arr[0] . ".php")) {
            $this->controller = $arr[0];
            unset($arr[0]);
        }
    }

    require_once("./mvc/Controllers/" . $this->controller . ".php");
    $this->controller = new $this->controller;

    if (isset($arr[1])) {
        if (method_exists($this->controller, $arr[1])) {
            $this->action = $arr[1];
        }
        unset($arr[1]);
    }

    $this->params = $arr ? array_values($arr) : [];
    call_user_func_array([$this->controller, $this->action], $this->params);
}

        function UrlProcess() {
            if(isset($_GET["url"])) {
                return explode("/", filter_var(trim($_GET["url"], "/")));
            }
        }

		// Kiểm tra một xâu ký tự có phải là text hay không
		// Input: $s
		// Điều kiện: Chỉ bao gồm các ký tự tiếng Việt và chữ số, dấu -, dấu trắng
        public static function isText($s) {
			$c1 = preg_match("/^[0-9a-zA-Záàạảãăắằặẳẵâấầậẩẫéèẹẻẽêếềệểễíìịỉĩóòọỏõôốồộổỗơớờợởỡúùụủũưứừựửữ\s\-]*$/", $s);
			if ($c1 == 1) return true;
			else return false;
		} 
    }
?>