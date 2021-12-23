<?php
namespace PlaygroundStudio\BlackBridge\BenchmarkTools;

use Exception;
use PlaygroundStudio\BlackBridge\Element;

class StopWatch extends Element
{
    private $name = '';
    private $startTime = null;
    private $laps = [];
    private $stopTime = null;
    private $alerts = [];

    public function __construct($name = 'A Laravel Benchmark') {
        $this->startTime = \LARAVEL_START ?? \microtime();
        $this->name = $name;
    }

    /**
     * เริ่มต้นการจับเวลา
     *
     * @return void
     */
    public function start() {
        $this->reset();
        $this->startTime = \microtime(true);
    }

    /**
     * รีเซตประวัติการจับเวลาทั้งหมด
     *
     * @return void
     */
    public function lap($name) {
        if($name == 'Start' || $name == 'Stop') {
            throw new Exception("Bemchmark lap name '$name' is reserved.");
        }
        foreach($this->laps as $lap) {
            if($lap->name == $name) {
                throw new Exception("Bemchmark lap name '$name' is already exist.");
            }
        }
        $this->laps[] = (object) [
            'time' => \microtime(true),
            'name' => $name
        ];
    }

    /**
     * หยุดการจับเวลา
     *
     * @return void
     */
    public function stop() {
        $this->stopTime = \microtime(true);
    }

    /**
     * รีเซตประวัติการจับเวลาทั้งหมด
     *
     * @return void
     */
    public function reset() {
        $this->startTime = null;
        $this->laps = [];
        $this->stopTime = null;
    }

    /**
     * คำนวนระยะ
     *
     * @param [type] $from
     * @param [type] $to
     * @return void
     */
    private function timeDiff($from, $to) {
        return $to - $from;
    }

    /**
     * คำนวนเวลาสิ้นสุดกับเวลาเริ่มต้น
     *
     * @param [type] $endTime
     * @return void
     */
    private function time($endTime) {
        return $this->timeDiff($this->startTime, $endTime);
    }

    /**
     * อ่านค่าเวลาบันทึกโดยระบุเป็นชื่อ
     *
     * @param [type] $name
     * @return void
     */
    private function timeByName($name) {
        if($name == 'Start') return 0;
        if($name == 'Stop') return $this->stopTime;
        foreach($this->laps as $lap) {
            if($name == $lap->name) {
                return $lap->time;
            }
        }
        return false;
    }

    /**
     * เรียกดูข้อมูลเวลาประมวลผลจากเวลาเริ่มต้น โดยระบุชื่อของเวลาสิ้นสุดได้
     *
     * @param string $endName ชื่อของเวลาสิ้นสุด
     * @return void
     */
    public function getTime($endName = 'Stop') {
        $endTime = $this->timeByName($endName);
        return $this->time($endTime);
    }

    private function calcData() {
        if($this->stopTime == null) {
            $this->stop();
            $this->alerts[] = 'Auto stopping by calcData method';
        }

        $lists = [(object)[ 'name' => 'Start', 'time' => 0 ]];
        foreach($this->laps as $lap) {
            $lists[] = (object)[
                'name' => $lap->name,
                'time' => $this->time($lap->time)
            ];
        }
        $lists[] = (object)[
            'name' => 'Stop',
            'time' => $this->time($this->stopTime)
        ];

        return $lists;
    }

    public function dd() {
        $data = [
            'name' => $this->name,
            'lists' => $this->calcData(),
            'alerts' => $this->alerts
        ];
        dd($data);
    }

    /**
     * ส่งออกเป็นรายงานในหน้า HTML ในรูปแบบของตาราง
     *
     * @return void
     */
    public function generateReport() {
        $data = [
            'name' => $this->name,
            'lists' => $this->calcData(),
            'alerts' => $this->alerts
        ];
        return $this->view('benchmark_tools.stopwatch_report', $data);
    }

}
