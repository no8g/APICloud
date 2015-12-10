<?php
/**
 * PHP文件上传 错误代码对应信息
 *
 * @access: public
 * @author: fanzhe 2015-04-04
 * @param: int，$file_error ，文件上传错误代码
 * @return: string
 */

function file_upload_error($file_error)
{
	$error_info = '';
	switch ($file_error) {
		case 0:
			$error_info = "文件上传成功。";
			break;
		case 1:
			$error_info = "文件大小超出了服务器的空间大小。";
			break;
		case 2:
			$error_info = "要上传的文件大小超出浏览器限制。";
			break;
		case 3:
			$error_info = "文件仅部分被上传。";
			break;
		case 4:
			$error_info = "没有找到要上传的文件。";
			break;
		case 5:
			$error_info = "服务器临时文件夹丢失。";
			break;
		case 6:
			$error_info = "文件写入到临时文件夹出错。";
			break;
		case 7:
			$error_info = "文件写入失败。";
			break;
		default:
			$error_info = "未知的服务器错误。";
			break;
	}
	return $error_info;
}
?>