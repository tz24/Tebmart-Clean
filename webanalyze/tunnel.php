<?php
define("VERSION", "1.1");

error_reporting(0);

$remote_ip = $_SERVER['REMOTE_ADDR'];
switch ($remote_ip)
{
    case '185.72.156.128':
    case '185.72.156.129':
    case '185.72.156.130':
    case '185.72.156.131':
    case '185.72.156.133':
        break;
    
    default:
        PrintOutput(false, 'wrong remote IP: '.$remote_ip);
        exit;
    
}

$website_access_key = '12345678900';

$data = trim($_REQUEST['data']);
$data = json_decode(base64_decode($data), true);

    
$session_id = trim($data['session_id']);
$session_code = trim($data['session_code']);
$version = trim($data['version']);
if (VERSION < $version || $version == '')
{
    PrintOutput(false, 'Old version. Installed: '.VERSION.' Request sent from version '.$version);
    exit;
}

$task = trim($data['task']);

if (md5($session_id.$website_access_key) != $session_code) 
{
    PrintOutput(false, 'error authorization');
    exit;
}

switch ($task)
{
    case 'self_info':
        //$result = array('server' => $_SERVER);
        $result = array('version' => VERSION);
        PrintOutput(true, '', $result);
        break;
        
    case 'remove_tunnel':
        $a = unlink(__FILE__);
        if ($a) PrintOutput(true, '');
        else PrintOutput(false, 'Cant remove '.__FILE__);
        exit;
        break;
        
    case 'remove_files':
        $files = trim($data['files']);
        $files = json_decode($files, true);
        if ($files === false)
        {
            PrintOutput(false, 'wrong file list');
            exit;
        }
        $result_array = TASK_remove_files($files);
        PrintOutput($result_array['status'], $result_array['description']);
        exit;
        break;
        
    case 'get_files_info':
        $files = trim($data['files']);
        $files = json_decode($files, true);
        //print_r($files);
        if ($files === false)
        {
            PrintOutput(false, 'wrong file list');
            exit;
        }
        $result = TASK_get_files_info($files);
        PrintOutput(true, '', $result); 
        break;
        
        
    case 'get_file_content':
        $file = trim($data['file']);
        //print_r($files);
        if ($file == '')
        {
            PrintOutput(false, 'wrong file'.print_r($data, true));
            exit;
        }
        $result = TASK_get_file_content($file);
        PrintOutput(true, '', $result);
        break;
        
        
    case 'save_file_content':
        $file = trim($data['file']);
        $file_content = base64_decode(trim($data['file_content']));
        //print_r($files);
        if ($file == '')
        {
            PrintOutput(false, 'wrong file'.print_r($data, true));
            exit;
        }
        $result_array = TASK_save_file_content($file, $file_content);
        PrintOutput($result_array['status'], $result_array['description']);
        break;
        
        
    default:
        PrintOutput(false, 'task '.$task.' is absent');
    
}

exit;


function GetDir()
{
    $dir = dirname(__FILE__);
    $dir = str_replace("/webanalyze", "", $dir); 
    
    return $dir;   
}


function TASK_save_file_content($file, $file_content)
{
    $dir = GetDir();
    
    $file_full = $dir.$file;
    
    $fp = fopen($file_full, 'w');
    if ($fp === false) return array('status' => false, 'description' => 'Cant open file (fopen) '.$file_full);
    $file_content = str_replace("\r\n","\n", $file_content);
    $a = fwrite($fp, $file_content);
    if ($a === false) return array('status' => false, 'description' => 'Cant save content (fwrite) '.$file_full);
    $a = fclose($fp);
    if ($a === false) return array('status' => false, 'description' => 'Cant close the file (fclose) '.$file_full);
    
    return array('status' => true, 'description' => $file_full);
}


function TASK_remove_files($files)
{
    $result_description = '';
    $result_status = true;
    
    $dir = GetDir();
    
    if (count($files))
    {
        foreach ($files as $file)
        {
            $file = trim($file);
            $file_full = $dir.$file;
            if (file_exists($file_full))
            {
                $a = unlink($file_full);
                if ($a === false) 
                {
                    $result_description .= $file.' - ERROR [unlink]'."\n";
                    $result_status = false;
                }
                else $result_description .= $file.' - OK'."\n";
            }
            else {
                $result_description .= $file.' - FILE ABSENTS'."\n";
            }
        }
    }
    else {
        $result_description = 'File list is empty';
        $result_status = false;
    }
    
    return array('status' => $result_status, 'description' => $result_description);
}


function TASK_get_file_content($file)
{
    $dir = GetDir();
    
    $file_full = $dir.$file;
    if (file_exists($file_full) === false) $file_content = 'file is not exist';
    else {
        $handle = fopen($file_full, "r");
        $file_size = filesize($file_full);
        $file_content = fread($handle, $file_size);
        fclose($handle);
    }
    
    $a = array(
        'file' => $file_full,
        'filesize' => $file_size,
        'content' => $file_content
    );
    
    return $a;
}


function TASK_get_files_info($files)
{
    $dir = GetDir();
    $a = array();
    foreach($files as $file)
    {
        $file = trim($file);
        $file_full = $dir.$file;
        if (file_exists($file_full) === false) $filesize = 'absent';
        else {
            $filesize = filesize($file_full);
            $file_md5 = md5_file($file_full);
        }

        $a[] = array(
            'file' => $file,
            'size' => $filesize,
            'md5' => $file_md5
        );
    }
    
    return $a;
}


function PrintOutput($result_type, $result_reason = '', $result_data = array())
{
    $a = array();
    if ($result_type) $a['status'] = 'ok';
    else $a['status'] = 'error';
    
    $a['description'] = $result_reason;
    
    $a['data'] = $result_data;
    
    echo json_encode($a);
}

?>