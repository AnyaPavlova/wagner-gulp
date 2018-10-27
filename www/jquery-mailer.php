<?php
	header("Content-Type: text/html; charset=utf-8");
	
	# Configuration
	#
	define('DESTINATION', 'aryastarikova@ya.ru');
	define('DESTINATION2', 'likamoon@list.ru');
	define('SCRIPT_URI',  'jquery-mailer.php');
		
	###############################################################
	
	function ok ($e = '') {
		header("Content-Type: application/json");
		print json_encode(array("status" => "ok", "error" => $e));
		exit();
	}
	
	function not_ok ($e) {
		header("Content-Type: application/json");
		print json_encode(array("status" => "not ok", "error" => $e));
		exit();
	}
		
	#Форма Задать вопрос
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["formType"] == "wagnerform" )
	{				
		$data_name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : null;
		if (!$data_name) {
			not_ok("Проверьте указано ли Имя");
		}	
		$data_company = isset($_POST['phone']) ? filter_var($_POST['phone'], FILTER_SANITIZE_STRING) : null;
		if (!$data_company) {
			not_ok("Проверьте указан ли Телефон");
		}
		
		$_subject = isset($_POST["formSubject"]) ? filter_var($_POST['formSubject'], FILTER_SANITIZE_STRING) :  null;
		
		$subject = "Заявка с сайта Wagner: " . $_subject . " от $data_name";
		
		$message = "Информация:
		Имя:            ".(isset($_POST["name"]) ?             filter_var($_POST['name'],            FILTER_SANITIZE_STRING) :  null)."
		Телефон:            ".(isset($_POST["phone"]) ?             filter_var($_POST['phone'],            FILTER_SANITIZE_STRING) :  null)."
		Дилерский центр:            ".(isset($_POST["selection-center"]) ?             filter_var($_POST['selection-center'],            FILTER_SANITIZE_STRING) :  null)."		
		Заявка: 				$_subject 
		Время заявки:       ".date("Y-m-d H:i:s")."
		";
		
		$headers =  "From: info@" . $_SERVER['HTTP_HOST']. "\r\n" .
		"Reply-To: e-conf@" . $_SERVER['HTTP_HOST']. "\r\n" .
		"Content-type: text/plain; charset=\"utf-8\"" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
		if ( mail(DESTINATION, $subject, $message, $headers) && mail(DESTINATION2, $subject, $message, $headers) )
        ok();
		else
        not_ok("Ошибка. Возможно функция mail отключена. Обратитесь к хостинг-провайдеру или возьмите консультацию на сайте, где купили шаблон");
		
	}		

	elseif ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		not_ok("Все поля обязательны к заполнению");
	}
	
	header("Content-Type: text/javascript");
	
?>

    $(':submit').click(function () {		
		var $form = $(this).closest('form');  
		var $success = $form.find('.block_success').val($(this).attr('class'));

		$(this).attr("disabled", "disabled");
		$.post(
			"<?php echo addslashes(SCRIPT_URI) ?>",
			$form.serialize(),
			function ($response) {
				if ($response.status == "ok") {					
					$success.css("display", "block");
					<!-- $form.html($success);  -->					
					<!-- $form.html("<div class='block_success'><p>Спасибо, ваше сообщение отправлено!</p> <p>Мы свяжемся с Вами в ближайшее время</p></div>"); -->
				}
				else {
					window.alert("Сообщение НЕ отправлено! " + $response.error);
				}
			},
			"json"
		);
		$(this).removeAttr("disabled");
		return false;
	});

