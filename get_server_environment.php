<?php

set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';

// read template xls file
$reader = PHPExcel_IOFactory::createReader('Excel2007');
$excel = $reader->load("server_environment_template.xlsx");

// set active sheet
$excel->setActiveSheetIndex(0);
$sheet = $excel->getActiveSheet();

// シートの設定
$sheet->setTitle('Basic');

// セルに値を入れる
// 基本設定
$sheet->setCellValue('D4', `hostname`);
$sheet->setCellValue('D5', `cat /etc/lsb-release`);
$sheet->setCellValue('F6', `cat /proc/cpuinfo | grep processor`);
$sheet->setCellValue('F7', `cat /proc/cpuinfo | grep "physical id"`);
$sheet->setCellValue('F8', `cat /proc/cpuinfo | grep "cpu cores"`);
$sheet->setCellValue('F9', `free -h |grep Mem |sed 's/[\t ]\+/\t/g' |cut -f2`);
$sheet->setCellValue('D11', `free -h`);
$sheet->setCellValue('D16', `df -hT`);
$sheet->setCellValue('D26', `mount`);

// ネットワーク設定
$sheet->setCellValue('D50', `cat /etc/hosts`);
$sheet->setCellValue('D60', `cat /etc/resolv.conf`);
$sheet->setCellValue('D65', `cat /etc/networks`);
$sheet->setCellValue('D68', `cat /etc/network/interfaces`);
$sheet->setCellValue('D84', `ifconfig`);

// ネットワーク設定
$sheet->setCellValue('D124', `netstat -rn`);
$sheet->setCellValue('D137', `initctl list`);

// セキュリティ設定
$sheet->setCellValue('D150', `sudo iptables -L`);
$sheet->setCellValue('D159', `which getenforce; if [ $? = 1 ]; then echo "SELinux not installed."; else getenfotce; fi`);

// SSH設定
$sheet->setCellValue('D164', `cat /etc/ssh/sshd_config`);

// NTP設定
$sheet->setCellValue('D254', `cat /etc/ntp.conf`);

// ログローテーション設定
$sheet->setCellValue('D282', `cat /etc/logrotate.conf`);

// インストールパッケージ一覧
$sheet->setCellValue('D310', `dpkg -l`);

// Excel2007 形式で出力
$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$writer->save("server_environment.xlsx");
