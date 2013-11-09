<?php
	phpinfo();
	header("content-type:text/html;charset=utf-8");
	set_time_limit(0);
	define("DEBUG", false);
	$path = "D:/wamp/www/wap/templates";
	$type = ".tpl";
	$fileName = $path . "/templet-dirlist.inc";
	$fileUtil = new FileUtil();
	/*$fileList = $fileUtil -> getFileList($path, $type);
	$fileUtil -> createFile($fileName);
	foreach($fileList as $key => $value) {
		$fileUtil -> writeFile($fileName, $value["fileName"] . "," . $value["fileName"]);
		$fileUtil -> writeFileLN($fileName);
	}*/

	$url = "http://www.younet.com/";
	$netWorkUtil = new NetWorkUtil();
	//$netWorkUtil -> get_phone_catagory($url);
	//$netWorkUtil -> update_phone_catagory($url);
	$url = "http://mobile.younet.com/nokia";
	//$netWorkUtil -> get_phone_list($url, "nokia");
	//$netWorkUtil -> set_phone_network($url, "nokia");
	$url = "http://mobi.younet.com/files/25/25052.html";
	//$netWorkUtil -> get_phone_info($url, "nokia", 25052);
	$url = "http://mobi.zhangyue.com:15000/MTK/?key=101_21_30B30&pc=10&p1=1305529733796451525&p2=100278&p3=5300&p4=501604&p5=4&p6=IJABEBADCBBBBIFBAHCA&p7=AAAAAAAAAAAAAAA&p8=&p9=0&p15=0&p16=SonyEricssonK800&p17=palmeread&p19=1.10";
	//echo $netWorkUtil -> gzip_decode($netWorkUtil -> get_contents($url));

	//$fileUtil -> getFile("D:/phone/qunar_files/touch.css", "D:/phone/qunar_files/css/touch.css");
	//$fileUtil -> getFile("D:/phone/qunar_files/touch_002.css", "D:/phone/qunar_files/css/touch_002.css");
	$monthEnd = date("Y-m-d", mktime(0, 0, 0, date("m")+1, 0, date("Y")));
	$hadoopHashId = 4207488029786584864;
	echo "$hadoopHashId" . PHP_INT_MAX;//2147483647
	print_r($_SERVER);
	$method_controller = "setDownloadInfo";
	if(stripos($method_controller, "get") === 0) {
		echo "setDownloadInfo";
	}
	$method_controller = "getDownloadInfo";
	if(stripos($method_controller, "get") === 0) {
		echo "getDownloadInfo";
	}
	$orderId = "111111111";
	echo substr($orderId, 0, strlen($orderId) - 5);
	function isPhone($phoneNum) {
		if(strlen($phoneNum) != 11)
			return false;
		$pattern = "/^(((13[0-9]{1})|15[0-9]{1}|18[0-9]{1}|)[0-9]{8})$/";
		if(!preg_match($pattern, $phoneNum, $matches, PREG_OFFSET_CAPTURE)) {
			return false;
		}
		return true;
	}
	$phoneNum = "18910979747";
	if(isPhone($phoneNum)) {
		echo $phoneNum . "是手机号";
	}
	$phoneNum = "1";
	if(!isPhone($phoneNum)) {
		echo $phoneNum . "不是手机号";
	}

	$str = "０１２３ＡＢＣＤＦＷＳ＼＂，．？＜＞｛｝［］＊＆＾％＃＠！～（）＋－｜：；";
	echo "$str";
	echo "<br />";
	$str = preg_replace('/\xa3([\xa1-\xfe])/e', 'chr(ord(\1)-0x80)', $str);
	echo $str;

	class FileUtil {
		function __construct() {

		}

		function getFileList($path, $type) {
			if (!is_dir($path))
				return false;
			$dirhandle = opendir($path);
			$arrayFileName = array();
			while(($file = readdir($dirhandle)) !== false) {
				if (($file != ". ") && ($file!= ".. ")) {
					$typelen = 0 - strlen($type);

					if (substr($file, $typelen) == $type)
						$arrayFileName[] = array(
							"fileName" => substr($file, 0, strlen($file) + $typelen)
						);
				}
			}
			closedir($dirhandle);
			return $arrayFileName;
		}

		function writeFile($fileName, $content) {
			$file = fopen($fileName, "a+");
			fwrite($file, $content);
			fclose($file);
		}

		function writeFileLN($fileName, $content = "\n") {
			$this -> writeFile($fileName, $content);
		}

		function createFile($fileName) {
			$file = fopen($fileName, "w+");
			fclose($file);
		}

		function file_get_contents($fileName) {
			return file_get_contents($fileName);
		}

		function readFile($fileName) {
			return fgets($fileName);
		}

		function getFile($fromFileName, $toFileName) {
			$fileName = $fromFileName;
			$file = fopen($fileName, "r");
			$writeFileName = $toFileName;
			$writeFile = fopen($writeFileName, "w");
			while(!feof($file)) {
				$char = fgetc($file);
				echo $char;
				fwrite($writeFile, $char);
				if($char == ";") {
					echo "<br />";
					fwrite($writeFile, "\r");
				}
				if($char == "{") {
					echo "<br />";
					fwrite($writeFile, "\r");
				}
				if($char == "}") {
					echo "<br />";
					fwrite($writeFile, "\r");
				}
			}
			fclose($file);
			fclose($writeFile);
			//$writeFileName = "D:/phone/qunar_files/css/touch.css";
			$file = file_get_contents($writeFileName);
			$file = explode("\r", $file);
			$writeFile = fopen($writeFileName, "w");
			$tab = false;
			foreach($file as $key => $value) {
				if($value == "}") {
					$tab = false;
				}
				if($tab) {
					echo "&nbsp;&nbsp;";
					fwrite($writeFile, "\t");
				}
				echo $value;
				fwrite($writeFile, $value);
				if(stripos($value, "{") > 0) {
					$tab = true;
				}
				echo "<br />";
				fwrite($writeFile, "\r");
			}
			fclose($writeFile);
		}
	}

	class NetWorkUtil {
		var $category = "category";
		var $db = null;
		var $categoryArray = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

		function __construct() {
			$this -> db = new DbUtil();
		}

		function get_category() {
			$category = array();
			for($i = 97 ; $i <= 97 + 25 ; $i++) {
				$category[] = chr($i);
			}
			return $category;
		}

		function get_contents($url) {
			return file_get_contents($url);
		}

		function gzdecode($data) {
			gzdecode($data);
		}

		function gzip_decode($content) {
			$flags = ord(substr($content, 3, 1));
			$headerlen = 10;
			$extralen = 0;
			$filenamelen = 0;
			if ($flags & 4) {
				$extralen = unpack('v' ,substr($content, 10, 2));
				$extralen = $extralen[1];
				$headerlen += 2 + $extralen;
			}
			if ($flags & 8) // Filename
				$headerlen = strpos($content, chr(0), $headerlen) + 1;
			if ($flags & 16) // Comment
				$headerlen = strpos($content, chr(0), $headerlen) + 1;
			if ($flags & 2) // CRC at end of file
				$headerlen += 2;
			$unpacked = @gzinflate(substr($content, $headerlen));
			if ($unpacked === FALSE)
				$unpacked = $content;
			return $unpacked;
		}

		function get_contents_byRegular($url, $regular = "") {
			$array = file($url);
			foreach($array as $key => $value) {
				if(strpos($value, "category_")) {
					$divhtml = $array[$key + 1];
					$divhtml = $this -> html_separator($divhtml, "</a>");
					foreach($divhtml as $htmlkey => $htmlvalue) {
						if(trim($htmlvalue) == "</div>")
							continue;
						$href_position = $this -> get_att_position($htmlvalue, "href");
						$target_position = $this -> get_att_position($htmlvalue, "\" target");
						$href = substr($htmlvalue, $href_position + 6, $target_position - ($href_position + 6));
						$tag_position = strrpos($href, "/");
						$e_phonename = substr($href, $tag_position + 1);

						$tag_position = $this -> get_att_position($htmlvalue, ">");
						$phonename = $this -> gb2utf(substr($htmlvalue, $tag_position + 1));

						$sql = "insert into catagory(catagory_id, catagory_name) values ('$e_phonename', '$phonename')";
						$this -> db -> execute($sql);

						$this -> get_phone_list($href, $e_phonename);
					}
				}
			}
		}

		function get_phone_catagory($url) {
			$array = file($url);
			foreach($array as $key => $value) {
				if(strpos($value, "category_")) {
					$divhtml = $array[$key + 1];
					$divhtml = $this -> html_separator($divhtml, "</a>");
					foreach($divhtml as $htmlkey => $htmlvalue) {
						if(trim($htmlvalue) == "</div>")
							continue;
						$href_position = $this -> get_att_position($htmlvalue, "href");
						$target_position = $this -> get_att_position($htmlvalue, "\" target");
						$href = substr($htmlvalue, $href_position + 6, $target_position - ($href_position + 6));
						$tag_position = strrpos($href, "/");
						$e_phonename = substr($href, $tag_position + 1);

						$tag_position = $this -> get_att_position($htmlvalue, ">");
						$phonename = $this -> gb2utf(substr($htmlvalue, $tag_position + 1));
						$this -> printf($e_phonename);
						$this -> writeLine();
						$this -> printf($phonename);
						$this -> writeLine();

						$sql = "insert into catagory(catagory_id, catagory_name) values ('$e_phonename', '$phonename')";
						$this -> db -> execute($sql);

						$this -> get_phone_list($href, $e_phonename);
					}
				}
			}
		}

		function get_phone_list($url, $e_phonename) {
			$array = file($url);
			foreach($array as $key => $value) {
				if(strpos($value, "ip-pn")) {
					$href_position = $this -> get_att_position($value, "href");
					$target_position = $this -> get_att_position($value, "\" target");
					$href = substr($value, $href_position + 6, $target_position - ($href_position + 6));
					$tag_position = strrpos($href, "/");
					$html_position = strpos($href, ".html");
					$phone_id = substr($href, $tag_position + 1, $html_position - ($tag_position + 1));
					$target_position = $this -> get_att_position($value, "target=\"_blank\">");
					$tag_position = $this -> get_att_position($value, "</a>");
					$phone_name = $this -> gb2utf(substr($value, $target_position + 16, $tag_position - ($target_position + 16)));
					$this -> printf($phone_id);
					$this -> writeLine();
					$this -> printf($phone_name);
					$this -> writeLine();

					$sql = "insert into phone_info(catagory_id, phone_id, phone_name) values ('$e_phonename', $phone_id, '$phone_name')";
					$this -> db -> execute($sql);

					$this -> get_phone_info($href, $e_phonename, $phone_id);
				}
				if(strpos($value, "more-mobi")) {
					$href_position = $this -> get_att_position($value, "href");
					$target_position = $this -> get_att_position($value, "\" target");
					$href = substr($value, $href_position + 6, $target_position - ($href_position + 6));
					$this -> get_phone_list($href, $e_phonename);
				}
			}
		}

		function update_phone_catagory($url) {
			$array = file($url);
			foreach($array as $key => $value) {
				if(strpos($value, "category_")) {
					$divhtml = $array[$key + 1];
					$divhtml = $this -> html_separator($divhtml, "</a>");
					foreach($divhtml as $htmlkey => $htmlvalue) {
						if(trim($htmlvalue) == "</div>")
							continue;
						$href_position = $this -> get_att_position($htmlvalue, "href");
						$target_position = $this -> get_att_position($htmlvalue, "\" target");
						$href = substr($htmlvalue, $href_position + 6, $target_position - ($href_position + 6));
						$tag_position = strrpos($href, "/");
						$e_phonename = substr($href, $tag_position + 1);

						$tag_position = $this -> get_att_position($htmlvalue, ">");
						$phonename = $this -> gb2utf(substr($htmlvalue, $tag_position + 1));
						$this -> printf($e_phonename);
						$this -> writeLine();
						$this -> printf($phonename);
						$this -> writeLine();

						$this -> set_phone_network($href, $e_phonename);
					}
				}
			}
		}

		function set_phone_network($url, $e_phonename) {
			$array = file($url);
			$phone_id = 0;
			foreach($array as $key => $value) {
				if(strpos($value, "ip-pn")) {
					$href_position = $this -> get_att_position($value, "href");
					$target_position = $this -> get_att_position($value, "\" target");
					$href = substr($value, $href_position + 6, $target_position - ($href_position + 6));
					$tag_position = strrpos($href, "/");
					$html_position = strpos($href, ".html");
					$phone_id = substr($href, $tag_position + 1, $html_position - ($tag_position + 1));
					$target_position = $this -> get_att_position($value, "target=\"_blank\">");
					$tag_position = $this -> get_att_position($value, "</a>");
					$phone_name = $this -> gb2utf(substr($value, $target_position + 16, $tag_position - ($target_position + 16)));
					$this -> printf($phone_id);
					$this -> writeLine();
					$this -> printf($phone_name);
					$this -> writeLine();
				}
				if(strpos($value, "ip-network")) {
					$spanhtml = $array[$key + 1];
					$spanstart_position = 0;
					$spanend_position = $this -> get_att_position($spanhtml, "</span>");
					$phone_network = substr($spanhtml, $spanstart_position, $spanend_position);
					$phone_network = $this -> gb2utf($phone_network);

					$sql = "update phone_info set network='$phone_network' where phone_id=$phone_id";
					$this -> printf($sql);
					$this -> db -> execute($sql);
				}
				if(strpos($value, "more-mobi")) {
					$href_position = $this -> get_att_position($value, "href");
					$target_position = $this -> get_att_position($value, "\" target");
					$href = substr($value, $href_position + 6, $target_position - ($href_position + 6));
					$this -> set_phone_network($href, $e_phonename);
				}
			}
		}

		function get_phone_info($url, $e_phonename, $phone_id) {
			$array = file($url);
			$sql = "update phone_info set ";
			foreach($array as $key => $value) {
				if(strpos($value, "<dt>")) {
					//$this -> printf($this -> gb2utf(htmlspecialchars($value)));
					$dtstart_position = $this -> get_att_position($value, "<dt>");
					$dtend_position = $this -> get_att_position($value, "</dt>");
					$column_name = substr($value, $dtstart_position + 4, $dtend_position - ($dtstart_position + 4));
					//$this -> printf($this -> gb2utf($column_name));
					$column_name = $this -> gb2utf($column_name);
					if($column_name == "参考报价:") {
						$ddhtml = $array[$key + 1];
						$target_position = strrpos($ddhtml, "target");
						$tag_position = strrpos($ddhtml, "</a>");
						$column_value = substr($ddhtml, $target_position + 16, $tag_position - ($target_position + 16));
						$column_value = $this -> gb2utf($column_value);
						$this -> printf($column_name);
						$this -> writeLine();
						$this -> printf($column_value);
						$this -> writeLine();
						$sql .= " phone_price = '$column_value',";
						continue;
					}
					if($column_name == "标准配置:") {
						$ddhtml = $array[$key + 1];
						$ddstart_position = $this -> get_att_position($ddhtml, "<dd>");
						$ddend_position = $this -> get_att_position($ddhtml, "</dd>");
						$column_value = substr($ddhtml, $ddstart_position + 4, $ddend_position - ($ddstart_position + 4));
						$column_value = $this -> gb2utf($column_value);
						$this -> printf($column_name);
						$this -> writeLine();
						$this -> printf($column_value);
						$this -> writeLine();
						$sql .= " phone_standardconfig = '$column_value',";
						continue;
					}
					$dlhtml = $this -> html_separator($value, "<dt>");
					foreach($dlhtml as $htmlkey => $htmlvalue) {
						//$this -> printf($this -> gb2utf(htmlspecialchars($htmlvalue)));
						if($htmlvalue == "</dl>")
							continue;
						$dtstart_position = 0;
						$dtend_position = $this -> get_att_position($htmlvalue, "</dt>");
						$column_name = substr($htmlvalue, $dtstart_position, $dtend_position);
						$ddstart_position = $this -> get_att_position($htmlvalue, "<dd>");
						$ddend_position = $this -> get_att_position($htmlvalue, "</dd>");
						$column_value = substr($htmlvalue, $ddstart_position + 4, $ddend_position - ($ddstart_position + 4));

						$column_name = $this -> gb2utf($column_name);
						if($column_name == "屏幕参数：") {
							$fontstart_position = $this -> get_att_position($htmlvalue, "<font color=red>");
							$fontend_position = $this -> get_att_position($htmlvalue, "</font>");
							$column_value = substr($htmlvalue, $fontstart_position + 16, $fontend_position - ($fontstart_position + 16));
						}
						$column_value = $this -> gb2utf($column_value);

						$this -> printf($column_name);
						$this -> writeLine();
						$this -> printf($column_value);
						$this -> writeLine();
						switch($column_name) {
						case "上市时间：":
							$column_value = substr($column_value, 0, 4);
							$sql .= " timetomarket = $column_value,";
							break;
						case "重　量　：":
							$sql .= " weight = '$column_value',";
							break;
						case "尺寸/体积：":
							$sql .= " measurement = '$column_value',";
							break;
						case "外观样式：":
							$sql .= " presentationstyles = '$column_value',";
							break;
						case "可选颜色：":
							$sql .= " choosecolor = '$column_value',";
							break;
						case "屏幕参数：":
							$sql .= " screenparameter = '$column_value',";
							break;
						case "操作系统：":
							$sql .= " operationsystem = '$column_value',";
							break;
						case "处理器：":
							$sql .= " cpu = '$column_value',";
							break;
						case "内存容量：":
							$sql .= " internalstorage = '$column_value',";
							break;
						default :
							$sql .= "";
							break;
						}
					}
				}
			}
			$sql = substr($sql, 0, strlen($sql) - 1);
			$sql .= " where phone_id=$phone_id";
			$this -> db -> execute($sql);
		}

		function get_att_position($html, $attribute) {
			return strpos($html, $attribute);
		}

		function html_separator($html, $separator) {
			$array = array();
			$array = explode($separator, $html);
			return $array;
		}

		function html_specialchars($html) {
			return htmlspecialchars($html);
		}

		function gb2utf($text) {
			return iconv("GB2312", "UTF-8", $text);
		}

		function printf($text) {
			if(DEBUG) {
				echo $text;
			}
		}

		function writeLine() {
			if(DEBUG) {
				echo "<br />";
			}
		}
	}

	class DbUtil {
		var $con = null;
		function __construct() {
			$this -> con = mysql_connect("localhost", "root", "root");
			if(!$this -> con) {
				die("Could not connect: " . mysql_error());
			}
			@mysql_select_db("phonetype");
			@mysql_query("set NAMES utf8", $this -> con);
		}

		function query($sql) {
			return @mysql_query($sql, $this -> con);
		}

		function fetch_array($query) {
			$array = array();
			while($row = @mysql_fetch_array($query)) {
				$array[] = $row;
			}
			return $array;
		}

		function execute($sql) {
			if(!@mysql_query($sql, $this -> con)) {
				$this -> show_message(mysql_error() . " cannot execute the sql: $sql");
			}
		}

		function last_insert_id() {
			return @mysql_insert_id($this -> con);
		}

		function __destruct() {
			@mysql_close($this -> con);
		}

		function show_message($message) {
			echo $message;
		}
	}
?>